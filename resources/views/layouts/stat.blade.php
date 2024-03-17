<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Category Stat</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table class="table table-bordered">
      <tr>
        <th style="width: 10px">ID</th>
        <th>Name</th>
        <th>Progress</th>
        <th style="width: 40px">Percent </th>
      </tr>
      @php
        $products = App\Products::all()
      @endphp
      @foreach($cat as $ct)
      <!-- if($ct->id % 2 == 0) -->
      @php
        $prods = App\Products::where('cat_id','=',[$ct->id])->get()
      @endphp
      <tr>
        <td>{{$ct->id}}.</td>
        <td><a href="list/{{$ct->id}}">{{$ct->cat_name}}</a> </td>
        <td>
          <div class="progress progress-xs progress-striped active">
            <div class="progress-bar progress-bar-success" style="width: {{substr((count($prods)/count($products))*100,0,4)}}%"></div>
          </div>
        </td>
        <td><span class="badge bg-red">{{substr((count($prods)/count($products))*100,0,4)}}%</span></td>
      </tr>
      <!-- endif -->
      @endforeach
    </table>
  </div>
  <!-- <div class="box-footer clearfix">
    <ul class="pagination pagination-sm no-margin pull-right">
      <li><a href="#">&laquo;</a></li>
      <li><a href="#">1</a></li>
      <li><a href="#">2</a></li>
      <li><a href="#">3</a></li>
      <li><a href="#">&raquo;</a></li>
    </ul>
  </div> -->
</div>

<section class="content">
  <div class="row">
    <div class="col-xs-12">

      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Tasks <small>with closest deadline</small> </h3>
        </div>
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th class="text-center">Task Title</th>
              <th class="text-center">Deadline</th>
              <th class="text-center">#</th>
            </tr>
            </thead>
            <tbody>
              @php
              $mytds = App\Task::where('assigned_member','=',[Auth::user()->id])->where('status','!=',2)->orderBy('deadline','asc')->take(10)->get()
              @endphp
              @foreach($mytds as $mytd)
              <tr class="odd gradeX">
                <td>{{$mytd->title}}</td>
                @php
                $fromnow = \Carbon\Carbon::parse($mytd->deadline)->diffInDays()
                @endphp
                @if($mytd->deadline->format('Y-m-d') > date('Y-m-d'))
                  <td>{{$mytd->deadline->format('d M, Y')}} ({{$fromnow}} days left)</td>
                @elseif($mytd->deadline->format('Y-m-d') == date('Y-m-d'))
                  <td style="color:red;">Today is deadline</td>
                @else
                  <td style="color:red;">Deadline passed ({{$fromnow}} days passed)</td>
                @endif
                <td><a href="/task/{{$mytd->access_token}}" title="see more about {{$mytd->title}}" class="btn btn-primary">More</a> </td>
              </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th class="text-center">Task Title</th>
                <th class="text-center">Deadline</th>
                <th class="text-center">#</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>

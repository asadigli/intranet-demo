@extends('layouts.master')

@section('body')
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      All Ideas
      <small>All Ideas sent by ASGRO members</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="/home"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">All Tasks</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">
              Ideas
            </h3>
          </div>
            @include('layouts.alerts')
          <!-- /.box-header -->
          <div class="box-body">
            <input class="form-control" id="Permissions" type="text" placeholder="Search..">
            <br>
            <table  class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Image</th>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Sender</th>
                  <th>Buttons</th>
                </tr>
              </thead>
              <tbody id="permissionTable">
                @foreach($ideas as $idea)
                <tr>
                  <td>
                    @if(count($idea->image1) != 0)
                    <img src="{{ asset('uploads/ideas/'.$idea->image1)}}" style="heigh:60px;width:60px;">
                    @else
                    No Image
                    @endif
                  </td>
                  <td>{{ str_limit($idea->title, 60) }}</td>
                  <td>{!! str_limit($idea->description, 100) !!}</td>
                  <td style="text-transform:capitalize;">
                    @php
                    $user = App\User::where('id','=',[$idea->user_id])->get()
                    @endphp
                    @foreach($user as $us)
                    {{$us->name}} {{$us->surname}}
                    @endforeach
                  </td>
                  <td>
                    <a data-toggle="modal" data-target="#more{{$idea->id}}"  class="btn btn-primary">More</a>
                    <a data-toggle="modal" data-target="#delete{{$idea->id}}"  class="btn btn-danger">Delete</a><br><br>
                   </td>
                   <!-- idea delete popup start -->
                   <div class="modal fade" id="delete{{$idea->id}}" role="dialog">
                     <div class="modal-dialog">
                       <div class="modal-content">
                         <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal">&times;</button>
                           <h4 class="modal-title">Delete</h4>
                         </div>
                         <div class="modal-body">
                           <p>Are you sure to <b style="text-transform:uppercase;">{{$idea->title}}</b>?</p>
                           <br>
                         </div>
                         <div class="modal-footer">
                           <a href="/delete/idea/{{$idea->id}}" class="btn btn-danger">Yes</a>
                             <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                         </div>
                       </div>

                     </div>
                   </div>
                   <!-- idea deletion popup ends -->
                   <!-- More section -->
                   <div class="modal fade" id="more{{$idea->id}}" role="dialog">
                     <div class="modal-dialog">
                       <div class="modal-content">
                         <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal">&times;</button>
                           <h4 class="modal-title">More</h4>
                         </div>
                         <div class="modal-body">
                           <div id="myCarousel" class="carousel slide" data-ride="carousel">
                             <ol class="carousel-indicators">
                               <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                               <li data-target="#myCarousel" data-slide-to="1"></li>
                               <li data-target="#myCarousel" data-slide-to="2"></li>
                             </ol>
                              <div class="carousel-inner">
                                @if(count($idea->image1) != 0)
                                  <div class="item active">
                                    <img src="{{ asset('uploads/ideas/'.$idea->image1)}}" alt="image" style="width:60%;">
                                  </div>
                                @endif
                                @if(count($idea->image2) != 0)
                                  <div class="item">
                                    <img src="{{ asset('uploads/ideas/'.$idea->image2)}}" alt="image" style="width:60%;">
                                  </div>
                                @endif
                                @if(count($idea->image3) != 0)
                                  <div class="item">
                                    <img src="{{ asset('uploads/ideas/'.$idea->image3)}}" alt="image" style="width:60%;">
                                  </div>
                                @endif
                                @if(count($idea->image4) != 0)
                                  <div class="item">
                                    <img src="{{ asset('uploads/ideas/'.$idea->image4)}}" alt="image" style="width:60%;">
                                  </div>
                                @endif
                                @if(count($idea->image5) != 0)
                                  <div class="item">
                                    <img src="{{ asset('uploads/ideas/'.$idea->image5)}}" alt="image" style="width:60%;">
                                  </div>
                                @endif
                              </div>
                               <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                                 <span class="glyphicon glyphicon-chevron-left"></span>
                                 <span class="sr-only">Previous</span>
                               </a>
                               <a class="right carousel-control" href="#myCarousel" data-slide="next">
                                 <span class="glyphicon glyphicon-chevron-right"></span>
                                 <span class="sr-only">Next</span>
                               </a>
                             <ul class="list-group">
                               <li class="list-group-item"><b style="color:#003399">ID:</b> {{$idea->id}}</li>
                               <li class="list-group-item"><b style="color:#003399">Sender: </b>
                                 @php
                                 $user = App\User::where('id','=',[$idea->user_id])->get()
                                 @endphp
                                 @foreach($user as $us)
                                 {{$us->name}} {{$us->surname}}
                                 @endforeach
                               </li>
                               <li class="list-group-item"><b style="color:#003399">Title:</b> {{$idea->title}}</li>
                               <li class="list-group-item"><b style="color:#003399">Details: </b>{!! $idea->description !!}</li>
                             </ul>
                            </div>
                            </div>
                         </div>
                         <div class="modal-footer">
                         </div>
                       </div>

                     </div>
                   </div>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection

@section('js')
<script src="{{ asset('plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<script src="{{ asset('bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{ asset('plugins/fastclick/fastclick.js')}}"></script>
<script src="{{ asset('dist/js/app.min.js')}}"></script>
<script src="{{ asset('dist/js/demo.js')}}"></script>
<script>
$(document).ready(function(){
  $("#Permissions").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#permissionTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
@endsection

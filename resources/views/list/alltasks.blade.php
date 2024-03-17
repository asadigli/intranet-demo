@extends('layouts.master')

@section('body')
<link rel="stylesheet" href="{{ asset('css/main.css')}}">
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      All Tasks
      <small>All Open tasks</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="/home"><i class="fa fa-home"></i> Home</a></li>
      <li class="active"> All Tasks</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">
              All Tasks
                <small>
                  <a href="/list/all-finished-tasks">All Finished Tasks' List</a>
                </small>
            </h3>
          </div>
            @include('layouts.alerts')
          <!-- /.box-header -->
          <div class="box-body">
            <input class="form-control" id="AllTasks" type="text" placeholder="Search..">
            <br>
            <table  class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Title</th>
                  <th>Assigned</th>
                  <th>Start Date</th>
                  <th>Percent</th>
                </tr>
              </thead>
              <tbody id="alltaskTable">
                @foreach($tasks as $task)
                <tr>
                  <td>{{$task->title}}</td>
                  <td class="capi">
                    @php
                    $user = App\User::where('id','=',[$task->assigned_member])->get()
                    @endphp
                    @foreach($user as $us)
                    {{$us->name}} {{$us->surname}}
                    @endforeach
                  </td>
                  <td>{{\Carbon\Carbon::parse($task->start_date)->formatLocalized('%d %b %Y')}}<br>
                     @php
                     $DeferenceInDays = \Carbon\Carbon::parse($task->deadline)->diffInDays($task->start_date)
                     @endphp
                     @php
                     $fromnow = \Carbon\Carbon::parse($task->deadline)->diffInDays(date('Y-m-d H:i:s'))
                     @endphp
                        (Duration: {{$DeferenceInDays}} days)<br>
                     @if($task->deadline->format('Y-m-d') == date('Y-m-d'))
                     <i style="color:red;">Deadline is Today</i>
                     @elseif($task->deadline < date('Y-m-d'))
                     <i style="color:red;">Deadline passed</i>
                     @else
                     <i>({{$fromnow}} from now)</i>
                     @endif
                   </td>
                  <td>
                    <div class="c100 p{{$task->percent}} center">
                        <span>{{$task->percent}}%</span>
                        <div class="slice">
                            <div class="bar"></div>
                            <div class="fill"></div>
                        </div>
                    </div>
                  </td>
                  <td>
                    <a href="" class="btn btn-success" data-toggle="modal" data-target="#more{{$task->id}}">Detail</a>
                    <a href="/task/{{$task->access_token}}" class="btn btn-primary">More</a>
                  </td>

                  <!-- Modal -->
                  <div class="modal fade" id="more{{$task->id}}" tabindex="-1" role="dialog" aria-labelledby="moreModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document" >
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="moreModalLabel">{{$task->title}}</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <ul class="list-group">
                            <li class="list-group-item">{{$task->title}}</li>
                            <li class="list-group-item"><b>FROM</b> {{$task->start_date->format('d M Y')}} <b>TO </b> {{$task->deadline->format('d M Y')}}</li>
                            <li class="list-group-item">{!! $task->details !!}</li>
                          </ul>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
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
  $("#AllTasks").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#alltaskTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
@endsection

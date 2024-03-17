@extends('layouts.master')

@section('body')
<link rel="stylesheet" href="{{ asset('css/main.css')}}">
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Task Control
      <small>You can see and control your tasks here.</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="/home"><i class="fa fa-home"></i> Home</a></li>
      <li><i class="fa fa-tasks"></i> Tasks</li>
      <li class="active">My Tasks</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">My Tasks</h3>
          </div>
          @include('layouts.alerts')
          <div class="box-body">
            <input class="form-control" id="Tasks" type="text" placeholder="Search..">
            <br>
            <table  class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Title</th>
                  <th>Start Date</th>
                  <th>Duration</th>
                  <th>Percent</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="taskTable">
                @foreach($tasks as $task)
                <tr>
                  <td>{{$task->title}}</td>
                  <td>{{\Carbon\Carbon::parse($task->start_date)->formatLocalized('%d %b %Y')}}
                    ({{$task->start_date->diffForHumans()}}) </td>
                  <td>
                    @php
                    $DeferenceInDays = \Carbon\Carbon::parse($task->deadline)->diffInDays($task->start_date)
                    @endphp
                    @php
                    $fromnow = \Carbon\Carbon::parse($task->deadline)->diffInDays()
                    @endphp
                    {{$DeferenceInDays}} days <br>
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
                    @if($task->start_date->format('Y-m-d') > date('Y-m-d'))
                    <b style="color:red;">Not Started, Yet.</b>
                    @else
                    <a href="" class="btn btn-success" data-toggle="modal" data-target="#more{{$task->id}}">Detail</a>
                    <a href="/task/{{$task->access_token}}" class="btn btn-primary">More</a>
                    @endif
                  </td>
                  <div class="modal fade" id="more{{$task->id}}" tabindex="-1" role="dialog" aria-labelledby="moreModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
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
  $("#Tasks").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#taskTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
@endsection

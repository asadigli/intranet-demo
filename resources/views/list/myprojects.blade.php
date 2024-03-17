@extends('layouts.master')

@section('body')
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Project List
      <small>All projects assigned to you</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="/home"><i class="fa fa-home"></i> Home</a></li>
      <li class="active"> All Projects</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">
              <center>My Projects</center>
            </h3>
          </div>
          @include('layouts.alerts')
          <div class="box-body">
            <input class="form-control" id="AllTasks" type="text" placeholder="Search..">
            <br>
            <table  class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Title</th>
                  <th>Start Date</th>
                  <th>Duration</th>
                </tr>
              </thead>
              <tbody id="alltaskTable">
                @foreach($project as $project)
                <tr>
                  <td>{{$project->name}}</td>
                  <td>{{substr(($project->start_date),0,10)}} ({{$project->start_date->diffForHumans()}}) </td>
                  <td>
                    @php
                    $DeferenceInDays = \Carbon\Carbon::parse($project->deadline)->diffInDays($project->start_date)
                    @endphp
                    {{$DeferenceInDays}} days
                    @php
                    $fromnow = \Carbon\Carbon::parse($project->deadline)->diffInDays(date('Y-m-d H:i:s'))
                    @endphp
                    <br>
                    @if($project->deadline->format('Y-m-d') == date('Y-m-d'))
                    <i style="color:red;">Deadline is Today</i>
                    @elseif($project->deadline < date('Y-m-d'))
                    <i style="color:red;">Deadline passed</i>
                    @else
                    <i>({{$fromnow}} from now)</i>
                    @endif
                  </td>
                  <td>
                    <a href="/project/{{$project->token}}" class="btn btn-primary">More</a>
                    <a href="" class="btn btn-danger" data-toggle="modal" data-target="#delete{{$project->id}}">Delete</a>
                  </td>
                  <div class="modal fade" id="delete{{$project->id}}" tabindex="-1" role="dialog" aria-labelledby="moreModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document" >
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="moreModalLabel">{{$project->name}}</h5>
                        </div>
                        <div class="modal-body">
                          <span>Are sure to delete this project?</span>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                          <a href="#" class="btn btn-danger">Yes</a>
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

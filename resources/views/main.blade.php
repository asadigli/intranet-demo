@extends('layouts.master')

@section('body')
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Home
      <small>Member Panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3>
              @php
              $tasks = App\Task::where('assigned_member','=',[Auth::user()->id])->where('status','!=',2)->get()
              @endphp
              {{count($tasks)}}
            </h3>
            <p>My Tasks</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-green">
          <div class="inner">
            <h3>
              @php
              $projects = App\Project::all()
              @endphp
              {{count($projects)}}
            </h3>
            <p>Projects</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
        </div>
      </div>
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-yellow">
          <div class="inner">
            @php
            $user = App\User::all()
            @endphp
            <h3>{{count($user)}}</h3>
            <p>Members</p>
          </div>
          <div class="icon">
            <i class="ion ion-person"></i>
          </div>
          <!-- <a href="/users" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
        </div>
      </div>
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-red">
          <div class="inner">
            <h3>
              @php
              $activetasks = App\Task::where('status','!=',2)->get()
              @endphp
              {{count($activetasks)}}
            </h3>
            <p>All Active Tasks</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
        </div>
      </div>
    </div>
      @include('layouts.alerts')
    <div class="row">
      <section class="col-lg-7">
          @include('layouts.tabs')
      </section>
      <section class="col-lg-5">
        <div class="box box-solid bg-green-gradient">
          <div class="box-header">
            <i class="fa fa-calendar"></i>
            <h3 class="box-title">Calendar</h3>
            <div class="pull-right box-tools">
              <!-- button with a dropdown -->
              <!-- <div class="btn-group">
                <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bars"></i></button>
                <ul class="dropdown-menu pull-right" role="menu">
                  <li><a href="#">Add new event</a></li>
                  <li><a href="#">Clear events</a></li>
                  <li class="divider"></li>
                  <li><a href="#">View calendar</a></li>
                </ul>
              </div> -->
              <!-- <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i>
              </button> -->
            </div>
          </div>
          <div class="box-body no-padding">
            <div id="calendar" style="width: 100%"></div>
          </div>
      </section>
      @include('layouts.maintable')
    </div>
  </section>
</div>
@endsection

@section('js')
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{ asset('plugins/morris/morris.min.js')}}"></script>
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="plugins/knob/jquery.knob.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="plugins/fastclick/fastclick.js"></script>
<script src="dist/js/app.min.js"></script>
<script src="dist/js/pages/dashboard.js"></script>
<script src="dist/js/demo.js"></script>
@endsection

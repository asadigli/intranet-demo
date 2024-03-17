@extends('layouts.master')

@section('body')

<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script src="{{ asset('js/tinymce.js')}}"></script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Start A Project
        <small> Add details about a new project</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-home"></i> Home</a></li>
        <li class="active"><a href="/add/project">Start Project</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- /.row -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box box-default">
              <div class="box-header with-border">
                <h3 class="box-title">Create a new project
                </h3>
                @if(Session::has('project_added'))
                <br><br>
                  <center>
                    <div class="col-md-4" style="width:100%;">
                      <div class="alert alert-success">
                        {{Session::get('project_added')}}
                      </div>
                    </div>
                  </center>
                @endif
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="row">
                  <div class="col-md-9 col-md-offset-1">
                    <div class="form-group">
                      <form class="form-horizontal row-fluid" method="POST" action="/add/newproject" enctype="multipart/form-data" >
                          {{ csrf_field() }}
                        <div class="form-group">
                          <label class="col-xs-2 control-label">Project Name </label>
                          <div class="col-xs-10">
                            <input class="form-control" type="text" name="name" placeholder="Name..." autocomplete="off"  required>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong style="color:red;">{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-xs-2 control-label">Project Goal </label>
                          <div class="col-xs-10">
                            <input class="form-control" type="text" name="goal" placeholder="Goal..." autocomplete="off"  required>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-xs-2 control-label">Project Budget </label>
                          <div class="col-xs-10">
                            <input class="form-control" type="text" name="budget" placeholder="Budget..." autocomplete="off">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-xs-2 control-label">Needed Budget </label>
                          <div class="col-xs-10">
                            <input class="form-control" type="text" name="budget_needed" placeholder="Demand..." autocomplete="off">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-xs-2 control-label">Focused Group </label>
                          <div class="col-xs-10">
                            <input class="form-control" type="text" name="focused_group" placeholder="Focused Group..." autocomplete="off" required>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-xs-2">Project Manager </label>
                          <div class="col-xs-10">
                            <select class="form-control capi" name="project_manager">
                              @php
                              $users = App\User::orderBy('name','asc')->get()
                              @endphp
                              @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->name}} {{$user->surname}}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-xs-2 control-label">Project Start Date </label>
                          <div class="col-xs-10">
                            <input class="form-control" type="date" name="start_date">
                            @if ($errors->has('start_date'))
                                <span class="help-block">
                                    <strong style="color:red;">{{ $errors->first('start_date') }}</strong>
                                </span>
                            @endif
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-xs-2 control-label">Project End Date </label>
                          <div class="col-xs-10">
                            <input class="form-control" type="date" name="deadline">
                            @if ($errors->has('deadline'))
                                <span class="help-block">
                                    <strong style="color:red;">{{ $errors->first('deadline') }}</strong>
                                </span>
                            @endif
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-xs-2 control-label">Start Country </label>
                          <div class="col-xs-10">
                            <select class="form-control" name="start_country">
                              <option value="0">Azerbaijan</option>
                              <option value="1">Turkey</option>
                              <option value="2">USA</option>
                              <option value="3">Georgia</option>
                            </select>
                            @if ($errors->has('start_country'))
                                <span class="help-block">
                                    <strong style="color:red;">{{ $errors->first('start_country') }}</strong>
                                </span>
                            @endif
                          </div>
                        </div>
                        <input type="hidden" name="document" value="0">
                        <div class="form-group">
                          <label class="col-xs-2 control-label">Project Details</label>
                          <div class="col-xs-10">
                            <textarea name="details" placeholder="Details..."></textarea>
                            @if ($errors->has('details'))
                                <span class="help-block">
                                    <strong style="color:red;">{{ $errors->first('details') }}</strong>
                                </span>
                            @endif
                          </div>
                        </div>

                        <!-- <div class="control-group">
                          <label class="control-label" >Image</label><br><br>
                          <div class="controls">
                            <input type="file" name="image1" required>
                          </div>
                        </div> -->
                        <br>
                        <div class="control-group">
                          <div class="controls">
                            <button type="submit"  class="btn btn-success pull-right">Create Project</button>
                          </div>
                        </div>
                        <br>
                      </form>
                    </div>
                  </div>
                  <!-- /.col -->
                </div>
                @php
                $idea = App\Ideas::all()
                @endphp
                @foreach($idea as $id)
                <img src="{{asset('storage/app/ideas/'.$id->image1)}}" alt="">
                @endforeach
                <!-- /.row -->
              </div>
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
@endsection

@extends('layouts.master')

@section('body')

<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script src="{{ asset('js/tinymce.js')}}"></script>
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Create Tasks
        <small>Create a new task for members</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-home"></i> Home</a></li>
        <li class="active"><a href="/add/task">Create Taks</a></li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box box-default">
              <div class="box-header with-border">
                <h3 class="box-title">Create a new Taks
                </h3>
                @include('layouts.alerts')
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="row">
                  <div class="col-md-9 col-md-offset-1">
                    <div class="form-group">
                      <form class="form-horizontal row-fluid" method="POST" action="/add/newtask" enctype="multipart/form-data" >
                          {{ csrf_field() }}
                        <div class="form-group">
                          <label class="col-xs-2 control-label" >Title</label>
                          <div class="col-xs-10">
                            <input autocomplete="off" class="form-control" type="text" name="title" placeholder="Add title to the task..." required>
                          </div>
                        </div><br>
                        <div class="form-group">
                          <label class="col-xs-2 control-label">Assign to </label>
                          <div class="col-xs-10">
                            <select class="form-control" name="assigned_member" style="text-transform:capitalize;">
                              <option disabled selected>Select</option>
                              @php
                              $users = App\User::orderBy('name','asc')->get()
                              @endphp
                              @foreach($users as $user)
                              <option value="{{$user->id}}">
                                {{$user->name}} {{$user->surname}}
                              </option>
                              @endforeach
                            </select>
                          </div>
                        </div><br>
                        <div class="form-group">
                          <label class="col-xs-2 control-label">Related to (which project) </label>
                          <div class="col-xs-10">
                            <select class="form-control" name="related_project">
                              <option value="0">None</option>
                              @php
                              $project = App\Project::orderBy('name','asc')->get()
                              @endphp
                              @foreach($project as $pro)
                              <option value="{{$pro->id}}">{{$pro->name}}</option>
                              @endforeach
                            </select>
                          </div>
                        </div><br>

                        <div class="form-group">
                          <label class="col-xs-2 control-label" >Start Date </label>
                          <div class="col-xs-10">
                            <input class="form-control" data-date-format="YYY/MM/DD" type="date" name="start_date" placeholder="Title..." required>
                            @if ($errors->has('start_date'))
                                <span class="help-block">
                                    <strong style="color:red;">{{ $errors->first('start_date') }}</strong>
                                </span>
                            @endif
                          </div>
                        </div><br>
                        <div class="form-group">
                          <label class="col-xs-2 control-label" >End Date </label>
                          <div class="col-xs-10">
                            <input class="form-control" data-date-format="YYY/MM/DD"  type="date" name="deadline" placeholder="Title..." required>
                            @if ($errors->has('deadline'))
                                <span class="help-block">
                                    <strong style="color:red;">{{ $errors->first('deadline') }}</strong>
                                </span>
                            @endif
                          </div>
                        </div><br>

                        <div class="form-group">
                          <label class="col-xs-2 control-label">Details</label>
                          <div class="col-xs-10">
                            <textarea name="details" placeholder="Add details of task..."></textarea>
                          </div>
                        </div>
                        <!-- <div class="control-group">
                          <label class="control-label" >Image</label><br><br>
                          <div class="controls">
                            <input type="file" name="image1" required>
                          </div>
                        </div> -->
                        <hr>
                        <div class="control-group">
                          <div class="controls">
                            <button type="submit" name="submit" class="btn btn-primary pull-right">Create Task</button>
                          </div>
                        </div>
                        <br><br><hr>
                      </form>
                    </div>
                  </div>
                </div>
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

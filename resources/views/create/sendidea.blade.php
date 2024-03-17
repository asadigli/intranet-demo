@extends('layouts.master')

@section('body')
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Send idea
        <small> Send your idea, and let us realize it together</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-home"></i> Home</a></li>
        <li class="active"><a href="/add/sendidea">Send Idea</a></li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box box-default">
              <div class="box-header with-border">
                <h3 class="box-title">Send your idea
                @if(Auth::user()->role_id == 4)
                <small>- <a href="/list/ideas">Idea List</a> </small>
                @endif
                </h3>
                @include('layouts.alerts')
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="row">
                  <div class="col-md-9 col-md-offset-1">
                    <div class="form-group">
                      <form class="form-horizontal row-fluid" method="POST" action="/add/sendidea" enctype="multipart/form-data" >
                          {{ csrf_field() }}
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        <div class="form-group">
                          <label class="col-xs-2 control-label" >Title </label>
                          <div class="col-xs-10">
                            <input autocomplete="off" class="form-control" type="text" name="title" placeholder="Type title of your idea..." required>
                          </div>
                        </div><br>
                        <div class="form-group">
                          <label class="col-xs-2 control-label">Description</label>
                          <div class="col-xs-10">
                            <textarea name="description" placeholder="Add more details about your idea..."></textarea>
                          </div>
                        </div>
                        <br>
                        <div class="form-group">
                          <label class="col-xs-2 control-label" >Image</label>
                          <div class="col-xs-10">
                            <input type="file" name="image1">
                          </div>
                        </div>
                        <hr>
                        <input type="hidden" required />
                        <div class="form-group">
                          <label class="col-xs-2 control-label" ></label>
                          <div class="col-xs-10">
                            <button type="submit" name="submit" class="btn btn-primary pull-right">Send Idea</button>
                          </div>
                        </div>
                        <br>
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
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script src="{{ asset('js/tinymce.js')}}"></script>
<script src="{{ asset('plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<script src="{{ asset('bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{ asset('plugins/fastclick/fastclick.js')}}"></script>
<script src="{{ asset('dist/js/app.min.js')}}"></script>
<script src="{{ asset('dist/js/demo.js')}}"></script>
@endsection

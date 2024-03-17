@extends('layouts.master')

@section('body')
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Add Country
        <small> adding new country</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-home"></i> Home</a></li>
        <li class="active"><a href="/add/country">Add Country</a></li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box box-default">
              <div class="box-header with-border">
                <h3 class="box-title">Add Country -
                </h3>
                @include('layouts.alerts')
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-9">
                    <div class="form-group">
                      <form class="form-horizontal row-fluid"  method="POST" action="/add/country">
                          {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label class="col-xs-2 control-label" >Name</label>
                          <div class="col-xs-10">
                            <input autocomplete="off" class="form-control capi" type="text" id="name" name="name" placeholder="Name..." required>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-xs-2 control-label"></label>
                          <div class="col-xs-10">
                            <input type="submit" name="submit" value="Add New Country" class="btn btn-primary pull-right">
                          </div>
                        </div>
                        <br>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="container" style="margin-left:10px;">
            <table class="table table-condensed">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                </tr>
              </thead>
              <tbody>
                @php
                $cons = App\Country::all()
                @endphp
                @foreach($cons as $con)
                <tr>
                  <td>{{$con->id}}</td>
                  <td>{{$con->country_id}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>

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

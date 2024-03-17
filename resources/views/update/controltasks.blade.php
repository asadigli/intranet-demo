@extends('layouts.master')

@section('body')
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
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
<link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css')}}">
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Permissions Control
      <small>All Members' permissions can be updated here</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="/home"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Permissions Control</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <!-- <div class="box-header">
            <h3 class="box-title">Employee List</h3>
          </div> -->

            @if(Session::has('user_deleted'))
              <br><br>
              <center>
                <div class="col-md-4" style="width:90%;">
                  <div class="alert alert-success">
                    {{Session::get('user_deleted')}}
                  </div>
                </div>
              </center>
            @endif
            @if(Session::has('assigned'))
            <br><br>
            <center>
                <div class="col-md-4" style="width:90%;">
                  <div class="alert alert-success">
                    {{Session::get('assigned')}}
                  </div>
                </div>
              </center>
            @endif
            @if(Session::has('success'))
            <br><br>
            <center>
                <div class="col-md-4" style="width:90%;">
                  <div class="alert alert-success">
                    {{Session::get('success')}}
                  </div>
                </div>
              </center>
            @endif
          <!-- /.box-header -->
          <div class="box-body">
            <input class="form-control" id="Permissions" type="text" placeholder="Search..">
            <br>
            <table  class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Firstname</th>
                  <th>Lastname</th>
                  <th>Email</th>
                </tr>
              </thead>
              <tbody id="permissionTable">
                <tr>
                  <td>John</td>
                  <td>Doe</td>
                  <td>john@example.com</td>
                </tr>
                <tr>
                  <td>Mary</td>
                  <td>Moe</td>
                  <td>mary@mail.com</td>
                </tr>
                <tr>
                  <td>July</td>
                  <td>Dooley</td>
                  <td>july@greatstuff.com</td>
                </tr>
                <tr>
                  <td>Anja</td>
                  <td>Ravendale</td>
                  <td>a_r@test.com</td>
                </tr>
              </tbody>
            </table>

          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<script src="{{ asset('plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<script src="{{ asset('bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{ asset('plugins/fastclick/fastclick.js')}}"></script>
<script src="{{ asset('dist/js/app.min.js')}}"></script>
<script src="{{ asset('dist/js/demo.js')}}"></script>
@endsection

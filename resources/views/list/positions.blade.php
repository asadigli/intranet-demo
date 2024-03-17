@extends('layouts.master')

@section('body')
<link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css')}}">
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      All Tasks
      <small>All Open tasks</small>
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
              <center>All Tasks</center>
            </h3>
          </div>
            @include('layouts.alerts')
          <div class="box-body">
            <input class="form-control" id="Permissions" type="text" placeholder="Search..">
            <br>
            <table  class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Position</th>
                  <th>Edit</th>
                </tr>
              </thead>
              <tbody id="permissionTable">
                @php
                $users = App\User::all()
                @endphp
                @foreach($users as $user)
                <tr>
                  <td>{{ $user->name}} {{$user->surname}}</td>
                  <td>
                    @php
                    $pos = App\Position::where('member_id','=',[$user->id])->get()
                    @endphp
                    @foreach($pos as $pos)
                    <span style="text-transform:capitalize;">{{$pos->position}}</span>
                    @endforeach
                    @if(count($pos) == 0)
                      <span>Not Added</span>
                    @endif
                  </td>
                  <td>
                    @if(count($pos) == 0)
                    <a data-toggle="modal" data-target="#addposition{{$user->id}}"  class="btn btn-primary">Change</a><br><br>
                    @else
                    <a data-toggle="modal" data-target="#changeposition{{$user->id}}"  class="btn btn-primary">Change</a><br><br>
                    @endif
                  </td>
                  <!-- idea delete popup start -->
                  <div class="modal fade" id="addposition{{$user->id}}" role="dialog">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <form class="" action="/add/position" method="post">
                          {{csrf_field()}}
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Delete</h4>
                          </div>
                          <div class="modal-body">
                            {{$user->name}} {{$user->surname}}<br><br>
                            <input type="hidden" name="member_id" value="{{$user->id}}">
                            Position: <br>
                            <input type="text" name="position" class="form-control" placeholder="Position..." required>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                            <button type="submit" name="submit" class="btn btn-primary">Change</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <!-- idea deletion popup ends -->
                  <!-- idea delete popup start -->
                  <div class="modal fade" id="changeposition{{$user->id}}" role="dialog">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        @php
                        $posi = App\Position::where('member_id','=',[$user->id])->get()
                        @endphp
                        @foreach($posi as $pos)
                        <form class="" action="/update/position/{{$pos->id}}" method="post">
                          {{csrf_field()}}
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Delete</h4>
                          </div>
                          <div class="modal-body">
                            {{$user->name}} {{$user->surname}}<br><br>
                            Position: <br>
                            <input type="text" name="position" class="form-control" value="{{$pos->position}}" placeholder="Position..." required>

                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                            <button type="submit" name="submit" class="btn btn-primary">Change</button>
                          </div>
                        </form>
                        @endforeach
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

@extends('layouts.master')

@section('body')
<link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css')}}">
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Member List
      <small>AS Group Member List</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="/home"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Member List</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          @include('layouts.alerts')
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>ID</th>
                <th>Name Surname</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
                @php
                $user = App\User::all()
                @endphp
                @foreach($user as $user)
                  <tr>
                    <td>{{$user->id}}</td>
                    <td style="text-transform:capitalize;">{{$user->name}} {{$user->surname}}</td>
                    <td>
                      <a data-toggle="modal" data-target="#more{{$user->id}}" class="btn btn-success">More</a>
                      <a data-toggle="modal" data-target="#assign{{$user->id}}"  class="btn btn-primary">Assign</a>
                      @if($user->id != Auth::user()->id)
                      <a data-toggle="modal" data-target="#delete{{$user->id}}"  class="btn btn-danger">Delete</a>
                      @endif
                    </td>
                  </tr>
                  <!-- user delete popup start -->
                  <div class="modal fade" id="delete{{$user->id}}" role="dialog">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Assign</h4>
                        </div>
                        <div class="modal-body">
                          <p>Are you sure to <b style="text-transform:uppercase;">{{$user->name}} {{$user->surname}}</b>?</p>
                          <br>
                        </div>
                        <div class="modal-footer">
                          <a href="/delete/employee/{{$user->id}}" class="btn btn-danger">Yes</a>
                            <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                        </div>
                      </div>

                    </div>
                  </div>
                  <!-- user deletion popup ends -->
                  <div class="modal fade" id="assign{{$user->id}}" role="dialog">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Assign</h4>
                        </div>
                        <form class="" action="/edit/userpermission/{{$user->id}}" method="post">
                          {{ csrf_field() }}
                          <div class="modal-body">
                            <p>User: {{$user->name}} {{$user->surname}}</b></p>
                            <br>
                            <select class="form-control" name="role_id">
                              @if($user->role_id == 1)
                              <option value="" selected disabled>Admin</option>
                              @elseif($user->role_id == 2)
                              <option value="" selected disabled>Second Admin</option>
                              @elseif($user->role_id == 3)
                              <option value="" selected disabled>Third Admin</option>
                              @else($user->role_id == 4)
                              <option value="" selected disabled>Main Admin</option>
                              @endif
                              <option value="1">Admin</option>
                              <option value="2">Second Admin</option>
                              <option value="3">Third Admin</option>
                              <option value="4">Main Admin</option>
                            </select>
                          </div>
                          <div class="modal-footer">
                              <button type="submit" name="submit" class="btn btn-success">Assign</button>
                              <!-- <button type="button" class="btn btn-primary" data-dismiss="modal">No</button> -->
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <!-- more modal -->
                  <div class="modal fade" id="more{{$user->id}}" role="dialog">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Details</h4>
                        </div>
                        <div class="modal-body">
                              <img class="profile-user-img img-circle" src="/uploads/profilephotos/{{$user->avatar}}" alt="profile picture">
                              <br><br>
                              <ul class="list-group">
                                <li class="list-group-item"><b style="color:#003399">ID:</b> {{$user->id}}</li>
                                <li class="list-group-item"><b style="color:#003399">Name:</b> {{$user->name}}</li>
                                <li class="list-group-item"><b style="color:#003399">Surname: </b>{{$user->surname}}</li>
                                <li class="list-group-item"><b style="color:#003399">Email: </b>{{$user->email}}</li>
                                <li class="list-group-item"><b style="color:#003399">Role: </b>
                                  @if($user->role_id == 1)
                                  <span style="color:red;">Admin</span>
                                  @elseif($user->role_id == 2)
                                  <span style="color:red;">Second Admin</span>
                                  @elseif($user->role_id == 3)
                                  <span style="color:red;">Third Admin</span>
                                  @elseif($user->role_id == 4)
                                  <span style="color:red;">Main Admin</span>
                                  @endif
                                </li>
                              </ul>
                        </div>
                        <div class="modal-footer">
                          <button data-toggle="modal" data-dismiss="modal" data-target="#reset{{$user->id}}" class="btn btn-success">Reset User Password</button>
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- end here -->
                  <!--reset pass-->
                   <div class="modal fade" id="reset{{$user->id}}" role="dialog">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Reset User Password</h4>
                        </div>
                        <form class="" action="/edit/password/{{$user->id}}" method="post">
                          {{ csrf_field() }}
                          <div class="modal-body">
                            <p><br>User:</b> <i>{{$user->name}} {{$user->surname}}</i></p>
                            <label for="password">New Password</label><br>
                            <input id="myPassShow" type="password" minlength="6" class="form-control" name="password" placeholder="New password here..." required>
                            <input type="checkbox" onclick="myFunction()"> Show Password
                            <br>
                          </div>
                          <div class="modal-footer">
                              <button type="submit" name="submit" class="btn btn-success">Change</button>
                               <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <!--reset pass end-->
                @endforeach
              </tbody>
              <tfoot>
              <tr>
                <th>ID</th>
                <th>Name Surname</th>
                <th>Action</th>
              </tr>
              </tfoot>
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
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
<script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{ asset('plugins/fastclick/fastclick.js')}}"></script>
<script src="{{ asset('dist/js/app.min.js')}}"></script>
<script src="{{ asset('dist/js/demo.js')}}"></script>
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
<script>
    function myFunction() {
    var x = document.getElementById("myPassShow");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
</script>
@endsection

@extends('layouts.master')

@section('body')
<div class="content-wrapper">
  <section class="content-header">
    <h1 class="capi">
      {{Auth::user()->name}}'s profile
    </h1>
    <ol class="breadcrumb">
      <li><a href="/home"><i class="fa fa-home"></i> Home</a></li>
      <li> <i class="fa fa-user"></i> Profiles</li>
      <li class="active capi"> {{Auth::user()->name}}</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-3">
        <div class="box box-primary">
          <div class="box-body box-profile">
            <img style="cursor:pointer;" class="profile-user-img img-responsive img-circle" data-toggle="modal" data-target="#updateprofile{{Auth::user()->id}}" src="{{ asset('/uploads/profilephotos/'. Auth::user()->avatar)}}" alt="User profile picture">
            <h3 class="profile-username text-center capi">{{Auth::user()->name}} {{Auth::user()->surname}}</h3>
            <p class="text-muted text-center">
              @php
              $pos = App\Position::where('member_id','=',[Auth::user()->id])->get()
              @endphp
              @foreach($pos as $pos)
              <span style="text-transform:capitalize;">{{$pos->position}}</span>
              @endforeach
            </p>
            <ul class="list-group list-group-unbordered">
              <li class="list-group-item">
                <b>Permission</b> <a class="pull-right">
                @if(Auth::user()->role_id == 4)
                Main Admin
                @elseif(Auth::user()->role_id == 3)
                Third Admin
                @elseif(Auth::user()->role_id == 2)
                Second Admin
                @else
                Admin
                @endif
              </a>
              </li>
            </ul>
            <a href="/add/sendidea" class="btn btn-primary btn-block"><b>Send Idea</b></a>
          </div>
        </div>
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">About Me</h3>
          </div>
          <div class="box-body">
            <strong style="color:red;"><center>THIS SECTION IS NOT AVALIABLE, YET</center></strong>

              <hr>
            <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

            <!-- <p class="text-muted">
              B.S. in Computer Science from the University of Tennessee at Knoxville
            </p> -->
            <hr>
            <strong><i class="fa fa-briefcase margin-r-5"></i> Experience</strong>

            <!-- <p class="text-muted">
              B.S. in Computer Science from the University of Tennessee at Knoxville
            </p> -->

            <hr>

            <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

            <!-- <p class="text-muted">Malibu, California</p> -->

            <hr>

            <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>

            <!-- <p>
              <span class="label label-danger">UI Design</span>
              <span class="label label-success">Coding</span>
              <span class="label label-info">Javascript</span>
              <span class="label label-warning">PHP</span>
              <span class="label label-primary">Node.js</span>
            </p> -->
            <hr>
            <!-- <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong> -->

            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p> -->
          </div>
        </div>
      </div>
      <!-- /.col -->
      <div class="col-md-9">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <!-- <li><a href="#activity" data-toggle="tab">Activity</a></li> -->
            <li class="active"><a href="#settings" data-toggle="tab">Settings</a></li>
            <li><a href="#password" data-toggle="tab">Change Password</a></li>
          </ul>
          <div class="tab-content">
      			@include('layouts.alerts')
            <div class="active tab-pane" id="settings">
              <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="/update/userdata/{{Auth::user()->id}}">
                {{ csrf_field() }}
                <div class="form-group">
                  <label for="inputSurname" class="col-sm-2 control-label">Username</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="username" value="{{Auth::user()->username}}" placeholder="Type something here...">
                    @if ($errors->has('username'))
                        <span class="help-block">
                            <strong style="color:red;">{{ $errors->first('username') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputName" class="col-sm-2 control-label">Name</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" value="{{Auth::user()->name}}" placeholder="Type something here...">
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong style="color:red;">{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputSurname" class="col-sm-2 control-label">Surname</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="surname" value="{{Auth::user()->surname}}" placeholder="Type something here...">
                    @if ($errors->has('surname'))
                        <span class="help-block">
                            <strong style="color:red;">{{ $errors->first('surname') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="email" value="{{Auth::user()->email}}" placeholder="Type something here...">
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong style="color:red;">{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary pull-right">Change</button>
                  </div>
                </div>
              </form>
            </div>
            <!--pass reset section-->
            <div class="tab-pane" id="password">
              <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="/update/password/{{Auth::user()->id}}">
                {{ csrf_field() }}
                <br>
                <div class="form-group">
                  <label for="inputEmail" class="col-sm-2 control-label">New Password</label>

                  <div class="col-sm-10">
                    <input id="PassIn" type="password" class="form-control" name="password" placeholder="New password here..." required>
                    <br>
                    <input type="checkbox" onclick="myFunction()"> Show Password
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail" class="col-sm-2 control-label">Confirm Password</label>
                  <div class="col-sm-10">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm password..." required>
                    <br>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong style="color:red;">{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary pull-right">Reset</button>
                  </div>
                </div>
              </form>
            </div>
            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
        </div>
        <!-- /.nav-tabs-custom -->
      </div>

      @if(Auth::user()->role_id == 4)
      <div class="col-md-9">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a>About</a></li>
          </ul>
          <div class="tab-content">
      			@include('layouts.alerts')
            <div class="active tab-pane">
              <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="">
                {{ csrf_field() }}
                <div class="form-group">
                  <label for="inputName" class="col-sm-2 control-label">Name</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" value="{{Auth::user()->name}}" placeholder="Type something here...">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputSurname" class="col-sm-2 control-label">Surname</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="surname" value="{{Auth::user()->surname}}" placeholder="Type something here...">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="email" value="{{Auth::user()->email}}" placeholder="Type something here...">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary pull-right">Change</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      @endif
    </div>

    <div class="modal fade modal-primary" id="updateprofile{{Auth::user()->id}}" tabindex="-1" role="dialog" aria-labelledby="moreModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="capi modal-title" id="moreModalLabel">Change Profile</h5>
          </div>
          <form enctype="multipart/form-data" action="/update/profilephoto/{{Auth::user()->id}}" method="post" >
          {{csrf_field()}}
            <div class="modal-body">
              <div class="form-group">
                <label class="col-sm-2 control-label" for="avatar">Select Photo</label>
                <div class="col-sm-10">
                  <input class="form-control" type="file" name="avatar">
                </div>
              </div>
              <br>
            </div>
            <div class="modal-footer">
              <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
              <button data-toggle="modal" data-dismiss="modal" data-target="#deleteprofile{{Auth::user()->id}}" class="btn btn-primary">Delete Current</button>
              <button type="submit" name="submit" class="btn btn-success">Change</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="modal fade modal-primary" id="deleteprofile{{Auth::user()->id}}" tabindex="-1" role="dialog" aria-labelledby="moreModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="capi modal-title" id="moreModalLabel">Change Profile</h5>
          </div>
          <form enctype="multipart/form-data" action="/delete/profilephoto/{{Auth::user()->id}}" method="post" >
          {{csrf_field()}}
            <div class="modal-body">
              Are you sure to delete your profile photo?
              <input class="form-control" type="hidden" name="avatar" value="default.png">
            </div>
            <div class="modal-footer">
              <button class="btn btn-success" data-dismiss="modal">Cancel</button>
              <button type="submit" name="submit" class="btn btn-danger">Yes</button>
            </div>
          </form>
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
    function myFunction() {
    var x = document.getElementById("PassIn");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
</script>
@endsection

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ASGRO | Local</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="_token" content="{{csrf_token()}}" />
  <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css')}}">
  <link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.min.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/iCheck/flat/blue.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/morris/morris.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/datepicker/datepicker3.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logo.png')}}" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script>
  $(document).ready(function(){
    $("#myInput").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#myNav li").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
  </script>

</head>
<body class="hold-transition skin-blue sidebar-mini">
  <style media="screen">
  .no-js #loader { display: none;  }
      .js #loader { display: block; position: absolute; left: 100px; top: 0; }
      .se-pre-con {
      position: fixed;
      left: 0px;
      top: 0px;
      width: 100%;
      height: 100%;
      z-index: 9999;
      background: url("images/loading.gif") center no-repeat #fff;
      }
  </style>
  <div class="se-pre-con"></div>
<div class="wrapper">
  <header class="main-header">
    <a href="/home" class="logo">
      <span class="logo-mini"><b>L</b>S</span>
      <span class="logo-lg"><b>Local</b>System</span>
    </a>
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown messages-menu">
            @include('layouts.messagepart')
          </li>
          @if(Auth::user()->role_id == 4)
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-list-ul"></i>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Control Panel</li>
              <li>
                <ul class="menu">
                  <li>
                    <a href="/add/country"><i class="fa fa-plus"></i> Add Country
                      <b class="label orange pull-right">456</b>
                    </a>
                  </li>
                  <li>
                    <a href="/users"><i class="fa fa-list-ul"></i> User Control
                      <b class="label green pull-right">
     									@php
     									$user = App\User::all()
     									@endphp
     									{{count($user)}}</b>
                    </a>
                  </li>
                  <li>
                    <a href="/usersbalance"><i class="fa fa-list-ul"></i> All balances
                    </a>
                  </li>
                  <li>
                    <a href="/balance"><i class="fa fa-money"></i> My Balance
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
          @endif
          <li class="dropdown tasks-menu">
            @php
            $tasss = App\Task::where('status','!=',2)->where('assigned_member','=',[Auth::user()->id])->get()
            @endphp
            @php
            $tasklist = App\Task::where('status','=',1)->where('assigned_member','=',[Auth::user()->id])->orderBy('created_at','desc')->take(4)->get()
            @endphp
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">{{count($tasklist)}}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have
                @if(count($tasklist) > 1)
                {{count($tasklist)}} tasks
                @elseif(count($tasklist) == 0)
                no task
                @else
                {{count($tasklist)}} task
                @endif in progress</li>
              <li>
                <ul class="menu">
                  @foreach($tasklist as $tl)
                  <li>
                    <a href="/task/{{$tl->access_token}}">
                      <h3 class="capi">
                        {{$tl->title}}
                        <small class="pull-right">{{$tl->percent}}%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: {{$tl->percent}}%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">{{$tl->percent}}% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  @endforeach
                </ul>
              </li>
              <li class="footer">
                <a href="/list/tasks-in-progress">View all tasks</a>
              </li>
            </ul>
          </li>
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="/uploads/profilephotos/{{Auth::user()->avatar}}" class="user-image" alt="User Image">
              <span class="hidden-xs" style="text-transform: capitalize;">{{Auth::user()->name}} {{Auth::user()->surname}}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <img src="/uploads/profilephotos/{{Auth::user()->avatar}}" class="img-circle" alt="User Image">
                <p>
                  <span style="text-transform:capitalize">{{Auth::user()->name}} {{Auth::user()->surname}}</span>
                  <br>
                  @php
                  $pos = App\Position::where('member_id','=',[Auth::user()->id])->get()
                  @endphp
                  @foreach($pos as $pos)
                  <span style="text-transform:capitalize;">{{$pos->position}}</span>
                  @endforeach
                  <small>Member since {{Auth::user()->created_at->diffForHumans()}}</small>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="/profile" class="btn btn-default btn-flat capi">{{ trans('app.profile')}}</a>
                </div>
                <div class="pull-right">
                  <a class="btn btn-default btn-flat capi" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">{{ trans('app.logout')}}</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                  </form>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="/uploads/profilephotos/{{Auth::user()->avatar}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p style="text-transform: capitalize;">{{Auth::user()->name}} {{Auth::user()->surname}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i>
            @php
            $pos = App\Position::where('member_id','=',[Auth::user()->id])->get()
            @endphp
            @foreach($pos as $pos)
            <span style="text-transform:capitalize;">{{$pos->position}}</span>
            @endforeach
            @if(count($pos) == 0)
            <span>N/A</span>
            @endif
          </a><br><br>
        </div>
      </div>
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" id="myInput" class="form-control" placeholder="Search..." autocomplete="off">
              <span class="input-group-btn">
                <a disabled type="submit" name="search" class="btn btn-flat"><i class="fa fa-search"></i>
                </a>
              </span>
        </div>
      </form>
      <ul class="sidebar-menu" id="myNav">
        <li class="header">{{ trans('app.main_navigation')}}</li>
        <li class="{{ Request::is('home')? 'active': '' }}">
          <a href="/home" class="capi">
            <i class="fa fa-home"></i> <span>{{trans('app.home')}}</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">{{trans('app.main')}}</small>
            </span>
          </a>
        </li>
        @if(Auth::user()->role_id == 4)
        <li class="{{ Request::is('list/ideas')? 'active': '' }}">
          <a href="/list/ideas">
            <i class="fa fa-home"></i> <span>İdea List</span>
          </a>
        </li>
        @endif
        @if(Auth::user()->role_id == 4)
        <li class="{{ Request::is('news')? 'active': '' }}">
          <a href="/news" class="capi">
            <i class="fa fa-home"></i> <span>{{trans('app.news')}}</span>
          </a>
        </li>
        @endif
        @if(Auth::user()->role_id == 4)
        <li class="treeview {{ (Request::is('users') | Request::is('add/user') | Request::is('list/positions') | Request::is('update/permissions'))? 'active': '' }}">
          <a href="#" class="capi">
            <i class="fa fa-list-ol"></i> <span>{{trans('app.members')}}</span>
            <span class="pull-right-container">
              <span class="label label-success pull-right">
                  @php
                  $user = App\User::all()
                  @endphp
                  {{count($user)}}
              </span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('users')? 'active': '' }}"><a href="/users"><i class="fa fa-circle-o"></i> Member List</a></li>
            <li class="{{ Request::is('list/positions')? 'active': '' }}"><a href="/list/positions"><i class="fa fa-circle-o"></i> Member Positions</a></li>
            <li class="{{ Request::is('update/permissions')? 'active': '' }}"><a href="/update/permissions"><i class="fa fa-circle-o"></i> Permission Control</a></li>
            <li class="{{ Request::is('add/user')? 'active': '' }}"><a href="/add/user"><i class="fa fa-circle-o"></i> Add new Member</a></li>
          </ul>
        </li>
        @endif
        <li class="treeview {{ (Request::is('list/mytasks') | Request::is('list/alltasks') | Request::is('add/task') | Request::is('list/finishedtasks') | Request::is('list/tasks-in-progress'))? 'active': '' }}">
          <a href="#" class="capi">
            <i class="fa fa-list-ol"></i> <span>{{trans('app.tasks')}}</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">
                {{count($tasss)}}
              </span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('list/mytasks')? 'active': '' }}"><a href="/list/mytasks" class="capi"><i class="fa fa-circle-o"></i> {{trans('app.active_tasks')}}
              <span class="pull-right-container">
                <span class="label label-primary pull-right">
                  @php
                  $tsknew = App\Task::where('status','=',0)->where('assigned_member','=',[Auth::user()->id])->get()
                  @endphp
                  {{count($tsknew)}}
                </span>
              </span>
            </a></li>
            <li class="{{ Request::is('list/tasks-in-progress')? 'active': '' }}"><a href="/list/tasks-in-progress" class="capi"><i class="fa fa-circle-o"></i> {{trans('app.tasks_in_progress')}}
              <span class="pull-right-container">
                <span class="label label-success pull-right">
                  @php
                  $tskprog = App\Task::where('status','=',1)->where('assigned_member','=',[Auth::user()->id])->get()
                  @endphp
                  {{count($tskprog)}}
                </span>
              </span></a></li>
            <li class="{{ Request::is('list/finishedtasks')? 'active': '' }}"><a href="/list/finishedtasks" class="capi"><i class="fa fa-circle-o"></i> {{trans('app.finished_tasks')}}
              <span class="pull-right-container">
                <span class="label label-success pull-right">
                  @php
                  $tsk = App\Task::where('status','=',2)->where('assigned_member','=',[Auth::user()->id])->get()
                  @endphp
                  {{count($tsk)}}
                </span>
              </span>
            </a></li>
            @if(Auth::user()->role_id == 4)
            <li class="{{ Request::is('list/alltasks')? 'active': '' }}"><a href="/list/alltasks" class="capi"><i class="fa fa-circle-o"></i> {{trans('app.all_tasks')}}
              <span class="pull-right-container">
                <span class="label label-danger pull-right">
                  @php
                  $alltaskcount = App\Task::where('status','=',1)->orWhere('status','=',0)->get()
                  @endphp
                  {{count($alltaskcount)}}
                </span>
              </span>
            </a></li>
            <li class="{{ Request::is('add/task')? 'active': '' }}"><a href="/add/task" class="capi"><i class="fa fa-circle-o"></i> {{trans('app.create_new_task')}}</a></li>
            @endif
          </ul>
        </li>
        <li class="treeview {{ (Request::is('add/project') | Request::is('list/projects') | Request::is('add/sendidea') | Request::is('list/myprojects'))? 'active': '' }}">
          <a href="#" class="capi">
            <i class="fa fa-list-ol"></i> <span>{{trans('app.projects')}}</span>
            <span class="pull-right-container">
              @php
              $proj = App\Project::where('project_manager','=',[Auth::user()->id])->get()
              @endphp
              <span class="label label-primary pull-right">{{count($proj)}}</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('list/myprojects')? 'active': '' }}"><a href="/list/myprojects" class="capi"><i class="fa fa-circle-o"></i> {{trans('app.my_project')}}
              <span class="pull-right-container">
                <span class="label label-primary pull-right">
                  {{count($proj)}}
                </span>
              </span></a></li>
            <li class="{{ Request::is('add/sendidea')? 'active': '' }}"><a href="/add/sendidea" class="capi"><i class="fa fa-circle-o"></i> {{trans('app.send_your_idea')}} </a></li>
            @if(Auth::user()->role_id == 4)
              <li class="{{ Request::is('list/projects')? 'active': '' }}"><a href="/list/projects" class="capi"><i class="fa fa-circle-o"></i> {{trans('app.all_projects')}}
                <span class="pull-right-container">
                  @php
                  $proj = App\Project::all()
                  @endphp
                  <span class="label label-danger pull-right">{{count($proj)}}</span>
                </span>
              </a> </li>
              <li class="{{ Request::is('add/project')? 'active': '' }}"><a href="/add/project" class="capi"><i class="fa fa-circle-o"></i> {{trans('app.start_a_project')}}</a> </li>
            @endif
          </ul>
        </li>
        @if(Auth::user()->role_id == 4)
        <li class="treeview">
          <a href="#">
            <i class="fa fa-list-ol"></i> <span>Balance</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right"></span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('')? 'active': '' }}"><a href="/list/"><i class="fa fa-circle-o"></i> Current Balance</a></li>
            <li class="{{ Request::is('')? 'active': '' }}"><a href="/list/"><i class="fa fa-circle-o"></i> Old Balance
              <span class="pull-right-container">
                <span class="label label-primary pull-right">23</span>
              </span>
            </a></li>
            <li class="{{ Request::is('')? 'active': '' }}"><a href="/list/"><i class="fa fa-circle-o"></i> All Balances</a></li>
          </ul>
        </li>
        @endif
      </ul>
    </section>
  </aside>
  @section('body')
  @show
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>AS GROUP</b>
    </div>
    <strong> &copy; {{ date('Y')}}
       <a href="#">ASGRO</a></strong>
  </footer>
  <div class="control-sidebar-bg"></div>
</div>
@section('js')
@show
<script type="text/javascript">
  $(window).load(function() {
    $(".se-pre-con").fadeOut("slow");;
  });
</script>
</body>
</html>

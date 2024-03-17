@extends('layouts.master')

@section('body')
<link rel="stylesheet" href="{{ asset('css/main.css')}}">
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Task
      <small>Task Details</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="/home"><i class="fa fa-home"></i> Home</a></li>
      <li>Task</li>
      <li class="active">{{$task->title}}</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">
              <b style="text-transform:capitalize;">{{$task->title}}</b>
                @if(Auth::user()->role_id == 4)
                <a href="/list/alltasks">
                  <small>
                      - all tasks
                  </small>
                </a>
                @endif
            </h3>
            @include('layouts.alerts')
          </div>
          <div class="box-body">
            <table  class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th style="width: 15%;">#</th>
                  <th>Information</th>
                </tr>
              </thead>
              <tbody id="alltaskTable">
                <tr>
                  <td class="cust-title">Task Title
                    @if(Auth::user()->role_id == 4)
                    <a href="#" data-toggle="modal" data-target="#edittitle{{$task->id}}"><i class="fa fa-edit pull-right cust-title-icon"></i> </a>
                    @endif
                  </td>
                  <td>{{$task->title}}</td>
                </tr>
                <tr>
                  <td class="cust-title">Status
                    @if(Auth::user()->role_id == 4)
                    <a href="#" data-toggle="modal" data-target="#editstatus{{$task->id}}"><i class="fa fa-edit pull-right cust-title-icon"></i> </a>
                    @endif
                  </td>
                  <td>
                    @if($task->status == 0)
                    <span class="percent-show w3-blue">Active</span>
                    @elseif($task->status == 1)
                    <span class="percent-show w3-green">In Progress</span>
                    @elseif($task->status == 2)
                    <span class="percent-show w3-red">Finished</span>
                    @endif
                  </td>
                </tr>
                <tr>
                  <td class="cust-title">Percent
                    <a href="#" data-toggle="modal" data-target="#edit{{$task->id}}"><i class="fa fa-edit pull-right cust-title-icon"></i> </a>
                  </td>
                  <td>
                    <div class="w3-light-blue">
                      @if($task->percent <= 40)
                        <div class="skills html-percent" style="width:{{$task->percent}}%">{{$task->percent}}%</div>
                      @elseif($task->percent <= 70 && $task->percent > 40)
                        <div class="skills css-percent" style="width:{{$task->percent}}%">{{$task->percent}}%</div>
                      @else($task->percent > 70)
                        <div class="skills js-percent" style="width:{{$task->percent}}%">{{$task->percent}}%</div>
                      @endif
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="cust-title">Related Project
                    @if(Auth::user()->role_id == 4)
                    <a href="#" data-toggle="modal" data-target="#editrelpro{{$task->id}}"><i class="fa fa-edit pull-right cust-title-icon"></i> </a>
                    @endif</td>
                  <td>
                    @php
                    $project = App\Project::where('id','=',[$task->related_project])->get()
                    @endphp
                    @foreach($project as $proj)
                      {{$proj->name}}
                    @endforeach
                    @if($task->related_project == 0)
                    Independent
                    @endif
                  </td>
                </tr>
                <tr>
                  <td class="cust-title">Start Date
                    @if(Auth::user()->role_id == 4)
                    <a href="#" data-toggle="modal" data-target="#editstart_date{{$task->id}}"><i class="fa fa-edit pull-right cust-title-icon"></i> </a>
                    @endif
                  </td>
                  <td>{{\Carbon\Carbon::parse($task->start_date)->formatLocalized('%d %b %Y')}}</td>
                </tr>
                <tr>
                  <td class="cust-title">End Date
                    @if(Auth::user()->role_id == 4)
                    <a href="#" data-toggle="modal" data-target="#editdeadline{{$task->id}}"><i class="fa fa-edit pull-right cust-title-icon"></i> </a>
                    @endif
                  </td>
                  <td>{{\Carbon\Carbon::parse($task->deadline)->formatLocalized('%d %b %Y')}}</td>
                </tr>
                <tr>
                  <td class="cust-title">Detail
                    @if(Auth::user()->role_id == 4)
                    <a href="#" data-toggle="modal" data-target="#editdetail{{$task->id}}"><i class="fa fa-edit pull-right cust-title-icon"></i> </a>
                    @endif
                  </td>
                  <td>{!! $task->details !!}</td>
                </tr>
                <tr>
                  <td></td>
                  <td>
                  <div class="pull-right">
                    @if(Auth::user()->role_id == 4)
                    <a href="" class="btn btn-danger" data-toggle="modal" data-target="#delete{{$task->id}}">Delete</a>
                    @endif
                  </div>
                  <!-- Modal -->
                  @include('layouts.modals.taskmodals')
                </td>
                </tr>
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
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script src="{{ asset('js/tinymce.js')}}"></script>
<script src="{{ asset('plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<script src="{{ asset('bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{ asset('plugins/fastclick/fastclick.js')}}"></script>
<script src="{{ asset('dist/js/app.min.js')}}"></script>
<script src="{{ asset('dist/js/demo.js')}}"></script>
<script type="text/javascript">
  var slider = document.getElementById("myRange");
  var output = document.getElementById("demo");
  output.innerHTML = slider.value;

  slider.oninput = function() {
  output.innerHTML = this.value;
  }
</script>
@endsection

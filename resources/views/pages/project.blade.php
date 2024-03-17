@extends('layouts.master')

@section('body')
<style media="screen">
  .cust-title{
    font-weight: bold;
  }
</style>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      All Tasks
      <small>All Open tasks</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="/home"><i class="fa fa-home"></i> Home</a></li>
      <li class="active"> All Tasks</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">
              <center class="capi">{{$project->name}}
                @if(Auth::user()->role_id == 4)
                <a href="/list/projects">
                  <small>
                    All Projects
                  </small>
                </a>
                @endif
              </center>
            </h3>
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
                  <td class="cust-title">Project Name</td>
                  <td>{{$project->name}}</td>
                </tr>
                <tr>
                  <td class="cust-title">Project Manager</td>
                  <td>
                    @php
                    $users = App\User::where('id','=',[$project->project_manager])->get()
                    @endphp
                    @foreach($users as $user)
                    {{$user->name}} {{$user->surname}}
                    @endforeach
                  </td>
                </tr>
                @if(!empty($project->project_sponsor))
                <tr>
                  <td class="cust-title">Project Sponsor</td>
                  <td>{{$project->project_sponsor}}</td>
                </tr>
                @endif
                <tr>
                  <td class="cust-title">Project Duration</td>
                  <td>
                    @php
                    $DeferenceInDays = \Carbon\Carbon::parse($project->deadline)->diffInDays($project->start_date)
                    @endphp
                    {{$DeferenceInDays}} days <br><br>
                    From {{$project->start_date}} to {{$project->deadline}}
                  </td>
                </tr>
                @if(!empty($project->focused_group))
                <tr>
                  <td class="cust-title">Focused Group</td>
                  <td>{{$project->focused_group}}</td>
                </tr>
                @endif
                <tr>
                  <td class="cust-title">Start Country</td>
                  <td>
                    @if($project->start_country == 0)
                    Azerbaijan
                    @elseif($project->start_country == 1)
                    Turkey
                    @elseif($project->start_country == 2)
                    USA
                    @elseif($project->start_country == 3)
                    Georgia
                    @endif
                  </td>
                </tr>
                @if(!empty($project->budget))
                <tr>
                  <td class="cust-title">Project Budget</td>
                  <td>{{$project->budget}}</td>
                </tr>
                @endif
                @if(!empty($project->budget_needed))
                <tr>
                  <td class="cust-title">Needed Budget</td>
                  <td>{{$project->budget_needed}}</td>
                </tr>
                @endif
                <tr>
                  <td class="cust-title">Project Details</td>
                  <td>{!! $project->details !!}</td>
                </tr>
                @if(Auth::user()->role_id == 4)
                <tr>
                  <td></td>
                  <td>
                  <div class="pull-right">
                    <a href="" class="btn btn-danger" data-toggle="modal" data-target="#delete{{$project->id}}">Delete</a>
                  </div>
                  <!-- Modal -->
                  <div class="modal fade" id="delete{{$project->id}}" tabindex="-1" role="dialog" aria-labelledby="moreModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document" >
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="moreModalLabel">{{$project->name}}</h5>
                        </div>
                        <div class="modal-body">
                          <span>Are sure to delete this project?</span>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                          <a href="#" class="btn btn-danger">Yes</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </td>
                </tr>
                @endif
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
@endsection

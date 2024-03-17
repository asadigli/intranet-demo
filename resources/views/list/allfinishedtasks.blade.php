@extends('layouts.master')

@section('body')
<link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css')}}">
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      All Finished Tasks
      <small>You can see and control your tasks here.</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="/home"><i class="fa fa-home"></i> Home</a></li>
      <li><i class="fa fa-tasks"></i> Tasks</li>
      <li class="active">My Tasks</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Finished Tasks</h3>
          </div>
            @include('layouts.alerts')
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
               <thead>
               <tr>
                 <th>Title</th>
                 <th>Start Date</th>
                 <th>Duration</th>
                 <th>Action</th>
               </tr>
               </thead>
               <tbody>
                 @foreach($tasks as $task)
                 <tr>
                   <td>{{$task->title}}</td>
                   <td>{{\Carbon\Carbon::parse($task->start_date)->formatLocalized('%d %b %Y')}}
                     ({{$task->start_date->diffForHumans()}}) </td>
                   <td>
                     @php
                     $DeferenceInDays = \Carbon\Carbon::parse($task->deadline)->diffInDays($task->start_date)
                     @endphp
                     {{$DeferenceInDays}} days
                   </td>
                   <td>
                     <a href="" class="btn btn-success" data-toggle="modal" data-target="#more{{$task->id}}">Detail</a>
                     <a href="/task/{{$task->access_token}}" class="btn btn-primary">More</a>
                   </td>
                   <div class="modal fade" id="more{{$task->id}}" tabindex="-1" role="dialog" aria-labelledby="moreModalLabel" aria-hidden="true">
                     <div class="modal-dialog" role="document">
                       <div class="modal-content">
                         <div class="modal-header">
                           <h5 class="modal-title" id="moreModalLabel">{{$task->title}}</h5>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                           </button>
                         </div>
                         <div class="modal-body">
                           <ul class="list-group">
                             <li class="list-group-item">{{$task->title}}</li>
                             <li class="list-group-item"><b>FROM</b> {{\Carbon\Carbon::parse($task->start_date)->formatLocalized('%d %b %Y')}} <b>TO </b> {{\Carbon\Carbon::parse($task->deadline)->formatLocalized('%d %b %Y')}}</li>
                             <li class="list-group-item">{!! $task->details !!}</li>
                           </ul>
                         </div>
                         <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                           <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                         </div>
                       </div>
                     </div>
                   </div>
                 </tr>
                 @endforeach
               </tbody>
               <tfoot>
               <tr>
                 <th>Title</th>
                 <th>Start Date</th>
                 <th>Duration</th>
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
@endsection

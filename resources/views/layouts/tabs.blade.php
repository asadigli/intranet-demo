<div class="row">
  <div class="col-md-12">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab">Latest Task</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            Tasks <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
          @if(Auth::user()->role_id == 4)
          <li role="presentation"><a role="menuitem" tabindex="-1" href="/add/task">New Task</a></li>
          <li role="presentation" class="divider"></li>
          @endif
            <li role="presentation"><a role="menuitem" tabindex="-1" href="/list/mytasks">Active Tasks</a></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="/list/tasks-in-progress">Tasks in Progress</a></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="/list/finishedtasks">Finished Tasks</a></li>
          </ul>
        </li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
          @php
          $myonetask = App\Task::where('status','!=',2)->where('assigned_member','=',[Auth::user()->id])->orderBy('created_at','desc')->take(1)->get()
          @endphp
          @foreach($myonetask as $mot)
          <h4><b>{{$mot->title}}</b> </h4>
          <small style="color:gray;">Deadline: <i>{{$mot->deadline->format('d M')}}</i> </small>
          <p>{!! substr(strip_tags($mot->details), 0, 300) !!}
            <br>
            <a href="/task/{{$mot->access_token}}" class="pull-right">See more</a>
            <br>
          </p>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>

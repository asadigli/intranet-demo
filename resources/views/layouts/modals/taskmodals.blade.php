<div class="modal fade" id="delete{{$task->id}}" tabindex="-1" role="dialog" aria-labelledby="moreModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="capi modal-title" id="moreModalLabel">{{$task->title}}</h5>
      </div>
      <div class="modal-body">
        <span>Are sure to delete this task?</span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <a href="/delete/task/{{$task->id}}" class="btn btn-danger">Yes</a>
      </div>
    </div>
  </div>
</div>
<!-- Edit Task -->
<div class="modal fade" id="edit{{$task->id}}" tabindex="-1" role="dialog" aria-labelledby="moreModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" >
    <div class="modal-content">
      <form action="/update/task/edit/{{$task->id}}" method="post">
        {{csrf_field()}}
        <div class="modal-header">
          <h5 class="modal-title capi" id="moreModalLabel">{{$task->title}}</h5>
        </div>
        <div class="modal-body">
          <input type="range" min="0" name="percent" max="100" value="{{$task->percent}}" class="slider" id="myRange">
          <br>
          <center><span style="font-size:25px;" id="demo"></span>%</center>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          <button type="submit" name="submit" class="btn btn-success">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End of Edit Task -->
<!-- Edit Task -->
<div class="modal fade" id="edittitle{{$task->id}}" tabindex="-1" role="dialog" aria-labelledby="moreModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" >
    <div class="modal-content">
      <form action="/update/task/edittitle/{{$task->id}}" method="post">
        {{csrf_field()}}
        <div class="modal-header">
          <h5 class="modal-title capi" id="moreModalLabel">{{$task->title}}</h5>
        </div>
        <div class="modal-body">
          <input type="text" class="form-control" name="title" value="{{$task->title}}" placeholder="Title..." required>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          <button type="submit" name="submit" class="btn btn-success">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End of Edit Task -->
<!-- Edit Task -->
<div class="modal fade" id="editstart_date{{$task->id}}" tabindex="-1" role="dialog" aria-labelledby="moreModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" >
    <div class="modal-content">
      <form action="/update/task/editstart_date/{{$task->id}}" method="post">
        {{csrf_field()}}
        <div class="modal-header">
          <h5 class="modal-title capi" id="moreModalLabel">{{$task->title}}</h5>
        </div>
        <div class="modal-body">
          <input type="date" class="form-control" name="start_date" value="{{$task->start_date}}" required>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          <button type="submit" name="submit" class="btn btn-success">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End of Edit Task -->
<!-- Edit Task -->
<div class="modal fade" id="editdeadline{{$task->id}}" tabindex="-1" role="dialog" aria-labelledby="moreModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" >
    <div class="modal-content">
      <form action="/update/task/editdeadline/{{$task->id}}" method="post">
        {{csrf_field()}}
        <div class="modal-header">
          <h5 class="modal-title capi" id="moreModalLabel">{{$task->title}}</h5>
        </div>
        <div class="modal-body">
          <input type="date" class="form-control" name="deadline" value="{{$task->deadline}}" required>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          <button type="submit" name="submit" class="btn btn-success">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End of Edit Task -->
<!-- Edit Task -->
<div class="modal fade" id="editdetail{{$task->id}}" tabindex="-1" role="dialog" aria-labelledby="moreModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" >
    <div class="modal-content">
      <form action="/update/task/editdetails/{{$task->id}}" method="post">
        {{csrf_field()}}
        <div class="modal-header">
          <h5 class="modal-title capi" id="moreModalLabel">{{$task->title}}</h5>
        </div>
        <div class="modal-body">
          <textarea name="details">{{$task->details}}</textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          <button type="submit" name="submit" class="btn btn-success">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End of Edit Task -->
<div class="modal fade" id="editstatus{{$task->id}}" tabindex="-1" role="dialog" aria-labelledby="moreModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" >
    <div class="modal-content">
      <form action="/update/task/editstatus/{{$task->id}}" method="post">
        {{csrf_field()}}
        <div class="modal-header">
          <h5 class="modal-title capi" id="moreModalLabel">{{$task->title}}</h5>
        </div>
        <div class="modal-body">
          <select class="form-control" name="status">
              <option value="0" {{ ($task->status == 0) ? "selected" : "" }}>Active</option>
              <option value="1" {{ ($task->status == 1) ? "selected" : "" }}>In Progress</option>
              <option value="2" {{ ($task->status == 2) ? "selected" : "" }}>Finished</option>
          </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          <button type="submit" name="submit" class="btn btn-success">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End of Edit Task -->
<div class="modal fade" id="editrelpro{{$task->id}}" tabindex="-1" role="dialog" aria-labelledby="moreModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" >
    <div class="modal-content">
      <form action="/update/task/editrelpro/{{$task->id}}" method="post">
        {{csrf_field()}}
        <div class="modal-header">
          <h5 class="modal-title capi" id="moreModalLabel">{{$task->title}}</h5>
        </div>
        <div class="modal-body">
          <select class="form-control" name="related_project">
              <option value="0" {{ ($task->status == 0) ? "selected" : "" }}>Independent</option>
              @php
              $projs = App\Project::all()
              @endphp
              @foreach($projs as $proj)
              <option value="{{$proj->id}}" {{ ($task->related_project == $proj->id) ? "selected" : "" }}>{{$proj->name}}</option>
              @endforeach
          </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          <button type="submit" name="submit" class="btn btn-success">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End of Edit Task -->

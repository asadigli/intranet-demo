@if(Session::has('success'))
<br><br>
  <center>
    <div class="col-md-4" style="width:100%;">
      <div class="alert alert-success">
        {{Session::get('success')}}
      </div>
    </div>
  </center>
@endif
@if(Session::has('primary'))
<br><br>
  <center>
    <div class="col-md-4" style="width:100%;">
      <div class="alert alert-primary">
        {{Session::get('primary')}}
      </div>
    </div>
  </center>
@endif
@if(Session::has('danger'))
<br><br>
  <center>
    <div class="col-md-4" style="width:100%;">
      <div class="alert alert-danger">
        {{Session::get('danger')}}
      </div>
    </div>
  </center>
@endif
@if(Session::has('warning'))
<br><br>
  <center>
    <div class="col-md-4" style="width:100%;">
      <div class="alert alert-warning">
        {{Session::get('warning')}}
      </div>
    </div>
  </center>
@endif

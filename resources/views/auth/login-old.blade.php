<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!------ Include the above in your HEAD tag ---------->
    <style media="screen">
    /*    --------------------------------------------------
  :: Login Section
-------------------------------------------------- */
#login {
  padding-top: 50px
}
#login h1 {
  color: #1fa67b;
  font-size: 18px;
  text-align: center;
  font-weight: bold;
  padding-bottom: 20px;
}
#login .form-group {
  margin-bottom: 20px;
}
#login .checkbox {
  margin-bottom: 20px;
  position: relative;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  -o-user-select: none;
  user-select: none;
}
#login .checkbox.show:before {
  content: '\e013';
  color: #1fa67b;
  font-size: 17px;
  margin: 1px 0 0 3px;
  position: absolute;
  pointer-events: none;
  font-family: 'Glyphicons Halflings';
}
#login .checkbox .character-checkbox {
  width: 25px;
  height: 25px;
  cursor: pointer;
  border-radius: 3px;
  border: 1px solid #ccc;
  vertical-align: middle;
  display: inline-block;
}
#login .checkbox .label {
  color: #6d6d6d;
  font-size: 13px;
  font-weight: normal;
}
#login .btn.btn-custom {
  font-size: 14px;
margin-bottom: 20px;
}
#login .forget {
  font-size: 13px;
text-align: center;
display: block;
}

/*    --------------------------------------------------
:: Inputs & Buttons
-------------------------------------------------- */
.form-control {
  color: #212121;
}
.btn-custom {
  color: #fff;
background-color: #1fa67b;
}
.btn-custom:hover,
.btn-custom:focus {
  color: #fff;
}

/*    --------------------------------------------------
  :: Footer
-------------------------------------------------- */
#footer {
  color: #6d6d6d;
  font-size: 12px;
  text-align: center;
}
#footer p {
  margin-bottom: 0;
}
#footer a {
  color: inherit;
}
    </style>
    <title></title>
  </head>
  <body>

    <section id="login">
        <div class="container">
            <div class="row">
        	    <div class="col-xs-12 col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                    <h1>Log in your account</h1>
                    <form role="form" method="POST" action="{{ route('login') }}" id="login-form" autocomplete="off">
                      {{ csrf_field()}}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="sr-only">Email</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="key" class="sr-only">Password</label>
                            <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                            </label>
                        </div>
                        <input type="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Log in">
                    </form>
                    <a href="javascript:;" class="forget" data-toggle="modal" data-target=".forget-modal">Forgot your password?</a>
                    <hr/>
        		</div> <!-- /.col-xs-12 -->
        	</div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>

    <div class="modal fade forget-modal" tabindex="-1" role="dialog" aria-labelledby="myForgetModalLabel" aria-hidden="true">
    	<div class="modal-dialog modal-md">
    		<form class="" method="POST" action="{{ route('password.email') }}">
          <div class="modal-content">
      			<div class="modal-header">
      				<button type="button" class="close" data-dismiss="modal">
      					<span aria-hidden="true">×</span>
      					<span class="sr-only">Close</span>
      				</button>
      				<h4 class="modal-title">Recovery password</h4>
      			</div>
      			<div class="modal-body">
      				<p>Type your email account</p>
      				<input type="email" name="email" value="{{ old('email') }}" class="form-control" autocomplete="off" required>
              @if ($errors->has('email'))
                  <span class="help-block">
                      <strong>{{ $errors->first('email') }}</strong>
                  </span>
              @endif
            </div>
      			<div class="modal-footer">
      				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      				<button type="submit" class="btn btn-custom">Recovery</button>
      			</div>
      		</div>
        </form> <!-- /.modal-content -->
    	</div> <!-- /.modal-dialog -->
    </div> <!-- /.modal -->

    <footer id="footer">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-12">
                    <p>SadeStore © - {{ date("Y")}}</p>
                    <!-- <p>Powered </p> -->
                </div>
            </div>
        </div>
    </footer>

  </body>
  <script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
  </script>
</html>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="google-translate-customization" content="839d71f7ff6044d0-328a2dc5159d6aa2-gd17de6447c9ba810-f"></meta>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	<title>
		Test Online	</title>
	<meta name="description" content="Test Online"/>
	<link href="favicon.ico" type="image/x-icon" rel="icon" /><link href="favicon.ico" type="image/x-icon" rel="shortcut icon" /><link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" /><link rel="stylesheet" type="text/css" href="css/style.css" /><link rel="stylesheet" type="text/css" href="css/design/style.css" /><link rel="stylesheet" type="text/css" href="css/design/fonts.css" /><link rel="stylesheet" type="text/css" href="css/design/plugins.css" /><link rel="stylesheet" type="text/css" href="css/design/responsive.css" /><link rel="stylesheet" type="text/css" href="css/design/settings.css" /><link rel="stylesheet" type="text/css" href="css/validationEngine.jquery.css" /><script type="text/javascript" src="js/jquery-1.8.2.min.js"></script><script type="text/javascript" src="js/html5shiv.js"></script><script type="text/javascript" src="js/respond.min.js"></script><script type="text/javascript" src="js/bootstrap.min.js"></script><script type="text/javascript" src="js/jquery.validationEngine-en.js"></script><script type="text/javascript" src="js/jquery.validationEngine.js"></script><script type="text/javascript" src="js/design200/superfish.js"></script><script type="text/javascript" src="js/design200/sidebar.js"></script><script type="text/javascript" src="js/design200/functions.js"></script><script type="text/javascript" src="js/design200/plugins.min.js"></script><script type="text/javascript" src="js/design200/revolution.min.js"></script><script type="text/javascript" src="js/custom.min.js"></script><script type="text/javascript" src="js/jquery.form.js"></script></head>
<body>
         <div id="wrap">
	    <div class="main-inner-content">
	    <header id="header" class="section cover header-bg" data-bg="/img//design200/slider.png">	   
	    <div class="logo-header">
	    <div class="container">
	    <div class="ulogo-container clearfix">
	    <div class="logo pull-left">
	    <h1 class="site-title">
	  <img src="img/logo-website.fw.png" alt="Edu Expression" class="img-responsive" />	    </h1> 
	    <p class="site-desc">Test Online</p>
	    </div> 
	    <div class="social-info pull-right hidden-xs hidden-sm">
			<div class="col-md-4 mrg text-center">
				<div class="btn-group user-login">
					<div class="btn dropdown-toggle" style="background: none;border: 0px;box-shadow: none;" data-toggle="dropdown">
					</div>
				</div>
				<strong><small><div id="clock"></div></small></strong>
			</div>
		</div>
	</div> 
	    </div> 
	    </div> 
	    <div class="site-menu">
	    <div class="container">
	    <div class="site-menu-inner clearfix">
	    <div class="site-menu-container pull-left">
	    <nav class="hidden-xs hidden-sm">
	    <ul class="sf-menu clearfix list-unstyled">
	      	      <li ><a href="{{ route('main_page') }}"><span class="glyphicon glyphicon-home"></span>&nbsp;Home</a></li>
	      	      <li class="current-menu-item"><a href="Users"><span class="glyphicon glyphicon-user"></span>&nbsp;Users Register</a></li>
	    </ul> 
	    </nav> 
	    </div> 	    
	    </div> 
	    </div> 
	    </div>
	    </header>
        		<div id="page-content">
	<div class="container mrg">
                    <div class="col-md-5 login">
			<form action="{{ route('register') }}" name="post_req" id="post_req" method="post" accept-charset="utf-8"><div style="display:none;"><input type="hidden" name="_method" value="POST"/></div>
				{{ csrf_field() }}		
				<div class="form-group">
					<div class="row">
						<label for="admin_id" class="col-sm-12 control-label">Name:</label>
					</div>
					<div class="input-group">
						<span class="input-group-addon glyphicon glyphicon-user"></span>
                        <input name="name" value="{{ old('name') }}" required autofocus class="form-control validate[required]" placeholder="Name" maxlength="50" type="text" id="UserUsername" required="required"/>					</div>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
				</div>		
				<div class="form-group">
					<div class="row">
						<label for="admin_id" class="col-sm-12 control-label">Email:</label>
					</div>
					<div class="input-group">
						<span class="input-group-addon glyphicon glyphicon-user"></span>
                        <input name="email" value="{{ old('email') }}" required autofocus class="form-control validate[required]" placeholder="Email" maxlength="50" type="email" id="UserUsername" required="required"/>					</div>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
				</div>
				<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
					<div class="row">
						<label for="pass" class="col-sm-12 control-label">Password :</label>
					</div>
					<div class="input-group">
						<span class="input-group-addon glyphicon glyphicon-lock"></span>
						<input name="password" required class="form-control validate[required,minSize[4],maxSize[15]]" placeholder="Password" type="password" id="UserPassword"/>
						@if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
            					</div>
				</div>

				<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
					<div class="row">
						<label for="pass" class="col-sm-12 control-label">Confirm Password :</label>
					</div>
					<div class="input-group">
						<span class="input-group-addon glyphicon glyphicon-lock"></span>
						<input name="password_confirmation" required class="form-control validate[required,minSize[4],maxSize[15]]" placeholder="Confirm Password" type="password" id="UserPassword" required/>
            					</div>
				</div>

				<div class="form-group col-md-12">
					<div class="row">                                        
						<button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-ok"></span>&nbsp;Submit</button>
					</div>
				</div>
                        </form>
		</div>
		</div>
	</div>
	    </div>
               <footer id="footer">
<div class="footer-widget">
<div class="container">
<div class="row">
<div class="col-md-6">
<div class="widget">
<h5 class="widget-title">
Copyright &copy; 2018<span> Test Online</span>
</h4>
</div> 
</div> 
<div class="col-md-6 text-right">
<div class="widget">
<h5 class="widget-title">
Time <span>26-05-2018 10:38:23 AM</span>
</h4>
</div> 
</div> 
</div> 
</div> 
</div>
<div class="footer-credits">
<div class="container">
<div class="footer-credits-inner">
<div class="row">
<div class="col-md-6">
<span>Powered by <a href="javascript:void(0)">kimhaihaktqd@gmail.com</a></span>
</div> 
</div> 
</div> 
</div> 
</div> 
</footer>
	<div class="sb-slidebar sb-right">
<div class="sb-menu-trigger"></div>
	</div>
   </div>
</body>
</html>
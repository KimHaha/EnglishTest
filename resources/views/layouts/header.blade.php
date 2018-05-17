<header id="header" class="section cover header-bg" data-bg="{{ asset('/img//design200/slider.png') }}">	   

<?php $user = Auth::user(); ?>

	{{-- logo header --}}
    <div class="logo-header">
	    <div class="container">
	    <div class="ulogo-container clearfix">
	    <div class="logo pull-left">
	    <h1 class="site-title">
	  	<img src="{{ asset('img/logo-website.fw.png') }}" alt="Edu Expression" class="img-responsive" />	    </h1> 
	    <p class="site-desc">Test Online</p>
	    </div> 
	    <div class="social-info pull-right hidden-xs hidden-sm">
			<div class="col-md-4 mrg text-center">
				<div class="btn-group user-login">
					<div class="btn dropdown-toggle" style="background: none;border: 0px;box-shadow: none;" data-toggle="dropdown">
						<span class="glyphicon glyphicon-user btn btn-success btn-sm"></span>&nbsp;Xin chào ! {{ $user->name }}&nbsp;<span class="caret"></span>
					</div>
					<div class="dropdown-menu" role="menu">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table" style="margin-bottom:0px">
									<tbody>
										<tr>
										  <td  colspan="2"><a href="Users/myProfile" class="btn btn-primary btn-xs btn-block"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;My Profile</a></td>
										</tr>											
										<tr>
										  <td><a href="Users/changePass" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-cog"></span>&nbsp;Change Password</a>											
										  <td><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-danger btn-xs">
										  	<span class="glyphicon glyphicon-off"></span>&nbsp;Signout</a>											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>	
				</div>
				<strong><small><div id="clock"></div></small></strong>
			</div>
		</div>
	</div> 
	    </div> 
	    </div> 




	


	{{-- site menu  --}}
    <div class="site-menu">
	    <div class="container">
	    <div class="site-menu-inner clearfix">
	    <div class="site-menu-container pull-left">
	    <nav class="hidden-xs hidden-sm">
	    <ul class="sf-menu clearfix list-unstyled">
	    	<?php $user = Auth::user(); ?>
			<li @if ($current_menu_item == 'home') class="current-menu-item" @endif><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home"></span>&nbsp;Home Page</a></li>
			@if ($user->hasRole('student'))
			<li @if ($current_menu_item == 'doing_contest') class="current-menu-item" @endif><a href="{{ route('do_contest') }}"><span class="glyphicon glyphicon-warning-sign"></span>&nbsp;Contest</a></li>
			@endif
			@if ($user->hasRole('student') || $user->hasRole('teacher'))
			<li @if ($current_menu_item == 'results') class="current-menu-item" @endif><a href="{{ route('results.index') }}"><span class="glyphicon glyphicon-asterisk"></span>&nbsp;Result</a></li>
			@endif
			@if ($user->hasRole('admin') || $user->hasRole('teacher'))
			<li @if ($current_menu_item == 'categories') class="current-menu-item" @endif><a href="{{ route('categories.index') }}"><span class="glyphicon glyphicon-th-large"></span>&nbsp;Categories</a></li>
			<li @if ($current_menu_item == 'examinations') class="current-menu-item" @endif><a href="{{ route('examinations.index') }}"><span class="glyphicon glyphicon-th-large"></span>&nbsp;Examinations</a></li>
			<li @if ($current_menu_item == 'exams') class="current-menu-item" @endif><a href="{{ route('exams.index') }}"><span class="glyphicon glyphicon-th-large"></span>&nbsp;Exams</a></li>
			@endif

			@if ($user->hasRole('teacher'))
			<li @if ($current_menu_item == 'questions') class="current-menu-item" @endif><a href="{{ route('questions.index') }}"><span class="glyphicon glyphicon-th-large"></span>&nbsp;Questions</a></li>
			@endif

			@if ($user->hasRole('admin'))
			<li @if ($current_menu_item == 'roles') class="current-menu-item" @endif><a href="{{ route('roles.index') }}"><span class="glyphicon glyphicon-tasks"></span>&nbsp;Roles</a></li>
			<li @if ($current_menu_item == 'permissions') class="current-menu-item" @endif><a href="{{ route('permissions.index') }}"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Permissions</a></li>
			<li @if ($current_menu_item == 'users') class="current-menu-item" @endif><a href="{{ route('users.index') }}"><span class="glyphicon glyphicon-user"></span>&nbsp;Users</a></li>
			@endif

			@if ($user->hasRole('teacher') || $user->hasRole('admin'))
			<li @if ($current_menu_item == 'classes') class="current-menu-item" @endif><a href="{{ route('classes.index') }}"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Classes</a></li>
			@endif

			<li class="menu-hidden"><a href="Users/myProfile"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;My Profile</a></li>
			<li class="menu-hidden"><a href="Users/changePass"><span class="glyphicon glyphicon-cog"></span>&nbsp;Change Password</a></li>
			<li class="menu-hidden"><a href="Users/logout"><span class="glyphicon glyphicon-off"></span>&nbsp;Signout</a></li>

			<li>
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
          </li>
	    </ul> 
	    </nav> 
	    </div> 	    
	    </div> 
	    </div> 
    </div>
</header>
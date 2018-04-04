<header id="header" class="section cover header-bg" data-bg="{{ asset('/img//design200/slider.png') }}">	   



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
						<span class="glyphicon glyphicon-user btn btn-success btn-sm"></span>&nbsp;Xin chào ! Administrator&nbsp;<span class="caret"></span>
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
										  <td><a href="Users/changePass" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-cog"></span>&nbsp;Change Password</a>											<td><a href="Users/logout" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-off"></span>&nbsp;Signout</a>											</td>
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
			<li @if ($current_menu_item == 'home') class="current-menu-item" @endif><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home"></span>&nbsp;Home Page</a></li>
			<li ><a href="{{ route('questions.index') }}"><span class="glyphicon glyphicon-th-large"></span>&nbsp;Questions</a></li>
			<li @if ($current_menu_item == 'roles') class="current-menu-item" @endif><a href="{{ route('roles.index') }}"><span class="glyphicon glyphicon-tasks"></span>&nbsp;Roles</a></li>
			<li ><a href="{{ route('permissions.index') }}"><span class="glyphicon glyphicon-user"></span>&nbsp;Permissions</a></li>
			<li ><a href="{{ route('users.index') }}"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Users</a></li>
			<li ><a href="Results"><span class="glyphicon glyphicon-asterisk"></span>&nbsp;Kết quả</a></li>
			<li ><a href="Configurations"><span class="glyphicon glyphicon-wrench"></span>&nbsp;Cấu hình</a></li>
			<li ><a href="Users"><span class="glyphicon glyphicon-user"></span>&nbsp;Người dùng</a></li>
			<li ><a href="Contents"><span class="glyphicon glyphicon-cog"></span>&nbsp;Nội dung</a></li>
			<li ><a href="Exports"><span class="glyphicon glyphicon-tasks"></span>&nbsp;Lưu Trữ</a></li>
			<li ><a href="Helps"><span class="glyphicon glyphicon-warning-sign"></span>&nbsp;Trợ giúp</a></li>
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
@extends ('layouts.layout')

@section ('content')

<div id="page-content">
	<div class="container mrg">
    <div class="row">
    <div class="col-md-12">

    </div>
        <div class="col-md-2 mrg-1">
    <form action="users" id="UserIndexForm" method="post" accept-charset="utf-8"><div style="display:none;"><input type="hidden" name="_method" value="POST"/></div>    <label><small>Show&nbsp;</small>
    <select name="data[User][limit]" default="20" onChange="this.form.submit();" class="input-sm" id="UserLimit">
<option value="5">5</option>
<option value="10">10</option>
<option value="20" selected="selected">20</option>
<option value="25">25</option>
<option value="30">30</option>
<option value="50">50</option>
<option value="100">100</option>
<option value="200">200</option>
<option value="500">500</option>
</select>    <small>&nbsp;entries</small></label>
    <input type="hidden" name="data[User][keyword]" class="form-control input-sm" placeholder="Search" empty="1" id="UserKeyword"/></form></div>
<div class="col-md-10">

</div>        

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">


            {{-- heading --}}
            <div class="panel-heading">
    			<div class="widget">
    				<h4 class="widget-title"> <span>Users</span></h4>
    			</div>
    		</div>


            {{-- list user --}}
            <div class="table-responsive">
                <table class="table table-striped table-bordered">

                    <tr>
                        <th><input type="checkbox" name="selectAll"  value="deleteall" id="selectAll"/></th>
                        <th><a href="Users/index/sort:id/direction:desc">ID</a></th>
                        <th><a href="Users/index/sort:username/direction:asc">Name</a></th>
                        <th><a href="Users/index/sort:name/direction:desc">Role</a></th>
                        <th><a href="Users/index/sort:email/direction:asc">Email</a></th>
                        <th><a href="Users/index/sort:status/direction:asc">Status</a></th>
                        <th>Action</th>
                    </tr>
                    
                    @foreach ($user_list as $user)
                    <tr>
                        <td><input type="hidden" name="data[User][id][]" id="DeleteCheckbox1_" value="0"/><input type="checkbox" name="data[User][id][]"  value="1" id="DeleteCheckbox1" class="chkselect"/></td>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>
                            @foreach ($user->roles as $role) 
                                {{ $role->name }}
                            @endforeach
                        </td>
                        <td>{{ $user->email }}</td>
                        <td></td>
                        <td><a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span>&nbsp;Edit</a>
                        </td>                            
                    </tr>
                    @endforeach
                </table>
            </div>

        </div>
    </div>
</div>



</div><div class="modal fade" id="targetModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-content">        
  </div>
</div>		</div>
	</div>
	    </div>


@stop
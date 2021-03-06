@extends ('layouts.layout')

@section ('content')



<div id="page-content">
	<div class="container mrg">
    <div class="row">

    <div class="col-md-12">
        <div class="btn-group">
		   </div>
    </div>



    <div class="col-md-2 mrg-1">
    <form action="students" id="StudentIndexForm" method="post" accept-charset="utf-8"><div style="display:none;"><input type="hidden" name="_method" value="POST"/></div>    <label><small>Show&nbsp;</small>
    <select name="data[Student][limit]" default="20" onChange="this.form.submit();" class="input-sm" id="StudentLimit">
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
    <input type="hidden" name="data[Student][keyword]" class="form-control input-sm" placeholder="Search" empty="1" id="StudentKeyword"/></form></div>




<div class="col-md-10">
    <div class="row">
        </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
			<div class="widget">
				<h4 class="widget-title"> <span>Permissions of Role {{ $role->name }}</span></h4>
			</div>
		</div>




                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th><input type="checkbox" name="selectAll"  value="deleteall" id="selectAll"/></th>
                            <th><a href="Students/index/sort:id/direction:desc">ID</a></th>
                            <th><a href="Students/index/sort:email/direction:asc">Name</a></th>
                            <th><a href="Students/index/sort:enroll/direction:asc">Display Name</a></th>
                            <th><a href="Students/index/sort:phone/direction:asc">Description</a></th>
                            {{-- <th>&nbsp;</th> --}}
                            <th>Action</th>                            
                        </tr>
                        
                        @foreach ($role->permissions as $permission)
                        <tr>
                            <td><input type="hidden" name="data[Student][id][]" id="DeleteCheckbox18_" value="0"/><input type="checkbox" name="data[Student][id][]"  value="18" id="DeleteCheckbox18" class="chkselect"/></td>
                            <td>{{ $permission->id }}</td>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->display_name }}</td>
                            <td>{{ $permission->description }}</td>

                            <td>
                                <a href="{{ route('roles.permissions.destroy', [$role->id, $permission->id]) }}"
                                onclick="event.preventDefault();
                                         document.getElementById('delete-{{ $permission->id }}').submit();" class="btn btn-danger">
                                <span class="glyphicon glyphicon-trash"></span>&nbsp;Delete</a>

                                <form id="delete-{{ $permission->id }}" action="{{ route('roles.permissions.destroy', [$role->id, $permission->id]) }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                </form>                            
                            </td>
                        </tr>
                        
                        @endforeach
                    </table>
                </div>
        </div>
    </div>
</div>

@stop
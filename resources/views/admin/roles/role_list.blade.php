@extends ('layouts.layout')

@section ('content')



<div id="page-content">
	<div class="container mrg">
    <div class="row">

    <div class="col-md-12">
        <div class="btn-group">
            
            <a href="{{ route('roles.create') }}" name="add" id="add" onclick="check_perform_add('Students/add');" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add</a>            

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
    				<h4 class="widget-title"> <span>Role</span></h4>
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
                    
                    @foreach ($role_list as $role)
                    <tr>
                        <td><input type="hidden" name="data[Student][id][]" id="DeleteCheckbox18_" value="0"/><input type="checkbox" name="data[Student][id][]"  value="18" id="DeleteCheckbox18" class="chkselect"/></td>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->display_name }}</td>
                        <td>{{ $role->description }}</td>

                        <td>
                            <a href="{{ route('roles.edit', $role->id) }}" name="editallfrm" onclick="check_perform_sedit('Students','18');" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span>&nbsp;Edit</a>

                            <a href="{{ route('roles.permissions.index', $role->id) }}" name="editallfrm" onclick="check_perform_sedit('Students','18');" class="btn btn-success"><span class="glyphicon glyphicon-list"></span>&nbsp;List Permission</a>

                            <a href="{{ route('roles.permissions.index', $role->id) }}" name="editallfrm" onclick="check_perform_sedit('Students','18');" class="btn btn-success"><span class="glyphicon glyphicon-list"></span>&nbsp;List User</a>

                            <a href="{{ route('roles.destroy', $role->id) }}"
                            onclick="event.preventDefault();
                                     document.getElementById('delete-{{ $role->id }}').submit();" class="btn btn-danger">
                            <span class="glyphicon glyphicon-trash"></span>&nbsp;Delete</a>

                            <form id="delete-{{ $role->id }}" action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display: none;">
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
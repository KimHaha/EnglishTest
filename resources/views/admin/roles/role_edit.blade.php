@extends ('layouts.layout')

@section ('content')

<div class="panel panel-default mrg">

    <div class="panel-heading"><div class="widget-modal"><h4 class="widget-modal-title">Add <span>New Role</span> </h4></div></div>


    <div class="panel-body">
        <form action="{{ route('roles.update', $role->id) }}" method="POST">

        	{{ csrf_field() }}

		    {{ method_field('PUT') }}
        	{{-- name --}}
        	<div class="row">
    		<div class="col-md-6">
				<div class="form-group">
					<label for="name"><small>Name: <span class="text-danger"> *</span></small></label>
					<input name="name" class="form-control input-sm" placeholder="Name" maxlength="100" value="{{ $role->name }}"></div>
			</div>

			{{-- display name --}}
    		<div class="col-md-6">
				<div class="form-group">
					<label for="display_name"><small>Display Name: <span class="text-danger"> *</span></small></label>
					<input name="display_name" class="form-control input-sm" placeholder="Display Name" maxlength="100" value="{{ $role->display_name }}"></div>
			</div>
			</div>

			{{-- description --}}
			<div class="row">
    		<div class="col-md-6">
				<div class="form-group">
					<label for="description"><small>Description: <span class="text-danger"> *</span></small></label>
					<input name="description" class="form-control input-sm" placeholder="Description" maxlength="100" value="{{ $role->description }}"></div>
			</div>
			</div>

			{{-- permission --}}
			<div class="row">
    		<div class="col-md-12">
				<div class="form-group">
					<label for="description"><small>Permission: <span class="text-danger"> *</span></small></label>


					@foreach ($list_permission as $permission)
					<div class="form-check">
					  	<input name="permissions[]" class="form-check-input" type="checkbox" value="{{ $permission->id }}" id="checkPermission-{{ $permission->id }}" 	
					  	@foreach ($role->permissions as $permission_of_role)
							@if ($permission->id == $permission_of_role->id) 
							 	checked
							@endif
						@endforeach>
					  	<label class="form-check-label" for="checkPermission-{{ $permission->id }}">
					    	{{ $permission->name }}
					  	</label>
					</div>
					@endforeach
				</div>
			</div>
			</div>

			{{-- submit or cancel --}}
	        <div class="form-group text-left">
	            <div class="col-sm-offset-3 col-sm-10">
	                <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Save</button>
	                <a href="{{ route('roles.index') }}" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Cancel</a>                        </div>
	        </div>
	    </form>
    </div>
</div>
			
@stop
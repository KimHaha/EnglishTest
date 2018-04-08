@extends ('layouts.layout')

@section ('content')

<div class="panel panel-default mrg">

    <div class="panel-heading"><div class="widget-modal"><h4 class="widget-modal-title">Add <span>New Permission</span> </h4></div></div>


    <div class="panel-body">
        <form action="{{ route('permissions.update', $permission->id) }}" method="post">

        	{{ csrf_field() }}
        	{{ method_field('PUT') }}

        	{{-- name --}}
        	<div class="row">
    		<div class="col-md-6">
				<div class="form-group">
					<label for="name"><small>Name: <span class="text-danger"> *</span></small></label>
					<input name="name" class="form-control input-sm" placeholder="Name" maxlength="100" value="{{ $permission->name }}"></div>
			</div>

			{{-- display name --}}
    		<div class="col-md-6">
				<div class="form-group">
					<label for="display_name"><small>Display Name: <span class="text-danger"> *</span></small></label>
					<input name="display_name" class="form-control input-sm" placeholder="Display Name" maxlength="100" value="{{ $permission->display_name }}"></div>
			</div>
			</div>

			{{-- description --}}
			<div class="row">
    		<div class="col-md-6">
				<div class="form-group">
					<label for="description"><small>Description: <span class="text-danger"> *</span></small></label>
					<input name="description" class="form-control input-sm" placeholder="Description" maxlength="100" value="{{ $permission->description }}"></div>
			</div>
			</div>

			{{-- submit or cancel --}}
	        <div class="form-group text-left">
	            <div class="col-sm-offset-3 col-sm-10">
	                <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Save</button>
	                <a href="{{ route('permissions.index') }}" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Cancel</a>                        </div>
	        </div>
	    </form>
    </div>
</div>
			
@stop
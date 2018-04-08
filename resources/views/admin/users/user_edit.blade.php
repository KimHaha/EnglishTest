@extends ('layouts.layout')

@section ('content')

<div class="panel panel-default mrg">

    <div class="panel-heading"><div class="widget-modal"><h4 class="widget-modal-title">Add <span>New Role</span> </h4></div></div>


    <div class="panel-body">
        <form action="{{ route('users.update', $user->id) }}" method="POST">

        	{{ csrf_field() }}

		    {{ method_field('PUT') }}
        	{{-- name --}}
        	<div class="row">
    		<div class="col-md-6">
				<div class="form-group">
					<label for="name"><small>Name: <span class="text-danger"> *</span></small></label>
					<input name="name" readonly class="form-control input-sm" placeholder="Name" maxlength="100" value="{{ $user->name }}"></div>
			</div>

			{{-- email --}}
    		<div class="col-md-6">
				<div class="form-group">
					<label for="email"><small>Email: <span class="text-danger"> *</span></small></label>
					<input name="email" readonly class="form-control input-sm" placeholder="Email" maxlength="100" value="{{ $user->email }}"></div>
			</div>
			</div>

			{{-- role --}}
			<div class="row">
			 	<div class="col-md-6">			
					<div class="form-group">
						<label for="group_name"><small>Role:</small></label>
						<select name="role_id" class="form-control input-sm">
							@foreach ($role_list as $role)
								<option value="{{ $role->id }}">{{ $role->name }}</option>
							@endforeach
						</select>						
					</div>
				</div>
			</div>
			{{-- submit or cancel --}}
	        <div class="form-group text-left">
	            <div class="col-sm-offset-3 col-sm-10">
	                <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Save</button>
	                <a href="{{ route('users.index') }}" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Cancel</a>                        </div>
	        </div>
	    </form>
    </div>
</div>
			
@stop
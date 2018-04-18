@extends ('layouts.layout')

@section ('content')

<?php
    $list_column = \DB::getSchemaBuilder()->getColumnListing($table);

	switch ($current_menu_item) {
        case 'categories':
            $title = 'Category';
            $list_action = ['create', 'edit', 'delete'];
            break;
        
        case 'questions': 
            $title = 'Question';
            $list_action = ['create', 'edit', 'delete'];
            break;

        case 'roles':
            $title = 'Role';
            $list_action = ['create', 'edit', 'delete'];
            break;

        case 'permissions':
            $title = 'Permission';
            $list_action = ['create', 'edit', 'delete'];
            break;

        case 'users':
            $list_action = ['edit'];
            $title = 'User';
        default:
            # code...
            $title = '';
            break;
    }
?>

<div class="panel panel-default mrg">

    <div class="panel-heading"><div class="widget-modal"><h4 class="widget-modal-title">Edit <span>{{ $title }}</span> </h4></div></div>


    <div class="panel-body">
        <form action="{{ route($current_menu_item . '.update', $item->id) }}" method="post">

        	{{ csrf_field() }}
            {{ method_field('PUT') }}

        	{{-- column --}}
        	<?php $index = 0; ?>
        	@foreach ($list_column as $column)

        	@if ($index % 2 == 0) 
        	<div class="row">
        	@endif

    		<div class="col-md-6">
    			@if ($column == 'name' || $column == 'display_name' || $column == 'description')
				<div class="form-group">
                    <?php $column_title = ucwords(str_replace('_', ' ', $column)); ?>

					<label for="{{ $column }}"><small>{{ $column_title }}<span class="text-danger"> *</span></small></label>
					<input name="{{ $column }}" class="form-control input-sm" placeholder="{{ $item->column }}" maxlength="100"></div>
				@endif
			</div>

        	@if ($index % 2 == 0) 
        	</div>
        	@endif

        	<?php $index++; ?>
			@endforeach
			</div>

			{{-- permission --}}
			@if ($current_menu_item == 'permissions')
			<div class="row">
    		<div class="col-md-12">
				<div class="form-group">
					<label for="description"><small>Permission: <span class="text-danger"> *</span></small></label>


					@foreach ($list_permission as $permission)
					<div class="form-check">
					  	<input name="permissions[]" class="form-check-input" type="checkbox" value="{{ $permission->id }}" id="checkPermission-{{ $permission->id }}">
					  	<label class="form-check-label" for="checkPermission-{{ $permission->id }}">
					    	{{ $permission->name }}
					  	</label>
					</div>
					@endforeach
				</div>
			</div>
			</div>
			@endif

			{{-- submit or cancel --}}
	        <div class="form-group text-left">
	            <div class="col-sm-offset-3 col-sm-10">
	                <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Save</button>
	                <a href="{{ route($current_menu_item . '.index') }}" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Cancel</a>
	            </div>
	        </div>
	    </form>
    </div>
</div>

			
@stop
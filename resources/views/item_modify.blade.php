@extends ('layouts.layout')

@section ('content')

<?php

	// get all column
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

    if ($action == 'create') {
    	$action_title = 'Add';
    	$form_url = $current_menu_item . '.store';
    }
    else if ($action == 'edit') {
    	$action_title = 'Edit';
    	$form_url = $current_menu_item . '.update';
    }

    $field_column_name = ['name', 'display_name', 'description', 'weight', 'difficult', 
                            'max_quantity', 'teacher_id', 'pass_score', 'max_try'];
    $select_column_name = ['type'];
    $radio_column_name = ['skill'];
    $date_time_column_name = ['start_time', 'end_time'];
?>

<div class="panel panel-default mrg">

    <div class="panel-heading"><div class="widget-modal"><h4 class="widget-modal-title">{{ $action_title }} <span>New {{ $title }}</span> </h4></div></div>


    <div class="panel-body">
    	@if ($action == 'create')
        <form action="{{ route($form_url) }}" method="post">
        @elseif ($action == 'edit') 
        <form action="{{ route($form_url, $item->id) }}" method="post">
        @endif

        	{{ csrf_field() }}

		@if ($action == 'edit') 
        	{{ method_field('PUT') }}
        @endif

        	{{-- column --}}
        	<?php $index = 0; ?>
        	@foreach ($list_column as $column)

        	@if ($index % 2 == 0) 
        	<div class="row">
        	@endif

    		<div class="col-md-6">

                {{-- if column is field --}}
    			@if (in_array($column, $field_column_name))
				<div class="form-group">
                    <?php 
                        if ($column == 'teacher_id'){
                            $column_title = 'Teacher Email';
                            $column_input = 'email';
                        }
                        else {
                            $column_title = ucwords(str_replace('_', ' ', $column)); 
                            $column_input = $column;
                        }
                    ?>

					<label for="{{ $column }}"><small>{{ $column_title }}<span class="text-danger"> *</span></small></label>

					<?php 
						$value = '';
						if ($action == 'edit') 
							$value = $item->$column;
					?>
					<input name="{{ $column }}" class="form-control input-sm" placeholder="{{ $column_title }}" @if ($action == 'edit') value="{{ $value }}" @endif maxlength="100">
                </div>

                {{-- if column is select box --}}
                @elseif (in_array($column, $select_column_name))        
                    <div class="form-group">
                        <label for="{{ $column }}"><small>{{ ucfirst($column) }}</small></label>
                        <select name="{{ $column }}" class="form-control" placeholder="{{ $column }}">
                            @foreach ($list_data->$column as $option)
                            <option value="{{ $option }}">{{ $option }}</option>
                            @endforeach
                        </select>                       
                    </div>

                @elseif (in_array($column, $radio_column_name)) 
                    <div class="form-group">
                        <label for="{{ $column }}" class="col-sm-2"><small>{{ ucfirst($column) }}</small></label>
                        <div class="col-sm-10">
                        @foreach ($list_data->$column as $option)
                        <label class="radio-inline"><input type="radio" name="{{ $column }}" value="{{ $option }}" checked="checked">{{ $option }}</label>
                        @endforeach
                        </div>
                    </div>
                @elseif (in_array($column, $date_time_column_name))
                    <div class="form-group">
                        <?php $column_title = ucwords(str_replace('_', ' ', $column)); ?>

                        <label for="{{ $column }}"><small>{{ $column_title }}<span class="text-danger"> *</span></small></label>

                        <?php 
                            $value = '';
                            if ($action == 'edit') 
                                $value = $item->$column;
                        ?>
                        <input name="{{ $column }}" data-provide="datepicker" type="date" class="form-control input-sm" placeholder="{{ $column_title }}" @if ($action == 'edit') value="{{ $value }}" @endif maxlength="100"></div>
				@endif
			</div>

        	@if ($index % 2 == 0) 
        	</div>
        	@endif

        	<?php $index++; ?>
			@endforeach

			{{-- permission --}}
			@if ($current_menu_item == 'permissions')
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

            {{-- examinations --}}
            @elseif ($current_menu_item == 'examinations')
            <div class="col-md-12">
                <div class="form-group">
                    <label for="classes"><small>Class Join: <span class="text-danger"> *</span></small></label>


                    @foreach ($list_class as $class)
                    <div class="form-check">
                        <input name="class_id[]" class="form-check-input" type="checkbox" value="{{ $class->id }}" id="checkPermission-{{ $class->id }}"

                        @if (isset($item))
                        @foreach ($item->classes as $class_join)
                            @if ($class->id == $class_join->id) 
                                checked
                            @endif
                        @endforeach>
                        @endif
                        <label class="form-check-label" for="checkPermission-{{ $class->id }}">
                            {{ $class->name }}
                        </label>
                    </div>
                    @endforeach
                    
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
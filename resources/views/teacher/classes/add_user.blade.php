@extends ('layouts.layout')

@section ('content')

<?php

    $action = 'create';

    $action_title = 'Add';
    $title = 'User';
    $form_url = 'classes.users.store';


?>

<div class="panel panel-default mrg">

    <div class="panel-heading"><div class="widget-modal"><h4 class="widget-modal-title">{{ $action_title }} <span>New {{ $title }}</span> </h4></div></div>


    <div class="panel-body">
   
        <form action="{{ route($form_url, $class_id) }}" method="post">

        	{{ csrf_field() }}

		@if ($action == 'edit') 
        	{{ method_field('PUT') }}
        @endif
            <div class="col-md-12">
            <label>Email</label>
        	<input type="text" name="email">
            </div>

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
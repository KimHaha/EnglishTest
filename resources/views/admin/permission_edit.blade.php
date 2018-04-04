<form action="{{ route('permissions.update', $permission->id) }}" method="POST">
	{{ csrf_field() }}
	
	<?php echo $errors->first('name'); ?>
	<br>
    {{ method_field('PUT') }}
	<label for="name">Name</label>
	<input name="name" type="text" value="{{ $permission->name }}">

	<br>
	<label for="display_name">Display Name</label>
	<input name="display_name" type="text" value="{{ $permission->display_name }}">

	<br>
	<label for="description">Description</label>
	<input name="description" type="text" value="{{ $permission->description }}">

	<br>
	<input type="submit">
</form>
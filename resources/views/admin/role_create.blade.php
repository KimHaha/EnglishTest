<form action="{{ route('roles.store') }}" method="POST">
	{{ csrf_field() }}

	<label for="name">Name</label>
	<input name="name" type="text">

	<br>
	<label for="display_name">Display Name</label>
	<input name="display_name" type="text">

	<br>
	<label for="description">Description</label>
	<input name="description" type="text">

	<br>
	<input type="submit">
</form>
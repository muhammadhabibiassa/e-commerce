@extends('admin.admin_master')


@section('admin')


<div class="card card-default">
	<div class="card-header card-header-border-bottom">
		<h2>User Profile Update</h2>
	</div>

	@if(session('success'))
	<div class="alert alert-success alert-dismissible fade show" role="alert">
		<strong>{{ session('success') }}</strong>
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
	@endif

	<div class="card-body">
		<form method="POST" action="{{ route('update.user.profile') }}" class="form-pill" enctype="multipart/form-data">
		@csrf
			<input type="hidden" name="old_image" value="{{ $user['profile_photo_path'] }}">
			<div class="form-group">
				<label for="exampleFormControlInput3">Username</label>
				<input type="text" name="name" class="form-control" value="{{ $user['name'] }}">
			</div>
			<div class="form-group">
				<label for="exampleFormControlInput3">Email</label>
				<input type="text" name="email" class="form-control" value="{{ $user['email'] }}">
			</div>
			<div class="form-group">
				<label for="exampleFormControlInput3" class="form-label">Profile Photo</label>
				<input type="file" name="profile_photo_path" class="form-control" id="exampleFormControlInput3" value="{{ $user['profile_photo_path'] }}">
			</div>
			<div class="form-group">
				<img src="{{ asset($user['profile_photo_path']) }}" style="width:200px; height:100px;">
			</div>
			
			<button class="btn btn-primary btn-default" type="submit">Update</button>
		</form>
	</div>
</div>


@endsection
@extends('layouts/master')

@section('title')
Dashboard
@endsection


@section('content')
<section class="row new-post">
	<div class="col-md-6 col-md-offset-3">
		<header>
			<h3>What do you want to say?</h3>
		</header>
		@include('includes/success-message', ['message' => 'message'])
		@error('postError')
		<div class="alert alert-danger">
			{{ $message }}
		</div>
		@enderror
		@include('includes/error-message', ['error' => 'body'])
		<form action="{{	route('post.create') }}" method="POST">
			<div class="form-group">
				<textarea class="form-control" name="body" id="new-post" rows="5" placeholder="Your Post"></textarea>
			</div>
			<button type="submit" class="btn btn-primary">Create Post</button>
			<input type="hidden" name="_token" value="{{ Session::token() }}">
		</form>
	</div>
</section>
<section class="row posts">
	<div class="col-md-6 col-md-offset-3">
		<header>
			<h3>What other people say...</h3>
		</header>
		@foreach ($posts as $post)
		<article class="post" data-postid="{{ $post->id }}">
			<p>{{ $post->body }}</p>
			<div class="info">Posted By <span>{{ $post->user->first_name }}</span> on <span>{{ $post->created_at }}</span>
			</div>
			<div class="interaction">
				<a href="">Like</a> |
				<a href="">Dislike</a>
				@if (Auth::user() == $post->user)
				| <a href="#" class="edit">Edit</a>
				| <a href="{{ route('post.delete', ['post_id' => $post->id]) }}">Delete</a>
				@endif
			</div>
		</article>
		@endforeach
	</div>
</section>

<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Post</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="">
					<label for="post-body">Edit the Post</label>
					<textarea class="form-control" name="post-body" id="post-body" rows="5"></textarea>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="modal-save">Save changes</button>
			</div>
		</div>
	</div>
</div>
<script>
	var token = '{{ Session::	token() }}';
		var url = '{{ route('post.edit') }}'
</script>
@endsection
@extends('layouts/master')

@section('title')
	Post
@endsection

@section('content')
	<section class="row posts mt-4">
		<div class="col-md-6 col-md-offset-3">
			@include('includes/post')
		</div>
	</section>
	<section>
		<form action="{{ route('comment.create') }}" method="POST">
			<div class="form-group">
				<div class="form-group">
					<textarea class="form-control" name="body" id="new-comment" rows="5" placeholder="Your Comment"></textarea>
				</div>
				<button type="submit" class="btn btn-primary">Post Comment</button>
				<input type="hidden" name="post_id" value="{{ $post->id }}">
				<input type="hidden" name="_token" value="{{ Session::token() }}">
			</div>
		</form>
	</section>
	<section class="row comments">
		<div class="col-6">
			<header>
				<h3>Comments</h3>		
			</header>
			<div>
				@foreach ($comments as $comment)
					@include('includes/comment')
				@endforeach
			</div>
		</div>
	</section>
	<script>
		var token = '{{ Session::	token() }}';
		var urlEdit = '{{ route('post.edit') }}';
		var urlLike = '{{ route('post.like') }}'
	</script>
@endsection
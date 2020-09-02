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
<section class="create-comment">
	<form action="{{ route('comment.create') }}" method="POST">
		<div class="form-group">
			<textarea class="form-control" name="text" rows="5" placeholder="Your Comment"></textarea>
		</div>
		<input type="hidden" name="post_id" value="{{ $post->id }}">
		<input type="hidden" name="_token" value="{{ Session::token() }}">
		<button type="submit" class="btn btn-primary">Post Comment</button>
	</form>
</section>
<section class="comments">
	<header>
		<h1>Comments</h1>
	</header>
	@foreach ($comments as $comment)
		 @include('includes/comment', ['comment' => $comment])
	@endforeach
</section>
@endsection
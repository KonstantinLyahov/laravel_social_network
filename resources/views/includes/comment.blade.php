<article class="comment">
	<p>{{ $comment->text }}</p>
	<div class="info">Posted By <a href="{{ route('profile', ['user_id' => $comment->user->id]) }}">{{ $comment->user->first_name }}</a> on
		<span>{{ $post->created_at }}</span>
	</div>
</article>
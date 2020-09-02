<article class="comment" data-commentid="{{ $comment->id }}">
	<p>{{ $comment->text }}</p>
	<div class="info">Commented By <a href="{{ route('profile', ['user_id' => $comment->user->id]) }}">{{ $comment->user->first_name }}</a> on
		<span>{{ $comment->created_at }}</span>
	</div>
		<div class="interaction">	
			@if (Auth::user() == $comment->user)		
			| <a href="#" class="edit">Edit</a>
			| <a href="{{ route('post.delete', ['post_id' => $post->id]) }}">Delete</a>
			@endif
		</div>
	</div>
</article>
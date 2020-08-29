<article class="post" data-postid="{{ $post->id }}">
	<p>{{ $post->body }}</p>
	<div class="info">Posted By <a href="{{ route('profile', ['user_id' => $post->user->id]) }}">{{ $post->user->first_name }}</a> on
		<span>{{ $post->created_at }}</span>
	</div>
	<span>
		{{$post->likes()->where('like', 1)->count()-$post->likes()->where('like', 0)->count()}}
	</span>
	<div class="interaction">
		<a href="#"
			class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'You like this post' : 'Like' : 'Like'  }}</a>
		|
		<a href="#"
			class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 0 ? 'You don\'t like this post' : 'Dislike' : 'Dislike'  }}</a>
		@if (Auth::user() == $post->user)
		| <a href="#" class="edit">Edit</a>
		| <a href="{{ route('post.delete', ['post_id' => $post->id]) }}">Delete</a>
		@endif
	</div>
</article>
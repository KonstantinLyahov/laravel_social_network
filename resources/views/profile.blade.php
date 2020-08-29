@extends('layouts/master')

@section('title')
Profile
@endsection

@section('content')
	<div class="row">
		<h5>First name: {{$user->first_name}}</h5>
	</div>
	@if (Storage::disk('local')->has($user->first_name . '-' . $user->id . '.jpg'))
		<section class="row new-post">
			<div class="col-md-6 col-md-offset-3">
				<img src="{{ route('account.image', ['filename' => $user->first_name . '-' . $user->id . '.jpg']) }}"
					class="img-responsive">
			</div>
		</section>
	@endif
	<section class="posts mt-3">
		@foreach ($posts as $post)
			@include('includes/post')
		@endforeach
	</section>
	<script>
		var token = '{{ Session::	token() }}';
		var urlEdit = '{{ route('post.edit') }}';
		var urlLike = '{{ route('post.like') }}'
	</script>
@endsection
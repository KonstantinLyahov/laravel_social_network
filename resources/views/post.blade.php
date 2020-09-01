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
@endsection
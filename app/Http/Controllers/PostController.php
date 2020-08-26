<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	public function getDashboard()
	{
		$posts = Post::orderBy('created_at', 'desc')->get();
		return view('dashboard', ['posts' => $posts]);
	}
	public function postCreatePost(Request $request)
	{
		$this->validate($request, [
			'body' => 'required|max:100'
		]);

		$post = new Post();
		$post->body = $request['body'];

		if ($request->user()->posts()->save($post)) {
			$message = 'Post succesfully created';
			return redirect()->route('dashboard')->with(['message' => $message]);
		} else {
			$message = 'There was an error';
			return redirect()->route('dashboard')->withErrors(['postError' => $message]);
		}
	}
	public function getDeletePost($post_id)
	{
		$post = Post::where('id', $post_id)->first();
		if (Auth::user() != $post->user) {
			return redirect()->back();
		}
		$post->delete();
		return redirect()->route('dashboard')->with(['message' => 'Successfully deleted']);
	}
}
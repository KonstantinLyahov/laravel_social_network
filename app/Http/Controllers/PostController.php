<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\Like;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

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
			'body' => 'required|max:300'
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
		$post = Post::find($post_id);
		if (Auth::user() != $post->user) {
			return redirect()->back();
		}
		$post->delete();
		return redirect()->route('dashboard')->with(['message' => 'Successfully deleted']);
	}
	public function postEditPost(Request $request)
	{

		$this->validate($request, [
			'body' => 'required|max:300'
		]);
		$post = Post::find($request['postId']);
		if (Auth::user() != $post->user) {
			return redirect()->json([], 401);
		}
		$post->body = $request['body'];
		$post->update();
		return response()->json(['new_body' => $post->body], 200);
	}
	public function postLikePost(Request $request)
	{
		$isLike = filter_var($request->isLike, FILTER_VALIDATE_BOOLEAN);
		$post_id = $request->postId;
		$user = Auth::user();
		$post = Post::find($post_id);
		$like = $user->likes()->where('post_id', $post_id)->first();
		if ($like !== null) {
			if ($like->like == $isLike) {
				$like->delete();
				return response()->json(['deleted' => $like]);
			}
			$like->like = $isLike;
			$like->update();
			return response()->json(['updated' => $like]);
		} else {
			$like = new Like();
			$like->post_id = $post->id;
			$like->user_id = $user->id;
			$like->like = $isLike;
			$like->save();
			return response()->json(['inserted' => $like]);
		}
	}
	public function getPost($post_id)
	{
		$post = Post::find($post_id);
		$comments = $post->comments()->orderBy('created_at', 'desc')->get();
		return view('post', ['post' => $post, 'comments' => $comments]);
	}
	public function postCreateComment(Request $request)
	{
		$this->validate($request, [
			'text' => 'required|max:250'
		]);
		$comment = new Comment();
		$comment->text = $request->text;
		$comment->user_id = Auth::user()->id;
		$comment->post_id = $request->post_id;
		$comment->save();
		return redirect()->back();
	}
}

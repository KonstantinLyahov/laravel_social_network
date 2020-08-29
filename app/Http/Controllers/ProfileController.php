<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;

class ProfileController extends Controller {
	public function __construct()
	{
		$this->middleware('auth');
	}
	public function getProfile($user_id)
	{
		$user = User::find($user_id);
		$posts = $user->posts()->get();
		return view('profile', ['user' => $user, 'posts' => $posts]);
	}
}
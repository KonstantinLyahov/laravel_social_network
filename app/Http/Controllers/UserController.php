<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
	public function postSignUp(Request $request)
	{
		$this->validate($request, [
			'email' => 'required|email|unique:users',
			'first_name' => 'required|max:30',
			'password' => 'required|min:5'
		]);

		$email = $request['email'];
		$first_name = $request['first_name'];
		$password = bcrypt($request['password']);

		$user = new User();
		$user->email = $email;
		$user->first_name = $first_name;
		$user->password = $password;
		$user->save();

		Auth::login($user);

		return redirect()->route('dashboard');
	}

	public function postSignIn(Request $request)
	{
		$email = $request['signin_email'];
		$password = $request['signin_password'];
		$this->validate($request, [
			'signin_email' => 'required',
			'signin_password' => 'required'
		]);

		if (Auth::attempt(['email' => $email, 'password' => $password])) {
			return redirect()->route('dashboard');
		} else {
			return redirect()->back()->withErrors(['auth' => 'Wrong username or password']);
		}
	}

	public function getLogout()
	{
		Auth::logout();
		return redirect()->route('home');
	}

	public function getAccount()
	{
		return view('account', ['user' => Auth::user()]);
	}

	public function postSaveAccount(Request $request)
	{
		$this->validate($request, [
			'first_name' => 'required|max:100'
		]);
		$user = Auth::user();
		$user->first_name = $request['first_name'];
		$user->update();
		$file = $request->file('image');
		$filename = $request['first_name'] . '-' . $user->id . '.jpg';
		if($file) {
			Storage::disk('local')->put($filename, File::get($file));
		}
		return redirect()->route('account');
	}

	public function  getUserImage($filename)
	{
		$file = Storage::disk('local')->get($filename);
		return new Response($file, 200);
	}
}

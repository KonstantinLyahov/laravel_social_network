<?php

use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    Route::post('/signup', [
        'uses' => 'UserController@postSignUp',
        'as' => 'signup'
    ]);

    Route::post('/signin', [
        'uses' => 'UserController@postSignIn',
        'as' => 'signin'
    ]);

    Route::get('/logout', [
        'uses' => 'UserController@getLogout', 
        'as' => 'logout'
    ]);

    Route::get('/account', [
        'uses' => 'UserController@getAccount',
        'as' => 'account',
        'middleware' => 'auth'
    ]);

    Route::post('/update-account', [
        'uses' => 'UserController@postSaveAccount',
        'as' => 'account.save'
    ]);

    Route::get('/userimage/{filename}', [
        'uses' => 'UserController@getUserImage',
        'as' => 'account.image'
    ]);

    Route::get('/dashboard', [
        'uses' => 'PostController@getDashboard',
        'as' => 'dashboard',
    ]);

    Route::post('/createpost', [
        'uses' => 'PostController@postCreatepost',
        'as' => 'post.create'
    ]);

    Route::get('/delete-post/{post_id}', [
        'uses' => 'PostController@getDeletePost',
        'as' => 'post.delete'
    ]);

    Route::post('/edit', [
        'uses' => 'PostController@postEditPost',
        'as' => 'post.edit'
    ]);

    Route::post('/like-post', [
        'uses' => 'PostController@postLikePost',
        'as' => 'post.like'
    ]);

    Route::get('/profile/{user_id}', [
        'uses' => 'ProfileController@getProfile',
        'as' => 'profile'
    ]);

    Route::get('/post/{post_id}', [
        'uses' => 'PostController@getPost',
        'as' => 'post'
    ]);
});

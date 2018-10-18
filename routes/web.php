<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/x', function () {
    return view('x');
});

Route::get('/first', function () {
    return view('first');
});

Route::get('/signup', function () {
    return view('signup');
});

Route::get('/dashboard', [
    'uses' => 'PostController@gotoDashboard',
    'as' => 'dashboard',
]);

Route::get('/profile', [
    'uses' => 'UserController@profile',
    'as' => 'profile',
]);

Route::get('/profilepic/{filename}', [
    'uses' => 'UserController@getProfilePic',
    'as' => 'profile.pic',
]);

Route::get('/logout', [
    'uses' => 'UserController@logout',
    'as' => 'logout',
]);

Route::post('/createUser', [
    'uses' => 'UserController@postSignup',
    'as' => 'create', // ? name of route
]);

Route::post('/editProfile', [
    'uses' => 'UserController@editProfile',
    'as' => 'profile.edit', // ? name of route
]);

Route::post('/saveProfilePic', [
    'uses' => 'UserController@saveProfilePic',
    'as' => 'profile.pic.save', // ? name of route
]);

Route::post('/loginUser', [
    'uses' => 'UserController@postLogin',
    'as' => 'login', // ? name of route
]);

Route::post('/createpost', [
    'uses' => 'PostController@createPost',
    'as' => 'post.create', // ? name of route
]);

Route::post('/editpost', [
    'uses' => "PostController@editPost",
    'as' => 'editpost',
]);

Route::get('/deletepost/{post_id}', [
    'uses' => 'PostController@deletePost',
    'as' => 'post.delete',
]);

Route::post('/like', [
    'uses' => "PostController@likePost",
    'as' => 'like',
]);

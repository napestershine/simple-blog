<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::any('registration', array('uses' => 'UserController@registration'));
    Route::any('login', array('uses' => 'UserController@login'));

    Route::any('/', function(){
        return Redirect::intended('posts');
    });
    Route::any('posts', array('uses' => 'PostController@index'));
    Route::any('posts/{id}', 'PostController@getPost');

    Route::any('personal', 'PostController@getListPosts');
    Route::any('personal/post/create', 'PostController@postCreate');
    Route::any('personal/post/{id}/edit', 'PostController@postEdit');
    Route::any('personal/post/{id}/delete', 'PostController@postDelete');

    Route::get('logout', function(){
        Auth::logout();
        return Redirect::intended('posts');
    });
});
Menu::make('userNav', function($menu){
    $menu->add('Home', 'posts');
    $menu->add('Personal', 'personal');
    $menu->add("Logout", 'logout');
});
Menu::make('mainNav', function($menu){
    $menu->add('Home', 'posts');
    $menu->add('Login', 'login');
    $menu->add('Registration',    'registration');
});
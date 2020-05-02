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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/post/{id}', ['as'=>'home.post','uses'=>'AdminPostsController@post']);

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::group(['middleware' => 'admin'], function () {

    // Admin
    Route::get('/admin', function(){
        return view('admin.index');
    });

    // Users
    Route::resource('admin/users', 'AdminUsersController');

    // POSTS
    Route::resource('admin/posts', 'AdminPostsController');

    // Categories
    Route::resource('admin/categories', 'AdminCategoriesController');

    // Media
    Route::resource('admin/media', 'AdminMediaController');

    // Comments
    Route::resource('admin/comments', 'PostCommentsController');

    // Replies
    Route::resource('admin/comment/replies', 'CommentsRepliesController');

});

Route::group(['middleware' => 'auth'], function () {
    Route::post('comment/reply', 'CommentsRepliesController@createReply');
});
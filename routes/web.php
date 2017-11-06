<?php

use App\Mail\BlogMail;

Route::get('blog/{slug}', [ 'as' => 'blog.single', 'uses'=> 'BlogController@getSingle' ])
-> where('slug' , '[\w\d\-\_]+');
Route::get('/', 'PagesController@getIndex')->name('home');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('blogs', ['uses' => 'BlogController@getIndex' ,'as' => 'blog.index']);

Route::get('trending', 'BlogController@weeksTrending');

Route::get('contact','PagesController@getContact');

Route::post('contact','PagesController@postContact');

Route::get('about','PagesController@getAbout');

Route::get('terms','PagesController@getTerms');

Route::get('setting','UserController@setting');
Route::post('setting/update',['uses'=>'UserController@user_setting_new', 'as'=> 'setting.update']);

Route::resource('profile','ProfileController');

Route::resource('posts','PostController');

//Authentication routes
Auth::routes();

// Post like routes
Route::post('/favorite/{post}', 'PostController@favoritePost');
Route::post('/unfavorite/{post}', 'PostController@unFavoritePost');
Route::get('my_favorites', 'UserController@myFavorites')->middleware('auth');

// bookmark routes
Route::post('bookmark/{post}', 'PostController@bookmarkPost');
Route::post('unbookmark/{post}', 'PostController@unBookmarkPost');
Route::get('my_bookmarked', 'UserController@myBookmarks')->middleware('auth');

// Category follow routes
Route::post('follow/{category}', 'CategoryController@follow');
Route::post('unfollow/{category}', 'CategoryController@unfollow');
Route::get('followed', 'CategoryController@showFollowed')->middleware('auth');

// socialite - social login route
Route::get('/auth/{provider}', 'Auth\RegisterController@redirectToProvider');
Route::get('/auth/{provider}/callback', 'Auth\RegisterController@handleProviderCallback');

//category route
Route::resource('categories', 'CategoryController', ['except' => ['create']]);
Route::get('/category/{id}',['uses'=>'CategoryController@show', 'as'=>'categories.show']);

//subscribe
Route::resource('subscribe', 'SubscribeController');

// feedback
Route::resource('feedback', 'FeedbackController');

Route::post('search' , 'PagesController@search');

// comments
Route::post('comments/{post_id}', ['uses' => 'CommentsController@store', 'as' => 'comments.store']);
Route::get('comments/{id}/edit', ['uses' => 'CommentsController@edit', 'as' => 'comments.edit']);
Route::get('comments/{id}', ['uses' => 'CommentsController@update', 'as' => 'comments.update']);
Route::delete('comments/{id}', ['uses' => 'CommentsController@destroy', 'as' => 'comments.destroy']);
Route::get('comments/{id}/delete', ['uses' => 'CommentsController@delete', 'as' => 'comments.delete']);


// Recommends routes
Route::get('recommend/{id}/blog', 'BlogController@userRecommends');
Route::get('recommend/blog', 'BlogController@guestRecommends');


Route::get('/markAsRead', function(){

	auth()->user()->notifications->markAsRead();
});
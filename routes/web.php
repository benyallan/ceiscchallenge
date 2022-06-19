<?php
Auth::routes();

Route::get('/posts/novo', 'PostsController@novo')->name('posts.create');
Route::post('/posts/novo', 'PostsController@store')->name('posts.store');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/postagem/{postagem}', 'PublicController@postagem')->name('posts.show');
Route::get('/', 'PublicController@index');
Route::delete('/posts/{postagem}', 'PostsController@destroy')->name('posts.delete');
Route::put('/posts/{postagem}/publicar', 'PostsController@publicar')->name('posts.publicar');
Route::post('/posts/{postagem}', 'PostsController@update')->name('posts.update');
Route::get('/posts/{postagem}', 'PostsController@edit')->name('posts.edit');
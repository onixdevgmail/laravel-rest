<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('podcasts/{status?}', 'PodcastController@index')->name('podcasts');
Route::get('podcast/{podcast}', 'PodcastController@show')->name('podcasts.show');
Route::post('podcast/{podcast}/approval', 'PodcastController@approval')->name('podcasts.approval');
Route::post('podcasts', 'PodcastController@store')->name('podcasts.store');
Route::put('podcast/{podcast}', 'PodcastController@update')->name('podcasts.update');
Route::delete('podcast/{podcast}', 'PodcastController@delete')->name('podcasts.delete');

Route::post('comment', 'CommentController@add_comment');
Route::delete('flag-comment/{comment}', 'CommentController@delete_comment');
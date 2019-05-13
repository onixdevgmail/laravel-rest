<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('podcasts/{status?}', 'PodcastController@index');
Route::get('podcast/{podcast}', 'PodcastController@show');
Route::post('podcast/{podcast}/approval', 'PodcastController@approval');
Route::post('podcasts', 'PodcastController@store');
Route::put('podcast/{podcast}', 'PodcastController@update');
Route::delete('podcast/{podcast}', 'PodcastController@delete');

Route::post('comment', 'CommentController@add_comment');
Route::delete('flag-comment/{comment}', 'CommentController@delete_comment');
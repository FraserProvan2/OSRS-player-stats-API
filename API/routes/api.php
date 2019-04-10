<?php

use Illuminate\Http\Request;

/*-------------------------------------------------------------------------
| Account
|--------------------------------------------------------------------------*/

Route::group(['prefix' => 'account'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::get('logout', 'AuthController@logout')->middleware('auth:api');
    Route::get('user', 'AuthController@user')->middleware('auth:api');
});
  
/*-------------------------------------------------------------------------
| OSRS Player Data
|--------------------------------------------------------------------------*/

// Get Stats
Route::get('playerStats/{account_name}', 'PlayerStatsController@get_player_stats');

// Likes
Route::post('playerLikes', 'PlayerLikesController@update_likes')->middleware('auth:api');
Route::get('playerLikes/{account_name}', 'PlayerLikesController@check_if_liked')->middleware('auth:api');

// Comments
Route::post('playerComments', 'PlayerCommentsController@post_comment')->middleware('auth:api');
Route::delete('playerComments/{id}', 'PlayerCommentsController@destroy_comment')->middleware('auth:api');

/*-------------------------------------------------------------------------
| Other
|--------------------------------------------------------------------------*/

// Fallback to catch invalid routes
Route::fallback(function(){
    return response()->json(['message' => 'Invalid Request'], 404);
});

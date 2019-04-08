<?php

use Illuminate\Http\Request;

/*-------------------------------------------------------------------------
| Account
|--------------------------------------------------------------------------*/

Route::group(['prefix' => 'account'], function () {

    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');

    // Authorized
    Route::get('logout', 'AuthController@logout')->middleware('auth:api');
    Route::get('user', 'AuthController@user')->middleware('auth:api');
});
  
/*-------------------------------------------------------------------------
| OSRS Player Data
|--------------------------------------------------------------------------*/

Route::get('playerStats/{account_name}', 'PlayerStatsController@get_player_stats');

// Authorized
Route::post('playerLikes', 'PlayerLikesController@update_likes')->middleware('auth:api');
Route::get('playerLikes/{account_name}', 'PlayerLikesController@check_if_liked')->middleware('auth:api');

/*-------------------------------------------------------------------------
| Other
|--------------------------------------------------------------------------*/

// fallback to catch invalid routes
Route::fallback(function(){
    return response()->json(['message' => 'Invalid Request'], 404);
});

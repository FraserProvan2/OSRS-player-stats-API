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

Route::group(['prefix' => 'playerStats'], function () {

    Route::get('/{username}', 'PlayerStatsController@get_player_stats');

});
    
/*-------------------------------------------------------------------------
| Other
|--------------------------------------------------------------------------*/

// fallback to catch invalid routes
Route::fallback(function(){
    return response()->json(['message' => 'Invalid Request'], 404);
});

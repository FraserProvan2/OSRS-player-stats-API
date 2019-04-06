<?php

use Illuminate\Http\Request;

// Authentication Wrapper
Route::group(['prefix' => 'auth'], function () {
    
    /*-------------------------------------------------------------
    | User Account API requests                                     
    |--------------------------------------------------------------*/

    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');

    // Requests using Authorization
    Route::get('logout', 'AuthController@logout')->middleware('auth:api');
    Route::get('user', 'AuthController@user')->middleware('auth:api');

    /*-------------------------------------------------------------
    | OSRS Data
    |--------------------------------------------------------------*/

    /*-------------------------------------------------------------
    | Other
    |--------------------------------------------------------------*/

    Route::fallback(function(){
        return response()->json([
            'message' => 'Invalid Request'], 404);
    });

});

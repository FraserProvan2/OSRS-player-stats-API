<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Like;
use App\Account;

class PlayerLikesController extends Controller
{
    /**
     * Update likes on a OSRS account (Like/Dislike)
     *
     * @return Json response message
     */
    public function update_likes()
    {
        // validate form data
        $validated = request()->validate([
            'account_name' => ['required'],
        ]);

        // get account data
        $account_data = Account::get_account_info_by_name(request()->get('account_name'));     
  
        // like or unlike (depending if liked already)
        $result = Like::like_or_unlike($account_data->id);
        
        // prepare message depending out function output
        if($result == true){
            $message = 'Player liked';
        } else {
            $message = 'Player unliked';
        }

        // response
        return response()->json([
            'message' => $message
        ], 200);
    }

    /**
     * Check is account is liked based on username
     *
     * @param String account name
     * @return Json response message
     */
    public function check_if_liked($account_name)
    {
        // get account data
        $account_data = Account::get_account_info_by_name($account_name);   

        // attempt to get like data to check if liked already
        $like_data = Like::where('user_id', Auth()->id())
            ->where('account_id', $account_data->id)
            ->first();
        
        // response based on if like exists
        if(isset($like_data)){
            $message = true;
        } else {
            $message = false;
        }

        // response
        return response()->json([
            'liked' => $message
        ], 200);
    }

}

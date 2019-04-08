<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['user_id', 'account_id'];

    /**
     * Like/Dislike account
     *
     * @param Int account id
     * @return Boolean True(Liked)/False(Unliked)
     */
    static function like_or_unlike($account_id)
    {
        // checks if user has already liked
        $like_data = Like::where('user_id', Auth()->id())
            ->where('account_id', $account_id)
            ->first();

        // like account
        if(!isset($like_data)){
            Like::create([
                'user_id' => Auth()->id(),
                'account_id' => $account_id
            ]);
            
            return true;
        } else {
            // dislike account if already liked
            Like::where('user_id', Auth()->id())
                ->where('account_id', $account_id)
                ->delete();

            return false;
        }
    }

    /**
     * Check if account is liked
     *
     * @param String account name
     * @return Boolean True(Liked)/False(Unliked)
     */
    static function check_if_account_is_liked($username)
    {
        $account_data = Account::get_account_info_by_name($username);   
       
        // attempt to get like data to check if liked already
        $like_data = Like::where('user_id', Auth()->id())
            ->where('account_id', $account_data->id)
            ->first();
        
        if(isset($like_data)){
            return true;
        } else {
            return false;
        }
    }

}

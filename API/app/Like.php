<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Like;

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
     * Get total likes for a username
     *
     * @param String account name
     * @return Int Number of likes
     */
    static function get_total_likes($username)
    {
        $account_data = Account::get_account_info_by_name($username);
        
        // get all likes
        $like_data = Like::where('account_id', $account_data->id)->get();
        
        // count the likes
        $total_likes = count($like_data);

        if($total_likes < 1){
            return 0;
        } else {
            return $total_likes;
        }
    }

    /**
     * Check is account is liked based on username
     *
     * @param String account name
     * @return Boolean if user likes account
     */
    static function check_if_user_likes($account_name)
    {
        // get account data
        $account_data = Account::get_account_info_by_name($account_name);   

        // attempt to get like data to check if liked already
        $like_data = Like::where('user_id', Auth()->id())
            ->where('account_id', $account_data->id)
            ->first();
        
        // response based on if like exists
        if(isset($like_data)){
            return true;
        } else {
            return false;
        }
    }

}

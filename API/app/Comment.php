<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Comment;
use App\Account;

class Comment extends Model
{
    protected $fillable = ['user_id', 'account_id', 'body'];

    /**
    * Posts comment 
    *
    * @param Array account data
    * @param String comment body
    * @return Object newly posted comment
    */
    static function post_new_comment($account_data, $body)
    {
        return Comment::create([
            'account_id' => $account_data['id'],
            'user_id' =>  Auth()->id(),
            'body' => $body
        ]);
    }

    /**
    * Gets comments for an account
    *
    * @param String account name
    * @return Object comments for a user
    */
    static function get_accounts_comments($username)
    {
        // get account data
        $account_data = Account::get_account_info_by_name($username);
        
        return Comment::where('account_id', $account_data->id)->get();
    }

    /**
    * Gets comment using ID
    *
    * @param Integer comment id
    * @return Object comment data
    */
    static function get_comment_by_id($id)
    {
        return $comment_data = Comment::where('id', $id)->first();
    }

    /**
    * Deletes comment using ID
    *
    * @param Integer comment id
    * @return Boolean success/failure of deleting comment
    */
    static function delete_comment_by_id($id)
    {
        return Comment::where('id', $id)->delete();
    }
}

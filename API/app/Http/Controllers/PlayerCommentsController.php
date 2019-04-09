<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use App\Comment;

class PlayerCommentsController extends Controller
{    
    /**
    * Gets comments for an account
    *
    * @param String account name
    * @return Json response comments
    */
    public function get_comments($username)
    {
        // gets account comments
        $account_comments = Comment::get_accounts_comments($username);

        // check if error when getting comments
        if(!isset($account_comments)){
            return response()->json([
                'message' => 'Unable to retrieve comments'
            ], 400);  
        }

        // check if there are any comments
        if(count($account_comments) < 1){
            return response()->json([
                'message' => 'There are no comments for this account'
            ], 400);
        }

        // response
        return response()->json([
            'comments' => $account_comments
        ], 200);
    }

    /**
    * post comment for an account
    *
    * @return Json response message
    */
    public function post_comment()
    {
        // validate form data
        $validated = request()->validate([
            'body' => ['required'],
            'account_name' => ['required']
        ]);

        // get account data
        $account_data = Account::get_account_info_by_name($validated['account_name']);

        // post comment
        $new_comment = Comment::post_new_comment($account_data, $validated['body']);

        // response
        if(!isset($new_comment)){
            return response()->json([
                'message' => 'Unable to post comment'
            ], 400);
        } else {
            return response()->json([
                'message' => 'Comment posted'
            ], 201);
        }
    }
    
    /**
    * Delete a comment
    *
    * @param Integer account id
    * @return Json response message
    */
    public function destroy_comment($id)
    {
        // gets comment data
        $comment_data = Comment::get_comment_by_id($id);

        // check if comment is found
        if(!isset($comment_data)){
            return response()->json([
                'message' => 'Unable to find comment'
            ], 400);
        }

        // ensure user is authorized
        if($comment_data->user_id != Auth()->id()){
            return response()->json([
                'message' => 'Not authorized to delete this comment'
            ], 401);
        } else {
            // delete comment
            $result = Comment::delete_comment_by_id($comment_data->id);
 
            if($result == false){
                // general catch incase errors
                return response()->json([
                    'message' => 'Something went wrong deleting this comment'
                ], 400);
            } else {
                // response
                return response()->json([
                    'message' => 'Comment deleted'
                ], 200);
            }
        }
    }

}

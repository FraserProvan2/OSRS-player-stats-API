<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = ['account_name'];

    /**
     * Get info of account
     * If account hasnt been registered, create
     *
     * @param String account name
     * @return Object account data
     */
    static function get_account_info_by_name($account_name)
    {
        // fetch account data
        $account_data = Account::where('account_name', $account_name)->first();

        // if account hasnt been registered create account record
        if(!isset($account_data)) {
            $account_data = Account::create(['account_name' => $account_name]);
        } 
        
        return $account_data;
    }
}

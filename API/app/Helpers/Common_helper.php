<?php

namespace App\Helpers;

class Common_Helper {

    /**
     * Curl request function
     * 
     * @param String URL for request
     * @param Array headers
     * @param Boolean Toggle return transfer
     * @return Collection response
     */
    static function curl_request($url, $headers = NULL, $returntransfer = false) 
    {
        // creats curl request
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        // curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        // die;

        // toggle return transfer
        if($returntransfer == true) {
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        }
        
        // gets curl response
        $response = curl_exec($curl);
        curl_close ($curl);
        
        return $response;
    }

    /**
     * Prepares and prints (this)
     * 
     * @param Array,Object,Collection of data to print  
     * @param Boolean if false doesnt kill page
     */
    static function p($p, $exit = 1)
    {
        // prints varaible
        echo '<pre>' . print_r($p, true) . '</pre>';

        // kills page if true
        ($exit == 1) ? exit : '';
    }

    /**
     * Reindexes array
     * 
     * @param Array
     * @return Array reindexed
     */
    static function reindex_array($array)
    {
        return array_values(array_filter($array));
    }

    /**
     * Dumps VAR
     * 
     * @param Array
     * @return String dumped array
     */
    static function v_dump($array)
    {
        // to show entire dump
        ini_set("xdebug.var_display_max_children", -1);
        ini_set("xdebug.var_display_max_data", -1);
        ini_set("xdebug.var_display_max_depth", -1);

        return var_dump($array);
    }

}
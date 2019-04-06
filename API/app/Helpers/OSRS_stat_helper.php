<?php

namespace App\Helpers;

class OSRS_stat_helper {

    /**
     * Get raw stats from HiScore Page, parses into Array
     * 
     * @param String URL for request
     * @return Array User Stats
     */
    static function get_stats_raw($username)
    {
        // call using username
        $username = str_replace(' ', '%20', $username);
        $response = Common_helper::curl_request("https://secure.runescape.com/m=hiscore_oldschool/hiscorepersonal.ws?user1={$username}", NULL, true);

        // strip tags
        $strip_tags = strip_tags($response);

        // removes start of string
        $overall = explode('SkillRankLevelXP', $strip_tags);
        $overall = $overall[1];

        // removes end of string
        $split = explode('Minigame', $overall);
        $stats = $split[0];

        $imploded_stats = explode(PHP_EOL, $stats);

        return Common_helper::reindex_array($filtered_stats = array_filter($imploded_stats));
    }

    /**
     * Proccess Raw Stats array into data object
     * 
     * @param Array Player Stats
     * @return Array Player Stats data object
     */
    static function process_stats($raw_stats)
    {
        // declare
        $stats = Array();
        $list_of_stats = Array();
        $no_xp_stats = Array();
        $all_stats = ['Attack', 'Defence', 'Strength', 'Hitpoints', 'Ranged', 'Prayer', 'Magic', 'Cooking', 'Woodcutting', 'Fletching', 'Fishing', 'Firemaking', 'Crafting', 'Smithing', 'Mining', 'Herblore', 'Agility', 'Thieving', 'Slayer', 'Farming', 'Runecraft', 'Hunter', 'Construction'];

        // process stats
        foreach($raw_stats as $key => $stat){
            if(!self::check_for_int($stat)){
                $stats[$stat] = [
                    'Rank' => self::string_to_int($raw_stats[$key + 1]),
                    'Level' => self::string_to_int($raw_stats[$key + 2]),
                    'XP' => self::string_to_int($raw_stats[$key + 3]),
                ];

                // push stat name to array
                array_push($list_of_stats, $stat);
            }
        }

        // process stats that are 0 xp
        foreach($all_stats as $key => $stat){
            if(!in_array($stat, $list_of_stats)){
                array_push($stats[$stat] = [
                    'Rank' => NULL,
                    'Level' => 0,
                    'XP' => 0,
                ]);
            }
        }

        return $stats;
    }

    /*------------------------------------------------------------------------
    | Helper functions
    |-------------------------------------------------------------------------*/

    /**
     * Checks if value start with int or not
     * 
     * @param String value to check
     * @return Boolean whether the value is an Int
     */
    static function check_for_int($string) 
    {
        $length = strlen($string);   
        for ($i = 0, $int = ''; $i < $length; $i++) {
        if (is_numeric($string[$i]))
            $int .= $string[$i];
        else break;
        }
    
        return (int) $int;
    }

    /**
     * Converts string into In
     * 
     * @param String value
     * @return Int String value
     */
    static function string_to_int($string)
    {
        return (int) str_replace(',', '', $string);
    }

}
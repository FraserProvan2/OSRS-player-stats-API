<?php

namespace App\Helpers;

class OSRS_stat_helper
{
    /**
     * Get raw stats from HiScore Page, parses into Array
     *
     * @param String URL for request
     * @return Array User Stats
     */
    public static function get_stats_raw($raw_username)
    {
        // call using username
        $username = str_replace(' ', '%20', $raw_username);

        // source code from get request
        $response = Common_helper::curl_request("https://secure.runescape.com/m=hiscore_oldschool/hiscorepersonal.ws?user1={$username}", false, true);

        // Trim 1: Tags Removed
        $response = strip_tags($response);

        // Trim 2: Remove everything above stats table
        $exploded_response = explode('SkillRankLevelXP', $response);
        
        // Catch if Trim 2 failed
        if (isset($exploded_response[1])) {
            $response = $exploded_response[1];
            
            // Trim 3: Remove everything under stats table
            $exploded_response = explode('Minigame', $response);
            $response = $exploded_response[0];

            // Trim 4: Explode by new line
            $exploded_response = explode(PHP_EOL, $response);

            // Trim 5: Remove empty arrays

            // Reorder and return player stats array
            return Common_helper::reindex_array($filtered_response);
        }

        // Return empty array to imply no player was found
        return array();
    }

    /**
     * Proccess Raw Stats array into data object
     *
     * @param Array Player Stats
     * @return Array Player Stats data object
     */
    public static function process_stats($raw_stats)
    {
        // declartions
        $stats = array();
        $list_of_stats = array();
        $no_xp_stats = array();
        $all_stats = array('Attack', 'Defence', 'Strength', 'Hitpoints', 'Ranged', 'Prayer', 'Magic', 'Cooking', 'Woodcutting', 'Fletching', 'Fishing', 'Firemaking', 'Crafting', 'Smithing', 'Mining', 'Herblore', 'Agility', 'Thieving', 'Slayer', 'Farming', 'Runecraft', 'Hunter', 'Construction');

        // process stats
        foreach ($raw_stats as $key => $stat) {
            if (!Common_Helper::check_for_int($stat)) {
                $stats[$stat] = [
                    'Rank' => Common_Helper::string_to_int($raw_stats[$key + 1]),
                    'Level' => Common_Helper::string_to_int($raw_stats[$key + 2]),
                    'XP' => Common_Helper::string_to_int($raw_stats[$key + 3]),
                ];

                // push stat name to array
                array_push($list_of_stats, $stat);
            }
        }

        // process stats that are 0 xp
        foreach ($all_stats as $key => $stat) {
            if (!in_array($stat, $list_of_stats)) {
                $stats[$stat] = [
                    'Rank' => null,
                    'Level' => 0,
                    'XP' => 0,
                ];
            }
        }

        return $stats;
    }

}

<?php

namespace Tests\Unit;

use App\Helpers\OSRS_stat_helper;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OSRSHelperUnitTest extends TestCase
{
    use RefreshDatabase;

    /**
     * function to get responses for test methods in class
     * 
     * @return Array get_stats_raw() response
     * @return Array process_stats_response() response
     */
    private function functions_to_test(){

        // functions being tested
        $get_stats_raw_response = OSRS_stat_helper::get_stats_raw('krun64');
        $process_stats_response = OSRS_stat_helper::process_stats($get_stats_raw_response);

        // return responses
        return Array(
            'get_stats_raw_response' => $get_stats_raw_response,
            'process_stats_response' => $process_stats_response,
        );
    }
    
    /**
     * @test
     * Checks the webpage source code is in curl response
     *
     * @return void
     */
    public function get_stats_raw_response_from_curl()
    {
        // setup
        $functions_responses = $this->functions_to_test();

        // test
        $this->assertIsArray($functions_responses['get_stats_raw_response']);
    }

    /**
     * @test
     * makes sure no stats are missing after processing
     *
     * @return void
     */
    public function makes_sure_every_stat_present_after_processing()
    {
        // setup
        $functions_responses = $this->functions_to_test();

        $stats_to_check = array('Attack', 'Defence', 'Strength', 'Hitpoints', 'Ranged', 'Prayer', 'Magic', 'Cooking', 'Woodcutting', 'Fletching', 'Fishing', 'Firemaking', 'Crafting', 'Smithing', 'Mining', 'Herblore', 'Agility', 'Thieving', 'Slayer', 'Farming', 'Runecraft', 'Hunter', 'Construction');

        // test
        foreach($stats_to_check as $key => $stat){
            $this->assertArrayHasKey($stat, $functions_responses['process_stats_response']);
        }
    }

    /**
     * @test
     * makes sure stats are not empty
     *
     * @return void
     */
    public function makes_sure_process_stats_is_not_empty()
    {
        // setup
        $functions_responses = $this->functions_to_test();

        // test
        $this->assertIsArray($functions_responses['process_stats_response']);
    }

}

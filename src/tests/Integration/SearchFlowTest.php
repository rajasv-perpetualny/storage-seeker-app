<?php
/**
 * Created by PhpStorm.
 * User: Volmar Machado <vmachado@sparefoot.com>
 * Date: 8/24/17
 * Time: 11:38 AM
 */

namespace Tests\Integration;


use Tests\TestCase;

class SearchFlowTest extends TestCase
{
    public function testStatus200WithLocation()
    {
        $response = $this->get('/search?location=78702');
        $response->assertStatus(200);
    }

    public function testStatus200NoLocation()
    {
        // Should also return 200 defaulting to Ashburn, VA
        $response = $this->get('/search');
        $response->assertStatus(200);
    }

    public function testContainsPaginator()
    {
        $response = $this->post('/search', ['location' => '78702']);
        $response->assertSee('<button id="show_more_button">Show More</button>');
    }

    public function testNoMatches()
    {
        $response = $this->post('/search', ['location' => '98930']);
        $response->assertStatus(200);
        $response->assertSee('There are no SpareFoot facilities in this area.');
    }

    public function testSOAPAPIDown()
    {
        $this->refreshApplication();
        \Config::set('app.soap_api_url', null);
        $response = $this->post('/search', ['location' => '78702']);
        $response->assertStatus(200);
        $response->assertSee('There was an error handling your request. Please try again later.');
    }

    public function testCorrectFacilityLinkGeneration()
    {
        $response = $this->post('/search', ['location' => '78702']);
        $response->assertSee('href="/facility/');
    }


    public function testCorrectUnitLinkGeneration()
    {
        $response = $this->post('/search', ['location' => '78702']);
        $response->assertSee('href="/unit/');
    }
}
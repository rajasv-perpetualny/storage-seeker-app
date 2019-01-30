<?php
/**
 * Created by PhpStorm.
 * User: Volmar Machado <vmachado@sparefoot.com>
 * Date: 9/20/17
 * Time: 4:51 PM
 */
use \App\Models\Reviews;

class ReviewsTest extends \Tests\TestCase
{
    public function createApplication()
    {
        $app = parent::createApplication();
        $app->singleton(\App\Models\SoapClientFacade::class, \Tests\Unit\Mock\SoapClientMock::class);
        return $app;
    }

    public function testParsing()
    {
        $reviews = new Reviews($this->getReviews());
        $this->assertEquals('155558',$reviews->facilityReviews[0]->facilityId);
    }

    public function testConstruction()
    {
        $reviews = new Reviews($this->getReviews());
        $this->assertInstanceOf('\App\Models\Reviews', $reviews);
    }

    public function testValidation()
    {
        $reviews = new Reviews($this->getReviews());
        $this->assertEquals(true, $reviews->validate());
    }

    public function testConstructionFails()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('An Object of stdClass must be passed as an argument');
        $reviews = new Reviews(null);
    }

    public function testValidationFails()
    {
        $reviews = new Reviews($this->getIncompleteReviews());
        $this->assertEquals([],$reviews->facilityReviews);
    }

    public function getReviews() {
        return (object) [
            "facilityReviews" => [
                (object)[
                    "facilityId"=> "155558"
                    ,"rating"=> "4.0"
                    ,"title"=> "It was good"
                    ,"review"=> "It's great for being a fake facility"
                    ,"email"=> null
                    ,"nickname"=> "test"
                    ,"timestamp"=> "2017-09-05 10=>32=>48"
                ]
            ],
            "responseCode" => 1,
        ];
    }

    public function getIncompleteReviews() {
        return (object) [
            "responseCode" => 1,
        ];
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Volmar Machado <vmachado@sparefoot.com>
 * Date: 9/20/17
 * Time: 4:51 PM
 */
use \App\Models\Unit;

class UnitTest extends \Tests\TestCase
{
    public function createApplication()
    {
        $app = parent::createApplication();
        $app->singleton(\App\Models\SoapClientFacade::class, \Tests\Unit\Mock\SoapClientMock::class);
        return $app;
    }

    public function testParsing()
    {
        $unit = new Unit($this->getUnit());

        $this->assertEquals('16448230',$unit->space->spaceId);
    }

    public function testConstruction()
    {
        $unit = new Unit($this->getUnit());
        $this->assertInstanceOf('\App\Models\Unit', $unit);
    }

    public function testValidation()
    {
        $unit = new Unit($this->getUnit());
        $this->assertEquals(true, $unit->validate());
    }

    public function testConstructionFails()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('There was an error handling your request. Please try again later.');
        $unit = new Unit(null);
    }

    public function testValidationFails()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('{"spaceId":["The space id field is required."]}');
        $unit = new Unit($this->getIncompleteUnit());
    }

    public function testGetSquareFootage(){
        $unit = new Unit($this->getUnit());
        $this->assertEquals(300, $unit->squarefoot);
    }

    public function testInvalidSquareFootage() {
        $unit1 = new Unit($this->getUnitInvalidFootage());
        $unit2 = new Unit($this->getUnitNonNumericFootage());

        $this->assertEquals(50, $unit1->squarefoot);
        $this->assertEquals(25, $unit2->squarefoot);

    }

    public function getUnit() {
        return (object)  [
            "facility" => (object) [
                "images" => [
                    "http://images.sparefoot.com/medium/15555853ebed27e0519.jpg",
                ]
            ],
            "space" => (object)[
                    "spaceId" => 16448230,
                    "dimensions" => "30' x 30'",
                    "price" => "5000.00",
                    "regularPrice" => "5000.00",
                    "amenities" => [
                       "Covered",
                        "8 ft ceiling",
                        "Floor 1",
                    ],
                    "type" => "Parking Space",
                    "promotion" => "",
                    "maxReservableDate" => "1508668271",
                    "maxReservableDateFormatted" => "2017-10-22 05:31:11",
                ],
            "responseCode" => 1,
        ];
    }

    public function getUnitInvalidFootage() {
        return (object)  ["space" => (object)[
            "spaceId" => 16448230,
            "dimensions" => "55' ",
            "price" => "5000.00",
            "regularPrice" => "5000.00",
            "amenities" => [
                "Covered",
                "8 ft ceiling",
                "Floor 1",
            ],
            "type" => "Parking Space",
            "promotion" => "",
            "maxReservableDate" => "1508668271",
            "maxReservableDateFormatted" => "2017-10-22 05:31:11",
        ],
            "responseCode" => 1,
        ];
    }

    public function getUnitNonNumericFootage() {
        return (object)  ["space" => (object)[
            "spaceId" => 16448230,
            "dimensions" => " no no",
            "price" => "5000.00",
            "regularPrice" => "5000.00",
            "amenities" => [
                "Covered",
                "8 ft ceiling",
                "Floor 1",
            ],
            "type" => "Parking Space",
            "promotion" => "",
            "maxReservableDate" => "1508668271",
            "maxReservableDateFormatted" => "2017-10-22 05:31:11",
        ],
            "responseCode" => 1,
        ];
    }

    public function getIncompleteUnit() {
        return (object)  ["space" => (object)[
            "dimensions" => "30' x 30'",
            "price" => "5000.00",
            "regularPrice" => "5000.00",
            "amenities" => [
                "Covered",
                "8 ft ceiling",
                "Floor 1",
            ],
            "type" => "Parking Space",
            "promotion" => "",
            "maxReservableDate" => "1508668271",
            "maxReservableDateFormatted" => "2017-10-22 05:31:11",
        ],
            "responseCode" => 1,
        ];
    }
}
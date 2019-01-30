<?php
/**
 * Created by PhpStorm.
 * User: Volmar Machado <vmachado@sparefoot.com>
 * Date: 9/20/17
 * Time: 4:51 PM
 */
use \App\Models\Facility;

class FacilityTest extends \Tests\TestCase
{
    public function createApplication()
    {
        $app = parent::createApplication();
        $app->singleton(\App\Models\SoapClientFacade::class, \Tests\Unit\Mock\SoapClientMock::class);
        return $app;
    }

    public function testParsing()
    {
        $facility = new Facility($this->getFacility());

        $this->assertEquals('155558', $facility->facility->id);
    }

    public function testConstruction()
    {
        $facility = new Facility($this->getFacility());
        $this->assertInstanceOf('\App\Models\Facility', $facility);
    }

    public function testValidation()
    {
        $facility = new Facility($this->getFacility());
        $this->assertEquals(true, $facility->validate());
    }

    public function testConstructionFails()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('An Object of stdClass must be passed as an argument');
        $facility = new Facility(null);
    }

    public function testValidationFails()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('{"id":["The id field is required."]}');
        $facility = new Facility($this->getIncompleteUnit());
    }

    public function getFacility() {
        return (object) [
            "facility" => (object) [
                "id"=> "155558",
                "name"=> "Fake Storage Facility - Product",
                "address"=> "400 Brooks Road ",
                "city"=> "Perryville",
                "state"=> "AK",
                "zip"=> "99648",
                "latitude"=> "55.917290",
                "longitude"=> "-159.170360",
                "description"=> "Product Team\nThis is not a real storage facility. Seriously. We're not trying to be clever or ironic or make some lofty Magritte style commentary on semantics. This place does not exist.",
                "images"=> [
                    "http=>//images.sparefoot.com/medium/15555853ebed27e0519.jpg",
                    "http=>//images.sparefoot.com/medium/15555853ebed28645ea.jpg",
                    "http=>//images.sparefoot.com/medium/15555853ebed28c3bed.jpg",
                    "http=>//images.sparefoot.com/medium/15555853ebed293e2cb.jpg",
                    "http=>//images.sparefoot.com/medium/15555857475f8d7a262.jpg",
                ],
                "promotion"=> "",
                "adminFee"=> "20.00",
                "appointmentOnlyHours" => [
                    "Mon=> 8=>00 AM - 11=>00 PM",
                    "Tue=> 8=>00 AM - 11=>30 PM",
                    "Wed=> 8=>00 AM - 11=>30 PM",
                    "Thu=> 8=>00 AM - 11=>30 PM",
                    "Fri=> 8=>00 AM - 11=>30 PM",
                ],

                "amenities"=> [
                    "Elevator available",
                    "24-hour access (with background check, for business users only)",
                    "Free use of truck (tenant must refuel, $50% of your net earnings truck insurance fee, no-mile limit)",
                    "Truck rental available",
                    "Fenced and lighted",
                    "Video cameras on site",
                ],
                "spaces"=> [
                    0 => (object) [
                    "spaceId"=> "16535551",
                    "dimensions"=> "5' x 11'",
                    "price"=> "2400.01",
                    "regularPrice"=> "2400.01",
                    "amenities"=> [
                        "Air cooled only",
                        "Heated only",
                        "Covered",
                        "Shelves",
                        "Skybox",
                        "Roll up door",
                        "Floor 5",
                        "Interior",
                    ],
                    "type" => "Unit",
                    "promotion"=> "",
                    "maxReservableDate"=> 1507276066,
                    "maxReservableDateFormatted"=> "2017-10-06 02=>47=>46",
                    ],
                    "showPhoneNumber"=> "true",
                    "trackedPhoneNumber"=> "(844) 297-3685",
                    "live"=> "true",
                    "url"=> "https=>//www.sparefoot.com/facility/155558",
                ],
            ],
            "responseCode" => 1,
            "timestamp"=> 1507036223,
            "message"=> "",
        ];
    }

    public function getIncompleteUnit() {
        return (object) [
            "facility" => (object) [
                "name"=> "Fake Storage Facility - Product",
                "address"=> "400 Brooks Road ",
                "city"=> "Perryville",
                "state"=> "AK",
                "zip"=> "99648",
                "latitude"=> "55.917290",
                "longitude"=> "-159.170360",
                "description"=> "Product Team\nThis is not a real storage facility. Seriously. We're not trying to be clever or ironic or make some lofty Magritte style commentary on semantics. This place does not exist.",
                "images"=> [
                    "http=>//images.sparefoot.com/medium/15555853ebed27e0519.jpg",
                    "http=>//images.sparefoot.com/medium/15555853ebed28645ea.jpg",
                    "http=>//images.sparefoot.com/medium/15555853ebed28c3bed.jpg",
                    "http=>//images.sparefoot.com/medium/15555853ebed293e2cb.jpg",
                    "http=>//images.sparefoot.com/medium/15555857475f8d7a262.jpg",
                ],
                "promotion"=> "",
                "adminFee"=> "20.00",
                "appointmentOnlyHours" => [
                    "Mon=> 8=>00 AM - 11=>00 PM",
                    "Tue=> 8=>00 AM - 11=>30 PM",
                    "Wed=> 8=>00 AM - 11=>30 PM",
                    "Thu=> 8=>00 AM - 11=>30 PM",
                    "Fri=> 8=>00 AM - 11=>30 PM",
                ],

                "amenities"=> [
                    "Elevator available",
                    "24-hour access (with background check, for business users only)",
                    "Free use of truck (tenant must refuel, $50% of your net earnings truck insurance fee, no-mile limit)",
                    "Truck rental available",
                    "Fenced and lighted",
                    "Video cameras on site",
                ],
                "spaces"=> [
                    0 => (object) [
                        "spaceId"=> "16535551",
                        "dimensions"=> "5' x 11'",
                        "price"=> "2400.01",
                        "regularPrice"=> "2400.01",
                        "amenities"=> [
                            "Air cooled only",
                            "Heated only",
                            "Covered",
                            "Shelves",
                            "Skybox",
                            "Roll up door",
                            "Floor 5",
                            "Interior",
                        ],
                        "type" => "Unit",
                        "promotion"=> "",
                        "maxReservableDate"=> 1507276066,
                        "maxReservableDateFormatted"=> "2017-10-06 02=>47=>46",
                    ],
                    "showPhoneNumber"=> "true",
                    "trackedPhoneNumber"=> "(844) 297-3685",
                    "live"=> "true",
                    "url"=> "https=>//www.sparefoot.com/facility/155558",
                ],
            ],
            "responseCode" => 1,
            "timestamp"=> 1507036223,
            "message"=> "",
        ];
    }
}
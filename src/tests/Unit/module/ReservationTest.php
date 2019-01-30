<?php
/**
 * Created by PhpStorm.
 * User: Volmar Machado <vmachado@sparefoot.com>
 * Date: 9/20/17
 * Time: 4:51 PM
 */

use \App\Models\Reservation;

class ReservationTest extends \Tests\TestCase
{
    public function testParsing()
    {
        $reservation = new Reservation($this->getReservation());
        $this->assertEquals('test',$reservation->customerFirstName);
    }

    public function testConstruction()
    {
        $reservation = new Reservation($this->getReservation());
        $this->assertInstanceOf('\App\Models\Reservation', $reservation);
    }

    public function testAccessKey(){
        $reservation = new Reservation($this->getReservation());
        $this->assertNotEmpty($reservation->getAccessKey());
        $this->assertRegExp('/^[a-f0-9]{32}$/', $reservation->getAccessKey());
    }

    public function testValidation()
    {
        $reservation = new Reservation($this->getReservation());
        $this->assertEquals(true,$reservation->validate());
    }

    public function testConstructionFails()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('There was an error handling your request. Please try again later.');
        $reservation = new Reservation(null);
    }

    public function testValidationFails()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('{"confirmationCode":["The confirmation code field is required."]}');
        $unit = new Reservation($this->getIncompleteReservation());
    }

    public function getReservation() {
        return (object) ["reservationConfirmation" => (object) [
                "confirmationCode" => "PA3WHY9HV",
                "moveInDate" => "2017-09-25",
                "customerFirstName" => "test",
                "customerLastName" => "test",
                "customerEmailAddress" => "test@test.com",
                "customerPhoneNumber" => 5555555555,
                "facilityName" => "Fake Storage Facility - Product",
                "facilityAddress" => "400 Brooks Road  Perryville, AK 99648",
                "facilityPhoneNumber" => "5555555555",
                "showPhoneNumber" => true,
                "spaceDimensions" => "10.00' x 7.50'",
                "spaceAmenities" => "ADA Accessible, Alarm, Climate Controlled, Drive Up Access, Electricity, Premium Location, Roll Up Door",
            ],
            "responseCode" => 1,
        ];
    }

    public function getIncompleteReservation() {
        return (object) ["reservationConfirmation" => (object) [
            "moveInDate" => "2017-09-25",
            "customerFirstName" => "test",
            "customerLastName" => "test",
            "customerEmailAddress" => "test@test.com",
            "customerPhoneNumber" => 5555555555,
            "facilityName" => "Fake Storage Facility - Product",
            "facilityAddress" => "400 Brooks Road  Perryville, AK 99648",
            "facilityPhoneNumber" => "5555555555",
            "showPhoneNumber" => true,
            "spaceDimensions" => "10.00' x 7.50'",
            "spaceAmenities" => "ADA Accessible, Alarm, Climate Controlled, Drive Up Access, Electricity, Premium Location, Roll Up Door",
        ],
            "responseCode" => 1,
        ];
    }
}
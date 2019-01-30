<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;


class ReservationFlowTest extends DuskTestCase
{
    /**
     * @return false|string
     */
    private function getMoveInDate(){
        $temp = 3;
        if (in_array(date('N'), array(3,4))){
            $temp = 5;
        }
        return date('Ymd', strtotime('+'.$temp.' days'));
    }

    /**
     * @param Browser $browser
     * @param Date $date
     */
    private function fillForm(&$browser, $date){
        $browser
            ->type('#reservation_firstName', 'test')
            ->type('#reservation_lastName', 'test')
            ->type('#reservation_emailAddress', 'test@test.mx')
            ->type('#reservation_phoneNumber', '5555555555')
            ->keys('#reservation_moveInDate', $date);
    }

    /**
     * A Reservation Flow test from Home / Search / Faacility Detaiul / Unit Detail
     * @throws \Exception
     * @throws \Throwable
     */
    public function testFacilityReservationFlow()
    {
        $date = $this->getMoveInDate();
        /*
         * The first link is fo stagging and the second one for local enviroment
         *  - http://storageseeker.sparefoot.com/aaa
         *  - http://storageseeker.extrameter.com/aaa
         *  - http://172.18.0.3/aaa
         */
        $this->browse(function (Browser $browser) use ($date){
            $browser->visit('http://storageseeker/')
                ->assertSee('Compare Self Storage Facilities')
                ->type('#search_location', '99648')
                ->press('Find Units')
                ->assertSee(" Facilities - 99648")
                ->click('#facility-title-155845')
                ->assertSee('Operating Hours')
                ->click('#unit-continue-16487364')
                ->assertSee('Complete Your Reservation');
            $this->fillForm($browser, $date);
            $browser->press('Complete Reservation')
                ->assertSee('Your Reservation is Confirmed')
            ;
        });
        $this->closeAll();
    }

    /**
     * A Reservation Flow test from Home / Search / Unit Detail
     * @throws \Exception
     * @throws \Throwable
     */
    public function testUnitReservationFlow()
    {
        $date = $this->getMoveInDate();
        /*
         * The first link is fo stagging and the second one for local enviroment
         *  - http://storageseeker.sparefoot.com/aaa
         *  - http://storageseeker.extrameter.com/aaa
         *  - http://172.18.0.3/aaa
         */
        $this->browse(function (Browser $browser) use ($date){
            $browser->visit('http://storageseeker/')
                ->assertSee('Compare Self Storage Facilities')
                ->type('#search_location', '99648')
                ->press('Find Units')
                ->assertSee(" Facilities - 99648")
                ->click('#facility-unit-description-18793069')
                ->assertSee('Complete Your Reservation');
            $this->fillForm($browser, $date);
            $browser->press('Complete Reservation')
                ->assertSee('Your Reservation is Confirmed')
            ;
        });
        $this->closeAll();
    }

    /**
     * A Reservation Flow test from Home / Portland storage units / Unit Detail
     * @throws \Exception
     * @throws \Throwable
     */
    public function testCityLandingPageReservationFlow()
    {
        $date = $this->getMoveInDate();
        /*
         * The first link is fo stagging and the second one for local enviroment
         *  - http://storageseeker.sparefoot.com/aaa
         *  - http://storageseeker.extrameter.com/aaa
         *  - http://172.18.0.3/aaa
         */
        $this->browse(function (Browser $browser) use ($date){
            $browser->visit('http://storageseeker/')
                ->click('.phpdebugbar-close-btn')
                ->assertSee('Portland storage units')
                ->click('#city-landing-05')
                ->assertSee("Self Storage")
                ->click('#facility-unit-description-19299309')
                ->assertSee('Complete Your Reservation')
            ;
            $this->fillForm($browser, $date);
        });
        $this->closeAll();
    }

    /**
     * Visit a facility doesn't exist
     * @throws \Exception
     * @throws \Throwable
     */
    public function testFacilityDoesntExist()
    {
        $this->browse(function (Browser $browser){
            $browser->visit('http://storageseeker/facility/666666666')
                ->click('.phpdebugbar-close-btn')
                ->assertSee('Facility with ID: 666666666 not found')
            ;
        });
        $this->closeAll();
    }

    /**
     * Visit a unit doesn't exist
     * @throws \Exception
     * @throws \Throwable
     */
    public function testUnitDoesntExist()
    {
        $this->browse(function (Browser $browser){
            $browser->visit('http://storageseeker/unit/666666666')
                ->click('.phpdebugbar-close-btn')
                ->assertSee('Space with ID 666666666 not found')
            ;
        });
        $this->closeAll();
    }

    /**
     * Visit a page doesn't exist (Error 404)
     * @throws \Exception
     * @throws \Throwable
     */
    public function testPageDoesntExist(){
        $this->browse(function (Browser $browser){
            $browser->visit('http://storageseeker/asdasd')
                ->click('.phpdebugbar-close-btn')
                ->assertSee('Page Not Found')
            ;
        });
        $this->closeAll();
    }
}

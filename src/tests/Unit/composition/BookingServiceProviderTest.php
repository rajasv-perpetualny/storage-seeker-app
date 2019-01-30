<?php
namespace Tests\composition;
/**
 * Created by PhpStorm.
 * User: Volmar Machado <vmachado@sparefoot.com>
 * Date: 9/20/17
 * Time: 1:47 PM
 */

use Illuminate\Container\Container;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class BookingServiceProviderTest extends \Tests\TestCase
{
    public function createApplication()
    {
        $app = parent::createApplication();
        $app->singleton(\App\Models\SoapClientFacade::class, \Tests\Unit\Mock\SoapClientMock::class);
        $app->bind(\Illuminate\Http\Request::class, function ($app) {
            $request = new Request([], [], ['unitId' => 16448230]);

            $request->setRouteResolver(function () use ($request) {
                return (new Route('GET', 'testing/{unitId}', []))->bind($request);
            });
            return $request;
        });
        return $app;
    }

    public function testBookingService()
    {
        $service = new \App\Providers\SpaceServiceProvider($this->app);

        $service->boot();
        $service->register();

        $unit = $this->app->makeWith(\App\Models\Unit::class,  [
            'rawUnit' => '16448230'
        ]);

        $this->assertInstanceOf(\App\Models\Unit::class, $unit);

        $this->assertEquals('16448230',$unit->space->spaceId);

        $reservation = $this->app->makeWith(\App\Models\Reservation::class,  [
            'rawReservation' => (object) [ "reservationConfirmation" => new \stdClass() ]
        ]);

        $this->assertInstanceOf(\App\Models\Reservation::class, $reservation);
    }

    public function tearDown(){
        parent::tearDown();
    }
}
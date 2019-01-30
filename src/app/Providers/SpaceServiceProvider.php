<?php
/**
 * Created by PhpStorm.
 * User: Volmar Machado <vmachado@sparefoot.com>
 * Date: 8/22/17
 * Time: 9:17 AM
 */

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Unit;
use App\Models\Reservation;
use Illuminate\Container\Container;
use App\Exceptions\SoapCallException;

class SpaceServiceProvider extends ServiceProvider
{
    protected $defer = true;
    private $data;

    public function boot()
    {
        $this->data = [];
    }

    public function register()
    {
        $this->app->bind(\App\Models\Unit::class, function($app, $params) {
            $soap = Container::getInstance()->makeWith(\App\Models\SoapClientFacade::class,['endpoint' => 'space']);
            $r = app(\Illuminate\Http\Request::class);
            $uid = $r->route()->parameter('unitId');
            $this->data = ['unitId' => $uid, 'token' => config('site.' . config('domain') . '.token')];
            $unit = $this->getSpaceDetails($soap);
            return $unit;
        });

        $this->app->bind(\App\Models\Reservation::class, function($app, $params) {
            $soap = Container::getInstance()->makeWith(\App\Models\SoapClientFacade::class,['endpoint' => 'space']);
            $this->data = ['space' => $params['rawReservation'], 'token' => config('site.' . config('domain') . '.token')];
            $reservation = $this->reserveSpace($soap);
            \Debugbar::info('space');
            \Debugbar::info($this->data['space']);
            return $reservation;
        });
    }

    public function provides()
    {
        return [Unit::class, Reservation::class];
    }

    public final function getSpaceDetails($soap) {
        $result = $soap->spaceDetails(config('site.' . config('domain') . '.soap_api_key'), $this->data['unitId'], $this->data['token']);
        if(isset($result->responseCode) && $result->responseCode == -1) {
            throw new SoapCallException($result->message);
        }
        return new Unit($result);
    }

    public final function reserveSpace($soap) {
        $reservation =  $soap->reserveSpace(config('site.' . config('domain') . '.soap_api_key'), $this->data['space'], $this->data['token']);
        \Debugbar::info($reservation);
        if(isset($reservation->responseCode) && $reservation->responseCode == -1) {
            throw new SoapCallException($reservation->message);
        }
        return new Reservation($reservation);
    }

    public final function availableSpaceByFacility() {
        return $this->soap->availableSpaceByFacility(config('site.' . config('domain') . '.soap_api_key'), $this->data['facilityId']);
    }
}
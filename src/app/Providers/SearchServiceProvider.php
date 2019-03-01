<?php
/**
 * Created by PhpStorm.
 * User: Luis Abendaño <labendano@sparefoot.com>
 * Date: 8/16/17
 * Time: 9:14 AM
 */

namespace App\Providers;

use App\Interfaces\ISearch;
use App\Models\CityLandingPage;
use App\Models\Coverage;
use App\Models\Search;
use App\Models\SearchVehicle;
use Illuminate\Container\Container;
use Illuminate\Support\ServiceProvider;

class SearchServiceProvider extends ServiceProvider
{
    protected $defer = true;
    private $data;

    public function boot()
    {
        $this->data = [];
    }

    public function register()
    {
        $this->app->bind(\App\Models\Coverage::class, function($app, $params) {
            $soap = Container::getInstance()->makeWith(\App\Models\SoapClientFacade::class,['endpoint' => 'search']);
            // $this->data = ['space' => $params['rawReservation'], 'token' => config('site.' . config('domain') . '.token')];
            $search = $this->checkCoverage($soap);
            return $search;
        });

        $this->app->bind(\App\Interfaces\ISearch::class, function($app, $params) {
            $soap = Container::getInstance()->makeWith(\App\Models\SoapClientFacade::class,['endpoint' => 'search']);
            $this->data = ['query' => [
                'location' => $params['location'],
                'page' => $params['page'],
                'sort' => null,
                'distance' => (float) (empty($params['distance']) ? 15 : $params['distance'] ),
                'listingsPerPage' => $params['listings'],
                'squareFoot' => $params['sqft'] ?? null,
                ],
            ];
            if(empty($params['order'])) {
                $this->data['query']['sort'] = config('domain')=='aaa' ? 'aaa' : 'default';
            } else {
                $this->data['query']['sort'] = $params['order'];
            }
            $this->data['searchFilter'] = ['filterClimateControlled'=>null,'filter24HourAccess'=>null,'filterDriveUpAccess'=>null];

            $amenities = array();
            if(isset($params['typeStorage'])) {
                switch ($params['typeStorage']) {
                    case 'vehicles':
                        if (is_array($params['amenities']) && in_array('covered', $params['amenities'])) {
                            $amenities = ['covered' => true];
                        }
                        $this->data = array_merge($this->data, $amenities);
                        $search = $this->queryVehicleStorage($soap);
                        break;
                    case 'selfstorage':
                    default:
                        $this->data['searchFilter'] = array();
                        switch ($params['amenities']) {
                            case 'twenty_four_hour_access':
                                $this->data['searchFilter']['filter24HourAccess'] = true;
                                break;
                            case 'drive_up':
                                $this->data['searchFilter']['filterDriveUpAccess'] =  true;
                                break;
                            case 'climate_controlled':
                                $this->data['searchFilter']['filterClimateControlled'] = true;
                                break;
                        }
                        $search = $this->query($soap);
                        break;
                }
            }
            else {
                $search = $this->query($soap);
            }
            return $search;
        });

        $this->app->bind(\App\Models\CityLandingPage::class, function($app, $params) {
            $soap = Container::getInstance()->makeWith(\App\Models\SoapClientFacade::class,['endpoint' => 'search']);
            // $this->data = ['space' => $params['rawReservation'], 'token' => config('site.' . config('domain') . '.token')];
            $this->data = ['query' => [
                'location' => $params['location'],
                ],
            ];
            $search = $this->getCityLandingPages($soap);
            return $search;
        });
    }

    public function provides()
    {
        return [ISearch::class, Search::class, Coverage::class, SearchVehicle::class, CityLandingPage::class];
    }

    /**
     * Call the Soap API checkCoverage method that allows you to check whether or
     * not we have coverage within 15 miles of a location.
     * @param $location string Location within a state you wish to find cities in.
     * Can be full address, city & state, or zip code.
     * @return ResponseQuery
     */
    public final function checkCoverage($soap)
    {
        $result = $soap->spaceDetails(config('site.' . config('domain') . '.soap_api_key'), $this->data['location']);
        if(isset($result->responseCode) && $result->responseCode == -1) {
            throw new \App\Exceptions\SoapCallException($result->message);
        }
        return new Search($result);
    }

    /**
     * Call the Soap API getCityLandingPages method which gets an array of cities and their landing page urls.
     * @param $location string Location within a state you wish to find cities in. Can be full address,
     * city & state, or zip code.
     * @return ResponseQuery
     */
    public final function getCityLandingPages($soap)
    {

        $result = $soap->getCityLandingPages(config('site.' . config('domain') . '.soap_api_key'), $this->data['query']['location']);
        var_dump($result);

        if(isset($result->responseCode) && $result->responseCode == -1) {
            throw new \App\Exceptions\SoapCallException($result->message);
        }
        return new Search($result);
    }

    /**
     * Call the Soap API queryVehicleStorage method that allows you to access paginated search listings by
     * location which are suitable for storing a vehicle.
     * @param $data Service_Module_Api_SearchQuery Search query data.
     * @return ResponseQuery
     */
    public final function queryVehicleStorage($soap)
    {

        $result = $soap->queryVehicleStorage(config('site.' . config('domain') . '.soap_api_key'), (array) $this->data['query'], $this->data['query']['listingsPerPage']);
        if(isset($result->responseCode) && $result->responseCode == -1) {
            throw new \App\Exceptions\SoapCallException($result->message);
        }
        \Debugbar::info($result);
        return new SearchVehicle($result);
    }

    /**
     * Call the Soap API query method that allows you to access paginated search listings by location.
     * @param $data Service_Module_Api_SearchQuery Search query data.
     * @return ResponseQuery
     */
    public final function query($soap)
    {
        $result = $soap->query(
            config('site.' . config('domain') . '.soap_api_key'),
            $this->data['query'],
            $this->data['query']['listingsPerPage'],
            $this->data['searchFilter']
        );
        if(isset($result->responseCode) && $result->responseCode == -1) {
            throw new \App\Exceptions\SoapCallException($result->message);
        }
        return new Search($result);
    }
}

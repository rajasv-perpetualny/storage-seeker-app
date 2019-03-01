<?php
/**
 * Created by Perpetual.
 * User: Ryan Sebade <ryan@perpetualny.com>
 * Date: 2/15/19
 * Time: 3:00 PM
 */

namespace App\Http\Controllers;

use App\Exceptions\SoapCallException;
use App\Models\City;
use App\Models\Unit;
use Corcel\Model\Page;
use Illuminate\Container\Container;

class CityController extends Controller
{
    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        Route::pattern('id', '[0-9]+');

        parent::boot();
    }

    public function getCityDetails($cityId)
    {
        $data= [];
        $page = 1;
        $perPage = 20;
        /**
         * Call to Search to make SoapAPI request
         */
        try {
            $response = Container::getInstance()->makeWith(\App\Models\City::class, [
                'cityId' => $cityId,
            ]);
            $reviews = Container::getInstance()->makeWith(\App\Models\Reviews::class, [
                'cityId' => $cityId,
            ]);
            $paginatedReviews = (new \Illuminate\Pagination\LengthAwarePaginator($reviews->cityReviews, $reviews->numRatings, $perPage, $page, []));
            $paginatedReviews->setPath('/city/' . $cityId);
            $paginatedReviews->numRatings = $reviews->numRatings;
            $paginatedReviews->averageRating = $reviews->averageRating;

            $citiesNearby = Container::getInstance()->makeWith(\App\Interfaces\ISearch::class, [
                'location' => $response->city->zip,
                'sort' => 'distance',
                'listings' => 6,
                'page' => 1,
            ]);
        } catch (\SoapFault $e) {
            error_log("Soap Client construct failed because: {$e->getMessage()}");
            throw new SoapCallException($e->getMessage());
        }

        $citiesNearby = array_filter(
            $citiesNearby->searchResult->listings,
            function ($item) use ($cityId) {
                return $item->cityId != $cityId;
            }
        );

        if(isset($response->responseCode) && $response->responseCode != -1) {
            $breadcrumb = Container::getInstance()->makeWith(\App\Models\Breadcrumb::class, [
                'address' => $response->city->address,
                'city' => $response->city->city,
                'state' => $response->city->state,
                'zip' => $response->city->zip,
                'cityId' => $response->city->id,
                'cityName' => $response->city->name,
            ]);

            $breadcrumb->cityPage = true;

            $gmarkers = Container::getInstance()->makeWith(\App\Models\GoogleMarkers::class,[
                'listings' => [$response->city],
                'type' => 'city'
            ]);
            $data = [
                'titlePage' => $response->city->name.' | StorageSeeker',
                'result' => $response->city,
                'reviews' => $paginatedReviews,
                'perPage'=>$perPage,
                'cityUnitGroupsByType' => $this->loadGroupedUnits($response->city),
                'breadcrumb' => $breadcrumb,
                'markers' => $gmarkers,
                'latitude' => $response->city->latitude,
                'longitude' => $response->city->longitude,
                'citiesNearby' => $citiesNearby,
                'bodyClass' => "storageseeker city"
            ];
        }else {
            $data = [
                'error' => "We could not find the unit you are looking for.",
                'bodyClass' => "storageseeker city",
            ];
        }
        return view('pages.city', $data);
    }

    /**
     * Load grouped units for city
     */
    public function loadGroupedUnits($city, $unitSortToTop=null, $vehicleSort=false)
    {

        $units = $city->spaces;

        $unitId = ($unitSortToTop) ? $unitSortToTop->getId() : null;
        $orderedUnits = array();
        $vehicleUnits = array();

        foreach($units as $unit) {
            // CON-738: Skip all zero price units:
            if ($unit->regularPrice <= 0) {
                continue;
            }

            if ( $vehicleSort ) {
                if ($unit->satisfiesVehicle()) {
                    if($unitId && in_array($unitId, $unit->unitIds)) {
                        array_unshift($vehicleUnits, $unit);
                    } else {
                        $vehicleUnits[] = $unit;
                    }
                } else {
                    $orderedUnits[] = $unit;
                }
            } else {
                if($unitId && in_array($unitId, $unit->unitIds)) {
                    array_unshift($orderedUnits, $unit);
                } else {
                    $orderedUnits[] = $unit;
                }
            }
            $unit->squarefoot = Unit::getSquareFootageClass($unit->dimensions);

        }

        return array_merge($vehicleUnits,$orderedUnits);
    }

    public function doReview($cityId) {

        $data = [
            'rating' => request('rating'),
            'cityId' => $cityId,
            'title' => request('title'),
            'review' => request('message'),
            'email' => request('email'),
            'nickname' => request('nickname'),
            'timestamp' => date('Y-m-d')
        ];

        $review = Container::getInstance()->makeWith(\App\Models\Review::class, [
           'cityReview' => $data
        ]);

        return response()->json($review);
    }
}

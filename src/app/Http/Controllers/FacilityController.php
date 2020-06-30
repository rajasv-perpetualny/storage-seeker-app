<?php
/**
 * Created by PhpStorm.
 * User: Luis Abendaño <labendano@sparefoot.com>
 * Date: 8/28/17
 * Time: 10:07 AM
 */

namespace App\Http\Controllers;

use App\Exceptions\SoapCallException;
use App\Models\Facility;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Container\Container;

class FacilityController extends Controller
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

    public function getFacilityDetails(Request $request, $state = null, $city = null, $facilityName, $facilityId)
    {
        $data= [];
        $page = 1;
        $perPage = 20;
        /**
         * Call to Search to make SoapAPI request
         */
        try {
            $response = Container::getInstance()->makeWith(\App\Models\Facility::class, [
                'facilityId' => $facilityId,
            ]);
            $reviews = Container::getInstance()->makeWith(\App\Models\Reviews::class, [
                'facilityId' => $facilityId,
            ]);
            $paginatedReviews = (new \Illuminate\Pagination\LengthAwarePaginator($reviews->facilityReviews, $reviews->numRatings, $perPage, $page, []));
            $paginatedReviews->setPath('/facility/' . $facilityId);
            $paginatedReviews->numRatings = $reviews->numRatings;
            $paginatedReviews->averageRating = $reviews->averageRating;

            $facilitiesNearby = Container::getInstance()->makeWith(\App\Interfaces\ISearch::class, [
                'location' => $response->facility->zip,
                'sort' => 'distance',
                'listings' => 6,
                'page' => 1,
            ]);
        } catch (\SoapFault $e) {
            error_log("Soap Client construct failed because: {$e->getMessage()}");
            throw new SoapCallException($e->getMessage());
        }

        $facilitiesNearby = array_filter(
            $facilitiesNearby->searchResult->listings,
            function ($item) use ($facilityId) {
                return $item->facilityId != $facilityId;
            }
        );

        if(isset($response->responseCode) && $response->responseCode != -1) {
            $breadcrumb = Container::getInstance()->makeWith(\App\Models\Breadcrumb::class, [
                'address' => $response->facility->address,
                'city' => $response->facility->city,
                'state' => $response->facility->state,
                'zip' => $response->facility->zip,
                'facilityId' => $response->facility->id,
                'facilityName' => $response->facility->name,
            ]);

            $breadcrumb->facilityPage = true;

            $gmarkers = Container::getInstance()->makeWith(\App\Models\GoogleMarkers::class,[
                'listings' => [$response->facility],
                'type' => 'facility'
            ]);
            $data = [
                'titlePage' => $response->facility->name.' | StorageSeeker',
                'result' => $response->facility,
                'reviews' => $paginatedReviews,
                'perPage'=>$perPage,
                'facilityUnitGroupsByType' => $this->loadGroupedUnits($response->facility),
                'breadcrumb' => $breadcrumb,
                'markers' => $gmarkers,
                'latitude' => $response->facility->latitude,
                'longitude' => $response->facility->longitude,
                'facilitiesNearby' => $facilitiesNearby,
                'bodyClass' => "storageseeker facility",
                'metaDescription' => 'Compare self storage unit prices and reserve a storage space for free at '.$response->facility->name.' in '.$response->facility->city.', '.$response->facility->state.'.',
                'canonicalUrl' => '/self-storage/'.strtoupper($response->facility->state).'/'.str_slug(strtolower($response->facility->city), '-').'/'.str_slug(strtolower($response->facility->name), '-').'/'.$response->facility->id,

            ];
        } else {
            $data = [
                'error' => "We could not find the unit you are looking for.",
                'bodyClass' => "storageseeker facility",
            ];
        }
        if(strtoupper($state) !== strtoupper($response->facility->state) || $city !==  strtolower(str_slug($response->facility->city, "-")) || $facilityName !==  strtolower(str_slug($response->facility->name, "-"))){
          $searchData = [
            'state' => strtoupper($response->facility->state),
            'city' => strtolower(str_slug($response->facility->city, "-")),
            'facilityName' => strtolower(str_slug($response->facility->name, "-")),
            'facilityId' => $facilityId
          ];
          return redirect()->route('facilityModule', $searchData);
        } else {
          return view('pages.facility', $data);
        }
    }

    public function getFacilityDetailsLegacy(Request $request, $facilityId)
    {
        $data= [];
        $page = 1;
        $perPage = 20;
        /**
         * Call to Search to make SoapAPI request
         */
        try {
            $response = Container::getInstance()->makeWith(\App\Models\Facility::class, [
                'facilityId' => $facilityId,
            ]);
            $reviews = Container::getInstance()->makeWith(\App\Models\Reviews::class, [
                'facilityId' => $facilityId,
            ]);

        } catch (\SoapFault $e) {
            error_log("Soap Client construct failed because: {$e->getMessage()}");
            throw new SoapCallException($e->getMessage());
        }


        if(isset($response->responseCode) && $response->responseCode != -1) {

            $searchData = [
              'state' => strtoupper($response->facility->state),
              'city' => strtolower(str_slug($response->facility->city, "-")),
              'facilityName' => strtolower(str_slug($response->facility->name, "-")),
              'facilityId' => $facilityId
            ];
            return redirect()->route('facilityModule', $searchData, 302);

        } else {
            $data = [
                'error' => "We could not find the unit you are looking for.",
                'bodyClass' => "storageseeker facility",
            ];
        }

    }

    /**
     * Load grouped units for facility
     */
    public function loadGroupedUnits($facility, $unitSortToTop=null, $vehicleSort=false)
    {

        $units = $facility->spaces;

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

    public function doReview($facilityId) {

        $data = [
            'rating' => request('rating'),
            'facilityId' => $facilityId,
            'title' => request('title'),
            'review' => request('message'),
            'email' => request('email'),
            'nickname' => request('nickname'),
            'timestamp' => date('Y-m-d')
        ];

        $review = Container::getInstance()->makeWith(\App\Models\Review::class, [
           'facilityReview' => $data
        ]);

        return response()->json($review);
    }
}

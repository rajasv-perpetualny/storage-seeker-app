<?php
/**
 * Created by PhpStorm.
 * User: Volmar Machado <vmachado@sparefoot.com>
 * Date: 9/28/17
 * Time: 12:34 PM
 */

namespace App\Providers;


use App\Exceptions\SoapCallException;
use App\Models\Facility;
use App\Models\Review;
use App\Models\Reviews;
use Illuminate\Support\ServiceProvider;
use Illuminate\Container\Container;

class FacilityServiceProvider extends ServiceProvider
{
    private $data;
    public function boot() {
        $this->data = [];
    }
    public function register ()
    {
        /*
         *  Binds every Facility invocation to a SoapClient call to the query endpoint
         */
        $this->app->bind(\App\Models\Facility::class, function($app, $params) {
            $soap = Container::getInstance()->makeWith(\App\Models\SoapClientFacade::class,['endpoint' => 'facility']);
            $this->data = ['facilityId' => $params['facilityId'], 'token' => config('site.' . config('domain') . '.token')];
            $facility = $this->facilityDetails($soap);
            return $facility;
        });

        /*
         *  Binds every Reviews invocation to a SoapClient call to the facilityReviews endpoint
         */
        $this->app->bind(\App\Models\Reviews::class, function($app, $params) {
            $soap = Container::getInstance()->makeWith(\App\Models\SoapClientFacade::class,['endpoint' => 'facility']);
            $this->data = ['facilityId' => $params['facilityId'], 'token' => config('site.' . config('domain') . '.token')];
            $reviews = $this->facilityReviews($soap);
            return $reviews;
        });

        /*
         *  Binds every Review POST to a SoapClient call to the postFacilityReview endpoint
         */
        $this->app->bind(\App\Models\Review::class, function($app, $params) {
            $soap = Container::getInstance()->makeWith(\App\Models\SoapClientFacade::class,['endpoint' => 'facility']);
            \Debugbar::info($params['facilityReview']);
            $this->data = ['facilityReview' => $params['facilityReview'], 'token' => config('site.' . config('domain') . '.token')];
            $review = $this->postFacilityReview($soap);
            return $review;
        });
    }

    /**
     * @return array Abstract bindings that will be provided by this ServiceProvider
     */
    public function provides()
    {
        return [Facility::class, Review::class, Reviews::class];
    }

    /**
     * Call the Soap API query method that Load facility details.
     * @param $facilityId Facility's ID.
     * @return ResponseQuery
     */
    public final function facilityDetails($soap)
    {
        $facility = $soap->facilityDetails(config('site.' . config('domain') . '.soap_api_key'), $this->data['facilityId']);
        \Debugbar::info($facility);
        if(isset($facility->responseCode) && $facility->responseCode == -1) {
            throw new SoapCallException($facility->message);
        }
        return new Facility($facility);
    }

    /**
     * Call the Soap API queryVehicleStorage method to Post a facility review.
     * @param facilityReview Service_Module_Api_FacilityReview Facility review.
     * @return ResponseQuery
     */
    public final function postFacilityReview($soap)
    {
        $review = $soap->postFacilityReview(config('site.' . config('domain') . '.soap_api_key'), $this->data['facilityReview']);
        if(isset($review->responseCode) && $review->responseCode == -1) {
            throw new SoapCallException($review->message);
        }
        return new Review($review);
    }

    /**
     * Call the Soap API facilityReviews method which load all reviews for a given facility.
     * @param $facilityId Facility's ID.
     * @return ResponseQuery
     */
    public final function facilityReviews($soap)
    {
        $reviews = $soap->facilityReviews(config('site.' . config('domain') . '.soap_api_key'), $this->data['facilityId']);
        \Debugbar::info($reviews);
        if(isset($reviews->responseCode) && $reviews->responseCode == -1) {
            throw new SoapCallException($reviews->message);
        }
        return new Reviews($reviews);
    }
}
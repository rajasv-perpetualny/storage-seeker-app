<?php
/**
 * Created by PhpStorm.
 * User: Luis Abendaño <labendano@sparefoot.com>
 * Date: 8/15/17
 * Time: 2:34 PM
 */

namespace App\Http\Controllers;

use App\Models\Feed;
use App\Providers\AppServiceProvider;
use Illuminate\Container\Container;
use Illuminate\Http\Request;
use App\Models\Unit;

use App\Models\Search;
use Validator;

use SoapFault;

class SearchController extends Controller
{
    /**
     * Get results with the search parameters given
     *
     * @param  Request $request
     * @return view
     */
    public function getResults(Request $request)
    {
        $page=$request->input('page', 1);
        $listings=$request->input('listingsPerPage', 10);

        // Default to Ashburn, VA if none specified
        $location = (!is_null($request->input('location'))) ? $request->input('location') : "Ashburn, VA";
        $moveInDate = $request->input('moveInDate', null);
        $typeStorage = $request->input('type');
        $sqft = $request->input('sqft');
        $order = $request->input('order');
        $amenities = $request->input('amenities');
        $distance = $request->input('distance');

        $source = $request->input('source');

        /**
         * Call to Search to make SoapAPI request
         */
        try {
            $validator = Validator::make(request()->all(), [
                'location' => 'required',
                'typeStorage' => 'sometimes|required',
                'distance' => 'sometimes|required',
                'amenities' => 'sometimes|required',
                'order' => 'sometimes|required',
                'sqft' => 'sometimes|required',
            ]);
            // $response = Container::getInstance()->makeWith(\App\Models\CityLandingPage::class, [
            $response = Container::getInstance()->makeWith(\App\Interfaces\ISearch::class, [
                'location' => $location,
                'page' => $page,
                'listings' => $listings,
                'typeStorage' => $typeStorage,
                'sqft' => $sqft,
                'order' => $order,
                'amenities' => $amenities,
                'distance' => $distance,
            ]);
        } catch(Exception $e) {
            error_log("Soap Client construct failed because: {$e->getMessage()}");
            $response = $e;
        } catch (\SoapFault $e) {
            error_log("Soap Client construct failed because: {$e->getMessage()}");
            $response = $e->getMessage();
        }
        if(isset($response->responseCode) && $response->responseCode != -1) {
            $paginated = (new \Illuminate\Pagination\LengthAwarePaginator($response->searchResult->listings, $response->searchResult->numHits, 10,[]));
            $paginated->setPath('/search?'.http_build_query(request()->all()));
            if(is_array($response->searchResult->listings) && count($response->searchResult->listings)>0){
                $city = $response->searchResult->listings[0]->city;
                $state = $response->searchResult->listings[0]->state;
            }
            else{
                list($city, $state) = explode(" ", $response->searchResult->location);
            }

            $breadcrumb = Container::getInstance()->makeWith(\App\Models\Breadcrumb::class, [
                'city' => $city,
                'state' => $state,
                'address' => null,
                'zip' => null,
                'facilityId' => null,
                'facilityName' => null
            ]);
            $gmarkers = Container::getInstance()->makeWith(\App\Models\GoogleMarkers::class,[
                'listings' => $response->searchResult->listings,
                'type' => 'search'
            ]);
            $data = [
                'titlePage' => 'Your Search For The Best Storage and Prices | StorageSeeker',
                'nocookie' => false, //Request::instance()->noCookie,
                'result' => $paginated,
                'titleH2' => explode(',',$response->searchResult->location)[0],
                'siteType' => 'DEFAULT',
                'siteName' => 'AAA',
                'isBroadened' => false,
                'city' => 'Default',
                'fullState' => 'Default',
                'siteId' => config('domain'),
                'aaaActiveHeader' => false,
                'aaaEligibleHeader' => false,
                'alternateUnits' => [],
                'breadcrumb' => $breadcrumb,
                'markers' => $gmarkers,
                'latitude' => $response->searchResult->latitude,
                'longitude' => $response->searchResult->longitude,
                'location' => $location,
                'moveInDate'=>$moveInDate,
                'typeStorage' => $typeStorage,
                'sqft' => $sqft,
                'order' => $order,
                'amenities' => $amenities,
                'distance' => $distance,
                'bodyClass' => "storageseeker search",
                'source' => $source
            ];
        }
        else {
            $paginated = (new \Illuminate\Pagination\LengthAwarePaginator([], 0, 10,[]));

            $data = [
                'titlePage' => 'Your Search For The Best Storage and Prices | StorageSeeker',
                'titleH2' => '',
                'result' => $paginated,
                'siteType' => '',
                'siteName' => 'AAA',
                'isBroadened' => false,
                'city' => '',
                'fullState' => '',
                'siteId' => config('domain'),
                'aaaActiveHeader' => false,
                'aaaEligibleHeader' => false,
                'alternateUnits' => [],
                'breadcrumb' => null,
                'markers' => '[]',
                'latitude' => null,
                'longitude' => null,
                'location' => $location,
                'moveInDate'=>$moveInDate,
                'typeStorage' => $typeStorage,
                'sqft' => $sqft,
                'order' => $order,
                'amenities' => $amenities,
                'distance' => $distance,
                'bodyClass' => "storageseeker search",
                'source' => $source
            ];

            if(is_object($response)) {
                $data['error'] = 'We were unable to find the location you entered. Try searching for a more specific location name or searching in a different area.';
            } else {
                $data['error'] = 'There was an error handling your request. Please try again later.';
            }

        }
        $data['articles'] = $this->getArticles($location);
        $view = 'pages.listing';
        if($source == 'ajax'){
            $view = 'includes.results';
        }
        return view($view, $data);
    }

    public function getArticles($location){
        $articles = array();
        try{
            $articles = Container::getInstance()->makeWith(\App\Models\Feed::class, [
                'location' => $location
            ]);
        } catch(Exception $e) {
            error_log("The obtain of articles failed because: {$e->getMessage()}");
        }
        return $articles;
    }
}

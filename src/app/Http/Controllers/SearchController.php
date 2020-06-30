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
use Corcel\Model\Post;

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
    public function getResults(Request $request, $state = null, $city = null)
    {
        $page=$request->input('page', 1);
        $listings=$request->input('listingsPerPage', 10);

        // Default to Ashburn, VA if none specified
        $location = (!is_null($city)) ? $city . ', ' . $state : ((!is_null($request->input('location'))) ? $request->input('location') : "Ashburn, VA");

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
              list($city, $state) = explode(", ", $response->searchResult->location);
              $state = explode(" ", $state)[0];

              foreach($response->searchResult->listings as $listing){

                if(stripos(str_slug(strtolower($location), '-'), str_slug($listing->city, '-')) !== false){
                  $city = $listing->city;
                  break;
                }
              }

              $slug = str_slug(strtolower($city . " " . $state), "-");
            }
            else{
              list($city, $state) = explode(", ", $response->searchResult->location);
            }

            $searchData = array(
              'state' => $state,
              'city' => str_slug(strtolower($city), "-")
            );
            $slug = str_slug(strtolower($city . " " . $state), "-");
            $explodedLocation = explode(" ", $response->searchResult->location);
            $cityPage = Post::type('city')->slug($slug)->first();
            if(is_object($cityPage) || $location === end($explodedLocation)){
              return redirect()->route('cityModule', $searchData, 301);
            } else {
              $redirectData = array(
                'location' => end($explodedLocation)
              );
              return redirect()->route('searchExtended', $redirectData);
            }
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

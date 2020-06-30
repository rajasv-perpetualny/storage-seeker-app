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
use Corcel\Model\Post;

use App\Models\Unit;

use App\Models\Search;
use Validator;

use SoapFault;

class CityLandingController extends Controller
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

            list($city, $state) = explode(", ", $response->searchResult->location);
            $state = explode(" ", $state)[0];
            $avgSmall = 0;
            $avgMed = 0;
            $avgLarge = 0;
            $minSmall = 1000;
            $minMed = 1000;
            $minLarge = 1000;
            $smallCount = 0;
            $medCount = 0;
            $largeCount = 0;

            foreach($response->searchResult->listings as $listing){
              if(stripos($location, str_slug($listing->city, '-')) !== false){
                $city = $listing->city;
              }
              if($listing->smallUnit){
                $avgSmall += floatval($listing->smallUnit->sparefootPrice);
                if($minSmall >  floatval($listing->smallUnit->sparefootPrice)){
                  $minSmall = floatval($listing->smallUnit->sparefootPrice);
                }
                $smallCount+=1;
              }
              if($listing->mediumUnit){
                $avgMed += floatval($listing->mediumUnit->sparefootPrice);
                if($minMed >  floatval($listing->mediumUnit->sparefootPrice)){
                  $minMed = floatval($listing->mediumUnit->sparefootPrice);
                }
                $medCount+=1;
              }
              if($listing->largeUnit){
                $avgLarge += floatval($listing->largeUnit->sparefootPrice);
                if($minLarge >  floatval($listing->largeUnit->sparefootPrice)){
                  $minLarge = floatval($listing->largeUnit->sparefootPrice);
                }
                $largeCount+=1;
              }
            }
            $overall = 0;
            if($smallCount > 0){
              $avgSmallTotal = $avgSmall/$smallCount;
              $overall += $avgSmall;
            } else {
              $avgSmallTotal = false;
            }
            if($medCount > 0){
              $avgMedTotal = $avgMed/$medCount;
              $overall += $avgMed;
            } else {
              $avgMedTotal = false;
            }
            if($largeCount > 0){
              $avgLargeTotal = $avgLarge/$largeCount;
              $overall += $avgLarge;
            } else {
              $avgLargeTotal = false;
            }
            if($overall > 0){
              $overallCount = $smallCount + $medCount + $largeCount;
              $overallAvg = $overall/$overallCount;
            } else {
              $overallAvg = false;
            }

            $slug = str_slug(strtolower($city . " " . $state), "-");
            $cityPage = Post::type('city')->slug($slug)->first();
            if(is_object($cityPage)){
              $pageTitle = $cityPage->acf->text("page_title");
              $resultsTitle = $cityPage->acf->text("results_title");
              $bottomLeftTitle = $cityPage->acf->text("bottom_left_title");
              $headerImage = $cityPage->acf->image("hero_image")->url;
              $bottomLeftContent = $cityPage->acf->wysiwyg("bottom_left_content");
              $hideBiggestFactor = $cityPage->acf->trueFalse("hide_biggest_factor");
              $hidePricesTable = $cityPage->acf->trueFalse("hide_prices_table");
              $hideAveragePrice = $cityPage->acf->trueFalse("hide_average_price");
              $customContentOrder = $cityPage->acf->trueFalse("custom_content_order");
              $contentImage =  $cityPage->acf->image("content_image")->url;
              $contentImageAltTag =  $cityPage->acf->text("content_image_alt_tag");
              $metaTitle =  $cityPage->acf->text("metadata_title_tag");
              $metaDescription =  $cityPage->acf->text("metadata_description_tag");
              if($metaTitle === NULL || $metaTitle === ''){
                $metaTitle = 'Find '.$city.' Self Storage Units Now Using StorageSeeker.com';
              }
              if($metaDescription === NULL || $metaDescription === ''){
              $metaDescription = 'Find, compare and reserve self-storage units in '.$city.' today. Reserve mini-storage online without a credit card or obligation – Storageseeker.com';
              }


            } else {
              $pageTitle = false;
              $resultsTitle = false;
              $bottomLeftTitle = false;
              $headerImage = false;
              $bottomLeftContent = false;
              $hideBiggestFactor = false;
              $hidePricesTable = false;
              $hideAveragePrice = false;
              $customContentOrder = false;
              $contentImage =  false;
              $contentImageAltTag =  false;
              $metaTitle = 'Find '.$city.' Self Storage Units Now Using StorageSeeker.com';
              $metaDescription = 'Find, compare and reserve self-storage units in '.$city.' today. Reserve mini-storage online without a credit card or obligation – Storageseeker.com';


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
                'titlePage' => $metaTitle,
                'nocookie' => false, //Request::instance()->noCookie,
                'result' => $paginated,
                'titleH2' => explode(',',$response->searchResult->location)[0],
                'siteType' => 'DEFAULT',
                'siteName' => 'AAA',
                'isBroadened' => false,
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
                'bodyClass' => "storageseeker search home",
                'source' => $source,
                'pageData' => $cityPage,
                'state' => $state,
                'city' => $city,
                'avgSmall' => $avgSmallTotal,
                'avgMed' => $avgMedTotal,
                'avgLarge' => $avgLargeTotal,
                'minSmall' => $minSmall,
                'minMed' => $minMed,
                'minLarge' => $minLarge,
                'overallAvg' => $overallAvg,
                'headerImage' => $headerImage,
                'pageTitle' => $pageTitle,
                'resultsTitle' => $resultsTitle,
                'bottomLeftTitle' => $bottomLeftTitle,
                'bottomLeftContent' => $bottomLeftContent,
                'hideBiggestFactor' => $hideBiggestFactor,
                'hidePricesTable' => $hidePricesTable,
                'hideAveragePrice' => $hideAveragePrice,
                'customContentOrder' => $customContentOrder,
                'contentImage' => $contentImage,
                'contentImageAltTag' => $contentImageAltTag,
                'metaDescription' => $metaDescription,
                'canonicalUrl' => '/self-storage/'.strtoupper($state).'/'.str_slug(strtolower($city), '-'),
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
                'source' => $source,
                'pageData' => $cityPage,
                'state' => $state,
                'city' => $city,
                'avgSmall' => $avgSmallTotal,
                'avgMed' => $avgMedTotal,
                'avgLarge' => $avgLargeTotal,
                'minSmall' => $minSmall,
                'minMed' => $minMed,
                'minLarge' => $minLarge,
                'overallAvg' => $overallAvg,
            ];

            if(is_object($response)) {
                $data['error'] = 'We were unable to find the location you entered. Try searching for a more specific location name or searching in a different area.';
            } else {
                $data['error'] = 'There was an error handling your request. Please try again later.';
            }

        }
        $data['articles'] = $this->getArticles($location);
        $view = 'pages.city';
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

<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Container\Container;
use Corcel\Model\Post;
use Corcel\Model\Taxonomy;


use App\Models\Search;
use Validator;

use SoapFault;

class StateLandingController extends Controller
{


public function getStatePage(Request $request, $state) {
  $statePage = Post::type('state')->slug($state)->first();
  $featured = Taxonomy::category()->slug($state)->first();
  $cities = collect($featured->posts);
  $popularZip = $statePage->acf->text("popular_zip");
  $headerImage = $statePage->acf->image("header_image")->url;
  $metaTitle =  $statePage->acf->text("metadata_title_tag");
  $metaDescription =  $statePage->acf->text("metadata_description_tag");
  if($metaTitle === NULL || $metaTitle === ''){
    $metaTitle = "Find " . $statePage->title . " Self Storage Units Now with Storageseeker.com";
  }
  if($metaDescription === NULL || $metaDescription === ''){
    $metaDescription = 'Find, compare and reserve self-storage units in '.$statePage->title.' today. Reserve '.strtoupper($state).' online without a credit card or obligation with Storageseeker.com';
  }

  $page=$request->input('page', 1);
  $listings=$request->input('listingsPerPage', 2);

  // Default to Ashburn, VA if none specified
  $location = (!is_null($popularZip)) ? $popularZip : ((!is_null($request->input('location'))) ? $request->input('location') : "Ashburn, VA");
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
          'order' => 'default',
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
          'city' => null,
          'state' => $state,
          'address' => null,
          'zip' => null,
          'facilityId' => null,
          'facilityName' => null
      ]);
      $data = [
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
          'latitude' => $response->searchResult->latitude,
          'longitude' => $response->searchResult->longitude,
          'location' => $location,
          'moveInDate'=>$moveInDate,
          'typeStorage' => $typeStorage,
          'sqft' => $sqft,
          'order' => $order,
          'amenities' => $amenities,
          'distance' => $distance,
          'source' => $source,
          "pageData" => $statePage,
          "featuredCities" => $cities->sortBy('title'),
          "slug" => $state,
          "popularZip"=> $popularZip,
          "headerImage" => $headerImage,
          "bodyClass" => 'storageseeker home featured-cities',
          "titlePage" => $metaTitle,
          'metaDescription' => $metaDescription
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

   $view = 'pages.state';
   return view($view, $data);

 }

 public function getAllStates(Request $request) {
   $page = Post::type('state')->get();
   // $featured = $page->acf->featured_cities;
   // $popularZip = $page->acf->text("popular_zip");

   $data = [
     "pageData" => collect($page)->sortBy('title'),
     'bodyClass' => 'storageseeker home',
     'titlePage' => 'Find Storage Units By State | Compare Self Storage Unit Rates | StorageSeeker',
     'breadcrumb' => null,
     'metaDescription' => 'Compare storage unit prices in all 50 states and over 10,000 cities with StorageSeeker.com’s comprehensive inventory of over 35,000 storage properties.'
   ];

      $view = 'pages.stateHome';
      return view($view, $data);

  }

 public function getStateData(Request $request, $slug) {
   $page = Post::type('state')->slug($slug)->first();
   $featured = $page->acf->featured_cities;
   $popularZip = $page->acf->text("popular_zip");

   $data = [
     "pageData" => $page,
     "featuredCities" => $featured,
     "popularZip"=> $popularZip,
   ];

   return $data;

  }

}

<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Corcel\Model\Taxonomy;
use Illuminate\Support\Facades\Cookie;

/**
 * Static Pages
 */

Route::get('/', function () {
    $featured = Taxonomy::category()->slug('featured')->first();
    $cities = collect($featured->posts);
    return view('pages.home', ['bodyClass' => 'storageseeker home featured-cities', 'titlePage' => 'Compare Self Storage Units | Search Storage Facilities By Zip Code | StorageSeeker', 'breadcrumb' => null, "featuredCities" => $cities->sortBy('title'), 'metaDescription' => '', 'metaDescription' => 'StorageSeeker.com is the easiest way to find and reserve a self-storage unit online. Find the best discount on storage space with no credit card needed.']);
});

Route::get('/ping', function () {
    return '{"message" : "ok"}';
});

Route::get('/size-guides', function(){
  $featured = Taxonomy::category()->slug('featured')->first();
  $cities = collect($featured->posts);
    return view('pages.size-guide', ['bodyClass' => 'storageseeker home featured-cities', 'titlePage' => 'Self Storage Unit Size Guide | Find Out What Size Storage Unit You Need | StorageSeeker', 'breadcrumb' => null, "featuredCities" => $cities->sortBy('title'), 'metaDescription' => 'Use StorageSeeker’s Self Storage Unit Size Guide to compare and find what size storage space will fit your household belongings or business inventory.']);
});

Route::get('/find-storage', function(){
  $featured = Taxonomy::category()->slug('featured')->first();
  $cities = collect($featured->posts);
    return view('pages.find-storage', ['bodyClass' => 'storageseeker home featured-cities', 'titlePage' => 'Find Storage Units By Zip Code | Compare Self Storage Unit Rates | StorageSeeker', 'breadcrumb' => null, "featuredCities" => $cities->sortBy('title'), 'metaDescription' => 'Find and compare self storage facilities and companies near you – StorageSeeker.com – over 35,000 facilities with thousands of storage units for rent.']);
});

Route::get('/terms', function(){
  $featured = Taxonomy::category()->slug('featured')->first();
  $cities = collect($featured->posts);
    return view('pages.terms', ['bodyClass' => 'storageseeker home featured-cities', 'titlePage' => 'Terms and Conditions | StorageSeeker', 'breadcrumb' => null, "featuredCities" => $cities->sortBy('title'), 'metaDescription' => 'StorageSeeker’s Terms & Conditions – Your use of StorageSeeker.com is your consent to StorageSeeker’s these terms and conditions.']);
});

Route::get('/privacy', function(){
  $featured = Taxonomy::category()->slug('featured')->first();
  $cities = collect($featured->posts);
    return view('pages.privacy', ['bodyClass' => 'storageseeker home featured-cities', 'titlePage' => 'Privacy policy | StorageSeeker', 'breadcrumb' => null, "featuredCities" => $cities->sortBy('title'), 'metaDescription' => 'StorageSeeker’s Privacy Policy – Your use of StorageSeeker.com is your consent to this privacy policy and associated legal disclaimers.']);
});

Route::get('/legal', function(){
  $featured = Taxonomy::category()->slug('featured')->first();
  $cities = collect($featured->posts);
    return view('pages.legal', ['bodyClass' => 'storageseeker home featured-cities', 'titlePage' => 'Legal | StorageSeeker', 'breadcrumb' => null, "featuredCities" => $cities->sortBy('title'), 'metaDescription' => 'Website Terms of Use include Reservation Terms, Communications, Prohibited Activities, and Disclaimers, among others.']);
});

Route::get('/self-storage', 'StateLandingController@getAllStates');


/**
 * Reviews
 */
Route::post('/reviews','ReviewController@getReviews');


Route::get('/self-storage/{state}/', 'StateLandingController@getStatePage');
Route::get('/state/{slug}/data', 'StateLandingController@getStateData');
/**
 * Search
 */
 Route::match(['get', 'post'], '/self-storage/{state}/{city}/',
 ['as' => 'cityModule', 'uses' => 'CityLandingController@getResults']);

Route::get('/search/{location}/{type}', 'SearchController@getResults');

Route::get('/search/{location}', ['as'=>'searchExtended', 'uses' => 'SearchController@getResults']);

Route::match(['get', 'post'], '/search',
    ['as' => 'searchModule', 'uses' => 'SearchController@getResults']);

// Route::get('/search/{location}', 'SearchController@getResults');
//
// Route::match(['get', 'post'], '/search',
//     ['as' => 'searchModule', 'uses' => 'SearchController@getResults']);


// Route::get('/state/{location}', 'SearchController@getResults');

/**
 * Facility
 */
Route::post('/facility/{facilityId}/review',
    ['as' => 'reviewAction', 'uses' => 'FacilityController@doReview']);

Route::get('/self-storage/{state}/{city}/{facilityName}/{facilityId}/',['as' => 'facilityModule', 'uses' => 'FacilityController@getFacilityDetails']);
Route::get('/facility/{facilityId}/',['uses' => 'FacilityController@getFacilityDetailsLegacy']);


/**
 * Unit
 */
Route::get('/self-storage/{state}/{city}/{facilityName}/{facilityId}/unit/{unitId}', ['as' => 'unitModule', 'uses' => 'SpaceController@getDetails']);

Route::get('/unit/{unitId}', 'SpaceController@getDetailsLegacy');

Route::post('/self-storage/{state}/{city}/{facilityName}/{facilityId}/unit/{unitId}', ['as' => 'reserveAction', 'uses' => 'BookingController@doReserve']);

Route::get('/self-storage/{state}/{city}/{facilityName}/{facilityId}/unit/reserve/{unitId}', 'BookingController@reserve');

Route::post('/reservation/{unitId}',
    ['as' => 'reserveAction', 'uses' => 'BookingController@doReserve']);

Route::any('/self-storage/{state}/{city}/{facilityName}/{facilityId}/confirmation/{confirmationCode}',
    ['as' => 'confirmAction', 'uses' => 'BookingController@confirm']);

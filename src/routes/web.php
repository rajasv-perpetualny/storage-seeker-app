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

use Illuminate\Support\Facades\Cookie;

/**
 * Static Pages
 */

Route::get('/', function () {
    return view('pages.home', ['bodyClass' => 'storageseeker home', 'titlePage' => 'Compare Self Storage Units | Search Storage Facilities By Zip Code | StorageSeeker', 'breadcrumb' => null]);
});

Route::get('/ping', function () {
    return '{"message" : "ok"}';
});

Route::get('/size-guide', function(){
    return view('pages.size-guide', ['bodyClass' => 'storageseeker home', 'titlePage' => 'Self Storage Unit Size Guide | Find Out What Size Storage Unit You Need | StorageSeeker', 'breadcrumb' => null]);
});

Route::get('/find-storage', function(){
    return view('pages.find-storage', ['bodyClass' => 'storageseeker home', 'titlePage' => 'Find Storage Units By Zip Code | Compare Self Storage Unit Rates | StorageSeeker', 'breadcrumb' => null]);
});

Route::get('/terms', function(){
    return view('pages.terms', ['bodyClass' => 'storageseeker home', 'titlePage' => 'Terms and Conditions | StorageSeeker', 'breadcrumb' => null]);
});

Route::get('/privacy', function(){
    return view('pages.privacy', ['bodyClass' => 'storageseeker home', 'titlePage' => 'Privacy policy | StorageSeeker', 'breadcrumb' => null]);
});

Route::get('/legal', function(){
    return view('pages.legal', ['bodyClass' => 'storageseeker home', 'titlePage' => 'Legal | StorageSeeker', 'breadcrumb' => null]);
});

/**
 * Reviews
 */
Route::post('/reviews','ReviewController@getReviews');

/**
 * Unit
 */
Route::get('/unit/{unitId}', 'SpaceController@getDetails');

Route::post('/unit/{unitId}', ['as' => 'reserveAction', 'uses' => 'BookingController@doReserve']);

Route::get('/unit/reserve/{unitId}', 'BookingController@reserve');

Route::post('/unit/reservation/{unitId}',
    ['as' => 'reserveAction', 'uses' => 'BookingController@doReserve']);

Route::any('/confirmation/{confirmationCode}',
    ['as' => 'confirmAction', 'uses' => 'BookingController@confirm']);


/**
 * Search
 */
 Route::get('/self-storage/US/{state}/{city}/', 'SearchController@getResults');

Route::get('/search/{location}/{type}', 'SearchController@getResults');

Route::get('/search/{location}', 'SearchController@getResults');

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

Route::get('/facility/{id}/',['as' => 'facilityModule', 'uses' => 'FacilityController@getFacilityDetails']);

Route::get('/self-storage/US/{state}/', 'StateLandingController@getStatePage');
Route::get('/state/{slug}/data', 'StateLandingController@getStateData');

<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Container\Container;
use Corcel\Model\Post;

class StateLandingController extends Controller
{


public function getStatePage(Request $request, $state) {
  $page = Post::type('state')->slug($state)->first();
  $featured = $page->acf->featured_cities;
  $data = [
    "pageData" => $page,
    "featuredCities" => $featured,
    "breadcrumb" => null,
    "bodyClass" => 'storageseeker home',
    "titlePage" => "Find Storage Units In " . $page->title . " | StorageSeeker"
  ];

   $view = 'pages.test';
   return view($view, $data);

 }

 public function getStateData(Request $request, $slug) {
   $page = Post::type('state')->slug($slug)->first();
   $featured = $page->acf->featured_cities;
   $data = [
     "pageData" => $page,
     "featuredCities" => $featured,
   ];

   return $data;

  }

}

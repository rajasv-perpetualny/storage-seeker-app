<?php
/**
 * Created by PhpStorm.
 * User: Luis Abendaño <labendano@sparefoot.com>
 * Date: 8/28/17
 * Time: 10:07 AM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exceptions\SoapCallException;
use App\Models\Facility;
use App\Models\Unit;
use Illuminate\Container\Container;

class ReviewController extends Controller
{
    protected $reviews;
    public function getReviews(Request $request){
        $page = (integer)$request->input('page', 1);
        $facilityId=$request->input('facilityId');
        $perPage = 20;

        $reviews = Container::getInstance()->makeWith(\App\Models\Reviews::class, [
            'facilityId' => $facilityId,
        ]);
        $paginatedReviews = (new \Illuminate\Pagination\LengthAwarePaginator($reviews->facilityReviews, $reviews->numRatings, $perPage, $page, []));
        $paginatedReviews->setPath('/facility/' . $facilityId);
        $paginatedReviews->numRatings = $reviews->numRatings;
        $paginatedReviews->averageRating = $reviews->averageRating;
        return view('includes.reviewsSection', ['reviews'=>$paginatedReviews, 'perPage'=>$perPage]);
    }
}
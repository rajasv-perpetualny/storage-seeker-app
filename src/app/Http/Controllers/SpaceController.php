<?php
/**
 * Created by PhpStorm.
 * User: Volmar Machado <vmachado@sparefoot.com>
 * Date: 10/3/17
 * Time: 11:39 AM
 */

namespace App\Http\Controllers;


use App\Models\Unit;
use Illuminate\Container\Container;
use \App\Models\Calendar;

class SpaceController extends Controller
{
   public function getDetails(Unit $unit, $state = null, $city = null, $facilityName, $facilityId)
    {
        $reviews = Container::getInstance()->makeWith(\App\Models\Reviews::class,[
           'facilityId' => $unit->facility->id
        ]);

        $breadcrumb = Container::getInstance()->makeWith(\App\Models\Breadcrumb::class, [
            'address' => $unit->facility->address,
            'city' => $unit->facility->city,
            'state' => $unit->facility->state,
            'zip' => $unit->facility->zip,
            'facilityId' => $unit->facility->id,
            'facilityName' => $unit->facility->name,
            'unitSize' => $unit->space->dimensions,
        ]);

        $gmarkers = Container::getInstance()->makeWith(\App\Models\GoogleMarkers::class,[
            'listings' => [$unit],
            'type' => 'unit'
        ]);
        return view('pages.unitDetails',[
            'titlePage' => 'Reserve a '.$unit->space->dimensions.' Storage Unit At '.$unit->facility->name,
            'bodyClass' => 'storageseeker unit',
            'unit' => $unit,
            'reviews' => $reviews,
            'bullets' => [
                        'Lock in this rate, no credit card required',
                        'No obligation, rentals are month to month'
                        ],
            'bookingTileTitle' => 'Hold this unit for FREE',
            'rewardAmount' => ('site.' . config('domain') . '.rewardAmount'),
            'noindex' => true,
            'displayPhone' => 'PUT_SPAREPHONE_BY_ZIP_HERE',
            'breadcrumb' => $breadcrumb,
            'markers' => $gmarkers,
            'latitude' => $unit->facility->latitude,
            'longitude' => $unit->facility->longitude,
            'calendar' => new Calendar($unit->facility->officeHours),
            'url' => '/self-storage/'.strtoupper($unit->facility->state).'/'.str_slug(strtolower($unit->facility->city), '-').'/'.str_slug(strtolower($unit->facility->name), '-').'/'.$unit->facility->id.'/unit/'.$unit->rawUnit->space->spaceId,
            'metaDescription' => ''

        ]);
    }
    public function getDetailsLegacy(Unit $unit)
    {

      $searchData = [
        'state' => strtoupper($unit->facility->state),
        'city' => strtolower(str_slug($unit->facility->city, "-")),
        'facilityName' => strtolower(str_slug($unit->facility->name, "-")),
        'facilityId' => $unit->facility->id,
        'unitId' => $unit->rawUnit->space->spaceId,
      ];
      return redirect()->route('unitModule', $searchData, 302);

    }
}

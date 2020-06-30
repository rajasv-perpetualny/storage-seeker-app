<?php
/**
 * Created by PhpStorm.
 * User: Volmar Machado <vmachado@sparefoot.com>
 * Date: 8/29/17
 * Time: 11:25 AM
 */

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Unit;
use Illuminate\Container\Container;
use App\Models\Calendar;
use Validator;

class BookingController
{
    public function reserve(Unit $unit) {
        $data = [];

        $data['unit'] = $unit->rawUnit;
        $data['bullets'] = array(
            'Lock in this rate, no credit card required',
            'No obligation, rentals are month to month'
        );
        $data['bookingTileTitle'] = 'Hold this unit for FREE';
        $data['rewardAmount'] = 20.00;

        $searchLocation = $unit->facility->city;
        if ($searchLocation) {
            $data['search_results_url'] =  route('searchModule') . '?location=' . urlencode($searchLocation);
        }

        $data['noindex'] = true;
        $data['displayPhone'] = 'PUT_SPAREPHONE_BY_ZIP_HERE';

        $breadcrumb = Container::getInstance()->makeWith(\App\Models\Breadcrumb::class, [
            'address' => $unit->facility->address,
            'city' => $unit->facility->city,
            'state' => $unit->facility->state,
            'zip' => $unit->facility->zip,
            'facilityId' => $unit->facility->id,
            'facilityName' => $unit->facility->name,
        ]);

        $markers = Container::getInstance(\App\Models\GoogleMarkers::class,[
            'markers' => $unit->facility
        ]);


        $data['breadcrumb'] = $breadcrumb;
        $data['markers'] = $markers;
        $data['calendar'] = new Calendar($unit->facility->officeHours);


        return view("pages.reserve", $data);
    }

    public function doReserve(Unit $unit) {
            $breadcrumb = Container::getInstance()->makeWith(\App\Models\Breadcrumb::class, [
                'city' => $unit->facility->city,
                'state' => $unit->facility->state,
                'address' => $unit->facility->address,
                'zip' => $unit->facility->zip,
                'facilityId' => $unit->facility->id,
                'facilityName' => $unit->facility->name,
                'unitSize' => $unit->space->dimensions
            ]);
            try {
                $validator = Validator::make(request()->all(), [
                        'first_name' => 'required',
                        'last_name' => 'required',
                        'email' => 'required|email',
                        'phone' => 'required|regex:/^(1){0,1}(\s){0,1}(\(){0,1}[0-9]{3}(\)){0,1}(\s){0,1}(\-){0,1}[0-9]{3}(\-){0,1}[0-9]{4}$/',
                        'move_in_date' => 'required',
                    ]);

                if ($validator->fails()) {
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
                }

                $data = [
                    'spaceId' => $unit->rawUnit->space->spaceId,
                    'moveInDate'  => request()->input('move_in_date'),
                    'firstName' => request()->input('first_name'),
                    'lastName' => request()->input('last_name'),
                    'emailAddress' => request()->input('email'),
                    'phoneNumber' => request()->input('phone'),
                ];

                $reservation = Container::getInstance()->makeWith(Reservation::class,  [
                    'rawReservation' => $data
                ]);

                $unit->reservationConfirmation = $reservation;
                    \Debugbar::info($unit);

                    return view('pages.confirmation', [
                        'bodyClass' => 'reservation',
                        'unit' => $unit,
                        'confirmationCode' => $unit->reservationConfirmation->getAccessKey(),
                        'k' => $unit->reservationConfirmation->getAccessKey(),
                        'breadcrumb' => $breadcrumb,
                    ]);


            } catch (\Exception $e) {
                error_log($e);

                $data['errorMessage'] = $e->getMessage();
                $data['breadcrumb'] = $breadcrumb;
                $data['metaDescription'] = '';

                return view('pages.reservationError', $data);
            }
        }

        public function confirm($data) {
            return view('pages.confirmation', $data);
        }
}

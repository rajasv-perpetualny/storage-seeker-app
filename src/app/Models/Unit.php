<?php
/**
 * Created by PhpStorm.
 * User: Volmar Machado <vmachado@sparefoot.com>
 * Date: 8/31/17
 * Time: 4:24 PM
 */

namespace App\Models;

use Validator;

class Unit extends AbstractParsedModel
{
    use ProtocolFreedom;

    public $rawUnit = null;
    public $reservationConfirmation = null;
    public $squarefoot = null;
    private static $squareFootageClasses = array(25,50,75,100,150,200,300);

    public function __construct($rawUnit)
    {
        $this->rawUnit = $rawUnit;
        if(!isset($rawUnit->responseCode) || ($rawUnit->responseCode == -1)) {
            throw new \Exception('There was an error handling your request. Please try again later.');
        }
        parent::__construct($rawUnit);
        $this->rawUnit->facility = $this->rawUnit->facility ?? new \stdClass();
        $this->setFakeFacilityReview();
        $this->squarefoot = self::getSquareFootageClass($rawUnit->space->dimensions);
        if(!isset($this->rawUnit->facility->images) || !is_array($this->rawUnit->facility->images)){
            $this->rawUnit->facility->images = [];
        }
        foreach($this->rawUnit->facility->images as $idx => $image) {
            $this->rawUnit->facility->images[$idx] = $this->freeFromProtocol($image);
        }
    }
    //TODO We need the APP-95-Facility
    private function setFakeFacilityReview()
    {
        $this->rawUnit->facility->averageRating = 3.5;
        $this->rawUnit->facility->numRatings = 15;
    }

    public function validate(): bool
    {
        $validator = Validator::make($array = json_decode(json_encode($this->toValidate['space']), true), [
            "spaceId" => "required|numeric",
            "dimensions" => "required|regex:/^([0-9\.]+\'( x [0-9\.]+\')*)/",
            "price" => "required|numeric",
            "regularPrice" => "required|numeric",
            "amenities" => "required|array",
            "type" => "required",
            "promotion" => "nullable",
            "maxReservableDate" => "required|numeric",
            "maxReservableDateFormatted" => "required",
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('dimensions')) {
                // 25 is the minimum size, a size is needed to show size image
                $this->space->dimensions = "25'";
            } else if($errors->has('amenities')) {
                $this->space->amenities = [];
            } else {
                throw new \Exception($validator->errors());
            }
        }
        return true;
    }

    private static function getSquareFootage($dimensions)
    {
        $splitDimensions = [];
        preg_match_all("/([0-9]{1,2})/", $dimensions, $splitDimensions);
        if (count($splitDimensions[0]) == 1) {
            return $splitDimensions[0][0];
        }

        return($splitDimensions[0][0] * $splitDimensions[0][1]);
    }

    public static function getSquareFootageClass($dimensions)
    {
        $dimension = self::getSquareFootage($dimensions);
        if ($dimension <= self::$squareFootageClasses[0]) {
            return self::$squareFootageClasses[0];
        } elseif ($dimension >= self::$squareFootageClasses[count(self::$squareFootageClasses)-1]) {
            return self::$squareFootageClasses[count(self::$squareFootageClasses)-1];
        } else {
            for ($i=1;$i<count(self::$squareFootageClasses);$i++) {
                if ($dimension >= self::$squareFootageClasses[$i-1] && $dimension < self::$squareFootageClasses[$i]) {
                    return self::$squareFootageClasses[$i-1];
                }
            }
        }
    }

    public static function getUnitAmenities($amenities) {
        return self::mergeAmenities($amenities);
    }

    private static function mergeAmenities($amenities)
    {
        $arrayAmenities = array();

        if(in_array("Roll up door", $amenities, true)) {
            $arrayAmenities['rollUpDoor'] = 'Roll Up Door';
        } else if (in_array("Swing", $amenities, true)){
            $arrayAmenities['swingDoor'] = 'Swing Door';
        }

        if(in_array("Drive up", $amenities, true)) {
            $arrayAmenities['driveUp'] = 'Drive Up Access';
        } elseif (in_array("Outdoor Access", $amenities, true)) {
            $arrayAmenities['outdoorAccess'] = 'Outdoor Access';
        } elseif (in_array("Interior", $amenities, true)){
            $arrayAmenities['outdoorAccess'] = 'Interior';
        }

        if (in_array("Vehicle", $amenities, true)) {
            $arrayAmenities['vehicle'] = 'Available for Indoor Vehicle Storage';
        }

        if (in_array("Covered", $amenities, true)) {
            $arrayAmenities['covered'] = 'Covered';
        }

        if(in_array("Alarm", $amenities, true)) {
            $arrayAmenities['alarm'] = 'Alarm';
        }

        if(in_array("Power", $amenities, true)) {
            $arrayAmenities['power'] = 'Electricity';
        }

        if(in_array("Premium unit", $amenities, true)) {
            $arrayAmenities['premium'] = 'Premium Location';
        }

        if(in_array("Climate controlled", $amenities, true)) {
            $arrayAmenities['climateControlled'] = 'Climate Controlled';
        }

        if(in_array("Humidity Controlled", $amenities, true)) {
            $arrayAmenities['humidityControlled'] = 'Humidity Controlled';
        }

        foreach ($amenities as $amn) {
            if (strpos($amn, ' ft ceiling') !== false) {
                if(explode(' ', $amn)[0] > 8 ||  explode(' ', $amn)[0] < 7)
                    $arrayAmenities['ceiling'] = explode(' ', $amn)[0] . "' Ceiling";
            }
            if (strpos($amn, 'Floor') !== false) {
                $flr=explode(' ', $amn)[1];
                if($flr == 1)
                    $arrayAmenities['floor'] = "1st Floor";
                else if($flr == 2)
                    $arrayAmenities['floor'] = "2nd Floor";
                else if($flr == 3)
                    $arrayAmenities['floor'] = "3rd Floor";
            }
        }

        if(in_array("Elevator", $amenities, true)) {
            $arrayAmenities['elevator'] = 'Upstairs (Access via Elevator)';
        } elseif(in_array("Stairs", $amenities, true)) {
            $arrayAmenities['stairs'] = 'Upstairs (Access via Stairs)';
        } elseif(in_array("Lift", $amenities, true)) {
            $arrayAmenities['lift'] = 'Upstairs (Access via Lift)';
        }

        if(in_array("Heated only", $amenities, true)) {
            $arrayAmenities['heated'] = 'Heated';
        } elseif(in_array("Air cooled", $amenities, true)) {
            $arrayAmenities['airCooled'] = 'Air Cooled';
        }

        if(in_array("Ada accessible", $amenities, true)) {
            $arrayAmenities['adaAccessible'] = 'ADA Accessible';
        }

        if(in_array("Vehicles permitted", $amenities, true)) {
            $arrayAmenities['vehicles'] = 'Household and Vehicle Storage Allowed';
        } elseif(in_array("Vehicles only", $amenities, true)) {
            $arrayAmenities['justVehicles'] = 'Vehicle Storage Only';
            $arrayAmenities['justVehiclesNoItems'] = 'Vehicle Storage Only (No Household Items)';
        }

        if (in_array("Twenty four hours", $amenities, true)) {
            $arrayAmenities['twentyFourHourAccess'] = '24 Hour Access';
        }
        if(is_array($arrayAmenities)) {
            sort($arrayAmenities);
        }

        return $arrayAmenities;
    }

    public function generateMarkers()
    {
        $this->facility->logitud;
    }
}

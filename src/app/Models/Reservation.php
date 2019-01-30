<?php
/**
 * Created by PhpStorm.
 * User: Volmar Machado <vmachado@sparefoot.com>
 * Date: 9/7/17
 * Time: 3:29 PM
 */

namespace App\Models;

use Validator;

class Reservation extends AbstractParsedModel
{
    public function __construct($raw)
    {
        if(!isset($raw->responseCode) || ($raw->responseCode == -1)) {
            throw new \Exception('There was an error handling your request. Please try again later.');
        }
         parent::__construct($raw->reservationConfirmation);
    }

    public function getAccessKey()
    {
        $uniqueKey = $this->confirmationCode. '-' . $this->moveInDate . '-' . cookie('visit');

        return md5($uniqueKey);
    }

    public function validate() : bool
    {
        $validator = Validator::make($this->toValidate, [
            "confirmationCode" => "required",
            "moveInDate" => "required|date",
            "customerFirstName" => "required",
            "customerLastName" => "required",
            "customerEmailAddress" => "required|email",
            "customerPhoneNumber" => "required|numeric",
            "facilityName" => "required",
            "facilityAddress" => "required",
            "facilityPhoneNumber" => "sometimes|numeric",
            "showPhoneNumber" => "required",
            "spaceDimensions" => "required",
            "spaceAmenities" => "required"
        ]);
        if ($validator->fails()) {
            \Debugbar::info($validator->errors());
            throw new \Exception($validator->errors());
        }
        return true;
    }
}
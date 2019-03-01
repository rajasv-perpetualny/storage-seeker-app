<?php
/**
 * Created by Perpetual.
 * User: Ryan Sebade <ryan@perpetualny.com>
 * Date: 2/15/19
 * Time: 3:03 PM
 */

namespace App\Models;

use Validator;
use Illuminate\Support\Facades\Config;


class City extends AbstractParsedModel
{
    use ProtocolFreedom;

    public function __construct($raw)
    {
        if(!is_object($raw)) {
            throw new \Exception('An Object of stdClass must be passed as an argument');
        }
        parent::__construct($raw);
        $this->city->images = is_array($this->city->images) ? $this->city->images : array();
        if(is_array($this->city->images) && count($this->city->images)>0) {
            foreach($this->city->images as $idx => $image) {
                $this->city->images[$idx] = $this->freeFromProtocol($image);
            }
        }

        $this->parseAmenitiesText();
    }

    public function validate(): bool
    {
        $validator = Validator::make($array = json_decode(json_encode($this->toValidate['city']), true), [
            "id" => "required|numeric",
            "name" => "required",
            "address" => "required",
            "city" => "required",
            "state" => "required",
            "zip" => "required|numeric",
            "latitude" => "required|numeric",
            "longitude" => "required|numeric",
            "amenities" => "array|nullable",
            "spaces" => "required|array"
        ]);
        if ($validator->fails()) {
            $errors = $validator->messages();
            foreach ($errors->keys() as $indexKey) {
                if(in_array($indexKey, ['id', 'spaces'])) {
                    throw new \Exception($validator->errors());
                }
                $this->$indexKey = "";
            }
        }
        return true;
    }

    public function parseAmenitiesText()
    {
        array_walk($this->city->amenities, function (&$item) {
            $toUp = preg_split('/^[0-9[:punct:]\s]+/',$item);
            if(count($toUp) > 1) {
                $item = str_replace($toUp[1], ucfirst($toUp[1]), $item);
            }
        });
    }
}

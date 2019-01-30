<?php
/**
 * Created by PhpStorm.
 * User: Luis Abendaño <labendano@sparefoot.com>
 * Date: 8/28/17
 * Time: 12:05 PM
 */

namespace App\Models;

use Validator;
use Illuminate\Support\Facades\Config;


class Facility extends AbstractParsedModel
{
    use ProtocolFreedom;
    
    public function __construct($raw)
    {
        if(!is_object($raw)) {
            throw new \Exception('An Object of stdClass must be passed as an argument');
        }
        parent::__construct($raw);
        $this->facility->images = is_array($this->facility->images) ? $this->facility->images : array();
        if(is_array($this->facility->images) && count($this->facility->images)>0) {
            foreach($this->facility->images as $idx => $image) {
                $this->facility->images[$idx] = $this->freeFromProtocol($image);
            }
        }

        $this->parseAmenitiesText();
    }

    public function validate(): bool
    {
        $validator = Validator::make($array = json_decode(json_encode($this->toValidate['facility']), true), [
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
        array_walk($this->facility->amenities, function (&$item) {
            $toUp = preg_split('/^[0-9[:punct:]\s]+/',$item);
            if(count($toUp) > 1) {
                $item = str_replace($toUp[1], ucfirst($toUp[1]), $item);
            }
        });
    }
}
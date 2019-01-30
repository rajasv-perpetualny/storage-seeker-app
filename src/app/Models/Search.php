<?php
/**
 * Created by PhpStorm.
 * User: Luis Abendaño <labendano@sparefoot.com>
 * Date: 8/16/17
 * Time: 10:24 AM
 */

namespace App\Models;

use App\Interfaces\ISearch;
use Illuminate\Support\Facades\Config;
use Exception;
use Validator;

class Search extends AbstractParsedModel implements ISearch
{
    use ProtocolFreedom;

    function __construct($raw)
    {
        $this->raw = $raw;
        \Debugbar::info($raw);
        if(!isset($raw->responseCode) || ($raw->responseCode == -1)) {
            throw new Exception('There was an error handling your request. Please try again later.');
        }
        parent::__construct($raw);
        $this->navigateFreeing();
        $this->mergeAmenities();
        $this->parsePrice();
    }

    public final function mergeAmenities()
    {
        foreach ($this->searchResult->listings as $unit) {
            foreach (['smallUnit', 'mediumUnit', 'largeUnit'] as $utype) {
                if (!isset($unit->{$utype}) || !is_object($unit->{$utype}))
                    continue;
                if (!empty($unit->{$utype}->amenities)) {
                    $unit->{$utype}->{"mergedAmenities"} = implode(", ", $unit->{$utype}->amenities);
                } else {
                    $unit->{$utype}->{"mergedAmenities"} = '';
                }
            }
        }
    }

    private final function parsePrice()
    {
        foreach($this->searchResult->listings as $ix => $facility) {
            foreach(['primaryUnit', 'smallUnit' , 'mediumUnit' , 'largeUnit'] as $unit) {
                if (!isset($facility->{$unit}) || !is_object($facility->{$unit})) {
                    continue;
                }
                $this->searchResult->listings[$ix]->$unit->sparefootPriceParsed =
                    str_replace(',', '', $facility->$unit->sparefootPrice);
                $this->searchResult->listings[$ix]->$unit->priceParsed =
                    str_replace(',', '', $facility->$unit->price);
            }
        }
    }

    public function validate(): bool
    {
        $validator = Validator::make($array = json_decode(json_encode($this->toValidate['searchResult']), true), [
            "location" => "required|regex:/^([a-zA-Z0-9].*)/",
            "latitude" => "required|numeric",
            "longitude" => "required|numeric",
            "numHits" => "required|numeric",
            "hitsPerPage" => "required|numeric",
            "pageNumber" => "required|numeric",
            "numPages" => "required|numeric",
            "hasCoverage" => "required|numeric",
            "listings" => "nullable|array",
        ]);
        if ($validator->fails()) {
            throw new \App\Exceptions\SoapCallException($validator->errors());
        }
        return true;
    }

    private function navigateFreeing()
    {
        foreach($this->searchResult->listings as $idx => $facility) {
            $this->searchResult->listings[$idx]->image = $this->freeFromProtocol($facility->image);
        }
    }
}
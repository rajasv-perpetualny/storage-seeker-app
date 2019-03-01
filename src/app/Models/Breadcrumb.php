<?php
/**
 * Created by PhpStorm.
 * User: Volmar Machado <vmachado@sparefoot.com>
 * Date: 10/16/17
 * Time: 4:30 PM
 */

namespace App\Models;


class breadcrumb
{
    use State;

    public $address;
    public $city;
    public $state;
    public $zip;
    public $facilityId;
    public $facilityName;
    public $facilityPage;
    public $fullstate;
    public $unitSize;

    public function __construct($address, $city, $state, $zip, $facilityId, $facilityName, $unitSize = null)
    {
        $this->address = $address;
        $this->city = $city;
        $this->state = $state;
        $this->zip = $zip;
        $this->facilityId = $facilityId;
        $this->facilityName = $facilityName;
        $this->fullstate = $this->setStateName($state);
        $this->unitSize = $unitSize;
    }
}

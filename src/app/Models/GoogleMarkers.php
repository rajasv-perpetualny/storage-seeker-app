<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 10/23/17
 * Time: 14:57
 */
namespace App\Models;


class GoogleMarkers
{
    private $markers;
    private $type;

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getMarkers()
    {
        return $this->markers;
    }

    /**
     * @param mixed $markers
     */
    public function setMarkers($markers)
    {
        $this->markers = $markers;
    }

    /**
     * GoogleMarkers constructor.
     * @param array $listings
     * @param string $type
     */
    public function __construct($listings, $type)
    {
        $this->setType($type);
        $markers = array();
        if(is_array($listings) && count($listings)>0) {
            foreach($listings as $item) {
                $markers[] = $this->createMarker($item);
            }
        }
        $this->setMarkers($markers);
    }

    public function createMarker($item)
    {
        /* * */
        return new class($item, $this->getType()) {
            public $name;
            public $address;
            public $city;
            public $state;
            public $zip;
            public $facility_id;
            public $rating;
            public $longitude;
            public $latitude;
            public $distance;
            public $price;
            public $size;
            public $reserve_url;
            public $facility_image;

            public function __construct($item, $typeEntity)
            {
                switch($typeEntity){
                    case 'facility':
                        $this->facilityVars($item);
                        break;
                    case 'unit':
                        $item = $this->unitVars($item);
                        break;
                    case 'search':
                        $this->searchVars($item);
                        break;
                }
                $this->name = $item->name;
                $this->address = $item->address;
                $this->city = $item->city;
                $this->state  = $item->state ;
                $this->zip = $item->zip;
                $this->longitude  = $item->longitude ;
                $this->latitude = $item->latitude;
            }

            public function searchVars($item)
            {
                $this->name = $item->name;
                $this->facility_id = $item->facilityId;
                $this->distance = $item->distance;
                $this->price = $item->price;
                $this->rating = $item->averageRating;
                $this->size = $item->dimensions;
                $this->facility_image = $item->image;
                $this->reserve_url = config('host') . '/unit/'.$item->primaryUnit->id;
            }

            public function facilityVars($item)
            {
                $this->facility_id = $item->id;
                if (is_array($item->images) && count($item->images)>0){
                    $this->facility_image = $item->images[0];
                }
                $this->reserve_url = config('host') . '/unit/' . $item->id;
            }

            public function unitVars($item)
            {
                $this->facility_id = $item->facility->id;
                $this->reserve_url = config('host') . '/unit/'.$item->space->spaceId;
                $this->price = $item->space->price;
                return $item->facility;
            }
        };
    }

    public function __toString()
    {
        return json_encode($this->getMarkers());
    }
}
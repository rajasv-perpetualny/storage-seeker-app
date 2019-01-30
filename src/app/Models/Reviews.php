<?php
/**
 * Created by PhpStorm.
 * User: Volmar Machado <vmachado@sparefoot.com>
 * Date: 10/2/17
 * Time: 4:49 PM
 */

namespace App\Models;


class Reviews extends AbstractParsedModel
{
    public $averageRating = 0;
    public $numRatings = 0;
    public function __construct($raw)
    {
        if(!is_object($raw)) {
            throw new \Exception('An Object of stdClass must be passed as an argument');
        }
        parent::__construct($raw);
        $this->setNumRating();
        $this->setAverageRating();
    }

    public function validate(): bool
    {
        if (!isset($this->toValidate['facilityReviews']) || !is_array($this->toValidate['facilityReviews'])) {
            $this->facilityReviews = [];
        }
        return true;
    }

    public function setAverageRating()
    {
        foreach ($this->facilityReviews as $review) {
            $this->averageRating += $review->rating;
        }
        $this->averageRating = ($this->numRatings>0) ? round($this->averageRating / $this->numRatings,1) : 0;
        if($this->averageRating>5){
            $this->averageRating = 5;
        }
    }

    public function setNumRating()
    {
        $this->numRatings = count($this->facilityReviews);
    }
}
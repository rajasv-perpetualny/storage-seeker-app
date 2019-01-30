<?php
/**
 * Created by PhpStorm.
 * User: Volmar Machado <vmachado@sparefoot.com>
 * Date: 9/29/17
 * Time: 10:44 AM
 */

namespace App\Models;


class Review extends AbstractParsedModel
{
    public $raw = null;

    public function __construct($raw)
    {
        if(!isset($raw->responseCode) || ($raw->responseCode == -1)) {
            throw new \Exception('There was an error handling your request. Please try again later.');
        }
        $this->raw = $raw;
        parent::__construct($raw);
    }

    public function validate(): bool
    {
        return true;
    }
}
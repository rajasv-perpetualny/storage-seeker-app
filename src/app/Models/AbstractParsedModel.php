<?php
/**
 * Created by PhpStorm.
 * User: Volmar Machado <vmachado@sparefoot.com>
 * Date: 9/12/17
 * Time: 8:42 PM
 */

namespace App\Models;

/**
 * Class AbstractParsedModel
 *  This class will bind raw data to the class so you can call it directly. And it forces the validation of the data
 *  that comes through the network
 *  All the classes that talks to SOAP API should extend this class
 *
 * @package App\Models
 */
abstract class AbstractParsedModel
{
    protected $toValidate;
    public function __construct (\stdClass $raw) {
        foreach(get_object_vars($raw) as $property => $value) {
            $this->{$property} = $value;
            $this->toValidate[$property] = $value;
        }
        $this->validate();
    }

    public abstract function validate() : bool;
}
<?php
/**
 * Created by PhpStorm.
 * User: Volmar Machado <vmachado@sparefoot.com>
 * Date: 7/26/17
 * Time: 10:10 AM.
 */

namespace App\Interfaces\modules;

interface IModule
{
    /**
     * Call the api endpoint for this module concern.
     */
    public function call();

    /**
     * return the Model generated for this Concern.
     *
     * @return object Model
     */
    public function getModel();

    /**
     * @return string formatted output
     */
    public function output();
}

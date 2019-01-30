<?php
/**
 * Created by PhpStorm.
 * User: Volmar Machado <vmachado@sparefoot.com>
 * Date: 7/26/17
 * Time: 10:16 AM.
 */

namespace App\Interfaces\modules;

interface IDecorator
{
    /**
     * @return formated data in the decorator fasion
     */
    public function format();
}

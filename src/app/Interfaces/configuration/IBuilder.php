<?php
/**
 * Created by PhpStorm.
 * User: Volmar Machado <vmachado@sparefoot.com>
 * Date: 7/25/17
 * Time: 9:24 AM.
 */

namespace App\Interfaces\configuration;

interface IBuilder
{
    const DYNAMIC_MODULE = 0;
    const STATIC_MODULE = 1;
    // The constructor will receive the parameters for the building

    /**
     *  This method is a factory method that will decide to load a dynamic or a static module.
     *
     * @return Module
     */
    public function loadModule();

    /**
     * This method will build a dynamic module.
     *
     * @return Module
     */
    public function buildStatic();

    /**
     * This method will build a static module.
     *
     * @return Module
     */
    public function buildDynamic();
}

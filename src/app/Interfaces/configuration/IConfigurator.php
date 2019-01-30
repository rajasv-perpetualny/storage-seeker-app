<?php
/**
 * Created by PhpStorm.
 * User: Volmar
 * Date: 7/24/17
 * Time: 3:28 PM.
 */

namespace App\Interfaces\configuration;

interface IConfigurator
{
    /**
     * @return string return logo path
     */
    public function getLogoPath();

    /**
     * @return string return the layout definition as a string
     */
    public function getLayout();

    /**
     * @return array return a list of Modules to be passed to the Composer
     */
    public function getModules();

    /**
     * @param string Brand name
     * @param mixed $brand
     *
     * @return JSON return merged configuration file from default.json + <brand>.json
     */
    public function mergeConfiguration($brand);
}

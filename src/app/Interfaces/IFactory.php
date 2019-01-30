<?php
/**
 * Created by PhpStorm.
 * User: Luis Abendaño <labendano@sparefoot.com>
 * Date: 7/26/17
 * Time: 11:19 PM.
 */

namespace App\Interfaces;

interface IFactory
{
    /**
     * @return array Return an array with all the CSS files needed in the header
     */
    public function getCss();

    /**
     * @return array Return an array with all the Javascript files needed in the header solving all the aliases used in the json file
     */
    public function getJs();

    /**
     * @return string Html elements and content needed to render the Header
     */
    public function createContent();
}

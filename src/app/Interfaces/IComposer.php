<?php
/**
 * Created by PhpStorm.
 * User: Luis Abendaño <labendano@sparefoot.com>
 * Date: 7/24/17
 * Time: 3:59 PM.
 */


namespace App\Interfaces;


interface IComposer
{
    /**
     * This method will load all CSS needed to render the page.
     *
     * @return bool
     */
    public function loadCss();

    /**
     * This method will load all JavaScript needed to render the page.
     *
     * @return JS file
     */
    public function loadJs();

    /**
     * This method will render the Header and return false if something went wrong (Logging the error).
     *
     * @return bool True in case everything went okay, false if an error happened
     */
    public function renderHeader();

    /**
     * This method will render the Footer and return false if something went wrong (Logging the error).
     *
     * @return bool True in case everything went okay, false if an error happened
     */
    public function renderFooter();

    /**
     * @return bool This method will render the page and return false if something went wrong (Logging the error)
     */
    public function renderPage();
}

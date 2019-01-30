<?php
/**
 * Created by PhpStorm.
 * User: Volmar Machado <vmachado@sparefoot.com>
 * Date: 9/23/17
 * Time: 5:45 PM
 */

namespace App\Models;

/**
 * Class SoapClientFacade
 * @package App\Providers
 *
 * This class will provide SoapClient calls for all the application, so we have only
 * one place to care about on soap instantiation
 * also needed for loose decopling between classes
 */
use Illuminate\Support\Facades\Config;

class SoapClientFacade extends \SoapClient
{
    public function __construct($endpoint) {
            switch($endpoint) {
                case 'space':
                    parent::__construct(config('app.soap_api_url') . "/api/space?wsdl",
                        ['cache_wsdl' => WSDL_CACHE_NONE, 'trace' => false, 'exceptions' => true]);
                    break;
                case 'search':
                    parent::__construct(config('app.soap_api_url') . "/api/search?wsdl",
                        ['cache_wsdl' => WSDL_CACHE_NONE, 'trace' => false, 'exceptions' => true]);
                    break;
                case 'facility':
                    parent::__construct(config('app.soap_api_url') . "/api/facility?wsdl",
                        ['cache_wsdl' => WSDL_CACHE_NONE, 'trace' => false, 'exceptions' => true]);
            }
    }
}
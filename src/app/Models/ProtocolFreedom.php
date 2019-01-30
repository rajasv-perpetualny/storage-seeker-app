<?php
/**
 * Created by PhpStorm.
 * User: Volmar Machado <vmachado@sparefoot.com>
 * Date: 10/24/17
 * Time: 10:22 AM
 */

namespace App\Models;


trait ProtocolFreedom
{
    public function freeFromProtocol($protocoled)
    {
        return preg_replace('/http(s){0,1}:/', null, $protocoled);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Volmar Machado <vmachado@sparefoot.com>
 * Date: 8/7/17
 * Time: 11:56 AM
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use View;

class CityLandingMiddleware
{
    public function handle($request, Closure $next)
    {
        if($request->method() != 'POST'){
            $request->merge(['location'=>$request->segment(2)]);
        }
        return $next($request);
    }
}
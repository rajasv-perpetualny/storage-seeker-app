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

class DomainMiddleware
{
    public function handle($request, Closure $next)
    {
        View::getFinder()->prependLocation(resource_path('storageseeker/views'));
        Config::set('domain','storageseeker');
        return $next($request);
    }
}
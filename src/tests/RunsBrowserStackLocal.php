<?php
namespace Tests;
trait RunsBrowserStackLocal
{
    /**
     * @var Process
     */
    protected static $bsLocal;
    /**
     * Start BrowserStack Local
     */
    public static function startBrowserStackLocal()
    {
        $bsLocalArgs = array("key" => config('app.browserstack_key'));
        static::$bsLocal = new \BrowserStack\Local();
        static::$bsLocal->start($bsLocalArgs);;
        static::afterClass(function() {
            if(static::$bsLocal) static::$bsLocal->stop();
        });
    }
}
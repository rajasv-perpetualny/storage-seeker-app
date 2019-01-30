<?php

namespace App\Providers;

use App\Models\FeedService;
use App\Models\FeedModeler;
use Illuminate\Support\ServiceProvider;
use Illuminate\Container\Container;

class FeedServiceProvider extends ServiceProvider
{
    protected $defer = true;
    private $data;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->data = [];
    }

    /**
     * @return array
     */
    public function provides()
    {
        return [\App\Models\Feed::class, FeedService::class];
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Models\Feed::class, function($app, $params) {
            $result = Container::getInstance()->makeWith(\App\Models\FeedFacade::class,['endpoint' => 'search']);
            $articles = $result->getArticles($params['location']);
            return $articles;
        });

        $this->app->bind(\App\Console\FeedService::class, function($app, $params) {
            $xmlFeeds = (Container::getInstance()->make(\App\Models\RSSListener::class))->getFeeds();
            $modeledFeeds = new FeedModeler($xmlFeeds->item);
            return FeedService($modeledFeeds);
        });
    }

    public final function getArticles($result, $location)
    {
        $articles = array();
        $result = $result->searchArticles();
        if(property_exists($result, $location)) {
            $articles = $result->$location;
        }
        return $articles;
    }
}
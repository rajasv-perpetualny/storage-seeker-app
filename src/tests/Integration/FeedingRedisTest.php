<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 1/26/18
 * Time: 11:33 AM
 */

namespace Tests\Integration;

use Tests\TestCase;
use \App\Models\FeedModeler;
use \App\Console\FeedService;

class FeedingRedisTest extends TestCase
{
    public function createApplication()
    {
        $app = parent::createApplication();
        $app->bind(\App\Console\FeedService::class, function($app, $params) {
            $xmlFeeds = ($app->make(\App\Models\RSSListener::class))->getFeeds();
            $modeledFeeds = new FeedModeler($xmlFeeds->xpath('//item'));
            return new FeedService($modeledFeeds);
        });
        return $app;
    }

    public function testReceiveXmlAndSave() {
      $feed =  $this->app->make(\App\Console\FeedService::class);
      $this->assertInstanceOf(\App\Console\FeedService::class, $feed);
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 1/23/18
 * Time: 2:58 PM
 */

namespace Tests\Unit\module;


use App\Models\FeedModeler;

class FeedModelerTest extends \Tests\TestCase
{
    public function createApplication()
    {
        $app = parent::createApplication();
        $app->singleton(\App\Models\RSSListener::class, \Tests\Unit\Mock\RssListenerMock::class);
        $app->bind(\App\Models\FeedModeler::class, function($app, $params) {
            switch($params[0]) {
                case 'good' :
                $xmlFeeds = (new \Tests\Unit\Mock\RssListenerMock())->getFeeds();
                $modeledFeeds = new \App\Models\FeedModeler($xmlFeeds->xpath('//item'));
                return $modeledFeeds;
                case 'bad' :
                    $xmlFeeds = new \SimpleXMLElement("");
                    return $modeledFeeds = new \App\Models\FeedModeler($xmlFeeds->xpath('//item'));
            }
        });
        $app->bind(\App\Models\Feed::class, function($app, $params) {
            $result = $app->makeWith(\App\Models\FeedFacade::class,['endpoint' => 'search']);
            $articles = $result->getArticles($params['location']);
            return $articles;
        });
        return $app;
    }

    public function testIsValidClass() {
        $feedModeler = $this->app->makeWith(\App\Models\FeedModeler::class,['good']);
        $this->assertInstanceOf(FeedModeler::class, $feedModeler);
        $feeds = $feedModeler->getModeled();
        $this->assertNotEmpty($feeds);
        $this->assertNotEmpty($feeds[0]);
        $this->assertEquals("http://blog.storageseeker.com/me-south-portland/self-storage-rents-went-down-in-south-portland-over-the-past-week-october-24-2017",$feeds[0]->link);
    }

    public function testIsInvalidClass() {
        $this->expectException(\Exception::class);
        $feedModeler = $this->app->makeWith(\App\Models\FeedModeler::class,['bad']);
    }
}
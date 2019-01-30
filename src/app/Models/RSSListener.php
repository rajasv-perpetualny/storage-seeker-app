<?php
namespace App\Models;


class RSSListener
{
    private $feeds;
    public function __construct() {
        $this->feeds = simplexml_load_file('http://blog.storageseeker.com/feed');
    }

    public function getFeeds(): \SimpleXMLElement {
        return $this->feeds;
    }
}
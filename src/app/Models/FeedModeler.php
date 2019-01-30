<?php
namespace App\Models;

use Illuminate\Container\Container;

class FeedModeler
{
    private $modeled = [];
    public function __construct(array $feedList)
    {
        foreach($feedList as $idx => $feed) {
            $type = $this->getContentType($feed->category->__toString());
            $parts = $this->sluggify($feed->link->__toString());
            $lastIndex = count($parts)-1;

            if(empty($parts)){
                error_log('Couldn\'t sluggify link:' + $feed->title->__toString());
                continue;
            } else if($type == 'geo') {
                $slug = $parts[1];
            } else {
                $slug = $parts[$lastIndex];
            }
            $contentId = $parts[$lastIndex];
            $feedModel = Container::getInstance()->makeWith(Feed::class, ['location' => $contentId]);

            if(!$feedModel)
            {
                $ts = time();
                $description = str_replace(['"',"\n"], ['\'', ''], $feed->description->__toString());
                $record = "{\"contentId\": \"$contentId\", \"type\": \"$type\", \"title\": \"{$feed->title->__toString()}\", \"slug\": \"$slug\", \"description\": \"$description\", \"link\":\"{$feed->link->__toString()}\", \"ts\": \"$ts\"}";
                $this->modeled[] = json_decode($record);
            }
        }
    }

    public function sluggify(string $link): array
    {
        $url = parse_url($link, PHP_URL_PATH);;
        $parts = explode('/', $url);

        if(!empty($parts) && strlen($parts[1])) {
            return $parts;
        }
        return [];
    }

    public function getContentType(string $category) : string
    {
        $matches = preg_match('/[A-Za-z]{2}-[A-Za-z\-]+/', $category);
        if($matches) {
            return 'geo';
        }
        return 'info';
    }

    public function getModeled() {
        return $this->modeled;
    }
}
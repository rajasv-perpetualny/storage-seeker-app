<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 1/11/18
 * Time: 4:45 PM
 */

namespace App\Models;
use Redis;
use Cache;
use Illuminate\Database\Eloquent\Model;
use Exception;



class FeedFacade extends Model
{
    private $prefix = 'article';

    public function addArticle($data)
    {
        try {
            return Redis::hmset($this->getPrefix().':' . $data->contentId,
                [
                    'contentId' => $data->contentId,
                    'title' => $data->title,
                    'location' => $data->slug,
                    'description' => $data->description,
                    'link' => $data->link,
                    'ts' => $data->ts
                ]
            );
        } catch(Exception $e) {
            error_log($e->getMessage());
        }
    }

    public function saveArticles($articles)
    {
        if(is_array($articles)) {
           $count = array_reduce($articles, function($carry, $article) {
                $result = $this->addArticle($article);
                return ($result == true) + $carry;
            }, 0);
           return $count;
        }
        return false;
    }

    /**
     * Return an array with all keys storaged in Redis if $ids was passed by param, in other case
     * @param null|arary(integers) $ids
     * @return array
     */
    public function getKeysArticle($ids = null)
    {
        $keys = array();
        $prefix = $this->getPrefix();
        if(is_null($ids)) {
            try {
                $keys = Redis::keys($prefix.'*');
            } catch(Exception $e) {
                error_log($e->getMessage());
            }
        } else {
            foreach($ids as $id) {
                $keys[] = $prefix.':'.$id;
            }
        }
        return $keys;
    }

    /**
     * @param null|string $location
     * @return array
     * @example
     * <pre>
     * $feeds->getArticles();           // Return all elements existing in redis
     * $feeds->getArticles($location);  // Return all existing keys that match the pattern
     * </pre>
     */
    public function getArticles($location=null)
    {
        $articles = array();
        try {
            $keys = $this->getKeysArticle();
            foreach($keys as $key){
                $item = Redis::hgetall($key);
                if(is_null($location) || $item['location'] == $location){
                    $articles[] = $item;
                }
                unset($art);
            }
        } catch(Exception $e) {
            error_log($e->getMessage());
        }
        return $articles;
    }

    public function deleteArticles($key)
    {
        Redis::del($key);
    }

    public function truncateArticles($ids=null)
    {
        $keys = $this->getKeysArticle($ids);
        foreach($keys as $key){
            $this->deleteArticles($key);
        }
    }

    public function cleanAndSave($articles)
    {
        $this->truncateArticles();
        $this->saveArticles($articles);
    }

    /**
     * @return string
     */
    public function getPrefix(): string
    {
        return $this->prefix;
    }

    /**
     * @param string $prefix
     */
    public function setPrefix(string $prefix): void
    {
        $this->prefix = $prefix;
    }

    public function searchArticles(){
        $articles = json_decode(file_get_contents(resource_path('default/assets/js/cityarticles.json')));
        return $articles;
    }

}
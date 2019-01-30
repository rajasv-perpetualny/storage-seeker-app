<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 1/25/18
 * Time: 9:41 AM
 */

namespace Tests\Mock;


class RedisMock
{
    public function __construct()
    {
        $this->articles = [
            ["contentId" => 101, "type" => "ONE", "title" => "TITLE ca-san-diego 101", "location" => "ca-san-diego", "description" => "DESC DESC DESC DESC ca-san-diego 101", "link" => "http://test/101", "ts" => "1516734586"],
            ["contentId" => 102, "type" => "TWO", "title" => "TITLE ca-san-diego 102", "location" => "ca-san-diego", "description" => "DESC DESC DESC DESC ca-san-diego 102", "link" => "http://test/102", "ts" => "1516567498"],
            ["contentId" => 201, "type" => "ONE", "title" => "TITLE il-chicago 201", "location" => "il-chicago", "description" => "DESC DESC DESC DESC il-chicago 201", "link" => "http://test/201", "ts" => "1516734586"],
            ["contentId" => 202, "type" => "TWO", "title" => "TITLE il-chicago 202", "location" => "il-chicago", "description" => "DESC DESC DESC DESC il-chicago 202", "link" => "http://test/202", "ts" => "1516567498"],
        ];
    }

    public function  getArticles(){
            return $this->articles;
    }
}
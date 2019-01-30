<?php
/**
 * User: Fernando Curiel
 */

namespace Tests\Unit\module;
use \App\Models\FeedFacade;
use Psr\Log\NullLogger;


class FeedFacadeTest extends \Tests\TestCase
{
    protected $data = [];

    protected function setData($type = 'valid'){
        switch($type){
            case 'null':
                $this->data = null;
                break;
            case 'string':
                $this->data = 'TEST TEST TEST TEST TEST';
                break;
            case 'integer':
                $this->data = 666;
                break;
            case 'boolean':
                $this->data = FALSE;
                break;
            case 'array_01':
                $this->data = [
                    ["i001" => 101, "i002" => "ONE", "i003" => "TITLE", "i004" => "ca-san-diego", "i005" => "DESC", "i006" => "http://test/101", "i007" => "1516734586"],
                ];
                break;
            case 'array_02':
                $this->data = [
                    ["i001" => 101,             "i002" => "ONE",        "i003"  => "TITLE",         "i004" => "ca-san-diego",       "i005"        => "DESC",        "i006" => "http://test/101",        "i007" => "1516734586"],
            (object)["contentId" => 1402,       "type" => "TWO",        "title" => "TITLE",         "slug" => "ny-new-yor",         "description" => "DESC",        "link" => "http://test/1402",       "ts"   => "1516567498"],
            (object)["contentId" => 1501,       "type" => "ONE",        "title" => "TITLE",         "slug" => "tx-el-paso",         "description" => "DESC",        "link" => "http://test/1501",       "ts"   => "1516734586"],
            (object)["v001" => 1102,            "v002" => "TWO",        "v003"  => "TITLE",         "v004" => "tx-dallas",          "v005"        => "DESC",        "v006" => "http://test/1102",       "v007" => "1516567498"],
            (object)["contentId" => 1502,       "type" => "TWO",        "title" => "TITLE",         "slug" => "tx-el-paso",         "description" => "DESC",        "link" => "http://test/1502",       "ts"   => "1516567498"],
                    ["t01" => 1201,             "t02"  => "ONE",        "t03"   => "TITLE",         "t04"  => "co-denver",          "t05"         => "DESC",        "t06"  => "http://test/1201",       "t07"  => "1516734586"],
                    (object)["contentId" => 402,        "type" => "TWO",        "title" => "TITLE",         "slug" => "tx-plano",           "description" => "DESC",        "link" => "http://test/402",        "ts"   => "1516567498"],
                    ["contentId" => 1202,       "type" => "TWO",        "title" => "TITLE",         "XXXX" => "co-denver",          "description" => "DESC",        "link" => "http://test/1202",       "ts"   => "1516567498"],
            (object)["contentId" => 501,        "type" => "ONE",        "title" => "TITLE",         "slug" => "or-portland",        "description" => "DESC",        "link" => "http://test/501",        "ts"   => "1516734586"],
                ];
                break;
            case 'valid':
            default:
                $this->data = [
                    (object)["contentId" => 101, "type" => "ONE", "title" => str_repeat("TITLE ca-san-diego 101 ", 4), "slug" => "ca-san-diego", "description" => str_repeat("DESC  ca-san-diego 101 ", 100), "link" => "http://test/101", "ts" => "1516734586"],
                    (object)["contentId" => 102, "type" => "TWO", "title" => str_repeat("TITLE ca-san-diego 102 ", 4), "slug" => "ca-san-diego", "description" => str_repeat("DESC  ca-san-diego 102 ", 100), "link" => "http://test/102", "ts" => "1516567498"],
                    (object)["contentId" => 201, "type" => "ONE", "title" => str_repeat("TITLE il-chicago 201 ", 4), "slug" => "il-chicago", "description" => str_repeat("DESC  il-chicago 201 ", 100), "link" => "http://test/201", "ts" => "1516734586"],
                    (object)["contentId" => 202, "type" => "TWO", "title" => str_repeat("TITLE il-chicago 202 ", 4), "slug" => "il-chicago", "description" => str_repeat("DESC  il-chicago 202 ", 100), "link" => "http://test/202", "ts" => "1516567498"],
                    (object)["contentId" => 301, "type" => "ONE", "title" => str_repeat("TITLE ga-atlanta 301 ", 4), "slug" => "ga-atlanta", "description" => str_repeat("DESC  ga-atlanta 301 ", 100), "link" => "http://test/301", "ts" => "1516734586"],
                    (object)["contentId" => 302, "type" => "TWO", "title" => str_repeat("TITLE ga-atlanta 302 ", 4), "slug" => "ga-atlanta", "description" => str_repeat("DESC  ga-atlanta 302 ", 100), "link" => "http://test/302", "ts" => "1516567498"],
                    (object)["contentId" => 401, "type" => "ONE", "title" => str_repeat("TITLE tx-plano 401 ", 4), "slug" => "tx-plano", "description" => str_repeat("DESC  tx-plano 401 ", 100), "link" => "http://test/401", "ts" => "1516734586"],
                    (object)["contentId" => 402, "type" => "TWO", "title" => str_repeat("TITLE tx-plano 402 ", 4), "slug" => "tx-plano", "description" => str_repeat("DESC  tx-plano 402 ", 100), "link" => "http://test/402", "ts" => "1516567498"],
                    (object)["contentId" => 501, "type" => "ONE", "title" => str_repeat("TITLE or-portland 501 ", 4), "slug" => "or-portland", "description" => str_repeat("DESC  or-portland 501 ", 100), "link" => "http://test/501", "ts" => "1516734586"],
                    (object)["contentId" => 502, "type" => "TWO", "title" => str_repeat("TITLE or-portland 502 ", 4), "slug" => "or-portland", "description" => str_repeat("DESC  or-portland 502 ", 100), "link" => "http://test/502", "ts" => "1516567498"],
                    (object)["contentId" => 601, "type" => "ONE", "title" => str_repeat("TITLE az-phoenix 601 ", 4), "slug" => "az-phoenix", "description" => str_repeat("DESC  az-phoenix 601 ", 100), "link" => "http://test/601", "ts" => "1516734586"],
                    (object)["contentId" => 602, "type" => "TWO", "title" => str_repeat("TITLE az-phoenix 602 ", 4), "slug" => "az-phoenix", "description" => str_repeat("DESC  az-phoenix 602 ", 100), "link" => "http://test/602", "ts" => "1516567498"],
                    (object)["contentId" => 701, "type" => "ONE", "title" => str_repeat("TITLE ny-brooklyn 701 ", 4), "slug" => "ny-brooklyn", "description" => str_repeat("DESC  ny-brooklyn 701 ", 100), "link" => "http://test/701", "ts" => "1516734586"],
                    (object)["contentId" => 702, "type" => "TWO", "title" => str_repeat("TITLE ny-brooklyn 702 ", 4), "slug" => "ny-brooklyn", "description" => str_repeat("DESC  ny-brooklyn 702 ", 100), "link" => "http://test/702", "ts" => "1516567498"],
                    (object)["contentId" => 801, "type" => "ONE", "title" => str_repeat("TITLE nv-las-vegas 801 ", 4), "slug" => "nv-las-vegas", "description" => str_repeat("DESC  nv-las-vegas 801 ", 100), "link" => "http://test/801", "ts" => "1516734586"],
                    (object)["contentId" => 802, "type" => "TWO", "title" => str_repeat("TITLE nv-las-vegas 802 ", 4), "slug" => "nv-las-vegas", "description" => str_repeat("DESC  nv-las-vegas 802 ", 100), "link" => "http://test/802", "ts" => "1516567498"],
                    (object)["contentId" => 901, "type" => "ONE", "title" => str_repeat("TITLE ca-los-angeles 901 ", 4), "slug" => "ca-los-angeles", "description" => str_repeat("DESC  ca-los-angeles 901 ", 100), "link" => "http://test/901", "ts" => "1516734586"],
                    (object)["contentId" => 902, "type" => "TWO", "title" => str_repeat("TITLE ca-los-angeles 902 ", 4), "slug" => "ca-los-angeles", "description" => str_repeat("DESC  ca-los-angeles 902 ", 100), "link" => "http://test/902", "ts" => "1516567498"],
                    (object)["contentId" => 1001, "type" => "ONE", "title" => str_repeat("TITLE tx-austin 1001 ", 4), "slug" => "tx-austin", "description" => str_repeat("DESC  tx-austin 1001 ", 100), "link" => "http://test/1001", "ts" => "1516734586"],
                    (object)["contentId" => 1002, "type" => "TWO", "title" => str_repeat("TITLE tx-austin 1002 ", 4), "slug" => "tx-austin", "description" => str_repeat("DESC  tx-austin 1002 ", 100), "link" => "http://test/1002", "ts" => "1516567498"],
                    (object)["contentId" => 1101, "type" => "ONE", "title" => str_repeat("TITLE tx-dallas 1101 ", 4), "slug" => "tx-dallas", "description" => str_repeat("DESC  tx-dallas 1101 ", 100), "link" => "http://test/1101", "ts" => "1516734586"],
                    (object)["contentId" => 1102, "type" => "TWO", "title" => str_repeat("TITLE tx-dallas 1102 ", 4), "slug" => "tx-dallas", "description" => str_repeat("DESC  tx-dallas 1102 ", 100), "link" => "http://test/1102", "ts" => "1516567498"],
                    (object)["contentId" => 1201, "type" => "ONE", "title" => str_repeat("TITLE co-denver 1201 ", 4), "slug" => "co-denver", "description" => str_repeat("DESC  co-denver 1201 ", 100), "link" => "http://test/1201", "ts" => "1516734586"],
                    (object)["contentId" => 1202, "type" => "TWO", "title" => str_repeat("TITLE co-denver 1202 ", 4), "slug" => "co-denver", "description" => str_repeat("DESC  co-denver 1202 ", 100), "link" => "http://test/1202", "ts" => "1516567498"],
                    (object)["contentId" => 1301, "type" => "ONE", "title" => str_repeat("TITLE tx-houston 1301 ", 4), "slug" => "tx-houston", "description" => str_repeat("DESC  tx-houston 1301 ", 100), "link" => "http://test/1301", "ts" => "1516734586"],
                    (object)["contentId" => 1302, "type" => "TWO", "title" => str_repeat("TITLE tx-houston 1302 ", 4), "slug" => "tx-houston", "description" => str_repeat("DESC  tx-houston 1302 ", 100), "link" => "http://test/1302", "ts" => "1516567498"],
                    (object)["contentId" => 1401, "type" => "ONE", "title" => str_repeat("TITLE ny-new-yor 1401 ", 4), "slug" => "ny-new-yor", "description" => str_repeat("DESC  ny-new-yor 1401 ", 100), "link" => "http://test/1401", "ts" => "1516734586"],
                    (object)["contentId" => 1402, "type" => "TWO", "title" => str_repeat("TITLE ny-new-yor 1402 ", 4), "slug" => "ny-new-yor", "description" => str_repeat("DESC  ny-new-yor 1402 ", 100), "link" => "http://test/1402", "ts" => "1516567498"],
                    (object)["contentId" => 1501, "type" => "ONE", "title" => str_repeat("TITLE tx-el-paso 1501 ", 4), "slug" => "tx-el-paso", "description" => str_repeat("DESC  tx-el-paso 1501 ", 100), "link" => "http://test/1501", "ts" => "1516734586"],
                    (object)["contentId" => 1502, "type" => "TWO", "title" => str_repeat("TITLE tx-el-paso 1502 ", 4), "slug" => "tx-el-paso", "description" => str_repeat("DESC  tx-el-paso 1502 ", 100), "link" => "http://test/1502", "ts" => "1516567498"]
                ];
                break;
        }
    }

    protected function getData(){
        return $this->data;
    }

    public function createApplication()
    {
        $app = parent::createApplication();
        $app->singleton(Illuminate\Support\Facades\Redis::class, \Tests\Unit\Mock\RedisMock::class);
        return $app;
    }

    public function testFLow(){
        $this->setData();
        $feedFacade = $this->app->make(\App\Models\FeedFacade::class);
        $feedFacade->setPrefix('testarticles');

        $result = $feedFacade->saveArticles($this->getData());
        $this->assertEquals(true, $result);
        unset($result);

        $result = $feedFacade->getArticles();
        $this->assertCount(30, $result);
        unset($result);

        $result = $feedFacade->getArticles('ca-san-diego');
        $this->assertCount(2, $result);
        unset($result);

        $result = $feedFacade->getKeysArticle();
        $this->assertCount(30, $result);
        unset($result);

        $result = $feedFacade->getKeysArticle([101, 201, 402, 802, 902, 502, 701, 1201, 1501]);
        $this->assertCount(9, $result);
        unset($result);

        $feedFacade->truncateArticles([101, 201, 402, 802, 902, 502, 701, 1201, 1501]);
        $result = $feedFacade->getArticles();
        $this->assertCount(21, $result);
        unset($result);

        $feedFacade->truncateArticles();
        $result = $feedFacade->getArticles();
        $this->assertCount(0, $result);
        unset($result);
    }

    public function testCleanAndSave(){
        $this->setData();
        $feedFacade = $this->app->make(\App\Models\FeedFacade::class);
        $feedFacade->setPrefix('testarticles');
        $feedFacade->cleanAndSave($this->getData());

        $result = $feedFacade->getArticles();
        $this->assertCount(30, $result);

        $feedFacade->truncateArticles();
    }

    public function testSaveArticlesWithWrongData(){

        $feedFacade = $this->app->make(\App\Models\FeedFacade::class);
        $feedFacade->setPrefix('testarticles');
        $feedFacade->truncateArticles();

        $this->setData('null');
        $result = $feedFacade->saveArticles($this->getData());
        $this->assertFalse($result);

        $this->setData('string');
        $result = $feedFacade->saveArticles($this->getData());
        $this->assertFalse($result);

        $this->setData('integer');
        $result = $feedFacade->saveArticles($this->getData());
        $this->assertFalse($result);

        $this->setData('boolean');
        $result = $feedFacade->saveArticles($this->getData());
        $this->assertFalse($result);

        $this->setData('array_01');
        $result = $feedFacade->saveArticles($this->getData());
        $this->assertTrue(count($result)>=1);

        $this->setData('array_02');
        $result = $feedFacade->saveArticles($this->getData());
        $this->assertEquals(5, $result);

        $feedFacade->truncateArticles();
    }
}
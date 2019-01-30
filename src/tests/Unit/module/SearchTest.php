<?php
/**
 * Created by PhpStorm.
 * User: Volmar Machado <vmachado@sparefoot.com>
 * Date: 10/11/17
 * Time: 4:42 PM
 */

namespace Tests\Unit\module;

use App\Models\Search;

class SearchTest extends  \Tests\TestCase
{
    public function createApplication()
    {
        $app = parent::createApplication();
        $app->singleton(\App\Models\SoapClientFacade::class, \Tests\Unit\Mock\SoapClientMock::class);
        return $app;
    }

    public function testValidationSuccess()
    {
        $search = new Search($this->getSearchResult());
        $this->assertEquals(65, $search->searchResult->numHits);
    }

    public function testValidationFail()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('{"numHits":["The num hits must be a number."]}');
        $search = new Search($this->getInvalidSearchResult());
    }

    public function getSearchResult() {
        return (object) [
            'searchResult' => (object) [
                    'location' => 'Austin, TX',
                    'latitude' => 30.267,
                    'longitude' => -97.743,
                    'numHits' => 65,
                    'hitsPerPage' => 20,
                    'pageNumber' => 1,
                    'numPages' => 4,
                    'hasCoverage' => 1,
                    'listings' => [
                        0 => (object) [
                            "image" => "http://images.sparefoot.com/medium/2028245943e697358cf.jpg",
                        ]
                    ]
            ],
            'responseCode' => 1];
    }

    public function getInvalidSearchResult() {
        return (object) [
            'searchResult' => (object) [
                'location' => 'Austin, TX',
                'latitude' => 30.267,
                'longitude' => -97.743,
                'numHits' => '--\' DROP TABLE;',
                'hitsPerPage' => 20,
                'pageNumber' => 1,
                'numPages' => 4,
                'hasCoverage' => 1,
                'listings' => [0 => []]
            ],
            'responseCode' => 1];
    }
}
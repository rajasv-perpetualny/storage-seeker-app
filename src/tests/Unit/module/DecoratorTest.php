<?php

/**
 * Created by PhpStorm.
 * User: Volmar Machado <vmachado@sparefoot.com>
 * Date: 7/27/17
 * Time: 8:28 AM
 */
use PHPUnit\Framework\TestCase;
use App\Interfaces\modules\IDecorator;

class DecoratorTest extends TestCase
{
    public function testOutputHtml() {
        $response = [
            'item 1',
            'item 2',
            'item 3',
            'item 4'
        ];
        $decorator = new DecoratorHtmlStub($response);
        $this->assertEquals('<ul><li>item 1</li><li>item 2</li><li>item 3</li><li>item 4</li></ul>', $decorator->format());
    }

    public function testOutputJSON() {
        $response = [
            'item 1',
            'item 2',
            'item 3',
            'item 4'
        ];
        $decorator = new DecoratorJSONStub($response);
        $this->assertEquals('["item 1","item 2","item 3","item 4"]', $decorator->format());
    }
}

class DecoratorHtmlStub implements IDecorator {
    private $data;

    public function __construct($response) {
        $this->data = $response;
    }

    public function format()
    {
        $formatted =  '<ul>';

        foreach($this->data as $item) {
            $formatted .= "<li>${item}</li>";
        }

        $formatted .= '</ul>';

        return $formatted;
    }
}

class DecoratorJSONStub implements IDecorator {
    private $data;

    public function __construct($response) {
        $this->data = $response;
    }

    public function format()
    {
        return json_encode($this->data);
    }
}
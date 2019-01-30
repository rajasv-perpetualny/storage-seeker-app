<?php
/**
 * Created by PhpStorm.
 * User: Luis Abendaño <labendano@sparefoot.com>
 * Date: 7/26/17
 * Time: 11:38 AM.
 */
use PHPUnit\Framework\TestCase;
use App\Interfaces\IFactory;

class FactoryTest extends TestCase
{
    public function testLoadCss()
    {
        $factory = new FactoryStub();
        $this->assertEquals('loading Css...', $factory->getCss());
    }

    public function testLoadJs()
    {
        $factory = new FactoryStub();
        $this->assertEquals('JS loaded', $factory->getJs());
    }

    public function testCreateContent()
    {
        $factory = new FactoryStub();
        $this->assertEquals('content created', $factory->createContent());
    }
}

class FactoryStub implements IFactory
{
    public function getCss()
    {
        return 'loading Css...';
    }

    public function getJs()
    {
        return 'JS loaded';
    }

    public function createContent()
    {
        return 'content created';
    }
}

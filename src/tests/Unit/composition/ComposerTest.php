<?php
/**
 * Created by PhpStorm.
 * User: Luis Abendaño <labendano@sparefoot.com>
 * Date: 7/25/17
 * Time: 11:37 AM.
 */
use PHPUnit\Framework\TestCase;
use App\Interfaces\IComposer;

class ComposerTest extends TestCase
{
    private $render;
    private $layout;
    private $statistics;

    public function testRender()
    {
        $composer = new ComposerStub();
        $this->assertEquals('renderpage...', $composer->render());
    }

    public function testStatics()
    {
        $composer = new ComposerStub();
        $this->assertEquals('le statique :)', $composer->getStatics());
    }

    public function testModules()
    {
        $composer = new ComposerStub();
        $this->assertEquals('les unitModules :)', $composer->getModules());
    }
}

class ComposerStub implements IComposer
{
    public function render()
    {
        return 'renderpage...';
    }

    public function getStatics()
    {
        return 'le statique :)';
    }

    public function getModules()
    {
        return 'les unitModules :)';
    }

    public function loadCss()
    {
        // TODO: Implement loadCss() method.
    }

    public function loadJs()
    {
        // TODO: Implement loadJs() method.
    }

    public function renderHeader()
    {
        // TODO: Implement renderHeader() method.
    }

    public function renderFooter()
    {
        // TODO: Implement renderFooter() method.
    }

    public function renderPage()
    {
        // TODO: Implement renderPage() method.
    }
}

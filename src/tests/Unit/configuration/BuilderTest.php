<?php
/**
 * Created by PhpStorm.
 * User: Volmar Machado <vmachado@sparefoot.com>
 * Date: 7/25/17
 * Time: 11:44 AM.
 */
use PHPUnit\Framework\TestCase;
use App\Interfaces\configuration\IBuilder;

class BuilderTest extends TestCase
{
    public function testLoadStatic()
    {
        $module = $this->getMockBuilder('App\Interfaces\module\IModule')
            ->setMethods(['output'])->getMock();

        $built = new BuilderStub('Unit', IBuilder::STATIC_MODULE, $module);
        $this->assertInstanceOf(get_class($built), $built);
    }

    public function testLoadDynamic()
    {
        $module = $this->getMockBuilder('App\Interfaces\module\IModule')
            ->setMethods(['output'])->getMock();
        $built = new BuilderStub('Unit', IBuilder::DYNAMIC_MODULE, $module);
        $this->assertInstanceOf(get_class($built), $built);
    }
}

class BuilderStub implements IBuilder
{
    private $module;
    private $type;
    private $name;

    public function __construct($name, $type, $module)
    {
        $this->module = $module;
        $this->type = $type;
        $this->name = $name;
    }

    /**
     *  This method is a factory method that will decide to load a dynamic or a static module.
     *
     * @return \Sparefoot\storageseeker\app\Interfaces\configuration\Module
     */
    public function loadModule()
    {
        switch ($this->type) {
            case IBuilder::STATIC_MODULE:
                return $this->buildStatic();
            case IBuilder::DYNAMIC_MODULE:
                return $this->buildDynamic();
        }
    }

    /**
     * This method will build a dynamic module.
     *
     * @return \Sparefoot\storageseeker\app\Interfaces\configuration\Module
     */
    public function buildStatic()
    {
        return $this->module;
    }

    /**
     * This method will build a static module.
     *
     * @return \Sparefoot\storageseeker\app\Interfaces\configuration\Module
     */
    public function buildDynamic()
    {
        return $this->module;
    }
}

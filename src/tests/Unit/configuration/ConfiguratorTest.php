<?php
/**
 * Created by PhpStorm.
 * User: Volmar Machado <vmachado@sparefoot.com>
 * Date: 7/25/17
 * Time: 11:44 AM.
 */
use PHPUnit\Framework\TestCase;
use App\Interfaces\configuration\IConfigurator;

class ConfiguratorTest extends TestCase
{
    public function testLogoPath()
    {
        $builder = $this->getMockBuilder('App\Interfaces\configuration\IBuilder')
            ->setMethods(['loadModule','buildStatic','buildDynamic'])
            ->getMock();
        $configurator = new ConfiguratorStub('aaa', $builder);
        $this->assertEquals('skin/default/logo.png', $configurator->getLogoPath());
    }

    public function testLayout()
    {
        $builder = $this->getMockBuilder('App\Interfaces\configuration\IBuilder')
            ->setMethods(['loadModule','buildStatic','buildDynamic'])
            ->getMock();
        $configurator = new ConfiguratorStub('aaa', $builder);
        $this->assertEquals('<html></html>', $configurator->getLayout());
    }

    public function testModules()
    {
        $builder = $this->getMockBuilder('App\Interfaces\configuration\IBuilder')
            ->setMethods(['loadModule','buildStatic','buildDynamic'])
            ->getMock();
        $configurator = new ConfiguratorStub('aaa', $builder);
        $this->assertNotEmpty($configurator->getModules());
    }

    public function testMerge()
    {
        $builder = $this->getMockBuilder('App\Interfaces\configuration\IBuilder')
            ->setMethods(['loadModule','buildStatic','buildDynamic'])
            ->getMock();
        $configurator = new ConfiguratorStub('aaa', $builder);
        $this->assertEquals(
            json_decode('{"logo":"", "modules":{"Search":{}}}'),
            $configurator->mergeConfiguration('aaa')
        );
    }

    public function testValidModule()
    {
        $builder = $this->getMockBuilder('App\Interfaces\configuration\IBuilder')
            ->setMethods(['loadModule','buildStatic','buildDynamic'])
            ->getMock();
        $module = $this->getMockBuilder('App\Interfaces\module\IModule')
             ->setMethods(['output'])->getMock();

        $builder->expects($this->once())
             ->method('loadModule')
             ->will($this->returnValue($module));
        $configurator = new ConfiguratorStub('aaa', $builder);
        $modules = $configurator->getModules();
        //  die(var_export($unitModules));
        $this->assertNotEmpty($modules);
    }
}

class ConfiguratorStub implements IConfigurator
{
    private $config;
    private $modules = [];

    public function __construct($brand, $builder)
    {
        $this->config = $this->mergeConfiguration($brand);
        foreach ($this->config->modules as $module) {
            $this->modules = [$builder->loadModule($module)];
        }
    }

    public function getLogoPath()
    {
        return 'skin/default/logo.png';
    }

    public function getLayout()
    {
        return '<html></html>';
    }

    public function getModules()
    {
        return $this->modules;
    }

    public function mergeConfiguration($brand)
    {
        return json_decode('{"logo":"", "modules":{"Search":{}}}');
    }
}

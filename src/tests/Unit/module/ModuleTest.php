<?php
/**
 * Created by PhpStorm.
 * User: Volmar Machado <vmachado@sparefoot.com>
 * Date: 7/27/17
 * Time: 8:27 AM
 */
use PHPUnit\Framework\TestCase;
use App\Interfaces\modules\IModule;

class ModuleTest extends TestCase
{
    public function testMakeCall()
    {
        $request = $this->getMockBuilder('App\Interfaces\module\IRequest')->getMock();
        $soapStub = $this->getMockBuilder('\SoapClientas') //Intentional incorrect name
            // ->setConstructorArgs(['a.wsdl'])
            ->setMethods(['getDataFromEndpoint'])->getMock();
        $decoratorStub = $this->getMockBuilder('App\Interfaces\module\IDecorator')
            ->setMethods(['output'])->getMock();

        $soapStub->expects($this->once())
            ->method('getDataFromEndpoint')
            ->will($this->returnValue(json_decode('{"results": ["item 1","item 2","item 3", "item 4"]}')));

        $decoratorStub->expects($this->once())
            ->method('output')
            ->will($this->returnValue('<ul><li>item 1</li><li>item 2</li><li>item 3</li><li>item 4</li></ul>'));

        $module = new ModuleStub($request, $soapStub, $decoratorStub);
        $module->call();

       $this->assertEquals(json_decode('{"results": ["item 1","item 2","item 3", "item 4"]}'), $module->getModel());

        $this->assertEquals(
            '<ul><li>item 1</li><li>item 2</li><li>item 3</li><li>item 4</li></ul>',
            $module->output());
    }
}

class ModuleStub implements IModule {
    private $request;
    private $soapStub;
    private $response;
    private $decoratorStub;

    public function __construct($request, $soapStub, $decoratorStub)
    {
        $this->request = $request;
        $this->soapStub = $soapStub;
        $this->decoratorStub = $decoratorStub;
    }

    public function call() {
        $this->response = $this->soapStub->getDataFromEndpoint();
    }
    public function getModel() {
        return $this->response;
    }
    public function output() {
        return $this->decoratorStub->output();
    }

}

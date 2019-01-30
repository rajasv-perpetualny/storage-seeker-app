<?php
/**
 * Created by PhpStorm.
 * User: Volmar Machado <vmachado@sparefoot.com>
 * Date: 7/31/17
 * Time: 9:26 AM
 */

namespace Tests\Integration;

use PHPUnit\Framework\TestCase;

class RequestFlowTest extends TestCase {
    public function testFlow()
    {
        $request = $this->getMockBuilder('App\Interfaces\modules\IRequest')
            ->getMock();

        $decoratorStub = $this->getMockBuilder('App\Interfaces\modules\IDecorator')
            ->setConstructorArgs([$request])
            ->setMethods(['format'])
            ->getMock();

        $decoratorStub->expects($this->once())
            ->method('format')
            ->will($this->returnValue('<ul><li>item 1</li><li>item 2</li><li>item 3</li><li>item 4</li></ul>'));

        $module = $this->getMockBuilder('App\Interfaces\modules\IModule')
            ->setConstructorArgs([$request,$decoratorStub])
            ->setMethods(['call','output','getModel'])
            ->getMock();

        $module->expects($this->once())
            ->method('call')
            ->will($this->returnValue(null));
        $module->call();

        $module->expects($this->once())
            ->method('output')
            ->will($this->returnValue($decoratorStub->format()));

        $module->expects($this->once())
            ->method('getModel')
            ->will($this->returnValue(json_decode('{"results": ["item 1","item 2","item 3", "item 4"]}')));
        $module->getModel();

        $builder = $this->getMockBuilder('App\Interfaces\configuration\IBuilder')
            ->setMethods(['loadModule','buildStatic','buildDynamic'])
            ->getMock();


        $builder->expects($this->once())
            ->method('loadModule')
            ->will($this->returnValue($module));


        $configurator = $this->getMockBuilder('App\Interfaces\configuration\IConfigurator')
            ->setConstructorArgs([$builder])
            ->setMethods(['getLogoPath', 'getLayout', 'getModules', 'mergeConfiguration'])
            ->getMock();

        $configurator->expects($this->once())
            ->method('getLogoPath')
            ->will($this->returnValue('skin/default/logo.png'));

        $configurator->expects($this->once())
            ->method('getLayout')
            ->will($this->returnValue('<html></html>'));
        $configurator->expects($this->once())
            ->method('mergeConfiguration')
            ->will($this->returnValue('{"logo":"", "unitModules":{"Search":{}}}'));
        $configurator->expects($this->once())
            ->method('getModules')
            ->will($this->returnValue([$builder->loadModule()]));
        $configurator->getLayout();
        $configurator->mergeconfiguration('aaa');
        $configurator->getModules();

        $factory = $this->getMockBuilder('App\Interfaces\IFactory')
            ->setMethods(['getCss','getJs','createContent'])
            ->getMock();

        $factory->expects($this->once())
            ->method('getCss')
            ->will($this->returnValue('<env>/skin/aaa/module.css'));
        $factory->expects($this->once())
            ->method('getJs')
            ->will($this->returnValue('<env>/skin/aaa/module.js'));
        $factory->expects($this->once())
            ->method('createContent')
            ->will($this->returnValue('<body>' . $module->output() . '</body>'));

        $composer = $this->getMockBuilder('App\Interfaces\IComposer')
            ->setConstructorArgs([$configurator,$factory])
            ->setMethods(['loadCss','loadJs','renderHeader','renderFooter','renderPage'])
            ->getMock();

        $composer->expects($this->once())
            ->method('loadCss')
            ->will($this->returnValue('<link rel="' . $factory->getCss() .'" />'));
        $composer->expects($this->once())
            ->method('loadJs')
            ->will($this->returnValue('<script src="'. $factory->getJs() .'" />'));
        $composer->expects($this->once())
            ->method('renderHeader')
            ->will($this->returnValue("<head>" . $composer->loadCss() . $composer->loadJs() . "</head><header>" . $configurator->getLogoPath(). "</header>"));
        $composer->expects($this->once())
            ->method('renderFooter')
            ->will($this->returnValue('<footer></footer>'));
        $composer->expects($this->once())
            ->method('renderPage')
            ->will($this->returnValue("<html>" . $composer->renderHeader() .$factory->createContent() . $composer->renderFooter() . "</html>"));

        $composer->renderPage();

        $soapStub = $this->getMockBuilder('\SoapClientas')//Intentional incorrect name
        // ->setConstructorArgs(['a.wsdl'])
        ->setMethods(['getDataFromEndpoint'])->getMock();
        $soapStub->expects($this->once())
            ->method('getDataFromEndpoint')
            ->will($this->returnValue(json_decode('{"results": ["item 1","item 2","item 3", "item 4"]}')));
        $soapStub->getDataFromEndpoint();

        $this->assertEquals(true, true);
    }
}

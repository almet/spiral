<?php

namespace spiral\framework\di\transformation\dumpers;

use spiral\framework\di\TestCase;
use spiral\framework\di\definition\DefaultSchema;
use \spiral\framework\di\definition\ServiceReferenceArgument;

/**
 * Test class for the Dot (graphviz format) dumper
 *
 * @author		Alexis Metaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */

class DotDumperTest extends TestCase
{

    /**
     * When an ampty schema is given, the dumper must return the right value
     */
	public function testEmptySchema()
	{
	    // empty schema
	    $schema = new DefaultSchema();
	    
	    $dumper = new DotDumper();
            $dumpedContent = $dumper->dump($schema);

            $expected =<<<'EOD'
digraph sc {
  ratio="compress"
  node [fontsize="11" fontname="Myriad" shape="record"];
  edge [fontsize="9" fontname="Myriad" color="grey" arrowhead="open" arrowsize="0.5"];

  node_spiral [label="Spiral Dependency \n Injection Schema", fillcolor="#ffffff", style="filled"]
}
EOD;
            $this->assertEquals($expected, $dumpedContent);
	}
	
	/**
	 * A schema representation of a service is a certain dot format string.
	 */
	public function testServiceOutput()
	{
            $schema = new DefaultSchema();
            $schema->addService($this->_getMockService('ClassA', 'service1'));

            $dumper = new DotDumper();
            $dumpedContent = $dumper->dump($schema);

            $this->assertContains('node_service_service1 [label = "service1\n ClassA", fillcolor="#9999ff", style="filled"];', $dumpedContent);
	}
	
	/**
	 * When a service relies on another service, check that the correct
         * output is generated
	 */
	public function testRelation()
	{
            $schema = new DefaultSchema();
            
            $constructor = $this->_getMockMethod('__construct');
            $argument = new ServiceReferenceArgument('service2');
            $constructor->addArgument($argument);

            $service1 = $this->_getMockService('ClassA', 'service1');
            $service1->addMethod($constructor);
            $service2 = $this->_getMockService('ClassA', 'service2');
            
            $schema->addService($service1);
            $schema->addService($service2);

            $dumper = new DotDumper();
            $dumpedContent = $dumper->dump($schema);
            $this->assertContains('node_service_service1 -> node_service_service2', $dumpedContent);
	}
}
?>

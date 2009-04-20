<?php
use spiral\core\di\schema\Schema_Default,
	spiral\core\di\schema\Service_Default,
	spiral\core\di\schema\Method_Default,
	spiral\core\di\schema\Method_Static,
	spiral\core\di\container\Container_Default,
	spiral\core\di\schema\SchemaFluent_Default;
	
require_once('../core/ini.php');
try{

	$mode = $_GET['mode'];
	$mode = (empty($mode))? 'hand' : $mode;
	
################################################################################
#		> Construct schema by hand
################################################################################
if ($mode == 'hand')
{
	// dynamic method
	$method = new Method_Default('__construct');
	$method->addArgument('arg1');
	$method->addArgument('arg2');

	// dynamic method
	$method2 = new Method_Default('myMethod');
	$method2->addArgument('arg3');
	$method2->addArgument('arg4');
	$method2->addArgument('arg5');	

	// static method
	$staticMethod = new Method_Default('myStaticMethod', 'spiral\tests\StaticClass');
	$staticMethod->addArgument('service', true);

	$service = new Service_Default('test','spiral\tests\ToInject');
	$service->registerMethod($method);
	$service->registerMethod($method2);
	$service->registerMethod($staticMethod);
	
	$service2 = new Service_Default('service', 'spiral\tests\Service');

	$schema = new Schema_Default();
	$schema->registerService($service);
	$schema->registerService($service2);
}
################################################################################
#		> Construct Schema automatically
################################################################################
elseif($mode == 'fluent')
{
	$fluent = new SchemaFluent_Default();
	$schema = 
	$fluent
		->registerService('test', 'spiral\tests\ToInject')
		    ->construct()->with('arg1', 'arg2')
		    ->call('myMethod')->with('arg3', 'arg4', 'arg5')
		    ->callStatic('spiral\tests\StaticClass', 'myStaticMethod')->withServices('service')
		->registerService('service', 'spiral\tests\Service')
		->getSchema();
}
################################################################################
#		> Display
################################################################################

	echo '<pre>';
	foreach($schema as $service){
		echo '## '.$service->getName()."\n";
		foreach($service as $method){
			echo ' - '.$method->getName().'(';
			foreach($method as $arg){
				if ($arg[1] == 'ARG_IS_SERVICE'){
					echo '##';
				}
				echo $arg[0].',';
			}
			echo ")\n"	;	
		}
	}
	$container = new Container_Default($schema);
	$container->test;
	echo '</pre>';

} catch(\spiral\core\Exception $e){
    $e->display();
}
?>

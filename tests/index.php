<?php
use spiral\core\di\schema\Schema_Default,
	spiral\core\di\schema\Service_Default,
	spiral\core\di\schema\Method_Default,
	spiral\core\di\schema\Method_Static,
	spiral\core\di\container\Container_Default,
	spiral\core\di\schema\SchemaFluent_Default,
	spiral\core\di\dumper\Dumper_Dot;
	
require_once('../core/ini.php');
try{

	$mode = $_GET['mode'];
	$mode = (empty($mode))? 'fluent' : $mode;
	
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
	$method2->addArgument(Schema_Default::ACTIVE_SERVICE);

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
			->construct()->withServices('anotherService')
			->call('testMethod')->withServices('youpi')
		->registerService('anotherService', 'spiral\tests\Service')
			->call('testMethod')->withServices('youpi')
		->registerService('youpi', 'spiral\tests\Youpi')
		->getSchema();
}
################################################################################
#		> Display
################################################################################

$dumper = new Dumper_Dot($schema);
$dump = $dumper->dump();
file_put_contents('di_schema.dot', $dump);
exec('dot -Tpng di_schema.dot > di_schema.png');
sleep(1);
echo '<img src="di_schema.png"/>';
echo '<pre>'.$dump.'</pre>';

################################################################################
#		> Build the schema
################################################################################

/*	$container = new Container_Default($schema);
	$container->test;
*/	

} catch(\spiral\core\Exception $e){
    $e->display();
}
?>

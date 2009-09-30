<?php
namespace Spiral\Framework\DI\Construction;

use \Spiral\Framework\DI\Construction;
use \Spiral\Framework\DI\Definition;

require_once('PHPUnit/Framework.php');

/**
 * Test the DI container default implementation : DefaultContainer
 * 
 * @author	Frédéric Sureau <frederic.sureau@gmail.com>
 */
class DefaultContainerTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * Container that will be tested.
	 * 
	 * The implementation concerned by this test case is DefaultContainer.
	 * 
	 * @var	\Spiral\Framework\DI\Construction\DefaultContainer
	 */
	protected $_container = null;
	
	/**
	 * Default Schema that will be tested
	 * 
	 * @return \Spiral\Framework\DI\Definition\Schema
	 */
	protected $_schema = null;
	
	/**
	 * Fill in the schema object and return it
	 * 
	 * @return \Spiral\Framework\DI\Definition\Schema
	 */
	protected function fillInSchema(){
		if ($this->_schema === null){
			$this->_schema = new Definition\DefaultSchema();
			
			//store service
			$store = new Definition\DefaultService('store', '\Spiral\Framework\DI\Fixtures\Store');
			$store->setConstructionStrategy(new Construction\DefaultServiceConstructionStrategy());

			// method1
			$storeMethod1 = new Definition\DefaultMethod('setName');
			$storeMethod1->setConstructionStrategy(new Construction\DefaultMethodConstructionStrategy());

			// method1 arg1
			$storeMethod1Arg1 = new Definition\DefaultArgument(null);
			$storeMethod1Arg1->setConstructionStrategy(new Construction\DefaultArgumentConstructionStrategy);
			$storeMethod1->addArgument($storeMethod1Arg1);
			
			$store->addMethod($storeMethod1);
			
			// callback
			$methodToCallbackForStore = new Definition\DefaultMethod('register', '\Spiral\Framework\DI\Fixtures\StoreRegister');
			$methodToCallbackForStore->setConstructionStrategy(new Construction\DefaultMethodConstructionStrategy());
			
			// callback arg
			$storeCallbackArg1 = new Definition\CurrentServiceArgument();
			$storeCallbackArg1->setConstructionStrategy(new Construction\CurrentServiceArgumentConstructionStrategy());
			
			$methodToCallbackForStore->addArgument($storeCallbackArg1);

			$storeCallback = new Definition\CallbackMethod('afterCreation', $methodToCallbackForStore);
			$storeCallback->setConstructionStrategy(new Construction\CallbackMethodConstructionStrategy());
			$store->addMethod($storeCallback);
			
			// add service to schema
			$this->_schema->addService($store);
			
			
			// musicStore service
			$musicStore = new Definition\InheritedService('musicStore', 'store', '\Spiral\Framework\DI\Fixtures\MusicStore');
			$musicStore->setConstructionStrategy(new Construction\InheritedServiceConstructionStrategy());
			
			// method1
			$musicStoreMethod1 = new Definition\DefaultMethod('addArtist');
			$musicStoreMethod1->setConstructionStrategy(new Construction\DefaultMethodConstructionStrategy());
			
			// method1 arg1
			$musicStoreMethod1Arg1 = new Definition\ServiceReferenceArgument('jamesBrown');
			$musicStoreMethod1Arg1->setConstructionStrategy(new Construction\ServiceReferenceArgumentConstructionStrategy());
			$musicStoreMethod1->addArgument($musicStoreMethod1Arg1);
			
			$musicStore->addMethod($musicStoreMethod1);
			
			// method2
			$musicStoreMethod2 = new Definition\DefaultMethod('setAlbumFinder');
			$musicStoreMethod2->setConstructionStrategy(new Construction\DefaultMethodConstructionStrategy());
			
			// method2 arg1
			$musicStoreMethod2Arg2 = new Definition\ServiceReferenceArgument('albumFinder');
			$musicStoreMethod2Arg2->setConstructionStrategy(new Construction\ServiceReferenceArgumentConstructionStrategy());
			$musicStoreMethod2->addArgument($musicStoreMethod2Arg2);
			
			$musicStore->addMethod($musicStoreMethod2);
			
			// method3
			$musicStoreMethod3 = new Definition\DefaultMethod('setArtistFinder');
			$musicStoreMethod3->setConstructionStrategy(new Construction\DefaultMethodConstructionStrategy());
			
			// method3 arg1
			$musicStoreMethod3Arg1 = new Definition\ServiceReferenceArgument('artistFinder');
			$musicStoreMethod3Arg1->setConstructionStrategy(new Construction\ServiceReferenceArgumentConstructionStrategy());
			$musicStoreMethod3->addArgument($musicStoreMethod3Arg1);
			
			$musicStore->addMethod($musicStoreMethod3);
			
			// method4
			$musicStoreMethod4 = new Definition\DefaultMethod('setSongFinder');
			$musicStoreMethod4->setConstructionStrategy(new Construction\DefaultMethodConstructionStrategy());
			
			// method4 arg1
			$musicStoreMethod4Arg1 = new Definition\ServiceReferenceArgument('songFinder');
			$musicStoreMethod4Arg1->setConstructionStrategy(new Construction\ServiceReferenceArgumentConstructionStrategy());
			$musicStoreMethod4->addArgument($musicStoreMethod4Arg1);
			
			$musicStore->addMethod($musicStoreMethod4);
			
			// add service to schema
			$this->_schema->addService($musicStore);
			
			// jamesBrown service
			$jamesBrown = new Definition\DefaultService('jamesBrown', '\Spiral\Framework\DI\Fixtures\Artist', 'singleton');
			$jamesBrown->setConstructionStrategy(new Construction\DefaultServiceConstructionStrategy());
			
			// constructor
			$jamesBrownConstructor = new Definition\DefaultMethod('__construct');
			$jamesBrownConstructor->setConstructionStrategy(new Construction\DefaultMethodConstructionStrategy());
			
			// constructor arg1
			$jamesBrownConstructorArg1 = new Definition\DefaultArgument('James');
			$jamesBrownConstructorArg1->setconstructionStrategy(new Construction\DefaultArgumentConstructionStrategy());
			$jamesBrownConstructor->addArgument($jamesBrownConstructorArg1);
			// constructor arg2
			$jamesBrownConstructorArg2 = new Definition\DefaultArgument('Brown');
			$jamesBrownConstructorArg2->setconstructionStrategy(new Construction\DefaultArgumentConstructionStrategy());
			$jamesBrownConstructor->addArgument($jamesBrownConstructorArg2);
			
			$jamesBrown->addMethod($jamesBrownConstructor);
			
			// method1
			$jamesBrownMethod1 = new Definition\DefaultMethod('setNickname');
			$jamesBrownMethod1->setConstructionStrategy(new Construction\DefaultMethodConstructionStrategy());
			
			// method1 arg1
			// arguments for resolve argument
			$jamesBrownMethod1Arg1Ref = new Definition\DefaultMethod('getElement');
			$jamesBrownMethod1Arg1Ref->setConstructionStrategy(new Construction\DefaultMethodConstructionStrategy());
			
			$jamesBrownMethod1Arg1Arg1 = new Definition\DefaultArgument('nickname');
			$jamesBrownMethod1Arg1Arg1->setConstructionStrategy(new Construction\DefaultArgumentConstructionStrategy());
			$jamesBrownMethod1Arg1Ref->addArgument($jamesBrownMethod1Arg1Arg1);
			
			$jamesBrownMethod1Arg1 = new Definition\UseReferenceArgument('jamesBrownInformation', $jamesBrownMethod1Arg1Ref);
			$jamesBrownMethod1Arg1->setConstructionStrategy(new Construction\UseReferenceArgumentConstructionStrategy());
			
			$jamesBrownMethod1->addArgument($jamesBrownMethodArg1);
			$jamesBrown->addMethod($jamesBrownMethod1);
			
			// method2
			$jamesBrownMethod2 = new Definition\DefaultMethod('setBirthdate');
			$jamesBrownMethod2->setConstructionStrategy(new Construction\DefaultMethodConstructionStrategy());
			
			// method2 arg1
			$jamesBrownMethod2Arg1Ref = new Definition\UseAttributeMethod('birthdate');
			$jamesBrownMethod2Arg1Ref->setConstructionStrategy(new Construction\UseAttributeMethodConstructionStrategy());
			
			$jamesBrownMethod2Arg1 = new Definition\UseReferenceArgument('jamesBrownInformation', $jamesBrownMethod2Arg1Ref);
			$jamesBrownMethod2Arg1->setconstructionStrategy(new Construction\UseReferenceArgumentConstructionStrategy());
			$jamesBrownMethod2->addArgument($jamesBrownMethod2Arg1);
			
			$jamesBrown->addMethod($jamesBrownMethod2);
			
			// method3
			$jamesBrownMethod3 = new Definition\DefaultMethod('setDiscography');
			$jamesBrownMethod3->setConstructionStrategy(new Construction\DefaultMethodConstructionStrategy());
			
			$jamesBrownMethod3arg1 = new Definition\ServiceReferenceArgument('discography');
			$jamesBrownMethod3arg1->setConstructionStrategy(new Construction\ServiceReferenceArgumentConstructionStrategy());
			
			$jamesBrownMethod3->addArgument($jamesBrownMethod3arg1);
			$jamesBrown->addMethod($jamesBrownMethod3);
			
			// callback
			
			$methodToCallbackForJamesBrown = new Definition\ServiceReferenceMethod('goldenMicrophone', 'say');
			$methodToCallbackForJamesBrown->setConstructionStrategy(new Construction\ServiceReferenceMethodConstructionStrategy());

			$jamesBrownCallback = new Definition\CallbackMethod('register', $methodToCallbackForJamesBrown, 'afterCreation');
			$jamesBrownCallback->setConstructionStrategy(new Construction\CallbackMethodConstructionStrategy());
			
			$jamesBrownCallbackArgument1 = new Definition\CurrentServiceArgument();
			$jamesBrownCallbackArgument1->setConstructionStrategy(new Construction\CurrentServiceArgumentConstructionStrategy());
			$methodToCallbackForJamesBrown->addArgument($jamesBrownCallbackArgument1);
			

			$jamesBrownCallbackArgument2 = new Definition\CurrentServiceArgument('I Feel Good !');
			$jamesBrownCallbackArgument2->setConstructionStrategy(new Construction\DefaultArgumentConstructionStrategy());
			$methodToCallbackForJamesBrown->addArgument($jamesBrownCallbackArgument2);
			$jamesBrown->addMethod($jamesBrownCallback);
			
			// add service to schema
			$this->_schema->addService($jamesBrown);
			
			// theGodfatherOfSoul service
			$theGodfatherOfSoul = new Definition\AliasService('theGodfatherOfSoul', 'jamesBrown');
			$theGodfatherOfSoul->setConstructionStrategy(new Construction\AliasServiceConstructionStrategy());
			// add service to schema
			$this->_schema->addService($theGodfatherOfSoul);
			
			// goldenMicrophone service
			$goldenMicrophone = new Definition\DefaultService('goldenMicrophone', '\Spiral\Framework\DI\Fixtures\GoldenMicrophone');
			$goldenMicrophone->setConstructionStrategy(new Construction\DefaultServiceConstructionStrategy());
			// add service to schema
			$this->_schema->addService($goldenMicrophone);
			
			// jamesBrownInformation service
			$jamesBrownInformation = new Definition\DefaultService('jamesBrownInformation', '\Spiral\Framework\DI\Fixtures\Collection');
			$jamesBrownInformation->setConstructionStrategy(new Construction\DefaultServiceConstructionStrategy());
			
			// method 1
			$jamesBrownInformationMethod1 = new Definition\DefaultMethod('setElement');
			$jamesBrownInformationMethod1->setConstructionStrategy(new Construction\DefaultMethodConstructionStrategy());
			
			// method1 arg1
			$jamesBrownInformationMethod1Arg1 = new Definition\DefaultArgument('nickname');
			$jamesBrownInformationMethod1Arg1->setConstructionStrategy(new Construction\DefaultArgumentConstructionStrategy());
			$jamesBrownInformationMethod1->addArgument($jamesBrownInformationMethod1Arg1);
			
			// method1 arg2
			$jamesBrownInformationMethod1Arg2 = new Definition\DefaultArgument('The Godfather Of Soul');
			$jamesBrownInformationMethod1Arg1->setConstructionStrategy(new Construction\DefaultArgumentConstructionStrategy());
			$jamesBrownInformationMethod1->addArgument($jamesBrownInformationMethod1Arg2);
			
			$jamesBrownInformation->addMethod($jamesBrownInformationMethod1);
			
			// method 2 (attribute)
			$jamesBrownInformationMethod2 = new Definition\AttributeMethod('birthdate', '1933-05-03');
			$jamesBrownInformationMethod2->setConstructionStrategy(new Construction\AttributeMethodConstructionStrategy());
			$jamesBrownInformation->addMethod($jamesBrownInformationMethod2);

			// add service to schema
			$this->_schema->addService($jamesBrownInformation);
			
			
		}
		$schema = $this->_schema;
		return $schema;
	}
	
	/**
	 * Set up the container to be tested.
	 *
	 * Initialize schema configuration to know the services contained by the container.
	 * 
	 * @return	Spiral\Framework\DI\Construction\Container
	 */
	public function setUp()
	{
		// Set up the container to be tested
		$this->_container = new Construction\DefaultContainer($this->fillInSchema());
		return $this->_container;
	}
	
	/**
	 * Test if the hasService() and __isset() method works well when the service exists.
	 *
	 * @return	void
	 */
	public function testHasExistingService()
	{
		$this->assertNotEquals($this->_container->getService('store'), null);
		$this->assertEquals(
			get_class($this->_container->getService('store')),
			get_class($this->_container->store));
		
	}
	
	/**
	 * Test if the hasService() and __isset() method works well when the service does not exist.
	 *
	 * @expectedException Spiral\Framework\DI\Definition\Exception\UnknownserviceException
	 * @return	void
	 */
	public function testHasUnknownService()
	{
		$this->_container->getService("unexistantService");
	}

	/**
	 * An exception had to be thrown when trying to register a non object shared
	 * service
	 *
	 * @expectedException Spiral\Framework\DI\Construction\Exception\InvalidSharedService
	 */
	public function testAddSharedServiceNotObject()
	{
		$this->_container->addSharedService('sharedService', 'test');
	}

	/**
	 * Check that everithing is going well when adding stdclass as shared service
	 */
	public function testAddSharedService(){
		$this->_container->addSharedService('test', new \stdClass());
	}

	public function testHasSharedService(){
		$this->_container->addSharedService('test', new \stdClass());
		$this->assertTrue($this->_container->hasSharedService('test'));
	}

	public function testGetSharedService(){
		$sharedService = new \stdClass();
		$this->_container->addSharedService('test', $sharedService);
		$this->assertEquals($sharedService, $this->_container->getSharedService('test'));
	}
}

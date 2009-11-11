<?php
namespace spiral\framework\di\construction;

use \spiral\framework\di\construction;
use \spiral\framework\di\definition;

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
	 * @var	\spiral\framework\di\construction\DefaultContainer
	 */
	protected $_container = null;
	
	/**
	 * Default Schema that will be tested
	 * 
	 * @return \spiral\framework\di\definition\Schema
	 */
	protected $_schema = null;
	
	/**
	 * Fill in the schema object and return it
	 * 
	 * @return \spiral\framework\di\definition\Schema
	 */
	protected function fillInSchema(){
		if ($this->_schema === null){
			$this->_schema = new definition\DefaultSchema();
			
			//store service
			$store = new definition\DefaultService('store', '\spiral\framework\di\fixtures\Store');
			$store->setConstructionStrategy(new construction\DefaultServiceConstructionStrategy());

			// method1
			$storeMethod1 = new definition\DefaultMethod('setName');
			$storeMethod1->setConstructionStrategy(new construction\DefaultMethodConstructionStrategy());

			// method1 arg1
			$storeMethod1Arg1 = new definition\DefaultArgument(null);
			$storeMethod1Arg1->setConstructionStrategy(new construction\DefaultArgumentConstructionStrategy);
			$storeMethod1->addArgument($storeMethod1Arg1);
			
			$store->addMethod($storeMethod1);
			
			// callback
			$methodToCallbackForStore = new definition\DefaultMethod('register', '\spiral\framework\di\fixtures\StoreRegister');
			$methodToCallbackForStore->setConstructionStrategy(new construction\DefaultMethodConstructionStrategy());
			
			// callback arg
			$storeCallbackArg1 = new definition\CurrentServiceArgument();
			$storeCallbackArg1->setConstructionStrategy(new construction\CurrentServiceArgumentConstructionStrategy());
			
			$methodToCallbackForStore->addArgument($storeCallbackArg1);

			$storeCallback = new definition\CallbackMethod('afterCreation', $methodToCallbackForStore);
			$storeCallback->setConstructionStrategy(new construction\CallbackMethodConstructionStrategy());
			$store->addMethod($storeCallback);
			
			// add service to schema
			$this->_schema->addService($store);
			
			
			// musicStore service
			$musicStore = new definition\InheritedService('musicStore', 'store', '\spiral\framework\di\fixtures\MusicStore');
			$musicStore->setConstructionStrategy(new construction\InheritedServiceConstructionStrategy());
			
			// method1
			$musicStoreMethod1 = new definition\DefaultMethod('addArtist');
			$musicStoreMethod1->setConstructionStrategy(new construction\DefaultMethodConstructionStrategy());
			
			// method1 arg1
			$musicStoreMethod1Arg1 = new definition\ServiceReferenceArgument('jamesBrown');
			$musicStoreMethod1Arg1->setConstructionStrategy(new construction\ServiceReferenceArgumentConstructionStrategy());
			$musicStoreMethod1->addArgument($musicStoreMethod1Arg1);
			
			$musicStore->addMethod($musicStoreMethod1);
			
			// method2
			$musicStoreMethod2 = new definition\DefaultMethod('setAlbumFinder');
			$musicStoreMethod2->setConstructionStrategy(new construction\DefaultMethodConstructionStrategy());
			
			// method2 arg1
			$musicStoreMethod2Arg2 = new definition\ServiceReferenceArgument('albumFinder');
			$musicStoreMethod2Arg2->setConstructionStrategy(new construction\ServiceReferenceArgumentConstructionStrategy());
			$musicStoreMethod2->addArgument($musicStoreMethod2Arg2);
			
			$musicStore->addMethod($musicStoreMethod2);
			
			// method3
			$musicStoreMethod3 = new definition\DefaultMethod('setArtistFinder');
			$musicStoreMethod3->setConstructionStrategy(new construction\DefaultMethodConstructionStrategy());
			
			// method3 arg1
			$musicStoreMethod3Arg1 = new definition\ServiceReferenceArgument('artistFinder');
			$musicStoreMethod3Arg1->setConstructionStrategy(new construction\ServiceReferenceArgumentConstructionStrategy());
			$musicStoreMethod3->addArgument($musicStoreMethod3Arg1);
			
			$musicStore->addMethod($musicStoreMethod3);
			
			// method4
			$musicStoreMethod4 = new definition\DefaultMethod('setSongFinder');
			$musicStoreMethod4->setConstructionStrategy(new construction\DefaultMethodConstructionStrategy());
			
			// method4 arg1
			$musicStoreMethod4Arg1 = new definition\ServiceReferenceArgument('songFinder');
			$musicStoreMethod4Arg1->setConstructionStrategy(new construction\ServiceReferenceArgumentConstructionStrategy());
			$musicStoreMethod4->addArgument($musicStoreMethod4Arg1);
			
			$musicStore->addMethod($musicStoreMethod4);
			
			// add service to schema
			$this->_schema->addService($musicStore);
			
			// jamesBrown service
			$jamesBrown = new definition\DefaultService('jamesBrown', '\spiral\framework\di\fixtures\Artist', 'singleton');
			$jamesBrown->setConstructionStrategy(new construction\DefaultServiceConstructionStrategy());
			
			// constructor
			$jamesBrownConstructor = new definition\DefaultMethod('__construct');
			$jamesBrownConstructor->setConstructionStrategy(new construction\DefaultMethodConstructionStrategy());
			
			// constructor arg1
			$jamesBrownConstructorArg1 = new definition\DefaultArgument('James');
			$jamesBrownConstructorArg1->setconstructionStrategy(new construction\DefaultArgumentConstructionStrategy());
			$jamesBrownConstructor->addArgument($jamesBrownConstructorArg1);
			// constructor arg2
			$jamesBrownConstructorArg2 = new definition\DefaultArgument('Brown');
			$jamesBrownConstructorArg2->setconstructionStrategy(new construction\DefaultArgumentConstructionStrategy());
			$jamesBrownConstructor->addArgument($jamesBrownConstructorArg2);
			
			$jamesBrown->addMethod($jamesBrownConstructor);
			
			// method1
			$jamesBrownMethod1 = new definition\DefaultMethod('setNickname');
			$jamesBrownMethod1->setConstructionStrategy(new construction\DefaultMethodConstructionStrategy());
			
			// method1 arg1
			// arguments for resolve argument
			$jamesBrownMethod1Arg1Ref = new definition\DefaultMethod('getElement');
			$jamesBrownMethod1Arg1Ref->setConstructionStrategy(new construction\DefaultMethodConstructionStrategy());
			
			$jamesBrownMethod1Arg1Arg1 = new definition\DefaultArgument('nickname');
			$jamesBrownMethod1Arg1Arg1->setConstructionStrategy(new construction\DefaultArgumentConstructionStrategy());
			$jamesBrownMethod1Arg1Ref->addArgument($jamesBrownMethod1Arg1Arg1);
			
			$jamesBrownMethod1Arg1 = new definition\UseReferenceArgument('jamesBrownInformation', $jamesBrownMethod1Arg1Ref);
			$jamesBrownMethod1Arg1->setConstructionStrategy(new construction\UseReferenceArgumentConstructionStrategy());
			
			$jamesBrownMethod1->addArgument($jamesBrownMethodArg1);
			$jamesBrown->addMethod($jamesBrownMethod1);
			
			// method2
			$jamesBrownMethod2 = new definition\DefaultMethod('setBirthdate');
			$jamesBrownMethod2->setConstructionStrategy(new construction\DefaultMethodConstructionStrategy());
			
			// method2 arg1
			$jamesBrownMethod2Arg1Ref = new definition\UseAttributeMethod('birthdate');
			$jamesBrownMethod2Arg1Ref->setConstructionStrategy(new construction\UseAttributeMethodConstructionStrategy());
			
			$jamesBrownMethod2Arg1 = new definition\UseReferenceArgument('jamesBrownInformation', $jamesBrownMethod2Arg1Ref);
			$jamesBrownMethod2Arg1->setconstructionStrategy(new construction\UseReferenceArgumentConstructionStrategy());
			$jamesBrownMethod2->addArgument($jamesBrownMethod2Arg1);
			
			$jamesBrown->addMethod($jamesBrownMethod2);
			
			// method3
			$jamesBrownMethod3 = new definition\DefaultMethod('setDiscography');
			$jamesBrownMethod3->setConstructionStrategy(new construction\DefaultMethodConstructionStrategy());
			
			$jamesBrownMethod3arg1 = new definition\ServiceReferenceArgument('discography');
			$jamesBrownMethod3arg1->setConstructionStrategy(new construction\ServiceReferenceArgumentConstructionStrategy());
			
			$jamesBrownMethod3->addArgument($jamesBrownMethod3arg1);
			$jamesBrown->addMethod($jamesBrownMethod3);
			
			// callback
			
			$methodToCallbackForJamesBrown = new definition\ServiceReferenceMethod('goldenMicrophone', 'say');
			$methodToCallbackForJamesBrown->setConstructionStrategy(new construction\ServiceReferenceMethodConstructionStrategy());

			$jamesBrownCallback = new definition\CallbackMethod('register', $methodToCallbackForJamesBrown, 'afterCreation');
			$jamesBrownCallback->setConstructionStrategy(new construction\CallbackMethodConstructionStrategy());
			
			$jamesBrownCallbackArgument1 = new definition\CurrentServiceArgument();
			$jamesBrownCallbackArgument1->setConstructionStrategy(new construction\CurrentServiceArgumentConstructionStrategy());
			$methodToCallbackForJamesBrown->addArgument($jamesBrownCallbackArgument1);
			

			$jamesBrownCallbackArgument2 = new definition\CurrentServiceArgument('I Feel Good !');
			$jamesBrownCallbackArgument2->setConstructionStrategy(new construction\DefaultArgumentConstructionStrategy());
			$methodToCallbackForJamesBrown->addArgument($jamesBrownCallbackArgument2);
			$jamesBrown->addMethod($jamesBrownCallback);
			
			// add service to schema
			$this->_schema->addService($jamesBrown);
			
			// theGodfatherOfSoul service
			$theGodfatherOfSoul = new definition\AliasService('theGodfatherOfSoul', 'jamesBrown');
			$theGodfatherOfSoul->setConstructionStrategy(new construction\AliasServiceConstructionStrategy());
			// add service to schema
			$this->_schema->addService($theGodfatherOfSoul);
			
			// goldenMicrophone service
			$goldenMicrophone = new definition\DefaultService('goldenMicrophone', '\spiral\framework\di\fixtures\GoldenMicrophone');
			$goldenMicrophone->setConstructionStrategy(new construction\DefaultServiceConstructionStrategy());
			// add service to schema
			$this->_schema->addService($goldenMicrophone);
			
			// jamesBrownInformation service
			$jamesBrownInformation = new definition\DefaultService('jamesBrownInformation', '\spiral\framework\di\fixtures\Collection');
			$jamesBrownInformation->setConstructionStrategy(new construction\DefaultServiceConstructionStrategy());
			
			// method 1
			$jamesBrownInformationMethod1 = new definition\DefaultMethod('setElement');
			$jamesBrownInformationMethod1->setConstructionStrategy(new construction\DefaultMethodConstructionStrategy());
			
			// method1 arg1
			$jamesBrownInformationMethod1Arg1 = new definition\DefaultArgument('nickname');
			$jamesBrownInformationMethod1Arg1->setConstructionStrategy(new construction\DefaultArgumentConstructionStrategy());
			$jamesBrownInformationMethod1->addArgument($jamesBrownInformationMethod1Arg1);
			
			// method1 arg2
			$jamesBrownInformationMethod1Arg2 = new definition\DefaultArgument('The Godfather Of Soul');
			$jamesBrownInformationMethod1Arg1->setConstructionStrategy(new construction\DefaultArgumentConstructionStrategy());
			$jamesBrownInformationMethod1->addArgument($jamesBrownInformationMethod1Arg2);
			
			$jamesBrownInformation->addMethod($jamesBrownInformationMethod1);
			
			// method 2 (attribute)
			$jamesBrownInformationMethod2 = new definition\AttributeMethod('birthdate', '1933-05-03');
			$jamesBrownInformationMethod2->setConstructionStrategy(new construction\AttributeMethodConstructionStrategy());
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
	 * @return	spiral\framework\di\construction\Container
	 */
	public function setUp()
	{
		// Set up the container to be tested
		$this->_container = new construction\DefaultContainer($this->fillInSchema());
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
	 * @expectedException spiral\framework\di\definition\Exception\UnknownserviceException
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
	 * @expectedException spiral\framework\di\construction\Exception\InvalidSharedService
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

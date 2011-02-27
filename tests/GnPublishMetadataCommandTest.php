<?php

/**
 * @package geonetwork
 * @subpackage tests
 */
class GnPublishMetadataCommandTest extends SapphireTest {

	/**
	 * Also uses SimpleNzctFixture in setUp()
	 */
	static $fixture_file = 'geonetwork/tests/GnGetUUIDOfRecordByIDCommandTest.yml';

	protected $controller = null;

	/**
	 * Initiate the controller and page classes and configure GeoNetwork service
	 * to use the mockup-controller for testing.
	 */
	function setUp() {
		parent::setUp();
		
		$url = Director::absoluteBaseURL() . 'GnPublishMetadataCommandTest_Controller';

		$page = $this->objFromFixture('RegisterDataPage', 'registerdatapage');
		$page->GeonetworkBaseURL  = $url;

		$this->controller = new CataloguePage_Controller($page);
		$this->controller->pushCurrent();
		
		//GetRecordsCommand::set_catalogue_url("/getrecords?usetestmanifest=1&flush=1");
		GnPublishMetadataCommand::set_api_url('/getrecords?usetestmanifest=1&flush=1');
		GnPublishMetadataCommand::set_require_auth(false);
	}

	/**
	 * Remove test controller from global controller-stack.
	 */
	function tearDown() {
		
		$this->controller->popCurrent();
		
		parent::tearDown();
	}

	/**
	 * Test the GnPublishMetadataCommand
	 *
	 */
	function testGnPublishMetadataCommand() {

		$data = array();
		$data['gnID'] = 1963;
		
		$cmd    = $this->controller->getCommand("GnPublishMetadata", $data);
		$result = $cmd->execute();
		
		$this->assertEquals($result,1963,'GnPublishMetadataCommand returned another ID. It should throw an exception instead.');
	}

	/**
	 * Test the GnPublishMetadataCommand with an unexpectes id
	 *
	 */
	function testGnPublishMetadataCommandWithUnexpectedId() {

		$data = array();
		$data['gnID'] = 2009;
		
		$cmd    = $this->controller->getCommand("GnPublishMetadata", $data);
		try{
			$result = $cmd->execute();
		}
		catch(GnPublishMetadataCommand_Exception $e){
			return;
		}
		
		$this->assertEquals(1,0,'GnPublishMetadataCommand has not thrown a "GeoNetwork publication has failed" exception');
	}
	/**
	 * Test the GnPublishMetadataCommand with 0 id
	 * which leads in a fake-response without an <id> tag
	* resulting in an exception
	 */
	function testGnPublishMetadataCommandWithNullId() {

		$data = array();
		$data['gnID'] = 1234;
		
		$cmd    = $this->controller->getCommand("GnPublishMetadata", $data);
		try{
			$result = $cmd->execute();
		}
		catch(GnPublishMetadataCommand_Exception $e){
			return;
		}
		$this->assertEquals(1,0,'GnPublishMetadataCommand has not thrown a "GeoNetwork ID for the new dataset has not been created" exception');
	}
	
}


/**
 * @package geonetwork
 * @subpackage tests
 *
 * Mockup controller class to simulate the GeoNetwork side in this test.
 */
class GnPublishMetadataCommandTest_Controller extends Controller {

	/**
	 * Standard method, not in use.
	 */
	function index() {
		BasicAuth::disable();
		return "failed";
	}

	/**
	 * Returns the request body so that the calling unit test can perform the validation.
	 *
	 * @return string request body
	 */
	function getrecords($httprequest) {
		$paramid=$_POST['id'];
		$resp=$this->getResponse();
		$resp->addHeader("Content-Type","text/xml"); 
		// if id=0 was given we use this test to force an exception by omitting the <id> tag
		if($paramid == 1234) return "<?xml version=\"1.0\" encoding=\"UTF-8\"?><Failresponse></Failresponse>";
		return"<?xml version=\"1.0\" encoding=\"UTF-8\"?><response><id>1963</id></response>";
	}
}

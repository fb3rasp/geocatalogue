<?php

/**
 * @package geonetwork
 * @subpackage tests
 */
class GnGetUUIDOfRecordByIDCommandTest extends SapphireTest {

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
		
		$url = Director::absoluteBaseURL() . 'GnGetUUIDOfRecordByIDCommandTest_Controller';

		$page = $this->objFromFixture('RegisterDataPage', 'registerdatapage');
		$page->GeonetworkBaseURL  = $url;

		$this->controller = new CataloguePage_Controller($page);
		$this->controller->pushCurrent();
		
		//GetRecordsCommand::set_catalogue_url("/getrecords?usetestmanifest=1&flush=1");
		GnGetUUIDOfRecordByIDCommand::set_api_url('/getrecords?usetestmanifest=1&flush=1&');
		GnGetUUIDOfRecordByIDCommand::set_require_auth(false);
	}

	/**
	 * Remove test controller from global controller-stack.
	 */
	function tearDown() {
		
		$this->controller->popCurrent();
		
		parent::tearDown();
	}

	/**
	 * Test the testGetRecordsInISOCommand
	 *
	 * Test the testGetRecordsInISOCommand. The test controller GetRecordsCommandTest_Controller
	 * expects a certain request and returns ok or failed.
	 *
	 * This test tests the cswGetRecordsSummaryISO_xml template only.
	 *
	 * @see GetRecordsCommand
	 * @see GetRecordsCommandTest_Controller
	 */
	function testGnGetUUIDOfRecordByIDCommand() {

		$data = array();
		$data['gnID'] = 1963;
		
		$cmd    = $this->controller->getCommand("GnGetUUIDOfRecordByID", $data);
		$result = $cmd->execute();
		
		$this->assertEquals($result,'0587e442-eaee-470d-a0d1-3e3a54cc983b','Invalid UUID. ');
	}
	
}


/**
 * @package geonetwork
 * @subpackage tests
 *
 * Mockup controller class to simulate the GeoNetwork side in this test.
 */
class GnGetUUIDOfRecordByIDCommandTest_Controller extends Controller {

		static $ISO19139response='<?xml version="1.0" encoding="UTF-8"?>
					    <gmd:MD_Metadata xmlns:gmd="http://www.isotc211.org/2005/gmd" xmlns:gml="http://www.opengis.net/gml" xmlns:gts="http://www.isotc211.org/2005/gts" xmlns:gco="http://www.isotc211.org/2005/gco" xmlns:geonet="http://www.fao.org/geonetwork">
					      <gmd:fileIdentifier>
					        <gco:CharacterString xmlns:srv="http://www.isotc211.org/2005/srv" xmlns:gmx="http://www.isotc211.org/2005/gmx">0587e442-eaee-470d-a0d1-3e3a54cc983b</gco:CharacterString>
					      </gmd:fileIdentifier>
					    </gmd:MD_Metadata>
';	

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
	function getrecords($params) {
		
		//check id we got a paramerter id=1963
		if(isset($params['id'])){
			if($params['id'] == 1963){
				$resp=$this->getResponse();
				$resp->addHeader("Content-Type","text/xml"); 
				return self::$ISO19139response;
			}
			else{
				return "Parameter id is(". $params['id'] .") should be 1963";
			}
		}
		else{
			return "Parameter id not found";
		}

	}
}

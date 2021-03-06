<?php
/**
 * @author Rainer Spittel (rainer at silverstripe dot com)
 * @package geonetwork
 * @subpackage commands
 */

/**
 * Retrieve the full metadata record of a specific record from the GeoNetwork node.
 *
 * This command sends a request to the GeoNetwork node to retrieve a single metadata 
 * record. It returns a XML string which is the plain XML catalogue response.
 */
class  GnGetUUIDOfRecordByIDCommand extends ControllerCommand {

	/**
	 * @var string $api_url refers the the GeoNetwork action to perform the publish process.
	 */
	static $api_url = '/srv/en/xml.metadata.get?';
	
	static $RequireAuth = true;

	static function get_require_auth() {
		return self::$RequireAuth;
	}
	
	static function set_require_auth( $value ) {
		self::$RequireAuth = $value ? true : false;
	}
	static function get_api_url() {
		return self::$api_url;
	}
	
	static function set_api_url( $value ) {
		self::$api_url = $value;
	}

	
	/**
	 * Command execute
	 *
	 * Performs the command to retrieve a single metadata record. This command creates a 
	 * request (initiates a sub-command) and uses this to send of the 
	 * OGC request to GeoNetwork.
	 *
	 * @see CreateRecordByIdRequestCommand
	 *
	 * @return string OGC CSW response
	 */
	public function execute() {
		$data       = $this->getParameters();
		
		$id = $data['gnID'];
		
		try {
			$this->restfulService = new GeoNetworkRestfulService($this->getController()->getGeoNetworkBaseURL(),0);
			$this->restfulService->setRequireAuthentication($this->get_require_auth());
		}
		catch (CataloguePage_Exception $e) {
			throw new GnGetUUIDOfRecordByIDCommand_Exception($e->getMessage());
		}
		
		// generate GeoNetwork HTTP request (query metadata).
		$cmd = null;

		// insert metadata into GeoNetwork
		$headers = array('Content-Type: application/x-www-form-urlencoded');

		$response    = $this->restfulService->request($this->get_api_url()."id=".$id,'GET', null, $headers);	

		// @todo better error handling
		$responseXML = $response->getBody();

		// parse catalogue response
		$data = array(
			'xml' => $responseXML,
			'xsl' => '../geonetwork/xslt/gnParseUUID.xsl'
		);

		$cmd = $this->getController()->getCommand("ParseXML", $data);
		$result = $cmd->execute();

		// render metadata data-structure
		$SearchRecord = $result->__get('Items');
		
		if ($SearchRecord->TotalItems() != 1) {
			throw new GnGetUUIDOfRecordByIDCommand_Exception('Unexpected GeoNetwork response. Can not locate or identify the UUID of the provided dataset.');
		}
		$metadata = $SearchRecord->First();
		
		$uuid = $metadata->fileIdentifier;
		return $uuid;		
	}
	
}

/**
 * Customised excpetion class
 */
class GnGetUUIDOfRecordByIDCommand_Exception extends Exception {}

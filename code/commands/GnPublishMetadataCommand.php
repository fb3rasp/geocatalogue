<?php
/**
 * @author Rainer Spittel (rainer at silverstripe dot com)
 * @package geonetwork
 * @subpackage commands
 */

/**
 * Perform a insert request to a GeoNetwork node.
 */
class GnPublishMetadataCommand extends ControllerCommand {

	/**
	 * @var string $api_url refers the the GeoNetwork action to perform the publish process.
	 */
	static $api_url = '/srv/en/metadata.admin';
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
	 * Performs the command to insert/add new metadata. This command creates a 
	 * request (initiates a sub-command) and uses this to send of the 
	 * OGC request to GeoNetwork.
	 *
	 * @see CreateInsertCommand
	 *
	 * @return string OGC CSW response
	 */
	public function execute() {
		$data       = $this->getParameters();
		
		$gnID 		= $data['gnID'];
		try {
			$this->restfulService = new GeoNetworkRestfulService($this->getController()->getGeoNetworkBaseURL(),0);
			$this->restfulService->setRequireAuthentication($this->get_require_auth());
		}
		catch (CataloguePage_Exception $e) {
			throw new GnPublishMetadataCommand_Exception($e->getMessage());
		}
		
		// build the parameters for the publish request. It is a structure of
		// a geonetwork form to publish the data to non-registered users and 
		// allow the download of assigned data sources.
		$data = array();
		$data['id']       = $gnID;
		$data['_1_0']      = "on";
		$data['_1_1']      = "on";
		$params = GnCreateInsertCommand::implode_with_keys($data);

		$headers     = array('Content-Type: application/x-www-form-urlencoded');		
		$response    = $this->restfulService->request($this->get_api_url(),'POST',$params, $headers);	

		// @todo better error handling
		$responseXML = $response->getBody();

		// parse catalogue response
		$data = array(
			'xml' => $responseXML,
			'xsl' => '../geonetwork/xslt/gnInsertResponse.xsl',
		);

		$cmd = $this->getController()->getCommand("TranslateXML", $data);
		$xml = $cmd->execute();
	
		$id   = $gnID;
		$gnID = null;
		
		// toDo: bad! use JSON
		eval(trim($xml));
		
		if (!isset($gnID)) {
			throw new GnPublishMetadataCommand_Exception('GeoNetwork ID for the new dataset has not been created.');
		}
		
		if ($gnID != $id) {
			throw new GnPublishMetadataCommand_Exception('GeoNetwork publication has failed.');
		}
		return $gnID;		
	}

}

/**
 * Customised Exception class.
 */
class GnPublishMetadataCommand_Exception extends Exception {}


<?php
/**
 * @author Rainer Spittel (rainer at silverstripe dot com)
 * @package geonetwork
 * @subpackage commands
 */

/**
 * Perform a insert request to a GeoNetwork node.
 * 
 */
class GnInsertCommand extends ControllerCommand {

	static $api_url = '/srv/en/xml.metadata.insert';
	
	private $gnID = null;

	private $uuid = null;

	/**
	 * Returns the UUID of the new metadata record.
	 *
	 * @return string
	 */
	public function get_uuid() {
		return $this->uuid;
	}
	
	/**
	 * Returns the GeoNetwork internal ID of the new metadata record.
	 *
	 * @return int
	 */
	public function get_gnid() {
		return $this->gnID;
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
	 * @return int GeoNetwork internal ID
	 */
	public function execute() {
		
		$data       = $this->getParameters();
		
		try {
			$this->restfulService = new GeoNetworkRestfulService($this->getController()->getGeoNetworkBaseURL(),0);
			$this->restfulService->setRequireAuthentication(true);
		}
		catch (CataloguePage_Exception $e) {
			throw new GeonetworkInsertCommand_Exception($e->getMessage());
		}
		
		// generate GeoNetwork HTTP request (query metadata).
		$cmd = null;

		$cmd = $this->getController()->getCommand("GnCreateInsert", $data);
		$params = $cmd->execute();

		// insert metadata into GeoNetwork
		$headers = array('Content-Type: application/x-www-form-urlencoded');

		$response    = $this->restfulService->request(self::$api_url,'POST',$params, $headers);	
		$responseXML = $response->getBody();
		
		// We expect a status code of 200 for the insert/getrecords and
		// getrecordsbyid requests.
		if ($response->getStatusCode() != 200) {
			throw new GeonetworkInsertCommand_Exception('HTTP request return following response code:'.$response->getStatusCode());
		}
		
		// because we use the Geonetwork API, the error message are returned as HTML page.
		if ( strpos($responseXML, "<html>" ) === 0 ) {
			throw new GeonetworkInsertCommand_Exception('GeoNetwork responded with an invalid HTML string.');
		}
		
		// parse catalogue response
		$data = array(
			'xml' => $responseXML,
			'xsl' => '../geonetwork/xslt/gnInsertResponse.xsl',
		);

		$cmd = $this->getController()->getCommand("TranslateXML", $data);
		$xml = $cmd->execute();
	
		$gnID = null;
		
		// toDo: bad! use JSON
		eval(trim($xml));
		
		if (!isset($gnID)) {
			throw new GeonetworkInsertCommand_Exception('GeoNetwork ID for the new dataset has not been created.');
		}

		// store gnid alongside with MDMetadata?

		// update metadata record and send an update to add the UUID to the record.
		$data         = $this->getParameters();
		$data['gnID'] = $gnID;
		
		$cmd = $this->getController()->getCommand("GnGetUUIDOfRecordByID", $data);
		$uuid = $cmd->execute();
		
		if (!isset($uuid)) {
			throw new GeonetworkInsertCommand_Exception("New metadata record has been created, but GeoNetwork can not provide the UUID for the new record."); 
		}
		
		$metadata = $data['MDMetadata'];
		$metadata->gnID           = $gnID;
		$metadata->fileIdentifier = $uuid;
		$metadata->write();
		
		// generate update GeoNetwork HTTP request (query metadata).
		$cmd = $this->getController()->getCommand("GnPublishMetadata", $data);
		$xml = $cmd->execute();
		
		$this->gnID = $gnID;
		$this->uuid = $uuid;
		
		// return the geonetwork id of the new entry.
		return $gnID;		
	}

}

/**
 * Customised Exception class.
 */
class GeonetworkInsertCommand_Exception extends Exception {}


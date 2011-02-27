<?php
/**
 * @author Rainer Spittel (rainer at silverstripe dot com)
 * @package geonetwork
 * @subpackage model
 * 
 * The MDContact Data object is used to model the ISO19139 MD-Contact XML
 * structure. 
 * This is not a full ISO19139 implementation, just a bare minimum to meet the 
 * business requirements.
 */
class MDContact extends MDDataObject {
	
	/**
	 * Data structure for MDContact
	 */
	static $db = array(		
		// CI_ResponsibleParty
		"MDIndividualName" => "Varchar",			// mandatory
		"MDOrganisationName" => "Varchar",			// mandatory
		"MDPositionName" => "Varchar",				// mandatory
	
		// CI_Telephone
		"MDVoice" => "Varchar",						// mandatory
		"MDFacsimile" => "Varchar",

		// CI_Address
		"MDDeliveryPoint" => "Varchar",
		"MDCity" => "Varchar",
		"MDAdministrativeArea" => "Varchar",
		"MDPostalCode" => "Varchar",
		"MDCountry" => "Varchar",
		"MDElectronicMailAddress" => "Varchar",		// mandatory
	);

	/**
	 * Data relationships for MDContact
	 */
	static $has_one = array(
		"MDMetadata" => "MDMetadata",
	);
	
}
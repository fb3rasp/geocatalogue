<?php
/**
 * @author Rainer Spittel (rainer at silverstripe dot com)
 * @package geonetwork
 * @subpackage model
 *
 * The MDMetadata class implements the core Metadata dataobject
 * to store ISO19139 metadata. This dataobject is used to render the search 
 * results onto the CataloguePage (@link CataloguePage) and for processing
 * a metadata registration (@link RegisterDataPage).
 *
 * ISO19139 is a OGC metadata standard and 'replaces/derives' from ISO19115. 
 * Other standards are:
 *  - ISO19119
 *  - DublinCore
 *  - MCP (derived version of ISO19115)
 */
class MDMetadata extends MDDataObject {
	
	/**
	 * Data Structure for ISO19139 mandatory core data fields
	 * @var array
	 */
	static $db = array(
		"gnID"			=> "Varchar",			// internal GeoNetwork ID
		"fileIdentifier" => "Varchar",						// mandatory
		"dateStamp" => "SSDatetime",						// mandatory

		"metadataStandardName" => "Varchar",
		"metadataStandardVersion" => "Varchar",
		
		"MDTitle" => "Varchar",								// mandatory
		"MDAbstract" => "Varchar",							// mandatory
		"MDPurpose" => "Varchar",
		"MDLanguage" => "Varchar",							// mandatory
		"MDDateTime" => "SSDatetime",						// mandatory
		"MDDateType" => "Varchar",							// mandatory
		"MDEdition" => "Varchar",
		"MDPresentationForm" => "Varchar",
		"MDTopicCategory" => "Varchar",						// mandatory

		"MDSpatialRepresentationType" => "Varchar",			// enhanced
		"MDGeographicDiscription" => "Varchar",				// mandatory

		"MDWestBound" => "Double",							// mandatory
		"MDEastBound" => "Double",							// mandatory
		"MDSouthBound" => "Double",							// mandatory
		"MDNorthBound" => "Double",							// mandatory
	);

	static $summary_fields = array(
		"fileIdentifier" => "ID",
		"MDTitle" => "Title",
		"MDAbstract" => "Abstract",
	    "MDGeographicDiscription" => "GeographicDiscription",
	);
	
	/**
	 * Relationship to other data-objects. Implement a semi ISO19139 
	 * implementation recommondation.
	 * @var array
	 */ 
	static $has_many = array(
		"MDContacts" => "MDContact",
		"PointOfContacts" => "MDContact",
		"MDKeywords" => "MDKeyword",
		"MDResourceConstraints" => "MDResourceConstraint",
		"MDResourceFormats" => "MDResourceFormat",
		"CIOnlineResources" => "CIOnlineResource",
		"MCPMDCreativeCommons" => "MCPMDCreativeCommons"
	);

	/**
	 * Returns the nice, human readable string for MDDateTime. Without the
	 * validation (if the date instance is a SSDateTime object), you will get
	 * a default 01/01/1970 date when the user hasn't entered a date.
	 *
	 * @return string
	 */
	public function getDateTimeNice() {
		$date = $this->MDDateTime;
		if (!is_a($date, "SS_DateTime")) {
			if($date == '') return MDCodeTypes::$default_for_null_value;
			//should be YYYY-MM-DD hh:mm:ss
			//Take the date-part, explode YYYY MM DD, reverse them, and out them togater with slashes
			//And retrun the result
			return implode("/",array_reverse(explode("-",substr($date,0,10))));
		}
		return $date->Nice();
	}

	public function CIOnlineResources_WebAddresses() {
		return $this->getFilteredCIOnlineResources( array('WWW:LINK-1.0-http--link'));
	}
	
	public function MetadataCIOnlineResources() {
		return $this->getFilteredCIOnlineResources( array('WWW:LINK-1.0-http--metadata-URL'));
	}
	
	/**
	 * Returns all CIOnlineResources objects of this metadata record which
	 * are web-addresses.
	 *
	 * @param $filter Array of protocol types you like to retrieve.
	 *
	 * @return DataObjectSet The components of the one-to-many relationship.
	 */
	public function getFilteredCIOnlineResources($filter = null) {
		// important: don't pass in the filter into the get-component 
		// method because it would try to get the data from the database
		// and would not use the memory/cached version.
		$resources = $this->getComponents('CIOnlineResources');
		$result = new DataObjectSet();

		$protocols = $filter;
		
		// if $filter is null, then get the default list, stored in 
		// CIOnlineResource.
		if ($protocols == null) {
			$protocols = CIOnlineResource::get_public_protocols();
		}
		
		if($resources) foreach($resources as $resource) {
			if ( in_array($resource->CIOnlineProtocol,$protocols) ) {
				if (isset($resource->CIOnlineLinkage) && $resource->CIOnlineLinkage != '') {
					$result->addWithoutWrite($resource);
				}
			}
		}		
		return $result;
	}

	/**
	 * Returns all CIOnlineResources objects of this metadata record which
	 * are web-addresses.
	 *
	 * @see RecordFull.ss
	 *
	 * @return DataObjectSet The components of the one-to-many relationship.
	 */
	public function CIOnlineResources_FirstWebAddress() {
		$result = $this->CIOnlineResources_WebAddresses();
		return $result->First();
	}

	/**
	 * Returns true if a web-address for this metadata exists. It is used by
	 * the RecordFull.ss template to determine if the web-address block need
	 * to be rendered.
	 *
	 * @see CIOnlineResources_FirstWebAddress
	 * @see RecordFull.ss
	 * @return boolean true if the metadata record has a web-address reference.
	 */
	public function CIOnlineResources_HasFirstWebAddress() {
		$result = $this->CIOnlineResources_WebAddresses();
		$item = $result->First();
		$retValue = true;

		if ($item == null) {
			$retValue = false;
		}
		return $retValue;
	}

	/**
	 * Returns the nice, human readable string for the codetype (defined by
	 * the OGC ISO standard).
	 *
	 * @return string
	 */
	public function getDateTypeNice() {
		$index = $this->MDDateType;
		$codeTypes = MDCodeTypes::get_date_types();
		return isset($codeTypes[$index]) ? $codeTypes[$index] : MDCodeTypes::$default_for_null_value;
	}

	/**
	 * Returns the nice, human readable string for the codetype (defined by
	 * the OGC ISO standard).
	 *
	 * @return string
	 */
	public function getTopicCategoryNice() {
		$index = $this->MDTopicCategory;
		$codeTypes = MDCodeTypes::get_categories();
		
		$response = MDCodeTypes::$default_for_null_value;
		if (isset($codeTypes[$index])) {
			if ($codeTypes[$index] != "(please select a category)") {
				$response = $codeTypes[$index];
			}
		}
		return $response;
	}

	/**
	 * Returns the nice, human readable string for the codetype (defined by
	 * the OGC ISO standard).
	 *
	 * @return string
	 */
	public function getSpatialRepresentationTypeNice() {
		$index = $this->MDSpatialRepresentationType;
		$codeTypes = MDCodeTypes::get_spatial_representation_type();
		
		return isset($codeTypes[$index]) ? $codeTypes[$index] : MDCodeTypes::$default_for_null_value;
	}

	/**
	 * Returns the nice, human readable string for the codetype (defined by
	 * the OGC ISO standard).
	 *
	 * @return string
	 */
	public function getPlaceName() {
		$index = $this->MDWestBound.";".$this->MDEastBound.";".$this->MDSouthBound.";".$this->MDNorthBound;
		
		$result = '';

		$codeTypes = MDCodeTypes::get_places();
		if (isset($codeTypes[$index])) $result = $codeTypes[$index];

		return $result;
	}

	/**
	 * This method loads a provided array into the data structure.
	 * It also creates dependencies, such as contact data objects
	 * and populate the values into those objects.
	 *
	 * @param $data array of db-values.
	 */
	public function loadData($data) {	
		
		if ($data == null) {
			return;
		}
		
		if (!is_array($data)) {
			return;
		}
				
		foreach($data as $k => $v) {
			// store data into this object (no ':" in the string)
			if(strpos($k,':') === false) {
				$this->$k =  Convert::xml2raw($v);
			} else {
				// A ':' is used as a namespace marker. It is used to 
				// create the related data objects, such as MDContacts.
				$relations = explode(':', $k);
				$fieldName = array_pop($relations);
				$relObj = $this;

				// iterate through the relationships. At the moment, this 
				// loading process just works for 1 level hierarchies. 
				foreach($relations as $relation) {
					
					if ($relation == 'PointOfContacts') {
						
						// load the sub-array into the MDContact object
						$item = new MDContact();
						$item->loadData($v);
						
						// add the new MDContect to the collection class of this
						// object.
						$relObj->PointOfContacts()->add($item);
					}
					if ($relation == 'MDContacts') {
						
						// load the sub-array into the MDContact object
						$item = new MDContact();
						$item->loadData($v);
						
						// add the new MDContect to the collection class of this
						// object.
						$relObj->MDContacts()->add($item);
					}
					if ($relation == 'MDResourceConstraints') {
						
						// load the sub-array into the MDContact object
						$item = new MDResourceConstraint();
						$item->loadData($v);
						
						// add the new MDContect to the collection class of this
						// object.
						$relObj->MDResourceConstraints()->add($item);
					}
					if ($relation == 'MDResourceFormats') {
						
						// load the sub-array into the MDContact object
						$item = new MDResourceFormat();
						$item->loadData($v);
						
						// add the new MDContect to the collection class of this
						// object.
						$relObj->MDResourceFormats()->add($item);
					}				
					if ($relation == 'MCPMDCreativeCommons') {
						if (is_array($v)) {
							foreach($v as $vitem) {
								// load the sub-array into the MDContact object
								$item = new MCPMDCreativeCommons();
								$item->loadData($vitem);

								// add the new MCPMDCreativeCommons to the collection class of this
								// object.
								$relObj->MCPMDCreativeCommons()->add($item);
							}
						}	
					}
					if ($relation == 'CIOnlineResources') {
						if (is_array($v)) {
							foreach($v as $vitem) {
								// load the sub-array into the MDContact object
								$item = new CIOnlineResource();
								$item->loadData($vitem);

								// add the new MDContect to the collection class of this
								// object.
								$relObj->CIOnlineResources()->add($item);
							}
						}	
					}
				}
			}
		}		
	}
}
<?php
/**
 * @author Rainer Spittel (rainer at silverstripe dot com)
 * @package geonetwork
 * @subpackage code
 */

/**
 * Browse Catalogue Page
 *
 * This page type is used to browse GeoNetwork data and visualise the results.
 * The {@see BrowsePage.ss} template is used to visualise the results. 
 */
class BrowsePage extends CataloguePage {
}


/**
 * Controller Class for Browse Catalogue Page
 *
 * Page controller class for Catalogue-Page (@link CataloguePage). The controller
 * class handles the requests and delegates the requests to the page instance
 * as well as to the available GeoNetwork node.
 */
class BrowsePage_Controller extends CataloguePage_Controller {

	/**
	 * Validate HTTP-Request parameter.
	 *
	 * BrowsePage customise the search capabilities and allows the 'empty' search.
	 *
	 * @param array $params http-request parameter
	 *
	 * @throws CataloguePage_Exception
	 */
	protected function validateRequest($params) {
	}
	
	/**
	 * Action: index 
	 * 
	 * Initialisation function that is run before any action on the 
	 * controller is called.
	 * Browse Page perform a empty search to populate the first results into 
	 * the page.
	 */
	public function index($data) {
		// perform a standard search, but the validation has been disabled to
		// enable an empty search on the metadata repository.
		$params = array();
		return $this->dogetrecords($params);	
		
	}
}

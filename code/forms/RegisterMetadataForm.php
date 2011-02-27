<?php
/**
 * @author Rainer Spittel (rainer at silverstripe dot com)
 * @package geonetwork
 * @subpackage code
 */

/**
 * Standard RegisterMetadataForm
 *
 * This class implements the standard registration form, which contains a mandatory
 * text fields to register metadata in MCP format (derived ISO19139 format).
 */
class RegisterMetadataForm extends Form {

	/**
	 * Initiate the standard Metadata catalogue search form. The 
	 * additional parameter $defaults defines the default values for the form.
	 * 
	 * @param Controller $controller The parent controller, necessary to create the appropriate form action tag.
	 * @param String $name The method on the controller that will return this form object.
	 * @param FieldSet $fields All of the fields in the form - a {@link FieldSet} of {@link FormField} objects.
	 * @param FieldSet $actions All of the action buttons in the form - a {@link FieldSet} of {@link FormAction} objects
	 * @param Validator $validator Override the default validator instance (Default: {@link RequiredFields})
	 */
	function __construct($controller, $name, FieldSet $fields = null, FieldSet $actions = null, $validator = null) {

		if(!$fields) {
			// Create fields
			
			//adding extra class for custom validation
			$title = new TextField('MDTitle',"TITLE"); 
			$title->addExtraClass("required");
			$fields = new FieldSet(
				new CompositeField (
		         $title,
		         new TextareaField('MDAbstract'),
		         new CalendarDateField('MDDateTime'),
		         new DropdownField('MDDateType','DateType',MDCodeTypes::get_date_types(),""),	// drop down
		         new DropdownField('MDTopicCategory','Category',MDCodeTypes::get_categories(),"")	// drop down
				),
				new CompositeField (
			         new DropdownField('MDSpatialRepresentationType','Spatial Representation Type',MDCodeTypes::get_spatial_representation_type(),""),	// drop down				
			         new TextField('MDGeographicDiscription','Geographic Description'),	// drop down				

			         new TextField('MDWestBound'),  // double
			         new TextField('MDEastBound'),  // double
			         new TextField('MDSouthBound'), // double
			         new TextField('MDNorthBound'), // double
			
			         new DropdownField('ISOPlaces','ISOPlaces',MDCodeTypes::get_places(),"170;180;-52.57806;-32.41472"),	// drop down				
			         new DropdownField('Places','Places',NewZealandPlaces::get_nzplaces(),"-141;160;-7;-90"),	// drop down				
			
		         	 new DropdownField('OffshoreIslands','NZ Offshore islands',NewZealandPlaces::get_nzoffshoreislands(),""),					// drop down
		         	 
					 new DropdownField('Dependencies','NZ Dependencies in the South West Pacific',NewZealandPlaces::get_nzdependencies(),""),					// drop down
		         	 
					 new DropdownField('Regions','Regions',NewZealandPlaces::get_nzregions(),""),					// drop down
		         	 new DropdownField('TAs','TAs',NewZealandPlaces::get_nzta(),"")									// drop down				
				),
				new CompositeField (
			         new TextField('MDIndividualName'),
			         new TextField('MDOrganisationName'),
			         new TextField('MDPositionName'),

					 new TextField('MDVoice'),
/*
			         new TextField('MDFacsimile'),
			         new TextField('MDDeliveryPoint'),
			         new TextField('MDCity'),
			         new TextField('MDAdministrativeArea'),
			         new TextField('MDPostalCode'),
			         new TextField('MDCountry'),
*/
			         new EmailField('MDElectronicMailAddress')
				),
				new CompositeField (
		         	new DropdownField('ResourceFormatsList','ResourceFormatsList',MDCodeTypes::get_resource_formats(),""),	// drop down				
	         	 	new TextField('MDResourceFormatName','MDResourceFormatName',""),	// drop down				
	         	 	new TextField('MDResourceFormatVersion','MDResourceFormatVersion',"")	// drop down				
				),
				new CompositeField (
	
		         	new TextField('CIOnlineLinkage','CIOnlineLinkage',""),				
	         	 	new DropdownField('CIOnlineProtocol','CIOnlineProtocol',MDCodeTypes::get_online_resource_protocol(),""),	// drop down				
	         	 	new TextField('CIOnlineName','CIOnlineName',""),		
	         	 	new TextField('CIOnlineDescription','CIOnlineDescription',""),				
	         	 	new DropdownField('CIOnlineFunction','CIOnlineFunction',MDCodeTypes::get_online_resource_function(),"")	// drop down				
				),
				new CompositeField (
		         	 new DropdownField('otherConstraints','Licence',MDCodeTypes::get_other_constraints(),"")	// drop down				
				)
			);
		}
		
		if(!$actions) {
	      $actions = new FieldSet(
	         new FormAction('doRegisterMetadata', 'Submit')
	    //     new FormAction('doDeleteMetadata', 'Delete')
	      );
		}
		
		if(!$validator){
			$validator = new RequiredFields( 
						//make sure that MDTitle and MDAbstract is filled and MDElectronicMailAddress is a valid email-address
			            'MDTitle', 'MDAbstract', 'MDElectronicMailAddress', 'MDIndividualName', 'MDOrganisationName'
			        );
		}
		
		$validator->setJavascriptValidationHandler('none');
		
		parent::__construct($controller, $name, $fields, $actions, $validator);
	}
	
	function forTemplate() {
		return $this->renderWith(array(
			$this->class,
			'Form'
		));
	}

}
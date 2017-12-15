<?php
App::uses('AppModel', 'Model');
	
class ProjectContact extends AppModel {
		public $name = 'ProjectContact';

		
	public $belongsTo = array(
		  
		 'BuilderContact' => array(
							'className'    => 'BuilderContact',
							'foreignKey'   => 'project_contact_builder_contact_id'
					),
		'Level' => array(
						'className'    => 'lookupBuilderContactLevel',
						'foreignKey' => false,
						'conditions' => 'BuilderContact.builder_contact_level = Level.id',
						
					),			
  		'PrimaryMobileCountry' => 	array(
				'className'    => 'LookupValueLeadsCountry',
				'foreignKey' => false,
				'conditions' => 'BuilderContact.builder_contact_mobile_country_code = PrimaryMobileCountry.id',
			),
		'SecondMobileCountry' => 	array(
				'className'    => 'LookupValueLeadsCountry',
				'foreignKey' => false,
				'conditions' => 'BuilderContact.builder_contact_secondary_mobile_country_code = SecondMobileCountry.id',
			),	
		'Project' => 	array(
				'className'    => 'Project',
				'fields' 	   => array('project_name'),	
				'foreignKey' => 'project_contact_project_id',
			),	
		'Builder' => 	array(
				'className'    => 'Builder',
				'fields' 	   => array('builder_name'),	
				'foreignKey' => 'project_contact_builder_id',
			),
		'ForCompany' => 	array(
				'className'    => 'LookupCompany',
				'foreignKey' => false,
				'conditions' => 'BuilderContact.builder_contact_company = ForCompany.id',
			),
			
		'ForCompanyCity' => 	array(
				'className'    => 'City',
				'fields' => array('id','city_name'),
				'foreignKey' => false,
				'conditions' => 'BuilderContact.builder_contact_company_city = ForCompanyCity.id',
			),		
			
		'Location' => 	array(
				'className'    => 'City',
				'fields' => array('id','city_name'),
				'foreignKey' => false,
				'conditions' => 'BuilderContact.builder_contact_location = Location.id',
			),	
				
		
		);	
	}
?>
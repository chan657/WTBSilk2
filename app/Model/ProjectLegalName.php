<?php
	App::uses('AppModel', 'Model');
	
class ProjectLegalName extends AppModel {
		public $name = 'ProjectLegalName';

		
	public $belongsTo = array(
		   

		'BuilderLegalName' => 	array(
				'className'    => 'BuilderLegalName',
				'foreignKey'   => 'project_legal_names_builder_legal_id'
			),			
	   'Project' => 	array(
				'className'    => 'Project',
				'fields' 	   => array('project_name'),	
				'foreignKey'   => 'project_legal_names_project_id'
			),
		'Builder' => 	array(
				'className'    => 'Builder',
				'fields' 	   => array('builder_name'),	
				'foreignKey'   => 'project_legal_names_builder_id'
			),		
	  'BuilderContact' => 	array(
				'className'    => 'BuilderContact',
				'foreignKey'   => false,
				'conditions'   => 'BuilderLegalName.builder_legal_names_contact_id = BuilderContact.id'	
			),
	'Location' => 	array(
				'className'    => 'City',
				'foreignKey'   => false,
				'conditions'   => 'BuilderLegalName.builder_legal_names_city_id = Location.id'	
			),			
		
		);	

	
}
?>
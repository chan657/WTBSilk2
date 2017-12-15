<?php
	App::uses('AppModel', 'Model');
	
class BuilderLegalName extends AppModel {
		public $name = 'BuilderLegalName';

		
	public $belongsTo = array(
		   

		'Builder' => 	array(
				'className'    => 'Builder',
				'fields' 	   => array('builder_name'),	
				'foreignKey'   => 'builder_legal_names_builder_id'
			),	
	   'BuilderContact' => 	array(
				'className'    => 'BuilderContact',
				'foreignKey'   => 'builder_legal_names_contact_id'
			),
			
		'Location' => 	array(
				'className'    => 'City',
				'foreignKey'   => 'builder_legal_names_city_id'
			),

		
		
		);	

	
}
?>
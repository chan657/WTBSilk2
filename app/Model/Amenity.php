<?php
	App::uses('AppModel', 'Model');
	
	class Amenity extends AppModel {
		var $name = 'Amenity';
		
		public $validate = array(
			'amenity_name' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'value required'
				)
			),		);
		
		public $belongsTo = array(
				'Project' => array(
				'fields' => array('project_name'),	
				'className' => 'Project',
				'foreignKey' => 'project_id'
			),
				'LookupValueAmenitie' => array(
				'className' => 'LookupValueAmenitie',
				'foreignKey' => 'amenity_id'
			)
		);	
		
	}
?>
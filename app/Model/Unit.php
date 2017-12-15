<?php
	App::uses('AppModel', 'Model');
	
	class Unit extends AppModel 
	{
		public $name = 'Unit';
		public $validate = array(
			'unit_name' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'please provide a unit name'
				)
			),
			
		);
		/*
		public $belongsTo = array(
					 'Project' => array(
				'className' => 'Project',
				'foreignKey' => 'project_id'
			)
					  );
					  */
		
	

		
	}
?>
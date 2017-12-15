<?php
	App::uses('AppModel', 'Model');
	
	class Suburb extends AppModel 
	{
		public $name = 'Suburb';
		public $validate = array(
			'suburb_name' => array(											
			'notempty' => array(									
				'rule' => array('notempty'),								
				'message' => 'Please enter suburb name',
				
			),
			
			'validChars' => array(
				'rule'    => '/^[a-zA-Z\s]+$/',
				'message' => 'Suburb should only contain letters.'
			),

			
			

			
		),

			
			
			'city_id' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'please provide a City name'
				)
			),
	);
		
		public $belongsTo = array(
			'City' => array(
			'className'    => 'City',
			'foreignKey'   => 'city_id'
		)
	);

		
	}
?>
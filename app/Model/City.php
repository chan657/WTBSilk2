<?php
	App::uses('AppModel', 'Model');
	
	class City extends AppModel {
		var $name = 'City';
		
		public $validate = array(
		'city_name' => array(											
			'notempty' => array(									
				'rule' => array('notempty'),								
				'message' => 'Please enter city name',
				
			),
			
			'validChars' => array(
				'rule'    => '/^[a-zA-Z\s]+$/',
				'message' => 'City should only contain letters.'
			),

			
			

			'isUnique' => array (
				'rule' => 'isUnique',
				'message' => 'This city already exists.'
				
			),

		)
	);
		
		
		
		
		public $hasMany = array(
				'Area' => array(
					'className'  => 'Area',
				)
		);
				
		
	}
?>
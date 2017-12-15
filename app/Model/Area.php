<?php
	App::uses('AppModel', 'Model');
	
	class Area extends AppModel 
	{
		public $validate = array(
			'area_name' => array(											
				'required' => array(									
					'rule' => array('notempty'),								
					'message' => 'Please enter area name',
					
				),
			),
			'city_id' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'please provide a City name'
				)
			),
			
			'suburb_id' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'please provide a Suburb name'
				)
			),
	);
		
		
		
	public $belongsTo = array(
			'Suburb' => array(
				'className'    => 'Suburb',
				'foreignKey'   => 'suburb_id'
			),
		
			'City'=>array(
				'className'=> 'City'
				)
		);

	}
?>
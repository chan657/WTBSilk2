<?php
	App::uses('AppModel', 'Model');
	
	class TravelHotelAmenitie extends AppModel {
		var $name = 'TravelHotelAmenitie';
/*		
		public $validate = array(
			'value' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'value required'
				)
			),		);
*/	
/*                
		public $belongsTo = array(
				'TravelHotelLookup' => array(
//				'fields' => array('hotel_name'),	
				'className' => 'TravelHotelLookup',
				'foreignKey' => 'hotel_id'
			),
				'TravelLookupAmenityType' => array(
				'className' => 'TravelLookupAmenityType',
				'foreignKey' => 'amenity_type_id'
			)
		);	
*/		
	}
?>
<?php
	App::uses('AppModel', 'Model');
	
	class TravelHotelAmenity extends AppModel {
		var $name = 'TravelHotelAmenity';
		
		public $validate = array(
			'value' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'value required'
				)
			),		);
		
		public $belongsTo = array(
				'TravelHotelLookup' => array(
//				'fields' => array('hotel_name'),	
				'className' => 'TravelHotelLookup',
				'foreignKey' => 'hotel_id'
			),
				'TravelLookupAmenityType' => array(
				'className' => 'LookupValueAmenitie',
				'foreignKey' => 'amenity_type_id'
			)
		);	
		
	}
?>
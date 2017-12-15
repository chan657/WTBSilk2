<?php
	App::uses('AppModel', 'Model');
	
	class TravelHotelReviewItem extends AppModel {
		var $name = 'TravelHotelReviewItem';
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
				'TravelLookupReviewTopic' => array(
				'className' => 'TravelLookupReviewTopic',
				'foreignKey' => 'review_topic_id'
			)
		);	
*/		
	}
?>
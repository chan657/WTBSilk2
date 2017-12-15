<?php
	App::uses('AppModel', 'Model');
	
	class TravelLookupReviewTopic extends AppModel { 
		var $name = 'TravelLookupReviewTopic';
		
		public $validate = array(
			'value' => array( 
             'rule' => '/^[a-zA-Z\s&-]+$/', 
             'message' => 'Names can only contain letters.',
             'allowEmpty' => false 
			
			),
			
		);
		
	}
?>
<?php
	App::uses('AppModel', 'Model');
	
	class TravelLookupAmenityCategorie extends AppModel {
		var $name = 'TravelLookupAmenityCategorie';
		
		public $validate = array( 
			'value' => array( 
             'rule' => '/^[a-zA-Z\s]+$/', 
             'message' => 'Names can only contain letters.', 
             'allowEmpty' => false 
			
			),
			
		);
		public $hasMany = array(   
        'Hotel_Amenity' => array(
                    'className' => 'TravelLookupAmenityType',
                    'foreignKey' => 'amenity_category_id',
		    'order' => 'value ASC',
                    ),
		
				);
		
				
		
	}
?>
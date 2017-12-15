<?php
	App::uses('AppModel', 'Model');
	
	class Group extends AppModel {
		var $name = 'Group';
		
		public $validate = array(
			'group_name' => array( 
             'rule' => '/^[a-zA-Z]+$/', 
             'message' => 'Names can only contain letters.', 
             'allowEmpty' => false 
			
			),
			
		);
		public $hasMany = array(   
        'Amnity' => array(
                    'className' => 'LookupValueAmenitie',
                    'foreignKey' => 'group_id',
		  
                    ),
		
				);
		
				
		
	}
?>
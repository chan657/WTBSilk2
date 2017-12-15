<?php
App::uses('AppModel', 'Model');


	
	class Remark extends AppModel {
           public $belongsTo = array(
            'Lead' => array(
                'className' => 'Lead',
                'foreignKey' => 'lead_id'
            ),
	    'Activity' => array(
	       'className' => 'Activity',
	       'foreignKey' => 'activity_id'
	    ),
	   
           );
	   	   
        }
?>
<?php
App::uses('AppModel', 'Model');
	
	class Activity extends AppModel {
           public $belongsTo = array(
            'Lead' => array(
                'className' => 'Lead',
                'foreignKey' => 'lead_id'
            )
           );
        }
?>
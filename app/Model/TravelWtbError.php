<?php

App::uses('AppModel', 'Model');

class TravelWtbError extends AppModel {

    public $name = 'TravelWtbError';

    public $belongsTo = array(
        'TravelLookupErrorTopic' => array(
            'className' => 'TravelLookupErrorTopic',            
            'foreignKey' => 'error_topic'
        ),
        'TravelLookupErrorStatus' => array(
            'className' => 'TravelLookupErrorStatus',            
            'foreignKey' => 'error_status'
        )
    );

}

?>
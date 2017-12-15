<?php

App::uses('AppModel', 'Model');

class DigPatternPerson extends AppModel {

    public $name = 'DigPatternPerson';
    public $belongsTo = array(
        'Channel' => array(
            'className' => 'Channel',
            'fields' => 'channel_name',
            'foreignKey' => 'channel_id'
        ),
        'DigPerson' => array(
            'className' => 'DigPerson',
            'fields' => 'person_name',
            'foreignKey' => 'person_id'
        ),
        'DigPattern' => array(
            'className' => 'DigPattern',
            'fields' => 'pattern_name',
            'foreignKey' => 'pattern_id'
        ),
    );

}

?>
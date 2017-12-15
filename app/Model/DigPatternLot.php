<?php

App::uses('AppModel', 'Model');

class DigPatternLot extends AppModel {

    public $name = 'DigPatternLot';
    public $belongsTo = array(
        'Channel' => array(
            'className' => 'Channel',
            'fields' => 'channel_name',
            'foreignKey' => 'channel_id'
        ),
        'DigLot' => array(
            'className' => 'DigLot',
            'fields' => 'lot_name',
            'foreignKey' => 'lot_id'
        ),
        'DigPattern' => array(
            'className' => 'DigPattern',
            'fields' => 'pattern_name',
            'foreignKey' => 'pattern_id'
        ),
    );

}

?>
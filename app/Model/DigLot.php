<?php

App::uses('AppModel', 'Model');

class DigLot extends AppModel {

    public $name = 'DigLot';
    public $belongsTo = array(
        'DigLotType' => array(
            'className' => 'DigLotType',
            'foreignKey' => 'lot_type'
        ),
        'DigBaseUsage' => array(
            'className' => 'DigBaseUsage',
            'foreignKey' => 'usage_status'
        ),
        'Channel' => array(
            'className' => 'Channel',
            'foreignKey' => 'lot_channel'
        ),
    );

}

?>
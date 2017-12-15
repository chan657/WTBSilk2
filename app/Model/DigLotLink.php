<?php

App::uses('AppModel', 'Model');

class DigLotLink extends AppModel {

    public $name = 'DigLotLink';
    
    public $belongsTo = array(
        'DigLot' => array(
            'className' => 'DigLot',
            'fields' => 'lot_name',
            'foreignKey' => 'lot_links_lot_id'
        ),
        'DigBase' => array(
            'fields' => 'base_website_url',
            'className' => 'DigBase',
            'foreignKey' => 'lot_links_base_id'
        ),
        'DigBaseUsage' => array(
            'className' => 'DigBaseUsage',
            'foreignKey' => 'lot_links_usage_status'
        ),
    );

}

?>
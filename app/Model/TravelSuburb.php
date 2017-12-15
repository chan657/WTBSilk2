<?php

App::uses('AppModel', 'Model');

class TravelSuburb extends AppModel {

    public $name = 'TravelSuburb';
    public $validate = array(
        'name' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Please enter suburb name',
            ),
        ),
    );
    public $belongsTo = array(
        'TravelCity' => array(
            'className' => 'TravelCity',
            'fields' => 'city_name',
            'foreignKey' => 'city_id'
        ),
        'TravelCountry' => array(
            'className' => 'TravelCountry',
            'fields' => 'country_name',
            'foreignKey' => 'country_id'
        )
    );

}

?>
<?php

App::uses('AppModel', 'Model');

class Province extends AppModel {

    public $name = 'Province';
    
    public $belongsTo = array(
            'TravelLookupContinent' => array(
                'className' => 'TravelLookupContinent',
                'fields'    => array('continent_name','continent_code'),
                'foreignKey' => 'continent_id',
            ),
            'TravelCountry' => array(
                'className' => 'TravelCountry',
                'fields'    => array('country_code','country_name'),
                'foreignKey' => 'country_id',
            ),
        );
    
}

?>
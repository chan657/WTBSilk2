<?php

App::uses('AppModel', 'Model');

class TravelCity extends AppModel {

    public $name = 'TravelCity';
    

    public $hasMany = array(
        'TravelHotelLookup' => array(
            'className' => 'TravelHotelLookup',
            'foreignKey' => 'city_id',
            'fields' => 'TravelHotelLookup.id',           
        ),
        'TravelCitySupplier' => array(
            'className' => 'TravelCitySupplier',
            'foreignKey' => 'city_id',
            'fields' => 'TravelCitySupplier.id',           
        ),
        'TravelHotelRoomSupplier' => array(
            'className' => 'TravelHotelRoomSupplier',
            'foreignKey' => 'hotel_city_id',
            'fields' => 'TravelHotelRoomSupplier.id',           
        ),
        'TravelSuburb' => array(
            'className' => 'TravelSuburb',
            'foreignKey' => 'city_id',
            'fields' => 'TravelSuburb.id',           
        ),
        'TravelArea' => array(
            'className' => 'TravelArea',
            'foreignKey' => 'city_id',
            'fields' => 'TravelArea.id',           
        ),
    );

    
}

?>
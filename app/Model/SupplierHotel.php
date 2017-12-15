<?php

App::uses('AppModel', 'Model');

class SupplierHotel extends AppModel {

    var $name = 'SupplierHotel';
 
    public $belongsTo = array(
        'TravelSupplierStatus' => array(
            'className' => 'TravelSupplierStatus',
            'foreignKey' => 'status',
        ),
    );
    
    public $hasMany = array(
        'TravelHotelRoomSupplier' => array(
            'className' => 'TravelHotelRoomSupplier',
            'foreignKey' => 'hotel_supplier_id',
        ),
        );

}

?>
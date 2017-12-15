<?php

App::uses('AppModel', 'Model');

class SupplierCity extends AppModel {

    var $name = 'SupplierCity';

    public $belongsTo = array(
        'TravelSupplierStatus' => array(
            'className' => 'TravelSupplierStatus',
            'foreignKey' => 'status',
        ),
    );
    
    public $hasMany = array(
        'TravelCitySupplier' => array(
            'className' => 'TravelCitySupplier',
            'foreignKey' => 'city_supplier_id',
        ),
        );

}

?>
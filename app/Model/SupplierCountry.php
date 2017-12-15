<?php

App::uses('AppModel', 'Model');

class SupplierCountry extends AppModel {

    var $name = 'SupplierCountry';

    public $belongsTo = array(
        'TravelSupplierStatus' => array(
            'className' => 'TravelSupplierStatus',
            'foreignKey' => 'status',
        ),
    );
    
    public $hasMany = array(
        'TravelCountrySupplier' => array(
            'className' => 'TravelCountrySupplier',
            'foreignKey' => 'country_supplier_id',
        ),
        );

}

?>
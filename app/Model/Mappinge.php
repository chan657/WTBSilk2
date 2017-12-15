<?php

App::uses('AppModel', 'Model');

class Mappinge extends AppModel {

    var $name = 'Mappinge';
    
    public $validate = array(
    );
   
    public $belongsTo = array(
        'TravelSupplier' => array(
            'fields' => array('supplier_name'),
            'className' => 'TravelSupplier',
            'foreignKey' => false,
            'conditions' => 'TravelSupplier.supplier_code = Mappinge.supplier_code',
        ),
        
        'TravelMappingType' => array(            
            'className' => 'TravelMappingType',
            'foreignKey' => 'mapping_type',
            
        ),

        
        'TravelCountrySupplier' => array(            
            'className' => 'TravelCountrySupplier',
            'foreignKey' => 'country_supplier_id',
            
        ),
        
        'TravelCitySupplier' => array(            
            'className' => 'TravelCitySupplier',
            'foreignKey' => 'city_supplier_id',
            
        ),
        
        'TravelHotelRoomSupplier' => array(            
            'className' => 'TravelHotelRoomSupplier',
            'foreignKey' => 'hotel_supplier_id',
            
        ),
    );


}

?>
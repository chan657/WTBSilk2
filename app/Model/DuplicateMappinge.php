<?php

App::uses('AppModel', 'Model');

class DuplicateMappinge extends AppModel {

    var $name = 'DuplicateMappinge';
    
    public $validate = array(
    );
   
    public $belongsTo = array(
        'TravelSupplier' => array(
            'fields' => array('supplier_name'),
            'className' => 'TravelSupplier',
            'foreignKey' => false,
            'conditions' => 'TravelSupplier.supplier_code = DuplicateMappinge.supplier_code',
        ),       
     
        
        'DuplicateTravelCitySupplier' => array(            
            'className' => 'TravelCitySupplier',
            'fields' => array('city_mapping_name'),
            'foreignKey' => 'duplicate_id',
            'conditions' => 'DuplicateMappinge.mapping_type = 2',            
        ),
        
        'DuplicateTravelHoelSupplier' => array(            
            'className' => 'TravelHotelRoomSupplier',
            'fields' => array('hotel_mapping_name'),
            'foreignKey' => 'duplicate_id',
            'conditions' => 'DuplicateMappinge.mapping_type = 3',            
        ),
         

    );

}

?>
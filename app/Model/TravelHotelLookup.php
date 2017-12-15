<?php

App::uses('AppModel', 'Model');

class TravelHotelLookup extends AppModel {

    var $name = 'TravelHotelLookup';
    public $validate = array(
            
       
    );
    public $belongsTo = array(
        'ContractStatus' => array(
            'className' => 'TravelLookupValueContractStatus',
            'foreignKey' => 'contract_status',
        ), 
    );
    public $hasMany = array(
        'TravelHotelRoomSupplier' => array(
            'className' => 'TravelHotelRoomSupplier',
            'foreignKey' => 'hotel_id',            
            //'conditions' => array('TravelHotelRoomSupplier.wtb_status' => '1','TravelHotelRoomSupplier.active' => 'TRUE','TravelHotelRoomSupplier.hotel_supplier_status' => '2')  // 1 for client table of  lookup_value_activity_levels
        ),
        
        
    );
   

}

?>
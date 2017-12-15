<?php

App::uses('AppModel', 'Model');

class TravelActionItem extends AppModel {

    var $name = 'TravelActionItem';
    /*
    public $validate = array(
        'type_id' => array
            (
            'unique' => array
                (
                'rule' => array('checkUnique', array('type_id', 'level_id', 'created_by', 'next_action_by', 'parent_action_item_id')),
                'message' => 'This action is already added, check your input and try again.',
            )
        ),
    );
     * 
     */
    public $belongsTo = array(
        'Agent' => array(
            'className' => 'Agent',
            'fields' => array('agent_name'),
            'foreignKey' => 'agent_id'
        ),
        'TravelCountrySupplier' => array(
            'className' => 'TravelCountrySupplier',
            'fields' => array('country_mapping_name'),
            'foreignKey' => 'country_supplier_id'
        ),
        'TravelCitySupplier' => array(
            'className' => 'TravelCitySupplier',
            'fields' => array('city_mapping_name'),
            'foreignKey' => 'city_supplier_id'
        ),
        'TravelHotelRoomSupplier' => array(
            'className' => 'TravelHotelRoomSupplier',
            'fields' => array('hotel_mapping_name'),
            'foreignKey' => 'hotel_supplier_id'
        ),
        'TravelHotelLookup' => array(
            'className' => 'TravelHotelLookup',
            'fields' => array('hotel_name'),
            'foreignKey' => 'hotel_id'
        ),
       'DuplicateMappinge' => array(
            'className' => 'DuplicateMappinge',            
            'foreignKey' => 'duplicate_city_supplier_id'
        ),
        'LookupReturn' => array(
            'className' => 'LookupValueActionItemReturn',
            'foreignKey' => 'lookup_return_id'
        ),
        'LookupReject' => array(
            'className' => 'LookupValueActionItemRejection',
            'foreignKey' => 'lookup_rejection_id'
        ),
        'LookupRelease' => array(
            'className' => 'LookupValueActionItemRelease',
            'foreignKey' => 'lookup_release_id'
        ),
       'TravelActionItemLevel' => array(
            'className' => 'TravelActionRemarkLevel',
            'foreignKey' => 'level_id'
        ),
        'TravelActionType' => array(
            'className' => 'TravelActionItemType',
            'foreignKey' => 'type_id',
        ),
        'TravelRole' => array(
            'className' => 'Role',
            'foreignKey' => 'action_item_source',
        ),
        'AllocationReason' => array(
            'className' => 'LookupValueTravelAllocation',
            'foreignKey' => 'reason_allocation_id',
        ),

    );
    
    public function HotelMappingPending($hotel_supplier_id) {
        return $this->find('count', array('conditions' => array('TravelActionItem.hotel_supplier_id' => $hotel_supplier_id,'TravelActionItem.level_id' => '4', 'TravelActionItem.action_item_active' => 'Yes','TravelActionItem.next_action_by != "NULL"')));
    }

}

?>
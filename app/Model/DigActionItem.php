<?php

App::uses('AppModel', 'Model');

class DigActionItem extends AppModel {

    var $name = 'DigActionItem';
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
        'DigBase' => array(
            'className' => 'DigBase',
            'fields' => array('base_website_url'),
            'foreignKey' => 'base_id'
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
       'DigActionItemLevel' => array(
            'className' => 'DigActionRemarkLevel',
            'foreignKey' => 'level_id'
        ),
        'DigActionType' => array(
            'className' => 'DigActionItemType',
            'foreignKey' => 'type_id',
        ),
        'DigRole' => array(
            'className' => 'Role',
            'foreignKey' => 'action_item_source',
        ),

    );

}

?>
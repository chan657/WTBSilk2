<?php

App::uses('AppModel', 'Model');

class GroupsUser extends AppModel {

    var $name = 'GroupsUser';
    public $validate = array(
        'name' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Please enter group name',
            )
        ),
        'channel_field' => array(
            'Rule1' => array
                (
                'rule' => array('notempty'),
                'message' => 'Please enter channel field name',
            ),
            'Rule2' => array
                (
                'rule' => '/[a-z_]+/',
                'message' => 'Please enter proper field name',
            ),
            'Rule3' => array
                (
                'rule' => 'isUnique',
                'message' => 'Channel field name already exists'
            )
        ),
        'role_field' => array(
            'Rule1' => array(
                'rule' => array('notempty'),
                'message' => 'Please enter role field name',
            ),
            'Rule2' => array
                (
                'rule' => '/[a-z_]+/',
                'message' => 'Please enter proper field name',
            ),
            'Rule3' => array
                (
                'rule' => 'isUnique',
                'message' => 'Role field name already exists'
            )
        ),
    );
    public $belongsTo = array(
        'Industry' => array(
            'className' => 'LookupValueActivityIndustry',
            'foreignKey' => 'industry'
        ),
    );

}

?>
<?php

App::uses('AppModel', 'Model');

class Channel extends AppModel {

    public $name = 'Channel';
    public $validate = array(
        'channel_name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'please provide a name'
            )
        ),
        'channel_city' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'value required'
            )
        ),
        'channel_head' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'value required'
            )
        ),
        'channel_role' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'value required'
            )
        ),
    );
    public $belongsTo = array(
        'City' => array(
            'className' => 'City',
            'foreignKey' => 'city_id'
        ),
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'channel_head'
        ),
        'LookupValueStatus' => array(
            'className' => 'LookupValueStatus',
            'foreignKey' => 'channel_status'
        ),
        'LookupValueChannelRole' => array(
            'className' => 'GroupsUser',
            'foreignKey' => 'channel_role'
        ),
       
    );

}

?>
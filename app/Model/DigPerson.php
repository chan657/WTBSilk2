<?php

App::uses('AppModel', 'Model');

class DigPerson extends AppModel {

    public $name = 'DigPerson';
    public $validate = array(
        
    );
    
    public $belongsTo = array(
        'DigPersonProfileType' => array(
            'className' => 'DigPersonProfileType',
            'fields' => 'value',
            'foreignKey' => 'person_profile_type'
        ),
        'DigPersonType' => array(
            'className' => 'DigPersonType',
            'fields' => 'value',
            'foreignKey' => 'person_type'
        ),
        'DigPersonIndustry' => array(
            'className' => 'DigPersonIndustry',
            'fields' => 'value',
            'foreignKey' => 'person_industry'
        ),
        'Location' => array(
            'className' => 'LookupValueLeadsCountry',
            'fields' => array('code','value'),
            'foreignKey' => 'person_location'
        ),
        'DigPersonUsedByTeam' => array(
            'className' => 'Channel',
            'fields' => array('channel_name'),
            'foreignKey' => 'person_used_by_team'
        ),
       'DigPersonUsedByPerson' => array(
            'className' => 'User',
            'fields' => array('fname','lname'),
            'foreignKey' => 'person_used_by_person'
        ),
        'DigPersonUsageStatus' => array(
            'className' => 'DigBaseUsage',
            'fields' => 'value',
            'foreignKey' => 'person_usage_status'
        ),
    );
    
}

?>
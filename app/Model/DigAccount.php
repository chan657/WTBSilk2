<?php

App::uses('AppModel', 'Model');

class DigAccount extends AppModel {

    public $name = 'DigAccount';
    public $validate = array(

    );
    
    public $belongsTo = array(
        'DigBase' => array(
            'className' => 'DigBase',
            'fields' => 'base_website_url,base_pp',
            'foreignKey' => 'account_base_id'
        ),
        'BasePP' => array(
            'className' => 'DigBaseDaAaClLrLookup',            
            'foreignKey' => false,
            'conditions' => 'DigBase.base_pp = BasePP.id',
        ),

        'DigAccountPopularity' => array(
            'className' => 'DigAccountPopularity',
            'fields' => 'value',
            'foreignKey' => 'account_popularity_id'
        ),
    
        'DigAccountUsage' => array(
            'className' => 'DigAccountUsage',
            'fields' => 'value',
            'foreignKey' => 'account_usage_status'
        ),
        
        'DigPerson' => array(
            'className' => 'DigPerson',            
            'foreignKey' => 'account_person_id'
        ),
        
        'DigUsedByTeam' => array(
            'className' => 'Channel',
            'fields' => 'channel_name',
            'foreignKey' => 'account_team_id'
        ),
        'DigUsedByPerson' => array(
            'className' => 'User',
            'fields' => array('fname','lname'),
            'foreignKey' => 'account_used_by_person'
        ),
        'DigPersonDF' => array(
            'className' => 'DigBaseDofollow',
            'fields' => 'value',
            'foreignKey' => 'account_profile_df'
        ),
        'DigAccountIndustry' => array(
            'className' => 'DigAccountIndustry',
            'fields' => 'value',
            'foreignKey' => 'account_industry_id'
        ),
        'Geography' => array(
            'className' => 'LookupValueLeadsCountry',
            'fields' => array('code','value'),
            'foreignKey' => false,
            'conditions' => 'DigPerson.person_location = Geography.id',
        ),
    );
    
}

?>
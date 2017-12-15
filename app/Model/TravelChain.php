<?php

App::uses('AppModel', 'Model');

class TravelChain extends AppModel {

    public $name = 'TravelChain';
    public $validate = array(
        'chain_name' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Please enter chain name',
            )
        ),    
    );
    public $belongsTo = array(
       
        'TravelCountry' => array(
            'className' => 'TravelCountry',
            'fields' => 'country_name',
            'foreignKey' => 'chain_home_country_id'
        ),
        'TravelCity' => array(
            'className' => 'TravelCity',
            'fields' => 'city_name',
            'foreignKey' => 'chain_hq_city_id'
        ),
        'TravelLookupChainPresence' => array(
            'className' => 'TravelLookupChainPresence',            
            'foreignKey' => 'chain_presence'
        ),
        'TravelLookupChainSegment' => array(
            'className' => 'TravelLookupChainSegment',           
            'foreignKey' => 'chain_segment'
        )
        
    );
}

?>
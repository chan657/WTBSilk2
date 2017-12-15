<?php

App::uses('AppModel', 'Model');

class TravelBrand extends AppModel {

    public $name = 'TravelBrand';
    public $validate = array(
        'brand_name' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Please enter brand name',
            )
        ),    
    );
    public $belongsTo = array(
       
        'TravelCountry' => array(
            'className' => 'TravelCountry',
            'fields' => 'country_name',
            'foreignKey' => 'brand_country_id'
        ),
        'TravelCity' => array(
            'className' => 'TravelCity',
            'fields' => 'city_name',
            'foreignKey' => 'brand_hq_city_id'
        ),
        'TravelLookupBrandPresence' => array(
            'className' => 'TravelLookupBrandPresence',            
            'foreignKey' => 'brand_presence'
        ),
        'TravelLookupBrandSegment' => array(
            'className' => 'TravelLookupBrandSegment',           
            'foreignKey' => 'brand_segment'
        )
    );
}

?>
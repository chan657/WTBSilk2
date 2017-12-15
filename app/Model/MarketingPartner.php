<?php

App::uses('AppModel', 'Model');

class MarketingPartner extends AppModel {

    public $name = 'MarketingPartner';
    public $belongsTo = array(
        'City' => array(
            'fields' => 'city_name',
            'className' => 'City',
            'foreignKey' => 'marketing_partner_primarycity'
        ),
        'SecondaryCity' => array(
            'fields' => 'city_name',
            'className' => 'City',
            'foreignKey' => 'marketing_partner_secondarycity'
        ),
        'TertiaryCity' => array(
            'fields' => 'city_name',
            'className' => 'City',
            'foreignKey' => 'marketing_partner_tertiarycity'
        ),
        'City4' => array(
            'fields' => 'city_name',
            'className' => 'City',
            'foreignKey' => 'marketing_partner_city_4'
        ),
        'City5' => array(
            'fields' => 'city_name',
            'className' => 'City',
            'foreignKey' => 'marketing_partner_city_5'
        ),
        'BoardNumber' => array(
            'className' => 'LookupValueLeadsCountry',
            'foreignKey' => 'marketing_partner_boardnumber_code'
        ),
    );
    var $hasMany = array(
        'BuilderContact' => array(
            'className' => 'BuilderContact',
            'foreignKey' => 'builder_partner_id',
        ),
    );

}

?>
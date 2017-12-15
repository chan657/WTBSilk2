<?php

App::uses('AppModel', 'Model');

class Owner extends AppModel {

    public $name = 'Owner';
    public $validate = array(
        'owner_name' => array(
            'Rule1' => array(
                'rule' => array('notempty'),
                'message' => 'Please enter owner name'
            ),
            'Rule2' => array(
                'rule' => 'isUnique',
                'message' => 'Owner name already exists',
                'on' => 'create'
            ),
        ),
        'owner_primarycity' => array(
            'rule' => array('notempty'), // Rule: notempty
            'message' => 'Primary city can not be blank',
        ),
        'owner_highendresidential' => array(
            'rule' => array('notempty'), // Rule: notempty
            'message' => 'Highend residential can not be blank',
        ),
    );
    public $belongsTo = array(
        'Residental' => array(
            'className' => 'LookupValueStatus',
            'foreignKey' => 'owner_residential'
        ),
        'Highend' => array(
            'className' => 'LookupValueStatus',
            'foreignKey' => 'owner_highendresidential'
        ),
        'Commercial' => array(
            'className' => 'LookupValueStatus',
            'foreignKey' => 'owner_commercial'
        ),
        'City' => array(
            'fields' => 'city_name',
            'className' => 'City',
            'foreignKey' => 'owner_primarycity'
        ),
        'SecondaryCity' => array(
            'fields' => 'city_name',
            'className' => 'City',
            'foreignKey' => 'owner_secondarycity'
        ),
        'TertiaryCity' => array(
            'fields' => 'city_name',
            'className' => 'City',
            'foreignKey' => 'owner_tertiarycity'
        ),
        'City4' => array(
            'fields' => 'city_name',
            'className' => 'City',
            'foreignKey' => 'city_4'
        ),
        'City5' => array(
            'fields' => 'city_name',
            'className' => 'City',
            'foreignKey' => 'city_5'
        ),
        'OwnerStatus' => array(
            'className' => 'LookupValueStatus',
            'foreignKey' => 'owner_status'
        ),
        'BoardNumber' => array(
            'className' => 'LookupValueLeadsCountry',
            'foreignKey' => 'owner_boardnumber_code'
        ),
   
        'ContactLevel' => array(
            'className' => 'LookupBuilderContactLevel',
            'foreignKey' => 'owner_contact_level',
        ),
        'ContactMobileCode' => array(
            'className' => 'LookupValueLeadsCountry',
            'foreignKey' => 'owner_contact_mobile_country_code',
        ),
        'ContactSecondaryMobileCode' => array(
            'className' => 'LookupValueLeadsCountry',
            'foreignKey' => 'owner_contact_secondary_mobile_country_code',
        ),
        'ContactCompanyCity' => array(
            'className' => 'city',
            'foreignKey' => 'owner_contact_company_city',
        ),
        'ContactLocation' => array(
            'className' => 'city',
            'foreignKey' => 'owner_contact_location',
        ),
        'ForCompany' => array(
            'className' => 'LookupCompany',
            'foreignKey' => 'owner_contact_company',
        ),
           
    );

}

?>
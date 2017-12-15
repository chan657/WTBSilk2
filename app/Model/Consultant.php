<?php

App::uses('AppModel', 'Model');

class Consultant extends AppModel {

    public $name = 'Consultant';
    public $validate = array(
        'consultant_name' => array(
            'Rule1' => array(
                'rule' => array('notempty'),
                'message' => 'Please enter consultant name'
            ),
            'Rule2' => array(
                'rule' => 'isUnique',
                'message' => 'Owner name already exists',
                'on' => 'create'
            ),
        ),
        'consultant_primarycity' => array(
            'rule' => array('notempty'), // Rule: notempty
            'message' => 'Primary city can not be blank',
        ),
        'consultant_highendresidential' => array(
            'rule' => array('notempty'), // Rule: notempty
            'message' => 'Highend residential can not be blank',
        ),
    );
    public $belongsTo = array(
        'Residental' => array(
            'className' => 'LookupValueStatus',
            'foreignKey' => 'consultant_residential'
        ),
        'Highend' => array(
            'className' => 'LookupValueStatus',
            'foreignKey' => 'consultant_highendresidential'
        ),
        'Commercial' => array(
            'className' => 'LookupValueStatus',
            'foreignKey' => 'consultant_commercial'
        ),
        'City' => array(
            'fields' => 'city_name',
            'className' => 'City',
            'foreignKey' => 'consultant_primarycity'
        ),
        'SecondaryCity' => array(
            'fields' => 'city_name',
            'className' => 'City',
            'foreignKey' => 'consultant_secondarycity'
        ),
        'TertiaryCity' => array(
            'fields' => 'city_name',
            'className' => 'City',
            'foreignKey' => 'consultant_tertiarycity'
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
            'foreignKey' => 'consultant_status'
        ),
        'BoardNumber' => array(
            'className' => 'LookupValueLeadsCountry',
            'foreignKey' => 'consultant_boardnumber_code'
        ),
   
        'ContactLevel' => array(
            'className' => 'LookupBuilderContactLevel',
            'foreignKey' => 'consultant_contact_level',
        ),
        'ContactMobileCode' => array(
            'className' => 'LookupValueLeadsCountry',
            'foreignKey' => 'consultant_contact_mobile_country_code',
        ),
        'ContactSecondaryMobileCode' => array(
            'className' => 'LookupValueLeadsCountry',
            'foreignKey' => 'consultant_contact_secondary_mobile_country_code',
        ),
        'ContactCompanyCity' => array(
            'className' => 'city',
            'foreignKey' => 'consultant_contact_company_city',
        ),
        'ContactLocation' => array(
            'className' => 'city',
            'foreignKey' => 'consultant_contact_location',
        ),
        'ForCompany' => array(
            'className' => 'LookupCompany',
            'foreignKey' => 'consultant_contact_company',
        ),
           
    );

}

?>
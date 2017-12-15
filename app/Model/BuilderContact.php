<?php

App::uses('AppModel', 'Model');

class BuilderContact extends AppModel {

    public $name = 'BuilderContact';
    public $belongsTo = array(
        'Level' => array(
            'className' => 'lookupBuilderContactLevel',
            'foreignKey' => 'builder_contact_level'
        ),
        'PrimaryMobileCountry' => array(
            'className' => 'LookupValueLeadsCountry',
            'foreignKey' => 'builder_contact_mobile_country_code'
        ),
        'Builder' => array(
            'className' => 'Builder',
            'fields' => array('builder_name'),
            'foreignKey' => 'builder_contact_builder_id'
        ),
        'MarketingPartner' => array(
            'className' => 'MarketingPartner',
            'fields' => array('marketing_partner_display_name'),
            'foreignKey' => 'builder_partner_id'
        ),
        'SecondMobileCountry' => array(
            'className' => 'LookupValueLeadsCountry',
            'foreignKey' => 'builder_contact_secondary_mobile_country_code'
        ),
        'ForCompany' => array(
            'className' => 'LookupCompany',
            'foreignKey' => 'builder_contact_company'
        ),
        'ForCompanyCity' => array(
            'className' => 'City',
            'foreignKey' => 'builder_contact_company_city'
        ),
        'Location' => array(
            'className' => 'City',
            'foreignKey' => 'builder_contact_location'
        ),
        'InitiatedBy' => array(
            'className' => 'LookupBuilderContactInitiatedBy',
            'foreignKey' => 'builder_contact_intiated_by_id'
        ),
        'ManagedBy' => array(
            'className' => 'LookupBuilderContactManagedBy',
            'foreignKey' => 'builder_contact_managed_by_id'
        ),
        'Initiated' => array(
            'className' => 'User',
            'fields' => array('Initiated.fname', 'Initiated.lname'),
            'foreignKey' => 'builder_contact_intiated_by'
        ),
        'Managed' => array(
            'className' => 'User',
            'fields' => array('Managed.fname', 'Managed.lname'),
            'foreignKey' => 'builder_contact_managed_by'
        ),
        'ApprovedBy' => array(
            'className' => 'User',
            'fields' => array('ApprovedBy.fname', 'ApprovedBy.lname'),
            'foreignKey' => 'builder_contact_approved_by'
        ),
        'PreparedBy' => array(
            'className' => 'LookupBuilderContactPreparedBy',
            'foreignKey' => 'builder_contact_prepared_by_id'
        ),
    );

}

?>
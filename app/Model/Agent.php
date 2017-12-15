<?php

App::uses('AppModel', 'Model');

class Agent extends AppModel {

    public $name = 'Agent';
    public $belongsTo = array(
        'PrimaryCity' => array(
            'fields' => 'city_name',
            'className' => 'City',
            'foreignKey' => 'agent_primary_city'
        ),
        'SecondaryCity' => array(
            'fields' => 'city_name',
            'className' => 'City',
            'foreignKey' => 'agent_secondary_city'
        ),
        'TertiaryCity' => array(
            'fields' => 'city_name',
            'className' => 'City',
            'foreignKey' => 'agent_tertiary_city'
        ),
        'City4' => array(
            'fields' => 'city_name',
            'className' => 'City',
            'foreignKey' => 'agent_city4'
        ),
        'City5' => array(
            'fields' => 'city_name',
            'className' => 'City',
            'foreignKey' => 'agent_city5'
        ),
        'AgentCountry' => array(
            'fields' => 'name',
            'className' => 'CwrCountry',
            'foreignKey' => 'agent_incorporated_in_country'
        ),
        'AgentStatus' => array(
            'className' => 'LookupAgentStatus',
            'foreignKey' => 'agent_status'
        ),
        'MobileCode' => array(
            'className' => 'LookupValueLeadsCountry',
            'foreignKey' => 'agent_contact_number_code_mobile'
        ),
        'LandLineCode' => array(
            'className' => 'LookupValueLeadsCountry',
            'foreignKey' => 'agent_contact_number_code_landline'
        ),
        'AgentBusinessNature' => array(
            'className' => 'LookupAgentNatureOfBusiness',
            'foreignKey' => 'agent_nature_of_business'
        ),
        'AgentSource' => array(
            'className' => 'LookupAgentSource',
            'foreignKey' => 'agent_source'
        ),
         'AgentBusinessType' => array(
            'className' => 'LookupAgentBusinessType',
            'foreignKey' => 'agent_business_type'
        ),
        'TimeZone' => array(
            'className' => 'Timezone',
            'foreignKey' => 'agent_time_zone'
        ),
        'ProcurementType' => array(
            'className' => 'LookupAgentProcurementType',
            'foreignKey' => 'agent_procurement_type'
        ),
        'AgentCountry' => array(
            'className' => 'CwrCountry',
            'foreignKey' => 'agent_incorporated_in_country'
        ),
        'AgentSuburb' => array(
            'fields' => 'suburb_name',
            'className' => 'Suburb',
            'foreignKey' => 'agent_suburb'
        ),
        'AgentArea' => array(
            'fields' => 'area_name',
            'className' => 'Area',
            'foreignKey' => 'agent_area'
        ),
    );

}

?>
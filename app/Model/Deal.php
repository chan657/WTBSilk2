<?php

App::uses('AppModel', 'Model');

class Deal extends AppModel {

    public $belongsTo = array(
        'TransactionType' => array(
            'className' => 'LookupValueLeadTransactionType',
            'foreignKey' => 'deal_type'
        ),
        'BillingType' => array(
            'className' => 'LookupValueDealBillingType',
            'foreignKey' => 'deal_billing_type'
        ),
        'DealStatus' => array(
            'className' => 'LookupDealStatu',
            'foreignKey' => 'deal_status'
        ),
        'DealClient' => array(
            'className' => 'Lead',
            'fields' => array('lead_fname', 'lead_lname'),
            'foreignKey' => 'deal_client_id'
        ),
        'DealProject' => array(
            'className' => 'Project',
            'fields' => array('project_name'),
            'foreignKey' => 'deal_project_id'
        ),
        'CommissionEvent' => array(
            'className' => 'LookupUnitCommissionEvent',
            'foreignKey' => 'deal_invoice_event'
        ),
        'DealBuilder' => array(
            'className' => 'Builder',
            'fields' => array('builder_name'),
            'foreignKey' => 'deal_builder_id'
        ),
        'DealPartner' => array(
            'className' => 'MarketingPartner',
            'fields' => array('marketing_partner_display_name'),
            'foreignKey' => 'deal_marketing_partner_id'
        ),
        'ProjectLegalName' => array(
            'fields' => array('project_legal_names_builder_legal_id'),
            'className' => 'ProjectLegalName',
            'foreignKey' => 'deal_project_legal_name_id'
        ),
        'DealLegalName' => array(
            'fields' => array('builder_legal_names_name'),
            'className' => 'BuilderLegalName',
            'foreignKey' => false,
            'conditions' => 'ProjectLegalName.project_legal_names_builder_legal_id = DealLegalName.id'
        ),
        'DealUnit' => array(
            'className' => 'ProjectUnit',
            'fields' => array('unit_name'),
            'foreignKey' => 'deal_project_unit_id'
        ),
    );

}

?>
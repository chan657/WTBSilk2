<?php

App::uses('AppModel', 'Model');

class ActionItem extends AppModel {

    var $name = 'ActionItem';
    public $validate = array(
        /*
        'type_id' => array
            (
            'unique' => array
                (
                // 'rule' => array('lead_id', 'next_action_by','type_id' ,'key'),
                'rule' => array('checkUnique', array('type_id', 'action_item_level_id', 'created_by', 'next_action_by')),
                'message' => 'This action is already added, check your input and try again.',
            )
        ),
         * 
         */
    );
    public $belongsTo = array(
        'Lead' => array(
            'className' => 'Lead',
            'foreignKey' => 'lead_id'
        ),
        'ActionBuilder' => array(
            'fields' => array('builder_name'),
            'className' => 'Builder',
            'foreignKey' => 'builder_id'
        ),
        'Owner' => array(
            'fields' => array('owner_name'),
            'className' => 'Owner',
            'foreignKey' => 'owner_id'
        ),
        'Consultant' => array(
            'fields' => array('consultant_name'),
            'className' => 'Consultant',
            'foreignKey' => 'consultant_id'
        ),
        'Property' => array(
            'fields' => array('prop_name'),
            'className' => 'Property',
            'foreignKey' => 'property_id'
        ),
        'Reimbursement' => array(
            'className' => 'Reimbursement',
            'foreignKey' => 'event_id'
        ),
        'BuilderContact' => array(
            'fields' => array('builder_contact_name'),
            'className' => 'BuilderContact',
            'foreignKey' => 'builder_contact_id'
        ),
        'BuilderLegalName' => array(
            'fields' => array('builder_legal_names_name'),
            'className' => 'BuilderLegalName',
            'foreignKey' => 'builder_legalname_id'
        ),
        'ProjectLegalName' => array(
            'fields' => array('project_legal_names_builder_legal_id'),
            'className' => 'ProjectLegalName',
            'foreignKey' => 'project_legalname_id'
        ),
        'ProjectUnit' => array(
            'fields' => array('unit_name'),
            'className' => 'ProjectUnit',
            'foreignKey' => 'project_unit_id'
        ),
        'ProjectBuilderLegalName' => array(
            'fields' => array('builder_legal_names_name'),
            'className' => 'BuilderLegalName',
            'foreignKey' => false,
            'conditions' => 'ProjectLegalName.project_legal_names_builder_legal_id = ProjectBuilderLegalName.id'
        ),
        'MarketingPartner' => array(
            'fields' => array('marketing_partner_display_name'),
            'className' => 'MarketingPartner',
            'foreignKey' => 'marketing_partner_id'
        ),
        'Deal' => array(
            'fields' => array('deal_client_id'),
            'className' => 'Deal',
            'foreignKey' => 'deal_id'
        ),
        'DealClient' => array(
            'fields' => array('lead_fname','lead_lname'),
            'className' => 'Lead',
            'foreignKey' => false,
            'conditions' => 'Deal.deal_client_id = DealClient.id'
        ),
        'ActionStatus' => array(
            'className' => 'LookupValueActionItemStatus',
            'foreignKey' => 'action_item_status'
        ),
        'LookupReturn' => array(
            'className' => 'LookupValueActionItemReturn',
            'foreignKey' => 'lookup_return_id'
        ),
        'LookupReject' => array(
            'className' => 'LookupValueActionItemRejection',
            'foreignKey' => 'lookup_rejection_id'
        ),
        'LookupRelease' => array(
            'className' => 'LookupValueActionItemRelease',
            'foreignKey' => 'lookup_release_id'
        ),
        'CreatedBy' => array(
            'className' => 'User',
            'fields' => array('CreatedBy.fname', 'CreatedBy.lname'),
            'foreignKey' => 'created_by'
        ),
        'ActionProject' => array(
            'fields' => array('project_name'),
            'className' => 'Project',
            'foreignKey' => 'project_id'
        ),
        'PhoneOfficer' => array(
            'className' => 'User',
            'fields' => array('PhoneOfficer.fname', 'PhoneOfficer.mname', 'PhoneOfficer.lname'),
            'foreignKey' => false,
            'conditions' => 'Lead.lead_phoneofficer = PhoneOfficer.id',
        ),
        'Associate' => array(
            'className' => 'User',
            'fields' => array('Associate.fname', 'Associate.mname', 'Associate.lname'),
            'foreignKey' => false,
            'conditions' => 'Lead.lead_associate = Associate.id',
        ),
        'PrimaryManage' => array(
            'className' => 'User',
            'fields' => array('PrimaryManage.fname', 'PrimaryManage.lname'),
            'foreignKey' => 'primary_manager_id'
        ),
        'NextActionBy' => array(
            'className' => 'User',
            'fields' => array('NextActionBy.fname', 'NextActionBy.mname', 'NextActionBy.lname'),
            'foreignKey' => 'next_action_by'
        ),
        'SecondaryManage' => array(
            'className' => 'User',
            'fields' => array('SecondaryManage.fname', 'SecondaryManage.lname'),
            'foreignKey' => 'secondary_manager_id'
        ),
        'ActionItemLevel' => array(
            'className' => 'ActionItemLevel',
            'foreignKey' => 'action_item_level_id'
        ),
        'ActionType' => array(
            'className' => 'action_item_types',
            'foreignKey' => 'type_id',
        ),
        'Role' => array(
            'className' => 'Role',
            'foreignKey' => 'action_item_source',
        ),
        'LastActionBy' => array(
            'className' => 'User',
            'fields' => array('LastActionBy.fname', 'LastActionBy.mname', 'LastActionBy.lname'),
            'foreignKey' => 'created_by_id',
        ),
    );

    public function GetLastAllocationDate($lead_id) {
        $action = $this->find('first', array('fields' => array('ActionItem.created'), 'conditions' => array('OR' => array('ActionItem.action_item_level_id' => array('1', '10')), 'ActionItem.lead_id' => $lead_id, 'ActionItem.type_id' => 4, 'ActionItem.action_item_active' => 'No'), 'order' => array('ActionItem.id' => 'DESC')));

        if (count($action))
            return date("j M, Y H:i:s", strtotime($action['ActionItem']['created']));
        else
            return false;
    }

    /*
      public $hasMany = array(
      'Remark' => array('conditions' => array('Remark.lead_id' => 'ActionItem.lead_id'))
      );
     */
    /*  var $hasMany = array(   
      'Remark' => array(
      'className' => 'Remark',
      'foreignKey' => 'lead_id',
      'joinTable' => 'action_items',
      'alias' => 'ActionItem',
      'conditions' => 'ActionItem.lead_id = Remark.lead_id',

      )
      );
     */
    /* var $hasMany = array(
      'Remark' => array(
      'className' => 'Remark',
      'joinTable' => 'action_items',
      'foreignKey' => 'lead_id',
      'associationForeignKey' => 'lead_id'
      )
      );
     */
}

?>
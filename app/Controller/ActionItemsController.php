<?php

/**
 * Action controller.
 *
 * This file will render views from views/actions/
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('CakeEmail', 'Network/Email');
/**
 * Email sender
 */
App::uses('AppController', 'Controller');

/**
 * Action controller
 *
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class ActionItemsController extends AppController {

    var $uses = array('Amenity', 'Group','Property', 'City','Owner','Consultant', 'Deal','LookupValueProjectAttache','LookupUnitCommissionBasedOn', 'LookupValueLeadTransactionType', 'LookupUnitCommissionEvent', 'LookupValueDealBillingType', 'Channel', 'Project', 'Lead', 'Builder', 'Role', 'ActionItem', 'ActionItemType', 'Remark', 'Channel', 'ActionItemLevel', 'LookupValueProjectUnitType', 'LookupValueActionItemRejection', 'LookupValueActionItemReturn', 'LeadStatus', 'Suburb', 'Area', 'User', 'LookupValueCallQuality', 'LookupValueLeadsClosureProbability', 'LookupValueLeadsUrgency', 'LookupValueLeadsSegment', 'LookupValueLeadsCountry', 'LookupValueLeadsImportance', 'LookupValueLeadsType', 'LookupValueLeadsProgress', 'LookupValueLeadsCurrency', 'LookupValueProjectUnitPreference', 'LookupValueProjectPhase', 'CallingReport', 'BuilderContact', 'Event', 'Reimbursement', 'LookupValueActivityDetail', 'LookupValueReimbursementType_1', 'LookupValueActivityLevel', 'LookupValueBillStatus', 'LookupValueBillType', 'LookupValueReimbursementType_2', 'ProjectUnit', 'ProjectContact', 'BuilderLegalName', 'ProjectLegalName', 'MarketingPartner');
    public $components = array('Sms');

    public function index() {

        $dummy_status = $this->Auth->user('dummy_status');
        $role_id = $this->Session->read("role_id");
        $channel_id = $this->Session->read("channel_id");
        $channels = $this->Channel->findById($channel_id);
        $channel_head = $channels['Channel']['channel_head'];
        $user_id = $this->Auth->user('id');
        $city_id = $channels['Channel']['city_id'];
        $roles = $this->Role->find('all', array('conditions' => 'Role.id = ' . $role_id));
        $this->set(compact('roles'));
        $group_user = $roles[0]['Role']['id'];
        $search_condition = array();

        if ($this->request->is('post') || $this->request->is('put')) {

            if (!empty($this->data['ActionItem']['global_search'])) {
                $search = $this->data['ActionItem']['global_search'];

                array_push($search_condition, array('OR' => array($this->Lead->getVirtualField('fullname') . ' LIKE' => "%" . mysql_escape_string(trim(strip_tags($search))) . "%", 'Project.project_name' . ' LIKE' => "%" . mysql_escape_string(trim(strip_tags($search))) . "%", 'Builder.builder_name' . ' LIKE' => "%" . mysql_escape_string(trim(strip_tags($search))) . "%")));
            }

            if (!empty($this->data['ActionItem']['action_item_level_id'])) {
                $search = $this->data['ActionItem']['action_item_level_id'];
                array_push($search_condition, array('ActionItem.action_item_level_id' => mysql_escape_string(trim(strip_tags($search)))));
            }

            if (!empty($this->data['ActionItem']['type_id'])) {
                $search = $this->data['ActionItem']['type_id'];
                array_push($search_condition, array('ActionItem.type_id' => mysql_escape_string(trim(strip_tags($search)))));
            }

            if (!empty($this->data['ActionItem']['lead_status'])) {
                $search = $this->data['ActionItem']['lead_status'];
                array_push($search_condition, array('Lead.lead_status' => mysql_escape_string(trim(strip_tags($search)))));
            }
        }

        if ($dummy_status)
            array_push($search_condition, array('ActionItem.dummy_status' => $dummy_status));

        if (count($this->params['pass']))
            array_push($search_condition, array('ActionItem.action_item_level_id' => $this->params['pass'][0])); // when builder is approve/pending
/*
        $this->paginateaction['conditions'][0] = "ActionItem.action_item_active='Yes' AND ActionItem.next_action_by = " . $user_id . "";
//        $this->paginateaction['conditions'][0] = "ActionItem.action_item_active='Yes' AND ActionItem.next_action_by=146";        
        $this->paginateaction['conditions'][1] = $search_condition;
        $this->paginateaction['order'] = array('ActionItem.id' => 'desc');
*/  
        $this->paginate['conditions'][0] = "ActionItem.action_item_active='Yes' AND ActionItem.next_action_by = " . $user_id . "";
//        $this->paginateaction['conditions'][0] = "ActionItem.action_item_active='Yes' AND ActionItem.next_action_by=146";        
        $this->paginate['conditions'][1] = $search_condition;
//        $this->paginate['limit'] = 25;
        $this->paginate['order'] = array('ActionItem.id' => 'desc');        
        $this->set('actionitems', $this->paginate("ActionItem"));

        //$log = $this->ActionItem->getDataSource()->getLog(false, false);       
        //  debug($log);
        // die;
        // pr($actionitems);

        $all_action = $this->ActionItem->find('count', array('conditions' => array('OR' => array('ActionItem.next_action_by' => $user_id, 'ActionItem.created_by_id' => $user_id))));
        $this->set(compact('all_action'));

        $all_action_pending = $this->ActionItem->find('count', array('conditions' => array('ActionItem.next_action_by' => $user_id, 'ActionItem.action_item_active' => 'Yes')));
        $this->set(compact('all_action_pending'));


        $builder_action_pending = $this->ActionItem->find('count', array('conditions' => array('ActionItem.action_item_active' => 'Yes', 'ActionItem.action_item_level_id' => '2', 'ActionItem.next_action_by' => $user_id)));
        $this->set(compact('builder_action_pending'));

        $project_action_pending = $this->ActionItem->find('count', array('conditions' => array('ActionItem.action_item_active' => 'Yes', 'ActionItem.action_item_level_id' => '3', 'ActionItem.next_action_by' => $user_id)));
        $this->set(compact('project_action_pending'));

        $client_action_pending = $this->ActionItem->find('count', array('conditions' => array('ActionItem.action_item_active' => 'Yes', 'ActionItem.action_item_level_id' => '1', 'ActionItem.next_action_by' => $user_id)));
        $this->set(compact('client_action_pending'));

        $client_allaction_pending = $this->ActionItem->find('count', array('conditions' => array('OR' => array('ActionItem.action_item_level_id' => '1', 'ActionItem.action_item_level_id' => '10'), 'ActionItem.action_item_active' => 'Yes', 'ActionItem.next_action_by' => $user_id)));
        $this->set(compact('client_allaction_pending'));

        $client_oldaction_pending = $this->ActionItem->find('count', array('conditions' => array('ActionItem.action_item_active' => 'Yes', 'ActionItem.action_item_level_id' => '10', 'ActionItem.next_action_by' => $user_id)));
        $this->set(compact('client_oldaction_pending'));

        $client_newaction_pending = $this->ActionItem->find('count', array('conditions' => array('ActionItem.action_item_active' => 'Yes', 'ActionItem.action_item_level_id' => '1', 'ActionItem.next_action_by' => $user_id)));
        $this->set(compact('client_newaction_pending'));

        $action_level = $this->ActionItemLevel->find('list', array('fields' => array('id', 'level'), 'order' => 'level asc'));
        $this->set(compact('action_level'));

        $status = $this->LeadStatus->find('list', array('fields' => array('id', 'status')));
        $this->set(compact('status'));

        $action_type = $this->ActionItemType->find('list', array('fields' => array('id', 'type'), 'order' => 'type asc'));
        $this->set(compact('action_type'));

        $returns = $this->LookupValueActionItemReturn->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('returns'));
    }

    public function add($actio_itme_id = null) {
        $this->layout = '';


        /*         * *******Checking user*********** */
        $dummy_status = $this->Auth->user('dummy_status');
        $channel_id = $this->Session->read("channel_id");
        $channels = $this->Channel->findById($channel_id);
        $channel_head = $channels['Channel']['channel_head'];
        $channel_city_id = $channels['Channel']['city_id'];
        $user_id = $this->Auth->user('id');
        $role_id = $this->Session->read("role_id");
        $roles = $this->Role->find('all', array('conditions' => 'Role.id = ' . $role_id));
        $group_user = $roles[0]['Role']['id'];
        $id = $this->Auth->user("id");
        $condition_dummy_status = array('dummy_status' => $dummy_status);
        $general_exu_id = '';
        $type = '';
        $client = array();


        $actionitems = $this->ActionItem->findById($actio_itme_id);

        if ($actionitems['ActionItem']['lead_id']) {
            $client = $this->Lead->findById($actionitems['ActionItem']['lead_id']);
            $this->set(compact('client'));
        }

        $this->set(compact('actionitems'));
        $city_id = $actionitems['Lead']['city_id'];

        if ($actionitems['ActionItem']['action_item_level_id'] == '2')
            $this->set('user_type', 'Builder');
        else if ($actionitems['ActionItem']['action_item_level_id'] == '3')
            $this->set('user_type', 'Project');
        else if ($actionitems['ActionItem']['action_item_level_id'] == '5')
            $this->set('user_type', 'Builder Contact');
        else if ($actionitems['ActionItem']['action_item_level_id'] == '9')
            $this->set('user_type', 'Expenses');
        else
            $this->set('user_type', $actionitems['ActionItemLevel']['level']);

        if ($role_id == '4' && $actionitems['ActionItem']['type_id'] == '8' && ($actionitems['ActionItem']['action_item_level_id'] == '1' || $actionitems['ActionItem']['action_item_level_id'] == '10')) { //cheking for Global Administration Channel or Global Business Admin Channel from chennels table   
            $this->set('user_type', 'Global');
            $type = $this->ActionItemType->find('list', array('fields' => array('id', 'type'), 'conditions' => 'ActionItemType.id = 5 OR ActionItemType.id = 9 OR ActionItemType.id = 8'));
        } else if ($role_id == '4' && $actionitems['ActionItem']['type_id'] == '10' && ($actionitems['ActionItem']['action_item_level_id'] == '1' || $actionitems['ActionItem']['action_item_level_id'] == '10')) { //cheking for Global Administration Channel or Global Business Admin Channel from chennels table   
            $this->set('user_type', 'Global');
            $type = $this->ActionItemType->find('list', array('fields' => array('id', 'type'), 'conditions' => 'ActionItemType.id = 5 OR ActionItemType.id = 9'));
        } else if ($role_id == '4') { //cheking for Global Administration Channel or Global Business Admin Channel from chennels table   
            //$this->set('user_type','Global');
            $type = $this->ActionItemType->find('list', array('fields' => array('id', 'type'), 'conditions' => 'ActionItemType.id = 4 OR ActionItemType.id = 9 OR ActionItemType.id = 8'));
        } else if ($role_id == '7') { //cheking for Global Administration Channel or Global Business Admin Channel from chennels table   
            $this->set('user_type', 'Global');
            $type = $this->ActionItemType->find('list', array('fields' => array('id', 'type'), 'conditions' => 'ActionItemType.id = 3 OR ActionItemType.id = 8'));
        } else if ($actionitems['ActionItem']['type_id'] == '7') {

            $type = $this->ActionItemType->find('list', array('fields' => array('id', 'type'), 'conditions' => 'ActionItemType.id = 6 OR ActionItemType.id = 8  OR ActionItemType.id = 9'));
        } else if ($actionitems['ActionItem']['type_id'] == '10') {

            $type = $this->ActionItemType->find('list', array('fields' => array('id', 'type'), 'conditions' => 'ActionItemType.id = 6 OR ActionItemType.id = 8'));
        } else if ($actionitems['ActionItem']['type_id'] == '18') {

            $type = $this->ActionItemType->find('list', array('fields' => array('id', 'type'), 'conditions' => 'ActionItemType.id = 18 OR ActionItemType.id = 8'));
        }

        /*
          elseif($group_user == '7' ){ // FOR PRIMARY MANAGER
          $this->set('user_type','Execution');
          $type = $this->ActionItemType->find('list',array('fields' => array('id','type'),'conditions' =>'ActionItemType.id = 3  OR ActionItemType.id = 8'));
          }

          elseif($group_user == '8' ){ // FOR TEAM MEMBER
          $this->set('user_type','Team');
          $type = $this->ActionItemType->find('list',array('fields' => array('id','type'),'conditions' =>'ActionItemType.id = 3 OR ActionItemType.id = 8')); // 2 = Acceptance , 8 = Return of action_item_types
          } */ else { // FOR DDATA GLOBAL
            $this->set('user_type', 'Global');
            $type = $this->ActionItemType->find('list', array('fields' => array('id', 'type'), 'conditions' => 'ActionItemType.id = 10')); // 10 = Re-Submission For Approval
        }


        $this->set(compact('type'));


        // die;


        if ($this->request->is('post')) {

            /*             * ************This data is common features **************************************** */

            $this->request->data['ActionItem']['parent_action_item_id'] = $actio_itme_id;
            $this->request->data['ActionItem']['dummy_status'] = $dummy_status;
            $this->request->data['ActionItem']['action_item_created'] = date('Y-m-d');
            $this->request->data['ActionItem']['created_by_id'] = $id;
            $this->request->data['ActionItem']['action_item_active'] = 'Yes';
            $this->request->data['ActionItem']['created_by'] = $id;
            $this->request->data['Remark']['remarks_time'] = date('g:i A');
            $this->request->data['Remark']['remarks_by'] = $id;
            $this->request->data['Remark']['created_by'] = $id;
            $this->request->data['Remark']['remarks_date'] = date('Y-m-d');
            $this->request->data['Remark']['dummy_status'] = $dummy_status;
            $this->request->data['ActionItem']['action_item_source'] = $role_id;
            $this->request->data['ActionItem']['action_industry'] = '1'; // for realestate of lookup_value_activity_industry



            if ($actionitems['ActionItem']['action_item_level_id'] == 1 || $actionitems['ActionItem']['action_item_level_id'] == 10) { // for client
                $this->request->data['ActionItem']['lead_id'] = $actionitems['ActionItem']['lead_id'];
                $this->request->data['Remark']['remarks_level'] = '3'; //3 for client from lookup_value_remarks_level
                $this->request->data['Remark']['lead_id'] = $actionitems['ActionItem']['lead_id'];

                if ($this->data['ActionItem']['type_id'] == 9)
                    $this->request->data['Lead']['lead_status'] = '6'; // for Dropped

                if ($this->data['ActionItem']['type_id'] == 4)
                    $this->request->data['Lead']['lead_status'] = '2'; // for allcated	

                if ($this->data['ActionItem']['type_id'] == 10) { // Re-submission
                    $this->request->data['Lead']['lead_status'] = '9'; // for Re-submitted	
                    $next_action_by = '146';
                    $this->request->data['ActionItem']['description'] = 'Client Re-submission by ' . strtoupper($this->User->Username($user_id)) . ' to ' . strtoupper($this->User->Username(146)) . ' because of reason - ' . strtoupper($this->data['ActionItem']['other_return']);
                    $this->request->data['Remark']['remarks'] = 'Client Re-submission  by ' . strtoupper($this->User->Username($user_id)) . ' to ' . strtoupper($this->User->Username(146)) . ' because of reason - ' . strtoupper($this->data['ActionItem']['other_return']);
                }

                if ($this->data['ActionItem']['type_id'] == 8) {
                    $this->request->data['Lead']['lead_status'] = '5'; // for return	
                    $this->request->data['Lead']['lead_managersecondary'] = NULL;
                    $this->request->data['Lead']['lead_managerprimary'] = NULL;
                    $this->request->data['Lead']['lead_channel'] = NULL;
                }
            }

            if ($actionitems['ActionItem']['action_item_level_id'] == 2) { // for builder
                $this->request->data['ActionItem']['builder_id'] = $actionitems['ActionItem']['builder_id'];
                $this->request->data['Remark']['remarks_level'] = '1'; //1 for builder from lookup_value_remarks_level
                $this->request->data['Remark']['builder_id'] = $actionitems['ActionItem']['builder_id'];
                $this->request->data['Builder']['builder_approved'] = '1'; // for approved
                $next_action_by = '136';
                if ($actionitems['ActionItem']['screen_no'] == 'SC-1')
                    $this->request->data['Builder']['builder_active_primary'] = '0'; // screen primary info.
                if ($actionitems['ActionItem']['screen_no'] == 'SC-2')
                    $this->request->data['Builder']['builder_active_operation'] = '0'; // screen details.
            }
            
            if ($actionitems['ActionItem']['action_item_level_id'] == '16') { // for owner
                $this->request->data['ActionItem']['owner_id'] = $actionitems['ActionItem']['owner_id'];
                $this->request->data['Remark']['remarks_level'] = '11'; //11 for owner from lookup_value_remarks_level
                $this->request->data['Remark']['owner_id'] = $actionitems['ActionItem']['owner_id'];
                $this->request->data['Owner']['owner_approved'] = '1'; // for approved
                $next_action_by = '136';
                if ($actionitems['ActionItem']['screen_no'] == 'SC-1')
                    $this->request->data['Owner']['owner_active_primary'] = '0'; // screen primary info.
                if ($actionitems['ActionItem']['screen_no'] == 'SC-2')
                    $this->request->data['Owner']['owner_active_operation'] = '0'; // screen details.
                if ($actionitems['ActionItem']['screen_no'] == 'SC-3')
                    $this->request->data['Owner']['owner_active_contact'] = '0'; // screen details.
            }
            
            if ($actionitems['ActionItem']['action_item_level_id'] == '17') { // for consultant
                $this->request->data['ActionItem']['consultant_id'] = $actionitems['ActionItem']['consultant_id'];
                $this->request->data['Remark']['remarks_level'] = '11'; //11 for owner from lookup_value_remarks_level
                $this->request->data['Remark']['consultant_id'] = $actionitems['ActionItem']['consultant_id'];
                $this->request->data['Consultant']['consultant_approved'] = '1'; // for approved
                $next_action_by = '136';
                if ($actionitems['ActionItem']['screen_no'] == 'SC-1')
                    $this->request->data['Consultant']['consultant_active_primary'] = '0'; // screen primary info.
                if ($actionitems['ActionItem']['screen_no'] == 'SC-2')
                    $this->request->data['Consultant']['consultant_active_operation'] = '0'; // screen details.
                if ($actionitems['ActionItem']['screen_no'] == 'SC-3')
                    $this->request->data['Consultant']['consultant_active_contact'] = '0'; // screen details.
            }
            if ($actionitems['ActionItem']['action_item_level_id'] == '18') { // for Property
                $this->request->data['ActionItem']['property_id'] = $actionitems['ActionItem']['property_id'];
                $this->request->data['Remark']['remarks_level'] = '11'; //11 for owner from lookup_value_remarks_level
                $this->request->data['Remark']['property_id'] = $actionitems['ActionItem']['property_id'];
                $this->request->data['Property']['prop_approved'] = '1'; // for approved
                $next_action_by = '136';
                
            }

            if ($actionitems['ActionItem']['action_item_level_id'] == 5) { // for builder contact
                $this->request->data['ActionItem']['builder_contact_id'] = $actionitems['ActionItem']['builder_contact_id'];
                $this->request->data['Remark']['remarks_level'] = '4'; //4 for builder contact from lookup_value_remarks_level
                $this->request->data['Remark']['builder_contact_id'] = $actionitems['ActionItem']['builder_contact_id'];
                $this->request->data['BuilderContact']['builder_contact_approved'] = '1'; // for approved
                $this->request->data['BuilderContact']['builder_contact_approved_by'] = $user_id; // for approved
                $this->request->data['BuilderContact']['builder_contact_approved_date'] = "'" . date('Y-m-d') . "'"; // for approved
                $next_action_by = '136';
            }
            if ($actionitems['ActionItem']['action_item_level_id'] == 12) { // for builder legal name
                $this->request->data['ActionItem']['builder_legalname_id'] = $actionitems['ActionItem']['builder_legalname_id'];
                $this->request->data['Remark']['remarks_level'] = '7'; // for builder legal name from lookup_value_remarks_level
                $this->request->data['Remark']['builder_legalname_id'] = $actionitems['ActionItem']['builder_legalname_id'];
                $this->request->data['BuilderLegalName']['builder_legal_name_approved'] = '1'; // for approved
                $this->request->data['BuilderLegalName']['builder_legal_name_approved_by'] = $user_id; // for approved
                $this->request->data['BuilderLegalName']['builder_legal_name_approved_date'] = "'" . date('Y-m-d') . "'"; // for approved
                $next_action_by = '136';
            }
            if ($actionitems['ActionItem']['action_item_level_id'] == 13) { // for project legal name
                $this->request->data['ActionItem']['project_legalname_id'] = $actionitems['ActionItem']['project_legalname_id'];
                $this->request->data['Remark']['remarks_level'] = '8'; // for builder legal name from lookup_value_remarks_level
                $this->request->data['Remark']['project_legalname_id'] = $actionitems['ActionItem']['project_legalname_id'];
                $this->request->data['ProjectLegalName']['project_legal_names_approved'] = '1'; // for approved
                $this->request->data['ProjectLegalName']['project_legal_names_approved_by'] = $user_id; // for approved
                $this->request->data['ProjectLegalName']['project_legal_names_approved_date'] = "'" . date('Y-m-d') . "'"; // for approved
            }
            if ($actionitems['ActionItem']['action_item_level_id'] == 14) { // for marketing partner
                $this->request->data['ActionItem']['marketing_partner_id'] = $actionitems['ActionItem']['marketing_partner_id'];
                $this->request->data['Remark']['remarks_level'] = '9'; // for marketing partner from lookup_value_remarks_level
                $this->request->data['Remark']['marketing_partner_id'] = $actionitems['ActionItem']['marketing_partner_id'];
                $this->request->data['MarketingPartner']['marketing_partner_approved'] = '1'; // for approved
                $this->request->data['MarketingPartner']['marketing_partner_approved_by'] = $user_id; // for approved
                $this->request->data['MarketingPartner']['marketing_partner_approved_date'] = "'" . date('Y-m-d') . "'"; // for approved
                if ($actionitems['ActionItem']['screen_no'] == 'SC-1')
                    $this->request->data['MarketingPartner']['marketing_partner_active_primary'] = '0'; // screen primary info.
                if ($actionitems['ActionItem']['screen_no'] == 'SC-2')
                    $this->request->data['MarketingPartner']['marketing_partner_active_operation'] = '0'; // screen details.
            }
            if ($actionitems['ActionItem']['action_item_level_id'] == 7) { // for project contact
                $this->request->data['ActionItem']['project_contact_id'] = $actionitems['ActionItem']['project_contact_id'];
                $this->request->data['Remark']['remarks_level'] = '5'; //4 for project contact from lookup_value_remarks_level
                $this->request->data['Remark']['project_id'] = $actionitems['ActionItem']['project_id'];
                $this->request->data['ProjectContact']['project_contact_approved'] = '1'; // for approved
                $this->request->data['ProjectContact']['project_contact_approved_by'] = $user_id; // for approved
                $this->request->data['ProjectContact']['project_contact_approved_date'] = "'" . date('Y-m-d') . "'"; // for approved
                $next_action_by = '136';
            }


            if ($actionitems['ActionItem']['action_item_level_id'] == 11) { // for project unit
                $this->request->data['ActionItem']['project_unit_id'] = $actionitems['ActionItem']['project_unit_id'];
                $this->request->data['Remark']['remarks_level'] = '6'; //6 for Project Unit from lookup_value_remarks_level
                $this->request->data['Remark']['project_unit_id'] = $actionitems['ActionItem']['project_unit_id'];

                $this->request->data['ProjectUnit']['unit_approved'] = '1'; // for approved
                $this->request->data['ProjectUnit']['unit_approved_by'] = $user_id; // for approved
                $this->request->data['ProjectUnit']['unit_approved_date'] = "'" . date('Y-m-d') . "'"; // for 
                $next_action_by = '136';
            }

            if ($actionitems['ActionItem']['action_item_level_id'] == 3) { // for project
                $this->request->data['ActionItem']['project_id'] = $actionitems['ActionItem']['project_id'];
                $this->request->data['Remark']['remarks_level'] = '2'; //2 for project from lookup_value_remarks_level
                $this->request->data['Remark']['project_id'] = $actionitems['ActionItem']['project_id'];
                $this->request->data['Project']['proj_approved'] = '1'; // for approved
                $next_action_by = '136';
                if ($actionitems['ActionItem']['screen_no'] == 'SC-1')
                    $this->request->data['Project']['proj_active_primary'] = '0'; // screen primary info.
                if ($actionitems['ActionItem']['screen_no'] == 'SC-2')
                    $this->request->data['Project']['proj_active_details'] = '0'; // screen details.
                if ($actionitems['ActionItem']['screen_no'] == 'SC-4')
                    $this->request->data['Project']['proj_active_amenities'] = '0'; // screen amenities.		
            }



            if ($this->data['ActionItem']['type_id'] == 8) { // for return
                $this->request->data['ActionItem']['action_item_status'] = '8'; // 8 for Return of lookup_value_action_item_statuses


                if ($actionitems['ActionItem']['action_item_level_id'] == 1 || $actionitems['ActionItem']['action_item_level_id'] == 10) { // for client
                    if ($role_id == '4') {
                        $this->request->data['ActionItem']['next_action_by'] = $this->getParentNode($actionitems['ActionItem']['lead_id']);
                        $this->request->data['ActionItem']['description'] = 'Client Returned by ' . strtoupper($this->User->Username($user_id)) . ' to ' . strtoupper($this->User->Username($this->getParentNode($actionitems['ActionItem']['lead_id']))) . ' because of reason - ' . strtoupper($this->data['ActionItem']['other_return']);
                        $this->request->data['Remark']['remarks'] = 'Client Returned by ' . strtoupper($this->User->Username($user_id)) . ' to ' . strtoupper($this->User->Username($this->getParentNode($actionitems['ActionItem']['lead_id']))) . ' because of reason - ' . strtoupper($this->data['ActionItem']['other_return']);
                    } else {
                        $this->request->data['ActionItem']['next_action_by'] = $actionitems['ActionItem']['created_by'];
                        $this->request->data['ActionItem']['description'] = 'Client Returned by ' . strtoupper($this->User->Username($user_id)) . ' to ' . strtoupper($this->User->Username($actionitems['ActionItem']['created_by'])) . ' because of reason - ' . strtoupper($this->data['ActionItem']['other_return']);
                        $this->request->data['Remark']['remarks'] = 'Client Returned by ' . strtoupper($this->User->Username($user_id)) . ' to ' . strtoupper($this->User->Username($actionitems['ActionItem']['created_by'])) . ' because of reason - ' . strtoupper($this->data['ActionItem']['other_return']);
                    }
                } else {

                    $this->request->data['ActionItem']['description'] = 'Return';
                    $this->request->data['Remark']['remarks'] = 'Rrturn';
                    $this->request->data['ActionItem']['next_action_by'] = $actionitems['ActionItem']['created_by'];
                }
            }
            if ($this->data['ActionItem']['type_id'] == 18) { // for Transaction Reported
                $this->request->data['ActionItem']['next_action_by'] = $actionitems['ActionItem']['created_by'];
                $this->request->data['Lead']['lead_status'] = '12';
                $this->request->data['Deal']['deal_status'] = '2';
                $this->request->data['ActionItem']['action_item_status'] = '22';
            }

            if ($this->data['ActionItem']['type_id'] == 9) { // for rejection
                $this->request->data['ActionItem']['next_action_by'] = NULL;
                $this->request->data['ActionItem']['action_item_status'] = '9'; // for rejection of lookup_value_action_item_statuses

                if ($actionitems['ActionItem']['action_item_level_id'] == 1 || $actionitems['ActionItem']['action_item_level_id'] == 10) { // for client
                    $this->request->data['ActionItem']['description'] = 'Client Rejected by ' . strtoupper($this->User->Username($user_id)) . ' because of reason ' . strtoupper($this->data['ActionItem']['other_rejection']);
                    $this->request->data['Remark']['remarks'] = 'Client Rejected by ' . strtoupper($this->User->Username($user_id)) . ' because of reason ' . strtoupper($this->data['ActionItem']['other_rejection']);
                } else {
                    $this->request->data['ActionItem']['description'] = 'Rejection';
                    $this->request->data['Remark']['remarks'] = 'Rejection';
                }
            }

            if ($this->data['ActionItem']['type_id'] == 2) {  // 2 for acceptance.
                $this->request->data['ActionItem']['description'] = 'Acceptance';
                $this->request->data['Remark']['remarks'] = 'Acceptance';
                $this->request->data['Lead']['lead_status'] = '4'; // 4 for Activation of lookup_value_leads_statuses
                $this->request->data['ActionItem']['next_action_by'] = NULL;
                $this->request->data['ActionItem']['action_item_status'] = '2'; // for acceptance of lookup_value_action_item_statuses
            }

            if ($this->data['ActionItem']['type_id'] == 4) {  // 4 for Allocation.
                $this->request->data['Lead']['lead_managerprimary'] = $this->request->data['ActionItem']['primary_manager_id'];
                $this->request->data['ActionItem']['next_action_by'] = $this->request->data['ActionItem']['primary_manager_id'];
                $this->request->data['Lead']['lead_status'] = '2'; // for allocated of lead_statues
                $this->request->data['Lead']['lead_channel'] = $this->data['ActionItem']['allocated_channel_id'];
                $this->request->data['ActionItem']['description'] = 'Client Allocated by ' . strtoupper($this->User->Username($user_id)) . ' to ' . strtoupper($this->User->Username($this->request->data['ActionItem']['primary_manager_id']));
                $this->request->data['ActionItem']['builder_id'] = NULL;
                $this->request->data['ActionItem']['project_id'] = NULL;
                $this->request->data['Remark']['remarks'] = 'Client Allocated by ' . strtoupper($this->User->Username($user_id)) . ' to ' . strtoupper($this->User->Username($this->request->data['ActionItem']['primary_manager_id']));
                $this->request->data['ActionItem']['action_item_status'] = '4'; // for Allocation of lookup_value_action_item_statuses
            }


            if ($this->data['ActionItem']['type_id'] == 6) {  // 6 for Approval.
                $this->request->data['ActionItem']['description'] = 'Approval';
                $this->request->data['Remark']['remarks'] = 'Approval';
                $this->request->data['ActionItem']['next_action_by'] = NULL;
                $this->request->data['ActionItem']['action_item_status'] = '6'; // for Approval of lookup_value_action_item_statuses
            }
            if ($this->data['ActionItem']['type_id'] == 5) {  // 5 for Re-Allocated of action_status.
                $this->request->data['Lead']['lead_managerprimary'] = $this->request->data['ActionItem']['primary_manager_id'];
                $this->request->data['ActionItem']['next_action_by'] = $this->request->data['ActionItem']['primary_manager_id'];
                $this->request->data['Lead']['lead_status'] = '3'; // for allocated of lead_statues
                $this->request->data['Lead']['lead_channel'] = $this->data['ActionItem']['allocated_channel_id'];
                $this->request->data['ActionItem']['description'] = 'Client re-allocated by ' . strtoupper($this->User->Username($user_id)) . ' to ' . strtoupper($this->User->Username($this->request->data['ActionItem']['primary_manager_id']));
                $this->request->data['ActionItem']['builder_id'] = NULL;
                $this->request->data['ActionItem']['project_id'] = NULL;
                $this->request->data['Remark']['remarks'] = 'Client re-allocated by ' . strtoupper($this->User->Username($user_id)) . ' to ' . strtoupper($this->User->Username($this->request->data['ActionItem']['primary_manager_id']));
                $this->request->data['ActionItem']['action_item_status'] = '5'; // for Allocation of lookup_value_action_item_statuses
            }
            if ($this->data['ActionItem']['type_id'] == 3) {  // 3 for Activates.
                $this->request->data['ActionItem']['description'] = 'Client activated by ' . strtoupper($this->User->Username($user_id));
                $this->request->data['Remark']['remarks'] = 'Client activated by ' . strtoupper($this->User->Username($user_id));

                $this->request->data['ActionItem']['action_item_status'] = '3'; // for Activates of lookup_value_action_item_statuses 

                $this->request->data['ActionItem']['next_action_by'] = NULL;


                $this->request->data['Lead']['lead_fname'] = $this->data['ActionItem']['lead_fname'];
                $this->request->data['Lead']['lead_status'] = '4'; //Activate of lead_status.
                $this->request->data['Lead']['lead_primary_phone_country_code'] = $this->data['ActionItem']['lead_primary_phone_country_code'];
                $this->request->data['Lead']['lead_primaryphonenumber'] = $this->data['ActionItem']['lead_primaryphonenumber'];
                $this->request->data['Lead']['lead_emailid'] = $this->data['ActionItem']['lead_emailid'];
                $this->request->data['Lead']['lead_type'] = $this->data['ActionItem']['lead_type'];
                $this->request->data['Lead']['lead_budget_unit'] = $this->data['ActionItem']['lead_budget_unit'];
                $this->request->data['Lead']['lead_budget'] = $this->data['ActionItem']['lead_budget'];
                $this->request->data['Lead']['lead_progress'] = $this->data['ActionItem']['lead_progress'];
                $this->request->data['Lead']['lead_importance'] = $this->data['ActionItem']['lead_importance'];
                $this->request->data['Lead']['lead_lname'] = $this->data['ActionItem']['lead_lname'];
                $this->request->data['Lead']['lead_secondary_phone_country_code'] = $this->data['ActionItem']['lead_secondary_phone_country_code'];
                $this->request->data['Lead']['lead_secondaryphonenumber'] = $this->data['ActionItem']['lead_secondaryphonenumber'];
                $this->request->data['Lead']['lead_country'] = $this->data['ActionItem']['lead_country'];
                $this->request->data['Lead']['lead_segment'] = $this->data['ActionItem']['lead_segment'];
                $this->request->data['Lead']['lead_special_client_status'] = $this->data['ActionItem']['lead_special_client_status'];
                $this->request->data['Lead']['lead_closureprobabilityinnext1Month'] = $this->data['ActionItem']['lead_closureprobabilityinnext1Month'];
                $this->request->data['Lead']['lead_urgency'] = $this->data['ActionItem']['lead_urgency'];
                $this->request->data['Lead']['lead_suburb1'] = $this->data['ActionItem']['lead_suburb1'];
                $this->request->data['Lead']['lead_suburb2'] = $this->data['ActionItem']['lead_suburb2'];
                $this->request->data['Lead']['lead_suburb3'] = $this->data['ActionItem']['lead_suburb3'];
                $this->request->data['Lead']['lead_areapreference1'] = $this->data['ActionItem']['lead_areapreference1'];
                $this->request->data['Lead']['lead_areapreference2'] = $this->data['ActionItem']['lead_areapreference2'];
                $this->request->data['Lead']['lead_areapreference3'] = $this->data['ActionItem']['lead_areapreference3'];
                $this->request->data['Lead']['builder_id1'] = $this->data['ActionItem']['builder_id1'];
                $this->request->data['Lead']['builder_id2'] = $this->data['ActionItem']['builder_id2'];
                $this->request->data['Lead']['builder_id3'] = $this->data['ActionItem']['builder_id3'];
                $this->request->data['Lead']['proj_id1'] = $this->data['ActionItem']['proj_id1'];
                $this->request->data['Lead']['proj_id2'] = $this->data['ActionItem']['proj_id2'];
                $this->request->data['Lead']['proj_id3'] = $this->data['ActionItem']['proj_id3'];
                $this->request->data['Lead']['lead_unit_id_1'] = $this->data['ActionItem']['lead_unit_id_1'];
                $this->request->data['Lead']['lead_unit_id_2'] = $this->data['ActionItem']['lead_unit_id_2'];
                $this->request->data['Lead']['lead_unit_id_3'] = $this->data['ActionItem']['lead_unit_id_3'];
                $this->request->data['Lead']['lead_typeofprojectpreference1'] = $this->data['ActionItem']['lead_typeofprojectpreference1'];
                $this->request->data['Lead']['lead_typeofprojectpreference2'] = $this->data['ActionItem']['lead_typeofprojectpreference2'];
                $this->request->data['Lead']['lead_typeofprojectpreference3'] = $this->data['ActionItem']['lead_typeofprojectpreference3'];

                $date1 = date('Y-m-d', strtotime($this->data['Event']['date1']));
                if ($this->data['Event']['date2'] == '')
                    $date2 = $date1;
                else
                    $date2 = date('Y-m-d', strtotime($this->data['Event']['date2']));
                $this->request->data['Event']['start_date'] = $date1 . " " . date("H:i", strtotime($this->data['Event']['start_time']));
                $this->request->data['Event']['end_date'] = $date2 . " " . date("H:i", strtotime($this->data['Event']['end_time']));
                $this->request->data['Event']['creator_id'] = $id;
                $this->request->data['Event']['user_id'] = $id;
                $this->request->data['Event']['activity_closed'] = 'Yes';
                $this->request->data['Event']['activity_status'] = '1';
                $this->request->data['Event']['activity_level'] = '1'; // client
                $this->request->data['Event']['activity_type'] = '1'; // call
                $this->request->data['Event']['role_city'] = $channel_city_id; // call
                $this->request->data['Event']['activity_completed'] = '1';
                $this->request->data['Event']['event_type'] = '3'; // call event
                $this->request->data['Event']['activity_industry'] = '1'; // call event
                $this->request->data['Event']['dummy_status'] = $dummy_status;
                $this->request->data['Event']['lead_id'] = $actionitems['ActionItem']['lead_id'];
                $this->Event->save($this->data['Event']); // insert data to CallingReport table
                $last_event_id = $this->Event->getLastInsertId();
            }
            if ($this->data['ActionItem']['type_id'] == 10) {
                $this->request->data['ActionItem']['action_item_status'] = '10'; // for Re-Approval of lookup_value_action_item_statuses
                $this->request->data['ActionItem']['next_action_by'] = $next_action_by;
            }
            /*
              if($this->data['ActionItem']['type_id'] == 8){  // 8 for return.

              $this->request->data['ActionItem']['description'] = 'Return';
              $this->request->data['Remark']['remarks'] = 'Return';
              $this->request->data['Lead']['lead_status'] = '5'; // 5 for Returned of lead status
              $this->request->data['ActionItem']['next_action_by'] = $actionitems['ActionItem']['created_by'];
              $this->request->data['ActionItem']['primary_manager_id'] = NULL;
              $this->request->data['Lead']['lead_managersecondary'] = NULL;
              $this->request->data['Lead']['lead_managerprimary'] = NULL;
              $this->request->data['ActionItem']['secondary_manager_id'] = NULL;
              $this->request->data['ActionItem']['action_item_status'] = '8'; // for lookup_value_action_item_statuses
              }
             */





            //$channels = $this->Channel->find('all',array('conditions' => array('Channel.id' => $channel_id)));
            // $to = $channels[0]['User']['company_email_id'];
            //$to = 'neerajs@wtbglobal.com';

            $this->ActionItem->create();
            if ($this->ActionItem->save($this->data['ActionItem'])) {
                $last_action_id = $this->ActionItem->getLastInsertId();
                $this->ActionItem->updateAll(array('ActionItem.action_item_active' => "'No'"), array('ActionItem.id' => $actio_itme_id));

                if ($actionitems['ActionItem']['action_item_level_id'] == 1 || $actionitems['ActionItem']['action_item_level_id'] == 10) {  // for client
                    $this->Lead->id = $actionitems['ActionItem']['lead_id'];
                    $this->Lead->save($this->data['Lead']);
                }

                if ($actionitems['ActionItem']['action_item_level_id'] == 2 && $this->data['ActionItem']['type_id'] == 6) {  // for builder
                    $this->Builder->updateAll($this->data['Builder'], array('Builder.id' => $actionitems['ActionItem']['builder_id']));
                }
                if ($actionitems['ActionItem']['action_item_level_id'] == 16 && $this->data['ActionItem']['type_id'] == 6) {  // for Owner
                    $this->Owner->updateAll($this->data['Owner'], array('Owner.id' => $actionitems['ActionItem']['owner_id']));
                }
                if ($actionitems['ActionItem']['action_item_level_id'] == 17 && $this->data['ActionItem']['type_id'] == 6) {  // for Consultant
                    $this->Consultant->updateAll($this->data['Consultant'], array('Consultant.id' => $actionitems['ActionItem']['consultant_id']));
                }
                if ($actionitems['ActionItem']['action_item_level_id'] == 18 && $this->data['ActionItem']['type_id'] == 6) {  // for property
                    $this->Property->updateAll($this->data['Property'], array('Property.id' => $actionitems['ActionItem']['property_id']));
                }

                if ($actionitems['ActionItem']['action_item_level_id'] == 3 && $this->data['ActionItem']['type_id'] == 6) {  // for Project
                    $this->Project->updateAll($this->data['Project'], array('Project.id' => $actionitems['ActionItem']['project_id']));
                }
                if ($actionitems['ActionItem']['action_item_level_id'] == 5 && $this->data['ActionItem']['type_id'] == 6) {  // for Builder Contact
                    $this->BuilderContact->updateAll($this->data['BuilderContact'], array('BuilderContact.id' => $actionitems['ActionItem']['builder_contact_id']));
                }
                if ($actionitems['ActionItem']['action_item_level_id'] == 7 && $this->data['ActionItem']['type_id'] == 6) {  // for Project Contact
                    $this->ProjectContact->updateAll($this->data['ProjectContact'], array('ProjectContact.id' => $actionitems['ActionItem']['project_contact_id']));
                }
                if ($actionitems['ActionItem']['action_item_level_id'] == 11 && $this->data['ActionItem']['type_id'] == 6) {  // for Project Unit
                    $this->ProjectUnit->updateAll($this->data['ProjectUnit'], array('ProjectUnit.id' => $actionitems['ActionItem']['project_unit_id']));
                }
                if ($actionitems['ActionItem']['action_item_level_id'] == 12 && $this->data['ActionItem']['type_id'] == 6) {  // for Builder Legal Name
                    $this->BuilderLegalName->updateAll($this->data['BuilderLegalName'], array('BuilderLegalName.id' => $actionitems['ActionItem']['builder_legalname_id']));
                }
                if ($actionitems['ActionItem']['action_item_level_id'] == 13 && $this->data['ActionItem']['type_id'] == 6) {  // for Project Legal Name
                    $this->ProjectLegalName->updateAll($this->data['ProjectLegalName'], array('ProjectLegalName.id' => $actionitems['ActionItem']['project_legalname_id']));
                }
                if ($actionitems['ActionItem']['action_item_level_id'] == 14 && $this->data['ActionItem']['type_id'] == 6) {  // for marketing partner
                    $this->MarketingPartner->updateAll($this->data['MarketingPartner'], array('MarketingPartner.id' => $actionitems['ActionItem']['marketing_partner_id']));
                }

                if ($actionitems['ActionItem']['action_item_level_id'] == 11 && $this->data['ActionItem']['type_id'] == 9) {  // for Builder Legal Name
                    $rejection_unit['ProjectUnit']['unit_status'] = '2';
                    $this->ProjectUnit->updateAll($rejection_unit['ProjectUnit'], array('ProjectUnit.id' => $actionitems['ActionItem']['project_unit_id']));
                }

                if ($actionitems['ActionItem']['action_item_level_id'] == 7 && $this->data['ActionItem']['type_id'] == 9) {  // for Project Contact Rejection
                    $rejection_unit['ProjectContact']['project_contact_status'] = '2';
                    $this->ProjectContact->updateAll($rejection_unit['ProjectContact'], array('ProjectContact.id' => $actionitems['ActionItem']['project_contact_id']));
                }
                if ($actionitems['ActionItem']['action_item_level_id'] == 16 && $this->data['ActionItem']['type_id'] == 9) {  // for owner Rejection
                    $rejection_unit['Owner']['owner_status'] = '2';
                    $this->Owner->updateAll($rejection_unit['Owner'], array('Owner.id' => $actionitems['ActionItem']['owner_id']));
                }
                if ($actionitems['ActionItem']['action_item_level_id'] == 17 && $this->data['ActionItem']['type_id'] == 9) {  // for consultant Rejection
                    $rejection_unit['Consultant']['consultant_status'] = '2';
                    $this->Consultant->updateAll($rejection_unit['Consultant'], array('Consultant.id' => $actionitems['ActionItem']['consultant_id']));
                }

                if ($actionitems['ActionItem']['action_item_level_id'] == 3 && $this->data['ActionItem']['type_id'] == 9) {  // for Project Rejection
                    $rejection['Project']['proj_status'] = '2';
                    $this->Project->updateAll($rejection['Project'], array('Project.id' => $actionitems['ActionItem']['project_id']));
                }
                if ($actionitems['ActionItem']['action_item_level_id'] == 14 && $this->data['ActionItem']['type_id'] == 9) {  // for marketing partner Rejection
                    $rejection['MarketingPartner']['marketing_partner_status'] = '2';
                    $this->MarketingPartner->updateAll($rejection['MarketingPartner'], array('MarketingPartner.id' => $actionitems['ActionItem']['marketing_partner_id']));
                }

                if ($actionitems['ActionItem']['action_item_level_id'] == 2 && $this->data['ActionItem']['type_id'] == 9) {  // for Builder Rejection
                    $rejection['Builder']['builder_status'] = '2';
                    $this->Builder->updateAll($rejection['Builder'], array('Builder.id' => $actionitems['ActionItem']['builder_id']));
                }
                if ($actionitems['ActionItem']['action_item_level_id'] == 2 && $this->data['ActionItem']['type_id'] == 18) {  // for transaction approve
                    $lead['Lead']['lead_status'] = '12';
                    $deal['Deal']['deal_status'] = '2';
                    $this->Lead->updateAll($lead['Lead'], array('Lead.id' => $actionitems['ActionItem']['lead_id']));
                    $this->Deal->updateAll($deal['Deal'], array('Deal.deal_id' => $actionitems['ActionItem']['lead_id']));
                }

                //$log = $this->ActionItem->getDataSource()->getLog(false, false);       
                //debug($log);
                // die;
                $this->Remark->save($this->data['Remark']);


                //$this->Session->write('success_msg', 'Action Item has been saved.');
                /* Email Logic */
                if (($this->data['ActionItem']['type_id'] == 4 || $this->data['ActionItem']['type_id'] == 3 || $this->data['ActionItem']['type_id'] == 5 || $this->data['ActionItem']['type_id'] == 8 || $this->data['ActionItem']['type_id'] == 9 || $this->data['ActionItem']['type_id'] == 10) && $last_action_id > 0 && ($actionitems['ActionItem']['action_item_level_id'] == '1' || $actionitems['ActionItem']['action_item_level_id'] == '10')) {
                    $actionArry = $this->ActionItem->findById($last_action_id);
                    $clientArry = $this->Lead->findById($actionArry['ActionItem']['lead_id']);

                    if ($last_event_id)
                        $eventtArry = $this->Event->findById($last_event_id);


                    //if($actionArry['Lead']['lead_source'] != 3){ // if source is not old client
                    $email_client_name = '';
                    $client_name = strtoupper($actionArry['Lead']['lead_fname']) . ' ' . strtoupper($actionArry['Lead']['lead_lname']);
                    $ActionType = strtoupper($actionArry['ActionType']['type']);
                    $LastAllocation = $this->ActionItem->GetLastAllocationDate($actionArry['ActionItem']['lead_id']);

                    if ($actionArry['Lead']['lead_source'] == 3) {
                        $client_info = 'OLD';
                        $client_call = 'Old Client Latest Status';
                    } else {
                        $client_info = 'NEW';
                        $client_call = 'Report First Call';
                    }


                    $Email = new CakeEmail();

                    $Email->viewVars(array(
                        'CreatedBy' => strtoupper($actionArry['CreatedBy']['fname'] . ' ' . $actionArry['CreatedBy']['lname']),
                        'NextActionBy' => strtoupper($actionArry['NextActionBy']['fname'] . ' ' . $actionArry['NextActionBy']['lname']),
                        'PhoneOfficer' => strtoupper($actionArry['PhoneOfficer']['fname'] . ' ' . $actionArry['PhoneOfficer']['lname']),
                        'Associate' => strtoupper($actionArry['Associate']['fname'] . ' ' . $actionArry['Associate']['lname']),
                        'lead_name' => strtoupper($actionArry['Lead']['lead_fname']) . ' ' . strtoupper($actionArry['Lead']['lead_lname']),
                        'AllocationHistory' => date("j M, Y H:i:s", strtotime($actionitems['ActionItem']['created'])),
                        'ReturnHistory' => date("j M, Y H:i:s", strtotime($actionArry['ActionItem']['created'])),
                        'LastAllocation' => $LastAllocation,
                        'LookupReturn' => strtoupper($actionArry['LookupReturn']['value']),
                        'LookupReject' => strtoupper($actionArry['LookupReject']['value']),
                        'Return' => strtoupper($actionArry['ActionItem']['other_return']),
                        'Reject' => strtoupper($actionArry['ActionItem']['other_rejection']),
                        'Description' => strtoupper($actionArry['Lead']['lead_description']),
                        /*                         * **************Lead Table****************** */
                        'Arrival' => date("j M, Y H:i:s", strtotime($clientArry['Lead']['created'])),
                        'lead_primaryphonenumber' => $clientArry['PrimaryCode']['code'] . '- ' . $actionArry['Lead']['lead_primaryphonenumber'],
                        'lead_emailid' => $clientArry['Lead']['lead_emailid'],
                        'Source' => strtoupper($clientArry['Source']['value']),
                        'City' => strtoupper(substr($clientArry['City']['city_name'], 0, 3)),
                        'Urgency' => strtoupper(substr($clientArry['Urgency']['value'], 0, 3)),
                        'Importance' => strtoupper(substr($clientArry['Importance']['value'], 0, 3)),
                        'Country' => strtoupper(substr($clientArry['Country']['value'], 0, 2)),
                        'ClosurProbability' => $clientArry['ClosurProbability']['value'],
                        'ProjectPref1' => strtoupper($clientArry['Project']['project_name']),
                        'ProjectPref2' => strtoupper($clientArry['Project2']['project_name']),
                        'ProjectPref3' => strtoupper($clientArry['Project3']['project_name']),
                        'BuilderPref1' => strtoupper($clientArry['Builder']['builder_name']),
                        'BuilderPref2' => strtoupper($clientArry['Builder2']['builder_name']),
                        'BuilderPref3' => strtoupper($clientArry['Builder3']['builder_name']),
                        'UnitPref1' => strtoupper($clientArry['Unit']['value']),
                        'UnitPref2' => strtoupper($clientArry['Unit2']['value']),
                        'UnitPref3' => strtoupper($clientArry['Unit3']['value']),
                        'AreaPref1' => strtoupper($clientArry['AreaPreference']['area_name']),
                        'AreaPref2' => strtoupper($clientArry['AreaPreference2']['area_name']),
                        'AreaPref3' => strtoupper($clientArry['AreaPreference3']['area_name']),
                        'SuburbPref1' => strtoupper($clientArry['Suburb']['suburb_name']),
                        'SuburbPref2' => strtoupper($clientArry['Suburb2']['suburb_name']),
                        'SuburbPref3' => strtoupper($clientArry['Suburb3']['suburb_name']),
                        'ProjectTypepPref1' => strtoupper($clientArry['ProjectType']['value']),
                        'ProjectTypepPref2' => strtoupper($clientArry['ProjectType2']['value']),
                        'ProjectTypepPref3' => strtoupper($clientArry['ProjectType3']['value']),
                        /*                         * **************Event Table****************** */
                        'client_info' => $client_info,
                        'client_call' => $client_call,
                        'StartDate' => date("j M, Y H:i:s", strtotime($eventtArry['Event']['start_date'])),
                        'EndDate' => date("j M, Y H:i:s", strtotime($eventtArry['Event']['end_date'])),
                        'CallDuration' => $eventtArry['Event']['call_duration'],
                        'Quality' => $eventtArry['CallQuality']['value'],
                        'EventDescription' => $eventtArry['Event']['event_description'],
                        'Details' => $eventtArry['Details']['value'],
                    ));



                    if ($this->data['ActionItem']['type_id'] == 4) { // Allocation
                        $to = 'infra@sumanus.com';
                        //$to = 'biswajit@wtbglobal.com';
                        $email_client_name = strtoupper($actionArry['NextActionBy']['fname'] . ' ' . $actionArry['NextActionBy']['mname'] . ' ' . $actionArry['NextActionBy']['lname']);
                        $Email->template('ActionItems/allocation', 'default')->emailFormat('html')->to($to)->from('admin@silkrouters.com')->subject($client_info . ' CLIENT ' . $ActionType . ' - ' . $client_name . ' (' . $email_client_name . ')')->send();
                    }
                    if ($this->data['ActionItem']['type_id'] == 5) { // RE-ALLOCATION
                        $to = 'infra@sumanus.com';
                        $email_client_name = strtoupper($actionArry['NextActionBy']['fname'] . ' ' . $actionArry['NextActionBy']['mname'] . ' ' . $actionArry['NextActionBy']['lname']);
                        $Email->template('ActionItems/re_allocation', 'default')->emailFormat('html')->to($to)->from('admin@silkrouters.com')->subject($client_info . ' CLIENT ' . $ActionType . ' - ' . $client_name . ' (' . $email_client_name . ')')->send();
                    }
                    if ($this->data['ActionItem']['type_id'] == 3) { // Active
                        $to = 'infra@sumanus.com';
                        //$to = 'biswajit@wtbglobal.com';
                        $email_client_name = strtoupper($actionArry['CreatedBy']['fname'] . ' ' . $actionArry['CreatedBy']['lname']);
                        $Email->template('ActionItems/activation', 'default')->emailFormat('html')->to($to)->from('admin@silkrouters.com')->subject($client_info . ' CLIENT ' . strtoupper($actionArry['ActionType']['type']) . ' - ' . $client_name . ' (' . $email_client_name . ')')->send();
                    }
                    if ($this->data['ActionItem']['type_id'] == 10) {  // Re-submission
                        $to = array('administrator@silkrouters.com', 'data@silkrouters.com');
                        //$to = 'biswajit@wtbglobal.com';
                        $cc = 'infra@sumanus.com';
                        $NextActionBy = $actionArry['NextActionBy']['fname'] . ' ' . $actionArry['NextActionBy']['lname'];
                        $Email->template('ActionItems/re_allocation', 'default')->emailFormat('html')->to($to)->cc($cc)->from('admin@silkrouters.com')->subject($client_info . ' CLIENT ' . $ActionType . ' - ' . $client_name . ' (' . $NextActionBy . ')')->send();
                    }

                    if ($this->data['ActionItem']['type_id'] == 8) { // return
                        if ($role_id == '4') {

                            $to = $this->User->GetRealEasteEmail($this->getParentNode($actionArry['ActionItem']['lead_id']));
                            //$to = 'biswajit@wtbglobal.com';
                            $cc = array('infra@sumanus.com', 'data@silkrouters.com', 'administrator@silkrouters.com');
                            $email_client_name = $actionArry['CreatedBy']['fname'] . ' ' . $actionArry['CreatedBy']['lname'];

                            $Email->template('ActionItems/return', 'default')->emailFormat('html')->to($to)->cc($cc)->from('admin@silkrouters.com')->subject($client_info . ' CLIENT ' . $ActionType . ' - ' . $client_name . ' (' . $email_client_name . ')')->send();
                        } else {
                            $to = array('administrator@silkrouters.com', 'data@silkrouters.com');
                            //$to = 'biswajit@wtbglobal.com';
                            $cc = 'infra@sumanus.com';
                            $email_client_name = $actionArry['CreatedBy']['fname'] . ' ' . $actionArry['CreatedBy']['lname'];
                            $lead_name = strtoupper($actionArry['Lead']['lead_fname'] . ' ' . $actionArry['Lead']['lead_lname']);
                            $Email->template('ActionItems/return_transaction', 'default')->emailFormat('html')->to($to)->cc($cc)->from('admin@silkrouters.com')->subject($client_info . ' CLIENT ' . $ActionType . ' - ' . $client_name . ' (' . $email_client_name . ')')->send();
                        }
                    }
                    if ($this->data['ActionItem']['type_id'] == 9 && $role_id == '4') { // rejection
                        $to_mail = $this->User->GetRealEasteEmail($this->getParentNode($actionArry['ActionItem']['lead_id']));
                        //die;
                        //$to = 'biswajit@wtbglobal.com';
                        $to = array('administrator@silkrouters.com', 'data@silkrouters.com');
                        if ($to_mail == '')
                            $cc = array('infra@sumanus.com');
                        else
                            $cc = array('infra@sumanus.com', $to_mail);
                        $email_client_name = $actionArry['CreatedBy']['fname'] . ' ' . $actionArry['CreatedBy']['lname'];
                        $Email->template('ActionItems/rejection', 'default')->emailFormat('html')->to($to)->cc($cc)->from('admin@silkrouters.com')->subject($client_info . ' CLIENT ' . $ActionType . ' - ' . $client_name . ' (' . $email_client_name . ')')->send();
                    }


                    //}
                }
                /* End Emial */
                /* Phone API */
                /*
                  $msg = $actionitems['City']['city_name'].' | '.$actionitems['Urgency']['value'].' | '.$actionitems['Importance']['value'].' | '.$actionitems['Country']['value'].' | '.$actionitems['Lead']['lead_primaryphonenumber'].' | '.$actionitems['Lead']['lead_emailid'].' | '.$actionitems['Area']['area_name'].' , '.$actionitems['Suburb']['suburb_name'].' , '.$actionitems['Builder']['builder_name'].' , '.$actionitems['Project']['project_name'].' , '.$actionitems['TypeProject']['value'];
                  $authKey = Configure::read('sms_api_key');
                  $senderId = Configure::read('sms_sender_id');
                  $mobileNumber = $channels[0]['User']['primary_mobile_number'];
                  //$mobileNumber = "9833156460";
                  $message = urlencode($msg);
                  $route = "default";
                  $this->Sms->send_sms($authKey,$mobileNumber,$message,$senderId,$route);
                 */
                /* End Phone */

                echo '<script>
				 			var objP=parent.document.getElementsByClassName("mfp-bg");
							var objC=parent.document.getElementsByClassName("mfp-wrap");
							objP[0].style.display="none";
							objC[0].style.display="none";
							parent.location.reload(true);</script>';
            } else {
                $this->Session->setFlash('Unable to add Action item.', 'failure');
            }
        }




        $conditions = array('city_id = "' . $city_id . '" AND (channel_role = 1 OR channel_role = 8)'); // 1 for Execution 3 for Consulting of lookup_value_channel_roles

        $channels = $this->Channel->find('list', array('fields' => array('id', 'channel_name'),
            'conditions' => $conditions
        ));
        $this->set(compact('channels'));

        $reject_cond = array('type' => array($actionitems['ActionItem']['action_item_level_id'], '0'));
        $rejections = $this->LookupValueActionItemRejection->find('list', array('fields' => 'id, value', 'conditions' => $reject_cond, 'order' => 'value ASC'));
        $this->set(compact('rejections'));

        $general_exu = $this->Channel->find('first', array('conditions' => array('Channel.city_id' => $channel_city_id, 'Channel.channel_role' => '16', 'Channel.dummy_status' => $dummy_status)));

        if (!empty($general_exu))
            $general_exu_id = $general_exu['Channel']['id'];



        $secondary_manager = $this->User->find('all', array('fields' => array('User.id', 'User.fname', 'User.mname', 'User.lname'),
            'conditions' => array(
                'OR' =>
                array(
                    'AND' => array(
                        'User.exu_channel_id' => $channel_id,
                        'User.exu_role_id' => '8', // Execution Associate of roles
                        'User.dummy_status' => $dummy_status
                    ),
                    'OR' => array(
                        'AND' => array(
                            'User.general_exe_channel_id' => $general_exu_id,
                            'User.general_exe_role_id' => '9', // General Execution Associate of roles
                            'User.dummy_status' => $dummy_status
                        )
                    ),
                ),
            )
        ));

        // $log = $this->User->getDataSource()->getLog(false, false);       
        // debug($log);
        $secondary_manager = Set::combine($secondary_manager, '{n}.User.id', array('%s %s %s', '{n}.User.fname', '{n}.User.mname', '{n}.User.lname'));
        $this->set(compact('secondary_manager'));

        $retrun_cond = array('type' => array($actionitems['ActionItem']['action_item_level_id'], '0'));
        $returns = $this->LookupValueActionItemReturn->find('list', array('fields' => 'id, value', 'conditions' => $retrun_cond, 'order' => 'value ASC'));
        $this->set(compact('returns'));

        $call_quality = $this->LookupValueCallQuality->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('call_quality'));

        $codes = $this->LookupValueLeadsCountry->find('all', array('fields' => array('LookupValueLeadsCountry.id', 'LookupValueLeadsCountry.value', 'LookupValueLeadsCountry.code')));
        $codes = Set::combine($codes, '{n}.LookupValueLeadsCountry.id', array('%s: %s', '{n}.LookupValueLeadsCountry.value', '{n}.LookupValueLeadsCountry.code'));
        $this->set(compact('codes'));

        $closureprobabilities = $this->LookupValueLeadsClosureProbability->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $this->set(compact('closureprobabilities'));

        $urgencies = $this->LookupValueLeadsUrgency->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $this->set(compact('urgencies'));

        $segment = $this->LookupValueLeadsSegment->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $this->set(compact('segment'));

        $countires = $this->LookupValueLeadsCountry->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $this->set(compact('countires'));

        $importance = $this->LookupValueLeadsImportance->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $this->set(compact('importance'));

        $types = $this->LookupValueLeadsType->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $this->set(compact('types'));

        $lead_progrss = $this->LookupValueLeadsProgress->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $this->set(compact('lead_progrss'));

        $courrency = $this->LookupValueLeadsCurrency->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('courrency'));

        $suburbs = $this->Suburb->find('list', array('fields' => 'Suburb.id, Suburb.suburb_name', 'conditions' => array('Suburb.dummy_status' => $dummy_status, 'Suburb.suburb_status' => '1'), 'order' => 'Suburb.suburb_name ASC'));
        $this->set(compact('suburbs'));

        $areas = $this->Area->find('list', array('fields' => 'Area.id, Area.area_name', 'conditions' => array('Area.dummy_status' => $dummy_status, 'Area.area_status' => '1'), 'order' => 'Area.area_name ASC'));
        $this->set('areas', $areas);

        $project = $this->Lead->Project->find('list', array('fields' => 'Project.id, Project.project_name', 'conditions' => $condition_dummy_status, 'order' => 'Project.project_name ASC'));
        $this->set('projects', $project);

        /* $builder = $this->Builder->find('list', array('fields' => 'Builder.id, Builder.builder_name','conditions' => array('OR' =>array(
          'Builder.builder_primarycity' => $channel_city_id,
          'Builder.builder_secondarycity' => $channel_city_id,
          'Builder.builder_tertiarycity' => $channel_city_id,
          'Builder.city_4' => $channel_city_id,
          'Builder.city_5' => $channel_city_id,
          ),'Builder.dummy_status' => $dummy_status), 'order' => 'Builder.builder_name ASC')); */
        $builder = $this->Builder->find('list', array('fields' => 'Builder.id, Builder.builder_name', 'conditions' => $condition_dummy_status, 'order' => 'Builder.builder_name ASC'));
        $this->set('builders', $builder);

        $unit = $this->LookupValueProjectUnitPreference->find('list', array('fields' => 'LookupValueProjectUnitPreference.id, LookupValueProjectUnitPreference.value', 'order' => 'LookupValueProjectUnitPreference.value ASC'));
        $this->set('unit', $unit);

        $type_preference = $this->LookupValueProjectPhase->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('type_preference'));

        $details_cond = array('type_id' => array($actionitems['ActionItem']['action_item_level_id'], '0'));
        $activity_details = $this->LookupValueActivityDetail->find('list', array('fields' => 'id, value', 'conditions' => $details_cond, 'order' => 'value ASC'));
        $this->set(compact('activity_details'));
    }

    public function even_action($actio_itme_id = null) {

        $this->layout = 'ajax';
        $dummy_status = $this->Auth->user('dummy_status');
        $user_id = $this->Auth->user('id');
        $role_id = $this->Session->read("role_id");
        $channel_id = $this->Session->read("channel_id");
        $channels = $this->Channel->findById($channel_id);
        $city_id = $channels['Channel']['city_id'];



        $actionitems = $this->ActionItem->findById($actio_itme_id);
        $Reimbursements = $this->Reimbursement->findById($actionitems['ActionItem']['event_id']);

        if ($Reimbursements['Reimbursement']['reimbursement_city_id'] == '2')
            $submitted_to = '150';
        else
            $submitted_to = '149';

        $this->set(compact('Reimbursements'));
        if ($this->request->is('post')) {

            /*             * ************This data is common features **************************************** */

            $this->request->data['ActionItem']['parent_action_item_id'] = $actio_itme_id;
            $this->request->data['ActionItem']['dummy_status'] = $dummy_status;
            $this->request->data['ActionItem']['action_item_created'] = date('Y-m-d');
            $this->request->data['ActionItem']['created_by_id'] = $user_id;
            $this->request->data['ActionItem']['action_item_active'] = 'Yes';
            $this->request->data['ActionItem']['created_by'] = $user_id;
            //$this->request->data['ActionItem']['action_item_level_id'] = $user_id;
            $this->request->data['Remark']['remarks_time'] = date('g:i A');
            $this->request->data['Remark']['remarks_by'] = $user_id;
            $this->request->data['Remark']['created_by'] = $user_id;
            $this->request->data['Remark']['remarks_date'] = date('Y-m-d');
            $this->request->data['Remark']['dummy_status'] = $dummy_status;
            $this->request->data['ActionItem']['action_item_source'] = $role_id;
            $this->request->data['ActionItem']['event_id'] = $actionitems['ActionItem']['event_id'];




            if ($this->data['ActionItem']['type_id'] == 6) {  // 6 for Approval of event.
                $this->request->data['ActionItem']['description'] = 'Submit Approval';
                $this->request->data['Remark']['remarks'] = 'Submit Approval';
                $this->request->data['ActionItem']['next_action_by'] = $submitted_to;
                $this->request->data['ActionItem']['action_item_status'] = '6'; // for Approval of lookup_value_action_item_statuses
                //	$this->request->data['Remark']['remarks_level'] = '6'; //2 for event from lookup_value_remarks_level
                $this->request->data['Remark']['activity_id'] = $actionitems['ActionItem']['event_id'];
                $this->request->data['Event']['activity_status'] = '1'; // for approved
                $this->request->data['ActionItem']['action_item_level_id'] = '9'; // for event
                $this->request->data['Reimbursement']['reimbursement_status'] = '2'; // for approved of lookup_value_reimbursement_status
                $this->request->data['Reimbursement']['reimbursement_approved_by_id'] = $user_id; // for approved
                $this->request->data['Reimbursement']['reimbursement_approved_date'] = date('Y-m-d'); // for approved
            }

            if ($this->data['ActionItem']['type_id'] == 8) {  // 8 for return.
                $this->request->data['ActionItem']['description'] = 'Return';
                $this->request->data['Remark']['remarks'] = 'Return';

                $this->request->data['ActionItem']['next_action_by'] = $actionitems['ActionItem']['created_by'];
                $this->request->data['ActionItem']['action_item_level_id'] = '9'; // for event
                $this->request->data['ActionItem']['action_item_status'] = '8'; // for lookup_value_action_item_statuses 
            }

            if ($this->data['ActionItem']['type_id'] == 9) { // for rejection
                $this->request->data['ActionItem']['description'] = 'Rejection';
                $this->request->data['Remark']['remarks'] = 'Rejection';

                $this->request->data['ActionItem']['next_action_by'] = NULL;
                $this->request->data['ActionItem']['action_item_level_id'] = '9'; // for event
                $this->request->data['ActionItem']['action_item_status'] = '9'; // for rejection of lookup_value_action_item_statuses
            }

            $this->ActionItem->create();
            if ($this->ActionItem->save($this->data['ActionItem'])) {
                $last_action_id = $this->ActionItem->getLastInsertId();
                $this->ActionItem->updateAll(array('ActionItem.action_item_active' => "'No'"), array('ActionItem.id' => $actio_itme_id));

                if ($actionitems['ActionItem']['action_item_level_id'] == 9 && $this->data['ActionItem']['type_id'] == 6) {  // for Reimbursement
                    $this->Reimbursement->id = $actionitems['ActionItem']['event_id'];
                    $this->Reimbursement->save($this->request->data['Reimbursement']);
                    //$this->Reimbursement->updateAll($this->data['Reimbursement'],array('Reimbursement.id' => $actionitems['ActionItem']['event_id']));
                }




                $actionArry = $this->ActionItem->findById($last_action_id);
                $CreatedBy = strtoupper($actionArry['CreatedBy']['fname'] . ' ' . $actionArry['CreatedBy']['lname']);
                $ActivityLevel = strtoupper($Reimbursements['Level']['value']);
                $Email = new CakeEmail();

                $Email->viewVars(array(
                    'SubmittedBy' => $Reimbursements['SubmittedBy']['fname'] . ' ' . $Reimbursements['SubmittedBy']['mname'] . ' ' . $Reimbursements['SubmittedBy']['lname'],
                    'CreatedBy' => $actionArry['CreatedBy']['fname'] . ' ' . $actionArry['CreatedBy']['lname'],
                    'NextActionBy' => $actionArry['NextActionBy']['fname'] . ' ' . $actionArry['NextActionBy']['lname'],
                    'LookupReturn' => strtoupper($actionArry['LookupReturn']['value']),
                    'LookupReject' => strtoupper($actionArry['LookupReject']['value']),
                    'Return' => strtoupper($actionArry['ActionItem']['other_return']),
                    'Reject' => strtoupper($actionArry['ActionItem']['other_rejection']),
                    'ApprovalAmount' => $Reimbursements['Reimbursement']['reimbursement_amount'],
                    'SumittedDate' => date("j M, Y", strtotime($Reimbursements['Reimbursement']['reimbursement_bill_submission_date'])),
                    'ActivityLevel' => $Reimbursements['Level']['value'],
                    'ActivityWith' => $Reimbursements['Reimbursement']['reimbursement_with'],
                    'ExpenceType' => $Reimbursements['Type']['value'],
                    'ExpenceFor' => $Reimbursements['For']['value'],
                ));

                if ($this->data['ActionItem']['type_id'] == 6) {
                    $to = 'infra@sumanus.com';
                    //$to = 'biswajit@wtbglobal.com';
                    $Email->template('reimbursement', 'default')->emailFormat('html')->to($to)->from('admin@silkrouters.com')->subject('Silkrouters - ' . $ActivityLevel . ' REIMBURSEMENT APPROVE BY - ' . $CreatedBy)->send();
                }

                if ($this->data['ActionItem']['type_id'] == 8) { // return
                    $to = array('administrator@silkrouters.com');
                    $cc = 'infra@sumanus.com';

                    $Email->template('reimbursement', 'default')->emailFormat('html')->to($to)->cc($cc)->from('admin@silkrouters.com')->subject('Silkrouters - ' . $ActivityLevel . ' REIMBURSEMENT RETURN  BY ' . $CreatedBy)->send();
                }
                if ($this->data['ActionItem']['type_id'] == 9) { // rejection
                    //$to_mail = $this->User->GetRealEasteEmail($this->getParentNode($actionArry['ActionItem']['lead_id']));
                    $to = array('administrator@silkrouters.com');
                    $cc = array('infra@sumanus.com');

                    $Email->template('reimbursement', 'default')->emailFormat('html')->to($to)->cc($cc)->from('admin@silkrouters.com')->subject('Silkrouters - ' . $ActivityLevel . ' REIMBURSEMENT REJECTION BY ' . $CreatedBy)->send();
                }

                echo '<script>
				 			var objP=parent.document.getElementsByClassName("mfp-bg");
							var objC=parent.document.getElementsByClassName("mfp-wrap");
							objP[0].style.display="none";
							objC[0].style.display="none";
							parent.location.reload(true);</script>';
            } else {
                $this->Session->setFlash('Unable to add Action item.', 'failure');
            }
        }

        $type = $this->ActionItemType->find('list', array('fields' => array('id', 'type'), 'conditions' => 'ActionItemType.id = 6 OR ActionItemType.id = 8 OR ActionItemType.id = 9'));
        $this->set(compact('type'));

        $reject_cond = array('type' => array($actionitems['ActionItem']['action_item_level_id'], '0'));
        $rejections = $this->LookupValueActionItemRejection->find('list', array('fields' => 'id, value', 'conditions' => $reject_cond, 'order' => 'value ASC'));
        $this->set(compact('rejections'));

        $retrun_cond = array('type' => array($actionitems['ActionItem']['action_item_level_id'], '0'));
        $returns = $this->LookupValueActionItemReturn->find('list', array('fields' => 'id, value', 'conditions' => $retrun_cond, 'order' => 'value ASC'));
        $this->set(compact('returns'));
    }

    function edit($id = null) {

        $city_id = $this->Auth->user("city_id");
        if (!$id) {
            throw new NotFoundException(__('Invalid Builder'));
        }

        $action_item = $this->ActionItem->findById($id);

        if (!$action_item) {
            throw new NotFoundException(__('Invalid builder'));
        }

        if ($this->request->data) {


            $this->ActionItem->id = $id;
            $action_item_created = explode('/', $this->data['ActionItem']['action_item_created']);
            $date = $action_item_created[0];
            $month = $action_item_created[1];
            $year = $action_item_created[2];
            $this->request->data['ActionItem']['action_item_created'] = $year . '-' . $month . '-' . $date;

            if ($this->ActionItem->save($this->request->data)) {
                $this->Session->setFlash('Action Item has been updated.', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to update Action Item.', 'failure');
            }
        }

        $type = $this->ActionItemType->find('list', array('fields' => array('id', 'type')));
        $this->set(compact('type'));

        $channels = $this->Channel->find('list', array('fields' => array('id', 'channel_name'),
            'conditions' => array('city_id =' . $city_id)));
        $this->set(compact('channels'));

        $leads = $this->Lead->find('all', array('fields' => array('Lead.id', 'Lead.lead_fname', 'Lead.lead_lname')));
        $leads = Set::combine($leads, '{n}.Lead.id', array('%s %s', '{n}.Lead.lead_fname', '{n}.Lead.lead_lname'));

        $this->set(compact('leads'));

        $levels = $this->ActionItemLevel->find('list', array('fields' => array('id', 'level')));
        $this->set(compact('levels'));

        $this->request->data = $action_item;
    }

    public function getParentNode($lead_id = null) {
        $parent = $this->ActionItem->find('first', array('conditions' => array('ActionItem.lead_id' => $lead_id),
            'fields' => 'ActionItem.created_by_id'));
        return $parent['ActionItem']['created_by_id'];
    }

    public function edit_reimbursement($reimbursement_id = null) {

        $this->layout = 'ajax';
        $dummy_status = $this->Auth->user('dummy_status');
        $user_id = $this->Auth->user('id');
        $role_id = $this->Session->read("role_id");

        $Reimbursements = $this->Reimbursement->findById($reimbursement_id);

        $reimburse_type = $this->LookupValueReimbursementType_1->find('list', array('fields' => 'id,value', 'order' => 'id ASC'));
        $this->set(compact('reimburse_type'));

        $activity_levels = $this->LookupValueActivityLevel->find('list', array('fields' => 'id,value', 'order' => 'id ASC'));
        $this->set('activity_levels', $activity_levels);

        $bill_type = $this->LookupValueBillStatus->find('list', array('fields' => 'id,value', 'order' => 'id ASC'));
        $this->set(compact('bill_type'));

        $bill_status = $this->LookupValueBillType->find('list', array('fields' => 'id,value', 'order' => 'id ASC'));
        $this->set(compact('bill_status'));

        $reimburse_for = $this->LookupValueReimbursementType_2->find('list', array('fields' => 'id,value', 'conditions' => array('type_id' => $Reimbursements['Reimbursement']['reimbursement_type_1']), 'order' => 'id ASC'));
        $this->set(compact('reimburse_for'));

        if (!$this->request->data) {
            $this->request->data = $Reimbursements;
        }
    }

    public function action_approve($action_id = null, $deal_id = null) {


        $dummy_status = $this->Auth->user('dummy_status');
        $user_id = $this->Auth->user('id');
        $role_id = $this->Session->read("role_id");
        $channel_id = $this->Session->read("channel_id");
        $channels = $this->Channel->findById($channel_id);
        $city_id = $channels['Channel']['city_id'];

        $Deals = $this->Deal->findById($deal_id);
        
        if ($this->request->data) {
            $this->Deal->id = $deal_id;
           
            //$this->request->data['Activity']['activity_date'] = date('Y-m-d',strtotime($this->data['Activity']['activity_date']));
            if ($this->Deal->save($this->request->data['Deal'])) {
                
                /*
                             * ****************** Remarks **************************
                             * ****** */
                            $remarks['Remark']['deal_id'] = $deal_id;
                            $remarks['Remark']['remarks'] = 'Submit Transaction Created';
                            $remarks['Remark']['remarks_by'] = $user_id;
                            $remarks['Remark']['created_by'] = $user_id;
                            $remarks['Remark']['remarks_time'] = date('g:i A');
                            $remarks['Remark']['remarks_level'] = '3'; //3 for Client from lookup_value_remarks_level
                            $remarks['Remark']['dummy_status'] = $dummy_status;
                            $this->Remark->save($remarks);


                            /*
                             * ***********************Marketing Partner Action ******************
                             * ** */
                            $action_item['ActionItem']['deal_id'] = $deal_id;

                            $action_item['ActionItem']['type_id'] = '7'; // 7 for Submission For Approval
                            $action_item['ActionItem']['action_item_active'] = 'Yes';
                            $action_item['ActionItem']['action_item_level_id'] = '15'; //For Deal
                            $action_item['ActionItem']['action_item_status'] = '7'; //7 for Submitted For Approval table - lookup_value_action_item_statuses
                            $action_item['ActionItem']['description'] = 'Deal Transaction Created - Submission For Approval';
                            $action_item['ActionItem']['action_item_source'] = $role_id;
                            $action_item['ActionItem']['created_by_id'] = $user_id;
                            $action_item['ActionItem']['created_by'] = $user_id;
                            $action_item['ActionItem']['dummy_status'] = $dummy_status;
                            $action_item['ActionItem']['next_action_by'] = '136'; // overseeing
                           // $action_item['ActionItem']['parent_action_item_id'] = $parent_action_item_id;
                            $this->ActionItem->save($action_item);
                            $ActionId = $this->ActionItem->getLastInsertId();
                            $this->ActionItem->id = $ActionId;
                            $this->ActionItem->saveField('parent_action_item_id', $ActionId);
                
               // $this->Session->setFlash('Project Unit has been updated.', 'success');
                $this->Session->write('success_msg', 'Activity has been updated.');
                $this->redirect(array('action' => 'index'));
                
                
              
            } else {
                $this->Session->setFlash('Unable to update Activity.', 'failure');
            }
        }

        $action_type = $this->ActionItemType->find('list', array('fields' => array('id', 'type'), 'conditions' => 'ActionItemType.id = 19 OR ActionItemType.id = 20'));
        $this->set(compact('action_type'));

        $lead_lt = $this->Lead->find('all', array('fields' => array('Lead.id', 'Lead.lead_fname', 'Lead.lead_lname', 'Lead.created'), 'conditions' => array('Lead.id' => $Deals['Deal']['deal_client_id'])));
        $lead_lt = Set::combine($lead_lt, '{n}.Lead.id', array('%s %s - Arrival Date: %s', '{n}.Lead.lead_fname', '{n}.Lead.lead_lname', '{n}.Lead.created'));
        $this->set(compact('lead_lt'));

        $LookupValueLeadTransactionType = $this->LookupValueLeadTransactionType->find('list', array('fields' => array('id', 'value'), 'order' => 'value asc'));
        $this->set(compact('LookupValueLeadTransactionType'));

        $billing_types = $this->LookupValueDealBillingType->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('billing_types'));

        $projects = $this->Project->findById($Deals['Deal']['deal_project_id'], array('Project.builder_id', 'Project.secondary_builder_id', 'Project.tertiary_builder_id'));
        $builders = $this->Builder->find('list', array('conditions' => array('Builder.id' => array($projects['Project']['builder_id'], $projects['Project']['secondary_builder_id'], $projects['Project']['tertiary_builder_id'])),
            'fields' => 'Builder.id, Builder.builder_name',
            'order' => 'Builder.builder_name ASC'
        ));

        $this->set(compact('builders'));

        if ($role_id == '10') {
            $projects = $this->Project->find('list', array('conditions' => array('Project.dummy_status' => $dummy_status),
                'fields' => 'Project.id, Project.project_name',
                'order' => 'Project.project_name ASC'
            ));
            $partners = $this->MarketingPartner->find('list', array('fields' => 'id, marketing_partner_display_name', 'order' => 'marketing_partner_display_name ASC'));
        } else {
            $projects = $this->Project->find('list', array('conditions' => array('Project.city_id' => $city_id, 'Project.dummy_status' => $dummy_status),
                'fields' => 'Project.id, Project.project_name',
                'order' => 'Project.project_name ASC'
            ));
            $partners = $this->MarketingPartner->find('list', array('fields' => 'id, marketing_partner_display_name', 'conditions' => array('OR' => array('MarketingPartner.marketing_partner_primarycity' => $city_id, 'MarketingPartner.marketing_partner_secondarycity' => $city_id, 'MarketingPartner.marketing_partner_tertiarycity' => $city_id, 'MarketingPartner.marketing_partner_city_4' => $city_id, 'MarketingPartner.marketing_partner_city_5' => $city_id)), 'order' => 'marketing_partner_display_name ASC'));
        }

        $this->set(compact('projects'));
        $this->set(compact('partners'));

        $commission_event = $this->LookupUnitCommissionEvent->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('commission_event'));

        $ProjectLegalNameList = $this->ProjectLegalName->find('all', array(
            'conditions' => array(
                'ProjectLegalName.project_legal_names_project_id' => $Deals['Deal']['deal_project_id'],
                'ProjectLegalName.dummy_status' => $dummy_status,
                'ProjectLegalName.project_legal_names_status' => '1',
                'ProjectLegalName.project_legal_names_approved' => '1',
            ),
            'order' => 'ProjectLegalName.id ASC'
        ));

        $ProjectLegalNameList = Set::combine($ProjectLegalNameList, '{n}.ProjectLegalName.id', array('%s', '{n}.BuilderLegalName.builder_legal_names_name'));

        $this->set(compact('ProjectLegalNameList'));

        $ProjectLegalNames = $this->ProjectLegalName->findById($Deals['Deal']['deal_project_legal_name_id']);
        $this->set(compact('ProjectLegalNames'));

        $project_units = $this->ProjectUnit->findById($Deals['Deal']['deal_project_unit_id']);
        $this->set(compact('project_units'));
        
        $attach_to = $this->LookupValueProjectAttache->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('attach_to'));
        
        $based_on = $this->LookupUnitCommissionBasedOn->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('based_on'));
        
        $codes = $this->LookupValueLeadsCountry->find('all', array('fields' => array('LookupValueLeadsCountry.id', 'LookupValueLeadsCountry.value', 'LookupValueLeadsCountry.code')));
        $codes = Set::combine($codes, '{n}.LookupValueLeadsCountry.id', array('%s: %s', '{n}.LookupValueLeadsCountry.value', '{n}.LookupValueLeadsCountry.code'));
        $this->set(compact('codes'));

        $project_unit_list = $this->ProjectUnit->find('list', array(
            'conditions' => array(
                'ProjectUnit.project_id' => $Deals['Deal']['deal_project_id'],
                'ProjectUnit.dummy_status' => $dummy_status,
                'ProjectUnit.unit_status' => '1',
                'ProjectUnit.unit_approved' => '1',
            ),
            'fields' => 'ProjectUnit.id, ProjectUnit.unit_name',
            'order' => 'ProjectUnit.unit_name ASC'
        ));
        $this->set(compact('project_unit_list'));

        $leads = $this->Lead->findById($Deals['Deal']['deal_client_id']);
        $this->set(compact('leads'));

        if (!$this->request->data) {
            $this->request->data = $Deals;
        }
    }
    
        public function action_submission_approve($action_id = null, $deal_id = null) {


        $dummy_status = $this->Auth->user('dummy_status');
        $user_id = $this->Auth->user('id');
        $role_id = $this->Session->read("role_id");
        $channel_id = $this->Session->read("channel_id");
        $channels = $this->Channel->findById($channel_id);
        $city_id = $channels['Channel']['city_id'];

        $Deals = $this->Deal->findById($deal_id);
        
        if ($this->request->data) {
            $this->Deal->id = $deal_id;
           
            //$this->request->data['Activity']['activity_date'] = date('Y-m-d',strtotime($this->data['Activity']['activity_date']));
            if ($this->Deal->save($this->request->data['Deal'])) {
                
                /*
                             * ****************** Remarks **************************
                             * ****** */
                            $remarks['Remark']['deal_id'] = $deal_id;
                            $remarks['Remark']['remarks'] = 'Submit Transaction Created';
                            $remarks['Remark']['remarks_by'] = $user_id;
                            $remarks['Remark']['created_by'] = $user_id;
                            $remarks['Remark']['remarks_time'] = date('g:i A');
                            $remarks['Remark']['remarks_level'] = '3'; //3 for Client from lookup_value_remarks_level
                            $remarks['Remark']['dummy_status'] = $dummy_status;
                            $this->Remark->save($remarks);


                            /*
                             * ***********************Marketing Partner Action ******************
                             * ** */
                            $action_item['ActionItem']['deal_id'] = $deal_id;

                            $action_item['ActionItem']['type_id'] = '7'; // 7 for Submission For Approval
                            $action_item['ActionItem']['action_item_active'] = 'Yes';
                            $action_item['ActionItem']['action_item_level_id'] = '15'; //For Deal
                            $action_item['ActionItem']['action_item_status'] = '7'; //7 for Submitted For Approval table - lookup_value_action_item_statuses
                            $action_item['ActionItem']['description'] = 'Deal Transaction Created - Submission For Approval';
                            $action_item['ActionItem']['action_item_source'] = $role_id;
                            $action_item['ActionItem']['created_by_id'] = $user_id;
                            $action_item['ActionItem']['created_by'] = $user_id;
                            $action_item['ActionItem']['dummy_status'] = $dummy_status;
                            $action_item['ActionItem']['next_action_by'] = '136'; // overseeing
                           // $action_item['ActionItem']['parent_action_item_id'] = $parent_action_item_id;
                            $this->ActionItem->save($action_item);
                            $ActionId = $this->ActionItem->getLastInsertId();
                            $this->ActionItem->id = $ActionId;
                            $this->ActionItem->saveField('parent_action_item_id', $ActionId);
                
               // $this->Session->setFlash('Project Unit has been updated.', 'success');
                $this->Session->write('success_msg', 'Activity has been updated.');
         
                
                
              
            } else {
                $this->Session->setFlash('Unable to update Activity.', 'failure');
            }
        }

        $action_type = $this->ActionItemType->find('list', array('fields' => array('id', 'type'), 'conditions' => 'ActionItemType.id = 19 OR ActionItemType.id = 20'));
        $this->set(compact('action_type'));

        $lead_lt = $this->Lead->find('all', array('fields' => array('Lead.id', 'Lead.lead_fname', 'Lead.lead_lname', 'Lead.created'), 'conditions' => array('Lead.id' => $Deals['Deal']['deal_client_id'])));
        $lead_lt = Set::combine($lead_lt, '{n}.Lead.id', array('%s %s - Arrival Date: %s', '{n}.Lead.lead_fname', '{n}.Lead.lead_lname', '{n}.Lead.created'));
        $this->set(compact('lead_lt'));

        $LookupValueLeadTransactionType = $this->LookupValueLeadTransactionType->find('list', array('fields' => array('id', 'value'), 'order' => 'value asc'));
        $this->set(compact('LookupValueLeadTransactionType'));

        $billing_types = $this->LookupValueDealBillingType->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('billing_types'));

        $projects = $this->Project->findById($Deals['Deal']['deal_project_id'], array('Project.builder_id', 'Project.secondary_builder_id', 'Project.tertiary_builder_id'));
        $builders = $this->Builder->find('list', array('conditions' => array('Builder.id' => array($projects['Project']['builder_id'], $projects['Project']['secondary_builder_id'], $projects['Project']['tertiary_builder_id'])),
            'fields' => 'Builder.id, Builder.builder_name',
            'order' => 'Builder.builder_name ASC'
        ));

        $this->set(compact('builders'));

        if ($role_id == '10') {
            $projects = $this->Project->find('list', array('conditions' => array('Project.dummy_status' => $dummy_status),
                'fields' => 'Project.id, Project.project_name',
                'order' => 'Project.project_name ASC'
            ));
            $partners = $this->MarketingPartner->find('list', array('fields' => 'id, marketing_partner_display_name', 'order' => 'marketing_partner_display_name ASC'));
        } else {
            $projects = $this->Project->find('list', array('conditions' => array('Project.city_id' => $city_id, 'Project.dummy_status' => $dummy_status),
                'fields' => 'Project.id, Project.project_name',
                'order' => 'Project.project_name ASC'
            ));
            $partners = $this->MarketingPartner->find('list', array('fields' => 'id, marketing_partner_display_name', 'conditions' => array('OR' => array('MarketingPartner.marketing_partner_primarycity' => $city_id, 'MarketingPartner.marketing_partner_secondarycity' => $city_id, 'MarketingPartner.marketing_partner_tertiarycity' => $city_id, 'MarketingPartner.marketing_partner_city_4' => $city_id, 'MarketingPartner.marketing_partner_city_5' => $city_id)), 'order' => 'marketing_partner_display_name ASC'));
        }

        $this->set(compact('projects'));
        $this->set(compact('partners'));

        $commission_event = $this->LookupUnitCommissionEvent->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('commission_event'));

        $ProjectLegalNameList = $this->ProjectLegalName->find('all', array(
            'conditions' => array(
                'ProjectLegalName.project_legal_names_project_id' => $Deals['Deal']['deal_project_id'],
                'ProjectLegalName.dummy_status' => $dummy_status,
                'ProjectLegalName.project_legal_names_status' => '1',
                'ProjectLegalName.project_legal_names_approved' => '1',
            ),
            'order' => 'ProjectLegalName.id ASC'
        ));

        $ProjectLegalNameList = Set::combine($ProjectLegalNameList, '{n}.ProjectLegalName.id', array('%s', '{n}.BuilderLegalName.builder_legal_names_name'));

        $this->set(compact('ProjectLegalNameList'));

        $ProjectLegalNames = $this->ProjectLegalName->findById($Deals['Deal']['deal_project_legal_name_id']);
        $this->set(compact('ProjectLegalNames'));

        $project_units = $this->ProjectUnit->findById($Deals['Deal']['deal_project_unit_id']);
        $this->set(compact('project_units'));
        
        $attach_to = $this->LookupValueProjectAttache->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('attach_to'));
        
        $based_on = $this->LookupUnitCommissionBasedOn->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('based_on'));
        
        $codes = $this->LookupValueLeadsCountry->find('all', array('fields' => array('LookupValueLeadsCountry.id', 'LookupValueLeadsCountry.value', 'LookupValueLeadsCountry.code')));
        $codes = Set::combine($codes, '{n}.LookupValueLeadsCountry.id', array('%s: %s', '{n}.LookupValueLeadsCountry.value', '{n}.LookupValueLeadsCountry.code'));
        $this->set(compact('codes'));

        $project_unit_list = $this->ProjectUnit->find('list', array(
            'conditions' => array(
                'ProjectUnit.project_id' => $Deals['Deal']['deal_project_id'],
                'ProjectUnit.dummy_status' => $dummy_status,
                'ProjectUnit.unit_status' => '1',
                'ProjectUnit.unit_approved' => '1',
            ),
            'fields' => 'ProjectUnit.id, ProjectUnit.unit_name',
            'order' => 'ProjectUnit.unit_name ASC'
        ));
        $this->set(compact('project_unit_list'));

        $leads = $this->Lead->findById($Deals['Deal']['deal_client_id']);
        $this->set(compact('leads'));

        if (!$this->request->data) {
            $this->request->data = $Deals;
        }
    }

    public function report_transaction($actio_itme_id = null, $deal_id = null) {

        $this->layout = 'ajax';
        $dummy_status = $this->Auth->user('dummy_status');
        $user_id = $this->Auth->user('id');
        $role_id = $this->Session->read("role_id");
        $channel_id = $this->Session->read("channel_id");
        $channels = $this->Channel->findById($channel_id);
        $city_id = $channels['Channel']['city_id'];

        $Deals = $this->Deal->findById($deal_id);
        $actionitems = $this->ActionItem->findById($actio_itme_id);


        if ($this->request->is('post')) {

            /*             * ************This data is common features **************************************** */

            $this->request->data['ActionItem']['parent_action_item_id'] = $actio_itme_id;
            $this->request->data['ActionItem']['dummy_status'] = $dummy_status;
            $this->request->data['ActionItem']['action_item_created'] = date('Y-m-d');
            $this->request->data['ActionItem']['created_by_id'] = $user_id;
            $this->request->data['ActionItem']['action_item_active'] = 'Yes';
            $this->request->data['ActionItem']['created_by'] = $user_id;
            $this->request->data['Remark']['remarks_time'] = date('g:i A');
            $this->request->data['Remark']['remarks_by'] = $user_id;
            $this->request->data['Remark']['created_by'] = $user_id;
            $this->request->data['Remark']['remarks_date'] = date('Y-m-d');
            $this->request->data['Remark']['dummy_status'] = $dummy_status;
            $this->request->data['ActionItem']['action_item_source'] = $role_id;
            $this->request->data['ActionItem']['action_item_level_id'] = $actionitems['ActionItem']['action_item_level_id'];
             $this->request->data['ActionItem']['deal_id'] = $actionitems['ActionItem']['deal_id'];
            $this->request->data['ActionItem']['action_industry'] = '1'; // for realestate of lookup_value_activity_industry

            if ($this->data['ActionItem']['type_id'] == '18') { // for Transaction Reported
                $this->request->data['ActionItem']['next_action_by'] = $actionitems['ActionItem']['created_by'];
                $this->request->data['Lead']['lead_status'] = '12';
                $this->request->data['Deal']['deal_status'] = '2';
                $this->request->data['ActionItem']['action_item_status'] = '22';
            }

            if ($this->data['ActionItem']['type_id'] == '8') { // for return
                $this->request->data['ActionItem']['action_item_status'] = '8'; // 8 for Return of lookup_value_action_item_statuses

                $this->request->data['ActionItem']['next_action_by'] = $this->getParentNode($actionitems['ActionItem']['lead_id']);
                $this->request->data['ActionItem']['description'] = 'Client Returned by ' . strtoupper($this->User->Username($user_id)) . ' to ' . strtoupper($this->User->Username($this->getParentNode($actionitems['ActionItem']['lead_id']))) . ' because of reason - ' . strtoupper($this->data['ActionItem']['other_return']);
                $this->request->data['Remark']['remarks'] = 'Client Returned by ' . strtoupper($this->User->Username($user_id)) . ' to ' . strtoupper($this->User->Username($this->getParentNode($actionitems['ActionItem']['lead_id']))) . ' because of reason - ' . strtoupper($this->data['ActionItem']['other_return']);
            }

            $this->ActionItem->create();
            if ($this->ActionItem->save($this->data['ActionItem'])) {
                $last_action_id = $this->ActionItem->getLastInsertId();
                $this->ActionItem->updateAll(array('ActionItem.action_item_active' => "'No'"), array('ActionItem.id' => $actio_itme_id));
                $this->Remark->save($this->data['Remark']);
                if ($this->data['ActionItem']['type_id'] == 18) {  // for transaction approve
                    $lead['Lead']['lead_status'] = '12';
                    $deal['Deal']['deal_status'] = '2';
                    $this->Lead->updateAll($lead['Lead'], array('Lead.id' => $actionitems['ActionItem']['lead_id']));
                    $this->Deal->updateAll($deal['Deal'], array('Deal.id' => $deal_id));
                }
                
                $this->Session->setFlash('Data action has been saved.', 'success');
              
            }
            
            echo '<script>
                var objP=parent.document.getElementsByClassName("mfp-bg");
                var objC=parent.document.getElementsByClassName("mfp-wrap");
                objP[0].style.display="none";
                objC[0].style.display="none";
                parent.location.reload(true);</script>';
        }

        $action_type = $this->ActionItemType->find('list', array('fields' => array('id', 'type'), 'conditions' => 'ActionItemType.id = 18 OR ActionItemType.id = 8'));
        $this->set(compact('action_type'));

        $lead_lt = $this->Lead->find('all', array('fields' => array('Lead.id', 'Lead.lead_fname', 'Lead.lead_lname', 'Lead.created'), 'conditions' => array('Lead.id' => $Deals['Deal']['deal_client_id'])));
        $lead_lt = Set::combine($lead_lt, '{n}.Lead.id', array('%s %s - Arrival Date: %s', '{n}.Lead.lead_fname', '{n}.Lead.lead_lname', '{n}.Lead.created'));
        $this->set(compact('lead_lt'));

        $LookupValueLeadTransactionType = $this->LookupValueLeadTransactionType->find('list', array('fields' => array('id', 'value'), 'order' => 'value asc'));
        $this->set(compact('LookupValueLeadTransactionType'));

        $billing_types = $this->LookupValueDealBillingType->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('billing_types'));

        $projects = $this->Project->findById($Deals['Deal']['deal_project_id'], array('Project.builder_id', 'Project.secondary_builder_id', 'Project.tertiary_builder_id'));
        $builders = $this->Builder->find('list', array('conditions' => array('Builder.id' => array($projects['Project']['builder_id'], $projects['Project']['secondary_builder_id'], $projects['Project']['tertiary_builder_id'])),
            'fields' => 'Builder.id, Builder.builder_name',
            'order' => 'Builder.builder_name ASC'
        ));

        $this->set(compact('builders'));

        if ($role_id == '10') {
            $projects = $this->Project->find('list', array('conditions' => array('Project.dummy_status' => $dummy_status),
                'fields' => 'Project.id, Project.project_name',
                'order' => 'Project.project_name ASC'
            ));
            $partners = $this->MarketingPartner->find('list', array('fields' => 'id, marketing_partner_display_name', 'order' => 'marketing_partner_display_name ASC'));
        } else {
            $projects = $this->Project->find('list', array('conditions' => array('Project.city_id' => $city_id, 'Project.dummy_status' => $dummy_status),
                'fields' => 'Project.id, Project.project_name',
                'order' => 'Project.project_name ASC'
            ));
            $partners = $this->MarketingPartner->find('list', array('fields' => 'id, marketing_partner_display_name', 'conditions' => array('OR' => array('MarketingPartner.marketing_partner_primarycity' => $city_id, 'MarketingPartner.marketing_partner_secondarycity' => $city_id, 'MarketingPartner.marketing_partner_tertiarycity' => $city_id, 'MarketingPartner.marketing_partner_city_4' => $city_id, 'MarketingPartner.marketing_partner_city_5' => $city_id)), 'order' => 'marketing_partner_display_name ASC'));
        }

        $this->set(compact('projects'));
        $this->set(compact('partners'));

        $commission_event = $this->LookupUnitCommissionEvent->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('commission_event'));

        $ProjectLegalNameList = $this->ProjectLegalName->find('all', array(
            'conditions' => array(
                'ProjectLegalName.project_legal_names_project_id' => $Deals['Deal']['deal_project_id'],
                'ProjectLegalName.dummy_status' => $dummy_status,
                'ProjectLegalName.project_legal_names_status' => '1',
                'ProjectLegalName.project_legal_names_approved' => '1',
            ),
            'order' => 'ProjectLegalName.id ASC'
        ));

        $ProjectLegalNameList = Set::combine($ProjectLegalNameList, '{n}.ProjectLegalName.id', array('%s', '{n}.BuilderLegalName.builder_legal_names_name'));

        $this->set(compact('ProjectLegalNameList'));


        $project_unit_list = $this->ProjectUnit->find('list', array(
            'conditions' => array(
                'ProjectUnit.project_id' => $Deals['Deal']['deal_project_id'],
                'ProjectUnit.dummy_status' => $dummy_status,
                'ProjectUnit.unit_status' => '1',
                'ProjectUnit.unit_approved' => '1',
            ),
            'fields' => 'ProjectUnit.id, ProjectUnit.unit_name',
            'order' => 'ProjectUnit.unit_name ASC'
        ));
        $this->set(compact('project_unit_list'));

        
        $return_cond = array('type' => array($actionitems['ActionItem']['action_item_level_id'], '0'));
        $returns = $this->LookupValueActionItemReturn->find('list', array('fields' => 'id, value', 'conditions' => $return_cond, 'order' => 'value ASC'));
        $this->set(compact('returns'));


        if (!$this->request->data) {
            $this->request->data = $Deals;
        }
    }

}

?>
<?php

/**
 * Leads controller.
 *
 * This file will render views from views/leads/
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
App::uses('AppController', 'Controller');

/**
 * Leads controller
 *
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
App::uses('CakeEmail', 'Network/Email');

class LeadsController extends AppController {

    public $uses = array('Lead', 'Builder', 'MarketingPartner', 'ProjectLegalName', 'ProjectUnit', 'Deal', 'Role', 'Channel', 'Area', 'LookupValueLeadsCountry', 'LookupValueLeadsClosureProbability', 'Suburb', 'City', 'Unit', 'Project', 'Channel', 'ActionItemType', 'LeadStatus', 'LookupValueLeadsCategory', 'LookupValueLeadsCreationType', 'LookupValueLeadsImportance', 'LookupValueLeadsIndustry', 'LookupValueLeadsProgress', 'LookupValueLeadsSegment', 'LookupValueLeadsType', 'LookupValueLeadsUrgency', 'LookupValueProjectUnitType', 'ActionItem', 'LookupValueLeadsSource', 'LookupValueLeadsCurrency', 'LookupValueProjectPhase', 'LookupValueLeadsCreationType', 'User', 'Remark', 'ActionItemLevel', 'LookupValueActionItemStatus', 'LookupValueLeadsProgress', 'LookupValueProjectUnitTypeQualifier_1', 'LookupValueProjectUnitPreference', 'LookupValueActivityType', 'LookupValueLeadTransactionType', 'LookupValueActionItemRelease', 'LookupUnitCommissionEvent', 'LookupValueDealBillingType');
    public $components = array('Sms');

    public function index() {

        $dummy_status = $this->Auth->user('dummy_status');
        $condition_dummy_status = array('dummy_status' => $dummy_status);
        $user_id = $this->Auth->user('id');
        $city_id = $this->Auth->user('city_id');
        $role_id = $this->Session->read("role_id");
        $roles = $this->Role->find('all', array('conditions' => 'Role.id = ' . $role_id));
        $role_name = $roles[0]['GroupsUser']['name'];
        $channel_id = $this->Session->read("channel_id");
        $channel_id = $this->Channel->findById($channel_id);
        $channel_city_id = $channel_id['Channel']['city_id'];

        $search_condition = array();
        $ApproveCond = array();
        $CountCond = array();
        $phone_cond = array();
        $PendingCond = array();
        $mostImpCond = array();
        $UrgencyCond = array();
        $ImpCond = array();
        $SpecialCond = array();
        $AboveNintyCond = array();
        $SeventyToNintyCond = array();
        $HighPotenCond = array();
        $FiftyCond = array();
        $primary_cond = array();
        $assocoate_cond = array();
        $global_search = '';
        $search_city_id = '';
        $suburb_id = '';
        $lead_areapreference1 = '';
        $lead_suburb1 = '';
        $builder_id = '';
        $project_id = '';
        $lead_unit_id_1 = '';
        $lead_typeofprojectpreference1 = '';
        $lead_segment = '';
        $lead_importance = '';
        $lead_urgency = '';
        $lead_type = '';
        $lead_special_client_status = '';
        $lead_status = '';
        $lead_progress = '';
        $lead_channel = '';
        $lead_managerprimary = '';
        $lead_managersecondary = '';
        $lead_associate = '';
        $lead_phoneofficer = '';

        if ($this->request->is('post') || $this->request->is('put')) {

            if (!empty($this->data['Lead']['global_search'])) {
                $global_search = $this->data['Lead']['global_search'];
                array_push($search_condition, array('OR' => array($this->Lead->getVirtualField('clientfullname') . ' LIKE' => "%" . mysql_escape_string(trim(strip_tags($global_search))) . "%", 'Project.project_name' . ' LIKE' => "%" . mysql_escape_string(trim(strip_tags($global_search))) . "%", 'Lead.lead_primaryphonenumber' . ' LIKE' => "%" . mysql_escape_string(trim(strip_tags($global_search))) . "%", 'Lead.lead_secondaryphonenumber' . ' LIKE' => "%" . mysql_escape_string(trim(strip_tags($global_search))) . "%", 'Builder.builder_name' . ' LIKE' => "%" . mysql_escape_string(trim(strip_tags($global_search))) . "%")));
            }
            if (!empty($this->data['Lead']['city_id'])) {
                $search_city_id = $this->data['Lead']['city_id'];
                array_push($search_condition, array('Lead.city_id' => mysql_escape_string(trim(strip_tags($search_city_id)))));
            }
            if (!empty($this->data['Lead']['builder_id'])) {
                $builder_id = $this->data['Lead']['builder_id'];
                array_push($search_condition, array('Lead.builder_id1' => mysql_escape_string(trim(strip_tags($builder_id)))));
            }
            if (!empty($this->data['Lead']['project_id'])) {
                $project_id = $this->data['Lead']['project_id'];
                array_push($search_condition, array('Lead.proj_id1' => mysql_escape_string(trim(strip_tags($project_id)))));
            }
            if (!empty($this->data['Lead']['unit_id'])) {
                $unit_id = $this->data['Lead']['unit_id'];
                array_push($search_condition, array('Lead.lead_unit_id_1' => mysql_escape_string(trim(strip_tags($unit_id)))));
            }
            if (!empty($this->data['Lead']['lead_urgency'])) {
                $lead_urgency = $this->data['Lead']['lead_urgency'];
                array_push($search_condition, array('Lead.lead_urgency' => mysql_escape_string(trim(strip_tags($lead_urgency)))));
            }
            if (!empty($this->data['Lead']['lead_importance'])) {
                $lead_importance = $this->data['Lead']['lead_importance'];
                array_push($search_condition, array('Lead.lead_importance' => mysql_escape_string(trim(strip_tags($lead_importance)))));
            }
            if (!empty($this->data['Lead']['lead_status'])) {
                $lead_status = $this->data['Lead']['lead_status'];
                array_push($search_condition, array('Lead.lead_status' => mysql_escape_string(trim(strip_tags($lead_status)))));
            }
            if (!empty($this->data['Lead']['lead_suburb1'])) {
                $lead_suburb1 = $this->data['Lead']['lead_suburb1'];
                array_push($search_condition, array('Lead.lead_suburb1' => mysql_escape_string(trim(strip_tags($lead_suburb1)))));
            }
            if (!empty($this->data['Lead']['lead_areapreference1'])) {
                $lead_areapreference1 = $this->data['Lead']['lead_areapreference1'];
                array_push($search_condition, array('Lead.lead_areapreference1' => mysql_escape_string(trim(strip_tags($lead_areapreference1)))));
            }
            if (!empty($this->data['Lead']['lead_channel'])) {
                $lead_channel = $this->data['Lead']['lead_channel'];
                array_push($search_condition, array('Lead.lead_channel' => mysql_escape_string(trim(strip_tags($lead_channel)))));
            }
            if (!empty($this->data['Lead']['lead_closureprobabilityinnext1Month'])) {
                $lead_closureprobabilityinnext1Month = $this->data['Lead']['lead_closureprobabilityinnext1Month'];
                array_push($search_condition, array('Lead.lead_closureprobabilityinnext1Month' => $lead_closureprobabilityinnext1Month));
            }
            if (!empty($this->data['Lead']['lead_managerprimary'])) {
                $lead_managerprimary = $this->data['Lead']['lead_managerprimary'];
                array_push($search_condition, array('Lead.lead_managerprimary' => $lead_managerprimary));
            }
            if (!empty($this->data['Lead']['lead_managersecondary'])) {
                $lead_managersecondary = $this->data['Lead']['lead_managersecondary'];
                array_push($search_condition, array('Lead.lead_managersecondary' => $lead_managersecondary));
            }
            if (!empty($this->data['Lead']['lead_associate'])) {
                $lead_associate = $this->data['Lead']['lead_associate'];
                array_push($search_condition, array('Lead.lead_associate' => $lead_associate));
            }
            if (!empty($this->data['Lead']['lead_phoneofficer'])) {
                $lead_phoneofficer = $this->data['Lead']['lead_phoneofficer'];
                array_push($search_condition, array('Lead.lead_phoneofficer' => $lead_phoneofficer));
            }
            if (!empty($this->data['Lead']['lead_source'])) {
                $lead_source = $this->data['Lead']['lead_source'];
                array_push($search_condition, array('Lead.lead_source' => $lead_source));
            }
        } elseif ($this->request->is('get')) {

            if (!empty($this->request->params['named']['global_search'])) {
                $global_search = $this->request->params['named']['global_search'];

                array_push($search_condition, array('OR' => array($this->Lead->getVirtualField('clientfullname') . ' LIKE' => "%" . mysql_escape_string(trim(strip_tags($global_search))) . "%", 'Project.project_name' . ' LIKE' => "%" . mysql_escape_string(trim(strip_tags($global_search))) . "%", 'Builder.builder_name' . ' LIKE' => "%" . mysql_escape_string(trim(strip_tags($global_search))) . "%")));
            }

            if (!empty($this->request->params['named']['city_id'])) {
                $search_city_id = $this->request->params['named']['city_id'];
                array_push($search_condition, array('Lead.city_id' => $search_city_id));
            }
            if (!empty($this->request->params['named']['lead_suburb1'])) {
                $lead_suburb1 = $this->request->params['named']['lead_suburb1'];
                array_push($search_condition, array('Lead.lead_suburb1' => $lead_suburb1));
            }
            if (!empty($this->request->params['named']['lead_areapreference1'])) {
                $lead_areapreference1 = $this->request->params['named']['lead_areapreference1'];
                array_push($search_condition, array('Lead.lead_areapreference1' => $lead_areapreference1));
            }
            if (!empty($this->request->params['named']['project_id'])) {
                $project_id = $this->request->params['named']['project_id'];
                array_push($search_condition, array('Lead.project_id' => $project_id));
            }
            if (!empty($this->request->params['named']['builder_id'])) {
                $builder_id = $this->request->params['named']['builder_id'];
                array_push($search_condition, array('Lead.builder_id' => $builder_id));
            }
            if (!empty($this->request->params['named']['lead_unit_id_1'])) {
                $lead_unit_id_1 = $this->request->params['named']['lead_unit_id_1'];
                array_push($search_condition, array('Lead.lead_unit_id_1' => $lead_unit_id_1));
            }
            if (!empty($this->request->params['named']['lead_typeofprojectpreference1'])) {
                $lead_typeofprojectpreference1 = $this->request->params['named']['lead_typeofprojectpreference1'];
                array_push($search_condition, array('Lead.lead_typeofprojectpreference1' => $lead_typeofprojectpreference1));
            }
            if (!empty($this->request->params['named']['lead_segment'])) {
                $lead_segment = $this->request->params['named']['lead_segment'];
                array_push($search_condition, array('Lead.lead_segment' => $lead_segment));
            }
            if (!empty($this->request->params['named']['lead_importance'])) {
                $lead_importance = $this->request->params['named']['lead_importance'];
                array_push($search_condition, array('Lead.lead_importance' => $lead_importance));
            }
            if (!empty($this->request->params['named']['lead_urgency'])) {
                $lead_urgency = $this->request->params['named']['lead_urgency'];
                array_push($search_condition, array('Lead.lead_urgency' => $lead_urgency));
            }if (!empty($this->request->params['named']['lead_type'])) {
                $lead_type = $this->request->params['named']['lead_type'];
                array_push($search_condition, array('Lead.lead_type' => $lead_type));
            }
            if (!empty($this->request->params['named']['lead_special_client_status'])) {
                $lead_special_client_status = $this->request->params['named']['lead_special_client_status'];
                array_push($search_condition, array('Lead.lead_special_client_status' => $lead_special_client_status));
            }
            if (!empty($this->request->params['named']['lead_status'])) {
                $lead_status = $this->request->params['named']['lead_status'];
                array_push($search_condition, array('Lead.lead_status' => $lead_status));
            }
            if (!empty($this->request->params['named']['lead_progress'])) {
                $lead_progress = $this->request->params['named']['lead_progress'];
                array_push($search_condition, array('Lead.lead_progress' => $lead_progress));
            }
            if (!empty($this->request->params['named']['lead_channel'])) {
                $lead_channel = $this->request->params['named']['lead_channel'];
                array_push($search_condition, array('Lead.lead_channel' => $lead_channel));
            }
            if (!empty($this->request->params['named']['lead_closureprobabilityinnext1Month'])) {
                $lead_closureprobabilityinnext1Month = $this->request->params['named']['lead_closureprobabilityinnext1Month'];
                array_push($search_condition, array('Lead.lead_closureprobabilityinnext1Month' => $lead_closureprobabilityinnext1Month));
            }
            if (!empty($this->request->params['named']['lead_managerprimary'])) {
                $lead_managerprimary = $this->request->params['named']['lead_managerprimary'];
                array_push($search_condition, array('Lead.lead_managerprimary' => $lead_managerprimary));
            }
            if (!empty($this->request->params['named']['lead_managersecondary'])) {
                $lead_managersecondary = $this->request->params['named']['lead_managersecondary'];
                array_push($search_condition, array('Lead.lead_managersecondary' => $lead_managersecondary));
            }
            if (!empty($this->request->params['named']['lead_associate'])) {
                $lead_associate = $this->request->params['named']['lead_associate'];
                array_push($search_condition, array('Lead.lead_associate' => $lead_associate));
            }
            if (!empty($this->request->params['named']['lead_phoneofficer'])) {
                $lead_phoneofficer = $this->request->params['named']['lead_phoneofficer'];
                array_push($search_condition, array('Lead.lead_phoneofficer' => $lead_phoneofficer));
            }
            if (!empty($this->request->params['named']['lead_source'])) {
                $lead_source = $this->request->params['named']['lead_source'];
                array_push($search_condition, array('Lead.lead_source' => $lead_source));
            }
        }

        if ($role_id == '7') {// for execution manager
            array_push($search_condition, array('OR' => array('Lead.lead_managerprimary' => $user_id, 'Lead.lead_managersecondary' => $user_id)));
            array_push($ApproveCond, array('OR' => array('Lead.lead_managerprimary' => $user_id, 'Lead.lead_managersecondary' => $user_id)));
            array_push($CountCond, array('OR' => array('Lead.lead_managerprimary' => $user_id, 'Lead.lead_managersecondary' => $user_id)));
            array_push($PendingCond, array('OR' => array('Lead.lead_managerprimary' => $user_id, 'Lead.lead_managersecondary' => $user_id)));
            array_push($mostImpCond, array('OR' => array('Lead.lead_managerprimary' => $user_id, 'Lead.lead_managersecondary' => $user_id)));
            array_push($ImpCond, array('OR' => array('Lead.lead_managerprimary' => $user_id, 'Lead.lead_managersecondary' => $user_id)));
            array_push($UrgencyCond, array('OR' => array('Lead.lead_managerprimary' => $user_id, 'Lead.lead_managersecondary' => $user_id)));
            array_push($SpecialCond, array('OR' => array('Lead.lead_managerprimary' => $user_id, 'Lead.lead_managersecondary' => $user_id)));
            array_push($HighPotenCond, array('OR' => array('Lead.lead_managerprimary' => $user_id, 'Lead.lead_managersecondary' => $user_id)));
            array_push($FiftyCond, array('OR' => array('Lead.lead_managerprimary' => $user_id, 'Lead.lead_managersecondary' => $user_id)));
            array_push($SeventyToNintyCond, array('OR' => array('Lead.lead_managerprimary' => $user_id, 'Lead.lead_managersecondary' => $user_id)));
            array_push($AboveNintyCond, array('OR' => array('Lead.lead_managerprimary' => $user_id, 'Lead.lead_managersecondary' => $user_id)));
        } else if ($role_id == '14') { // Phone Officer
            array_push($search_condition, array('Lead.lead_phoneofficer' => $user_id));
            array_push($mostImpCond, array('Lead.lead_phoneofficer' => $user_id));
            array_push($CountCond, array('Lead.lead_phoneofficer' => $user_id));
            array_push($ApproveCond, array('Lead.lead_phoneofficer' => $user_id));
            array_push($PendingCond, array('Lead.lead_phoneofficer' => $user_id));
            array_push($ImpCond, array('Lead.lead_phoneofficer' => $user_id));
            array_push($UrgencyCond, array('Lead.lead_phoneofficer' => $user_id));
            array_push($SpecialCond, array('Lead.lead_phoneofficer' => $user_id));
            array_push($HighPotenCond, array('Lead.lead_phoneofficer' => $user_id));
            array_push($FiftyCond, array('Lead.lead_phoneofficer' => $user_id));
            array_push($SeventyToNintyCond, array('Lead.lead_phoneofficer' => $user_id));
            array_push($AboveNintyCond, array('Lead.lead_phoneofficer' => $user_id));
        } else if ($role_id == '5') { //Associate
            array_push($search_condition, array('Lead.lead_associate' => $user_id));
            array_push($mostImpCond, array('Lead.lead_associate' => $user_id));
            array_push($CountCond, array('Lead.lead_associate' => $user_id));
            array_push($ApproveCond, array('Lead.lead_associate' => $user_id));
            array_push($PendingCond, array('Lead.lead_associate' => $user_id));
            array_push($ImpCond, array('Lead.lead_associate' => $user_id));
            array_push($UrgencyCond, array('Lead.lead_associate' => $user_id));
            array_push($SpecialCond, array('Lead.lead_associate' => $user_id));
            array_push($HighPotenCond, array('Lead.lead_associate' => $user_id));
            array_push($FiftyCond, array('Lead.lead_associate' => $user_id));
            array_push($SeventyToNintyCond, array('Lead.lead_associate' => $user_id));
        } else if ($role_id == '15') { //Accounts
            if ($channel_city_id == '2') {
                array_push($search_condition, array('Lead.lead_associate' => $user_id, 'Lead.city_id' => $channel_city_id));
                array_push($mostImpCond, array('Lead.lead_associate' => $user_id, 'Lead.city_id' => $channel_city_id));
                array_push($CountCond, array('Lead.lead_associate' => $user_id, 'Lead.city_id' => $channel_city_id));
                array_push($ApproveCond, array('Lead.lead_associate' => $user_id, 'Lead.city_id' => $channel_city_id));
                array_push($PendingCond, array('Lead.lead_associate' => $user_id, 'Lead.city_id' => $channel_city_id));
                array_push($ImpCond, array('Lead.lead_associate' => $user_id, 'Lead.city_id' => $channel_city_id));
                array_push($UrgencyCond, array('Lead.lead_associate' => $user_id, 'Lead.city_id' => $channel_city_id));
                array_push($SpecialCond, array('Lead.lead_associate' => $user_id, 'Lead.city_id' => $channel_city_id));
                array_push($HighPotenCond, array('Lead.lead_associate' => $user_id, 'Lead.city_id' => $channel_city_id));
                array_push($FiftyCond, array('Lead.lead_associate' => $user_id, 'Lead.city_id' => $channel_city_id));
                array_push($SeventyToNintyCond, array('Lead.lead_associate' => $user_id, 'Lead.city_id' => $channel_city_id));
            } else {
                array_push($search_condition, array('NOT' => array('Lead.city_id' => 2), 'Lead.lead_associate' => $user_id));
                array_push($mostImpCond, array('NOT' => array('Lead.city_id' => 2), 'Lead.lead_associate' => $user_id));
                array_push($CountCond, array('NOT' => array('Lead.city_id' => 2), 'Lead.lead_associate' => $user_id));
                array_push($ApproveCond, array('NOT' => array('Lead.city_id' => 2), 'Lead.lead_associate' => $user_id));
                array_push($PendingCond, array('NOT' => array('Lead.city_id' => 2), 'Lead.lead_associate' => $user_id));
                array_push($ImpCond, array('NOT' => array('Lead.city_id' => 2), 'Lead.lead_associate' => $user_id));
                array_push($UrgencyCond, array('NOT' => array('Lead.city_id' => 2), 'Lead.lead_associate' => $user_id));
                array_push($SpecialCond, array('NOT' => array('Lead.city_id' => 2), 'Lead.lead_associate' => $user_id));
                array_push($HighPotenCond, array('NOT' => array('Lead.city_id' => 2), 'Lead.lead_associate' => $user_id));
                array_push($FiftyCond, array('NOT' => array('Lead.city_id' => 2), 'Lead.lead_associate' => $user_id));
                array_push($SeventyToNintyCond, array('NOT' => array('Lead.city_id' => 2), 'Lead.lead_associate' => $user_id));
            }
        } else if ($channel_city_id > '1') { //Not global
            array_push($search_condition, array('Lead.city_id' => $channel_city_id));
            array_push($CountCond, array('Lead.city_id' => $channel_city_id));
            array_push($ApproveCond, array('Lead.city_id' => $channel_city_id));
            array_push($PendingCond, array('Lead.city_id' => $channel_city_id));
            array_push($mostImpCond, array('Lead.city_id' => $channel_city_id));
            array_push($ImpCond, array('Lead.city_id' => $channel_city_id));
            array_push($UrgencyCond, array('Lead.city_id' => $channel_city_id));
            array_push($SpecialCond, array('Lead.city_id' => $channel_city_id));
            array_push($HighPotenCond, array('Lead.city_id' => $channel_city_id));
            array_push($FiftyCond, array('Lead.city_id' => $channel_city_id));
            array_push($SeventyToNintyCond, array('Lead.city_id' => $channel_city_id));
            array_push($AboveNintyCond, array('Lead.city_id' => $channel_city_id));
            array_push($primary_cond, array('User.city_id' => $channel_city_id));
            array_push($phone_cond, array('User.city_id' => $channel_city_id));
            array_push($assocoate_cond, array('User.city_id' => $channel_city_id));
        }


        if ($dummy_status)
            array_push($search_condition, array('Lead.dummy_status' => $dummy_status));

        if (count($this->params['pass'])) {

            $aaray = explode(':', $this->params['pass'][0]);
            $field = $aaray[0];
            $value = $aaray[1];
            array_push($search_condition, array('Lead.' . $field => $value)); // when 
        }

        $this->paginate['order'] = array('Lead.created' => 'desc');

        $leads = $this->paginate("Lead", $search_condition);
        $this->set(compact('leads'));



        array_push($CountCond, array('Lead.dummy_status' => $dummy_status));
        $all_count = $this->Lead->find('count', array('conditions' => $CountCond));
        $this->set(compact('all_count'));

        array_push($ApproveCond, array('Lead.lead_source' => '3', 'Lead.dummy_status' => $dummy_status));
        $old_client_count = $this->Lead->find('count', array('conditions' => $ApproveCond));
        $this->set(compact('old_client_count'));

        array_push($PendingCond, array('Lead.lead_source !=3', 'Lead.dummy_status' => $dummy_status));
        $new_client_count = $this->Lead->find('count', array('conditions' => $PendingCond));
        $this->set(compact('new_client_count'));

        array_push($mostImpCond, array('OR' => array('Lead.lead_importance' => '2', 'Lead.lead_urgency' => '2', 'Lead.lead_special_client_status' => '1'), 'Lead.dummy_status' => $dummy_status));
        $most_tmportent_count = $this->Lead->find('count', array('conditions' => $mostImpCond));
        $this->set(compact('most_tmportent_count'));

        array_push($ImpCond, array('OR' => array('Lead.lead_urgency' => '2', 'Lead.lead_importance' => '2'), 'Lead.dummy_status' => $dummy_status));
        $importance_urgency_count = $this->Lead->find('count', array('conditions' => $ImpCond));
        $this->set(compact('importance_urgency_count'));

        /*
          array_push($UrgencyCond, array('Lead.dummy_status' => $dummy_status,'Lead.lead_urgency' => '2'));
          $urgency_count = $this->Lead->find('count',array('conditions' => $UrgencyCond));
          $this->set(compact('urgency_count'));
         */

        array_push($SpecialCond, array('Lead.dummy_status' => $dummy_status, 'Lead.lead_special_client_status' => '1'));
        $special_count = $this->Lead->find('count', array('conditions' => $SpecialCond));
        $this->set(compact('special_count'));

        array_push($HighPotenCond, array('OR' => array('Lead.lead_closureprobabilityinnext1Month' => array('2', '1')), 'Lead.dummy_status' => $dummy_status));
        $high_potential_count = $this->Lead->find('count', array('conditions' => $HighPotenCond));
        $this->set(compact('high_potential_count'));

        //$log = $this->Lead->getDataSource()->getLog(false, false);       
        //debug($log);
        /*
          array_push($FiftyCond, array('Lead.dummy_status' => $dummy_status,'Lead.lead_closureprobabilityinnext1Month' => '6'));
          $fifty_count = $this->Lead->find('count',array('conditions' => $FiftyCond));
          $this->set(compact('fifty_count'));
         */

        array_push($SeventyToNintyCond, array('Lead.dummy_status' => $dummy_status, 'Lead.lead_closureprobabilityinnext1Month' => '2'));
        $seventy_to_ninty_count = $this->Lead->find('count', array('conditions' => $SeventyToNintyCond));
        $this->set(compact('seventy_to_ninty_count'));

        array_push($AboveNintyCond, array('Lead.dummy_status' => $dummy_status, 'Lead.lead_closureprobabilityinnext1Month' => '1'));
        $above_ninty_count = $this->Lead->find('count', array('conditions' => $AboveNintyCond));
        $this->set(compact('above_ninty_count'));

        $activity_count = $this->Event->find('count', array('conditions' => array('Event.dummy_status' => $dummy_status, 'Event.event_type' => '2', 'Event.creator_id' => $user_id)));
        $this->set(compact('activity_count'));

        $action_count = $this->ActionItem->find('count', array('conditions' => array('OR' => array('ActionItem.next_action_by' => $user_id, 'ActionItem.created_by_id' => $user_id), 'ActionItem.dummy_status' => $dummy_status)));
        $this->set(compact('action_count'));

        $all_action_pending = $this->ActionItem->find('count', array('conditions' => array('ActionItem.next_action_by' => $user_id, 'ActionItem.action_item_active' => 'Yes')));
        $this->set(compact('all_action_pending'));



        if ($channel_city_id == '1')
            $city = $this->City->find('list', array('fields' => 'City.id, City.city_name', 'conditions' => array('City.dummy_status' => $dummy_status, 'City.city_status' => '1'), 'order' => 'City.city_name ASC'));
        else
            $city = $this->City->find('list', array('fields' => 'City.id, City.city_name', 'conditions' => array('City.id' => $channel_city_id, 'City.dummy_status' => $dummy_status, 'City.city_status' => '1'), 'order' => 'City.city_name ASC'));

        $this->set('city', $city);

        $led_type = $this->LookupValueLeadsType->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('led_type'));

        $conProject = array('Project.dummy_status' => $dummy_status, 'Project.city_id' => $search_city_id);
        $project = $this->Project->find('list', array('fields' => 'Project.id, Project.project_name', 'conditions' => $conProject, 'order' => 'Project.project_name ASC'));
        $this->set('project', $project);




        $builders = $this->Builder->find('list', array(
            'conditions' => array('OR' => array(
                    'Builder.builder_primarycity' => $search_city_id,
                    'Builder.builder_secondarycity' => $search_city_id,
                    'Builder.builder_tertiarycity' => $search_city_id,
                    'Builder.city_4' => $search_city_id,
                    'Builder.city_5' => $search_city_id,
                ),
                'Builder.builder_approved' => '1'
            ),
            'fields' => 'Builder.id, Builder.builder_name',
            'order' => 'Builder.builder_name ASC'
        ));
        $this->set('builder', $builders);


        $unit = $this->LookupValueProjectUnitPreference->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set('unit', $unit);

        $country = $this->LookupValueLeadsCountry->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('country'));

        $status = $this->LeadStatus->find('list', array('fields' => array('id', 'status')));
        $this->set(compact('status'));

        $importance = $this->LookupValueLeadsImportance->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $this->set(compact('importance'));

        $urgencies = $this->LookupValueLeadsUrgency->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $this->set(compact('urgencies'));

        $conSuburb = array('Suburb.dummy_status' => $dummy_status, 'Suburb.city_id' => $search_city_id, 'Suburb.suburb_status' => '1');
        $suburbs = $this->Suburb->find('list', array('fields' => 'Suburb.id, Suburb.suburb_name', 'conditions' => $conSuburb, 'order' => 'Suburb.suburb_name ASC'));
        $this->set(compact('suburbs'));

        $conArea = array('Area.dummy_status' => $dummy_status, 'Area.city_id' => $search_city_id, 'Area.suburb_id' => $suburb_id, 'Area.area_status' => '1');
        $areas = $this->Area->find('list', array('fields' => 'Area.id, Area.area_name', 'conditions' => $conArea, 'order' => 'Area.area_name ASC'));
        $this->set('areas', $areas);

        $channels = $this->Channel->find('list', array('fields' => 'id, channel_name', 'conditions' => $condition_dummy_status, 'order' => 'channel_name ASC'));
        $this->set('channels', $channels);

        $lead_progrss = $this->LookupValueLeadsProgress->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $this->set(compact('lead_progrss'));

        $type_preference = $this->LookupValueProjectPhase->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('type_preference'));

        $segment = $this->LookupValueLeadsSegment->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $this->set(compact('segment'));

        $closureprobabilities = $this->LookupValueLeadsClosureProbability->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $this->set(compact('closureprobabilities'));

        $source = $this->LookupValueLeadsSource->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('source'));

        array_push($primary_cond, array('User.dummy_status' => $dummy_status, 'User.exu_role_id' => '7'));
        $primary_manager = $this->User->find('all', array('fields' => array('User.id', 'User.fname', 'User.lname'),
            'conditions' => $primary_cond, 'order' => 'User.fname asc'));

        $primary_manager = Set::combine($primary_manager, '{n}.User.id', array('%s %s', '{n}.User.fname', '{n}.User.lname'));
        $this->set(compact('primary_manager'));

        array_push($phone_cond, array('User.dummy_status' => $dummy_status, 'User.phone_role_id' => '14'));
        $phone_officer = $this->User->find('all', array('fields' => array('User.id', 'User.fname', 'User.lname'),
            'conditions' => $phone_cond, 'order' => 'User.fname asc'));

        $phone_officer = Set::combine($phone_officer, '{n}.User.id', array('%s %s', '{n}.User.fname', '{n}.User.lname'));
        $this->set(compact('phone_officer'));

        array_push($assocoate_cond, array('User.dummy_status' => $dummy_status, 'User.distributor_role_id' => '5'));
        $associate = $this->User->find('all', array('fields' => array('User.id', 'User.fname', 'User.lname'),
            'conditions' => $assocoate_cond, 'order' => 'User.fname asc'));

        $associate = Set::combine($associate, '{n}.User.id', array('%s %s', '{n}.User.fname', '{n}.User.lname'));
        $this->set(compact('associate'));

        if (!isset($this->passedArgs['global_search']) && empty($this->passedArgs['global_search'])) {
            $this->passedArgs['global_search'] = (isset($this->data['Lead']['global_search'])) ? $this->data['Lead']['global_search'] : '';
        }
        if (!isset($this->passedArgs['city_id']) && empty($this->passedArgs['city_id'])) {
            $this->passedArgs['city_id'] = (isset($this->data['Lead']['city_id'])) ? $this->data['Lead']['city_id'] : '';
        }
        if (!isset($this->passedArgs['lead_suburb1']) && empty($this->passedArgs['lead_suburb1'])) {
            $this->passedArgs['lead_suburb1'] = (isset($this->data['Lead']['lead_suburb1'])) ? $this->data['Lead']['lead_suburb1'] : '';
        }
        if (!isset($this->passedArgs['lead_areapreference1']) && empty($this->passedArgs['lead_areapreference1'])) {
            $this->passedArgs['lead_areapreference1'] = (isset($this->data['Lead']['lead_areapreference1'])) ? $this->data['Lead']['lead_areapreference1'] : '';
        }
        if (!isset($this->passedArgs['builder_id']) && empty($this->passedArgs['builder_id'])) {
            $this->passedArgs['builder_id'] = (isset($this->data['Lead']['builder_id'])) ? $this->data['Lead']['builder_id'] : '';
        }
        if (!isset($this->passedArgs['project_id']) && empty($this->passedArgs['project_id'])) {
            $this->passedArgs['project_id'] = (isset($this->data['Lead']['project_id'])) ? $this->data['Lead']['project_id'] : '';
        }
        if (!isset($this->passedArgs['lead_unit_id_1']) && empty($this->passedArgs['lead_unit_id_1'])) {
            $this->passedArgs['lead_unit_id_1'] = (isset($this->data['Lead']['lead_unit_id_1'])) ? $this->data['Lead']['lead_unit_id_1'] : '';
        }
        if (!isset($this->passedArgs['lead_typeofprojectpreference1']) && empty($this->passedArgs['lead_typeofprojectpreference1'])) {
            $this->passedArgs['lead_typeofprojectpreference1'] = (isset($this->data['Lead']['lead_typeofprojectpreference1'])) ? $this->data['Lead']['lead_typeofprojectpreference1'] : '';
        }
        if (!isset($this->passedArgs['lead_segment']) && empty($this->passedArgs['lead_segment'])) {
            $this->passedArgs['lead_segment'] = (isset($this->data['Lead']['lead_segment'])) ? $this->data['Lead']['lead_segment'] : '';
        }
        if (!isset($this->passedArgs['lead_importance']) && empty($this->passedArgs['lead_importance'])) {
            $this->passedArgs['lead_importance'] = (isset($this->data['Lead']['lead_importance'])) ? $this->data['Lead']['lead_importance'] : '';
        }
        if (!isset($this->passedArgs['lead_urgency']) && empty($this->passedArgs['lead_urgency'])) {
            $this->passedArgs['lead_urgency'] = (isset($this->data['Lead']['lead_urgency'])) ? $this->data['Lead']['lead_urgency'] : '';
        }
        if (!isset($this->passedArgs['lead_type']) && empty($this->passedArgs['lead_type'])) {
            $this->passedArgs['lead_type'] = (isset($this->data['Lead']['lead_type'])) ? $this->data['Lead']['lead_type'] : '';
        }
        if (!isset($this->passedArgs['lead_special_client_status']) && empty($this->passedArgs['lead_special_client_status'])) {
            $this->passedArgs['lead_special_client_status'] = (isset($this->data['Lead']['lead_special_client_status'])) ? $this->data['Lead']['lead_special_client_status'] : '';
        }
        if (!isset($this->passedArgs['lead_status']) && empty($this->passedArgs['lead_status'])) {
            $this->passedArgs['lead_status'] = (isset($this->data['Lead']['lead_status'])) ? $this->data['Lead']['lead_status'] : '';
        }
        if (!isset($this->passedArgs['lead_progress']) && empty($this->passedArgs['lead_progress'])) {
            $this->passedArgs['lead_progress'] = (isset($this->data['Lead']['lead_progress'])) ? $this->data['Lead']['lead_progress'] : '';
        }
        if (!isset($this->passedArgs['lead_channel']) && empty($this->passedArgs['lead_channel'])) {
            $this->passedArgs['lead_channel'] = (isset($this->data['Lead']['lead_channel'])) ? $this->data['Lead']['lead_channel'] : '';
        }
        if (!isset($this->passedArgs['lead_closureprobabilityinnext1Month']) && empty($this->passedArgs['lead_closureprobabilityinnext1Month'])) {
            $this->passedArgs['lead_closureprobabilityinnext1Month'] = (isset($this->data['Lead']['lead_closureprobabilityinnext1Month'])) ? $this->data['Lead']['lead_closureprobabilityinnext1Month'] : '';
        }
        if (!isset($this->passedArgs['lead_managerprimary']) && empty($this->passedArgs['lead_managerprimary'])) {
            $this->passedArgs['lead_managerprimary'] = (isset($this->data['Lead']['lead_managerprimary'])) ? $this->data['Lead']['lead_managerprimary'] : '';
        }
        if (!isset($this->passedArgs['lead_managersecondary']) && empty($this->passedArgs['lead_managersecondary'])) {
            $this->passedArgs['lead_managersecondary'] = (isset($this->data['Lead']['lead_managersecondary'])) ? $this->data['Lead']['lead_managersecondary'] : '';
        }
        if (!isset($this->passedArgs['lead_associate']) && empty($this->passedArgs['lead_associate'])) {
            $this->passedArgs['lead_associate'] = (isset($this->data['Lead']['lead_associate'])) ? $this->data['Lead']['lead_associate'] : '';
        }
        if (!isset($this->passedArgs['lead_phoneofficer']) && empty($this->passedArgs['lead_phoneofficer'])) {
            $this->passedArgs['lead_phoneofficer'] = (isset($this->data['Lead']['lead_phoneofficer'])) ? $this->data['Lead']['lead_phoneofficer'] : '';
        }
        if (!isset($this->passedArgs['lead_source']) && empty($this->passedArgs['lead_source'])) {
            $this->passedArgs['lead_source'] = (isset($this->data['Lead']['lead_source'])) ? $this->data['Lead']['lead_source'] : '';
        }

        if (!isset($this->data) && empty($this->data)) {
            $this->data['Lead']['global_search'] = $this->passedArgs['global_search'];
            $this->data['Lead']['city_id'] = $this->passedArgs['city_id'];
            $this->data['Lead']['lead_suburb1'] = $this->passedArgs['lead_suburb1'];
            $this->data['Lead']['lead_areapreference1'] = $this->passedArgs['lead_areapreference1'];
            $this->data['Lead']['builder_id'] = $this->passedArgs['builder_id'];
            $this->data['Lead']['project_id'] = $this->passedArgs['project_id'];
            $this->data['Lead']['lead_unit_id_1'] = $this->passedArgs['lead_unit_id_1'];
            $this->data['Lead']['lead_typeofprojectpreference1'] = $this->passedArgs['lead_typeofprojectpreference1'];
            $this->data['Lead']['lead_segment'] = $this->passedArgs['lead_segment'];
            $this->data['Lead']['lead_importance'] = $this->passedArgs['lead_importance'];
            $this->data['Lead']['lead_urgency'] = $this->passedArgs['lead_urgency'];
            $this->data['Lead']['lead_type'] = $this->passedArgs['lead_type'];
            $this->data['Lead']['lead_special_client_status'] = $this->passedArgs['lead_special_client_status'];
            $this->data['Lead']['lead_status'] = $this->passedArgs['lead_status'];
            $this->data['Lead']['lead_progress'] = $this->passedArgs['lead_progress'];
            $this->data['Lead']['lead_channel'] = $this->passedArgs['lead_channel'];
            $this->data['Lead']['lead_closureprobabilityinnext1Month'] = $this->passedArgs['lead_closureprobabilityinnext1Month'];
            $this->data['Lead']['lead_managerprimary'] = $this->passedArgs['lead_managerprimary'];
            $this->data['Lead']['lead_managersecondary'] = $this->passedArgs['lead_managersecondary'];
            $this->data['Lead']['lead_associate'] = $this->passedArgs['lead_associate'];
            $this->data['Lead']['lead_phoneofficer'] = $this->passedArgs['lead_phoneofficer'];
            $this->data['Lead']['lead_source'] = $this->passedArgs['lead_source'];
        }

        $this->set(compact('global_search'));
        $this->set(compact('search_city_id'));
        $this->set(compact('lead_suburb1'));
        $this->set(compact('lead_areapreference1'));
        $this->set(compact('builder_id'));
        $this->set(compact('project_id'));
        $this->set(compact('lead_unit_id_1'));
        $this->set(compact('lead_typeofprojectpreference1'));
        $this->set(compact('lead_segment'));
        $this->set(compact('lead_importance'));
        $this->set(compact('lead_urgency'));
        $this->set(compact('lead_type'));
        $this->set(compact('lead_special_client_status'));
        $this->set(compact('lead_status'));
        $this->set(compact('lead_progress'));
        $this->set(compact('lead_channel'));
        $this->set(compact('lead_closureprobabilityinnext1Month'));
        $this->set(compact('lead_managerprimary'));
        $this->set(compact('lead_managersecondary'));
        $this->set(compact('lead_associate'));
        $this->set(compact('lead_phoneofficer'));
    }

    public function add() {
        //$this->layout = 'ajax';
        $dummy_status = $this->Auth->user('dummy_status');
        $this->set(compact('dummy_status'));
        $condition_dummy_status = array('dummy_status' => $dummy_status);
        $user_id = $this->Auth->User('id');
        //$city_id = $this->Auth->User('city_id');
        $phone_officer = array();
        $phone_value = '';
        $creation_default_value = '';
        $associate = array();
        $channel_id = $this->Session->read("channel_id");
        $channel_id = $this->Channel->findById($channel_id);

        $city_id = $channel_id['Channel']['city_id'];

        $role_id = $this->Session->read("role_id");
        $roles = $this->Role->find('all', array('conditions' => 'Role.id = ' . $role_id));


        $creation_type = $roles[0]['GroupsUser']['name'];

        $this->set(compact('role_id'));



        $conditions = '';
        $city_conditions = '';
        $phone_coditions = '';
        $id = 'phone_officer_id';
        if ($role_id == '24' || $role_id == '1') {
            //$conditions = array('NOT' => array('value' => array('Administrator','System Admin')));
            $city_conditions = array('dummy_status' => $dummy_status, 'city_status' => '1');
        } elseif ($role_id == '5') {
            $conditions = array('id' => '4');
            $id = 'phone_officer_id';
            $city_conditions = array('dummy_status' => $dummy_status, 'city_status' => '1');
            $creation_default_value = '4';


            $associate = $this->User->find('all', array('fields' => array('User.id', 'User.fname', 'User.lname'),
                'conditions' => array('User.id' => $user_id)));

            $associate = Set::combine($associate, '{n}.User.id', array('%s %s', '{n}.User.fname', '{n}.User.lname'));
        } elseif ($role_id == '14') {
            $conditions = array('id' => '1');
            $city_conditions = array('id' => $city_id);
            $phone_coditions = array('city_id' => $city_id);
            $creation_default_value = '1';


            $phone_officer = $this->User->find('all', array('fields' => array('User.id', 'User.fname', 'User.mname', 'User.lname'), 'conditions' => array(
                    // 'User.city_id' => $phone_coditions,
                    'User.id' => $user_id, // 14 for phone office of roles table
                ),));

            $phone_officer = Set::combine($phone_officer, '{n}.User.id', array('%s %s %s', '{n}.User.fname', '{n}.User.mname', '{n}.User.lname'));

            foreach ($phone_officer as $phone_val) {
                $phone_value = $phone_val;
            }
        } elseif ($role_id == '7') {

            $city_conditions = array('dummy_status' => $dummy_status, 'city_status' => '1');
        } else {

            $city_conditions = array('dummy_status' => $dummy_status, 'city_status' => '1');
        }

        $this->set(compact('phone_officer'));
        $this->set(compact('associate'));
        $this->set(compact('phone_value'));
        $this->set(compact('creation_default_value'));

        if ($this->request->is('post')) {


            $next_action_by = '';


            $business_admin = $this->Channel->find('first', array('conditions' => array('Channel.city_id' => $this->data['Lead']['city_id'], 'Channel.channel_role' => '4', 'Channel.dummy_status' => $dummy_status)));  // business admin logic. 4 for business admin of groups_users table

            if (!empty($business_admin)) {
                $next_action_id = $this->User->find('first', array('conditions' => array('User.business_admin_channel_id' => $business_admin['Channel']['id'], 'User.business_admin_role_id' => 4, 'User.dummy_status' => $dummy_status))); // 4 for business admin of roles table	

                if (!empty($next_action_id)) {
                    $next_action_by = $next_action_id['User']['id'];
                }
            }


            $this->request->data['Lead']['created_by'] = $user_id;
            $this->request->data['Lead']['dummy_status'] = $dummy_status;
            $this->request->data['Lead']['lead_sandboxed'] = 'No';
            $this->request->data['Lead']['lead_progress'] = '1'; // 1 for Fresh Client of lookup_value_leads_progresses
            $this->request->data['Lead']['lead_travel_potential'] = '1'; // 1 for yes of  lookup_value_statuses
            $this->request->data['Lead']['lead_loan_potential'] = '1';   // ,,
            $this->request->data['Lead']['lead_insurance_potential'] = '2';  // 2 for no of lookup_value_statuses
            $this->request->data['Lead']['lead_pwm_potential'] = '2';  // 2 for no of lookup_value_statuses
            $this->request->data['Lead']['lead_email_subscription'] = '1'; // 1 for yes of  lookup_value_statuses
            $this->request->data['Lead']['lead_email_id_for_subscription'] = $this->data['Lead']['lead_emailid'];
            $this->request->data['Lead']['lead_special_client_status'] = '2';   // 2 for no of lookup_value_statuses
            $this->request->data['Lead']['lead_multicity_status'] = '2';   // 2 for no of lookup_value_statuses
            // $this->Lead->create();
            $this->Lead->set($this->data);
            if ($this->Lead->validates() == true) {
                if ($this->Lead->save($this->request->data)) {
                    $lead_id = $this->Lead->getLastInsertId();
                    $lead = $this->Lead->findById($lead_id);
                    $actionitem['ActionItem']['lead_id'] = $lead_id;

                    if ($this->data['Lead']['lead_source'] == 3) {
                        $actionitem['ActionItem']['action_item_level_id'] = '10'; // 10 for old client
                        $actionitem['ActionItem']['description'] = 'Old Client Record Created - Waiting For Allocation';
                        $message1 = 'OLD';
                        //$remarks['Remark']['remarks'] = 'Old Client Record Created';
                    } else {
                        $actionitem['ActionItem']['action_item_level_id'] = '1'; // 1 for client
                        $actionitem['ActionItem']['description'] = 'New Client Record Created - Waiting For Allocation';
                        $message1 = 'NEW';

                        //$remarks['Remark']['remarks'] = 'New Client Record Created';
                    }

                    if ($this->data['Lead']['lead_creation_type'] == 1) { // PHONE OFFICER
                        $this->request->data['Lead']['lead_phoneofficer'] = $this->data['Lead']['lead_phoneofficer'];
                        $this->request->data['Lead']['lead_associate'] = NULL;
                        $remarks['Remark']['remarks'] = $message1 . ' CALL client created by ' . strtoupper($lead['User']['fname'] . ' ' . $lead['User']['lname']) . ' for phone officer ' . strtoupper($lead['PhoneOfficer']['fname'] . ' ' . $lead['PhoneOfficer']['lname']);
                    } else if ($this->data['Lead']['lead_creation_type'] == 4) { // ASSOCIATE
                        $this->request->data['Lead']['lead_phoneofficer'] = NULL;
                        $this->request->data['Lead']['lead_associate'] = $this->data['Lead']['lead_associate'];
                        $remarks['Remark']['remarks'] = $message1 . ' REFERRAL client created by ' . strtoupper($lead['User']['fname'] . ' ' . $lead['User']['lname']) . ' for associate ' . strtoupper($lead['PhoneOfficer']['fname'] . ' ' . $lead['PhoneOfficer']['lname']);
                    } else {  // ENQUIRY
                        $this->request->data['Lead']['lead_phoneofficer'] = NULL;
                        $this->request->data['Lead']['lead_associate'] = NULL;
                        $remarks['Remark']['remarks'] = $message1 . ' ENQUIRY client created by ' . strtoupper($lead['User']['fname'] . ' ' . $lead['User']['lname']);
                    }

                    $actionitem['ActionItem']['type_id'] = '1'; // 1 for waiting for allocation
                    $actionitem['ActionItem']['next_action_by'] = '146';
                    $actionitem['ActionItem']['action_item_active'] = 'Yes';
                    $actionitem['ActionItem']['action_item_status'] = '1'; //1 for created table - lookup_value_action_item_statuses
                    $actionitem['ActionItem']['action_item_source'] = $role_id;
                    $actionitem['ActionItem']['created_by_id'] = $user_id;
                    $actionitem['ActionItem']['created_by'] = $user_id;
                    $actionitem['ActionItem']['dummy_status'] = $dummy_status;
                    $action_item['ActionItem']['action_industry'] = '1'; // for realestate of lookup_value_activity_industry    

                    $remarks['Remark']['lead_id'] = $lead_id;
                    $remarks['Remark']['remarks_by'] = $user_id;
                    $remarks['Remark']['created_by'] = $user_id;
                    $remarks['Remark']['remarks_time'] = date('g:i A');
                    $remarks['Remark']['remarks_level'] = '3'; //3 for client from lookup_value_remarks_level
                    $remarks['Remark']['dummy_status'] = $dummy_status;
                    $this->ActionItem->save($actionitem);
                    $ActionId = $this->ActionItem->getLastInsertId();
                    $this->ActionItem->id = $ActionId;
                    $this->ActionItem->saveField('parent_action_item_id', $ActionId);
                    $this->Remark->save($remarks);

                    if ($this->data['Lead']['lead_source'] != 3) { // if source is not old client


                        /* Email Logic */
                        $to = array('administrator@silkrouters.com', 'data@silkrouters.com');
                        $cc = 'infra@sumanus.com';
                        $Email = new CakeEmail();
                        $Email->viewVars(array(
                            'Source' => strtoupper($lead['Source']['value']),
                            'CreatedBy' => strtoupper($lead['User']['fname'] . ' ' . $lead['User']['lname']),
                            'PhoneOfficer' => strtoupper($lead['PhoneOfficer']['fname'] . ' ' . $lead['PhoneOfficer']['lname']),
                            'Associate' => strtoupper($lead['Associate']['fname'] . ' ' . $lead['Associate']['lname']),
                            'City' => strtoupper(substr($lead['City']['city_name'], 0, 3)),
                            'Urgency' => strtoupper(substr($lead['Urgency']['value'], 0, 3)),
                            'Importance' => strtoupper(substr($lead['Importance']['value'], 0, 3)),
                            'Country' => strtoupper(substr($lead['Country']['value'], 0, 2)),
                            'lead_primaryphonenumber' => $lead['PrimaryCode']['code'] . '- ' . $lead['Lead']['lead_primaryphonenumber'],
                            'lead_name' => strtoupper($lead['Lead']['lead_fname']) . ' ' . strtoupper($lead['Lead']['lead_lname']),
                            'lead_emailid' => $lead['Lead']['lead_emailid'],
                            'Area' => strtoupper($lead['AreaPreference']['area_name']),
                            'Unit' => strtoupper($lead['Unit']['value']),
                            'Suburb' => strtoupper($lead['Suburb']['suburb_name']),
                            'Builder' => strtoupper($lead['Builder']['builder_name']),
                            'Project' => strtoupper($lead['Project']['project_name']),
                            'TypeProject' => strtoupper($lead['ProjectType']['value']),
                            'Type' => strtoupper($lead['Type']['value']),
                            'Description' => strtoupper($lead['Lead']['lead_description']),
                        ));
                        $Email->template('Leads/add', 'default')->emailFormat('html')->to($to)->cc($cc)->from('admin@silkrouters.com')->subject('A New Client For -' . $lead['City']['city_name'])->send();
                    }
                    /* End Emial */

                    $this->Session->setFlash('Your new client record has been created. Waiting for allocation at the moment.', 'success');

                    $this->redirect(array('controller' => 'messages', 'action' => 'index', 'leads', 'my-clients'));
                } else {
                    $this->Session->setFlash('Unable to add Lead.', 'failure');
                }
            }
        }

        $city = $this->City->find('list', array('fields' => 'City.id, City.city_name', 'conditions' => $city_conditions, 'order' => 'City.city_name ASC'));

        $this->set('city', $city);






        //$codes = $this->LookupValueLeadsCountry->find('list', array('fields' => 'id,code', 'order' => 'code ASC'));
        $this->set(compact('phone_officer'));

        // $log = $this->User->getDataSource()->getLog(false, false);       
        // debug($log);

        /*

          $phone_officer = $this->User->find('list', array('conditions' => array(
          'User.city_id' => $phone_coditions,
          'User.phone_role_id' => 14,     // 14 for phone office of roles table
          'User.dummy_status' => $dummy_status

          ),
          'fields' => 'Channel.id, Channel.channel_name',
          'order' => 'Channel.channel_name ASC'
          ));

          $this->set(compact('phone_officer'));
         */
        //$log = $this->Channel->getDataSource()->getLog(false, false);       
        //debug($log);
        $this->set(compact('id'));

        $builders = $this->Builder->find('list', array('fields' => 'Builder.id, Builder.builder_name', 'conditions' => $condition_dummy_status, 'order' => 'Builder.builder_name ASC'));

        $this->set('builders', $builders);

        $projects = $this->Lead->Project->find('list', array('fields' => 'Project.id, Project.project_name', 'conditions' => $condition_dummy_status, 'order' => 'Project.project_name ASC'));
        $this->set('projects', $projects);

        $suburbs = $this->Suburb->find('list', array('fields' => 'Suburb.id, Suburb.suburb_name', 'conditions' => array('Suburb.dummy_status' => $dummy_status, 'Suburb.suburb_status' => '1'), 'order' => 'Suburb.suburb_name ASC'));
        $this->set(compact('suburbs'));

        $areas = $this->Area->find('list', array('fields' => 'Area.id, Area.area_name', 'conditions' => array('Area.dummy_status' => $dummy_status, 'Area.area_status' => '1'), 'order' => 'Area.area_name ASC'));
        $this->set('areas', $areas);

        $units = $this->LookupValueProjectUnitPreference->find('list', array('fields' => 'LookupValueProjectUnitPreference.id, LookupValueProjectUnitPreference.value', 'order' => 'LookupValueProjectUnitPreference.value ASC'));
        $this->set('unit', $units);

        $types = $this->LookupValueLeadsType->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $this->set(compact('types'));

        $status = $this->LeadStatus->find('list', array('fields' => array('id', 'status')));
        $this->set(compact('status'));

        $categories = $this->LookupValueLeadsCategory->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $this->set(compact('categories'));

        $industry = $this->LookupValueLeadsIndustry->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $this->set(compact('industry'));
        $segment = $this->LookupValueLeadsSegment->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $this->set(compact('segment'));

        $importance = $this->LookupValueLeadsImportance->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $this->set(compact('importance'));

        $urgencies = $this->LookupValueLeadsUrgency->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $this->set(compact('urgencies'));

        $lead_progrss = $this->LookupValueLeadsProgress->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $this->set(compact('lead_progrss'));

        $countires = $this->LookupValueLeadsCountry->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $this->set(compact('countires'));

        $codes = $this->LookupValueLeadsCountry->find('all', array('fields' => array('LookupValueLeadsCountry.id', 'LookupValueLeadsCountry.value', 'LookupValueLeadsCountry.code')));

        $codes = Set::combine($codes, '{n}.LookupValueLeadsCountry.id', array('%s: %s', '{n}.LookupValueLeadsCountry.value', '{n}.LookupValueLeadsCountry.code'));


        //$codes = $this->LookupValueLeadsCountry->find('list', array('fields' => 'id,code', 'order' => 'code ASC'));
        $this->set(compact('codes'));

        $closureprobabilities = $this->LookupValueLeadsClosureProbability->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $this->set(compact('closureprobabilities'));

        $channel_name = $this->Channel->find('list', array('fields' => 'Channel.id, Channel.channel_name', 'conditions' => $condition_dummy_status, 'order' => 'Channel.channel_name ASC'));
        $this->set('channel_name', $channel_name);

        $source = $this->LookupValueLeadsSource->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('source'));

        $courrency = $this->LookupValueLeadsCurrency->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('courrency'));

        $type_preference = $this->LookupValueProjectPhase->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('type_preference'));

        $creation_types = $this->LookupValueLeadsCreationType->find('list', array('fields' => 'id, value', 'conditions' => $conditions, 'order' => 'value ASC'));
        $this->set(compact('creation_types'));





        $created_by = $this->User->find('all', array('fields' => array('User.id', 'User.fname', 'User.lname'),
            'conditions' => array('User.id' => $user_id)));

        $created_by = Set::combine($created_by, '{n}.User.id', array('%s %s', '{n}.User.fname', '{n}.User.lname'));
        $this->set(compact('created_by'));
    }

    /* $builders = $this->Lead->Builder->find('all', array('order' => 'Builder.builder_name ASC'));
      $arrBuilder = array();
      if (count($builders) > 0)
      {
      foreach ($builders as $builder)
      {
      $arrBuilder[$builder['Builder']['id']] = $builder['Builder']['builder_name'];
      }
      }

      $this->set('builders', $arrBuilder);

      } */


    /* $cities = $this->Suburb->City->find('all', array('order' => 'City.city_name ASC'));
      $arrCity = array();
      if (count($cities) > 0)
      {
      foreach ($cities as $city)
      {
      $arrCity[$city['City']['id']] = $city['City']['city_name'];
      }
      }

      $this->set('citiess', $arrCity);
      }
     */

    function edit($id = null) {

        $dummy_status = $this->Auth->user('dummy_status');
        $user_id = $this->Auth->User('id');
        $city_id = $this->Auth->User('city_id');
        $role_id = $this->Session->read("role_id");
        $roles = $this->Role->find('all', array('conditions' => 'Role.id = ' . $role_id));
        $creation_type = $roles[0]['GroupsUser']['name'];
        $this->set(compact('creation_type'));
        $actio_itme_id = '';


        $flag = 0;
        $arr = explode('_', $id);
        $id = base64_decode($arr[0]);
        if (count($arr) > 1) {
            $actio_itme_id = $arr[1];
            $flag = 1;
        }

        if (!$id) {
            throw new NotFoundException(__('Invalid Lead'));
        }

        $lead = $this->Lead->findById($id);


        if (!$lead) {
            throw new NotFoundException(__('Invalid Lead'));
        }




        $conditions = '';
        $city_conditions = array();
        $phone_coditions = '';
        $phone_officer_id = 'phone_officer_id';

        if ($creation_type == 'Administrator' || $creation_type == 'System Admin') {
            $conditions = array('NOT' => array('value' => array('Administrator', 'System Admin')));
        }





        if ($this->request->data) {

            /*             * *************************Lead Action ********************** */
            /*
              $action_item['ActionItem']['lead_id'] = $id;
              $action_item['ActionItem']['action_item_level_id'] = '1'; //  for client
              $action_item['ActionItem']['type_id'] = '10'; // 10 for Re-Submission For Approval
              $action_item['ActionItem']['next_action_by'] = '146';
              $action_item['ActionItem']['action_item_active'] = 'Yes';
              $action_item['ActionItem']['action_item_status'] = '17'; //1 for created table - lookup_value_action_item_statuses
              $action_item['ActionItem']['description'] = 'Client Record Updated - Re-Submission For Allocate';
              $action_item['ActionItem']['action_item_source'] = $role_id;
              $action_item['ActionItem']['created_by_id'] = $user_id;
              $action_item['ActionItem']['created_by'] = $user_id;
              $action_item['ActionItem']['dummy_status'] = $dummy_status;
              $action_item['ActionItem']['builder_id'] = NULL;
              $action_item['ActionItem']['project_id'] = NULL;

              if($this->data['Lead']['action_type'] == '0'){
              $action_item['ActionItem']['screen_no'] = 'SC-1';
              }
              else if($this->data['Lead']['action_type'] == '1'){
              $action_item['ActionItem']['screen_no'] = 'SC-2';
              }
              else if($this->data['Lead']['action_type'] == '2'){
              $action_item['ActionItem']['screen_no'] = 'SC-3';
              }
              else{
              $action_item['ActionItem']['screen_no'] = 'SC-4';
              }
             */
            /*             * *********************Client Remarks ******************************** */
            $remarks['Remark']['lead_id'] = $id;
            $remarks['Remark']['remarks'] = 'Edit Client Record';
            $remarks['Remark']['remarks_by'] = $user_id;
            $remarks['Remark']['created_by'] = $user_id;
            $remarks['Remark']['remarks_time'] = date('g:i A');
            $remarks['Remark']['remarks_level'] = '3'; //3 for client from lookup_value_remarks_level
            $remarks['Remark']['dummy_status'] = $dummy_status;






            //$this->request->data['Lead']['lead_status'] = '1';	

            $this->Lead->set($this->data);
            if ($this->Lead->validates() == true) {
                $this->Lead->id = $id;
                if ($this->Lead->save($this->request->data)) {
                    $this->Remark->save($remarks);
                    /*
                      $this->ActionItem->save($action_item);
                      $ActionId = $this->ActionItem->getLastInsertId();
                      $this->ActionItem->id = $ActionId;
                      $this->ActionItem->saveField('parent_action_item_id' , $ActionId);
                      if($actio_itme_id){
                      $this->ActionItem->saveField('parent_action_item_id' , $actio_itme_id);
                      $this->ActionItem->updateAll(array('ActionItem.action_item_active' => "'No'"),array('ActionItem.id' => $actio_itme_id));
                      }
                     */
                    $this->Session->setFlash('Client has been Re-submitted.', 'success');
                    if ($flag == 1)
                        $this->redirect(array('controller' => 'action-items', 'action' => 'index'));
                    else
                        $this->redirect(array('controller' => 'messages', 'action' => 'index', 'leads', 'my-clients'));
                }
                else {
                    $this->Session->setFlash('Unable to update Lead.', 'failure');
                }
            }
        }

        array_push($city_conditions, array('City.dummy_status' => $dummy_status, 'City.city_status' => '1'));
        $city = $this->City->find('list', array('fields' => 'City.id, City.city_name', 'conditions' => $city_conditions, 'order' => 'City.city_name ASC'));

        $this->set('city', $city);

        $phone_officer = $this->User->find('all', array('fields' => array('User.id', 'User.fname', 'User.mname', 'User.lname'), 'conditions' => array('User.id' => $lead['Lead']['lead_phoneofficer'])));
        $phone_officer = Set::combine($phone_officer, '{n}.User.id', array('%s %s %s', '{n}.User.fname', '{n}.User.mname', '{n}.User.lname'));


        $this->set(compact('phone_officer'));
        $this->set(compact('phone_officer_id'));

        $builders = $this->Builder->find('list', array('fields' => 'Builder.id, Builder.builder_name', 'order' => 'Builder.builder_name ASC'));

        $this->set('builders', $builders);

        $associate = $this->User->find('all', array('fields' => array('User.id', 'User.fname', 'User.lname'),
            'conditions' => array('User.id' => $lead['Lead']['lead_associate'])));
        $associate = Set::combine($associate, '{n}.User.id', array('%s %s', '{n}.User.fname', '{n}.User.lname'));
        $this->set(compact('associate'));

        $projects = $this->Lead->Project->find('list', array('fields' => 'Project.id, Project.project_name', 'order' => 'Project.project_name ASC'));
        $this->set('projects', $projects);

        $suburbs = $this->Suburb->find('list', array('fields' => 'Suburb.id, Suburb.suburb_name', 'conditions' => array('Suburb.dummy_status' => $dummy_status, 'Suburb.suburb_status' => '1'), 'order' => 'Suburb.suburb_name ASC'));
        $this->set(compact('suburbs'));

        $areas = $this->Area->find('list', array('fields' => 'Area.id, Area.area_name', 'conditions' => array('Area.dummy_status' => $dummy_status, 'Area.area_status' => '1'), 'order' => 'Area.area_name ASC'));
        $this->set('areas', $areas);

        $codes = $this->LookupValueLeadsCountry->find('all', array('fields' => array('LookupValueLeadsCountry.id', 'LookupValueLeadsCountry.value', 'LookupValueLeadsCountry.code')));
        $codes = Set::combine($codes, '{n}.LookupValueLeadsCountry.id', array('%s: %s', '{n}.LookupValueLeadsCountry.value', '{n}.LookupValueLeadsCountry.code'));
        $this->set(compact('codes'));

        $lead_progrss = $this->LookupValueLeadsProgress->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $this->set(compact('lead_progrss'));

        $action_level = $this->ActionItemLevel->find('list', array('fields' => array('id', 'level')));
        $this->set(compact('action_level'));

        $action_type = $this->ActionItemType->find('list', array('fields' => array('id', 'type')));
        $this->set(compact('action_type'));

        $action_status = $this->LookupValueActionItemStatus->find('list', array('fields' => array('id', 'value')));
        $this->set(compact('action_status'));

        $units = $this->LookupValueProjectUnitPreference->find('list', array('fields' => 'LookupValueProjectUnitPreference.id, LookupValueProjectUnitPreference.value', 'order' => 'LookupValueProjectUnitPreference.value ASC'));
        $this->set('unit', $units);

        $status = $this->LeadStatus->find('list', array('fields' => array('id', 'status')));
        $this->set(compact('status'));

        $countires = $this->LookupValueLeadsCountry->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $this->set(compact('countires'));

        $closureprobabilities = $this->LookupValueLeadsClosureProbability->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $this->set(compact('closureprobabilities'));

        $urgencies = $this->LookupValueLeadsUrgency->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $this->set(compact('urgencies'));

        $importance = $this->LookupValueLeadsImportance->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $this->set(compact('importance'));

        $types = $this->LookupValueLeadsType->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $this->set(compact('types'));

        $categories = $this->LookupValueLeadsCategory->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $this->set(compact('categories'));

        $channel_name = $this->Channel->find('list', array('fields' => 'Channel.id, Channel.channel_name', 'conditions' => array('Channel.id' => $lead['Lead']['lead_channel']), 'order' => 'Channel.channel_name ASC'));
        $this->set('channel_name', $channel_name);

        $primary_manager = $this->User->find('all', array('fields' => array('User.id', 'User.fname', 'User.lname'),
            'conditions' => array('User.id' => $lead['Lead']['lead_managerprimary'])));
        $primary_manager = Set::combine($primary_manager, '{n}.User.id', array('%s %s', '{n}.User.fname', '{n}.User.lname'));
        $this->set(compact('primary_manager'));

        $industry = $this->LookupValueLeadsIndustry->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $this->set(compact('industry'));
        $segment = $this->LookupValueLeadsSegment->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $this->set(compact('segment'));

        $source = $this->LookupValueLeadsSource->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('source'));

        $courrency = $this->LookupValueLeadsCurrency->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('courrency'));

        $type_preference = $this->LookupValueProjectPhase->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('type_preference'));

        $creation_types = $this->LookupValueLeadsCreationType->find('list', array('fields' => 'id, value', 'conditions' => $conditions, 'order' => 'value ASC'));
        $this->set(compact('creation_types'));

        $created_by = $this->User->find('all', array('fields' => array('User.id', 'User.fname', 'User.lname')));

        $created_by = Set::combine($created_by, '{n}.User.id', array('%s %s', '{n}.User.fname', '{n}.User.lname'));
        $this->set(compact('created_by'));

        $events = $this->Event->find('all', array('conditions' => array('lead_id' => $id)));
        $this->set(compact('events'));




        $this->request->data = $lead;
    }

    function quick_edit($id = null) {
        $this->layout = '';

        $city = $this->City->find('list', array('fields' => 'City.id, City.city_name', 'order' => 'City.city_name ASC'));
        $this->set('city', $city);

        $codes = $this->LookupValueLeadsCountry->find('all', array('fields' => array('LookupValueLeadsCountry.id', 'LookupValueLeadsCountry.value', 'LookupValueLeadsCountry.code')));
        $codes = Set::combine($codes, '{n}.LookupValueLeadsCountry.id', array('%s: %s', '{n}.LookupValueLeadsCountry.value', '{n}.LookupValueLeadsCountry.code'));
        $this->set(compact('codes'));
    }

    function action($id = null) {
        $this->layout = '';

        $action_level = $this->ActionItemLevel->find('list', array('fields' => array('id', 'level')));
        $this->set(compact('action_level'));

        $action_type = $this->ActionItemType->find('list', array('fields' => array('id', 'type')));
        $this->set(compact('action_type'));

        $action_status = $this->LookupValueActionItemStatus->find('list', array('fields' => array('id', 'value')));
        $this->set(compact('action_status'));

        $source = $this->LookupValueLeadsSource->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('source'));

        $created_by = $this->User->find('all', array('fields' => array('User.id', 'User.fname', 'User.lname')));

        $created_by = Set::combine($created_by, '{n}.User.id', array('%s %s', '{n}.User.fname', '{n}.User.lname'));
        $this->set(compact('created_by'));

        $lead = $this->Lead->findById($id);
        $this->request->data = $lead;
    }

    function send_text($id) {
        $leads = $this->Lead->find('all', array('conditions' => array('Lead.id' => $id)));

        $html = 'City-' . $leads['City']['city_name'] . ',Urgency-' . $leads['City']['city_name'];

        $authKey = Configure::read('sms_api_key');
        $senderId = Configure::read('sms_sender_id');
        $mobileNumber = "9433657552";
        $message = urlencode("Hiii");
        $route = "default";
        $this->Sms->send_sms($authKey, $mobileNumber, $message, $senderId, $route);
    }

    function view($id = null) {

        $id = base64_decode($id);


        if (!$id) {
            throw new NotFoundException(__('Invalid Lead'));
        }

        $lead = $this->Lead->findById($id);
        if (!$lead) {
            throw new NotFoundException(__('Invalid Lead'));
        }

        $city_id = $this->Auth->User('city_id');

        $role_id = $this->Session->read("role_id");
        $roles = $this->Role->find('all', array('conditions' => 'Role.id = ' . $role_id));


        $user_id = $this->Auth->User('id');

        $this->request->data = $lead;
    }

    public function add_event($lead_id = null) {

        $this->layout = 'ajax';
        $user_id = $this->Auth->user('id');
        $dummy_status = $this->Auth->user('dummy_status');
        $channel_id = $this->Session->read("channel_id");
        $channels = $this->Channel->findById($channel_id);
        $channel_role = $channels['Channel']['channel_role'];
        $city_id = $channels['Channel']['city_id'];

        if ($this->request->is('post') || $this->request->is('put')) {

            $this->request->data['Event']['creator_id'] = $user_id;
            $this->request->data['Event']['user_id'] = $user_id;
            $this->request->data['Event']['dummy_status'] = $dummy_status;
            $this->request->data['Event']['lead_id'] = $lead_id;
            $this->request->data['Event']['role_city'] = $city_id;
            $this->request->data['Event']['event_type'] = '2'; // 2 for lead event.
            $this->request->data['Event']['activity_level'] = '1'; // 1 for client of LookupValueActivityLevel.
            $event_date = date('Y-m-d', strtotime($this->request->data['Event']['event_date']));
            $this->request->data['Event']['start_date'] = $event_date . " " . date("H:i", strtotime($this->data['Event']['start_time']));
            $this->request->data['Event']['end_date'] = $event_date . " " . date("H:i", strtotime($this->data['Event']['end_time']));
            $this->request->data['Event']['description'] = $this->data['Event']['start_time'] . '-' . $this->data['Event']['end_time'];

            $this->Event->set($this->data);
            if ($this->Event->validates() == true) {

                if ($this->Event->save($this->request->data)) {
                    $this->Session->setFlash('Client event has been added.', 'success');
                    echo '<script>
				 			var objP=parent.document.getElementsByClassName("mfp-bg");
							var objC=parent.document.getElementsByClassName("mfp-wrap");
							objP[0].style.display="none";
							objC[0].style.display="none";
							parent.location.reload(true);</script>';
                }
                else
                    $this->Session->setFlash('Unable to add event unit.', 'failure');
            }
        }

        $activity_types = $this->LookupValueActivityType->find('list', array('fields' => 'id,value', 'order' => 'id ASC'));
        $this->set('activity_types', $activity_types);
    }

    public function edit_event($id = null) {

        $this->layout = 'ajax';
        $user_id = $this->Auth->user('id');
        $dummy_status = $this->Auth->user('dummy_status');

        /*
         * To catch an array of project unit by project unit Id.
         */
        $Event = $this->Event->findById($id);

        if ($this->request->is('post') || $this->request->is('put')) {

            $event_date = date('Y-m-d', strtotime($this->request->data['Event']['event_date']));
            $this->request->data['Event']['start_date'] = $event_date . " " . date("H:i", strtotime($this->data['Event']['start_time']));
            $this->request->data['Event']['end_date'] = $event_date . " " . date("H:i", strtotime($this->data['Event']['end_time']));
            $this->request->data['Event']['description'] = $this->data['Event']['start_time'] . '-' . $this->data['Event']['end_time'];

            $this->Event->set($this->data);
            $this->Event->id = $id;
            if ($this->Event->validates() == true) {

                if ($this->Event->save($this->request->data)) {
                    $this->Session->setFlash('Client event has been updated.', 'success');
                    echo '<script>
				 			var objP=parent.document.getElementsByClassName("mfp-bg");
							var objC=parent.document.getElementsByClassName("mfp-wrap");
							objP[0].style.display="none";
							objC[0].style.display="none";
							parent.location.reload(true);</script>';
                }
                else
                    $this->Session->setFlash('Unable to edit event unit.', 'failure');
            }
        }

        $activity_types = $this->LookupValueActivityType->find('list', array('fields' => 'id,value', 'order' => 'id ASC'));
        $this->set('activity_types', $activity_types);

        if (!$this->request->data) {
            $this->request->data = $Event;
        }
    }

    public function add_remark($lead_id = null) {
        $this->layout = 'ajax';
        $user_id = $this->Auth->user('id');
        $dummy_status = $this->Auth->user('dummy_status');

        if ($this->request->is('post') || $this->request->is('put')) {
            /*             * *********************Add Client Remarks ******************************** */
            $this->request->data['Remark']['lead_id'] = $lead_id;
            $this->request->data['Remark']['remarks_by'] = $user_id;
            $this->request->data['Remark']['created_by'] = $user_id;
            $this->request->data['Remark']['remarks_time'] = date('g:i A');
            $this->request->data['Remark']['remarks_level'] = '3'; //3 for client from lookup_value_remarks_level
            $this->request->data['Remark']['dummy_status'] = $dummy_status;

            $this->Remark->set($this->data);
            if ($this->Remark->validates() == true) {

                if ($this->Remark->save($this->request->data)) {
                    $this->Session->setFlash('Client remark has been added.', 'success');
                    echo '<script>
				 			var objP=parent.document.getElementsByClassName("mfp-bg");
							var objC=parent.document.getElementsByClassName("mfp-wrap");
							objP[0].style.display="none";
							objC[0].style.display="none";
							parent.location.reload(true);</script>';
                }
                else
                    $this->Session->setFlash('Unable to add remark unit.', 'failure');
            }
        }
    }

    function action_transaction($id = null) {

        $dummy_status = $this->Auth->user('dummy_status');
        $channel_id = $this->Session->read("channel_id");
        $channels = $this->Channel->findById($channel_id);
        $channel_head = $channels['Channel']['channel_head'];
        $city_id = $channels['Channel']['city_id'];
        $role_id = $this->Session->read("role_id");
        $user_id = $this->Auth->user('id');

        $lead = $this->Lead->findById($id, array('Lead.lead_fname', 'Lead.lead_source', 'Lead.created_by'));
        $lead_action_array = end($lead['Action']);
        $parent_action_item_id = $lead_action_array['id'];

        if ($this->request->is('post') || $this->request->is('put')) {

            $type_id = $this->data['ActionItem']['type_id'];
            if ($type_id == '11') {
                $this->request->data['ActionItem']['action_item_level_id'] = '15'; // Deal
         
                $this->request->data['Lead']['lead_status'] = '10';
                $this->request->data['ActionItem']['action_item_active'] = 'Yes';
                $this->request->data['ActionItem']['lead_id'] = $id;

                $this->request->data['ActionItem']['parent_action_item_id'] = $parent_action_item_id;
                $this->request->data['ActionItem']['dummy_status'] = $dummy_status;
                $this->request->data['ActionItem']['action_item_created'] = date('Y-m-d');
                $this->request->data['ActionItem']['created_by_id'] = $lead['Lead']['created_by'];
                $this->request->data['ActionItem']['description'] = 'Release the client';
                $this->request->data['ActionItem']['next_action_by'] = '146'; // client desk
                $this->request->data['ActionItem']['action_item_source'] = $role_id;
                $this->request->data['ActionItem']['action_industry'] = '1'; // for realestate of lookup_value_activity_industry
                $this->request->data['ActionItem']['action_item_status'] = '11'; //  Release of lookup_value_action_item_statuses
                $this->request->data['ActionItem']['created_by'] = $user_id;

                $this->request->data['Remark']['remarks'] = 'Release the client';
                $this->request->data['Remark']['remarks_time'] = date('g:i A');
                $this->request->data['Remark']['remarks_by'] = $user_id;
                $this->request->data['Remark']['lead_id'] = $id;
                $this->request->data['Remark']['created_by'] = $user_id;
                $this->request->data['Remark']['remarks_date'] = date('Y-m-d');
                $this->request->data['Remark']['dummy_status'] = $dummy_status;
                $this->request->data['Remark']['remarks_level'] = '3'; // for client from lookup_value_remarks_level

                $this->ActionItem->create();
                if ($this->ActionItem->save($this->data['ActionItem'])) {

                    $last_action_id = $this->ActionItem->getLastInsertId();
                    $this->Lead->updateAll($this->data['Lead'], array('Lead.id' => $id));
                    $this->Remark->save($this->data['Remark']);

                    $actionArry = $this->ActionItem->findById($last_action_id);
                    $clientArry = $this->Lead->findById($id);
                    $client_name = strtoupper($actionArry['Lead']['lead_fname']) . ' ' . strtoupper($actionArry['Lead']['lead_lname']);
                    $email_client_name = strtoupper($actionArry['CreatedBy']['fname'] . ' ' . $actionArry['CreatedBy']['lname']);
                    $ActionType = strtoupper($actionArry['ActionType']['type']);
                    $to = 'infra@sumanus.com';
                    //$to = 'biswajit@wtbglobal.com';

                    if ($actionArry['Lead']['lead_source'] == 3) {
                        $client_info = 'OLD';
                    } else {
                        $client_info = 'NEW';
                    }

                    $Email = new CakeEmail();

                    $Email->viewVars(array(
                        'CreatedBy' => strtoupper($actionArry['CreatedBy']['fname'] . ' ' . $actionArry['CreatedBy']['lname']),
                        'lead_name' => strtoupper($actionArry['Lead']['lead_fname']) . ' ' . strtoupper($actionArry['Lead']['lead_lname']),
                        'LookupRelease' => strtoupper($actionArry['LookupRelease']['value']),
                        'Release' => strtoupper($actionArry['ActionItem']['other_release']),
                        /*                         * **************Lead Table****************** */
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
                    ));

                    $Email->template('ActionItems/release', 'default')->emailFormat('html')->to($to)->from('admin@silkrouters.com')->subject($client_info . ' CLIENT ' . $ActionType . ' - ' . $client_name . ' (' . $email_client_name . ')')->send();

                    $this->Session->setFlash('Your action have been submitted.', 'success');
                    $this->redirect(array('action' => 'index'));
                }
            } elseif ($type_id == '17') {

                $this->request->data['Deal']['dummy_status'] = $dummy_status;
                $this->request->data['Deal']['deal_status'] = '1';  // 1 for Yes of lookup_deal_status
                $this->request->data['Deal']['created_by'] = $user_id;
                $this->request->data['Deal']['deal_id'] = $id;
                $billing_type = $this->data['Deal']['deal_billing_type'];


                if ($this->data['Deal']['deal_booking_date'])
                    $this->request->data['Deal']['deal_booking_date'] = date('Y-m-d', strtotime($this->data['Deal']['deal_booking_date']));
                if ($this->data['Deal']['deal_expected_invoice_date'])
                    $this->request->data['Deal']['deal_expected_invoice_date'] = date('Y-m-d', strtotime($this->data['Deal']['deal_expected_invoice_date']));
                if ($this->data['Deal']['deal_actual_invoice_date'])
                    $this->request->data['Deal']['deal_actual_invoice_date'] = date('Y-m-d', strtotime($this->data['Deal']['deal_actual_invoice_date']));

                $action_item['ActionItem']['action_item_level_id'] = '15'; // Deal
                $this->Deal->set($this->data['Deal']);
                if ($this->Deal->validates() == true) {
                    if ($this->Deal->save($this->request->data['Deal'])) {

                        $deal_id = $this->Deal->getLastInsertId();
                        if ($deal_id) {

                            /*
                             * *
                             * Update status of lead table
                             */
                            $status['Lead']['lead_status'] = '11';
                            $this->Lead->updateAll($status['Lead'], array('Lead.id' => $id));
                            /*
                             * ****************** Remarks **************************
                             * ****** */
                            $remarks['Remark']['deal_id'] = $deal_id;
                            $remarks['Remark']['remarks'] = 'New Action Record Created';
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
                                
                            $action_item['ActionItem']['type_id'] = '18'; // 7 for Submission For Approval
                            $action_item['ActionItem']['action_item_active'] = 'Yes';
                            $action_item['ActionItem']['action_item_status'] = '21'; //7 for Submitted For Approval table - lookup_value_action_item_statuses
                            $action_item['ActionItem']['description'] = 'Client Action  Record Created - Submission For Approval';
                            $action_item['ActionItem']['action_item_source'] = $role_id;
                            $action_item['ActionItem']['created_by_id'] = $user_id;
                            $action_item['ActionItem']['created_by'] = $user_id;
                            $action_item['ActionItem']['dummy_status'] = $dummy_status;
                            $action_item['ActionItem']['next_action_by'] = '136'; // overseeing
                                         
                            $this->ActionItem->save($action_item);
                            $ActionId = $this->ActionItem->getLastInsertId();         
                          
                            $this->ActionItem->query("UPDATE `action_items` SET `parent_action_item_id` = '".$ActionId."' WHERE `id` = ".$ActionId);
                        



                            /* Email Logic */
                            /*
                              $to = 'neerajs@wtbglobal.com';
                              $Email = new CakeEmail();
                              $Email->viewVars(array(
                              'Builder' => $this->data['Builder']['builder_name'],
                              'Address' => $this->data['Builder']['builder_corporateaddress'],
                              'Board_no' => $this->data['Builder']['builder_boardnumber'],
                              'Board_email' => $this->data['Builder']['builder_boardemail'],
                              'Status' => 'Submission For Approval',

                              ));
                              $Email->template('builder_template', 'default')->emailFormat('html')->to($to)->from('admin@silkrouters.com')->subject('Silkrouters - Submission for Builder')->send();
                             */
                            /* End Emial */
                            /* Phone API */
                            /*
                              $msg = $this->data['Builder']['builder_name'].' | '.$this->data['Builder']['builder_corporateaddress'].' | '.$this->data['Builder']['builder_boardnumber'].' | '.$this->data['Builder']['builder_boardemail'].' | Submission For Approval';
                              $authKey = Configure::read('sms_api_key');
                              $senderId = Configure::read('sms_sender_id');
                              // $mobileNumber = $channels[0]['User']['primary_mobile_number'];
                              $mobileNumber = "9833156460";
                              $message = urlencode($msg);
                              $route = "default";
                              $this->Sms->send_sms($authKey,$mobileNumber,$message,$senderId,$route);
                             */
                            /* End Phone */


                            $this->Session->setFlash('Your changes have been submitted. Waiting for approval at the moment...', 'success');
                            $this->redirect(array('action' => 'index'));
                        }
                    } else {
                        $this->Session->setFlash('Unable to add data.', 'failure');
                    }
                }
            }
        }


        $action_type = $this->ActionItemType->find('list', array('fields' => array('id', 'type'), 'conditions' => 'ActionItemType.id = 11 OR ActionItemType.id = 17'));
        $this->set(compact('action_type'));

        $LookupValueLeadTransactionType = $this->LookupValueLeadTransactionType->find('list', array('fields' => array('id', 'value'), 'order' => 'value asc'));
        $this->set(compact('LookupValueLeadTransactionType'));

        $projects = $this->Project->find('list', array('conditions' => array('Project.city_id' => $city_id, 'Project.dummy_status' => $dummy_status),
            'fields' => 'Project.id, Project.project_name',
            'order' => 'Project.project_name ASC'
        ));
        $this->set(compact('projects'));

        $partners = $this->MarketingPartner->find('list', array('fields' => 'id, marketing_partner_display_name', 'conditions' => array('OR' => array('MarketingPartner.marketing_partner_primarycity' => $city_id, 'MarketingPartner.marketing_partner_secondarycity' => $city_id, 'MarketingPartner.marketing_partner_tertiarycity' => $city_id, 'MarketingPartner.marketing_partner_city_4' => $city_id, 'MarketingPartner.marketing_partner_city_5' => $city_id)), 'order' => 'marketing_partner_display_name ASC'));
        $this->set(compact('partners'));

        $leads = $this->Lead->find('all', array('fields' => array('Lead.id', 'Lead.lead_fname', 'Lead.lead_lname', 'Lead.created'), 'conditions' => array('OR' => array('Lead.lead_managersecondary' => $user_id, 'Lead.lead_managerprimary' => $user_id), 'NOT' => array('Lead.lead_fname' => ''), 'Lead.dummy_status' => $dummy_status, 'Lead.lead_status' => '4')));
        $leads = Set::combine($leads, '{n}.Lead.id', array('%s %s - Arrival Date: %s', '{n}.Lead.lead_fname', '{n}.Lead.lead_lname', '{n}.Lead.created'));
        $this->set(compact('leads'));

        $release = $this->LookupValueActionItemRelease->find('list', array('fields' => 'id, value', 'conditions' => array('type' => array(0, 1)), 'order' => 'value ASC'));
        $this->set(compact('release'));

        $commission_event = $this->LookupUnitCommissionEvent->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('commission_event'));

        $billing_types = $this->LookupValueDealBillingType->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('billing_types'));

        $this->request->data = $lead;
    }

    function action_transaction_edit($id = null) {
        $this->layout = 'ajax';
        $user_id = $this->Auth->user('id');
        $role_id = $this->Session->read("role_id");
        $dummy_status = $this->Auth->user('dummy_status');
        $channel_id = $this->Session->read("channel_id");
        $channels = $this->Channel->findById($channel_id);
        $channel_head = $channels['Channel']['channel_head'];
        $city_id = $channels['Channel']['city_id'];

        $actio_itme_id = '';
        $screen_position = '';
        $arr = explode('_', $id);
        $id = $arr[0];
        if (count($arr) > 1) {
            $actio_itme_id = $arr[1];
        }

        if (!$id) {
            throw new NotFoundException(__('Invalid Transaction'));
        }


        $Deals = $this->Deal->findById($id);


        if (!$Deals) {
            throw new NotFoundException(__('Invalid Transaction'));
        }

        if ($this->request->data) {

            $deal['Deal']['deal_type'] = "'" . $this->data['Deal']['deal_type'] . "'";
            $deal['Deal']['deal_billing_type'] = "'" . $this->data['Deal']['deal_billing_type'] . "'";
            $deal['Deal']['deal_project_id'] = "'" . $this->data['Deal']['deal_project_id'] . "'";
            $deal['Deal']['deal_project_legal_name_id'] = "'" . $this->data['Deal']['deal_project_legal_name_id'] . "'";
           // $deal['Deal']['deal_unit_floor'] = "'" . $this->data['Deal']['deal_unit_floor'] . "'";
            $deal['Deal']['deal_client_id'] = "'" . $this->data['Deal']['deal_client_id'] . "'";
            $deal['Deal']['deal_project_unit_id'] = "'" . $this->data['Deal']['deal_project_unit_id'] . "'";
            $deal['Deal']['deal_booking_date'] = "'" . date('Y-m-d', strtotime($this->data['Deal']['deal_booking_date'])) . "'";
            $deal['Deal']['deal_sale_pattern'] = "'" . $this->data['Deal']['deal_sale_pattern'] . "'";
            $deal['Deal']['deal_commission_percent'] = "'" . $this->data['Deal']['deal_commission_percent'] . "'";
            $deal['Deal']['deal_invoiced_on_amount'] = "'" . $this->data['Deal']['deal_invoiced_on_amount'] . "'";
            $deal['Deal']['deal_expected_invoice_date'] = "'" . date('Y-m-d', strtotime($this->data['Deal']['deal_expected_invoice_date'])) . "'";
            $deal['Deal']['deal_actual_invoice_date'] = "'" . date('Y-m-d', strtotime($this->data['Deal']['deal_actual_invoice_date'])) . "'";
            $deal['Deal']['deal_booking_amount'] = "'" . $this->data['Deal']['deal_booking_amount'] . "'";
            $deal['Deal']['deal_invoice_event'] = "'" . $this->data['Deal']['deal_invoice_event'] . "'";

          
            if ($this->data['Deal']['deal_billing_type'] == '1')
                $deal['Deal']['deal_builder_id'] = "'" . $this->data['Deal']['deal_builder_id'] . "'";
            else
                $deal['Deal']['deal_marketing_partner_id'] = "'" . $this->data['Deal']['deal_marketing_partner_id'] . "'";
            $leads = $this->Lead->findById($id, array('Lead.lead_source'));
            $action_item['ActionItem']['action_item_level_id'] = '15'; // Deal
        
            $action_item['ActionItem']['deal_id'] = $id;

            $action_item['ActionItem']['type_id'] = '18'; // 10 for Re-Submission For Approval
            $action_item['ActionItem']['next_action_by'] = '136';
            $action_item['ActionItem']['action_item_active'] = 'Yes';
            $action_item['ActionItem']['action_item_status'] = '17'; //Change Submitted for created table - lookup_value_action_item_statuses
            $action_item['ActionItem']['description'] = 'Lead Transaction Record Updated - Re-Submission For Approval';
            $action_item['ActionItem']['action_item_source'] = $role_id;
            $action_item['ActionItem']['created_by_id'] = $user_id;
            $action_item['ActionItem']['created_by'] = $Deals['Deal']['created_by'];
            $action_item['ActionItem']['dummy_status'] = $dummy_status;
            $action_item['ActionItem']['parent_action_item_id'] = $actio_itme_id;




            /*             * *********************Builder Remarks ******************************** */
            $remarks['Remark']['deal_id'] = $id;
            $remarks['Remark']['remarks'] = 'Edit Lead Transaction Record';
            $remarks['Remark']['remarks_by'] = $user_id;
            $remarks['Remark']['created_by'] = $user_id;
            $remarks['Remark']['remarks_time'] = date('g:i A');
            $remarks['Remark']['remarks_level'] = '3'; // for client from lookup_value_remarks_level
            $remarks['Remark']['dummy_status'] = $dummy_status;

            if ($this->Deal->updateAll($deal['Deal'], array('Deal.id' => $id))) {

                $this->Remark->save($remarks);

                $this->ActionItem->save($action_item);
                $ActionId = $this->ActionItem->getLastInsertId();
                $this->ActionItem->id = $ActionId;
                if ($actio_itme_id) {
                    $this->ActionItem->updateAll(array('ActionItem.action_item_active' => "'No'"), array('ActionItem.id' => $actio_itme_id));
                }
                $this->Session->setFlash('Your changes have been submitted. Waiting for approval at the moment...', 'success');
                echo '<script>
                        var objP=parent.document.getElementsByClassName("mfp-bg");
                        var objC=parent.document.getElementsByClassName("mfp-wrap");
                        objP[0].style.display="none";
                        objC[0].style.display="none";
                        parent.location.reload(true);</script>';
            }
        }

        $action_type = $this->ActionItemType->find('list', array('fields' => array('id', 'type'), 'conditions' => 'ActionItemType.id = 11 OR ActionItemType.id = 17'));
        $this->set(compact('action_type'));

        $LookupValueLeadTransactionType = $this->LookupValueLeadTransactionType->find('list', array('fields' => array('id', 'value'), 'order' => 'value asc'));
        $this->set(compact('LookupValueLeadTransactionType'));

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

        $lead_lt = $this->Lead->find('all', array('fields' => array('Lead.id', 'Lead.lead_fname', 'Lead.lead_lname', 'Lead.created'), 'conditions' => array('Lead.id' => $Deals['Deal']['deal_client_id'])));
        $lead_lt = Set::combine($lead_lt, '{n}.Lead.id', array('%s %s - Arrival Date: %s', '{n}.Lead.lead_fname', '{n}.Lead.lead_lname', '{n}.Lead.created'));
        $this->set(compact('lead_lt'));

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

        $projects = $this->Project->findById($Deals['Deal']['deal_project_id'], array('Project.builder_id', 'Project.secondary_builder_id', 'Project.tertiary_builder_id'));
        $builders = $this->Builder->find('list', array('conditions' => array('Builder.id' => array($projects['Project']['builder_id'], $projects['Project']['secondary_builder_id'], $projects['Project']['tertiary_builder_id'])),
            'fields' => 'Builder.id, Builder.builder_name',
            'order' => 'Builder.builder_name ASC'
        ));

        $this->set(compact('builders'));

        $release = $this->LookupValueActionItemRelease->find('list', array('fields' => 'id, value', 'conditions' => array('type' => array(0, 1)), 'order' => 'value ASC'));
        $this->set(compact('release'));

        $commission_event = $this->LookupUnitCommissionEvent->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('commission_event'));

        $billing_types = $this->LookupValueDealBillingType->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('billing_types'));





        $this->request->data = $Deals;
    }

}
<?php

/**
 * User controller. 
 *
 * This file will render views from views/users/
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
 * User controller
 *
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class UsersController extends AppController {

    var $name = 'Users';
    var $uses = array('User', 'Role', 'DuplicateMappinge', 'Event', 'City', 'Channel', 'GroupsUser', 'LookupValueLeadsCountry', 'Builder', 'Project', 'Lead', 'ActionItem', 'LookupValueActivityIndustry', 'Agent', 'TravelHotelLookup', 'TravelHotelRoomSupplier',
        'Mappinge', 'TravelCitySupplier', 'TravelCountrySupplier', 'TravelSupplier', 'DigMediaTask', 'DigAccount', 'DigPerson','SupportTicket');
    public $components = array(
        'Auth' => array(
            'authenticate' => array(
                'Form' => array(
                    'fields' => array('username' => 'company_email_id')
                )
            )
        )
    );

    function dashboard() {
        $this->set('foreignMachineInterAction','NO');

        $dummy_status = $this->Auth->user('dummy_status');
        $user_id = $this->Auth->user('id');


        if (isset($this->params['named']['id'])) {
            $role_id = $this->params['named']['id'];
            $channel_id = $this->params['named']['channel'];
            $industry = $this->params['named']['industry'];

            /*
              if (!$this->Session->read('role_id'))
              $this->Session->write('role_id', $role_id);
             * 
             */

            $this->Session->write('channel_id', $channel_id);
            $this->Session->write('industry', $industry);
            $this->Session->write('role_id', $role_id);
        } else {
            $channel_id = $this->Session->read("channel_id");
            $role_id = $this->Session->read('role_id');
            $industry = $this->Session->read('industry');
        }
        $this->set(compact('industry'));
        $channels = $this->Channel->findById($channel_id);
        $channel_city_id = $channels['Channel']['city_id'];
        // $role_id = $this->Session->read('role_id');

        if ($role_id == '') {
            //$role_id = $this->Auth->user("role_id");
            $this->redirect($this->Auth->logout());
        }
        if ($industry == '1') {// Real Estate
            if ($role_id == '15') {
                if ($channel_city_id == '2') {
                    $builder_all_count = $this->Builder->find('count', array('conditions' => array('OR' => array(
                                'Builder.builder_primarycity' => $channel_city_id,
                                'Builder.builder_secondarycity' => $channel_city_id,
                                'Builder.builder_tertiarycity' => $channel_city_id,
                                'Builder.city_4' => $channel_city_id,
                                'Builder.city_5' => $channel_city_id,
                            ),
                            'Builder.dummy_status' => $dummy_status)
                    ));
                    $builder_approve = $this->Builder->find('count', array('conditions' => array('OR' => array(
                                'Builder.builder_primarycity' => $channel_city_id,
                                'Builder.builder_secondarycity' => $channel_city_id,
                                'Builder.builder_tertiarycity' => $channel_city_id,
                                'Builder.city_4' => $channel_city_id,
                                'Builder.city_5' => $channel_city_id,
                            ), 'Builder.builder_approved' => '1', 'Builder.dummy_status' => $dummy_status)
                    ));
                    $builder_pending = $this->Builder->find('count', array('conditions' => array('OR' => array(
                                'Builder.builder_primarycity' => $channel_city_id,
                                'Builder.builder_secondarycity' => $channel_city_id,
                                'Builder.builder_tertiarycity' => $channel_city_id,
                                'Builder.city_4' => $channel_city_id,
                                'Builder.city_5' => $channel_city_id,
                            ), 'Builder.builder_approved' => '2', 'Builder.dummy_status' => $dummy_status)));

                    $agent_all_count = $this->Agent->find('count', array('conditions' => array('OR' => array(
                                'Agent.agent_primary_city' => $channel_city_id,
                                'Agent.agent_secondary_city' => $channel_city_id,
                                'Agent.agent_tertiary_city' => $channel_city_id,
                                'Agent.agent_city4' => $channel_city_id,
                                'Agent.agent_city5' => $channel_city_id,
                            ),
                            'Agent.dummy_status' => $dummy_status)
                    ));
                    $agent_allocated = $this->Agent->find('count', array('conditions' => array('OR' => array(
                                'Agent.agent_primary_city' => $channel_city_id,
                                'Agent.agent_secondary_city' => $channel_city_id,
                                'Agent.agent_tertiary_city' => $channel_city_id,
                                'Agent.agent_city4' => $channel_city_id,
                                'Agent.agent_city5' => $channel_city_id,
                            ), 'Agent.agent_status' => '3', 'Agent.dummy_status' => $dummy_status)
                    ));
                    $agent_registered = $this->Agent->find('count', array('conditions' => array('OR' => array(
                                'Agent.agent_primary_city' => $channel_city_id,
                                'Agent.agent_secondary_city' => $channel_city_id,
                                'Agent.agent_tertiary_city' => $channel_city_id,
                                'Agent.agent_city4' => $channel_city_id,
                                'Agent.agent_city5' => $channel_city_id,
                            ), 'Agent.agent_status' => '5', 'Agent.dummy_status' => $dummy_status)));

                    $project_all_count = $this->Project->find('count', array('conditions' => array('Project.dummy_status' => $dummy_status, 'Project.city_id' => $channel_city_id)));

                    $project_approve = $this->Project->find('count', array('conditions' => array('Project.city_id' => $channel_city_id, 'Project.proj_approved' => '1', 'Project.dummy_status' => $dummy_status)));

                    $project_pending = $this->Project->find('count', array('conditions' => array('Project.city_id' => $channel_city_id, 'Project.proj_approved' => '2', 'Project.dummy_status' => $dummy_status)));
                } else {
                    $builder_all_count = $this->Builder->find('count', array('conditions' => array('NOT' => array(
                                'Builder.builder_primarycity' => 2,
                                'Builder.builder_secondarycity' => 2,
                                'Builder.builder_tertiarycity' => 2,
                                'Builder.city_4' => 2,
                                'Builder.city_5' => 2,
                            ),
                            'Builder.dummy_status' => $dummy_status)
                    ));
                    $builder_approve = $this->Builder->find('count', array('conditions' => array('NOT' => array(
                                'Builder.builder_primarycity' => 2,
                                'Builder.builder_secondarycity' => 2,
                                'Builder.builder_tertiarycity' => 2,
                                'Builder.city_4' => 2,
                                'Builder.city_5' => 2,
                            ), 'Builder.builder_approved' => '1', 'Builder.dummy_status' => $dummy_status)
                    ));
                    $builder_pending = $this->Builder->find('count', array('conditions' => array('NOT' => array(
                                'Builder.builder_primarycity' => 2,
                                'Builder.builder_secondarycity' => 2,
                                'Builder.builder_tertiarycity' => 2,
                                'Builder.city_4' => 2,
                                'Builder.city_5' => 2,
                            ), 'Builder.builder_approved' => '2', 'Builder.dummy_status' => $dummy_status)));

                    $agent_all_count = $this->Agent->find('count', array('conditions' => array('OR' => array(
                                'Agent.agent_primary_city' => $channel_city_id,
                                'Agent.agent_secondary_city' => $channel_city_id,
                                'Agent.agent_tertiary_city' => $channel_city_id,
                                'Agent.agent_city4' => $channel_city_id,
                                'Agent.agent_city5' => $channel_city_id,
                            ),
                            'Agent.dummy_status' => $dummy_status)
                    ));
                    $agent_allocated = $this->Agent->find('count', array('conditions' => array('OR' => array(
                                'Agent.agent_primary_city' => $channel_city_id,
                                'Agent.agent_secondary_city' => $channel_city_id,
                                'Agent.agent_tertiary_city' => $channel_city_id,
                                'Agent.agent_city4' => $channel_city_id,
                                'Agent.agent_city5' => $channel_city_id,
                            ), 'Agent.agent_status' => '3', 'Agent.dummy_status' => $dummy_status)
                    ));
                    $agent_registered = $this->Agent->find('count', array('conditions' => array('OR' => array(
                                'Agent.agent_primary_city' => $channel_city_id,
                                'Agent.agent_secondary_city' => $channel_city_id,
                                'Agent.agent_tertiary_city' => $channel_city_id,
                                'Agent.agent_city4' => $channel_city_id,
                                'Agent.agent_city5' => $channel_city_id,
                            ), 'Agent.agent_status' => '5', 'Agent.dummy_status' => $dummy_status)));

                    $project_all_count = $this->Project->find('count', array('conditions' => array('NOT' => array('Project.city_id' => 2), 'Project.dummy_status' => $dummy_status)));

                    $project_approve = $this->Project->find('count', array('conditions' => array('NOT' => array('Project.city_id' => 2), 'Project.proj_approved' => '1', 'Project.dummy_status' => $dummy_status)));

                    $project_pending = $this->Project->find('count', array('conditions' => array('NOT' => array('Project.city_id' => 2), 'Project.proj_approved' => '2', 'Project.dummy_status' => $dummy_status)));
                }
            } else if ($channel_city_id == '1') {

                $builder_all_count = $this->Builder->find('count', array('conditions' => array('Builder.dummy_status' => $dummy_status)));
                $builder_approve = $this->Builder->find('count', array('conditions' => array('Builder.builder_approved' => '1', 'Builder.dummy_status' => $dummy_status)));
                $builder_pending = $this->Builder->find('count', array('conditions' => array('Builder.builder_approved' => '2', 'Builder.dummy_status' => $dummy_status)));
                $agent_all_count = $this->Agent->find('count', array('conditions' => array('Agent.dummy_status' => $dummy_status)));
                $agent_allocated = $this->Agent->find('count', array('conditions' => array('Agent.agent_status' => '3', 'Agent.dummy_status' => $dummy_status)));
                $agent_registered = $this->Agent->find('count', array('conditions' => array('Agent.agent_status' => '5', 'Agent.dummy_status' => $dummy_status)));
                $project_all_count = $this->Project->find('count', array('conditions' => array('Project.dummy_status' => $dummy_status)));
                $project_approve = $this->Project->find('count', array('conditions' => array('Project.proj_approved' => '1', 'Project.dummy_status' => $dummy_status)));
                $project_pending = $this->Project->find('count', array('conditions' => array('Project.proj_approved' => '2', 'Project.dummy_status' => $dummy_status)));
            } else {

                $builder_all_count = $this->Builder->find('count', array('conditions' => array('OR' => array(
                            'Builder.builder_primarycity' => $channel_city_id,
                            'Builder.builder_secondarycity' => $channel_city_id,
                            'Builder.builder_tertiarycity' => $channel_city_id,
                            'Builder.city_4' => $channel_city_id,
                            'Builder.city_5' => $channel_city_id,
                        ),
                        'Builder.dummy_status' => $dummy_status)
                ));
                $builder_approve = $this->Builder->find('count', array('conditions' => array('OR' => array(
                            'Builder.builder_primarycity' => $channel_city_id,
                            'Builder.builder_secondarycity' => $channel_city_id,
                            'Builder.builder_tertiarycity' => $channel_city_id,
                            'Builder.city_4' => $channel_city_id,
                            'Builder.city_5' => $channel_city_id,
                        ), 'Builder.builder_approved' => '1', 'Builder.dummy_status' => $dummy_status)
                ));
                $builder_pending = $this->Builder->find('count', array('conditions' => array('OR' => array(
                            'Builder.builder_primarycity' => $channel_city_id,
                            'Builder.builder_secondarycity' => $channel_city_id,
                            'Builder.builder_tertiarycity' => $channel_city_id,
                            'Builder.city_4' => $channel_city_id,
                            'Builder.city_5' => $channel_city_id,
                        ), 'Builder.builder_approved' => '2', 'Builder.dummy_status' => $dummy_status)));

                

                $project_all_count = $this->Project->find('count', array('conditions' => array('Project.dummy_status' => $dummy_status, 'Project.city_id' => $channel_city_id)));

                $project_approve = $this->Project->find('count', array('conditions' => array('Project.city_id' => $channel_city_id, 'Project.proj_approved' => '1', 'Project.dummy_status' => $dummy_status)));

                $project_pending = $this->Project->find('count', array('conditions' => array('Project.city_id' => $channel_city_id, 'Project.proj_approved' => '2', 'Project.dummy_status' => $dummy_status)));
            }
            $this->set(compact('builder_all_count'));
            $this->set(compact('builder_approve'));
            $this->set(compact('builder_pending'));
            
            $this->set(compact('project_all_count'));
            $this->set(compact('project_approve'));
            $this->set(compact('project_pending'));

            if ($role_id == '7') { // for execution manager
                $lead_all_count = $this->Lead->find('count', array('conditions' => array('OR' => array('Lead.lead_managerprimary' => $user_id, 'Lead.lead_managersecondary' => $user_id), 'Lead.dummy_status' => $dummy_status)));

                $lead_new_client_count = $this->Lead->find('count', array('conditions' => array('OR' => array('Lead.lead_managerprimary' => $user_id, 'Lead.lead_managersecondary' => $user_id), 'Lead.dummy_status' => $dummy_status, 'Lead.lead_source != 3')));

                $lead_old_client_count = $this->Lead->find('count', array('conditions' => array('OR' => array('Lead.lead_managerprimary' => $user_id, 'Lead.lead_managersecondary' => $user_id), 'Lead.dummy_status' => $dummy_status, 'Lead.lead_source' => '3')));
            } else if ($role_id == '14') { //phone officer
                $lead_all_count = $this->Lead->find('count', array('conditions' => array('Lead.lead_phoneofficer' => $user_id, 'Lead.dummy_status' => $dummy_status)));
                $lead_old_client_count = $this->Lead->find('count', array('conditions' => array('Lead.lead_phoneofficer' => $user_id, 'Lead.dummy_status' => $dummy_status, 'Lead.lead_source' => '3')));
                $lead_new_client_count = $this->Lead->find('count', array('conditions' => array('Lead.lead_phoneofficer' => $user_id, 'Lead.dummy_status' => $dummy_status, 'Lead.lead_source != 3')));
            } else if ($role_id == '5') { //Associate
                $lead_all_count = $this->Lead->find('count', array('conditions' => array('Lead.lead_associate' => $user_id, 'Lead.dummy_status' => $dummy_status)));
                $lead_old_client_count = $this->Lead->find('count', array('conditions' => array('Lead.lead_associate' => $user_id, 'Lead.dummy_status' => $dummy_status, 'Lead.lead_source' => '3')));
                $lead_new_client_count = $this->Lead->find('count', array('conditions' => array('Lead.lead_associate' => $user_id, 'Lead.dummy_status' => $dummy_status, 'Lead.lead_source != 3')));
            } else if ($role_id == '15') { //Accounts
                $lead_all_count = $this->Lead->find('count', array('conditions' => array('NOT' => array('Lead.city_id' => 2), 'Lead.lead_associate' => $user_id, 'Lead.dummy_status' => $dummy_status)));
                $lead_old_client_count = $this->Lead->find('count', array('conditions' => array('NOT' => array('Lead.city_id' => 2), 'Lead.lead_associate' => $user_id, 'Lead.dummy_status' => $dummy_status, 'Lead.lead_source' => '3')));
                $lead_new_client_count = $this->Lead->find('count', array('conditions' => array('NOT' => array('Lead.city_id' => 2), 'Lead.lead_associate' => $user_id, 'Lead.dummy_status' => $dummy_status, 'Lead.lead_source != 3')));
            } else if ($channel_city_id > '1') { //Not global{
                $lead_all_count = $this->Lead->find('count', array('conditions' => array('Lead.city_id' => $channel_city_id, 'Lead.dummy_status' => $dummy_status)));
                $lead_old_client_count = $this->Lead->find('count', array('conditions' => array('Lead.city_id' => $channel_city_id, 'Lead.dummy_status' => $dummy_status, 'Lead.lead_source' => '3')));
                $lead_new_client_count = $this->Lead->find('count', array('conditions' => array('Lead.city_id' => $channel_city_id, 'Lead.dummy_status' => $dummy_status, 'Lead.lead_source != 3')));
            } else {
                $lead_all_count = $this->Lead->find('count', array('conditions' => array('Lead.dummy_status' => $dummy_status)));
                $lead_old_client_count = $this->Lead->find('count', array('conditions' => array('Lead.dummy_status' => $dummy_status, 'Lead.lead_source' => '3')));
                $lead_new_client_count = $this->Lead->find('count', array('conditions' => array('Lead.dummy_status' => $dummy_status, 'Lead.lead_source != 3')));
            }
            $this->set(compact('lead_all_count'));
            $this->set(compact('lead_new_client_count'));
            $this->set(compact('lead_old_client_count'));

            $all_action = $this->ActionItem->find('count', array('conditions' => array('OR' => array('ActionItem.next_action_by' => $user_id, 'ActionItem.created_by_id' => $user_id))));
            $this->set(compact('all_action'));
            
            //pr($SupportTickets);
            $all_action_pending = $this->ActionItem->find('count', array('conditions' => array('ActionItem.next_action_by' => $user_id, 'ActionItem.action_item_active' => 'Yes')));
            $this->set(compact('all_action_pending'));
        }

        elseif ($industry == '2') {// travel
            
            $agent_all_count = $this->Agent->find('count', array('conditions' => array('OR' => array(
                            'Agent.agent_primary_city' => $channel_city_id,
                            'Agent.agent_secondary_city' => $channel_city_id,
                            'Agent.agent_tertiary_city' => $channel_city_id,
                            'Agent.agent_city4' => $channel_city_id,
                            'Agent.agent_city5' => $channel_city_id,
                        ),
                        'Agent.dummy_status' => $dummy_status)
                ));
                $agent_allocated = $this->Agent->find('count', array('conditions' => array('OR' => array(
                            'Agent.agent_primary_city' => $channel_city_id,
                            'Agent.agent_secondary_city' => $channel_city_id,
                            'Agent.agent_tertiary_city' => $channel_city_id,
                            'Agent.agent_city4' => $channel_city_id,
                            'Agent.agent_city5' => $channel_city_id,
                        ), 'Agent.agent_status' => '3', 'Agent.dummy_status' => $dummy_status)
                ));
                $agent_registered = $this->Agent->find('count', array('conditions' => array('OR' => array(
                            'Agent.agent_primary_city' => $channel_city_id,
                            'Agent.agent_secondary_city' => $channel_city_id,
                            'Agent.agent_tertiary_city' => $channel_city_id,
                            'Agent.agent_city4' => $channel_city_id,
                            'Agent.agent_city5' => $channel_city_id,
                        ), 'Agent.agent_status' => '5', 'Agent.dummy_status' => $dummy_status)));
                
                $this->set(compact('agent_all_count','agent_allocated','agent_registered'));
    
            
            $travel_count_action = $this->TravelActionItem->find('count', array('conditions' => array('OR' => array('TravelActionItem.next_action_by' => $user_id, 'TravelActionItem.created_by_id' => $user_id))));
            $this->set(compact('travel_count_action'));

            $travel_count_action_pending = $this->TravelActionItem->find('count', array('conditions' => array('TravelActionItem.action_item_active' => 'Yes', 'TravelActionItem.next_action_by' => $user_id)));
            $this->set(compact('travel_count_action_pending'));

            $event_all_count = $this->Event->find('count', array('conditions' => array('Event.dummy_status' => $dummy_status, 'Event.creator_id' => $user_id)));
            $this->set(compact('event_all_count'));
            $conProvince = array();
			if($this->hotelProvince()){
			$conProvince = array('TravelHotelLookup.province_id' => $this->hotelProvince());
			}

            $hotel_all_count = $this->TravelHotelLookup->find('count',array('conditions' => $conProvince));
            $this->set(compact('hotel_all_count'));

            $hotel_approve = $this->TravelHotelLookup->find('count', array('conditions' => array('TravelHotelLookup.active' => 'TRUE')+$conProvince));
            $this->set(compact('hotel_approve'));

            $hotel_pending = $this->TravelHotelLookup->find('count', array('conditions' => array('TravelHotelLookup.active' => 'FALSE')+$conProvince));
            $this->set(compact('hotel_pending'));

            $mapping_all_count = $this->Mappinge->find('count');
            $this->set(compact('mapping_all_count'));

            $country_supplier_all_count = $this->TravelCountrySupplier->find('count');
            $city_supplier_all_count = $this->TravelCitySupplier->find('count');
            $city_county_supplier_count = $country_supplier_all_count + $city_supplier_all_count;
            $this->set(compact('city_county_supplier_count'));

            $hotel_supplier_all_count = $this->TravelHotelRoomSupplier->find('count');
            $this->set(compact('hotel_supplier_all_count'));

            $supplier_all_count = $this->TravelSupplier->find('count');
            $supplier_pending = $this->TravelSupplier->find('count', array('conditions' => array('TravelSupplier.active' => 'FALSE')));
            $supplier_approved = $this->TravelSupplier->find('count', array('conditions' => array('TravelSupplier.active' => 'TRUE')));
            $duplicate_cnt = $this->DuplicateMappinge->find('count');
            $duplicate_city_cnt = $this->DuplicateMappinge->find('count', array('conditions' => array('DuplicateMappinge.mapping_type' => '2')));
            $duplicate_hotel_cnt = $this->DuplicateMappinge->find('count', array('conditions' => array('DuplicateMappinge.mapping_type' => '3')));
        }


        if ($industry == '5') { // digital
            $digital_media_task_cnt = $this->DigMediaTask->find('count', array('conditions' => array('DigMediaTask.created_by' => $user_id)));

            $validate_cnt = $this->DigAccount->find('count', array('conditions' => array('DigAccount.account_usage_status' => '9', 'DigAccount.account_base_id' => '25'))); //dig_account_usages
            $currently_cnt = $this->DigAccount->find('count', array('conditions' => array('DigAccount.account_usage_status' => '1', 'DigAccount.account_base_id' => '25')));

            $person_validate_cnt = $this->DigPerson->find('count', array('conditions' => array('DigPerson.person_usage_status' => '9'))); //DigBaseUsage
            $person_currently_cnt = $this->DigPerson->find('count', array('conditions' => array('DigPerson.person_usage_status' => '1'))); //DigBaseUsage

            $pinterest_validate_cnt = $this->DigAccount->find('count', array('conditions' => array('DigAccount.account_usage_status' => '9', 'DigAccount.account_base_id' => '3')));
            $pinterest_currently_cnt = $this->DigAccount->find('count', array('conditions' => array('DigAccount.account_usage_status' => '1', 'DigAccount.account_base_id' => '3')));

            $facebook_validate_cnt = $this->DigAccount->find('count', array('conditions' => array('DigAccount.account_usage_status' => '9', 'DigAccount.account_base_id' => '41')));
            $facebook_currently_cnt = $this->DigAccount->find('count', array('conditions' => array('DigAccount.account_usage_status' => '1', 'DigAccount.account_base_id' => '41')));

            $linkedIn_validate_cnt = $this->DigAccount->find('count', array('conditions' => array('DigAccount.account_usage_status' => '9', 'DigAccount.account_base_id' => '46')));
            $linkedIn_currently_cnt = $this->DigAccount->find('count', array('conditions' => array('DigAccount.account_usage_status' => '1', 'DigAccount.account_base_id' => '46')));

            $muzy_validate_cnt = $this->DigAccount->find('count', array('conditions' => array('DigAccount.account_usage_status' => '9', 'DigAccount.account_base_id' => '42')));
            $muzy_currently_cnt = $this->DigAccount->find('count', array('conditions' => array('DigAccount.account_usage_status' => '1', 'DigAccount.account_base_id' => '42')));

            $newsvine_validate_cnt = $this->DigAccount->find('count', array('conditions' => array('DigAccount.account_usage_status' => '9', 'DigAccount.account_base_id' => '43')));
            $newsvine_currently_cnt = $this->DigAccount->find('count', array('conditions' => array('DigAccount.account_usage_status' => '1', 'DigAccount.account_base_id' => '43')));

            $skyrock_validate_cnt = $this->DigAccount->find('count', array('conditions' => array('DigAccount.account_usage_status' => '9', 'DigAccount.account_base_id' => '44')));
            $skyrock_currently_cnt = $this->DigAccount->find('count', array('conditions' => array('DigAccount.account_usage_status' => '1', 'DigAccount.account_base_id' => '44')));

            $weheartit_validate_cnt = $this->DigAccount->find('count', array('conditions' => array('DigAccount.account_usage_status' => '9', 'DigAccount.account_base_id' => '45')));
            $weheartit_currently_cnt = $this->DigAccount->find('count', array('conditions' => array('DigAccount.account_usage_status' => '1', 'DigAccount.account_base_id' => '45')));

            $plurk_validate_cnt = $this->DigAccount->find('count', array('conditions' => array('DigAccount.account_usage_status' => '9', 'DigAccount.account_base_id' => '6')));
            $plurk_currently_cnt = $this->DigAccount->find('count', array('conditions' => array('DigAccount.account_usage_status' => '1', 'DigAccount.account_base_id' => '6')));

            $fancy_validate_cnt = $this->DigAccount->find('count', array('conditions' => array('DigAccount.account_usage_status' => '9', 'DigAccount.account_base_id' => '13')));
            $fancy_currently_cnt = $this->DigAccount->find('count', array('conditions' => array('DigAccount.account_usage_status' => '1', 'DigAccount.account_base_id' => '13')));

            $pusha_validate_cnt = $this->DigAccount->find('count', array('conditions' => array('DigAccount.account_usage_status' => '9', 'DigAccount.account_base_id' => '47')));
            $pusha_currently_cnt = $this->DigAccount->find('count', array('conditions' => array('DigAccount.account_usage_status' => '1', 'DigAccount.account_base_id' => '47')));

            $visualize_validate_cnt = $this->DigAccount->find('count', array('conditions' => array('DigAccount.account_usage_status' => '9', 'DigAccount.account_base_id' => '48')));
            $visualize_currently_cnt = $this->DigAccount->find('count', array('conditions' => array('DigAccount.account_usage_status' => '1', 'DigAccount.account_base_id' => '48')));

            $piccsy_validate_cnt = $this->DigAccount->find('count', array('conditions' => array('DigAccount.account_usage_status' => '9', 'DigAccount.account_base_id' => '49')));
            $piccsy_currently_cnt = $this->DigAccount->find('count', array('conditions' => array('DigAccount.account_usage_status' => '1', 'DigAccount.account_base_id' => '49')));

            $scoopit_validate_cnt = $this->DigAccount->find('count', array('conditions' => array('DigAccount.account_usage_status' => '9', 'DigAccount.account_base_id' => '29')));
            $scoopit_currently_cnt = $this->DigAccount->find('count', array('conditions' => array('DigAccount.account_usage_status' => '1', 'DigAccount.account_base_id' => '29')));

            $buzznet_validate_cnt = $this->DigAccount->find('count', array('conditions' => array('DigAccount.account_usage_status' => '9', 'DigAccount.account_base_id' => '50')));
            $buzznet_currently_cnt = $this->DigAccount->find('count', array('conditions' => array('DigAccount.account_usage_status' => '1', 'DigAccount.account_base_id' => '50')));

            $tumblr_validate_cnt = $this->DigAccount->find('count', array('conditions' => array('DigAccount.account_usage_status' => '9', 'DigAccount.account_base_id' => '51')));
            $tumblr_currently_cnt = $this->DigAccount->find('count', array('conditions' => array('DigAccount.account_usage_status' => '1', 'DigAccount.account_base_id' => '51')));

            $diigo_validate_cnt = $this->DigAccount->find('count', array('conditions' => array('DigAccount.account_usage_status' => '9', 'DigAccount.account_base_id' => '30')));
            $diigo_currently_cnt = $this->DigAccount->find('count', array('conditions' => array('DigAccount.account_usage_status' => '1', 'DigAccount.account_base_id' => '30')));

            $behance_validate_cnt = $this->DigAccount->find('count', array('conditions' => array('DigAccount.account_usage_status' => '9', 'DigAccount.account_base_id' => '52')));
            $behance_currently_cnt = $this->DigAccount->find('count', array('conditions' => array('DigAccount.account_usage_status' => '1', 'DigAccount.account_base_id' => '52')));

            $googlepl_validate_cnt = $this->DigAccount->find('count', array('conditions' => array('DigAccount.account_usage_status' => '9', 'DigAccount.account_base_id' => '1')));
            $googlepl_currently_cnt = $this->DigAccount->find('count', array('conditions' => array('DigAccount.account_usage_status' => '1', 'DigAccount.account_base_id' => '1')));
        }
        $this->paginate['order'] = array('SupportTicket.created' => 'desc');
        $this->set('SupportTickets', $this->paginate("SupportTicket",array('OR' => array('SupportTicket.last_action_by' => $user_id,'SupportTicket.approved_by' => $user_id,'SupportTicket.next_action_by' => $user_id,'SupportTicket.created_by' => $user_id),'SupportTicket.active' => 'TRUE')));

        $this->set(compact('digital_media_task_cnt', 'duplicate_hotel_cnt', 'duplicate_city_cnt', 'duplicate_cnt', 'supplier_approved', 'supplier_pending', 'supplier_all_count', 'validate_cnt', 'currently_cnt', 'person_validate_cnt', 'person_currently_cnt'));




        // $log = $this->Lead->getDataSource()->getLog(false, false);       
        //debug($log);
    }

    function index() {

        $dummy_status = $this->Auth->user('dummy_status');

        $search_condition = array();

        if ($this->request->is('post') || $this->request->is('put')) {

            if (!empty($this->data['User']['search_value'])) {
                $search = $this->data['User']['search_value'];
                array_push($search_condition, array('OR' => array('User.fname' . ' LIKE' => "%" . mysql_escape_string(trim(strip_tags($search))) . "%", 'User.lname' . ' LIKE' => "%" . mysql_escape_string(trim(strip_tags($search))) . "%")));
            }
        }
        /*
          if($dummy_status){
          array_push($search_condition, array('User.dummy_status' => $dummy_status));

          }
         */

        $this->paginate['order'] = array('User.fname' => 'asc');
        $this->set('users', $this->paginate("User", $search_condition));



        $roles = $this->Role->find('list', array('fields' => array('id', 'role_name')));
        $this->set(compact('roles'));
        $channels = $this->Channel->find('list', array('fields' => array('id', 'channel_name')));
        $this->set(compact('channels'));
    }

    function login() {

        $this->layout = 'login';

        if ($this->request->is('post')) {

            if ($this->Auth->login()) {
                $arrLoginInfo = $this->request->data["User"];
                $details = $this->User->find('first', array(
                    'conditions' => array('company_email_id' => $arrLoginInfo["company_email_id"])
                ));
                return $this->redirect($this->Auth->redirect('users/home'));
                exit;
            } else {

                $this->Session->setFlash(__('Error: invalid username and/or password'), 'login_error');
            }
        }

        $this->set('isLoginPage', 1);
    }

    function home() {
        $this->layout = 'home';
        $user_id = $this->Auth->user('id');
        $dummy_status = $this->Auth->user('dummy_status');
        $role_id = array();
        $travel_role_id = array();
        $digital_role_id = array();
        $role_field = $this->GroupsUser->find('list', array('fields' => array('channel_field', 'role_field'), 'conditions' => array('industry' => 1))); // real easte
        $travel_role_field = $this->GroupsUser->find('list', array('fields' => array('channel_field', 'role_field'), 'conditions' => array('industry' => 2))); // travel
        $digital_role_field = $this->GroupsUser->find('list', array('fields' => array('channel_field', 'role_field'), 'conditions' => array('industry' => 5))); // travel
        //pr($digital_role_field);
        foreach ($role_field as $key => $val) {
            // echo $key;
            if ($this->Auth->user($val)) {
                $role_id[] = $this->Auth->user($key) . ',' . $this->Auth->user($val);
            }
        }

        foreach ($travel_role_field as $key => $val) {
            // echo $key;
            if ($this->Auth->user($val)) {
                $travel_role_id[] = $this->Auth->user($key) . ',' . $this->Auth->user($val);
            }
        }

        foreach ($digital_role_field as $key => $val) {
            // echo $key;
            if ($this->Auth->user($val)) {
                $digital_role_id[] = $this->Auth->user($key) . ',' . $this->Auth->user($val);
            }
        }
        //  pr($digital_role_id);
        $this->set(compact('digital_role_id'));
        $this->set(compact('travel_role_id'));
        //  pr($role_id);
        /*
          $roles = $this->Role->find('list',array(
          'fields' => array('Role.id', 'Role.group_id'),
          'joins' => array(
          array(
          'table' => 'groups_users',
          'alias' => 'GroupsUser',
          'conditions' => array(
          'Role.group_id = GroupsUser.id'
          )
          )
          ),
          'conditions' => array('GroupsUser.industry' => 1),

          )); // for real easte
         * 
         */
        $roles = $this->Role->find('list', array('fields' => array('Role.id', 'Role.group_id'))); // for real easte
        //pr($roles);
        $this->set(compact('roles'));

        $this->set('role_id', $role_id);


        $user = $this->User->findById($user_id);

        if ($this->request->data) {

            $this->User->id = $user_id;



            if ($this->User->save($this->request->data)) {
                // $this->log('special', 'foo');
                $this->Session->setFlash('User has been updated.', 'success');
                // $this->redirect(array('controller' => 'messages','action' => 'index','users','my-users'));
                $this->redirect(array('action' => 'home'));
            } else {
                $this->Session->setFlash('Unable to edit User.', 'error');
            }
        }





        $groups = $this->GroupsUser->find('list', array('fields' => array('id', 'name')));
        $this->set(compact('groups'));

        $channels = $this->Channel->find('all', array('fields' => array('Channel.id', 'City.city_name')));
        foreach ($channels as $key => $val) {
            //$a[] =  $val['Channel']['id'];
            $channel_city[$val['Channel']['id']] = $val['City']['city_name'];
        }

        $this->set(compact('channel_city'));

        $codes = $this->LookupValueLeadsCountry->find('all', array('fields' => array('LookupValueLeadsCountry.id', 'LookupValueLeadsCountry.value', 'LookupValueLeadsCountry.code')));
        $codes = Set::combine($codes, '{n}.LookupValueLeadsCountry.id', array('%s: %s', '{n}.LookupValueLeadsCountry.value', '{n}.LookupValueLeadsCountry.code'));
        $this->set(compact('codes'));

        $cities = $this->City->find('list', array('fields' => array('id', 'city_name'), 'conditions' => array('dummy_status' => $dummy_status), 'order' => 'city_name asc'));
        $this->set(compact('cities'));

        $this->request->data = $user;
        //  pr($channels);
    }

    function logout() {
        //$this->Session->delete('role_id');
        $this->redirect($this->Auth->logout());
    }

    public function add() {


        $dummy_status = $this->Auth->user('dummy_status');

        $condition_dummy_status = array('dummy_status' => $dummy_status);

        if ($this->request->is('post')) {

            //Set User password

            $password = $this->generateRandomAlpha(4);
            $password = $password . '' . $this->generateRandomNumber(3);
            $password = $password . '' . $this->generateRandomAlpha(2);
            $password = $password . '' . $this->generateRandomNumber(1);
            $this->request->data['User']['password'] = $password;
            $this->request->data['User']['dummy_status'] = $dummy_status;
            $this->User->create();
            if ($this->User->save($this->request->data)) {

                //Send email with password
                $Email = new CakeEmail();
                $Email->viewVars(array(
                    'name' => $this->request->data['User']['fname'],
                    'email' => $this->request->data['User']['company_email_id'],
                    'password' => $password
                ));
                //$company_email_id = $this->request->data['User']['company_email_id'];
                $company_email_id = 'infra@sumanus.com';
                $Email->template('registration_password', 'default')->emailFormat('html')->to($company_email_id)->from('admin@silkrouters.com')->subject('Silkrouters - Your Password')->send();
                $this->Session->setFlash('User has been saved.', 'success');
                $this->redirect(array('controller' => 'messages', 'action' => 'index', 'users', 'my-users'));
                // $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to add User.', 'error');
            }
        }



        $channels = $this->Channel->find('all', array('fields' => array('Channel.id', 'Channel.channel_name', 'Channel.channel_role'), 'conditions' => array('Channel.dummy_status' => 2), 'order' => 'channel_role asc')); // for real easte
        $this->set(compact('channels'));

        $role_id = array();

        $this->set('role_id', $role_id);


        $cities = $this->City->find('list', array('fields' => array('id', 'city_name'), 'conditions' => $condition_dummy_status, 'order' => 'city_name asc'));
        $this->set(compact('cities'));
        $roles = $this->Role->find('all');
        $this->set('roles', $roles);

        $codes = $this->LookupValueLeadsCountry->find('all', array('fields' => array('LookupValueLeadsCountry.id', 'LookupValueLeadsCountry.value', 'LookupValueLeadsCountry.code')));
        $codes = Set::combine($codes, '{n}.LookupValueLeadsCountry.id', array('%s: %s', '{n}.LookupValueLeadsCountry.value', '{n}.LookupValueLeadsCountry.code'));
        $this->set(compact('codes'));

        $groups = $this->GroupsUser->find('all', array('conditions' => array('GroupsUser.industry' => 1)));
        $this->set(compact('groups'));

        $travel_groups = $this->GroupsUser->find('all', array('conditions' => array('GroupsUser.industry' => 2))); // for travel
        $this->set(compact('travel_groups'));
        //   pr($groups);
    }

    function edit($id = null, $mode = null) {

        $dummy_status = $this->Auth->user('dummy_status');

        $condition_dummy_status = array('dummy_status' => $dummy_status);

        $id = base64_decode($id);
        $this->set(compact('mode'));

        if (!$id) {            // If id is not passed from the URL
            $this->Session->setFlash(sprintf(__('Invalid user', true), 'user'), 'error');   // Set flash error message

            $this->redirect(array('action' => 'index'));       // Redirect back to list page with the message
        }
        $user = $this->User->findById($id);



        if ($this->request->data) {

            $this->User->id = $id;



            if ($this->User->save($this->request->data)) {
                // $this->log('special', 'foo');
                $this->Session->setFlash('User has been updated.', 'success');
                $this->redirect(array('controller' => 'messages', 'action' => 'index', 'users', 'my-users'));
                //   $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to edit User.', 'error');
            }
        }




        $cities = $this->City->find('list', array('fields' => array('id', 'city_name'), 'conditions' => $condition_dummy_status, 'order' => 'city_name asc'));
        $this->set(compact('cities'));


        $role_id = array();
        $role_field = $this->GroupsUser->find('list', array('fields' => array('id', 'role_field')));

        foreach ($role_field as $field) {
            $role_id[] = $user['User'][$field];
        }
        $role_id = array_filter($role_id);
        $this->set('role_id', $role_id);

        $channel_id = array();
        $channel_fields = $this->GroupsUser->find('list', array('fields' => array('id', 'channel_field')));

        foreach ($channel_fields as $channel_field) {
            $channel_id[] = $user['User'][$channel_field];
        }
        $channel_id = array_filter($channel_id);
        $this->set('channel_id', $channel_id);

        $roles = $this->Role->find('all', array('conditions' => array('GroupsUser.industry' => 1))); // for real easte
        $this->set('roles', $roles);

        $travel_roles = $this->Role->find('all', array('conditions' => array('GroupsUser.industry' => 2))); // for real easte
        $this->set(compact('travel_roles'));

        $digital_roles = $this->Role->find('all', array('conditions' => array('GroupsUser.industry' => 5))); // for Digital
        $this->set(compact('digital_roles'));
        // pr($roles);

        $channels = $this->Channel->find('all', array('fields' => array('Channel.id', 'Channel.channel_name', 'Channel.channel_role'), 'conditions' => array('Channel.dummy_status' => 2), 'order' => 'channel_role asc')); // for real easte
        $this->set(compact('channels'));

        //  $travel_channels = $this->Channel->find('all', array('fields' => array('Channel.id','Channel.channel_name','Channel.channel_role'), 'conditions' => array('Channel.dummy_status' => 2,'Channel.channel_industry' => 2), 'order' => 'channel_role asc')); // for travel
        //  $this->set(compact('travel_channels'));

        $groups = $this->GroupsUser->find('all', array('conditions' => array('GroupsUser.industry' => 1))); // for real easte
        $this->set(compact('groups'));

        $travel_groups = $this->GroupsUser->find('all', array('conditions' => array('GroupsUser.industry' => 2))); // for travel
        $this->set(compact('travel_groups'));

        $digital_groups = $this->GroupsUser->find('all', array('conditions' => array('GroupsUser.industry' => 5))); // for travel
        $this->set(compact('digital_groups'));

        $codes = $this->LookupValueLeadsCountry->find('all', array('fields' => array('LookupValueLeadsCountry.id', 'LookupValueLeadsCountry.value', 'LookupValueLeadsCountry.code')));
        $codes = Set::combine($codes, '{n}.LookupValueLeadsCountry.id', array('%s: %s', '{n}.LookupValueLeadsCountry.value', '{n}.LookupValueLeadsCountry.code'));
        $this->set(compact('codes'));

        $this->request->data = $user;
    }

    function group() {

        $search_condition = array();


        if ($this->request->is('post') || $this->request->is('put')) {
            if (!empty($this->data['GroupsUser']['search_value'])) {
                $search = $this->data['GroupsUser']['search_value'];
                array_push($search_condition, array('GroupsUser.name' . ' LIKE' => mysql_escape_string(trim(strip_tags($search))) . "%"));
            }
        }

        $this->set('groups', $this->paginate("GroupsUser", $search_condition));
    }

    public function group_add() {

        if ($this->request->is('post') || $this->request->data('put')) {
            // pr($this->request->data['GroupsUser']['role_field']);
            $role_field = $this->request->data['GroupsUser']['role_field'];
            $channel_field = $this->request->data['GroupsUser']['channel_field'];

            $this->GroupsUser->set($this->data);

            if ($this->GroupsUser->validates() == true) {

                if ($this->GroupsUser->save($this->request->data)) {
                    $this->User->query("ALTER TABLE `users` ADD " . $role_field . " INT( 2 ) NULL");
                    $this->User->query("ALTER TABLE `users` ADD " . $channel_field . " INT( 2 ) NULL");
                    $this->Session->setFlash('Group has been saved.', 'success');
                    $this->redirect(array('controller' => 'users', 'action' => 'group'));
                } else {
                    $this->Session->setFlash('Unable to add Group.', 'error');
                }
            }
        }

        $industries = $this->LookupValueActivityIndustry->find('list', array('fields' => array('id', 'value'), 'order' => 'value asc'));
        $this->set(compact('industries'));
    }

    /**
     * Edit group and on sussess or failure, shows messages.
     * 
     * @param intiger $id Either value or null.
     * @return null    This method does not return any data.
     */
    public function group_edit($id = null, $mode = null) {
        $id = base64_decode($id);
        $this->set(compact('mode'));

        if (!$id) {
            throw new NotFoundException(__('Invalid Group'));
        }

        $role = $this->GroupsUser->findById($id);

        if (!$role) {
            throw new NotFoundException(__('Invalid Group'));
        }

        if ($this->request->data) {

            $this->GroupsUser->id = $id;
            if ($this->GroupsUser->save($this->request->data)) {
                $this->Session->setFlash('Your changes have been submitted.', 'success');
                $this->redirect(array('controller' => 'users', 'action' => 'group'));
            } else {
                $this->Session->setFlash('Unable to update.', 'failure');
            }
        }

        $industries = $this->LookupValueActivityIndustry->find('list', array('fields' => array('id', 'value'), 'order' => 'value asc'));
        $this->set(compact('industries'));

        if (!$this->request->data) {
            $this->request->data = $role;
        }
    }

    function delete($id = null) {

        if ($this->User->delete($id)) {
            $this->Session->setFlash('User has been deleted.', 'success');
            $this->redirect(array('action' => 'index'));
        } else {
            $this->Session->setFlash('Unable to delete User.', 'error');
            $this->redirect(array('action' => 'index'));
        }
    }

    public function demo() {
        $this->layout = '';
    }

}
<?php

/**
 * Event controller.
 *
 * This file will render views from views/events/
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
 * Events controller
 *
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
App::uses('CakeEmail', 'Network/Email');

class EventsController extends AppController {

    var $uses = array('Event', 'Project', 'Lead', 'Channel', 'Area', 'Suburb', 'City', 'Builder', 'LookupValueActivityLevel', 'LookupValueActivityType', 'User', 'LookupValueReimbursementType_1', 'LookupValueReimbursementType_2', 'Reimbursement', 'ActionItem', 'LookupValueBillStatus', 'LookupValueBillType', 'LookupCompany', 'LookupValueActivityDetail');
    var $name = 'Events';

    function index($pointer = NULL) {

        $search_condition = array();
        $channel_id = $this->Session->read("channel_id");
        $channels = $this->Channel->findById($channel_id);
        $channel_role = $channels['Channel']['channel_role'];
        $self_id = $this->Auth->user("id");
        $city_id = $channels['Channel']['city_id'];
        $user_id = '';
        $activity_level = '';
        $activity_type = '';
        $site_visit_project_id = '';
        $activity_completed = '';
        $this->Event->recursive = 1;




        if ($this->request->is('post') || $this->request->is('put')) {

            if (!empty($this->data['Event']['user_id'])) {
                $user_id = $this->data['Event']['user_id'];
                array_push($search_condition, array('Event.user_id' => $user_id));
            }
            if (!empty($this->data['Event']['activity_level'])) {
                $activity_level = $this->data['Event']['activity_level'];
                array_push($search_condition, array('Event.activity_level' => $activity_level));
            }
            if (!empty($this->data['Event']['activity_with']) && empty($this->data['Event']['activity_level'])) {
                $activity_level = $this->data['Event']['activity_level'];
                $activity_with = $this->data['Event']['activity_with'];
                if ($activity_level == '1')
                    array_push($search_condition, array('Event.lead_id' => $activity_with));
                else if ($activity_level == '2')
                    array_push($search_condition, array('Event.builder_id' => $activity_with));
                else if ($activity_level == '3')
                    array_push($search_condition, array('Event.project_id' => $activity_with));
            }
            if (!empty($this->data['Event']['activity_type'])) {
                $activity_type = $this->data['Event']['activity_type'];
                array_push($search_condition, array('Event.activity_type' => $activity_type));
            }
            if (!empty($this->data['Event']['site_visit_project_id'])) {
                $site_visit_project_id = $this->data['Event']['site_visit_project_id'];
                array_push($search_condition, array('Event.site_visit_project_id' => $site_visit_project_id));
            }
            if (!empty($this->data['Event']['activity_completed'])) {
                $activity_completed = $this->data['Event']['activity_completed'];
                array_push($search_condition, array('Event.activity_completed' => $activity_completed));
            }
        } elseif ($this->request->is('get')) {

            if (!empty($this->request->params['named']['user_id'])) {
                $user_id = $this->request->params['named']['user_id'];
                array_push($search_condition, array('Event.user_id' => $user_id));
            }

            if (!empty($this->request->params['named']['activity_level'])) {
                $activity_level = $this->request->params['named']['activity_level'];
                array_push($search_condition, array('Event.activity_level' => $activity_level));
            }

            if (!empty($this->request->params['named']['activity_type'])) {
                $activity_type = $this->request->params['named']['activity_type'];
                array_push($search_condition, array('Event.activity_type' => $activity_type));
            }

            if (!empty($this->request->params['named']['site_visit_project_id'])) {
                $site_visit_project_id = $this->request->params['named']['site_visit_project_id'];
                array_push($search_condition, array('Event.site_visit_project_id' => $site_visit_project_id));
            }
            if (!empty($this->request->params['named']['activity_completed'])) {
                $activity_completed = $this->request->params['named']['activity_completed'];
                array_push($search_condition, array('Event.activity_completed' => $activity_completed));
            }
        }

        if ($city_id == 2)
            array_push($search_condition, array('Event.role_city' => $city_id, 'Event.user_id' => $self_id));
        else
            array_push($search_condition, array('Event.user_id' => $self_id, 'NOT' => array('Event.role_city' => '2')));

        $this->paginate['order'] = array('Event.created' => 'asc');
        $this->set('events', $this->paginate("Event", $search_condition));

        $activity_levels = $this->LookupValueActivityLevel->find('list', array('fields' => 'id,value', 'conditions' => array('id' => array('1', '2', '3')), 'order' => 'id ASC'));
        $this->set('activity_levels', $activity_levels);

        $activity_types = $this->LookupValueActivityType->find('list', array('fields' => 'id,value', 'order' => 'id ASC'));
        $this->set(compact('activity_types'));
        if ($city_id == 1) {
            $activity_by = $this->User->find('all', array('fields' => array('User.id', 'User.fname', 'User.lname'),
                'conditions' => array('User.exu_role_id' => '7')));
        } else {
            $activity_by = $this->User->find('all', array('fields' => array('User.id', 'User.fname', 'User.lname'),
                'conditions' => array('User.id' => $self_id)));
        }

        $activity_by = Set::combine($activity_by, '{n}.User.id', array('%s %s', '{n}.User.fname', '{n}.User.lname'));
        $this->set(compact('activity_by'));

        $projects = $this->Project->find('list', array('fields' => array('id', 'project_name'), 'conditions' => array('city_id' => $city_id), 'order' => 'project_name ASC'));
        $this->set(compact('projects'));


        if (!isset($this->passedArgs['user_id']) && empty($this->passedArgs['user_id'])) {
            $this->passedArgs['user_id'] = (isset($this->data['Event']['user_id'])) ? $this->data['Event']['user_id'] : '';
        }
        if (!isset($this->passedArgs['activity_level']) && empty($this->passedArgs['activity_level'])) {
            $this->passedArgs['activity_level'] = (isset($this->data['Event']['activity_level'])) ? $this->data['Event']['activity_level'] : '';
        }
        if (!isset($this->passedArgs['activity_type']) && empty($this->passedArgs['activity_type'])) {
            $this->passedArgs['activity_type'] = (isset($this->data['Event']['activity_type'])) ? $this->data['Event']['activity_type'] : '';
        }
        if (!isset($this->passedArgs['site_visit_project_id']) && empty($this->passedArgs['site_visit_project_id'])) {
            $this->passedArgs['site_visit_project_id'] = (isset($this->data['Event']['site_visit_project_id'])) ? $this->data['Event']['site_visit_project_id'] : '';
        }
        if (!isset($this->passedArgs['activity_completed']) && empty($this->passedArgs['activity_completed'])) {
            $this->passedArgs['activity_completed'] = (isset($this->data['Event']['activity_completed'])) ? $this->data['Event']['activity_completed'] : '';
        }

        if (!isset($this->data) && empty($this->data)) {
            $this->data['Event']['user_id'] = $this->passedArgs['user_id'];
            $this->data['Event']['activity_level'] = $this->passedArgs['activity_level'];
            $this->data['Event']['activity_type'] = $this->passedArgs['activity_type'];
            $this->data['Event']['site_visit_project_id'] = $this->passedArgs['site_visit_project_id'];
            $this->data['Event']['activity_completed'] = $this->passedArgs['activity_completed'];
        }

        $this->set(compact('user_id'));
        $this->set(compact('activity_level'));
        $this->set(compact('activity_type'));
        $this->set(compact('site_visit_project_id'));
        $this->set(compact('activity_completed'));



        //$log = $this->Event->getDataSource()->getLog(false, false);       
        //debug($log);
    }

    function add($event_date = null) {

        $this->layout = 'ajax';

        $role_id = $this->Session->read("role_id");
        $channel_id = $this->Session->read("channel_id");
        $channels = $this->Channel->findById($channel_id);
        $channel_role = $channels['Channel']['channel_role'];
        $city_id = $channels['Channel']['city_id'];
        $self_id = $this->Auth->user("id");
        $fllowup_status = '';
        $Reimbursement_status = '';
        $dummy_status = $this->Auth->user('dummy_status');

        $this->set(compact('event_date'));

        if ($city_id == '2')
            $submitted_to = '150';
        else
            $submitted_to = '149';


        if (!empty($this->data)) {

            if ($this->data['Event']['activity_past'] == 'Yes') {
                $start_date = date('Y-m-d', strtotime($this->request->data['Event']['start_date_past']));
                $end_date = date('Y-m-d', strtotime($this->request->data['Event']['end_date_past']));
            } else {
                $start_date = date('Y-m-d', strtotime($this->request->data['Event']['start_date_present']));
                $end_date = date('Y-m-d', strtotime($this->request->data['Event']['end_date_present']));
            }
            if ($this->data['Event']['activity_level'] == '1') {
                $this->request->data['Event']['activity_type'] = $this->data['Event']['client_types'];
            } else if ($this->data['Event']['activity_level'] == '2' || $this->data['Event']['activity_level'] == '3') {
                $this->request->data['Event']['activity_type'] = $this->data['Event']['proj_builder_types'];
            } else if ($this->data['Event']['activity_level'] == '4' || $this->data['Event']['activity_level'] == '5' || $this->data['Event']['activity_level'] == '6') {
                $this->request->data['Event']['activity_type'] = $this->data['Event']['city_sub_area_types'];
            } else if ($this->data['Event']['activity_level'] == '7') {
                $this->request->data['Event']['activity_type'] = $this->data['Event']['company_types'];
            } else {
                $this->request->data['Event']['activity_type'] = $this->data['Event']['other_types'];
            }
            //$event_date = date('Y-m-d',strtotime($this->request->data['Event']['event_date']));
            $start_date = $start_date . " " . date("H:i", strtotime($this->data['Event']['start_time']));
            $end_date = $end_date . " " . date("H:i", strtotime($this->data['Event']['end_time']));
            $this->request->data['Event']['start_date'] = $start_date;
            $this->request->data['Event']['end_date'] = $end_date;
            $this->request->data['Event']['creator_id'] = $self_id;
            $this->request->data['Event']['user_id'] = $self_id;
            $this->request->data['Event']['active'] = 1;
            $this->request->data['Event']['role_city'] = $city_id; // Role city
            $this->request->data['Event']['activity_industry'] = '1'; //  for Real Estate
            $this->request->data['Event']['activity_closed'] = 'No'; //  for Real Estate
            $this->request->data['Event']['activity_status'] = '2'; //  for Real Estate
            $this->request->data['Event']['event_type'] = '1'; //1 for general event 
            $this->request->data['Event']['dummy_status'] = $dummy_status;
            $this->request->data['Event']['description'] = $this->data['Event']['start_time'] . '-' . $this->data['Event']['end_time'];


            $this->Event->create();

            if ($this->Event->save($this->data['Event'])) {

                $event_id = $this->Event->getLastInsertId();
                if ($event_id > 0) {
                    if ($this->request->data['Reimbursement']['is_expense'] == '1') {
                        $Reimbursement_status = '1';
                        $this->request->data['Reimbursement']['reimbursement_event_id'] = $event_id;
                        $this->request->data['Reimbursement']['dummy_status'] = $dummy_status;
                        $this->request->data['Reimbursement']['reimbursement_city_id'] = $city_id;
                        $this->request->data['Reimbursement']['created_by'] = $self_id;
                        $this->request->data['Reimbursement']['reimbursement_closed'] = 'No';
                        $this->request->data['Reimbursement']['reimbursement_status'] = '1';  // Submitted of lookup_value_reimbursement_status
                        $this->request->data['Reimbursement']['reimbursement_level'] = $this->data['Event']['activity_level'];
                        //$this->request->data['Reimbursement']['reimbursement_with'] = $this->data['Event']['activity_level'];
                        $this->request->data['Reimbursement']['reimbursement_industry'] = '1'; //  for Real Estate
                        $this->request->data['Reimbursement']['reimbursement_bill_status'] = '2';
                        $this->request->data['Reimbursement']['reimbursement_bill_submission_date'] = date('Y-m-d');
                        $this->request->data['Reimbursement']['reimbursement_type_1'] = $this->request->data['Event']['activity_type'];

                        if ($this->Reimbursement->save($this->data['Reimbursement'])) {
                            /*                             * *************************Reimbursement Action ********************** */
                            $reimbursement_id = $this->Reimbursement->getLastInsertId();
                            $action_item['ActionItem']['event_id'] = $reimbursement_id;
                            $action_item['ActionItem']['action_item_level_id'] = '9'; //  for Event 
                            $action_item['ActionItem']['type_id'] = '7'; // 7 for Submission For Approval
                            // $actionitem['ActionItem']['next_action_by'] = $business_admin['Channel']['id'];
                            $action_item['ActionItem']['action_item_active'] = 'Yes';
                            $action_item['ActionItem']['action_item_status'] = '7'; //7 for Submitted For Approval table - lookup_value_action_item_statuses
                            $action_item['ActionItem']['description'] = 'Reimbursement - Submission For Approval';
                            $action_item['ActionItem']['action_item_source'] = $role_id;
                            $action_item['ActionItem']['created_by_id'] = $self_id;
                            $action_item['ActionItem']['created_by'] = $self_id;
                            $action_item['ActionItem']['dummy_status'] = $dummy_status;
                            $action_item['ActionItem']['action_industry'] = '1'; // for realestate of lookup_value_activity_industry
                            $action_item['ActionItem']['next_action_by'] = '147';
                            $this->ActionItem->save($action_item);
                            $ActionId = $this->ActionItem->getLastInsertId();

                            $this->ActionItem->id = $ActionId;
                            $this->ActionItem->saveField('parent_action_item_id', $ActionId);

                            //$last_action_id = $this->ActionItem->getLastInsertId();
                            $actionArry = $this->ActionItem->findById($ActionId);
                            $Reimbursements = $this->Reimbursement->findById($actionArry['ActionItem']['event_id']);

                            $Email = new CakeEmail();

                            $Email->viewVars(array(
                                'SubmittedBy' => $actionArry['SubmittedBy']['fname'] . ' ' . $actionArry['SubmittedBy']['mname'] . ' ' . $actionArry['SubmittedBy']['lname'],
                                'CreatedBy' => $actionArry['CreatedBy']['fname'] . ' ' . $actionArry['CreatedBy']['lname'],
                                'NextActionBy' => $actionArry['NextActionBy']['fname'] . ' ' . $actionArry['NextActionBy']['lname'],
                                'LookupReturn' => strtoupper($actionArry['LookupReturn']['value']),
                                'LookupReject' => strtoupper($actionArry['LookupReject']['value']),
                                'Return' => strtoupper($actionArry['ActionItem']['other_return']),
                                'Reject' => strtoupper($actionArry['ActionItem']['other_rejection']),
                                'ApprovalAmount' => $Reimbursements['Reimbursement']['reimbursement_amount'],
                                'SumittedDate' => date("j M, Y", strtotime($Reimbursements['Reimbursement']['created'])),
                                'ActivityLevel' => $Reimbursements['Level']['value'],
                                'ActivityWith' => $Reimbursements['Reimbursement']['reimbursement_with'],
                                'ExpenceType' => $Reimbursements['Type']['value'],
                                'ExpenceFor' => $Reimbursements['For']['value'],
                            ));

                            $to = 'infra@sumanus.com';
                            //$to = 'biswajit@wtbglobal.com';
                            $Email->template('reimbursement', 'default')->emailFormat('html')->to($to)->from('admin@silkrouters.com')->subject($Reimbursements['Level']['value'] . ' REIMBURSEMENT SUBMITTED BY - ' . strtoupper($actionArry['CreatedBy']['fname'] . ' ' . $actionArry['CreatedBy']['lname']))->send();
                        }
                    }
                    if ($this->request->data['Event']['is_follow'] == '1') {

                        $fllowup_status = '1';
                        $start_date = date('Y-m-d', strtotime($this->request->data['Event']['fllow_start_date']));
                        $end_date = date('Y-m-d', strtotime($this->request->data['Event']['fllow_end_date']));
                        $start_date = $start_date . " " . date("H:i", strtotime($this->data['Event']['fllow_start_time']));
                        $end_date = $end_date . " " . date("H:i", strtotime($this->data['Event']['fllow_end_time']));
                        $fllowup['Event']['start_date'] = $start_date;
                        $fllowup['Event']['end_date'] = $end_date;
                        $fllowup['Event']['creator_id'] = $self_id;
                        $fllowup['Event']['activity_level'] = $this->data['Event']['activity_level'];
                        $fllowup['Event']['lead_id'] = $this->data['Event']['lead_id'];
                        $fllowup['Event']['builder_id'] = $this->data['Event']['builder_id'];
                        $fllowup['Event']['project_id'] = $this->data['Event']['project_id'];


                        $fllowup['Event']['user_id'] = $self_id;
                        $fllowup['Event']['active'] = 1;
                        $fllowup['Event']['role_city'] = $city_id; // Role city
                        $fllowup['Event']['activity_industry'] = '1'; //  for Real Estate
                        $fllowup['Event']['activity_closed'] = 'No'; //  for Real Estate
                        $fllowup['Event']['activity_status'] = '2'; //  for Real Estate
                        $fllowup['Event']['event_type'] = '4'; //1 for fllowup event 
                        $fllowup['Event']['dummy_status'] = $dummy_status;
                        $fllowup['Event']['description'] = $this->data['Event']['fllow_start_time'] . '-' . $this->data['Event']['fllow_end_time'];
                        $fllowup['Event']['activity_type'] = $this->data['Event']['fllow_client_types'];
                        $fllowup['Event']['event_type_desc'] = $this->data['Event']['fllow_event_type_desc'];
                        $fllowup['Event']['event_attended_by_1'] = $this->data['Event']['fllow_event_attended_by_1'];
                        $fllowup['Event']['site_visit_project_id'] = $this->data['Event']['fllow_site_visit_project_id'];
                        $fllowup['Event']['event_attended_by_3'] = $this->data['Event']['fllow_event_attended_by_3'];
                        $fllowup['Event']['activity_completed'] = $this->data['Event']['fllow_activity_completed'];
                        $fllowup['Event']['event_level_desc'] = $this->data['Event']['fllow_event_level_desc'];
                        $fllowup['Event']['event_attended_by_2'] = $this->data['Event']['fllow_event_attended_by_2'];

                        if ($this->data['Event']['activity_level'] == '1') {
                            $fllowup['Event']['activity_type'] = $this->data['Event']['fllow_client_types'];
                        } else if ($this->data['Event']['activity_level'] == '2' || $this->data['Event']['activity_level'] == '3') {
                            $fllowup['Event']['activity_type'] = $this->data['Event']['fllow_proj_builder_types'];
                        }



                        $this->Event->query("INSERT INTO `events` (`start_date`, `end_date`, `creator_id`, `user_id`, `active`, `role_city`, `activity_industry`,  `activity_closed`, `activity_status`,  `event_type`,`dummy_status`,`description`,`activity_type`,`event_type_desc`,`event_attended_by_1`,`site_visit_project_id`,`event_attended_by_3`,`activity_completed`,`event_level_desc`,`event_attended_by_2`,`created`,`activity_level`,`lead_id`,`builder_id`,`project_id`,`modified`) VALUES ('" . $fllowup['Event']['start_date'] . "', '" . $fllowup['Event']['end_date'] . "', '" . $fllowup['Event']['creator_id'] . "', '" . $fllowup['Event']['user_id'] . "', '" . $fllowup['Event']['active'] . "', '" . $fllowup['Event']['role_city'] . "', '" . $fllowup['Event']['activity_industry'] . "', '" . $fllowup['Event']['activity_closed'] . "', '" . $fllowup['Event']['activity_status'] . "', '" . $fllowup['Event']['event_type'] . "', '" . $fllowup['Event']['dummy_status'] . "', '" . $fllowup['Event']['description'] . "', '" . $fllowup['Event']['activity_type'] . "', '" . $fllowup['Event']['event_type_desc'] . "', '" . $fllowup['Event']['event_attended_by_1'] . "', '" . $fllowup['Event']['site_visit_project_id'] . "', '" . $fllowup['Event']['event_attended_by_3'] . "', '" . $fllowup['Event']['activity_completed'] . "', '" . $fllowup['Event']['event_level_desc'] . "', '" . $fllowup['Event']['event_attended_by_2'] . "','" . date('Y-m-d h:i:s') . "', '" . $fllowup['Event']['activity_level'] . "', '" . $fllowup['Event']['lead_id'] . "', '" . $fllowup['Event']['builder_id'] . "', '" . $fllowup['Event']['project_id'] . "','" . date('Y-m-d h:i:s') . "')");

                        $Event1 = $this->Event->query("SELECT LAST_INSERT_ID()");
                        $fllowup_id = $Event1[0][0]['LAST_INSERT_ID()'];
                    }

                    // for event email
                    $eventArray = $this->Event->findById($event_id);
                    $followupArry = $this->Event->findById($fllowup_id);
                    $actionArry = $this->ActionItem->findById($ActionId);
                    $Reimbursements = $this->Reimbursement->findById($actionArry['ActionItem']['event_id']);
                    $ActivityLevel = strtoupper($eventArray['ActivityLevel']['value']);
                    $ActivityWith = strtoupper($eventArray['Lead']['lead_fname'] . ' ' . $eventArray['Lead']['lead_lname'] . $eventArray['Builder']['builder_name'] . $eventArray['Project']['project_name']);
                    if ($eventArray['Event']['activity_completed'] == '1')
                        $activityCompleted = 'Yes';
                    else
                        $activityCompleted = 'No';

                    if ($followupArry['Event']['activity_completed'] == '1')
                        $followupCompleted = 'Yes';
                    else
                        $followupCompleted = 'No';
                    $Email = new CakeEmail();
                    $Email->viewVars(array(
                        'CreatedBy' => strtoupper($eventArray['User']['fname'] . ' ' . $eventArray['User']['lname']),
                        'SumittedDate' => date("j M, Y", strtotime($eventArray['Event']['created'])),
                        'ActivityFrom' => date("F j, Y, g:i a", strtotime($eventArray['Event']['start_date'])),
                        'ActivityTo' => date("F j, Y, g:i a", strtotime($eventArray['Event']['end_date'])),
                        'ActivityCompleted' => strtoupper($activityCompleted),
                        'ActivityLevel' => strtoupper($eventArray['ActivityLevel']['value']),
                        'PastActivity' => strtoupper($eventArray['Event']['activity_past']),
                        'ActivityWith' => strtoupper($eventArray['Lead']['lead_fname'] . ' ' . $eventArray['Lead']['lead_lname'] . $eventArray['Builder']['builder_name'] . $eventArray['Project']['project_name']),
                        'ActivityType' => strtoupper($eventArray['ActivityType']['value']),
                        'ActivityDetails' => strtoupper($eventArray['Details']['value']),
                        'ActivityDescription' => strtoupper($eventArray['Event']['event_level_desc']),
                        'ActivitySite' => strtoupper($eventArray['ActivitySite']['project_name']),
                        'FollowupStatus' => $fllowup_status,
                        'StartDate' => date("F j, Y, g:i a", strtotime($followupArry['Event']['start_date'])),
                        'EndDate' => date("F j, Y, g:i a", strtotime($followupArry['Event']['end_date'])),
                        'FollowupCompleted' => strtoupper($followupCompleted),
                        'FollowupLevel' => strtoupper($followupArry['ActivityLevel']['value']),
                        'FollowupWith' => strtoupper($followupArry['Lead']['lead_fname'] . ' ' . $followupArry['Lead']['lead_lname'] . $followupArry['Builder']['builder_name'] . $followupArry['Project']['project_name']),
                        'FollowupType' => strtoupper($followupArry['ActivityType']['value']),
                        'FollowupDetails' => strtoupper($followupArry['Details']['value']),
                        'FollowupDescription' => strtoupper($followupArry['Event']['event_level_desc']),
                        'FollowupSite' => strtoupper($followupArry['ActivitySite']['project_name']),
                        'ExpenseStatus' => $Reimbursement_status,
                        'SubmittedBy' => $actionArry['SubmittedBy']['fname'] . ' ' . $actionArry['SubmittedBy']['mname'] . ' ' . $actionArry['SubmittedBy']['lname'],
                        'NextActionBy' => strtoupper($actionArry['NextActionBy']['fname'] . ' ' . $actionArry['NextActionBy']['lname']),
                        'ApprovalAmount' => $Reimbursements['Reimbursement']['reimbursement_amount'],
                        'ReimbursementSumittedDate' => date("j M, Y", strtotime($Reimbursements['Reimbursement']['created'])),
                        'ExpenseLevel' => strtoupper($Reimbursements['Level']['value']),
                        'ExpenseWith' => strtoupper($Reimbursements['Reimbursement']['reimbursement_with']),
                        'ExpenceType' => strtoupper($Reimbursements['Type']['value']),
                        'ExpenceFor' => strtoupper($Reimbursements['For']['value']),
                    ));

                    $to = 'infra@sumanus.com';
                    //$to = 'biswajit@wtbglobal.com';
                    $Email->template('Events/add', 'default')->emailFormat('html')->to($to)->from('admin@silkrouters.com')->subject($ActivityLevel . ' ACTIVITY - ' . $ActivityWith . ' (' . strtoupper($eventArray['User']['fname'] . ' ' . $eventArray['User']['lname']) . ')')->send();



                    echo '<script>
				 			var objP=parent.document.getElementsByClassName("mfp-bg");
							var objC=parent.document.getElementsByClassName("mfp-wrap");
							objP[0].style.display="none";
							objC[0].style.display="none";
							parent.location.reload(true);</script>';

                    $this->Session->setFlash(__('The event has been saved', true), 'success');
                    //$this->redirect(array('action' => 'index'));
                }
            } else {
                $this->Session->setFlash(__('The event could not be saved. Please, try again.', true), 'error');
            }
        }

        // if (in_array($self_id, array('1', '2', '3', '4', '5'))) {
        $projects = $this->Project->find('list', array('fields' => array('id', 'project_name'), 'conditions' => array('OR' => array('city_id' => array($city_id, 0))), 'order' => 'project_name ASC'));
        $this->set(compact('projects'));



        $builders = $this->Builder->find('list', array('fields' => 'Builder.id, Builder.builder_name', 'conditions' => array('OR' => array('builder_primarycity' => $city_id, 'builder_secondarycity' => $city_id, 'builder_tertiarycity' => $city_id, 'city_4' => $city_id, 'city_5' => $city_id)), 'order' => 'Builder.builder_name ASC'));
        $this->set('builders', $builders);

        $channel = $this->Channel->find('list', array('fields' => array('id', 'channel_name'), 'conditions' => array('city_id' => $city_id, 'channel_role' => $channel_role), 'order' => 'channel_name ASC'));
        $this->set(compact('channel'));

        $all_cities = $this->City->find('list', array('fields' => 'id,city_name', 'order' => 'city_name ASC'));
        $this->set(compact('all_cities'));

        if ($city_id <> 1)
            $cities = $this->City->find('list', array('fields' => 'id,city_name', 'conditions' => array('id' => $city_id), 'order' => 'city_name ASC'));
        else
            $cities = $this->City->find('list', array('fields' => 'id,city_name', 'conditions' => array('NOT' => array('id' => $city_id)), 'order' => 'city_name ASC'));
        $this->set(compact('cities'));


        $suburbs = $this->Suburb->find('list', array('fields' => array('id', 'suburb_name'), 'conditions' => array('city_id' => $city_id), 'order' => 'suburb_name ASC'));
        $this->set(compact('suburbs'));

        $user_name = array($this->Auth->user("fname") . ' ' . $this->Auth->user("lname"));
        $this->set(compact('user_name'));


        $areas = $this->Area->find('list', array('fields' => array('id', 'area_name'), 'conditions' => array('city_id' => $city_id), 'order' => 'area_name ASC'));
        $this->set(compact('areas'));

        $clients = $this->Lead->find('all', array('fields' => array('Lead.id', 'Lead.lead_fname', 'Lead.lead_lname'), 'conditions' => array('OR' => array('Lead.lead_managerprimary' => $self_id, 'Lead.lead_managersecondary' => $self_id), 'Lead.lead_fname !=""', 'Lead.lead_status' => array('4', '7', '8')), 'order' => 'Lead.lead_fname ASC'));
        $clients = Set::combine($clients, '{n}.Lead.id', array('%s %s', '{n}.Lead.lead_fname', '{n}.Lead.lead_lname'));
        $this->set('clients', $clients);


        $activity_levels = $this->LookupValueActivityLevel->find('list', array('fields' => 'id,value', 'conditions' => array('id' => array('1', '2', '3')), 'order' => 'id ASC'));
        $this->set('activity_levels', $activity_levels);

        $companies = $this->LookupCompany->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $this->set(compact('companies'));

        $client_types = $this->LookupValueActivityType->find('list', array('fields' => 'id,value', 'conditions' => array('id' => array('1', '2', '4', '6', '10')), 'order' => 'id ASC'));
        $this->set(compact('client_types'));

        $proj_builder_types = $this->LookupValueActivityType->find('list', array('fields' => 'id,value', 'conditions' => array('id' => array('1', '2', '4', '7', '9', '10')), 'order' => 'id ASC'));
        $this->set(compact('proj_builder_types'));

        $city_sub_area_types = $this->LookupValueActivityType->find('list', array('fields' => 'id,value', 'conditions' => array('id' => array('5', '7', '8', '9', '10')), 'order' => 'id ASC'));
        $this->set(compact('city_sub_area_types'));

        $company_types = $this->LookupValueActivityType->find('list', array('fields' => 'id,value', 'conditions' => array('id' => array('5', '8', '9', '10')), 'order' => 'id ASC'));
        $this->set(compact('company_types'));

        $other_types = $this->LookupValueActivityType->find('list', array('fields' => 'id,value', 'order' => 'id ASC'));
        $this->set(compact('other_types'));

        $attendes = $this->User->find('all', array('fields' => array('User.id', 'User.fname', 'User.lname'),
            'conditions' => array('User.exu_channel_id' => $channel_id)));

        $attendes = Set::combine($attendes, '{n}.User.id', array('%s %s', '{n}.User.fname', '{n}.User.lname'));
        $this->set(compact('attendes'));

        $event_type = $this->LookupValueReimbursementType_1->find('list', array('fields' => 'id,value', 'order' => 'id ASC'));
        $this->set(compact('event_type'));

        $bill_type = $this->LookupValueBillStatus->find('list', array('fields' => 'id,value', 'order' => 'id ASC'));
        $this->set(compact('bill_type'));

        $bill_status = $this->LookupValueBillType->find('list', array('fields' => 'id,value', 'order' => 'id ASC'));
        $this->set(compact('bill_status'));

        $submitted_to = $this->User->find('all', array('fields' => array('User.id', 'User.fname', 'User.lname'),
            'conditions' => array('User.id' => $submitted_to)));

        $submitted_to = Set::combine($submitted_to, '{n}.User.id', array('%s %s', '{n}.User.fname', '{n}.User.lname'));
        $this->set(compact('submitted_to'));

        //$log = $this->User->getDataSource()->getLog(false, false);       
        //  debug($log);
    }

    function edit($id = NULL) {
        // $this->layout = 'ajax';
        $channel_id = $this->Session->read("channel_id");
        $channels = $this->Channel->findById($channel_id);
        $channel_role = $channels['Channel']['channel_role'];
        $city_id = $channels['Channel']['city_id'];
        $self_id = $this->Auth->user("id");

        $events = $this->Event->findById($id);
        if ($this->request->is('post') || $this->request->is('put')) {

            if ($this->data['Event']['activity_past'] == 'Yes') {
                $start_date = date('Y-m-d', strtotime($this->request->data['Event']['start_date_past']));
                $end_date = date('Y-m-d', strtotime($this->request->data['Event']['end_date_past']));
            } else {
                $start_date = date('Y-m-d', strtotime($this->request->data['Event']['start_date_present']));
                $end_date = date('Y-m-d', strtotime($this->request->data['Event']['end_date_present']));
            }

            $start_date = $start_date . " " . date("H:i", strtotime($this->data['Event']['start_time']));
            $end_date = $end_date . " " . date("H:i", strtotime($this->data['Event']['end_time']));

            $this->request->data['Event']['start_date'] = $start_date;
            $this->request->data['Event']['end_date'] = $end_date;

            $this->request->data['Event']['description'] = $this->data['Event']['start_time'] . '-' . $this->data['Event']['end_time'];

            $this->Event->id = $id;
            $this->Event->set($this->data);
            if ($this->Event->validates() == true) {
                if ($this->Event->save($this->request->data)) {
                    $this->Session->setFlash('Event has been saved.', 'success');
                    $this->redirect(array('controller' => 'events', 'action' => 'edit/' . $id));
                } else {
                    $this->Session->setFlash('Unable to add Event.', 'failure');
                }
            }
        }


        //  if (in_array($self_id, array('1', '2', '3', '4', '5'))) {
        $projects = $this->Project->find('list', array('fields' => array('id', 'project_name'), 'conditions' => array('OR' => array('city_id' => array($city_id, 0))), 'order' => 'project_name ASC'));
        $this->set(compact('projects'));

        $builders = $this->Builder->find('list', array('fields' => 'Builder.id, Builder.builder_name', 'conditions' => array('OR' => array('builder_primarycity' => $city_id, 'builder_secondarycity' => $city_id, 'builder_tertiarycity' => $city_id, 'city_4' => $city_id, 'city_5' => $city_id)), 'order' => 'Builder.builder_name ASC'));
        $this->set('builders', $builders);

        $attendes = $this->User->find('all', array('fields' => array('User.id', 'User.fname', 'User.lname'),
            'conditions' => array('User.exu_channel_id' => $channel_id)));
        $attendes = Set::combine($attendes, '{n}.User.id', array('%s %s', '{n}.User.fname', '{n}.User.lname'));
        $this->set(compact('attendes'));

        $clients = $this->Lead->find('all', array('fields' => array('Lead.id', 'Lead.lead_fname', 'Lead.lead_lname'), 'conditions' => array('OR' => array('Lead.lead_managerprimary' => $self_id, 'Lead.lead_managersecondary' => $self_id), 'Lead.lead_fname !=""', 'Lead.lead_status' => array('4', '7', '8')), 'order' => 'Lead.lead_fname ASC'));
        $clients = Set::combine($clients, '{n}.Lead.id', array('%s %s', '{n}.Lead.lead_fname', '{n}.Lead.lead_lname'));
        $this->set('clients', $clients);

        $activity_levels = $this->LookupValueActivityLevel->find('list', array('fields' => 'id,value', 'conditions' => array('id' => array('1', '2', '3')), 'order' => 'id ASC'));

        $this->set('activity_levels', $activity_levels);
        $activity_types = $this->LookupValueActivityType->find('list', array('fields' => 'id,value', 'order' => 'id ASC'));
        $activity_types = $this->LookupValueActivityType->find('list', array('fields' => 'id,value', 'order' => 'id ASC'));
        $this->set(compact('activity_types'));

        $activity_details = $this->LookupValueActivityDetail->find('list', array(
            'conditions' => array(
                'type_id' => $events['Event']['activity_level']
            ),
            'fields' => 'id, value',
            'order' => 'value ASC'
        ));

        $this->set(compact('activity_details'));

        $Reimbursements = $this->Reimbursement->find('all', array('conditions' => array('Reimbursement.reimbursement_event_id' => $id)));
        $this->set(compact('Reimbursements'));

        if (!$this->request->data) {
            $this->request->data = $events;
        }
    }

    function view($id = NULL) {
        $this->layout = '';
        $flag = 0;
        $cur_date = date('Y-m-d h:i:s');

        $events = $this->Event->findById($id);

        $self_id = $this->Auth->user("id");

        if ($cur_date > $events['Event']['end_date'] && $events['Event']['activity_completed'] == '2') //2 for no of lookup_value_statuses
            $flag = 1;
        if ($cur_date > $events['Event']['end_date'] && $events['Event']['activity_completed'] == '1')  //1 for yes of lookup_value_statuses
            $flag = 2;

        $this->set(compact('flag'));


        // if (in_array($self_id, array('1', '2', '3', '4', '5'))) {
        $projects = $this->Project->find('list', array('fields' => array('id', 'project_name')));
        $this->set(compact('projects'));

        $builders = $this->Builder->find('list', array('fields' => 'Builder.id, Builder.builder_name', 'order' => 'Builder.builder_name ASC'));
        $this->set('builders', $builders);
        //  }
        $activity_levels = $this->LookupValueActivityLevel->find('list', array('fields' => 'id,value', 'conditions' => array('id' => array('1', '2', '3')), 'order' => 'id ASC'));
        $this->set('activity_levels', $activity_levels);
        $activity_types = $this->LookupValueActivityType->find('list', array('fields' => 'id,value', 'order' => 'id ASC'));
        $this->set('activity_types', $activity_types);
        if (!$this->request->data) {
            $this->request->data = $events;
        }
    }

}

?>

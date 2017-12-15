<?php

/**
 * Deals controller.
 *
 * This file will render views from views/deals/
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
 * Deals controller
 *
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
App::uses('CakeEmail', 'Network/Email');

class DealsController extends AppController {

    public $uses = array('Deal','Channel','ActionItemType','ActionItem','LookupValueLeadTransactionType','Project','MarketingPartner','Lead','LookupUnitCommissionEvent','LookupValueDealBillingType');

    public function index() {

        $dummy_status = $this->Auth->user('dummy_status');
        $channel_id = $this->Session->read("channel_id");
        $role_id = $this->Session->read("role_id");
        $user_id = $this->Auth->user('id');

        $search_condition = array();
        $builder_contact_name = '';
        $builder_contact_builder_id = '';
        $builder_contact_location = '';
        $builder_contact_level = '';
        $builder_contact_company = '';
        $builder_contact_company_city = '';


        if ($this->request->is('post') || $this->request->is('put')) {
            if (!empty($this->data['BuilderContact']['builder_contact_name'])) {
                $builder_contact_name = $this->data['BuilderContact']['builder_contact_name'];
                array_push($search_condition, array('OR' => array('Builder.builder_name' . ' LIKE' => mysql_escape_string(trim(strip_tags($builder_contact_name))) . "%", 'BuilderContact.builder_contact_name' . ' LIKE' => mysql_escape_string(trim(strip_tags($builder_contact_name))) . "%")));
                //array_push($search_condition, array('BuilderContact.builder_contact_name' . ' LIKE' => mysql_escape_string(trim(strip_tags($builder_contact_name))) . "%"));
            }
            if (!empty($this->data['BuilderContact']['builder_contact_builder_id'])) {
                $builder_contact_builder_id = $this->data['BuilderContact']['builder_contact_builder_id'];
                array_push($search_condition, array('BuilderContact.builder_contact_builder_id' => $builder_contact_builder_id));
            }
            if (!empty($this->data['BuilderContact']['builder_contact_level'])) {
                $builder_contact_level = $this->data['BuilderContact']['builder_contact_level'];
                array_push($search_condition, array('BuilderContact.builder_contact_level' => $builder_contact_level));
            }
            if (!empty($this->data['BuilderContact']['builder_contact_location'])) {
                $builder_contact_location = $this->data['BuilderContact']['builder_contact_location'];
                array_push($search_condition, array('BuilderContact.builder_contact_location' => $builder_contact_location));
            }
            if (!empty($this->data['BuilderContact']['builder_contact_company'])) {
                $builder_contact_company = $this->data['BuilderContact']['builder_contact_company'];
                array_push($search_condition, array('BuilderContact.builder_contact_company' => $builder_contact_company));
            }
            if (!empty($this->data['BuilderContact']['builder_contact_company_city'])) {
                $builder_contact_company_city = $this->data['BuilderContact']['builder_contact_company_city'];
                array_push($search_condition, array('BuilderContact.builder_contact_company_city' => $builder_contact_company_city));
            }
        } elseif ($this->request->is('get')) {

            if (!empty($this->request->params['named']['builder_contact_name'])) {
                $builder_contact_name = $this->request->params['named']['builder_contact_name'];
                array_push($search_condition, array("BuilderContact.builder_contact_name LIKE '%$builder_contact_name%'"));
            }

            if (!empty($this->request->params['named']['builder_contact_builder_id'])) {
                $builder_contact_builder_id = $this->request->params['named']['builder_contact_builder_id'];
                array_push($search_condition, array('BuilderContact.builder_contact_builder_id' => $builder_contact_builder_id));
            }
            if (!empty($this->request->params['named']['builder_contact_level'])) {
                $builder_contact_level = $this->request->params['named']['builder_contact_level'];
                array_push($search_condition, array('BuilderContact.builder_contact_level' => $builder_contact_level));
            }
            if (!empty($this->request->params['named']['builder_contact_location'])) {
                $builder_contact_location = $this->request->params['named']['builder_contact_location'];
                array_push($search_condition, array('BuilderContact.builder_contact_location' => $builder_contact_location));
            }
            if (!empty($this->request->params['named']['builder_contact_company'])) {
                $builder_contact_company = $this->request->params['named']['builder_contact_company'];
                array_push($search_condition, array('BuilderContact.builder_contact_company' => $builder_contact_company));
            }
            if (!empty($this->request->params['named']['builder_contact_company_city'])) {
                $builder_contact_company_city = $this->request->params['named']['builder_contact_company_city'];
                array_push($search_condition, array('BuilderContact.builder_contact_company_city' => $builder_contact_company_city));
            }
        }




        if ($dummy_status) {
            array_push($search_condition, array('Deal.dummy_status' => $dummy_status,'Deal.created_by' => $user_id));
        }
        // pr($this->params);


        if (count($this->params['pass'])) {

            $aaray = explode(':', $this->params['pass'][0]);
            $field = $aaray[0];
            $value = $aaray[1];
            array_push($search_condition, array('Deal.' . $field => $value)); // when builder is approve/pending
        }

        $this->paginate['order'] = array('Deal.created' => 'asc');

        $this->set('Deals', $this->paginate("Deal", $search_condition));


        

        //$log = $this->BuilderContact->getDataSource()->getLog(false, false);       
        // debug($log);

        

        if (!isset($this->passedArgs['builder_contact_builder_id']) && empty($this->passedArgs['builder_contact_builder_id'])) {
            $this->passedArgs['builder_contact_builder_id'] = (isset($this->data['BuilderContact']['builder_contact_builder_id'])) ? $this->data['BuilderContact']['builder_contact_builder_id'] : '';
        }
        if (!isset($this->passedArgs['builder_contact_name']) && empty($this->passedArgs['builder_contact_name'])) {
            $this->passedArgs['builder_contact_name'] = (isset($this->data['BuilderContact']['builder_contact_name'])) ? $this->data['BuilderContact']['builder_contact_name'] : '';
        }
        if (!isset($this->passedArgs['builder_contact_level']) && empty($this->passedArgs['builder_contact_level'])) {
            $this->passedArgs['builder_contact_level'] = (isset($this->data['BuilderContact']['builder_contact_level'])) ? $this->data['BuilderContact']['builder_contact_level'] : '';
        }
        if (!isset($this->passedArgs['builder_contact_location']) && empty($this->passedArgs['builder_contact_location'])) {
            $this->passedArgs['builder_contact_location'] = (isset($this->data['BuilderContact']['builder_contact_location'])) ? $this->data['BuilderContact']['builder_contact_location'] : '';
        }
        if (!isset($this->passedArgs['builder_contact_company']) && empty($this->passedArgs['builder_contact_company'])) {
            $this->passedArgs['builder_contact_company'] = (isset($this->data['BuilderContact']['builder_contact_company'])) ? $this->data['BuilderContact']['builder_contact_company'] : '';
        }
        if (!isset($this->passedArgs['builder_contact_company_city']) && empty($this->passedArgs['builder_contact_company_city'])) {
            $this->passedArgs['builder_contact_company_city'] = (isset($this->data['BuilderContact']['builder_contact_company_city'])) ? $this->data['BuilderContact']['builder_contact_company_city'] : '';
        }
        if (!isset($this->data) && empty($this->data)) {
            $this->data['BuilderContact']['builder_contact_name'] = $this->passedArgs['builder_contact_name'];
            $this->data['BuilderContact']['builder_name'] = $this->passedArgs['builder_name'];
            $this->data['BuilderContact']['builder_contact_level'] = $this->passedArgs['builder_contact_level'];
            $this->data['BuilderContact']['builder_contact_location'] = $this->passedArgs['builder_contact_location'];
            $this->data['BuilderContact']['builder_contact_company'] = $this->passedArgs['builder_contact_company'];
            $this->data['BuilderContact']['builder_contact_company_city'] = $this->passedArgs['builder_contact_company_city'];
        }

        $this->set(compact('builder_contact_builder_id'));
        $this->set(compact('builder_contact_name'));
        $this->set(compact('builder_contact_level'));
        $this->set(compact('builder_contact_location'));
        $this->set(compact('builder_contact_company'));
        $this->set(compact('builder_contact_company_city'));
    }
    function add($id = null) {

        $dummy_status = $this->Auth->user('dummy_status');
        $channel_id = $this->Session->read("channel_id");
        $channels = $this->Channel->findById($channel_id);
        $channel_head = $channels['Channel']['channel_head'];
        $city_id = $channels['Channel']['city_id'];
        $role_id = $this->Session->read("role_id");
        $user_id = $this->Auth->user('id');


        if ($this->request->is('post') || $this->request->is('put')) {

                $this->request->data['Deal']['dummy_status'] = $dummy_status;
                $this->request->data['Deal']['deal_status'] = '1';  // 1 for Yes of lookup_deal_status
                $this->request->data['Deal']['created_by'] = $user_id;
              
                $billing_type = $this->data['Deal']['deal_billing_type'];


                if ($this->data['Deal']['deal_booking_date'])
                    $this->request->data['Deal']['deal_booking_date'] = date('Y-m-d', strtotime($this->data['Deal']['deal_booking_date']));
                if ($this->data['Deal']['deal_expected_invoice_date'])
                    $this->request->data['Deal']['deal_expected_invoice_date'] = date('Y-m-d', strtotime($this->data['Deal']['deal_expected_invoice_date']));
                if ($this->data['Deal']['deal_actual_invoice_date'])
                    $this->request->data['Deal']['deal_actual_invoice_date'] = date('Y-m-d', strtotime($this->data['Deal']['deal_actual_invoice_date']));

                $leads = $this->Lead->findById($this->data['Deal']['deal_id'], array('Lead.lead_source'));
                if ($leads['Lead']['lead_source'] == 3) {
                    $action_item['ActionItem']['action_item_level_id'] = '10'; // old client
                } else {
                    $action_item['ActionItem']['action_item_level_id'] = '1'; // new client
                }

                $this->Deal->set($this->data['Deal']);
                if ($this->Deal->validates() == true) {
                    if ($this->Deal->save($this->request->data['Deal'])) {

                        $deal_id = $this->Deal->getLastInsertId();
                        if ($deal_id) {

                      
                            /*
                             * ****************** Remarks **************************
                             * ****** */
                            $remarks['Remark']['lead_id'] = $this->data['Deal']['deal_id'];
                            $remarks['Remark']['remarks'] = 'New Action Record Created';
                            $remarks['Remark']['remarks_by'] = $user_id;
                            $remarks['Remark']['created_by'] = $user_id;
                            $remarks['Remark']['remarks_time'] = date('g:i A');
                            $remarks['Remark']['remarks_level'] = '10'; //10 for Deal from lookup_value_remarks_level
                            $remarks['Remark']['dummy_status'] = $dummy_status;
                            $this->Remark->save($remarks);


                            /*
                             * ***********************Marketing Partner Action ******************
                             * ** */
                            $action_item['ActionItem']['lead_id'] = $this->data['Deal']['deal_id'];

                            $action_item['ActionItem']['type_id'] = '18'; // 7 for Submission For Approval
                            $action_item['ActionItem']['action_item_active'] = 'Yes';
                            $action_item['ActionItem']['action_item_status'] = '21'; //7 for Submitted For Approval table - lookup_value_action_item_statuses
                            $action_item['ActionItem']['description'] = 'Client Action  Record Created - Submission For Approval';
                            $action_item['ActionItem']['action_item_source'] = $role_id;
                            $action_item['ActionItem']['created_by_id'] = $user_id;
                            $action_item['ActionItem']['created_by'] = $user_id;
                            $action_item['ActionItem']['dummy_status'] = $dummy_status;
                            $action_item['ActionItem']['next_action_by'] = '136'; // overseeing
                            $action_item['ActionItem']['parent_action_item_id'] = $parent_action_item_id;
                            $this->ActionItem->save($action_item);
                            $ActionId = $this->ActionItem->getLastInsertId();
                            //$this->ActionItem->id = $ActionId;
                            // $this->ActionItem->saveField('parent_action_item_id', $ActionId);



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

        $leads = $this->Lead->find('all', array('fields' => array('Lead.id', 'Lead.lead_fname', 'Lead.lead_lname', 'Lead.created'), 'conditions' => array('Lead.dummy_status' => $dummy_status, 'Lead.lead_status' => '4')));
        $leads = Set::combine($leads, '{n}.Lead.id', array('%s %s - Arrival Date: %s', '{n}.Lead.lead_fname', '{n}.Lead.lead_lname', '{n}.Lead.created'));
        $this->set(compact('leads'));


        $commission_event = $this->LookupUnitCommissionEvent->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('commission_event'));

        $billing_types = $this->LookupValueDealBillingType->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('billing_types'));

    }
}


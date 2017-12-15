<?php

/**
 * Marketing Partner controller.
 *
 * This file will render views from views/MarketingPartners/
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
Configure::write('Config.timezone', 'Europe/London');

/**
 * Marketing Partner controller
 *
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class MarketingPartnersController extends AppController {

    public $uses = array('MarketingPartner', 'Builder', 'Area', 'Suburb', 'City', 'LookupBuilderAgreementLevel', 'LookupBuilderAgreementProposed', 'LookupBuilderAgreementManagedBy', 'LookupBuilderAgreementIntiatedBy', 'LookupBuilderAgreementPreparedBy', 'LookupBuilderAgreementCommissionBasedOn', 'LookupBuilderAgreementCommissionTerm', 'LookupValueLeadsCountry', 'BuilderAgreement', 'BuilderContact', 'LookupBuilderContactStatus', 'ActionItem', 'Project', 'ProjectAgreement', 'Channel', 'User', 'LookupBuilderContactLevel', 'LookupBuilderContactInitiatedBy', 'LookupBuilderContactManagedBy', 'LookupBuilderContactPreparedBy', 'LookupBuilderAgreementStatuse', 'ActionItem', 'BuilderLegalName', 'LookupBuilderAgreementDoneWith', 'MarketingPartner', 'LookupCompany', 'Remark');
    public $components = array('Sms');

    public function index() {

        $dummy_status = $this->Auth->user('dummy_status');
        $city_id = $this->Auth->user('city_id');
        $role_id = $this->Session->read("role_id");
        $marketing_partner_display_name = '';
        $marketing_partner_primarycity = '';
        $search_condition = array();
        $channel_id = $this->Session->read("channel_id");
        $channel_id = $this->Channel->findById($channel_id);
        $channel_city_id = $channel_id['Channel']['city_id'];

        if ($this->request->is('post') || $this->request->is('put')) {

            if (!empty($this->data['MarketingPartner']['marketing_partner_display_name'])) {
                $marketing_partner_display_name = $this->data['MarketingPartner']['marketing_partner_display_name'];
                array_push($search_condition, array('MarketingPartner.marketing_partner_display_name' . ' LIKE' => "%" . mysql_escape_string(trim(strip_tags($marketing_partner_display_name))) . "%"));
            }

            if (!empty($this->data['MarketingPartner']['marketing_partner_primarycity'])) {
                $marketing_partner_primarycity = $this->data['MarketingPartner']['marketing_partner_primarycity'];
                array_push($search_condition, array('MarketingPartner.marketing_partner_primarycity' => $marketing_partner_primarycity));
            }
        } elseif ($this->request->is('get')) {

            if (!empty($this->request->params['named']['marketing_partner_display_name'])) {
                $marketing_partner_display_name = $this->request->params['named']['marketing_partner_display_name'];
                array_push($search_condition, array("MarketingPartner.marketing_partner_display_name LIKE '%$marketing_partner_display_name%'"));
            }

            if (!empty($this->request->params['named']['marketing_partner_primarycity'])) {
                $marketing_partner_primarycity = $this->request->params['named']['marketing_partner_primarycity'];
                array_push($search_condition, array('MarketingPartner.marketing_partner_primarycity' => $marketing_partner_primarycity));
            }
        }




        if ($dummy_status) {
            array_push($search_condition, array('MarketingPartner.dummy_status' => $dummy_status, 'MarketingPartner.marketing_partner_status' => '1'));
        }
        if (count($this->params['pass'])) {

            $aaray = explode(':', $this->params['pass'][0]);
            $field = $aaray[0];
            $value = $aaray[1];
            array_push($search_condition, array('MarketingPartner.' . $field => $value)); // when builder is approve/pending
        }


        $this->paginate['order'] = array('MarketingPartner.created' => 'asc');

        $this->set('MarketingPartners', $this->paginate("MarketingPartner", $search_condition));

        //$log = $this->Builder->getDataSource()->getLog(false, false);       
        //debug($log);
        //die;


        if ($role_id == '15') { // Accounts User.
            if ($channel_city_id == '2') {

                $all_count = $this->MarketingPartner->find('count', array('conditions' => array('OR' => array(
                            'MarketingPartner.marketing_partner_primarycity' => $channel_city_id,
                            'MarketingPartner.marketing_partner_secondarycity' => $channel_city_id,
                            'MarketingPartner.marketing_partner_tertiarycity' => $channel_city_id,
                            'MarketingPartner.marketing_partner_city_4' => $channel_city_id,
                            'MarketingPartner.marketing_partner_city_5' => $channel_city_id,
                        ), 'MarketingPartner.dummy_status' => $dummy_status)));

                $approve = $this->MarketingPartner->find('count', array('conditions' => array('OR' => array(
                            'MarketingPartner.marketing_partner_primarycity' => $channel_city_id,
                            'MarketingPartner.marketing_partner_secondarycity' => $channel_city_id,
                            'MarketingPartner.marketing_partner_tertiarycity' => $channel_city_id,
                            'MarketingPartner.marketing_partner_city_4' => $channel_city_id,
                            'MarketingPartner.marketing_partner_city_5' => $channel_city_id,
                        ), 'MarketingPartner.marketing_partner_approved' => '1', 'MarketingPartner.dummy_status' => $dummy_status)));

                $pending = $this->MarketingPartner->find('count', array('conditions' => array('OR' => array(
                            'MarketingPartner.marketing_partner_primarycity' => $channel_city_id,
                            'MarketingPartner.marketing_partner_secondarycity' => $channel_city_id,
                            'MarketingPartner.marketing_partner_tertiarycity' => $channel_city_id,
                            'MarketingPartner.marketing_partner_city_4' => $channel_city_id,
                            'MarketingPartner.city_5' => $channel_city_id,
                        ), 'MarketingPartner.marketing_partner_approved' => '2', 'MarketingPartner.dummy_status' => $dummy_status)));
            } else {

                $all_count = $this->MarketingPartner->find('count', array('conditions' => array('NOT' => array(
                            'MarketingPartner.marketing_partner_primarycity' => 2,
                            'MarketingPartner.marketing_partner_secondarycity' => 2,
                            'MarketingPartner.marketing_partner_tertiarycity' => 2,
                            'MarketingPartner.marketing_partner_city_4' => 2,
                            'MarketingPartner.marketing_partner_city_5' => 2,
                        ), 'MarketingPartner.dummy_status' => $dummy_status)));

                $approve = $this->MarketingPartner->find('count', array('conditions' => array('NOT' => array(
                            'MarketingPartner.marketing_partner_primarycity' => 2,
                            'MarketingPartner.marketing_partner_secondarycity' => 2,
                            'MarketingPartner.marketing_partner_tertiarycity' => 2,
                            'MarketingPartner.marketing_partner_city_4' => 2,
                            'MarketingPartner.marketing_partner_city_5' => 2,
                        ), 'MarketingPartner.marketing_partner_approved' => '1', 'MarketingPartner.dummy_status' => $dummy_status)));

                $pending = $this->MarketingPartner->find('count', array('conditions' => array('NOT' => array(
                            'MarketingPartner.marketing_partner_primarycity' => 2,
                            'MarketingPartner.marketing_partner_secondarycity' => 2,
                            'MarketingPartner.marketing_partner_tertiarycity' => 2,
                            'MarketingPartner.marketing_partner_city_4' => 2,
                            'MarketingPartner.marketing_partner_city_5' => 2,
                        ), 'MarketingPartner.marketing_partner_approved' => '2', 'MarketingPartner.dummy_status' => $dummy_status)));
            }
        } else {

            if ($channel_city_id == '1') {

                $all_count = $this->MarketingPartner->find('count', array('conditions' => array('MarketingPartner.dummy_status' => $dummy_status)));
                $approve = $this->MarketingPartner->find('count', array('conditions' => array('MarketingPartner.marketing_partner_approved' => '1', 'MarketingPartner.dummy_status' => $dummy_status)));
                $pending = $this->MarketingPartner->find('count', array('conditions' => array('MarketingPartner.marketing_partner_approved' => '2', 'MarketingPartner.dummy_status' => $dummy_status)));
            } else {

                $all_count = $this->MarketingPartner->find('count', array('conditions' => array('OR' => array(
                            'MarketingPartner.marketing_partner_primarycity' => $channel_city_id,
                            'MarketingPartner.marketing_partner_secondarycity' => $channel_city_id,
                            'MarketingPartner.marketing_partner_tertiarycity' => $channel_city_id,
                            'MarketingPartner.marketing_partner_city_4' => $channel_city_id,
                            'MarketingPartner.marketing_partner_city_5' => $channel_city_id,
                        ), 'MarketingPartner.dummy_status' => $dummy_status)));

                $approve = $this->MarketingPartner->find('count', array('conditions' => array('OR' => array(
                            'MarketingPartner.marketing_partner_primarycity' => $channel_city_id,
                            'MarketingPartner.marketing_partner_secondarycity' => $channel_city_id,
                            'MarketingPartner.marketing_partner_tertiarycity' => $channel_city_id,
                            'MarketingPartner.marketing_partner_city_4' => $channel_city_id,
                            'MarketingPartner.marketing_partner_city_5' => $channel_city_id,
                        ), 'MarketingPartner.marketing_partner_approved' => '1', 'MarketingPartner.dummy_status' => $dummy_status)));

                $pending = $this->MarketingPartner->find('count', array('conditions' => array('OR' => array(
                            'MarketingPartner.marketing_partner_primarycity' => $channel_city_id,
                            'MarketingPartner.marketing_partner_secondarycity' => $channel_city_id,
                            'MarketingPartner.marketing_partner_tertiarycity' => $channel_city_id,
                            'MarketingPartner.marketing_partner_city_4' => $channel_city_id,
                            'MarketingPartner.marketing_partner_city_5' => $channel_city_id,
                        ), 'MarketingPartner.marketing_partner_approved' => '2', 'MarketingPartner.dummy_status' => $dummy_status)));
            }
        }


        $this->set(compact('all_count'));
        $this->set(compact('approve'));
        $this->set(compact('pending'));


        $multicity_count = $this->MarketingPartner->find('count', array(
            'conditions' => array('OR' => array(
                    'MarketingPartner.marketing_partner_primarycity' => $channel_city_id,
                    'MarketingPartner.marketing_partner_secondarycity' => $channel_city_id,
                    'MarketingPartner.marketing_partner_tertiarycity' => $channel_city_id,
                    'MarketingPartner.marketing_partner_city_4' => $channel_city_id,
                    'MarketingPartner.marketing_partner_city_5' => $channel_city_id,
                ),
                'MarketingPartner.marketing_partner_approved' => '1',
                'MarketingPartner.dummy_status' => $dummy_status,
            ),
        ));
        $this->set(compact('multicity_count'));

        $city = $this->City->find('list', array('fields' => 'City.id, City.city_name', 'conditions' => array('City.dummy_status' => $dummy_status, 'City.city_status' => '1'), 'order' => 'City.city_name ASC'));
        $this->set('city', $city);
        
        $codes = $this->LookupValueLeadsCountry->find('all', array('fields' => array('LookupValueLeadsCountry.id', 'LookupValueLeadsCountry.value', 'LookupValueLeadsCountry.code')));
        $codes = Set::combine($codes, '{n}.LookupValueLeadsCountry.id', array('%s: %s', '{n}.LookupValueLeadsCountry.value', '{n}.LookupValueLeadsCountry.code'));
        $this->set(compact('codes'));

        $partners = $this->MarketingPartner->find('list', array('fields' => 'id, marketing_partner_display_name', 'order' => 'marketing_partner_display_name ASC'));
        $this->set(compact('partners'));

        if (!isset($this->passedArgs['marketing_partner_display_name']) && empty($this->passedArgs['marketing_partner_display_name'])) {
            $this->passedArgs['marketing_partner_display_name'] = (isset($this->data['MarketingPartner']['marketing_partner_display_name'])) ? $this->data['MarketingPartner']['marketing_partner_display_name'] : '';
        }
        if (!isset($this->passedArgs['marketing_partner_primarycity']) && empty($this->passedArgs['marketing_partner_primarycity'])) {
            $this->passedArgs['marketing_partner_primarycity'] = (isset($this->data['MarketingPartner']['marketing_partner_primarycity'])) ? $this->data['MarketingPartner']['marketing_partner_primarycity'] : '';
        }

        if (!isset($this->data) && empty($this->data)) {
            $this->data['MarketingPartner']['marketing_partner_display_name'] = $this->passedArgs['marketing_partner_display_name'];
            $this->data['MarketingPartner']['marketing_partner_primarycity'] = $this->passedArgs['marketing_partner_primarycity'];
        }

        $this->set(compact('marketing_partner_display_name'));
        $this->set(compact('marketing_partner_primarycity'));
    }

    public function add() {

        $user_id = $this->Auth->user('id');
        $role_id = $this->Session->read("role_id");
        $dummy_status = $this->Auth->user('dummy_status');
        $channel_id = $this->Session->read("channel_id");
        $channels = $this->Channel->findById($channel_id);
        $city_id = $channels['Channel']['city_id'];


        if ($this->request->is('post') || $this->request->is('put')) {


            $this->request->data['MarketingPartner']['dummy_status'] = $dummy_status;
            $this->request->data['MarketingPartner']['marketing_partner_approved'] = '2';
            $this->request->data['MarketingPartner']['marketing_partner_status'] = '1';  // 1 for Yes of lookup_value_statuses
            $this->request->data['MarketingPartner']['created_by'] = $user_id;

            if ($this->data['MarketingPartner']['marketing_partner_boardnumber_code'] == '')
                $this->request->data['MarketingPartner']['marketing_partner_boardnumber_code'] = '';


            // $this->MarketingPartner->create();
            $this->MarketingPartner->set($this->data['MarketingPartner']);
            if ($this->MarketingPartner->validates() == true) {
                if ($this->MarketingPartner->save($this->request->data['MarketingPartner'])) {

                    $marketing_partner_id = $this->MarketingPartner->getLastInsertId();
                    if ($marketing_partner_id) {

                        /*
                         * ****************** Remarks **************************
                         * ****** */
                        $remarks['Remark']['marketing_partner_id'] = $marketing_partner_id;
                        $remarks['Remark']['remarks'] = 'New Builder Record Created';
                        $remarks['Remark']['remarks_by'] = $user_id;
                        $remarks['Remark']['created_by'] = $user_id;
                        $remarks['Remark']['remarks_time'] = date('g:i A');
                        $remarks['Remark']['remarks_level'] = '9'; //9 for Marketing Partner from lookup_value_remarks_level
                        $remarks['Remark']['dummy_status'] = $dummy_status;
                        $this->Remark->save($remarks);

                        /*
                         * *******************Builder Contacts**********************
                         * ** */
                        if ($this->data['MarketingPartner']['is_contact']) {

                            $contact_action_item['ActionItem']['action_item_level_id'] = '5'; //  for Builder Contact
                            $contact_action_item['ActionItem']['type_id'] = '7'; // 7 for Submission For Approval
                            $contact_action_item['ActionItem']['next_action_by'] = '148'; // system desk
                            $contact_action_item['ActionItem']['action_item_active'] = 'Yes';
                            $contact_action_item['ActionItem']['action_item_status'] = '7'; //1 for created table - lookup_value_action_item_statuses
                            $contact_action_item['ActionItem']['description'] = 'Buillder Contact  Record Created - Submission For Approval';
                            $contact_action_item['ActionItem']['action_item_source'] = $role_id;
                            $contact_action_item['ActionItem']['created_by_id'] = $user_id;
                            $contact_action_item['ActionItem']['created_by'] = $user_id;
                            $contact_action_item['ActionItem']['dummy_status'] = $dummy_status;
                            $this->request->data['BuilderContact']['created_by'] = $user_id;
                            $this->request->data['BuilderContact']['dummy_status'] = $dummy_status;
                            $this->request->data['BuilderContact']['contact_type'] = '1'; // for marketing partner
                            $this->request->data['BuilderContact']['builder_partner_id'] = $marketing_partner_id;

                            if ($this->BuilderContact->save($this->request->data['BuilderContact'])) {
                                $builder_contact_id = $this->BuilderContact->getLastInsertId();

                                $this->ActionItem->query("INSERT INTO `action_items` (`action_item_level_id`, `type_id`, `builder_contact_id`, `action_item_status`, `action_item_source`, `created_by_id`, `action_item_active`,  `description`, `next_action_by`,  `created_by`,`dummy_status`,`created`) VALUES ('" . $contact_action_item['ActionItem']['action_item_level_id'] . "', '" . $contact_action_item['ActionItem']['type_id'] . "', '" . $builder_contact_id . "', '" . $contact_action_item['ActionItem']['action_item_status'] . "', '" . $contact_action_item['ActionItem']['action_item_source'] . "', '" . $contact_action_item['ActionItem']['created_by_id'] . "', '" . $contact_action_item['ActionItem']['action_item_active'] . "', '" . $contact_action_item['ActionItem']['description'] . "', '" . $contact_action_item['ActionItem']['next_action_by'] . "', '" . $contact_action_item['ActionItem']['created_by'] . "', '" . $contact_action_item['ActionItem']['dummy_status'] . "','" . date('Y-m-d h:i:s') . "')");


                                $ActionId1 = $this->ActionItem->query("SELECT LAST_INSERT_ID()");
                                $last_id = $ActionId1[0][0]['LAST_INSERT_ID()'];

                                $this->ActionItem->updateAll(array('ActionItem.parent_action_item_id' => $last_id), array('ActionItem.id' => $last_id));
                            }
                        }

                        /*
                         * ***********************Marketing Partner Action ******************
                         * ** */
                        $action_item['ActionItem']['marketing_partner_id'] = $marketing_partner_id;
                        $action_item['ActionItem']['action_item_level_id'] = '14'; //  for Marketing Partner 
                        $action_item['ActionItem']['type_id'] = '7'; // 7 for Submission For Approval
                        $action_item['ActionItem']['action_item_active'] = 'Yes';
                        $action_item['ActionItem']['action_item_status'] = '7'; //7 for Submitted For Approval table - lookup_value_action_item_statuses
                        $action_item['ActionItem']['description'] = 'Marketing Partner  Record Created - Submission For Approval';
                        $action_item['ActionItem']['action_item_source'] = $role_id;
                        $action_item['ActionItem']['created_by_id'] = $user_id;
                        $action_item['ActionItem']['created_by'] = $user_id;
                        $action_item['ActionItem']['dummy_status'] = $dummy_status;
                        $action_item['ActionItem']['next_action_by'] = '136'; // overseeing
                        $action_item['ActionItem']['parent_action_item_id'] = '';
                        $this->ActionItem->save($action_item);
                        $ActionId = $this->ActionItem->getLastInsertId();
                        $this->ActionItem->id = $ActionId;
                        $this->ActionItem->saveField('parent_action_item_id', $ActionId);



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


                        $this->Session->setFlash('Data has been saved.', 'success');
                        // $this->redirect(array('controller' => 'messages', 'action' => 'index', 'builders', 'my-builders'));
                    }
                } else {
                    $this->Session->setFlash('Unable to add data.', 'failure');
                }
            }
        }

        $city = $this->City->find('list', array('fields' => 'City.id, City.city_name', 'conditions' => array('City.dummy_status' => $dummy_status, 'City.city_status' => '1'), 'order' => 'City.city_name ASC'));
        $this->set('city', $city);

        $codes = $this->LookupValueLeadsCountry->find('all', array('fields' => array('LookupValueLeadsCountry.id', 'LookupValueLeadsCountry.value', 'LookupValueLeadsCountry.code')));
        $codes = Set::combine($codes, '{n}.LookupValueLeadsCountry.id', array('%s: %s', '{n}.LookupValueLeadsCountry.value', '{n}.LookupValueLeadsCountry.code'));
        $this->set(compact('codes'));

        $contacts = $this->BuilderContact->find('all', array('fields' => array('BuilderContact.id', 'BuilderContact.builder_contact_name', 'BuilderContact.builder_contact_designation'), 'conditions' => array('BuilderContact.builder_contact_approved' => 1),
            'order' => 'BuilderContact.builder_contact_name asc'));

        $contacts = Set::combine($contacts, '{n}.BuilderContact.id', array('%s, %s', '{n}.BuilderContact.builder_contact_name', '{n}.BuilderContact.builder_contact_designation'));
        $this->set(compact('contacts'));

        if ($city_id == '1') // when city is global
            $builder = $this->Builder->find('list', array(
                'conditions' => array('Builder.builder_approved' => '1',
                    'Builder.dummy_status' => $dummy_status,
                ),
                'fields' => 'Builder.id, Builder.builder_name',
                'order' => 'Builder.builder_name ASC'
            ));
        else
            $builder = $this->Builder->find('list', array(
                'conditions' => array('OR' => array(
                        'Builder.builder_primarycity' => $city_id,
                        'Builder.builder_secondarycity' => $city_id,
                        'Builder.builder_tertiarycity' => $city_id,
                        'Builder.city_4' => $city_id,
                        'Builder.city_5' => $city_id,
                    ),
                    'Builder.builder_approved' => '1',
                    'Builder.dummy_status' => $dummy_status,
                ),
                'fields' => 'Builder.id, Builder.builder_name',
                'order' => 'Builder.builder_name ASC'
            ));

        $this->set(compact('builder'));

        $contact_level = $this->LookupBuilderContactLevel->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('contact_level'));

        $for_company = $this->LookupCompany->find('list', array('fields' => 'id, value', 'conditions' => array('id' => array('1', '2')), 'order' => 'value ASC'));
        $this->set(compact('for_company'));

    }

    function edit($id = null) {

        $user_id = $this->Auth->user('id');
        $role_id = $this->Session->read("role_id");
        $dummy_status = $this->Auth->user('dummy_status');
        $actio_itme_id = '';
        $screen_position = '';
        $flag = 0;
        $arr = explode('_', $id);
        $id = base64_decode($arr[0]);
        if (count($arr) > 1) {
            $actio_itme_id = $arr[1];
            $screen_no = $this->ActionItem->find('first', array('conditions' => array('ActionItem.id' => $actio_itme_id), 'fields' => array('ActionItem.screen_no')));
            $screen_position = $screen_no['ActionItem']['screen_no'];
            $flag = 1;
        }
        $this->set(compact('screen_position'));
        $this->set(compact('actio_itme_id'));
        if (!$id) {
            throw new NotFoundException(__('Invalid partner'));
        }

        $MarketingPartners = $this->MarketingPartner->findById($id);


        if (!$MarketingPartners) {
            throw new NotFoundException(__('Invalid partner'));
        }

        if ($this->request->data) {

            /*             * *************************Next Action By logic********************** */

            $action_user_id = '';
            $oversing_user = array();
            /*
              $oversing_channel = $this->Channel->find('first',array('conditions' => array('Channel.city_id'=> $this->data['BuilderContact']['builder_contact_company_city'],'Channel.dummy_status' => $dummy_status),'fields' => 'id'));

              if(!empty($oversing_channel))
              $oversing_user = $this->User->find('first',array('conditions' => array('User.overse_channel_id'=> $oversing_channel['Channel']['id'],'User.overse_role_id' => 10,'User.dummy_status' => $dummy_status),'fields' => 'id')); // 10 for Overseer of roles table.

              if(count($oversing_user))
              $action_user_id = $oversing_user['User']['id'];
             */

            //$this->request->data['Builder']['builder_approved'] = '2';

            /*             * *************************Builder Action ********************** */
            $action_item['ActionItem']['marketing_partner_id'] = $id;
            $action_item['ActionItem']['action_item_level_id'] = '14'; //  for Builder
            $action_item['ActionItem']['type_id'] = '10'; // 10 for Re-Submission For Approval
            $action_item['ActionItem']['next_action_by'] = '148';
            $action_item['ActionItem']['action_item_active'] = 'Yes';
            $action_item['ActionItem']['action_item_status'] = '17'; //1 for created table - lookup_value_action_item_statuses
            $action_item['ActionItem']['description'] = 'Marketing Partner Record Updated - Re-Submission For Approval';
            $action_item['ActionItem']['action_item_source'] = $role_id;
            $action_item['ActionItem']['created_by_id'] = $user_id;
            $action_item['ActionItem']['created_by'] = $user_id;
            $action_item['ActionItem']['dummy_status'] = $dummy_status;
            $action_item['ActionItem']['parent_action_item_id'] = $actio_itme_id;




            /*             * *********************Builder Remarks ******************************** */
            $remarks['Remark']['marketing_partner_id'] = $id;
            $remarks['Remark']['remarks'] = 'Edit Marketing Partner Record';
            $remarks['Remark']['remarks_by'] = $user_id;
            $remarks['Remark']['created_by'] = $user_id;
            $remarks['Remark']['remarks_time'] = date('g:i A');
            $remarks['Remark']['remarks_level'] = '9'; //2 for builder from lookup_value_remarks_level
            $remarks['Remark']['dummy_status'] = $dummy_status;
            $this->Remark->save($remarks);

            if ($this->data['MarketingPartner']['action_type'] == '0') {

                $this->request->data['MarketingPartner']['marketing_partner_active_primary'] = '1';
                $action_item['ActionItem']['screen_no'] = 'SC-1';
               
                $this->MarketingPartner->id = $id;
                if ($this->MarketingPartner->save($this->request->data['MarketingPartner'])) {

                    $this->ActionItem->save($action_item);
                    $ActionId = $this->ActionItem->getLastInsertId();
                    $this->ActionItem->id = $ActionId;
                    $this->ActionItem->saveField('parent_action_item_id', $ActionId);
                    if ($actio_itme_id) {
                        $this->ActionItem->saveField('parent_action_item_id', $actio_itme_id);
                        $this->ActionItem->updateAll(array('ActionItem.action_item_active' => "'No'"), array('ActionItem.id' => $actio_itme_id));
                        
                        // $this->redirect(array('controller' => 'action-items','action' => 'index'));
                    }

                   $this->Session->setFlash('Your changes have been submitted. Waiting for approval at the moment...', 'success');
                    //$this->redirect(array('controller' => 'messages','action' => 'index','builder','my-builders'));
                }
            } else if ($this->data['MarketingPartner']['action_type'] == '1') {
                $action_item['ActionItem']['screen_no'] = 'SC-2';
                $this->request->data['MarketingPartner']['marketing_partner_active_operation'] = '1';
                $this->MarketingPartner->id = $id;
                if ($this->MarketingPartner->save($this->request->data['MarketingPartner'])) {
                    $this->ActionItem->save($action_item);
                    $ActionId = $this->ActionItem->getLastInsertId();
                    $this->ActionItem->id = $ActionId;
                    $this->ActionItem->saveField('parent_action_item_id', $ActionId);
                    if ($actio_itme_id) {
                        $this->ActionItem->saveField('parent_action_item_id', $actio_itme_id);
                        $this->ActionItem->updateAll(array('ActionItem.action_item_active' => "'No'"), array('ActionItem.id' => $actio_itme_id));
                                           }

                    $this->Session->setFlash('Your changes have been submitted. Waiting for approval at the moment...', 'success');
                    //	$this->redirect(array('controller' => 'messages','action' => 'index','builder','my-builders'));
                }
            }




            //$this->Session->setFlash('Builder contact has been updated.', 'success');
            //$this->redirect(array('controller' => 'messages','action' => 'index','builder','my-builders'));	


            $this->set('action_type', $this->data['MarketingPartner']['action_type']);

            if ($flag == 1)
                $this->redirect(array('controller' => 'action-items', 'action' => 'index'));
        }
        
        $city = $this->City->find('list', array('fields' => 'City.id, City.city_name', 'conditions' => array('City.dummy_status' => $dummy_status, 'City.city_status' => '1'), 'order' => 'City.city_name ASC'));
        $this->set('city', $city);

        $codes = $this->LookupValueLeadsCountry->find('all', array('fields' => array('LookupValueLeadsCountry.id', 'LookupValueLeadsCountry.value', 'LookupValueLeadsCountry.code')));
        $codes = Set::combine($codes, '{n}.LookupValueLeadsCountry.id', array('%s: %s', '{n}.LookupValueLeadsCountry.value', '{n}.LookupValueLeadsCountry.code'));
        $this->set(compact('codes'));
        
        $builder_contacts = $this->BuilderContact->find('all', array('conditions' => array('BuilderContact.builder_partner_id' => $id), 'order' => 'builder_contact_name ASC'));
        $this->set(compact('builder_contacts'));
       // pr($builder_contacts)  ;  


        $this->request->data = $MarketingPartners;
    }

   

    function view($id = null) {

        $arr = explode('_', $id);
        $id = base64_decode($arr[0]);
        $dummy_status = $this->Auth->user('dummy_status');

        if (!$id) {
            throw new NotFoundException(__('Invalid Partner'));
        }

        $MarketingPartners = $this->MarketingPartner->findById($id);


        if (!$MarketingPartners) {
            throw new NotFoundException(__('Invalid Partner'));
        }

        $codes = $this->LookupValueLeadsCountry->find('all', array('fields' => array('LookupValueLeadsCountry.id', 'LookupValueLeadsCountry.value', 'LookupValueLeadsCountry.code')));
        $codes = Set::combine($codes, '{n}.LookupValueLeadsCountry.id', array('%s: %s', '{n}.LookupValueLeadsCountry.value', '{n}.LookupValueLeadsCountry.code'));
        $this->set(compact('codes'));
        
        $contact_level = $this->LookupBuilderContactLevel->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('contact_level'));
        
        $city = $this->City->find('list', array('fields' => 'City.id, City.city_name', 'conditions' => array('City.dummy_status' => $dummy_status, 'City.city_status' => '1'), 'order' => 'City.city_name ASC'));
        $this->set('city', $city);
        
        $for_company = $this->LookupCompany->find('list', array('fields' => 'id, value', 'conditions' => array('id' => array('1', '2')), 'order' => 'value ASC'));
        $this->set(compact('for_company'));
   
        $this->request->data = $MarketingPartners;
    }

}


<?php

/**
 * BuilderLegalName controller.
 *
 * This file will render views from views/builder_legal_names/
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
 * BuilderLegalName controller
 *
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
App::uses('CakeEmail', 'Network/Email');

class BuilderLegalNamesController extends AppController {

    public $uses = array('BuilderLegalName', 'ActionItem', 'Remark', 'Builder','LookupValueLeadsCountry', 'City', 'BuilderContact', 'Channel', 'LookupBuilderLegalNamesEntityType');

    public function index() {

        $dummy_status = $this->Auth->user('dummy_status');
        $channel_id = $this->Session->read("channel_id");
        $role_id = $this->Session->read("role_id");
        $channels = $this->Channel->findById($channel_id);
        $city_id = $channels['Channel']['city_id'];

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
        if ($role_id == '15') { // Accounts User.
            if ($city_id == 2) {
                array_push($search_condition, array('BuilderContact.dummy_status' => $dummy_status, 'BuilderContact.builder_contact_company_city' => $city_id));
            } else {
                array_push($search_condition, array('NOT' => array('BuilderContact.builder_contact_company_city' => '2'), 'BuilderContact.dummy_status' => $dummy_status));
            }
        } else {
            if ($city_id > 1) {
                array_push($search_condition, array('BuilderContact.dummy_status' => $dummy_status, 'BuilderContact.builder_contact_company_city' => $city_id));
            }
        }



        if ($dummy_status) {
            array_push($search_condition, array('BuilderContact.dummy_status' => $dummy_status));
        }
        // pr($this->params);


        if (count($this->params['pass'])) {

            $aaray = explode(':', $this->params['pass'][0]);
            $field = $aaray[0];
            $value = $aaray[1];
            array_push($search_condition, array('BuilderContact.' . $field => $value)); // when builder is approve/pending
        }

        $this->paginate['order'] = array('BuilderContact.builder_contact_approved' => 'asc');

        $this->set('builder_contacts', $this->paginate("BuilderContact", $search_condition));


        if ($role_id == '15') { // Accounts User.
            if ($city_id == 2) {
                $all_count = $this->BuilderContact->find('count', array('conditions' => array('BuilderContact.builder_contact_company_city' => $city_id, 'BuilderContact.dummy_status' => $dummy_status)));
                $this->set(compact('all_count'));

                $approve = $this->BuilderContact->find('count', array('conditions' => array('BuilderContact.builder_contact_company_city' => $city_id, 'BuilderContact.builder_contact_approved' => '1', 'BuilderContact.dummy_status' => $dummy_status)));
                $this->set(compact('approve'));

                $pending = $this->BuilderContact->find('count', array('conditions' => array('BuilderContact.builder_contact_company_city' => $city_id, 'BuilderContact.builder_contact_approved' => '2', 'BuilderContact.dummy_status' => $dummy_status)));
                $this->set(compact('pending'));

                $approve = $this->BuilderContact->find('count', array('conditions' => array('BuilderContact.builder_contact_company_city' => $city_id, 'BuilderContact.builder_contact_approved' => '1', 'BuilderContact.dummy_status' => $dummy_status)));
                $this->set(compact('approve'));

                $pending = $this->BuilderContact->find('count', array('conditions' => array('BuilderContact.builder_contact_company_city' => $city_id, 'BuilderContact.builder_contact_approved' => '2', 'BuilderContact.dummy_status' => $dummy_status)));
                $this->set(compact('pending'));

                $sales_marketing = $this->BuilderContact->find('count', array('conditions' => array('BuilderContact.builder_contact_company_city' => $city_id, 'BuilderContact.builder_contact_approved' => '1', 'BuilderContact.dummy_status' => $dummy_status, 'BuilderContact.builder_contact_level' => '1')));
                $this->set(compact('sales_marketing'));

                $accounts = $this->BuilderContact->find('count', array('conditions' => array('BuilderContact.builder_contact_company_city' => $city_id, 'BuilderContact.builder_contact_approved' => '1', 'BuilderContact.dummy_status' => $dummy_status, 'BuilderContact.builder_contact_level' => '6')));
                $this->set(compact('accounts'));

                $corporate_finance = $this->BuilderContact->find('count', array('conditions' => array('BuilderContact.builder_contact_company_city' => $city_id, 'BuilderContact.builder_contact_approved' => '1', 'BuilderContact.dummy_status' => $dummy_status, 'BuilderContact.builder_contact_level' => '11')));
                $this->set(compact('corporate_finance'));

                $land_acquisition = $this->BuilderContact->find('count', array('conditions' => array('BuilderContact.builder_contact_company_city' => $city_id, 'BuilderContact.builder_contact_approved' => '1', 'BuilderContact.dummy_status' => $dummy_status, 'BuilderContact.builder_contact_level' => '7')));
                $this->set(compact('land_acquisition'));
            } else {
                $all_count = $this->BuilderContact->find('count', array('conditions' => array('NOT' => array('BuilderContact.builder_contact_company_city' => 2), 'BuilderContact.dummy_status' => $dummy_status)));
                $this->set(compact('all_count'));

                $approve = $this->BuilderContact->find('count', array('conditions' => array('NOT' => array('BuilderContact.builder_contact_company_city' => 2), 'BuilderContact.builder_contact_approved' => '1', 'BuilderContact.dummy_status' => $dummy_status)));
                $this->set(compact('approve'));

                $pending = $this->BuilderContact->find('count', array('conditions' => array('NOT' => array('BuilderContact.builder_contact_company_city' => 2), 'BuilderContact.builder_contact_approved' => '2', 'BuilderContact.dummy_status' => $dummy_status)));
                $this->set(compact('pending'));

                $approve = $this->BuilderContact->find('count', array('conditions' => array('NOT' => array('BuilderContact.builder_contact_company_city' => 2), 'BuilderContact.builder_contact_approved' => '1', 'BuilderContact.dummy_status' => $dummy_status)));
                $this->set(compact('approve'));

                $pending = $this->BuilderContact->find('count', array('conditions' => array('NOT' => array('BuilderContact.builder_contact_company_city' => 2), 'BuilderContact.builder_contact_approved' => '2', 'BuilderContact.dummy_status' => $dummy_status)));
                $this->set(compact('pending'));

                $sales_marketing = $this->BuilderContact->find('count', array('conditions' => array('NOT' => array('BuilderContact.builder_contact_company_city' => 2), 'BuilderContact.builder_contact_approved' => '1', 'BuilderContact.dummy_status' => $dummy_status, 'BuilderContact.builder_contact_level' => '1')));
                $this->set(compact('sales_marketing'));

                $accounts = $this->BuilderContact->find('count', array('conditions' => array('NOT' => array('BuilderContact.builder_contact_company_city' => 2), 'BuilderContact.builder_contact_approved' => '1', 'BuilderContact.dummy_status' => $dummy_status, 'BuilderContact.builder_contact_level' => '6')));
                $this->set(compact('accounts'));

                $corporate_finance = $this->BuilderContact->find('count', array('conditions' => array('NOT' => array('BuilderContact.builder_contact_company_city' => 2), 'BuilderContact.builder_contact_approved' => '1', 'BuilderContact.dummy_status' => $dummy_status, 'BuilderContact.builder_contact_level' => '11')));
                $this->set(compact('corporate_finance'));

                $land_acquisition = $this->BuilderContact->find('count', array('conditions' => array('NOT' => array('BuilderContact.builder_contact_company_city' => 2), 'BuilderContact.builder_contact_approved' => '1', 'BuilderContact.dummy_status' => $dummy_status, 'BuilderContact.builder_contact_level' => '7')));
                $this->set(compact('land_acquisition'));
            }
        } else {

            $all_count = $this->BuilderContact->find('count', array('conditions' => array('BuilderContact.dummy_status' => $dummy_status)));
            $this->set(compact('all_count'));

            $approve = $this->BuilderContact->find('count', array('conditions' => array('BuilderContact.builder_contact_approved' => '1', 'BuilderContact.dummy_status' => $dummy_status)));
            $this->set(compact('approve'));

            $pending = $this->BuilderContact->find('count', array('conditions' => array('BuilderContact.builder_contact_approved' => '2', 'BuilderContact.dummy_status' => $dummy_status)));
            $this->set(compact('pending'));

            $approve = $this->BuilderContact->find('count', array('conditions' => array('BuilderContact.builder_contact_approved' => '1', 'BuilderContact.dummy_status' => $dummy_status)));
            $this->set(compact('approve'));

            $pending = $this->BuilderContact->find('count', array('conditions' => array('BuilderContact.builder_contact_approved' => '2', 'BuilderContact.dummy_status' => $dummy_status)));
            $this->set(compact('pending'));

            $sales_marketing = $this->BuilderContact->find('count', array('conditions' => array('BuilderContact.builder_contact_approved' => '1', 'BuilderContact.dummy_status' => $dummy_status, 'BuilderContact.builder_contact_level' => '1')));
            $this->set(compact('sales_marketing'));

            $accounts = $this->BuilderContact->find('count', array('conditions' => array('BuilderContact.builder_contact_approved' => '1', 'BuilderContact.dummy_status' => $dummy_status, 'BuilderContact.builder_contact_level' => '6')));
            $this->set(compact('accounts'));

            $corporate_finance = $this->BuilderContact->find('count', array('conditions' => array('BuilderContact.builder_contact_approved' => '1', 'BuilderContact.dummy_status' => $dummy_status, 'BuilderContact.builder_contact_level' => '11')));
            $this->set(compact('corporate_finance'));

            $land_acquisition = $this->BuilderContact->find('count', array('conditions' => array('BuilderContact.builder_contact_approved' => '1', 'BuilderContact.dummy_status' => $dummy_status, 'BuilderContact.builder_contact_level' => '7')));
            $this->set(compact('land_acquisition'));
        }

        //$log = $this->BuilderContact->getDataSource()->getLog(false, false);       
        // debug($log);

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



        $city = $this->City->find('list', array('fields' => 'City.id, City.city_name', 'conditions' => array('City.dummy_status' => $dummy_status), 'order' => 'City.city_name ASC'));
        $this->set('city', $city);

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

    public function add($id = null) {

        $this->layout = 'ajax';
        $user_id = $this->Auth->user('id');
        $role_id = $this->Session->read("role_id");
        $dummy_status = $this->Auth->user('dummy_status');
        $condition_dummy_status = array('dummy_status =' . $dummy_status, 'id != 1');
        $channel_id = $this->Session->read("channel_id");
        $channels = $this->Channel->findById($channel_id);
        $city_id = $channels['Channel']['city_id'];



        if ($this->request->is('post')) {


            $this->request->data['BuilderLegalName']['dummy_status'] = $dummy_status;
            $this->request->data['BuilderLegalName']['builder_legal_names_status'] = '1'; // 1= Yes, table of lookup value status
            $this->request->data['BuilderLegalName']['builder_legal_name_approved'] = '2'; // 2= No, table of lookup value status
            $this->request->data['BuilderLegalName']['created_by'] = $user_id;



            $this->BuilderLegalName->create();
            if ($this->BuilderLegalName->save($this->request->data)) {

                $builder_legalname_id = $this->BuilderLegalName->getLastInsertId();
                if ($builder_legalname_id) {

                    /*                     * *********************Builder Remarks ******************************** */
                    $remarks['Remark']['builder_legalname_id'] = $builder_legalname_id;
                    $remarks['Remark']['remarks'] = 'New Builder Legal Name Record Created';
                    $remarks['Remark']['remarks_by'] = $user_id;
                    $remarks['Remark']['created_by'] = $user_id;
                    $remarks['Remark']['remarks_time'] = date('g:i A');
                    $remarks['Remark']['remarks_level'] = '7'; // for builder legal name from lookup_value_remarks_level
                    $remarks['Remark']['dummy_status'] = $dummy_status;
                    $this->Remark->save($remarks);

                    /*                     * *******************Builder Contacts************************ */


                    $action_item['ActionItem']['builder_legalname_id'] = $builder_legalname_id;
                    $action_item['ActionItem']['action_item_level_id'] = '12'; //  for Builder Legal Name
                    $action_item['ActionItem']['type_id'] = '7'; // 7 for Submission For Approval
                    $action_item['ActionItem']['next_action_by'] = '136';
                    $action_item['ActionItem']['action_item_active'] = 'Yes';
                    $action_item['ActionItem']['action_item_status'] = '1'; //1 for created table - lookup_value_action_item_statuses
                    $action_item['ActionItem']['description'] = 'Buillder Legal Name Record Created - Submission For Approval';
                    $action_item['ActionItem']['action_item_source'] = $role_id;
                    $action_item['ActionItem']['created_by_id'] = $user_id;
                    $action_item['ActionItem']['created_by'] = $user_id;
                    $action_item['ActionItem']['dummy_status'] = $dummy_status;


                    if ($this->ActionItem->save($action_item)) {
                        $ActionId = $this->ActionItem->getLastInsertId();
                        $this->ActionItem->id = $ActionId;
                        $this->ActionItem->saveField('parent_action_item_id', $ActionId);

                        $actionArry = $this->ActionItem->findById($ActionId);
                        $BuilderLegalNames = $this->BuilderLegalName->findById($actionArry['ActionItem']['builder_legalname_id']);

                        $Email = new CakeEmail();

                        $Email->viewVars(array(
                            'NextActionBy' => strtoupper($actionArry['NextActionBy']['fname'] . ' ' . $actionArry['NextActionBy']['lname']),
                            'BuilderName' => strtoupper($BuilderLegalNames['Builder']['builder_name']),
                            'ContactName' => strtoupper($BuilderLegalNames['BuilderContact']['builder_contact_name']),
                            'Location' => strtoupper($BuilderLegalNames['Location']['city_name']),
                            'LegalName' => strtoupper($BuilderLegalNames['BuilderLegalName']['builder_legal_names_name']),
                            'Address' => strtoupper($BuilderLegalNames['BuilderLegalName']['builder_legal_names_address']),
                        ));

                        $to = 'infra@sumanus.com';
                        //$to = 'biswajit@wtbglobal.com';
                        $Email->template('BuilderLegalNames/add', 'default')->emailFormat('html')->to($to)->from('admin@silkrouters.com')->subject('BUILDER LEGAL NAME SUBMITTED BY - ' . strtoupper($actionArry['CreatedBy']['fname'] . ' ' . $actionArry['CreatedBy']['lname']))->send();
                    }
                }
                $this->Session->setFlash('Builder Legal Name has been saved.', 'success');
                //$this->redirect(array('controller' => 'messages','action' => 'index','builder_contacts','my-builder-contacts'));
            } else {
                $this->Session->setFlash('Unable to add builder legal name.', 'failure');
            }

            echo '<script>
				 			var objP=parent.document.getElementsByClassName("mfp-bg");
							var objC=parent.document.getElementsByClassName("mfp-wrap");
							objP[0].style.display="none";
							objC[0].style.display="none";
							parent.location.reload(true);</script>';
        }

        $city = $this->City->find('list', array('fields' => 'City.id, City.city_name', 'conditions' => $condition_dummy_status, 'order' => 'City.city_name ASC'));
        $this->set('city', $city);

        $entity_types = $this->LookupBuilderLegalNamesEntityType->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('entity_types'));


        $contact_name = $this->BuilderContact->find('list', array('fields' => array('BuilderContact.id', 'BuilderContact.builder_contact_name'), 'conditions' => array('BuilderContact.builder_contact_builder_id' => $id), 'order' => 'builder_contact_name ASC'));
        $this->set(compact('contact_name'));

        if ($id) {
            $builder = $this->Builder->find('list', array(
                'conditions' => array(
                    'Builder.id' => $id,
                ),
                'fields' => 'Builder.id, Builder.builder_name',
                'order' => 'Builder.builder_name ASC'
            ));
        } else {
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
        }

        $this->set(compact('builder'));
    }

    function edit($id = null) {

        $this->layout = 'ajax';
        $user_id = $this->Auth->user('id');
        $role_id = $this->Session->read("role_id");
        $dummy_status = $this->Auth->user('dummy_status');
        $condition_dummy_status = array('dummy_status =' . $dummy_status, 'id != 1');
        $channel_id = $this->Session->read("channel_id");
        $channels = $this->Channel->findById($channel_id);
        $city_id = $channels['Channel']['city_id'];
        $actio_itme_id = '';
        $flag = 0;
        $arr = explode('_', $id);
        $id = base64_decode($arr[0]);
        if (count($arr) > 1) {
            $actio_itme_id = $arr[1];
            $flag = 1;
        }

        if (!$id) {
            throw new NotFoundException(__('Invalid Builder Legal Name'));
        }

        $BuilderLegalNames = $this->BuilderLegalName->findById($id);


        if (!$BuilderLegalNames) {
            throw new NotFoundException(__('Invalid Builder Legal Name'));
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

           $this->request->data['BuilderLegalName']['builder_legal_name_approved'] = '2';

            /*             * *************************Builder Action ********************** */
            $action_item['ActionItem']['builder_legalname_id'] = $id;
            $action_item['ActionItem']['action_item_level_id'] = '12'; //  for Builder Legal 
            $action_item['ActionItem']['type_id'] = '10'; // 10 for Re-Submission For Approval
            $action_item['ActionItem']['next_action_by'] = '136';
            $action_item['ActionItem']['action_item_active'] = 'Yes';
            $action_item['ActionItem']['action_item_status'] = '17'; //17 for Change Submitted table - lookup_value_action_item_statuses
            $action_item['ActionItem']['description'] = 'Buillder Legal Name Record Updated - Re-Submission For Approval';
            $action_item['ActionItem']['action_item_source'] = $role_id;
            $action_item['ActionItem']['created_by_id'] = $user_id;
            $action_item['ActionItem']['created_by'] = $user_id;
            $action_item['ActionItem']['dummy_status'] = $dummy_status;
            $action_item['ActionItem']['parent_action_item_id'] = $actio_itme_id;



            /*             * *********************Builder Remarks ******************************** */
            $remarks['Remark']['builder_legalname_id'] = $id;
            $remarks['Remark']['remarks'] = 'Edit Builder Legal Name Record';
            $remarks['Remark']['remarks_by'] = $user_id;
            $remarks['Remark']['created_by'] = $user_id;
            $remarks['Remark']['remarks_time'] = date('g:i A');
            $remarks['Remark']['remarks_level'] = '7'; //4 for builder legal name from lookup_value_remarks_level
            $remarks['Remark']['dummy_status'] = $dummy_status;
            $this->Remark->save($remarks);


            $this->BuilderLegalName->id = $id;
            if ($this->BuilderLegalName->save($this->request->data)) {

                $this->ActionItem->save($action_item);
                $ActionId = $this->ActionItem->getLastInsertId();
                $this->ActionItem->id = $ActionId;
                $this->ActionItem->saveField('parent_action_item_id', $ActionId);
                if ($actio_itme_id) {
                    $this->ActionItem->saveField('parent_action_item_id', $actio_itme_id);
                    $this->ActionItem->updateAll(array('ActionItem.action_item_active' => "'No'"), array('ActionItem.id' => $actio_itme_id));
                }

                $this->Session->setFlash('Your changes have been submitted. Waiting for approval at the moment...', 'success');

                /* if($flag == 1)
                  $this->redirect(array('controller' => 'action-items','action' => 'index'));
                  else
                  $this->redirect(array('controller' => 'messages','action' => 'index','builder_contacts','my-builder-contacts')); */
            }
            else
                $this->Session->setFlash('Unable to update builder legal name.', 'failure');

            echo '<script>
				 			var objP=parent.document.getElementsByClassName("mfp-bg");
							var objC=parent.document.getElementsByClassName("mfp-wrap");
							objP[0].style.display="none";
							objC[0].style.display="none";
							parent.location.reload(true);</script>';
        }

       $city = $this->City->find('list', array('fields' => 'City.id, City.city_name', 'conditions' => $condition_dummy_status, 'order' => 'City.city_name ASC'));
        $this->set('city', $city);

        $entity_types = $this->LookupBuilderLegalNamesEntityType->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('entity_types'));


        $contact_name = $this->BuilderContact->find('list', array('fields' => array('BuilderContact.id', 'BuilderContact.builder_contact_name'), 'conditions' => array('BuilderContact.builder_contact_builder_id' => $BuilderLegalNames['BuilderLegalName']['builder_legal_names_builder_id']), 'order' => 'builder_contact_name ASC'));
        $this->set(compact('contact_name'));
        
        $contact_details = $this->BuilderContact->find('all', array('conditions' => array('BuilderContact.id' => $BuilderLegalNames['BuilderLegalName']['builder_legal_names_contact_id'])));
        $this->set(compact('contact_details'));

        if ($id) {
            $builder = $this->Builder->find('list', array(
                'conditions' => array(
                    'Builder.id' => $BuilderLegalNames['BuilderLegalName']['builder_legal_names_builder_id'],
                ),
                'fields' => 'Builder.id, Builder.builder_name',
                'order' => 'Builder.builder_name ASC'
            ));
        } else {
            if ($city_id == '1') // when city is global
                $builder = $this->Builder->find('list', array(
                    'conditions' => array('Builder.builder_approved' => '1',
                        'Builder.dummy_status' => $dummy_status,
                    ),
                    'fields' => 'Builder.id, Builder.builder_name',
                    'order' => 'Builder.builder_name ASC'
                ));
           
        }
        $this->set(compact('builder'));

        $this->request->data = $BuilderLegalNames;
    }

}


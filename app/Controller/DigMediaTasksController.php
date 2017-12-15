<?php

/**
 * DigMediaTask controller.
 *
 * This file will render views from views/TravelCities/
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

App::uses('CakeEmail', 'Network/Email');

/**
 * DigMediaTask controller
 *
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class DigMediaTasksController extends AppController {

    var $uses = array('DigMediaTask', 'TravelLookupContinent', 'LookupValueLeadsCountry', 'DigMediaProduct', 'DigMediaLookupDurationUnit',
        'DigMediaLookupUrgency', 'DigMediaLink', 'User', 'DigTopic', 'Channel', 'DigStructure','DigMediaTask','DigPerson','DigTaskPerson');
    public $components = array('Sms', 'Image');
    public $uploadDir;

    public function beforeFilter() {
        parent::beforeFilter();
        $this->uploadDir = ROOT . DS . APP_DIR . DS . WEBROOT_DIR . '/uploads/DigMediaTasks';
    }

    public function index() {

        $user_id = $this->Auth->user('id');
        $search_condition = array();
        $TravelCountries = array();
        $task_name = '';
     


        if ($this->request->is('post') || $this->request->is('put')) {
            if (!empty($this->data['DigMediaTask']['task_name'])) {
                $task_name = $this->data['DigMediaTask']['task_name'];
                array_push($search_condition, array("DigMediaTask.task_name LIKE '%$task_name%'"));
            }
      
        } elseif ($this->request->is('get')) {

            if (!empty($this->request->params['named']['task_name'])) {
                $task_name = $this->request->params['named']['task_name'];
                array_push($search_condition, array("DigMediaTask.task_name LIKE '%$task_name%'"));
            }
        
        }
        array_push($search_condition, array('DigMediaTask.created_by' => $user_id));
        $this->paginate['order'] = array('DigMediaTask.task_product_id' => 'asc');
        $this->set('DigMediaTasks', $this->paginate("DigMediaTask", $search_condition));


        if (!isset($this->passedArgs['task_name']) && empty($this->passedArgs['task_name'])) {
            $this->passedArgs['task_name'] = (isset($this->data['DigMediaTask']['task_name'])) ? $this->data['DigMediaTask']['task_name'] : '';
        }

        if (!isset($this->data) && empty($this->data)) {
            $this->data['DigMediaTask']['task_name'] = $this->passedArgs['task_name'];           
        }


        $this->set(compact('TravelCountries'));

        $TravelLookupContinents = $this->TravelLookupContinent->find('list', array('fields' => 'id,continent_name', 'conditions' => array('continent_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'continent_name ASC'));
        $this->set(compact('TravelLookupContinents','task_name'));
 
    }

    public function add() {

        $user_id = $this->Auth->user('id');


        // echo date('Y-m-d h:i:s', strtotime("+1 Days"));
        // echo $timestamp = strtotime(date('Y-m-d h:i:s'));



        if ($this->request->is('post')) {

            if (!empty($this->data['DigMediaTask']['task_duration']) && !empty($this->data['DigMediaTask']['task_duration_unit'])) {
                $this->request->data['DigMediaTask']['task_delivary_date'] = date('Y-m-d H:i:s', strtotime("+" . $this->data['DigMediaTask']['task_duration'] . ' ' . $this->data['DigMediaTask']['task_duration_unit'], strtotime($this->data['DigMediaTask']['start_date'])));
            }

            if (!empty($this->data['DigMediaTask']['task_review_duration']) && !empty($this->data['DigMediaTask']['task_review_duration_unit'])) {
                $this->request->data['DigMediaTask']['task_customer_delivery_date'] = date('Y-m-d H:i:s', strtotime("+" . $this->data['DigMediaTask']['task_review_duration'] . ' ' . $this->data['DigMediaTask']['task_review_duration_unit'], strtotime($this->data['DigMediaTask']['start_date'])));
            }

            // $tmstamp = strtotime($this->request->data['DigMediaTask']['task_delivary_date']) + strtotime($this->request->data['DigMediaTask']['task_customer_delivery_date']);
            // $this->request->data['DigMediaTask']['task_actual_delivery_date'] = date("Y-m-d H:i:s", $tmstamp) ;


            if (!empty($this->data['DigMediaTask']['task_delivary_format']['name'])) {
                $file = $this->data['DigMediaTask']['task_delivary_format'];
                move_uploaded_file($file['tmp_name'], WWW_ROOT . 'uploads/DigMediaTasks/' . $file['name']);
                $this->request->data['DigMediaTask']['task_delivary_format'] = $file['name'];
            } else {
                if (!empty($this->data['DigMediaTask']['format2'])) {
                    copy(WWW_ROOT . 'uploads/DigMediaProducts/' . $this->data['DigMediaTask']['format2'], WWW_ROOT . 'uploads/DigMediaTasks/' . $this->data['DigMediaTask']['format2']);
                    $this->request->data['DigMediaTask']['task_delivary_format'] = $this->data['DigMediaTask']['format2'];
                }
                else
                    $this->request->data['DigMediaTask']['task_delivary_format'] = '';
            }

            if (!empty($this->data['DigMediaTask']['task_target_content_file1']['name'])) {
                $file = $this->data['DigMediaTask']['task_target_content_file1'];
                move_uploaded_file($file['tmp_name'], WWW_ROOT . 'uploads/DigMediaTasks/' . $file['name']);
                $this->request->data['DigMediaTask']['task_target_content_file1'] = $file['name'];
            }
            else
                $this->request->data['DigMediaTask']['task_target_content_file1'] = '';

            if (!empty($this->data['DigMediaTask']['task_target_content_file2']['name'])) {
                $file = $this->data['DigMediaTask']['task_target_content_file2'];
                move_uploaded_file($file['tmp_name'], WWW_ROOT . 'uploads/DigMediaTasks/' . $file['name']);
                $this->request->data['DigMediaTask']['task_target_content_file2'] = $file['name'];
            }
            else
                $this->request->data['DigMediaTask']['task_target_content_file2'] = '';

            if (!empty($this->data['DigMediaTask']['task_target_content_file3']['name'])) {
                $file = $this->data['DigMediaTask']['task_target_content_file3'];
                move_uploaded_file($file['tmp_name'], WWW_ROOT . 'uploads/DigMediaTasks/' . $file['name']);
                $this->request->data['DigMediaTask']['task_target_content_file3'] = $file['name'];
            }
            else
                $this->request->data['DigMediaTask']['task_target_content_file3'] = '';

            if (!empty($this->data['DigMediaTask']['task_target_content_file4']['name'])) {
                $file = $this->data['DigMediaTask']['task_target_content_file4'];
                move_uploaded_file($file['tmp_name'], WWW_ROOT . 'uploads/DigMediaTasks/' . $file['name']);
                $this->request->data['DigMediaTask']['task_target_content_file4'] = $file['name'];
            }
            else
                $this->request->data['DigMediaTask']['task_target_content_file4'] = '';

            if (!empty($this->data['DigMediaTask']['task_target_content_file5']['name'])) {
                $file = $this->data['DigMediaTask']['task_target_content_file5'];
                move_uploaded_file($file['tmp_name'], WWW_ROOT . 'uploads/DigMediaTasks/' . $file['name']);
                $this->request->data['DigMediaTask']['task_target_content_file5'] = $file['name'];
            }
            else
                $this->request->data['DigMediaTask']['task_target_content_file5'] = '';

            if (!empty($this->data['DigMediaTask']['task_target_content_file6']['name'])) {
                $file = $this->data['DigMediaTask']['task_target_content_file6'];
                move_uploaded_file($file['tmp_name'], WWW_ROOT . 'uploads/DigMediaTasks/' . $file['name']);
                $this->request->data['DigMediaTask']['task_target_content_file6'] = $file['name'];
            }
            else
                $this->request->data['DigMediaTask']['task_target_content_file6'] = '';

            if (!empty($this->data['DigMediaTask']['task_target_content_file7']['name'])) {
                $file = $this->data['DigMediaTask']['task_target_content_file7'];
                move_uploaded_file($file['tmp_name'], WWW_ROOT . 'uploads/DigMediaTasks/' . $file['name']);
                $this->request->data['DigMediaTask']['task_target_content_file7'] = $file['name'];
            }
            else
                $this->request->data['DigMediaTask']['task_target_content_file7'] = '';

            if (!empty($this->data['DigMediaTask']['task_target_content_file8']['name'])) {
                $file = $this->data['DigMediaTask']['task_target_content_file8'];
                move_uploaded_file($file['tmp_name'], WWW_ROOT . 'uploads/DigMediaTasks/' . $file['name']);
                $this->request->data['DigMediaTask']['task_target_content_file8'] = $file['name'];
            }
            else
                $this->request->data['DigMediaTask']['task_target_content_file8'] = '';

            if (!empty($this->data['DigMediaTask']['task_target_content_file9']['name'])) {
                $file = $this->data['DigMediaTask']['task_target_content_file9'];
                move_uploaded_file($file['tmp_name'], WWW_ROOT . 'uploads/DigMediaTasks/' . $file['name']);
                $this->request->data['DigMediaTask']['task_target_content_file9'] = $file['name'];
            }
            else
                $this->request->data['DigMediaTask']['task_target_content_file9'] = '';

            if (!empty($this->data['DigMediaTask']['task_target_content_file10']['name'])) {
                $file = $this->data['DigMediaTask']['task_target_content_file10'];
                move_uploaded_file($file['tmp_name'], WWW_ROOT . 'uploads/DigMediaTasks/' . $file['name']);
                $this->request->data['DigMediaTask']['task_target_content_file10'] = $file['name'];
            }
            else
                $this->request->data['DigMediaTask']['task_target_content_file10'] = '';


            $this->request->data['DigMediaTask']['task_status'] = '1'; // saved draft
            $this->request->data['DigMediaTask']['created_by'] = $user_id;
            $this->request->data['DigMediaTask']['task_name'] = strtoupper($this->data['DigMediaTask']['product'] . '_' . $this->data['DigMediaTask']['channel_name'] . '_' . $this->data['DigMediaTask']['topic_name'] . '_' . $this->data['DigMediaTask']['user_fname'] . '_' . $this->data['DigMediaTask']['task_start_date']);
            //  $this->request->data['DigMediaTask']['task_start_date'] = $this->data['DigMediaTask']['start_date'];
            // pr($this->request->data);
            // die;

            $this->DigMediaTask->create();

            if ($this->DigMediaTask->save($this->request->data)) {
                $this->Session->setFlash('Task has been successfully saved.', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to save draft.', 'failure');
            }
        }

        $codes = $this->LookupValueLeadsCountry->find('all', array('fields' => array('LookupValueLeadsCountry.id', 'LookupValueLeadsCountry.value', 'LookupValueLeadsCountry.code')));
        $codes = Set::combine($codes, '{n}.LookupValueLeadsCountry.id', array('%s: %s', '{n}.LookupValueLeadsCountry.value', '{n}.LookupValueLeadsCountry.code'));
        $this->set(compact('codes'));

        $DigMediaProducts = $this->DigMediaProduct->find('list', array('fields' => 'id,product_name', 'order' => 'product_name ASC'));
        $this->set(compact('DigMediaProducts'));

        $countires = $this->LookupValueLeadsCountry->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $this->set(compact('countires'));

        $DigMediaLookupDurationUnits = $this->DigMediaLookupDurationUnit->find('list', array('fields' => 'value,value', 'order' => 'value ASC'));

        $this->set(compact('DigMediaLookupDurationUnits'));


        $DigMediaLookupUrgencies = $this->DigMediaLookupUrgency->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $this->set(compact('DigMediaLookupUrgencies'));

        $DigTopics = $this->DigTopic->find('list', array('fields' => 'id,topic_name', 'order' => 'topic_name ASC'));
        $this->set(compact('DigTopics'));

        $Channels = $this->Channel->find('list', array('fields' => 'Channel.id, Channel.channel_name', 'conditions' => array('Channel.channel_role' => 35))); // 35 marketing group
        $Channels = array('ALL' => 'ALL') + $Channels + array('NONE' => 'NONE');

        $Users = $this->User->find('all', array('fields' => array('User.id', 'User.fname', 'User.lname'),
            'conditions' => array('User.id' => '133')));

        $Users = Set::combine($Users, '{n}.User.id', array('%s %s', '{n}.User.fname', '{n}.User.lname'));

        $DigStructures = $this->DigStructure->find('list', array('fields' => 'id,structure_name', 'order' => 'structure_name ASC'));

        $this->set(compact('Users', 'Channels', 'DigStructures'));
    }

    public function edit($id = null, $mode = null) {

        $id = base64_decode($id);
        $this->set(compact('mode'));
        if (!$id) {
            throw new NotFoundException(__('Invalid City'));
        }

        $TravelCities = $this->DigMediaTask->findById($id);

        if (!$TravelCities) {
            throw new NotFoundException(__('Invalid City'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->DigMediaTask->set($this->data);
            if ($this->DigMediaTask->validates() == true) {

                $this->DigMediaTask->id = $id;
                if ($this->DigMediaTask->save($this->request->data)) {
                    $this->Session->setFlash('City has been updated.', 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to update City.', 'failure');
                }
            }
        }


        $TravelCountries = $this->TravelCountry->find('list', array('fields' => 'id,country_name', 'conditions' => array('continent_id' => $TravelCities['DigMediaTask']['continent_id'], 'country_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'country_name ASC'));
        $this->set(compact('TravelCountries'));

        $TravelLookupContinents = $this->TravelLookupContinent->find('list', array('fields' => 'id,continent_name', 'conditions' => array('continent_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'continent_name ASC'));
        $this->set(compact('TravelLookupContinents'));


        $this->request->data = $TravelCities;
    }

    public function draft($id = null) {

        $user_id = $this->Auth->user('id');
        if (!$id) {
            throw new NotFoundException(__('Invalid Task'));
        }

        $DigMediaTasks = $this->DigMediaTask->findById($id);

        if (!$DigMediaTasks) {
            throw new NotFoundException(__('Invalid Task'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {

            if (!empty($this->data['DigMediaTask']['task_delivary_format']['name'])) {
                $file = $this->data['DigMediaTask']['task_delivary_format'];
                move_uploaded_file($file['tmp_name'], WWW_ROOT . 'uploads/DigMediaTasks/' . $file['name']);
                $this->request->data['DigMediaTask']['task_delivary_format'] = $file['name'];
            } else {
                if (!empty($this->data['DigMediaTask']['format2'])) {
                    copy(WWW_ROOT . 'uploads/DigMediaProducts/' . $this->data['DigMediaTask']['format2'], WWW_ROOT . 'uploads/DigMediaTasks/' . $this->data['DigMediaTask']['format2']);
                    $this->request->data['DigMediaTask']['task_delivary_format'] = $this->data['DigMediaTask']['format2'];
                }
                else
                    $this->request->data['DigMediaTask']['task_delivary_format'] = '';
            }

            if (!empty($this->data['DigMediaTask']['task_target_content_file1']['name'])) {
                $file = $this->data['DigMediaTask']['task_target_content_file1'];
                move_uploaded_file($file['tmp_name'], WWW_ROOT . 'uploads/DigMediaTasks/' . $file['name']);
                $this->request->data['DigMediaTask']['task_target_content_file1'] = $file['name'];
            }
            else
                unset($this->request->data['DigMediaTask']['task_target_content_file1']);

            if (!empty($this->data['DigMediaTask']['task_target_content_file2']['name'])) {
                $file = $this->data['DigMediaTask']['task_target_content_file2'];
                move_uploaded_file($file['tmp_name'], WWW_ROOT . 'uploads/DigMediaTasks/' . $file['name']);
                $this->request->data['DigMediaTask']['task_target_content_file2'] = $file['name'];
            }
            else
                unset($this->request->data['DigMediaTask']['task_target_content_file2']);

            if (!empty($this->data['DigMediaTask']['task_target_content_file3']['name'])) {
                $file = $this->data['DigMediaTask']['task_target_content_file3'];
                move_uploaded_file($file['tmp_name'], WWW_ROOT . 'uploads/DigMediaTasks/' . $file['name']);
                $this->request->data['DigMediaTask']['task_target_content_file3'] = $file['name'];
            }
            else
                unset($this->request->data['DigMediaTask']['task_target_content_file3']);

            if (!empty($this->data['DigMediaTask']['task_target_content_file4']['name'])) {
                $file = $this->data['DigMediaTask']['task_target_content_file4'];
                move_uploaded_file($file['tmp_name'], WWW_ROOT . 'uploads/DigMediaTasks/' . $file['name']);
                $this->request->data['DigMediaTask']['task_target_content_file4'] = $file['name'];
            }
            else
                unset($this->request->data['DigMediaTask']['task_target_content_file4']);

            if (!empty($this->data['DigMediaTask']['task_target_content_file5']['name'])) {
                $file = $this->data['DigMediaTask']['task_target_content_file5'];
                move_uploaded_file($file['tmp_name'], WWW_ROOT . 'uploads/DigMediaTasks/' . $file['name']);
                $this->request->data['DigMediaTask']['task_target_content_file5'] = $file['name'];
            }
            else
                unset($this->request->data['DigMediaTask']['task_target_content_file5']);

            if (!empty($this->data['DigMediaTask']['task_target_content_file6']['name'])) {
                $file = $this->data['DigMediaTask']['task_target_content_file6'];
                move_uploaded_file($file['tmp_name'], WWW_ROOT . 'uploads/DigMediaTasks/' . $file['name']);
                $this->request->data['DigMediaTask']['task_target_content_file6'] = $file['name'];
            }
            else
                unset($this->request->data['DigMediaTask']['task_target_content_file6']);

            if (!empty($this->data['DigMediaTask']['task_target_content_file7']['name'])) {
                $file = $this->data['DigMediaTask']['task_target_content_file7'];
                move_uploaded_file($file['tmp_name'], WWW_ROOT . 'uploads/DigMediaTasks/' . $file['name']);
                $this->request->data['DigMediaTask']['task_target_content_file7'] = $file['name'];
            }
            else
                unset($this->request->data['DigMediaTask']['task_target_content_file7']);

            if (!empty($this->data['DigMediaTask']['task_target_content_file8']['name'])) {
                $file = $this->data['DigMediaTask']['task_target_content_file8'];
                move_uploaded_file($file['tmp_name'], WWW_ROOT . 'uploads/DigMediaTasks/' . $file['name']);
                $this->request->data['DigMediaTask']['task_target_content_file8'] = $file['name'];
            }
            else
                unset($this->request->data['DigMediaTask']['task_target_content_file8']);

            if (!empty($this->data['DigMediaTask']['task_target_content_file9']['name'])) {
                $file = $this->data['DigMediaTask']['task_target_content_file9'];
                move_uploaded_file($file['tmp_name'], WWW_ROOT . 'uploads/DigMediaTasks/' . $file['name']);
                $this->request->data['DigMediaTask']['task_target_content_file9'] = $file['name'];
            }
            else
                unset($this->request->data['DigMediaTask']['task_target_content_file9']);

            if (!empty($this->data['DigMediaTask']['task_target_content_file10']['name'])) {
                $file = $this->data['DigMediaTask']['task_target_content_file10'];
                move_uploaded_file($file['tmp_name'], WWW_ROOT . 'uploads/DigMediaTasks/' . $file['name']);
                $this->request->data['DigMediaTask']['task_target_content_file10'] = $file['name'];
            }
            else
                unset($this->request->data['DigMediaTask']['task_target_content_file10']);



            $this->DigMediaTask->set($this->data);
            if ($this->DigMediaTask->validates() == true) {
                $this->request->data['DigMediaTask']['task_status'] = '2'; // Open Task
                $this->request->data['DigMediaTask']['created_by'] = $user_id;
                $allocate_email = $this->User->GetCompanyEmail($this->data['DigMediaTask']['task_allocated_to']);
                $review_email = $this->User->GetCompanyEmail($this->data['DigMediaTask']['task_reviewed_by']);
                $this->DigMediaTask->id = $id;
                if ($this->DigMediaTask->save($this->request->data)) {
                    $this->DigMediaLink->updateAll(array('DigMediaLink.link_status' => "'2'"), array('DigMediaLink.link_task_id' => $id));

                    $TaskArray = $this->DigMediaTask->findById($id);

                    if ($TaskArray['DigMediaTask']['task_status'] == '1')
                        $task_status = 'Save Draft';
                    elseif ($TaskArray['DigMediaTask']['task_status'] == '2')
                        $task_status = 'Open Task';
                    /* Email Logic */
                    $to = array($allocate_email, $review_email);
                    $bcc = 'infra@sumanus.com';
                    $Email = new CakeEmail();
                    $Email->viewVars(array(
                        'TaskName' => $TaskArray['DigMediaProduct']['product_name'],
                        'TaskUrgency' => $TaskArray['DigMediaLookupUrgency']['value'],
                        'DeliveryDate' => $TaskArray['DigMediaTask']['task_delivary_date'],
                        'AllocatedTo' => $this->User->Username($TaskArray['DigMediaTask']['task_allocated_to']),
                        'ReviewedBy' => $this->User->Username($TaskArray['DigMediaTask']['task_reviewed_by']),
                        'TaskStatus' => $task_status,
                    ));
                    $Email->template('DigMediaTasks/add', 'default')->emailFormat('html')->to($to)->bcc($bcc)->from('admin@silkrouters.com')->subject('New Task [' . $TaskArray['DigMediaProduct']['product_name'] . '] Open By [' . $this->User->Username($user_id) . '] Starting From [' . date('d/m/y H:i:s') . ']')->send();
                    $this->Session->setFlash('Task has been opened.', 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to update task.', 'failure');
                }
            }
        }


        $codes = $this->LookupValueLeadsCountry->find('all', array('fields' => array('LookupValueLeadsCountry.id', 'LookupValueLeadsCountry.value', 'LookupValueLeadsCountry.code')));
        $codes = Set::combine($codes, '{n}.LookupValueLeadsCountry.id', array('%s: %s', '{n}.LookupValueLeadsCountry.value', '{n}.LookupValueLeadsCountry.code'));
        $this->set(compact('codes'));

        $DigMediaProducts = $this->DigMediaProduct->find('list', array('fields' => 'id,product_name', 'order' => 'product_name ASC'));
        $this->set(compact('DigMediaProducts'));

        $countires = $this->LookupValueLeadsCountry->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $this->set(compact('countires'));

        $DigMediaLookupDurationUnits = $this->DigMediaLookupDurationUnit->find('list', array('fields' => 'value,value', 'order' => 'value ASC'));

        $this->set(compact('DigMediaLookupDurationUnits'));


        $DigMediaLookupUrgencies = $this->DigMediaLookupUrgency->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $this->set(compact('DigMediaLookupUrgencies'));

        $DigMediaLinks = $this->DigMediaLink->find('all', array('conditions' => array('DigMediaLink.link_task_id' => $id)));
        $this->set(compact('DigMediaLinks'));

        $Users = $this->User->find('all', array('fields' => array('User.id', 'User.fname', 'User.lname'),
            'conditions' => array('User.id' => '133')));

        $Users = Set::combine($Users, '{n}.User.id', array('%s %s', '{n}.User.fname', '{n}.User.lname'));

        $this->set(compact('Users'));
        //pr($DigMediaLinks);

        $this->request->data = $DigMediaTasks;
    }

    public function add_person($id = null) {

        $user_id = $this->Auth->user('id');
        $no_of_person = '';
        
        if (!$id) {
            throw new NotFoundException(__('Invalid Task'));
        }

        $DigMediaTasks = $this->DigMediaTask->findById($id);

        if (!$DigMediaTasks) {
            throw new NotFoundException(__('Invalid Task'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $no_of_person = $this->data['DigTaskPerson']['no_of_person'];
            
            if (isset($this->data['Save'])) {
             
                $univ_dept = $this->DigTaskPerson->find('all', array(
                    'conditions' => array('DigTaskPerson.task_id' => $id)
                ));
                
                $formatted_univ_dept = Hash::extract($univ_dept, '{n}.DigTaskPerson.person_id');

                $db_req = array_diff($formatted_univ_dept, $this->request->data['DigTaskPerson']['person_id']);
                $req_db = array_diff($this->request->data['DigTaskPerson']['person_id'], $formatted_univ_dept);
               // pr($db_req);
               // pr($req_db);exit;

                $save = array(); $saved = 0;
                if (!empty($db_req)) {
                    foreach ($db_req as $person_id) {
                        $del = $this->DigTaskPerson->deleteAll(
                                array(
                            'DigTaskPerson.person_id' => $person_id,
                            'DigTaskPerson.task_id' => $id
                                ), false);
                        if ($del) $save = $saved = 1;
                    }
                }
                
                if (!empty($req_db)) {
                    $save = array();
                    foreach ($req_db as $person_id) {
                        $save = array('DigTaskPerson' => array(
                                'person_id' => $person_id,
                                'task_id' => $id
                        ));
                        $this->DigTaskPerson->validate = false;
                        $this->DigTaskPerson->create();
                        if ($this->DigTaskPerson->save($save)) $saved = 1;
                        
                    }
                }

                if (!empty($save)) {
                    if ($saved) {
                        $this->Session->setFlash('Person successfully assigned to the selected task.', 'success');
                        return $this->redirect(array('action' => 'index'));
                    } else {
                        $this->Session->setFlash('Unable to assign person to the selected task.', 'failure');
                    }
                } else {
                    $this->Session->setFlash('Unable to assign person to the selected task.', 'failure');
                }
                

            }
            else{
                $this->set('DigPersons', $this->DigPerson->find('list', array(
                    'fields' => array('id', 'person_name'),
                    'order' => 'rand()',
                    'limit' => $no_of_person,
        )));
            }
        }
        else{
        

        $this->set('DigPersons', $this->DigPerson->find('list', array(
                    'fields' => array('id', 'person_name'),
                    'order' => 'rand()',
                    'limit' => 20,
        )));
        }

        $selected = $this->DigTaskPerson->find('list', array('fields' => array('id')));
       $this->set(compact('selected','no_of_person'));

        $this->request->data = $DigMediaTasks;
    }

}
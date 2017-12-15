<?php

/**
 * DigPerson controller.
 *
 * This file will render views from views/DigPersons/
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
 * DigPerson controller
 *
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class DigPersonsController extends AppController {

    var $uses = array('DigPerson', 'DigPersonDay', 'DigPersonProfileType', 'DigPersonType', 'LookupValueLeadsCountry','DigBaseUsage','DigPersonIndustry',
        'Channel','User','DigAccount');
    public $components = array('Image');
    
    public $uploadDir;

    public function beforeFilter() {
        parent::beforeFilter();
        $this->uploadDir = ROOT . DS . APP_DIR . DS . WEBROOT_DIR . '/uploads/DigPersons';
    }

    public function index() {

        $search_condition = array();
        $user_id = $this->Auth->user('id');
        $role_id = $this->Session->read('role_id');
        $person_name = '';
        
        if ($this->request->is('post') || $this->request->is('put')) {
            if (!empty($this->data['DigPersons']['person_name'])) {
                $person_name = $this->data['DigPersons']['person_name'];
                array_push($search_condition, array('DigPerson.person_name' . ' LIKE' => mysql_escape_string(trim(strip_tags($person_name))) . "%"));
            }
        }
        elseif ($this->request->is('get')) {

            if (!empty($this->request->params['DigPersons']['person_name'])) {
                $person_name = $this->request->params['DigPersons']['person_name'];
                array_push($search_condition, array("DigPerson.person_name LIKE '%$person_name%'"));
            }
        }
        
        
        if($role_id == '60'){ // social singal
            array_push($search_condition,array('DigPerson.person_profile_type' => array('2','5'),'DigPerson.person_used_by_person' => $user_id,'DigPerson.person_status' => '5'));
            
        }
        $this->paginate['order'] = array('DigPerson.created' => 'desc');
        $this->set('DigPersons', $this->paginate("DigPerson", $search_condition));
        
        if (!isset($this->passedArgs['person_name']) && empty($this->passedArgs['person_name'])) {
            $this->passedArgs['person_name'] = (isset($this->data['DigPersons']['person_name'])) ? $this->data['DigPersons']['person_name'] : '';
        }
        
        if (!isset($this->data) && empty($this->data)) {
            $this->data['DigPersons']['person_name'] = $this->passedArgs['person_name'];
        }
        
        $this->set(compact('person_name'));
        
        
    }

    public function add() {


        $user_id = $this->Auth->user('id');
        $channel_id = $this->Session->read("channel_id");

        if ($this->request->is('post')) {
            
            
            $upload_picture = '';


            if (is_uploaded_file($this->request->data['DigPerson']['upload_picture']['tmp_name'])) {
                $upload_picture = $image1 = $this->Image->upload(null, $this->request->data['DigPerson']['upload_picture'], $this->uploadDir, 'profile');
                $this->request->data['DigPerson']['upload_picture'] = $upload_picture;
            } else {
                unset($this->request->data['DigPerson']['upload_picture']);
            }

            $this->request->data['DigPerson']['created_by'] = $user_id;
            $this->request->data['DigPerson']['person_status'] = '1';

            $this->DigPerson->create();

            if ($this->DigPerson->save($this->request->data)) {
                $this->Session->setFlash('Record has been successfully saved.', 'success');

                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to add record.', 'failure');
            }
        }


        $DigPersonDays = $this->DigPersonDay->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigPersonProfileTypes = $this->DigPersonProfileType->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigPersonTypes = $this->DigPersonType->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigPersonUsages = $this->DigBaseUsage->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigPersonIndustries = $this->DigPersonIndustry->find('list', array('fields' => 'id,value'));
        $codes = $this->LookupValueLeadsCountry->find('all', array('fields' => array('LookupValueLeadsCountry.id', 'LookupValueLeadsCountry.value', 'LookupValueLeadsCountry.code')));
        $codes = Set::combine($codes, '{n}.LookupValueLeadsCountry.id', array('%s: %s', '{n}.LookupValueLeadsCountry.value', '{n}.LookupValueLeadsCountry.code'));
        $DigPersonUsedByTeams = $this->Channel->find('list', array('fields' => 'Channel.id, Channel.channel_name', 'conditions' => array('Channel.id' => $channel_id))); 
        $DigPersonUsedByTeams = array('0' => 'All Teams') + $DigPersonUsedByTeams;
        $DigPersonUsedByPersons = $this->User->find('all', array('fields' => array('User.id', 'User.fname', 'User.lname'), 'conditions' => array('User.id' => $user_id), 'order' => 'User.fname asc'));
        $DigPersonUsedByPersons = Set::combine($DigPersonUsedByPersons, '{n}.User.id', array('%s %s', '{n}.User.fname', '{n}.User.lname'));
        $this->set(compact('DigPersonDays', 'DigPersonProfileTypes', 'DigPersonTypes', 'codes','DigPersonUsages','DigPersonIndustries','DigPersonUsedByTeams',
                'DigPersonUsedByPersons'));
    }

    public function edit($id = null, $mode = null) {


        $user_id = $this->Auth->user('id');
        $id = base64_decode($id);
        $this->set(compact('mode'));
        $channel_id = $this->Session->read("channel_id");
        if (!$id) {
            throw new NotFoundException(__('Invalid Person'));
        }

        $DigPersons = $this->DigPerson->findById($id);

        if (!$DigPersons) {
            throw new NotFoundException(__('Invalid Person'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            
            $image = '';
            
            if (is_uploaded_file($this->request->data['DigPerson']['image']['tmp_name'])) {
                $image = $this->Image->upload($DigPersons['DigPerson']['upload_picture'], $this->request->data['DigPerson']['image'], $this->uploadDir, 'profile');
                $this->request->data['DigPerson']['upload_picture'] = $image;
            } else {
                unset($this->request->data['DigPerson']['image']);
            }
            
            $this->DigPerson->set($this->data);
            if ($this->DigPerson->validates() == true) {

                $this->DigPerson->id = $id;
                if ($this->DigPerson->save($this->request->data)) {                   
                    $this->Session->setFlash('Record has been successfully updated.', 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to update record.', 'failure');
                }
            }
        }


        $DigPersonDays = $this->DigPersonDay->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigPersonProfileTypes = $this->DigPersonProfileType->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigPersonTypes = $this->DigPersonType->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigPersonUsages = $this->DigBaseUsage->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigPersonIndustries = $this->DigPersonIndustry->find('list', array('fields' => 'id,value'));
        $codes = $this->LookupValueLeadsCountry->find('all', array('fields' => array('LookupValueLeadsCountry.id', 'LookupValueLeadsCountry.value', 'LookupValueLeadsCountry.code')));
        $codes = Set::combine($codes, '{n}.LookupValueLeadsCountry.id', array('%s: %s', '{n}.LookupValueLeadsCountry.value', '{n}.LookupValueLeadsCountry.code'));
        $DigPersonUsedByTeams = $this->Channel->find('list', array('fields' => 'Channel.id, Channel.channel_name', 'conditions' => array('Channel.id' => $channel_id))); 
        $DigPersonUsedByTeams = array('0' => 'All Teams') + $DigPersonUsedByTeams;
        $DigPersonUsedByPersons = $this->User->find('all', array('fields' => array('User.id', 'User.fname', 'User.lname'), 'conditions' => array('User.id' => $user_id), 'order' => 'User.fname asc'));
        $DigPersonUsedByPersons = Set::combine($DigPersonUsedByPersons, '{n}.User.id', array('%s %s', '{n}.User.fname', '{n}.User.lname'));
        $this->set(compact('DigPersonDays', 'DigPersonProfileTypes', 'DigPersonTypes', 'codes','DigPersonUsages','DigPersonIndustries','DigPersonUsedByTeams',
                'DigPersonUsedByPersons'));

        $this->request->data = $DigPersons;
    }
    
    public function action($id = null) {

        $channel_id = $this->Session->read("channel_id");
        $user_id = $this->Auth->user('id');
        $action_type ='';
       

        if (!$id) {
            throw new NotFoundException(__('Invalid Person'));
        }

        $DigPersons = $this->DigPerson->findById($id);

        if (!$DigPersons) {
            throw new NotFoundException(__('Invalid Person'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $action_type = $this->data['DigPerson']['action_type'];
            $this->DigPerson->set($this->data);
            if ($this->DigPerson->validates() == true) {

                $this->DigPerson->id = $id;
                if ($action_type == '1') { //Update
                    
                    $image = '';
            
                    if (is_uploaded_file($this->request->data['DigPerson']['image']['tmp_name'])) {
                        $image = $this->Image->upload($DigPersons['DigPerson']['upload_picture'], $this->request->data['DigPerson']['image'], $this->uploadDir, 'profile');
                        $this->request->data['DigPerson']['upload_picture'] = $image;
                    } else {
                        unset($this->request->data['DigPerson']['image']);
                    }
                    
                    $person_email = $this->data['DigPerson']['person_email'];
                    $person_email_parm = $this->data['DigPerson']['person_email_parm'];
                    $person_user = $this->data['DigPerson']['person_user'];
                    $person_user_parm = $this->data['DigPerson']['person_user_parm'];
                    $person_profile_picture= $this->data['DigPerson']['person_profile_picture'];
                    $person_bio = $this->data['DigPerson']['person_bio'];
                    
                    if($person_email == '' || $person_email_parm == '' || $person_user == '' || $person_user_parm == '' || $person_profile_picture == 'No' || $person_bio == 'No')
                        $this->request->data['DigPerson']['person_usage_status'] = '1';
                   
                } elseif ($action_type == '2') { //Validate
                    if(isset($this->request->data['Unvalidate']))
                        $this->request->data['DigPerson']['person_usage_status'] = '1'; // validated of dig_account_usages
                    if(isset($this->request->data['Validate']))
                        $this->request->data['DigPerson']['person_usage_status'] = '9'; // validated of dig_account_usages
                   
                    
                } elseif ($action_type == '3') { //edit
                    
                }
                   
                if ($this->DigPerson->save($this->request->data)) {
                        $this->Session->setFlash('Record has been successfully updated.', 'success');
                         //$log = $this->AccountRelationship->getDataSource()->getLog(false, false);       
                        //debug($log);
                        //die;
                        $this->redirect(array('action' => 'index'));
                    } else {
                        $this->Session->setFlash('Unable to update record.', 'failure');
                    }
                    
            }
        }
        
        $twitterValidate = $this->DigAccount->find('first',array('all','conditions' => array('DigAccount.account_person_id' => $id,'DigAccount.account_base_id' => '25','DigAccount.account_usage_status' => '9')));
        $pinterestValidate = $this->DigAccount->find('first',array('all','conditions' => array('DigAccount.account_person_id' => $id,'DigAccount.account_base_id' => '3','DigAccount.account_usage_status' => '9')));
        $facebookValidate = $this->DigAccount->find('first',array('all','conditions' => array('DigAccount.account_person_id' => $id,'DigAccount.account_base_id' => '41','DigAccount.account_usage_status' => '9')));
        $linkedInValidate = $this->DigAccount->find('first',array('all','conditions' => array('DigAccount.account_person_id' => $id,'DigAccount.account_base_id' => '46','DigAccount.account_usage_status' => '9')));
        $muzyValidate = $this->DigAccount->find('first',array('all','conditions' => array('DigAccount.account_person_id' => $id,'DigAccount.account_base_id' => '42','DigAccount.account_usage_status' => '9')));
        $newsvineValidate = $this->DigAccount->find('first',array('all','conditions' => array('DigAccount.account_person_id' => $id,'DigAccount.account_base_id' => '43','DigAccount.account_usage_status' => '9')));
        $skyrockValidate = $this->DigAccount->find('first',array('all','conditions' => array('DigAccount.account_person_id' => $id,'DigAccount.account_base_id' => '44','DigAccount.account_usage_status' => '9')));
        $weheartitValidate = $this->DigAccount->find('first',array('all','conditions' => array('DigAccount.account_person_id' => $id,'DigAccount.account_base_id' => '45','DigAccount.account_usage_status' => '9')));
        $plurkValidate = $this->DigAccount->find('first',array('all','conditions' => array('DigAccount.account_person_id' => $id,'DigAccount.account_base_id' => '6','DigAccount.account_usage_status' => '9')));
        $fancyValidate = $this->DigAccount->find('first',array('all','conditions' => array('DigAccount.account_person_id' => $id,'DigAccount.account_base_id' => '13','DigAccount.account_usage_status' => '9')));
        $pushaValidate = $this->DigAccount->find('first',array('all','conditions' => array('DigAccount.account_person_id' => $id,'DigAccount.account_base_id' => '47','DigAccount.account_usage_status' => '9')));
        $visualizeValidate = $this->DigAccount->find('first',array('all','conditions' => array('DigAccount.account_person_id' => $id,'DigAccount.account_base_id' => '48','DigAccount.account_usage_status' => '9')));
        $piccsyValidate = $this->DigAccount->find('first',array('all','conditions' => array('DigAccount.account_person_id' => $id,'DigAccount.account_base_id' => '49','DigAccount.account_usage_status' => '9')));
        $scoopitValidate = $this->DigAccount->find('first',array('all','conditions' => array('DigAccount.account_person_id' => $id,'DigAccount.account_base_id' => '29','DigAccount.account_usage_status' => '9')));
        $buzznetValidate = $this->DigAccount->find('first',array('all','conditions' => array('DigAccount.account_person_id' => $id,'DigAccount.account_base_id' => '50','DigAccount.account_usage_status' => '9')));
        $tumblrValidate = $this->DigAccount->find('first',array('all','conditions' => array('DigAccount.account_person_id' => $id,'DigAccount.account_base_id' => '51','DigAccount.account_usage_status' => '9')));
        $diigoValidate = $this->DigAccount->find('first',array('all','conditions' => array('DigAccount.account_person_id' => $id,'DigAccount.account_base_id' => '30','DigAccount.account_usage_status' => '9')));
        $behanceValidate = $this->DigAccount->find('first',array('all','conditions' => array('DigAccount.account_person_id' => $id,'DigAccount.account_base_id' => '52','DigAccount.account_usage_status' => '9')));
        $googleplValidate = $this->DigAccount->find('first',array('all','conditions' => array('DigAccount.account_person_id' => $id,'DigAccount.account_base_id' => '1','DigAccount.account_usage_status' => '9')));
        
        
        
                        //die;
        $DigPersonDays = $this->DigPersonDay->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigPersonProfileTypes = $this->DigPersonProfileType->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigPersonTypes = $this->DigPersonType->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigPersonUsages = $this->DigBaseUsage->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigPersonIndustries = $this->DigPersonIndustry->find('list', array('fields' => 'id,value'));
        $codes = $this->LookupValueLeadsCountry->find('all', array('fields' => array('LookupValueLeadsCountry.id', 'LookupValueLeadsCountry.value', 'LookupValueLeadsCountry.code')));
        $codes = Set::combine($codes, '{n}.LookupValueLeadsCountry.id', array('%s: %s', '{n}.LookupValueLeadsCountry.value', '{n}.LookupValueLeadsCountry.code'));
        $DigPersonUsedByTeams = $this->Channel->find('list', array('fields' => 'Channel.id, Channel.channel_name', 'conditions' => array('Channel.id' => $channel_id))); 
        $DigPersonUsedByTeams = array('0' => 'All Teams') + $DigPersonUsedByTeams;
        $DigPersonUsedByPersons = $this->User->find('all', array('fields' => array('User.id', 'User.fname', 'User.lname'), 'conditions' => array('User.id' => $user_id), 'order' => 'User.fname asc'));
        $DigPersonUsedByPersons = Set::combine($DigPersonUsedByPersons, '{n}.User.id', array('%s %s', '{n}.User.fname', '{n}.User.lname'));
        $this->set(compact('DigPersonDays', 'DigPersonProfileTypes', 'DigPersonTypes', 'codes','DigPersonUsages','DigPersonIndustries','DigPersonUsedByTeams',
                'DigPersonUsedByPersons','twitterValidate','pinterestValidate','facebookValidate','linkedInValidate','muzyValidate','newsvineValidate',
                'skyrockValidate','weheartitValidate','plurkValidate','fancyValidate','pushaValidate','visualizeValidate','piccsyValidate','scoopitValidate',
                'buzznetValidate','tumblrValidate','diigoValidate','behanceValidate','googleplValidate'));

        $this->request->data = $DigPersons;
    }

}
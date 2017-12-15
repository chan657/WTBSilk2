<?php

/**
 * DigAccount controller.
 *
 * This file will render views from views/DigAccounts/
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
 * DigAccount controller
 *
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class DigAccountsController extends AppController {

    var $uses = array('DigAccount', 'DigAccountIndustry', 'DigAccountPopularity', 'DigAccountTeam', 'DigAccountUsage', 'DigBase', 'DigPerson', 'DigBaseDofollow', 'AccountRelationship',
        'Channel','User');

    public function index($base_id = null) {

        $search_condition = array();
        $user_id = $this->Auth->user('id');
        $role_id = $this->Session->read('role_id');
        $base_website_url = '';


        if ($this->request->is('post') || $this->request->is('put')) {
            if (!empty($this->data['DigAccount']['base_website_url'])) {
                $base_website_url = $this->data['DigAccount']['base_website_url'];
                array_push($search_condition, array('DigBase.base_website_url' . ' LIKE' => mysql_escape_string(trim(strip_tags($base_website_url))) . "%"));
            }
        } elseif ($this->request->is('get')) {

            if (!empty($this->request->params['DigAccount']['base_website_url'])) {
                $base_website_url = $this->request->params['DigAccount']['base_website_url'];
                array_push($search_condition, array("DigBase.base_website_url LIKE '%$base_website_url%'"));
            }
        }

        if ($role_id == '60') { // social singal
            array_push($search_condition, array('DigAccount.account_type' => array('2', '6'), 'DigAccount.account_used_by_person' => $user_id, 'DigAccount.account_status' => '2'));
        }
        if($base_id){
            array_push($search_condition, array('DigAccount.account_base_id' => $base_id));
        }

        $this->paginate['order'] = array('DigAccount.created' => 'desc');
        $this->set('DigAccounts', $this->paginate("DigAccount", $search_condition));

        //$log = $this->DigAccount->getDataSource()->getLog(false, false);       
        //debug($log);

        if (!isset($this->passedArgs['base_website_url']) && empty($this->passedArgs['base_website_url'])) {
            $this->passedArgs['base_website_url'] = (isset($this->data['DigBase']['base_website_url'])) ? $this->data['DigBase']['base_website_url'] : '';
        }

        if (!isset($this->data) && empty($this->data)) {
            $this->data['DigBase']['base_website_url'] = $this->passedArgs['base_website_url'];
        }

        $this->set(compact('base_website_url','base_id'));
    }

    public function add($base_id = null) {


        $user_id = $this->Auth->user('id');
        $search_condition = array();

        if ($this->request->is('post')) {

            $this->request->data['DigAccount']['created_by'] = $user_id;
            $this->request->data['DigAccount']['account_status'] = '1';

            $this->DigAccount->create();


            if ($this->DigAccount->save($this->request->data)) {
                $this->Session->setFlash('Account has been successfully saved.', 'success');

                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to add account.', 'failure');
            }
        }


        $DigAccountIndustries = $this->DigAccountIndustry->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigAccountPopularities = $this->DigAccountPopularity->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigAccountTeams = $this->DigAccountTeam->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigAccountUsages = $this->DigAccountUsage->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        if($base_id){
            array_push($search_condition, array('DigBase.id' => $base_id));
        }
        $DigBases = $this->DigBase->find('list', array('fields' => 'id,base_website_url','conditions' => $search_condition, 'order' => 'base_website_url ASC'));
        $DigPersons = $this->DigPerson->find('list', array('fields' => 'id,person_name', 'order' => 'person_name ASC'));
        $DigAccountDofollows = $this->DigBaseDofollow->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));

        $this->set(compact('DigAccountIndustries', 'DigAccountPopularities', 'DigAccountTeams', 'DigAccountUsages', 'DigBases', 'DigPersons', 'DigAccountDofollows'));
    }

    public function edit($id = null, $mode = null) {


        $user_id = $this->Auth->user('id');
        $id = base64_decode($id);
        $this->set(compact('mode'));
        if (!$id) {
            throw new NotFoundException(__('Invalid Account'));
        }

        $DigAccounts = $this->DigAccount->findById($id);

        if (!$DigAccounts) {
            throw new NotFoundException(__('Invalid Account'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->DigAccount->set($this->data);
            if ($this->DigAccount->validates() == true) {

                $this->DigAccount->id = $id;
                if ($this->DigAccount->save($this->request->data)) {
                    $this->Session->setFlash('Record has been successfully updated.', 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to update record.', 'failure');
                }
            }
        }


        $DigAccountIndustries = $this->DigAccountIndustry->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigAccountPopularities = $this->DigAccountPopularity->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigAccountTeams = $this->DigAccountTeam->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigAccountUsages = $this->DigAccountUsage->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigBases = $this->DigBase->find('list', array('fields' => 'id,base_website_url', 'order' => 'base_website_url ASC'));
        $DigPersons = $this->DigPerson->find('list', array('fields' => 'id,person_name', 'order' => 'person_name ASC'));
        $DigAccountDofollows = $this->DigBaseDofollow->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));

        $this->set(compact('DigAccountIndustries', 'DigAccountPopularities', 'DigAccountTeams', 'DigAccountUsages', 'DigBases', 'DigPersons', 'DigAccountDofollows'));

        $this->request->data = $DigAccounts;
    }

    public function account_edit($id = null) {


        $user_id = $this->Auth->user('id');
        $action_type = '';


        if (!$id) {
            throw new NotFoundException(__('Invalid Account'));
        }

        $DigAccounts = $this->DigAccount->findById($id);

        if (!$DigAccounts) {
            throw new NotFoundException(__('Invalid Account'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $action_type = $this->data['DigAccount']['action_type'];
            $this->DigAccount->set($this->data);
            if ($this->DigAccount->validates() == true) {

                $this->DigAccount->id = $id;
                if ($action_type == '1') { //Update
                    $account_parm1 = $this->data['DigAccount']['account_parm1'];
                    $account_parm2 = $this->data['DigAccount']['account_parm2'];
                    $account_parm3 = $this->data['DigAccount']['account_parm3'];
                    $profile_pic_uploaded = $this->data['DigAccount']['profile_pic_uploaded'];
                    $bio_added = $this->data['DigAccount']['bio_added'];
                    $account_profile_url = $this->data['DigAccount']['account_profile_url'];
                    $account_public_url = $this->data['DigAccount']['account_public_url'];
                    if ($account_parm1 == '' || $account_parm2 == '' || $account_parm3 == '' || $profile_pic_uploaded == 'No' || $bio_added == 'No' || ($account_profile_url <> $account_public_url))
                        $this->request->data['DigAccount']['account_usage_status'] = '1';
                } elseif ($action_type == '2') { //Validate
                    if (isset($this->request->data['Unvalidate']))
                        $this->request->data['DigAccount']['account_usage_status'] = '1'; // validated of dig_account_usages
                    if (isset($this->request->data['Validate']))
                        $this->request->data['DigAccount']['account_usage_status'] = '9'; // validated of dig_account_usages
                } elseif ($action_type == '3') { //edit
                } elseif ($action_type == '4') { //Interact
                    if (count($this->data['DigAccount']['relation']) > 0) {
                        foreach ($this->data['DigAccount']['relation'] as $val) {
                            $arr = explode('_', $val);
                            $save[] = array('AccountRelationship' => array(
                                    'followed_by' => $arr[0],
                                    'following_id' => $arr[1],
                                    'account_type' => $arr[2],
                            ));
                        }
                    }
                    $this->AccountRelationship->create();
                    $this->AccountRelationship->saveMany($save);
                }

                if ($this->DigAccount->save($this->request->data)) {
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

        $AllDigAccounts = $this->AccountRelationship->find('all', array(
            'joins' => array(
                array(
                    'table' => 'dig_accounts',
                    'alias' => 'DigAccount',
                    'type' => 'RIGHT',
                    'conditions' => 'AccountRelationship.followed_by != DigAccount.id',
                ),
                array(
                    'table' => 'dig_people',
                    'alias' => 'DigPerson',
                    'conditions' => 'DigAccount.account_person_id = DigPerson.id',
                ),
                array(
                    'table' => 'lookup_value_leads_countries',
                    'alias' => 'Geography',
                    'conditions' => 'DigPerson.person_location = Geography.id',
                ),
                array(
                    'table' => 'dig_account_industries',
                    'alias' => 'DigAccountIndustry',
                    'conditions' => 'DigAccount.account_industry_id = DigAccountIndustry.id',
                )
            ),
            'conditions' => array('DigAccount.id != ' . $id, 'DigAccount.active' => 'TRUE', 'DigAccount.account_status' => '2', 'DigAccount.account_usage_status' => '1'),
            'fields' => array('DigAccount.*', 'DigPerson.person_name', 'DigPerson.id', 'Geography.value', 'DigAccountIndustry.value'),
            'group' => 'DigPerson.id',
            'order' => 'rand()',
            'limit' => 40
        ));



        $Following = $this->AccountRelationship->find('list', array('fields' => 'followed_by,followed_by', 'conditions' => array('AccountRelationship.following_id' => $id)));
        //pr($Following);

        $DigAccountIndustries = $this->DigAccountIndustry->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigAccountPopularities = $this->DigAccountPopularity->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigAccountTeams = $this->DigAccountTeam->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigAccountUsages = $this->DigAccountUsage->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigBases = $this->DigBase->find('list', array('fields' => 'id,base_website_url', 'order' => 'base_website_url ASC'));
        $DigPersons = $this->DigPerson->find('list', array('fields' => 'id,person_name', 'order' => 'person_name ASC'));
        $DigAccountDofollows = $this->DigBaseDofollow->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));

        $this->set(compact('action_type', 'AllDigAccounts', 'Following', 'DigAccountIndustries', 'DigAccountPopularities', 'DigAccountTeams', 'DigAccountUsages', 'DigBases', 'DigPersons', 'DigAccountDofollows'));

        $this->request->data = $DigAccounts;
    }

    public function add_account($person_id, $account_base_id) {

        $this->layout = '';
        $user_id = $this->Auth->user('id');

        if ($this->request->is('post')) {

            $this->request->data['DigAccount']['created_by'] = $user_id;
            $this->request->data['DigAccount']['account_status'] = '1';

            $this->DigAccount->create();


            if ($this->DigAccount->save($this->request->data)) {
                $this->Session->setFlash('Account has been successfully saved.', 'success');

               // $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to add account.', 'failure');
            }
            
             echo '<script>
				 			var objP=parent.document.getElementsByClassName("mfp-bg");
							var objC=parent.document.getElementsByClassName("mfp-wrap");
							objP[0].style.display="none";
							objC[0].style.display="none";
							parent.location.reload(true);</script>';
        }


        $DigAccountIndustries = $this->DigAccountIndustry->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigAccountPopularities = $this->DigAccountPopularity->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigAccountTeams = $this->DigAccountTeam->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigAccountUsages = $this->DigAccountUsage->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigBases = $this->DigBase->find('list', array('fields' => 'id,base_website_url','conditions' => array('DigBase.id' => $account_base_id), 'order' => 'base_website_url ASC'));
        $DigPersons = $this->DigPerson->find('list', array('fields' => 'id,person_name','conditions' => array('DigPerson.id' => $person_id), 'order' => 'person_name ASC'));
        $DigAccountDofollows = $this->DigBaseDofollow->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        
        $DataArray = $this->DigPerson->findById($person_id);

            $DigUsedByTeams = $this->Channel->find('list', array('fields' => 'Channel.id, Channel.channel_name', 'conditions' => array('Channel.id' => $DataArray['DigPerson']['person_used_by_team'])));
            $DigUsedByTeams = array('0' => 'All Teams') + $DigUsedByTeams;
            $DigUsedByPersons = $this->User->find('all', array('fields' => array('User.id', 'User.fname', 'User.lname'), 'conditions' => array('User.id' => $DataArray['DigPerson']['person_used_by_person']), 'order' => 'User.fname asc'));
            $DigUsedByPersons = Set::combine($DigUsedByPersons, '{n}.User.id', array('%s %s', '{n}.User.fname', '{n}.User.lname'));

        $this->set(compact('DigAccountIndustries', 'DigAccountPopularities', 'DigAccountTeams', 'DigAccountUsages', 'DigBases', 'DigPersons', 'DigAccountDofollows',
                'DataArray', 'DigUsedByTeams', 'DigUsedByPersons'));
    }

}
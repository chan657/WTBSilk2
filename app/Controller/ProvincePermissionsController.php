<?php

/**
 * ProvincePermission controller.
 *
 * This file will render views from views/ProvincePermissions/
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
 * ProvincePermission controller
 *
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class ProvincePermissionsController extends AppController {

    var $uses = array('User', 'ProvincePermission', 'Province', 'TravelLookupContinent', 'TravelCountry');

    public function index() {


        $ProvincePermissions = $this->ProvincePermission->find('all', array(
            'fields' => array('ProvincePermission.user_id,GROUP_CONCAT(Province.name separator " , ") AS province_name', 'TravelCountry.country_name', 'TravelLookupContinent.continent_name', 'User.fname', 'User.lname', 'ProvincePermission.approval_id', 'ProvincePermission.maaping_approval_id'
                , 'ProvincePermission.continent_id', 'ProvincePermission.country_id'),
            'joins' => array(
                array(
                    'table' => 'users',
                    'alias' => 'User',
                    'type' => 'INNER',
                    'conditions' => 'ProvincePermission.user_id = User.id'
                ),
                
                array(
                    'table' => 'provinces',
                    'alias' => 'Province',
                    'type' => 'INNER',
                    'conditions' => 'ProvincePermission.province_id = Province.id'
                ),
                array(
                    'table' => 'travel_countries',
                    'alias' => 'TravelCountry',
                    'fields' => 'country_name',
                    'type' => 'INNER',
                    'conditions' => 'ProvincePermission.country_id = TravelCountry.id'
                ),
                array(
                    'table' => 'travel_lookup_continents',
                    'fields' => 'continent_name',
                    'alias' => 'TravelLookupContinent',
                    'type' => 'INNER',
                    'conditions' => 'ProvincePermission.continent_id = TravelLookupContinent.id'
                ),
            ),
            'order' => 'ProvincePermission.id',
            'group' => array('ProvincePermission.user_id','ProvincePermission.continent_id','ProvincePermission.country_id')));

        $this->set(compact('ProvincePermissions'));
    }

    public function add() {

        $created_by = $this->Auth->user('id');
        $dummy_status = $this->Auth->user('dummy_status');
        $selected = array();
        $Provinces = array();
        $mapping_edit = '';
		$TravelCountries = array();

        if ($this->request->is('post')) {
            $user_id = $this->request->data['ProvincePermission']['user_id'];
            $country_id = $this->request->data['ProvincePermission']['country_id'];
            $maaping_approval_id = $this->request->data['ProvincePermission']['maaping_approval_id'];
            $continent_id = $this->request->data['ProvincePermission']['continent_id'];
            $approval_id = $this->request->data['ProvincePermission']['approval_id'];
            $TravelCountries = $this->TravelCountry->find('list', array('fields' => 'id,country_name', 'conditions' => array('country_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE','continent_id' => $continent_id), 'order' => 'country_name ASC'));
        
            if (isset($this->request->data['add'])) {
                if (count($this->data['ProvincePermission']['province_id']) > 0) {

                    foreach ($this->data['ProvincePermission']['province_id'] as $val) {
                        if(isset($this->data['ProvincePermission']['mapping_edit'][$val]))
                            $mapping_edit = $this->data['ProvincePermission']['mapping_edit'][$val];
                        $save[] = array('ProvincePermission' => array(
                                'province_id' => $val,
                                'mapping_edit' => $mapping_edit,
                                'user_id' => $user_id,
                                'country_id' => $country_id,
                                'maaping_approval_id' => $maaping_approval_id,
                                'continent_id' => $continent_id,
                                'approval_id' => $approval_id,
                                'created_by' => $created_by
                        ));
                    }
                }

                $this->ProvincePermission->create();


                if ($this->ProvincePermission->saveMany($save)) {

                    $this->Session->setFlash('Data has been saved.', 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to add data.', 'failure');
                    $this->redirect(array('action' => 'index'));
                }
            }
            elseif(isset($this->request->data['search'])){
				//echo $continent_id;
                $Provinces = $this->Province->find('list', array('fields' => array('id', 'name'),'conditions' => array('continent_id' => $continent_id,'country_id' => $country_id)));
            }
        }

        

        $Users = $this->User->find
                (
                'all', array
            (
            'fields' => array('User.id', 'User.fname', 'User.lname'),
            'conditions' => array
                (
                'OR' => array('t_sales_role_id' => 28,'infra_operations_channel_id' => 262)
                ,
                //'User.id NOT IN (SELECT user_id FROM province_permissions WHERE 1 group by user_id)'
            ),
            'User.dummy_status' => $dummy_status,
            'order' => 'User.fname ASC'
                )
        );

        $Users = Set::combine($Users, '{n}.User.id', array('%s %s', '{n}.User.fname', '{n}.User.lname'));

        $Approved = $this->User->find
                (
                'all', array
            (
            'fields' => array('User.id', 'User.fname', 'User.lname'),
            'conditions' => array
                (
                //'User.id NOT IN (SELECT user_id FROM province_permissions WHERE 1 group by user_id)',
                'travel_role_infra_core' => '62'
            ),
            'User.dummy_status' => $dummy_status,
            'order' => 'User.fname ASC'
                )
        );

        $Approved = Set::combine($Approved, '{n}.User.id', array('%s %s', '{n}.User.fname', '{n}.User.lname'));

        $MappingApproved = $this->User->find
                (
                'all', array
            (
            'fields' => array('User.id', 'User.fname', 'User.lname'),
            'conditions' => array
                (
                //'User.id NOT IN (SELECT user_id FROM province_permissions WHERE 1 group by user_id)',
                'travel_channel_infra_mapping' => '258'
            ),
            'User.dummy_status' => $dummy_status,
            'order' => 'User.fname ASC'
                )
        );

        $MappingApproved = Set::combine($MappingApproved, '{n}.User.id', array('%s %s', '{n}.User.fname', '{n}.User.lname'));

        $TravelLookupContinents = $this->TravelLookupContinent->find('list', array('fields' => 'id,continent_name', 'conditions' => array('continent_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'continent_name ASC'));


        //$Provinces = array(1 => 'ONE', 'Mapping Edit');
        // pr($Provinces);
        //die;
        //$selected = $this->ProvincePermission->find('list', array('fields' => array('id')));

        $this->set(compact('Provinces', 'Users', 'selected', 'TravelLookupContinents', 'Approved', 'MappingApproved','TravelCountries'));
    }

    public function edit() {
        $created_by = $this->Auth->user('id');
        $dummy_status = $this->Auth->user('dummy_status');
        $search_condition = array();
        $province_condition = array();
        $selected = array();

        /*
        $permissionArray = $this->ProvincePermission->find('first', array('conditions' => array('user_id' => $user_id)));
        $country_id = $permissionArray['ProvincePermission']['country_id'];
        $continent_id = $permissionArray['ProvincePermission']['continent_id'];
        $maaping_approval_id = $permissionArray['ProvincePermission']['maaping_approval_id'];
        $approval_id = $permissionArray['ProvincePermission']['approval_id'];
         * 
         */
        //pr($this->request->params['named']);
        if (!empty($this->request->params['named']['user_id'])) {
                $user_id = $this->request->params['named']['user_id'];
                array_push($search_condition, array('ProvincePermission.user_id' => $user_id));
            }
        if (!empty($this->request->params['named']['continent_id'])) {
                $continent_id = $this->request->params['named']['continent_id'];
                array_push($search_condition, array('ProvincePermission.continent_id' => $continent_id));
            }
       if (!empty($this->request->params['named']['country_id'])) {
                $country_id = $this->request->params['named']['country_id'];
                array_push($search_condition, array('ProvincePermission.country_id' => $country_id));
            }     
            
      $permissionArray = $this->ProvincePermission->find('first', array('conditions' => $search_condition));

        $maaping_approval_id = $permissionArray['ProvincePermission']['maaping_approval_id'];
        $approval_id = $permissionArray['ProvincePermission']['approval_id'];

        if ($this->request->is('post') || $this->request->is('put')) {

            //$country_id = $this->data['ProvincePermission']['country_id'];
            $maaping_approval_id = $this->data['ProvincePermission']['maaping_approval_id'];
            //$continent_id = $this->data['ProvincePermission']['continent_id'];
            $approval_id = $this->data['ProvincePermission']['approval_id'];
           


            $save = array();
            $saved = 0;
            
            if (isset($this->request->data['add'])) {
            //if (!empty($db_req)) {

            foreach ($this->data['ProvincePermission']['province_id'] as $province_id) {
                $del = $this->ProvincePermission->deleteAll(
                        array(
                    'ProvincePermission.province_id' => $province_id,
                    'ProvincePermission.user_id' => $user_id,
                    'ProvincePermission.continent_id' => $continent_id,
                    'ProvincePermission.country_id' => $country_id,
                        ), false);
                if ($del)
                    $save = $saved = 1;
            }
            //}
            //if (!empty($req_db)) {
            $save = array();
            foreach ($this->data['ProvincePermission']['province_id'] as $province_id) {
                $save[] = array('ProvincePermission' => array(
                        'user_id' => $user_id,
                        'mapping_edit' => $this->data['ProvincePermission']['mapping_edit'][$province_id],
                        'province_id' => $province_id,
                        'country_id' => $country_id,
                        'maaping_approval_id' => $maaping_approval_id,
                        'continent_id' => $continent_id,
                        'approval_id' => $approval_id,
                        'created_by' => $created_by
                ));
            }

            $this->ProvincePermission->create();
            if ($this->ProvincePermission->saveMany($save))
                $saved = 1;
            //}
            //pr($save);
            //die;
            if ($saved) {
                $this->Session->setFlash('Data has been saved.', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to save data.', 'failure');
            }
        }
        /*
        elseif(isset($this->request->data['search'])){
                 array_push($province_condition, array('Province.continent_id' => $continent_id,'Province.country_id' => $country_id));
                 }
         * 
         */
        }

        $Approved = $this->User->find
                (
                'all', array
            (
            'fields' => array('User.id', 'User.fname', 'User.lname'),
            'conditions' => array
                (
                'travel_role_infra_core' => '62'
                //'User.id NOT IN (SELECT user_id FROM province_permissions WHERE 1 group by user_id)'
            ),
            'User.dummy_status' => $dummy_status,
            'order' => 'User.fname ASC'
                )
        );

        $Approved = Set::combine($Approved, '{n}.User.id', array('%s %s', '{n}.User.fname', '{n}.User.lname'));

        $MappingApproved = $this->User->find
                (
                'all', array
            (
            'fields' => array('User.id', 'User.fname', 'User.lname'),
            'conditions' => array
                (
                'travel_channel_infra_mapping' => '258'
                //'User.id NOT IN (SELECT user_id FROM province_permissions WHERE 1 group by user_id)'
            ),
            'User.dummy_status' => $dummy_status,
            'order' => 'User.fname ASC'
                )
        );

        $MappingApproved = Set::combine($MappingApproved, '{n}.User.id', array('%s %s', '{n}.User.fname', '{n}.User.lname'));
        $TravelLookupContinents = $this->TravelLookupContinent->find('list', array('fields' => 'id,continent_name', 'conditions' => array('id' => $continent_id), 'order' => 'continent_name ASC'));
        $Provinces = $this->Province->find('list', array('fields' => array('id', 'name'),'conditions' => array('Province.continent_id' => $continent_id,'Province.country_id' => $country_id)));
        $Users = $this->User->find('all', array('fields' => array('User.id', 'User.fname', 'User.lname'),
            'conditions' => array('User.dummy_status' => $dummy_status, 'User.id' => $user_id)));
        $Users = Set::combine($Users, '{n}.User.id', array('%s %s', '{n}.User.fname', '{n}.User.lname'));
        $TravelCountries = $this->TravelCountry->find('list', array('fields' => 'id,country_name', 'conditions' => array('id' => $country_id), 'order' => 'country_name ASC'));
        $selected = $this->ProvincePermission->find('list', array('fields' => array('province_id'), 'conditions' => array('ProvincePermission.user_id' => $user_id,'ProvincePermission.country_id' => $country_id,'ProvincePermission.continent_id' => $continent_id)));
        $mapping_selected = $this->ProvincePermission->find('list', array('fields' => array('province_id'), 'conditions' => array('ProvincePermission.user_id' => $user_id,'ProvincePermission.country_id' => $country_id,'ProvincePermission.continent_id' => $continent_id,'ProvincePermission.mapping_edit' => 'Yes')));
        $this->set(compact('Provinces', 'Users', 'selected', 'mapping_selected', 'TravelLookupContinents', 'MappingApproved', 'Approved', 'TravelCountries', 'country_id', 'maaping_approval_id', 'approval_id', 'continent_id'));
    }

}


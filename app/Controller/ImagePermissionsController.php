<?php

/**
 * ImagePermission controller.
 *
 * This file will render views from views/ImagePermissions/
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
 * ImagePermission controller
 *
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class ImagePermissionsController extends AppController {

    var $uses = array('User', 'ImagePermission', 'Province', 'TravelLookupContinent', 'TravelCountry');

      public function beforeFilter() {
        parent::beforeFilter();
       
        $this->Auth->allow('index','add','edit');
       
    }
    
    public function index() {


        $ImagePermissions = $this->ImagePermission->find('all', array(
            'fields' => array('ImagePermission.user_id,GROUP_CONCAT(Province.name separator " , ") AS province_name', 'TravelCountry.country_name', 'TravelLookupContinent.continent_name', 'User.fname', 'User.lname'
                , 'ImagePermission.continent_id', 'ImagePermission.country_id'),
            'joins' => array(
                array(
                    'table' => 'users',
                    'alias' => 'User',
                    'type' => 'INNER',
                    'conditions' => 'ImagePermission.user_id = User.id'
                ),
                
                array(
                    'table' => 'provinces',
                    'alias' => 'Province',
                    'type' => 'INNER',
                    'conditions' => 'ImagePermission.province_id = Province.id'
                ),
                array(
                    'table' => 'travel_countries',
                    'alias' => 'TravelCountry',
                    'fields' => 'country_name',
                    'type' => 'INNER',
                    'conditions' => 'ImagePermission.country_id = TravelCountry.id'
                ),
                array(
                    'table' => 'travel_lookup_continents',
                    'fields' => 'continent_name',
                    'alias' => 'TravelLookupContinent',
                    'type' => 'INNER',
                    'conditions' => 'ImagePermission.continent_id = TravelLookupContinent.id'
                ),
            ),
            'order' => 'ImagePermission.id',
            'group' => array('ImagePermission.user_id','ImagePermission.continent_id','ImagePermission.country_id')));

        $this->set(compact('ImagePermissions'));
    }

    public function add() {

        $created_by = $this->Auth->user('id');
        $dummy_status = $this->Auth->user('dummy_status');
        $selected = array();
        $Provinces = array();
        $mapping_edit = '';
		$TravelCountries = array();

        if ($this->request->is('post')) {
            $user_id = $this->request->data['ImagePermission']['user_id'];
            $country_id = $this->request->data['ImagePermission']['country_id'];
           
            $continent_id = $this->request->data['ImagePermission']['continent_id'];
   
            $TravelCountries = $this->TravelCountry->find('list', array('fields' => 'id,country_name', 'conditions' => array('country_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE','continent_id' => $continent_id), 'order' => 'country_name ASC'));
        
            if (isset($this->request->data['add'])) {
                if (count($this->data['ImagePermission']['province_id']) > 0) {

                    foreach ($this->data['ImagePermission']['province_id'] as $val) {
                       
                        $save[] = array('ImagePermission' => array(
                                'province_id' => $val,                                
                                'user_id' => $user_id,
                                'country_id' => $country_id,                               
                                'continent_id' => $continent_id,                               
                                'created_by' => $created_by
                        ));
                    }
                }

                $this->ImagePermission->create();


                if ($this->ImagePermission->saveMany($save)) {

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
                'OR' => array('o_overseeing_channel_id' => 66,'o_data_analyst_role_id' => 67,'t_sales_role_id' => 28,'infra_operations_role_id' => 65, 'overseer_apac_role_id' => 64, 'travel_role_infra_core' => 62, 't_tech_role_id' => 44, 't_review_t_role_id' => 70)
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
        //$selected = $this->ImagePermission->find('list', array('fields' => array('id')));

        $this->set(compact('Provinces', 'Users', 'selected', 'TravelLookupContinents', 'Approved', 'MappingApproved','TravelCountries'));
    }

    public function edit() {
        $created_by = $this->Auth->user('id');
        $dummy_status = $this->Auth->user('dummy_status');
        $search_condition = array();
        $province_condition = array();
        $selected = array();

        /*
        $permissionArray = $this->ImagePermission->find('first', array('conditions' => array('user_id' => $user_id)));
        $country_id = $permissionArray['ImagePermission']['country_id'];
        $continent_id = $permissionArray['ImagePermission']['continent_id'];
        $maaping_approval_id = $permissionArray['ImagePermission']['maaping_approval_id'];
        $approval_id = $permissionArray['ImagePermission']['approval_id'];
         * 
         */
        //pr($this->request->params['named']);
        if (!empty($this->request->params['named']['user_id'])) {
                $user_id = $this->request->params['named']['user_id'];
                array_push($search_condition, array('ImagePermission.user_id' => $user_id));
            }
        if (!empty($this->request->params['named']['continent_id'])) {
                $continent_id = $this->request->params['named']['continent_id'];
                array_push($search_condition, array('ImagePermission.continent_id' => $continent_id));
            }
       if (!empty($this->request->params['named']['country_id'])) {
                $country_id = $this->request->params['named']['country_id'];
                array_push($search_condition, array('ImagePermission.country_id' => $country_id));
            }     
            
      $permissionArray = $this->ImagePermission->find('first', array('conditions' => $search_condition));


        if ($this->request->is('post') || $this->request->is('put')) {

                 


            $save = array();
            $saved = 0;
            
            if (isset($this->request->data['add'])) {
            //if (!empty($db_req)) {

            foreach ($this->data['ImagePermission']['province_id'] as $province_id) {
                $del = $this->ImagePermission->deleteAll(
                        array(
                    'ImagePermission.province_id' => $province_id,
                    'ImagePermission.user_id' => $user_id,
                    'ImagePermission.continent_id' => $continent_id,
                    'ImagePermission.country_id' => $country_id,
                        ), false);
                if ($del)
                    $save = $saved = 1;
            }
            //}
            //if (!empty($req_db)) {
            $save = array();
            foreach ($this->data['ImagePermission']['province_id'] as $province_id) {
                $save[] = array('ImagePermission' => array(
                        'user_id' => $user_id,
                       
                        'province_id' => $province_id,
                        'country_id' => $country_id,
                      
                        'continent_id' => $continent_id,
                        
                        'created_by' => $created_by
                ));
            }

            $this->ImagePermission->create();
            if ($this->ImagePermission->saveMany($save))
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
        $selected = $this->ImagePermission->find('list', array('fields' => array('province_id'), 'conditions' => array('ImagePermission.user_id' => $user_id,'ImagePermission.country_id' => $country_id,'ImagePermission.continent_id' => $continent_id)));

        $this->set(compact('Provinces', 'Users', 'selected', 'mapping_selected', 'TravelLookupContinents', 'MappingApproved', 'Approved', 'TravelCountries', 'country_id', 'maaping_approval_id', 'approval_id', 'continent_id'));
    }

}


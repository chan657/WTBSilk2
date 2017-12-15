<?php

/**
 * Channel controller.
 *
 * This file will render views from views/channels/
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
 * Channel controller
 *
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class ChannelsController extends AppController {

    var $uses = array('Channel', 'ChannelRole', 'User', 'City', 'LookupValueStatus', 'GroupsUser', 'LookupValueActivityIndustry');
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session');

    public function index() {

        $dummy_status = $this->Auth->user('dummy_status');
        $condition_dummy_status = array('dummy_status' => $dummy_status);
        $search_condition = array();
        if ($dummy_status)
            array_push($search_condition, array('Channel.dummy_status' => $dummy_status));

        $this->paginate['order'] = array('Channel.channel_name' => 'asc');
        $this->set('channels', $this->paginate("Channel", $search_condition));

        $channel_name = $this->Channel->find('list', array('fields' => 'Channel.id, Channel.channel_name', 'conditions' => $condition_dummy_status, 'order' => 'Channel.channel_name ASC'));
        $this->set('channel_name', $channel_name);
        //pr($channel_name);

        $channel_city = $this->City->find('list', array('fields' => array('City.id', 'City.city_name'), 'conditions' => $condition_dummy_status, 'order' => 'City.city_name ASC'));
        $this->set('channel_city', $channel_city);
    }

    public function add() {

        $dummy_status = $this->Auth->user('dummy_status');
        $user_id = $this->Auth->user('id');
        $condition_dummy_status = array('dummy_status' => $dummy_status);


        if ($this->request->is('post')) {

            $this->request->data['Channel']['dummy_status'] = $dummy_status;
            $this->request->data['Channel']['created_by'] = $user_id;
            $this->request->data['Channel']['channel_status'] = '1'; // 1= yes, table of lookup value status 		

            $this->Channel->create();
            if ($this->Channel->save($this->request->data)) {
                $this->Session->setFlash('Channel Name has been saved.', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to add Channel Name.', 'failure');
            }
        }

        $cities = $this->Channel->City->find('all', array('conditions' => $condition_dummy_status, 'order' => 'City.city_name ASC'));
        $arrCity = array();
        if (count($cities) > 0) {
            foreach ($cities as $city) {
                $arrCity[$city['City']['id']] = $city['City']['city_name'];
            }
        }

        $this->set('cities', $arrCity);



        $channelroles = $this->GroupsUser->find('list', array('fields' => array('id', 'name'), 'order' => 'name asc'));
        $this->set(compact('channelroles'));

        $industries = $this->LookupValueActivityIndustry->find('list', array('fields' => array('id', 'value'), 'order' => 'value asc'));
        $this->set(compact('industries'));


        $user = $this->User->find('all', array('fields' => array('User.id', 'User.fname', 'User.lname'), 'conditions' => array('User.dummy_status' => $dummy_status), 'order' => 'User.fname ASC'));
        $arrUser = array();
        if (count($user) > 0) {
            foreach ($user as $usr) {
                $arrUser[$usr['User']['id']] = $usr['User']['fname'] . ' ' . $usr['User']['lname'];
            }
        }
        $this->set('user', $arrUser);
    }

    function edit($id = null, $mode = null) {
        $id = base64_decode($id);
        $this->set(compact('mode'));
        if (!$id) {
            throw new NotFoundException(__('Invalid Channel Name'));
        }

        $channel = $this->Channel->findById($id);

        if (!$channel) {
            throw new NotFoundException(__('Invalid Channel Name'));
        }

        if ($this->request->data) {


            $this->Channel->id = $id;
            if ($this->Channel->save($this->request->data)) {
                $this->Session->setFlash('Your changes have been submitted.', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to update.', 'failure');
            }
        }


        $channelroles = $this->GroupsUser->find('list', array('fields' => array('id', 'name'), 'order' => 'name asc'));
        $this->set(compact('channelroles'));

        $industries = $this->LookupValueActivityIndustry->find('list', array('fields' => array('id', 'value'), 'order' => 'value asc'));
        $this->set(compact('industries'));

        $cities = $this->Channel->City->find('all', array('order' => 'City.city_name ASC'));
        $arrCity = array();
        if (count($cities) > 0) {
            foreach ($cities as $city) {
                $arrCity[$city['City']['id']] = $city['City']['city_name'];
            }
        }
        $this->set('cities', $arrCity);


        $user = $this->User->find('all', array('fields' => array('User.id', 'User.fname', 'User.lname'), 'order' => 'User.fname ASC'));
        $arrUser = array();
        if (count($user) > 0) {
            foreach ($user as $usr) {
                $arrUser[$usr['User']['id']] = $usr['User']['fname'] . ' ' . $usr['User']['lname'];
            }
        }
        $this->set('user', $arrUser);


        $this->request->data = $channel;
    }

    function delete($id = null) {

        if ($this->Channel->delete($id)) {
            $this->Session->setFlash('Channel has been deleted.', 'success');
            $this->redirect(array('action' => 'index'));
        } else {
            $this->Session->setFlash('Unable to delete channel.', 'error');
            $this->redirect(array('action' => 'index'));
        }
    }

}


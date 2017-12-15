<?php

/**
 * DigLot controller.
 *
 * This file will render views from views/DigLots/
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
 * DigLot controller
 *
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class DigLotsController extends AppController {

    var $uses = array('DigLot','Channel','DigLotType','DigBaseUsage');

    public function index() {

        $search_condition = array();
        $user_id = $this->Auth->user('id');        
        $lot_name = '';
        
         if ($this->request->is('post') || $this->request->is('put')) {
            if (!empty($this->data['DigLot']['lot_name'])) {
                $lot_name = $this->data['DigLot']['lot_name'];
                array_push($search_condition, array('DigLot.lot_name' . ' LIKE' => mysql_escape_string(trim(strip_tags($lot_name))) . "%"));
            }
        }
        elseif ($this->request->is('get')) {

            if (!empty($this->request->params['DigLot']['lot_name'])) {
                $lot_name = $this->request->params['DigLot']['lot_name'];
                array_push($search_condition, array("DigLot.lot_name LIKE '%$lot_name%'"));
            }
        }

        $this->paginate['order'] = array('DigLot.created' => 'desc');
        $this->set('DigLots', $this->paginate("DigLot", $search_condition));
        
        
        if (!isset($this->passedArgs['lot_name']) && empty($this->passedArgs['lot_name'])) {
            $this->passedArgs['lot_name'] = (isset($this->data['DigLot']['lot_name'])) ? $this->data['DigLot']['lot_name'] : '';
        }
        
        if (!isset($this->data) && empty($this->data)) {
            $this->data['DigLot']['lot_name'] = $this->passedArgs['lot_name'];
        }
        
        $this->set(compact('lot_name'));
    }

    public function add() {


        $user_id = $this->Auth->user('id');

        if ($this->request->is('post')) {

            $this->request->data['DigLot']['created_by'] = $user_id;
            $this->request->data['DigLot']['lot_status'] = '1'; 

            $this->DigLot->create();

            if ($this->DigLot->save($this->request->data)) {
                $this->Session->setFlash('Data has been successfully saved.', 'success');

                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to add data.', 'failure');
            }
        }

/*
        $DigAccountIndustries = $this->DigAccountIndustry->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigAccountPopularities = $this->DigAccountPopularity->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigAccountTeams = $this->DigAccountTeam->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigAccountUsages = $this->DigAccountUsage->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigBases = $this->DigBase->find('list', array('fields' => 'id,base_website_url', 'order' => 'base_website_url ASC'));
        $DigPersons = $this->DigPerson->find('list', array('fields' => 'id,person_name', 'order' => 'person_name ASC'));
        $DigAccountDofollows = $this->DigBaseDofollow->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
 * 
 */
        $DigLotUsedBies = $this->Channel->find('list', array('fields' => 'Channel.id, Channel.channel_name', 'conditions' => array('Channel.channel_role' => 35))); // 35 marketing group
        $DigLotUsedBies = array('ALL' => 'ALL') + $DigLotUsedBies + array('NONE' => 'NONE');
        $DigLotTypes = $this->DigLotType->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigLotUsageStatus = $this->DigBaseUsage->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        

        $this->set(compact('DigLotUsedBies','DigLotTypes','DigLotUsageStatus'));
    }
    
    public function edit($id = null, $mode = null) {

        //   $id = base64_decode($id);
        $this->set(compact('mode'));
        $id = base64_decode($id);


        if (!$id) {
            throw new NotFoundException(__('Invalid Lot'));
        }

        $DigLots = $this->DigLot->findById($id);

        if (!$DigLots) {
            throw new NotFoundException(__('Invalid Lot'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {

                     

            $this->DigLot->id = $id;
            if ($this->DigLot->save($this->request->data)) {
                $this->Session->setFlash('Data has been successfully saved.', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to save data.', 'failure');
            }
        }

        $DigLotUsedBies = $this->Channel->find('list', array('fields' => 'Channel.id, Channel.channel_name', 'conditions' => array('Channel.channel_role' => 35))); // 35 marketing group
        $DigLotUsedBies = array('ALL' => 'ALL') + $DigLotUsedBies + array('NONE' => 'NONE');
        $DigLotTypes = $this->DigLotType->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigLotUsageStatus = $this->DigBaseUsage->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        

        $this->set(compact('DigLotUsedBies','DigLotTypes','DigLotUsageStatus'));

        if (!$this->request->data) {
            $this->request->data = $DigLots;
        }
    }
}
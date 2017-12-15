<?php

/**
 * TravelBookingService controller.
 *
 * This file will render views from views/TravelBookingServices/
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
 * TravelBookingService controller
 *
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class TravelBookingServicesController extends AppController {

    var $uses = array('TravelBookingService','DigMediaLookupDurationUnit','DigMediaLookupLinkTier','DigBaseType','DigLevel');

    public function index() {
        $search_condition = array();     
        $structure_name = '';
        
         if ($this->request->is('post') || $this->request->is('put')) {
            if (!empty($this->data['TravelBookingService']['structure_name'])) {
                $structure_name = $this->data['TravelBookingService']['structure_name'];
                array_push($search_condition, array('TravelBookingService.structure_name' . ' LIKE' => mysql_escape_string(trim(strip_tags($structure_name))) . "%"));
            }
        }
        elseif ($this->request->is('get')) {

            if (!empty($this->request->params['TravelBookingService']['structure_name'])) {
                $structure_name = $this->request->params['TravelBookingService']['structure_name'];
                array_push($search_condition, array('TravelBookingService.structure_name' . ' LIKE' => mysql_escape_string(trim(strip_tags($structure_name))) . "%"));
            }
        }
        $this->paginate['order'] = array('TravelBookingService.BookingCode' => 'asc');
        $this->set('TravelBookingServices', $this->paginate("TravelBookingService", $search_condition));
        
        if (!isset($this->passedArgs['structure_name']) && empty($this->passedArgs['structure_name'])) {
            $this->passedArgs['structure_name'] = (isset($this->data['TravelBookingService']['structure_name'])) ? $this->data['TravelBookingService']['structure_name'] : '';
        }
        
        if (!isset($this->data) && empty($this->data)) {
            $this->data['TravelBookingService']['structure_name'] = $this->passedArgs['structure_name'];
        }
        
        $this->set(compact('structure_name'));

    }

    public function add() {

        $user_id = $this->Auth->user('id');

        if ($this->request->is('post')) {
            
            $this->request->data['TravelBookingService']['structure_status'] = '1'; // Created
            $this->request->data['TravelBookingService']['created_by'] = $user_id;
            
            if ($this->TravelBookingService->save($this->request->data)) {
                $this->Session->setFlash('Data has been successfully saved.', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to save data.', 'failure');
            }
        }
        
        $DigMediaLookupDurationUnits = $this->DigMediaLookupDurationUnit->find('list', array('fields' => 'value,value', 'order' => 'value ASC'));
        $DigMediaLookupLinkTiers = $this->DigMediaLookupLinkTier->find('list', array('fields' => 'value,value', 'order' => 'value ASC'));
        $DigBaseTypes = $this->DigBaseType->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigLevels = $this->DigLevel->find('list', array('fields' => 'id,level_name', 'order' => 'level_name ASC'));
       
        $this->set(compact('DigMediaLookupDurationUnits','DigMediaLookupLinkTiers','DigBaseTypes','DigLevels'));
       
    }
    
    public function edit($id = null, $mode = null) {

        $this->set(compact('mode'));
        $id = base64_decode($id);


        if (!$id) {
            throw new NotFoundException(__('Invalid Structure'));
        }

        $TravelBookingServices = $this->TravelBookingService->findById($id);

        if (!$TravelBookingServices) {
            throw new NotFoundException(__('Invalid Structure'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {



            $this->TravelBookingService->id = $id;
            if ($this->TravelBookingService->save($this->request->data)) {
                $this->Session->setFlash('Data has been successfully saved.', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to save data.', 'failure');
            }
        }

        $DigMediaLookupDurationUnits = $this->DigMediaLookupDurationUnit->find('list', array('fields' => 'value,value', 'order' => 'value ASC'));
        $DigMediaLookupLinkTiers = $this->DigMediaLookupLinkTier->find('list', array('fields' => 'value,value', 'order' => 'value ASC'));
        $DigBaseTypes = $this->DigBaseType->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigLevels = $this->DigLevel->find('list', array('fields' => 'id,level_name', 'order' => 'level_name ASC'));
       
        $this->set(compact('DigMediaLookupDurationUnits','DigMediaLookupLinkTiers','DigBaseTypes','DigLevels'));

        if (!$this->request->data) {
            $this->request->data = $TravelBookingServices;
        }
    }
}
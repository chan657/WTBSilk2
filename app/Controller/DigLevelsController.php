<?php

/**
 * DigLevel controller.
 *
 * This file will render views from views/DigLevels/
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
 * DigLevel controller
 *
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class DigLevelsController extends AppController {

    var $uses = array('DigLevel','DigMediaLookupDurationUnit','DigMediaLookupLinkTier','DigBaseType','DigPattern');

    public function index() {
        $search_condition = array();   
        $level_name = '';
        
         if ($this->request->is('post') || $this->request->is('put')) {
            if (!empty($this->data['DigLevel']['level_name'])) {
                $level_name = $this->data['DigLevel']['level_name'];
                array_push($search_condition, array('DigLevel.level_name' . ' LIKE' => mysql_escape_string(trim(strip_tags($level_name))) . "%"));
            }
        }
        elseif ($this->request->is('get')) {

            if (!empty($this->request->params['DigLevel']['level_name'])) {
                $level_name = $this->request->params['DigLevel']['level_name'];
                array_push($search_condition, array('DigLevel.level_name' . ' LIKE' => mysql_escape_string(trim(strip_tags($level_name))) . "%"));
            }
        }
        
        $this->paginate['order'] = array('DigLevel.level_name' => 'asc');
        $this->set('DigLevels', $this->paginate("DigLevel", $search_condition));
        
        if (!isset($this->passedArgs['level_name']) && empty($this->passedArgs['level_name'])) {
            $this->passedArgs['level_name'] = (isset($this->data['DigLevel']['level_name'])) ? $this->data['DigLevel']['level_name'] : '';
        }
        
        if (!isset($this->data) && empty($this->data)) {
            $this->data['DigLevel']['level_name'] = $this->passedArgs['level_name'];
        }
        
        $this->set(compact('level_name'));

    }

    public function add() {

        $user_id = $this->Auth->user('id');

        if ($this->request->is('post')) {
            
            $this->request->data['DigLevel']['level_status'] = '1'; // Created
            $this->request->data['DigLevel']['created_by'] = $user_id;
            
            if ($this->DigLevel->save($this->request->data)) {
                $this->Session->setFlash('Data has been successfully saved.', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to save data.', 'failure');
            }
        }
        
        $DigMediaLookupDurationUnits = $this->DigMediaLookupDurationUnit->find('list', array('fields' => 'value,value', 'order' => 'value ASC'));
        $DigMediaLookupLinkTiers = $this->DigMediaLookupLinkTier->find('list', array('fields' => 'value,value', 'order' => 'value ASC'));
        $DigBaseTypes = $this->DigBaseType->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigPatterns = $this->DigPattern->find('list', array('fields' => 'id,pattern_name', 'order' => 'pattern_name ASC'));
       
        $this->set(compact('DigMediaLookupDurationUnits','DigMediaLookupLinkTiers','DigBaseTypes','DigPatterns'));
       
    }
    
    public function edit($id = null, $mode = null) {

        $id = base64_decode($id);
        $this->set(compact('mode'));


        if (!$id) {
            throw new NotFoundException(__('Invalid Level'));
        }

        $DigLevels = $this->DigLevel->findById($id);

        if (!$DigLevels) {
            throw new NotFoundException(__('Invalid Level'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {



            $this->DigLotLink->id = $id;
            if ($this->DigLotLink->save($this->request->data)) {
                $this->Session->setFlash('Data has been successfully saved.', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to save data.', 'failure');
            }
        }

        $DigMediaLookupDurationUnits = $this->DigMediaLookupDurationUnit->find('list', array('fields' => 'value,value', 'order' => 'value ASC'));
        $DigMediaLookupLinkTiers = $this->DigMediaLookupLinkTier->find('list', array('fields' => 'value,value', 'order' => 'value ASC'));
        $DigBaseTypes = $this->DigBaseType->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigPatterns = $this->DigPattern->find('list', array('fields' => 'id,pattern_name', 'order' => 'pattern_name ASC'));
       
        $this->set(compact('DigMediaLookupDurationUnits','DigMediaLookupLinkTiers','DigBaseTypes','DigPatterns'));

        if (!$this->request->data) {
            $this->request->data = $DigLevels;
        }
    }
}
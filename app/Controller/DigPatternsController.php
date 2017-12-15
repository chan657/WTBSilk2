<?php

/**
 * DigPattern controller.
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

/**
 * DigPattern controller
 *
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class DigPatternsController extends AppController {

    var $uses = array('DigPattern', 'DigMediaLookupDurationUnit', 'DigMediaLookupLinkTier', 'DigBaseType', 'DigPatternPerson', 'Channel', 'DigPerson','DigPatternLot','DigLot');

    public function index() {
        
        $search_condition = array();        
        $pattern_name = '';
        
         if ($this->request->is('post') || $this->request->is('put')) {
            if (!empty($this->data['DigPattern']['pattern_name'])) {
                $pattern_name = $this->data['DigPattern']['pattern_name'];
                array_push($search_condition, array('DigPattern.pattern_name' . ' LIKE' => mysql_escape_string(trim(strip_tags($pattern_name))) . "%"));
            }
        }
        elseif ($this->request->is('get')) {

            if (!empty($this->request->params['DigPattern']['pattern_name'])) {
                $pattern_name = $this->request->params['DigPattern']['pattern_name'];
                array_push($search_condition, array("DigPattern.pattern_name LIKE '%$pattern_name%'"));
            }
        }
        
        $this->paginate['order'] = array('DigPattern.pattern_name' => 'asc');
        $this->set('DigPatterns', $this->paginate("DigPattern", $search_condition));
        
        if (!isset($this->passedArgs['pattern_name']) && empty($this->passedArgs['pattern_name'])) {
            $this->passedArgs['pattern_name'] = (isset($this->data['DigPattern']['pattern_name'])) ? $this->data['DigPattern']['pattern_name'] : '';
        }
        
        if (!isset($this->data) && empty($this->data)) {
            $this->data['DigPattern']['pattern_name'] = $this->passedArgs['pattern_name'];
        }
        
        $this->set(compact('pattern_name'));
    }

    public function add() {

        $user_id = $this->Auth->user('id');

        if ($this->request->is('post')) {

            $this->request->data['DigPattern']['pattern_status'] = '1'; // Created
            $this->request->data['DigPattern']['created_by'] = $user_id;

            if ($this->DigPattern->save($this->request->data)) {
                $this->Session->setFlash('Data has been successfully saved.', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to save data.', 'failure');
            }
        }

        $DigMediaLookupDurationUnits = $this->DigMediaLookupDurationUnit->find('list', array('fields' => 'value,value', 'order' => 'value ASC'));
        $DigMediaLookupLinkTiers = $this->DigMediaLookupLinkTier->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigBaseTypes = $this->DigBaseType->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));

        $this->set(compact('DigMediaLookupDurationUnits', 'DigMediaLookupLinkTiers', 'DigBaseTypes'));
    }

    public function edit($id = null, $mode = null) {

        //   $id = base64_decode($id);
        $this->set(compact('mode'));
        $user_id = $this->Auth->user('id');


        if (!$id) {
            throw new NotFoundException(__('Invalid Pattern'));
        }

        $DigPatterns = $this->DigPattern->findById($id);

        if (!$DigPatterns) {
            throw new NotFoundException(__('Invalid Pattern'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {

            $this->request->data['DigPatterns']['pattern_status'] = '1'; // Created
            $this->request->data['DigPatterns']['created_by'] = $user_id;

            $this->DigPattern->id = $id;
            if ($this->DigPattern->save($this->request->data)) {
                $this->Session->setFlash('Data has been successfully saved.', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to save data.', 'failure');
            }
        }

        $DigMediaLookupDurationUnits = $this->DigMediaLookupDurationUnit->find('list', array('fields' => 'value,value', 'order' => 'value ASC'));
        $DigMediaLookupLinkTiers = $this->DigMediaLookupLinkTier->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigBaseTypes = $this->DigBaseType->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigPatternPersons = $this->DigPatternPerson->find('all');
        $DigPatternLots = $this->DigPatternLot->find('all');

        $this->set(compact('DigMediaLookupDurationUnits', 'DigMediaLookupLinkTiers', 'DigBaseTypes', 'DigPatternPersons','DigPatternLots'));

        if (!$this->request->data) {
            $this->request->data = $DigPatterns;
        }
    }

    public function add_person($pattern_id) {

        $this->layout = '';
        $user_id = $this->Auth->user('id');

        if ($this->request->is('post')) {

            $this->request->data['DigPatternPerson']['pattern_id'] = $pattern_id; // Created
            $this->request->data['DigPatternPerson']['user_id'] = $user_id;

            if ($this->DigPatternPerson->save($this->request->data)) {
                $this->Session->setFlash('Data has been successfully saved.', 'success');
                //  $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to save data.', 'failure');
            }

            echo '<script>
				 			var objP=parent.document.getElementsByClassName("mfp-bg");
							var objC=parent.document.getElementsByClassName("mfp-wrap");
							objP[0].style.display="none";
							objC[0].style.display="none";
							parent.location.reload(true);</script>';
        }

        $Channels = $this->Channel->find('list', array('fields' => 'Channel.id, Channel.channel_name')); // 35 marketing group
        $DigPersons = $this->DigPerson->find('list', array('fields' => 'id, person_name'));

        $this->set(compact('Channels', 'DigPersons'));
    }

    public function add_lot($pattern_id) {

        $this->layout = '';
        $user_id = $this->Auth->user('id');

        if ($this->request->is('post')) {

            $this->request->data['DigPatternLot']['pattern_id'] = $pattern_id; // Created
            
            if ($this->DigPatternLot->save($this->request->data)) {
                $this->Session->setFlash('Data has been successfully saved.', 'success');
                //  $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to save data.', 'failure');
            }

            echo '<script>
				 			var objP=parent.document.getElementsByClassName("mfp-bg");
							var objC=parent.document.getElementsByClassName("mfp-wrap");
							objP[0].style.display="none";
							objC[0].style.display="none";
							parent.location.reload(true);</script>';
        }

        $Channels = $this->Channel->find('list', array('fields' => 'Channel.id, Channel.channel_name')); // 35 marketing group
        $DigLots = $this->DigLot->find('list', array('fields' => 'id, lot_name'));

        $this->set(compact('Channels', 'DigLots'));
    }

}
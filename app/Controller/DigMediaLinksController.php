<?php

/**
 * DigMediaLink controller.
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
 * DigMediaLink controller
 *
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class DigMediaLinksController extends AppController {

    var $uses = array('DigMediaLink','DigMediaLookupDurationUnit','DigMediaLookupLinkType','DigMediaLookupLinkTier');
    public $components = array('Sms', 'Image');
    public $uploadDir;

    public function beforeFilter() {
        parent::beforeFilter();
        $this->uploadDir = ROOT . DS . APP_DIR . DS . WEBROOT_DIR . '/uploads/DigMediaTasks';
    }


    public function add($task_id = null) {

        $this->layout = '';
        $user_id = $this->Auth->user('id');
        
      // echo date('Y-m-d h:i:s', strtotime("+1 Days"));
       // echo $timestamp = strtotime(date('Y-m-d h:i:s'));


       
        if ($this->request->is('post')) {
            
            if(!empty($this->data['DigMediaLink']['link_duration']) && !empty($this->data['DigMediaLink']['link_duration_unit'])){
                $this->request->data['DigMediaLink']['link_delivery_date'] = date('Y-m-d h:i:s',strtotime("+".$this->data['DigMediaLink']['link_duration'].' '.$this->data['DigMediaLink']['link_duration_unit'],strtotime($this->data['DigMediaLink']['start_date'])));
            }
            
            $this->request->data['DigMediaLink']['link_task_id'] = $task_id; 
            $this->request->data['DigMediaLink']['created_by'] = $user_id;
            $this->request->data['DigMediaLink']['link_status'] = '1'; // saved draft
            
            $this->DigMediaLink->create();
            
            if ($this->DigMediaLink->save($this->request->data)) {
                $this->Session->setFlash('Link has been successfully saved.', 'success');
               
                //$this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to add link.', 'failure');
            }
            
             echo '<script>
				 			var objP=parent.document.getElementsByClassName("mfp-bg");
							var objC=parent.document.getElementsByClassName("mfp-wrap");
							objP[0].style.display="none";
							objC[0].style.display="none";
							parent.location.reload(true);</script>';
        }


        $DigMediaLookupLinkTiers = $this->DigMediaLookupLinkTier->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $this->set(compact('DigMediaLookupLinkTiers'));

        $DigMediaLookupDurationUnits = $this->DigMediaLookupDurationUnit->find('list', array('fields' => 'value,value', 'order' => 'value ASC'));       
        $this->set(compact('DigMediaLookupDurationUnits'));       

        $DigMediaLookupLinkTypes = $this->DigMediaLookupLinkType->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $this->set(compact('DigMediaLookupLinkTypes'));
    }

}
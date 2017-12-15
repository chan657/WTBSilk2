<?php
/**
 * Payments controller.
 *
 * This file will render views from views/Payments/
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
 * Payments controller
 *
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PaymentsController extends AppController {
	
	var $uses = array('City','LookupValueStatus','Reimbursement','Event','ActionItem','Payment','User','LookupValueReimbursementType_1','LookupValueReimbursementType_2','LookupValueActivityLevel','Channel');

	public function index() {
		
		$dummy_status = $this->Auth->user('dummy_status');
		$user_id = $this->Auth->user('id');
		$channel_id = $this->Session->read("channel_id");
		$role_id = $this->Session->read("role_id");

		


	 
	$all_count = $this->Reimbursement->find('count',array('conditions' => array('Reimbursement.dummy_status' => $dummy_status))); // approve
	$this->set(compact('all_count'));
	
	$paid_count = $this->Reimbursement->find('count',array('conditions' => array('Reimbursement.dummy_status' => $dummy_status,'Reimbursement.reimbursement_status' => 3)));
	$this->set(compact('paid_count'));
	
	$pending_count = $this->Reimbursement->find('count',array('conditions' => array('Reimbursement.dummy_status' => $dummy_status,'Reimbursement.reimbursement_status' => 2)));
	$this->set(compact('pending_count'));
	
	
	}

	
	public function edit($id = null,$mode = null) {
		
		$id = base64_decode($id);
		$this->set(compact('mode'));
		
		
				
		if (!$id) {
			throw new NotFoundException(__('Invalid City'));
		}
	
		$city = $this->City->findById($id);
		
		if (!$city) {
			throw new NotFoundException(__('Invalid City'));
		}
	
		if ($this->request->data) {
			
			$this->City->id = $id;
			$this->City->set($this->data);
            if ($this->City->validates() == true) {
				if ($this->City->save($this->request->data)) {
					$this->Session->setFlash('City has been updated.','success');
					$this->redirect(array('action' => 'index'));
				}
				else {
					$this->Session->setFlash('Unable to update city.','failure');
				}
			}
			 
		}
	
		if (!$this->request->data) {
			$this->request->data = $city;
		}
	}

}
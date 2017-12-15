<?php
/**
 * City controller.
 *
 * This file will render views from views/cities/
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
 * City controller
 *
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class CitiesController extends AppController {
	var $uses = array('City','LookupValueStatus');
	
	public $helpers = array('Html', 'Form', 'Session');
	public $components = array('Session');
	

	public function index() {
		
		$dummy_status = $this->Auth->user('dummy_status');
		$condition_dummy_status = array('dummy_status' => $dummy_status);
		$search_condition = array();
		if($dummy_status)	
			 array_push($search_condition, array('City.dummy_status' => $dummy_status));
		
		$this->paginate['order'] = array('City.city_name' => 'asc');
		$this->set('cities', $this->paginate("City", $search_condition));
		
		
	}
	
	public function add() {

		$dummy_status = $this->Auth->user('dummy_status');
		$user_id = $this->Auth->user('id');
		$this->request->data['City']['dummy_status'] = $dummy_status;
		$this->request->data['City']['created_by'] = $user_id;
		
		
        if ($this->request->is('post')) {
            $this->City->create();
            if ($this->City->save($this->request->data)) {
                $this->Session->setFlash('City has been saved.','success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to add city.','failure');
            }
        }	
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
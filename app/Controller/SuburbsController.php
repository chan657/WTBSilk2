<?php
/**
 * Suburb controller.
 *
 * This file will render views from views/suburbs/
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
 * Suburb controller
 *
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class SuburbsController extends AppController {
	var $uses = array('Suburb','LookupValueStatus');

	public function index() {
		
		$dummy_status = $this->Auth->user('dummy_status');
		$condition_dummy_status = array('dummy_status' => $dummy_status);
		$search_condition = array();
		$suburb_name = '';
		$city_id = '';
		
		if ($this->request->is('post') || $this->request->is('put')) {
			 if (!empty($this->data['Suburb']['suburb_name'])) {
                $suburb_name = $this->data['Suburb']['suburb_name'];
                array_push($search_condition, array("Suburb.suburb_name LIKE '%$suburb_name%'"));
            }
			
			if (!empty($this->data['Suburb']['city_id'])) {
                $city_id = $this->data['Suburb']['city_id'];
                array_push($search_condition, array('Suburb.city_id' => $city_id));
            }
		}
		
		elseif ($this->request->is('get')) {
		
			if (!empty($this->request->params['named']['suburb_name'])) {
                $suburb_name = $this->request->params['named']['suburb_name'];
				 array_push($search_condition, array("Suburb.suburb_name LIKE '%$suburb_name%'"));
                
            }
			
            if (!empty($this->request->params['named']['city_id'])) {
                $city_id = $this->request->params['named']['city_id'];
				 array_push($search_condition, array('Suburb.city_id' => $city_id));
                
            }
		}	
		//pr($search_condition);
		if($dummy_status)	
			 array_push($search_condition, array('Suburb.dummy_status' => $dummy_status));
		
		$this->paginate['order'] = array('Suburb.suburb_name' => 'asc');
		$suburbs = $this->paginate("Suburb", $search_condition);
		$this->set(compact('suburbs'));
				
		
		$cities = $this->Suburb->City->find('all', array('conditions' => array('dummy_status' => $dummy_status,'city_status' => '1'),'order' => 'City.city_name ASC'));
		$arrCity = array();
		if (count($cities) > 0)
		{
			foreach ($cities as $city)
			{
				$arrCity[$city['City']['id']] = $city['City']['city_name'];
			}
		}
		
		$this->set('cities', $arrCity);
		
		if (!isset($this->passedArgs['city_id']) && empty($this->passedArgs['city_id'])) {
            $this->passedArgs['city_id'] = (isset($this->data['Suburb']['city_id'])) ? $this->data['Suburb']['city_id'] : '';
        }
		if (!isset($this->passedArgs['suburb_name']) && empty($this->passedArgs['suburb_name'])) {
            $this->passedArgs['suburb_name'] = (isset($this->data['Suburb']['suburb_name'])) ? $this->data['Suburb']['suburb_name'] : '';
        }
		if (!isset($this->data) && empty($this->data)) {
            $this->data['Suburb']['city_id'] = $this->passedArgs['city_id'];
			$this->data['Suburb']['suburb_name'] = $this->passedArgs['suburb_name'];
        }
			
		$this->set(compact('city_id'));	
		$this->set(compact('suburb_name'));	
		
	
		
	}
	
	public function add() {
	
		$dummy_status = $this->Auth->user('dummy_status');
		$condition_dummy_status = array('dummy_status' => $dummy_status);
		$this->request->data['Suburb']['dummy_status'] = $dummy_status;
		$user_id = $this->Auth->user('id');
	
        if ($this->request->is('post')) {
		
			//$this->request->data['Suburb']['suburb_status'] = '1'; // 1= yes, table of lookup value status 
			$this->request->data['Suburb']['dummy_status'] = $dummy_status;
			$this->request->data['Suburb']['created_by'] = $user_id;
            $this->Suburb->create();
            if ($this->Suburb->save($this->request->data)) {
                $this->Session->setFlash('Suburb has been saved.','success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to add Suburb.','failure');
            }
        }	
		
		$cities = $this->Suburb->City->find('all', array('conditions' => array('City.dummy_status' => $dummy_status,'City.city_status' => '1'),'order' => 'City.city_name ASC'));
		$arrCity = array();
		if (count($cities) > 0)
		{
			foreach ($cities as $city)
			{
				$arrCity[$city['City']['id']] = $city['City']['city_name'];
			}
		}
		
		$this->set('cities', $arrCity);
	}


	
 public function edit($id = null,$mode = null)
	 {
	 	$dummy_status = $this->Auth->user('dummy_status');
		$id = base64_decode($id);
		$this->set(compact('mode'));
		if (!$id) {
			throw new NotFoundException(__('Invalid Suburb'));
		}
	
		$suburb = $this->Suburb->findById($id);
		
		if (!$suburb) {
			throw new NotFoundException(__('Invalid suburb'));
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			 $this->Suburb->set($this->data);
            if ($this->Suburb->validates() == true) {
			
				$this->Suburb->id = $id;
				if ($this->Suburb->save($this->request->data)) {
					$this->Session->setFlash('Suburb has been updated.','success');
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash('Unable to update Suburb.','failure');
				}
			}
		}
		
		$status = $this->LookupValueStatus->find('list',array('fields' => array('id','value')));
		$this->set(compact('status'));
	
		
		$cities = $this->Suburb->City->find('all', array('conditions' => array('City.dummy_status' => $dummy_status),'order' => 'City.city_name ASC'));
		$arrCity = array();
		if (count($cities) > 0)
		{
			foreach ($cities as $city)
			{
				$arrCity[$city['City']['id']] = $city['City']['city_name'];
			}
		}
		$this->set('cities', $arrCity);
	
		$this->request->data = $suburb;
		
	}

}
	 
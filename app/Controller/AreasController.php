<?php
/**
 * Area controller.
 *
 * This file will render views from views/areas/
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
 * Area controller
 *
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class AreasController extends AppController {

	var $uses =array( 'Builder','Area', 'Suburb','City','LookupValueStatus');

	public function index() {
	
                $view = new View($this);
                $Custom = $view->loadHelper('Custom');
               echo $test = $Custom->ConvertGMTToLocalTimezone(date('d/m/y H:i:s'), 'Asia/Calcutta');
               //echo $this->Custom->sayHello();
		$dummy_status = $this->Auth->user('dummy_status');
		$condition_dummy_status = array('dummy_status' => $dummy_status);
		$search_condition = array();
		$city_id = '';
		$suburb_id = '';
		$area_name = '';
		
		if ($this->request->is('post') || $this->request->is('put')) {
			
			 if (!empty($this->data['Area']['area_name'])) {
                $area_name = $this->data['Area']['area_name'];
                array_push($search_condition, array("Area.area_name LIKE '%$area_name%'"));
            }
			
			if (!empty($this->data['Area']['city_id'])) {
                $city_id = $this->data['Area']['city_id'];
                array_push($search_condition, array('Area.city_id' => $city_id));
            }
			if (!empty($this->data['Area']['suburb_id'])) {
                $suburb_id = $this->data['Area']['suburb_id'];
                array_push($search_condition, array('Area.suburb_id' => $suburb_id));
            }
		}
		
		elseif ($this->request->is('get')) {
		
			if (!empty($this->request->params['named']['area_name'])) {
                $area_name = $this->request->params['named']['area_name'];
				 array_push($search_condition, array("Area.area_name LIKE '%$area_name%'"));
                
            }
			
            if (!empty($this->request->params['named']['city_id'])) {
                $city_id = $this->request->params['named']['city_id'];
				 array_push($search_condition, array('Area.city_id' => $city_id));
                
            }
			 if (!empty($this->request->params['named']['suburb_id'])) {
                $suburb_id = $this->request->params['named']['suburb_id'];
				 array_push($search_condition, array('Area.suburb_id' => $suburb_id));
                
            }
        }
		
		if($dummy_status)	
			 array_push($search_condition, array('Area.dummy_status' => $dummy_status));
		
		$this->paginate['order'] = array('Area.area_name' => 'asc');
		
		$areas = $this->paginate("Area", $search_condition);
		$this->set(compact('areas'));

		//$this->set('areas', $this->paginate("Area", $search_condition));
		
		
		
		$city = $this->City->find('list', array('fields' => 'City.id, City.city_name','conditions' => $condition_dummy_status, 'order' => 'City.city_name ASC'));
		$this->set('city', $city);
		
		$conSub = array('Suburb.dummy_status' => $dummy_status,'Suburb.city_id' => $city_id);
			
		$suburb = $this->Suburb->find('list', array('fields' => 'Suburb.id, Suburb.suburb_name','conditions' => $conSub, 'order' => 'Suburb.suburb_name ASC'));
		$this->set('suburb', $suburb);
		
		$area = $this->Area->find('list', array('fields' => 'Area.id, Area.area_name','conditions' => $condition_dummy_status, 'order' => 'Area.area_name ASC'));
		$this->set('area', $area);
		
		if (!isset($this->passedArgs['city_id']) && empty($this->passedArgs['city_id'])) {
            $this->passedArgs['city_id'] = (isset($this->data['Area']['city_id'])) ? $this->data['Area']['city_id'] : '';
        }
		if (!isset($this->passedArgs['suburb_id']) && empty($this->passedArgs['suburb_id'])) {
            $this->passedArgs['suburb_id'] = (isset($this->data['Area']['suburb_id'])) ? $this->data['Area']['suburb_id'] : '';
        }
		if (!isset($this->passedArgs['area_name']) && empty($this->passedArgs['area_name'])) {
            $this->passedArgs['area_name'] = (isset($this->data['Area']['area_name'])) ? $this->data['Area']['area_name'] : '';
        }
        if (!isset($this->data) && empty($this->data)) {
            $this->data['Area']['city_id'] = $this->passedArgs['city_id'];
			$this->data['Area']['suburb_id'] = $this->passedArgs['suburb_id'];
			$this->data['Area']['area_name'] = $this->passedArgs['area_name'];
        }

		$this->set(compact('city_id'));
		$this->set(compact('suburb_id'));
		$this->set(compact('area_name'));
		
	}
	
	public function add() {
	
		$dummy_status = $this->Auth->user('dummy_status');
		$user_id = $this->Auth->user('id');
	
        if ($this->request->is('post')) {
			//$this->request->data['Area']['area_status'] = '1'; // 1= yes, table of lookup value status 
			$this->request->data['Area']['dummy_status'] = $dummy_status;
			$this->request->data['Area']['created_by'] = $user_id;
            $this->Area->create();
            if ($this->Area->save($this->request->data)) {
                $this->Session->setFlash('Area has been saved.','success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to add area.','failure');
            }
        }
		
		$cities = $this->City->find('list', array('fields' => 'City.id, City.city_name','conditions' => array('City.dummy_status' => $dummy_status), 'order' => 'City.city_name ASC'));
        $this->set(compact('cities'));
	}
	
	public function edit($id = null,$mode = null) {
		$id = base64_decode($id);
		$dummy_status = $this->Auth->user('dummy_status');
		$this->set(compact('mode'));
	
		if (!$id) {
			throw new NotFoundException(__('Invalid Area'));
		}
		
		$area = $this->Area->findById($id);

		if (!$area) {
			throw new NotFoundException(__('Invalid Area'));
		}

		if ($this->request->data) {
			
			$this->Area->id = $id;
			
			if ($this->Area->save($this->request->data)) {
				$this->Session->setFlash('Area has been updated.','success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('Unable to update area.','failure');
			}
		}

		
		$suburbs = $this->Suburb->find('list', array('fields' => 'Suburb.id, Suburb.suburb_name','conditions' => array('Suburb.dummy_status' => $dummy_status,'Suburb.city_id' => $area['Area']['city_id']), 'order' => 'Suburb.suburb_name ASC'));
        $this->set(compact('suburbs'));
		
		$cities = $this->City->find('list', array('fields' => 'City.id, City.city_name','conditions' => array('City.dummy_status' => $dummy_status), 'order' => 'City.city_name ASC'));
        $this->set(compact('cities'));
		
		$this->request->data = $area;  
	 
	}

}
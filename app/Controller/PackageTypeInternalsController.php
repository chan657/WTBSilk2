<?php
/**
 * City controller.
 *
 * This file will render views from views/PackageTypeInternals/
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
 * PackageTypeInternals controller
 *
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PackageTypeInternalsController extends AppController {
	var $uses = array('PackageTypeInternal');
		

	public function index() {
		
		
		$search_condition = array();
		
		
		//$this->paginate['order'] = array('City.city_name' => 'asc');
		$this->set('PackageTypeInternals', $this->paginate("PackageTypeInternal", $search_condition));
		
		
	}
	
	public function add() {

		
		$user_id = $this->Auth->user('id');
		$this->request->data['PackageTypeInternal']['IsActive'] = '1';
		
		
		
        if ($this->request->is('post')) {

            $this->PackageTypeInternal->create();
            if ($this->PackageTypeInternal->save($this->request->data)) {
                $this->Session->setFlash('Data has been saved.','success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to add data.','failure');
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
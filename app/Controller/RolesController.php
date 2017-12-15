<?php

/**
 * Roles controller.
 *
 * This file will render views from views/roles/
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
 * Roles controller
 *
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class RolesController extends AppController {

    var $name = 'Roles';
   
    var $uses = array('Role','ControllerSet','GroupsUser','LookupValueActivityIndustry');
    

   
    
    /**
     * List all role present in the site.
     *
     * @return null    This method does not return any data.
    
     */

    public function index() {
       // $this->insert_controllers_actions_into_permission_table();

        
        $search_condition = array();
        
         if ($this->request->is('post') || $this->request->is('put')) {
            if (!empty($this->data['Role']['search_value'])) {
                $search = $this->data['Role']['search_value'];
                array_push($search_condition, array('Role.name' . ' LIKE' => mysql_escape_string(trim(strip_tags($search))) . "%"));
             } 
        } 

         $this->set('roles', $this->paginate("Role", $search_condition));
      
    }

     /**
     * Add new role to the database. On sussess or failure, shows messages.
     *
     * @return null    This method does not return any data.
     */
    public function add() {

        if ($this->request->is('post') || $this->request->is('put')) {

            $this->Role->set($this->data);

            if ($this->Role->validates() == true) {

                if ($this->Role->save($this->request->data)) {
                    $this->Session->setFlash('Role has been saved.', 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to add Role.', 'error');
                }
            }
        }
        $groupsusers = $this->GroupsUser->find('list',array('id','name'));
        $this->set(compact('groupsusers'));
        
        $industries = $this->LookupValueActivityIndustry->find('list', array('fields' => array('id', 'value'), 'order' => 'value asc'));
        $this->set(compact('industries'));
        
    }

    /**
     * Edit role and on sussess or failure, shows messages.
     * 
     * @param intiger $id Either value or null.
     * @return null    This method does not return any data.
     */
    public function edit($id = null,$mode = null) {
        $id = base64_decode($id);
		$this->set(compact('mode'));
        
        if (!$id) {
            throw new NotFoundException(__('Invalid Role'));
        }

        $role = $this->Role->findById($id);

        if (!$role) {
            throw new NotFoundException(__('Invalid Role'));
        }

        if ($this->request->data) {

            $this->Role->id = $id;
            if ($this->Role->save($this->request->data)) {
                $this->Session->setFlash('Role has been updated.', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to update Role.', 'failure');
            }
        }

        if (!$this->request->data) {
            $this->request->data = $role;
            $groupsusers = $this->GroupsUser->find('list',array('id','name'));
            $this->set(compact('groupsusers'));
        }
    }
    
    

}

?>

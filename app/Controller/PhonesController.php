<?php

/**
 * Test controller.
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
class RestPhonesController extends AppController {
    public $uses = array('Phone');
    public $components = array('RequestHandler');
 
 
    public function index() {
        $phones = $this->Phone->find('all');
        $this->set(array(
            'phones' => $phones,
            '_serialize' => array('phones')
        ));
    }
 
    public function add() {
        $this->Phone->create();
        if ($this->Phone->save($this->request->data)) {
             $message = 'Created';
        } else {
            $message = 'Error';
        }
        $this->set(array(
            'message' => $message,
            '_serialize' => array('message')
        ));
    }
     
    public function view($id) {
        $phone = $this->Phone->findById($id);
        $this->set(array(
            'phone' => $phone,
            '_serialize' => array('phone')
        ));
    }
 
     
    public function edit($id) {
        $this->Phone->id = $id;
        if ($this->Phone->save($this->request->data)) {
            $message = 'Saved';
        } else {
            $message = 'Error';
        }
        $this->set(array(
            'message' => $message,
            '_serialize' => array('message')
        ));
    }
     
    public function delete($id) {
        if ($this->Phone->delete($id)) {
            $message = 'Deleted';
        } else {
            $message = 'Error';
        }
        $this->set(array(
            'message' => $message,
            '_serialize' => array('message')
        ));
    }
}       
  
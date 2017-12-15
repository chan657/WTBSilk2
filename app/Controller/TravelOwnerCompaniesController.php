<?php

/**
 * TravelOwnerCompanies controller.
 *
 * This file will render views from views/TravelOwnerCompanies/
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
 * TravelOwnerCompanies controller
 *
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class TravelOwnerCompaniesController extends AppController {

    var $uses = array('TravelOwnerCompany', 'TravelCountry');

    public function index() {


        $search_condition = array();
        $owner_company_name = '';
        $owner_company_category = '';

        if ($this->request->is('post') || $this->request->is('put')) {
            if (!empty($this->data['TravelOwnerCompany']['owner_company_name'])) {
                $owner_company_name = $this->data['TravelOwnerCompany']['owner_company_name'];
                array_push($search_condition, array("TravelOwnerCompany.owner_company_name LIKE '%$owner_company_name%'"));
            }

            if (!empty($this->data['TravelOwnerCompany']['owner_company_category'])) {
                $owner_company_category = $this->data['TravelOwnerCompany']['owner_company_category'];
                array_push($search_condition, array('TravelOwnerCompany.owner_company_category' => $owner_company_category));
            }
        } elseif ($this->request->is('get')) {

            if (!empty($this->request->params['named']['owner_company_name'])) {
                $owner_company_name = $this->request->params['named']['owner_company_name'];
                array_push($search_condition, array("TravelOwnerCompany.owner_company_name LIKE '%$owner_company_name%'"));
            }

            if (!empty($this->request->params['named']['owner_company_category'])) {
                $owner_company_category = $this->request->params['named']['owner_company_category'];
                array_push($search_condition, array('TravelOwnerCompany.owner_company_category' => $owner_company_category));
            }
        }
        $this->paginate['order'] = array('TravelOwnerCompany.owner_company_name' => 'asc');
        $this->set('TravelOwnerCompanies', $this->paginate("TravelOwnerCompany", $search_condition));


        if (!isset($this->passedArgs['owner_company_name']) && empty($this->passedArgs['owner_company_name'])) {
            $this->passedArgs['owner_company_name'] = (isset($this->data['TravelOwnerCompany']['owner_company_name'])) ? $this->data['TravelOwnerCompany']['owner_company_name'] : '';
        }
        if (!isset($this->passedArgs['owner_company_category']) && empty($this->passedArgs['owner_company_category'])) {
            $this->passedArgs['owner_company_category'] = (isset($this->data['TravelOwnerCompany']['owner_company_category'])) ? $this->data['TravelOwnerCompany']['owner_company_category'] : '';
        }

        if (!isset($this->data) && empty($this->data)) {

            $this->data['TravelOwnerCompany']['owner_company_name'] = $this->passedArgs['owner_company_name'];
            $this->data['TravelOwnerCompany']['owner_company_category'] = $this->passedArgs['owner_company_category'];
        }

        $this->set(compact('owner_company_category'));
        $this->set(compact('owner_company_name'));
    }

    public function add() {

        $user_id = $this->Auth->user('id');

        if ($this->request->is('post')) {

            $this->request->data['TravelOwnerCompany']['created_by'] = $user_id;
            $this->TravelOwnerCompany->create();
            if ($this->TravelOwnerCompany->save($this->request->data)) {
                $this->Session->setFlash('Owner company has been saved.', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to add Owner company.', 'failure');
            }
        }
    }

    public function edit($id = null, $mode = null) {

        $id = base64_decode($id);
        $this->set(compact('mode'));
        if (!$id) {
            throw new NotFoundException(__('Invalid Cain'));
        }

        $TravelOwnerCompanies = $this->TravelOwnerCompany->findById($id);

        if (!$TravelOwnerCompanies) {
            throw new NotFoundException(__('Invalid owner company'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->TravelOwnerCompany->set($this->data);
            if ($this->TravelOwnerCompany->validates() == true) {

                $this->TravelOwnerCompany->id = $id;
                if ($this->TravelOwnerCompany->save($this->request->data)) {
                    $this->Session->setFlash('Owner company has been updated.', 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to update Owner company.', 'failure');
                }
            }
        }

        $this->request->data = $TravelOwnerCompanies;
    }

}


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
class PackageStandardMastersController extends AppController {

    var $uses = array('PackageStandardMaster','PackageDurationTarget','PackageNationality','PackageType','PackageTypeInternal','ServiceCostTarget',
        'ServiceScope','PackageCurrency','PackageNo2','PackageNo1','PackageStandardItem');

    public function index() {


        $search_condition = array();


        //$this->paginate['order'] = array('City.city_name' => 'asc');
        $this->set('PackageStandardMasters', $this->paginate("PackageStandardMaster", $search_condition));
    }

    public function add() {


        $user_id = $this->Auth->user('id');
        $this->request->data['PackageStandardMaster']['IsActive'] = '1';



        if ($this->request->is('post')) {

            if (isset($this->data['PackageStandardMaster']['PackageValidFrom']))
                $this->request->data['PackageStandardMaster']['PackageValidFrom'] = date('Y-m-d', strtotime($this->data['PackageStandardMaster']['PackageValidFrom']));

            if (isset($this->data['PackageStandardMaster']['PackageValidTo']))
                $this->request->data['PackageStandardMaster']['PackageValidTo'] = date('Y-m-d', strtotime($this->data['PackageStandardMaster']['PackageValidTo']));


            $this->PackageStandardMaster->create();
            if ($this->PackageStandardMaster->save($this->request->data)) {
                $this->Session->setFlash('Data has been saved.', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to add data.', 'failure');
            }
        }
        $PackageTypes = $this->PackageType->find('list', array('fields' => 'id, PackageType', 'order' => 'PackageType ASC'));
        $PackageTypeInternals = $this->PackageTypeInternal->find('list', array('fields' => 'id, PackageTypeInternalCode', 'order' => 'PackageTypeInternalCode ASC'));
        $PackageDurationTargets = $this->PackageDurationTarget->find('list', array('fields' => 'id, PackageDurationTarget', 'order' => 'PackageDurationTarget ASC'));
        $PackageNationalities = $this->PackageNationality->find('list', array('fields' => 'id, PackageNationalityCode', 'order' => 'PackageNationalityCode ASC'));
        $ServiceScopes = $this->ServiceScope->find('list', array('fields' => 'id, ServiceScopeCode', 'order' => 'ServiceScopeCode ASC'));
        $ServiceCostTargets = $this->ServiceCostTarget->find('list', array('fields' => 'id, ServiceCostTargetCode', 'order' => 'ServiceCostTargetCode ASC'));
        $PackageCurrencies = $this->PackageCurrency->find('list', array('fields' => 'currency, currency', 'order' => 'currency ASC'));
        $PackageNo1s = $this->PackageNo1->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $PackageNo2s = $this->PackageNo2->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
       
        $this->set(compact('PackageTypes','PackageTypeInternals','PackageDurationTargets','PackageNationalities','ServiceScopes','ServiceCostTargets','PackageCurrencies','PackageNo2s','PackageNo1s'));
        
    }

    public function edit($id = null, $mode = null) {

       // $id = base64_decode($id);
        $this->set(compact('mode'));

        if (!$id) {
            throw new NotFoundException(__('Invalid Data'));
        }

        $PackageStandardMasters = $this->PackageStandardMaster->findById($id);

        if (!$PackageStandardMasters) {
            throw new NotFoundException(__('Invalid Data'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {

            $this->PackageStandardMaster->id = $id;          
                if ($this->PackageStandardMaster->save($this->request->data)) {
                    $this->Session->setFlash('Data has been updated.', 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to update data.', 'failure');
                }
   
        }
        
        $PackageTypes = $this->PackageType->find('list', array('fields' => 'id, PackageType', 'order' => 'PackageType ASC'));
        $PackageTypeInternals = $this->PackageTypeInternal->find('list', array('fields' => 'id, PackageTypeInternalCode', 'order' => 'PackageTypeInternalCode ASC'));
        $PackageDurationTargets = $this->PackageDurationTarget->find('list', array('fields' => 'id, PackageDurationTarget', 'order' => 'PackageDurationTarget ASC'));
        $PackageNationalities = $this->PackageNationality->find('list', array('fields' => 'id, PackageNationalityCode', 'order' => 'PackageNationalityCode ASC'));
        $ServiceScopes = $this->ServiceScope->find('list', array('fields' => 'id, ServiceScopeCode', 'order' => 'ServiceScopeCode ASC'));
        $ServiceCostTargets = $this->ServiceCostTarget->find('list', array('fields' => 'id, ServiceCostTargetCode', 'order' => 'ServiceCostTargetCode ASC'));
        $PackageCurrencies = $this->PackageCurrency->find('list', array('fields' => 'currency, currency', 'order' => 'currency ASC'));
        $PackageNo1s = $this->PackageNo1->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $PackageNo2s = $this->PackageNo2->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $PackageStandardItems = $this->PackageStandardItem->find('all');
       
        $this->set(compact('PackageTypes','PackageTypeInternals','PackageDurationTargets','PackageNationalities','ServiceScopes','ServiceCostTargets','PackageCurrencies','PackageNo2s','PackageNo1s',
                'PackageStandardItems'));

        if (!$this->request->data) {
            $this->request->data = $PackageStandardMasters;
        }
    }

}
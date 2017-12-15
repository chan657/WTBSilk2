<?php

/**
 * City controller.
 *
 * This file will render views from views/PackageStandardItems/
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
 * PackageStandardItems controller
 *
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PackageStandardItemsController extends AppController {

    var $uses = array('PackageStandardItem','TravelCountry','PackageItem','PackageStandardMaster');

    public function index() {


        $search_condition = array();


        //$this->paginate['order'] = array('City.city_name' => 'asc');
        $this->set('PackageStandardItems', $this->paginate("PackageStandardItem", $search_condition));
    }

    public function add($package_id = null) {

        $this->layout = '';

        $user_id = $this->Auth->user('id');
        $package_code = $this->PackageStandardMaster->findById($package_id,array('fields' => 'PackageStandardMaster.StandardPackageCode'));
  

        if ($this->request->is('post')) {
            $this->request->data['PackageStandardItem']['StandardPackageId'] = $package_id;
            $this->request->data['PackageStandardItem']['StandardPackageCode'] = $package_code['PackageStandardMaster']['StandardPackageCode'];
            $this->PackageStandardItem->create();
            if ($this->PackageStandardItem->save($this->request->data)) {
                $this->Session->setFlash('Data has been saved.', 'success');
               // $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to add data.', 'failure');
            }
            
            
            echo '<script>
                var objP=parent.document.getElementsByClassName("mfp-bg");
                var objC=parent.document.getElementsByClassName("mfp-wrap");
                objP[0].style.display="none";
                objC[0].style.display="none";
                parent.location.reload(true);</script>';
        }
        
        $TravelCountries = $this->TravelCountry->find('list', array('fields' => 'id, country_code', 'conditions' => array(
                        'TravelCountry.country_status' => '1',
                        'TravelCountry.wtb_status' => '1',
                        'TravelCountry.active' => 'TRUE'), 'order' => 'country_code ASC'));
        
        $PackageItems = $this->PackageItem->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        
       $this->set(compact('TravelCountries','PackageItems'));     
    }

    public function edit($id = null, $mode = null) {

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
                    $this->Session->setFlash('City has been updated.', 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to update city.', 'failure');
                }
            }
        }

        if (!$this->request->data) {
            $this->request->data = $city;
        }
    }

}
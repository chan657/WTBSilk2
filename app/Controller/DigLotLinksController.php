<?php

/**
 * DigLotLink controller.
 *
 * This file will render views from views/DigLotLinks/
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
 * DigLotLink controller
 *
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class DigLotLinksController extends AppController {

    var $uses = array('DigLotLink', 'DigBase', 'DigBaseUsage', 'DigLot');

    public function index() {

        $search_condition = array();
        $user_id = $this->Auth->user('id');
        $lot_name = '';
        
         if ($this->request->is('post') || $this->request->is('put')) {
            if (!empty($this->data['DigLotLink']['lot_name'])) {
                $lot_name = $this->data['DigLotLink']['lot_name'];
                array_push($search_condition, array('DigLot.lot_name' . ' LIKE' => mysql_escape_string(trim(strip_tags($lot_name))) . "%"));
            }
        }
        elseif ($this->request->is('get')) {

            if (!empty($this->request->params['DigLotLink']['lot_name'])) {
                $lot_name = $this->request->params['DigLotLink']['lot_name'];
                array_push($search_condition, array("DigLot.lot_name LIKE '%$lot_name%'"));
            }
        }

        $this->paginate['order'] = array('DigLotLink.created' => 'desc');
        $this->set('DigLotLinks', $this->paginate("DigLotLink", $search_condition));
        
        if (!isset($this->passedArgs['lot_name']) && empty($this->passedArgs['lot_name'])) {
            $this->passedArgs['lot_name'] = (isset($this->data['DigLotLink']['lot_name'])) ? $this->data['DigLotLink']['lot_name'] : '';
        }
        
        if (!isset($this->data) && empty($this->data)) {
            $this->data['DigLotLink']['lot_name'] = $this->passedArgs['lot_name'];
        }
        
        $this->set(compact('lot_name'));
    }

    public function add() {


        $user_id = $this->Auth->user('id');

        if ($this->request->is('post')) {

            $this->request->data['DigLotLink']['created_by'] = $user_id;
            $this->request->data['DigLotLink']['lot_links_status'] = '1';

            $this->DigLotLink->create();

            if ($this->DigLotLink->save($this->request->data)) {
                $this->Session->setFlash('Data has been successfully saved.', 'success');

                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to add data.', 'failure');
            }
        }


        $DigLotLinkUsageStatus = $this->DigBaseUsage->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigBases = $this->DigBase->find('list', array('fields' => 'id,base_website_url', 'order' => 'base_website_url ASC'));
        $DigLots = $this->DigLot->find('list', array('fields' => 'id,lot_name', 'order' => 'lot_name ASC'));


        $this->set(compact('DigLotLinkUsageStatus', 'DigBases', 'DigLots'));
    }

    public function edit($id = null, $mode = null) {

        //   $id = base64_decode($id);
        $this->set(compact('mode'));
        $id = base64_decode($id);


        if (!$id) {
            throw new NotFoundException(__('Invalid Lotlinks'));
        }

        $DigLotLinks = $this->DigLotLink->findById($id);

        if (!$DigLotLinks) {
            throw new NotFoundException(__('Invalid Lotlinks'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {



            $this->DigLotLink->id = $id;
            if ($this->DigLotLink->save($this->request->data)) {
                $this->Session->setFlash('Data has been successfully saved.', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to save data.', 'failure');
            }
        }

        $DigLotLinkUsageStatus = $this->DigBaseUsage->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigBases = $this->DigBase->find('list', array('fields' => 'id,base_website_url', 'order' => 'base_website_url ASC'));
        $DigLots = $this->DigLot->find('list', array('fields' => 'id,lot_name', 'order' => 'lot_name ASC'));


        $this->set(compact('DigLotLinkUsageStatus', 'DigBases', 'DigLots'));

        if (!$this->request->data) {
            $this->request->data = $DigLotLinks;
        }
    }

}
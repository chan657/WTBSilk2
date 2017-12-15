<?php

/**
 * DigBase controller.
 *
 * This file will render views from views/TravelCities/
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
 * DigBase controller
 *
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class DigBasesController extends AppController {

    var $uses = array('DigBase', 'DigBaseDofollow', 'DigBaseLinkCategory', 'DigBaseTargetGeography', 'DigBaseType', 'DigBaseUsage', 'DigBaseWhy',
        'DigActionItem','DigRemark','DigBaseUsageType','DigBaseDaAaClLrLookup','DigBaseUsedBy','Channel');

    public function index() {

        $search_condition = array();
        $user_id = $this->Auth->user('id');
        $base_website_url = '';
        
        if ($this->request->is('post') || $this->request->is('put')) {
            if (!empty($this->data['DigBase']['base_website_url'])) {
                $base_website_url = $this->data['DigBase']['base_website_url'];
                array_push($search_condition, array('DigBase.base_website_url' . ' LIKE' => mysql_escape_string(trim(strip_tags($base_website_url))) . "%"));
            }
        }
        elseif ($this->request->is('get')) {

            if (!empty($this->request->params['DigBase']['base_website_url'])) {
                $base_website_url = $this->request->params['DigBase']['base_website_url'];
                array_push($search_condition, array("DigBase.base_website_url LIKE '%$base_website_url%'"));
            }
        }

        $this->paginate['order'] = array('DigBase.created' => 'desc');
        $this->set('DigBases', $this->paginate("DigBase", $search_condition));
        
        if (!isset($this->passedArgs['base_website_url']) && empty($this->passedArgs['base_website_url'])) {
            $this->passedArgs['base_website_url'] = (isset($this->data['DigBase']['base_website_url'])) ? $this->data['DigBase']['base_website_url'] : '';
        }
        
        if (!isset($this->data) && empty($this->data)) {
            $this->data['DigBase']['base_website_url'] = $this->passedArgs['base_website_url'];
        }
        
        $this->set(compact('base_website_url'));
    }

    public function add($task_id = null) {


        $user_id = $this->Auth->user('id');

        if ($this->request->is('post')) {

            $this->request->data['DigBase']['created_by'] = $user_id;
            $this->request->data['DigBase']['base_status'] = '1'; // saved draft

            $this->DigBase->create();

            if ($this->DigBase->save($this->request->data)) {
                $this->Session->setFlash('Base has been successfully saved.', 'success');

                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to add data.', 'failure');
            }
        }


        $DigBaseDofollows = $this->DigBaseDofollow->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigBaseLinkCategories = $this->DigBaseLinkCategory->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigBaseTargetGeographies = $this->DigBaseTargetGeography->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigBaseTypes = $this->DigBaseType->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigBaseUsages = $this->DigBaseUsage->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigBaseWhies = $this->DigBaseWhy->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigBaseUsageTypes = $this->DigBaseUsageType->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigBaseDaAaClLrLookups = $this->DigBaseDaAaClLrLookup->find('list', array('fields' => 'id,value'));
        
        $DigBaseUsedBies = $this->Channel->find('list', array('fields' => 'Channel.id, Channel.channel_name', 'conditions' => array('Channel.channel_role' => 35))); // 35 marketing group
        $DigBaseUsedBies = array('ALL' => 'ALL') + $DigBaseUsedBies + array('NONE' => 'NONE');
/// $this->set('channel_name', $channel_name);
      
       // $DigBaseUsedBies = $this->User->find('all', array('fields' => array('User.id', 'User.fname', 'User.lname'), 'conditions' => array('User.d_marketing_role_id <> "" and User.d_marketing_channel_id <> ""'), 'order' => 'User.fname asc'));
        
        // $log = $this->User->getDataSource()->getLog(false, false);       
        // debug($log);

       // $DigBaseUsedBies = Set::combine($DigBaseUsedBies, '{n}.User.id', array('%s %s', '{n}.User.fname', '{n}.User.lname'));
        

        $this->set(compact('DigBaseDofollows', 'DigBaseLinkCategories', 'DigBaseTargetGeographies', 'DigBaseTypes', 'DigBaseUsages', 'DigBaseWhies','DigBaseUsageTypes',
                'DigBaseDaAaClLrLookups','DigBaseUsedBies'));
    }

    function edit($id = null, $mode = null) {

        $user_id = $this->Auth->user('id');
        $role_id = $this->Session->read("role_id");
        $dummy_status = $this->Auth->user('dummy_status');
        $next_action_by = '136';  //overseer 136 44 is sarika
        $actio_itme_id = '';
        $flag = 0;
        $id = base64_decode($id);
        $this->set(compact('mode'));
        $arr = explode('_', $id);
        $id = $arr[0];
        if (count($arr) > 1) {
            $actio_itme_id = $arr[1];
            $flag = 1;
        }
        //echo $actio_itme_id;
        if (!$id) {
            throw new NotFoundException(__('Invalid Base'));
        }

        $DigBases = $this->DigBase->findById($id);


        if (!$DigBases) {
            throw new NotFoundException(__('Invalid Base'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {

            
       
            /*             * ************************* Action ********************** */
            $DigActionItems['DigActionItem']['base_id'] = $id;
            $DigActionItems['DigActionItem']['level_id'] = '1';  // for agent dig_action_remark_levels 
            $DigActionItems['DigActionItem']['type_id'] = '4'; // for Change Submitted of dig_action_item_types
            $DigActionItems['DigActionItem']['next_action_by'] = $next_action_by;
            $DigActionItems['DigActionItem']['action_item_active'] = 'Yes';
            $DigActionItems['DigActionItem']['description'] = 'Base Record Updated - Re-Submission For Approval';
            $DigActionItems['DigActionItem']['action_item_source'] = $role_id;
            $DigActionItems['DigActionItem']['created_by_id'] = $user_id;
            $DigActionItems['DigActionItem']['created_by'] = $user_id;
            $DigActionItems['DigActionItem']['dummy_status'] = $dummy_status;
            


            /*             * ********************* Remarks ******************************** */
            $DigRemarks['DigRemark']['base_id'] = $id;
            $DigRemarks['DigRemark']['remarks'] = 'Edit Base Record';
            $DigRemarks['DigRemark']['created_by'] = $user_id;
            $DigRemarks['DigRemark']['remarks_time'] = date('g:i A');
            $DigRemarks['DigRemark']['remarks_level'] = '1';  // for mapping country dig_action_remark_levels 
            $DigRemarks['DigRemark']['dummy_status'] = $dummy_status;
            
       
            $this->request->data['DigBase']['base_status'] = '4'; // 4 for Change Submitted of the travel_action_item_types
            $this->DigBase->id = $id;
            if ($this->DigBase->save($this->request->data['DigBase'])) {
            
                $this->DigRemark->save($DigRemarks);
                $this->DigActionItem->save($DigActionItems);
                $ActionId = $this->DigActionItem->getLastInsertId();
                
                if ($actio_itme_id) {
                    $parent_action_item_id = $actio_itme_id;
                    $this->DigActionItem->updateAll(array('DigActionItem.action_item_active' => "'No'"), array('DigActionItem.id' => $actio_itme_id));
                }else
                    $parent_action_item_id = $ActionId;
                
                $this->DigActionItem->updateAll(array('DigActionItem.parent_action_item_id' => $parent_action_item_id), array('DigActionItem.id' => $ActionId));
                $this->Session->setFlash('Your changes have been submitted. Waiting for approval at the moment...', 'success');
            }
            else
                $this->Session->setFlash('Unable to add Base.', 'failure');    
            
            $this->redirect(array('action' => 'index'));
        }


        $DigBaseDofollows = $this->DigBaseDofollow->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigBaseLinkCategories = $this->DigBaseLinkCategory->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigBaseTargetGeographies = $this->DigBaseTargetGeography->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigBaseTypes = $this->DigBaseType->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigBaseUsages = $this->DigBaseUsage->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigBaseWhies = $this->DigBaseWhy->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigBaseUsageTypes = $this->DigBaseUsageType->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigBaseDaAaClLrLookups = $this->DigBaseDaAaClLrLookup->find('list', array('fields' => 'id,value'));
        
        $DigBaseUsedBies = $this->Channel->find('list', array('fields' => 'Channel.id, Channel.channel_name', 'conditions' => array('Channel.channel_role' => 35))); // 35 marketing group
        $DigBaseUsedBies = array('ALL' => 'ALL') + $DigBaseUsedBies + array('NONE' => 'NONE');
/// $this->set('channel_name', $channel_name);
      
       // $DigBaseUsedBies = $this->User->find('all', array('fields' => array('User.id', 'User.fname', 'User.lname'), 'conditions' => array('User.d_marketing_role_id <> "" and User.d_marketing_channel_id <> ""'), 'order' => 'User.fname asc'));
        
        // $log = $this->User->getDataSource()->getLog(false, false);       
        // debug($log);

       // $DigBaseUsedBies = Set::combine($DigBaseUsedBies, '{n}.User.id', array('%s %s', '{n}.User.fname', '{n}.User.lname'));
        

        $this->set(compact('DigBaseDofollows', 'DigBaseLinkCategories', 'DigBaseTargetGeographies', 'DigBaseTypes', 'DigBaseUsages', 'DigBaseWhies','DigBaseUsageTypes',
                'DigBaseDaAaClLrLookups','DigBaseUsedBies'));


        $this->request->data = $DigBases;
    }
    
    function active($id = null) {

        $user_id = $this->Auth->user('id');
       
        if (!$id) {
            throw new NotFoundException(__('Invalid Base'));
        }

        $DigBases = $this->DigBase->findById($id);


        if (!$DigBases) {
            throw new NotFoundException(__('Invalid Base'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {           
       
       
            $this->request->data['DigBase']['base_status'] = '2'; 
            $this->DigBase->id = $id;
            if ($this->DigBase->save($this->request->data['DigBase'])) {
                
                $this->Session->setFlash('Update successfully', 'success');
            }
            else
                $this->Session->setFlash('Unable to update Base.', 'failure');    
            
            $this->redirect(array('action' => 'index'));
        }


        $DigBaseDofollows = $this->DigBaseDofollow->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigBaseLinkCategories = $this->DigBaseLinkCategory->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigBaseTargetGeographies = $this->DigBaseTargetGeography->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigBaseTypes = $this->DigBaseType->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigBaseUsages = $this->DigBaseUsage->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigBaseWhies = $this->DigBaseWhy->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));

        $this->set(compact('DigBaseDofollows', 'DigBaseLinkCategories', 'DigBaseTargetGeographies', 'DigBaseTypes', 'DigBaseUsages', 'DigBaseWhies'));


        $this->request->data = $DigBases;
    }
    
    function de_active($id = null) {

        $user_id = $this->Auth->user('id');
       
        if (!$id) {
            throw new NotFoundException(__('Invalid Base'));
        }

        $DigBases = $this->DigBase->findById($id);


        if (!$DigBases) {
            throw new NotFoundException(__('Invalid Base'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {           
       
       
            $this->request->data['DigBase']['base_status'] = '8'; 
            $this->DigBase->id = $id;
            if ($this->DigBase->save($this->request->data['DigBase'])) {
                
                $this->Session->setFlash('Update successfully', 'success');
            }
            else
                $this->Session->setFlash('Unable to update Base.', 'failure');    
            
            $this->redirect(array('action' => 'index'));
        }


        $DigBaseDofollows = $this->DigBaseDofollow->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigBaseLinkCategories = $this->DigBaseLinkCategory->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigBaseTargetGeographies = $this->DigBaseTargetGeography->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigBaseTypes = $this->DigBaseType->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigBaseUsages = $this->DigBaseUsage->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $DigBaseWhies = $this->DigBaseWhy->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));

        $this->set(compact('DigBaseDofollows', 'DigBaseLinkCategories', 'DigBaseTargetGeographies', 'DigBaseTypes', 'DigBaseUsages', 'DigBaseWhies'));

        $this->request->data = $DigBases;
    }
    
    

}
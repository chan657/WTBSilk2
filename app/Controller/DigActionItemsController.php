<?php

/**
 * Digital Action controller.
 *
 * This file will render views from views/actions/
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
App::uses('CakeEmail', 'Network/Email');
/**
 * Email sender
 */
App::uses('AppController', 'Controller');
App::uses('Xml', 'Utility');

/**
 * Travel Action controller
 *
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class DigActionItemsController extends AppController {

    var $uses = array('DigActionItem', 'DigRemark', 'LookupValueActionItemReturn', 'LookupValueActionItemRejection', 'DigActionItemType', 'DigBase');

    public function index() {

        $dummy_status = $this->Auth->user('dummy_status');
        $role_id = $this->Session->read("role_id");
        $user_id = $this->Auth->user('id');
        $search_condition = array();


        if ($dummy_status)
            array_push($search_condition, array('DigActionItem.dummy_status' => $dummy_status));


        $this->paginate['conditions'][0] = "DigActionItem.action_item_active='Yes' AND DigActionItem.next_action_by = " . $user_id . "";
        $this->paginate['conditions'][1] = $search_condition;
        $this->paginate['order'] = array('DigActionItem.id' => 'desc');
        $this->set('DigActionItems', $this->paginate("DigActionItem"));
    }

    public function submit_action($actio_itme_id = null) {


        $this->layout = '';

        /*         * *******Checking user*********** */
        $dummy_status = $this->Auth->user('dummy_status');
        $channel_id = $this->Session->read("channel_id");
        $user_id = $this->Auth->user('id');
        $role_id = $this->Session->read("role_id");



        $DigActionItems = $this->DigActionItem->findById($actio_itme_id);
        $level_id = $DigActionItems['DigActionItem']['level_id'];
        if ($level_id == '1') // base id
            $t_id = $DigActionItems['DigActionItem']['base_id'];

        if ($this->request->is('post') || $this->request->is('put')) {


            /*             * ************This data is common features **************************************** */
           
            $this->request->data['DigActionItem']['parent_action_item_id'] = $actio_itme_id;
            $this->request->data['DigActionItem']['dummy_status'] = $dummy_status;
            $this->request->data['DigActionItem']['action_item_created'] = date('Y-m-d');
            $this->request->data['DigActionItem']['created_by_id'] = $DigActionItems['DigActionItem']['created_by_id'];
            $this->request->data['DigActionItem']['level_id'] = $DigActionItems['DigActionItem']['level_id'];
            $this->request->data['DigActionItem']['action_item_active'] = 'Yes';
            $this->request->data['DigActionItem']['created_by'] = $user_id;
            $this->request->data['DigActionItem']['action_item_source'] = $role_id;

            $this->request->data['DigRemark']['remarks_time'] = date('g:i A');
            $this->request->data['DigRemark']['created_by'] = $user_id;
            $this->request->data['DigRemark']['remarks_date'] = date('Y-m-d H:i:s');
            $this->request->data['DigRemark']['dummy_status'] = $dummy_status;
            $this->request->data['DigRemark']['remarks_level'] = $DigActionItems['DigActionItem']['level_id'];

            $type_id = $this->data['DigActionItem']['type_id'];


            if ($type_id == '2' && $level_id == '1') { // Approval in base
                $this->request->data['DigActionItem']['base_id'] = $t_id;
                $this->request->data['DigActionItem']['description'] = 'Approve Base';
                $this->request->data['DigActionItem']['next_action_by'] = '';

                $this->request->data['DigRemark']['base_id'] = $t_id;
                $this->request->data['DigRemark']['remarks'] = 'Approve Base';


                $DigBases['DigBase']['base_status'] = '2';  // 2 for approve of dig_action_item_types             
                $DigBases['DigBase']['approved_by'] = "'" . $user_id . "'";
                $DigBases['DigBase']['approved_date'] = "'" . date('Y-m-d H:i:s') . "'";
            } elseif ($type_id == '3' && $level_id == '1') { // Return in base
                $this->request->data['DigActionItem']['base_id'] = $t_id;
                $this->request->data['DigActionItem']['next_action_by'] = $DigActionItems['DigActionItem']['created_by_id'];
                $this->request->data['DigActionItem']['description'] = 'Return Base';

                $this->request->data['DigRemark']['base_id'] = $t_id;
                $this->request->data['DigRemark']['remarks'] = 'Return Base';

                $DigBases['DigBase']['base_status'] = '3';  // 2 for approve of dig_action_item_types
                $DigBases['DigBase']['approved_by'] = "'" . $user_id . "'";
                $DigBases['DigBase']['approved_date'] = "'" . date('Y-m-d H:i:s') . "'";
            }

            if ($this->DigActionItem->save($this->data['DigActionItem'])) {
                $last_action_id = $this->DigActionItem->getLastInsertId();
                $this->DigRemark->save($this->data['DigRemark']);
                $this->DigBase->updateAll($DigBases['DigBase'], array('DigBase.id' => $t_id));
                $this->DigActionItem->updateAll(array('DigActionItem.action_item_active' => "'No'"), array('DigActionItem.id' => $actio_itme_id));

                $this->Session->setFlash('Local record has been successfully updated.', 'success');
              
            }
            else
                $this->Session->setFlash('Unable to add Action item.', 'failure');

            echo '<script>
              var objP=parent.document.getElementsByClassName("mfp-bg");
              var objC=parent.document.getElementsByClassName("mfp-wrap");
              objP[0].style.display="none";
              objC[0].style.display="none";
              parent.location.reload(true);</script>';
        }

        $type = $this->DigActionItemType->find('list', array('fields' => array('id', 'value'), 'conditions' => 'id = 2 OR id = 3'));
        $this->set(compact('type'));

        $retrun_cond = array('type' => array('0')); // 0=other
        $returns = $this->LookupValueActionItemReturn->find('list', array('fields' => 'id, value', 'conditions' => $retrun_cond, 'order' => 'value ASC'));
        $this->set(compact('returns'));

        $rejection_cond = array('type' => array('0')); // 0=other
        $rejections = $this->LookupValueActionItemRejection->find('list', array('fields' => 'id, value', 'conditions' => $rejection_cond, 'order' => 'value ASC'));
        $this->set(compact('rejections'));
    }

}

?>
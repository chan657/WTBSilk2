<?php

/**
 * DigTopic controller.
 *
 * This file will render views from views/DigTopics/
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
 * DigTopic controller
 *
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class DigTopicsController extends AppController {

    var $uses = array('DigTopic', 'Channel');

    public function index() {

        $search_condition = array();
        $user_id = $this->Auth->user('id');
        $topic_name = '';
        
         if ($this->request->is('post') || $this->request->is('put')) {
            if (!empty($this->data['DigTopic']['topic_name'])) {
                $topic_name = $this->data['DigTopic']['topic_name'];
                array_push($search_condition, array('DigTopic.topic_name' . ' LIKE' => mysql_escape_string(trim(strip_tags($topic_name))) . "%"));
            }
        }
        elseif ($this->request->is('get')) {

            if (!empty($this->request->params['DigTopic']['topic_name'])) {
                $topic_name = $this->request->params['DigTopic']['topic_name'];
                array_push($search_condition, array("DigTopic.topic_name LIKE '%$topic_name%'"));
            }
        }

        $this->paginate['order'] = array('DigTopic.created' => 'desc');
        $this->set('DigTopics', $this->paginate("DigTopic", $search_condition));
        
        if (!isset($this->passedArgs['topic_name']) && empty($this->passedArgs['topic_name'])) {
            $this->passedArgs['topic_name'] = (isset($this->data['DigTopic']['topic_name'])) ? $this->data['DigTopic']['topic_name'] : '';
        }
        
        if (!isset($this->data) && empty($this->data)) {
            $this->data['DigTopic']['topic_name'] = $this->passedArgs['topic_name'];
        }
        
        $this->set(compact('topic_name'));
    }

    public function add() {


        $user_id = $this->Auth->user('id');
        $keyword_value = '';
        $related_key_value = '';
        $Ukeyword_value = '';
        $Urelated_key_value = '';
        $generate = false;

        if ($this->request->is('post')) {
            // echo nl2br(trim($this->data['DigTopic']['topic_keywords']));
            if (isset($this->data['generate'])) {
                $generate = true;
                $keyword = trim($this->data['DigTopic']['topic_keywords']);
                $keywordAr = explode("\n", $keyword);
                $keywordAr = array_filter($keywordAr, 'trim');

                foreach ($keywordAr as $val) {
                    $keyword_value .= preg_replace("/[\n\r]/", '', $val) . '|';
                    $Ukeyword_value .= preg_replace("/[\n\r]/", '', ucwords($val)) . '|';
                }

                $related_key = trim($this->data['DigTopic']['topic_related_keywords']);
                $relatedAr = explode("\n", $related_key);
                $relatedAr = array_filter($relatedAr, 'trim');

                foreach ($relatedAr as $val) {
                    // $related_key_value .= $val.'|';
                    $related_key_value .= preg_replace("/[\n\r]/", '', $val) . '|';
                    $Urelated_key_value .= preg_replace("/[\n\r]/", '', ucwords($val)) . '|';
                }
                // $keyword_value = preg_replace("/[\n\r]/",'',$keyword_value);
                // $related_key_value =  preg_replace("/[\n\r]/", '', $related_key_value);
            }
            if (isset($this->data['add'])) {
                $this->request->data['DigTopic']['created_by'] = $user_id;
                $this->request->data['DigTopic']['topic_status'] = '1';
                $this->request->data['DigTopic']['active'] = 'TRUE';
                $this->DigTopic->create();

                if ($this->DigTopic->save($this->request->data)) {
                    $this->Session->setFlash('Data has been successfully saved.', 'success');

                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to add data.', 'failure');
                }
            }
        }

        $Channel = $this->Channel->find('list', array('fields' => 'Channel.id, Channel.channel_name', 'conditions' => array('Channel.channel_role' => 35))); // 35 marketing group
        $Channel = array('ALL' => 'ALL') + $Channel + array('NONE' => 'NONE');

        $this->set(compact('Channel', 'keyword_value', 'related_key_value', 'Ukeyword_value', 'Urelated_key_value', 'generate'));
    }

    public function edit($id = null, $mode = null) {


        $user_id = $this->Auth->user('id');
        $id = base64_decode($id);
        $this->set(compact('mode'));
        $keyword_value = '';
        $related_key_value = '';
        $Ukeyword_value = '';
        $Urelated_key_value = '';
        $generate = false;
        
        if (!$id) {
            throw new NotFoundException(__('Invalid Topic'));
        }

        $DigTopics = $this->DigTopic->findById($id);

        if (!$DigTopics) {
            throw new NotFoundException(__('Invalid Topic'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->DigTopic->set($this->data);
            if ($this->DigTopic->validates() == true) {

                if (isset($this->data['generate'])) {
                    $generate = true;
                    $keyword = trim($this->data['DigTopic']['topic_keywords']);
                    $keywordAr = explode("\n", $keyword);
                    $keywordAr = array_filter($keywordAr, 'trim');

                    foreach ($keywordAr as $val) {
                        $keyword_value .= preg_replace("/[\n\r]/", '', $val) . '|';
                        $Ukeyword_value .= preg_replace("/[\n\r]/", '', ucwords($val)) . '|';
                    }

                    $related_key = trim($this->data['DigTopic']['topic_related_keywords']);
                    $relatedAr = explode("\n", $related_key);
                    $relatedAr = array_filter($relatedAr, 'trim');

                    foreach ($relatedAr as $val) {
                        // $related_key_value .= $val.'|';
                        $related_key_value .= preg_replace("/[\n\r]/", '', $val) . '|';
                        $Urelated_key_value .= preg_replace("/[\n\r]/", '', ucwords($val)) . '|';
                    }
          
                }

                if (isset($this->data['add'])) {
                    $this->DigTopic->id = $id;
                    if ($this->DigTopic->save($this->request->data)) {
                        $this->Session->setFlash('Record has been successfully updated.', 'success');
                        $this->redirect(array('action' => 'index'));
                    } else {
                        $this->Session->setFlash('Unable to update record.', 'failure');
                    }
                }
            }
        }


       $Channel = $this->Channel->find('list', array('fields' => 'Channel.id, Channel.channel_name', 'conditions' => array('Channel.channel_role' => 35))); // 35 marketing group
        $Channel = array('ALL' => 'ALL') + $Channel + array('NONE' => 'NONE');

    
			$this->request->data = $DigTopics;
	
             $keyword_value = $this->data['DigTopic']['topic_anchors_raw'];
             $Ukeyword_value = $this->data['DigTopic']['topic_anchors_polished'];
             $related_key_value = $this->data['DigTopic']['topic_related_anchors_raw'];
             $Urelated_key_value = $this->data['DigTopic']['topic_related_anchors_polished'];
      
        $this->set(compact('Channel', 'keyword_value', 'related_key_value', 'Ukeyword_value', 'Urelated_key_value', 'generate'));
  
    }

}
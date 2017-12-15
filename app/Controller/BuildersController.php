<?php

/**
 * Builder controller.
 *
 * This file will render views from views/builders/
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


/**
 * Builder controller
 *
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class BuildersController extends AppController {

    public $uses = array('Builder', 'Area', 'Suburb', 'City', 'LookupBuilderAgreementLevel', 'LookupBuilderAgreementProposed', 'LookupBuilderAgreementManagedBy', 'LookupBuilderAgreementIntiatedBy', 'LookupBuilderAgreementPreparedBy', 'LookupBuilderAgreementCommissionBasedOn', 'LookupBuilderAgreementCommissionTerm', 'LookupValueLeadsCountry', 'BuilderAgreement', 'BuilderContact', 'LookupBuilderContactStatus', 'ActionItem', 'Project', 'ProjectAgreement', 'Channel', 'User', 'LookupBuilderContactLevel', 'LookupBuilderContactInitiatedBy', 'LookupBuilderContactManagedBy', 'LookupBuilderContactPreparedBy', 'LookupBuilderAgreementStatuse', 'ActionItem', 'BuilderLegalName', 'LookupBuilderAgreementDoneWith', 'MarketingPartner', 'LookupCompany', 'Remark');
    public $components = array('Sms');

    public function index() {

        $dummy_status = $this->Auth->user('dummy_status');
        $city_id = $this->Auth->user('city_id');
        $role_id = $this->Session->read("role_id");
        $builder_name = '';
        $builder_primarycity = '';
        $builder_commercial = '';
        $builder_highendresidential = '';
        $builder_residential = '';
        $search_condition = array();
        $channel_id = $this->Session->read("channel_id");
        $channel_id = $this->Channel->findById($channel_id);
        $channel_city_id = $channel_id['Channel']['city_id'];

        if ($this->request->is('post') || $this->request->is('put')) {
            if (!empty($this->data['Builder']['builder_name'])) {
                $builder_name = $this->data['Builder']['builder_name'];
                array_push($search_condition, array('Builder.builder_name' . ' LIKE' => "%" . mysql_escape_string(trim(strip_tags($builder_name))) . "%"));
            }
            if (!empty($this->data['Builder']['builder_highendresidential'])) {
                $builder_highendresidential = $this->data['Builder']['builder_highendresidential'];
                array_push($search_condition, array('Builder.builder_highendresidential' => $builder_highendresidential));
            }

            if (!empty($this->data['Builder']['builder_primarycity'])) {
                $builder_primarycity = $this->data['Builder']['builder_primarycity'];
                array_push($search_condition, array('Builder.builder_primarycity' => $builder_primarycity));
            }
            if (!empty($this->data['Builder']['builder_residential'])) {
                $builder_residential = $this->data['Builder']['builder_residential'];
                array_push($search_condition, array('Builder.builder_residential' => $builder_residential));
            }
            if (!empty($this->data['Builder']['builder_commercial'])) {
                $builder_commercial = $this->data['Builder']['builder_commercial'];
                array_push($search_condition, array('Builder.builder_commercial' => $builder_commercial));
            }
        } elseif ($this->request->is('get')) {

            if (!empty($this->request->params['named']['builder_name'])) {
                $builder_name = $this->request->params['named']['builder_name'];
                array_push($search_condition, array("Builder.builder_name LIKE '%$builder_name%'"));
            }

            if (!empty($this->request->params['named']['builder_primarycity'])) {
                $builder_primarycity = $this->request->params['named']['builder_primarycity'];
                array_push($search_condition, array('Builder.builder_primarycity' => $builder_primarycity));
            }

            if (!empty($this->request->params['named']['builder_highendresidential'])) {
                $builder_highendresidential = $this->request->params['named']['builder_highendresidential'];
                array_push($search_condition, array('Builder.builder_highendresidential' => $builder_highendresidential));
            }

            if (!empty($this->request->params['named']['builder_residential'])) {
                $builder_residential = $this->request->params['named']['builder_residential'];
                array_push($search_condition, array('Builder.builder_residential' => $builder_residential));
            }

            if (!empty($this->request->params['named']['builder_commercial'])) {
                $builder_commercial = $this->request->params['named']['builder_commercial'];
                array_push($search_condition, array('Builder.builder_commercial' => $builder_commercial));
            }
        }
        if ($role_id == '15') { // Accounts User.
            if ($channel_city_id == 2) {
                array_push($search_condition, array('OR' => array('Builder.builder_primarycity' => $channel_city_id, 'Builder.builder_secondarycity' => $channel_city_id, 'Builder.builder_tertiarycity' => $channel_city_id, 'Builder.city_4' => $city_id, 'Builder.city_5' => $channel_city_id)));
            } else {
                array_push($search_condition, array('NOT' => array('Builder.builder_primarycity' => 2, 'Builder.builder_secondarycity' => 2, 'Builder.builder_tertiarycity' => 2, 'Builder.city_4' => 2, 'Builder.city_5' => 2)));
            }
        } else {
            if ($channel_city_id > 1) {
                array_push($search_condition, array('OR' => array('Builder.builder_primarycity' => $channel_city_id, 'Builder.builder_secondarycity' => $channel_city_id, 'Builder.builder_tertiarycity' => $channel_city_id, 'Builder.city_4' => $city_id, 'Builder.city_5' => $channel_city_id)));
            }
        }



        if ($dummy_status) {
            array_push($search_condition, array('Builder.dummy_status' => $dummy_status, 'Builder.builder_status' => '1'));
        }
        if (count($this->params['pass'])) {

            $aaray = explode(':', $this->params['pass'][0]);
            $field = $aaray[0];
            $value = $aaray[1];
            array_push($search_condition, array('Builder.' . $field => $value)); // when builder is approve/pending
        }


        $this->paginate['order'] = array('Builder.builder_approved' => 'asc');

        $this->set('builders', $this->paginate("Builder", $search_condition));

        //$log = $this->Builder->getDataSource()->getLog(false, false);       
        //debug($log);
        //die;


        if ($role_id == '15') { // Accounts User.
            if ($channel_city_id == '2') {

                $all_count = $this->Builder->find('count', array('conditions' => array('OR' => array(
                            'Builder.builder_primarycity' => $channel_city_id,
                            'Builder.builder_secondarycity' => $channel_city_id,
                            'Builder.builder_tertiarycity' => $channel_city_id,
                            'Builder.city_4' => $channel_city_id,
                            'Builder.city_5' => $channel_city_id,
                        ), 'Builder.dummy_status' => $dummy_status)));

                $approve = $this->Builder->find('count', array('conditions' => array('OR' => array(
                            'Builder.builder_primarycity' => $channel_city_id,
                            'Builder.builder_secondarycity' => $channel_city_id,
                            'Builder.builder_tertiarycity' => $channel_city_id,
                            'Builder.city_4' => $channel_city_id,
                            'Builder.city_5' => $channel_city_id,
                        ), 'Builder.builder_approved' => '1', 'Builder.dummy_status' => $dummy_status)));

                $pending = $this->Builder->find('count', array('conditions' => array('OR' => array(
                            'Builder.builder_primarycity' => $channel_city_id,
                            'Builder.builder_secondarycity' => $channel_city_id,
                            'Builder.builder_tertiarycity' => $channel_city_id,
                            'Builder.city_4' => $channel_city_id,
                            'Builder.city_5' => $channel_city_id,
                        ), 'Builder.builder_approved' => '2', 'Builder.dummy_status' => $dummy_status)));
                $residential_all_count = $this->Builder->find('count', array('conditions' => array('OR' => array(
                            'Builder.builder_primarycity' => $channel_city_id,
                            'Builder.builder_secondarycity' => $channel_city_id,
                            'Builder.builder_tertiarycity' => $channel_city_id,
                            'Builder.city_4' => $channel_city_id,
                            'Builder.city_5' => $channel_city_id,
                        ), 'Builder.dummy_status' => $dummy_status, 'Builder.builder_residential <> ""')));

                $residential_yes = $this->Builder->find('count', array('conditions' => array('OR' => array(
                            'Builder.builder_primarycity' => $channel_city_id,
                            'Builder.builder_secondarycity' => $channel_city_id,
                            'Builder.builder_tertiarycity' => $channel_city_id,
                            'Builder.city_4' => $channel_city_id,
                            'Builder.city_5' => $channel_city_id,
                        ), 'Builder.builder_residential' => '1', 'Builder.dummy_status' => $dummy_status)));

                $residential_no = $this->Builder->find('count', array('conditions' => array('OR' => array(
                            'Builder.builder_primarycity' => $channel_city_id,
                            'Builder.builder_secondarycity' => $channel_city_id,
                            'Builder.builder_tertiarycity' => $channel_city_id,
                            'Builder.city_4' => $channel_city_id,
                            'Builder.city_5' => $channel_city_id,
                        ), 'Builder.builder_residential' => '2', 'Builder.dummy_status' => $dummy_status)));

                $commercial_all_count = $this->Builder->find('count', array('conditions' => array('OR' => array(
                            'Builder.builder_primarycity' => $channel_city_id,
                            'Builder.builder_secondarycity' => $channel_city_id,
                            'Builder.builder_tertiarycity' => $channel_city_id,
                            'Builder.city_4' => $channel_city_id,
                            'Builder.city_5' => $channel_city_id,
                        ), 'Builder.dummy_status' => $dummy_status, 'Builder.builder_commercial <> ""')));

                $commercial_yes = $this->Builder->find('count', array('conditions' => array('OR' => array(
                            'Builder.builder_primarycity' => $channel_city_id,
                            'Builder.builder_secondarycity' => $channel_city_id,
                            'Builder.builder_tertiarycity' => $channel_city_id,
                            'Builder.city_4' => $channel_city_id,
                            'Builder.city_5' => $channel_city_id,
                        ), 'Builder.builder_commercial' => '1', 'Builder.dummy_status' => $dummy_status)));

                $commercial_no = $this->Builder->find('count', array('conditions' => array('OR' => array(
                            'Builder.builder_primarycity' => $channel_city_id,
                            'Builder.builder_secondarycity' => $channel_city_id,
                            'Builder.builder_tertiarycity' => $channel_city_id,
                            'Builder.city_4' => $channel_city_id,
                            'Builder.city_5' => $channel_city_id,
                        ), 'Builder.builder_commercial' => '2', 'Builder.dummy_status' => $dummy_status)));

                $highend_all_count = $this->Builder->find('count', array('conditions' => array('OR' => array(
                            'Builder.builder_primarycity' => $channel_city_id,
                            'Builder.builder_secondarycity' => $channel_city_id,
                            'Builder.builder_tertiarycity' => $channel_city_id,
                            'Builder.city_4' => $channel_city_id,
                            'Builder.city_5' => $channel_city_id,
                        ), 'Builder.dummy_status' => $dummy_status, 'Builder.builder_highendresidential <> ""')));

                $highend_yes = $this->Builder->find('count', array('conditions' => array('OR' => array(
                            'Builder.builder_primarycity' => $channel_city_id,
                            'Builder.builder_secondarycity' => $channel_city_id,
                            'Builder.builder_tertiarycity' => $channel_city_id,
                            'Builder.city_4' => $channel_city_id,
                            'Builder.city_5' => $channel_city_id,
                        ), 'Builder.builder_highendresidential' => '1', 'Builder.dummy_status' => $dummy_status)));

                $highend_no = $this->Builder->find('count', array('conditions' => array('OR' => array(
                            'Builder.builder_primarycity' => $channel_city_id,
                            'Builder.builder_secondarycity' => $channel_city_id,
                            'Builder.builder_tertiarycity' => $channel_city_id,
                            'Builder.city_4' => $channel_city_id,
                            'Builder.city_5' => $channel_city_id,
                        ), 'Builder.builder_highendresidential' => '2', 'Builder.dummy_status' => $dummy_status)));
            } else {

                $all_count = $this->Builder->find('count', array('conditions' => array('NOT' => array(
                            'Builder.builder_primarycity' => 2,
                            'Builder.builder_secondarycity' => 2,
                            'Builder.builder_tertiarycity' => 2,
                            'Builder.city_4' => 2,
                            'Builder.city_5' => 2,
                        ), 'Builder.dummy_status' => $dummy_status)));

                $approve = $this->Builder->find('count', array('conditions' => array('NOT' => array(
                            'Builder.builder_primarycity' => 2,
                            'Builder.builder_secondarycity' => 2,
                            'Builder.builder_tertiarycity' => 2,
                            'Builder.city_4' => 2,
                            'Builder.city_5' => 2,
                        ), 'Builder.builder_approved' => '1', 'Builder.dummy_status' => $dummy_status)));

                $pending = $this->Builder->find('count', array('conditions' => array('NOT' => array(
                            'Builder.builder_primarycity' => 2,
                            'Builder.builder_secondarycity' => 2,
                            'Builder.builder_tertiarycity' => 2,
                            'Builder.city_4' => 2,
                            'Builder.city_5' => 2,
                        ), 'Builder.builder_approved' => '2', 'Builder.dummy_status' => $dummy_status)));
                $residential_all_count = $this->Builder->find('count', array('conditions' => array('NOT' => array(
                            'Builder.builder_primarycity' => 2,
                            'Builder.builder_secondarycity' => 2,
                            'Builder.builder_tertiarycity' => 2,
                            'Builder.city_4' => 2,
                            'Builder.city_5' => 2,
                        ), 'Builder.dummy_status' => $dummy_status, 'Builder.builder_residential <> ""')));

                $residential_yes = $this->Builder->find('count', array('conditions' => array('NOT' => array(
                            'Builder.builder_primarycity' => 2,
                            'Builder.builder_secondarycity' => 2,
                            'Builder.builder_tertiarycity' => 2,
                            'Builder.city_4' => 2,
                            'Builder.city_5' => 2,
                        ), 'Builder.builder_residential' => '1', 'Builder.dummy_status' => $dummy_status)));

                $residential_no = $this->Builder->find('count', array('conditions' => array('NOT' => array(
                            'Builder.builder_primarycity' => 2,
                            'Builder.builder_secondarycity' => 2,
                            'Builder.builder_tertiarycity' => 2,
                            'Builder.city_4' => 2,
                            'Builder.city_5' => 2,
                        ), 'Builder.builder_residential' => '2', 'Builder.dummy_status' => $dummy_status)));

                $commercial_all_count = $this->Builder->find('count', array('conditions' => array('NOT' => array(
                            'Builder.builder_primarycity' => 2,
                            'Builder.builder_secondarycity' => 2,
                            'Builder.builder_tertiarycity' => 2,
                            'Builder.city_4' => 2,
                            'Builder.city_5' => 2,
                        ), 'Builder.dummy_status' => $dummy_status, 'Builder.builder_commercial <> ""')));

                $commercial_yes = $this->Builder->find('count', array('conditions' => array('NOT' => array(
                            'Builder.builder_primarycity' => 2,
                            'Builder.builder_secondarycity' => 2,
                            'Builder.builder_tertiarycity' => 2,
                            'Builder.city_4' => 2,
                            'Builder.city_5' => 2,
                        ), 'Builder.builder_commercial' => '1', 'Builder.dummy_status' => $dummy_status)));

                $commercial_no = $this->Builder->find('count', array('conditions' => array('NOT' => array(
                            'Builder.builder_primarycity' => 2,
                            'Builder.builder_secondarycity' => 2,
                            'Builder.builder_tertiarycity' => 2,
                            'Builder.city_4' => 2,
                            'Builder.city_5' => 2,
                        ), 'Builder.builder_commercial' => '2', 'Builder.dummy_status' => $dummy_status)));

                $highend_all_count = $this->Builder->find('count', array('conditions' => array('NOT' => array(
                            'Builder.builder_primarycity' => 2,
                            'Builder.builder_secondarycity' => 2,
                            'Builder.builder_tertiarycity' => 2,
                            'Builder.city_4' => 2,
                            'Builder.city_5' => 2,
                        ), 'Builder.dummy_status' => $dummy_status, 'Builder.builder_highendresidential <> ""')));

                $highend_yes = $this->Builder->find('count', array('conditions' => array('NOT' => array(
                            'Builder.builder_primarycity' => 2,
                            'Builder.builder_secondarycity' => 2,
                            'Builder.builder_tertiarycity' => 2,
                            'Builder.city_4' => 2,
                            'Builder.city_5' => 2,
                        ), 'Builder.builder_highendresidential' => '1', 'Builder.dummy_status' => $dummy_status)));

                $highend_no = $this->Builder->find('count', array('conditions' => array('NOT' => array(
                            'Builder.builder_primarycity' => 2,
                            'Builder.builder_secondarycity' => 2,
                            'Builder.builder_tertiarycity' => 2,
                            'Builder.city_4' => 2,
                            'Builder.city_5' => 2,
                        ), 'Builder.builder_highendresidential' => '2', 'Builder.dummy_status' => $dummy_status)));
            }
        } else {

            if ($channel_city_id == '1') {

                $all_count = $this->Builder->find('count', array('conditions' => array('Builder.dummy_status' => $dummy_status)));
                $approve = $this->Builder->find('count', array('conditions' => array('Builder.builder_approved' => '1', 'Builder.dummy_status' => $dummy_status)));
                $pending = $this->Builder->find('count', array('conditions' => array('Builder.builder_approved' => '2', 'Builder.dummy_status' => $dummy_status)));
                $residential_all_count = $this->Builder->find('count', array('conditions' => array('Builder.dummy_status' => $dummy_status, 'Builder.builder_residential <> ""')));
                $residential_yes = $this->Builder->find('count', array('conditions' => array('Builder.builder_residential' => '1', 'Builder.dummy_status' => $dummy_status)));
                $residential_no = $this->Builder->find('count', array('conditions' => array('Builder.builder_residential' => '2', 'Builder.dummy_status' => $dummy_status)));
                $commercial_all_count = $this->Builder->find('count', array('conditions' => array('Builder.dummy_status' => $dummy_status, 'Builder.builder_commercial <> ""')));
                $commercial_yes = $this->Builder->find('count', array('conditions' => array('Builder.builder_commercial' => '1', 'Builder.dummy_status' => $dummy_status)));
                $commercial_no = $this->Builder->find('count', array('conditions' => array('Builder.builder_commercial' => '2', 'Builder.dummy_status' => $dummy_status)));
                $highend_all_count = $this->Builder->find('count', array('conditions' => array('Builder.dummy_status' => $dummy_status, 'Builder.builder_highendresidential <> ""')));
                $highend_yes = $this->Builder->find('count', array('conditions' => array('Builder.builder_highendresidential' => '1', 'Builder.dummy_status' => $dummy_status)));
                $highend_no = $this->Builder->find('count', array('conditions' => array('Builder.builder_highendresidential' => '2', 'Builder.dummy_status' => $dummy_status)));
            } else {

                $all_count = $this->Builder->find('count', array('conditions' => array('OR' => array(
                            'Builder.builder_primarycity' => $channel_city_id,
                            'Builder.builder_secondarycity' => $channel_city_id,
                            'Builder.builder_tertiarycity' => $channel_city_id,
                            'Builder.city_4' => $channel_city_id,
                            'Builder.city_5' => $channel_city_id,
                        ), 'Builder.dummy_status' => $dummy_status)));

                $approve = $this->Builder->find('count', array('conditions' => array('OR' => array(
                            'Builder.builder_primarycity' => $channel_city_id,
                            'Builder.builder_secondarycity' => $channel_city_id,
                            'Builder.builder_tertiarycity' => $channel_city_id,
                            'Builder.city_4' => $channel_city_id,
                            'Builder.city_5' => $channel_city_id,
                        ), 'Builder.builder_approved' => '1', 'Builder.dummy_status' => $dummy_status)));

                $pending = $this->Builder->find('count', array('conditions' => array('OR' => array(
                            'Builder.builder_primarycity' => $channel_city_id,
                            'Builder.builder_secondarycity' => $channel_city_id,
                            'Builder.builder_tertiarycity' => $channel_city_id,
                            'Builder.city_4' => $channel_city_id,
                            'Builder.city_5' => $channel_city_id,
                        ), 'Builder.builder_approved' => '2', 'Builder.dummy_status' => $dummy_status)));
                $residential_all_count = $this->Builder->find('count', array('conditions' => array('OR' => array(
                            'Builder.builder_primarycity' => $channel_city_id,
                            'Builder.builder_secondarycity' => $channel_city_id,
                            'Builder.builder_tertiarycity' => $channel_city_id,
                            'Builder.city_4' => $channel_city_id,
                            'Builder.city_5' => $channel_city_id,
                        ), 'Builder.dummy_status' => $dummy_status, 'Builder.builder_residential <> ""')));

                $residential_yes = $this->Builder->find('count', array('conditions' => array('OR' => array(
                            'Builder.builder_primarycity' => $channel_city_id,
                            'Builder.builder_secondarycity' => $channel_city_id,
                            'Builder.builder_tertiarycity' => $channel_city_id,
                            'Builder.city_4' => $channel_city_id,
                            'Builder.city_5' => $channel_city_id,
                        ), 'Builder.builder_residential' => '1', 'Builder.dummy_status' => $dummy_status)));

                $residential_no = $this->Builder->find('count', array('conditions' => array('OR' => array(
                            'Builder.builder_primarycity' => $channel_city_id,
                            'Builder.builder_secondarycity' => $channel_city_id,
                            'Builder.builder_tertiarycity' => $channel_city_id,
                            'Builder.city_4' => $channel_city_id,
                            'Builder.city_5' => $channel_city_id,
                        ), 'Builder.builder_residential' => '2', 'Builder.dummy_status' => $dummy_status)));

                $commercial_all_count = $this->Builder->find('count', array('conditions' => array('OR' => array(
                            'Builder.builder_primarycity' => $channel_city_id,
                            'Builder.builder_secondarycity' => $channel_city_id,
                            'Builder.builder_tertiarycity' => $channel_city_id,
                            'Builder.city_4' => $channel_city_id,
                            'Builder.city_5' => $channel_city_id,
                        ), 'Builder.dummy_status' => $dummy_status, 'Builder.builder_commercial <> ""')));

                $commercial_yes = $this->Builder->find('count', array('conditions' => array('OR' => array(
                            'Builder.builder_primarycity' => $channel_city_id,
                            'Builder.builder_secondarycity' => $channel_city_id,
                            'Builder.builder_tertiarycity' => $channel_city_id,
                            'Builder.city_4' => $channel_city_id,
                            'Builder.city_5' => $channel_city_id,
                        ), 'Builder.builder_commercial' => '1', 'Builder.dummy_status' => $dummy_status)));

                $commercial_no = $this->Builder->find('count', array('conditions' => array('OR' => array(
                            'Builder.builder_primarycity' => $channel_city_id,
                            'Builder.builder_secondarycity' => $channel_city_id,
                            'Builder.builder_tertiarycity' => $channel_city_id,
                            'Builder.city_4' => $channel_city_id,
                            'Builder.city_5' => $channel_city_id,
                        ), 'Builder.builder_commercial' => '2', 'Builder.dummy_status' => $dummy_status)));

                $highend_all_count = $this->Builder->find('count', array('conditions' => array('OR' => array(
                            'Builder.builder_primarycity' => $channel_city_id,
                            'Builder.builder_secondarycity' => $channel_city_id,
                            'Builder.builder_tertiarycity' => $channel_city_id,
                            'Builder.city_4' => $channel_city_id,
                            'Builder.city_5' => $channel_city_id,
                        ), 'Builder.dummy_status' => $dummy_status, 'Builder.builder_highendresidential <> ""')));

                $highend_yes = $this->Builder->find('count', array('conditions' => array('OR' => array(
                            'Builder.builder_primarycity' => $channel_city_id,
                            'Builder.builder_secondarycity' => $channel_city_id,
                            'Builder.builder_tertiarycity' => $channel_city_id,
                            'Builder.city_4' => $channel_city_id,
                            'Builder.city_5' => $channel_city_id,
                        ), 'Builder.builder_highendresidential' => '1', 'Builder.dummy_status' => $dummy_status)));

                $highend_no = $this->Builder->find('count', array('conditions' => array('OR' => array(
                            'Builder.builder_primarycity' => $channel_city_id,
                            'Builder.builder_secondarycity' => $channel_city_id,
                            'Builder.builder_tertiarycity' => $channel_city_id,
                            'Builder.city_4' => $channel_city_id,
                            'Builder.city_5' => $channel_city_id,
                        ), 'Builder.builder_highendresidential' => '2', 'Builder.dummy_status' => $dummy_status)));
            }
        }


        $this->set(compact('all_count'));
        $this->set(compact('approve'));
        $this->set(compact('pending'));
        $this->set(compact('residential_all_count'));
        $this->set(compact('residential_yes'));
        $this->set(compact('residential_no'));
        $this->set(compact('commercial_all_count'));
        $this->set(compact('commercial_yes'));
        $this->set(compact('commercial_no'));
        $this->set(compact('highend_all_count'));
        $this->set(compact('highend_yes'));
        $this->set(compact('highend_no'));

        $multicity_count = $this->Builder->find('count', array(
            'conditions' => array('OR' => array(
                    'Builder.builder_primarycity' => $channel_city_id,
                    'Builder.builder_secondarycity' => $channel_city_id,
                    'Builder.builder_tertiarycity' => $channel_city_id,
                    'Builder.city_4' => $channel_city_id,
                    'Builder.city_5' => $channel_city_id,
                ),
                'Builder.builder_approved' => '1',
                'Builder.dummy_status' => $dummy_status,
            ),
        ));
        $this->set(compact('multicity_count'));

        $builder = $this->Builder->find('list', array('fields' => 'Builder.id, Builder.builder_name', 'order' => 'Builder.builder_name ASC'));
        $this->set('builder', $builder);





        $city = $this->City->find('list', array('fields' => 'City.id, City.city_name', 'conditions' => array('City.dummy_status' => $dummy_status, 'City.city_status' => '1'), 'order' => 'City.city_name ASC'));
        $this->set('city', $city);

        $codes = $this->LookupValueLeadsCountry->find('all', array('fields' => array('LookupValueLeadsCountry.id', 'LookupValueLeadsCountry.value', 'LookupValueLeadsCountry.code')));
        $codes = Set::combine($codes, '{n}.LookupValueLeadsCountry.id', array('%s:', '{n}.LookupValueLeadsCountry.code'));
        $this->set(compact('codes'));

        if (!isset($this->passedArgs['builder_primarycity']) && empty($this->passedArgs['builder_primarycity'])) {
            $this->passedArgs['builder_primarycity'] = (isset($this->data['Builder']['builder_primarycity'])) ? $this->data['Builder']['builder_primarycity'] : '';
        }
        if (!isset($this->passedArgs['builder_name']) && empty($this->passedArgs['builder_name'])) {
            $this->passedArgs['builder_name'] = (isset($this->data['Builder']['builder_name'])) ? $this->data['Builder']['builder_name'] : '';
        }
        if (!isset($this->passedArgs['builder_residential']) && empty($this->passedArgs['builder_residential'])) {
            $this->passedArgs['builder_residential'] = (isset($this->data['Builder']['builder_residential'])) ? $this->data['Builder']['builder_residential'] : '';
        }
        if (!isset($this->passedArgs['builder_commercial']) && empty($this->passedArgs['builder_commercial'])) {
            $this->passedArgs['builder_commercial'] = (isset($this->data['Builder']['builder_commercial'])) ? $this->data['Builder']['builder_commercial'] : '';
        }
        if (!isset($this->passedArgs['builder_highendresidential']) && empty($this->passedArgs['builder_highendresidential'])) {
            $this->passedArgs['builder_highendresidential'] = (isset($this->data['Builder']['builder_highendresidential'])) ? $this->data['Builder']['builder_highendresidential'] : '';
        }
        if (!isset($this->data) && empty($this->data)) {
            $this->data['Builder']['builder_primarycity'] = $this->passedArgs['builder_primarycity'];
            $this->data['Builder']['builder_name'] = $this->passedArgs['builder_name'];
            $this->data['Builder']['builder_residential'] = $this->passedArgs['builder_residential'];
            $this->data['Builder']['builder_commercial'] = $this->passedArgs['builder_commercial'];
            $this->data['Builder']['builder_highendresidential'] = $this->passedArgs['builder_highendresidential'];
        }

        $this->set(compact('builder_primarycity'));
        $this->set(compact('builder_name'));
        $this->set(compact('builder_residential'));
        $this->set(compact('builder_commercial'));
        $this->set(compact('builder_highendresidential'));
    }

    public function add() {

        $user_id = $this->Auth->user('id');
        $role_id = $this->Session->read("role_id");
        $dummy_status = $this->Auth->user('dummy_status');
        $condition_dummy_status = array('dummy_status =' . $dummy_status, 'id != 1');


        if ($this->request->is('post')) {


            $this->request->data['Builder']['dummy_status'] = $dummy_status;
            $this->request->data['Builder']['builder_approved'] = '1';
            $this->request->data['Builder']['builder_status'] = '1';  // 1 for Yes of lookup_value_statuses
            $this->request->data['Builder']['created_by'] = $user_id;
            if ($this->data['Builder']['builder_boardnumber'] == '')
                $this->request->data['Builder']['builder_boardnumber_code'] = '';


            $this->Builder->create();
            if ($this->Builder->save($this->request->data['Builder'])) {

                $builder_id = $this->Builder->getLastInsertId();
                if ($builder_id) {
                   
                    
                    /**********************Builder Remarks ******************************** */
                    
                    /*
                    $remarks['Remark']['builder_id'] = $builder_id;
                    $remarks['Remark']['remarks'] = 'New Builder Record Created';
                    $remarks['Remark']['remarks_by'] = $user_id;
                    $remarks['Remark']['created_by'] = $user_id;
                    $remarks['Remark']['remarks_time'] = date('g:i A');
                    $remarks['Remark']['remarks_level'] = '1'; //2 for builder from lookup_value_remarks_level
                    $remarks['Remark']['dummy_status'] = $dummy_status;
                    $this->Remark->save($remarks);

                    /********************Builder Contacts************************ */
                    
                    if ($this->data['Builder']['is_contact']) {
                        
                        
                        $contact_action_item['ActionItem']['action_item_level_id'] = '5'; //  for Builder Contact
                        $contact_action_item['ActionItem']['type_id'] = '7'; // 7 for Submission For Approval
                        $contact_action_item['ActionItem']['next_action_by'] = '148'; // system desk
                        $contact_action_item['ActionItem']['action_item_active'] = 'Yes';
                        $contact_action_item['ActionItem']['action_item_status'] = '7'; //1 for created table - lookup_value_action_item_statuses
                        $contact_action_item['ActionItem']['description'] = 'Buillder Contact  Record Created - Submission For Approval';
                        $contact_action_item['ActionItem']['action_item_source'] = $role_id;
                        $contact_action_item['ActionItem']['created_by_id'] = $user_id;
                        $contact_action_item['ActionItem']['created_by'] = $user_id;
                        $contact_action_item['ActionItem']['dummy_status'] = $dummy_status;
                        $this->request->data['BuilderContact']['created_by'] = $user_id;
                        $this->request->data['BuilderContact']['dummy_status'] = $dummy_status;
                        $this->request->data['BuilderContact']['contact_type'] = '2'; // for builder
                        $this->request->data['BuilderContact']['builder_contact_builder_id'] = $builder_id;
                        $this->request->data['BuilderContact']['builder_contact_approved'] = '1'; 
                        
                        if ($this->BuilderContact->save($this->request->data['BuilderContact'])) {
                            $builder_contact_id = $this->BuilderContact->getLastInsertId();
                            /*
                            $this->ActionItem->query("INSERT INTO `action_items` (`action_item_level_id`, `type_id`, `builder_contact_id`, `action_item_status`, `action_item_source`, `created_by_id`, `action_item_active`,  `description`, `next_action_by`,  `created_by`,`dummy_status`,`created`) VALUES ('" . $contact_action_item['ActionItem']['action_item_level_id'] . "', '" . $contact_action_item['ActionItem']['type_id'] . "', '" . $builder_contact_id . "', '" . $contact_action_item['ActionItem']['action_item_status'] . "', '" . $contact_action_item['ActionItem']['action_item_source'] . "', '" . $contact_action_item['ActionItem']['created_by_id'] . "', '" . $contact_action_item['ActionItem']['action_item_active'] . "', '" . $contact_action_item['ActionItem']['description'] . "', '" . $contact_action_item['ActionItem']['next_action_by'] . "', '" . $contact_action_item['ActionItem']['created_by'] . "', '" . $contact_action_item['ActionItem']['dummy_status'] . "','" . date('Y-m-d h:i:s') . "')");


                            $ActionId1 = $this->ActionItem->query("SELECT LAST_INSERT_ID()");
                            $last_id = $ActionId1[0][0]['LAST_INSERT_ID()'];

                            $this->ActionItem->updateAll(array('ActionItem.parent_action_item_id' => $last_id), array('ActionItem.id' => $last_id));
                            
                             */
                        }
                    }

                    /*                     * ************************Next Action By logic********************** */
                    /*
                    $action_user_id = '';
                    $oversing_user = array();

                    $oversing_channel = $this->Channel->find('first', array('conditions' => array('Channel.city_id' => $this->data['Builder']['builder_primarycity'], 'Channel.dummy_status' => $dummy_status), 'fields' => 'id'));

                    if (!empty($oversing_channel))
                        $oversing_user = $this->User->find('first', array('conditions' => array('User.overse_channel_id' => $oversing_channel['Channel']['id'], 'User.overse_role_id' => 10, 'User.dummy_status' => $dummy_status), 'fields' => 'id')); // 10 for Overseer of roles table.

                    if (count($oversing_user))
                        $action_user_id = $oversing_user['User']['id'];

                    /*                     * ************************Builder Action ********************** */
                   /*
                    $action_item['ActionItem']['builder_id'] = $builder_id;
                    $action_item['ActionItem']['action_item_level_id'] = '2'; //  for Builder 
                    $action_item['ActionItem']['type_id'] = '7'; // 7 for Submission For Approval
                    $action_item['ActionItem']['action_industry'] = '1'; // for realestate of lookup_value_activity_industry
                    $action_item['ActionItem']['action_item_active'] = 'Yes';
                    $action_item['ActionItem']['action_item_status'] = '7'; //7 for Submitted For Approval table - lookup_value_action_item_statuses
                    $action_item['ActionItem']['description'] = 'New Buillder Record Created - Submission For Approval';
                    $action_item['ActionItem']['action_item_source'] = $role_id;
                    $action_item['ActionItem']['created_by_id'] = $user_id;
                    $action_item['ActionItem']['created_by'] = $user_id;
                    $action_item['ActionItem']['dummy_status'] = $dummy_status;
                    //$action_item['ActionItem']['next_action_by'] = $action_user_id;
                    $action_item['ActionItem']['next_action_by'] = '136';
                    $this->ActionItem->save($action_item);
                    $ActionId = $this->ActionItem->getLastInsertId();
                    $this->ActionItem->id = $ActionId;
                    $this->ActionItem->saveField('parent_action_item_id', $ActionId);



                    /* Email Logic */
                    /*
                      $to = 'neerajs@wtbglobal.com';
                      $Email = new CakeEmail();
                      $Email->viewVars(array(
                      'Builder' => $this->data['Builder']['builder_name'],
                      'Address' => $this->data['Builder']['builder_corporateaddress'],
                      'Board_no' => $this->data['Builder']['builder_boardnumber'],
                      'Board_email' => $this->data['Builder']['builder_boardemail'],
                      'Status' => 'Submission For Approval',

                      ));
                      $Email->template('builder_template', 'default')->emailFormat('html')->to($to)->from('admin@silkrouters.com')->subject('Silkrouters - Submission for Builder')->send();
                     */
                    /* End Emial */
                    /* Phone API */
                    /*
                      $msg = $this->data['Builder']['builder_name'].' | '.$this->data['Builder']['builder_corporateaddress'].' | '.$this->data['Builder']['builder_boardnumber'].' | '.$this->data['Builder']['builder_boardemail'].' | Submission For Approval';
                      $authKey = Configure::read('sms_api_key');
                      $senderId = Configure::read('sms_sender_id');
                      // $mobileNumber = $channels[0]['User']['primary_mobile_number'];
                      $mobileNumber = "9833156460";
                      $message = urlencode($msg);
                      $route = "default";
                      $this->Sms->send_sms($authKey,$mobileNumber,$message,$senderId,$route);
                     */
                    /* End Phone */

                  
                       
                    $this->Session->setFlash('Builder has been saved.', 'success');
                    $this->redirect(array('controller' => 'messages', 'action' => 'index', 'builders', 'my-builders'));
                }
            } else {
                $this->Session->setFlash('Unable to add builder.', 'failure');
            }
        }

        $city = $this->City->find('list', array('fields' => 'City.id, City.city_name', 'conditions' => array('City.dummy_status' => $dummy_status, 'City.city_status' => '1'), 'order' => 'City.city_name ASC'));
        $this->set('city', $city);

        $suburb = $this->Suburb->find('list', array('fields' => array('Suburb.id, Suburb.suburb_name'), 'conditions' => array('Suburb.dummy_status' => $dummy_status, 'Suburb.suburb_status' => '1'), 'order' => 'Suburb.suburb_name ASC'));
        $this->set('suburbs', $suburb);

        $areas = $this->Area->find('list', array('fields' => array('Area.id, Area.area_name'), 'conditions' => array('Area.dummy_status' => $dummy_status, 'Area.area_status' => '1'), 'order' => 'Area.area_name ASC'));
        $this->set('areas', $areas);

        $codes = $this->LookupValueLeadsCountry->find('all', array('fields' => array('LookupValueLeadsCountry.id', 'LookupValueLeadsCountry.value', 'LookupValueLeadsCountry.code')));
        $codes = Set::combine($codes, '{n}.LookupValueLeadsCountry.id', array('%s: %s', '{n}.LookupValueLeadsCountry.value', '{n}.LookupValueLeadsCountry.code'));
        $this->set(compact('codes'));

        $contact_level = $this->LookupBuilderContactLevel->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('contact_level'));

        $for_company = $this->LookupCompany->find('list', array('fields' => 'id, value', 'conditions' => array('id' => array('1', '2')), 'order' => 'value ASC'));
        $this->set(compact('for_company'));

        $contact_initiated = $this->LookupBuilderContactInitiatedBy->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('contact_initiated'));

        $contact_managed = $this->LookupBuilderContactManagedBy->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('contact_managed'));

        $contact_prepared = $this->LookupBuilderContactPreparedBy->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('contact_prepared'));

        $contact_status = $this->LookupBuilderContactStatus->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('contact_status'));

        $agreement_level = $this->LookupBuilderAgreementLevel->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('agreement_level'));


        $agreement_done_with = $this->LookupBuilderAgreementDoneWith->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('agreement_done_with'));

        $marketings_partners = $this->MarketingPartner->find('list', array('fields' => 'id, marketing_partner_display_name', 'order' => 'marketing_partner_display_name ASC'));
        $this->set(compact('marketings_partners'));

        $marketings_partners_legal_name = $this->MarketingPartner->find('list', array('fields' => 'id, marketing_partner_legal_name', 'order' => 'marketing_partner_legal_name ASC'));
        $this->set(compact('marketings_partners_legal_name'));

        $agreement_proposed = $this->LookupBuilderAgreementProposed->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('agreement_proposed'));

        $manage_by = $this->LookupBuilderAgreementManagedBy->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('manage_by'));

        $builder_legal_names = $this->BuilderLegalName->find('list', array('fields' => 'id, builder_legal_names_name', 'order' => 'builder_legal_names_name ASC'));
        $this->set(compact('builder_legal_names'));

        $intiate_by = $this->LookupBuilderAgreementIntiatedBy->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('intiate_by'));

        $prepare_by = $this->LookupBuilderAgreementPreparedBy->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('prepare_by'));

        $commission_based_on = $this->LookupBuilderAgreementCommissionBasedOn->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('commission_based_on'));

        $commission_terms = $this->LookupBuilderAgreementCommissionTerm->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('commission_terms'));

        $agreement_status = $this->LookupBuilderAgreementStatuse->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('agreement_status'));
    }

    function edit($id = null) {

        $user_id = $this->Auth->user('id');
        $role_id = $this->Session->read("role_id");
        $dummy_status = $this->Auth->user('dummy_status');
        $actio_itme_id = '';
        $flag = 0;
        $arr = explode('_', $id);
        $id = base64_decode($arr[0]);
        if (count($arr) > 1) {
            $actio_itme_id = $arr[1];
            $flag = 1;
        }

        if (!$id) {
            throw new NotFoundException(__('Invalid Builder'));
        }

        $builder = $this->Builder->findById($id);


        if (!$builder) {
            throw new NotFoundException(__('Invalid builder'));
        }

        if ($this->request->data) {

            /*             * *************************Next Action By logic********************** */

            $action_user_id = '';
            $oversing_user = array();
            /*
              $oversing_channel = $this->Channel->find('first',array('conditions' => array('Channel.city_id'=> $this->data['BuilderContact']['builder_contact_company_city'],'Channel.dummy_status' => $dummy_status),'fields' => 'id'));

              if(!empty($oversing_channel))
              $oversing_user = $this->User->find('first',array('conditions' => array('User.overse_channel_id'=> $oversing_channel['Channel']['id'],'User.overse_role_id' => 10,'User.dummy_status' => $dummy_status),'fields' => 'id')); // 10 for Overseer of roles table.

              if(count($oversing_user))
              $action_user_id = $oversing_user['User']['id'];
             */

            //$this->request->data['Builder']['builder_approved'] = '2';

            /*             * ************************Builder Action ********************** */
            $action_item['ActionItem']['builder_id'] = $id;
            $action_item['ActionItem']['action_item_level_id'] = '2'; //  for Builder
            $action_item['ActionItem']['type_id'] = '10'; // 10 for Re-Submission For Approval
            $action_item['ActionItem']['next_action_by'] = '148';
            $action_item['ActionItem']['action_item_active'] = 'Yes';
            $action_item['ActionItem']['action_item_status'] = '17'; //1 for created table - lookup_value_action_item_statuses
            $action_item['ActionItem']['description'] = 'Buillder Record Updated - Re-Submission For Approval';
            $action_item['ActionItem']['action_item_source'] = $role_id;
            $action_item['ActionItem']['created_by_id'] = $user_id;
            $action_item['ActionItem']['created_by'] = $user_id;
            $action_item['ActionItem']['dummy_status'] = $dummy_status;
            $action_item['ActionItem']['parent_action_item_id'] = $actio_itme_id;
            $action_item['ActionItem']['action_industry'] = '1'; // for realestate of lookup_value_activity_industry



            /*             * ********************Builder Agreement ******************************** */

            /* 	$agreement_action_item['ActionItem']['builder_id'] = $id;
              $agreement_action_item['ActionItem']['action_item_level_id'] = '2'; //  for Builder
              $agreement_action_item['ActionItem']['type_id'] = '10'; // 10 for Re-Submission For Approval
              $agreement_action_item['ActionItem']['next_action_by'] = '148'; // system desk
              $agreement_action_item['ActionItem']['action_item_active'] = 'Yes';
              $agreement_action_item['ActionItem']['action_item_status'] = '17'; //1 for created table - lookup_value_action_item_statuses
              $agreement_action_item['ActionItem']['description'] = 'Buillder Record Updated - Re-Submission For Approval';
              $agreement_action_item['ActionItem']['action_item_source'] = $role_id;
              $agreement_action_item['ActionItem']['created_by_id'] = $user_id;
              $agreement_action_item['ActionItem']['created_by'] = $user_id;
              $agreement_action_item['ActionItem']['dummy_status'] = $dummy_status;
              $agreement_action_item['ActionItem']['parent_action_item_id'] = $actio_itme_id; */

            /*             * ********************Builder Remarks ******************************** */
            $remarks['Remark']['builder_id'] = $id;
            $remarks['Remark']['remarks'] = 'Edit Builder Record';
            $remarks['Remark']['remarks_by'] = $user_id;
            $remarks['Remark']['created_by'] = $user_id;
            $remarks['Remark']['remarks_time'] = date('g:i A');
            $remarks['Remark']['remarks_level'] = '1'; //2 for builder from lookup_value_remarks_level
            $remarks['Remark']['dummy_status'] = $dummy_status;
            $this->Remark->save($remarks);

            if ($this->data['Builder']['action_type'] == '0') {

                $this->request->data['Builder']['builder_active_primary'] = '1';
                $action_item['ActionItem']['screen_no'] = 'SC-1';
                $this->Builder->id = $id;
                if ($this->Builder->save($this->request->data['Builder'])) {

                    $this->ActionItem->save($action_item);
                    $ActionId = $this->ActionItem->getLastInsertId();
                    $this->ActionItem->id = $ActionId;
                    $this->ActionItem->saveField('parent_action_item_id', $ActionId);
                    if ($actio_itme_id) {
                        $this->ActionItem->saveField('parent_action_item_id', $actio_itme_id);
                        $this->ActionItem->updateAll(array('ActionItem.action_item_active' => "'No'"), array('ActionItem.id' => $actio_itme_id));
                        $this->Session->setFlash('Your changes have been submitted. Waiting for approval at the moment...', 'success');
                        // $this->redirect(array('controller' => 'action-items','action' => 'index'));
                    }

                    $this->Session->setFlash('Builder has been updated.', 'success');
                    //$this->redirect(array('controller' => 'messages','action' => 'index','builder','my-builders'));
                }
            } else if ($this->data['Builder']['action_type'] == '1') {
                $action_item['ActionItem']['screen_no'] = 'SC-2';
                $this->request->data['Builder']['builder_active_operation'] = '1';
                $this->Builder->id = $id;
                if ($this->Builder->save($this->request->data['Builder'])) {
                    $this->ActionItem->save($action_item);
                    $ActionId = $this->ActionItem->getLastInsertId();
                    $this->ActionItem->id = $ActionId;
                    $this->ActionItem->saveField('parent_action_item_id', $ActionId);
                    if ($actio_itme_id) {
                        $this->ActionItem->saveField('parent_action_item_id', $actio_itme_id);
                        $this->ActionItem->updateAll(array('ActionItem.action_item_active' => "'No'"), array('ActionItem.id' => $actio_itme_id));
                        $this->Session->setFlash('Your changes have been submitted. Waiting for approval at the moment...', 'success');
                        //$this->redirect(array('controller' => 'action-items','action' => 'index'));
                    }

                    $this->Session->setFlash('Your changes have been submitted. Waiting for approval at the moment...', 'success');
                    //	$this->redirect(array('controller' => 'messages','action' => 'index','builder','my-builders'));
                }
            }




            //$this->Session->setFlash('Builder contact has been updated.', 'success');
            //$this->redirect(array('controller' => 'messages','action' => 'index','builder','my-builders'));	


            $this->set('action_type', $this->data['Builder']['action_type']);

            if ($flag == 1)
                $this->redirect(array('controller' => 'action-items', 'action' => 'index'));
        }






        $city = $this->City->find('list', array('fields' => 'City.id, City.city_name', 'conditions' => array('City.dummy_status' => $dummy_status, 'City.city_status' => '1'), 'order' => 'City.city_name ASC'));
        $this->set('city', $city);

        $agreement_level = $this->LookupBuilderAgreementLevel->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('agreement_level'));



        $agreement_proposed = $this->LookupBuilderAgreementProposed->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('agreement_proposed'));

        $for_company = $this->LookupCompany->find('list', array('fields' => 'id, value', 'conditions' => array('id' => array('1', '2')), 'order' => 'value ASC'));
        $this->set(compact('for_company'));

        $manage_by = $this->LookupBuilderAgreementManagedBy->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('manage_by'));

        $intiate_by = $this->LookupBuilderAgreementIntiatedBy->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('intiate_by'));

        $prepare_by = $this->LookupBuilderAgreementPreparedBy->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('prepare_by'));

        $commission_based_on = $this->LookupBuilderAgreementCommissionBasedOn->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('commission_based_on'));

        $commission_terms = $this->LookupBuilderAgreementCommissionTerm->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('commission_terms'));

        $agreement_status = $this->LookupBuilderAgreementStatuse->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('agreement_status'));

        $builder_contacts = $this->BuilderContact->find('all', array('conditions' => array('BuilderContact.builder_contact_builder_id' => $id), 'order' => 'builder_contact_name ASC'));
        $this->set(compact('builder_contacts'));

        $builder_legal_names = $this->BuilderLegalName->find('all', array('conditions' => array('BuilderLegalName.builder_legal_names_builder_id' => $id, 'BuilderLegalName.builder_legal_names_status' => 1), 'order' => 'builder_legal_names_name ASC'));
        $this->set(compact('builder_legal_names'));


        $codes = $this->LookupValueLeadsCountry->find('all', array('fields' => array('LookupValueLeadsCountry.id', 'LookupValueLeadsCountry.value', 'LookupValueLeadsCountry.code')));
        $codes = Set::combine($codes, '{n}.LookupValueLeadsCountry.id', array('%s: %s', '{n}.LookupValueLeadsCountry.value', '{n}.LookupValueLeadsCountry.code'));
        $this->set(compact('codes'));




        $city = $this->City->find('list', array('fields' => 'City.id, City.city_name', 'conditions' => array('City.dummy_status' => $dummy_status, 'City.city_status' => '1'), 'order' => 'City.city_name ASC'));
        $this->set('city', $city);

        $codes = $this->LookupValueLeadsCountry->find('all', array('fields' => array('LookupValueLeadsCountry.id', 'LookupValueLeadsCountry.value', 'LookupValueLeadsCountry.code')));
        $codes = Set::combine($codes, '{n}.LookupValueLeadsCountry.id', array('%s: %s', '{n}.LookupValueLeadsCountry.value', '{n}.LookupValueLeadsCountry.code'));
        $this->set(compact('codes'));

        $contact_level = $this->LookupBuilderContactLevel->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('contact_level'));

        $contact_initiated = $this->LookupBuilderContactInitiatedBy->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('contact_initiated'));

        $contact_managed = $this->LookupBuilderContactManagedBy->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('contact_managed'));

        $contact_prepared = $this->LookupBuilderContactPreparedBy->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('contact_prepared'));

        $contact_status = $this->LookupBuilderContactStatus->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('contact_status'));

        $contact_name = $this->BuilderContact->find('list', array('fields' => 'id, builder_contact_name', 'order' => 'builder_contact_name ASC'));
        $this->set(compact('contact_name'));
        //pr($builder_contact_name);
        //$log = $this->BuilderContact->getDataSource()->getLog(false, false);       
        // debug($log);

        $this->request->data = $builder;
    }

    public function add_agreement($builder_id = null) {
        $this->layout = '';
        $dummy_status = $this->Auth->user('dummy_status');

        if ($this->request->is('post') || $this->request->is('put')) {

            $this->request->data['BuilderAgreement']['builder_agreement_builder_id'] = $builder_id;
            $this->request->data['BuilderAgreement']['builder_agreement_approved_date'] = date('Y-m-d', strtotime($this->data['BuilderAgreement']['builder_agreement_approved_date']));
            $this->request->data['BuilderAgreement']['builder_agreement_expiry_date'] = date('Y-m-d', strtotime($this->data['BuilderAgreement']['builder_agreement_expiry_date']));
            $this->request->data['BuilderAgreement']['builder_agreement_effective_date'] = date('Y-m-d', strtotime($this->data['BuilderAgreement']['builder_agreement_effective_date']));


            if ($this->BuilderAgreement->save($this->request->data)) {
                echo '<script>
				 			var objP=parent.document.getElementsByClassName("mfp-bg");
							var objC=parent.document.getElementsByClassName("mfp-wrap");
							objP[0].style.display="none";
							objC[0].style.display="none";
							parent.location.reload(true);</script>';
            }
        }

        $codes = $this->LookupValueLeadsCountry->find('all', array('fields' => array('LookupValueLeadsCountry.id', 'LookupValueLeadsCountry.value', 'LookupValueLeadsCountry.code')));
        $codes = Set::combine($codes, '{n}.LookupValueLeadsCountry.id', array('%s: %s', '{n}.LookupValueLeadsCountry.value', '{n}.LookupValueLeadsCountry.code'));
        $this->set(compact('codes'));

        $agreement_level = $this->LookupBuilderAgreementLevel->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('agreement_level'));

        $for_company = $this->LookupCompany->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('for_company'));

        $agreement_done_with = $this->LookupBuilderAgreementDoneWith->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('agreement_done_with'));

        $marketings_partners = $this->MarketingPartner->find('list', array('fields' => 'id, marketing_partner_display_name', 'order' => 'marketing_partner_display_name ASC'));
        $this->set(compact('marketings_partners'));

        $marketings_partners_legal_name = $this->MarketingPartner->find('list', array('fields' => 'id, marketing_partner_legal_name', 'order' => 'marketing_partner_legal_name ASC'));
        $this->set(compact('marketings_partners_legal_name'));



        $agreement_proposed = $this->LookupBuilderAgreementProposed->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('agreement_proposed'));

        $manage_by = $this->LookupBuilderAgreementManagedBy->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('manage_by'));

        $builder_legal_names = $this->BuilderLegalName->find('list', array('fields' => 'id, builder_legal_names_name', 'order' => 'builder_legal_names_name ASC'));
        $this->set(compact('builder_legal_names'));

        $intiate_by = $this->LookupBuilderAgreementIntiatedBy->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('intiate_by'));

        $prepare_by = $this->LookupBuilderAgreementPreparedBy->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('prepare_by'));

        $commission_based_on = $this->LookupBuilderAgreementCommissionBasedOn->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('commission_based_on'));

        $commission_terms = $this->LookupBuilderAgreementCommissionTerm->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('commission_terms'));

        $agreement_status = $this->LookupBuilderAgreementStatuse->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('agreement_status'));

        $agreement_contacts = $this->BuilderContact->find('list', array('fields' => 'id,builder_contact_name', 'order' => 'builder_contact_name ASC'));
        $this->set(compact('agreement_contacts'));

        $city = $this->City->find('list', array('fields' => 'City.id, City.city_name', 'conditions' => array('City.dummy_status' => $dummy_status, 'City.city_status' => '1'), 'order' => 'City.city_name ASC'));
        $this->set('city', $city);
    }

    public function edit_agreement($id = null) {
        $this->layout = '';

        $dummy_status = $this->Auth->user('dummy_status');

        if (!$id) {
            throw new NotFoundException(__('Invalid Builder'));
        }

        $builder_agreement = $this->BuilderAgreement->findById($id);


        if (!$builder_agreement) {
            throw new NotFoundException(__('Invalid builder'));
        }




        if ($this->request->is('post') || $this->request->is('put')) {

            $this->request->data['BuilderAgreement']['builder_agreement_approved_date'] = date('Y-m-d', strtotime($this->data['BuilderAgreement']['builder_agreement_approved_date']));
            $this->request->data['BuilderAgreement']['builder_agreement_expiry_date'] = date('Y-m-d', strtotime($this->data['BuilderAgreement']['builder_agreement_expiry_date']));
            $this->request->data['BuilderAgreement']['builder_agreement_effective_date'] = date('Y-m-d', strtotime($this->data['BuilderAgreement']['builder_agreement_effective_date']));

            $this->BuilderAgreement->id = $id;

            if ($this->BuilderAgreement->save($this->request->data)) {
                $this->redirect(array('action' => 'my-builders'));
                echo '<script>
				 			var objP=parent.document.getElementsByClassName("mfp-bg");
							var objC=parent.document.getElementsByClassName("mfp-wrap");
							objP[0].style.display="none";
							objC[0].style.display="none";
							parent.location.reload(true);
						</script>';
            }
        }

        $codes = $this->LookupValueLeadsCountry->find('all', array('fields' => array('LookupValueLeadsCountry.id', 'LookupValueLeadsCountry.value', 'LookupValueLeadsCountry.code')));
        $codes = Set::combine($codes, '{n}.LookupValueLeadsCountry.id', array('%s: %s', '{n}.LookupValueLeadsCountry.value', '{n}.LookupValueLeadsCountry.code'));
        $this->set(compact('codes'));

        $agreement_level = $this->LookupBuilderAgreementLevel->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('agreement_level'));



        $agreement_proposed = $this->LookupBuilderAgreementProposed->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('agreement_proposed'));

        $manage_by = $this->LookupBuilderAgreementManagedBy->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('manage_by'));

        $intiate_by = $this->LookupBuilderAgreementIntiatedBy->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('intiate_by'));

        $prepare_by = $this->LookupBuilderAgreementPreparedBy->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('prepare_by'));

        $commission_based_on = $this->LookupBuilderAgreementCommissionBasedOn->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('commission_based_on'));

        $commission_terms = $this->LookupBuilderAgreementCommissionTerm->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('commission_terms'));

        $agreement_status = $this->LookupBuilderAgreementStatuse->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('agreement_status'));

        $city = $this->City->find('list', array('fields' => 'City.id, City.city_name', 'conditions' => array('City.dummy_status' => $dummy_status, 'City.city_status' => '1'), 'order' => 'City.city_name ASC'));
        $this->set('city', $city);

        $this->request->data = $builder_agreement;
    }

    public function add_contact($builder_id = null) {
        $this->layout = '';
        $dummy_status = $this->Auth->user('dummy_status');

        if ($this->request->is('post') || $this->request->is('put')) {

            $this->request->data['BuilderContact']['builder_contact_builder_id'] = $builder_id;
            $this->request->data['BuilderContact']['builder_contact_approved_date'] = date('Y-m-d', strtotime($this->data['BuilderContact']['builder_contact_approved_date']));


            if ($this->BuilderContact->save($this->request->data)) {
                echo '<script>var objP=parent.document.getElementsByClassName("mfp-bg");
							var objC=parent.document.getElementsByClassName("mfp-wrap");
							objP[0].style.display="none";
							objC[0].style.display="none";
							parent.location.reload(true);</script>';
            }
        }

        $codes = $this->LookupValueLeadsCountry->find('all', array('fields' => array('LookupValueLeadsCountry.id', 'LookupValueLeadsCountry.value', 'LookupValueLeadsCountry.code')));
        $codes = Set::combine($codes, '{n}.LookupValueLeadsCountry.id', array('%s: %s', '{n}.LookupValueLeadsCountry.value', '{n}.LookupValueLeadsCountry.code'));
        $this->set(compact('codes'));

        $contact_level = $this->LookupBuilderContactLevel->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('contact_level'));

        $contact_status = $this->LookupBuilderContactStatus->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('contact_status'));

        $for_company = $this->LookupCompany->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('for_company'));

        $contact_initiated = $this->LookupBuilderContactInitiatedBy->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('contact_initiated'));

        $contact_managed = $this->LookupBuilderContactManagedBy->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('contact_managed'));

        $contact_prepared = $this->LookupBuilderContactPreparedBy->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('contact_prepared'));

        $city = $this->City->find('list', array('fields' => 'City.id, City.city_name', 'conditions' => array('City.dummy_status' => $dummy_status, 'City.city_status' => '1'), 'order' => 'City.city_name ASC'));
        $this->set('city', $city);
    }

    public function edit_contact($id = null) {
        $this->layout = '';
        $dummy_status = $this->Auth->user('dummy_status');

        if (!$id) {
            throw new NotFoundException(__('Invalid Builder'));
        }

        $builder_contacts = $this->BuilderContact->findById($id);


        if (!$builder_contacts) {
            throw new NotFoundException(__('Invalid builder'));
        }




        if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['BuilderContact']['builder_contact_approved_date'] = date('Y-m-d', strtotime($this->data['BuilderContact']['builder_contact_approved_date']));

            $this->BuilderContact->id = $id;

            if ($this->BuilderContact->save($this->request->data)) {

                echo '<script>
							var objP=parent.document.getElementsByClassName("mfp-bg");
							var objC=parent.document.getElementsByClassName("mfp-wrap");
							objP[0].style.display="none";
							objC[0].style.display="none";
							parent.location.reload(true);
				 </script>';
                // $this->Session->setFlash('Builder has been updated.', 'success');
                // $this->redirect(array('controller' => 'messages','action' => 'index','builder','my-builders'));
            }
        }

        $codes = $this->LookupValueLeadsCountry->find('all', array('fields' => array('LookupValueLeadsCountry.id', 'LookupValueLeadsCountry.value', 'LookupValueLeadsCountry.code')));
        $codes = Set::combine($codes, '{n}.LookupValueLeadsCountry.id', array('%s: %s', '{n}.LookupValueLeadsCountry.value', '{n}.LookupValueLeadsCountry.code'));
        $this->set(compact('codes'));

        $contact_level = $this->LookupBuilderContactLevel->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('contact_level'));

        $contact_status = $this->LookupBuilderContactStatus->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('contact_status'));

        $contact_initiated = $this->LookupBuilderContactInitiatedBy->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('contact_initiated'));

        $contact_managed = $this->LookupBuilderContactManagedBy->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('contact_managed'));

        $contact_prepared = $this->LookupBuilderContactPreparedBy->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('contact_prepared'));

        $city = $this->City->find('list', array('fields' => 'City.id, City.city_name', 'conditions' => array('City.dummy_status' => $dummy_status, 'City.city_status' => '1'), 'order' => 'City.city_name ASC'));
        $this->set('city', $city);

        $this->request->data = $builder_contacts;
    }

    function view($id = null) {

        $arr = explode('_', $id);
        $id = base64_decode($arr[0]);


        if (!$id) {
            throw new NotFoundException(__('Invalid Builder'));
        }

        $builder = $this->Builder->findById($id);


        if (!$builder) {
            throw new NotFoundException(__('Invalid builder'));
        }


        $this->request->data = $builder;
    }

}


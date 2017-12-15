<?php

/**
 * Owners controller.
 *
 * This file will render views from views/owners/
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
 * Owner controller
 *
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class OwnersController extends AppController {

    public $uses = array('Owner','Area', 'Suburb', 'City', 'LookupBuilderAgreementLevel', 'LookupBuilderAgreementProposed', 'LookupBuilderAgreementManagedBy', 'LookupBuilderAgreementIntiatedBy', 'LookupBuilderAgreementPreparedBy', 'LookupBuilderAgreementCommissionBasedOn', 'LookupBuilderAgreementCommissionTerm', 'LookupValueLeadsCountry', 'BuilderAgreement', 'BuilderContact', 'LookupBuilderContactStatus', 'ActionItem', 'Project', 'ProjectAgreement', 'Channel', 'User', 'LookupBuilderContactLevel', 'LookupBuilderContactInitiatedBy', 'LookupBuilderContactManagedBy', 'LookupBuilderContactPreparedBy', 'LookupBuilderAgreementStatuse', 'ActionItem', 'BuilderLegalName', 'LookupBuilderAgreementDoneWith', 'MarketingPartner', 'LookupCompany', 'Remark');
    public $components = array('Sms');

    public function index() {

        $dummy_status = $this->Auth->user('dummy_status');
        $city_id = $this->Auth->user('city_id');
        $role_id = $this->Session->read("role_id");
        $owner_name = '';
        $owner_primarycity = '';
        $owner_commercial = '';
        $owner_highendresidential = '';
        $owner_residential = '';
        $search_condition = array();
        $channel_id = $this->Session->read("channel_id");
        $channel_id = $this->Channel->findById($channel_id);
        $channel_city_id = $channel_id['Channel']['city_id'];

        if ($this->request->is('post') || $this->request->is('put')) {
            if (!empty($this->data['Owner']['owner_name'])) {
                $owner_name = $this->data['Owner']['owner_name'];
                array_push($search_condition, array('Owner.owner_name' . ' LIKE' => "%" . mysql_escape_string(trim(strip_tags($owner_name))) . "%"));
            }
            if (!empty($this->data['Owner']['owner_highendresidential'])) {
                $owner_highendresidential = $this->data['Owner']['owner_highendresidential'];
                array_push($search_condition, array('Owner.owner_highendresidential' => $owner_highendresidential));
            }

            if (!empty($this->data['Owner']['owner_primarycity'])) {
                $owner_primarycity = $this->data['Owner']['owner_primarycity'];
                array_push($search_condition, array('Owner.owner_primarycity' => $owner_primarycity));
            }
            if (!empty($this->data['Owner']['owner_residential'])) {
                $owner_residential = $this->data['Owner']['owner_residential'];
                array_push($search_condition, array('Owner.owner_residential' => $owner_residential));
            }
            if (!empty($this->data['Owner']['owner_commercial'])) {
                $owner_commercial = $this->data['Owner']['owner_commercial'];
                array_push($search_condition, array('Owner.owner_commercial' => $owner_commercial));
            }
        } elseif ($this->request->is('get')) {

            if (!empty($this->request->params['named']['owner_name'])) {
                $owner_name = $this->request->params['named']['owner_name'];
                array_push($search_condition, array("Owner.owner_name LIKE '%$owner_name%'"));
            }

            if (!empty($this->request->params['named']['owner_primarycity'])) {
                $owner_primarycity = $this->request->params['named']['owner_primarycity'];
                array_push($search_condition, array('Owner.owner_primarycity' => $owner_primarycity));
            }

            if (!empty($this->request->params['named']['owner_highendresidential'])) {
                $owner_highendresidential = $this->request->params['named']['owner_highendresidential'];
                array_push($search_condition, array('Owner.owner_highendresidential' => $owner_highendresidential));
            }

            if (!empty($this->request->params['named']['owner_residential'])) {
                $owner_residential = $this->request->params['named']['owner_residential'];
                array_push($search_condition, array('Owner.owner_residential' => $owner_residential));
            }

            if (!empty($this->request->params['named']['owner_commercial'])) {
                $owner_commercial = $this->request->params['named']['owner_commercial'];
                array_push($search_condition, array('Owner.owner_commercial' => $owner_commercial));
            }
        }
        if ($role_id == '15') { // Accounts User.
            if ($channel_city_id == 2) {
                array_push($search_condition, array('OR' => array('Owner.owner_primarycity' => $channel_city_id, 'Owner.owner_secondarycity' => $channel_city_id, 'Owner.owner_tertiarycity' => $channel_city_id, 'Owner.city_4' => $city_id, 'Owner.city_5' => $channel_city_id)));
            } else {
                array_push($search_condition, array('NOT' => array('Owner.owner_primarycity' => 2, 'Owner.owner_secondarycity' => 2, 'Owner.owner_tertiarycity' => 2, 'Owner.city_4' => 2, 'Owner.city_5' => 2)));
            }
        } else {
            if ($channel_city_id > 1) {
                array_push($search_condition, array('OR' => array('Owner.owner_primarycity' => $channel_city_id, 'Owner.owner_secondarycity' => $channel_city_id, 'Owner.owner_tertiarycity' => $channel_city_id, 'Owner.city_4' => $city_id, 'Owner.city_5' => $channel_city_id)));
            }
        }



        if ($dummy_status) {
            array_push($search_condition, array('Owner.dummy_status' => $dummy_status, 'Owner.owner_status' => '1'));
        }
        if (count($this->params['pass'])) {

            $aaray = explode(':', $this->params['pass'][0]);
            $field = $aaray[0];
            $value = $aaray[1];
            array_push($search_condition, array('Owner.' . $field => $value)); // when owner is approve/pending
        }


        $this->paginate['order'] = array('Owner.owner_approved' => 'asc');

        $this->set('owners', $this->paginate("Owner", $search_condition));

        //$log = $this->Owner->getDataSource()->getLog(false, false);       
        //debug($log);
        //die;


        if ($role_id == '15') { // Accounts User.
            if ($channel_city_id == '2') {

                $all_count = $this->Owner->find('count', array('conditions' => array('OR' => array(
                            'Owner.owner_primarycity' => $channel_city_id,
                            'Owner.owner_secondarycity' => $channel_city_id,
                            'Owner.owner_tertiarycity' => $channel_city_id,
                            'Owner.city_4' => $channel_city_id,
                            'Owner.city_5' => $channel_city_id,
                        ), 'Owner.dummy_status' => $dummy_status)));

                $approve = $this->Owner->find('count', array('conditions' => array('OR' => array(
                            'Owner.owner_primarycity' => $channel_city_id,
                            'Owner.owner_secondarycity' => $channel_city_id,
                            'Owner.owner_tertiarycity' => $channel_city_id,
                            'Owner.city_4' => $channel_city_id,
                            'Owner.city_5' => $channel_city_id,
                        ), 'Owner.owner_approved' => '1', 'Owner.dummy_status' => $dummy_status)));

                $pending = $this->Owner->find('count', array('conditions' => array('OR' => array(
                            'Owner.owner_primarycity' => $channel_city_id,
                            'Owner.owner_secondarycity' => $channel_city_id,
                            'Owner.owner_tertiarycity' => $channel_city_id,
                            'Owner.city_4' => $channel_city_id,
                            'Owner.city_5' => $channel_city_id,
                        ), 'Owner.owner_approved' => '2', 'Owner.dummy_status' => $dummy_status)));
                $residential_all_count = $this->Owner->find('count', array('conditions' => array('OR' => array(
                            'Owner.owner_primarycity' => $channel_city_id,
                            'Owner.owner_secondarycity' => $channel_city_id,
                            'Owner.owner_tertiarycity' => $channel_city_id,
                            'Owner.city_4' => $channel_city_id,
                            'Owner.city_5' => $channel_city_id,
                        ), 'Owner.dummy_status' => $dummy_status, 'Owner.owner_residential <> ""')));

                $residential_yes = $this->Owner->find('count', array('conditions' => array('OR' => array(
                            'Owner.owner_primarycity' => $channel_city_id,
                            'Owner.owner_secondarycity' => $channel_city_id,
                            'Owner.owner_tertiarycity' => $channel_city_id,
                            'Owner.city_4' => $channel_city_id,
                            'Owner.city_5' => $channel_city_id,
                        ), 'Owner.owner_residential' => '1', 'Owner.dummy_status' => $dummy_status)));

                $residential_no = $this->Owner->find('count', array('conditions' => array('OR' => array(
                            'Owner.owner_primarycity' => $channel_city_id,
                            'Owner.owner_secondarycity' => $channel_city_id,
                            'Owner.owner_tertiarycity' => $channel_city_id,
                            'Owner.city_4' => $channel_city_id,
                            'Owner.city_5' => $channel_city_id,
                        ), 'Owner.owner_residential' => '2', 'Owner.dummy_status' => $dummy_status)));

                $commercial_all_count = $this->Owner->find('count', array('conditions' => array('OR' => array(
                            'Owner.owner_primarycity' => $channel_city_id,
                            'Owner.owner_secondarycity' => $channel_city_id,
                            'Owner.owner_tertiarycity' => $channel_city_id,
                            'Owner.city_4' => $channel_city_id,
                            'Owner.city_5' => $channel_city_id,
                        ), 'Owner.dummy_status' => $dummy_status, 'Owner.owner_commercial <> ""')));

                $commercial_yes = $this->Owner->find('count', array('conditions' => array('OR' => array(
                            'Owner.owner_primarycity' => $channel_city_id,
                            'Owner.owner_secondarycity' => $channel_city_id,
                            'Owner.owner_tertiarycity' => $channel_city_id,
                            'Owner.city_4' => $channel_city_id,
                            'Owner.city_5' => $channel_city_id,
                        ), 'Owner.owner_commercial' => '1', 'Owner.dummy_status' => $dummy_status)));

                $commercial_no = $this->Owner->find('count', array('conditions' => array('OR' => array(
                            'Owner.owner_primarycity' => $channel_city_id,
                            'Owner.owner_secondarycity' => $channel_city_id,
                            'Owner.owner_tertiarycity' => $channel_city_id,
                            'Owner.city_4' => $channel_city_id,
                            'Owner.city_5' => $channel_city_id,
                        ), 'Owner.owner_commercial' => '2', 'Owner.dummy_status' => $dummy_status)));

                $highend_all_count = $this->Owner->find('count', array('conditions' => array('OR' => array(
                            'Owner.owner_primarycity' => $channel_city_id,
                            'Owner.owner_secondarycity' => $channel_city_id,
                            'Owner.owner_tertiarycity' => $channel_city_id,
                            'Owner.city_4' => $channel_city_id,
                            'Owner.city_5' => $channel_city_id,
                        ), 'Owner.dummy_status' => $dummy_status, 'Owner.owner_highendresidential <> ""')));

                $highend_yes = $this->Owner->find('count', array('conditions' => array('OR' => array(
                            'Owner.owner_primarycity' => $channel_city_id,
                            'Owner.owner_secondarycity' => $channel_city_id,
                            'Owner.owner_tertiarycity' => $channel_city_id,
                            'Owner.city_4' => $channel_city_id,
                            'Owner.city_5' => $channel_city_id,
                        ), 'Owner.owner_highendresidential' => '1', 'Owner.dummy_status' => $dummy_status)));

                $highend_no = $this->Owner->find('count', array('conditions' => array('OR' => array(
                            'Owner.owner_primarycity' => $channel_city_id,
                            'Owner.owner_secondarycity' => $channel_city_id,
                            'Owner.owner_tertiarycity' => $channel_city_id,
                            'Owner.city_4' => $channel_city_id,
                            'Owner.city_5' => $channel_city_id,
                        ), 'Owner.owner_highendresidential' => '2', 'Owner.dummy_status' => $dummy_status)));
            } else {

                $all_count = $this->Owner->find('count', array('conditions' => array('NOT' => array(
                            'Owner.owner_primarycity' => 2,
                            'Owner.owner_secondarycity' => 2,
                            'Owner.owner_tertiarycity' => 2,
                            'Owner.city_4' => 2,
                            'Owner.city_5' => 2,
                        ), 'Owner.dummy_status' => $dummy_status)));

                $approve = $this->Owner->find('count', array('conditions' => array('NOT' => array(
                            'Owner.owner_primarycity' => 2,
                            'Owner.owner_secondarycity' => 2,
                            'Owner.owner_tertiarycity' => 2,
                            'Owner.city_4' => 2,
                            'Owner.city_5' => 2,
                        ), 'Owner.owner_approved' => '1', 'Owner.dummy_status' => $dummy_status)));

                $pending = $this->Owner->find('count', array('conditions' => array('NOT' => array(
                            'Owner.owner_primarycity' => 2,
                            'Owner.owner_secondarycity' => 2,
                            'Owner.owner_tertiarycity' => 2,
                            'Owner.city_4' => 2,
                            'Owner.city_5' => 2,
                        ), 'Owner.owner_approved' => '2', 'Owner.dummy_status' => $dummy_status)));
                $residential_all_count = $this->Owner->find('count', array('conditions' => array('NOT' => array(
                            'Owner.owner_primarycity' => 2,
                            'Owner.owner_secondarycity' => 2,
                            'Owner.owner_tertiarycity' => 2,
                            'Owner.city_4' => 2,
                            'Owner.city_5' => 2,
                        ), 'Owner.dummy_status' => $dummy_status, 'Owner.owner_residential <> ""')));

                $residential_yes = $this->Owner->find('count', array('conditions' => array('NOT' => array(
                            'Owner.owner_primarycity' => 2,
                            'Owner.owner_secondarycity' => 2,
                            'Owner.owner_tertiarycity' => 2,
                            'Owner.city_4' => 2,
                            'Owner.city_5' => 2,
                        ), 'Owner.owner_residential' => '1', 'Owner.dummy_status' => $dummy_status)));

                $residential_no = $this->Owner->find('count', array('conditions' => array('NOT' => array(
                            'Owner.owner_primarycity' => 2,
                            'Owner.owner_secondarycity' => 2,
                            'Owner.owner_tertiarycity' => 2,
                            'Owner.city_4' => 2,
                            'Owner.city_5' => 2,
                        ), 'Owner.owner_residential' => '2', 'Owner.dummy_status' => $dummy_status)));

                $commercial_all_count = $this->Owner->find('count', array('conditions' => array('NOT' => array(
                            'Owner.owner_primarycity' => 2,
                            'Owner.owner_secondarycity' => 2,
                            'Owner.owner_tertiarycity' => 2,
                            'Owner.city_4' => 2,
                            'Owner.city_5' => 2,
                        ), 'Owner.dummy_status' => $dummy_status, 'Owner.owner_commercial <> ""')));

                $commercial_yes = $this->Owner->find('count', array('conditions' => array('NOT' => array(
                            'Owner.owner_primarycity' => 2,
                            'Owner.owner_secondarycity' => 2,
                            'Owner.owner_tertiarycity' => 2,
                            'Owner.city_4' => 2,
                            'Owner.city_5' => 2,
                        ), 'Owner.owner_commercial' => '1', 'Owner.dummy_status' => $dummy_status)));

                $commercial_no = $this->Owner->find('count', array('conditions' => array('NOT' => array(
                            'Owner.owner_primarycity' => 2,
                            'Owner.owner_secondarycity' => 2,
                            'Owner.owner_tertiarycity' => 2,
                            'Owner.city_4' => 2,
                            'Owner.city_5' => 2,
                        ), 'Owner.owner_commercial' => '2', 'Owner.dummy_status' => $dummy_status)));

                $highend_all_count = $this->Owner->find('count', array('conditions' => array('NOT' => array(
                            'Owner.owner_primarycity' => 2,
                            'Owner.owner_secondarycity' => 2,
                            'Owner.owner_tertiarycity' => 2,
                            'Owner.city_4' => 2,
                            'Owner.city_5' => 2,
                        ), 'Owner.dummy_status' => $dummy_status, 'Owner.owner_highendresidential <> ""')));

                $highend_yes = $this->Owner->find('count', array('conditions' => array('NOT' => array(
                            'Owner.owner_primarycity' => 2,
                            'Owner.owner_secondarycity' => 2,
                            'Owner.owner_tertiarycity' => 2,
                            'Owner.city_4' => 2,
                            'Owner.city_5' => 2,
                        ), 'Owner.owner_highendresidential' => '1', 'Owner.dummy_status' => $dummy_status)));

                $highend_no = $this->Owner->find('count', array('conditions' => array('NOT' => array(
                            'Owner.owner_primarycity' => 2,
                            'Owner.owner_secondarycity' => 2,
                            'Owner.owner_tertiarycity' => 2,
                            'Owner.city_4' => 2,
                            'Owner.city_5' => 2,
                        ), 'Owner.owner_highendresidential' => '2', 'Owner.dummy_status' => $dummy_status)));
            }
        } else {

            if ($channel_city_id == '1') {

                $all_count = $this->Owner->find('count', array('conditions' => array('Owner.dummy_status' => $dummy_status)));
                $approve = $this->Owner->find('count', array('conditions' => array('Owner.owner_approved' => '1', 'Owner.dummy_status' => $dummy_status)));
                $pending = $this->Owner->find('count', array('conditions' => array('Owner.owner_approved' => '2', 'Owner.dummy_status' => $dummy_status)));
                $residential_all_count = $this->Owner->find('count', array('conditions' => array('Owner.dummy_status' => $dummy_status, 'Owner.owner_residential <> ""')));
                $residential_yes = $this->Owner->find('count', array('conditions' => array('Owner.owner_residential' => '1', 'Owner.dummy_status' => $dummy_status)));
                $residential_no = $this->Owner->find('count', array('conditions' => array('Owner.owner_residential' => '2', 'Owner.dummy_status' => $dummy_status)));
                $commercial_all_count = $this->Owner->find('count', array('conditions' => array('Owner.dummy_status' => $dummy_status, 'Owner.owner_commercial <> ""')));
                $commercial_yes = $this->Owner->find('count', array('conditions' => array('Owner.owner_commercial' => '1', 'Owner.dummy_status' => $dummy_status)));
                $commercial_no = $this->Owner->find('count', array('conditions' => array('Owner.owner_commercial' => '2', 'Owner.dummy_status' => $dummy_status)));
                $highend_all_count = $this->Owner->find('count', array('conditions' => array('Owner.dummy_status' => $dummy_status, 'Owner.owner_highendresidential <> ""')));
                $highend_yes = $this->Owner->find('count', array('conditions' => array('Owner.owner_highendresidential' => '1', 'Owner.dummy_status' => $dummy_status)));
                $highend_no = $this->Owner->find('count', array('conditions' => array('Owner.owner_highendresidential' => '2', 'Owner.dummy_status' => $dummy_status)));
            } else {

                $all_count = $this->Owner->find('count', array('conditions' => array('OR' => array(
                            'Owner.owner_primarycity' => $channel_city_id,
                            'Owner.owner_secondarycity' => $channel_city_id,
                            'Owner.owner_tertiarycity' => $channel_city_id,
                            'Owner.city_4' => $channel_city_id,
                            'Owner.city_5' => $channel_city_id,
                        ), 'Owner.dummy_status' => $dummy_status)));

                $approve = $this->Owner->find('count', array('conditions' => array('OR' => array(
                            'Owner.owner_primarycity' => $channel_city_id,
                            'Owner.owner_secondarycity' => $channel_city_id,
                            'Owner.owner_tertiarycity' => $channel_city_id,
                            'Owner.city_4' => $channel_city_id,
                            'Owner.city_5' => $channel_city_id,
                        ), 'Owner.owner_approved' => '1', 'Owner.dummy_status' => $dummy_status)));

                $pending = $this->Owner->find('count', array('conditions' => array('OR' => array(
                            'Owner.owner_primarycity' => $channel_city_id,
                            'Owner.owner_secondarycity' => $channel_city_id,
                            'Owner.owner_tertiarycity' => $channel_city_id,
                            'Owner.city_4' => $channel_city_id,
                            'Owner.city_5' => $channel_city_id,
                        ), 'Owner.owner_approved' => '2', 'Owner.dummy_status' => $dummy_status)));
                $residential_all_count = $this->Owner->find('count', array('conditions' => array('OR' => array(
                            'Owner.owner_primarycity' => $channel_city_id,
                            'Owner.owner_secondarycity' => $channel_city_id,
                            'Owner.owner_tertiarycity' => $channel_city_id,
                            'Owner.city_4' => $channel_city_id,
                            'Owner.city_5' => $channel_city_id,
                        ), 'Owner.dummy_status' => $dummy_status, 'Owner.owner_residential <> ""')));

                $residential_yes = $this->Owner->find('count', array('conditions' => array('OR' => array(
                            'Owner.owner_primarycity' => $channel_city_id,
                            'Owner.owner_secondarycity' => $channel_city_id,
                            'Owner.owner_tertiarycity' => $channel_city_id,
                            'Owner.city_4' => $channel_city_id,
                            'Owner.city_5' => $channel_city_id,
                        ), 'Owner.owner_residential' => '1', 'Owner.dummy_status' => $dummy_status)));

                $residential_no = $this->Owner->find('count', array('conditions' => array('OR' => array(
                            'Owner.owner_primarycity' => $channel_city_id,
                            'Owner.owner_secondarycity' => $channel_city_id,
                            'Owner.owner_tertiarycity' => $channel_city_id,
                            'Owner.city_4' => $channel_city_id,
                            'Owner.city_5' => $channel_city_id,
                        ), 'Owner.owner_residential' => '2', 'Owner.dummy_status' => $dummy_status)));

                $commercial_all_count = $this->Owner->find('count', array('conditions' => array('OR' => array(
                            'Owner.owner_primarycity' => $channel_city_id,
                            'Owner.owner_secondarycity' => $channel_city_id,
                            'Owner.owner_tertiarycity' => $channel_city_id,
                            'Owner.city_4' => $channel_city_id,
                            'Owner.city_5' => $channel_city_id,
                        ), 'Owner.dummy_status' => $dummy_status, 'Owner.owner_commercial <> ""')));

                $commercial_yes = $this->Owner->find('count', array('conditions' => array('OR' => array(
                            'Owner.owner_primarycity' => $channel_city_id,
                            'Owner.owner_secondarycity' => $channel_city_id,
                            'Owner.owner_tertiarycity' => $channel_city_id,
                            'Owner.city_4' => $channel_city_id,
                            'Owner.city_5' => $channel_city_id,
                        ), 'Owner.owner_commercial' => '1', 'Owner.dummy_status' => $dummy_status)));

                $commercial_no = $this->Owner->find('count', array('conditions' => array('OR' => array(
                            'Owner.owner_primarycity' => $channel_city_id,
                            'Owner.owner_secondarycity' => $channel_city_id,
                            'Owner.owner_tertiarycity' => $channel_city_id,
                            'Owner.city_4' => $channel_city_id,
                            'Owner.city_5' => $channel_city_id,
                        ), 'Owner.owner_commercial' => '2', 'Owner.dummy_status' => $dummy_status)));

                $highend_all_count = $this->Owner->find('count', array('conditions' => array('OR' => array(
                            'Owner.owner_primarycity' => $channel_city_id,
                            'Owner.owner_secondarycity' => $channel_city_id,
                            'Owner.owner_tertiarycity' => $channel_city_id,
                            'Owner.city_4' => $channel_city_id,
                            'Owner.city_5' => $channel_city_id,
                        ), 'Owner.dummy_status' => $dummy_status, 'Owner.owner_highendresidential <> ""')));

                $highend_yes = $this->Owner->find('count', array('conditions' => array('OR' => array(
                            'Owner.owner_primarycity' => $channel_city_id,
                            'Owner.owner_secondarycity' => $channel_city_id,
                            'Owner.owner_tertiarycity' => $channel_city_id,
                            'Owner.city_4' => $channel_city_id,
                            'Owner.city_5' => $channel_city_id,
                        ), 'Owner.owner_highendresidential' => '1', 'Owner.dummy_status' => $dummy_status)));

                $highend_no = $this->Owner->find('count', array('conditions' => array('OR' => array(
                            'Owner.owner_primarycity' => $channel_city_id,
                            'Owner.owner_secondarycity' => $channel_city_id,
                            'Owner.owner_tertiarycity' => $channel_city_id,
                            'Owner.city_4' => $channel_city_id,
                            'Owner.city_5' => $channel_city_id,
                        ), 'Owner.owner_highendresidential' => '2', 'Owner.dummy_status' => $dummy_status)));
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

        $multicity_count = $this->Owner->find('count', array(
            'conditions' => array('OR' => array(
                    'Owner.owner_primarycity' => $channel_city_id,
                    'Owner.owner_secondarycity' => $channel_city_id,
                    'Owner.owner_tertiarycity' => $channel_city_id,
                    'Owner.city_4' => $channel_city_id,
                    'Owner.city_5' => $channel_city_id,
                ),
                'Owner.owner_approved' => '1',
                'Owner.dummy_status' => $dummy_status,
            ),
        ));
        $this->set(compact('multicity_count'));

        $owner = $this->Owner->find('list', array('fields' => 'Owner.id, Owner.owner_name', 'order' => 'Owner.owner_name ASC'));
        $this->set('owner', $owner);





        $city = $this->City->find('list', array('fields' => 'City.id, City.city_name', 'conditions' => array('City.dummy_status' => $dummy_status, 'City.city_status' => '1'), 'order' => 'City.city_name ASC'));
        $this->set('city', $city);

        $codes = $this->LookupValueLeadsCountry->find('all', array('fields' => array('LookupValueLeadsCountry.id', 'LookupValueLeadsCountry.value', 'LookupValueLeadsCountry.code')));
        $codes = Set::combine($codes, '{n}.LookupValueLeadsCountry.id', array('%s:', '{n}.LookupValueLeadsCountry.code'));
        $this->set(compact('codes'));

        if (!isset($this->passedArgs['owner_primarycity']) && empty($this->passedArgs['owner_primarycity'])) {
            $this->passedArgs['owner_primarycity'] = (isset($this->data['Owner']['owner_primarycity'])) ? $this->data['Owner']['owner_primarycity'] : '';
        }
        if (!isset($this->passedArgs['owner_name']) && empty($this->passedArgs['owner_name'])) {
            $this->passedArgs['owner_name'] = (isset($this->data['Owner']['owner_name'])) ? $this->data['Owner']['owner_name'] : '';
        }
        if (!isset($this->passedArgs['owner_residential']) && empty($this->passedArgs['owner_residential'])) {
            $this->passedArgs['owner_residential'] = (isset($this->data['Owner']['owner_residential'])) ? $this->data['Owner']['owner_residential'] : '';
        }
        if (!isset($this->passedArgs['owner_commercial']) && empty($this->passedArgs['owner_commercial'])) {
            $this->passedArgs['owner_commercial'] = (isset($this->data['Owner']['owner_commercial'])) ? $this->data['Owner']['owner_commercial'] : '';
        }
        if (!isset($this->passedArgs['owner_highendresidential']) && empty($this->passedArgs['owner_highendresidential'])) {
            $this->passedArgs['owner_highendresidential'] = (isset($this->data['Owner']['owner_highendresidential'])) ? $this->data['Owner']['owner_highendresidential'] : '';
        }
        if (!isset($this->data) && empty($this->data)) {
            $this->data['Owner']['owner_primarycity'] = $this->passedArgs['owner_primarycity'];
            $this->data['Owner']['owner_name'] = $this->passedArgs['owner_name'];
            $this->data['Owner']['owner_residential'] = $this->passedArgs['owner_residential'];
            $this->data['Owner']['owner_commercial'] = $this->passedArgs['owner_commercial'];
            $this->data['Owner']['owner_highendresidential'] = $this->passedArgs['owner_highendresidential'];
        }

        $this->set(compact('owner_primarycity'));
        $this->set(compact('owner_name'));
        $this->set(compact('owner_residential'));
        $this->set(compact('owner_commercial'));
        $this->set(compact('owner_highendresidential'));
    }

    public function add() {

        $user_id = $this->Auth->user('id');
        $role_id = $this->Session->read("role_id");
        $dummy_status = $this->Auth->user('dummy_status');
        $condition_dummy_status = array('dummy_status =' . $dummy_status, 'id != 1');



        if ($this->request->is('post')) {


            $this->request->data['Owner']['dummy_status'] = $dummy_status;
            $this->request->data['Owner']['owner_approved'] = '2';
            $this->request->data['Owner']['owner_status'] = '1';  // 1 for Yes of lookup_value_statuses
            $this->request->data['Owner']['created_by'] = $user_id;
            if ($this->data['Owner']['owner_boardnumber'] == '')
                $this->request->data['Owner']['owner_boardnumber_code'] = '';


            $this->Owner->create();
            if ($this->Owner->save($this->request->data['Owner'])) {

                $owner_id = $this->Owner->getLastInsertId();
                if ($owner_id) {

                    /**********************Owner Remarks ******************************** */
                    $remarks['Remark']['owner_id'] = $owner_id;
                    $remarks['Remark']['remarks'] = 'New Owner Record Created';
                    $remarks['Remark']['remarks_by'] = $user_id;
                    $remarks['Remark']['created_by'] = $user_id;
                    $remarks['Remark']['remarks_time'] = date('g:i A');
                    $remarks['Remark']['remarks_level'] = '11'; //11 for owner from lookup_value_remarks_level
                    $remarks['Remark']['dummy_status'] = $dummy_status;
                    $this->Remark->save($remarks);



                    /*                     * ************************Next Action By logic********************** */

                    $action_user_id = '';
                    $oversing_user = array();

                    $oversing_channel = $this->Channel->find('first', array('conditions' => array('Channel.city_id' => $this->data['Owner']['owner_primarycity'], 'Channel.dummy_status' => $dummy_status), 'fields' => 'id'));

                    if (!empty($oversing_channel))
                        $oversing_user = $this->User->find('first', array('conditions' => array('User.overse_channel_id' => $oversing_channel['Channel']['id'], 'User.overse_role_id' => 10, 'User.dummy_status' => $dummy_status), 'fields' => 'id')); // 10 for Overseer of roles table.

                    if (count($oversing_user))
                        $action_user_id = $oversing_user['User']['id'];

                    /*                     * ************************Owner Action ********************** */
                    $action_item['ActionItem']['owner_id'] = $owner_id;
                    $action_item['ActionItem']['action_item_level_id'] = '16'; //  for Owner 
                    $action_item['ActionItem']['type_id'] = '7'; // 7 for Submission For Approval
                    $action_item['ActionItem']['action_industry'] = '1'; // for realestate of lookup_value_activity_industry
                    $action_item['ActionItem']['action_item_active'] = 'Yes';
                    $action_item['ActionItem']['action_item_status'] = '7'; //7 for Submitted For Approval table - lookup_value_action_item_statuses
                    $action_item['ActionItem']['description'] = 'New Owner Record Created - Submission For Approval';
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
                      'Owner' => $this->data['Owner']['owner_name'],
                      'Address' => $this->data['Owner']['owner_corporateaddress'],
                      'Board_no' => $this->data['Owner']['owner_boardnumber'],
                      'Board_email' => $this->data['Owner']['owner_boardemail'],
                      'Status' => 'Submission For Approval',

                      ));
                      $Email->template('owner_template', 'default')->emailFormat('html')->to($to)->from('admin@silkrouters.com')->subject('Silkrouters - Submission for Owner')->send();
                     */
                    /* End Emial */
                    /* Phone API */
                    /*
                      $msg = $this->data['Owner']['owner_name'].' | '.$this->data['Owner']['owner_corporateaddress'].' | '.$this->data['Owner']['owner_boardnumber'].' | '.$this->data['Owner']['owner_boardemail'].' | Submission For Approval';
                      $authKey = Configure::read('sms_api_key');
                      $senderId = Configure::read('sms_sender_id');
                      // $mobileNumber = $channels[0]['User']['primary_mobile_number'];
                      $mobileNumber = "9833156460";
                      $message = urlencode($msg);
                      $route = "default";
                      $this->Sms->send_sms($authKey,$mobileNumber,$message,$senderId,$route);
                     */
                    /* End Phone */


                    $this->Session->setFlash('Owner has been saved.', 'success');
                    $this->redirect(array('controller' => 'messages', 'action' => 'index', 'owners', 'my-owners'));
                }
            } else {
                $this->Session->setFlash('Unable to add owner.', 'failure');
            }
        }

        $city = $this->City->find('list', array('fields' => 'City.id, City.city_name', 'conditions' => array('City.dummy_status' => $dummy_status, 'City.city_status' => '1'), 'order' => 'City.city_name ASC'));
        $this->set('city', $city);

        $codes = $this->LookupValueLeadsCountry->find('all', array('fields' => array('LookupValueLeadsCountry.id', 'LookupValueLeadsCountry.value', 'LookupValueLeadsCountry.code')));
        $codes = Set::combine($codes, '{n}.LookupValueLeadsCountry.id', array('%s: %s', '{n}.LookupValueLeadsCountry.value', '{n}.LookupValueLeadsCountry.code'));
        $this->set(compact('codes'));

        $contact_level = $this->LookupBuilderContactLevel->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('contact_level'));

        $for_company = $this->LookupCompany->find('list', array('fields' => 'id, value', 'conditions' => array('id' => array('1', '2')), 'order' => 'value ASC'));
        $this->set(compact('for_company'));

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
            throw new NotFoundException(__('Invalid Owner'));
        }

        $owner = $this->Owner->findById($id);


        if (!$owner) {
            throw new NotFoundException(__('Invalid owner'));
        }

        if ($this->request->data) {

            /*             * *************************Next Action By logic********************** */

            $action_user_id = '';
            $oversing_user = array();
            /*
              $oversing_channel = $this->Channel->find('first',array('conditions' => array('Channel.city_id'=> $this->data['OwnerContact']['owner_contact_company_city'],'Channel.dummy_status' => $dummy_status),'fields' => 'id'));

              if(!empty($oversing_channel))
              $oversing_user = $this->User->find('first',array('conditions' => array('User.overse_channel_id'=> $oversing_channel['Channel']['id'],'User.overse_role_id' => 10,'User.dummy_status' => $dummy_status),'fields' => 'id')); // 10 for Overseer of roles table.

              if(count($oversing_user))
              $action_user_id = $oversing_user['User']['id'];
             */

            //$this->request->data['Owner']['owner_approved'] = '2';

            /*             * ************************Owner Action ********************** */
            $action_item['ActionItem']['owner_id'] = $id;
            $action_item['ActionItem']['action_item_level_id'] = '16'; //  for Owner
            $action_item['ActionItem']['type_id'] = '10'; // 10 for Re-Submission For Approval
            $action_item['ActionItem']['next_action_by'] = '148';
            $action_item['ActionItem']['action_item_active'] = 'Yes';
            $action_item['ActionItem']['action_item_status'] = '17'; //1 for created table - lookup_value_action_item_statuses
            $action_item['ActionItem']['description'] = 'Owner Record Updated - Re-Submission For Approval';
            $action_item['ActionItem']['action_item_source'] = $role_id;
            $action_item['ActionItem']['created_by_id'] = $user_id;
            $action_item['ActionItem']['created_by'] = $user_id;
            $action_item['ActionItem']['dummy_status'] = $dummy_status;
            $action_item['ActionItem']['parent_action_item_id'] = $actio_itme_id;
            $action_item['ActionItem']['action_industry'] = '1'; // for realestate of lookup_value_activity_industry


            /*             * ********************Owner Remarks ******************************** */
            $remarks['Remark']['owner_id'] = $id;
            $remarks['Remark']['remarks'] = 'Edit Owner Record';
            $remarks['Remark']['remarks_by'] = $user_id;
            $remarks['Remark']['created_by'] = $user_id;
            $remarks['Remark']['remarks_time'] = date('g:i A');
            $remarks['Remark']['remarks_level'] = '11'; //11 for owner from lookup_value_remarks_level
            $remarks['Remark']['dummy_status'] = $dummy_status;
            $this->Remark->save($remarks);

            if ($this->data['Owner']['action_type'] == '0') {

                $this->request->data['Owner']['owner_active_primary'] = '1';
                $action_item['ActionItem']['screen_no'] = 'SC-1';
                $this->Owner->id = $id;
                if ($this->Owner->save($this->request->data['Owner'])) {

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

                    $this->Session->setFlash('Owner has been updated.', 'success');
                    //$this->redirect(array('controller' => 'messages','action' => 'index','owner','my-owners'));
                }
            } else if ($this->data['Owner']['action_type'] == '1') {
                $action_item['ActionItem']['screen_no'] = 'SC-2';
                $this->request->data['Owner']['owner_active_operation'] = '1';
                $this->Owner->id = $id;
                if ($this->Owner->save($this->request->data['Owner'])) {
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
                    //	$this->redirect(array('controller' => 'messages','action' => 'index','owner','my-owners'));
                }
            }else if ($this->data['Owner']['action_type'] == '2') {
                $action_item['ActionItem']['screen_no'] = 'SC-3';
                $this->request->data['Owner']['owner_active_contact'] = '1';
                $this->Owner->id = $id;
                if ($this->Owner->save($this->request->data['Owner'])) {
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
                    //	$this->redirect(array('controller' => 'messages','action' => 'index','owner','my-owners'));
                }
            }




            //$this->Session->setFlash('Owner contact has been updated.', 'success');
            //$this->redirect(array('controller' => 'messages','action' => 'index','owner','my-owners'));	


            $this->set('action_type', $this->data['Owner']['action_type']);

            if ($flag == 1)
                $this->redirect(array('controller' => 'action-items', 'action' => 'index'));
        }


        $city = $this->City->find('list', array('fields' => 'City.id, City.city_name', 'conditions' => array('City.dummy_status' => $dummy_status, 'City.city_status' => '1'), 'order' => 'City.city_name ASC'));
        $this->set('city', $city);

        $for_company = $this->LookupCompany->find('list', array('fields' => 'id, value', 'conditions' => array('id' => array('1', '2')), 'order' => 'value ASC'));
        $this->set(compact('for_company'));


        $codes = $this->LookupValueLeadsCountry->find('all', array('fields' => array('LookupValueLeadsCountry.id', 'LookupValueLeadsCountry.value', 'LookupValueLeadsCountry.code')));
        $codes = Set::combine($codes, '{n}.LookupValueLeadsCountry.id', array('%s: %s', '{n}.LookupValueLeadsCountry.value', '{n}.LookupValueLeadsCountry.code'));
        $this->set(compact('codes'));

        $contact_level = $this->LookupBuilderContactLevel->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('contact_level'));

        $this->request->data = $owner;
    }

    

    function view($id = null) {

        $arr = explode('_', $id);
        $id = base64_decode($arr[0]);


        if (!$id) {
            throw new NotFoundException(__('Invalid Owner'));
        }

        $owner = $this->Owner->findById($id);


        if (!$owner) {
            throw new NotFoundException(__('Invalid owner'));
        }


        $this->request->data = $owner;
    }

}


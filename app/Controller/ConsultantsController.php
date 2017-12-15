<?php

/**
 * Consultants controller.
 *
 * This file will render views from views/consultants/
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
 * consultants controller
 *
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class ConsultantsController extends AppController {

    public $uses = array('Consultant', 'Area', 'Suburb', 'City', 'LookupBuilderAgreementLevel', 'LookupBuilderAgreementProposed', 'LookupBuilderAgreementManagedBy', 'LookupBuilderAgreementIntiatedBy', 'LookupBuilderAgreementPreparedBy', 'LookupBuilderAgreementCommissionBasedOn', 'LookupBuilderAgreementCommissionTerm', 'LookupValueLeadsCountry', 'BuilderAgreement', 'BuilderContact', 'LookupBuilderContactStatus', 'ActionItem', 'Project', 'ProjectAgreement', 'Channel', 'User', 'LookupBuilderContactLevel', 'LookupBuilderContactInitiatedBy', 'LookupBuilderContactManagedBy', 'LookupBuilderContactPreparedBy', 'LookupBuilderAgreementStatuse', 'ActionItem', 'BuilderLegalName', 'LookupBuilderAgreementDoneWith', 'MarketingPartner', 'LookupCompany', 'Remark');
    public $components = array('Sms');

    public function index() {

        $dummy_status = $this->Auth->user('dummy_status');
        $city_id = $this->Auth->user('city_id');
        $role_id = $this->Session->read("role_id");
        $consultant_name = '';
        $consultant_primarycity = '';
        $consultant_commercial = '';
        $consultant_highendresidential = '';
        $consultant_residential = '';
        $search_condition = array();
        $channel_id = $this->Session->read("channel_id");
        $channel_id = $this->Channel->findById($channel_id);
        $channel_city_id = $channel_id['Channel']['city_id'];

        if ($this->request->is('post') || $this->request->is('put')) {
            if (!empty($this->data['Consultant']['consultant_name'])) {
                $consultant_name = $this->data['Consultant']['consultant_name'];
                array_push($search_condition, array('Consultant.consultant_name' . ' LIKE' => "%" . mysql_escape_string(trim(strip_tags($consultant_name))) . "%"));
            }
            if (!empty($this->data['Consultant']['consultant_highendresidential'])) {
                $consultant_highendresidential = $this->data['Consultant']['consultant_highendresidential'];
                array_push($search_condition, array('Consultant.consultant_highendresidential' => $consultant_highendresidential));
            }

            if (!empty($this->data['Consultant']['consultant_primarycity'])) {
                $consultant_primarycity = $this->data['Consultant']['consultant_primarycity'];
                array_push($search_condition, array('Consultant.consultant_primarycity' => $consultant_primarycity));
            }
            if (!empty($this->data['Consultant']['consultant_residential'])) {
                $consultant_residential = $this->data['Consultant']['consultant_residential'];
                array_push($search_condition, array('Consultant.consultant_residential' => $consultant_residential));
            }
            if (!empty($this->data['Consultant']['consultant_commercial'])) {
                $consultant_commercial = $this->data['Consultant']['consultant_commercial'];
                array_push($search_condition, array('Consultant.consultant_commercial' => $consultant_commercial));
            }
        } elseif ($this->request->is('get')) {

            if (!empty($this->request->params['named']['consultant_name'])) {
                $consultant_name = $this->request->params['named']['consultant_name'];
                array_push($search_condition, array("Consultant.consultant_name LIKE '%$consultant_name%'"));
            }

            if (!empty($this->request->params['named']['consultant_primarycity'])) {
                $consultant_primarycity = $this->request->params['named']['consultant_primarycity'];
                array_push($search_condition, array('Consultant.consultant_primarycity' => $consultant_primarycity));
            }

            if (!empty($this->request->params['named']['consultant_highendresidential'])) {
                $consultant_highendresidential = $this->request->params['named']['consultant_highendresidential'];
                array_push($search_condition, array('Consultant.consultant_highendresidential' => $consultant_highendresidential));
            }

            if (!empty($this->request->params['named']['consultant_residential'])) {
                $consultant_residential = $this->request->params['named']['consultant_residential'];
                array_push($search_condition, array('Consultant.consultant_residential' => $consultant_residential));
            }

            if (!empty($this->request->params['named']['consultant_commercial'])) {
                $consultant_commercial = $this->request->params['named']['consultant_commercial'];
                array_push($search_condition, array('Consultant.consultant_commercial' => $consultant_commercial));
            }
        }
        if ($role_id == '15') { // Accounts User.
            if ($channel_city_id == 2) {
                array_push($search_condition, array('OR' => array('Consultant.consultant_primarycity' => $channel_city_id, 'Consultant.consultant_secondarycity' => $channel_city_id, 'Consultant.consultant_tertiarycity' => $channel_city_id, 'Consultant.city_4' => $city_id, 'Consultant.city_5' => $channel_city_id)));
            } else {
                array_push($search_condition, array('NOT' => array('Consultant.consultant_primarycity' => 2, 'Consultant.consultant_secondarycity' => 2, 'Consultant.consultant_tertiarycity' => 2, 'Consultant.city_4' => 2, 'Consultant.city_5' => 2)));
            }
        } else {
            if ($channel_city_id > 1) {
                array_push($search_condition, array('OR' => array('Consultant.consultant_primarycity' => $channel_city_id, 'Consultant.consultant_secondarycity' => $channel_city_id, 'Consultant.consultant_tertiarycity' => $channel_city_id, 'Consultant.city_4' => $city_id, 'Consultant.city_5' => $channel_city_id)));
            }
        }



        if ($dummy_status) {
            array_push($search_condition, array('Consultant.dummy_status' => $dummy_status, 'Consultant.consultant_status' => '1'));
        }
        if (count($this->params['pass'])) {

            $aaray = explode(':', $this->params['pass'][0]);
            $field = $aaray[0];
            $value = $aaray[1];
            array_push($search_condition, array('Consultant.' . $field => $value)); // when consultant is approve/pending
        }


        $this->paginate['order'] = array('Consultant.consultant_approved' => 'asc');

        $this->set('consultants', $this->paginate("Consultant", $search_condition));

        //$log = $this->Consultant->getDataSource()->getLog(false, false);       
        //debug($log);
        //die;


        if ($role_id == '15') { // Accounts User.
            if ($channel_city_id == '2') {

                $all_count = $this->Consultant->find('count', array('conditions' => array('OR' => array(
                            'Consultant.consultant_primarycity' => $channel_city_id,
                            'Consultant.consultant_secondarycity' => $channel_city_id,
                            'Consultant.consultant_tertiarycity' => $channel_city_id,
                            'Consultant.city_4' => $channel_city_id,
                            'Consultant.city_5' => $channel_city_id,
                        ), 'Consultant.dummy_status' => $dummy_status)));

                $approve = $this->Consultant->find('count', array('conditions' => array('OR' => array(
                            'Consultant.consultant_primarycity' => $channel_city_id,
                            'Consultant.consultant_secondarycity' => $channel_city_id,
                            'Consultant.consultant_tertiarycity' => $channel_city_id,
                            'Consultant.city_4' => $channel_city_id,
                            'Consultant.city_5' => $channel_city_id,
                        ), 'Consultant.consultant_approved' => '1', 'Consultant.dummy_status' => $dummy_status)));

                $pending = $this->Consultant->find('count', array('conditions' => array('OR' => array(
                            'Consultant.consultant_primarycity' => $channel_city_id,
                            'Consultant.consultant_secondarycity' => $channel_city_id,
                            'Consultant.consultant_tertiarycity' => $channel_city_id,
                            'Consultant.city_4' => $channel_city_id,
                            'Consultant.city_5' => $channel_city_id,
                        ), 'Consultant.consultant_approved' => '2', 'Consultant.dummy_status' => $dummy_status)));
                $residential_all_count = $this->Consultant->find('count', array('conditions' => array('OR' => array(
                            'Consultant.consultant_primarycity' => $channel_city_id,
                            'Consultant.consultant_secondarycity' => $channel_city_id,
                            'Consultant.consultant_tertiarycity' => $channel_city_id,
                            'Consultant.city_4' => $channel_city_id,
                            'Consultant.city_5' => $channel_city_id,
                        ), 'Consultant.dummy_status' => $dummy_status, 'Consultant.consultant_residential <> ""')));

                $residential_yes = $this->Consultant->find('count', array('conditions' => array('OR' => array(
                            'Consultant.consultant_primarycity' => $channel_city_id,
                            'Consultant.consultant_secondarycity' => $channel_city_id,
                            'Consultant.consultant_tertiarycity' => $channel_city_id,
                            'Consultant.city_4' => $channel_city_id,
                            'Consultant.city_5' => $channel_city_id,
                        ), 'Consultant.consultant_residential' => '1', 'Consultant.dummy_status' => $dummy_status)));

                $residential_no = $this->Consultant->find('count', array('conditions' => array('OR' => array(
                            'Consultant.consultant_primarycity' => $channel_city_id,
                            'Consultant.consultant_secondarycity' => $channel_city_id,
                            'Consultant.consultant_tertiarycity' => $channel_city_id,
                            'Consultant.city_4' => $channel_city_id,
                            'Consultant.city_5' => $channel_city_id,
                        ), 'Consultant.consultant_residential' => '2', 'Consultant.dummy_status' => $dummy_status)));

                $commercial_all_count = $this->Consultant->find('count', array('conditions' => array('OR' => array(
                            'Consultant.consultant_primarycity' => $channel_city_id,
                            'Consultant.consultant_secondarycity' => $channel_city_id,
                            'Consultant.consultant_tertiarycity' => $channel_city_id,
                            'Consultant.city_4' => $channel_city_id,
                            'Consultant.city_5' => $channel_city_id,
                        ), 'Consultant.dummy_status' => $dummy_status, 'Consultant.consultant_commercial <> ""')));

                $commercial_yes = $this->Consultant->find('count', array('conditions' => array('OR' => array(
                            'Consultant.consultant_primarycity' => $channel_city_id,
                            'Consultant.consultant_secondarycity' => $channel_city_id,
                            'Consultant.consultant_tertiarycity' => $channel_city_id,
                            'Consultant.city_4' => $channel_city_id,
                            'Consultant.city_5' => $channel_city_id,
                        ), 'Consultant.consultant_commercial' => '1', 'Consultant.dummy_status' => $dummy_status)));

                $commercial_no = $this->Consultant->find('count', array('conditions' => array('OR' => array(
                            'Consultant.consultant_primarycity' => $channel_city_id,
                            'Consultant.consultant_secondarycity' => $channel_city_id,
                            'Consultant.consultant_tertiarycity' => $channel_city_id,
                            'Consultant.city_4' => $channel_city_id,
                            'Consultant.city_5' => $channel_city_id,
                        ), 'Consultant.consultant_commercial' => '2', 'Consultant.dummy_status' => $dummy_status)));

                $highend_all_count = $this->Consultant->find('count', array('conditions' => array('OR' => array(
                            'Consultant.consultant_primarycity' => $channel_city_id,
                            'Consultant.consultant_secondarycity' => $channel_city_id,
                            'Consultant.consultant_tertiarycity' => $channel_city_id,
                            'Consultant.city_4' => $channel_city_id,
                            'Consultant.city_5' => $channel_city_id,
                        ), 'Consultant.dummy_status' => $dummy_status, 'Consultant.consultant_highendresidential <> ""')));

                $highend_yes = $this->Consultant->find('count', array('conditions' => array('OR' => array(
                            'Consultant.consultant_primarycity' => $channel_city_id,
                            'Consultant.consultant_secondarycity' => $channel_city_id,
                            'Consultant.consultant_tertiarycity' => $channel_city_id,
                            'Consultant.city_4' => $channel_city_id,
                            'Consultant.city_5' => $channel_city_id,
                        ), 'Consultant.consultant_highendresidential' => '1', 'Consultant.dummy_status' => $dummy_status)));

                $highend_no = $this->Consultant->find('count', array('conditions' => array('OR' => array(
                            'Consultant.consultant_primarycity' => $channel_city_id,
                            'Consultant.consultant_secondarycity' => $channel_city_id,
                            'Consultant.consultant_tertiarycity' => $channel_city_id,
                            'Consultant.city_4' => $channel_city_id,
                            'Consultant.city_5' => $channel_city_id,
                        ), 'Consultant.consultant_highendresidential' => '2', 'Consultant.dummy_status' => $dummy_status)));
            } else {

                $all_count = $this->Consultant->find('count', array('conditions' => array('NOT' => array(
                            'Consultant.consultant_primarycity' => 2,
                            'Consultant.consultant_secondarycity' => 2,
                            'Consultant.consultant_tertiarycity' => 2,
                            'Consultant.city_4' => 2,
                            'Consultant.city_5' => 2,
                        ), 'Consultant.dummy_status' => $dummy_status)));

                $approve = $this->Consultant->find('count', array('conditions' => array('NOT' => array(
                            'Consultant.consultant_primarycity' => 2,
                            'Consultant.consultant_secondarycity' => 2,
                            'Consultant.consultant_tertiarycity' => 2,
                            'Consultant.city_4' => 2,
                            'Consultant.city_5' => 2,
                        ), 'Consultant.consultant_approved' => '1', 'Consultant.dummy_status' => $dummy_status)));

                $pending = $this->Consultant->find('count', array('conditions' => array('NOT' => array(
                            'Consultant.consultant_primarycity' => 2,
                            'Consultant.consultant_secondarycity' => 2,
                            'Consultant.consultant_tertiarycity' => 2,
                            'Consultant.city_4' => 2,
                            'Consultant.city_5' => 2,
                        ), 'Consultant.consultant_approved' => '2', 'Consultant.dummy_status' => $dummy_status)));
                $residential_all_count = $this->Consultant->find('count', array('conditions' => array('NOT' => array(
                            'Consultant.consultant_primarycity' => 2,
                            'Consultant.consultant_secondarycity' => 2,
                            'Consultant.consultant_tertiarycity' => 2,
                            'Consultant.city_4' => 2,
                            'Consultant.city_5' => 2,
                        ), 'Consultant.dummy_status' => $dummy_status, 'Consultant.consultant_residential <> ""')));

                $residential_yes = $this->Consultant->find('count', array('conditions' => array('NOT' => array(
                            'Consultant.consultant_primarycity' => 2,
                            'Consultant.consultant_secondarycity' => 2,
                            'Consultant.consultant_tertiarycity' => 2,
                            'Consultant.city_4' => 2,
                            'Consultant.city_5' => 2,
                        ), 'Consultant.consultant_residential' => '1', 'Consultant.dummy_status' => $dummy_status)));

                $residential_no = $this->Consultant->find('count', array('conditions' => array('NOT' => array(
                            'Consultant.consultant_primarycity' => 2,
                            'Consultant.consultant_secondarycity' => 2,
                            'Consultant.consultant_tertiarycity' => 2,
                            'Consultant.city_4' => 2,
                            'Consultant.city_5' => 2,
                        ), 'Consultant.consultant_residential' => '2', 'Consultant.dummy_status' => $dummy_status)));

                $commercial_all_count = $this->Consultant->find('count', array('conditions' => array('NOT' => array(
                            'Consultant.consultant_primarycity' => 2,
                            'Consultant.consultant_secondarycity' => 2,
                            'Consultant.consultant_tertiarycity' => 2,
                            'Consultant.city_4' => 2,
                            'Consultant.city_5' => 2,
                        ), 'Consultant.dummy_status' => $dummy_status, 'Consultant.consultant_commercial <> ""')));

                $commercial_yes = $this->Consultant->find('count', array('conditions' => array('NOT' => array(
                            'Consultant.consultant_primarycity' => 2,
                            'Consultant.consultant_secondarycity' => 2,
                            'Consultant.consultant_tertiarycity' => 2,
                            'Consultant.city_4' => 2,
                            'Consultant.city_5' => 2,
                        ), 'Consultant.consultant_commercial' => '1', 'Consultant.dummy_status' => $dummy_status)));

                $commercial_no = $this->Consultant->find('count', array('conditions' => array('NOT' => array(
                            'Consultant.consultant_primarycity' => 2,
                            'Consultant.consultant_secondarycity' => 2,
                            'Consultant.consultant_tertiarycity' => 2,
                            'Consultant.city_4' => 2,
                            'Consultant.city_5' => 2,
                        ), 'Consultant.consultant_commercial' => '2', 'Consultant.dummy_status' => $dummy_status)));

                $highend_all_count = $this->Consultant->find('count', array('conditions' => array('NOT' => array(
                            'Consultant.consultant_primarycity' => 2,
                            'Consultant.consultant_secondarycity' => 2,
                            'Consultant.consultant_tertiarycity' => 2,
                            'Consultant.city_4' => 2,
                            'Consultant.city_5' => 2,
                        ), 'Consultant.dummy_status' => $dummy_status, 'Consultant.consultant_highendresidential <> ""')));

                $highend_yes = $this->Consultant->find('count', array('conditions' => array('NOT' => array(
                            'Consultant.consultant_primarycity' => 2,
                            'Consultant.consultant_secondarycity' => 2,
                            'Consultant.consultant_tertiarycity' => 2,
                            'Consultant.city_4' => 2,
                            'Consultant.city_5' => 2,
                        ), 'Consultant.consultant_highendresidential' => '1', 'Consultant.dummy_status' => $dummy_status)));

                $highend_no = $this->Consultant->find('count', array('conditions' => array('NOT' => array(
                            'Consultant.consultant_primarycity' => 2,
                            'Consultant.consultant_secondarycity' => 2,
                            'Consultant.consultant_tertiarycity' => 2,
                            'Consultant.city_4' => 2,
                            'Consultant.city_5' => 2,
                        ), 'Consultant.consultant_highendresidential' => '2', 'Consultant.dummy_status' => $dummy_status)));
            }
        } else {

            if ($channel_city_id == '1') {

                $all_count = $this->Consultant->find('count', array('conditions' => array('Consultant.dummy_status' => $dummy_status)));
                $approve = $this->Consultant->find('count', array('conditions' => array('Consultant.consultant_approved' => '1', 'Consultant.dummy_status' => $dummy_status)));
                $pending = $this->Consultant->find('count', array('conditions' => array('Consultant.consultant_approved' => '2', 'Consultant.dummy_status' => $dummy_status)));
                $residential_all_count = $this->Consultant->find('count', array('conditions' => array('Consultant.dummy_status' => $dummy_status, 'Consultant.consultant_residential <> ""')));
                $residential_yes = $this->Consultant->find('count', array('conditions' => array('Consultant.consultant_residential' => '1', 'Consultant.dummy_status' => $dummy_status)));
                $residential_no = $this->Consultant->find('count', array('conditions' => array('Consultant.consultant_residential' => '2', 'Consultant.dummy_status' => $dummy_status)));
                $commercial_all_count = $this->Consultant->find('count', array('conditions' => array('Consultant.dummy_status' => $dummy_status, 'Consultant.consultant_commercial <> ""')));
                $commercial_yes = $this->Consultant->find('count', array('conditions' => array('Consultant.consultant_commercial' => '1', 'Consultant.dummy_status' => $dummy_status)));
                $commercial_no = $this->Consultant->find('count', array('conditions' => array('Consultant.consultant_commercial' => '2', 'Consultant.dummy_status' => $dummy_status)));
                $highend_all_count = $this->Consultant->find('count', array('conditions' => array('Consultant.dummy_status' => $dummy_status, 'Consultant.consultant_highendresidential <> ""')));
                $highend_yes = $this->Consultant->find('count', array('conditions' => array('Consultant.consultant_highendresidential' => '1', 'Consultant.dummy_status' => $dummy_status)));
                $highend_no = $this->Consultant->find('count', array('conditions' => array('Consultant.consultant_highendresidential' => '2', 'Consultant.dummy_status' => $dummy_status)));
            } else {

                $all_count = $this->Consultant->find('count', array('conditions' => array('OR' => array(
                            'Consultant.consultant_primarycity' => $channel_city_id,
                            'Consultant.consultant_secondarycity' => $channel_city_id,
                            'Consultant.consultant_tertiarycity' => $channel_city_id,
                            'Consultant.city_4' => $channel_city_id,
                            'Consultant.city_5' => $channel_city_id,
                        ), 'Consultant.dummy_status' => $dummy_status)));

                $approve = $this->Consultant->find('count', array('conditions' => array('OR' => array(
                            'Consultant.consultant_primarycity' => $channel_city_id,
                            'Consultant.consultant_secondarycity' => $channel_city_id,
                            'Consultant.consultant_tertiarycity' => $channel_city_id,
                            'Consultant.city_4' => $channel_city_id,
                            'Consultant.city_5' => $channel_city_id,
                        ), 'Consultant.consultant_approved' => '1', 'Consultant.dummy_status' => $dummy_status)));

                $pending = $this->Consultant->find('count', array('conditions' => array('OR' => array(
                            'Consultant.consultant_primarycity' => $channel_city_id,
                            'Consultant.consultant_secondarycity' => $channel_city_id,
                            'Consultant.consultant_tertiarycity' => $channel_city_id,
                            'Consultant.city_4' => $channel_city_id,
                            'Consultant.city_5' => $channel_city_id,
                        ), 'Consultant.consultant_approved' => '2', 'Consultant.dummy_status' => $dummy_status)));
                $residential_all_count = $this->Consultant->find('count', array('conditions' => array('OR' => array(
                            'Consultant.consultant_primarycity' => $channel_city_id,
                            'Consultant.consultant_secondarycity' => $channel_city_id,
                            'Consultant.consultant_tertiarycity' => $channel_city_id,
                            'Consultant.city_4' => $channel_city_id,
                            'Consultant.city_5' => $channel_city_id,
                        ), 'Consultant.dummy_status' => $dummy_status, 'Consultant.consultant_residential <> ""')));

                $residential_yes = $this->Consultant->find('count', array('conditions' => array('OR' => array(
                            'Consultant.consultant_primarycity' => $channel_city_id,
                            'Consultant.consultant_secondarycity' => $channel_city_id,
                            'Consultant.consultant_tertiarycity' => $channel_city_id,
                            'Consultant.city_4' => $channel_city_id,
                            'Consultant.city_5' => $channel_city_id,
                        ), 'Consultant.consultant_residential' => '1', 'Consultant.dummy_status' => $dummy_status)));

                $residential_no = $this->Consultant->find('count', array('conditions' => array('OR' => array(
                            'Consultant.consultant_primarycity' => $channel_city_id,
                            'Consultant.consultant_secondarycity' => $channel_city_id,
                            'Consultant.consultant_tertiarycity' => $channel_city_id,
                            'Consultant.city_4' => $channel_city_id,
                            'Consultant.city_5' => $channel_city_id,
                        ), 'Consultant.consultant_residential' => '2', 'Consultant.dummy_status' => $dummy_status)));

                $commercial_all_count = $this->Consultant->find('count', array('conditions' => array('OR' => array(
                            'Consultant.consultant_primarycity' => $channel_city_id,
                            'Consultant.consultant_secondarycity' => $channel_city_id,
                            'Consultant.consultant_tertiarycity' => $channel_city_id,
                            'Consultant.city_4' => $channel_city_id,
                            'Consultant.city_5' => $channel_city_id,
                        ), 'Consultant.dummy_status' => $dummy_status, 'Consultant.consultant_commercial <> ""')));

                $commercial_yes = $this->Consultant->find('count', array('conditions' => array('OR' => array(
                            'Consultant.consultant_primarycity' => $channel_city_id,
                            'Consultant.consultant_secondarycity' => $channel_city_id,
                            'Consultant.consultant_tertiarycity' => $channel_city_id,
                            'Consultant.city_4' => $channel_city_id,
                            'Consultant.city_5' => $channel_city_id,
                        ), 'Consultant.consultant_commercial' => '1', 'Consultant.dummy_status' => $dummy_status)));

                $commercial_no = $this->Consultant->find('count', array('conditions' => array('OR' => array(
                            'Consultant.consultant_primarycity' => $channel_city_id,
                            'Consultant.consultant_secondarycity' => $channel_city_id,
                            'Consultant.consultant_tertiarycity' => $channel_city_id,
                            'Consultant.city_4' => $channel_city_id,
                            'Consultant.city_5' => $channel_city_id,
                        ), 'Consultant.consultant_commercial' => '2', 'Consultant.dummy_status' => $dummy_status)));

                $highend_all_count = $this->Consultant->find('count', array('conditions' => array('OR' => array(
                            'Consultant.consultant_primarycity' => $channel_city_id,
                            'Consultant.consultant_secondarycity' => $channel_city_id,
                            'Consultant.consultant_tertiarycity' => $channel_city_id,
                            'Consultant.city_4' => $channel_city_id,
                            'Consultant.city_5' => $channel_city_id,
                        ), 'Consultant.dummy_status' => $dummy_status, 'Consultant.consultant_highendresidential <> ""')));

                $highend_yes = $this->Consultant->find('count', array('conditions' => array('OR' => array(
                            'Consultant.consultant_primarycity' => $channel_city_id,
                            'Consultant.consultant_secondarycity' => $channel_city_id,
                            'Consultant.consultant_tertiarycity' => $channel_city_id,
                            'Consultant.city_4' => $channel_city_id,
                            'Consultant.city_5' => $channel_city_id,
                        ), 'Consultant.consultant_highendresidential' => '1', 'Consultant.dummy_status' => $dummy_status)));

                $highend_no = $this->Consultant->find('count', array('conditions' => array('OR' => array(
                            'Consultant.consultant_primarycity' => $channel_city_id,
                            'Consultant.consultant_secondarycity' => $channel_city_id,
                            'Consultant.consultant_tertiarycity' => $channel_city_id,
                            'Consultant.city_4' => $channel_city_id,
                            'Consultant.city_5' => $channel_city_id,
                        ), 'Consultant.consultant_highendresidential' => '2', 'Consultant.dummy_status' => $dummy_status)));
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

        $multicity_count = $this->Consultant->find('count', array(
            'conditions' => array('OR' => array(
                    'Consultant.consultant_primarycity' => $channel_city_id,
                    'Consultant.consultant_secondarycity' => $channel_city_id,
                    'Consultant.consultant_tertiarycity' => $channel_city_id,
                    'Consultant.city_4' => $channel_city_id,
                    'Consultant.city_5' => $channel_city_id,
                ),
                'Consultant.consultant_approved' => '1',
                'Consultant.dummy_status' => $dummy_status,
            ),
        ));
        $this->set(compact('multicity_count'));

        $consultant = $this->Consultant->find('list', array('fields' => 'Consultant.id, Consultant.consultant_name', 'order' => 'Consultant.consultant_name ASC'));
        $this->set('consultant', $consultant);





        $city = $this->City->find('list', array('fields' => 'City.id, City.city_name', 'conditions' => array('City.dummy_status' => $dummy_status, 'City.city_status' => '1'), 'order' => 'City.city_name ASC'));
        $this->set('city', $city);

        $codes = $this->LookupValueLeadsCountry->find('all', array('fields' => array('LookupValueLeadsCountry.id', 'LookupValueLeadsCountry.value', 'LookupValueLeadsCountry.code')));
        $codes = Set::combine($codes, '{n}.LookupValueLeadsCountry.id', array('%s:', '{n}.LookupValueLeadsCountry.code'));
        $this->set(compact('codes'));

        if (!isset($this->passedArgs['consultant_primarycity']) && empty($this->passedArgs['consultant_primarycity'])) {
            $this->passedArgs['consultant_primarycity'] = (isset($this->data['Consultant']['consultant_primarycity'])) ? $this->data['Consultant']['consultant_primarycity'] : '';
        }
        if (!isset($this->passedArgs['consultant_name']) && empty($this->passedArgs['consultant_name'])) {
            $this->passedArgs['consultant_name'] = (isset($this->data['Consultant']['consultant_name'])) ? $this->data['Consultant']['consultant_name'] : '';
        }
        if (!isset($this->passedArgs['consultant_residential']) && empty($this->passedArgs['consultant_residential'])) {
            $this->passedArgs['consultant_residential'] = (isset($this->data['Consultant']['consultant_residential'])) ? $this->data['Consultant']['consultant_residential'] : '';
        }
        if (!isset($this->passedArgs['consultant_commercial']) && empty($this->passedArgs['consultant_commercial'])) {
            $this->passedArgs['consultant_commercial'] = (isset($this->data['Consultant']['consultant_commercial'])) ? $this->data['Consultant']['consultant_commercial'] : '';
        }
        if (!isset($this->passedArgs['consultant_highendresidential']) && empty($this->passedArgs['consultant_highendresidential'])) {
            $this->passedArgs['consultant_highendresidential'] = (isset($this->data['Consultant']['consultant_highendresidential'])) ? $this->data['Consultant']['consultant_highendresidential'] : '';
        }
        if (!isset($this->data) && empty($this->data)) {
            $this->data['Consultant']['consultant_primarycity'] = $this->passedArgs['consultant_primarycity'];
            $this->data['Consultant']['consultant_name'] = $this->passedArgs['consultant_name'];
            $this->data['Consultant']['consultant_residential'] = $this->passedArgs['consultant_residential'];
            $this->data['Consultant']['consultant_commercial'] = $this->passedArgs['consultant_commercial'];
            $this->data['Consultant']['consultant_highendresidential'] = $this->passedArgs['consultant_highendresidential'];
        }

        $this->set(compact('consultant_primarycity'));
        $this->set(compact('consultant_name'));
        $this->set(compact('consultant_residential'));
        $this->set(compact('consultant_commercial'));
        $this->set(compact('consultant_highendresidential'));
    }

    public function add() {

        $user_id = $this->Auth->user('id');
        $role_id = $this->Session->read("role_id");
        $dummy_status = $this->Auth->user('dummy_status');
        $condition_dummy_status = array('dummy_status =' . $dummy_status, 'id != 1');



        if ($this->request->is('post')) {


            $this->request->data['Consultant']['dummy_status'] = $dummy_status;
            $this->request->data['Consultant']['consultant_approved'] = '2';
            $this->request->data['Consultant']['consultant_status'] = '1';  // 1 for Yes of lookup_value_statuses
            $this->request->data['Consultant']['created_by'] = $user_id;
            if ($this->data['Consultant']['consultant_boardnumber'] == '')
                $this->request->data['Consultant']['consultant_boardnumber_code'] = '';


            $this->Consultant->create();
            if ($this->Consultant->save($this->request->data['Consultant'])) {

                $consultant_id = $this->Consultant->getLastInsertId();
                if ($consultant_id) {

                    /**********************Consultant Remarks ******************************** */
                    $remarks['Remark']['consultant_id'] = $consultant_id;
                    $remarks['Remark']['remarks'] = 'New Consultant Record Created';
                    $remarks['Remark']['remarks_by'] = $user_id;
                    $remarks['Remark']['created_by'] = $user_id;
                    $remarks['Remark']['remarks_time'] = date('g:i A');
                    $remarks['Remark']['remarks_level'] = '12'; //11 for consultant from lookup_value_remarks_level
                    $remarks['Remark']['dummy_status'] = $dummy_status;
                    $this->Remark->save($remarks);



                    /*                     * ************************Next Action By logic********************** */

                    $action_user_id = '';
                    $oversing_user = array();

                    $oversing_channel = $this->Channel->find('first', array('conditions' => array('Channel.city_id' => $this->data['Consultant']['consultant_primarycity'], 'Channel.dummy_status' => $dummy_status), 'fields' => 'id'));

                    if (!empty($oversing_channel))
                        $oversing_user = $this->User->find('first', array('conditions' => array('User.overse_channel_id' => $oversing_channel['Channel']['id'], 'User.overse_role_id' => 10, 'User.dummy_status' => $dummy_status), 'fields' => 'id')); // 10 for Overseer of roles table.

                    if (count($oversing_user))
                        $action_user_id = $oversing_user['User']['id'];

                    /*                     * ************************Consultant Action ********************** */
                    $action_item['ActionItem']['consultant_id'] = $consultant_id;
                    $action_item['ActionItem']['action_item_level_id'] = '17'; //  for Consultant 
                    $action_item['ActionItem']['type_id'] = '7'; // 7 for Submission For Approval
                    $action_item['ActionItem']['action_industry'] = '1'; // for realestate of lookup_value_activity_industry
                    $action_item['ActionItem']['action_item_active'] = 'Yes';
                    $action_item['ActionItem']['action_item_status'] = '7'; //7 for Submitted For Approval table - lookup_value_action_item_statuses
                    $action_item['ActionItem']['description'] = 'New Consultant Record Created - Submission For Approval';
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
                      'Consultant' => $this->data['Consultant']['consultant_name'],
                      'Address' => $this->data['Consultant']['consultant_corporateaddress'],
                      'Board_no' => $this->data['Consultant']['consultant_boardnumber'],
                      'Board_email' => $this->data['Consultant']['consultant_boardemail'],
                      'Status' => 'Submission For Approval',

                      ));
                      $Email->template('consultant_template', 'default')->emailFormat('html')->to($to)->from('admin@silkrouters.com')->subject('Silkrouters - Submission for Consultant')->send();
                     */
                    /* End Emial */
                    /* Phone API */
                    /*
                      $msg = $this->data['Consultant']['consultant_name'].' | '.$this->data['Consultant']['consultant_corporateaddress'].' | '.$this->data['Consultant']['consultant_boardnumber'].' | '.$this->data['Consultant']['consultant_boardemail'].' | Submission For Approval';
                      $authKey = Configure::read('sms_api_key');
                      $senderId = Configure::read('sms_sender_id');
                      // $mobileNumber = $channels[0]['User']['primary_mobile_number'];
                      $mobileNumber = "9833156460";
                      $message = urlencode($msg);
                      $route = "default";
                      $this->Sms->send_sms($authKey,$mobileNumber,$message,$senderId,$route);
                     */
                    /* End Phone */


                    $this->Session->setFlash('Consultant has been saved.', 'success');
                    $this->redirect(array('controller' => 'messages', 'action' => 'index', 'consultants', 'my-consultants'));
                }
            } else {
                $this->Session->setFlash('Unable to add consultant.', 'failure');
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
            throw new NotFoundException(__('Invalid Consultant'));
        }

        $consultant = $this->Consultant->findById($id);
        
       // pr($consultant);
       // die;
        if (!$consultant) {
            throw new NotFoundException(__('Invalid consultant'));
        }

        if ($this->request->data) {

            /*             * *************************Next Action By logic********************** */

            $action_user_id = '';
            $oversing_user = array();
            /*
              $oversing_channel = $this->Channel->find('first',array('conditions' => array('Channel.city_id'=> $this->data['ConsultantContact']['consultant_contact_company_city'],'Channel.dummy_status' => $dummy_status),'fields' => 'id'));

              if(!empty($oversing_channel))
              $oversing_user = $this->User->find('first',array('conditions' => array('User.overse_channel_id'=> $oversing_channel['Channel']['id'],'User.overse_role_id' => 10,'User.dummy_status' => $dummy_status),'fields' => 'id')); // 10 for Overseer of roles table.

              if(count($oversing_user))
              $action_user_id = $oversing_user['User']['id'];
             */

            //$this->request->data['Consultant']['consultant_approved'] = '2';

            /*             * ************************Consultant Action ********************** */
            $action_item['ActionItem']['consultant_id'] = $id;
            $action_item['ActionItem']['action_item_level_id'] = '17'; //  for Consultant
            $action_item['ActionItem']['type_id'] = '10'; // 10 for Re-Submission For Approval
            $action_item['ActionItem']['next_action_by'] = '148';
            $action_item['ActionItem']['action_item_active'] = 'Yes';
            $action_item['ActionItem']['action_item_status'] = '17'; //1 for created table - lookup_value_action_item_statuses
            $action_item['ActionItem']['description'] = 'Consultant Record Updated - Re-Submission For Approval';
            $action_item['ActionItem']['action_item_source'] = $role_id;
            $action_item['ActionItem']['created_by_id'] = $user_id;
            $action_item['ActionItem']['created_by'] = $user_id;
            $action_item['ActionItem']['dummy_status'] = $dummy_status;
            $action_item['ActionItem']['parent_action_item_id'] = $actio_itme_id;
            $action_item['ActionItem']['action_industry'] = '1'; // for realestate of lookup_value_activity_industry


            /*             * ********************Consultant Remarks ******************************** */
            $remarks['Remark']['consultant_id'] = $id;
            $remarks['Remark']['remarks'] = 'Edit Consultant Record';
            $remarks['Remark']['remarks_by'] = $user_id;
            $remarks['Remark']['created_by'] = $user_id;
            $remarks['Remark']['remarks_time'] = date('g:i A');
            $remarks['Remark']['remarks_level'] = '12'; //12 for consultant from lookup_value_remarks_level
            $remarks['Remark']['dummy_status'] = $dummy_status;
            $this->Remark->save($remarks);

            if ($this->data['Consultant']['action_type'] == '0') {

                $this->request->data['Consultant']['consultant_active_primary'] = '1';
                $action_item['ActionItem']['screen_no'] = 'SC-1';
                $this->Consultant->id = $id;
                if ($this->Consultant->save($this->request->data['Consultant'])) {

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

                    $this->Session->setFlash('Consultant has been updated.', 'success');
                    //$this->redirect(array('controller' => 'messages','action' => 'index','consultant','my-consultants'));
                }
            } else if ($this->data['Consultant']['action_type'] == '1') {
                $action_item['ActionItem']['screen_no'] = 'SC-2';
                $this->request->data['Consultant']['consultant_active_operation'] = '1';
                $this->Consultant->id = $id;
                if ($this->Consultant->save($this->request->data['Consultant'])) {
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
                    //	$this->redirect(array('controller' => 'messages','action' => 'index','consultant','my-consultants'));
                }
            }else if ($this->data['Consultant']['action_type'] == '2') {
                $action_item['ActionItem']['screen_no'] = 'SC-3';
                $this->request->data['Consultant']['consultant_active_contact'] = '1';
                $this->Consultant->id = $id;
                if ($this->Consultant->save($this->request->data['Consultant'])) {
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
                    //	$this->redirect(array('controller' => 'messages','action' => 'index','consultant','my-consultants'));
                }
            }




            //$this->Session->setFlash('Consultant contact has been updated.', 'success');
            //$this->redirect(array('controller' => 'messages','action' => 'index','consultant','my-consultants'));	


            $this->set('action_type', $this->data['Consultant']['action_type']);

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

        $this->request->data = $consultant;
    }

    

    function view($id = null) {

        $arr = explode('_', $id);
        $id = base64_decode($arr[0]);


        if (!$id) {
            throw new NotFoundException(__('Invalid Consultant'));
        }

        $consultant = $this->Consultant->findById($id);


        if (!$consultant) {
            throw new NotFoundException(__('Invalid consultant'));
        }


        $this->request->data = $consultant;
    }

}


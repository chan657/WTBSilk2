<?php

/**
 * Project controller.
 *
 * This file will render views from views/projects/
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
 * Project controller
 *
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
App::uses('CakeEmail', 'Network/Email');

class ProjectsController extends AppController {

    public $components = array('Session', 'Image');
    public $uses = array('Project', 'ProjectType', 'Builder', 'Area', 'Suburb', 'LookupValueStatus', 'City', 'ProjectUnit', 'Amenitie', 'Phase', 'Category', 'Marketing', 'Quality', 'BuilderContact', 'LookupValueLeadsCountry', 'LookupProjectBankFinance', 'LookupProjectContactManagedBy', 'LookupProjectContactPreparedBy', 'LookupProjectContactProjectRole', 'BuilderAgreement', 'LookupValueProjectPhase', 'LookupProjectContactStatus', 'MarketingPartner', 'LookupProjectLegalApproval', 'LookupProjectLandmarkDistanceUnit', 'LookupProjectLandAreaUnit', 'LookupProjectConstruction', 'LookupValueProjectUnitTypeQualifier_1', 'LookupValueProjectUnitTypeQualifier_2', 'LookupValueProjectUnitTypeQualifier_3', 'LookupValueProjectUnitTypeQualifier_4', 'LookupValueProjectUnitTypeQualifier_5', 'Amenity', 'Group', 'LookupValueMarketingStatus', 'LookupValueProjectUnitType', 'LookupValueProjectAttache', 'LookupUnitCommissionBasedOn', 'LookupUnitCommissionEvent', 'ProjectContact', 'Remark', 'Channel', 'LookupValueProjectUnitPreference', 'ProjectLegalName');
    public $uploadDir;

    public function beforeFilter() {
        parent::beforeFilter();
        $this->uploadDir = ROOT . DS . APP_DIR . DS . WEBROOT_DIR . '/uploads/projects';
    }

    public function index() {

        $user_city_id = $this->Auth->user('city_id');
        $dummy_status = $this->Auth->user('dummy_status');
        $channel_id = $this->Session->read("channel_id");
        $role_id = $this->Session->read("role_id");
        $channels = $this->Channel->findById($channel_id);
        $channel_city_id = $channels['Channel']['city_id'];

        $condition_dummy_status = array('dummy_status' => $dummy_status);

        $search_condition = array();
        $global_search = '';
        $builder_id = '';
        $phase_id = '';
        $city_id = '';
        $suburb_id = '';
        $area_id = '';
        $builder_id = '';
        $proj_residential = '';
        $proj_highendresidential = '';
        $proj_commercial = '';
        $secondary_builder_id = '';
        $proj_marketing_status = '';
        $proj_marketing_partner = '';

        if ($this->request->is('post') || $this->request->is('put')) {

            App::import('Sanitize');


            //  $city_id =  $this->data['Project']['city_id'];
            // $components = array('Paginator');
            if (!empty($this->data['Project']['global_search'])) {
                $global_search = $this->data['Project']['global_search'];
                // array_push($search_condition,array("MATCH(Project.project_name) AGAINST('$global_search')"));
                array_push($search_condition, array('OR' => array('Project.project_name' . ' LIKE' => "%" . mysql_escape_string(trim(strip_tags($global_search))) . "%", 'Builder.builder_name' . ' LIKE' => "%" . mysql_escape_string(trim(strip_tags($global_search))) . "%")));
            }

            if (!empty($this->data['Project']['builder_id'])) {
                $builder_id = $this->data['Project']['builder_id'];
                array_push($search_condition, array('Project.builder_id' => $builder_id));
            }
            if (!empty($this->data['Project']['phase_id'])) {
                $phase_id = $this->data['Project']['phase_id'];
                array_push($search_condition, array('Project.phase_id' => $phase_id));
            }

            if (!empty($this->data['Project']['city_id'])) {
                $city_id = $this->data['Project']['city_id'];
                array_push($search_condition, array('Project.city_id' => $city_id));
            }
            if (!empty($this->data['Project']['suburb_id'])) {
                $suburb_id = $this->data['Project']['suburb_id'];
                array_push($search_condition, array('Project.suburb_id' => $suburb_id));
            }
            if (!empty($this->data['Project']['area_id'])) {
                $area_id = $this->data['Project']['area_id'];
                array_push($search_condition, array('Project.area_id' => $area_id));
            }

            if (!empty($this->data['Project']['proj_residential'])) {
                $proj_residential = $this->data['Project']['proj_residential'];
                array_push($search_condition, array('Project.proj_residential' => $proj_residential));
            }
            if (!empty($this->data['Project']['proj_highendresidential'])) {
                $proj_highendresidential = $this->data['Project']['proj_highendresidential'];
                array_push($search_condition, array('Project.proj_highendresidential' => $proj_highendresidential));
            }
            if (!empty($this->data['Project']['proj_commercial'])) {
                $proj_commercial = $this->data['Project']['proj_commercial'];
                array_push($search_condition, array('Project.proj_commercial' => $proj_commercial));
            }
            if (!empty($this->data['Project']['secondary_builder_id'])) {
                $secondary_builder_id = $this->data['Project']['secondary_builder_id'];
                array_push($search_condition, array('Project.secondary_builder_id' => $secondary_builder_id));
            }
            if (!empty($this->data['Project']['proj_marketing_status'])) {
                $proj_marketing_status = $this->data['Project']['proj_marketing_status'];
                array_push($search_condition, array('Project.proj_marketing_status' => $proj_marketing_status));
            }
            if (!empty($this->data['Project']['proj_marketing_partner'])) {
                $proj_marketing_partner = $this->data['Project']['proj_marketing_partner'];
                array_push($search_condition, array('Project.proj_marketing_partner' => $proj_marketing_partner));
            }
            // pr($search_condition);
        } elseif ($this->request->is('get')) {

            if (!empty($this->request->params['named']['global_search'])) {
                $global_search = $this->request->params['named']['global_search'];
                array_push($search_condition, array('OR' => array('Project.project_name' . ' LIKE' => mysql_escape_string(trim(strip_tags($global_search))) . "%", 'Builder.builder_name' . ' LIKE' => mysql_escape_string(trim(strip_tags($global_search))) . "%")));
            }

            if (!empty($this->request->params['named']['city_id'])) {
                $city_id = $this->request->params['named']['city_id'];
                array_push($search_condition, array('Project.city_id' => $city_id));
            }
            if (!empty($this->request->params['named']['builder_id'])) {
                $builder_id = $this->request->params['named']['builder_id'];
                array_push($search_condition, array('Project.builder_id' => $builder_id));
            }
            if (!empty($this->request->params['named']['phase_id'])) {
                $phase_id = $this->request->params['named']['phase_id'];
                array_push($search_condition, array('Project.phase_id' => $phase_id));
            }
            if (!empty($this->request->params['named']['suburb_id'])) {
                $suburb_id = $this->request->params['named']['suburb_id'];
                array_push($search_condition, array('Project.suburb_id' => $suburb_id));
            }
            if (!empty($this->request->params['named']['area_id'])) {
                $area_id = $this->request->params['named']['area_id'];
                array_push($search_condition, array('Project.area_id' => $area_id));
            }
            if (!empty($this->request->params['named']['proj_residential'])) {
                $proj_residential = $this->request->params['named']['proj_residential'];
                array_push($search_condition, array('Project.proj_residential' => $proj_residential));
            }
            if (!empty($this->request->params['named']['proj_highendresidential'])) {
                $proj_highendresidential = $this->request->params['named']['proj_highendresidential'];
                array_push($search_condition, array('Project.proj_highendresidential' => $proj_highendresidential));
            }
            if (!empty($this->request->params['named']['proj_commercial'])) {
                $proj_commercial = $this->request->params['named']['proj_commercial'];
                array_push($search_condition, array('Project.proj_commercial' => $proj_commercial));
            }
            if (!empty($this->request->params['named']['secondary_builder_id'])) {
                $secondary_builder_id = $this->request->params['named']['secondary_builder_id'];
                array_push($search_condition, array('Project.secondary_builder_id' => $secondary_builder_id));
            }
            if (!empty($this->request->params['named']['proj_marketing_status'])) {
                $proj_marketing_status = $this->request->params['named']['proj_marketing_status'];
                array_push($search_condition, array('Project.proj_marketing_status' => $proj_marketing_status));
            }
            if (!empty($this->request->params['named']['proj_marketing_partner'])) {
                $proj_marketing_partner = $this->request->params['named']['proj_marketing_partner'];
                array_push($search_condition, array('Project.proj_marketing_partner' => $proj_marketing_partner));
            }
        }
        if ($role_id == '15') { // Accounts User.
            if ($channel_city_id == 2) {
                array_push($search_condition, array('Project.city_id' => $channel_city_id));
            } else {
                array_push($search_condition, array('NOT' => array('Project.city_id' => 2)));
            }
        } else {
            if ($channel_city_id > 1) {
                array_push($search_condition, array('Project.city_id' => $channel_city_id));
            }
        }
        if ($dummy_status)
            array_push($search_condition, array('Project.dummy_status' => $dummy_status, 'Project.proj_status' => '1'));
        //$this->set('projects', $this->Project->find('all', array('order' => 'Project.project_name ASC')));
        $this->paginate['order'] = array('Project.project_name' => 'asc');
        // pr($this->params['pass']);
        if (count($this->params['pass'])) {

            $aaray = explode(':', $this->params['pass'][0]);
            $field = $aaray[0];
            $value = $aaray[1];
            array_push($search_condition, array('Project.' . $field => $value)); // when builder is approve/pending
        }
        // $log = $this->Project->getDataSource()->getLog(false, false);       
        // debug($log);

        $projects = $this->paginate("Project", $search_condition);
        $this->set(compact('projects'));

        if ($role_id == '15') { // Accounts User.
            if ($channel_city_id == '2') {
                $all_count = $this->Project->find('count', array('conditions' => array('Project.city_id' => $channel_city_id, 'Project.dummy_status' => $dummy_status)));
                $approve = $this->Project->find('count', array('conditions' => array('Project.city_id' => $channel_city_id, 'Project.proj_approved' => '1', 'Project.dummy_status' => $dummy_status)));
                $pending = $this->Project->find('count', array('conditions' => array('Project.city_id' => $channel_city_id, 'Project.proj_approved' => '2', 'Project.dummy_status' => $dummy_status)));
                $residential_all_count = $this->Project->find('count', array('conditions' => array('Project.city_id' => $channel_city_id, 'Project.dummy_status' => $dummy_status, 'Project.proj_residential <> ""')));
                $residential_yes = $this->Project->find('count', array('conditions' => array('Project.city_id' => $channel_city_id, 'Project.proj_residential' => '1', 'Project.dummy_status' => $dummy_status)));
                $residential_no = $this->Project->find('count', array('conditions' => array('Project.city_id' => $channel_city_id, 'Project.proj_residential' => '2', 'Project.dummy_status' => $dummy_status)));
                $commercial_all_count = $this->Project->find('count', array('conditions' => array('Project.city_id' => $channel_city_id, 'Project.dummy_status' => $dummy_status, 'Project.proj_commercial <> ""')));
                $commercial_yes = $this->Project->find('count', array('conditions' => array('Project.city_id' => $channel_city_id, 'Project.proj_commercial' => '1', 'Project.dummy_status' => $dummy_status)));
                $commercial_no = $this->Project->find('count', array('conditions' => array('Project.city_id' => $channel_city_id, 'Project.proj_commercial' => '2', 'Project.dummy_status' => $dummy_status)));
                $highend_all_count = $this->Project->find('count', array('conditions' => array('Project.city_id' => $channel_city_id, 'Project.dummy_status' => $dummy_status, 'Project.proj_highendresidential <> ""')));
                $highend_yes = $this->Project->find('count', array('conditions' => array('Project.city_id' => $channel_city_id, 'Project.proj_highendresidential' => '1', 'Project.dummy_status' => $dummy_status)));
                $highend_no = $this->Project->find('count', array('conditions' => array('Project.city_id' => $channel_city_id, 'Project.proj_highendresidential' => '2', 'Project.dummy_status' => $dummy_status)));
                $township = $this->Project->find('count', array('conditions' => array('Project.city_id' => $channel_city_id, 'Project.category_id' => '10', 'Project.dummy_status' => $dummy_status)));
            } else {
                $all_count = $this->Project->find('count', array('conditions' => array('NOT' => array('Project.city_id' => 2), 'Project.dummy_status' => $dummy_status)));
                $approve = $this->Project->find('count', array('conditions' => array('NOT' => array('Project.city_id' => 2), 'Project.proj_approved' => '1', 'Project.dummy_status' => $dummy_status)));
                $pending = $this->Project->find('count', array('conditions' => array('NOT' => array('Project.city_id' => 2), 'Project.proj_approved' => '2', 'Project.dummy_status' => $dummy_status)));
                $residential_all_count = $this->Project->find('count', array('conditions' => array('NOT' => array('Project.city_id' => 2), 'Project.dummy_status' => $dummy_status, 'Project.proj_residential <> ""')));
                $residential_yes = $this->Project->find('count', array('conditions' => array('NOT' => array('Project.city_id' => 2), 'Project.proj_residential' => '1', 'Project.dummy_status' => $dummy_status)));
                $residential_no = $this->Project->find('count', array('conditions' => array('NOT' => array('Project.city_id' => 2), 'Project.proj_residential' => '2', 'Project.dummy_status' => $dummy_status)));
                $commercial_all_count = $this->Project->find('count', array('conditions' => array('NOT' => array('Project.city_id' => 2), 'Project.dummy_status' => $dummy_status, 'Project.proj_commercial <> ""')));
                $commercial_yes = $this->Project->find('count', array('conditions' => array('NOT' => array('Project.city_id' => 2), 'Project.proj_commercial' => '1', 'Project.dummy_status' => $dummy_status)));
                $commercial_no = $this->Project->find('count', array('conditions' => array('NOT' => array('Project.city_id' => 2), 'Project.proj_commercial' => '2', 'Project.dummy_status' => $dummy_status)));
                $highend_all_count = $this->Project->find('count', array('conditions' => array('NOT' => array('Project.city_id' => 2), 'Project.dummy_status' => $dummy_status, 'Project.proj_highendresidential <> ""')));
                $highend_yes = $this->Project->find('count', array('conditions' => array('NOT' => array('Project.city_id' => 2), 'Project.proj_highendresidential' => '1', 'Project.dummy_status' => $dummy_status)));
                $highend_no = $this->Project->find('count', array('conditions' => array('NOT' => array('Project.city_id' => 2), 'Project.proj_highendresidential' => '2', 'Project.dummy_status' => $dummy_status)));
                $township = $this->Project->find('count', array('conditions' => array('NOT' => array('Project.city_id' => 2), 'Project.category_id' => '10', 'Project.dummy_status' => $dummy_status)));
            }
        } else {

            if ($channel_city_id == '1') {
                $all_count = $this->Project->find('count', array('conditions' => array('Project.dummy_status' => $dummy_status)));
                $approve = $this->Project->find('count', array('conditions' => array('Project.proj_approved' => '1', 'Project.dummy_status' => $dummy_status)));
                $pending = $this->Project->find('count', array('conditions' => array('Project.proj_approved' => '2', 'Project.dummy_status' => $dummy_status)));
                $residential_all_count = $this->Project->find('count', array('conditions' => array('Project.dummy_status' => $dummy_status, 'Project.proj_residential <> ""')));
                $residential_yes = $this->Project->find('count', array('conditions' => array('Project.proj_residential' => '1', 'Project.dummy_status' => $dummy_status)));
                $residential_no = $this->Project->find('count', array('conditions' => array('Project.proj_residential' => '2', 'Project.dummy_status' => $dummy_status)));
                $commercial_all_count = $this->Project->find('count', array('conditions' => array('Project.dummy_status' => $dummy_status, 'Project.proj_commercial <> ""')));
                $commercial_yes = $this->Project->find('count', array('conditions' => array('Project.proj_commercial' => '1', 'Project.dummy_status' => $dummy_status)));
                $commercial_no = $this->Project->find('count', array('conditions' => array('Project.proj_commercial' => '2', 'Project.dummy_status' => $dummy_status)));
                $highend_all_count = $this->Project->find('count', array('conditions' => array('Project.dummy_status' => $dummy_status, 'Project.proj_highendresidential <> ""')));
                $highend_yes = $this->Project->find('count', array('conditions' => array('Project.proj_highendresidential' => '1', 'Project.dummy_status' => $dummy_status)));
                $highend_no = $this->Project->find('count', array('conditions' => array('Project.proj_highendresidential' => '2', 'Project.dummy_status' => $dummy_status)));
                $township = $this->Project->find('count', array('conditions' => array('Project.category_id' => '10', 'Project.dummy_status' => $dummy_status)));
            } else {
                $all_count = $this->Project->find('count', array('conditions' => array('Project.city_id' => $channel_city_id, 'Project.dummy_status' => $dummy_status)));
                $approve = $this->Project->find('count', array('conditions' => array('Project.city_id' => $channel_city_id, 'Project.proj_approved' => '1', 'Project.dummy_status' => $dummy_status)));
                $pending = $this->Project->find('count', array('conditions' => array('Project.city_id' => $channel_city_id, 'Project.proj_approved' => '2', 'Project.dummy_status' => $dummy_status)));
                $residential_all_count = $this->Project->find('count', array('conditions' => array('Project.city_id' => $channel_city_id, 'Project.dummy_status' => $dummy_status, 'Project.proj_residential <> ""')));
                $residential_yes = $this->Project->find('count', array('conditions' => array('Project.city_id' => $channel_city_id, 'Project.proj_residential' => '1', 'Project.dummy_status' => $dummy_status)));
                $residential_no = $this->Project->find('count', array('conditions' => array('Project.city_id' => $channel_city_id, 'Project.proj_residential' => '2', 'Project.dummy_status' => $dummy_status)));
                $commercial_all_count = $this->Project->find('count', array('conditions' => array('Project.city_id' => $channel_city_id, 'Project.dummy_status' => $dummy_status, 'Project.proj_commercial <> ""')));
                $commercial_yes = $this->Project->find('count', array('conditions' => array('Project.city_id' => $channel_city_id, 'Project.proj_commercial' => '1', 'Project.dummy_status' => $dummy_status)));
                $commercial_no = $this->Project->find('count', array('conditions' => array('Project.city_id' => $channel_city_id, 'Project.proj_commercial' => '2', 'Project.dummy_status' => $dummy_status)));
                $highend_all_count = $this->Project->find('count', array('conditions' => array('Project.city_id' => $channel_city_id, 'Project.dummy_status' => $dummy_status, 'Project.proj_highendresidential <> ""')));
                $highend_yes = $this->Project->find('count', array('conditions' => array('Project.city_id' => $channel_city_id, 'Project.proj_highendresidential' => '1', 'Project.dummy_status' => $dummy_status)));
                $highend_no = $this->Project->find('count', array('conditions' => array('Project.city_id' => $channel_city_id, 'Project.proj_highendresidential' => '2', 'Project.dummy_status' => $dummy_status)));
                $township = $this->Project->find('count', array('conditions' => array('Project.city_id' => $channel_city_id, 'Project.category_id' => '10', 'Project.dummy_status' => $dummy_status)));
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
        $this->set(compact('township'));

        $phase = $this->Phase->find('list', array('fields' => array('id', 'name')));
        $this->set(compact('phase'));

        $project_list = $this->Project->find('list', array('fields' => array('id', 'project_name'), 'conditions' => $condition_dummy_status, 'order' => 'project_name asc'));
        $this->set('project_list', $project_list);

        $builders = $this->Builder->find('list', array(
            'conditions' => array('OR' => array(
                    'Builder.builder_primarycity' => $city_id,
                    'Builder.builder_secondarycity' => $city_id,
                    'Builder.builder_tertiarycity' => $city_id,
                    'Builder.city_4' => $city_id,
                    'Builder.city_5' => $city_id,
                ),
                'Builder.builder_approved' => '1',
                'Builder.dummy_status' => $dummy_status,
            ),
            'fields' => 'Builder.id, Builder.builder_name',
            'order' => 'Builder.builder_name ASC'
        ));
        $this->set(compact('builders'));


        $cities = $this->City->find('list', array('fields' => array('id', 'city_name'), 'conditions' => array('dummy_status' => $dummy_status, 'city_status' => '1'), 'order' => 'city_name asc'));
        $this->set(compact('cities'));

        $consub = array('dummy_status' => $dummy_status, 'city_id' => $city_id, 'suburb_status' => '1');
        $suburbs = $this->Suburb->find('list', array('fields' => array('id', 'suburb_name'), 'conditions' => $consub, 'order' => 'suburb_name asc'));
        $this->set(compact('suburbs'));

        $conarea = array('dummy_status' => $dummy_status, 'city_id' => $city_id, 'suburb_id' => $suburb_id, 'area_status' => '1');
        $areas = $this->Area->find('list', array('fields' => array('id', 'area_name'), 'conditions' => $conarea, 'order' => 'area_name asc'));
        $this->set(compact('areas'));



        $marketing_partners = $this->MarketingPartner->find('list', array('fields' => 'MarketingPartner.id, MarketingPartner.marketing_partner_display_name', 'conditions' => array('MarketingPartner.dummy_status' => $dummy_status, 'MarketingPartner.marketing_partner_status' => '1'), 'order' => 'MarketingPartner.marketing_partner_display_name ASC'));
        $this->set('marketing_partners', $marketing_partners);

        $marketing_status = $this->LookupValueMarketingStatus->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('marketing_status'));

        if (!isset($this->passedArgs['global_search']) && empty($this->passedArgs['global_search'])) {
            $this->passedArgs['global_search'] = (isset($this->data['Project']['global_search'])) ? $this->data['Project']['global_search'] : '';
        }
        if (!isset($this->passedArgs['city_id']) && empty($this->passedArgs['city_id'])) {
            $this->passedArgs['city_id'] = (isset($this->data['Project']['city_id'])) ? $this->data['Project']['city_id'] : '';
        }
        if (!isset($this->passedArgs['suburb_id']) && empty($this->passedArgs['suburb_id'])) {
            $this->passedArgs['suburb_id'] = (isset($this->data['Project']['suburb_id'])) ? $this->data['Project']['suburb_id'] : '';
        }
        if (!isset($this->passedArgs['area_id']) && empty($this->passedArgs['area_id'])) {
            $this->passedArgs['area_id'] = (isset($this->data['Project']['area_id'])) ? $this->data['Project']['area_id'] : '';
        }
        if (!isset($this->passedArgs['builder_id']) && empty($this->passedArgs['builder_id'])) {
            $this->passedArgs['builder_id'] = (isset($this->data['Project']['builder_id'])) ? $this->data['Project']['builder_id'] : '';
        }
        if (!isset($this->passedArgs['phase_id']) && empty($this->passedArgs['phase_id'])) {
            $this->passedArgs['phase_id'] = (isset($this->data['Project']['phase_id'])) ? $this->data['Project']['phase_id'] : '';
        }
        if (!isset($this->passedArgs['proj_residential']) && empty($this->passedArgs['proj_residential'])) {
            $this->passedArgs['proj_residential'] = (isset($this->data['Project']['proj_residential'])) ? $this->data['Project']['proj_residential'] : '';
        }
        if (!isset($this->passedArgs['proj_highendresidential']) && empty($this->passedArgs['proj_highendresidential'])) {
            $this->passedArgs['proj_highendresidential'] = (isset($this->data['Project']['proj_highendresidential'])) ? $this->data['Project']['proj_highendresidential'] : '';
        }
        if (!isset($this->passedArgs['proj_commercial']) && empty($this->passedArgs['proj_commercial'])) {
            $this->passedArgs['proj_commercial'] = (isset($this->data['Project']['proj_commercial'])) ? $this->data['Project']['proj_commercial'] : '';
        }
        if (!isset($this->passedArgs['secondary_builder_id']) && empty($this->passedArgs['secondary_builder_id'])) {
            $this->passedArgs['secondary_builder_id'] = (isset($this->data['Project']['secondary_builder_id'])) ? $this->data['Project']['secondary_builder_id'] : '';
        }
        if (!isset($this->passedArgs['proj_marketing_status']) && empty($this->passedArgs['proj_marketing_status'])) {
            $this->passedArgs['proj_marketing_status'] = (isset($this->data['Project']['proj_marketing_status'])) ? $this->data['Project']['proj_marketing_status'] : '';
        }
        if (!isset($this->passedArgs['proj_marketing_partner']) && empty($this->passedArgs['proj_marketing_partner'])) {
            $this->passedArgs['proj_marketing_partner'] = (isset($this->data['Project']['proj_marketing_partner'])) ? $this->data['Project']['proj_marketing_partner'] : '';
        }

        if (!isset($this->data) && empty($this->data)) {
            $this->data['Project']['city_id'] = $this->passedArgs['city_id'];
            $this->data['Project']['global_search'] = $this->passedArgs['global_search'];
            $this->data['Project']['suburb_id'] = $this->passedArgs['suburb_id'];
            $this->data['Project']['area_id'] = $this->passedArgs['area_id'];
            $this->data['Project']['builder_id'] = $this->passedArgs['builder_id'];
            $this->data['Project']['phase_id'] = $this->passedArgs['phase_id'];
            $this->data['Project']['proj_residential'] = $this->passedArgs['proj_residential'];
            $this->data['Project']['proj_highendresidential'] = $this->passedArgs['proj_highendresidential'];
            $this->data['Project']['proj_commercial'] = $this->passedArgs['proj_commercial'];
            $this->data['Project']['secondary_builder_id'] = $this->passedArgs['secondary_builder_id'];
            $this->data['Project']['proj_marketing_status'] = $this->passedArgs['proj_marketing_status'];
            $this->data['Project']['proj_marketing_partner'] = $this->passedArgs['proj_marketing_partner'];
        }

        $this->set(compact('global_search'));
        $this->set(compact('city_id'));
        $this->set(compact('suburb_id'));
        $this->set(compact('area_id'));
        $this->set(compact('builder_id'));
        $this->set(compact('phase_id'));
        $this->set(compact('proj_residential'));
        $this->set(compact('proj_highendresidential'));
        $this->set(compact('proj_commercial'));
        $this->set(compact('secondary_builder_id'));
        $this->set(compact('proj_marketing_status'));
        $this->set(compact('proj_marketing_partner'));
    }

    public function add() {

        $user_id = $this->Auth->user('id');
        $role_id = $this->Session->read("role_id");
        $dummy_status = $this->Auth->user('dummy_status');

        $condition_dummy_status = array('dummy_status =' . $dummy_status, 'id != 1');

        if ($this->request->is('post')) {

            $this->request->data['Project']['dummy_status'] = $dummy_status;
            $this->request->data['Project']['proj_approved'] = '1';
            $this->request->data['Project']['created_by'] = $user_id;
            $this->request->data['Project']['proj_status'] = '1'; // 1 for Yes of lookup_value_statuses


            if ($this->data['Project']['proj_completionyear'] <> '')
                $this->request->data['Project']['proj_completionyear'] = date('Y-m-d', strtotime($this->data['Project']['proj_completionyear']));
            else
                $this->request->data['Project']['proj_completionyear'] = NULL;


            $this->Project->create();

            if ($this->Project->save($this->request->data['Project'])) {

                $project_id = $this->Project->getLastInsertId();


                if ($project_id) {



                    /*                     * *******************Amenity************************ */
                    if ($this->data['Project']['is_amenity']) {

                        foreach ($this->data['Amenity']['amenity_id'] as $val) {
                            $save[] = array('Amenity' => array(
                                    'amenity_id' => $val,
                                    'created_by' => $user_id,
                                    'dummy_status' => $dummy_status,
                                    'project_id' => $project_id,
                            ));
                        }
                        $this->Amenity->saveMany($save);
                    }

                    /*                     * *******************Project Unit************************ */
                    if ($this->data['Project']['is_unit']) {

                        $this->request->data['ProjectUnit']['created_by'] = $user_id;
                        $this->request->data['ProjectUnit']['dummy_status'] = $dummy_status;
                        $this->request->data['ProjectUnit']['project_id'] = $project_id;
                        $this->ProjectUnit->save($this->request->data['ProjectUnit']);
                    }



                    /*                     * *******************Project Contacts************************ */
                    if ($this->data['Project']['is_contact']) {

                        $this->request->data['ProjectContact']['created_by'] = $user_id;
                        $this->request->data['ProjectContact']['dummy_status'] = $dummy_status;
                        $this->request->data['ProjectContact']['project_contact_project_id'] = $project_id;
                        $this->ProjectContact->save($this->request->data['ProjectContact']);
                    }

                    /*                     * *************************Next Action By logic********************** */

                    $action_user_id = '';
                    $oversing_user = array();


                    /*                     * *************************Project Action ********************** */
                    /*
                    $action_item['ActionItem']['project_id'] = $project_id;
                    $action_item['ActionItem']['action_item_level_id'] = '3'; //  for Project 
                    $action_item['ActionItem']['type_id'] = '7'; // 10 for Submission For Approval
                    $action_item['ActionItem']['action_industry'] = '1'; // for realestate of lookup_value_activity_industry
                    $action_item['ActionItem']['action_item_active'] = 'Yes';
                    $action_item['ActionItem']['action_item_status'] = '7'; //7 for Submitted For Approval table - lookup_value_action_item_statuses
                    $action_item['ActionItem']['description'] = 'New Project Record Created - Submission For Approval';
                    $action_item['ActionItem']['action_item_source'] = $role_id;
                    $action_item['ActionItem']['created_by_id'] = $user_id;
                    $action_item['ActionItem']['created_by'] = $user_id;
                    $action_item['ActionItem']['dummy_status'] = $dummy_status;
                    $action_item['ActionItem']['next_action_by'] = '148'; // system desk
                    $this->ActionItem->save($action_item);
                    $ActionId = $this->ActionItem->getLastInsertId();
                    $this->ActionItem->id = $ActionId;
                    $this->ActionItem->saveField('parent_action_item_id', $ActionId);

                    /*                     * ********************Project Remarks ******************************** */
                    /*
                    $remarks['Remark']['project_id'] = $project_id;
                    $remarks['Remark']['remarks'] = 'New Project Record Created';
                    $remarks['Remark']['remarks_by'] = $user_id;
                    $remarks['Remark']['created_by'] = $user_id;
                    $remarks['Remark']['remarks_time'] = date('g:i A');
                    $remarks['Remark']['remarks_level'] = '2'; //2 for project from lookup_value_remarks_level
                    $remarks['Remark']['dummy_status'] = $dummy_status;
                    $this->Remark->save($remarks);



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


                    $this->Session->setFlash('Project has been saved.', 'success');
                    $this->redirect(array('controller' => 'messages', 'action' => 'index', 'projects', 'my-projects'));
                }
            } else {
                $this->Session->setFlash('Unable to add Project.', 'failure');
            }
        }
        $city = $this->City->find('list', array('fields' => 'City.id, City.city_name', 'conditions' => array('City.dummy_status' => $dummy_status, 'City.city_status' => '1'), 'order' => 'City.city_name ASC'));
        $this->set('city', $city);

        $phase = $this->Phase->find('list', array('fields' => array('id', 'name')));
        $this->set(compact('phase'));

        $legal_approval = $this->LookupProjectLegalApproval->find('list', array('fields' => array('id', 'value')));
        $this->set(compact('legal_approval'));

        $constructions = $this->LookupProjectConstruction->find('list', array('fields' => array('id', 'value')));
        $this->set(compact('constructions'));

        $area_units = $this->LookupProjectLandAreaUnit->find('list', array('fields' => array('id', 'value')));
        $this->set(compact('area_units'));

        $distance_units = $this->LookupProjectLandmarkDistanceUnit->find('list', array('fields' => array('id', 'value')));
        $this->set(compact('distance_units'));

        $categories = $this->Category->find('list', array('fields' => array('id', 'name')));
        $this->set(compact('categories'));

        $qualities = $this->Quality->find('list', array('fields' => array('id', 'name')));
        $this->set(compact('qualities'));

        $qualities = $this->Quality->find('list', array('fields' => array('id', 'name')));
        $this->set(compact('qualities'));

        $marketings = $this->Marketing->find('list', array('fields' => array('id', 'name')));
        $this->set(compact('marketings'));

        $suburb = $this->Suburb->find('list', array('fields' => array('Suburb.id, Suburb.suburb_name'), 'conditions' => array('Suburb.dummy_status' => $dummy_status, 'Suburb.suburb_status' => '1'), 'order' => 'Suburb.suburb_name ASC'));
        $this->set('suburbs', $suburb);

        $areas = $this->Area->find('list', array('fields' => array('Area.id, Area.area_name'), 'conditions' => array('Area.dummy_status' => $dummy_status, 'Area.area_status' => '1'), 'order' => 'Area.area_name ASC'));
        $this->set('areas', $areas);

        $types = $this->ProjectType->find('list', array('fields' => 'ProjectType.id, ProjectType.name', 'order' => 'ProjectType.name ASC'));
        $this->set('types', $types);

        $marketing_partners = $this->MarketingPartner->find('list', array('fields' => 'MarketingPartner.id, MarketingPartner.marketing_partner_display_name', 'conditions' => array('MarketingPartner.dummy_status' => $dummy_status, 'MarketingPartner.marketing_partner_status' => '1'), 'order' => 'MarketingPartner.marketing_partner_display_name ASC'));
        $this->set('marketing_partners', $marketing_partners);


        $unit_type = $this->LookupValueProjectUnitType->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set('unit_type', $unit_type);



        $builders = $this->Builder->find('list', array('fields' => 'Builder.id, Builder.builder_name', 'conditions' => array('Builder.builder_approved' => '1', 'Builder.dummy_status' => $dummy_status), 'order' => 'Builder.builder_name ASC'));
        $this->set('builders', $builders);



        $builder_contact = $this->BuilderContact->find('list', array('fields' => 'BuilderContact.id, BuilderContact.builder_contact_name', 'order' => 'BuilderContact.builder_contact_name ASC'));
        $this->set('builder_contact', $builder_contact);

        $contact_status = $this->LookupProjectContactStatus->find('list', array('fields' => 'LookupProjectContactStatus.id, LookupProjectContactStatus.value', 'order' => 'LookupProjectContactStatus.value ASC'));
        $this->set('contact_status', $contact_status);


        $bank_finance = $this->LookupProjectBankFinance->find('list', array('fields' => 'LookupProjectBankFinance.id, LookupProjectBankFinance.value', 'order' => 'LookupProjectBankFinance.value ASC'));
        $this->set(compact('bank_finance'));

        $project_managed = $this->LookupProjectContactManagedBy->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('project_managed'));

        $projec_prepared = $this->LookupProjectContactPreparedBy->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('projec_prepared'));

        $projec_role = $this->LookupProjectContactProjectRole->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('projec_role'));

        $unit_qualifier1 = $this->LookupValueProjectUnitTypeQualifier_1->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('unit_qualifier1'));

        $unit_qualifier2 = $this->LookupValueProjectUnitTypeQualifier_2->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('unit_qualifier2'));

        $unit_qualifier3 = $this->LookupValueProjectUnitTypeQualifier_3->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('unit_qualifier3'));

        $unit_qualifier4 = $this->LookupValueProjectUnitTypeQualifier_4->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('unit_qualifier4'));

        $unit_qualifier5 = $this->LookupValueProjectUnitTypeQualifier_5->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('unit_qualifier5'));

        $marketing_status = $this->LookupValueMarketingStatus->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('marketing_status'));

        $attach_to = $this->LookupValueProjectAttache->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('attach_to'));

        $commission_event = $this->LookupUnitCommissionEvent->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('commission_event'));

        $based_on = $this->LookupUnitCommissionBasedOn->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('based_on'));

        $contact_managed = $this->LookupProjectContactManagedBy->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('contact_managed'));

        $groups = $this->Group->find('all');
        $this->set(compact('groups'));
    }

    function edit($id = null) {

        $user_id = $this->Auth->user('id');
        $role_id = $this->Session->read("role_id");
        $dummy_status = $this->Auth->user('dummy_status');
        $condition_dummy_status = array('dummy_status =' . $dummy_status, 'id != 1');

        $actio_itme_id = '';
        $screen_position = '';
        $flag = 0;
        $arr = explode('_', $id);
        $id = base64_decode($arr[0]);
        if (count($arr) > 1) {
            $actio_itme_id = $arr[1];
            $screen_no = $this->ActionItem->find('first', array('conditions' => array('ActionItem.id' => $actio_itme_id), 'fields' => array('ActionItem.screen_no')));
            $screen_position = $screen_no['ActionItem']['screen_no'];
            $flag = 1;
        }
        $this->set(compact('screen_position'));
        $this->set(compact('actio_itme_id'));


        if (!$id) {
            throw new NotFoundException(__('Invalid Project'));
        }

        $project = $this->Project->findById($id);

        /*
          if($project['Project']['proj_active_primary'] == 0)
          $this->Project->updateAll(array('Project.proj_active_primary' => "2"),array('Project.id' => $id));
          if($project['Project']['proj_active_details'] == 0)
          $this->Project->updateAll(array('Project.proj_active_details' => "2"),array('Project.id' => $id));
          if($project['Project']['proj_active_amenities'] == 0)
          $this->Project->updateAll(array('Project.proj_active_amenities' => "2"),array('Project.id' => $id));
         */

        if (!$project) {
            throw new NotFoundException(__('Invalid Project'));
        }

        if ($this->request->data) {

            $this->Project->id = $id;
            $page_info = '';

            if ($this->data['Project']['proj_completionyear'] <> '')
                $this->request->data['Project']['proj_completionyear'] = date('Y-m-d', strtotime($this->data['Project']['proj_completionyear']));
            else
                $this->request->data['Project']['proj_completionyear'] = NULL;

            //$this->request->data['Project']['proj_approved'] = '2';
            /*
              $this->request->data['Project']['proj_active_primary'] = '0';
              $this->request->data['Project']['proj_active_details'] = '0';
              $this->request->data['Project']['proj_active_amenities'] = '0';
             */


            /*             * *************************Project Action ********************** */
            $action_item['ActionItem']['project_id'] = $id;
            $action_item['ActionItem']['action_item_level_id'] = '3'; //  for Project
            $action_item['ActionItem']['type_id'] = '10'; // 10 for Re-Submission For Approval
            $action_item['ActionItem']['next_action_by'] = '148'; // system desk
            $action_item['ActionItem']['action_item_active'] = 'Yes';
            $action_item['ActionItem']['action_item_status'] = '17'; //1 for created table - lookup_value_action_item_statuses
            $action_item['ActionItem']['description'] = 'Project Record Updated - Re-Submission For Approval';
            $action_item['ActionItem']['action_item_source'] = $role_id;
            $action_item['ActionItem']['created_by_id'] = $user_id;
            $action_item['ActionItem']['created_by'] = $user_id;
            $action_item['ActionItem']['dummy_status'] = $dummy_status;
            $action_item['ActionItem']['parent_action_item_id'] = $actio_itme_id;
            $action_item['ActionItem']['action_industry'] = '1'; // for realestate of lookup_value_activity_industry

            /*             * ********************Project Remarks ******************************** */
            $remarks['Remark']['project_id'] = $id;
            $remarks['Remark']['remarks'] = 'Edit Project Record';
            $remarks['Remark']['remarks_by'] = $user_id;
            $remarks['Remark']['created_by'] = $user_id;
            $remarks['Remark']['remarks_time'] = date('g:i A');
            $remarks['Remark']['remarks_level'] = '2'; //2 for project from lookup_value_remarks_level
            $remarks['Remark']['dummy_status'] = $dummy_status;

            /*             * *******************Amenity************************ */
            if ($this->data['Project']['action_type'] == '3') {

                if (count($this->data['Amenity']['amenity_id']) > 0 && !empty($this->data['Amenity']['amenity_id'])) {
                    $this->Amenitie->deleteAll(array('Amenitie.project_id' => $id)); // delete project amenity by project id

                    foreach ($this->data['Amenity']['amenity_id'] as $val) {
                        $save[] = array('Amenity' => array(
                                'amenity_id' => $val,
                                'created_by' => $user_id,
                                'dummy_status' => $dummy_status,
                                'project_id' => $id,
                        ));
                    }
                    $this->request->data['Project']['proj_active_amenities'] = '1';
                    $action_item['ActionItem']['screen_no'] = 'SC-4';
                    $page_info = 'amenity';
                } else {

                    $this->Amenitie->deleteAll(array('Amenitie.project_id' => $id));
                    $this->Project->save($this->request->data['Project']);
                    $this->set('action_type', $this->data['Project']['action_type']);
                    $action_item['ActionItem']['screen_no'] = 'SC-4';
                }
            }



            if ($this->data['Project']['action_type'] == '0') {
                $action_item['ActionItem']['screen_no'] = 'SC-1';
                $this->request->data['Project']['proj_active_primary'] = '1';
                $page_info = 'project';
            }
            if ($this->data['Project']['action_type'] == '1') {
                $this->request->data['Project']['proj_active_details'] = '1';
                $action_item['ActionItem']['screen_no'] = 'SC-2';
                $page_info = 'project';
            }

            if ($page_info == 'project') {
                $this->Project->save($this->request->data['Project']);
                $this->set('action_type', $this->data['Project']['action_type']);
            }

            if ($page_info == 'amenity') {
                $this->Amenity->saveMany($save);
                $this->Project->save($this->request->data['Project']);
                $this->set('action_type', $this->data['Project']['action_type']);
            }

            $this->Remark->save($remarks);

            //  $this->ActionItem->query("INSERT INTO `action_items` (`action_item_level_id`, `type_id`, `project_id`, `action_item_status`, `action_item_source`, `created_by_id`, `action_item_active`,  `description`, `next_action_by`,  `created_by`,`dummy_status`,`created`) VALUES ('" . $action_item['ActionItem']['action_item_level_id'] . "', '" . $action_item['ActionItem']['type_id'] . "', '" . $action_item['ActionItem']['project_id'] . "', '" . $action_item['ActionItem']['action_item_status'] . "', '" . $action_item['ActionItem']['action_item_source'] . "', '" . $action_item['ActionItem']['created_by_id'] . "', '" . $action_item['ActionItem']['action_item_active'] . "', '" . $action_item['ActionItem']['description'] . "', '" . $action_item['ActionItem']['next_action_by'] . "', '" . $action_item['ActionItem']['created_by'] . "', '" . $action_item['ActionItem']['dummy_status'] . "','" . date('Y-m-d h:i:s') . "')");
            //$ActionId1 = $this->ActionItem->query("SELECT LAST_INSERT_ID()");
            //$last_id = $ActionId1[0][0]['LAST_INSERT_ID()'];
            //$this->ActionItem->updateAll(array('ActionItem.parent_action_item_id' => $last_id), array('ActionItem.id' => $last_id));


            $this->ActionItem->save($action_item);
            $ActionId = $this->ActionItem->getLastInsertId();
            $this->ActionItem->id = $ActionId;
            $this->ActionItem->saveField('parent_action_item_id', $ActionId);
            if ($actio_itme_id) {
                $this->ActionItem->saveField('parent_action_item_id', $actio_itme_id);
                $this->ActionItem->updateAll(array('ActionItem.action_item_active' => "'No'"), array('ActionItem.id' => $actio_itme_id));
                $this->Session->setFlash('Project has been Re-submitted.', 'success');
            }
            $this->Session->setFlash('Your changes have been submitted. Waiting for approval at the moment...', 'success');
            if ($flag == 1)
                $this->redirect(array('controller' => 'action-items', 'action' => 'index'));
            /* else
              $this->redirect(array('controller' => 'messages','action' => 'index','projects','my-projects')); */
        }


        $city = $this->City->find('list', array('fields' => 'City.id, City.city_name', 'conditions' => array('City.dummy_status' => $dummy_status, 'City.city_status' => '1'), 'order' => 'City.city_name ASC'));
        $this->set('city', $city);

        $status = $this->LookupValueStatus->find('list', array('fields' => array('id', 'value')));
        $this->set(compact('status'));

        $amenity = $this->Amenity->find('list', array('fields' => array('amenity_id', 'amenity_id'), 'conditions' => array('project_id' => $id)));
        $this->set(compact('amenity'));

        $suburb = $this->Suburb->find('list', array('fields' => 'Suburb.id, Suburb.suburb_name', 'conditions' => array('Suburb.dummy_status' => $dummy_status, 'Suburb.suburb_status' => '1'), 'order' => 'Suburb.suburb_name ASC'));
        $this->set('suburbs', $suburb);



        $marketing_status = $this->LookupValueMarketingStatus->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('marketing_status'));

        $phase = $this->Phase->find('list', array('fields' => array('id', 'name')));
        $this->set(compact('phase'));

        $categories = $this->Category->find('list', array('fields' => array('id', 'name')));
        $this->set(compact('categories'));

        $legal_approval = $this->LookupProjectLegalApproval->find('list', array('fields' => array('id', 'value')));
        $this->set(compact('legal_approval'));

        $constructions = $this->LookupProjectConstruction->find('list', array('fields' => array('id', 'value')));
        $this->set(compact('constructions'));

        $bank_finance = $this->LookupProjectBankFinance->find('list', array('fields' => 'LookupProjectBankFinance.id, LookupProjectBankFinance.value', 'order' => 'LookupProjectBankFinance.value ASC'));
        $this->set(compact('bank_finance'));

        $qualities = $this->Quality->find('list', array('fields' => array('id', 'name')));
        $this->set(compact('qualities'));

        $area_units = $this->LookupProjectLandAreaUnit->find('list', array('fields' => array('id', 'value')));
        $this->set(compact('area_units'));

        $distance_units = $this->LookupProjectLandmarkDistanceUnit->find('list', array('fields' => array('id', 'value')));
        $this->set(compact('distance_units'));

        $marketings = $this->Marketing->find('list', array('fields' => array('id', 'name')));
        $this->set(compact('marketings'));

        $marketing_partners = $this->MarketingPartner->find('list', array('fields' => 'MarketingPartner.id, MarketingPartner.marketing_partner_display_name', 'conditions' => array('MarketingPartner.dummy_status' => $dummy_status, 'MarketingPartner.marketing_partner_status' => '1'), 'order' => 'MarketingPartner.marketing_partner_display_name ASC'));
        $this->set('marketing_partners', $marketing_partners);

        $codes = $this->LookupValueLeadsCountry->find('all', array('fields' => array('LookupValueLeadsCountry.id', 'LookupValueLeadsCountry.value', 'LookupValueLeadsCountry.code')));
        $codes = Set::combine($codes, '{n}.LookupValueLeadsCountry.id', array('%s: %s', '{n}.LookupValueLeadsCountry.value', '{n}.LookupValueLeadsCountry.code'));
        $this->set(compact('codes'));

        $types = $this->ProjectType->find('list', array('fields' => 'ProjectType.id, ProjectType.name', 'order' => 'ProjectType.name ASC'));
        $this->set('types', $types);

        $areas = $this->Area->find('list', array('fields' => 'Area.id, Area.area_name', 'conditions' => array('Area.dummy_status' => $dummy_status, 'Area.area_status' => '1'), 'order' => 'Area.area_name ASC'));
        $this->set('areas', $areas);


        $builders = $this->Builder->find('list', array('fields' => 'Builder.id, Builder.builder_name', 'conditions' => array('Builder.builder_approved' => '1', 'Builder.dummy_status' => $dummy_status), 'order' => 'Builder.builder_name ASC'));
        $this->set('builders', $builders);

        $bank_finance = $this->LookupProjectBankFinance->find('list', array('fields' => 'LookupProjectBankFinance.id, LookupProjectBankFinance.value', 'order' => 'LookupProjectBankFinance.value ASC'));
        $this->set(compact('bank_finance'));

        $project_managed = $this->LookupProjectContactManagedBy->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('project_managed'));

        $projec_prepared = $this->LookupProjectContactPreparedBy->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('projec_prepared'));

        $projec_role = $this->LookupProjectContactProjectRole->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('projec_role'));

        $project_legal_names = $this->ProjectLegalName->find('all', array('conditions' => array('ProjectLegalName.project_legal_names_project_id' => $id, 'ProjectLegalName.project_legal_names_status' => 1), 'order' => 'ProjectLegalName.id ASC'));
        $this->set(compact('project_legal_names'));

        $builder_contacts = $this->BuilderContact->find('all');
        $this->set('builder_contacts', $builder_contacts);

        $builder_agreements = $this->BuilderAgreement->find('all');
        $this->set('builder_agreements', $builder_agreements);

        $groups = $this->Group->find('all');
        $this->set(compact('groups'));

        $unit_type = $this->LookupValueProjectUnitPreference->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set('unit_type', $unit_type);

        $this->request->data = $project;
    }

    function view($id = null) {

        $arr = explode('_', $id);
        $id = base64_decode($arr[0]);
        $dummy_status = $this->Auth->user('dummy_status');

        if (!$id) {
            throw new NotFoundException(__('Invalid Project'));
        }

        $project = $this->Project->findById($id);

        if (!$project) {
            throw new NotFoundException(__('Invalid Project'));
        }

        $suburbs = $this->Project->Suburb->find('all', array('conditions' => array('Suburb.dummy_status' => $dummy_status, 'Suburb.suburb_status' => '1'), 'order' => 'Suburb.suburb_name ASC'));
        $arrSuburb = array();
        if (count($suburbs) > 0) {
            foreach ($suburbs as $suburb) {
                $arrSuburb[$suburb['Suburb']['id']] = $suburb['Suburb']['suburb_name'];
            }
        }
        $this->set('suburbs', $arrSuburb);

        $amenities = $this->Amenitie->find('all', array('fields' => array('Group.group_name', 'Group.id', 'Amenitie.id', 'GROUP_CONCAT(LookupValueAmenitie.amenity_name separator " , ") AS amenity_name'),
            'joins' => array(
                array(
                    'table' => 'lookup_value_amenities',
                    'alias' => 'LookupValueAmenitie',
                    'conditions' => array(
                        'Amenitie.amenity_id = LookupValueAmenitie.id')
                ),
                array(
                    'table' => 'groups',
                    'alias' => 'Group',
                    'conditions' => array(
                        'LookupValueAmenitie.group_id = Group.id'
                    )
                )
            ),
            'conditions' => 'Amenitie.project_id =' . $id,
            'order' => 'Amenitie.amenity_id ASC',
            'group' => array('LookupValueAmenitie.group_id')
        ));

        $this->set(compact('amenities'));

        $units = $this->ProjectUnit->find('all', array(
            'conditions' => array('ProjectUnit.project_id =' . $id)
            , 'order' => 'ProjectUnit.unit_type ASC'));
        $this->set(compact('units'));



        $this->request->data = $project;
    }

    public function add_unit($project_id = null) {

        $this->layout = 'ajax';
        $user_id = $this->Auth->user('id');
        $role_id = $this->Session->read("role_id");
        $dummy_status = $this->Auth->user('dummy_status');

        if ($this->request->is('post') || $this->request->is('put')) {

            $this->request->data['ProjectUnit']['created_by'] = $user_id;
            $this->request->data['ProjectUnit']['dummy_status'] = $dummy_status;
            $this->request->data['ProjectUnit']['project_id'] = $project_id;
            $this->request->data['ProjectUnit']['unit_status'] = '1'; // 1 for Yes of lookup_value_statuses
            $this->request->data['ProjectUnit']['unit_approved'] = '2'; // 2 for No of lookup_value_statuses
            $this->request->data['ProjectUnit']['unit_cost_currency'] = 'INR';


            $this->ProjectUnit->set($this->data);
            if ($this->ProjectUnit->validates() == true) {

                if ($this->ProjectUnit->save($this->request->data)) {

                    $project_unit_id = $this->ProjectUnit->getLastInsertId();

                    /*                     * *********************Unit Remarks ******************************** */
                    $remarks['Remark']['project_unit_id'] = $project_unit_id;
                    $remarks['Remark']['remarks'] = 'Project unit  Record Created - Submission For Approval';
                    $remarks['Remark']['remarks_by'] = $user_id;
                    $remarks['Remark']['created_by'] = $user_id;
                    $remarks['Remark']['remarks_time'] = date('g:i A');
                    $remarks['Remark']['remarks_level'] = '6'; //6 for Project Unit from lookup_value_remarks_level
                    $remarks['Remark']['dummy_status'] = $dummy_status;
                    $this->Remark->save($remarks);

                    /*                     * *******************Unit Action************************ */


                    $ActionItem['ActionItem']['project_unit_id'] = $project_unit_id;
                    $ActionItem['ActionItem']['action_item_level_id'] = '11'; //  for Project Units tabel of action_item_level
                    $ActionItem['ActionItem']['type_id'] = '7'; // 7 for Submission For Approval
                    $ActionItem['ActionItem']['next_action_by'] = '136'; // overser
                    $ActionItem['ActionItem']['action_item_active'] = 'Yes';
                    $ActionItem['ActionItem']['action_item_status'] = '7'; //7 for Submitted For Approval table - lookup_value_action_item_statuses
                    $ActionItem['ActionItem']['description'] = 'Project Unit  Record Created - Submission For Approval';
                    $ActionItem['ActionItem']['action_item_source'] = $role_id;
                    $ActionItem['ActionItem']['created_by_id'] = $user_id;
                    $ActionItem['ActionItem']['created_by'] = $user_id;
                    $ActionItem['ActionItem']['dummy_status'] = $dummy_status;
                    $ActionItem['ActionItem']['action_industry'] = '1'; // for realestate of lookup_value_activity_industry

                    if ($this->ActionItem->save($ActionItem)) {
                        $ActionId = $this->ActionItem->getLastInsertId();
                        $this->ActionItem->id = $ActionId;
                        $this->ActionItem->saveField('parent_action_item_id', $ActionId);
                    }

                    $this->Session->setFlash('Your changes have been submitted. Waiting for approval at the moment...', 'success');
                    echo '<script>
				 			var objP=parent.document.getElementsByClassName("mfp-bg");
							var objC=parent.document.getElementsByClassName("mfp-wrap");
							objP[0].style.display="none";
							objC[0].style.display="none";
							parent.location.reload(true);</script>';
                }
                else
                    $this->Session->setFlash('Unable to add project unit.', 'failure');
            }
        }

        $unit_type = $this->LookupValueProjectUnitPreference->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set('unit_type', $unit_type);

        $unit_qualifier1 = $this->LookupValueProjectUnitTypeQualifier_1->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('unit_qualifier1'));

        $unit_qualifier2 = $this->LookupValueProjectUnitTypeQualifier_2->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('unit_qualifier2'));

        $unit_qualifier3 = $this->LookupValueProjectUnitTypeQualifier_3->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('unit_qualifier3'));

        $unit_qualifier4 = $this->LookupValueProjectUnitTypeQualifier_4->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('unit_qualifier4'));

        $unit_qualifier5 = $this->LookupValueProjectUnitTypeQualifier_5->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('unit_qualifier5'));

        $based_on = $this->LookupUnitCommissionBasedOn->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('based_on'));

        $attach_to = $this->LookupValueProjectAttache->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('attach_to'));

        $commission_event = $this->LookupUnitCommissionEvent->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('commission_event'));

        $projects = $this->Project->find('list', array('fields' => array('id', 'project_name'), 'conditions' => array('id' => $project_id), 'order' => 'project_name asc'));
        $this->set('projects', $projects);

        //$this->set(compact('project_id'));
    }

    public function edit_unit($id = null) {

        $this->layout = 'ajax';
        $user_id = $this->Auth->user('id');
        $dummy_status = $this->Auth->user('dummy_status');
        $role_id = $this->Session->read("role_id");
        $actio_itme_id = '';
  
        $arr = explode('_', $id);
        $id = $arr[0];
        if (count($arr) > 1) {
            $actio_itme_id = $arr[1];
            
        }
        /*
         * To catch an array of project unit by project unit Id.
         */
        $ProjectUnit = $this->ProjectUnit->findById($id);

        if ($this->request->is('post') || $this->request->is('put')) {

            $this->request->data['ProjectUnit']['unit_approved'] = '2'; // 2 for No of lookup_value_statuses

            /*             * *************************Builder Action ********************** */
            $action_item['ActionItem']['project_unit_id'] = $id;
            $action_item['ActionItem']['action_item_level_id'] = '11'; //  for Project Unit
            $action_item['ActionItem']['type_id'] = '10'; // 10 for Re-Submission For Approval
            $action_item['ActionItem']['next_action_by'] = '136'; // Overseer
            $action_item['ActionItem']['action_item_active'] = 'Yes';
            $action_item['ActionItem']['action_item_status'] = '17'; //17 for Change Submitted table - lookup_value_action_item_statuses
            $action_item['ActionItem']['description'] = 'Project Contact Record Updated - Re-Submission For Approval';
            $action_item['ActionItem']['action_item_source'] = $role_id;
            $action_item['ActionItem']['created_by_id'] = $user_id;
            $action_item['ActionItem']['created_by'] = $user_id;
            $action_item['ActionItem']['dummy_status'] = $dummy_status;
            $action_item['ActionItem']['parent_action_item_id'] = $actio_itme_id;
            $action_item['ActionItem']['action_industry'] = '1'; // for realestate of lookup_value_activity_industry



            /*             * *********************Builder Remarks ******************************** */
            $remarks['Remark']['project_unit_id'] = $id;
            $remarks['Remark']['remarks'] = 'Edit Project Unit Contact Record';
            $remarks['Remark']['remarks_by'] = $user_id;
            $remarks['Remark']['created_by'] = $user_id;
            $remarks['Remark']['remarks_time'] = date('g:i A');
            $remarks['Remark']['remarks_level'] = '6'; //4 for builder contact from lookup_value_remarks_level
            $remarks['Remark']['dummy_status'] = $dummy_status;
            $this->Remark->save($remarks);

            $this->ProjectUnit->set($this->data);
            $this->ProjectUnit->id = $id;
            if ($this->ProjectUnit->validates() == true) {

                if ($this->ProjectUnit->save($this->request->data)) {
                    
                $this->ActionItem->save($action_item);
                $ActionId = $this->ActionItem->getLastInsertId();
                $this->ActionItem->id = $ActionId;
                $this->ActionItem->saveField('parent_action_item_id', $ActionId);
                if ($actio_itme_id) {
                    $this->ActionItem->saveField('parent_action_item_id', $actio_itme_id);
                    $this->ActionItem->updateAll(array('ActionItem.action_item_active' => "'No'"), array('ActionItem.id' => $actio_itme_id));
                }

                $this->Session->setFlash('Your changes have been submitted. Waiting for approval at the moment...', 'success');

                    echo '<script>
                            var objP=parent.document.getElementsByClassName("mfp-bg");
                            var objC=parent.document.getElementsByClassName("mfp-wrap");
                            objP[0].style.display="none";
                            objC[0].style.display="none";
                            parent.location.reload(true);
                          </script>';
                }
                else
                    $this->Session->setFlash('Unable to add project unit.', 'failure');
            }
        }

        $unit_type = $this->LookupValueProjectUnitPreference->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set('unit_type', $unit_type);

        $unit_qualifier1 = $this->LookupValueProjectUnitTypeQualifier_1->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('unit_qualifier1'));

        $unit_qualifier2 = $this->LookupValueProjectUnitTypeQualifier_2->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('unit_qualifier2'));

        $unit_qualifier3 = $this->LookupValueProjectUnitTypeQualifier_3->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('unit_qualifier3'));

        $unit_qualifier4 = $this->LookupValueProjectUnitTypeQualifier_4->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('unit_qualifier4'));

        $unit_qualifier5 = $this->LookupValueProjectUnitTypeQualifier_5->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('unit_qualifier5'));

        $based_on = $this->LookupUnitCommissionBasedOn->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('based_on'));

        $attach_to = $this->LookupValueProjectAttache->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('attach_to'));

        $commission_event = $this->LookupUnitCommissionEvent->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('commission_event'));

        $projects = $this->Project->find('list', array('fields' => array('id', 'project_name'), 'conditions' => array('id' => $ProjectUnit['ProjectUnit']['project_id']), 'order' => 'project_name asc'));
        $this->set('projects', $projects);

        if (!$this->request->data) {
            $this->request->data = $ProjectUnit;
        }
    }
    
    public function view_unit($id = null) {

        $this->layout = 'ajax';
        $user_id = $this->Auth->user('id');
        $dummy_status = $this->Auth->user('dummy_status');
        /*
         * To catch an array of project unit by project unit Id.
         */
        $ProjectUnit = $this->ProjectUnit->findById($id);

        if (!$this->request->data) {
            $this->request->data = $ProjectUnit;
        }
    }

    public function add_contact($project_id = null) {

        $this->layout = 'ajax';
        $user_id = $this->Auth->user('id');
        $role_id = $this->Session->read("role_id");
        $dummy_status = $this->Auth->user('dummy_status');

        /*
         * To catch an array of project by Id.
         */
        $Project = $this->Project->findById($project_id);

        if ($this->request->is('post') || $this->request->is('put')) {

            $this->request->data['ProjectContact']['created_by'] = $user_id;
            $this->request->data['ProjectContact']['dummy_status'] = $dummy_status;
            $this->request->data['ProjectContact']['project_contact_project_id'] = $project_id;
            $this->request->data['ProjectContact']['project_contact_status'] = '1'; // 1 for Yes of lookup_value_statuses
            $this->request->data['ProjectContact']['project_contact_approved'] = '2'; // 2 for No of lookup_value_statuses

            $this->request->data['ProjectContact']['project_contact_prepared_by'] = $user_id;
            $this->request->data['ProjectContact']['project_contact_managed_by'] = $user_id;

            if ($role_id == '15') { // accounts
                $this->request->data['ProjectContact']['builder_contact_intiated_by_id'] = '4';
                $this->request->data['ProjectContact']['project_contact_managed_by_id'] = '4';
            } else if ($role_id == '21') { // legal
                $this->request->data['ProjectContact']['project_contact_prepared_by_id'] = '3';
                $this->request->data['ProjectContact']['project_contact_managed_by_id'] = '3';
            } else if ($role_id == '7') { // Transaction manager 
                $this->request->data['ProjectContact']['project_contact_prepared_by_id'] = '1';
                $this->request->data['ProjectContact']['project_contact_managed_by_id'] = '1';
            } else if ($role_id == '11') { //  
                $this->request->data['ProjectContact']['project_contact_prepared_by_id'] = '2';
                $this->request->data['ProjectContact']['project_contact_managed_by_id'] = '2';
            } else if ($role_id == '3' || $role_id == '24') { // system data, administrator
                $this->request->data['ProjectContact']['project_contact_prepared_by_id'] = '5';
                $this->request->data['ProjectContact']['project_contact_managed_by_id'] = '6';
            }


            $this->ProjectContact->set($this->data);
            if ($this->ProjectContact->validates() == true) {

                if ($this->ProjectContact->save($this->request->data)) {

                    $project_conatct_id = $this->ProjectContact->getLastInsertId();

                    /*                     * *********************Unit Remarks ******************************** */
                    $remarks['Remark']['project_contact_id'] = $project_conatct_id;
                    $remarks['Remark']['remarks'] = 'Project Conact  Record Created - Submission For Approval';
                    $remarks['Remark']['remarks_by'] = $user_id;
                    $remarks['Remark']['created_by'] = $user_id;
                    $remarks['Remark']['remarks_time'] = date('g:i A');
                    $remarks['Remark']['remarks_level'] = '5'; //5 for Project Contact from lookup_value_remarks_level
                    $remarks['Remark']['dummy_status'] = $dummy_status;
                    $this->Remark->save($remarks);

                    /*                     * *******************Unit Action************************ */


                    $ActionItem['ActionItem']['project_contact_id'] = $project_conatct_id;
                    $ActionItem['ActionItem']['action_item_level_id'] = '7'; //  for Project Conatct tabel of action_item_level
                    $ActionItem['ActionItem']['type_id'] = '7'; // 7 for Submission For Approval
                    $ActionItem['ActionItem']['next_action_by'] = '148'; // system desk
                    $ActionItem['ActionItem']['action_item_active'] = 'Yes';
                    $ActionItem['ActionItem']['action_item_status'] = '7'; //7 for Submitted For Approval table - lookup_value_action_item_statuses
                    $ActionItem['ActionItem']['description'] = 'Project Conatct  Record Created - Submission For Approval';
                    $ActionItem['ActionItem']['action_item_source'] = $role_id;
                    $ActionItem['ActionItem']['created_by_id'] = $user_id;
                    $ActionItem['ActionItem']['created_by'] = $user_id;
                    $ActionItem['ActionItem']['dummy_status'] = $dummy_status;
                    $ActionItem['ActionItem']['action_industry'] = '1'; // for realestate of lookup_value_activity_industry

                    if ($this->ActionItem->save($ActionItem)) {
                        $ActionId = $this->ActionItem->getLastInsertId();
                        $this->ActionItem->id = $ActionId;
                        $this->ActionItem->saveField('parent_action_item_id', $ActionId);

                        $actionArry = $this->ActionItem->findById($ActionId);
                        $ProjectContact = $this->ProjectContact->findById($actionArry['ActionItem']['project_contact_id']);

                        $Email = new CakeEmail();

                        $Email->viewVars(array(
                            'NextActionBy' => strtoupper($actionArry['NextActionBy']['fname'] . ' ' . $actionArry['NextActionBy']['lname']),
                            'ProjectName' => strtoupper($ProjectContact['Project']['project_name']),
                            'BuilderName' => strtoupper($ProjectContact['Builder']['builder_name']),
                            'ContactName' => strtoupper($ProjectContact['BuilderContact']['builder_contact_name']),
                            'Mobile' => strtoupper($ProjectContact['PrimaryMobileCountry']['code'] . ' ' . $ProjectContact['BuilderContact']['builder_contact_mobile_no']),
                            'ContactEmail' => strtoupper($ProjectContact['BuilderContact']['builder_contact_email']),
                            'Location' => strtoupper($ProjectContact['Location']['city_name']),
                            'ContactLevel' => strtoupper($ProjectContact['Level']['value']),
                            'Designation' => strtoupper($ProjectContact['BuilderContact']['builder_contact_designation']),
                            'ForCompany' => strtoupper($ProjectContact['ForCompany']['value']),
                            'ForCompanyCity' => strtoupper($ProjectContact['ForCompanyCity']['city_name']),
                        ));

                        $to = 'infra@sumanus.com';
                        //$to = 'biswajit@wtbglobal.com';
                        $Email->template('ProjectContacts/Add', 'default')->emailFormat('html')->to($to)->from('admin@silkrouters.com')->subject('PROJECT CONTACT SUBMITTED BY - ' . strtoupper($actionArry['CreatedBy']['fname'] . ' ' . $actionArry['CreatedBy']['lname']))->send();
                    }

                    $this->Session->setFlash('Your changes have been submitted. Waiting for approval at the moment...', 'success');
                    echo '<script>
				 			var objP=parent.document.getElementsByClassName("mfp-bg");
							var objC=parent.document.getElementsByClassName("mfp-wrap");
							objP[0].style.display="none";
							objC[0].style.display="none";
							parent.location.reload(true);</script>';
                }
                else
                    $this->Session->setFlash('Unable to add project conact.', 'failure');
            }
        }

        $project_role = $this->LookupProjectContactProjectRole->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('project_role'));

        $projects = $this->Project->find('list', array('fields' => array('id', 'project_name'), 'conditions' => array('id' => $project_id), 'order' => 'project_name asc'));
        $this->set('projects', $projects);


        $contacts = $this->BuilderContact->find('all', array('fields' => array('BuilderContact.id', 'BuilderContact.builder_contact_name', 'BuilderContact.builder_contact_designation'), 'conditions' => array('BuilderContact.builder_contact_approved' => 1, 'BuilderContact.builder_contact_builder_id' => $Project['Project']['builder_id']),
            'order' => 'BuilderContact.builder_contact_name asc'));

        $contacts = Set::combine($contacts, '{n}.BuilderContact.id', array('%s, %s', '{n}.BuilderContact.builder_contact_name', '{n}.BuilderContact.builder_contact_designation'));
        $this->set(compact('contacts'));

        $builder = $this->Builder->find('list', array('fields' => array('id', 'builder_name'), 'conditions' => array('id' => array($Project['Project']['builder_id'], $Project['Project']['secondary_builder_id'], $Project['Project']['tertiary_builder_id']))));
        $this->set(compact('builder'));

        //$this->set(compact('project_id'));
    }

    public function edit_contact($id = null) {

        $this->layout = 'ajax';
        $user_id = $this->Auth->user('id');
        $role_id = $this->Session->read("role_id");
        $dummy_status = $this->Auth->user('dummy_status');
        $actio_itme_id = '';

        $arr = explode('_', $id);
        $id = $arr[0];
        if (count($arr) > 1) {
            $actio_itme_id = $arr[1];
        }

        /*
         * To catch an array of project unit by project unit Id.
         */
        $ProjectContact = $this->ProjectContact->findById($id);
        $Project = $this->Project->findById($ProjectContact['ProjectContact']['project_contact_project_id']);

        if ($this->request->is('post') || $this->request->is('put')) {

            $this->request->data['ProjectContact']['project_contact_approved'] = '2'; // 2 for No of lookup_value_statuses
            //$this->request->data['ProjectContact']['project_contact_project_id'] =  $ProjectContact['ProjectContact']['project_contact_project_id'];


            /*             * ************************Builder Action ********************** */
            $action_item['ActionItem']['project_contact_id'] = $id;
            $action_item['ActionItem']['action_item_level_id'] = '7'; //  for Project Contact
            $action_item['ActionItem']['type_id'] = '10'; // 10 for Re-Submission For Approval
            $action_item['ActionItem']['next_action_by'] = '148'; // system desk
            $action_item['ActionItem']['action_item_active'] = 'Yes';
            $action_item['ActionItem']['action_item_status'] = '17'; //17 for Change Submitted table - lookup_value_action_item_statuses
            $action_item['ActionItem']['description'] = 'Project Contact Record Updated - Re-Submission For Approval';
            $action_item['ActionItem']['action_item_source'] = $role_id;
            $action_item['ActionItem']['created_by_id'] = $user_id;
            $action_item['ActionItem']['created_by'] = $user_id;
            $action_item['ActionItem']['dummy_status'] = $dummy_status;
            $action_item['ActionItem']['parent_action_item_id'] = $actio_itme_id;
            $action_item['ActionItem']['action_industry'] = '1'; // for realestate of lookup_value_activity_industry

            /*             * ********************Builder Remarks ******************************** */
            $remarks['Remark']['project_contact_id'] = $id;
            $remarks['Remark']['remarks'] = 'Edit Project Contact Record';
            $remarks['Remark']['remarks_by'] = $user_id;
            $remarks['Remark']['created_by'] = $user_id;
            $remarks['Remark']['remarks_time'] = date('g:i A');
            $remarks['Remark']['remarks_level'] = '5'; //5 for Project Contact from lookup_value_remarks_level
            $remarks['Remark']['dummy_status'] = $dummy_status;
            $this->Remark->save($remarks);

            //$this->ProjectContact->set($this->data);
            $this->ProjectContact->id = $id;
            if ($this->ProjectContact->validates() == true) {

                if ($this->ProjectContact->save($this->request->data)) {

                    $this->ActionItem->query("INSERT INTO `action_items` (`action_item_level_id`, `type_id`, `project_contact_id`, `action_item_status`, `action_item_source`, `created_by_id`, `action_item_active`,  `description`, `next_action_by`,  `created_by`,`dummy_status`,`created`) VALUES ('" . $action_item['ActionItem']['action_item_level_id'] . "', '" . $action_item['ActionItem']['type_id'] . "', '" . $action_item['ActionItem']['project_contact_id'] . "', '" . $action_item['ActionItem']['action_item_status'] . "', '" . $action_item['ActionItem']['action_item_source'] . "', '" . $action_item['ActionItem']['created_by_id'] . "', '" . $action_item['ActionItem']['action_item_active'] . "', '" . $action_item['ActionItem']['description'] . "', '" . $action_item['ActionItem']['next_action_by'] . "', '" . $action_item['ActionItem']['created_by'] . "', '" . $action_item['ActionItem']['dummy_status'] . "','" . date('Y-m-d h:i:s') . "')");

                    $ActionId1 = $this->ActionItem->query("SELECT LAST_INSERT_ID()");
                    $last_id = $ActionId1[0][0]['LAST_INSERT_ID()'];

                    $this->ActionItem->updateAll(array('ActionItem.parent_action_item_id' => $last_id), array('ActionItem.id' => $last_id));

                    //	$this->ActionItem->save($action_item);
                    //	$ActionId = $this->ActionItem->getLastInsertId();
                    //	$this->ActionItem->id = $ActionId;
                    //$this->ActionItem->updateAll(array('ActionItem.parent_action_item_id' => $ActionId),array('ActionItem.id' => $ActionId));
                    //	$this->ActionItem->saveField('parent_action_item_id' , $ActionId);
                    if ($actio_itme_id) {
                        //$this->ActionItem->id = $last_id;
                        //$this->ActionItem->saveField('parent_action_item_id' , $actio_itme_id);
                        $this->ActionItem->updateAll(array('ActionItem.parent_action_item_id' => $actio_itme_id), array('ActionItem.id' => $last_id));
                        $this->ActionItem->updateAll(array('ActionItem.action_item_active' => "'No'"), array('ActionItem.id' => $actio_itme_id));
                    }

                    //	 $log = $this->ActionItem->getDataSource()->getLog(false, false);       
                    //	 debug($log);

                    $this->Session->setFlash('Your changes have been submitted. Waiting for approval at the moment...', 'success');

                    //	die;

                    echo '<script>
				 			var objP=parent.document.getElementsByClassName("mfp-bg");
							var objC=parent.document.getElementsByClassName("mfp-wrap");
							objP[0].style.display="none";
							objC[0].style.display="none";
							parent.location.reload(true);</script>';
                }
                else
                    $this->Session->setFlash('Unable to add project unit.', 'failure');
            }
        }

        $project_role = $this->LookupProjectContactProjectRole->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('project_role'));

        $projects = $this->Project->find('list', array('fields' => array('id', 'project_name'), 'conditions' => array('id' => $ProjectContact['ProjectContact']['project_contact_project_id']), 'order' => 'project_name asc'));
        $this->set('projects', $projects);


        $contacts = $this->BuilderContact->find('all', array('fields' => array('BuilderContact.id', 'BuilderContact.builder_contact_name', 'BuilderContact.builder_contact_designation'), 'conditions' => array('BuilderContact.id' => $ProjectContact['ProjectContact']['project_contact_builder_contact_id']),
            'order' => 'BuilderContact.builder_contact_name asc'));

        $contacts = Set::combine($contacts, '{n}.BuilderContact.id', array('%s, %s', '{n}.BuilderContact.builder_contact_name', '{n}.BuilderContact.builder_contact_designation'));
        $this->set(compact('contacts'));

        $builder = $this->Builder->find('list', array('fields' => array('id', 'builder_name'), 'conditions' => array('id' => array($Project['Project']['builder_id'], $Project['Project']['secondary_builder_id'], $Project['Project']['tertiary_builder_id']))));
        $this->set(compact('builder'));

        // $log = $this->BuilderContact->getDataSource()->getLog(false, false);       
        // debug($log);

        if (!$this->request->data) {
            $this->request->data = $ProjectContact;
        }
    }

}
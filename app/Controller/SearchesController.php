<?php

/**
 * Search controller.
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
 * Search controller
 *
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class SearchesController extends AppController {

    var $uses = array('City', 'Channel', 'Suburb', 'Area', 'Project', 'LookupUnitCommissionBasedOn', 'LookupValueProjectUnitPreference', 'ProjectType', 'ProjectUnit');

    public function index() {

        $channel_id = $this->Session->read("channel_id");
        $channel_id = $this->Channel->findById($channel_id);
        $channel_city_id = $channel_id['Channel']['city_id'];
        $dummy_status = $this->Auth->user('dummy_status');
        $property_suburb_id = '';
        $property_city_id = '';
        $property_area_id = '';
        $search_type = '';
        $property_unit_type = '';
        $property_project_type = '';
        $property_unit_commission_based_on = '';
        $project_specific = '';
        $contact_city_id = '';
        $contact_suburb_id = '';
        $contact_area_id = '';
        $legal_city_id = '';
        $legal_suburb_id = '';
        $legal_area_id = '';
        $aminity_city_id = '';
        $aminity_suburb_id = '';
        $aminity_area_id = '';
        $unit_city_id = '';
        $unit_suburb_id = '';
        $unit_area_id = '';
        $city_id = '';
        $suburb_id = '';
        $property_budget = '';
        
        $search_condition = array();


        if ($this->request->is('post') || $this->request->is('put')) {
            $search_type = $this->data['Search']['search_type'];
            $project_specific = $this->data['Project']['specific'];

            if (!empty($this->data['Project']['city_id'])) {
                $property_city_id = $this->data['Project']['city_id'];
                $city_id = $this->data['Project']['city_id'];
                array_push($search_condition, array('Project.city_id' => mysql_escape_string(trim(strip_tags($property_city_id)))));
            }

            if (!empty($this->data['Project']['suburb_id'])) {
                $property_suburb_id = $this->data['Project']['suburb_id'];
                $suburb_id = $this->data['Project']['suburb_id'];
                array_push($search_condition, array('Project.suburb_id' => mysql_escape_string(trim(strip_tags($property_suburb_id)))));
            }
            if (!empty($this->data['Project']['area_id'])) {
                $property_area_id = $this->data['Project']['area_id'];
                array_push($search_condition, array('Project.area_id' => mysql_escape_string(trim(strip_tags($property_area_id)))));
            }

            if (!empty($this->data['Project']['project_type'])) {
                $property_project_type = $this->data['Project']['project_type'];
                array_push($search_condition, array('Project.project_type' => mysql_escape_string(trim(strip_tags($property_project_type)))));
            }
            if (!empty($this->data['ProjectUnit']['unit_type'])) {
                $property_unit_type = $this->data['ProjectUnit']['unit_type'];
                array_push($search_condition, array('ProjectUnit.unit_type' => mysql_escape_string(trim(strip_tags($property_unit_type)))));
            }
            if (!empty($this->data['ProjectUnit']['unit_commission_based_on']) && !empty($this->data['ProjectUnit']['property_budget'])) {
                $property_unit_commission_based_on = $this->data['ProjectUnit']['unit_commission_based_on'];
                $property_budget = $this->data['ProjectUnit']['property_budget'];
                if($property_unit_commission_based_on == '1') // Basic Cost
                    array_push($search_condition, array('ProjectUnit.basic_cost >=' => $property_budget,'ProjectUnit.basic_cost <=' => $property_budget));
                if($property_unit_commission_based_on == '2') // Agreement Cost
                    array_push($search_condition, array('ProjectUnit.agreement_cost >=' => $property_budget,'ProjectUnit.agreement_cost <=' => $property_budget));
                if($property_unit_commission_based_on == '3') // Inclusive Cost
                    array_push($search_condition, array('ProjectUnit.post_tax_total >=' => $property_budget,'ProjectUnit.post_tax_total <=' => $property_budget));
            }
            if (!empty($this->data['Project']['city_id1'])) {
                $contact_city_id = $this->data['Project']['city_id1'];
                $city_id = $this->data['Project']['city_id1'];
                array_push($search_condition, array('Project.city_id' => mysql_escape_string(trim(strip_tags($contact_city_id)))));
            }
            if (!empty($this->data['Project']['suburb_id1'])) {
                $contact_suburb_id = $this->data['Project']['suburb_id1'];
                 $suburb_id = $this->data['Project']['suburb_id1'];
                array_push($search_condition, array('Project.suburb_id' => mysql_escape_string(trim(strip_tags($contact_suburb_id)))));
            }
            if (!empty($this->data['Project']['area_id1'])) {
                $contact_area_id = $this->data['Project']['area_id1'];
                array_push($search_condition, array('Project.area_id' => mysql_escape_string(trim(strip_tags($contact_area_id)))));
            }
            if (!empty($this->data['Project']['city_id2'])) {
                $legal_city_id = $this->data['Project']['city_id2'];
                $city_id = $this->data['Project']['city_id2'];
                array_push($search_condition, array('Project.city_id' => mysql_escape_string(trim(strip_tags($legal_city_id)))));
            }
            if (!empty($this->data['Project']['suburb_id2'])) {
                $legal_suburb_id = $this->data['Project']['suburb_id2'];
                $suburb_id = $this->data['Project']['suburb_id2'];
                array_push($search_condition, array('Project.suburb_id' => mysql_escape_string(trim(strip_tags($legal_suburb_id)))));
            }
            if (!empty($this->data['Project']['area_id2'])) {
                $legal_area_id = $this->data['Project']['area_id2'];
                array_push($search_condition, array('Project.area_id' => mysql_escape_string(trim(strip_tags($legal_area_id)))));
            }
             if (!empty($this->data['Project']['city_id3'])) {
                $aminity_city_id = $this->data['Project']['city_id3'];
                $city_id = $this->data['Project']['city_id3'];
                array_push($search_condition, array('Project.city_id' => mysql_escape_string(trim(strip_tags($aminity_city_id)))));
            }
            if (!empty($this->data['Project']['suburb_id3'])) {
                $aminity_suburb_id = $this->data['Project']['suburb_id3'];
                $suburb_id = $this->data['Project']['suburb_id3'];
                array_push($search_condition, array('Project.suburb_id' => mysql_escape_string(trim(strip_tags($aminity_suburb_id)))));
            }
            if (!empty($this->data['Project']['area_id3'])) {
                $aminity_area_id = $this->data['Project']['area_id3'];
                array_push($search_condition, array('Project.area_id' => mysql_escape_string(trim(strip_tags($aminity_area_id)))));
            }
            if (!empty($this->data['Project']['city_id4'])) {
                $unit_city_id = $this->data['Project']['city_id4'];
                $city_id = $this->data['Project']['city_id4'];
                array_push($search_condition, array('Project.city_id' => mysql_escape_string(trim(strip_tags($unit_city_id)))));
            }
            if (!empty($this->data['Project']['suburb_id4'])) {
                $unit_suburb_id = $this->data['Project']['suburb_id4'];
                $suburb_id = $this->data['Project']['suburb_id4'];
                array_push($search_condition, array('Project.suburb_id' => mysql_escape_string(trim(strip_tags($unit_suburb_id)))));
            }
            if (!empty($this->data['Project']['area_id4'])) {
                $unit_area_id = $this->data['Project']['area_id4'];
                array_push($search_condition, array('Project.area_id' => mysql_escape_string(trim(strip_tags($unit_area_id)))));
            }
            
           
        } elseif ($this->request->is('get')) {


            if (!empty($this->request->params['named']['city_id'])) {
                $property_city_id = $this->request->params['named']['city_id'];
                array_push($search_condition, array('Project.city_id' => $property_city_id));
            }

            if (!empty($this->request->params['named']['suburb_id'])) {
                $property_suburb_id = $this->request->params['named']['suburb_id'];
                array_push($search_condition, array('Project.suburb_id' => $property_suburb_id));
            }

            if (!empty($this->request->params['named']['area_id'])) {
                $property_area_id = $this->request->params['named']['area_id'];
                array_push($search_condition, array('Project.area_id' => $property_area_id));
            }
        }

        if ($search_type == '1') { // property
            $properties = $this->paginate("ProjectUnit", $search_condition);
            $this->set(compact('properties'));
           
            //$log = $this->ProjectUnit->getDataSource()->getLog(false, false);       
            //debug($log);
            //die;
            
        } elseif ($search_type == '2') { //project
            if ($project_specific == '1') { // without contacts
                array_push($search_condition, array('not exists ' .
                    '(select id from project_contacts' .
                    ' where project_contacts.project_contact_project_id = ' .
                    'Project.id)'));
            }
            elseif($project_specific == '2'){ // without legalname
                array_push($search_condition, array('not exists ' .
                    '(select id from project_legal_names' .
                    ' where project_legal_names.project_legal_names_project_id = ' .
                    'Project.id)'));
            }
            elseif($project_specific == '3'){ // without amanities
                array_push($search_condition, array('not exists ' .
                    '(select id from amenities' .
                    ' where amenities.project_id = ' .
                    'Project.id)'));
            }
            elseif($project_specific == '4'){ // without legalname
                array_push($search_condition, array('not exists ' .
                    '(select id from project_units' .
                    ' where project_units.project_id = ' .
                    'Project.id)'));
            }

            $projects = $this->paginate("Project", $search_condition);
            $this->set(compact('projects'));
            
            
        }




        if ($channel_city_id == '1')
            $city = $this->City->find('list', array('fields' => 'City.id, City.city_name', 'conditions' => array('City.dummy_status' => $dummy_status, 'City.city_status' => '1'), 'order' => 'City.city_name ASC'));
        else
            $city = $this->City->find('list', array('fields' => 'City.id, City.city_name', 'conditions' => array('City.id' => $channel_city_id, 'City.dummy_status' => $dummy_status, 'City.city_status' => '1'), 'order' => 'City.city_name ASC'));

        $this->set('city', $city);

        $conSuburb = array('dummy_status' => $dummy_status, 'city_id' => $city_id, 'suburb_status' => '1');
        $suburbs = $this->Suburb->find('list', array('fields' => 'Suburb.id, Suburb.suburb_name','conditions' => $conSuburb, 'order' => 'Suburb.suburb_name ASC'));
        $this->set(compact('suburbs'));

        $conArea = array('dummy_status' => $dummy_status, 'city_id' => $city_id, 'suburb_id' => $suburb_id, 'area_status' => '1');
        $areas = $this->Area->find('list', array('fields' => 'Area.id, Area.area_name','conditions' => $conArea, 'order' => 'Area.area_name ASC'));
        $this->set('areas', $areas);

        $based_on = $this->LookupUnitCommissionBasedOn->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('based_on'));

        $unit_type = $this->LookupValueProjectUnitPreference->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set('unit_type', $unit_type);

        $types = $this->ProjectType->find('list', array('fields' => 'ProjectType.id, ProjectType.name', 'order' => 'ProjectType.name ASC'));
        $this->set('project_types', $types);



        if (!isset($this->passedArgs['city_id']) && empty($this->passedArgs['city_id'])) {
            $this->passedArgs['city_id'] = (isset($this->data['Project']['city_id'])) ? $this->data['Project']['city_id'] : '';
        }
        if (!isset($this->passedArgs['suburb_id']) && empty($this->passedArgs['suburb_id'])) {
            $this->passedArgs['suburb_id'] = (isset($this->data['Project']['suburb_id'])) ? $this->data['Project']['suburb_id'] : '';
        }
        if (!isset($this->passedArgs['area_id']) && empty($this->passedArgs['area_id'])) {
            $this->passedArgs['area_id'] = (isset($this->data['Project']['area_id'])) ? $this->data['Project']['area_id'] : '';
        }

        if (!isset($this->data) && empty($this->data)) {
            $this->data['Project']['city_id'] = $this->passedArgs['city_id'];
            $this->data['Project']['suburb_id'] = $this->passedArgs['suburb_id'];
            $this->data['Project']['area_id'] = $this->passedArgs['area_id'];
        }

        $this->set(compact('property_city_id'));
        $this->set(compact('property_suburb_id'));
        $this->set(compact('property_area_id'));
        $this->set(compact('property_unit_type'));
        $this->set(compact('property_project_type'));
        $this->set(compact('property_unit_commission_based_on'));
        $this->set(compact('search_type'));
        $this->set(compact('project_specific'));
        $this->set(compact('contact_city_id'));
        $this->set(compact('contact_suburb_id'));
        $this->set(compact('contact_area_id'));
        $this->set(compact('legal_city_id'));
        $this->set(compact('legal_suburb_id'));
        $this->set(compact('legal_area_id'));
        $this->set(compact('aminity_city_id'));
        $this->set(compact('aminity_suburb_id'));
        $this->set(compact('aminity_area_id'));
        $this->set(compact('unit_city_id'));
        $this->set(compact('unit_suburb_id'));
        $this->set(compact('unit_area_id'));
        $this->set(compact('property_budget'));
    }

}
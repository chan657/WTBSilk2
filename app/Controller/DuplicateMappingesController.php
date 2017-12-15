<?php

/**
 * DuplicateMappinges controller.
 *
 * This file will render views from views/DuplicateMappinges/
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
 * Agent controller
 *
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class DuplicateMappingesController extends AppController {

    public $uses = array('User', 'TravelActionItemType', 'TravelRemark', 'TravelActionItem',
        'TravelMappingType', 'TravelSupplier', 'TravelCountrySupplier', 'TravelCountrySupplier', 'TravelCitySupplier', 'TravelHotelRoomSupplier', 'Mappinge', 'TravelCountry', 'TravelHotelLookup', 'TravelCity', 'DuplicateMappinge'
    );

    public function index() {

        $dummy_status = $this->Auth->user('dummy_status');
        $role_id = $this->Session->read("role_id");
        $search_condition = array();

        $hotel_wtb_code = '';
        $supplier_code = '';
        $country_wtb_code = '';
        $city_wtb_code = '';
        $hotel_wtb_code = '';
        $status = '';
        $exclude = '';
        $TravelCities = array();
        $TravelHotelLookups = array();

        if ($this->request->is('post') || $this->request->is('put')) {
            if (!empty($this->data['Mappinge']['hotel_wtb_code'])) {
                $hotel_wtb_code = $this->data['Mappinge']['hotel_wtb_code'];
                array_push($search_condition, array('Mappinge.hotel_wtb_code' . ' LIKE' => "%" . mysql_escape_string(trim(strip_tags($hotel_wtb_code))) . "%"));
            }

            if (!empty($this->data['Mappinge']['supplier_code'])) {
                $supplier_code = $this->data['Mappinge']['supplier_code'];
                array_push($search_condition, array('Mappinge.supplier_code LIKE' => "%" . mysql_escape_string(trim(strip_tags($supplier_code))) . "%"));
            }
            if (!empty($this->data['Mappinge']['country_wtb_code'])) {
                $country_wtb_code = $this->data['Mappinge']['country_wtb_code'];
                array_push($search_condition, array('Mappinge.country_wtb_code LIKE' => "%" . mysql_escape_string(trim(strip_tags($country_wtb_code))) . "%"));
                $TravelCities = $this->TravelCity->find('list', array('fields' => 'city_code, city_name', 'conditions' => array('country_code LIKE ' => '%' . trim($this->data['Mappinge']['country_wtb_code']) . '%', 'city_status' => '0'), 'order' => 'city_name ASC'));
            }
            if (!empty($this->data['Mappinge']['city_wtb_code'])) {
                $city_wtb_code = $this->data['Mappinge']['city_wtb_code'];
                array_push($search_condition, array('Mappinge.city_wtb_code LIKE' => "%" . mysql_escape_string(trim(strip_tags($city_wtb_code))) . "%"));
                $TravelHotelLookups = $this->TravelHotelLookup->find('list', array('fields' => 'hotel_code, hotel_name', 'conditions' => array('city_code LIKE' => '%' . trim($this->data['Mappinge']['city_wtb_code']) . '%', 'active' => '1'), 'order' => 'hotel_name ASC'));
            }
            if (!empty($this->data['Mappinge']['hotel_wtb_code'])) {
                $hotel_wtb_code = $this->data['Mappinge']['hotel_wtb_code'];
                array_push($search_condition, array('Mappinge.hotel_wtb_code LIKE' => "%" . mysql_escape_string(trim(strip_tags($hotel_wtb_code))) . "%"));
            }

            if (!empty($this->data['Mappinge']['status'])) {
                $status = $this->data['Mappinge']['status'];
                array_push($search_condition, array('Mappinge.status' => $status));
            }
            if (!empty($this->data['Mappinge']['exclude'])) {
                $exclude = $this->data['Mappinge']['exclude'];
                array_push($search_condition, array('Mappinge.exclude' => $exclude));
            }
        } elseif ($this->request->is('get')) {

            if (!empty($this->request->params['named']['hotel_wtb_code'])) {
                $hotel_wtb_code = $this->request->params['named']['hotel_wtb_code'];
                array_push($search_condition, array('Mappinge.hotel_wtb_code' . ' LIKE' => "%" . mysql_escape_string(trim(strip_tags($hotel_wtb_code))) . "%"));
            }

            if (!empty($this->request->params['named']['supplier_code'])) {
                $supplier_code = $this->request->params['named']['supplier_code'];
                array_push($search_condition, array('Mappinge.supplier_code LIKE' => "%" . mysql_escape_string(trim(strip_tags($supplier_code))) . "%"));
            }
            if (!empty($this->request->params['named']['country_wtb_code'])) {
                $country_wtb_code = $this->request->params['named']['country_wtb_code'];
                array_push($search_condition, array('Mappinge.country_wtb_code LIKE' => "%" . mysql_escape_string(trim(strip_tags($country_wtb_code))) . "%"));
                $TravelCities = $this->TravelCity->find('list', array('fields' => 'city_code, city_name', 'conditions' => array('country_code LIKE ' => '%' . trim($this->request->params['named']['country_wtb_code']) . '%', 'city_status' => '0'), 'order' => 'city_name ASC'));
            }
            if (!empty($this->request->params['named']['city_wtb_code'])) {
                $city_wtb_code = $this->request->params['named']['city_wtb_code'];
                array_push($search_condition, array('Mappinge.city_wtb_code LIKE' => "%" . mysql_escape_string(trim(strip_tags($city_wtb_code))) . "%"));
                $TravelHotelLookups = $this->TravelHotelLookup->find('list', array('fields' => 'hotel_code, hotel_name', 'conditions' => array('city_code LIKE' => '%' . trim($this->request->params['named']['city_wtb_code']) . '%', 'active' => '1'), 'order' => 'hotel_name ASC'));
            }
            if (!empty($this->request->params['named']['hotel_wtb_code'])) {
                $hotel_wtb_code = $this->request->params['named']['hotel_wtb_code'];
                array_push($search_condition, array('Mappinge.hotel_wtb_code LIKE' => "%" . mysql_escape_string(trim(strip_tags($hotel_wtb_code))) . "%"));
            }
            if (!empty($this->request->params['named']['status'])) {
                $status = $this->request->params['named']['status'];
                array_push($search_condition, array('Mappinge.status' => $status));
            }
            if (!empty($this->request->params['named']['exclude'])) {
                $exclude = $this->request->params['named']['exclude'];
                array_push($search_condition, array('Mappinge.exclude' => $exclude));
            }
        }


        if ($dummy_status)
            array_push($search_condition, array('DuplicateMappinge.dummy_status' => $dummy_status));


        if (count($this->params['pass'])) {

            $aaray = explode(':', $this->params['pass'][0]);
            $field = $aaray[0];
            $value = $aaray[1];
            array_push($search_condition, array('DuplicateMappinge.' . $field => $value)); // when builder is approve/pending
        }
        /*
          elseif(count($this->params['named'])){
          foreach($this->params['named'] as $key=>$val){
          array_push($search_condition, array('Mappinge.' .$key => $val)); // when builder is approve/pending
          }
          }
         * 
         */


        $this->paginate['order'] = array('DuplicateMappinge.supplier_code' => 'asc');
        $this->set('DuplicateMappinges', $this->paginate("DuplicateMappinge", $search_condition));

        $TravelSuppliers = $this->TravelSupplier->find('list', array('fields' => 'supplier_code, supplier_name', 'conditions' => array('active' => 'TRUE'), 'order' => 'supplier_name ASC'));
        $this->set(compact('TravelSuppliers'));

        $TravelCountries = $this->TravelCountry->find('list', array('fields' => 'country_code, country_name', 'conditions' => array('country_status' => 'TRUE'), 'order' => 'country_name ASC'));
        $this->set(compact('TravelCountries'));


        $this->set(compact('TravelCities'));


        $this->set(compact('TravelHotelLookups'));

        $TravelActionItemTypes = $this->TravelActionItemType->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('TravelActionItemTypes'));

        $hotel_all_count = $this->TravelHotelLookup->find('count');
        $this->set(compact('hotel_all_count'));

        $country_all_count = $this->TravelCountry->find('count');
        $this->set(compact('country_all_count'));

        $city_all_count = $this->TravelCity->find('count');
        $this->set(compact('city_all_count'));


        if (!isset($this->passedArgs['hotel_wtb_code']) && empty($this->passedArgs['hotel_wtb_code'])) {
            $this->passedArgs['hotel_wtb_code'] = (isset($this->data['Mappinge']['hotel_wtb_code'])) ? $this->data['Mappinge']['hotel_wtb_code'] : '';
        }
        if (!isset($this->passedArgs['supplier_code']) && empty($this->passedArgs['supplier_code'])) {
            $this->passedArgs['supplier_code'] = (isset($this->data['Mappinge']['supplier_code'])) ? $this->data['Mappinge']['supplier_code'] : '';
        }
        if (!isset($this->passedArgs['country_wtb_code']) && empty($this->passedArgs['country_wtb_code'])) {
            $this->passedArgs['country_wtb_code'] = (isset($this->data['Mappinge']['country_wtb_code'])) ? $this->data['Mappinge']['country_wtb_code'] : '';
        }
        if (!isset($this->passedArgs['city_wtb_code']) && empty($this->passedArgs['city_wtb_code'])) {
            $this->passedArgs['city_wtb_code'] = (isset($this->data['Mappinge']['city_wtb_code'])) ? $this->data['Mappinge']['city_wtb_code'] : '';
        }
        if (!isset($this->passedArgs['hotel_wtb_code']) && empty($this->passedArgs['hotel_wtb_code'])) {
            $this->passedArgs['hotel_wtb_code'] = (isset($this->data['Mappinge']['hotel_wtb_code'])) ? $this->data['Mappinge']['hotel_wtb_code'] : '';
        }
        if (!isset($this->passedArgs['status']) && empty($this->passedArgs['status'])) {
            $this->passedArgs['status'] = (isset($this->data['Mappinge']['status'])) ? $this->data['Mappinge']['status'] : '';
        }
        if (!isset($this->passedArgs['exclude']) && empty($this->passedArgs['exclude'])) {
            $this->passedArgs['exclude'] = (isset($this->data['Mappinge']['exclude'])) ? $this->data['Mappinge']['exclude'] : '';
        }



        if (!isset($this->data) && empty($this->data)) {
            $this->data['Mappinge']['hotel_wtb_code'] = $this->passedArgs['hotel_wtb_code'];
            $this->data['Mappinge']['supplier_code'] = $this->passedArgs['supplier_code'];
            $this->data['Mappinge']['country_wtb_code'] = $this->passedArgs['country_wtb_code'];
            $this->data['Mappinge']['city_wtb_code'] = $this->passedArgs['city_wtb_code'];
            $this->data['Mappinge']['hotel_wtb_code'] = $this->passedArgs['hotel_wtb_code'];
            $this->data['Mappinge']['status'] = $this->passedArgs['status'];
            $this->data['Mappinge']['exclude'] = $this->passedArgs['exclude'];
        }

        $this->set(compact('hotel_wtb_code'));
        $this->set(compact('supplier_code'));
        $this->set(compact('country_wtb_code'));
        $this->set(compact('city_wtb_code'));
        $this->set(compact('hotel_wtb_code'));
        $this->set(compact('status'));
        $this->set(compact('exclude'));
    }

}


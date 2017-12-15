<?php

/**
 * Mapping controller.
 *
 * This file will render views from views/agents/
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
class MappingesController extends AppController {

    public $uses = array('User', 'LogCall', 'TravelActionItemType', 'TravelRemark', 'TravelActionItem',
        'TravelMappingType', 'TravelSupplier', 'TravelCountrySupplier', 'TravelCitySupplier', 
        'TravelHotelRoomSupplier', 'Mappinge', 'TravelCountry', 'TravelHotelLookup', 'TravelCity', 
        'DuplicateMappinge','TravelBrand','TravelChain','TravelSuburb','TravelArea','Province','ProvincePermission'
    );

    public function index() {

        $dummy_status = $this->Auth->user('dummy_status');
        $role_id = $this->Session->read("role_id");
        $search_condition = array();
        $user_id = $this->Auth->user('id');

        $search = '';
        $supplier_code = '';
        $country_wtb_code = '';
        $city_wtb_code = '';
        $hotel_wtb_code = '';
        $status = '';
        $active = '';
        $exclude = '';
        $mapping_type = '';
        $wtb_status = '';
        $province_id = '';
        $mapping_edit_permission = false;
        $TravelCities = array();
        $TravelHotelLookups = array();
        $Provinces = array();
        

        if ($this->request->is('post') || $this->request->is('put')) {
            
            if (!empty($this->data['Mappinge']['search'])) {
                $search = $this->data['Mappinge']['search'];
                array_push($search_condition, array('OR' => array('TravelCountrySupplier.country_name LIKE' => "%" . mysql_escape_string(trim(strip_tags($search))) . "%", 'TravelCitySupplier.city_name' . ' LIKE' => "%" . mysql_escape_string(trim(strip_tags($search))) . "%", 'TravelHotelRoomSupplier.hotel_name' . ' LIKE' => "%" . mysql_escape_string(trim(strip_tags($search))) . "%")));
                
            }
            if (!empty($this->data['Mappinge']['active'])) {
                $active = $this->data['Mappinge']['active'];
                array_push($search_condition, array('OR' => array('TravelCountrySupplier.active' => $active, 'TravelCitySupplier.active' => $active, 'TravelHotelRoomSupplier.active' => $active)));
                
            }
            if (!empty($this->data['Mappinge']['wtb_status'])) {
                $wtb_status = $this->data['Mappinge']['wtb_status'];
                array_push($search_condition, array('OR' => array('TravelCountrySupplier.wtb_status' => $wtb_status, 'TravelCitySupplier.wtb_status' => $wtb_status, 'TravelHotelRoomSupplier.wtb_status' => $wtb_status)));
                
            }

            if (!empty($this->data['Mappinge']['supplier_code'])) {
                $supplier_code = $this->data['Mappinge']['supplier_code'];
                array_push($search_condition, array('Mappinge.supplier_code LIKE' => "%" . mysql_escape_string(trim(strip_tags($supplier_code))) . "%"));
            }
            if (!empty($this->data['Mappinge']['mapping_type'])) {
                $mapping_type = $this->data['Mappinge']['mapping_type'];
                array_push($search_condition, array('Mappinge.mapping_type' => $mapping_type));
            }
            if (!empty($this->data['Mappinge']['country_wtb_code'])) {
                $country_wtb_code = $this->data['Mappinge']['country_wtb_code'];
                array_push($search_condition, array('Mappinge.country_wtb_code LIKE' => "%" . mysql_escape_string(trim(strip_tags($country_wtb_code))) . "%"));
                $TravelCities = $this->TravelCity->find('list', array('fields' => 'city_code, city_name', 'conditions' => array('TravelCity.country_code LIKE ' => '%' . trim($this->data['Mappinge']['country_wtb_code']) . '%',
                        'TravelCity.city_status' => '1',
                        'TravelCity.wtb_status' => '1',
                        'TravelCity.active' => 'TRUE'), 'order' => 'city_name ASC'));
                
               // $TravelCities = $this->TravelCity->find('list', array('fields' => 'city_code, city_name', 'conditions' => array('country_code LIKE ' => '%' . trim($this->data['Mappinge']['country_wtb_code']) . '%', 'city_status' => '0'), 'order' => 'city_name ASC'));
            }
            if (!empty($this->data['Mappinge']['city_wtb_code'])) {
                $city_wtb_code = $this->data['Mappinge']['city_wtb_code'];
                array_push($search_condition, array('Mappinge.city_wtb_code LIKE' => "%" . mysql_escape_string(trim(strip_tags($city_wtb_code))) . "%"));
                $TravelHotelLookups = $this->TravelHotelLookup->find('list', array('fields' => 'hotel_code, hotel_name', 'conditions' => array('city_code LIKE' => '%' . trim($this->data['Mappinge']['city_wtb_code']) . '%', 'active' => 'TRUE'), 'order' => 'hotel_name ASC'));
            }
            if (!empty($this->data['Mappinge']['hotel_wtb_code'])) {
                $hotel_wtb_code= $this->data['Mappinge']['hotel_wtb_code'];
                array_push($search_condition, array('Mappinge.hotel_wtb_code LIKE' => "%" . mysql_escape_string(trim(strip_tags($hotel_wtb_code))) . "%"));
            }
            if (!empty($this->data['Mappinge']['province_id'])) {
                $province_id = $this->data['Mappinge']['province_id'];
                array_push($search_condition, array('OR' => array( 'TravelCitySupplier.province_id' =>$province_id, 'TravelHotelRoomSupplier.province_id' => $province_id)));                               
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

            if (!empty($this->request->params['named']['search '])) {
                $search = $this->request->params['named']['search '];
                array_push($search_condition, array('OR' => array('TravelCountrySupplier.country_name LIKE' => "%" . mysql_escape_string(trim(strip_tags($search))) . "%", 'TravelCitySupplier.city_name' . ' LIKE' => "%" . mysql_escape_string(trim(strip_tags($search))) . "%", 'TravelHotelRoomSupplier.hotel_name' . ' LIKE' => "%" . mysql_escape_string(trim(strip_tags($search))) . "%")));
            }
            if (!empty($this->request->params['named']['active '])) {
                $active = $this->request->params['named']['active '];
                array_push($search_condition, array('OR' => array('TravelCountrySupplier.active' => $active, 'TravelCitySupplier.active' => $active, 'TravelHotelRoomSupplier.active' => $active)));
            }
            if (!empty($this->request->params['named']['province_id '])) {
                $province_id = $this->request->params['named']['province_id '];
                array_push($search_condition, array('OR' => array( 'TravelCitySupplier.province_id' =>$province_id, 'TravelHotelRoomSupplier.province_id' => $province_id)));                               
            }
            if (!empty($this->request->params['named']['wtb_status '])) {
                $wtb_status = $this->request->params['named']['wtb_status '];
                array_push($search_condition, array('OR' => array('TravelCountrySupplier.wtb_status' => $wtb_status, 'TravelCitySupplier.wtb_status' => $wtb_status, 'TravelHotelRoomSupplier.wtb_status' => $wtb_status)));
            }

            if (!empty($this->request->params['named']['supplier_code'])) {
                $supplier_code = $this->request->params['named']['supplier_code'];
                array_push($search_condition, array('Mappinge.supplier_code LIKE' => "%" . mysql_escape_string(trim(strip_tags($supplier_code))) . "%"));
            }
            if (!empty($this->request->params['named']['mapping_type'])) {
                $mapping_type = $this->request->params['named']['mapping_type'];
                array_push($search_condition, array('Mappinge.mapping_type' => $mapping_type));
            }
            if (!empty($this->request->params['named']['country_wtb_code'])) {
                $country_wtb_code = $this->request->params['named']['country_wtb_code'];
                array_push($search_condition, array('Mappinge.country_wtb_code LIKE' => "%" . mysql_escape_string(trim(strip_tags($country_wtb_code))) . "%"));
                $TravelCities = $this->TravelCity->find('list', array('fields' => 'city_code, city_name', 'conditions' => array('TravelCity.country_code LIKE ' => '%' . trim($country_wtb_code) . '%',
                        'TravelCity.city_status' => '1',
                        'TravelCity.wtb_status' => '1',
                        'TravelCity.active' => 'TRUE'), 'order' => 'city_name ASC'));
            }
            if (!empty($this->request->params['named']['city_wtb_code'])) {
                $city_wtb_code = $this->request->params['named']['city_wtb_code'];
                array_push($search_condition, array('Mappinge.city_wtb_code LIKE' => "%" . mysql_escape_string(trim(strip_tags($city_wtb_code))) . "%"));
                $TravelHotelLookups = $this->TravelHotelLookup->find('list', array('fields' => 'hotel_code, hotel_name', 'conditions' => array('city_code LIKE' => '%' . trim($this->request->params['named']['city_wtb_code']) . '%', 'active' => 'TRUE'), 'order' => 'hotel_name ASC'));
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

        //$this->Mappinge->recursive = 0;
        if ($dummy_status)
            array_push($search_condition, array('Mappinge.dummy_status' => $dummy_status));


        if (count($this->params['pass'])) {

            $aaray = explode(':', $this->params['pass'][0]);
            $field = $aaray[0];
            $value = $aaray[1];
            array_push($search_condition, array('Mappinge.' . $field => $value)); // when builder is approve/pending
        }
        /*
          elseif(count($this->params['named'])){
          foreach($this->params['named'] as $key=>$val){
          array_push($search_condition, array('Mappinge.' .$key => $val)); // when builder is approve/pending
          }
          }
         * 
         */


        $this->paginate['order'] = array('Mappinge.created' => 'desc');
        $this->set('Mappinges', $this->paginate("Mappinge", $search_condition));
        
          //$log = $this->Mappinge->getDataSource()->getLog(false, false);       
          //debug($log);

        $TravelSuppliers = $this->TravelSupplier->find('list', array('fields' => 'supplier_code, supplier_name', 'conditions' => array('active' => 'TRUE'), 'order' => 'supplier_name ASC'));
        $this->set(compact('TravelSuppliers'));
        
        $TravelCountries = $this->TravelCountry->find('list', array('fields' => 'country_code, country_name', 'conditions' => array(
                        'TravelCountry.country_status' => '1',
                        'TravelCountry.wtb_status' => '1',
                        'TravelCountry.active' => 'TRUE'), 'order' => 'country_name ASC'));

        //$TravelCountries = $this->TravelCountry->find('list', array('fields' => 'country_code, country_name', 'conditions' => array('country_status' => '1'), 'order' => 'country_name ASC'));
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


        if (!isset($this->passedArgs['search']) && empty($this->passedArgs['search'])) {
            $this->passedArgs['search'] = (isset($this->data['Mappinge']['search'])) ? $this->data['Mappinge']['search'] : '';
        }
        if (!isset($this->passedArgs['active']) && empty($this->passedArgs['active'])) {
            $this->passedArgs['active'] = (isset($this->data['Mappinge']['active'])) ? $this->data['Mappinge']['active'] : '';
        }
        if (!isset($this->passedArgs['wtb_status']) && empty($this->passedArgs['wtb_status'])) {
            $this->passedArgs['wtb_status'] = (isset($this->data['Mappinge']['wtb_status'])) ? $this->data['Mappinge']['wtb_status'] : '';
        }
        if (!isset($this->passedArgs['supplier_code']) && empty($this->passedArgs['supplier_code'])) {
            $this->passedArgs['supplier_code'] = (isset($this->data['Mappinge']['supplier_code'])) ? $this->data['Mappinge']['supplier_code'] : '';
        }
        if (!isset($this->passedArgs['mapping_type']) && empty($this->passedArgs['mapping_type'])) {
            $this->passedArgs['mapping_type'] = (isset($this->data['Mappinge']['mapping_type'])) ? $this->data['Mappinge']['mapping_type'] : '';
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
        if (!isset($this->passedArgs['province_id']) && empty($this->passedArgs['province_id'])) {
            $this->passedArgs['province_id'] = (isset($this->data['Mappinge']['province_id'])) ? $this->data['Mappinge']['province_id'] : '';
        }



        if (!isset($this->data) && empty($this->data)) {
            $this->data['Mappinge']['search'] = $this->passedArgs['search'];
            $this->data['Mappinge']['active'] = $this->passedArgs['active'];
            $this->data['Mappinge']['wtb_status'] = $this->passedArgs['wtb_status'];
            $this->data['Mappinge']['supplier_code'] = $this->passedArgs['supplier_code'];
            $this->data['Mappinge']['mapping_type'] = $this->passedArgs['mapping_type'];
            $this->data['Mappinge']['country_wtb_code'] = $this->passedArgs['country_wtb_code'];
            $this->data['Mappinge']['city_wtb_code'] = $this->passedArgs['city_wtb_code'];
            $this->data['Mappinge']['hotel_wtb_code'] = $this->passedArgs['hotel_wtb_code'];
            $this->data['Mappinge']['status'] = $this->passedArgs['status'];
            $this->data['Mappinge']['exclude'] = $this->passedArgs['exclude'];
            $this->data['Mappinge']['province_id'] = $this->passedArgs['province_id'];
        }
        
        
        $TravelMappingTypes = $this->TravelMappingType->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $mapping_edit_permission = $this->ProvincePermission->find('list',array('fields' => array('ProvincePermission.province_id','ProvincePermission.province_id'),'conditions' => array('ProvincePermission.user_id' => $user_id,'ProvincePermission.mapping_edit' => 'Yes')));
     
        $this->set(compact('search','supplier_code','mapping_edit_permission','country_wtb_code','wtb_status','city_wtb_code','active','hotel_wtb_code','status','exclude','TravelMappingTypes','mapping_type','province_id','Provinces'));

    }

    public function add() {


        $user_id = $this->Auth->user('id');
        $role_id = $this->Session->read("role_id");
        $dummy_status = $this->Auth->user('dummy_status');
        $mapping_type = '';
        $city_wtb_country = array();
        $city_wtb_city = array();
        $country_wtb_country = array();
        $hotel_city = array();
        $hotel_list = array();
        $TravelSuburbs = array();
        $TravelAreas = array();
        $TravelChains = array();
        $TravelBrands = array();
        $Provinces = array();
        $website_url = '';
        $address = '';
        
        if($this->checkProvince())
            $proArr = $this->checkProvince();      
     


        if ($this->request->is('post') || $this->request->is('put')) {


            $next_action_by = '166';  //overseer 136 44 is sarika 152 - ojas
            $flag = 0;
            $search_condition = array();
            $condition = '';
            $success = '';
            $mapping_type = $this->data['Mapping']['mapping_type'];
            

            if ($this->data['Mapping']['operation'] == 'search_mapping') {
                

                if (!empty($this->data['Mapping']['city_supplier_code'])) {
                    $city_supplier_code = $this->data['Mapping']['city_supplier_code'];
                }
                if (!empty($this->data['Mapping']['hotel_supplier_code'])) {
                    $city_supplier_code = $this->data['Mapping']['hotel_supplier_code'];
                }

                $city_wtb_country = $this->TravelCountry->find
                        (
                        'all', array
                    (
                    'fields' => array('TravelCountry.country_code', 'TravelCountry.country_name'),
                    'conditions' => array
                        (
                        'TravelCountry.country_code IN (SELECT pf_country_code FROM travel_country_suppliers WHERE supplier_code = "' . $city_supplier_code . '" AND active = TRUE AND wtb_status = 1)',
                        'TravelCountry.country_status' => '1','TravelCountry.active' => 'TRUE'
                    ),
                    'order' => 'TravelCountry.country_name ASC'
                        )
                );

                $city_wtb_country = Set::combine($city_wtb_country, '{n}.TravelCountry.country_code', array('%s - %s', '{n}.TravelCountry.country_code', '{n}.TravelCountry.country_name'));


                if (!empty($this->data['Mapping']['city_country_code'])) {
                    $country_wtb_code = $this->data['Mapping']['city_country_code'];

                    //  array_push($search_condition, array('TravelCity.country_code LIKE' => "%" . mysql_escape_string(trim(strip_tags($country_wtb_code))) . "%"));
                    $city_wtb_city = $this->TravelCity->find
                            (
                            'all', array
                        (
                        'fields' => array('TravelCity.city_code', 'TravelCity.city_name'),
                        'conditions' => array
                            (
                            'TravelCity.city_code NOT IN (SELECT pf_city_code FROM travel_city_suppliers WHERE supplier_code = "' . $city_supplier_code . '" AND city_country_code ="' . trim($country_wtb_code) . '")',
                            'TravelCity.city_status' => '1', 'TravelCity.country_code LIKE ' => '%' . trim($country_wtb_code) . '%', 'TravelCity.province_id' => $this->data['Mapping']['city_province_id']
                        ),
                        'order' => 'TravelCity.city_name ASC'
                            )
                    );



                    $city_wtb_city = Set::combine($city_wtb_city, '{n}.TravelCity.city_code', array('%s - %s', '{n}.TravelCity.city_code', '{n}.TravelCity.city_name'));
                }



                if ($mapping_type == '2') {



                    if (!empty($this->data['Mapping']['pf_city_code'])) {
                        $city_wtb_code = $this->data['Mapping']['pf_city_code'];
                        $city_name_arr = $this->TravelCity->findByCityCode($this->data['Mapping']['pf_city_code'], array('fields' => 'city_name'));
                        //$city_name = substr(trim($city_name_arr['TravelCity']['city_name']), 0, 2);
                        $city_name = $city_name_arr['TravelCity']['city_name'];


                        for ($indexOfFirstLetter = 0; $indexOfFirstLetter <= strlen($city_name); $indexOfFirstLetter++) {
                            for ($indexOfLastLetter = $indexOfFirstLetter + 1; $indexOfLastLetter <= strlen($city_name); $indexOfLastLetter++) {
                                $arr[] = substr($city_name, $indexOfFirstLetter, 3);
                                $condition .= "(city_name LIKE '%" . $arr[$indexOfFirstLetter] . "%')";
                                if ($indexOfFirstLetter < strlen($city_name) - 1)
                                    $condition .= 'OR';
                                $indexOfFirstLetter++;
                            }
                        }
                    }
                   

                    if (!empty($this->data['Mapping']['country_supplier_code'])) {
                        $country_supplier_code = $this->data['Mapping']['country_supplier_code'];
                        $country_wtb_country = $this->TravelCountry->find
                                (
                                'all', array
                            (
                            'fields' => array('TravelCountry.country_code', 'TravelCountry.country_name'),
                            'conditions' => array
                                (
                                'TravelCountry.country_code NOT IN (SELECT pf_country_code FROM travel_country_suppliers WHERE supplier_code = "' . $country_supplier_code . '")',
                                'TravelCountry.country_status' => '1'
                            ),
                            'order' => 'TravelCountry.country_name ASC'
                                )
                        );


                        $country_wtb_country = Set::combine($country_wtb_country, '{n}.TravelCountry.country_code', array('%s - %s', '{n}.TravelCountry.country_code', '{n}.TravelCountry.country_name'));
                    }
                    if (!empty($this->data['Mapping']['pf_country_code'])) {
                        $country_wtb_code = $this->data['Mapping']['pf_country_code'];
                        array_push($search_condition, array('TravelCity.country_code LIKE' => "%" . mysql_escape_string(trim(strip_tags($country_wtb_code))) . "%"));
                        //$TravelCities = $this->TravelCity->find('list', array('fields' => 'city_code, city_name', 'conditions' => array('country_code LIKE ' => '%' . trim($country_wtb_code) . '%', 'city_status' => '0'), 'order' => 'city_name ASC'));
                    }

                    $Mappinges = $this->TravelCitySupplier->find
                            (
                            'all', array
                        (
                        'conditions' => array
                            (
                            'TravelCitySupplier.pf_city_code IN (SELECT city_code FROM travel_cities WHERE country_code = "' . $country_wtb_code . '" AND (' . $condition . '))',
                            'TravelCitySupplier.city_country_code' => $country_wtb_code, 'TravelCitySupplier.supplier_code' => $city_supplier_code
                        ),
                        'order' => 'TravelCitySupplier.city_country_code ASC',
                            )
                    );
                    $proArr = array();
                if($this->checkProvince())
                    $proArr = $this->checkProvince();
                    
                    $Provinces = $this->Province->find('list', array(
                'conditions' => array(                    
                    'Province.country_code' => trim($country_wtb_code),
                    'Province.status' => '1',
                    'Province.wtb_status' => '1',
                    'Province.active' => 'TRUE',
                    'Province.id' => $proArr
                ),
                'fields' => array('Province.id', 'Province.name'),
                'order' => 'Province.name ASC'
            ));

                    $this->set('Mappinges', $Mappinges);

                    //   $this->paginate['order'] = array('Mappinge.supplier_code' => 'asc');
                    //  $this->set('Mappinges', $this->paginate("Mappinge", $search_condition));
                    // $log = $this->TravelCitySupplier->getDataSource()->getLog(false, false);       
                    // debug($log);
                    //die;
                } elseif ($mapping_type == '3') {

                    if (!empty($this->data['Mapping']['hotel_country_code'])) {
                        $hotel_country_code = $this->data['Mapping']['hotel_country_code'];
                    }
                    if (!empty($this->data['Mapping']['hotel_city_code'])) {
                        $hotel_city_code = $this->data['Mapping']['hotel_city_code'];
                    }
                    $city_con = array();
                    
                    if($this->checkProvince())
                       $city_con = $this->checkProvince();
                   
                    
                    $hotel_city = $this->TravelCity->find
                    (
                    'all', array
                (
                'fields' => array('TravelCity.city_code', 'TravelCity.city_name'),
                'conditions' => array
                    (
                    'TravelCity.city_code IN (SELECT pf_city_code FROM travel_city_suppliers WHERE supplier_code = "' . $city_supplier_code . '" AND city_country_code ="' . $hotel_country_code . '" AND active = TRUE AND wtb_status=1)',
                    'TravelCity.city_status' => '1','TravelCity.active' =>'TRUE','TravelCity.province_id' => $city_con
                ),
                'order' => 'TravelCity.city_name ASC'
                    )
            );

                   
                    
                      //$log = $this->TravelCity->getDataSource()->getLog(false, false);       
                     //debug($log);
                      //die;


                    $hotel_city = Set::combine($hotel_city, '{n}.TravelCity.city_code', array('%s - %s', '{n}.TravelCity.city_code', '{n}.TravelCity.city_name'));
                    $hotel_list = $this->TravelHotelLookup->find
                            (
                            'all', array
                        (
                        'fields' => array('TravelHotelLookup.hotel_code', 'TravelHotelLookup.hotel_name'),
                        'conditions' => array
                            (
                            'TravelHotelLookup.hotel_code NOT IN (SELECT hotel_code FROM travel_hotel_room_suppliers WHERE supplier_code = "' . $city_supplier_code . '" AND hotel_country_code ="' . $hotel_country_code . '" AND hotel_city_code ="' . $hotel_city_code . '")',
                            'TravelHotelLookup.active' => 'TRUE', 'TravelHotelLookup.city_code LIKE' => '%' . trim($hotel_city_code) . '%', 'TravelHotelLookup.country_code LIKE' => '%' . trim($hotel_country_code) . '%'
                        ),
                        'order' => 'TravelHotelLookup.hotel_name ASC'
                            )
                    );
                    
                    


                    $hotel_list = Set::combine($hotel_list, '{n}.TravelHotelLookup.hotel_code', array('%s - %s', '{n}.TravelHotelLookup.hotel_code', '{n}.TravelHotelLookup.hotel_name'));

                    if (!empty($this->data['Mapping']['hotel_code'])) {
                        $hotel_code = $this->data['Mapping']['hotel_code'];
                        $hotel_name_arr = $this->TravelHotelLookup->findByHotelCode($this->data['Mapping']['hotel_code'], array('fields' => 'hotel_name'));
                        //$city_name = substr(trim($city_name_arr['TravelCity'  ]['city_name']), 0, 2);
                        $hotel_name = $hotel_name_arr['TravelHotelLookup']['hotel_name'];


                        for ($indexOfFirstLetter = 0; $indexOfFirstLetter <= strlen($hotel_name); $indexOfFirstLetter++) {
                            for ($indexOfLastLetter = $indexOfFirstLetter + 1; $indexOfLastLetter <= strlen($hotel_name); $indexOfLastLetter++) {
                                $arr[] = substr($hotel_name, $indexOfFirstLetter, 3);
                                $condition .= "(hotel_name LIKE '%" . $arr[$indexOfFirstLetter] . "%')";
                                if ($indexOfFirstLetter < strlen($hotel_name) - 1)
                                    $condition .= 'OR';
                                $indexOfFirstLetter++;
                            }
                        }
                    }
                    
                    
                    
                    $Mappinges = $this->TravelHotelRoomSupplier->find
                            (
                            'all', array
                        (
                        'conditions' => array
                            (
                            'TravelHotelRoomSupplier.hotel_code IN (SELECT hotel_code FROM travel_hotel_lookups WHERE country_code = "' . $hotel_country_code . '"  AND city_code LIKE "%' . $hotel_city_code . '%" AND (' . $condition . '))',
                            'TravelHotelRoomSupplier.hotel_city_code' => $hotel_city_code, 'TravelHotelRoomSupplier.hotel_country_code' => $hotel_country_code, 'TravelHotelRoomSupplier.supplier_code' => $city_supplier_code
                        ),
                        'order' => 'TravelHotelRoomSupplier.hotel_city_code ASC',
                            )
                    );
                    
                       

                    $this->set('Mappinges', $Mappinges);
                    
                    $hotelArray = $this->TravelHotelLookup->find('first',array('conditions' => array('hotel_code' => $hotel_code),'fields' => array('suburb_id','area_id','chain_id','brand_id','url_hotel','address')));
                    
                    $TravelSuburbs = $this->TravelSuburb->find('list', array(
                                    'conditions' => array(
                                        'TravelSuburb.id' => $hotelArray['TravelHotelLookup']['suburb_id'],
                                    ),
                                    'fields' => 'TravelSuburb.id, TravelSuburb.name',
                                    'order' => 'TravelSuburb.name ASC'
                                ));
                    
                    $TravelAreas = $this->TravelArea->find('list', array(
                'conditions' => array(
                    'TravelArea.id' => $hotelArray['TravelHotelLookup']['area_id'],                   
                ),
                'fields' => 'TravelArea.id, TravelArea.area_name',
                'order' => 'TravelArea.area_name ASC'
            ));
                    
                   
                    
                    $TravelChains = $this->TravelChain->find('list', array(
                'conditions' => array(
                    'TravelChain.id' => $hotelArray['TravelHotelLookup']['chain_id'],
                  
                ),
                'fields' => 'TravelChain.id, TravelChain.chain_name',
                'order' => 'TravelChain.chain_name ASC'
            ));
                    
                    $TravelBrands = $this->TravelBrand->find('list', array(
                'conditions' => array(
                    'TravelBrand.id' => $hotelArray['TravelHotelLookup']['brand_id'],
                ),
                'fields' => 'TravelBrand.id, TravelBrand.brand_name',
                'order' => 'TravelBrand.brand_name ASC'
            ));
                   $proArr = array();
                if($this->checkProvince())
                    $proArr = $this->checkProvince();
                
                    $Provinces = $this->Province->find('list', array(
                'conditions' => array(                    
                    'Province.country_code' => trim($hotel_country_code),
                    'Province.status' => '1',
                    'Province.wtb_status' => '1',
                    'Province.active' => 'TRUE',
                    'Province.id' => $proArr
                ),
                'fields' => array('Province.id', 'Province.name'),
                'order' => 'Province.name ASC'
            ));
                    
                    $website_url = $hotelArray['TravelHotelLookup']['url_hotel'];
                    $address = $hotelArray['TravelHotelLookup']['address'];
                    
                    
                }
            } elseif ($this->data['Mapping']['operation'] == 'add') {
               
                if ($this->data['Mapping']['mapping_type'] == '1') { // supplier country
                    $this->request->data['Mappinge']['supplier_code'] = $this->data['Mapping']['country_supplier_code'];
                    $this->request->data['Mappinge']['mapping_type'] = '1'; // supplier country
                    $this->request->data['Mappinge']['country_wtb_code'] = $this->data['Mapping']['pf_country_code'];
                    $this->request->data['Mappinge']['country_supplier_code'] = $this->data['Mapping']['supplier_country_code'];

                    $this->request->data['TravelCountrySupplier']['country_suppliner_status'] = '1'; // 1 for Submission For Approval [None] of the travel_action_item_types
                    $this->request->data['TravelCountrySupplier']['excluded'] = 'FALSE'; // 2 for No of lookup_value_statuses
                    $this->request->data['TravelCountrySupplier']['wtb_status'] = '1'; // 1 for True
                    $this->request->data['TravelCountrySupplier']['active'] = 'FALSE'; // 2 for No of lookup_value_statuses
                    $this->request->data['TravelCountrySupplier']['supplier_code'] = $this->data['Mapping']['country_supplier_code'];
                    $this->request->data['TravelCountrySupplier']['supplier_country_code'] = $this->data['Mapping']['supplier_country_code'];
                    $this->request->data['TravelCountrySupplier']['pf_country_code'] = $this->data['Mapping']['pf_country_code'];
                    $country_name_arr = $this->TravelCountry->findByCountryCode($this->data['Mapping']['pf_country_code'], array('fields' => 'country_name', 'id', 'continent_id', 'continent_name'));

                    $this->request->data['TravelCountrySupplier']['country_name'] = $country_name_arr['TravelCountry']['country_name'];
                    $this->request->data['TravelCountrySupplier']['country_id'] = $country_name_arr['TravelCountry']['id'];
                    $this->request->data['TravelCountrySupplier']['country_continent_id'] = $country_name_arr['TravelCountry']['continent_id'];
                    $this->request->data['TravelCountrySupplier']['country_continent_name'] = $country_name_arr['TravelCountry']['continent_name'];
                    $this->request->data['TravelCountrySupplier']['country_mapping_name'] = strtoupper('[SUPP/COUNTRY] | ' . $this->data['Mapping']['country_supplier_code'] . ' | ' . $this->data['Mapping']['pf_country_code'] . ' - ' . $country_name_arr['TravelCountry']['country_name']);
                    $this->request->data['TravelCountrySupplier']['created_by'] = $user_id;

                    $tr_remarks['TravelRemark']['remarks_level'] = '2'; // for Mapping Country from travel_action_remark_levels
                    $tr_remarks['TravelRemark']['remarks'] = 'New Supplier Country Record Created';


                    $tr_action_item['TravelActionItem']['level_id'] = '2'; // for agent travel_action_remark_levels
                    $tr_action_item['TravelActionItem']['description'] = 'New Supplier Country Record Created - Submission For Approval';


                    $this->TravelCountrySupplier->save($this->request->data['TravelCountrySupplier']);
                    $country_supplier_id = $this->TravelCountrySupplier->getLastInsertId();
                    if ($country_supplier_id) {

                        $this->request->data['Mappinge']['country_supplier_id'] = $country_supplier_id;
                        $tr_remarks['TravelRemark']['country_supplier_id'] = $country_supplier_id;
                        $tr_action_item['TravelActionItem']['country_supplier_id'] = $country_supplier_id;
                        $flag = 1;
                    }
                } elseif ($this->data['Mapping']['mapping_type'] == '2') { // supplier city
                    $this->request->data['Mappinge']['supplier_code'] = $this->data['Mapping']['city_supplier_code'];
                    $this->request->data['Mappinge']['mapping_type'] = '2'; // supplier country
                    $this->request->data['Mappinge']['city_wtb_code'] = $this->data['Mapping']['pf_city_code'];
                    $this->request->data['Mappinge']['city_supplier_code'] = $this->data['Mapping']['supplier_city_code'];
                    $this->request->data['Mappinge']['country_wtb_code'] = $this->data['Mapping']['city_country_code'];



                    $this->request->data['TravelCitySupplier']['city_supplier_status'] = '1'; // 1 for Submission For Approval [None] of the travel_action_item_types
                    $this->request->data['TravelCitySupplier']['active'] = 'FALSE'; // 2 for No of lookup_value_statuses
                    $this->request->data['TravelCitySupplier']['excluded'] = 'FALSE'; // 2 for No of lookup_value_statuses
                    $this->request->data['TravelCitySupplier']['wtb_status'] = '1'; // 1 = true
                    $this->request->data['TravelCitySupplier']['supplier_code'] = $this->data['Mapping']['city_supplier_code'];
                    $this->request->data['TravelCitySupplier']['supplier_city_code'] = $this->data['Mapping']['supplier_city_code'];
                    $this->request->data['TravelCitySupplier']['pf_city_code'] = $this->data['Mapping']['pf_city_code'];
                    $this->request->data['TravelCitySupplier']['city_country_code'] = $this->data['Mapping']['city_country_code'];
                    $this->request->data['TravelCitySupplier']['province_id'] = $this->data['Mapping']['city_province_id'];
                    $this->request->data['TravelCitySupplier']['province_name'] = $this->data['Mapping']['city_province_name'];
                    $city_name_arr = $this->TravelCity->findByCityCode($this->data['Mapping']['pf_city_code'], array('fields' => 'city_name', 'id'));
                    $this->request->data['TravelCitySupplier']['city_name'] = $city_name_arr['TravelCity']['city_name'];
                    $this->request->data['TravelCitySupplier']['city_id'] = $city_name_arr['TravelCity']['id'];
                    $this->request->data['TravelCitySupplier']['city_mapping_name'] = strtoupper('[SUPP/CITY] | ' . $this->data['Mapping']['city_supplier_code'] . ' | ' . $this->data['Mapping']['city_country_code'] . ' | ' . $this->data['Mapping']['pf_city_code'] . ' - ' . $city_name_arr['TravelCity']['city_name']);
                    $this->request->data['TravelCitySupplier']['created_by'] = $user_id;

                    $supp_country_code = $this->TravelCountrySupplier->find('first', array('fields' => array('supplier_country_code', 'country_id', 'country_name', 'country_continent_id', 'country_continent_name'), 'conditions' => array('supplier_code' => $this->data['Mapping']['city_supplier_code'], 'pf_country_code' => $this->data['Mapping']['city_country_code'])));
                    $this->request->data['TravelCitySupplier']['city_country_name'] = $supp_country_code['TravelCountrySupplier']['country_name'];
                    $this->request->data['TravelCitySupplier']['city_country_id'] = $supp_country_code['TravelCountrySupplier']['country_id'];
                    $this->request->data['TravelCitySupplier']['city_continent_id'] = $supp_country_code['TravelCountrySupplier']['country_continent_id'];
                    $this->request->data['TravelCitySupplier']['city_continent_name'] = $supp_country_code['TravelCountrySupplier']['country_continent_name'];
                    $this->request->data['TravelCitySupplier']['supplier_coutry_code'] = $supp_country_code['TravelCountrySupplier']['supplier_country_code'];
                    $this->request->data['Mappinge']['country_supplier_code'] = $supp_country_code['TravelCountrySupplier']['supplier_country_code'];

                    $tr_remarks['TravelRemark']['remarks_level'] = '3'; // for Mapping City from travel_action_remark_levels
                    $tr_remarks['TravelRemark']['remarks'] = 'New Supplier City Record Created';


                    $tr_action_item['TravelActionItem']['level_id'] = '3'; // for agent travel_action_remark_levels            
                    $tr_action_item['TravelActionItem']['description'] = 'New Supplier City Record Created - Submission For Approval';


                    $this->TravelCitySupplier->save($this->request->data['TravelCitySupplier']);
                    $city_supplier_id = $this->TravelCitySupplier->getLastInsertId();
                    if ($city_supplier_id) {
                        $this->request->data['Mappinge']['city_supplier_id'] = $city_supplier_id;
                        $tr_remarks['TravelRemark']['city_supplier_id'] = $city_supplier_id;
                        $tr_action_item['TravelActionItem']['city_supplier_id'] = $city_supplier_id;
                        $flag = 1;
                    }
                } elseif ($this->data['Mapping']['mapping_type'] == '3') { // supplier hotel room 
                    $this->request->data['Mappinge']['supplier_code'] = $this->data['Mapping']['hotel_supplier_code'];
                    $this->request->data['Mappinge']['mapping_type'] = '3'; // supplier hotel
                    $this->request->data['Mappinge']['hotel_wtb_code'] = $this->data['Mapping']['hotel_code'];
                    $this->request->data['Mappinge']['hotel_supplier_code'] = $this->data['Mapping']['supplier_item_code1'];
                    $this->request->data['Mappinge']['city_wtb_code'] = $this->data['Mapping']['hotel_city_code'];
                    $this->request->data['Mappinge']['country_wtb_code'] = $this->data['Mapping']['hotel_country_code'];

                    $this->request->data['TravelHotelRoomSupplier']['hotel_supplier_status'] = '1'; // 1 for Submission For Approval [None] of the travel_action_item_types
                    $this->request->data['TravelHotelRoomSupplier']['active'] = 'FALSE'; // 2 for No of lookup_value_statuses
                    $this->request->data['TravelHotelRoomSupplier']['excluded'] = 'FALSE'; // 2 for No of lookup_value_statuses
                    $this->request->data['TravelHotelRoomSupplier']['wtb_status'] = '1'; // 1 = true
                    $this->request->data['TravelHotelRoomSupplier']['hotel_code'] = $this->data['Mapping']['hotel_code'];
                    $this->request->data['TravelHotelRoomSupplier']['supplier_code'] = $this->data['Mapping']['hotel_supplier_code'];
                    $hotel_name_arr = $this->TravelHotelLookup->findByHotelCode($this->data['Mapping']['hotel_code'], array('fields' => 'hotel_name', 'id'));
                    $this->request->data['TravelHotelRoomSupplier']['hotel_mapping_name'] = strtoupper('[SUPP/HOTEL] | ' . $this->data['Mapping']['hotel_supplier_code'] . ' | ' . $this->data['Mapping']['hotel_country_code'] . ' | ' . $this->data['Mapping']['hotel_city_code'] . ' | ' . $this->data['Mapping']['hotel_code'] . ' - ' . $hotel_name_arr['TravelHotelLookup']['hotel_name']);
                    $this->request->data['TravelHotelRoomSupplier']['hotel_name'] = $hotel_name_arr['TravelHotelLookup']['hotel_name'];
                    $this->request->data['TravelHotelRoomSupplier']['hotel_id'] = $hotel_name_arr['TravelHotelLookup']['id'];
                    $this->request->data['TravelHotelRoomSupplier']['hotel_country_code'] = $this->data['Mapping']['hotel_country_code'];
                    $this->request->data['TravelHotelRoomSupplier']['supplier_item_code1'] = $this->data['Mapping']['supplier_item_code1'];
                    $this->request->data['TravelHotelRoomSupplier']['hotel_country_code'] = $this->data['Mapping']['hotel_country_code'];
                    $this->request->data['TravelHotelRoomSupplier']['hotel_city_code'] = $this->data['Mapping']['hotel_city_code'];
                    $TravelAreas = $this->TravelArea->find('first', array('fields' => array('area_name'), 'conditions' => array('id' => $this->data['Mapping']['hotel_area_id'])));
                    $this->request->data['TravelHotelRoomSupplier']['hotel_area_id'] = $this->data['Mapping']['hotel_area_id'];
                    $this->request->data['TravelHotelRoomSupplier']['hotel_area_name'] = $TravelAreas['TravelArea']['area_name'];
                    $TravelBrands = $this->TravelBrand->find('first', array('fields' => array('TravelBrand.brand_name'), 'conditions' => array('TravelBrand.id' => $this->data['Mapping']['hotel_brand_id'])));
                    $this->request->data['TravelHotelRoomSupplier']['hotel_brand_id'] = $this->data['Mapping']['hotel_brand_id'];
                    $this->request->data['TravelHotelRoomSupplier']['hotel_brand_name'] = $TravelBrands['TravelBrand']['brand_name'];
                    $TravelSuburbs = $this->TravelSuburb->find('first', array('fields' => array('TravelSuburb.name'), 'conditions' => array('TravelSuburb.id' => $this->data['Mapping']['hotel_suburb_id'])));
                    $this->request->data['TravelHotelRoomSupplier']['hotel_suburb_id'] = $this->data['Mapping']['hotel_suburb_id'];
                    $this->request->data['TravelHotelRoomSupplier']['hotel_suburb_name'] = $TravelSuburbs['TravelSuburb']['name'];
                    $TravelChains = $this->TravelChain->find('first', array('fields' => array('TravelChain.chain_name'), 'conditions' => array('TravelChain.id' => $this->data['Mapping']['hotel_chain_id'])));        
                    $this->request->data['TravelHotelRoomSupplier']['hotel_chain_id'] = $this->data['Mapping']['hotel_chain_id'];
                    $this->request->data['TravelHotelRoomSupplier']['hotel_chain_name'] = $TravelChains['TravelChain']['chain_name'];
                    $this->request->data['TravelHotelRoomSupplier']['created_by'] = $user_id;
                    $this->request->data['TravelHotelRoomSupplier']['province_id'] = $this->data['Mapping']['hotel_province_id'];
                    $this->request->data['TravelHotelRoomSupplier']['province_name'] = $this->data['Mapping']['hotel_province_name'];

                    $supp_country_code = $this->TravelCountrySupplier->find('first', array('fields' => array('supplier_country_code', 'country_id', 'country_name', 'country_continent_id', 'country_continent_name'), 'conditions' => array('supplier_code' => $this->data['Mapping']['hotel_supplier_code'], 'pf_country_code' => $this->data['Mapping']['hotel_country_code'])));
                    //$supp_country_code = $this->TravelCountrySupplier->find('first', array('fields' => array('supplier_country_code'), 'conditions' => array('supplier_code' => $this->data['Mapping']['hotel_supplier_code'], 'pf_country_code' => $this->data['Mapping']['hotel_country_code'])));
                    $this->request->data['TravelHotelRoomSupplier']['supplier_item_code4'] = $supp_country_code['TravelCountrySupplier']['supplier_country_code'];
                    $this->request->data['Mappinge']['country_supplier_code'] = $supp_country_code['TravelCountrySupplier']['supplier_country_code'];
                    $this->request->data['TravelHotelRoomSupplier']['hotel_country_id'] = $supp_country_code['TravelCountrySupplier']['country_id'];
                    $this->request->data['TravelHotelRoomSupplier']['hotel_country_name'] = $supp_country_code['TravelCountrySupplier']['country_name'];
                    $this->request->data['TravelHotelRoomSupplier']['hotel_continent_id'] = $supp_country_code['TravelCountrySupplier']['country_continent_id'];
                    $this->request->data['TravelHotelRoomSupplier']['hotel_continent_name'] = $supp_country_code['TravelCountrySupplier']['country_continent_name'];

                    $supp_city_code = $this->TravelCitySupplier->find('first', array('fields' => array('supplier_city_code', 'city_id', 'city_name'), 'conditions' => array('supplier_code' => $this->data['Mapping']['hotel_supplier_code'], 'pf_city_code' => $this->data['Mapping']['hotel_city_code'], 'city_country_code' => $this->data['Mapping']['hotel_country_code'])));
                    $this->request->data['TravelHotelRoomSupplier']['supplier_item_code3'] = $supp_city_code['TravelCitySupplier']['supplier_city_code'];
                    $this->request->data['TravelHotelRoomSupplier']['hotel_city_id'] = $supp_city_code['TravelCitySupplier']['city_id'];
                    $this->request->data['TravelHotelRoomSupplier']['hotel_city_name'] = $supp_city_code['TravelCitySupplier']['city_name'];
                    $this->request->data['Mappinge']['city_supplier_code'] = $supp_city_code['TravelCitySupplier']['supplier_city_code'];

                    $tr_remarks['TravelRemark']['remarks_level'] = '4'; // for Mapping City from travel_action_remark_levels
                    $tr_remarks['TravelRemark']['remarks'] = 'New Supplier Hotel Record Created';

                    $tr_action_item['TravelActionItem']['level_id'] = '4'; // for agent travel_action_remark_levels                 
                    $tr_action_item['TravelActionItem']['description'] = 'New Supplier Hotel Record Created - Submission For Approval';
                    
            $continent_id = $TravelHotelLookups['TravelHotelLookup']['continent_id'];
            $country_id = $TravelHotelLookups['TravelHotelLookup']['country_id'];
            $province_id = $TravelHotelLookups['TravelHotelLookup']['province_id'];  
         

            $permissionArray = $this->ProvincePermission->find('first', array('conditions' => array('continent_id' => $continent_id, 'country_id' => $country_id, 'province_id' => $province_id, 'user_id' => $user_id)));
            if (isset($permissionArray['ProvincePermission']['maaping_approval_id']))
            $next_action_by = $permissionArray['ProvincePermission']['maaping_approval_id'];
            else
            $next_action_by = '169';
            
                    $this->TravelHotelRoomSupplier->save($this->request->data['TravelHotelRoomSupplier']);
                    //$this->TravelHotelLookup->updateAll(array('TravelHotelLookup.active' => "'FALSE'"), array('TravelHotelLookup.id' => $hotel_name_arr['TravelHotelLookup']['id']));
                    $hotel_supplier_id = $this->TravelHotelRoomSupplier->getLastInsertId();
                    if ($hotel_supplier_id) {
                        $this->request->data['Mappinge']['hotel_supplier_id'] = $hotel_supplier_id;
                        $tr_remarks['TravelRemark']['hotel_supplier_id'] = $hotel_supplier_id;
                        $tr_action_item['TravelActionItem']['hotel_supplier_id'] = $hotel_supplier_id;
                        $flag = 1;
                    }
                }

                /*
                 * ***************** Remarks *******************
                 */
                if ($flag) {


                    $this->request->data['Mappinge']['created_by'] = $user_id;
                    $this->request->data['Mappinge']['status'] = '1'; // 1 for Submission For Approval [None] of the travel_action_item_types
                    $this->request->data['Mappinge']['exclude'] = '2'; // 2 for No of lookup_value_statuses
                    $this->request->data['Mappinge']['dummy_status'] = $dummy_status;
                    $this->Mappinge->save($this->request->data['Mappinge']);

                    $tr_remarks['TravelRemark']['created_by'] = $user_id;
                    $tr_remarks['TravelRemark']['remarks_time'] = date('g:i A');

                    $tr_remarks['TravelRemark']['dummy_status'] = $dummy_status;
                    $this->TravelRemark->save($tr_remarks);




                    /*
                     * ********************** Action *********************
                     */

                    $tr_action_item['TravelActionItem']['type_id'] = '1'; // 1 for Submission For Approval [None] of the travel_action_item_types
                    $tr_action_item['TravelActionItem']['action_item_active'] = 'Yes';
                    $tr_action_item['TravelActionItem']['action_item_source'] = $role_id;
                    $tr_action_item['TravelActionItem']['created_by_id'] = $user_id;
                    $tr_action_item['TravelActionItem']['created_by'] = $user_id;
                    $tr_action_item['TravelActionItem']['dummy_status'] = $dummy_status;
                    $tr_action_item['TravelActionItem']['next_action_by'] = $next_action_by;
                    $tr_action_item['TravelActionItem']['parent_action_item_id'] = '';
                    $this->TravelActionItem->save($tr_action_item);
                    $ActionId = $this->TravelActionItem->getLastInsertId();
                    $ActionUpdateArr['TravelActionItem']['parent_action_item_id'] = "'" . $ActionId . "'";
                    $this->TravelActionItem->updateAll($ActionUpdateArr['TravelActionItem'], array('TravelActionItem.id' => $ActionId));

                    $this->Session->setFlash('Your changes have been submitted. Waiting for approval at the moment...', 'success');
                    $this->redirect(array('controller' => 'mappinges', 'action' => 'index'));
                }
                else
                    $this->Session->setFlash('Unable to add Action item.', 'failure');
            }
            elseif ($this->data['Mapping']['operation'] == 'duplicate') {
                if ($this->data['Mapping']['mapping_type'] == '2') { // supplier city
                    $this->request->data['DuplicateMappinge']['supplier_code'] = $this->data['Mapping']['city_supplier_code'];
                    $this->request->data['DuplicateMappinge']['mapping_type'] = '2'; // supplier country
                    $this->request->data['DuplicateMappinge']['city_wtb_code'] = $this->data['Mapping']['pf_city_code'];
                    $this->request->data['DuplicateMappinge']['city_supplier_code'] = $this->data['Mapping']['supplier_city_code'];
                    $this->request->data['DuplicateMappinge']['country_wtb_code'] = $this->data['Mapping']['city_country_code'];

                    $supp_country_code = $this->TravelCountrySupplier->find('first', array('fields' => array('supplier_country_code'), 'conditions' => array('supplier_code' => $this->data['Mapping']['city_supplier_code'], 'pf_country_code' => $this->data['Mapping']['city_country_code'])));
                    $this->request->data['DuplicateMappinge']['country_supplier_code'] = $supp_country_code['TravelCountrySupplier']['supplier_country_code'];

                    $dp_remarks['TravelRemark']['remarks_level'] = '5'; // for duplicate City from travel_action_remark_levels
                    $dp_remarks['TravelRemark']['remarks'] = 'Duplicate Supplier City Record Created';
                    $dp_action_item['TravelActionItem']['level_id'] = '5'; // for duplicate city travel_action_remark_levels            
                    $dp_action_item['TravelActionItem']['description'] = 'Duplicate Supplier City Record Created - Submission For Approval';

                    $city_name_arr = $this->TravelCity->findByCityCode($this->data['Mapping']['pf_city_code'], array('fields' => 'city_name'));
                    $this->request->data['DuplicateMappinge']['mapping_name'] = strtoupper($this->data['Mapping']['pf_city_code'] . ' - ' . $city_name_arr['TravelCity']['city_name']);
                    $success .='1';
                } elseif ($this->data['Mapping']['mapping_type'] == '3') {
                    $this->request->data['DuplicateMappinge']['supplier_code'] = $this->data['Mapping']['hotel_supplier_code'];
                    $this->request->data['DuplicateMappinge']['mapping_type'] = '3'; // supplier hotel
                    $this->request->data['DuplicateMappinge']['city_wtb_code'] = $this->data['Mapping']['hotel_city_code'];
                    //$this->request->data['DuplicateMappinge']['city_supplier_code'] = $this->data['Mapping']['supplier_city_code'];
                    $this->request->data['DuplicateMappinge']['country_wtb_code'] = $this->data['Mapping']['hotel_country_code'];
                    $this->request->data['DuplicateMappinge']['hotel_wtb_code'] = $this->data['Mapping']['hotel_code'];
                    $this->request->data['DuplicateMappinge']['hotel_supplier_code'] = $this->data['Mapping']['supplier_item_code1'];

                    $supp_country_code = $this->TravelCountrySupplier->find('first', array('fields' => array('supplier_country_code'), 'conditions' => array('supplier_code' => $this->data['Mapping']['hotel_supplier_code'], 'pf_country_code' => $this->data['Mapping']['hotel_country_code'])));
                    $this->request->data['DuplicateMappinge']['country_supplier_code'] = $supp_country_code['TravelCountrySupplier']['supplier_country_code'];
                    $supp_city_code = $this->TravelCitySupplier->find('first', array('fields' => array('supplier_city_code'), 'conditions' => array('supplier_code' => $this->data['Mapping']['hotel_supplier_code'], 'pf_city_code' => $this->data['Mapping']['hotel_city_code'], 'city_country_code' => $this->data['Mapping']['hotel_country_code'])));
                    $this->request->data['DuplicateMappinge']['city_supplier_code'] = $supp_city_code['TravelCitySupplier']['supplier_city_code'];

                    $dp_remarks['TravelRemark']['remarks_level'] = '6'; // for duplicate City from travel_action_remark_levels
                    $dp_remarks['TravelRemark']['remarks'] = 'Duplicate Supplier Hotel Record Created';
                    $dp_action_item['TravelActionItem']['level_id'] = '6'; // for duplicate city travel_action_remark_levels            
                    $dp_action_item['TravelActionItem']['description'] = 'Duplicate Supplier Hotel Record Created - Submission For Approval';


                    $hotel_name_arr = $this->TravelHotelLookup->findByHotelCode($this->data['Mapping']['hotel_code'], array('fields' => 'hotel_name'));
                    $this->request->data['DuplicateMappinge']['mapping_name'] = strtoupper($this->data['Mapping']['hotel_code'] . ' - ' . $hotel_name_arr['TravelHotelLookup']['hotel_name']);

                    $success .='2';
                }


                $this->request->data['DuplicateMappinge']['duplicate_id'] = $this->data['Mapping']['duplicate'];
                $this->request->data['DuplicateMappinge']['created_by'] = $user_id;
                $this->request->data['DuplicateMappinge']['status'] = '1'; // 1 for Submission For Approval [None] of the travel_action_item_types
                $this->request->data['DuplicateMappinge']['exclude'] = '2'; // 2 for No of lookup_value_statuses
                $this->request->data['DuplicateMappinge']['dummy_status'] = $dummy_status;




                $dp_remarks['TravelRemark']['created_by'] = $user_id;
                $dp_remarks['TravelRemark']['remarks_time'] = date('g:i A');
                $dp_remarks['TravelRemark']['dummy_status'] = $dummy_status;



                $dp_action_item['TravelActionItem']['type_id'] = '1'; // 1 for Submission For Approval [None] of the travel_action_item_types
                $dp_action_item['TravelActionItem']['action_item_active'] = 'Yes';
                $dp_action_item['TravelActionItem']['action_item_source'] = $role_id;
                $dp_action_item['TravelActionItem']['created_by_id'] = $user_id;
                $dp_action_item['TravelActionItem']['created_by'] = $user_id;
                $dp_action_item['TravelActionItem']['dummy_status'] = $dummy_status;
                $dp_action_item['TravelActionItem']['next_action_by'] = $next_action_by;
                $dp_action_item['TravelActionItem']['parent_action_item_id'] = '';



                $this->DuplicateMappinge->save($this->request->data['DuplicateMappinge']);
                $duplicate_city_supplier_id = $this->DuplicateMappinge->getLastInsertId();
                if ($duplicate_city_supplier_id) {
                    $dp_remarks['TravelRemark']['duplicate_city_supplier_id'] = $duplicate_city_supplier_id;
                    $dp_action_item['TravelActionItem']['duplicate_city_supplier_id'] = $duplicate_city_supplier_id;
                    $this->TravelRemark->save($dp_remarks);

                    $this->TravelActionItem->save($dp_action_item);
                    $ActionId = $this->TravelActionItem->getLastInsertId();
                    $ActionUpdateArr['TravelActionItem']['parent_action_item_id'] = "'" . $ActionId . "'";
                    $this->TravelActionItem->updateAll($ActionUpdateArr['TravelActionItem'], array('TravelActionItem.id' => $ActionId));

                    $this->Session->setFlash('Your changes have been submitted. Waiting for approval at the moment...', 'success');

                    $success .='3';
                }
                if ($success == '13') //city
                    $this->TravelCity->updateAll(array('TravelCity.city_status' => "'1'"), array('TravelCity.city_code LIKE' => $this->data['Mapping']['pf_city_code']));

                if ($success == '23') //Hotel
                    $this->TravelHotelLookup->updateAll(array('TravelHotelLookup.active' => "'FALSE'"), array('TravelHotelLookup.hotel_code LIKE' => $this->data['Mapping']['hotel_code']));

                $this->redirect(array('controller' => 'mappinges', 'action' => 'index'));
            }
        }

  
        $TravelMappingTypes = $this->TravelMappingType->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));

        $TravelSuppliers = $this->TravelSupplier->find('list', array('fields' => 'supplier_code, supplier_code', 'conditions' => array('active' => 'TRUE'), 'order' => 'supplier_name ASC'));
        //$TravelSuppliers = Set::combine($TravelSuppliers, '{n}.TravelSupplier.supplier_code', array('%s - %s', '{n}.TravelSupplier.supplier_code', '{n}.TravelSupplier.supplier_name'));

        
        
        
        $this->set(compact('hotel_list','TravelSuburbs','website_url','TravelAreas','TravelChains','TravelBrands','address','hotel_city','user_id',
                'city_wtb_country','country_wtb_country','city_wtb_city','mapping_type','TravelSuppliers','TravelMappingTypes','Provinces'));
    }

    function edit_supplier_country($id = null) {

        $this->layout = '';
        $user_id = $this->Auth->user('id');
        $role_id = $this->Session->read("role_id");
        $dummy_status = $this->Auth->user('dummy_status');
        $next_action_by = '166';  //overseer 136 44 is sarika 152 - ojas
        $actio_itme_id = '';
        $flag = 0;
        $arr = explode('_', $id);
        $id = $arr[0];
        if (count($arr) > 1) {
            $actio_itme_id = $arr[1];
            $flag = 1;
        }

        if (!$id) {
            throw new NotFoundException(__('Invalid Country Supplier'));
        }

        $TravelCountrySuppliers = $this->TravelCountrySupplier->findById($id);


        if (!$TravelCountrySuppliers) {
            throw new NotFoundException(__('Invalid Country Supplier'));
        }

        if ($this->request->data) {


            $oversing_user = array();

            $this->request->data['TravelCountrySupplier']['country_suppliner_status'] = '4'; // 4 for Change Submitted of the travel_action_item_types
            $this->request->data['TravelCountrySupplier']['active'] = 'FALSE'; // 2 for No of lookup_value_statuses

            /*             * ************************* Action ********************** */
            if ($TravelCountrySuppliers['TravelCountrySupplier']['approved_by'])
                $travel_action_item['TravelActionItem']['type_id'] = '4'; // for Change Submitted of travel_action_item_types
            else
                $travel_action_item['TravelActionItem']['type_id'] = '8'; // for Submitted Approval [Creation]d of travel_action_item_types

            $travel_action_item['TravelActionItem']['country_supplier_id'] = $id;
            $travel_action_item['TravelActionItem']['level_id'] = '2';  // for agent travel_action_remark_levels 

            $travel_action_item['TravelActionItem']['next_action_by'] = $next_action_by;
            $travel_action_item['TravelActionItem']['action_item_active'] = 'Yes';
            $travel_action_item['TravelActionItem']['description'] = 'Supplier Country Record Updated - Re-Submission For Approval';
            $travel_action_item['TravelActionItem']['action_item_source'] = $role_id;
            $travel_action_item['TravelActionItem']['created_by_id'] = $user_id;
            $travel_action_item['TravelActionItem']['created_by'] = $user_id;
            $travel_action_item['TravelActionItem']['dummy_status'] = $dummy_status;
            $travel_action_item['TravelActionItem']['parent_action_item_id'] = $actio_itme_id;


            /*             * ********************* Remarks ******************************** */
            $travel_remarks['TravelRemark']['country_supplier_id'] = $id;
            $travel_remarks['TravelRemark']['remarks'] = 'Edit Supplier Country Record';
            $travel_remarks['TravelRemark']['created_by'] = $user_id;
            $travel_remarks['TravelRemark']['remarks_time'] = date('g:i A');
            $travel_remarks['TravelRemark']['remarks_level'] = '2';  // for mapping country travel_action_remark_levels 
            $travel_remarks['TravelRemark']['dummy_status'] = $dummy_status;
            $this->TravelRemark->save($travel_remarks);


            $this->TravelCountrySupplier->id = $id;
            if ($this->TravelCountrySupplier->save($this->request->data['TravelCountrySupplier'])) {
                $this->TravelActionItem->save($travel_action_item);
                $ActionId = $this->TravelActionItem->getLastInsertId();
                if ($actio_itme_id) {
                    $this->TravelActionItem->updateAll(array('TravelActionItem.action_item_active' => "'No'"), array('TravelActionItem.id' => $actio_itme_id));
                }
                $this->Session->setFlash('Your changes have been submitted. Waiting for approval at the moment...', 'success');
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


        $TravelSuppliers = $this->TravelSupplier->find('all', array('fields' => 'supplier_code, supplier_name', 'conditions' => array('active' => 'TRUE'), 'order' => 'supplier_name ASC'));
        $TravelSuppliers = Set::combine($TravelSuppliers, '{n}.TravelSupplier.supplier_code', array('%s - %s', '{n}.TravelSupplier.supplier_code', '{n}.TravelSupplier.supplier_name'));
        $this->set(compact('TravelSuppliers'));

        $TravelCountries = $this->TravelCountry->find('all', array('fields' => 'country_code, country_name','conditions' => array('TravelCountry.country_status' => '1','TravelCountry.active' => 'TRUE','TravelCountry.wtb_status' => '1'), 'order' => 'country_name ASC'));
        $TravelCountries = Set::combine($TravelCountries, '{n}.TravelCountry.country_code', array('%s - %s', '{n}.TravelCountry.country_code', '{n}.TravelCountry.country_name'));
        $this->set(compact('TravelCountries'));


        $this->request->data = $TravelCountrySuppliers;
    }

    function edit_supplier_city($id = null) {

        $this->layout = '';
        $user_id = $this->Auth->user('id');
        $role_id = $this->Session->read("role_id");
        $dummy_status = $this->Auth->user('dummy_status');
        //$next_action_by = '166';  //overseer 136 44 is sarika 152 - ojas
        $actio_itme_id = '';
        $flag = 0;
        $arr = explode('_', $id);

        $id = $arr[0];
        if (count($arr) > 1) {
            $actio_itme_id = $arr[1];
            $flag = 1;
        }

        if (!$id) {
            throw new NotFoundException(__('Invalid City Supplier'));
        }

        $TravelCitySuppliers = $this->TravelCitySupplier->findById($id);


        if (!$TravelCitySuppliers) {
            throw new NotFoundException(__('Invalid City Supplier'));
        }

        if ($this->request->data) {

            $permissionArray = $this->ProvincePermission->find('first',array('conditions' => array('continent_id' => $TravelCitySuppliers['TravelCitySupplier']['city_continent_id'],'country_id' => $TravelCitySuppliers['TravelCitySupplier']['city_country_id'],'province_id' => $TravelCitySuppliers['TravelCitySupplier']['province_id'],'user_id' => $user_id)));  
                    if(isset($permissionArray['ProvincePermission']['approval_id']))
                        $next_action_by = $permissionArray['ProvincePermission']['approval_id'];
                    else
                        $next_action_by = '166'; //Infra Mapping
            $oversing_user = array();

            $this->request->data['TravelCitySupplier']['city_supplier_status'] = '4'; // 4 for Change Submitted of the travel_action_item_types
            $this->request->data['TravelCitySupplier']['active'] = 'FALSE'; // 2 for No of lookup_value_statuses

            /*             * ************************* Action ********************** */
            if ($TravelCitySuppliers['TravelCitySupplier']['approved_by'])
                $travel_action_item['TravelActionItem']['type_id'] = '4'; // for Change Submitted of travel_action_item_types
            else
                $travel_action_item['TravelActionItem']['type_id'] = '8'; // for Submitted Approval [Creation]d of travel_action_item_types

            $travel_action_item['TravelActionItem']['city_supplier_id'] = $id;
            $travel_action_item['TravelActionItem']['level_id'] = '3';  // for mapping city travel_action_remark_levels 

            $travel_action_item['TravelActionItem']['next_action_by'] = $next_action_by;
            $travel_action_item['TravelActionItem']['action_item_active'] = 'Yes';
            $travel_action_item['TravelActionItem']['description'] = 'Supplier City Record Updated - Re-Submission For Approval';
            $travel_action_item['TravelActionItem']['action_item_source'] = $role_id;
            $travel_action_item['TravelActionItem']['created_by_id'] = $user_id;
            $travel_action_item['TravelActionItem']['created_by'] = $user_id;
            $travel_action_item['TravelActionItem']['dummy_status'] = $dummy_status;
            $travel_action_item['TravelActionItem']['parent_action_item_id'] = $actio_itme_id;


            /*             * ********************* Remarks ******************************** */
            $travel_remarks['TravelRemark']['city_supplier_id'] = $id;
            $travel_remarks['TravelRemark']['remarks'] = 'Edit Supplier City Record';
            $travel_remarks['TravelRemark']['created_by'] = $user_id;
            $travel_remarks['TravelRemark']['remarks_time'] = date('g:i A');
            $travel_remarks['TravelRemark']['remarks_level'] = '3';  // for mapping country travel_action_remark_levels 
            $travel_remarks['TravelRemark']['dummy_status'] = $dummy_status;
            $this->TravelRemark->save($travel_remarks);


            $this->TravelCitySupplier->id = $id;
            if ($this->TravelCitySupplier->save($this->request->data['TravelCitySupplier'])) {

                $this->TravelActionItem->save($travel_action_item);
                $ActionId = $this->TravelActionItem->getLastInsertId();
                if ($actio_itme_id) {
                    $this->TravelActionItem->updateAll(array('TravelActionItem.action_item_active' => "'No'"), array('TravelActionItem.id' => $actio_itme_id));
                }

                $this->Session->setFlash('Your changes have been submitted. Waiting for approval at the moment...', 'success');
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


        $TravelSuppliers = $this->TravelSupplier->find('all', array('fields' => 'supplier_code, supplier_name', 'conditions' => array('active' => 'TRUE'), 'order' => 'supplier_name ASC'));
        $TravelSuppliers = Set::combine($TravelSuppliers, '{n}.TravelSupplier.supplier_code', array('%s - %s', '{n}.TravelSupplier.supplier_code', '{n}.TravelSupplier.supplier_name'));
        $this->set(compact('TravelSuppliers'));

        $TravelCountries = $this->TravelCountry->find('all', array('fields' => 'country_code, country_name', 'conditions' => array('country_code' => $TravelCitySuppliers['TravelCitySupplier']['city_country_code']), 'order' => 'country_name ASC'));
        $TravelCountries = Set::combine($TravelCountries, '{n}.TravelCountry.country_code', array('%s - %s', '{n}.TravelCountry.country_code', '{n}.TravelCountry.country_name'));
        $this->set(compact('TravelCountries'));

        $TravelCities = $this->TravelCity->find('all', array('fields' => 'city_code, city_name', 'conditions' => array('city_code' => $TravelCitySuppliers['TravelCitySupplier']['pf_city_code']), 'order' => 'city_name ASC'));
        $TravelCities = Set::combine($TravelCities, '{n}.TravelCity.city_code', array('%s - %s', '{n}.TravelCity.city_code', '{n}.TravelCity.city_name'));
        $this->set(compact('TravelCities'));


        $this->request->data = $TravelCitySuppliers;
    }

    function edit_supplier_hotel($id = null) {

        $this->layout = '';
        $user_id = $this->Auth->user('id');
        $role_id = $this->Session->read("role_id");
        $dummy_status = $this->Auth->user('dummy_status');
        //$next_action_by = '166';  //overseer 136 44 is sarika 152 ojas
        $actio_itme_id = '';
        $flag = 0;
        $arr = explode('_', $id);
        $id = $arr[0];
        if (count($arr) > 1) {
            $actio_itme_id = $arr[1];
            $flag = 1;
        }

        if (!$id) {
            throw new NotFoundException(__('Invalid Hotel Supplier'));
        }

        $TravelHotelRoomSuppliers = $this->TravelHotelRoomSupplier->findById($id);


        if (!$TravelHotelRoomSuppliers) {
            throw new NotFoundException(__('Invalid Hotel Supplier'));
        }

        if ($this->request->data) {

            $permissionArray = $this->ProvincePermission->find('first',array('conditions' => array('continent_id' => $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_continent_id'],'country_id' => $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_country_id'],'province_id' => $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['province_id'],'user_id' => $user_id)));  
                    if(isset($permissionArray['ProvincePermission']['approval_id']))
                        $next_action_by = $permissionArray['ProvincePermission']['approval_id'];
                    else
                        $next_action_by = '166'; //Infra Mapping

            $oversing_user = array();

            $this->request->data['TravelHotelRoomSupplier']['hotel_supplier_status'] = '4'; // 4 for Change Submitted of the travel_action_item_types
            $this->request->data['TravelHotelRoomSupplier']['active'] = 'FALSE'; // 2 for No of lookup_value_statuses
            if ($TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['approved_by'])
                $travel_action_item['TravelActionItem']['type_id'] = '4'; // for Change Submitted of travel_action_item_types
            else
                $travel_action_item['TravelActionItem']['type_id'] = '8'; // for Change Submitted of travel_action_item_types

            /*             * ************************* Action ********************** */
            $travel_action_item['TravelActionItem']['hotel_supplier_id'] = $id;
            $travel_action_item['TravelActionItem']['level_id'] = '4';  // for mapping hotel travel_action_remark_levels 

            $travel_action_item['TravelActionItem']['next_action_by'] = $next_action_by;
            $travel_action_item['TravelActionItem']['action_item_active'] = 'Yes';
            $travel_action_item['TravelActionItem']['description'] = 'Supplier Hotel Record Updated - Re-Submission For Approval';
            $travel_action_item['TravelActionItem']['action_item_source'] = $role_id;
            $travel_action_item['TravelActionItem']['created_by_id'] = $user_id;
            $travel_action_item['TravelActionItem']['created_by'] = $user_id;
            $travel_action_item['TravelActionItem']['dummy_status'] = $dummy_status;
            $travel_action_item['TravelActionItem']['parent_action_item_id'] = $actio_itme_id;


            /*             * ********************* Remarks ******************************** */
            $travel_remarks['TravelRemark']['hotel_supplier_id'] = $id;
            $travel_remarks['TravelRemark']['remarks'] = 'Edit Supplier Hotel Record';
            $travel_remarks['TravelRemark']['created_by'] = $user_id;
            $travel_remarks['TravelRemark']['remarks_time'] = date('g:i A');
            $travel_remarks['TravelRemark']['remarks_level'] = '4';  // for mapping hotel travel_action_remark_levels 
            $travel_remarks['TravelRemark']['dummy_status'] = $dummy_status;
            $this->TravelRemark->save($travel_remarks);


            $this->TravelHotelRoomSupplier->id = $id;
            if ($this->TravelHotelRoomSupplier->save($this->request->data['TravelHotelRoomSupplier'])) {
                $this->TravelActionItem->save($travel_action_item);
                $ActionId = $this->TravelActionItem->getLastInsertId();
                if ($actio_itme_id) {
                    $this->TravelActionItem->updateAll(array('TravelActionItem.action_item_active' => "'No'"), array('TravelActionItem.id' => $actio_itme_id));
                }
                $this->Session->setFlash('Your changes have been submitted. Waiting for approval at the moment...', 'success');
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


        $TravelSuppliers = $this->TravelSupplier->find('all', array('fields' => 'supplier_code, supplier_name', 'conditions' => array('active' => 'TRUE'), 'order' => 'supplier_name ASC'));
        $TravelSuppliers = Set::combine($TravelSuppliers, '{n}.TravelSupplier.supplier_code', array('%s - %s', '{n}.TravelSupplier.supplier_code', '{n}.TravelSupplier.supplier_name'));
     

        $TravelCountries = $this->TravelCountry->find('all', array('fields' => 'country_code, country_name', 'conditions' => array('country_code' => $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_country_code']), 'order' => 'country_name ASC'));
        $TravelCountries = Set::combine($TravelCountries, '{n}.TravelCountry.country_code', array('%s - %s', '{n}.TravelCountry.country_code', '{n}.TravelCountry.country_name'));


        $TravelCities = $this->TravelCity->find('all', array('fields' => 'city_code, city_name', 'conditions' => array('city_code' => $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_city_code']), 'order' => 'city_name ASC'));
        $TravelCities = Set::combine($TravelCities, '{n}.TravelCity.city_code', array('%s - %s', '{n}.TravelCity.city_code', '{n}.TravelCity.city_name'));
    

        $TravelHotelLookups = $this->TravelHotelLookup->find('list', array('fields' => 'hotel_code, hotel_name', 'conditions' => array('hotel_code' => $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_code']), 'order' => 'hotel_name ASC'));
        
        
        $TravelAreas = $this->TravelArea->find('list', array(
                'conditions' => array(
                    'TravelArea.id' => $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_area_id'],                   
                ),
                'fields' => 'TravelArea.id, TravelArea.area_name',
                'order' => 'TravelArea.area_name ASC'
            ));
       
        
        $TravelSuburbs = $this->TravelSuburb->find('list', array(
                'conditions' => array(
                    'TravelSuburb.id' => $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_suburb_id'],
                ),
                'fields' => 'TravelSuburb.id, TravelSuburb.name',
                'order' => 'TravelSuburb.name ASC'
            ));
        
        $TravelChains = $this->TravelChain->find('list', array(
                'conditions' => array(
                    'TravelChain.id' => $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_chain_id'],
                  
                ),
                'fields' => 'TravelChain.id, TravelChain.chain_name',
                'order' => 'TravelChain.chain_name ASC'
            ));
        
        $TravelBrands = $this->TravelBrand->find('list', array(
                'conditions' => array(
                    'TravelBrand.id' => $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_brand_id'],
                ),
                'fields' => 'TravelBrand.id, TravelBrand.brand_name',
                'order' => 'TravelBrand.brand_name ASC'
            ));
        
        $HotelUrl = $this->TravelHotelLookup->find('first',array('conditions' => array('hotel_code' => $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_code']),'fields' => array('url_hotel','address')));
    
        $this->set(compact('TravelHotelLookups','TravelCities','TravelCountries','TravelSuppliers','TravelAreas','TravelSuburbs','TravelChains','TravelBrands','HotelUrl'));

        $this->request->data = $TravelHotelRoomSuppliers;
    }

    function edit_duplicate_supplier_city($id = null) {

        // $this->layout = '';
        $user_id = $this->Auth->user('id');
        $role_id = $this->Session->read("role_id");
        $dummy_status = $this->Auth->user('dummy_status');
        $next_action_by = '166';  //overseer 136 44 is sarika 152 ojas
        $actio_itme_id = '';
        $flag = 0;
        $arr = explode('_', $id);
        $id = $arr[0];
        if (count($arr) > 1) {
            $actio_itme_id = $arr[1];
            $flag = 1;
        }

        if (!$id) {
            throw new NotFoundException(__('Invalid Duplicate City Supplier'));
        }

        $DuplicateMappinges = $this->DuplicateMappinge->findById($id);


        if (!$DuplicateMappinges) {
            throw new NotFoundException(__('Invalid Duplicate City Supplier'));
        }

        if ($this->request->data) {

            $oversing_user = array();

            $this->request->data['DuplicateMappinge']['status'] = '4'; // 4 for Change Submitted of the travel_action_item_types
            //$this->request->data['DuplicateMappinge']['active'] = '2'; // 2 for No of lookup_value_statuses

            /*             * ************************* Action ********************** */
            $travel_action_item['TravelActionItem']['duplicate_city_supplier_id'] = $id;
            $travel_action_item['TravelActionItem']['level_id'] = '5';  // for duplicate city travel_action_remark_levels 
            $travel_action_item['TravelActionItem']['type_id'] = '4'; // for Change Submitted of travel_action_item_types
            $travel_action_item['TravelActionItem']['next_action_by'] = $next_action_by;
            $travel_action_item['TravelActionItem']['action_item_active'] = 'Yes';
            $travel_action_item['TravelActionItem']['description'] = 'Duplicate Supplier City Record Updated - Re-Submission For Approval';
            $travel_action_item['TravelActionItem']['action_item_source'] = $role_id;
            $travel_action_item['TravelActionItem']['created_by_id'] = $user_id;
            $travel_action_item['TravelActionItem']['created_by'] = $user_id;
            $travel_action_item['TravelActionItem']['dummy_status'] = $dummy_status;
            $travel_action_item['TravelActionItem']['parent_action_item_id'] = $actio_itme_id;


            /*             * ********************* Remarks ******************************** */
            $travel_remarks['TravelRemark']['duplicate_city_supplier_id'] = $id;
            $travel_remarks['TravelRemark']['remarks'] = 'Edit Duplicate Supplier City Record';
            $travel_remarks['TravelRemark']['created_by'] = $user_id;
            $travel_remarks['TravelRemark']['remarks_time'] = date('g:i A');
            $travel_remarks['TravelRemark']['remarks_level'] = '5';  // for duplicate country travel_action_remark_levels 
            $travel_remarks['TravelRemark']['dummy_status'] = $dummy_status;



            $this->DuplicateMappinge->id = $id;
            if ($this->DuplicateMappinge->save($this->request->data['DuplicateMappinge'])) {
                $this->TravelRemark->save($travel_remarks);
                $this->TravelActionItem->save($travel_action_item);
                $ActionId = $this->TravelActionItem->getLastInsertId();
                if ($actio_itme_id) {
                    $this->TravelActionItem->updateAll(array('TravelActionItem.action_item_active' => "'No'"), array('TravelActionItem.id' => $actio_itme_id));
                }
                $this->Session->setFlash('Your changes have been submitted. Waiting for approval at the moment...', 'success');
            }
            else
                $this->Session->setFlash('Unable to add Action item.', 'failure');

            if ($flag == 1)
                $this->redirect(array('controller' => 'travel_action_items', 'action' => 'index'));
        }


        $TravelSuppliers = $this->TravelSupplier->find('all', array('fields' => 'supplier_code, supplier_name', 'conditions' => array('active' => 'TRUE'), 'order' => 'supplier_name ASC'));
        $TravelSuppliers = Set::combine($TravelSuppliers, '{n}.TravelSupplier.supplier_code', array('%s - %s', '{n}.TravelSupplier.supplier_code', '{n}.TravelSupplier.supplier_name'));
        $this->set(compact('TravelSuppliers'));


        $TravelCountries = $this->TravelCountry->find('all', array('fields' => 'country_code, country_name', 'conditions' => array('country_code' => $DuplicateMappinges['DuplicateMappinge']['country_wtb_code']), 'order' => 'country_name ASC'));
        $TravelCountries = Set::combine($TravelCountries, '{n}.TravelCountry.country_code', array('%s - %s', '{n}.TravelCountry.country_code', '{n}.TravelCountry.country_name'));
        $this->set(compact('TravelCountries'));

        $TravelCities = $this->TravelCity->find('all', array('fields' => 'city_code, city_name', 'conditions' => array('city_code' => $DuplicateMappinges['DuplicateMappinge']['city_wtb_code']), 'order' => 'city_name ASC'));
        $TravelCities = Set::combine($TravelCities, '{n}.TravelCity.city_code', array('%s - %s', '{n}.TravelCity.city_code', '{n}.TravelCity.city_name'));
        $this->set(compact('TravelCities'));

        $city_name_arr = $this->TravelCity->findByCityCode($DuplicateMappinges['DuplicateMappinge']['city_wtb_code'], array('fields' => 'city_name'));
        $city_name = $city_name_arr['TravelCity']['city_name'];

        $condition = '';

        for ($indexOfFirstLetter = 0; $indexOfFirstLetter <= strlen($city_name); $indexOfFirstLetter++) {

            for ($indexOfLastLetter = $indexOfFirstLetter + 1; $indexOfLastLetter <= strlen($city_name); $indexOfLastLetter++) {
                $new_arr[] = substr($city_name, $indexOfFirstLetter, 3);
                //  echo $arr[$indexOfFirstLetter];
                $condition .= "(city_name LIKE '%" . $new_arr[$indexOfFirstLetter] . "%')";
                if ($indexOfFirstLetter < strlen($city_name) - 1)
                    $condition .= 'OR';
                $indexOfFirstLetter++;
            }
        }

        $Mappinges = $this->TravelCitySupplier->find
                (
                'all', array
            (
            'conditions' => array
                (
                'TravelCitySupplier.pf_city_code IN (SELECT city_code FROM travel_cities WHERE country_code = "' . $DuplicateMappinges['DuplicateMappinge']['country_wtb_code'] . '" AND (' . $condition . '))',
                'TravelCitySupplier.city_country_code' => $DuplicateMappinges['DuplicateMappinge']['country_wtb_code'], 'TravelCitySupplier.supplier_code' => $DuplicateMappinges['DuplicateMappinge']['supplier_code']
            ),
            'order' => 'TravelCitySupplier.city_country_code ASC',
        ));


        $this->set('Mappinges', $Mappinges);
        //   $log = $this->TravelCitySupplier->getDataSource()->getLog(false, false);       
        //  debug($log);


        $this->request->data = $DuplicateMappinges;
    }

    function edit_duplicate_supplier_hotel($id = null) {

        // $this->layout = '';
        $user_id = $this->Auth->user('id');
        $role_id = $this->Session->read("role_id");
        $dummy_status = $this->Auth->user('dummy_status');
        $next_action_by = '166';  //overseer 136 44 is sarika 152 ojas
        $actio_itme_id = '';
        $flag = 0;
        $arr = explode('_', $id);
        $id = $arr[0];
        if (count($arr) > 1) {
            $actio_itme_id = $arr[1];
            $flag = 1;
        }

        if (!$id) {
            throw new NotFoundException(__('Invalid Duplicate City Supplier'));
        }

        $DuplicateMappinges = $this->DuplicateMappinge->findById($id);


        if (!$DuplicateMappinges) {
            throw new NotFoundException(__('Invalid Duplicate Hotel Supplier'));
        }

        if ($this->request->data) {


            $oversing_user = array();

            $this->request->data['DuplicateMappinge']['status'] = '4'; // 4 for Change Submitted of the travel_action_item_types
            //$this->request->data['DuplicateMappinge']['active'] = '2'; // 2 for No of lookup_value_statuses

            /*             * ************************* Action ********************** */
            $travel_action_item['TravelActionItem']['duplicate_city_supplier_id'] = $id;
            $travel_action_item['TravelActionItem']['level_id'] = '6';  // for duplicate city travel_action_remark_levels 
            $travel_action_item['TravelActionItem']['type_id'] = '4'; // for Change Submitted of travel_action_item_types
            $travel_action_item['TravelActionItem']['next_action_by'] = $next_action_by;
            $travel_action_item['TravelActionItem']['action_item_active'] = 'Yes';
            $travel_action_item['TravelActionItem']['description'] = 'Duplicate Supplier City Record Updated - Re-Submission For Approval';
            $travel_action_item['TravelActionItem']['action_item_source'] = $role_id;
            $travel_action_item['TravelActionItem']['created_by_id'] = $user_id;
            $travel_action_item['TravelActionItem']['created_by'] = $user_id;
            $travel_action_item['TravelActionItem']['dummy_status'] = $dummy_status;
            $travel_action_item['TravelActionItem']['parent_action_item_id'] = $actio_itme_id;


            /*             * ********************* Remarks ******************************** */
            $travel_remarks['TravelRemark']['duplicate_city_supplier_id'] = $id;
            $travel_remarks['TravelRemark']['remarks'] = 'Edit Duplicate Supplier City Record';
            $travel_remarks['TravelRemark']['created_by'] = $user_id;
            $travel_remarks['TravelRemark']['remarks_time'] = date('g:i A');
            $travel_remarks['TravelRemark']['remarks_level'] = '6';  // for duplicate country travel_action_remark_levels 
            $travel_remarks['TravelRemark']['dummy_status'] = $dummy_status;



            $this->DuplicateMappinge->id = $id;
            if ($this->DuplicateMappinge->save($this->request->data['DuplicateMappinge'])) {
                $this->TravelRemark->save($travel_remarks);
                $this->TravelActionItem->save($travel_action_item);
                $ActionId = $this->TravelActionItem->getLastInsertId();
                if ($actio_itme_id) {
                    $this->TravelActionItem->updateAll(array('TravelActionItem.action_item_active' => "'No'"), array('TravelActionItem.id' => $actio_itme_id));
                }
                $this->Session->setFlash('Your changes have been submitted. Waiting for approval at the moment...', 'success');
            }
            else
                $this->Session->setFlash('Unable to add Action item.', 'failure');

            if ($flag == 1)
                $this->redirect(array('controller' => 'travel_action_items', 'action' => 'index'));
        }

        $TravelSuppliers = $this->TravelSupplier->find('all', array('fields' => 'supplier_code, supplier_name', 'conditions' => array('active' => 'TRUE'), 'order' => 'supplier_name ASC'));
        $TravelSuppliers = Set::combine($TravelSuppliers, '{n}.TravelSupplier.supplier_code', array('%s - %s', '{n}.TravelSupplier.supplier_code', '{n}.TravelSupplier.supplier_name'));
        $this->set(compact('TravelSuppliers'));

        $TravelCountries = $this->TravelCountry->find('all', array('fields' => 'country_code, country_name', 'conditions' => array('country_code' => $DuplicateMappinges['DuplicateMappinge']['country_wtb_code']), 'order' => 'country_name ASC'));
        $TravelCountries = Set::combine($TravelCountries, '{n}.TravelCountry.country_code', array('%s - %s', '{n}.TravelCountry.country_code', '{n}.TravelCountry.country_name'));
        $this->set(compact('TravelCountries'));

        $TravelCities = $this->TravelCity->find('all', array('fields' => 'city_code, city_name', 'conditions' => array('city_code' => $DuplicateMappinges['DuplicateMappinge']['city_wtb_code']), 'order' => 'city_name ASC'));
        $TravelCities = Set::combine($TravelCities, '{n}.TravelCity.city_code', array('%s - %s', '{n}.TravelCity.city_code', '{n}.TravelCity.city_name'));
        $this->set(compact('TravelCities'));

        $TravelHotelLookups = $this->TravelHotelLookup->find('all', array('fields' => 'hotel_code, hotel_name', 'conditions' => array('hotel_code like' => $DuplicateMappinges['DuplicateMappinge']['hotel_wtb_code']), 'order' => 'hotel_name ASC'));
        $TravelHotelLookups = Set::combine($TravelHotelLookups, '{n}.TravelHotelLookup.hotel_code', array('%s - %s', '{n}.TravelHotelLookup.hotel_code', '{n}.TravelHotelLookup.hotel_name'));
        
        $TravelHotelLookupsAll = $this->TravelHotelLookup->find('first', array( 'conditions' => array('hotel_code like' => $DuplicateMappinges['DuplicateMappinge']['hotel_wtb_code']), 'order' => 'hotel_name ASC'));
       
        
       // $HotelUrl = $this->TravelHotelLookup->find('first', array('conditions' => array('hotel_code' => $TravelHotelLookupsAll['TravelHotelLookup']['hotel_code']), 'fields' => array('url_hotel', 'address','id','hotel_code')));        
            $TravelAreas = $this->TravelArea->find('list', array(
                'conditions' => array(
                    'TravelArea.id' => $TravelHotelLookupsAll['TravelHotelLookup']['area_id'],
                ),
                'fields' => 'TravelArea.id, TravelArea.area_name',
                'order' => 'TravelArea.area_name ASC'
            ));


            $TravelSuburbs = $this->TravelSuburb->find('list', array(
                'conditions' => array(
                    'TravelSuburb.id' => $TravelHotelLookupsAll['TravelHotelLookup']['suburb_id'],
                ),
                'fields' => 'TravelSuburb.id, TravelSuburb.name',
                'order' => 'TravelSuburb.name ASC'
            ));

            $TravelChains = $this->TravelChain->find('list', array(
                'conditions' => array(
                    'TravelChain.id' => $TravelHotelLookupsAll['TravelHotelLookup']['chain_id'],
                ),
                'fields' => 'TravelChain.id, TravelChain.chain_name',
                'order' => 'TravelChain.chain_name ASC'
            ));

            $TravelBrands = $this->TravelBrand->find('list', array(
                'conditions' => array(
                    'TravelBrand.id' => $TravelHotelLookupsAll['TravelHotelLookup']['brand_id'],
                ),
                'fields' => 'TravelBrand.id, TravelBrand.brand_name',
                'order' => 'TravelBrand.brand_name ASC'
            ));
            
            $Provinces = $this->Province->find('list', array(
                'conditions' => array(
                    'Province.id' => $TravelHotelLookupsAll['TravelHotelLookup']['province_id'],
                ),
                'fields' => 'Province.id, Province.name',
                'order' => 'Province.name ASC'
            ));
            
            $this->set(compact('TravelHotelLookupsAll','TravelAreas','TravelSuburbs','TravelChains','TravelBrands','Provinces'));
        
        $this->set(compact('TravelHotelLookups'));



        $condition = '';

        $hotel_code = $DuplicateMappinges['DuplicateMappinge']['hotel_wtb_code'];
        $hotel_name_arr = $this->TravelHotelLookup->findByHotelCode($hotel_code, array('fields' => 'hotel_name'));
        $hotel_name = $hotel_name_arr['TravelHotelLookup']['hotel_name'];

        

        for ($indexOfFirstLetter = 0; $indexOfFirstLetter <= strlen($hotel_name); $indexOfFirstLetter++) {
            for ($indexOfLastLetter = $indexOfFirstLetter + 1; $indexOfLastLetter <= strlen($hotel_name); $indexOfLastLetter++) {
                $hotel_arr[] = substr($hotel_name, $indexOfFirstLetter, 3);
                $condition .= "(hotel_name LIKE '%" . $hotel_arr[$indexOfFirstLetter] . "%')";
                if ($indexOfFirstLetter < strlen($hotel_name) - 1)
                    $condition .= 'OR';
                $indexOfFirstLetter++;
            }
        }


        $Mappinges = $this->TravelHotelRoomSupplier->find
                (
                'all', array
            (
            'conditions' => array
                (
                'TravelHotelRoomSupplier.hotel_code IN (SELECT hotel_code FROM travel_hotel_lookups WHERE country_code = "' . $DuplicateMappinges['DuplicateMappinge']['country_wtb_code'] . '" AND city_code = "' . $DuplicateMappinges['DuplicateMappinge']['city_wtb_code'] . '" AND (' . $condition . '))',
                'TravelHotelRoomSupplier.hotel_city_code' => $DuplicateMappinges['DuplicateMappinge']['city_wtb_code'], 'TravelHotelRoomSupplier.hotel_country_code' => $DuplicateMappinges['DuplicateMappinge']['country_wtb_code'], 'TravelHotelRoomSupplier.supplier_code' => $DuplicateMappinges['DuplicateMappinge']['supplier_code']
            ),
            'order' => 'TravelHotelRoomSupplier.hotel_city_code ASC',
                )
        );

        $this->set('Mappinges', $Mappinges);

        //$log = $this->TravelHotelRoomSupplier->getDataSource()->getLog(false, false);
        // debug($log);
        //  die;




        $this->request->data = $DuplicateMappinges;
    }

    public function edit($id = null, $table = null) {

        $user_id = $this->Auth->user('id');
        $mapping_type = '';
        $country_code = '';
        $city_code = '';
        $hotel_code = '';
        $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';
        $action_URL = 'http://www.travel.domain/ProcessXML';
        $log_call_screen = '';
        $xml_msg = '';
        $xml_error = 'FALSE';



        $arrs = $this->$table->findById($id);

        if ($table == 'TravelCountrySupplier') {
            $mapping_type = '1';
            $Id = $arrs['TravelCountrySupplier']['id'];
            $country_code = $arrs['TravelCountrySupplier']['pf_country_code'];
            $SupplierCode = $arrs['TravelCountrySupplier']['supplier_code'];
            $SupplierCountryCode = $arrs['TravelCountrySupplier']['supplier_country_code'];
            $CountryName = $arrs['TravelCountrySupplier']['country_name'];
            $CountryId = $arrs['TravelCountrySupplier']['country_id'];
            $CountryContinentId = $arrs['TravelCountrySupplier']['country_continent_id'];
            $CountryContinentName = $arrs['TravelCountrySupplier']['country_continent_name'];
            $CountryMappingName = $arrs['TravelCountrySupplier']['country_mapping_name'];
            $CountrySupplierStatus = $arrs['TravelCountrySupplier']['country_suppliner_status'];
            $Active = strtolower($arrs['TravelCountrySupplier']['active']);
            $Excluded = strtolower($arrs['TravelCountrySupplier']['excluded']);
            $ApprovedBy = $arrs['TravelCountrySupplier']['approved_by'];
            $CreatedBy = $arrs['TravelCountrySupplier']['created_by'];
            $app_date = explode(' ', $arrs['TravelCountrySupplier']['approved_date']);
            $ApprovedDate = $app_date[0] . 'T' . $app_date[1];
            $date = explode(' ', $arrs['TravelCountrySupplier']['created']);
            $created = $date[0] . 'T' . $date[1];
            $is_update = $arrs['TravelCountrySupplier']['is_update'];
                    if ($is_update == 'Y')
                        $country_actiontype = 'Update';
                    else
                        $country_actiontype = 'AddNew';
                    
            $WtbStatus = $arrs['TravelCountrySupplier']['wtb_status'];
                    if ($WtbStatus)
                        $WtbStatus = 'true';
                    else
                        $WtbStatus = 'false';        
        } elseif ($table == 'TravelCitySupplier') {
            $mapping_type = '2';
            $Id = $arrs['TravelCitySupplier']['id'];
            $country_code = $arrs['TravelCitySupplier']['city_country_code'];
            $city_code = $arrs['TravelCitySupplier']['pf_city_code'];
            $SupplierCode = $arrs['TravelCitySupplier']['supplier_code'];
            $Active = strtolower($arrs['TravelCitySupplier']['active']);
            $Excluded = strtolower($arrs['TravelCitySupplier']['excluded']);
            $SupplierCountryCode = $arrs['TravelCitySupplier']['supplier_coutry_code'];
            $SupplierCityCode = $arrs['TravelCitySupplier']['supplier_city_code'];
            $CityContinentName = $arrs['TravelCitySupplier']['city_continent_name'];
            $CityContinentId = $arrs['TravelCitySupplier']['city_continent_id'];
            $CityCountryName = $arrs['TravelCitySupplier']['city_country_name'];
            $CityCountryId = $arrs['TravelCitySupplier']['city_country_id'];
            $CityMappingName = $arrs['TravelCitySupplier']['city_mapping_name'];
            $CityName = $arrs['TravelCitySupplier']['city_name'];
            $CityId = $arrs['TravelCitySupplier']['city_id'];

            $CitySupplierStatus = $arrs['TravelCitySupplier']['city_supplier_status'];
            if ($CitySupplierStatus)
                $CitySupplierStatus = 'true';
            else
                $CitySupplierStatus = 'false';
            $ApprovedBy = $arrs['TravelCitySupplier']['approved_by'];
            $CreatedBy = $arrs['TravelCitySupplier']['created_by'];
            $ProvinceId = $arrs['TravelCitySupplier']['province_id'];
            $ProvinceName = $arrs['TravelCitySupplier']['province_name'];
            $app_date = explode(' ', $arrs['TravelCitySupplier']['approved_date']);
            $ApprovedDate = $app_date[0] . 'T' . $app_date[1];           
            $date = explode(' ', $arrs['TravelCitySupplier']['created']);
            $created = $date[0] . 'T' . $date[1];
            $is_update = $arrs['TravelCitySupplier']['is_update'];
                    if ($is_update == 'Y')
                        $city_actiontype = 'Update';
                    else
                        $city_actiontype = 'AddNew';
                    
           $WtbStatus = $arrs['TravelCitySupplier']['wtb_status'];
                    if ($WtbStatus)
                        $WtbStatus = 'true';
                    else
                        $WtbStatus = 'false';          
        }
        elseif ($table == 'TravelHotelRoomSupplier') {
            $mapping_type = '3';
            $Id = $arrs['TravelHotelRoomSupplier']['id'];
            $country_code = trim($arrs['TravelHotelRoomSupplier']['hotel_country_code']);
            $hotel_code = trim($arrs['TravelHotelRoomSupplier']['hotel_code']);
            $city_code = $arrs['TravelHotelRoomSupplier']['hotel_city_code'];
            $SupplierCode = $arrs['TravelHotelRoomSupplier']['supplier_code'];
            $Active = strtolower($arrs['TravelHotelRoomSupplier']['active']);
            $Excluded = strtolower($arrs['TravelHotelRoomSupplier']['excluded']);
            $SupplierCountryCode = $arrs['TravelHotelRoomSupplier']['supplier_item_code4'];
            $SupplierCityCode = $arrs['TravelHotelRoomSupplier']['supplier_item_code3'];
            $SupplierHotelCode = $arrs['TravelHotelRoomSupplier']['supplier_item_code1'];
            $HotelName = $arrs['TravelHotelRoomSupplier']['hotel_name'];
            $CityId = $arrs['TravelHotelRoomSupplier']['hotel_city_id'];
            $CityName = $arrs['TravelHotelRoomSupplier']['hotel_city_name'];
            $SuburbId = $arrs['TravelHotelRoomSupplier']['hotel_suburb_id'];
            $SuburbName = $arrs['TravelHotelRoomSupplier']['hotel_suburb_name'];
            $AreaId = $arrs['TravelHotelRoomSupplier']['hotel_area_id'];
            $AreaName = $arrs['TravelHotelRoomSupplier']['hotel_area_name'];
            $BrandId = $arrs['TravelHotelRoomSupplier']['hotel_brand_id'];
            $BrandName = $arrs['TravelHotelRoomSupplier']['hotel_brand_name'];
            $ChainId = $arrs['TravelHotelRoomSupplier']['hotel_chain_id'];
            $ChainName = $arrs['TravelHotelRoomSupplier']['hotel_chain_name'];
            $CountryId = $arrs['TravelHotelRoomSupplier']['hotel_country_id'];
            $CountryName = $arrs['TravelHotelRoomSupplier']['hotel_country_name'];
            $ContinentId = $arrs['TravelHotelRoomSupplier']['hotel_continent_id'];
            $ContinentName = $arrs['TravelHotelRoomSupplier']['hotel_continent_name'];
            $ApprovedBy = $arrs['TravelHotelRoomSupplier']['approved_by'];
            $CreatedBy = $arrs['TravelHotelRoomSupplier']['created_by'];           
            $app_date = explode(' ', $arrs['TravelHotelRoomSupplier']['approved_date']);        
            $ApprovedDate = $app_date[0] . 'T' . $app_date[1];           
            $ProvinceId = $arrs['TravelHotelRoomSupplier']['province_id'];
            $ProvinceName = $arrs['TravelHotelRoomSupplier']['province_name'];
            $date = explode(' ', $arrs['TravelHotelRoomSupplier']['created']);
            $created = $date[0] . 'T' . $date[1];
            $is_update = $arrs['TravelHotelRoomSupplier']['is_update'];
                    if ($is_update == 'Y')
                        $hotel_actiontype = 'Update';
                    else
                        $hotel_actiontype = 'AddNew';
                    
            $WtbStatus = $arrs['TravelHotelRoomSupplier']['wtb_status'];
                    if ($WtbStatus)
                        $WtbStatus = 'true';
                    else
                        $WtbStatus = 'false';     
                    
            $HotelUrl = $this->TravelHotelLookup->find('first', array('conditions' => array('hotel_code' => $arrs['TravelHotelRoomSupplier']['hotel_code']), 'fields' => array('url_hotel', 'address','id','hotel_code')));        
            $TravelAreas = $this->TravelArea->find('list', array(
                'conditions' => array(
                    'TravelArea.id' => $arrs['TravelHotelRoomSupplier']['hotel_area_id'],
                ),
                'fields' => 'TravelArea.id, TravelArea.area_name',
                'order' => 'TravelArea.area_name ASC'
            ));


            $TravelSuburbs = $this->TravelSuburb->find('list', array(
                'conditions' => array(
                    'TravelSuburb.id' => $arrs['TravelHotelRoomSupplier']['hotel_suburb_id'],
                ),
                'fields' => 'TravelSuburb.id, TravelSuburb.name',
                'order' => 'TravelSuburb.name ASC'
            ));

            $TravelChains = $this->TravelChain->find('list', array(
                'conditions' => array(
                    'TravelChain.id' => $arrs['TravelHotelRoomSupplier']['hotel_chain_id'],
                ),
                'fields' => 'TravelChain.id, TravelChain.chain_name',
                'order' => 'TravelChain.chain_name ASC'
            ));

            $TravelBrands = $this->TravelBrand->find('list', array(
                'conditions' => array(
                    'TravelBrand.id' => $arrs['TravelHotelRoomSupplier']['hotel_brand_id'],
                ),
                'fields' => 'TravelBrand.id, TravelBrand.brand_name',
                'order' => 'TravelBrand.brand_name ASC'
            ));
            
           
                    
                    $Provinces = $this->Province->find('list', array(
                'conditions' => array(                    
                    'Province.country_id' => $arrs['TravelHotelRoomSupplier']['hotel_country_id'],
                    'Province.status' => '1',
                    'Province.wtb_status' => '1',
                    'Province.active' => 'TRUE',
                   
                ),
                'fields' => array('Province.id', 'Province.name'),
                'order' => 'Province.name ASC'
            ));
            
            $this->set(compact('HotelUrl','TravelAreas','Provinces','TravelSuburbs','TravelChains','TravelBrands'));        
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $operation = $this->data['Mapping']['operation'];
            $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');
            if ($operation == '1') { // country
                $content_xml_str = '<soap:Body>
                                        <ProcessXML xmlns="http://www.travel.domain/">
                                            <RequestInfo>
                                                <ResourceDataRequest>
                                                    <RequestAuditInfo>
                                                        <RequestType>PXML_WData_CountryMapping</RequestType>
                                                        <RequestTime>' . $CreatedDate . '</RequestTime>
                                                        <RequestResource>Silkrouters</RequestResource>
                                                    </RequestAuditInfo>
                                                    <RequestParameters>                        
                                                        <ResourceData>
                                                            <ResourceDetailsData srno="1" actiontype="' . $country_actiontype . '">
                                                                <Id>' . $Id . '</Id>
                                                                <CountryCode><![CDATA[' . $country_code . ']]></CountryCode>
                                                                <CountryName><![CDATA[' . $CountryName . ']]></CountryName>
                                                                <SupplierCode><![CDATA[' . $SupplierCode . ']]></SupplierCode>
                                                                <SupplierCountryCode><![CDATA[' . $SupplierCountryCode . ']]></SupplierCountryCode>
                                                                <CountryId>' . $CountryId . '</CountryId>
                                                                <CountryContinentId>' . $CountryContinentId . '</CountryContinentId>
                                                                <CountryContinentName><![CDATA[' . $CountryContinentName . ']]></CountryContinentName>
                                                                <CountryMappingName><![CDATA[' . $CountryMappingName . ']]></CountryMappingName>
                                                                <BuyingCurrency>NA</BuyingCurrency>
                                                                <ApplyBuyingCurrency>NA</ApplyBuyingCurrency>
                                                                <CountrySupplierStatus>' . $CountrySupplierStatus . '</CountrySupplierStatus>
                                                                <WtbStatus>'.$WtbStatus.'</WtbStatus>
                                                                <Active>' . $Active . '</Active>
                                                                <Excluded>' . $Excluded . '</Excluded>                             
                                                                <ApprovedBy>' . $ApprovedBy . '</ApprovedBy>
                                                                <ApprovedDate>' . $ApprovedDate . '</ApprovedDate>
                                                                <CreatedBy>' . $CreatedBy . '</CreatedBy>
                                                                <CreatedDate>' . $created . '</CreatedDate> 
                                                            </ResourceDetailsData>              
                                                    </ResourceData>
                                                    </RequestParameters>
                                                </ResourceDataRequest>
                                            </RequestInfo>
                                        </ProcessXML>
                                    </soap:Body>';
                $log_call_screen = 'Re-Try WTB Operation - Country Mapping';
                $RESOURCEDATA = 'RESOURCEDATA_COUNTRYMAPPING';
            } elseif ($operation == '2') { //city
                $content_xml_str = '<soap:Body>
                                        <ProcessXML xmlns="http://www.travel.domain/">
                                            <RequestInfo>
                                                <ResourceDataRequest>
                                                    <RequestAuditInfo>
                                                        <RequestType>PXML_WData_CityMapping</RequestType>
                                                        <RequestTime>' . $CreatedDate . '</RequestTime>
                                                        <RequestResource>Silkrouters</RequestResource>
                                                    </RequestAuditInfo>
                                                    <RequestParameters>                        
                                                        <ResourceData>
                                                            <ResourceDetailsData srno="1" actiontype="' . $city_actiontype . '">
                                                                <Id>' . $Id . '</Id>
                                                                <CityCode><![CDATA['.$city_code.']]></CityCode>
                                                                <CityName><![CDATA[' . $CityName . ']]></CityName>
                                                                <CityId>' . $CityId . '</CityId>                                
                                                                <SupplierCode><![CDATA[' . $SupplierCode . ']]></SupplierCode>
                                                                <SupplierCityCode><![CDATA[' . $SupplierCityCode . ']]></SupplierCityCode>
                                                                <PFCityCode><![CDATA[' . $city_code . ']]></PFCityCode>
                                                                <CityMappingName><![CDATA[' . $CityMappingName . ']]></CityMappingName>
                                                                <CityCountryCode><![CDATA[' . $country_code . ']]></CityCountryCode>
                                                                <CityCountryId>' . $CityCountryId . '</CityCountryId>
                                                                <CityCountryName><![CDATA[' . $CityCountryName . ']]></CityCountryName>
                                                                <CityContinentId>' . $CityContinentId . '</CityContinentId>
                                                                <CityContinentName><![CDATA[' . $CityContinentName . ']]></CityContinentName>
                                                                <ProvinceId>' . $ProvinceId . '</ProvinceId>
                                                                <ProvinceName><![CDATA[' . $ProvinceName . ']]></ProvinceName>
                                                                <CitySupplierStatus>' . $CitySupplierStatus . '</CitySupplierStatus>
                                                                <SupplierCountryCode><![CDATA[' . $SupplierCountryCode . ']]></SupplierCountryCode>
                                                                <WtbStatus>false</WtbStatus>
                                                                <Active>' . $Active . '</Active>
                                                                <Excluded>' . $Excluded . '</Excluded>                             
                                                                <ApprovedBy>' . $ApprovedBy . '</ApprovedBy>
                                                                <ApprovedDate>' . $ApprovedDate . '</ApprovedDate>
                                                                <CreatedBy>' . $CreatedBy . '</CreatedBy>
                                                                <CreatedDate>' . $created . '</CreatedDate> 
                                                            </ResourceDetailsData>              
                                                    </ResourceData>
                                                    </RequestParameters>
                                                </ResourceDataRequest>
                                            </RequestInfo>
                                        </ProcessXML>
                                    </soap:Body>';

                $log_call_screen = 'Re-Try WTB Operation - City Mapping';
                $RESOURCEDATA = 'RESOURCEDATA_CITYMAPPING';
            } elseif ($operation == '3') { //Hotel
                                
                $content_xml_str = '<soap:Body>
                                        <ProcessXML xmlns="http://www.travel.domain/">
                                            <RequestInfo>
                                                <ResourceDataRequest>
                                                    <RequestAuditInfo>
                                                        <RequestType>PXML_WData_HotelMapping</RequestType>
                                                        <RequestTime>' . $CreatedDate . '</RequestTime>
                                                        <RequestResource>Silkrouters</RequestResource>
                                                    </RequestAuditInfo>
                                                    <RequestParameters>                        
                                                        <ResourceData>
                                                            <ResourceDetailsData srno="1" actiontype="' . $hotel_actiontype . '">
                                                                <Id>'.$Id.'</Id>
                                                                <HotelCode><![CDATA['.$hotel_code.']]></HotelCode>
                                                                <HotelName><![CDATA['.$HotelName.']]></HotelName>
                                                                <SupplierCode><![CDATA['.$SupplierCode.']]></SupplierCode>
                                                                <WtbStatus>false</WtbStatus>
                                                                <Active>'.$Active.'</Active>
                                                                <Excluded>'.$Excluded.'</Excluded>
                                                                <ContinentId>'.$ContinentId.'</ContinentId>
                                                                <ContinentCode>NA</ContinentCode>
                                                                <ContinentName><![CDATA['.$ContinentName.']]></ContinentName>                              
                                                                <CountryId>'.$CountryId.'</CountryId>
                                                                <CountryCode><![CDATA['.$country_code.']]></CountryCode>
                                                                <CountryName><![CDATA['.$CountryName.']]></CountryName>
                                                                <ProvinceId>' . $ProvinceId . '</ProvinceId>
                                                                <ProvinceName><![CDATA[' . $ProvinceName . ']]></ProvinceName>
                                                                <CityId>'.$CityId.'</CityId>
                                                                <CityCode><![CDATA['.$city_code.']]></CityCode>
                                                                <CityName><![CDATA['.$CityName.']]></CityName>
                                                                <SuburbId>'.$SuburbId.'</SuburbId>
                                                                <SuburbCode>NA</SuburbCode>
                                                                <SuburbName><![CDATA['.$SuburbName.']]></SuburbName>
                                                                <AreaId>'.$AreaId.'</AreaId>
                                                                <AreaName><![CDATA['.$AreaName.']]></AreaName>
                                                                <BrandId>'.$BrandId.'</BrandId>
                                                                <BrandName><![CDATA['.$BrandName.']]></BrandName>
                                                                <ChainId>'.$ChainId.'</ChainId>
                                                                <ChainName><![CDATA['.$ChainName.']]></ChainName>    
                                                                <SupplierCountryCode><![CDATA['.$SupplierCountryCode.']]></SupplierCountryCode>
                                                                <SupplierCityCode><![CDATA['.$SupplierCityCode.']]></SupplierCityCode>
                                                                <SupplierHotelCode>'.$SupplierHotelCode.'</SupplierHotelCode>                              
                                                                <SupplierHotelRoomCode></SupplierHotelRoomCode>
                                                                <SupplierItemCode5></SupplierItemCode5>
                                                                <SupplierItemCode6></SupplierItemCode6>                              
                                                                <SupplierSuburbCode>NA</SupplierSuburbCode>
                                                                <SupplierAreaCode>NA</SupplierAreaCode>                              
                                                                <ApprovedBy>'.$ApprovedBy.'</ApprovedBy>
                                                                <ApprovedDate>'.$ApprovedDate.'</ApprovedDate>
                                                                <CreatedBy>' . $CreatedBy . '</CreatedBy>
                                                                <CreatedDate>' . $created . '</CreatedDate> 
                                                              </ResourceDetailsData>              
                                                    </ResourceData>
                                                    </RequestParameters>
                                                </ResourceDataRequest>
                                            </RequestInfo>
                                        </ProcessXML>
                                    </soap:Body>';
                
                $log_call_screen = 'Re-Try WTB Operation - Hotel Mapping';
                $RESOURCEDATA = 'RESOURCEDATA_HOTELMAPPING';
            }

            $xml_string = Configure::read('travel_start_xml_str') . $content_xml_str . Configure::read('travel_end_xml_str');

            $client = new SoapClient(null, array(
                'location' => $location_URL,
                'uri' => '',
                'trace' => 1,
            ));

            try {
                $order_return = $client->__doRequest($xml_string, $location_URL, $action_URL, 1);
//Get response from here
                $xml_arr = $this->xml2array($order_return);

                if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT'][$RESOURCEDATA]['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
                    $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT'][$RESOURCEDATA]['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
                    $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT'][$RESOURCEDATA]['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
                    $xml_msg = "Foreign record has been successfully created [Code:$log_call_status_code]";
                    $this->$table->updateAll(array('wtb_status' => "'1'",'is_update' => "'Y'"), array('id' => $id));
                    
                } else {

                    $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT'][$RESOURCEDATA]['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
                    $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT'][$RESOURCEDATA]['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
                    $xml_msg = "There was a problem with foreign record creation [Code:$log_call_status_code]";
                    $this->$table->updateAll(array('wtb_status' => "'2'"), array('id' => $id));
                    $xml_error = 'TRUE';
                }
            } catch (SoapFault $exception) {
                var_dump(get_class($exception));
                var_dump($exception);
            }


            $this->request->data['LogCall']['log_call_nature'] = 'Production';
            $this->request->data['LogCall']['log_call_type'] = 'Outbound';
            $this->request->data['LogCall']['log_call_parms'] = trim($xml_string);
            $this->request->data['LogCall']['log_call_status_code'] = $log_call_status_code;
            $this->request->data['LogCall']['log_call_status_message'] = $log_call_status_message;
            $this->request->data['LogCall']['log_call_screen'] = $log_call_screen;
            $this->request->data['LogCall']['log_call_counterparty'] = 'WTBNETWORKS';
            $this->request->data['LogCall']['log_call_by'] = $user_id;
            $this->LogCall->save($this->request->data['LogCall']);
            $LogId = $this->LogCall->getLastInsertId();
            $a =  date('m/d/Y H:i:s', strtotime('-1 hour'));
            $date = new DateTime($a, new DateTimeZone('Asia/Calcutta'));
            $message = $xml_msg;
            if($xml_error == 'TRUE'){
                $Email = new CakeEmail();

                $Email->viewVars(array(
                    'request_xml' => trim($xml_string),
                    'respon_message' => $log_call_status_message,
                    'respon_code' => $log_call_status_code,
                ));

                $to = 'biswajit@wtbglobal.com';
                $cc = 'infra@sumanus.com';
               
                $Email->template('XML/xml', 'default')->emailFormat('html')->to($to)->cc($cc)->from('admin@silkrouters.com')->subject('XML Error [' . $log_call_screen . '] Log Id [' . $LogId . '] Open By [' . $this->User->Username($user_id) . '] Date [' . date("m/d/Y H:i:s", $date->format('U')) . ']')->send();
            }
            $this->Session->setFlash($message, 'success');
            
            $this->redirect(array('controller' => 'mappinges', 'action' => 'index'));
        }

        $TravelSuppliers = $this->TravelSupplier->find('all', array('fields' => 'supplier_code, supplier_name', 'conditions' => array('active' => 'TRUE'), 'order' => 'supplier_name ASC'));
        $TravelSuppliers = Set::combine($TravelSuppliers, '{n}.TravelSupplier.supplier_code', array('%s - %s', '{n}.TravelSupplier.supplier_code', '{n}.TravelSupplier.supplier_name'));
        $this->set(compact('TravelSuppliers'));

        $TravelCountries = $this->TravelCountry->find('all', array('fields' => 'country_code, country_name', 'conditions' => array('country_code' => $country_code), 'order' => 'country_name ASC'));
        $TravelCountries = Set::combine($TravelCountries, '{n}.TravelCountry.country_code', array('%s - %s', '{n}.TravelCountry.country_code', '{n}.TravelCountry.country_name'));
        $this->set(compact('TravelCountries'));

        $TravelCities = $this->TravelCity->find('all', array('fields' => 'city_code, city_name', 'conditions' => array('city_code' => $city_code), 'order' => 'city_name ASC'));
        $TravelCities = Set::combine($TravelCities, '{n}.TravelCity.city_code', array('%s - %s', '{n}.TravelCity.city_code', '{n}.TravelCity.city_name'));
        $this->set(compact('TravelCities'));

        $TravelHotelLookups = $this->TravelHotelLookup->find('list', array('fields' => 'hotel_code, hotel_name', 'conditions' => array('hotel_code' => $hotel_code), 'order' => 'hotel_name ASC'));
        $this->set(compact('TravelHotelLookups'));
        
        

        $this->set(compact('mapping_type'));

        $this->request->data = $arrs;
    }

    public function de_active_mapping($id = null, $table = null,$type = null) {

        $user_id = $this->Auth->user('id');
        $mapping_type = '';
        $country_code = '';
        $city_code = '';
        $hotel_code = '';
        $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';
        $action_URL = 'http://www.travel.domain/ProcessXML';
        $log_call_screen = '';
        $xml_msg = '';
        $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');
        $xml_error = 'FALSE';
        
        if($type == 'TRUE'){
            $type = 'FALSE';
            $ACTIVE_MSG = 'Active';
        }
        else{
            $type = 'TRUE';
            $ACTIVE_MSG = 'Inactive';
        }


        $arrs = $this->$table->findById($id);

        if ($table == 'TravelCountrySupplier') {
            $mapping_type = '1';
            $Id = $arrs['TravelCountrySupplier']['id'];
            $country_code = $arrs['TravelCountrySupplier']['pf_country_code'];
            $SupplierCode = $arrs['TravelCountrySupplier']['supplier_code'];
            $SupplierCountryCode = $arrs['TravelCountrySupplier']['supplier_country_code'];
            $CountryName = $arrs['TravelCountrySupplier']['country_name'];
            $CountryId = $arrs['TravelCountrySupplier']['country_id'];
            $CountryContinentId = $arrs['TravelCountrySupplier']['country_continent_id'];
            $CountryContinentName = $arrs['TravelCountrySupplier']['country_continent_name'];
            $CountryMappingName = $arrs['TravelCountrySupplier']['country_mapping_name'];
            $CountrySupplierStatus = $arrs['TravelCountrySupplier']['country_suppliner_status'];
            //$Active = strtolower($arrs['TravelCountrySupplier']['active']);
            $Excluded = strtolower($arrs['TravelCountrySupplier']['excluded']);
            $ApprovedBy = $arrs['TravelCountrySupplier']['approved_by'];
            $CreatedBy = $arrs['TravelCountrySupplier']['created_by'];
            $app_date = explode(' ', $arrs['TravelCountrySupplier']['approved_date']);
            $ApprovedDate = $app_date[0] . 'T' . $app_date[1];
            $date = explode(' ', $arrs['TravelCountrySupplier']['created']);
            $created = $date[0] . 'T' . $date[1];
        } elseif ($table == 'TravelCitySupplier') {
            $mapping_type = '2';
            $Id = $arrs['TravelCitySupplier']['id'];
            $country_code = $arrs['TravelCitySupplier']['city_country_code'];
            $city_code = $arrs['TravelCitySupplier']['pf_city_code'];
            $SupplierCode = $arrs['TravelCitySupplier']['supplier_code'];
            //$Active = strtolower($arrs['TravelCitySupplier']['active']);
            $Excluded = strtolower($arrs['TravelCitySupplier']['excluded']);
            $SupplierCountryCode = $arrs['TravelCitySupplier']['supplier_coutry_code'];
            $SupplierCityCode = $arrs['TravelCitySupplier']['supplier_city_code'];
            $CityContinentName = $arrs['TravelCitySupplier']['city_continent_name'];
            $CityContinentId = $arrs['TravelCitySupplier']['city_continent_id'];
            $CityCountryName = $arrs['TravelCitySupplier']['city_country_name'];
            $ProvinceId = $arrs['TravelCitySupplier']['province_id'];
            $ProvinceName = $arrs['TravelCitySupplier']['province_name'];
            $CityCountryId = $arrs['TravelCitySupplier']['city_country_id'];
            $CityMappingName = $arrs['TravelCitySupplier']['city_mapping_name'];
            $CityName = $arrs['TravelCitySupplier']['city_name'];
            $CityId = $arrs['TravelCitySupplier']['city_id'];

            $CitySupplierStatus = $arrs['TravelCitySupplier']['city_supplier_status'];
            if ($CitySupplierStatus)
                $CitySupplierStatus = 'true';
            else
                $CitySupplierStatus = 'false';
            $ApprovedBy = $arrs['TravelCitySupplier']['approved_by'];
            $CreatedBy = $arrs['TravelCitySupplier']['created_by'];
            $app_date = explode(' ', $arrs['TravelCitySupplier']['approved_date']);
            $ApprovedDate = $app_date[0] . 'T' . $app_date[1];           
            $date = explode(' ', $arrs['TravelCitySupplier']['created']);
            $created = $date[0] . 'T' . $date[1];
        }
        elseif ($table == 'TravelHotelRoomSupplier') {
            $mapping_type = '3';
            $Id = $arrs['TravelHotelRoomSupplier']['id'];
            $country_code = trim($arrs['TravelHotelRoomSupplier']['hotel_country_code']);
            $hotel_code = trim($arrs['TravelHotelRoomSupplier']['hotel_code']);
            $city_code = $arrs['TravelHotelRoomSupplier']['hotel_city_code'];
            $SupplierCode = $arrs['TravelHotelRoomSupplier']['supplier_code'];
            //$Active = strtolower($arrs['TravelHotelRoomSupplier']['active']);
            $Excluded = strtolower($arrs['TravelHotelRoomSupplier']['excluded']);
            $SupplierCountryCode = $arrs['TravelHotelRoomSupplier']['supplier_item_code4'];
            $SupplierCityCode = $arrs['TravelHotelRoomSupplier']['supplier_item_code3'];
            $SupplierHotelCode = $arrs['TravelHotelRoomSupplier']['supplier_item_code1'];
            $HotelName = $arrs['TravelHotelRoomSupplier']['hotel_name'];
            $CityId = $arrs['TravelHotelRoomSupplier']['hotel_city_id'];
            $CityName = $arrs['TravelHotelRoomSupplier']['hotel_city_name'];
            $SuburbId = $arrs['TravelHotelRoomSupplier']['hotel_suburb_id'];
            $SuburbName = $arrs['TravelHotelRoomSupplier']['hotel_suburb_name'];
            $AreaId = $arrs['TravelHotelRoomSupplier']['hotel_area_id'];
            $AreaName = $arrs['TravelHotelRoomSupplier']['hotel_area_name'];
            $BrandId = $arrs['TravelHotelRoomSupplier']['hotel_brand_id'];
            $BrandName = $arrs['TravelHotelRoomSupplier']['hotel_brand_name'];
            $ChainId = $arrs['TravelHotelRoomSupplier']['hotel_chain_id'];
            $ChainName = $arrs['TravelHotelRoomSupplier']['hotel_chain_name'];
            $CountryId = $arrs['TravelHotelRoomSupplier']['hotel_country_id'];
            $ChainId = $arrs['TravelHotelRoomSupplier']['hotel_chain_id'];
            $ProvinceId = $arrs['TravelHotelRoomSupplier']['province_id'];
            $ProvinceName = $arrs['TravelHotelRoomSupplier']['province_name'];
            $CountryName = $arrs['TravelHotelRoomSupplier']['hotel_country_name'];
            $ContinentId = $arrs['TravelHotelRoomSupplier']['hotel_continent_id'];
            $ContinentName = $arrs['TravelHotelRoomSupplier']['hotel_continent_name'];
            $ApprovedBy = $arrs['TravelHotelRoomSupplier']['approved_by'];
            $CreatedBy = $arrs['TravelHotelRoomSupplier']['created_by'];
            $app_date = explode(' ', $arrs['TravelHotelRoomSupplier']['approved_date']);
            $ApprovedDate = $app_date[0] . 'T' . $app_date[1];           
            $date = explode(' ', $arrs['TravelHotelRoomSupplier']['created']);
            $created = $date[0] . 'T' . $date[1];
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $operation = $this->data['Mapping']['operation'];
            $Active = strtolower($this->data['Mapping']['active']);
                        
            if ($operation == '1') { // country
                $content_xml_str = '<soap:Body>
                                        <ProcessXML xmlns="http://www.travel.domain/">
                                            <RequestInfo>
                                                <ResourceDataRequest>
                                                    <RequestAuditInfo>
                                                        <RequestType>PXML_WData_CountryMapping</RequestType>
                                                        <RequestTime>' . $CreatedDate . '</RequestTime>
                                                        <RequestResource>Silkrouters</RequestResource>
                                                    </RequestAuditInfo>
                                                    <RequestParameters>                        
                                                        <ResourceData>
                                                            <ResourceDetailsData srno="1" actiontype="Update">
                                                                <Id>' . $Id . '</Id>
                                                                <CountryCode><![CDATA[' . $country_code . ']]></CountryCode>
                                                                <CountryName><![CDATA[' . $CountryName . ']]></CountryName>
                                                                <SupplierCode><![CDATA[' . $SupplierCode . ']]></SupplierCode>
                                                                <SupplierCountryCode><![CDATA[' . $SupplierCountryCode . ']]></SupplierCountryCode>
                                                                <CountryId>' . $CountryId . '</CountryId>
                                                                <CountryContinentId>' . $CountryContinentId . '</CountryContinentId>
                                                                <CountryContinentName><![CDATA[' . $CountryContinentName . ']]></CountryContinentName>
                                                                <CountryMappingName><![CDATA[' . $CountryMappingName . ']]></CountryMappingName>
                                                                <BuyingCurrency>NA</BuyingCurrency>
                                                                <ApplyBuyingCurrency>NA</ApplyBuyingCurrency>
                                                                <CountrySupplierStatus>' . $CountrySupplierStatus . '</CountrySupplierStatus>
                                                                <WtbStatus>false</WtbStatus>
                                                                <Active>' . $Active . '</Active>
                                                                <Excluded>' . $Excluded . '</Excluded>                             
                                                                <ApprovedBy>' . $ApprovedBy . '</ApprovedBy>
                                                                <ApprovedDate>' . $ApprovedDate . '</ApprovedDate>
                                                                <CreatedBy>' . $CreatedBy . '</CreatedBy>
                                                                <CreatedDate>' . $created . '</CreatedDate> 
                                                            </ResourceDetailsData>              
                                                    </ResourceData>
                                                    </RequestParameters>
                                                </ResourceDataRequest>
                                            </RequestInfo>
                                        </ProcessXML>
                                    </soap:Body>';
                $log_call_screen = 'Country Mapping - '.$ACTIVE_MSG;
                $RESOURCEDATA = 'RESOURCEDATA_COUNTRYMAPPING';
            } elseif ($operation == '2') { //city
                $content_xml_str = '<soap:Body>
                                        <ProcessXML xmlns="http://www.travel.domain/">
                                            <RequestInfo>
                                                <ResourceDataRequest>
                                                    <RequestAuditInfo>
                                                        <RequestType>PXML_WData_CityMapping</RequestType>
                                                        <RequestTime>' . $CreatedDate . '</RequestTime>
                                                        <RequestResource>Silkrouters</RequestResource>
                                                    </RequestAuditInfo>
                                                    <RequestParameters>                        
                                                        <ResourceData>
                                                            <ResourceDetailsData srno="1" actiontype="Update">
                                                                <Id>' . $Id . '</Id>
                                                                <CityCode><![CDATA[' . $city_code . ']]></CityCode>
                                                                <CityName><![CDATA[' . $CityName . ']]></CityName>
                                                                <CityId>' . $CityId . '</CityId>                                
                                                                <SupplierCode><![CDATA[' . $SupplierCode . ']]></SupplierCode>
                                                                <SupplierCityCode><![CDATA[' . $SupplierCityCode . ']]></SupplierCityCode>
                                                                <PFCityCode><![CDATA[' . $city_code . ']]></PFCityCode>
                                                                <CityMappingName><![CDATA[' . $CityMappingName . ']]></CityMappingName>
                                                                <CityCountryCode><![CDATA[' . $country_code . ']]></CityCountryCode>
                                                                <CityCountryId>' . $CityCountryId . '</CityCountryId>
                                                                <CityCountryName><![CDATA[' . $CityCountryName . ']]></CityCountryName>
                                                                <CityContinentId>' . $CityContinentId . '</CityContinentId>
                                                                <CityContinentName><![CDATA[' . $CityContinentName . ']]></CityContinentName>
                                                                <ProvinceId>'.$ProvinceId.'</ProvinceId>
                                                                <ProvinceName><![CDATA[' . $ProvinceName . ']]></ProvinceName>
                                                                <CitySupplierStatus>' . $CitySupplierStatus . '</CitySupplierStatus>
                                                                <SupplierCountryCode><![CDATA[' . $SupplierCountryCode . ']]></SupplierCountryCode>
                                                                <WtbStatus>false</WtbStatus>
                                                                <Active>' . $Active . '</Active>
                                                                <Excluded>' . $Excluded . '</Excluded>                             
                                                                <ApprovedBy>' . $ApprovedBy . '</ApprovedBy>
                                                                <ApprovedDate>' . $ApprovedDate . '</ApprovedDate>
                                                                <CreatedBy>' . $CreatedBy . '</CreatedBy>
                                                                <CreatedDate>' . $created . '</CreatedDate> 
                                                            </ResourceDetailsData>              
                                                    </ResourceData>
                                                    </RequestParameters>
                                                </ResourceDataRequest>
                                            </RequestInfo>
                                        </ProcessXML>
                                    </soap:Body>';
                
                $log_call_screen = 'City Mapping - '.$ACTIVE_MSG;               
                $RESOURCEDATA = 'RESOURCEDATA_CITYMAPPING';
            } elseif ($operation == '3') { //Hotel
                
                
                $content_xml_str = '<soap:Body>
                                        <ProcessXML xmlns="http://www.travel.domain/">
                                            <RequestInfo>
                                                <ResourceDataRequest>
                                                    <RequestAuditInfo>
                                                        <RequestType>PXML_WData_HotelMapping</RequestType>
                                                        <RequestTime>' . $CreatedDate . '</RequestTime>
                                                        <RequestResource>Silkrouters</RequestResource>
                                                    </RequestAuditInfo>
                                                    <RequestParameters>                        
                                                        <ResourceData>
                                                            <ResourceDetailsData srno="1" actiontype="Update">
                                                                <Id>'.$Id.'</Id>
                                                                <HotelCode><![CDATA['.$hotel_code.']]></HotelCode>
                                                                <HotelName><![CDATA['.$HotelName.']]></HotelName>
                                                                <SupplierCode><![CDATA['.$SupplierCode.']]></SupplierCode>
                                                                <WtbStatus>false</WtbStatus>
                                                                <Active>'.$Active.'</Active>
                                                                <Excluded>'.$Excluded.'</Excluded>
                                                                <ContinentId>'.$ContinentId.'</ContinentId>
                                                                <ContinentCode>NA</ContinentCode>
                                                                <ContinentName><![CDATA['.$ContinentName.']]></ContinentName>                              
                                                                <CountryId>'.$CountryId.'</CountryId>
                                                                <CountryCode><![CDATA['.$country_code.']]></CountryCode>
                                                                <CountryName><![CDATA['.$CountryName.']]></CountryName>
                                                                <ProvinceId>'.$ProvinceId.'</ProvinceId> 
                                                                <ProvinceName><![CDATA['.$ProvinceName.']]></ProvinceName>
                                                                <CityId>'.$CityId.'</CityId>
                                                                <CityCode><![CDATA['.$city_code.']]></CityCode>
                                                                <CityName><![CDATA['.$CityName.']]></CityName>
                                                                <SuburbId>'.$SuburbId.'</SuburbId>
                                                                <SuburbCode>NA</SuburbCode>
                                                                <SuburbName><![CDATA['.$SuburbName.']]></SuburbName>
                                                                <AreaId>'.$AreaId.'</AreaId>
                                                                <AreaName><![CDATA['.$AreaName.']]></AreaName>
                                                                <BrandId>'.$BrandId.'</BrandId>
                                                                <BrandName><![CDATA['.$BrandName.']]></BrandName>
                                                                <ChainId>'.$ChainId.'</ChainId>
                                                                <ChainName><![CDATA['.$ChainName.']]></ChainName> 
                                                                <SupplierCountryCode><![CDATA['.$SupplierCountryCode.']]></SupplierCountryCode>
                                                                <SupplierCityCode><![CDATA['.$SupplierCityCode.']]></SupplierCityCode>
                                                                <SupplierHotelCode><![CDATA['.$SupplierHotelCode.']]></SupplierHotelCode>                              
                                                                <SupplierHotelRoomCode></SupplierHotelRoomCode>
                                                                <SupplierItemCode5></SupplierItemCode5>
                                                                <SupplierItemCode6></SupplierItemCode6>                              
                                                                <SupplierSuburbCode>NA</SupplierSuburbCode>
                                                                <SupplierAreaCode>NA</SupplierAreaCode>                              
                                                                <ApprovedBy>'.$ApprovedBy.'</ApprovedBy>
                                                                <ApprovedDate>'.$ApprovedDate.'</ApprovedDate>
                                                                <CreatedBy>' . $CreatedBy . '</CreatedBy>
                                                                <CreatedDate>' . $created . '</CreatedDate> 
                                                              </ResourceDetailsData>              
                                                    </ResourceData>
                                                    </RequestParameters>
                                                </ResourceDataRequest>
                                            </RequestInfo>
                                        </ProcessXML>
                                    </soap:Body>';
                
                 $log_call_screen = 'Hotel Mapping - '.$ACTIVE_MSG;
                $RESOURCEDATA = 'RESOURCEDATA_HOTELMAPPING';
            }

            $xml_string = Configure::read('travel_start_xml_str') . $content_xml_str . Configure::read('travel_end_xml_str');

            $client = new SoapClient(null, array(
                'location' => $location_URL,
                'uri' => '',
                'trace' => 1,
            ));

            try {
                $order_return = $client->__doRequest($xml_string, $location_URL, $action_URL, 1);
//Get response from here
                $xml_arr = $this->xml2array($order_return);
                
                //echo htmlentities($xml_string);
                //pr($xml_arr);
                //die;

                if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT'][$RESOURCEDATA]['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
                    $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT'][$RESOURCEDATA]['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
                    $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT'][$RESOURCEDATA]['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
                    $xml_msg = "Foreign record has been successfully updated [Code:$log_call_status_code]";
                    $this->$table->updateAll(array('wtb_status' => "'1'", 'active' => '"'.$this->data['Mapping']['active'].'"'), array('id' => $id));
                    
                } else {

                    $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT'][$RESOURCEDATA]['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
                    $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT'][$RESOURCEDATA]['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
                    $xml_msg = "There was a problem with foreign record updation [Code:$log_call_status_code]";
                    $this->$table->updateAll(array('wtb_status' => "'2'", 'active' => '"'.$this->data['Mapping']['active'].'"'), array('id' => $id));
                    $xml_error = 'TRUE';
                }
                
            } catch (SoapFault $exception) {
                var_dump(get_class($exception));
                var_dump($exception);
            }


            $this->request->data['LogCall']['log_call_nature'] = 'Production';
            $this->request->data['LogCall']['log_call_type'] = 'Outbound';
            $this->request->data['LogCall']['log_call_parms'] = trim($xml_string);
            $this->request->data['LogCall']['log_call_status_code'] = $log_call_status_code;
            $this->request->data['LogCall']['log_call_status_message'] = $log_call_status_message;
            $this->request->data['LogCall']['log_call_screen'] = $log_call_screen;
            $this->request->data['LogCall']['log_call_counterparty'] = 'WTBNETWORKS';
            $this->request->data['LogCall']['log_call_by'] = $user_id;
            $this->LogCall->save($this->request->data['LogCall']);
            $a =  date('m/d/Y H:i:s', strtotime('-1 hour'));
            $date = new DateTime($a, new DateTimeZone('Asia/Calcutta'));
            $message = 'Local record has been successfully updated.<br />' . $xml_msg;
            if($xml_error == 'TRUE'){
                $Email = new CakeEmail();

                $Email->viewVars(array(
                    'request_xml' => trim($xml_string),
                    'respon_message' => $log_call_status_message,
                    'respon_code' => $log_call_status_code,
                ));

                $to = 'biswajit@wtbglobal.com';
                $cc = 'infra@sumanus.com';
                
                $Email->template('XML/xml', 'default')->emailFormat('html')->to($to)->cc($cc)->from('admin@silkrouters.com')->subject('XML Error [' . $log_call_screen . '] Open By [' . $this->User->Username($user_id) . '] Date [' . date("m/d/Y H:i:s", $date->format('U')) . ']')->send();
            }
            $this->Session->setFlash($message, 'success');
            $this->redirect(array('controller' => 'mappinges', 'action' => 'index'));
        }

        $Types = array($type);

        $TravelSuppliers = $this->TravelSupplier->find('all', array('fields' => 'supplier_code, supplier_name', 'conditions' => array('active' => 'TRUE'), 'order' => 'supplier_name ASC'));
        $TravelSuppliers = Set::combine($TravelSuppliers, '{n}.TravelSupplier.supplier_code', array('%s - %s', '{n}.TravelSupplier.supplier_code', '{n}.TravelSupplier.supplier_name'));
        $this->set(compact('TravelSuppliers','Types'));

        $TravelCountries = $this->TravelCountry->find('all', array('fields' => 'country_code, country_name', 'conditions' => array('country_code' => $country_code), 'order' => 'country_name ASC'));
        $TravelCountries = Set::combine($TravelCountries, '{n}.TravelCountry.country_code', array('%s - %s', '{n}.TravelCountry.country_code', '{n}.TravelCountry.country_name'));
        $this->set(compact('TravelCountries'));

        $TravelCities = $this->TravelCity->find('all', array('fields' => 'city_code, city_name', 'conditions' => array('city_code' => $city_code), 'order' => 'city_name ASC'));
        $TravelCities = Set::combine($TravelCities, '{n}.TravelCity.city_code', array('%s - %s', '{n}.TravelCity.city_code', '{n}.TravelCity.city_name'));
        $this->set(compact('TravelCities'));

        $TravelHotelLookups = $this->TravelHotelLookup->find('list', array('fields' => 'hotel_code, hotel_name', 'conditions' => array('hotel_code' => $hotel_code), 'order' => 'hotel_name ASC'));
        $this->set(compact('TravelHotelLookups'));

        $this->set(compact('mapping_type'));



        $this->request->data = $arrs;
    }

    public function exclude_mapping($id = null, $table = null,$type = null) {

        $user_id = $this->Auth->user('id');
        $mapping_type = '';
        $country_code = '';
        $city_code = '';
        $hotel_code = '';
        $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';
        $action_URL = 'http://www.travel.domain/ProcessXML';
        $log_call_screen = '';
        $xml_msg = '';
        $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');
        $xml_error = 'FALSE';

        if($type == 'TRUE'){
            $type = 'FALSE';
            $ACTIVE_MSG = 'Include';
        }
        else{
            $type = 'TRUE';
            $ACTIVE_MSG = 'Exclude';
        }

        $arrs = $this->$table->findById($id);

        if ($table == 'TravelCountrySupplier') {
            $mapping_type = '1';
            $Id = $arrs['TravelCountrySupplier']['id'];
            $country_code = $arrs['TravelCountrySupplier']['pf_country_code'];
            $SupplierCode = $arrs['TravelCountrySupplier']['supplier_code'];
            $SupplierCountryCode = $arrs['TravelCountrySupplier']['supplier_country_code'];
            $CountryName = $arrs['TravelCountrySupplier']['country_name'];
            $CountryId = $arrs['TravelCountrySupplier']['country_id'];
            $CountryContinentId = $arrs['TravelCountrySupplier']['country_continent_id'];
            $CountryContinentName = $arrs['TravelCountrySupplier']['country_continent_name'];
            $CountryMappingName = $arrs['TravelCountrySupplier']['country_mapping_name'];
            $CountrySupplierStatus = $arrs['TravelCountrySupplier']['country_suppliner_status'];
            $Active = strtolower($arrs['TravelCountrySupplier']['active']);
            //$Excluded = strtolower($arrs['TravelCountrySupplier']['excluded']);
            $ApprovedBy = $arrs['TravelCountrySupplier']['approved_by'];
            $CreatedBy = $arrs['TravelCountrySupplier']['created_by'];
            $app_date = explode(' ', $arrs['TravelCountrySupplier']['approved_date']);
            $ApprovedDate = $app_date[0] . 'T' . $app_date[1];
            $date = explode(' ', $arrs['TravelCountrySupplier']['created']);
            $created = $date[0] . 'T' . $date[1];
        } elseif ($table == 'TravelCitySupplier') {
            $mapping_type = '2';
            $Id = $arrs['TravelCitySupplier']['id'];
            $country_code = $arrs['TravelCitySupplier']['city_country_code'];
            $city_code = $arrs['TravelCitySupplier']['pf_city_code'];
            $SupplierCode = $arrs['TravelCitySupplier']['supplier_code'];
            $Active = strtolower($arrs['TravelCitySupplier']['active']);
            //$Excluded = strtolower($arrs['TravelCitySupplier']['excluded']);
            $SupplierCountryCode = $arrs['TravelCitySupplier']['supplier_coutry_code'];
            $SupplierCityCode = $arrs['TravelCitySupplier']['supplier_city_code'];
            $CityContinentName = $arrs['TravelCitySupplier']['city_continent_name'];
            $CityContinentId = $arrs['TravelCitySupplier']['city_continent_id'];
            $CityCountryName = $arrs['TravelCitySupplier']['city_country_name'];
            $CityCountryId = $arrs['TravelCitySupplier']['city_country_id'];
            $CityMappingName = $arrs['TravelCitySupplier']['city_mapping_name'];
            $CityName = $arrs['TravelCitySupplier']['city_name'];
            $CityId = $arrs['TravelCitySupplier']['city_id'];

            $CitySupplierStatus = $arrs['TravelCitySupplier']['city_supplier_status'];
            if ($CitySupplierStatus)
                $CitySupplierStatus = 'true';
            else
                $CitySupplierStatus = 'false';
            $ApprovedBy = $arrs['TravelCitySupplier']['approved_by'];
            $CreatedBy = $arrs['TravelCitySupplier']['created_by'];
            $ProvinceId = $arrs['TravelCitySupplier']['province_id'];
            $ProvinceName = $arrs['TravelCitySupplier']['province_name'];
            $app_date = explode(' ', $arrs['TravelCitySupplier']['approved_date']);
            $ApprovedDate = $app_date[0] . 'T' . $app_date[1];           
            $date = explode(' ', $arrs['TravelCitySupplier']['created']);
            $created = $date[0] . 'T' . $date[1];
        }
        elseif ($table == 'TravelHotelRoomSupplier') {
            $mapping_type = '3';
            $Id = $arrs['TravelHotelRoomSupplier']['id'];
            $country_code = $arrs['TravelHotelRoomSupplier']['hotel_country_code'];
            $hotel_code = $arrs['TravelHotelRoomSupplier']['hotel_code'];
            $city_code = $arrs['TravelHotelRoomSupplier']['hotel_city_code'];
            $SupplierCode = $arrs['TravelHotelRoomSupplier']['supplier_code'];
            $Active = strtolower($arrs['TravelHotelRoomSupplier']['active']);
            //$Excluded = strtolower($arrs['TravelHotelRoomSupplier']['excluded']);
            $SupplierCountryCode = $arrs['TravelHotelRoomSupplier']['supplier_item_code4'];
            $SupplierCityCode = $arrs['TravelHotelRoomSupplier']['supplier_item_code3'];
            $SupplierHotelCode = $arrs['TravelHotelRoomSupplier']['supplier_item_code1'];
            $HotelName = $arrs['TravelHotelRoomSupplier']['hotel_name'];
            $CityId = $arrs['TravelHotelRoomSupplier']['hotel_city_id'];
            $CityName = $arrs['TravelHotelRoomSupplier']['hotel_city_name'];
            $SuburbId = $arrs['TravelHotelRoomSupplier']['hotel_suburb_id'];
            $SuburbName = $arrs['TravelHotelRoomSupplier']['hotel_suburb_name'];
            $AreaId = $arrs['TravelHotelRoomSupplier']['hotel_area_id'];
            $AreaName = $arrs['TravelHotelRoomSupplier']['hotel_area_name'];
            $BrandId = $arrs['TravelHotelRoomSupplier']['hotel_brand_id'];
            $BrandName = $arrs['TravelHotelRoomSupplier']['hotel_brand_name'];
            $ChainId = $arrs['TravelHotelRoomSupplier']['hotel_chain_id'];
            $ChainName = $arrs['TravelHotelRoomSupplier']['hotel_chain_name'];
            $CountryId = $arrs['TravelHotelRoomSupplier']['hotel_country_id'];
            $CountryName = $arrs['TravelHotelRoomSupplier']['hotel_country_name'];
            $ContinentId = $arrs['TravelHotelRoomSupplier']['hotel_continent_id'];
            $ContinentName = $arrs['TravelHotelRoomSupplier']['hotel_continent_name'];
            $ApprovedBy = $arrs['TravelHotelRoomSupplier']['approved_by'];
            $CreatedBy = $arrs['TravelHotelRoomSupplier']['created_by'];
            $app_date = explode(' ', $arrs['TravelHotelRoomSupplier']['approved_date']);
            $ApprovedDate = $app_date[0] . 'T' . $app_date[1];           
            $date = explode(' ', $arrs['TravelHotelRoomSupplier']['created']);
            $created = $date[0] . 'T' . $date[1];
            $ProvinceId = $arrs['TravelHotelRoomSupplier']['province_id'];
            $ProvinceName = $arrs['TravelHotelRoomSupplier']['province_name'];
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $operation = $this->data['Mapping']['operation'];
            $Excluded = strtolower($this->data['Mapping']['excluded']);
                
            if ($operation == '1') { // country
                $content_xml_str = '<soap:Body>
                                        <ProcessXML xmlns="http://www.travel.domain/">
                                            <RequestInfo>
                                                <ResourceDataRequest>
                                                    <RequestAuditInfo>
                                                        <RequestType>PXML_WData_CountryMapping</RequestType>
                                                        <RequestTime>' . $CreatedDate . '</RequestTime>
                                                        <RequestResource>Silkrouters</RequestResource>
                                                    </RequestAuditInfo>
                                                    <RequestParameters>                        
                                                        <ResourceData>
                                                            <ResourceDetailsData srno="1" actiontype="Update">
                                                                <Id>' . $Id . '</Id>
                                                                <CountryCode><![CDATA[' . $country_code . ']]></CountryCode>
                                                                <CountryName><![CDATA[' . $CountryName . ']]></CountryName>
                                                                <SupplierCode><![CDATA[' . $SupplierCode . ']]></SupplierCode>
                                                                <SupplierCountryCode><![CDATA[' . $SupplierCountryCode . ']]></SupplierCountryCode>
                                                                <CountryId>' . $CountryId . '</CountryId>
                                                                <CountryContinentId>' . $CountryContinentId . '</CountryContinentId>
                                                                <CountryContinentName><![CDATA[' . $CountryContinentName . ']]></CountryContinentName>
                                                                <CountryMappingName><![CDATA[' . $CountryMappingName . ']]></CountryMappingName>
                                                                <BuyingCurrency>NA</BuyingCurrency>
                                                                <ApplyBuyingCurrency>NA</ApplyBuyingCurrency>
                                                                <CountrySupplierStatus>' . $CountrySupplierStatus . '</CountrySupplierStatus>
                                                                <WtbStatus>false</WtbStatus>
                                                                <Active>' . $Active . '</Active>
                                                                <Excluded>' . $Excluded . '</Excluded>                             
                                                                <ApprovedBy>' . $ApprovedBy . '</ApprovedBy>
                                                                <ApprovedDate>' . $ApprovedDate . '</ApprovedDate>
                                                                <CreatedBy>' . $CreatedBy . '</CreatedBy>
                                                                <CreatedDate>' . $created . '</CreatedDate> 
                                                            </ResourceDetailsData>              
                                                    </ResourceData>
                                                    </RequestParameters>
                                                </ResourceDataRequest>
                                            </RequestInfo>
                                        </ProcessXML>
                                    </soap:Body>';
                $log_call_screen = 'Country Mapping - '.$ACTIVE_MSG;
                $RESOURCEDATA = 'RESOURCEDATA_COUNTRYMAPPING';
            } elseif ($operation == '2') { //city
                $content_xml_str = '<soap:Body>
                                        <ProcessXML xmlns="http://www.travel.domain/">
                                            <RequestInfo>
                                                <ResourceDataRequest>
                                                    <RequestAuditInfo>
                                                        <RequestType>PXML_WData_CityMapping</RequestType>
                                                        <RequestTime>' . $CreatedDate . '</RequestTime>
                                                        <RequestResource>Silkrouters</RequestResource>
                                                    </RequestAuditInfo>
                                                    <RequestParameters>                        
                                                        <ResourceData>
                                                            <ResourceDetailsData srno="1" actiontype="Update">
                                                                <Id>' . $Id . '</Id>
                                                                <CityCode><![CDATA[' . $city_code . ']]></CityCode>
                                                                <CityName><![CDATA[' . $CityName . ']]></CityName>
                                                                <CityId>' . $CityId . '</CityId>                                
                                                                <SupplierCode><![CDATA[' . $SupplierCode . ']]></SupplierCode>
                                                                <SupplierCityCode><![CDATA[' . $SupplierCityCode . ']]></SupplierCityCode>
                                                                <PFCityCode><![CDATA[' . $city_code . ']]></PFCityCode>
                                                                <CityMappingName><![CDATA[' . $CityMappingName . ']]></CityMappingName>
                                                                <CityCountryCode><![CDATA[' . $country_code . ']]></CityCountryCode>
                                                                <CityCountryId>' . $CityCountryId . '</CityCountryId>
                                                                <CityCountryName><![CDATA[' . $CityCountryName . ']]></CityCountryName>
                                                                <CityContinentId>' . $CityContinentId . '</CityContinentId>
                                                                <CityContinentName><![CDATA[' . $CityContinentName . ']]></CityContinentName>
                                                                <ProvinceId>'.$ProvinceId.'</ProvinceId>
                                                                <ProvinceName><![CDATA[' . $ProvinceName . ']]></ProvinceName>                                                                
                                                                <CitySupplierStatus>' . $CitySupplierStatus . '</CitySupplierStatus>
                                                                <SupplierCountryCode><![CDATA[' . $SupplierCountryCode . ']]></SupplierCountryCode>
                                                                <WtbStatus>false</WtbStatus>
                                                                <Active>' . $Active . '</Active>
                                                                <Excluded>' . $Excluded . '</Excluded>                             
                                                                <ApprovedBy>' . $ApprovedBy . '</ApprovedBy>
                                                                <ApprovedDate>' . $ApprovedDate . '</ApprovedDate>
                                                                <CreatedBy>' . $CreatedBy . '</CreatedBy>
                                                                <CreatedDate>' . $created . '</CreatedDate> 
                                                            </ResourceDetailsData>              
                                                    </ResourceData>
                                                    </RequestParameters>
                                                </ResourceDataRequest>
                                            </RequestInfo>
                                        </ProcessXML>
                                    </soap:Body>';
                
                $log_call_screen = 'City Mapping - '.$ACTIVE_MSG;               
                $RESOURCEDATA = 'RESOURCEDATA_CITYMAPPING';
            } elseif ($operation == '3') { //Hotel
                
                
                $content_xml_str = '<soap:Body>
                                        <ProcessXML xmlns="http://www.travel.domain/">
                                            <RequestInfo>
                                                <ResourceDataRequest>
                                                    <RequestAuditInfo>
                                                        <RequestType>PXML_WData_HotelMapping</RequestType>
                                                        <RequestTime>' . $CreatedDate . '</RequestTime>
                                                        <RequestResource>Silkrouters</RequestResource>
                                                    </RequestAuditInfo>
                                                    <RequestParameters>                        
                                                        <ResourceData>
                                                            <ResourceDetailsData srno="1" actiontype="Update">
                                                                <Id>'.$Id.'</Id>
                                                                <HotelCode><![CDATA['.$hotel_code.']]></HotelCode>
                                                                <HotelName><![CDATA['.$HotelName.']]></HotelName>
                                                                <SupplierCode><![CDATA['.$SupplierCode.']]></SupplierCode>
                                                                <WtbStatus>false</WtbStatus>
                                                                <Active>'.$Active.'</Active>
                                                                <Excluded>'.$Excluded.'</Excluded>
                                                                <ContinentId>'.$ContinentId.'</ContinentId>
                                                                <ContinentCode>NA</ContinentCode>
                                                                <ContinentName><![CDATA['.$ContinentName.']]></ContinentName>                              
                                                                <CountryId>'.$CountryId.'</CountryId>
                                                                <CountryCode><![CDATA['.$country_code.']]></CountryCode>
                                                                <CountryName><![CDATA['.$CountryName.']]></CountryName>
                                                                <ProvinceId>'.$ProvinceId.'</ProvinceId>
                                                                <ProvinceName><![CDATA[' . $ProvinceName . ']]></ProvinceName>
                                                                <CityId>'.$CityId.'</CityId>
                                                                <CityCode><![CDATA['.$city_code.']]></CityCode>
                                                                <CityName><![CDATA['.$CityName.']]></CityName>
                                                                <SuburbId>'.$SuburbId.'</SuburbId>
                                                                <SuburbCode>NA</SuburbCode>
                                                                <SuburbName><![CDATA['.$SuburbName.']]></SuburbName>
                                                                <AreaId>'.$AreaId.'</AreaId>
                                                                <AreaName><![CDATA['.$AreaName.']]></AreaName>
                                                                <BrandId>'.$BrandId.'</BrandId>
                                                                <BrandName><![CDATA['.$BrandName.']]></BrandName>
                                                                <ChainId>'.$ChainId.'</ChainId>
                                                                <ChainName><![CDATA['.$ChainName.']]></ChainName> 
                                                                <SupplierCountryCode><![CDATA['.$SupplierCountryCode.']]></SupplierCountryCode>
                                                                <SupplierCityCode><![CDATA['.$SupplierCityCode.']]></SupplierCityCode>
                                                                <SupplierHotelCode><![CDATA['.$SupplierHotelCode.']]></SupplierHotelCode>                              
                                                                <SupplierHotelRoomCode></SupplierHotelRoomCode>
                                                                <SupplierItemCode5></SupplierItemCode5>
                                                                <SupplierItemCode6></SupplierItemCode6>                              
                                                                <SupplierSuburbCode></SupplierSuburbCode>
                                                                <SupplierAreaCode></SupplierAreaCode>                              
                                                                <ApprovedBy>'.$ApprovedBy.'</ApprovedBy>
                                                                <ApprovedDate>'.$ApprovedDate.'</ApprovedDate>
                                                                <CreatedBy>' . $CreatedBy . '</CreatedBy>
                                                                <CreatedDate>' . $created . '</CreatedDate> 
                                                              </ResourceDetailsData>              
                                                    </ResourceData>
                                                    </RequestParameters>
                                                </ResourceDataRequest>
                                            </RequestInfo>
                                        </ProcessXML>
                                    </soap:Body>';
                
                 $log_call_screen = 'Hotel Mapping - '.$ACTIVE_MSG;
                $RESOURCEDATA = 'RESOURCEDATA_HOTELMAPPING';
            }

            $xml_string = Configure::read('travel_start_xml_str') . $content_xml_str . Configure::read('travel_end_xml_str');

            $client = new SoapClient(null, array(
                'location' => $location_URL,
                'uri' => '',
                'trace' => 1,
            ));

            try {
                $order_return = $client->__doRequest($xml_string, $location_URL, $action_URL, 1);
//Get response from here
                $xml_arr = $this->xml2array($order_return);

                if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT'][$RESOURCEDATA]['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
                    $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT'][$RESOURCEDATA]['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
                    $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT'][$RESOURCEDATA]['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
                    $xml_msg = "Foreign record has been successfully updated [Code:$log_call_status_code]";
                    $this->$table->updateAll(array('wtb_status' => "'1'", 'excluded' => '"'.$this->data['Mapping']['excluded'].'"'), array('id' => $id));
                } else {

                    $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT'][$RESOURCEDATA]['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
                    $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT'][$RESOURCEDATA]['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
                    $xml_msg = "There was a problem with foreign record updation [Code:$log_call_status_code]";
                    $this->$table->updateAll(array('wtb_status' => "'2'", 'excluded' => '"'.$this->data['Mapping']['excluded'].'"'), array('id' => $id));
                    $xml_error = 'TRUE';
                }

               
            } catch (SoapFault $exception) {
                var_dump(get_class($exception));
                var_dump($exception);
            }


            $this->request->data['LogCall']['log_call_nature'] = 'Production';
            $this->request->data['LogCall']['log_call_type'] = 'Outbound';
            $this->request->data['LogCall']['log_call_parms'] = trim($xml_string);
            $this->request->data['LogCall']['log_call_status_code'] = $log_call_status_code;
            $this->request->data['LogCall']['log_call_status_message'] = $log_call_status_message;
            $this->request->data['LogCall']['log_call_screen'] = $log_call_screen;
            $this->request->data['LogCall']['log_call_counterparty'] = 'WTBNETWORKS';
            $this->request->data['LogCall']['log_call_by'] = $user_id;
            $this->LogCall->save($this->request->data['LogCall']);
            $message = 'Local record has been successfully updated.<br />' . $xml_msg;
            $a =  date('m/d/Y H:i:s', strtotime('-1 hour'));
            $date = new DateTime($a, new DateTimeZone('Asia/Calcutta'));
            if($xml_error == 'TRUE'){
                $Email = new CakeEmail();

                $Email->viewVars(array(
                    'request_xml' => trim($xml_string),
                    'respon_message' => $log_call_status_message,
                    'respon_code' => $log_call_status_code,
                ));

                $to = 'biswajit@wtbglobal.com';
                $cc = 'infra@sumanus.com';
               
                $Email->template('XML/xml', 'default')->emailFormat('html')->to($to)->cc($cc)->from('admin@silkrouters.com')->subject('XML Error [' . $log_call_screen . '] Open By [' . $this->User->Username($user_id) . '] Date [' . date("m/d/Y H:i:s", $date->format('U')). ']')->send();
            }
            $this->Session->setFlash($message, 'success');
            $this->redirect(array('controller' => 'mappinges', 'action' => 'index'));
        }

        $Types = array($type);

        $TravelSuppliers = $this->TravelSupplier->find('all', array('fields' => 'supplier_code, supplier_name', 'conditions' => array('active' => 'TRUE'), 'order' => 'supplier_name ASC'));
        $TravelSuppliers = Set::combine($TravelSuppliers, '{n}.TravelSupplier.supplier_code', array('%s - %s', '{n}.TravelSupplier.supplier_code', '{n}.TravelSupplier.supplier_name'));
        $this->set(compact('TravelSuppliers','Types'));

        $TravelCountries = $this->TravelCountry->find('all', array('fields' => 'country_code, country_name', 'conditions' => array('country_code' => $country_code), 'order' => 'country_name ASC'));
        $TravelCountries = Set::combine($TravelCountries, '{n}.TravelCountry.country_code', array('%s - %s', '{n}.TravelCountry.country_code', '{n}.TravelCountry.country_name'));
        $this->set(compact('TravelCountries'));

        $TravelCities = $this->TravelCity->find('all', array('fields' => 'city_code, city_name', 'conditions' => array('city_code' => $city_code), 'order' => 'city_name ASC'));
        $TravelCities = Set::combine($TravelCities, '{n}.TravelCity.city_code', array('%s - %s', '{n}.TravelCity.city_code', '{n}.TravelCity.city_name'));
        $this->set(compact('TravelCities'));

        $TravelHotelLookups = $this->TravelHotelLookup->find('list', array('fields' => 'hotel_code, hotel_name', 'conditions' => array('hotel_code' => $hotel_code), 'order' => 'hotel_name ASC'));
        $this->set(compact('TravelHotelLookups'));

        $this->set(compact('mapping_type'));



        $this->request->data = $arrs;
    }
    
    public function view_mapping($id = null, $table = null){
        $this->layout = '';
        $mappings = $this->$table->findById($id);    
        $this->set(compact('mappings','table'));
    }

}


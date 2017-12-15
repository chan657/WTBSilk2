<?php

/**
 * MappingArea controller.
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
class MappingeAreasController extends AppController {

    public $uses = array('TravelHotelLookup', 'TravelCountry', 'TravelCity', 'Province', 'SupplierHotel', 'TravelSupplier',
        'TravelLookupContinent', 'TravelHotelRoomSupplier', 'TravelCitySupplier', 'User');

    public function supplier_hotels() {

        $search_condition = array();
        $supplier_id = '';
        $proArr = array();
        $SupplierHotels = array();
        $TravelCountries = array();
        $TravelCities = array();
        $TravelCitySuppliers = array();
        $Provinces = array();
        $display = 'FALSE';
        $check_mapp = 'FALSE';
        $supplier_id = '';
        $continent_id = '';
        $country_id = '';
        $province_id = '';
        $city_id = '';
        $supplier_city_codde = array();
        $hotel_name = '';
       

        if ($this->checkProvince())
            $proArr = $this->checkProvince();

        if ($this->request->is('post') || $this->request->is('put')) {




            if (!empty($this->data['TravelHotelLookup']['hotel_name'])) {
                $hotel_name = $this->data['TravelHotelLookup']['hotel_name'];
                array_push($search_condition, array("SupplierHotel.hotel_name LIKE '%$hotel_name%'"));
            }
            if (!empty($this->data['TravelHotelLookup']['supplier_id'])) {
                $supplier_id = $this->data['TravelHotelLookup']['supplier_id'];
            }
            if (!empty($this->data['TravelHotelLookup']['continent_id'])) {
                $continent_id = $this->data['TravelHotelLookup']['continent_id'];
                //array_push($search_condition, array('TravelHotelLookup.continent_id' => $continent_id));
                $TravelCountries = $this->TravelCountry->find('all', array('fields' => 'id, country_name,country_code', 'conditions' => array('TravelCountry.continent_id' => $continent_id,
                        'TravelCountry.country_status' => '1',
                        'TravelCountry.wtb_status' => '1',
                        'TravelCountry.active' => 'TRUE'), 'order' => 'country_code ASC'));

                $TravelCountries = Set::combine($TravelCountries, '{n}.TravelCountry.id', array('%s - %s', '{n}.TravelCountry.country_code', '{n}.TravelCountry.country_name'));
            }

            if (!empty($this->data['TravelHotelLookup']['country_id'])) {
                $country_id = $this->data['TravelHotelLookup']['country_id'];
            }
            if (!empty($this->data['TravelHotelLookup']['province_id'])) {

                $province_id = $this->data['TravelHotelLookup']['province_id'];
                //array_push($search_condition, array('TravelHotelLookup.country_id' => $country_id));
                $TravelCities = $this->TravelCity->find('all', array('fields' => 'id, city_name,city_code', 'conditions' => array('TravelCity.province_id' => $province_id,
                        'TravelCity.city_status' => '1',
                        'TravelCity.wtb_status' => '1',
                        'TravelCity.active' => 'TRUE',), 'order' => 'city_code ASC'));

                $TravelCities = Set::combine($TravelCities, '{n}.TravelCity.id', array('%s - %s', '{n}.TravelCity.city_code', '{n}.TravelCity.city_name'));

                $Provinces = $this->Province->find('list', array(
                    'conditions' => array(
                        'Province.country_id' => $country_id,
                        'Province.continent_id' => $continent_id,
                        'Province.status' => '1',
                        'Province.wtb_status' => '1',
                        'Province.active' => 'TRUE',
                        'Province.id' => $proArr
                    ),
                    'fields' => array('Province.id', 'Province.name'),
                    'order' => 'Province.name ASC'
                ));
            }
            if (!empty($this->data['TravelHotelLookup']['city_id'])) {
                $city_id = $this->data['TravelHotelLookup']['city_id'];
                /*
                  $TravelCitySuppliers = $this->TravelCitySupplier->find('list',ARRAY('fields' => 'supplier_city_code,city_name','conditions' =>
                  array('supplier_id' => $supplier_id,'city_continent_id' => $continent_id,'city_country_id' => $country_id,'province_id' => $province_id,'city_id' => $city_id), 'order' => 'supplier_city_code ASC'));

                  $TravelCitySuppliers = Set::combine($TravelCitySuppliers, '{n}.TravelCitySupplier.supplier_city_code', array('%s - %s', '{n}.TravelCitySupplier.supplier_city_code', '{n}.TravelCitySupplier.city_name'));

                 */
            }
            /*

              if (!empty($this->data['TravelHotelLookup']['supplier_city_code'])) {
              $supplier_city_codde = $this->data['TravelHotelLookup']['supplier_city_code'];
              array_push($search_condition, array('SupplierHotel.city_code' => $supplier_city_codde));
              }
             * 
             */

            if (isset($this->data['check_city_mapping'])) {

                $check_mapp = 'TRUE';

                $TravelCitySuppliers = $this->TravelCitySupplier->find('all', ARRAY('conditions' =>
                    array('supplier_id' => $supplier_id, 'city_continent_id' => $continent_id, 'city_country_id' => $country_id, 'province_id' => $province_id, 'city_id' => $city_id)));
            } elseif (isset($this->data['fetch_hotel'])) {

                $display = 'TRUE';
                $check_mapp = 'TRUE';

                $TravelCitySuppliers = $this->TravelCitySupplier->find('all', ARRAY('conditions' =>
                    array('supplier_id' => $supplier_id, 'city_continent_id' => $continent_id, 'city_country_id' => $country_id, 'province_id' => $province_id, 'city_id' => $city_id)));

                $supplier_city_codde = $this->TravelCitySupplier->find('list', ARRAY('fields' => 'supplier_city_code,supplier_city_code', 'conditions' =>
                    array('supplier_id' => $supplier_id, 'city_continent_id' => $continent_id, 'city_country_id' => $country_id, 'province_id' => $province_id
                        , 'city_id' => $city_id, 'wtb_status' => '1', 'active' => 'TRUE', 'city_supplier_status' => '2', 'excluded' => 'FALSE')));
                //pr($supplier_city_codde);

                array_push($search_condition, array('SupplierHotel.city_code' => $supplier_city_codde));
                $this->paginate['order'] = array('SupplierHotel.id' => 'asc');
                $this->set('SupplierHotels', $this->paginate("SupplierHotel", $search_condition));
            }
            //$log = $this->SupplierHotel->getDataSource()->getLog(false, false);
            // debug($log);
            // die;
        } elseif ($this->request->is('get')) {

            if (!empty($this->request->params['named']['supplier_id'])) {
                $supplier_id = $this->data['TravelHotelLookup']['supplier_id'];
            }
        }

        if (!isset($this->passedArgs['supplier_id']) && empty($this->passedArgs['supplier_id'])) {
            $this->passedArgs['supplier_id'] = (isset($this->data['TravelHotelLookup']['supplier_id'])) ? $this->data['TravelHotelLookup']['supplier_id'] : '';
        }

        if (!isset($this->data) && empty($this->data)) {

            $this->data['TravelHotelLookup']['supplier_id'] = $this->passedArgs['supplier_id'];
        }




        $TravelSuppliers = $this->TravelSupplier->find('list', array('fields' => 'id,supplier_code', 'order' => 'supplier_code ASC'));

        $TravelLookupContinents = $this->TravelLookupContinent->find('list', array('fields' => 'id,continent_name', 'order' => 'continent_name ASC'));


        $this->set(compact('TravelCities', 'TravelCitySuppliers', 'supplier_city_codde', 'Provinces', 'TravelCountries', 'check_mapp', 'display', 'TravelLookupContinents'
                        , 'TravelSuppliers', 'supplier_id', 'continent_id', 'country_id', 'province_id', 'city_id', 'hotel_name'));
    }

    public function getCountryNameWithCountryId($country_id){
        
        $Data = ClassRegistry::init('TravelCountry')->find('first', array('fields' => array( 'TravelCountry.country_name'), 'conditions' => array('TravelCountry.id' => $country_id)));
        return $Data['TravelCountry']['country_name'];
    }
    
    public function getCityNameWithCityId($city_id){
        
        $Data = ClassRegistry::init('TravelCity')->find('first', array('fields' => array( 'TravelCity.city_name'), 'conditions' => array('TravelCity.id' => $city_id)));
        return $Data['TravelCity']['city_name'];
    }

    
    public function supplier_hotel_report() {



        $search_condition = array();

        $supplier_id = '';

        $proArr = array();

        $SupplierHotels = array();

        $TravelCountries = array();

        $TravelCities = array();

        $TravelCitySuppliers = array();

        $Provinces = array();

        $display = 'FALSE';

        $check_mapp = 'FALSE';

        $supplier_id = '';

        $continent_id = '';

        $country_id = '';
        
        $country_name = '';

        $province_id = '';

        $city_id = '';
        
        $city_name = '';

        $supplier_city_codde = array();

        $hotel_name = '';

        $msg_flag = '';
        
        $msg = '';   

        if ($this->checkProvince())

            $proArr = $this->checkProvince();





if(isset($_GET['country_id'])){

$get_continent_id =	$_GET['continent_id'];
$get_province_id =	$_GET['province_id']; 
$continent_id =	$get_continent_id;
$province_id =	$get_province_id;

$get_country_id =	$_GET['country_id'];
$get_city_id =	$_GET['city_id'];
$get_supplier_id =	$_GET['supplier_id'];

//$country_name = $this->MappingeAreas->getCountryNameWithCountryId($get_country_id);
//$city_name = $this->MappingeAreas->getCityNameWithCityId($get_city_id);
$supplier_id = $get_supplier_id;
$country_id = $get_country_id;
$city_id = $get_city_id;

$DataArray1 = ClassRegistry::init('TravelCountry')->find('first', array('fields' => array('country_name'), 'conditions' => array('TravelCountry.id' => $country_id)));
$get_country_name = $DataArray1['TravelCountry']['country_name'];

$DataArray3 = ClassRegistry::init('TravelCity')->find('first', array('fields' => array('city_name'), 'conditions' => array('TravelCity.id' => $city_id)));
$get_city_name = $DataArray3['TravelCity']['city_name'];

$DataArray4 = ClassRegistry::init('TravelSupplier')->find('first', array('fields' => array('supplier_code'), 'conditions' => array('TravelSupplier.id' => $get_supplier_id)));
$get_supplier_code = $DataArray4['TravelSupplier']['supplier_code'];

$msg_flag = 'Y';
$msg = "[".$get_supplier_code."] Hotels for WTB Country: [" . $get_country_name . "] and WTB City: [" . $get_city_name. "] with Status = [FETCHED] or [CREATED]";

// THIS PART IS FOR JUST DISPLAYING THE CITY MAPPINGS FOR THE PASSED COUNTRY+CITY+SUPPLIER.
$check_mapp = 'TRUE';
$TravelCitySuppliers = $this->TravelCitySupplier->find('all', ARRAY('conditions' =>
       array('supplier_id' => $get_supplier_id, 'city_country_id' => $get_country_id, 'city_id' => $get_city_id)));

// THIS PART HAS THE SUPPLIER HOTEL DATA PULLING LOGIC
$display = 'TRUE';
$supplier_city_codex = $this->TravelCitySupplier->find('list', ARRAY('fields' => 'supplier_city_code,supplier_city_code', 'conditions' =>
       array('supplier_id' => $get_supplier_id, 'city_country_id' => $get_country_id, 'city_id' => $get_city_id, 'wtb_status' => '1', 'active' => 'TRUE', 'city_supplier_status' => '2', 'excluded' => 'FALSE')));
                //pr($supplier_city_codde);

       array_push($search_condition, array('SupplierHotel.city_code' => $supplier_city_codex));
       array_push($search_condition, array('SupplierHotel.status' => array('1','5','4','6') ));   //FETCHED OR CREATED
       //array_push($search_condition, array('SupplierHotel.status' => '1'));         
       //array_push($search_condition, array('SupplierHotel.status' => '1' OR '5'));      
       $this->paginate['order'] = array('SupplierHotel.id' => 'asc');
       $this->set('SupplierHotels', $this->paginate("SupplierHotel", $search_condition));

 /*
$result_array = ClassRegistry::init('TravelCitySupplier')->find('all', array('fields' => array('supplier_city_code'),'conditions' => array('TravelCitySupplier.city_country_id' => $get_country_id,'TravelCitySupplier.city_id' => $get_city_id,'TravelCitySupplier.supplier_id ' => $get_supplier_id,'TravelCitySupplier.active ' => 'TRUE','TravelCitySupplier.excluded ' => 'FALSE')));

 count($result_array);

	$checkCondition = false;

	foreach( $result_array as  $results){

		$found_city_code = $results['TravelCitySupplier']['supplier_city_code'];		

		$conditions['or'][] = array('SupplierHotel.city_code =' => $found_city_code);   

		$checkCondition = true;

        }			

array_push($search_condition, $conditions);

array_push($search_condition, array('SupplierHotel.supplier_id' => $get_supplier_id));
*/	
} elseif ($this->request->is('get')) {

            if (!empty($this->request->params['named']['supplier_id'])) {
                $supplier_id = $this->data['TravelHotelLookup']['supplier_id'];
            }
 }

 if (!isset($this->passedArgs['supplier_id']) && empty($this->passedArgs['supplier_id'])) {
      $this->passedArgs['supplier_id'] = (isset($this->data['TravelHotelLookup']['supplier_id'])) ? $this->data['TravelHotelLookup']['supplier_id'] : '';
 }

 if (!isset($this->data) && empty($this->data)) {
      $this->data['TravelHotelLookup']['supplier_id'] = $this->passedArgs['supplier_id'];
 }



 $this->set(compact('TravelCities', 'TravelCitySuppliers', 'supplier_city_codde', 'Provinces', 'TravelCountries', 'check_mapp', 'display', 'TravelLookupContinents'
                        , 'TravelSuppliers', 'supplier_id', 'continent_id', 'country_id', 'country_name', 'province_id', 'city_id', 'city_name', 'hotel_name','msg_flag','msg'));

    }
    
    public function supplier_hotel_report_all() {



        $search_condition = array();

        $supplier_id = '';

        $proArr = array();

        $SupplierHotels = array();

        $TravelCountries = array();

        $TravelCities = array();

        $TravelCitySuppliers = array();

        $Provinces = array();

        $display = 'FALSE';

        $check_mapp = 'FALSE';

        $supplier_id = '';

        $continent_id = '';

        $country_id = '';
        
        $country_name = '';

        $province_id = '';

        $city_id = '';
        
        $city_name = '';

        $supplier_city_codde = array();

        $hotel_name = '';

        $msg_flag = '';
        
        $msg = '';   

        if ($this->checkProvince())

            $proArr = $this->checkProvince();





if(isset($_GET['country_id'])){

$get_country_id =	$_GET['country_id'];
$get_city_id =	$_GET['city_id'];
$get_supplier_id =	$_GET['supplier_id'];

//$country_name = $this->MappingeAreas->getCountryNameWithCountryId($get_country_id);
//$city_name = $this->MappingeAreas->getCityNameWithCityId($get_city_id);
$supplier_id = $get_supplier_id;
$country_id = $get_country_id;
$city_id = $get_city_id;

$DataArray1 = ClassRegistry::init('TravelCountry')->find('first', array('fields' => array('country_name'), 'conditions' => array('TravelCountry.id' => $country_id)));
$get_country_name = $DataArray1['TravelCountry']['country_name'];

$DataArray3 = ClassRegistry::init('TravelCity')->find('first', array('fields' => array('city_name'), 'conditions' => array('TravelCity.id' => $city_id)));
$get_city_name = $DataArray3['TravelCity']['city_name'];

$DataArray4 = ClassRegistry::init('TravelSupplier')->find('first', array('fields' => array('supplier_code'), 'conditions' => array('TravelSupplier.id' => $get_supplier_id)));
$get_supplier_code = $DataArray4['TravelSupplier']['supplier_code'];

$msg_flag = 'Y';
$msg = "[".$get_supplier_code."] Hotels for WTB Country: [" . $get_country_name . "] and WTB City: [" . $get_city_name. "] with Status = [FETCHED] or [CREATED]";

// THIS PART IS FOR JUST DISPLAYING THE CITY MAPPINGS FOR THE PASSED COUNTRY+CITY+SUPPLIER.
$check_mapp = 'TRUE';
$TravelCitySuppliers = $this->TravelCitySupplier->find('all', ARRAY('conditions' =>
       array('supplier_id' => $get_supplier_id, 'city_country_id' => $get_country_id, 'city_id' => $get_city_id)));

// THIS PART HAS THE SUPPLIER HOTEL DATA PULLING LOGIC
$display = 'TRUE';
$supplier_city_codex = $this->TravelCitySupplier->find('list', ARRAY('fields' => 'supplier_city_code,supplier_city_code', 'conditions' =>
       array('supplier_id' => $get_supplier_id, 'city_country_id' => $get_country_id, 'city_id' => $get_city_id, 'wtb_status' => '1', 'active' => 'TRUE', 'city_supplier_status' => '2', 'excluded' => 'FALSE')));
                //pr($supplier_city_codde);

       array_push($search_condition, array('SupplierHotel.city_code' => $supplier_city_codex));
//       array_push($search_condition, array('SupplierHotel.status' => array('1','5','4','6') ));   //FETCHED OR CREATED
       //array_push($search_condition, array('SupplierHotel.status' => '1'));         
       //array_push($search_condition, array('SupplierHotel.status' => '1' OR '5'));      
       $this->paginate['order'] = array('SupplierHotel.id' => 'asc');
       $this->set('SupplierHotels', $this->paginate("SupplierHotel", $search_condition));

 /*
$result_array = ClassRegistry::init('TravelCitySupplier')->find('all', array('fields' => array('supplier_city_code'),'conditions' => array('TravelCitySupplier.city_country_id' => $get_country_id,'TravelCitySupplier.city_id' => $get_city_id,'TravelCitySupplier.supplier_id ' => $get_supplier_id,'TravelCitySupplier.active ' => 'TRUE','TravelCitySupplier.excluded ' => 'FALSE')));

 count($result_array);

	$checkCondition = false;

	foreach( $result_array as  $results){

		$found_city_code = $results['TravelCitySupplier']['supplier_city_code'];		

		$conditions['or'][] = array('SupplierHotel.city_code =' => $found_city_code);   

		$checkCondition = true;

        }			

array_push($search_condition, $conditions);

array_push($search_condition, array('SupplierHotel.supplier_id' => $get_supplier_id));
*/	
} elseif ($this->request->is('get')) {

            if (!empty($this->request->params['named']['supplier_id'])) {
                $supplier_id = $this->data['TravelHotelLookup']['supplier_id'];
            }
 }

 if (!isset($this->passedArgs['supplier_id']) && empty($this->passedArgs['supplier_id'])) {
      $this->passedArgs['supplier_id'] = (isset($this->data['TravelHotelLookup']['supplier_id'])) ? $this->data['TravelHotelLookup']['supplier_id'] : '';
 }

 if (!isset($this->data) && empty($this->data)) {
      $this->data['TravelHotelLookup']['supplier_id'] = $this->passedArgs['supplier_id'];
 }



 $this->set(compact('TravelCities', 'TravelCitySuppliers', 'supplier_city_codde', 'Provinces', 'TravelCountries', 'check_mapp', 'display', 'TravelLookupContinents'
                        , 'TravelSuppliers', 'supplier_id', 'continent_id', 'country_id', 'country_name', 'province_id', 'city_id', 'city_name', 'hotel_name','msg_flag','msg'));

    }

    
}

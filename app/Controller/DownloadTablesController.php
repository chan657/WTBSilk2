<?php

/**
 * DownloadTables controller.
 *
 * This file will render views from views/DownloadTables/
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
 * DownloadTables controller
 *
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class DownloadTablesController extends AppController {

    public $uses = array('TravelLookupContinent','TravelLookupChainPresence','TravelLookupChainSegment','TravelHotelLookup', 
        'TravelCountry', 'TravelCity', 'TravelCountrySupplier', 'TravelHotelRoomSupplier', 'TravelCitySupplier',
        'TravelChain','TravelBrand','TravelLookupBrandPresence','TravelLookupBrandSegment','TravelSuburb','TravelArea','Province'
        ,'lookupValueTravelAllocation','TravelLookupPropertyType','TravelLookupRateType','TravelMappingType','TravelLookupValueContractStatus',
        'TravelSupplier','TravelSupplierStatus','LookupAgentNatureOfBusiness','LookupAgentProcurementType','LookupAgentSource',
        'LookupAgentStatus','TravelHotelAmenitie','TravelHotelReviewItem','TravelLookupAmenityCategorie','TravelLookupAmenityType',
		'TravelLookupReviewTopic');

    public function index() {

        $offset = 1;
        $structure = array();
        $counts = '';
        $search_condition = array();
        $operation = '';
        $table = '';
        $country_id = '';
        $DataArray = array();
        $tableOption = array();
        
        if ($this->request->is('post')) {
            
            

            $operation = $this->data['DownloadTable']['operation'];
            $table = $this->data['DownloadTable']['table'];
            $type_id = $this->data['DownloadTable']['type_id'];
            
            if($type_id == '1')
                $tableOption = array('TravelCountry' => 'Country', 'TravelCity' => 'City', 'TravelHotelLookup' => 'Hotel', 'TravelCountrySupplier' => 'Country Mapping', 'TravelCitySupplier' => 'City Mapping', 'TravelHotelRoomSupplier' => 'Hotel Mapping', 'TravelSuburb' => 'Suburb', 'TravelArea' => 'Area', 'TravelLookupContinent' => 'Continent', 'TravelChain' => 'Chain', 'TravelBrand' => 'Brand','Province' => 'Province','TravelSupplier' => 'Supplier','TravelHotelAmenitie' => 'Amenity','TravelHotelReviewItem' => 'Review',);
            elseif($type_id == '2')
                
            $tableOption = array('TravelLookupChainPresence' => 'Lookup Chain Presence', 'TravelLookupChainSegment' => 'Lookup Chain Segment', 'TravelLookupBrandPresence' => 'Lookup Brand Presence', 'TravelLookupBrandSegment' => 'Lookup Brand Segment','lookupValueTravelAllocation' => 'Lookup Allocation'
                ,'TravelLookupPropertyType' => 'Lookup Property Type','TravelLookupRateType' => 'Lookup Rate Type',
                'TravelLookupValueContractStatus' => 'Lookup Contract Status','TravelMappingType' => 'Lookup Mapping Type','TravelSupplierStatus' => 'Lookup Supplier Status',
                'LookupAgentNatureOfBusiness' => 'Lookup AgentNature Business','LookupAgentProcurementType' => 'Lookup Agent Procurement Type',
                'LookupAgentSource' => 'Lookup Agent Source','LookupAgentStatus' => 'Lookup Agent Status','TravelLookupAmenityCategorie' => 'Lookup Amenity Category','TravelLookupAmenityType' => 'Lookup Amenity Type','TravelLookupReviewTopic' => 'Lookup Review Type'); 

          
            if (!empty($this->data['DownloadTable']['country_id'])) {
                $country_id = $this->data['DownloadTable']['country_id'];
                array_push($search_condition, array('country_id' => $country_id));
            }
            if (!empty($this->data['DownloadTable']['city_id'])) {
                $city_id = $this->data['DownloadTable']['city_id'];
                array_push($search_condition, array('city_id' => $city_id));
            }
            if (!empty($this->data['DownloadTable']['hotel_country_id'])) {
                $country_id = $this->data['DownloadTable']['hotel_country_id'];
                array_push($search_condition, array('hotel_country_id' => $country_id));
            }
            if (!empty($this->data['DownloadTable']['hotel_city_id'])) {
                $hotel_city_id = $this->data['DownloadTable']['hotel_city_id'];
                array_push($search_condition, array('hotel_city_id' => $hotel_city_id));
            }
            if (!empty($this->data['DownloadTable']['active'])) {
                $active = $this->data['DownloadTable']['active'];
                array_push($search_condition, array('active' => $active));
            }
            if (!empty($this->data['DownloadTable']['wtb_status'])) {
                $wtb_status = $this->data['DownloadTable']['wtb_status'];
                array_push($search_condition, array('wtb_status' => $wtb_status));
            }
            if (!empty($this->data['TravelHotelLookup']['status'])) {
                $status = $this->data['TravelHotelLookup']['status'];
                array_push($search_condition, array('status' => $status));
            }
            if (!empty($this->data['TravelHotelRoomSupplier']['hotel_supplier_status'])) {
                $status = $this->data['TravelHotelRoomSupplier']['hotel_supplier_status'];
                array_push($search_condition, array('hotel_supplier_status' => $status));
            }
            
            if ($country_id) {
            $DataArray = $this->TravelCity->find('list', array(
                'conditions' => array(
                    'TravelCity.country_id' => $country_id,
                    'TravelCity.city_status' => '1',
                    'TravelCity.wtb_status' => '1',
                    'TravelCity.active' => 'TRUE',
                ),
                'fields' => 'TravelCity.id, TravelCity.city_name',
                'order' => 'TravelCity.city_name ASC'
            ));
        }

        $this->TravelHotelLookup->unbindModel(
                array('hasMany' => array('TravelHotelRoomSupplier'))
            );
      
   

            if ($operation == '1') { // Table Structure                
               $structure = $this->$table->schema();
               
            } elseif ($operation == '2') { // Data Download
                if (!empty($this->data['DownloadTable']['offset'])) {
                    $offset = $this->data['DownloadTable']['offset'];
                }

                

                $data = $this->$table->find('all', array('conditions' => $search_condition,'limit' => 5000, 'offset' => $offset - 1));
                $csv_name = date('Y-m-d') . '-' . $table . '.csv';
                $this->Export->exportCsv($data, $csv_name);
            } elseif ($operation == '3') {  // Data Count
                $counts = $this->$table->find('count',array('conditions' => $search_condition));
            }
            
              // $log = $this->$table->getDataSource()->getLog(false, false);       
             // debug($log);
             // die;
        }
        $TravelCountries = $this->TravelCountry->find('list', array('fields' => 'id, country_name','conditions' => array('TravelCountry.country_status' => '1','TravelCountry.active' => 'TRUE','TravelCountry.wtb_status' => '1'), 'order' => 'country_name ASC'));
        $this->set(compact('TravelCountries','structure','counts','operation','table','DataArray','tableOption'));
    
    }
    
    public function download_ota(){
        $offset = 1;
        $fields = array();
        $counts = '';
        $search_condition = array();
        $operation = '';
        $table = '';
        $suburb_id = '';
        $chain_id = '';
        $country_id = '';
        $city_id = '';
        $DataArray = array();
        $Suburbs = array();
        $Chains = array();
        $Areas = array();
        $Brands = array();
        $tableOption = array();
        
        if ($this->request->is('post')) {
            
            
            

            $operation = $this->data['DownloadTable']['operation'];
            $table = $this->data['DownloadTable']['table'];
            $type_id = $this->data['DownloadTable']['type_id'];
            
            if($type_id == '1')
            $tableOption = array('TravelLookupContinent' => 'Continent','TravelCountry' => 'Country','Province' => 'Province', 'TravelCity' => 'City', 'TravelSuburb' => 'Suburb', 'TravelArea' => 'Area','TravelChain' => 'Chain','TravelBrand' => 'Brand','TravelHotelLookup' => 'Hotel');
        elseif($type_id == '2')
            $tableOption = array('TravelLookupChainPresence' => 'Lookup Chain Presence', 'TravelLookupChainSegment' => 'Lookup Chain Segment', 'TravelLookupBrandPresence' => 'Lookup Brand Presence', 'TravelLookupBrandSegment' => 'Lookup Brand Segment','lookupValueTravelAllocation' => 'lookup Allocation'
                ,'TravelLookupPropertyType' => 'Lookup Property Type','TravelLookupRateType' => 'Lookup Rate Type',
                'TravelLookupValueContractStatus' => 'Lookup Contract Status','TravelMappingType' => 'Lookup Mapping Type'); 
            
            $this->TravelHotelLookup->unbindModel(
                array('hasMany' => array('TravelHotelRoomSupplier'))
            );
            
            
            if (!empty($this->data['DownloadTable']['country_id'])) {
                $country_id = $this->data['DownloadTable']['country_id'];
                array_push($search_condition, array($table.'.country_id' => $country_id));
            }
            if (!empty($this->data['DownloadTable']['city_id'])) {
                $city_id = $this->data['DownloadTable']['city_id'];
                array_push($search_condition, array($table.'.city_id' => $city_id));
            }         
            if (!empty($this->data['DownloadTable']['brand_chain_id'])) {
                $chain_id = $this->data['DownloadTable']['brand_chain_id'];
                array_push($search_condition, array($table.'.brand_chain_id' => $chain_id));
            }
            if (!empty($this->data['DownloadTable']['suburb_id'])) {
                $suburb_id = $this->data['DownloadTable']['suburb_id'];
                array_push($search_condition, array($table.'.suburb_id' => $suburb_id));
               
            }
            if (!empty($this->data['DownloadTable']['chain_id'])) {
                $chain_id = $this->data['DownloadTable']['chain_id'];
                array_push($search_condition, array($table.'.chain_id' => $chain_id));
            }
            if (!empty($this->data['DownloadTable']['area_id'])) {
                $area_id = $this->data['DownloadTable']['area_id'];
                array_push($search_condition, array($table.'.chain_id' => $area_id));
            }
            if (!empty($this->data['DownloadTable']['brand_id'])) {
                $brand_id = $this->data['DownloadTable']['brand_id'];
                array_push($search_condition, array($table.'.chain_id' => $brand_id));
            }
            
            if ($country_id) {
            $DataArray = $this->TravelCity->find('list', array(
                'conditions' => array(
                    'TravelCity.country_id' => $country_id,
                    'TravelCity.city_status' => '1',
                    'TravelCity.wtb_status' => '1',
                    'TravelCity.active' => 'TRUE',
                ),
                'fields' => 'TravelCity.id, TravelCity.city_name',
                'order' => 'TravelCity.city_name ASC'
            ));
        }
        if ($city_id) {
             $Suburbs = $this->TravelSuburb->find('list', array(
                'conditions' => array(
                    'TravelSuburb.country_id' => $country_id,
                    'TravelSuburb.city_id' => $city_id,
                    'TravelSuburb.status' => '1',
                    'TravelSuburb.wtb_status' => '1',
                    'TravelSuburb.active' => 'TRUE'
                ),
                'fields' => 'TravelSuburb.id, TravelSuburb.name',
                'order' => 'TravelSuburb.name ASC'
            ));
        }
        
        if ($suburb_id) {
            $Areas = $this->TravelArea->find('list', array(
                'conditions' => array(
                    'TravelArea.suburb_id' => $suburb_id,
                    'TravelArea.area_status' => '1',
                    'TravelArea.wtb_status' => '1',
                    'TravelArea.area_active' => 'TRUE'
                ),
                'fields' => 'TravelArea.id, TravelArea.area_name',
                'order' => 'TravelArea.area_name ASC'
            ));
        }
        if ($chain_id) {
            $Chains = $this->TravelBrand->find('list', array(
                'conditions' => array(
                    'TravelBrand.brand_chain_id' => $chain_id,
                    'TravelBrand.brand_status' => '1',
                    'TravelBrand.wtb_status' => '1',
                    'TravelBrand.brand_active' => 'TRUE'
                ),
                'fields' => 'TravelBrand.id, TravelBrand.brand_name',
                'order' => 'TravelBrand.brand_name ASC'
            ));
        }
   
            if($table == 'TravelLookupContinent'){
                $fields = array('id','continent_name','continent_code');
                array_push($search_condition, array($table.'.active' => 'TRUE'));
                
            }
            elseif($table == 'TravelCountry'){
                $fields = array('id','country_name','country_code','continent_id','continent_name','continent_code');
                //array_push($search_condition, array($table.'.active' => 'TRUE'));
            }
            elseif($table == 'TravelCity'){
                $fields = array('id','city_name','city_code','country_id','country_name','country_code','continent_id','continent_name','province_id','province_name');
                array_push($search_condition, array($table.'.active' => 'TRUE'));
            }
            elseif($table == 'TravelSuburb'){
                $fields = array('id','name','city_id','city_name','country_id','country_name','continent_id','continent_name','province_id','province_name');  
                array_push($search_condition, array($table.'.active' => 'TRUE'));
            }
            elseif($table == 'TravelArea'){
                $fields = array('id','area_name','suburb_id','suburb_name','city_id','city_name','country_id','country_name','continent_id','continent_name','province_id','province_name');                
                array_push($search_condition, array($table.'.area_active' => 'TRUE'));
            }
            elseif($table == 'TravelChain'){
                $fields = array('id','chain_name'); 
                array_push($search_condition, array($table.'.chain_active' => 'TRUE'));
            }
            elseif($table == 'TravelBrand'){
                $fields = array('id','brand_name','brand_chain_id','brand_chain_name');    
                array_push($search_condition, array($table.'.brand_active' => 'TRUE'));
            }
            elseif($table == 'TravelHotelLookup'){
                $fields = array('id','hotel_name','hotel_code','continent_id','continent_name','city_id','city_name','country_id','country_name','suburb_id','suburb_name','area_id','area_name','brand_id','brand_name','chain_id','chain_name','province_id','province_name','hotel_comment','star','keyword','standard_rating','hotel_rating','food_rating','service_rating','location_rating','value_rating','overall_rating','business_center','meeting_facilities','dining_facilities','bar_lounge','fitness_center','pool','golf','tennis','kids','handicap','url_hotel','address','post_code','no_room','active','gps_prm_1','gps_prm_2');                
                array_push($search_condition, array($table.'.active' => 'TRUE'));
                //$search_condition = array('country_id' => '220');                
            }

            if ($operation == '2') { // Data Download
                if (!empty($this->data['DownloadTable']['offset'])) {
                    $offset = $this->data['DownloadTable']['offset'];
                }                

                $data = $this->$table->find('all', array('conditions' => $search_condition,'fields' => $fields,'limit' => 5000, 'offset' => $offset - 1));
                $csv_name = date('Y-m-d') . '-' . $table . '.csv';
                //$log = $this->$table->getDataSource()->getLog(false, false);       
               //debug($log);
                $this->Export->exportCsv($data, $csv_name);
            } elseif ($operation == '3') {  // Data Count
                $counts = $this->$table->find('count',array('conditions' => $search_condition));
            }
            
            
            
               //$log = $this->$table->getDataSource()->getLog(false, false);       
               //debug($log);
             // die;
        }
        $TravelCountries = $this->TravelCountry->find('list', array('fields' => 'id, country_name','conditions' => array('TravelCountry.id' => '220'), 'order' => 'country_name ASC'));
        $Chains = $this->TravelChain->find('list', array(
                'conditions' => array(                   
                    'TravelChain.chain_status' => '1',
                    'TravelChain.wtb_status' => '1',
                    'TravelChain.chain_active' => 'TRUE'
                ),
                'fields' => 'TravelChain.id, TravelChain.chain_name',
                'order' => 'TravelChain.chain_name ASC'
            ));
        
        $this->set(compact('counts','tableOption','operation','table','TravelCountries','DataArray','Suburbs','Chains','Areas','Brands'));
        
    }

}
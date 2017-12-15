<?php
App::uses('AppModel', 'Model');
	
class Common extends AppModel {

   var $useTable = false;

   public function getContinentCode($continent_id){
        $DataArray = ClassRegistry::init('TravelLookupContinent')->find('first', array('fields' => array('continent_code'), 'conditions' => array('TravelLookupContinent.id' => $continent_id)));
        return $DataArray['TravelLookupContinent']['continent_code'];
    }
    
    public function getContinentName($continent_id){
        $DataArray = ClassRegistry::init('TravelLookupContinent')->find('first', array('fields' => array('continent_name'), 'conditions' => array('TravelLookupContinent.id' => $continent_id)));
        return $DataArray['TravelLookupContinent']['continent_name'];
    }
    
   public function getCountryCode($country_id){
        $DataArray = ClassRegistry::init('TravelCountry')->find('first', array('fields' => array('country_code'), 'conditions' => array('TravelCountry.id' => $country_id)));
        return $DataArray['TravelCountry']['country_code'];
    }
    
    public function getCountryName($country_id){
        $DataArray = ClassRegistry::init('TravelCountry')->find('first', array('fields' => array('country_name'), 'conditions' => array('TravelCountry.id' => $country_id)));
        return $DataArray['TravelCountry']['country_name'];
    }
    
    public function getProvinceName($province_id){
        $DataArray = ClassRegistry::init('Province')->find('first', array('fields' => array('name'), 'conditions' => array('Province.id' => $province_id)));
        return $DataArray['Province']['name'];
    }
    
    public function getCityName($city_id){
        $DataArray = ClassRegistry::init('TravelCity')->find('first', array('fields' => array('city_name'), 'conditions' => array('TravelCity.id' => $city_id)));
        return $DataArray['TravelCity']['city_name'];
    }
    
    public function getSuburbName($suburb_id){
        $DataArray = ClassRegistry::init('TravelSuburb')->find('first', array('fields' => array('name'), 'conditions' => array('TravelSuburb.id' => $suburb_id)));
        return $DataArray['TravelSuburb']['name'];
    }
    
    public function getHotelName($hotel_id){
        $DataArray = ClassRegistry::init('TravelHotelLookup')->find('first', array('fields' => array('hotel_name'), 'conditions' => array('TravelHotelLookup.id' => $hotel_id)));
        return $DataArray['TravelHotelLookup']['hotel_name'];
    }
    
    public function getHotelCode($hotel_id){
        $DataArray = ClassRegistry::init('TravelHotelLookup')->find('first', array('fields' => array('hotel_code'), 'conditions' => array('TravelHotelLookup.id' => $hotel_id)));
        return $DataArray['TravelHotelLookup']['hotel_code'];
    }
    
    public function getSupplierCountryCode($country_id){
        $DataArray = ClassRegistry::init('SupplierCountry')->find('first', array('fields' => array('code'), 'conditions' => array('SupplierCountry.id' => $country_id)));
        return $DataArray['SupplierCountry']['code'];
    }
    
    public function getSupplierCityCode($city_id){
        $DataArray = ClassRegistry::init('SupplierCity')->find('first', array('fields' => array('code'), 'conditions' => array('SupplierCity.id' => $city_id)));
        return $DataArray['SupplierCity']['code'];
    }
    
    public function getSupplierCode($supplier_id){
        $DataArray = ClassRegistry::init('TravelSupplier')->find('first', array('fields' => array('supplier_code'), 'conditions' => array('TravelSupplier.id' => $supplier_id)));
        return $DataArray['TravelSupplier']['supplier_code'];
    }
    
    public function getSupplierCountryName($country_id){
        $DataArray = ClassRegistry::init('SupplierCountry')->find('first', array('fields' => array('name'), 'conditions' => array('SupplierCountry.id' => $country_id)));
        return $DataArray['SupplierCountry']['name'];
    }
    
    public function getSupplierCityName($city_id){
        $DataArray = ClassRegistry::init('SupplierCity')->find('first', array('fields' => array('name'), 'conditions' => array('SupplierCity.id' => $city_id)));
        return $DataArray['SupplierCity']['name'];
    }
    
    public function getSupplierName($supplier_id){
        $DataArray = ClassRegistry::init('TravelSupplier')->find('first', array('fields' => array('supplier_name'), 'conditions' => array('TravelSupplier.id' => $supplier_id)));
        return $DataArray['TravelSupplier']['supplier_name'];
    }
    
    public function getDepartmentByQuestionId($answer_id){
        
        $Data = ClassRegistry::init('LookupQuestion')->find('first', array('fields' => array( 'LookupQuestion.department_id'), 'conditions' => array('LookupQuestion.id' => $answer_id)));
        return $Data['LookupQuestion']['department_id'];
    }
    
    public function getNextActionByDepartmentId($department_id){
        
        $Data = ClassRegistry::init('LookupDepartment')->find('first', array('fields' => array( 'LookupDepartment.next_action_by'), 'conditions' => array('LookupDepartment.id' => $department_id)));
        return $Data['LookupDepartment']['next_action_by'];
    }
    
    public function getSupplierHotelName($supplier_hotel_id){
        $DataArray = ClassRegistry::init('SupplierHotel')->find('first', array('fields' => array('hotel_name'), 'conditions' => array('SupplierHotel.id' => $supplier_hotel_id)));
        return $DataArray['SupplierHotel']['hotel_name'];
    }
    
    public function getSupplierHotelCode($supplier_hotel_id){
        $DataArray = ClassRegistry::init('SupplierHotel')->find('first', array('fields' => array('hotel_code'), 'conditions' => array('SupplierHotel.id' => $supplier_hotel_id)));
        return $DataArray['SupplierHotel']['hotel_code'];
    }
    
    public function checkAreaExistsHotel($area_id){
        return ClassRegistry::init('TravelHotelLookup')->find('count', array('fields' => array('TravelHotelLookup.id'), 'conditions' => array('TravelHotelLookup.area_id' => $area_id)));    
    }
    
    public function checkSuburbExistsHotel($suburb_id){
        return ClassRegistry::init('TravelHotelLookup')->find('count', array('fields' => array('TravelHotelLookup.id'), 'conditions' => array('TravelHotelLookup.suburb_id' => $suburb_id)));    
    }
    
    public function checkSuburbExistsArea($suburb_id){
        return ClassRegistry::init('TravelArea')->find('count', array('fields' => array('TravelArea.id'), 'conditions' => array('TravelArea.suburb_id' => $suburb_id)));    
    }
    
    public function checkHotelExistsHotelMapping($hotel_id){
        return ClassRegistry::init('TravelHotelRoomSupplier')->find('count', array('fields' => array('TravelHotelRoomSupplier.id'), 'conditions' => array('TravelHotelRoomSupplier.hotel_id' => $hotel_id)));    
    }
    
    public function checkCityExistsCityMapping($city_id){
        return ClassRegistry::init('TravelCitySupplier')->find('count', array('fields' => array('TravelCitySupplier.id'), 'conditions' => array('TravelCitySupplier.city_id' => $city_id)));    
    }
    
    public function checkCityExistsSuburb($city_id){
        return ClassRegistry::init('TravelSuburb')->find('count', array('fields' => array('TravelSuburb.id'), 'conditions' => array('TravelSuburb.city_id' => $city_id)));    
    }
    
    public function checkCityExistsArea($city_id){
        return ClassRegistry::init('TravelArea')->find('count', array('fields' => array('TravelArea.id'), 'conditions' => array('TravelArea.city_id' => $city_id)));    
    }
    
    public function checkCityExistsHotel($city_id){
        return ClassRegistry::init('TravelHotelLookup')->find('count', array('fields' => array('TravelHotelLookup.id'), 'conditions' => array('TravelHotelLookup.city_id' => $city_id)));    
    }
    
    public function checkProvinceExistsHotel($province_id){
        return ClassRegistry::init('TravelHotelLookup')->find('count', array('fields' => array('TravelHotelLookup.id'), 'conditions' => array('TravelHotelLookup.province_id' => $province_id)));    
    }
    
    public function checkProvinceExistsCity($province_id){
        return ClassRegistry::init('TravelCitySupplier')->find('count', array('fields' => array('TravelCitySupplier.id'), 'conditions' => array('TravelCitySupplier.province_id' => $province_id)));    
    }
    
    public function checkProvinceExistsSuburb($province_id){
        return ClassRegistry::init('TravelSuburb')->find('count', array('fields' => array('TravelSuburb.id'), 'conditions' => array('TravelSuburb.province_id' => $province_id)));    
    }
    
    public function checkProvinceExistsArea($province_id){
        return ClassRegistry::init('TravelArea')->find('count', array('fields' => array('TravelArea.id'), 'conditions' => array('TravelArea.province_id' => $province_id)));    
    }
    
    Public function GetIndiaTime(){
        return date('Y-m-d H:i:s', strtotime('+10 hour 30 minutes'));
    }
}
?>
<?php

App::uses('AppController', 'Controller');
class TravelCoreLookUpsController extends AppController{
    var $uses = array('TravelCity','TravelCountry','TravelCitySupplier','TravelCountrySupplier','TravelCurrencyByCountryForSupplier',
                        'TravelCurrencyForSupplier','TravelHotelRoomSupplier','TravelHotelLookup','TravelHotelRoomlookup','TravelNationalityForSupplier',
                        'TravelSupplier'
                      );

    
    public function index(){

        /*
         $TravelCities = $this->TravelCity->find('all',array('order' => 'city_name asc'));         
         $this->set('TravelCities', $this->paginate("TravelCity"));
       
       
         $TravelCountries = $this->TravelCountry->find('all',array('order' => 'country_name asc'));
         $this->set(compact('TravelCountries'));
         
         
         $TravelNationalityForSuppliers = $this->TravelNationalityForSupplier->find('all',array('order' => 'id asc'));
         $this->set(compact('TravelNationalityForSuppliers'));
         
         $TravelSuppliers = $this->TravelSupplier->find('all',array('order' => 'id asc'));
         $this->set(compact('TravelSuppliers'));
         * 
         */
          
    }
    
  
    
}
?>
<?php

App::uses('AppModel', 'Model');

class SupportTicket extends AppModel {

    public $name = 'SupportTicket';
    
    public $belongsTo = array(
            'LookupTicketUrgency' => array(
                'className' => 'LookupTicketUrgency',                
                'foreignKey' => 'urgency',
            ),  
        'LookupTicketStatus' => array(
                'className' => 'LookupTicketStatus',                
                'foreignKey' => 'status',
            ),
        'LookupScreen' => array(
                'className' => 'LookupScreen',                
                'foreignKey' => 'screen',
            ),
        'LookupDepartment' => array(
                'className' => 'LookupDepartment',                
                'foreignKey' => 'department_id',
            ),
        'LookupTicketType' => array(
                'className' => 'LookupTicketType',                
                'foreignKey' => 'type',
            ),
        'Answer' => array(
                'className' => 'LookupQuestion',                
                'foreignKey' => 'answer',
            ),
        'Response' => array(
                'className' => 'LookupTicketSolution',                
                'foreignKey' => 'response',
            ),
        'LookupResponseIssue' => array(
                'className' => 'LookupResponseIssue',                
                'foreignKey' => 'response_issue_id',
            ),
        );
    
    public function getCountryNameByCountryId($country_id){
        
        $Data = ClassRegistry::init('TravelCountry')->find('first', array('fields' => array( 'TravelCountry.country_name'), 'conditions' => array('TravelCountry.id' => $country_id)));
        return $Data['TravelCountry']['country_name'];
    }
    
    public function getContinentNameByContinentId($continent_id){
        
        $Data = ClassRegistry::init('TravelLookupContinent')->find('first', array('fields' => array( 'TravelLookupContinent.continent_name'), 'conditions' => array('TravelLookupContinent.id' => $continent_id)));
        return $Data['TravelLookupContinent']['continent_name'];
    }
    
    public function getHotelNameByHotelId($hotel_id){
        
        $Data = ClassRegistry::init('TravelHotelLookup')->find('first', array('fields' => array( 'TravelHotelLookup.hotel_name','TravelHotelLookup.hotel_code','TravelHotelLookup.id'), 'conditions' => array('TravelHotelLookup.id' => $hotel_id)));
        return $Data['TravelHotelLookup']['hotel_name'].' | Code: '.$Data['TravelHotelLookup']['hotel_code'].' | Id: '.$Data['TravelHotelLookup']['id'];
    }

    public function getSupplierHotelNameByHotelId($hotel_id){
        
        $Data = ClassRegistry::init('SupplierHotel')->find('first', array('fields' => array( 'SupplierHotel.hotel_name','SupplierHotel.hotel_code','SupplierHotel.id'), 'conditions' => array('SupplierHotel.id' => $hotel_id)));
        return $Data['SupplierHotel']['hotel_name'].' | Code: '.$Data['SupplierHotel']['hotel_code'].' | Id: '.$Data['SupplierHotel']['id'];
    }
    
    public function getAnswerByAnswerId($answer_id){
        
        $Data = ClassRegistry::init('LookupQuestion')->find('first', array('fields' => array( 'LookupQuestion.question'), 'conditions' => array('LookupQuestion.id' => $answer_id)));
        return $Data['LookupQuestion']['question'];
    }
    
    public function getProvinceByProvinceId($province_id){
        
        $Data = ClassRegistry::init('Province')->find('first', array('fields' => array( 'Province.name'), 'conditions' => array('Province.id' => $province_id)));
        return $Data['Province']['name'];
    }
    
    public function getCityByCityId($city_id){
        
        $Data = ClassRegistry::init('TravelCity')->find('first', array('fields' => array( 'TravelCity.city_name'), 'conditions' => array('TravelCity.id' => $city_id)));
        return $Data['TravelCity']['city_name'];
    }
    
    public function getSuburbBySuburbId($suburb_id){
        
        $Data = ClassRegistry::init('TravelSuburb')->find('first', array('fields' => array( 'TravelSuburb.name'), 'conditions' => array('TravelSuburb.id' => $suburb_id)));
        return $Data['TravelSuburb']['name'];
    }
    
    public function getAreaByAreaId($area_id){
        
        $Data = ClassRegistry::init('TravelArea')->find('first', array('fields' => array( 'TravelArea.area_name'), 'conditions' => array('TravelArea.id' => $area_id)));
        return $Data['TravelArea']['area_name'];
    }
    
    public function getDepartmentByQuestionId($answer_id){
        
        $Data = ClassRegistry::init('LookupQuestion')->find('first', array('fields' => array( 'LookupQuestion.department_id'), 'conditions' => array('LookupQuestion.id' => $answer_id)));
        return $Data['LookupQuestion']['department_id'];
    }
    
    public function getNextActionByDepartmentId($department_id){
        
        $Data = ClassRegistry::init('LookupDepartment')->find('first', array('fields' => array( 'LookupDepartment.next_action_by'), 'conditions' => array('LookupDepartment.id' => $department_id)));
        return $Data['LookupDepartment']['next_action_by'];
    }
    
    public function getHotelByHotelId($hotel_id){
        
        $Data = ClassRegistry::init('TravelHotelLookup')->find('first', array('fields' => array( 'TravelHotelLookup.hotel_name'), 'conditions' => array('TravelHotelLookup.id' => $hotel_id)));
        return $Data['TravelHotelLookup']['hotel_name'];
    }
    public function getChainId($chain_id){
        
        $Data = ClassRegistry::init('TravelChain')->find('first', array('fields' => array( 'TravelChain.chain_name'), 'conditions' => array('TravelChain.id' => $chain_id)));
        return $Data['TravelChain']['chain_name'];
    }
    public function getBrandId($brand_id){
        
        $Data = ClassRegistry::init('TravelBrand')->find('first', array('fields' => array( 'TravelBrand.brand_name'), 'conditions' => array('TravelBrand.id' => $brand_id)));
        return $Data['TravelBrand']['brand_name'];
    }
    public function getNextActionById($ticket_id){
        
        $Data = ClassRegistry::init('SupportTicket')->find('first', array('fields' => array( 'SupportTicket.created_by'), 'conditions' => array('SupportTicket.id' => $ticket_id)));
        return $Data['SupportTicket']['created_by'];
    }

}

?>
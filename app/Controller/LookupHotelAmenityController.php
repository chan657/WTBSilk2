<?php

App::uses('AppController', 'Controller');
class LookupHotelAmenityController extends AppController{
    var $uses = array('TravelLookupAmenityCategorie','TravelLookupAmenityType');

    
    public function index(){

         $categories = $this->TravelLookupAmenityCategorie->find('all',array('order' => 'TravelLookupAmenityCategorie.value asc'));
         $this->set(compact('categories'));
         
         $amenities = $this->TravelLookupAmenityType->find('all', array(
            'fields' => array('TravelLookupAmenityType.amenity_category_id,TravelLookupAmenityType.id,GROUP_CONCAT(TravelLookupAmenityType.value separator " , ") AS amenity_name', 'TravelLookupAmenityCategorie.value'),
            'joins' => array(
                array(
                    'table' => 'travel_lookup_amenity_categories',
                    'alias' => 'TravelLookupAmenityCategorie',
                    'type' => 'INNER',
                    'conditions' => 'TravelLookupAmenityType.amenity_category_id = TravelLookupAmenityCategorie.id'
                )
            ),
            'order' => 'TravelLookupAmenityType.amenity_category_id',
            'group' => array('TravelLookupAmenityType.amenity_category_id')));
         
        $this->set(compact('amenities'));
          
    }
    
  
    
}
?>
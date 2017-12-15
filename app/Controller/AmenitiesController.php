<?php

class AmenitiesController extends AppController {

    var $uses = array('Amenity', 'Group','Project','Lead','LookupValueAmenitie');
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session');

    
    public function add($id = null) {
         $this->layout = '';

        if ($this->request->is('post')) {
        

            $project_id = $id;
           // pr($data);
           // die;
            $this->Amenity->create();
               
                 foreach ($this->data['Amenity']['amenity_id'] as $amenities) {
                    $save[] = array('Amenity' => array(
                            'amenity_id' => $amenities,
                            'project_id' => $project_id,
                           
                    ));
                }
                
                  if($this->Amenity->saveMany($save)){
                     $this->Session->setFlash('Amenity has been saved.', 'success');
                     echo '<script>parent.$.fancybox.close(); parent.location.reload(true);</script>';
                  }
                  else{
                    $this->Session->setFlash('Unable to add Project.', 'failure');
                  }
  
       
        }
        $condition= array();
        
        $amen = $this->Amenity->find('threaded',array('conditions' => array('Amenity.project_id = '.$id)));
        $amenities = $this->Amenity->findByProjectId($id);
        $this->set(compact('amenities'));
        
        foreach($amen as $ame){
            $condition[] = $ame['LookupValueAmenitie']['group_id'];
        }
        $result = array_unique($condition);


        $groups = $this->Group->find('list',array('fields' => array('id','group_name'), 'conditions' => array('Group.id NOT IN' => $result)));

        $this->set(compact('groups'));
        
        
        
        
    }


    /* $cities = $this->Suburb->City->find('all', array('order' => 'City.city_name ASC'));
      $arrCity = array();
      if (count($cities) > 0)
      {
      foreach ($cities as $city)
      {
      $arrCity[$city['City']['id']] = $city['City']['city_name'];
      }
      }

      $this->set('citiess', $arrCity);
      }
     */

    function edit($id = null,$project_id = null) {
        $this->layout = 'ajax';
        
        $amenities = $this->Amenity->findByProjectId($project_id);
        $this->set(compact('amenities'));
       // pr($amenities);
       
        
        $selected_grp = $this->Group->findById($id);
        $this->set(compact('selected_grp'));

        if ($this->request->is('post')) {
                     
        $conditions = $this->LookupValueAmenitie->find('list',array('fields' => array('id'),
                                                                    'conditions' => 'LookupValueAmenitie.group_id = '.$id
                                                                    ));

            if($this->Amenity->deleteAll(array('Amenity.amenity_id' => $conditions))){
                
                foreach ($this->data['Amenity']['amenity_id'] as $amenities) {
                        $save[] = array('Amenity' => array(
                                'amenity_id' => $amenities,
                                'project_id' => $project_id,
                               
                        ));
                    }
                    
                      if($this->Amenity->saveMany($save)){
                         $this->Session->setFlash('Amenity has been saved.', 'success');
                         echo '<script>parent.$.fancybox.close(); parent.location.reload(true);</script>';
                      }
            }
            

        }
        
        $groups = $this->Group->find('list',array('fields' => array('id','group_name'),'order' => 'Group.group_name asc'));
        $this->set(compact('groups'));
        
        $amenity = $this->LookupValueAmenitie->find('list',array('fields' => array('LookupValueAmenitie.id','LookupValueAmenitie.amenity_name'),'conditions' => array('LookupValueAmenitie.group_id = '.$id)));
        $this->set(compact('amenity'));

        $selected = $this->Amenity->find('list', array(
            'fields' => array('Amenity.id', 'Amenity.amenity_id'),
            /*
            'joins' => array(
                            array(
                                'table' => 'lookup_value_amenities',
                                'alias' => 'LookupValueAmenitie',
                                'type' => 'INNER',
                                'conditions' => array(
                                    'Amenity.amenity_id = LookupValueAmenitie.id'
                                )
                                  ),
                             array(
                                'table' => 'groups',
                                'alias' => 'Group',
                                'type' => 'INNER',
                                'conditions' => array(
                                                    'LookupValueAmenitie.group_id = Group.id'
                                                    )
                             )
                             ),
                             */
            'conditions' => 'Amenity.project_id =' . $project_id,
        ));
       // pr($selected);

        $this->set('select_arr', $selected);
    }

}


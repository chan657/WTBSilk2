<?php
class DatasController extends AppController{
    var $uses = array('Group','LookupValueAmenitie');
    

    
    public function index(){
         
         $groups = $this->Group->find('all',array('order' => 'Group.group_name asc'));
         $this->set(compact('groups'));
         
         $amenities = $this->LookupValueAmenitie->find('all', array(
            'fields' => array('LookupValueAmenitie.group_id,LookupValueAmenitie.id,GROUP_CONCAT(LookupValueAmenitie.amenity_name separator " , ") AS amenity_name', 'Group.group_name'),
            'joins' => array(
                array(
                    'table' => 'groups',
                    'alias' => 'Group',
                    'type' => 'INNER',
                    'conditions' => 'LookupValueAmenitie.group_id = Group.id'
                )
            ),
            'order' => 'LookupValueAmenitie.group_id',
            'group' => array('LookupValueAmenitie.group_id')));
         
        $this->set(compact('amenities'));
        
  
    }
    
 
    public function add_amenities_group(){   
	
		$this->layout = 'ajax';     
        if ($this->request->is('post') || $this->request->is('put')) {

            $this->Group->set($this->data);

            if ($this->Group->validates() == true) {

                if ($this->Group->save($this->request->data)) {
                    $this->Session->setFlash('Amenities group has been saved.', 'success');
                   // $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to add amenities group.', 'error');
                }
				echo '<script>
				 			var objP=parent.document.getElementsByClassName("mfp-bg");
							var objC=parent.document.getElementsByClassName("mfp-wrap");
							objP[0].style.display="none";
							objC[0].style.display="none";
							parent.location.reload(true);</script>';	
            }
        }    
    }
    public function edit_amenities_group($id = null) {
	
		$this->layout = 'ajax';
        if (!$id) {
            throw new NotFoundException(__('Invalid Amenities Group'));
        }

        $groups = $this->Group->findById($id);

        if (!$groups) {
            throw new NotFoundException(__('Invalid Amenities Group'));
        }

        if ($this->request->data) {

            $this->Group->id = $id;
            if ($this->Group->save($this->request->data)) {
                $this->Session->setFlash('Amenities group has been updated.', 'success');
				
                //$this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to update amenities group.', 'failure');
            }
			echo '<script>
				 			var objP=parent.document.getElementsByClassName("mfp-bg");
							var objC=parent.document.getElementsByClassName("mfp-wrap");
							objP[0].style.display="none";
							objC[0].style.display="none";
							parent.location.reload(true);</script>';
        }

        if (!$this->request->data) {
            $this->request->data = $groups;
        }
    }
    public function add_amenities(){
        
		$this->layout = 'ajax';
        $groups = $this->Group->find('list',array('fields' => array('id','group_name'),'order' => 'Group.group_name asc'));
        $this->set(compact('groups'));
         
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->LookupValueAmenitie->validates() == true) {

                   $group_id = $this->data['LookupValueAmenitie']['group_id'];
                   
                   
                   
                     foreach ($this->data['LookupValueAmenitie']['amenity_name'] as $amenities) {
                        $save[] = array('LookupValueAmenitie' => array(
                                'amenity_name' => $amenities,
                                'group_id' => $group_id,
                        ));
                    }
                    
                      if($this->LookupValueAmenitie->saveMany($save)){
                         $this->Session->setFlash('Amenities has been saved.', 'success');
						 echo '<script>
				 			var objP=parent.document.getElementsByClassName("mfp-bg");
							var objC=parent.document.getElementsByClassName("mfp-wrap");
							objP[0].style.display="none";
							objC[0].style.display="none";
							parent.location.reload(true);</script>';
                      //   $this->redirect(array('action' => 'index'));
                        }
                      else {
                            $this->Session->setFlash('Unable to update amenities.', 'failure');
                        }
    
                
            }
        }    
    }
    public function edit_amenities($id = null) {
	
		$this->layout = 'ajax';
        if (!$id) {
            throw new NotFoundException(__('Invalid Amenities Group'));
        }
        
        $groups = $this->Group->find('list',array('fields' => array('id','group_name'),'order' => 'Group.group_name asc'));
        $this->set(compact('groups'));

        $amenities = $this->LookupValueAmenitie->findByGroupId($id);
        $amenity = $this->LookupValueAmenitie->find('all',array('conditions' => array('LookupValueAmenitie.group_id = '.$id)));
        $this->set(compact('amenity'));
        

        if (!$amenities) {
            throw new NotFoundException(__('Invalid Amenities Group'));
        }

        if ($this->request->data) {
            $group_id = $this->data['LookupValueAmenitie']['group_id'];
            
             if($this->LookupValueAmenitie->deleteAll(array('LookupValueAmenitie.group_id' => $id))) {
                
                   foreach ($this->data['LookupValueAmenitie']['amenity_name'] as $amenities) {
                        $save[] = array('LookupValueAmenitie' => array(
                                'amenity_name' => $amenities,
                                'group_id' => $group_id,
                        ));
                    }
                    
                      if($this->LookupValueAmenitie->saveMany($save)){
					   $this->Session->setFlash('Amenities has been saved.', 'success');
					  	echo '<script>
				 			var objP=parent.document.getElementsByClassName("mfp-bg");
							var objC=parent.document.getElementsByClassName("mfp-wrap");
							objP[0].style.display="none";
							objC[0].style.display="none";
							parent.location.reload(true);</script>';
                        
                       //  $this->redirect(array('action' => 'index'));
                        }
                      else {
                            $this->Session->setFlash('Unable to update amenities.', 'failure');
                        }
                
             }

         
        }

        if (!$this->request->data) {
            $this->request->data = $amenities;
        }
    }

    
}
?>
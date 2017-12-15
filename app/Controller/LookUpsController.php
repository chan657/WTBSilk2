<?php
class LookUpsController extends AppController{
    var $uses = array('Phase','Marketing','Category','ProjectType','Quality','ActionItemLevel','ActionItemType','LookupValueActionItemStatus',
                      'LookupValueLeadsCategory','LookupValueLeadsClosureProbability','LookupValueLeadsCountry',
                      'LookupValueLeadsCreationType','LookupValueLeadsImportance','LookupValueLeadsIndustry','LookupValueLeadsProgress',
                      'LookupValueLeadsSegment','LeadStatus','LookupValueLeadsType','LookupValueLeadsUrgency','LookupValueRatingTranslation',
                      'LookupValueRemarksLevel','LookupValueStatus','LookupValueChannelRole','LookupValueChannelStatus','LookupValueGeneralStatus',
                      'LookupValueDummyStatus','Group','LookupValueAmenitie','LookupValueProjectUnitType','LookupValueProjectUnitTypeQualifier_1',
                      'LookupValueProjectUnitTypeQualifier_2','LookupValueProjectUnitTypeQualifier_3','LookupValueProjectUnitTypeQualifier_4',
                      'LookupValueProjectUnitTypeQualifier_5','LookupBuilderContactInitiatedBy','LookupBuilderContactManagedBy','LookupBuilderContactPreparedBy','LookupBuilderContactLevel','LookupMarketingIndustry','LookupMarketingLocation','LookupMarketingSiteResourceType','LookupMarketingVertical'
                      );
    
    public $paginate = array(
            'paramType' => 'querystring',
            'limit' => 100,
            'maxLimit' => 200
        );
    
    public function index(){
        
         $this->paginate['order'] = array('Phase.name' => 'asc');   
         $this->set('phases', $this->paginate('Phase'));
         
         $marketings = $this->Marketing->find('all',array('order' => 'Marketing.name asc'));
         $this->set(compact('marketings'));
         
         $categories = $this->Category->find('all',array('order' => 'Category.name asc'));
         $this->set(compact('categories'));

         $types = $this->ProjectType->find('all',array('order' => 'ProjectType.name asc'));
         $this->set(compact('types'));
         
         $qualities= $this->Quality->find('all',array('order' => 'Quality.name asc'));
         $this->set(compact('qualities'));
		 
		 $LookupMarketingIndustry = $this->LookupMarketingIndustry->find('all',array('order' => 'value asc'));
         $this->set(compact('LookupMarketingIndustry'));
		 
		 $LookupMarketingLocation = $this->LookupMarketingLocation->find('all',array('order' => 'value asc'));
         $this->set(compact('LookupMarketingLocation'));
		 
		 $LookupMarketingSiteResourceType = $this->LookupMarketingSiteResourceType->find('all',array('order' => 'value asc'));
         $this->set(compact('LookupMarketingSiteResourceType'));
		 
		 $LookupMarketingVertical = $this->LookupMarketingVertical->find('all',array('order' => 'value asc'));
         $this->set(compact('LookupMarketingVertical'));
         
         $action_item_levels = $this->ActionItemLevel->find('all',array('order' => 'ActionItemLevel.level asc'));
         $this->set(compact('action_item_levels'));
         
         $action_item_types = $this->ActionItemType->find('all',array('order' => 'ActionItemType.type asc'));
         $this->set(compact('action_item_types'));
		 
		 $LookupBuilderContactInitiatedBy = $this->LookupBuilderContactInitiatedBy->find('all',array('order' => 'value asc'));
         $this->set(compact('LookupBuilderContactInitiatedBy'));
		 
		  $LookupBuilderContactManagedBy = $this->LookupBuilderContactManagedBy->find('all',array('order' => 'value asc'));
         $this->set(compact('LookupBuilderContactManagedBy'));
		 
		  $LookupBuilderContactPreparedBy = $this->LookupBuilderContactPreparedBy->find('all',array('order' => 'value asc'));
         $this->set(compact('LookupBuilderContactPreparedBy'));
		 
		  $LookupBuilderContactLevel = $this->LookupBuilderContactLevel->find('all',array('order' => 'value asc'));
         $this->set(compact('LookupBuilderContactLevel'));
         
         $lookup_value_action_item_statuses = $this->LookupValueActionItemStatus->find('all',array('order' => 'LookupValueActionItemStatus.value asc'));
         $this->set(compact('lookup_value_action_item_statuses'));
         
         $lookup_value_lead_categories = $this->LookupValueLeadsCategory->find('all',array('order' => 'LookupValueLeadsCategory.value asc'));
         $this->set(compact('lookup_value_lead_categories'));
         
         $lookup_value_leads_closure_probabilities = $this->LookupValueLeadsClosureProbability->find('all',array('order' => 'LookupValueLeadsClosureProbability.value asc'));
         $this->set(compact('lookup_value_leads_closure_probabilities'));
         
         $lookup_value_leads_countries= $this->LookupValueLeadsCountry->find('all',array('order' => 'LookupValueLeadsCountry.value asc'));
         $this->set(compact('lookup_value_leads_countries'));
         
         $lookup_value_leads_creation_types = $this->LookupValueLeadsCreationType->find('all',array('order' => 'LookupValueLeadsCreationType.value asc'));
         $this->set(compact('lookup_value_leads_creation_types'));
         
         $lookup_value_leads_importances = $this->LookupValueLeadsImportance->find('all',array('order' => 'LookupValueLeadsImportance.value asc'));
         $this->set(compact('lookup_value_leads_importances'));
         
         $lookup_value_leads_industries = $this->LookupValueLeadsIndustry->find('all',array('order' => 'LookupValueLeadsIndustry.value asc'));
         $this->set(compact('lookup_value_leads_industries'));
         
         $lookup_value_leads_progresses = $this->LookupValueLeadsProgress->find('all',array('order' => 'LookupValueLeadsProgress.value asc'));
         $this->set(compact('lookup_value_leads_progresses'));
         
         $lookup_value_leads_segments = $this->LookupValueLeadsSegment->find('all',array('order' => 'LookupValueLeadsSegment.value asc'));
         $this->set(compact('lookup_value_leads_segments'));
         
         $lead_statuses = $this->LeadStatus->find('all',array('order' => 'LeadStatus.status asc'));
         $this->set(compact('lead_statuses'));
         
         $lookup_value_leads_types = $this->LookupValueLeadsType->find('all',array('order' => 'LookupValueLeadsType.value asc'));
         $this->set(compact('lookup_value_leads_types'));
         
         $lookup_value_leads_urgencies = $this->LookupValueLeadsUrgency->find('all',array('order' => 'LookupValueLeadsUrgency.value asc'));
         $this->set(compact('lookup_value_leads_urgencies'));
         
         $lookup_value_rating_translations = $this->LookupValueRatingTranslation->find('all',array('order' => 'LookupValueRatingTranslation.value asc'));
         $this->set(compact('lookup_value_rating_translations'));
         
         $lookup_value_remarks_levels = $this->LookupValueRemarksLevel->find('all',array('order' => 'LookupValueRemarksLevel.value asc'));
         $this->set(compact('lookup_value_remarks_levels'));
         
         $lookup_value_statuses = $this->LookupValueStatus->find('all',array('order' => 'LookupValueStatus.value asc'));
         $this->set(compact('lookup_value_statuses'));
         
         $lookup_value_channel_roles = $this->LookupValueChannelRole->find('all',array('order' => 'LookupValueChannelRole.value asc'));
         $this->set(compact('lookup_value_channel_roles'));
         
         $lookup_value_channel_statuses = $this->LookupValueChannelStatus->find('all',array('order' => 'LookupValueChannelStatus.value asc'));
         $this->set(compact('lookup_value_channel_statuses'));
         
         $lookup_value_general_statuses = $this->LookupValueGeneralStatus->find('all',array('order' => 'LookupValueGeneralStatus.value asc'));
         $this->set(compact('lookup_value_general_statuses'));
         
         $lookup_value_dummy_statuses = $this->LookupValueDummyStatus->find('all',array('order' => 'LookupValueDummyStatus.value asc'));
         $this->set(compact('lookup_value_dummy_statuses'));
         
         $lookup_value_project_unit_type_qualifier_1 = $this->LookupValueProjectUnitTypeQualifier_1->find('all',array('order' => 'LookupValueProjectUnitTypeQualifier_1.value asc'));
         $this->set(compact('lookup_value_project_unit_type_qualifier_1'));
         
          $lookup_value_project_unit_type_qualifier_2 = $this->LookupValueProjectUnitTypeQualifier_2->find('all',array('order' => 'LookupValueProjectUnitTypeQualifier_2.value asc'));
         $this->set(compact('lookup_value_project_unit_type_qualifier_2'));
         
          $lookup_value_project_unit_type_qualifier_3 = $this->LookupValueProjectUnitTypeQualifier_3->find('all',array('order' => 'LookupValueProjectUnitTypeQualifier_3.value asc'));
         $this->set(compact('lookup_value_project_unit_type_qualifier_3'));
        
         $lookup_value_project_unit_type_qualifier_4 = $this->LookupValueProjectUnitTypeQualifier_4->find('all',array('order' => 'LookupValueProjectUnitTypeQualifier_4.value asc'));
        $this->set(compact('lookup_value_project_unit_type_qualifier_4'));
          
        $lookup_value_project_unit_type_qualifier_5 = $this->LookupValueProjectUnitTypeQualifier_5->find('all',array('order' => 'LookupValueProjectUnitTypeQualifier_5.value asc'));
        $this->set(compact('lookup_value_project_unit_type_qualifier_5'));

         
         $lookup_value_project_unit_types = $this->LookupValueProjectUnitType->find('all',array('order' => 'LookupValueProjectUnitType.value asc'));
         $this->set(compact('lookup_value_project_unit_types'));
         
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
    
    /**
     * Add new project phase to the database. On sussess or failure, shows messages.
     *
     * @return null    This method does not return any data.
     */
    public function add_project_phase(){
	
		$this->layout = 'ajax';
        
        if ($this->request->is('post') || $this->request->is('put')) {

            $this->Phase->set($this->data);

            if ($this->Phase->validates() == true) {

                if ($this->Phase->save($this->request->data)) {
                    $this->Session->setFlash('Project Phase has been saved.', 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to add Project Phase.', 'error');
                }
            }
        }
        
    }
    
    /**
     * Edit project phase and on sussess or failure, shows messages.
     * 
     * @param intiger $id Either value or null.
     * @return null    This method does not return any data.
     */
    public function edit_project_phase($id = null) {
	
		$this->layout = 'ajax';
        if (!$id) {
            throw new NotFoundException(__('Invalid Role'));
        }

        $phases = $this->Phase->findById($id);

        if (!$phases) {
            throw new NotFoundException(__('Invalid Role'));
        }

        if ($this->request->data) {

            $this->Phase->id = $id;
            if ($this->Phase->save($this->request->data)) {
                $this->Session->setFlash('Project Phase has been updated.', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to update Project Phase.', 'failure');
            }
        }

        if (!$this->request->data) {
            $this->request->data = $phases;
        }
    }
    
    public function add_project_marketing(){
		
		$this->layout = 'ajax';
        
        if ($this->request->is('post') || $this->request->is('put')) {

            $this->Marketing->set($this->data);

            if ($this->Marketing->validates() == true) {

                if ($this->Marketing->save($this->request->data)) {
                    $this->Session->setFlash('Project Marketing has been saved.', 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to add Project Marketing.', 'error');
                }
            }
        }    
    }
    public function edit_project_marketing($id = null) {
	
		$this->layout = 'ajax';
        if (!$id) {
            throw new NotFoundException(__('Invalid Role'));
        }

        $marketings = $this->Marketing->findById($id);

        if (!$marketings) {
            throw new NotFoundException(__('Invalid Role'));
        }

        if ($this->request->data) {

            $this->Marketing->id = $id;
            if ($this->Marketing->save($this->request->data)) {
                $this->Session->setFlash('Project Marketing has been updated.', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to update Project Marketing.', 'failure');
            }
        }

        if (!$this->request->data) {
            $this->request->data = $marketings;
        }
    }
    public function add_project_category(){
	
		$this->layout = 'ajax';
        
        if ($this->request->is('post') || $this->request->is('put')) {

            $this->Category->set($this->data);

            if ($this->Category->validates() == true) {

                if ($this->Category->save($this->request->data)) {
                    $this->Session->setFlash('Project Category has been saved.', 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to add Project Category.', 'error');
                }
            }
        }    
    }
    public function edit_project_category($id = null) {
	
		$this->layout = 'ajax';
        if (!$id) {
            throw new NotFoundException(__('Invalid Role'));
        }

        $categories = $this->Category->findById($id);

        if (!$categories) {
            throw new NotFoundException(__('Invalid Role'));
        }

        if ($this->request->data) {

            $this->Category->id = $id;
            if ($this->Category->save($this->request->data)) {
                $this->Session->setFlash('Project Category has been updated.', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to update Project Category.', 'failure');
            }
        }

        if (!$this->request->data) {
            $this->request->data = $categories;
        }
    }
    public function add_project_type(){
	
		$this->layout = 'ajax';
        
        if ($this->request->is('post') || $this->request->is('put')) {

            $this->ProjectType->set($this->data);

            if ($this->ProjectType->validates() == true) {

                if ($this->ProjectType->save($this->request->data)) {
                    $this->Session->setFlash('Project Type has been saved.', 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to add Project Type.', 'error');
                }
            }
        }    
    }
    public function edit_project_type($id = null) {
	
		$this->layout = 'ajax';
        if (!$id) {
            throw new NotFoundException(__('Invalid Role'));
        }

        $types = $this->ProjectType->findById($id);

        if (!$types) {
            throw new NotFoundException(__('Invalid Role'));
        }

        if ($this->request->data) {

            $this->ProjectType->id = $id;
            if ($this->ProjectType->save($this->request->data)) {
                $this->Session->setFlash('Project Type has been updated.', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to update Project Type.', 'failure');
            }
        }

        if (!$this->request->data) {
            $this->request->data = $types;
        }
    }
    public function add_project_qualities(){
	
		$this->layout = 'ajax';
        
        if ($this->request->is('post') || $this->request->is('put')) {

            $this->Quality->set($this->data);

            if ($this->Quality->validates() == true) {

                if ($this->Quality->save($this->request->data)) {
                    $this->Session->setFlash('Project Type has been saved.', 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to add Project Type.', 'error');
                }
            }
        }    
    }
    public function edit_project_qualities($id = null) {
	
		$this->layout = 'ajax';
        if (!$id) {
            throw new NotFoundException(__('Invalid Role'));
        }

        $qualities = $this->Quality->findById($id);

        if (!$qualities) {
            throw new NotFoundException(__('Invalid Role'));
        }

        if ($this->request->data) {

            $this->Quality->id = $id;
            if ($this->Quality->save($this->request->data)) {
                $this->Session->setFlash('Project Type has been updated.', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to update Project Type.', 'failure');
            }
        }

        if (!$this->request->data) {
            $this->request->data = $qualities;
        }
    }
    public function add_action_level(){
	
		$this->layout = 'ajax';
        
        if ($this->request->is('post') || $this->request->is('put')) {

            $this->ActionItemLevel->set($this->data);

            if ($this->ActionItemLevel->validates() == true) {

                if ($this->ActionItemLevel->save($this->request->data)) {
                    $this->Session->setFlash('Action level has been saved.', 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to add action level.', 'error');
                }
            }
        }    
    }
    public function edit_action_level($id = null) {
	
		$this->layout = 'ajax';
        if (!$id) {
            throw new NotFoundException(__('Invalid Role'));
        }

        $action_item_levels = $this->ActionItemLevel->findById($id);

        if (!$action_item_levels) {
            throw new NotFoundException(__('Invalid Role'));
        }

        if ($this->request->data) {

            $this->ActionItemLevel->id = $id;
            if ($this->ActionItemLevel->save($this->request->data)) {
                $this->Session->setFlash('Action level has been updated.', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to update action level.', 'failure');
            }
        }

        if (!$this->request->data) {
            $this->request->data = $action_item_levels;
        }
    }
    public function add_action_type(){
	
		$this->layout = 'ajax';
        
        if ($this->request->is('post') || $this->request->is('put')) {

            $this->ActionItemType->set($this->data);

            if ($this->ActionItemType->validates() == true) {

                if ($this->ActionItemType->save($this->request->data)) {
                    $this->Session->setFlash('Action type has been saved.', 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to add action type.', 'error');
                }
            }
        }    
    }
    public function edit_action_type($id = null) {
	
		$this->layout = 'ajax';
        if (!$id) {
            throw new NotFoundException(__('Invalid Role'));
        }

        $action_item_types = $this->ActionItemType->findById($id);

        if (!$action_item_types) {
            throw new NotFoundException(__('Invalid Role'));
        }

        if ($this->request->data) {

            $this->ActionItemType->id = $id;
            if ($this->ActionItemType->save($this->request->data)) {
                $this->Session->setFlash('Action type has been updated.', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to update action type.', 'failure');
            }
        }

        if (!$this->request->data) {
            $this->request->data = $action_item_types;
        }
    }
    public function add_action_status(){
	
		$this->layout = 'ajax';
        
        if ($this->request->is('post') || $this->request->is('put')) {

            $this->LookupValueActionItemStatus->set($this->data);

            if ($this->LookupValueActionItemStatus->validates() == true) {

                if ($this->LookupValueActionItemStatus->save($this->request->data)) {
                    $this->Session->setFlash('Action status has been saved.', 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to add action status.', 'error');
                }
            }
        }    
    }
    public function edit_action_status($id = null) {
	
		$this->layout = 'ajax';
        if (!$id) {
            throw new NotFoundException(__('Invalid Role'));
        }

        $action_item_status = $this->LookupValueActionItemStatus->findById($id);

        if (!$action_item_status) {
            throw new NotFoundException(__('Invalid Role'));
        }

        if ($this->request->data) {

            $this->LookupValueActionItemStatus->id = $id;
            if ($this->LookupValueActionItemStatus->save($this->request->data)) {
                $this->Session->setFlash('Action status has been updated.', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to update action status.', 'failure');
            }
        }

        if (!$this->request->data) {
            $this->request->data = $action_item_status;
        }
    }
    public function add_lead_category(){
	
		$this->layout = 'ajax';
        
        if ($this->request->is('post') || $this->request->is('put')) {

            $this->LookupValueLeadsCategory->set($this->data);

            if ($this->LookupValueLeadsCategory->validates() == true) {

                if ($this->LookupValueLeadsCategory->save($this->request->data)) {
                    $this->Session->setFlash('Lead category has been saved.', 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to add lead category.', 'error');
                }
            }
        }    
    }
    public function edit_lead_category($id = null) {
	
		$this->layout = 'ajax';
        if (!$id) {
            throw new NotFoundException(__('Invalid Role'));
        }

        $lead_categories = $this->LookupValueLeadsCategory->findById($id);

        if (!$lead_categories) {
            throw new NotFoundException(__('Invalid Role'));
        }

        if ($this->request->data) {

            $this->LookupValueLeadsCategory->id = $id;
            if ($this->LookupValueLeadsCategory->save($this->request->data)) {
                $this->Session->setFlash('Lead category has been updated.', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to update lead category.', 'failure');
            }
        }

        if (!$this->request->data) {
            $this->request->data = $lead_categories;
        }
    }
    public function add_lead_closure(){
	
		$this->layout = 'ajax';
        
        if ($this->request->is('post') || $this->request->is('put')) {

            $this->LookupValueLeadsClosureProbability->set($this->data);

            if ($this->LookupValueLeadsClosureProbability->validates() == true) {

                if ($this->LookupValueLeadsClosureProbability->save($this->request->data)) {
                    $this->Session->setFlash('Lead closure has been saved.', 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to add lead closure.', 'error');
                }
            }
        }    
    }
    public function edit_lead_closure($id = null) {
	
		$this->layout = 'ajax';
        if (!$id) {
            throw new NotFoundException(__('Invalid Role'));
        }

        $lead_closure = $this->LookupValueLeadsClosureProbability->findById($id);

        if (!$lead_closure) {
            throw new NotFoundException(__('Invalid Role'));
        }

        if ($this->request->data) {

            $this->LookupValueLeadsClosureProbability->id = $id;
            if ($this->LookupValueLeadsClosureProbability->save($this->request->data)) {
                $this->Session->setFlash('Lead closure has been updated.', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to update lead closure.', 'failure');
            }
        }

        if (!$this->request->data) {
            $this->request->data = $lead_closure;
        }
    }
    public function add_lead_country(){
	
		$this->layout = 'ajax';
        
        if ($this->request->is('post') || $this->request->is('put')) {

            $this->LookupValueLeadsCountry->set($this->data);

            if ($this->LookupValueLeadsCountry->validates() == true) {

                if ($this->LookupValueLeadsCountry->save($this->request->data)) {
                    $this->Session->setFlash('Lead country has been saved.', 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to add lead country.', 'error');
                }
            }
        }    
    }
    public function edit_lead_country($id = null) {
	
		$this->layout = 'ajax';
        if (!$id) {
            throw new NotFoundException(__('Invalid Role'));
        }

        $lead_country = $this->LookupValueLeadsCountry->findById($id);

        if (!$lead_country) {
            throw new NotFoundException(__('Invalid Role'));
        }

        if ($this->request->data) {

            $this->LookupValueLeadsCountry->id = $id;
            if ($this->LookupValueLeadsCountry->save($this->request->data)) {
                $this->Session->setFlash('Lead country has been updated.', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to update lead country.', 'failure');
            }
        }

        if (!$this->request->data) {
            $this->request->data = $lead_country;
        }
    }
    public function add_lead_creation_type(){
	
		$this->layout = 'ajax';
        
        if ($this->request->is('post') || $this->request->is('put')) {

            $this->LookupValueLeadsCreationType->set($this->data);

            if ($this->LookupValueLeadsCreationType->validates() == true) {

                if ($this->LookupValueLeadsCreationType->save($this->request->data)) {
                    $this->Session->setFlash('Lead creation type has been saved.', 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to add lead creation type.', 'error');
                }
            }
        }    
    }
    public function edit_lead_creation_type($id = null) {
	
		$this->layout = 'ajax';
        if (!$id) {
            throw new NotFoundException(__('Invalid Creation Type'));
        }

        $lead_types = $this->LookupValueLeadsCreationType->findById($id);

        if (!$lead_types) {
            throw new NotFoundException(__('Invalid Creation Type'));
        }

        if ($this->request->data) {

            $this->LookupValueLeadsCreationType->id = $id;
            if ($this->LookupValueLeadsCreationType->save($this->request->data)) {
                $this->Session->setFlash('Lead creation type has been updated.', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to update lead creation type.', 'failure');
            }
        }

        if (!$this->request->data) {
            $this->request->data = $lead_types;
        }
    }
    public function add_lead_importance(){
	
		$this->layout = 'ajax';
        
        if ($this->request->is('post') || $this->request->is('put')) {

            $this->LookupValueLeadsImportance->set($this->data);

            if ($this->LookupValueLeadsImportance->validates() == true) {

                if ($this->LookupValueLeadsImportance->save($this->request->data)) {
                    $this->Session->setFlash('Lead importace has been saved.', 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to add lead creation type.', 'error');
                }
            }
        }    
    }
    public function edit_lead_importance($id = null) {
	
		$this->layout = 'ajax';
        if (!$id) {
            throw new NotFoundException(__('Invalid Creation Type'));
        }

        $lead_importance = $this->LookupValueLeadsImportance->findById($id);

        if (!$lead_importance) {
            throw new NotFoundException(__('Invalid Creation Type'));
        }

        if ($this->request->data) {

            $this->LookupValueLeadsImportance->id = $id;
            if ($this->LookupValueLeadsImportance->save($this->request->data)) {
                $this->Session->setFlash('Lead importace has been updated.', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to update lead creation type.', 'failure');
            }
        }

        if (!$this->request->data) {
            $this->request->data = $lead_importance;
        }
    }
    public function add_lead_progress(){
	
		$this->layout = 'ajax';
        
        if ($this->request->is('post') || $this->request->is('put')) {

            $this->LookupValueLeadsProgress->set($this->data);

            if ($this->LookupValueLeadsProgress->validates() == true) {

                if ($this->LookupValueLeadsProgress->save($this->request->data)) {
                    $this->Session->setFlash('Lead progress has been saved.', 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to add lead progress.', 'error');
                }
            }
        }    
    }
    public function edit_lead_progress($id = null) {
	
		$this->layout = 'ajax';
        if (!$id) {
            throw new NotFoundException(__('Invalid Lead Progress'));
        }

        $lead_progress = $this->LookupValueLeadsProgress->findById($id);

        if (!$lead_progress) {
            throw new NotFoundException(__('Invalid Lead Progress'));
        }

        if ($this->request->data) {

            $this->LookupValueLeadsProgress->id = $id;
            if ($this->LookupValueLeadsProgress->save($this->request->data)) {
                $this->Session->setFlash('Lead progress has been updated.', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to update lead progress.', 'failure');
            }
        }

        if (!$this->request->data) {
            $this->request->data = $lead_progress;
        }
    }
    public function add_lead_segment(){
        
		$this->layout = 'ajax';
        if ($this->request->is('post') || $this->request->is('put')) {

            $this->LookupValueLeadsSegment->set($this->data);

            if ($this->LookupValueLeadsSegment->validates() == true) {

                if ($this->LookupValueLeadsSegment->save($this->request->data)) {
                    $this->Session->setFlash('Lead segment has been saved.', 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to add lead segment.', 'error');
                }
            }
        }    
    }
    public function edit_lead_segment($id = null) {
	
		$this->layout = 'ajax';
        if (!$id) {
            throw new NotFoundException(__('Invalid Lead Segment'));
        }

        $lead_segments = $this->LookupValueLeadsSegment->findById($id);

        if (!$lead_segments) {
            throw new NotFoundException(__('Invalid Lead Segment'));
        }

        if ($this->request->data) {

            $this->LookupValueLeadsSegment->id = $id;
            if ($this->LookupValueLeadsSegment->save($this->request->data)) {
                $this->Session->setFlash('Lead segment has been updated.', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to update lead segment.', 'failure');
            }
        }

        if (!$this->request->data) {
            $this->request->data = $lead_segments;
        }
    }
    public function add_lead_status(){
	
		$this->layout = 'ajax';
        
        if ($this->request->is('post') || $this->request->is('put')) {

            $this->LeadStatus->set($this->data);

            if ($this->LeadStatus->validates() == true) {

                if ($this->LeadStatus->save($this->request->data)) {
                    $this->Session->setFlash('Lead status has been saved.', 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to add lead status.', 'error');
                }
            }
        }    
    }
    public function edit_lead_status($id = null) {
	
		$this->layout = 'ajax';
        if (!$id) {
            throw new NotFoundException(__('Invalid Lead Status'));
        }

        $lead_status = $this->LeadStatus->findById($id);

        if (!$lead_status) {
            throw new NotFoundException(__('Invalid Lead Status'));
        }

        if ($this->request->data) {

            $this->LeadStatus->id = $id;
            if ($this->LeadStatus->save($this->request->data)) {
                $this->Session->setFlash('Lead status has been updated.', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to update lead status.', 'failure');
            }
        }

        if (!$this->request->data) {
            $this->request->data = $lead_status;
        }
    }
    public function add_lead_industry(){
        
		$this->layout = 'ajax';
        if ($this->request->is('post') || $this->request->is('put')) {

            $this->LookupValueLeadsIndustry->set($this->data);

            if ($this->LookupValueLeadsIndustry->validates() == true) {

                if ($this->LookupValueLeadsIndustry->save($this->request->data)) {
                    $this->Session->setFlash('Lead industry has been saved.', 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to add lead industry.', 'error');
                }
            }
        }    
    }
    public function edit_lead_industry($id = null) {
	
		$this->layout = 'ajax';
        if (!$id) {
            throw new NotFoundException(__('Invalid Lead Industry'));
        }

        $lead_industries = $this->LookupValueLeadsIndustry->findById($id);

        if (!$lead_industries) {
            throw new NotFoundException(__('Invalid Lead Industry'));
        }

        if ($this->request->data) {

            $this->LookupValueLeadsIndustry->id = $id;
            if ($this->LookupValueLeadsIndustry->save($this->request->data)) {
                $this->Session->setFlash('Lead industry has been updated.', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to update lead industry.', 'failure');
            }
        }

        if (!$this->request->data) {
            $this->request->data = $lead_industries;
        }
    }
    public function add_lead_type(){
        
		$this->layout = 'ajax';
        if ($this->request->is('post') || $this->request->is('put')) {

            $this->LookupValueLeadsType->set($this->data);

            if ($this->LookupValueLeadsType->validates() == true) {

                if ($this->LookupValueLeadsType->save($this->request->data)) {
                    $this->Session->setFlash('Lead type has been saved.', 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to add lead type.', 'error');
                }
            }
        }    
    }
    public function edit_lead_type($id = null) {
	
		$this->layout = 'ajax';
        if (!$id) {
            throw new NotFoundException(__('Invalid Lead Type'));
        }

        $lead_types = $this->LookupValueLeadsType->findById($id);

        if (!$lead_types) {
            throw new NotFoundException(__('Invalid Lead Type'));
        }

        if ($this->request->data) {

            $this->LookupValueLeadsType->id = $id;
            if ($this->LookupValueLeadsType->save($this->request->data)) {
                $this->Session->setFlash('Lead type has been updated.', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to update lead type.', 'failure');
            }
        }

        if (!$this->request->data) {
            $this->request->data = $lead_types;
        }
    }
    public function add_lead_urgency(){
        
		$this->layout = 'ajax';
        if ($this->request->is('post') || $this->request->is('put')) {

            $this->LookupValueLeadsUrgency->set($this->data);

            if ($this->LookupValueLeadsUrgency->validates() == true) {

                if ($this->LookupValueLeadsUrgency->save($this->request->data)) {
                    $this->Session->setFlash('Lead urgency has been saved.', 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to add lead urgency.', 'error');
                }
            }
        }    
    }
    public function edit_lead_urgency($id = null) {
	
		$this->layout = 'ajax';
        if (!$id) {
            throw new NotFoundException(__('Invalid Lead Urgency'));
        }

        $lead_urgencies = $this->LookupValueLeadsUrgency->findById($id);

        if (!$lead_urgencies) {
            throw new NotFoundException(__('Invalid Lead Urgency'));
        }

        if ($this->request->data) {

            $this->LookupValueLeadsUrgency->id = $id;
            if ($this->LookupValueLeadsUrgency->save($this->request->data)) {
                $this->Session->setFlash('Lead urgency has been updated.', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to update lead urgency.', 'failure');
            }
        }

        if (!$this->request->data) {
            $this->request->data = $lead_urgencies;
        }
    }
    public function add_rating_translation(){  
	
		$this->layout = 'ajax';      
        if ($this->request->is('post') || $this->request->is('put')) {

            $this->LookupValueRatingTranslation->set($this->data);

            if ($this->LookupValueRatingTranslation->validates() == true) {

                if ($this->LookupValueRatingTranslation->save($this->request->data)) {
                    $this->Session->setFlash('Rating Translation has been saved.', 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to add rating translation.', 'error');
                }
            }
        }    
    }
    public function edit_rating_translation($id = null) {
	
		$this->layout = 'ajax';
        if (!$id) {
            throw new NotFoundException(__('Invalid Rating Translation'));
        }

        $rating_translations = $this->LookupValueRatingTranslation->findById($id);

        if (!$rating_translations) {
            throw new NotFoundException(__('Invalid Rating Translation'));
        }

        if ($this->request->data) {

            $this->LookupValueRatingTranslation->id = $id;
            if ($this->LookupValueRatingTranslation->save($this->request->data)) {
                $this->Session->setFlash('Rating translation has been updated.', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to update rating translation.', 'failure');
            }
        }

        if (!$this->request->data) {
            $this->request->data = $rating_translations;
        }
    }
    public function add_remarks_level(){    
	
		$this->layout = 'ajax';    
        if ($this->request->is('post') || $this->request->is('put')) {

            $this->LookupValueRemarksLevel->set($this->data);

            if ($this->LookupValueRemarksLevel->validates() == true) {

                if ($this->LookupValueRemarksLevel->save($this->request->data)) {
                    $this->Session->setFlash('Remarks level has been saved.', 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to add remarks level.', 'error');
                }
            }
        }    
    }
    public function edit_remarks_level($id = null) {
	
		$this->layout = 'ajax';
        if (!$id) {
            throw new NotFoundException(__('Invalid Remarks Level'));
        }

        $remarks_level = $this->LookupValueRemarksLevel->findById($id);

        if (!$remarks_level) {
            throw new NotFoundException(__('Invalid Remarks Level'));
        }

        if ($this->request->data) {

            $this->LookupValueRemarksLevel->id = $id;
            if ($this->LookupValueRemarksLevel->save($this->request->data)) {
                $this->Session->setFlash('Remarks level has been updated.', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to update remarks level.', 'failure');
            }
        }

        if (!$this->request->data) {
            $this->request->data = $remarks_level;
        }
    }
    public function add_status(){    
	
		$this->layout = 'ajax';    
        if ($this->request->is('post') || $this->request->is('put')) {

            $this->LookupValueStatus->set($this->data);

            if ($this->LookupValueStatus->validates() == true) {

                if ($this->LookupValueStatus->save($this->request->data)) {
                    $this->Session->setFlash('Status has been saved.', 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to add status.', 'error');
                }
            }
        }    
    }
    public function edit_status($id = null) {
	
		$this->layout = 'ajax';
        if (!$id) {
            throw new NotFoundException(__('Invalid Status'));
        }

        $remarks_level = $this->LookupValueStatus->findById($id);

        if (!$remarks_level) {
            throw new NotFoundException(__('Invalid Status'));
        }

        if ($this->request->data) {

            $this->LookupValueStatus->id = $id;
            if ($this->LookupValueStatus->save($this->request->data)) {
                $this->Session->setFlash('Status has been updated.', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to update status.', 'failure');
            }
        }

        if (!$this->request->data) {
            $this->request->data = $remarks_level;
        }
    }
    public function add_channnel_role(){  
	
		$this->layout = 'ajax';      
        if ($this->request->is('post') || $this->request->is('put')) {

            $this->LookupValueChannelRole->set($this->data);

            if ($this->LookupValueChannelRole->validates() == true) {

                if ($this->LookupValueChannelRole->save($this->request->data)) {
                    $this->Session->setFlash('Channel role has been saved.', 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to add channel role.', 'error');
                }
            }
        }    
    }
    public function edit_channel_role($id = null) {
	
		$this->layout = 'ajax';
        if (!$id) {
            throw new NotFoundException(__('Invalid channel role'));
        }

        $channel_roles = $this->LookupValueChannelRole->findById($id);

        if (!$channel_roles) {
            throw new NotFoundException(__('Invalid channel role'));
        }

        if ($this->request->data) {

            $this->LookupValueChannelRole->id = $id;
            if ($this->LookupValueChannelRole->save($this->request->data)) {
                $this->Session->setFlash('Channel role has been updated.', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to update channel role.', 'failure');
            }
        }

        if (!$this->request->data) {
            $this->request->data = $channel_roles;
        }
    }
    public function add_channnel_status(){
	
		$this->layout = 'ajax';        
        if ($this->request->is('post') || $this->request->is('put')) {

            $this->LookupValueChannelStatus->set($this->data);

            if ($this->LookupValueChannelStatus->validates() == true) {

                if ($this->LookupValueChannelStatus->save($this->request->data)) {
                    $this->Session->setFlash('Channel status has been saved.', 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to add channel status.', 'error');
                }
            }
        }    
    }
    public function edit_channel_status($id = null) {
	
		$this->layout = 'ajax';
        if (!$id) {
            throw new NotFoundException(__('Invalid channel role'));
        }

        $channel_statuses = $this->LookupValueChannelStatus->findById($id);

        if (!$channel_statuses) {
            throw new NotFoundException(__('Invalid channel role'));
        }

        if ($this->request->data) {

            $this->LookupValueChannelStatus->id = $id;
            if ($this->LookupValueChannelStatus->save($this->request->data)) {
                $this->Session->setFlash('Channel status has been updated.', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to update channel status.', 'failure');
            }
        }

        if (!$this->request->data) {
            $this->request->data = $channel_statuses;
        }
    }
    public function add_general_status(){  
	
		$this->layout = 'ajax';      
        if ($this->request->is('post') || $this->request->is('put')) {

            $this->LookupValueGeneralStatus->set($this->data);

            if ($this->LookupValueGeneralStatus->validates() == true) {

                if ($this->LookupValueGeneralStatus->save($this->request->data)) {
                    $this->Session->setFlash('General status has been saved.', 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to add general status.', 'error');
                }
            }
        }    
    }
    public function edit_general_status($id = null) {
	
		$this->layout = 'ajax';
        if (!$id) {
            throw new NotFoundException(__('Invalid General Status'));
        }

        $general_statuses = $this->LookupValueGeneralStatus->findById($id);

        if (!$general_statuses) {
            throw new NotFoundException(__('Invalid General Status'));
        }

        if ($this->request->data) {

            $this->LookupValueGeneralStatus->id = $id;
            if ($this->LookupValueGeneralStatus->save($this->request->data)) {
                $this->Session->setFlash('General status has been updated.', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to update general status.', 'failure');
            }
        }

        if (!$this->request->data) {
            $this->request->data = $general_statuses;
        }
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
    
    public function add_project_unit_type(){   
	
		$this->layout = 'ajax';     
        if ($this->request->is('post') || $this->request->is('put')) {

            $this->LookupValueProjectUnitType->set($this->data);

            if ($this->LookupValueProjectUnitType->validates() == true) {

                if ($this->LookupValueProjectUnitType->save($this->request->data)) {
                    $this->Session->setFlash('Project unit type has been saved.', 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to add project unit type.', 'error');
                }
            }
        }    
    }
    public function edit_project_unit_type($id = null) {
	
		$this->layout = 'ajax';
        if (!$id) {
            throw new NotFoundException(__('Invalid Project Unit Type'));
        }

        $project_unit_types = $this->LookupValueProjectUnitType->findById($id);

        if (!$project_unit_types) {
            throw new NotFoundException(__('Invalid Project Unit Type'));
        }

        if ($this->request->data) {

            $this->LookupValueProjectUnitType->id = $id;
            if ($this->LookupValueProjectUnitType->save($this->request->data)) {
                $this->Session->setFlash('Project unit type qualifier has been updated.', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to update project unit type qualifier.', 'failure');
            }
        }

        if (!$this->request->data) {
            $this->request->data = $project_unit_types;
        }
    }
    
    public function add_project_unit_type_qualifier1(){
	
		$this->layout = 'ajax';        
        if ($this->request->is('post') || $this->request->is('put')) {

            $this->LookupValueProjectUnitTypeQualifier_1->set($this->data);

            if ($this->LookupValueProjectUnitTypeQualifier_1->validates() == true) {

                if ($this->LookupValueProjectUnitTypeQualifier_1->save($this->request->data)) {
                    $this->Session->setFlash('Project unit type qualifier has been saved.', 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to add project unit type qualifier.', 'error');
                }
            }
        }    
    }
    public function edit_project_unit_type_qualifier1($id = null) {
	
		$this->layout = 'ajax';
        if (!$id) {
            throw new NotFoundException(__('Invalid Project Unit Type qualifier'));
        }

        $project_unit_types = $this->LookupValueProjectUnitTypeQualifier_1->findById($id);

        if (!$project_unit_types) {
            throw new NotFoundException(__('Invalid Project Unit Type qualifier'));
        }

        if ($this->request->data) {

            $this->LookupValueProjectUnitTypeQualifier_1->id = $id;
            if ($this->LookupValueProjectUnitTypeQualifier_1->save($this->request->data)) {
                $this->Session->setFlash('Project unit type qualifier has been updated.', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to update project unit type qualifier.', 'failure');
            }
        }

        if (!$this->request->data) {
            $this->request->data = $project_unit_types;
        }
    }
  
    
    public function add_project_unit_type_qualifier2(){   
	
		$this->layout = 'ajax';     
        if ($this->request->is('post') || $this->request->is('put')) {

            $this->LookupValueProjectUnitTypeQualifier_2->set($this->data);

            if ($this->LookupValueProjectUnitTypeQualifier_2->validates() == true) {

                if ($this->LookupValueProjectUnitTypeQualifier_2->save($this->request->data)) {
                    $this->Session->setFlash('Project unit type qualifier has been saved.', 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to add project unit type qualifier.', 'error');
                }
            }
        }    
    }
    public function edit_project_unit_type_qualifier2($id = null) {
	
		$this->layout = 'ajax';
        if (!$id) {
            throw new NotFoundException(__('Invalid Project Unit Type qualifier'));
        }

        $project_unit_types = $this->LookupValueProjectUnitTypeQualifier_2->findById($id);

        if (!$project_unit_types) {
            throw new NotFoundException(__('Invalid Project Unit Type qualifier'));
        }

        if ($this->request->data) {

            $this->LookupValueProjectUnitTypeQualifier_2->id = $id;
            if ($this->LookupValueProjectUnitTypeQualifier_2->save($this->request->data)) {
                $this->Session->setFlash('Project unit type qualifier has been updated.', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to update project unit type qualifier.', 'failure');
            }
        }

        if (!$this->request->data) {
            $this->request->data = $project_unit_types;
        }
    }
    
    public function add_project_unit_type_qualifier3(){  
	
		$this->layout = 'ajax';      
        if ($this->request->is('post') || $this->request->is('put')) {

            $this->LookupValueProjectUnitTypeQualifier_3->set($this->data);

            if ($this->LookupValueProjectUnitTypeQualifier_3->validates() == true) {

                if ($this->LookupValueProjectUnitTypeQualifier_3->save($this->request->data)) {
                    $this->Session->setFlash('Project unit type qualifier has been saved.', 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to add project unit type qualifier.', 'error');
                }
            }
        }    
    }
    public function edit_project_unit_type_qualifier3($id = null) {
	
		$this->layout = 'ajax';
        if (!$id) {
            throw new NotFoundException(__('Invalid Project Unit Type qualifier'));
        }

        $project_unit_types = $this->LookupValueProjectUnitTypeQualifier_3->findById($id);

        if (!$project_unit_types) {
            throw new NotFoundException(__('Invalid Project Unit Type qualifier'));
        }

        if ($this->request->data) {

            $this->LookupValueProjectUnitTypeQualifier_3->id = $id;
            if ($this->LookupValueProjectUnitTypeQualifier_3->save($this->request->data)) {
                $this->Session->setFlash('Project unit type qualifier has been updated.', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to update project unit type qualifier.', 'failure');
            }
        }

        if (!$this->request->data) {
            $this->request->data = $project_unit_types;
        }
    }
    
    public function add_project_unit_type_qualifier4(){  
	
		$this->layout = 'ajax';      
        if ($this->request->is('post') || $this->request->is('put')) {

            $this->LookupValueProjectUnitTypeQualifier_4->set($this->data);

            if ($this->LookupValueProjectUnitTypeQualifier_4->validates() == true) {

                if ($this->LookupValueProjectUnitTypeQualifier_4->save($this->request->data)) {
                    $this->Session->setFlash('Project unit type qualifier has been saved.', 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to add project unit type qualifier.', 'error');
                }
            }
        }    
    }
    public function edit_project_unit_type_qualifier4($id = null) {
	
		$this->layout = 'ajax';
        if (!$id) {
            throw new NotFoundException(__('Invalid Project Unit Type qualifier'));
        }

        $project_unit_types = $this->LookupValueProjectUnitTypeQualifier_4->findById($id);

        if (!$project_unit_types) {
            throw new NotFoundException(__('Invalid Project Unit Type qualifier'));
        }

        if ($this->request->data) {

            $this->LookupValueProjectUnitTypeQualifier_4->id = $id;
            if ($this->LookupValueProjectUnitTypeQualifier_4->save($this->request->data)) {
                $this->Session->setFlash('Project unit type qualifier has been updated.', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to update project unit type qualifier.', 'failure');
            }
        }

        if (!$this->request->data) {
            $this->request->data = $project_unit_types;
        }
    }
    
    public function add_project_unit_type_qualifier5(){   
	
		$this->layout = 'ajax';     
        if ($this->request->is('post') || $this->request->is('put')) {

            $this->LookupValueProjectUnitTypeQualifier_5->set($this->data);

            if ($this->LookupValueProjectUnitTypeQualifier_5->validates() == true) {

                if ($this->LookupValueProjectUnitTypeQualifier_5->save($this->request->data)) {
                    $this->Session->setFlash('Project unit type qualifier has been saved.', 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to add project unit type qualifier.', 'error');
                }
            }
        }    
    }
    public function edit_project_unit_type_qualifier5($id = null) {
	
	$this->layout = 'ajax';
        if (!$id) {
            throw new NotFoundException(__('Invalid Project Unit Type qualifier'));
        }

        $project_unit_types = $this->LookupValueProjectUnitTypeQualifier_5->findById($id);

        if (!$project_unit_types) {
            throw new NotFoundException(__('Invalid Project Unit Type qualifier'));
        }

        if ($this->request->data) {

            $this->LookupValueProjectUnitTypeQualifier_5->id = $id;
            if ($this->LookupValueProjectUnitTypeQualifier_5->save($this->request->data)) {
                $this->Session->setFlash('Project unit type qualifier has been updated.', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to update project unit type qualifier.', 'failure');
            }
        }

        if (!$this->request->data) {
            $this->request->data = $project_unit_types;
        }
    }
	
	  public function add_builder_contact_initiated_by(){
	  
	  	$this->layout = 'ajax';
        
        if ($this->request->is('post') || $this->request->is('put')) {

            $this->LookupBuilderContactInitiatedBy->set($this->data);

            if ($this->LookupBuilderContactInitiatedBy->validates() == true) {

                if ($this->LookupBuilderContactInitiatedBy->save($this->request->data)) {
                    $this->Session->setFlash('Record has been saved.', 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to record.', 'error');
                }
            }
        }    
    }
    public function edit_builder_contact_initiated_by($id = null) {
	
		$this->layout = 'ajax';
        if (!$id) {
            throw new NotFoundException(__('Invalid Record'));
        }

        $array = $this->LookupBuilderContactInitiatedBy->findById($id);

        if (!$array) {
            throw new NotFoundException(__('Invalid Record'));
        }

        if ($this->request->data) {

            $this->LookupBuilderContactInitiatedBy->id = $id;
            if ($this->LookupBuilderContactInitiatedBy->save($this->request->data)) {
                $this->Session->setFlash('Record has been updated.', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to update record.', 'failure');
            }
        }

        if (!$this->request->data) {
            $this->request->data = $array;
        }
    }
	
	 public function add_builder_contact_managed_by(){
	 
	 	$this->layout = 'ajax';
        
        if ($this->request->is('post') || $this->request->is('put')) {

            $this->LookupBuilderContactManagedBy->set($this->data);

            if ($this->LookupBuilderContactManagedBy->validates() == true) {

                if ($this->LookupBuilderContactManagedBy->save($this->request->data)) {
                    $this->Session->setFlash('Record has been saved.', 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to record.', 'error');
                }
            }
        }    
    }
    public function edit_builder_contact_managed_by($id = null) {
	
		$this->layout = 'ajax';
        if (!$id) {
            throw new NotFoundException(__('Invalid Record'));
        }

        $array = $this->LookupBuilderContactManagedBy->findById($id);

        if (!$array) {
            throw new NotFoundException(__('Invalid Record'));
        }

        if ($this->request->data) {

            $this->LookupBuilderContactManagedBy->id = $id;
            if ($this->LookupBuilderContactManagedBy->save($this->request->data)) {
                $this->Session->setFlash('Record has been updated.', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to update record.', 'failure');
            }
        }

        if (!$this->request->data) {
            $this->request->data = $array;
        }
    }
	
	 public function add_builder_contact_prepared_by(){
        
		$this->layout = 'ajax';
        if ($this->request->is('post') || $this->request->is('put')) {

            $this->LookupBuilderContactPreparedBy->set($this->data);

            if ($this->LookupBuilderContactPreparedBy->validates() == true) {

                if ($this->LookupBuilderContactPreparedBy->save($this->request->data)) {
                    $this->Session->setFlash('Record has been saved.', 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to record.', 'error');
                }
            }
        }    
    }
    public function edit_builder_contact_prepared_by($id = null) {
	
		$this->layout = 'ajax';
        if (!$id) {
            throw new NotFoundException(__('Invalid Record'));
        }

        $array = $this->LookupBuilderContactPreparedBy->findById($id);

        if (!$array) {
            throw new NotFoundException(__('Invalid Record'));
        }

        if ($this->request->data) {

            $this->LookupBuilderContactPreparedBy->id = $id;
            if ($this->LookupBuilderContactPreparedBy->save($this->request->data)) {
                $this->Session->setFlash('Record has been updated.', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to update record.', 'failure');
            }
        }

        if (!$this->request->data) {
            $this->request->data = $array;
        }
    }
	
	 public function add_builder_contact_level(){
	 
	 	$this->layout = 'ajax';
        
        if ($this->request->is('post') || $this->request->is('put')) {

            $this->LookupBuilderContactLevel->set($this->data);

            if ($this->LookupBuilderContactLevel->validates() == true) {

                if ($this->LookupBuilderContactLevel->save($this->request->data)) {
                    $this->Session->setFlash('Record has been saved.', 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to record.', 'error');
                }
            }
        }    
    }
    public function edit_builder_contact_level($id = null) {
	
		$this->layout = 'ajax';
        if (!$id) {
            throw new NotFoundException(__('Invalid Record'));
        }

        $array = $this->LookupBuilderContactLevel->findById($id);

        if (!$array) {
            throw new NotFoundException(__('Invalid Record'));
        }

        if ($this->request->data) {

            $this->LookupBuilderContactLevel->id = $id;
            if ($this->LookupBuilderContactLevel->save($this->request->data)) {
                $this->Session->setFlash('Record has been updated.', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to update record.', 'failure');
            }
        }

        if (!$this->request->data) {
            $this->request->data = $array;
        }
    }
    
}
?>
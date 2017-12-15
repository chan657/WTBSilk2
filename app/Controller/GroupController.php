<?php
class GroupController extends AppController {
	var $uses = 'Group';

	public function index() {
		
		//echo '<pre>'.print_r($this->City->findByCityName('Kolkata'), true).'</pre>';
		//exit;
		
				
		$this->set('groups', $this->Group->find('all', array('order' => 'Group.group_name ASC')));
		
	}
	
	public function add() {
	
        if ($this->request->is('post')) {
            $this->Group->create();
            if ($this->Group->save($this->request->data)) {
                $this->Session->setFlash('Group has been saved.','success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to add Group.','failure');
            }
        }	
	
	}

	
	/*$cities = $this->Suburb->City->find('all', array('order' => 'City.city_name ASC'));
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
	
 function edit($id = null)
	 {
		if (!$id) {
			throw new NotFoundException(__('Invalid Group'));
		}
	
		$group = $this->Group->findById($id);
		
		if (!$group) {
			throw new NotFoundException(__('Invalid Group'));
		}
	
		if ($this->request->data) {
			
			
			$this->Group->id = $id;
			if ($this->Group->save($this->request->data)) {
				$this->Session->setFlash('Group has been updated.','success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('Unable to update Group.','failure');
			}
		}
	
		
	
		$this->request->data = $group;
		
	}

	 }
	 
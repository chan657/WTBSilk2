<?php
class ActivitiesController extends AppController{
    var $uses = array('Activity','Lead');
    
    
    function edit($id = null) {
        $this->layout = '';

        if (!$id) {
            throw new NotFoundException(__('Invalid Project Unit'));
        }

        //$unit = $this->Unit->findById($id);
        $activities = $this->Activity->findById($id);


        if (!$activities) {
            throw new NotFoundException(__('Invalid Activity'));
        }

        if ($this->request->data) {
            $this->Activity->id = $id;
            $this->request->data['Activity']['activity_date'] = date('Y-m-d',strtotime($this->data['Activity']['activity_date']));
            if ($this->Activity->save($this->request->data)) {
               // $this->Session->setFlash('Project Unit has been updated.', 'success');
                $this->Session->write('success_msg', 'Activity has been updated.');
                 
                echo '<script>parent.location.reload(true);exit();</script>';
              
            } else {
                $this->Session->setFlash('Unable to update Activity.', 'failure');
            }
        }

        $this->request->data = $activities;
    }
    
    public function add($id = null) {
         $this->layout = '';

        if ($this->request->is('post')) {
            $this->request->data['Activity']['activity_date'] = date('Y-m-d',strtotime($this->data['Activity']['activity_date']));
            $this->request->data['Activity']['lead_id'] = $id;
  
            
            $this->Activity->create();
            if ($this->Activity->save($this->request->data)) {
                 $this->Session->write('success_msg', 'Activity has been saved.');
                 
                echo '<script>parent.location.reload(true);exit();</script>';
            } else {
                $this->Session->setFlash('Unable to add Activity.', 'failure');
            }
        }

        $lead = $this->Lead->findById($id);
        $this->set('lead',$lead);
    }
}
?>
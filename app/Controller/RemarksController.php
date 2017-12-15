<?php
class RemarksController extends AppController{
    var $uses = array('Remark','Activity','Lead');
    
    
    function edit($id = null) {
        $this->layout = '';

        if (!$id) {
            throw new NotFoundException(__('Invalid Project Unit'));
        }

        //$unit = $this->Unit->findById($id);
        $remarks = $this->Remark->findById($id);
        

        if (!$remarks) {
            throw new NotFoundException(__('Invalid Activity'));
        }

        if ($this->request->data) {
            $this->Remark->id = $id;
            $activity_date = explode('/',$this->data['Remark']['remarks_date']);
            $date = $activity_date[0];
            $month = $activity_date[1];
            $year = $activity_date[2];
            $this->request->data['Remark']['remarks_date'] = $year.'-'.$month.'-'.$date;
            if ($this->Remark->save($this->request->data)) {
               // $this->Session->setFlash('Project Unit has been updated.', 'success');
                $this->Session->write('success_msg', 'Remarks has been updated.');
                 
                echo '<script>parent.$.fancybox.close(); parent.location.reload(true);exit();</script>';
              
            } else {
                $this->Session->setFlash('Unable to update Remarks.', 'failure');
            }
        }

        //echo $this->data['Remark']['lead_id'];
        $activities = $this->Activity->find('all',array('fields' => array('Activity.id','Activity.activity_by','Activity.activity'),
                                                         'conditions' => array('lead_id' => $remarks['Remark']['lead_id'])));
      //  $activities = Set::combine($activities, '{n}.Activity.id',array('%s %s', '{n}.Activity.activity_by', 'Activity.activity'));
        $activities = Set::combine($activities, '{n}.Activity.id',array('%s %s','{n}.Activity.activity_by','{n}.Activity.activity_date'));

        
        
        $this->set(compact('activities'));
    //  pr($activities);
     // die;

        $this->request->data = $remarks;
    }
    
    public function add($id = null) {
         $this->layout = '';
         

        if ($this->request->is('post')) {
            $remarks_date = explode('/',$this->data['Remark']['remarks_date']);
            $date = $remarks_date[0];
            $month = $remarks_date[1];
            $year = $remarks_date[2];
            $this->request->data['Remark']['remarks_date'] = $year.'-'.$month.'-'.$date;
             $this->request->data['Remark']['lead_id'] = $id;
            
            
            $this->Remark->create();
            if ($this->Remark->save($this->request->data)) {
                 $this->Session->write('success_msg', 'Remarks has been saved.');
                 
                echo '<script>parent.$.fancybox.close(); parent.location.reload(true);exit();</script>';
            } else {
                $this->Session->setFlash('Unable to add Lead Remarks.', 'failure');
            }
        }
        
         $activities = $this->Activity->find('list',array('fields' => array('id','activity_by'),
                                                         'conditions' => array('lead_id' => $id)));
        $this->set(compact('activities'));
        $lead = $this->Lead->findById($id);
       // pr($project);
      //  die;
        $this->set('lead',$lead);
    }
}
?>
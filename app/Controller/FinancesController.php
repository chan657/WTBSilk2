<?php
/**
 * Payments controller.
 *
 * This file will render views from views/Payments/
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
 App::uses('AppController', 'Controller');
 /**
 * Payments controller
 *
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class FinancesController extends AppController {
	
	public $uses = array('Reimbursement','LookupValueReimbursementType_1','LookupValueReimbursementType_2','LookupValueActivityLevel','LookupValueBillStatus','LookupValueEventCourrency','LookupValueBillType','Channel','City','LookupValueStatus','Event','ActionItem','Payment','User');

	public function index() {
		
		$dummy_status = $this->Auth->user('dummy_status');
		$user_id = $this->Auth->user('id');
		$channel_id = $this->Session->read("channel_id");
		$role_id = $this->Session->read("role_id");

		


	 
	$all_count = $this->Reimbursement->find('count',array('conditions' => array('Reimbursement.dummy_status' => $dummy_status,'Reimbursement.created_by' => $user_id))); // approve
	$this->set(compact('all_count'));
	
	$paid_count = $this->Reimbursement->find('count',array('conditions' => array('Reimbursement.dummy_status' => $dummy_status,'Reimbursement.created_by' => $user_id,'Reimbursement.reimbursement_status' => 3)));
	$this->set(compact('paid_count'));
	
	$pending_count = $this->Reimbursement->find('count',array('conditions' => array('Reimbursement.dummy_status' => $dummy_status,'Reimbursement.created_by' => $user_id,'Reimbursement.reimbursement_status' => 2)));
	$this->set(compact('pending_count'));
	
	
	}
	
   public function list_reimbursement() {
	
		$dummy_status = $this->Auth->user('dummy_status');
		$user_id = $this->Auth->user('id');
		$channel_id = $this->Session->read("channel_id");
		$role_id = $this->Session->read("role_id");
		$channels = $this->Channel->findById($channel_id);
		$city_id = $channels['Channel']['city_id'];
		$search_condition = array();
	
		$reimbursement_status = '';

		$from_day = '';
		$from_month = '';
		$from_year = '';
		$to_day = '';
		$to_month = '';
		$to_year = '';
		$primary_cond = array();
		
		if ($this->request->is('post') || $this->request->is('put')) {
           
           
            if (!empty($this->data['Reimbursement']['reimbursement_status'])) {
                $reimbursement_status = $this->data['Reimbursement']['reimbursement_status'];
                array_push($search_condition, array('Reimbursement.reimbursement_status'  =>$reimbursement_status));
            }
			
			if (!empty($this->data['Reimbursement']['from_day']) && !empty($this->data['Reimbursement']['from_month']) && !empty($this->data['Reimbursement']['from_year'])) {
                $from_day = $this->data['Reimbursement']['from_day'];
				$from_month = $this->data['Reimbursement']['from_month'];
				$from_year = $this->data['Reimbursement']['from_year'];
				$from_date = $from_year.'-'.$from_month.'-'.$from_day;
                array_push($search_condition, array('Reimbursement.reimbursement_bill_submission_date >='  => $from_date));
            }
			
			if (!empty($this->data['Reimbursement']['to_day']) && !empty($this->data['Reimbursement']['to_month']) && !empty($this->data['Reimbursement']['to_year'])) 			{
                $to_day = $this->data['Reimbursement']['to_day'];
				$to_month = $this->data['Reimbursement']['to_month'];
				$to_year = $this->data['Reimbursement']['to_year'];
				$to_date = $to_year.'-'.$to_month.'-'.$to_day;
                array_push($search_condition, array('Reimbursement.reimbursement_bill_submission_date <='  => $to_date));
            }
			
			
           
        } 
		elseif ($this->request->is('get')) {
		
			
			
			if (!empty($this->request->params['named']['reimbursement_status'])) {
                $reimbursement_status = $this->request->params['named']['reimbursement_status'];
				 array_push($search_condition, array('Reimbursement.reimbursement_status' => $reimbursement_status));
                
            }
			if (!empty($this->request->params['named']['from_day']) && !empty($this->request->params['named']['from_month']) && !empty($this->request->params['named']['from_year'])) {
			
               $from_day = $this->data['Reimbursement']['from_day'];
				$from_month = $this->data['Reimbursement']['from_month'];
				$from_year = $this->data['Reimbursement']['from_year'];
				$from_date = $from_year.'-'.$from_month.'-'.$from_day;
                array_push($search_condition, array('Reimbursement.reimbursement_bill_submission_date >='  =>$from_date));
                
            }
			if (!empty($this->request->params['named']['to_day']) && !empty($this->request->params['named']['to_month']) && !empty($this->request->params['named']['to_year'])) {
			
                $to_day = $this->data['Reimbursement']['to_day'];
				$to_month = $this->data['Reimbursement']['to_month'];
				$to_year = $this->data['Reimbursement']['to_year'];
				$to_date = $to_year.'-'.$to_month.'-'.$to_day;
                array_push($search_condition, array('Reimbursement.reimbursement_bill_submission_date <='  => $to_date));
                
            }
		}
		
		if($dummy_status)
	    	array_push($search_condition, array('Reimbursement.dummy_status' => $dummy_status));
	  
	  	if(count($this->params['pass'])){
			$aaray = explode(':',$this->params['pass'][0]);
			$field = $aaray[0];
			$value = $aaray[1];
			array_push($search_condition, array('Reimbursement.'.$field => $value)); // when builder is approve/pending
		}
		
		$this->paginate['conditions'][0] = "Reimbursement.created_by=".$user_id;
		$this->paginate['conditions'][1] = $search_condition;
		$this->paginate['order'] = array('Reimbursement.id' => 'desc');	
		$this->set('Reimbursement',$this->paginate("Reimbursement"));
		
		/*if($cur_date >= $start_date && $cur_date <= $end_date)
			$this->paginate['conditions'][2] = "Reimbursement.reimbursement_bill_submission_date <= '".$end_date."'";
		else
			$this->paginate['conditions'][2] = "Reimbursement.reimbursement_bill_submission_date >= '".$end_date."'";*/
				
	 
		//$this->paginate['conditions'][0] = "ActionItem.action_item_active='Yes' AND ActionItem.next_action_by = ".$user_id." AND ActionItem.action_item_level_id=9";
		//$this->paginate['conditions'][1] = $search_condition;
		//$this->paginate['order'] = array('ActionItem.id' => 'desc');	
		//$this->set('actionitems', $this->paginate("ActionItem", $search_condition));
		//$this->set('actionitems',$this->paginate("ActionItem"));
	
	 //$log = $this->Reimbursement->getDataSource()->getLog(false, false);       
     //debug($log);	
	 
	$all_count = $this->Reimbursement->find('count',array('conditions' => array('Reimbursement.dummy_status' => $dummy_status,'Reimbursement.created_by' => $user_id))); // approve
	$this->set(compact('all_count'));
	
	$paid_count = $this->Reimbursement->find('count',array('conditions' => array('Reimbursement.dummy_status' => $dummy_status,'Reimbursement.created_by' => $user_id,'Reimbursement.reimbursement_status' => 3)));
	$this->set(compact('paid_count'));
	
	$pending_count = $this->Reimbursement->find('count',array('conditions' => array('Reimbursement.dummy_status' => $dummy_status,'Reimbursement.created_by' => $user_id,'Reimbursement.reimbursement_status' => 2)));
	$this->set(compact('pending_count'));
	
	$today = array('15' => '15','28' => '28','29' => '29','30' => '30','31'=>'31');
	$this->set(compact('today'));
	
	$fromday = array('01' => '01','15' => '15');
	$this->set(compact('fromday'));
	
	for($i=1;$i<=12;$i++){
		$month[$i] = $i;
	}
	$this->set(compact('month'));

	$year = array(date('Y') => date('Y'));
	$this->set(compact('year'));
	
	
	
		if (!isset($this->passedArgs['reimbursement_status']) && empty($this->passedArgs['reimbursement_status'])) {
            $this->passedArgs['reimbursement_status'] = (isset($this->data['Reimbursement']['reimbursement_status'])) ? $this->data['Reimbursement']['reimbursement_status'] : '';
        }
		if (!isset($this->passedArgs['from_day']) && !isset($this->passedArgs['from_month']) && !isset($this->passedArgs['from_year'])) {
            $this->passedArgs['from_day'] = (isset($this->data['Reimbursement']['from_day'])) ? $this->data['Reimbursement']['from_day'] : '';
			$this->passedArgs['from_month'] = (isset($this->data['Reimbursement']['from_month'])) ? $this->data['Reimbursement']['from_month'] : '';
			$this->passedArgs['from_year'] = (isset($this->data['Reimbursement']['from_year'])) ? $this->data['Reimbursement']['from_year'] : '';
        }
		if (!isset($this->passedArgs['to_day']) && !isset($this->passedArgs['to_month']) && !isset($this->passedArgs['to_year'])) {
            $this->passedArgs['to_day'] = (isset($this->data['Reimbursement']['to_day'])) ? $this->data['Reimbursement']['to_day'] : '';
			$this->passedArgs['to_month'] = (isset($this->data['Reimbursement']['to_month'])) ? $this->data['Reimbursement']['to_month'] : '';
			$this->passedArgs['to_year'] = (isset($this->data['Reimbursement']['to_year'])) ? $this->data['Reimbursement']['to_year'] : '';
        }
		
       
		if (!isset($this->data) && empty($this->data)) {
           
			$this->data['Reimbursement']['reimbursement_status'] = $this->passedArgs['reimbursement_status'];
			$this->data['Reimbursement']['from_day'] = $this->passedArgs['from_day'];
			$this->data['Reimbursement']['from_month'] = $this->passedArgs['from_month'];
			$this->data['Reimbursement']['from_year'] = $this->passedArgs['from_year'];
			$this->data['Reimbursement']['to_day'] = $this->passedArgs['to_day'];
			$this->data['Reimbursement']['to_month'] = $this->passedArgs['to_month'];
			$this->data['Reimbursement']['to_year'] = $this->passedArgs['to_year'];
        }
			
		
		$this->set(compact('reimbursement_status'));
		$this->set(compact('from_day'));
		$this->set(compact('from_month'));
		$this->set(compact('from_year'));
		$this->set(compact('to_day'));
		$this->set(compact('to_month'));
		$this->set(compact('to_year'));
	}
	
	public function add_reimbursement(){

		$dummy_status = $this->Auth->user('dummy_status');
		$user_id = $this->Auth->user('id');
		if(!isset($this->data['Payment']['submit']))
			$this->redirect(array('action' => 'list_reimbursement'));

		if($this->data['Payment']['submit'] == 'submit')
		{
		
			$reimbursement_created_by = $this->data['Payment']['reimbursement_created_by'];
			$reimbursement_from_date = $this->data['Payment']['reimbursement_from_date'];
			$reimbursement_to_date = $this->data['Payment']['reimbursement_to_date'];
			
			if(count($this->data['Payment']['msg_sel']) > 0){
				foreach($this->data['Payment']['msg_sel'] as $val){
					$arr = explode('_',$val);
					$action_id[] = $arr[0];
					$event_id[] = $arr[1];
				}
			}
			
			$Reimbursements = $this->Reimbursement->find('all',array('conditions' => array('Reimbursement.id' => $event_id)));
			$this->set(compact('Reimbursements'));
			$this->set(compact('reimbursement_created_by'));
			$this->set(compact('reimbursement_from_date'));
			$this->set(compact('reimbursement_to_date'));
			
	//	$log = $this->Reimbursement->getDataSource()->getLog(false, false);       
      //  debug($log);
			
			$this->set(compact('action_id'));
			$this->set(compact('event_id'));
			$this->set(compact('user_id'));
		}
		//$action_arr[] = $action_id;
		//pr($action_arr);
		//echo 'ev='.$event_id.'act='.$action_id;
		
        
		if($this->data['Payment']['submit'] == 'add')
		{

			$this->request->data['Payment']['created_by'] = $user_id;
			$this->request->data['Payment']['dummy_status'] = $dummy_status;
			$this->request->data['Event']['activity_status'] = '1'; // for approved
			$this->request->data['Event']['activity_closed'] = '"Yes"'; // for approved

			
            $this->Payment->create();
            if ($this->Payment->save($this->request->data)) {
			
					$payment_id = $this->Payment->getLastInsertId();
					$this->ActionItem->updateAll(array('ActionItem.action_item_active' => "'No'"),array('ActionItem.id' => $this->data['Payment']['action_id']));
                	//$this->Event->updateAll($this->data['Event'],array('Event.id' => $this->data['Payment']['event_id']));
					foreach($this->data['Reimbursement'] as $val=>$key)
					{
					
						$this->request->data['Reimbursement'][$val]['payment_id'] = $payment_id;
					}
					$this->Reimbursement->saveMany($this->request->data['Reimbursement']);
               
				
                $this->Session->setFlash('Payment has been saved.','success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to add payment.','failure');
            }
			
			
			
        }	
	}	


}
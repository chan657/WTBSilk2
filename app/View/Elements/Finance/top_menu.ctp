<?php 
	$url = $this->here;
	$cur_page='';
	$arr = explode("/",$url);
	$arr = end($arr);
	$arr1 =  explode("_",$arr);
	$cur_page = end($arr1);
 ?>
	<div class="row">
    	
        <div class="col-md-4 <?php if($cur_page == ''){?>active<?php }?>">
    		
    			<div class="info-box  bg-info  text-white" id="initial-tour">
    				<div class="info-icon bg-info-dark">
    					<span aria-hidden="true" class="icon icon-layers"></span>
    				</div>
    				<div class="info-details">
    					 <?php echo $this->Html->link('<h4>All Payments<span class="pull-right">0</span></h4>', '/payments', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'My Builders','escape' => false));
					
					
					?>
    				</div>
    			</div>
    		
    	</div>
        <div class="col-md-4  <?php if($cur_page == 'reimbursement'){?>active<?php }?>">
    		
    			<div class="info-box  bg-info  text-white" id="initial-tour">
    				<div class="info-icon bg-info-dark">
    					<span aria-hidden="true" class="icon icon-layers"></span>
    				</div>
    				<div class="info-details">
    					 <?php echo $this->Html->link('<h4>Reimbursements<span class="pull-right">'.$all_count.'</span></h4>', '/finances/list_reimbursement', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'Reimbursement Payments','escape' => false));
					
					echo $this->Html->link('<p>Paid<span class="badge pull-right bg-white text-success">'.$paid_count.'</span> </p>', '/my-payments/reimbursement_status:3', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'Paid','escape' => false));
					
					echo $this->Html->link('<p>Pending<span class="badge pull-right bg-white text-success">'.$pending_count.'</span> </p>', '/my-payments/reimbursement_status:2', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'Pending','escape' => false));
					?>
    				</div>
    			</div>
    		
    	</div>
        <div class="col-md-4">
    		
    			<div class="info-box  bg-info  text-white" id="initial-tour">
    				<div class="info-icon bg-info-dark">
    					<span aria-hidden="true" class="icon icon-layers"></span>
    				</div>
    				<div class="info-details">
    					 <?php echo $this->Html->link('<h4>Commissions<span class="pull-right">0</span></h4>', '/payments', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'My Builders','escape' => false));
					
					
					?>
    				</div>
    			</div>
    		
    	</div>
        
        
    </div>
    
 
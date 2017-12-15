<?php 
	$url = $this->here;
	$arr = explode("/",$url);
	$page_url = end($arr);
	$aaray = explode(':',$page_url);
	$cur_page = $aaray[0];
 ?>
<div class="row">
    	
        <div class="col-md-4 <?php if($cur_page == 'my-clients' || $cur_page == 'lead_source'){?>active<?php }?>">
    		
    			<div class="info-box  bg-info  text-white" id="initial-tour">
    				<div class="info-icon bg-info-dark">
    					<span aria-hidden="true" class="icon icon-layers"></span>
    				</div>
    				<div class="info-details">
    					 <?php echo $this->Html->link('<h4>All Clients<span class="pull-right">'.$all_count.'</span></h4>', '/my-clients', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'My Clients','escape' => false));?>
                      <p>Old<span class="badge pull-right bg-white text-success"><?php echo $old_client_count?> </span> </p>  
                      <p>New<span class="badge pull-right bg-white text-success"><?php echo $new_client_count?> </span> </p>   
                    
    				</div>
    			</div>
    		
    	</div>
        <div class="col-md-4 <?php if($cur_page == 'lead_importance' || $cur_page == 'lead_urgency' || $cur_page == 'lead_special_client_status'){?>active<?php }?>">
        <div class="info-box  bg-info  text-white" id="initial-tour">
    				<div class="info-icon bg-info-dark">
    					<span aria-hidden="true" class="icon icon-layers"></span>
    				</div>
    				<div class="info-details">
    					 <?php echo $this->Html->link('<h4>Most Important<span class="pull-right">'.$most_tmportent_count.'</span></h4>', '#', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'Residential','escape' => false));?>
                      <p>Important or Urgent<span class="badge pull-right bg-white text-success"><?php echo $importance_urgency_count?> </span> </p>  
                      <p>Special<span class="badge pull-right bg-white text-success"><?php echo $special_count?> </span> </p>
					
    				</div>
    			</div>
       
    	
    	</div>
    	<div class="col-md-4 <?php if($cur_page == 'lead_closureprobabilityinnext1Month'){?>active<?php }?>">
        <div class="info-box  bg-info  text-white" id="initial-tour">
    				<div class="info-icon bg-info-dark">
    					<span aria-hidden="true" class="icon icon-layers"></span>
    				</div>
    				<div class="info-details">
    					 <?php echo $this->Html->link('<h4>High Potential<span class="pull-right">'.$high_potential_count.'</span></h4>', '#', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'Residential','escape' => false));
					
					echo $this->Html->link('<p>70% - 90% <span class="badge pull-right bg-white text-success">'.$seventy_to_ninty_count.'</span> </p>', '/my-clients/lead_closureprobabilityinnext1Month:2', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'Pending','escape' => false));
					echo $this->Html->link('<p>>= 90%  <span class="badge pull-right bg-white text-success">'.$above_ninty_count.'</span> </p>', '/my-clients/lead_closureprobabilityinnext1Month:1', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'Pending','escape' => false));?>
    				</div>
    			</div>
       
    	
    	</div>
    </div>
<div class="row">
    	<div class="col-md-4"> 
    		<div class="info-box  bg-warn  text-white">
    			<div class="info-icon bg-warn-dark">
    				<span aria-hidden="true" class="icon icon-wallet"></span>
    			</div>
    			<div class="info-details">
    				
                                <?php echo $this->Html->link('<h4>Transaction<span class="pull-right">0</span></h4>', '/my-deals', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'Transaction','escape' => false));
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
    					 <?php echo $this->Html->link('<h4>Activities<span class="pull-right">'.$activity_count.'</span></h4>', '#', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'Residential','escape' => false));
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
    					 <?php echo $this->Html->link('<h4>Action Items<span class="pull-right">'.$action_count.'</span></h4>', '/action-items', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'Residential','escape' => false));
						 echo $this->Html->link('<p>Pending <span class="badge pull-right bg-white text-success">'.$all_action_pending.'</span> </p>', '/action-items', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'My Builders','escape' => false));
					?>
    				</div>
    			</div>
       
    	
    	</div>	
    	
</div> 
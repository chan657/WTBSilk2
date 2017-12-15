<?php 
$url = $this->here;
$cur_page='';

	  $arr = explode("/",$url);
	  if(count($arr) == 3)
	  	$cur_page = $arr[2]; // demo
	  	//$cur_page = $arr[3]; // demo
 ?>
<div class="row">
    	
        <div class="col-md-4 <?php if($cur_page == ''){?>active<?php }?>">
    		
    			<div class="info-box  bg-info  text-white" id="initial-tour">
    				<div class="info-icon bg-info-dark">
    					<span aria-hidden="true" class="icon icon-layers"></span>
    				</div>
    				<div class="info-details">
    					 <?php echo $this->Html->link('<h4>All Actions<span class="pull-right">'.$all_action.'</span></h4>', '/action-items', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'My Builders','escape' => false));
					
					echo $this->Html->link('<p>Pending <span class="badge pull-right bg-white text-success">'.$all_action_pending.'</span> </p>', '/action-items', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'My Builders','escape' => false));
					?>
    				</div>
    			</div>
    		
    	</div>
        <div class="col-md-4 <?php if($cur_page == '2'){?>active<?php }?>">
    		
    			<div class="info-box  bg-info  text-white" id="initial-tour">
    				<div class="info-icon bg-info-dark">
    					<span aria-hidden="true" class="icon icon-layers"></span>
    				</div>
    				<div class="info-details">
    					 <?php echo $this->Html->link('<h4>Builder Actions<span class="pull-right">'.$builder_action_pending.'</span></h4>', '/action-items/2', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'My Builders','escape' => false));
					
					echo $this->Html->link('<p>Pending <span class="badge pull-right bg-white text-success">'.$builder_action_pending.'</span> </p>', '/action-items/2', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'My Actions','escape' => false));
					?>
    				</div>
    			</div>
    		
    	</div>
         <div class="col-md-4 <?php if($cur_page == '3'){?>active<?php }?>">
    		
    			<div class="info-box  bg-info  text-white" id="initial-tour">
    				<div class="info-icon bg-info-dark">
    					<span aria-hidden="true" class="icon icon-layers"></span>
    				</div>
    				<div class="info-details">
    					 <?php echo $this->Html->link('<h4>Project Actions<span class="pull-right">'.$project_action_pending.'</span></h4>', '/action-items/3', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'My Builders','escape' => false));
				
					echo $this->Html->link('<p>Pending <span class="badge pull-right bg-white text-success">'.$project_action_pending.'</span> </p>', '/action-items/3', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'My Builders','escape' => false));
					?>
    				</div>
    			</div>
    		
    	</div>
        
    	
    	
    </div>
<div class="row">
    	
		<div class="col-md-4 <?php if($cur_page == '1' || $cur_page == '10'){?>active<?php }?>">
    		
    			<div class="info-box  bg-info  text-white" id="initial-tour">
    				<div class="info-icon bg-info-dark">
    					<span aria-hidden="true" class="icon icon-layers"></span>
    				</div>
    				<div class="info-details">
    					 <?php echo $this->Html->link('<h4>Client  Actions<span class="pull-right">'.$client_allaction_pending.'</span></h4>', '/action-items', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'My Builders','escape' => false));
					
					echo $this->Html->link('<p>Old Pending <span class="badge pull-right bg-white text-success">'.$client_oldaction_pending.'</span> </p>', '/action-items/10', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'My Builders','escape' => false));
					
					echo $this->Html->link('<p>New Pending <span class="badge pull-right bg-white text-success">'.$client_newaction_pending.'</span> </p>', '/action-items/1', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'My Builders','escape' => false));
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
    					 <?php echo $this->Html->link('<h4>General Actions<span class="pull-right">0</span></h4>', '/action-items', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'My Builders','escape' => false));
					
					echo $this->Html->link('<p>Pending <span class="badge pull-right bg-white text-success">0</span> </p>', '#', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'My Builders','escape' => false));
					?>
    				</div>
    			</div>
    		
    	</div>
        	
    	
</div> 
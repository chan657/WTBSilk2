<?php 
	$url = $this->here;
	$arr = explode("/",$url);
	$page_url = end($arr);

 ?>
<div class="row">
    	
        <div class="col-md-4 <?php if($page_url == 'my-builder-contacts' ||  $page_url == 'builder_contact_approved:1'){?>active<?php }?>">
    		
    			<div class="info-box  bg-info  text-white" id="initial-tour">
    				<div class="info-icon bg-info-dark">
    					<span aria-hidden="true" class="icon icon-layers"></span>
    				</div>
    				<div class="info-details">
    					 <?php echo $this->Html->link('<h4>Entire Network<span class="pull-right">'.$all_count.'</span></h4>', '/my-builder-contacts', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'Entire Network','escape' => false));
					echo $this->Html->link('<p>Approved <span class="badge pull-right bg-white text-success">'.$approve.'</span> </p>', '/my-builder-contacts/builder_contact_approved:1', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'Approved','escape' => false));
					echo $this->Html->link('<p>Pending <span class="badge pull-right bg-white text-success">'.$pending.'</span> </p>', '/my-builder-contacts/builder_contact_approved:2', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'Pending','escape' => false));
					?>
    				</div>
    			</div>
    		
    	</div>
    	<div class="col-md-4 <?php if($page_url == 'builder_contact_level:1'){?>active<?php }?>">
        <div class="info-box  bg-info  text-white" id="initial-tour">
    				<div class="info-icon bg-info-dark">
    					<span aria-hidden="true" class="icon icon-layers"></span>
    				</div>
    				<div class="info-details">
    					 <?php echo $this->Html->link('<h4>Sales & Marketing<span class="pull-right">'.$sales_marketing.'</span></h4>', '/my-builder-contacts/builder_contact_level:1', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'Sales & Marketing','escape' => false));
					?>
    				</div>
    			</div>
       
    	
    	</div>
    	<div class="col-md-4 <?php if($page_url == 'builder_contact_level:6'){?>active<?php }?>">
    		<div class="info-box  bg-info  text-white">
    			<div class="info-icon bg-info-dark">
    				<span aria-hidden="true" class="icon icon-drawer"></span>
    			</div>
                <div class="info-details">
    					 <?php echo $this->Html->link('<h4>Accounts<span class="pull-right">'.$accounts.'</span></h4>', '/my-builder-contacts/builder_contact_level:6', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'Accounts','escape' => false));
					?>
    				</div>
    			
    		</div>
    	</div>
    </div>
<!--<div class="row">
    	<div class="col-md-4 <?php if($page_url == 'builder_contact_level:11'){?>active<?php }?>">
    		<div class="info-box  bg-warn  text-white">
    			<div class="info-icon bg-warn-dark">
    				<span aria-hidden="true" class="icon icon-wallet"></span>
    			</div>
                <div class="info-details">
    					 <?php echo $this->Html->link('<h4>Corporate Finance<span class="pull-right">'.$corporate_finance.'</span></h4>', '/my-builder-contacts/builder_contact_level:11', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'Corporate Finance','escape' => false));
					?>
    				</div>
    			
    		</div>
    	</div>
		<div class="col-md-4 <?php if($page_url == 'builder_contact_level:7'){?>active<?php }?>">
    		<div class="info-box  bg-warn  text-white">
    			<div class="info-icon bg-warn-dark">
    				<span aria-hidden="true" class="icon icon-wallet"></span>
    			</div>
                <div class="info-details">
    					 <?php echo $this->Html->link('<h4>Land Acquisition<span class="pull-right">'.$land_acquisition.'</span></h4>', '/my-builder-contacts/builder_contact_level:7', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'Land Acquisition','escape' => false));
					?>
    				</div>
    			
    		</div>
    	</div>
        <div class="col-md-4">
    		<div class="info-box  bg-warn  text-white">
    			<div class="info-icon bg-warn-dark">
    				<span aria-hidden="true" class="icon icon-wallet"></span>
    			</div>
    			<div class="info-details">
    				<h4>Builders without Contacts <span class="pull-right"></span></h4>
    				
    			</div>
    		</div>
    	</div>	
    	
</div>--> 
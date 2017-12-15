<?php 
	$url = $this->here;
	$arr = explode("/",$url);
	$page_url = end($arr);
	$aaray = explode(':',$page_url);
	$cur_page = $aaray[0];
 ?>
<div class="row">
    	
        <div class="col-md-4 <?php if($cur_page == 'my-owners' || $cur_page == 'owner_approved'){?>active<?php }?>">
    		
    			<div class="info-box  bg-info  text-white" id="initial-tour">
    				<div class="info-icon bg-info-dark">
    					<span aria-hidden="true" class="icon icon-layers"></span>
    				</div>
    				<div class="info-details">
    					 <?php echo $this->Html->link('<h4>All Owners<span class="pull-right">'.$all_count.'</span></h4>', '/my-owners', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'My Builders','escape' => false));
					echo $this->Html->link('<p>Approved <span class="badge pull-right bg-white text-success">'.$approve.'</span> </p>', '/my-owners/owner_approved:1', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'My Builders','escape' => false));
					echo $this->Html->link('<p>Pending <span class="badge pull-right bg-white text-success">'.$pending.'</span> </p>', '/my-owners/owner_approved:2', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'My Builders','escape' => false));
					?>
    				</div>
    			</div>
    		
    	</div>
    	<div class="col-md-4 <?php if($cur_page == 'owner_residential'){?>active<?php }?>">
        <div class="info-box  bg-info  text-white" id="initial-tour">
    				<div class="info-icon bg-info-dark">
    					<span aria-hidden="true" class="icon icon-layers"></span>
    				</div>
    				<div class="info-details">
    					 <?php echo $this->Html->link('<h4>Residential<span class="pull-right">'.$residential_all_count.'</span></h4>', '/my-owners', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'Residential','escape' => false));
					echo $this->Html->link('<p>Yes <span class="badge pull-right bg-white text-success">'.$residential_yes.'</span> </p>', '/my-owners/owner_residential:1', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'Approved','escape' => false));
					echo $this->Html->link('<p>No <span class="badge pull-right bg-white text-success">'.$residential_no.'</span> </p>', '/my-owners/owner_residential:2', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'Pending','escape' => false));?>
    				</div>
    			</div>
       
    	
    	</div>
    	<div class="col-md-4 <?php if($cur_page == 'owner_commercial'){?>active<?php }?>">
        <div class="info-box  bg-info  text-white" id="initial-tour">
    				<div class="info-icon bg-info-dark">
    					<span aria-hidden="true" class="icon icon-layers"></span>
    				</div>
    				<div class="info-details">
    					 <?php echo $this->Html->link('<h4>Commercial<span class="pull-right">'.$commercial_all_count.'</span></h4>', '/my-owners', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'Commercial','escape' => false));
					echo $this->Html->link('<p>Yes <span class="badge pull-right bg-white text-success">'.$commercial_yes.'</span> </p>', '/my-owners/owner_commercial:1', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'Approved','escape' => false));
					echo $this->Html->link('<p>No <span class="badge pull-right bg-white text-success">'.$commercial_no.'</span> </p>', '/my-owners/owner_commercial:2', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'Pending','escape' => false));?>
    				</div>
    			</div>
       
    	
    	</div>
    </div>
<div class="row">
    	<div class="col-md-4 <?php if($cur_page == 'owner_highendresidential'){?>active<?php }?>">
        <div class="info-box  bg-info  text-white" id="initial-tour">
    				<div class="info-icon bg-info-dark">
    					<span aria-hidden="true" class="icon icon-layers"></span>
    				</div>
    				<div class="info-details">
    					 <?php echo $this->Html->link('<h4>High End<span class="pull-right">'.$highend_all_count.'</span></h4>', '/my-owners', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'High End','escape' => false));
					echo $this->Html->link('<p>Yes <span class="badge pull-right bg-white text-success">'.$highend_yes.'</span> </p>', '/my-owners/owner_highendresidential:1', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'Approved','escape' => false));
					echo $this->Html->link('<p>No <span class="badge pull-right bg-white text-success">'.$highend_no.'</span> </p>', '/my-owners/owner_highendresidential:2', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'Pending','escape' => false));?>
    				</div>
    			</div>
       
    	
    	</div>
		<div class="col-md-4">
        <div class="info-box  bg-info  text-white" id="initial-tour">
    				<div class="info-icon bg-info-dark">
    					<span aria-hidden="true" class="icon icon-layers"></span>
    				</div>
    				<div class="info-details">
    					 <?php echo $this->Html->link('<h4>Multi-City<span class="pull-right">'.$multicity_count.'</span></h4>', '/my-owners', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'High End','escape' => false));
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
    				<h4>With Agreements<span class="pull-right"></span></h4>
    				<p>Active<span class="badge pull-right bg-white text-success">0</span> </p>
    			</div>
    		</div>
    	</div>	
    	
</div> 
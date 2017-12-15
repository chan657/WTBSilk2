<?php 
	$url = $this->here;
	$arr = explode("/",$url);
	$page_url = end($arr);
	$aaray = explode(':',$page_url);
	$cur_page = $aaray[0];
 ?>
<div class="row">
    	<div class="col-md-4 <?php if($cur_page == 'my-projects' || $cur_page == 'proj_approved'){?>active<?php }?>">
        <div class="info-box  bg-info  text-white" id="initial-tour">
    				<div class="info-icon bg-info-dark">
    					<span aria-hidden="true" class="icon icon-layers"></span>
    				</div>
    				<div class="info-details">
    					 <?php echo $this->Html->link('<h4>All Projects<span class="pull-right">'.$all_count.'</span></h4>', '/my-projects', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'My Projects','escape' => false));
					echo $this->Html->link('<p>Approved <span class="badge pull-right bg-white text-success">'.$approve.'</span> </p>', '/my-projects/proj_approved:1', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'Approved','escape' => false));
					echo $this->Html->link('<p>Pending <span class="badge pull-right bg-white text-success">'.$pending.'</span> </p>', '/my-projects/proj_approved:2', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'Pending','escape' => false));?>
    				</div>
    			</div>
       
    	
    	</div>
    	<div class="col-md-4 <?php if($cur_page == 'proj_residential'){?>active<?php }?>">
        <div class="info-box  bg-info  text-white" id="initial-tour">
    				<div class="info-icon bg-info-dark">
    					<span aria-hidden="true" class="icon icon-layers"></span>
    				</div>
    				<div class="info-details">
    					 <?php echo $this->Html->link('<h4>Residential<span class="pull-right">'.$residential_all_count.'</span></h4>', '/my-projects', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'My Projects','escape' => false));
					echo $this->Html->link('<p>Yes <span class="badge pull-right bg-white text-success">'.$residential_yes.'</span> </p>', '/my-projects/proj_residential:1', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'Approved','escape' => false));
					echo $this->Html->link('<p>No <span class="badge pull-right bg-white text-success">'.$residential_no.'</span> </p>', '/my-projects/proj_residential:2', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'Pending','escape' => false));?>
    				</div>
    			</div>
       
    	
    	</div>
        <div class="col-md-4 <?php if($cur_page == 'proj_commercial'){?>active<?php }?>">
        <div class="info-box  bg-info  text-white" id="initial-tour">
    				<div class="info-icon bg-info-dark">
    					<span aria-hidden="true" class="icon icon-layers"></span>
    				</div>
    				<div class="info-details">
    					 <?php echo $this->Html->link('<h4>Commercial<span class="pull-right">'.$commercial_all_count.'</span></h4>', '/my-projects', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'My Projects','escape' => false));
					echo $this->Html->link('<p>Yes <span class="badge pull-right bg-white text-success">'.$commercial_yes.'</span> </p>', '/my-projects/proj_commercial:1', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'Approved','escape' => false));
					echo $this->Html->link('<p>No <span class="badge pull-right bg-white text-success">'.$commercial_no.'</span> </p>', '/my-projects/proj_commercial:2', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'Pending','escape' => false));?>
    				</div>
    			</div>
       
    	
    	</div>
    	
    </div>
<div class="row">
    	<div class="col-md-4 <?php if($cur_page == 'proj_highendresidential'){?>active<?php }?>">
        <div class="info-box  bg-info  text-white" id="initial-tour">
    				<div class="info-icon bg-info-dark">
    					<span aria-hidden="true" class="icon icon-layers"></span>
    				</div>
    				<div class="info-details">
    					 <?php echo $this->Html->link('<h4>High End<span class="pull-right">'.$highend_all_count.'</span></h4>', '/my-projects', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'My Projects','escape' => false));
					echo $this->Html->link('<p>Yes <span class="badge pull-right bg-white text-success">'.$highend_yes.'</span> </p>', '/my-projects/proj_highendresidential:1', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'Approved','escape' => false));
					echo $this->Html->link('<p>No <span class="badge pull-right bg-white text-success">'.$highend_no.'</span> </p>', '/my-projects/proj_highendresidential:2', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'Pending','escape' => false));?>
    				</div>
    			</div>
       
    	
    	</div>
		<div class="col-md-4 <?php if($cur_page == 'category_id'){?>active<?php }?>">
        <div class="info-box  bg-info  text-white" id="initial-tour">
    				<div class="info-icon bg-info-dark">
    					<span aria-hidden="true" class="icon icon-layers"></span>
    				</div>
    				<div class="info-details">
    					 <?php echo $this->Html->link('<h4>Townships<span class="pull-right">'.$township.'</span></h4>', '/my-projects/category_id:10', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'My Projects','escape' => false));
					?>
    				</div>
    			</div>
       
    	
    	</div>
        	
    	
</div> 
<?php
 echo $this->Html->css(array('/bootstrap/css/bootstrap.min','popup',
									
									'font-awesome/css/font-awesome.min',
									
									'/js/lib/datepicker/css/datepicker',
									'/js/lib/timepicker/css/bootstrap-timepicker.min'
									
									
									)
							);
echo $this->Html->script(array('jquery.min','lib/chained/jquery.chained.remote.min','lib/jquery.inputmask/jquery.inputmask.bundle.min','lib/parsley/parsley.min','pages/ebro_form_validate','lib/datepicker/js/bootstrap-datepicker','lib/timepicker/js/bootstrap-timepicker.min','pages/ebro_form_extended'));
		/* End */
		//pr($this->data);
		//pr($this->data);
?>

<!----------------------------start add project block------------------------------>

<div class="pop-outer">
     <div class="pop-up-hdng">View Reimbusement (<?php echo $this->data['SubmittedBy']['fname'].' '.$this->data['SubmittedBy']['mname'].' '.$this->data['SubmittedBy']['lname'];?>)</div>

<div class="col-sm-12">
        <div class="col-sm-6">
        	<div class="form-group">
                <label>Activity From</label>
                <span class="colon">:</span>
                <div class="col-sm-10" style="padding-top:6px;"><?php echo date("F j, Y, g:i a",strtotime($this->data['Activity']['start_date'])); ?>
            
                </div>
            
            </div>
            <div class="form-group">
                <label>Expense Level</label>
                <span class="colon">:</span>
                <div class="col-sm-10" style="padding-top:6px;"><?php
					echo $this->data['Level']['value'];
                    ?>
            
                </div>
            
            </div>
            <div class="form-group">
                <label>Expense Type</label>
                <span class="colon">:</span>
                <div class="col-sm-10" style="padding-top:6px;">
                <?php
					echo $this->data['Type']['value'];
                ?>
                </div>
                
                </div>
             <div class="form-group">
            <label>Project Site</label>
            <span class="colon">:</span>
            <div class="col-sm-10" style="padding-top:6px;">
            <?php
			echo $this->data['ProjectSite']['project_name'];
            ?>
            </div>
            
            </div>   
            <div class="form-group">
                <label>Distance(KM)</label>
                <span class="colon">:</span>
                <div class="col-sm-10" style="padding-top:6px;">
                <?php
					echo $this->data['Reimbursement']['reimbursement_factor_1'];
                ?>
                </div>
            </div>
            <div class="form-group">
                <label>Total Amount</label>
                <span class="colon">:</span>
                <div class="col-sm-10" style="padding-top:6px;">
                <?php
				echo $this->data['Reimbursement']['reimbursement_amount'];
                ?>
                </div>
                
            </div>
            <div class="form-group">
            <label>Approval Date</label>
            <span class="colon">:</span>
            <div class="col-sm-10" style="padding-top:6px;">
            <?php 
			if($this->data['Reimbursement']['reimbursement_approved_date'])
			echo date("F j, Y",strtotime($this->data['Reimbursement']['reimbursement_approved_date']));
            ?>
            </div>
            </div>
             
        </div>
        <div class="col-sm-6">
        	<div class="form-group">
                <label>Activity To</label>
                <span class="colon">:</span>
                <div class="col-sm-10" style="padding-top:6px;"><?php echo date("F j, Y, g:i a",strtotime($this->data['Activity']['end_date'])); ?>
            
                </div>
            
            </div>
            <div class="form-group">
            <label>Expense With</label>
            <span class="colon">:</span>
            <div class="col-sm-10" style="padding-top:6px;"><?php
			echo $this->data['Reimbursement']['reimbursement_with'];
            ?>
            
            </div>
            
            </div>
            <div class="form-group">
            <label>Expense Details</label>
            <span class="colon">:</span>
            <div class="col-sm-10" style="padding-top:6px;">
            <?php
			echo $this->data['ExpenseDetails']['value'];
            ?>
            </div>
            
            </div>
            <div class="form-group">
            <label>Expense For</label>
            <span class="colon">:</span>
            <div class="col-sm-10" style="padding-top:6px;">
            <?php
			echo $this->data['For']['value'];
            ?>
            </div>
            
            </div>
            <div class="form-group">
            <label>Expense / KM</label>
            <span class="colon">:</span>
            <div class="col-sm-10" style="padding-top:6px;">
            <?php 
			echo $this->data['Reimbursement']['reimbursement_factor_2'];
            ?>
            </div>
            </div>
            <div class="form-group">
            <label>Submission Date</label>
            <span class="colon">:</span>
            <div class="col-sm-10" style="padding-top:6px;">
            <?php 
			echo date("F j, Y",strtotime($this->data['Reimbursement']['reimbursement_bill_submission_date']));
            ?>
            </div>
            </div>
            <div class="form-group">
            <label>Payment Date</label>
            <span class="colon">:</span>
            <div class="col-sm-10" style="padding-top:6px;">
            <?php 
			if($this->data['Reimbursement']['reimbursement_released_date'])
			echo date("F j, Y",strtotime($this->data['Reimbursement']['reimbursement_released_date']));
            ?>
            </div>
            </div>
            
            
           </div>
           
           
           
	</div>
     <div class="col-sm-12 fullrow evt">
        <div class="form-group">
                <label style="width:16.5%">Expense Description</label>
                <span class="colon">:</span>
                <div class="col-sm-10" style="padding-top:6px;">
                <?php 
                echo $this->data['Reimbursement']['reimbursement_desc'];
                ?>
                </div>
                </div>
        <div class="form-group">
                <label style="width:16.5%">Activity Description</label>
                <span class="colon">:</span>
                <div class="col-sm-10" style="padding-top:6px;">
                <?php 
                echo $this->data['Activity']['event_level_desc'];
                ?>
                </div>
                </div>
    </div>

</div>	


		
<!----------------------------end add project block------------------------------>

<div align="left" valign="top" class="headerText"><?php //echo $this->data['Lead']['lead_fname'].' '.$this->data['Lead']['lead_lname'] . ' | Profile' ?></div>
<?php echo $this->Session->flash(); ?>
<?php if ($this->Session->read('success_msg')) { ?>
    <table width="30%" cellspacing="0" cellpadding="0" border="0">
        <tbody><tr>
                <td><div class="messagesuccessblock"><?php
                        echo $this->Session->read('success_msg');
                        unset($_SESSION['success_msg']);
                        ?></div></td>
            </tr>
        </tbody></table>
<?php } ?>
<div class="content">
	 <div class="tableheadbg">
        <div style="padding: 14px 30px; font-weight: bold;" >View or Update Information</div>
    </div>
<?php echo $this->Form->create('ActionItem');?>
<div class="tableboeder" style="padding-top: 25px;">
	<div class="content_div">
		<div class="popup_left">
			
			<div class="div_line">
				<div class="pop_text">Created Date</div>
				<div class="colon">:</div>
				<div class="input_div">	<?php
				  $action_item_created = date("d/m/Y", strtotime($this->data['ActionItem']['action_item_created']));
                    echo $this->Form->input('action_item_created',  array('div' =>false,'type' => 'text','id' => 'action_item_created','value' => $action_item_created,'label' =>false,'class' => 'inputbox', 'size' => '20','maxlength'=>'100'));
				    ?>
				</div>
			</div>
			<div class="div_line">
				<div class="pop_text">Level</div>
				<div class="colon">:</div>
				<div class="input_div">	<?php
				   echo $this->Form->input('action_item_level_id',  array('div' =>false,
					   'label' => false,'options' => $levels,'empty' => 'Select', 'class' => 'inputformadd', 'size' => '1', 'maxlength'=>'100'));
				
				    ?>
				</div>
			</div>
			<div class="div_line">
				<div class="pop_text">Allocated Channel</div>
				<div class="colon">:</div>
				<div class="input_div">	<?php
				echo $this->Form->input('allocated_channel_id',  array('div' =>false,
					   'label' => false,'options' => $channels,'empty' => 'Select', 'class' => 'inputformadd', 'size' => '1', 'maxlength'=>'100'));
				
				
				    ?>
				</div>
			</div>
			<div class="div_line">
				<div class="pop_text">Primary Manager</div>
				<div class="colon">:</div>
				<div class="input_div">	<?php
				    echo $this->Form->input('primary_manager_id', array('div' => true,
					'label' => false,
					'class' => 'inputbox', 'size' => '25', 'maxlength' => '100', 'onKeyUp' => 'basic_cose()'));
				    ?>
				</div>
			</div>
	
			
			
			
			
			
			
		</div>
		<div class="popup_right">
			<div class="div_line">
				<div class="pop_text">Client Name</div>
				<div class="colon">:</div>
				<div class="input_div">	<?php
				echo $this->Form->input('lead_id',  array('div' =>false,'label' => false, 'options' => $leads,'class' => 'inputformadd', 'size' => '1','maxlength'=>'100'));
				  
				    ?>
				</div>
			</div>
			<div class="div_line">
				<div class="pop_text">Type</div>
				<div class="colon">:</div>
				<div class="input_div">	<?php
				   echo $this->Form->input('type_id',  array('div' =>false,
					   'label' => false,'options' => $type,'empty' => 'Select', 'class' => 'inputformadd', 'size' => '1', 'maxlength'=>'100'));
				
				    ?>
				</div>
			</div>
			<div class="div_line">
				<div class="pop_text">Created By</div>
				<div class="colon">:</div>
				<div class="input_div">	<?php
				echo $this->Form->input('created_by_id',  array('div' =>false,'label' => false, 'options' => $leads,'class' => 'inputformadd', 'size' => '1','maxlength'=>'100'));
				  
				    ?>
				</div>
			</div>
			
			<div class="div_line">
				<div class="pop_text">Allocated By</div>
				<div class="colon">:</div>
				<div class="input_div">	<?php
				   echo $this->Form->input('allocated_by_id',  array('div' =>false,
					   'label' => false,  'options' => array('Top'=>'Top', 'High'=>'High', 'Moderate'=>'Moderate', 'Low'=>'Low'),'empty' => 'Select', 'class' => 'inputformadd', 'size' => '1','maxlength'=>'100'));
				    ?>
				</div>
			</div>
			<div class="div_line">
				<div class="pop_text">Seecondary Manager</div>
				<div class="colon">:</div>
				<div class="input_div">	<?php
				   echo $this->Form->input('secondary_manager_id',  array('div' =>false,
					   'label' => false,  'options' => array('Top'=>'Top', 'High'=>'High', 'Moderate'=>'Moderate', 'Low'=>'Low'),'empty' => 'Select', 'class' => 'inputformadd', 'size' => '1','maxlength'=>'100'));
				    ?>
				</div>
			</div>
			
			
			
			
		</div>
	</div>

	<div class="blank"></div>
        <div class="content_div">
		<div class="select_row">
		    <label>Action Item Description</label>
		    <div class="colon">:</div>
		    <div class="input-box">
		    <?php	    
		    echo $this->Form->input('description',  array('div' =>false,'label' => false, 'type'=>'textarea','class' => 'myclass' ,'rows' => '4'));
			?>
		    </div>
		</div>
		<div class="blank"></div>
        </div>
	<div class="add-project-row-new">
		<?php
		echo $this->Form->submit('Update', array('class' => 'updateBox'));
		echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'updateBox updateBox2'));
		?>
        </div>
	
</div>
 <?php echo $this->Form->end();?>

</div>

<script type="text/javascript">


$(document).ready(function(){

	new JsDatePick({
			useMode:2,
			target:"action_item_created",
			dateFormat:"%d/%m/%Y"
			/*selectedDate:{				This is an example of what the full configuration offers.
				day:5,						For full documentation about these settings please see the full version of the code.
				month:9,
				year:2006
			},
			yearsRange:[1978,2020],
			limitToToday:false,
			cellColorScheme:"beige",
			dateFormat:"%m-%d-%Y",
			imgPath:"img/",
			weekStartDay:1*/
		});

});
//]]>
</script>
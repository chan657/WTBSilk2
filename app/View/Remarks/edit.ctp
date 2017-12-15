<?php
echo $this->Html->css('main');
echo $this->Html->css('jquery.fancybox');
echo $this->Html->script('jquery-1.10.2.min');
echo $this->Html->script('jquery.fancybox');
/* Date Picker */
		echo $this->Html->css('jsDatePick_ltr.min');
		echo $this->Html->script('jsDatePick.min.1.3');
		/* End */
		/* Time Picker */
		echo $this->Html->css('jquery.timepicker');
		
		echo $this->Html->script('jquery.timepicker');
		/* End */
?>
<style>
    .add-project-row{
        padding: 10px 0 8px 30px;
        height: 28px;
    }

    .inputbox{
        padding: 0 0 0 0;
    }
    .colon{float: left;}
</style>
<!--<div align="left" valign="top" class="headerText"> Edit Unit</div>-->
<?php echo $this->Session->flash(); ?>

<!----------------------------start add project block------------------------------>
<div>
     <div class="tableheadbg">
        <span class="heading_text">Edit Remark For | <?php echo $this->data['Lead']['lead_fname'].' '.$this->data['Lead']['lead_lname']; ?></span>
    </div>


    <?php
    echo $this->Form->create('Remark', array('enctype' => 'multipart/form-data'));
    
    ?>

    <div class="tableboeder popup_fr">
        <div class="popup_left">

            <div class="div_line">
                <div class="pop_text">Remark Date</div>
                <div class="colon">:</div>
                <div class="input_div">	<?php
                   $remarks_date = date("d/m/Y", strtotime($this->data['Remark']['remarks_date']));
            // echo $this->data['Project']['proj_exp_date'];
              echo $this->Form->input('remarks_date',  array('type' => 'text','id' => "activity_date",'value' => $remarks_date, 'readonly' => 'readonly', 'div' =>false,'label' => false,'class' => 'inputbox'));
           
                    ?></div>
            </div>


            <div class="div_line">
                <div class="pop_text">Remark</div>
                <div class="colon">:</div>
                <div class="input_div"><?php
                    echo $this->Form->input('remarks', array('div' => false,
                        'label' => false,'class' => 'inputbox'));
                    ?>

                </div>

            </div>
            <div class="div_line">
                <div class="pop_text">Associated Activity</div>
                <div class="colon">:</div>
                <div class="input_div"><?php
		echo $this->Form->input('activity_id',   array('div' =>false,'label' => false,'options' => $activities,'empty'=>'Select','class' => 'inputbox', 'size' => '1','maxlength'=>'100'));
                   
                    ?>

                </div>

            </div>
        </div>
            


        <div class="popup_right">
	     <div class="div_line">
               <div class="pop_text">Remark Time</div>
                <div class="colon">:</div>
                <div class="input_div">	<?php
                   echo $this->Form->input('remarks_time',  array('div' =>false,'id' => 'remarks_time','type' => 'text','label' =>false,'class' => 'inputbox', 'size' => '20','maxlength'=>'100')); 
                    ?></div>
            </div>
            <div class="div_line">
               <div class="pop_text">Remark Level</div>
                <div class="colon">:</div>
                <div class="input_div">	<?php
                    echo $this->Form->input('remarks_level', array('div' => false,
                        'label' => false,
                        'class' => 'inputbox'));
                    ?></div>
            </div>
            <div class="div_line">
                <div class="pop_text">Remark By</div>
                <div class="colon">:</div>
                <div class="input_div"><?php
                    echo $this->Form->input('remarks_by', array('div' => false,
                        'label' => false,
                        'class' => 'inputbox'));
                    ?></div>
            </div>
           
         
        <div class="div_line">
                     <div class="pop_text">&nbsp;</div>
                    <div class="input_div">
            <div class="buttons">
                
                <?php echo $this->Form->submit('Update', array('class' => 'updateBox','div' => false, 'id' => 'udate_unit')); ?>

                <?php
                echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'updateBox updateBox2'));
                //  echo $this->Html->link($this->Html->image("btn-reset.gif"), array(), array('escape' => false, 'onclick'=>'document.UserAddForm.reset();return false;', 'div' => false));
                ?>
                     </div>
                 </div>
            </div>
        </div>

    </div>

    <?php echo $this->Form->end();
    ?>
</div>			
<!----------------------------end add project block------------------------------>
<script type="text/javascript">
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"activity_date",
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
		$('#remarks_time').timepicker({interval: 10});
	};
</script>
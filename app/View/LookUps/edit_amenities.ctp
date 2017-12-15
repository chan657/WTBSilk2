<?php  echo $this->Html->css(array('/bootstrap/css/bootstrap.min','popup','font-awesome/css/font-awesome.min'));
	   echo $this->Html->script(array('jquery.min','lib/chained/jquery.chained.remote.min','lib/jquery.inputmask/jquery.inputmask.bundle.min','lib/parsley/parsley.min','pages/ebro_form_validate','lib/datepicker/js/bootstrap-datepicker','lib/timepicker/js/bootstrap-timepicker.min','pages/ebro_form_extended'));
?>
<style>
    .add-project-row{
        padding: 10px 0 8px 30px;
        height: 28px;
    }

    .inputbox{
        padding: 0 0 0 0;
    }
    .butt_submit{
        float: right;
    }
#add_ameniti{
    background: url("../imag/add-icon.png") no-repeat scroll 0 0 rgba(0, 0, 0, 0);
    display: inline-block;
    height: 14px;
    margin: 0 0 0 6px;
    text-indent: -9999em;
    vertical-align: middle;
    width: 14px;
}

#removeVar{
    background: url("../imag/remove-icon.png") no-repeat scroll 0 0 rgba(0, 0, 0, 0);
    display: inline-block;
    height: 14px;
    margin: 0 0 0 9px;
    text-indent: -9999em;
    vertical-align: middle;
    width: 14px;
}
.div_line.divlineSec .input_div{
	width: 52%;
}

</style>
<?php echo $this->Session->flash(); ?>
<div class="pop-outer">
     <div class="pop-up-hdng">Edit Amenities</div>


    <?php
    //echo $this->Form->create('Remark', array('enctype' => 'multipart/form-data'));
	echo $this->Form->create('LookupValueAmenitie', array('method' => 'post','id' => 'parsley_reg','novalidate' => true,
													'inputDefaults' => array(
																	'label' => false,
																	'div' => false,
																	'class' => 'form-control',
																),
														
						));
   // pr($lead);
    ?>

  
    <div class="col-sm-12 fullrow">
    <div class="form-group" >
                <label for="input_name" class="req">Amenities Type</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                   echo $this->Form->input('group_id', array('options'=>$groups,'empty'=>'--Select--','data-required' => 'true'));
                    ?>

                </div>

            </div>  
    <div class="form-group" >
                <label for="input_name" class="req">Amenities</label>
                <span class="colon">:</span>
                <?php
	     //pr($amenity);
	     $i = 1;
	     foreach($amenity as $amenities){
	
		?>
               
                <div class="col-sm-10">
                    
		    <input type="text" class="inputbox add" name="data[LookupValueAmenitie][amenity_name][]" data-required="true" value="<?php echo $amenities['LookupValueAmenitie']['amenity_name'];?>" >
		    <?php if($i == 1){?>
                 <span id="addVar" style="display: inline-block;height: 14px;margin: 6px 0 0 10px;text-indent: -9999em;width: 14px;background: url('../../img/add-icon.png') no-repeat 0 0;">Add Variable</span>
                <?php }
		  else {
		?>
		<span class="removeVar" style="display: inline-block;height: 14px;margin: 10px 0 0 10px;text-indent: -9999em;vertical-align: middle;width: 14px;background: url(../../img/remove-icon.png) no-repeat 0 0;">Remove Variable</span>
		<?php }?>
		</div>
               
	    
	     <?php  $i++; }
	     //pr($amenity);?>

                

            </div>         
    </div>             
        <div class="row">
        	<div class="col-sm-12">
			<?php echo $this->Form->submit('Update', array('class' => 'success btn','div' => false, 'id' => 'udate_unit')); 
                echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'reset btn'));
               
                ?>
                </div>
         </div>
            
        

    <?php echo $this->Form->end();
    ?>
</div>

<!----------------------------start add project block------------------------------>
<!--<div>
    <div class="tableheadbg">
        <span class="heading_text">Edit Amenities</span>
    </div>

    <?php
    echo $this->Form->create('LookupValueAmenitie', array('enctype' => 'multipart/form-data'));
    ?>

    <div class="tableboeder" style="padding-top: 25px;">
         <div class="content_div">
            
             <div class="div_line">
                <div class="pop_text">Amenities Type</div>
                <div class="colon">:</div>
                <div class="input_div">	<?php
		echo $this->Form->input('group_id', array('type' => 'select','label'=> false,'options'=>$groups,'empty'=>'--Select--','class' => 'inputformadd', 'size' => '1','maxlength'=>'100'));
                    
                   
              
                    ?>
                </div>
	    </div>
	     <div class="div_line divlineSec">
		 <div class="pop_text">Amenities</div>
		  <div class="colon">:</div>
		   <div class="inputDivBox">
	     <?php
	     //pr($amenity);
	     $i = 1;
	     foreach($amenity as $amenities){
	
		?>
               
                <div class="input_div">
                    
		    <input type="text" class="inputbox add" name="data[LookupValueAmenitie][amenity_name][]" value="<?php echo $amenities['LookupValueAmenitie']['amenity_name'];?>" >
		    <?php if($i == 1){?>
                 <span id="addVar" style="display: inline-block;height: 14px;margin: 6px 0 0 10px;text-indent: -9999em;width: 14px;background: url('../../img/add-icon.png') no-repeat 0 0;">Add Variable</span>
                <?php }
		  else {
		?>
		<span class="removeVar" style="display: inline-block;height: 14px;margin: 10px 0 0 10px;text-indent: -9999em;vertical-align: middle;width: 14px;background: url(../../img/remove-icon.png) no-repeat 0 0;">Remove Variable</span>
		<?php }?>
		</div>
               
	    
	     <?php  $i++; }
	     //pr($amenity);?>
	     </div>
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
</div>-->
 <script>
var startingNo = 3;
var $node = "";
for(varCount=0;varCount<=startingNo;varCount++){
    var displayCount = varCount+1;
    //$node += '<p><label for="var'+displayCount+'">Variable '+displayCount+': </label><input type="text" name="var'+displayCount+'" id="var'+displayCount+'"><span class="removeVar">Remove Variable</span></p>';
}
//add them to the DOM
$('form').prepend($node);
//remove a textfield   
$('form').on('click', '.removeVar', function(){
   $(this).parent().remove();
  
});
//add a new node
$('#addVar').on('click', function(){
varCount++;
$node = '<div class="input_div"><input type="text" class="inputbox add" data-required="true" name="data[LookupValueAmenitie][amenity_name][]" id="var'+varCount+'"><span class="removeVar" style="display: inline-block;height: 14px;margin: 10px 0 0 10px;text-indent: -9999em;vertical-align: middle;width: 14px;background: url(../../img/remove-icon.png) no-repeat 0 0;">Remove Variable</span></div>';
$(this).parent().after($node);
});
  </script>

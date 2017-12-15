<?php 
//pr($DataArray);
$i=1;
foreach($DataArray as $values){
    
    echo $this->Form->hidden($model.'.question_id'.$i,array('value' => $values['LookupQuestion']['question']));
    $i++;
    ?>
<!--
<div class="col-sm-6">
<div class="form-group">
    <span><?php echo $values['LookupQuestion']['question'];?></span>          
            </div>
    </div>
-->
<div class="form-group">
    
    <label class="req"><?php echo $values['LookupQuestion']['question'];?></label>          
    <span class="colon">:</span>         
    <?php 
    if($values['LookupQuestion']['id'] == '9' || $values['LookupQuestion']['id'] == '11'){
    ?>
    
<div class="col-sm-10" style="padding-top:6px;">
                    <?php echo $this->Form->input($model.'.answer1', array('label'=> false,'id' => 'continetId','div'=>false,'options'=>$TravelLookupContinent,'empty'=>'--Select--')); ?>            
                </div>           
            
    <?php }
    elseif($values['LookupQuestion']['id'] == '10' || $values['LookupQuestion']['id'] == '12'){
        ?>
               
                
                <div class="col-sm-10" style="padding-top:6px;">
                    <?php echo $this->Form->input($model.'.answer2', array('label'=> false,'id' => 'countryId','div'=>false,'options'=>array(),'empty'=>'--Select--')); ?>            
                </div>           
       
    <?php
    }
    elseif($values['LookupQuestion']['id'] == '13'){
        ?>
                
                
                <div class="col-sm-10" style="padding-top:6px;">
                    <?php echo $this->Form->input($model.'.answer1', array('label'=> false,'id' => 'ProvinceCountry','div'=>false,'options'=>$TravelCountries,'empty'=>'--Select--')); ?>            
                </div>           
    <?php
    }
    elseif($values['LookupQuestion']['id'] == '14'){
        ?>
               
                
                <div class="col-sm-10" style="padding-top:6px;">
                    <?php echo $this->Form->input($model.'.answer2', array('label'=> false,'id' => 'Province','div'=>false,'options'=>array(),'empty'=>'--Select--')); ?>            
                </div>           
    <?php
    }
    elseif($values['LookupQuestion']['id'] == '15'){
        ?>
                
                
                <div class="col-sm-10" style="padding-top:6px;">
                    <?php echo $this->Form->input($model.'.answer1', array('label'=> false,'id' => 'ProvinceCity','div'=>false,'options'=>$Provinces,'empty'=>'--Select--')); ?>            
                </div>           
    <?php
    }
    elseif($values['LookupQuestion']['id'] == '16'){
        ?>
                
                
                <div class="col-sm-10" style="padding-top:6px;">
                    <?php echo $this->Form->input($model.'.answer2', array('label'=> false,'id' => 'City','div'=>false,'options'=>array(),'empty'=>'--Select--')); ?>            
                </div>           
    <?php
    }
    elseif($values['LookupQuestion']['id'] == '17'){
        ?>
                
               
                <div class="col-sm-10" style="padding-top:6px;">
                    <?php echo $this->Form->input($model.'.answer1', array('label'=> false,'div'=>false,'options'=>$TravelCities,'empty'=>'--Select--')); ?>            
                </div>           
    <?php
    }
    elseif($values['LookupQuestion']['id'] == '19'){
        ?>

                
                <div class="col-sm-10" style="padding-top:6px;">
                    <?php echo $this->Form->input($model.'.answer1', array('label'=> false,'div'=>false,'options'=>$TravelSuburbs,'empty'=>'--Select--')); ?>            
                </div>           

    <?php
    }
    elseif($values['LookupQuestion']['id'] == '18' || $values['LookupQuestion']['id'] == '20'){
        ?>
                
                
                <div class="col-sm-10" style="padding-top:6px;">
                    <?php echo $this->Form->input($model.'.answer2', array('label'=> false,'div'=>false,'type' => 'text','placeholder' => 'Type the name here')); ?>            
                </div>           
    <?php
    }
    elseif($values['LookupQuestion']['id'] == '21'){
        ?>
                
                
                <div class="col-sm-10" style="padding-top:6px;">
                    <?php echo $this->Form->input($model.'.answer1', array('label'=> false,'div'=>false,'options'=>$TechnicalIssue,'empty'=>'--Select--'));  ?>            
                </div>           
    <?php
    }
    elseif($values['LookupQuestion']['id'] == '25'){
        ?>
                
                
                <div class="col-sm-10" style="padding-top:6px;">
                    <?php echo $this->Form->input($model.'.answer1', array('label'=> false,'div'=>false,'type' => 'text','placeholder' => 'Type the description here'));  ?>            
                </div>           
    <?php
    }
    elseif($values['LookupQuestion']['id'] == '26'){
        ?>
                
                
                <div class="col-sm-10" style="padding-top:6px;">
                    <?php echo $this->Form->input($model.'.answer2', array('label'=> false,'div'=>false,'type' => 'text','placeholder' => 'Type the description here'));  ?>            
                </div>           
    <?php
    }
    elseif($values['LookupQuestion']['id'] == '28'){
        ?>
                
                
                <div class="col-sm-10" style="padding-top:6px;">
                    <?php echo $this->Form->input($model.'.answer1', array('label'=> false,'div'=>false,'options'=>$TravelHotelLookups,'empty'=>'--Select--'));  ?>            
                </div>           
    <?php
    }
    elseif($values['LookupQuestion']['id'] == '31'){
        ?>
                
                
                <div class="col-sm-10" style="padding-top:6px;">
                    <?php echo $this->Form->input($model.'.answer1', array('label'=> false,'div'=>false,'type' => 'text'));  ?>            
                </div>           
    <?php
    }
    elseif($values['LookupQuestion']['id'] == '32'){
        ?>
                
                
                <div class="col-sm-10" style="padding-top:6px;">
                    <?php echo $this->Form->input($model.'.answer2', array('label'=> false,'div'=>false,'type' => 'text'));  ?>            
                </div>           
    <?php
    }
    elseif($values['LookupQuestion']['id'] == '33'){
        ?>
                
                
                <div class="col-sm-10" style="padding-top:6px;">
                    <?php echo $this->Form->input($model.'.answer1', array('label'=> false,'div'=>false,'options'=>$TravelChains,'empty'=>'--Select--'));  ?>            
                </div>           
    <?php
    }
    elseif($values['LookupQuestion']['id'] == '34'){
        ?>
                
                
                <div class="col-sm-10" style="padding-top:6px;">
                    <?php echo $this->Form->input($model.'.answer2', array('label'=> false,'div'=>false,'type' => 'text'));  ?>            
                </div>           
    <?php
    }

    ?>

  
    </div>
<?php
}

?>



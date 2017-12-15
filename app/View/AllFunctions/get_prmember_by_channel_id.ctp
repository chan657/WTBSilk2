<?php
if(!empty($users)){
 echo $this->Form->hidden($model.'.primary_manager_id',array('type'=>'select','label' => false,'class' => 'inputformadd','type' => 'text','value' => $users[0]['User']['id'])); 
 
?>
 <div id="out_going"></div>
 <div class="div_line" id="pri_mang">
                <div class="pop_text">Primary Manager</div>
                <div class="colon">:</div>
                <div class="col-sm-10">
                <?php echo  $users[0]['User']['fname'].' '.$users[0]['User']['mname'].' '.$users[0]['User']['lname'];            

                    ?>
				</div>
            </div>
 
          <div class="div_line div_line_ex" id="going_msg">
                <div class="pop_text">Going To</div>
                <div class="colon">:</div>
                <div class="col-sm-10"><?php
                    echo $users[0]['User']['fname'].' '.$users[0]['User']['mname'].' '.$users[0]['User']['lname'].' | '.$users[0]['User']['company_email_id'].' | '.$users[0]['User']['primary_mobile_number'];
                    ?></div>
            </div>
            
            <div class="form-group smlabel" id="out_going_msg" style="display:none;">
                <label>Outgoing Message</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                     echo strtoupper(substr($clientArry['City']['city_name'],0,3)).' | '.strtoupper(substr($clientArry['Urgency']['value'],0,3)).' | '.strtoupper(substr($clientArry['Importance']['value'],0,3)).' | '.strtoupper(substr($clientArry['Country']['value'],0,2)). ' | +91- '.$clientArry['Lead']['lead_primaryphonenumber'].' | '.strtoupper($clientArry['Lead']['lead_fname']).' '.strtoupper($clientArry['Lead']['lead_lname']).' | '.$clientArry['Lead']['lead_emailid'].' | '.strtoupper($clientArry['Suburb']['suburb_name']).'  '.strtoupper($clientArry['AreaPreference']['area_name']).'   '.strtoupper($clientArry['Builder']['builder_name']).'  '.strtoupper($clientArry['Project']['project_name']).'  '.strtoupper($clientArry['ProjectType']['value']).'  '.strtoupper($clientArry['Type']['value'].'  '.strtoupper($clientArry['Lead']['lead_description']));
                    ?>

                </div>

            </div>
            
            <?php }?>
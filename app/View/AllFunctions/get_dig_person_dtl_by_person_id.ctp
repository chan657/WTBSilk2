<?php if(count($DataArray)){?>
<div class="col-sm-6">
    <h4>Account Logistics </h4>
    <div class="form-group">
        <label for="reg_input_name">Used By (Team)</label>
        <span class="colon">:</span>
        <div class="col-sm-10">
            <?php
            echo $this->Form->input('DigAccount.account_team_id', array('options' => $DigUsedByTeams, 'data-required' => 'true','label' => false,'div' => false,'class' => 'form-control'));
            ?></div>
    </div>
    <div class="form-group">
        <label for="reg_input_name">Email</label>
        <span class="colon">:</span>
        <div class="col-sm-10">
            <?php
            echo $this->Form->input('DigAccount.account_parm1', array('label' => false,'div' => false,'class' => 'form-control','value' => $DataArray['DigPerson']['person_email']));
            ?>
        </div>
    </div>
 
     <h4>Person Profile Picture</h4>
     <div class="form-group">
         <label>Profile</label>
                                                <span class="colon">:</span>
                                            <div class="col-sm-10">
                                                
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                    <div class="fileupload-new img-thumbnail" style="width: 178px; height: 120px; float: left;">
<?php
$imagePath = $this->webroot . 'uploads/DigPersons';

if ($DataArray['DigPerson']['upload_picture']) {    
    $logo_image2 = $imagePath . '/' . $DataArray['DigPerson']['upload_picture'];
} else {
    $logo_image2 = $imagePath . '/noimage.png' ;
}

?>
                                                        <img src="<?php echo $logo_image2; ?>" height="200" width="170" />
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                        </div>
</div>

<div class="col-sm-6">
    <h4>&nbsp;</h4>
    <div class="form-group">
        <label for="reg_input_name">Used By (Person)</label>
        <span class="colon">:</span>
        <div class="col-sm-10">
            <?php
            echo $this->Form->input('DigAccount.account_used_by_person', array('options' => $DigUsedByPersons,'data-required' => 'true','label' => false,'div' => false,'class' => 'form-control'));
            ?></div>
    </div>
    <div class="form-group">
        <label for="reg_input_name">User</label>
        <span class="colon">:</span>
        <div class="col-sm-10">
            <?php
            echo $this->Form->input('DigAccount.account_parm2', array('label' => false,'div' => false,'class' => 'form-control','value' => $DataArray['DigPerson']['person_user']));
            ?></div>
    </div>
       <div class="form-group">
        <label for="reg_input_name">Credential</label>
        <span class="colon">:</span>
        <div class="col-sm-10">
            <?php
            echo $this->Form->input('DigAccount.account_parm3', array('label' => false,'div' => false,'class' => 'form-control','value' => $DataArray['DigPerson']['person_user_parm']));
            ?></div>
    </div>
</div>
<?php }?>

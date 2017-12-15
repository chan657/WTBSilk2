<?php
echo $this->Html->css(array('/bootstrap/css/bootstrap.min', 'popup',
    'font-awesome/css/font-awesome.min',
    '/js/lib/datepicker/css/datepicker',
    '/js/lib/timepicker/css/bootstrap-timepicker.min'
        )
);
echo $this->Html->script(array('jquery.min', 'lib/chained/jquery.chained.remote.min', 'lib/jquery.inputmask/jquery.inputmask.bundle.min', 'lib/parsley/parsley.min', 'pages/ebro_form_validate', 'lib/datepicker/js/bootstrap-datepicker', 'lib/timepicker/js/bootstrap-timepicker.min', 'pages/ebro_form_extended'));
/* End */
//pr($this->data);
?>

<!----------------------------start add project block------------------------------>

<div class="pop-outer">
    <div class="pop-up-hdng">Add Account</div>


<?php
echo $this->Form->create('DigAccount', array('enctype' => 'multipart/form-data', 'method' => 'post',
    'id' => 'parsley_reg',
    'novalidate' => true,
    'inputDefaults' => array(
        'label' => false,
        'div' => false,
        'class' => 'form-control',
    )
));
echo $this->Form->hidden('base_url', array('id' => 'hidden_site_baseurl', 'value' => $this->request->base . ((!is_null($this->params['language'])) ? '/' . $this->params['language'] : '')));
?>

    <div class="col-sm-12" id="mycl-det">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">Add Information</h4>
            </div>
            <div class="panel-body">
                <fieldset>
                    <legend><span>Add Account</span></legend>
                </fieldset>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-6">


                            <div class="form-group">
                                <label for="reg_input_name" class="req">Base Name</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
<?php
echo $this->Form->input('account_base_id', array('options' => $DigBases, 'empty' => '--Select--', 'data-required' => 'true', 'tabindex' => '1'));
?></div>
                            </div>
                            <div class="form-group">
                                <label for="reg_input_name" class="req">Public URL</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
<?php
echo $this->Form->input('account_public_url', array('data-required' => 'true', 'tabindex' => '3'));
?></div>
                            </div>
                            <div class="form-group">
                                <label for="reg_input_name" class="req">Example Profile URL</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
<?php
echo $this->Form->input('account_ex_profile_url', array('data-required' => 'true', 'tabindex' => '5'));
?></div>
                            </div>
                            <h4>Account Statistics </h4>
                            <div class="form-group">
                                <label for="reg_input_name">Account PR</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><?php
echo $this->Form->input('account_profile_pr', array('tabindex' => '6'));
?></div>
                            </div>
                            <div class="form-group">
                                <label for="reg_input_name" class="req">Account PA</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
<?php
echo $this->Form->input('account_profile_pa', array('tabindex' => '8'));
?></div>
                            </div>
                            <div class="form-group">
                                <label for="reg_input_name" class="req">Usage Status</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
<?php
echo $this->Form->input('account_usage_status', array('options' => $DigAccountUsages, 'empty' => '--Select--', 'data-required' => 'true', 'tabindex' => '10'));
?></div>
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="reg_input_name" class="req">Person Name</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
<?php
echo $this->Form->input('account_person_id', array('options' => $DigPersons, 'empty' => '--Select--', 'data-required' => 'true', 'tabindex' => '2'));
?></div>
                            </div>
                            <div class="form-group">
                                <label for="reg_input_name" class="req">Profile URL</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
<?php
echo $this->Form->input('account_profile_url', array('data-required' => 'true', 'tabindex' => '4'));
?></div>
                            </div>

                            <h4>&nbsp;</h4>
                            <h4>&nbsp;</h4>
                            <div class="form-group">
                                <label for="reg_input_name" class="req">Account DA</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
<?php
echo $this->Form->input('account_profile_da', array('data-required' => 'true', 'tabindex' => '7'));
?></div>
                            </div>
                            <div class="form-group">
                                <label for="reg_input_name" class="req">Account DF</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
<?php
echo $this->Form->input('account_profile_df', array('options' => $DigAccountDofollows, 'empty' => '--Select--', 'data-required' => 'true', 'tabindex' => '9'));
?></div>
                            </div>                    

                            <div class="form-group">
                                <label for="reg_input_name" class="req">Active?</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
<?php
echo $this->Form->input('active', array('options' => array('TRUE' => 'TRUE', 'FALSE' => 'FALSE'), 'empty' => '--Select--', 'tabindex' => '11'));
?></div>
                            </div>

                        </div>
                    </div>
                    <div style="clear: both"></div>
                    <div class="col-sm-12">   
                        <div class="col-sm-6">
                            <h4>Account Logistics </h4>
                            <div class="form-group">
                                <label for="reg_input_name">Used By (Team)</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
<?php
echo $this->Form->input('DigAccount.account_team_id', array('options' => $DigUsedByTeams, 'data-required' => 'true', 'label' => false, 'div' => false, 'class' => 'form-control'));
?></div>
                            </div>
                            <div class="form-group">
                                <label for="reg_input_name">Email</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
<?php
echo $this->Form->input('DigAccount.account_parm1', array('label' => false, 'div' => false, 'class' => 'form-control', 'value' => $DataArray['DigPerson']['person_email']));
?>
                                </div>
                            </div>

                            <h4>Person Profile Picture</h4>
                            <div class="form-group">
                                <label>Profile</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">

                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-new img-thumbnail">
<?php
$imagePath = $this->webroot . 'uploads/DigPersons';

if ($DataArray['DigPerson']['upload_picture']) {
    $logo_image2 = $imagePath . '/' . $DataArray['DigPerson']['upload_picture'];
} else {
    $logo_image2 = $imagePath . '/noimage.png';
}
?>
                                            <img src="<?php echo $logo_image2; ?>" height="150" width="170" />
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
echo $this->Form->input('account_used_by_person', array('options' => $DigUsedByPersons, 'data-required' => 'true', 'label' => false, 'div' => false, 'class' => 'form-control'));
?></div>
                            </div>
                            <div class="form-group">
                                <label for="reg_input_name">User</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <?php
                                    echo $this->Form->input('account_parm2', array('label' => false, 'div' => false, 'class' => 'form-control', 'value' => $DataArray['DigPerson']['person_user']));
                                    ?></div>
                            </div>
                            <div class="form-group">
                                <label for="reg_input_name">Credential</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <?php
                                    echo $this->Form->input('account_parm3', array('label' => false, 'div' => false, 'class' => 'form-control', 'value' => $DataArray['DigPerson']['person_user_parm']));
                                    ?></div>
                            </div>
                        </div>
                    </div>                           
                   
                    <div class="col-sm-12 spacer" style="margin-left:-144px">
                        
                        <div class="form-group">
                            <label for="reg_input_name" style="margin-left: 14px">Account Description</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
<?php
echo $this->Form->input('account_description', array('type' => 'textarea', 'style' => 'width:135%;height:100px', 'tabindex' => '12'));
?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" style="margin-left: 14px">Account Comment</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('account_usage_comment', array('type' => 'textarea', 'style' => 'width:135%;height:100px', 'tabindex' => '13'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" style="margin-left: 14px">Account Instructions</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('account_instructions', array('type' => 'textarea', 'style' => 'width:135%;height:100px', 'tabindex' => '14'));
                                ?></div>
                        </div>
                        
                        
                    </div>
                     <div style="clear:both"></div>
                    <div class="row">
                            <div class="col-sm-1">
                                <?php
                                echo $this->Form->submit('Submit', array('class' => 'btn btn-success sticky_success'));
                                ?>
                            </div>
                           
                        </div>
                </div>
            </div>
        </div>
    </div>



<?php echo $this->Form->end();
?>
</div>	



<!----------------------------end add project block------------------------------>

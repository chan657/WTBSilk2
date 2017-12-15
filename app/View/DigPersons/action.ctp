<?php
$this->Html->addCrumb('Person Action', 'javascript:void(0);', array('class' => 'breadcrumblast'));
//pr($this->data);
?>
<?php
echo $this->Form->create('DigPerson', array('enctype' => 'multipart/form-data', 'method' => 'post', 'class' => 'form-horizontal user_form', 'id' => 'parsley_reg', 'novalidate' => true,
    'inputDefaults' => array(
        'label' => false,
        'div' => false,
        'class' => 'form-control',
    )
));

echo $this->Form->hidden('upload_picture', array('value' => $this->data['DigPerson']['upload_picture']));


$flag = '';
$account_usage_status = $this->data['DigPerson']['person_usage_status'];
if ($account_usage_status <> '9')
    $disabled = array('3');
else
    $disabled = array('3');



if ($account_usage_status == '1') {
    $usage_options = array('9');
} elseif ($account_usage_status == '9') {

    $usage_options = array('1', '2', '3', '4', '5', '6', '7', '8');
}
else
    $usage_options = array('9');
?>
<style>
    .validate_txt{
        width:55%;
    }

</style>
<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Person Action</h4>

        </div>

        <div class="panel-body">

            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Action</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('action_type', array('options' => array('2' => 'Validate', '1' => 'Update', '3' => 'Edit'), 'empty' => '--Select--', 'data-required' => 'true', 'tabindex' => '1', 'disabled' => $disabled));
                                ?></div>
                        </div>

                    </div>

                </div>
                <div style="clear:both"></div>
                <div class="col-sm-12 update" style="display:none">
                    <div class="col-sm-12" style="background-color: rgb(206, 228, 245);overflow:hidden;">
                        <div class="col-sm-6">    
                            <h4>Person Statistics (As Per Your Last Update)</h4>
                            <div class="form-group">
                                <label for="reg_input_name">Person Name</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <p class="form-control-static"><?php echo $this->data['DigPerson']['person_name']; ?></p>

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="reg_input_name">Industry</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <p class="form-control-static"><?php echo $this->data['DigPersonIndustry']['value']; ?></p>

                                </div>
                            </div>
                            <div class="form-group">
                                <label>Login Email</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10 editable">
                                    <p class="form-control-static"><?php echo $this->data['DigPerson']['person_email']; ?></p>

                                </div>
                            </div>
                            <div class="form-group">
                                <label>User</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <p class="form-control-static"><?php echo $this->data['DigPerson']['person_user']; ?></p>

                                </div>
                            </div>


                            <div class="form-group">
                                <label>Bio?</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <p class="form-control-static"><?php echo $this->data['DigPerson']['person_bio']; ?></p>

                                </div>
                            </div>                        

                        </div>  
                        <div class="col-sm-6">
                            <h4>&nbsp;</h4>
                            <div class="form-group">
                                <label>Geography</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <p class="form-control-static"><?php echo $this->data['Location']['value']; ?></p>

                                </div>
                            </div>
                            <div class="form-group">
                                <label>Usage Status</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <p class="form-control-static"><?php echo $this->data['DigPersonUsageStatus']['value']; ?></p>

                                </div>
                            </div>
                            <div class="form-group">
                                <label>Email Credential</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <p class="form-control-static"><?php echo $this->data['DigPerson']['person_email_parm']; ?></p>

                                </div>
                            </div>
                            <div class="form-group">
                                <label>User Credential</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <p class="form-control-static"><?php echo $this->data['DigPerson']['person_user_parm']; ?></p>

                                </div>
                            </div>

                            <div class="form-group">
                                <label>Profile Picture?</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <p class="form-control-static"><?php echo $this->data['DigPerson']['person_profile_picture']; ?></p>

                                </div>
                            </div>                         

                        </div>
                    </div>
                    <div style="margin-top:10px"></div>
                    <div class="col-sm-12" style="background-color: rgb(211, 233, 237);overflow:hidden;">
                        <div class="col-sm-6">
                            <h4>To Do List</h4>
                            <div class="form-group">
                                <label for="reg_input_name">Login Email</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <?php
                                    echo $this->Form->input('person_email');
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="reg_input_name" class="req">User</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <?php
                                    echo $this->Form->input('person_user');
                                    ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="reg_input_name" class="req">Added Picture?</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <?php
                                    echo $this->Form->input('person_profile_picture', array('options' => array('Yes' => 'Yes', 'No' => 'No'), 'empty' => '--Select--', 'data-required' => 'true', 'tabindex' => '1'));
                                    ?></div>
                            </div>
                            <div class="form-group">
                                <label for="reg_input_name" class="req">Usage Status</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <?php
                                    echo $this->Form->input('person_usage_status', array('options' => $DigPersonUsages, 'empty' => '--Select--', 'data-required' => 'true', 'tabindex' => '2', 'disabled' => $usage_options));
                                    ?></div>
                            </div>
                            <h4>Person Profile Picture</h4>
                            <div class="form-group">
                                <div class="col-sm-10 editable txtbox">
                                    <label>Profile</label>
                                    <span class="colon">:</span>
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-new img-thumbnail" style="width: 178px; height: 120px; float: left;">
                                            <?php
                                            $imagePath = $this->webroot . 'uploads/DigPersons';

                                            if ($this->data['DigPerson']['upload_picture']) {
                                                $logo_image2 = $imagePath . '/' . $this->data['DigPerson']['upload_picture'];
                                            } else {
                                                $logo_image2 = $imagePath . '/noimage.png';
                                            }
                                            ?>
                                            <img src="<?php echo $logo_image2; ?>" height="200" width="170" />
                                        </div>
                                        <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 178px; height: 120px; float: left;"></div>
                                        <div>
                                            <span class="btn btn-default btn-file"  style="margin-left: 5px; "><span class="fileupload-new">Select</span><span class="fileupload-exists">Change</span>
                                                <input type="file" name="data[DigPerson][image]" />

                                            </span>
                                            <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload" style="margin-left: 5px; ">Remove</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <h4>&nbsp;</h4>
                            <div class="form-group">
                                <label for="reg_input_name">Email Credential</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <?php
                                    echo $this->Form->input('person_email_parm');
                                    ?></div>
                            </div>
                            <div class="form-group">
                                <label for="reg_input_name" class="req">User Credential</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <?php
                                    echo $this->Form->input('person_user_parm');
                                    ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="reg_input_name" class="req">Added Bio?</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <?php
                                    echo $this->Form->input('person_bio', array('options' => array('Yes' => 'Yes', 'No' => 'No'), 'empty' => '--Select--', 'data-required' => 'true', 'tabindex' => '2'));
                                    ?></div>
                            </div>

                        </div>
                        <div style="clear:both"></div>
                        <div class="form_submit clearfix" style="margin-bottom: 13px;">
                            <div class="row">
                                <div class="col-sm-1">
                                    <?php
                                    echo $this->Form->submit('Update', array('class' => 'btn btn-success sticky_success'));
                                    ?>
                                </div>                   
                            </div>
                        </div>
                    </div>
                    <div style="margin-top:10px;"></div>
                    <div class="col-sm-12" style="background-color: rgb(206, 228, 245);overflow:hidden;">
                        <h4>Review Accounts</h4>
                        <table border="0" cellpadding="0" cellspacing="0" id="resp_table" class="table toggle-square myclitb" data-filter="#table_search" data-page-size="100" style="margin-top:15px;">
                            <thead>
                                <tr class="footable-group-row">
                                    <th data-group="group1" colspan="3">Account Information</th>                                                                     
                                    <th data-group="group3" colspan="4">Account Logistics</th>
                                    <th data-group="group4" colspan="4">Account Status</th>
                                    <th data-group="group5" class="nodis">Action</th>
                                </tr>
                                <tr>  
                                    <th data-toggle="phone"  data-group="group1">Id</th>
                                    <th data-toggle="phone" data-sort-ignore="true"  data-group="group1">Base Info.</th>
                                    <th data-toggle="phone" data-sort-ignore="true"  data-group="group1">Person Name</th>
                 

                                    <th data-hide="phone" data-sort-ignore="true" data-group="group3">Email</th>
                                    <th data-hide="phone" data-sort-ignore="true" data-group="group3">User</th>
                                    <th data-hide="phone" data-sort-ignore="true" data-group="group3">Credential</th>
                                    <th data-hide="phone" data-sort-ignore="true" data-group="group3">Profile URL</th>

                                    <th data-hide="phone" data-sort-ignore="true" data-group="group4">System Status</th>
                                    <th data-hide="phone" data-sort-ignore="true" data-group="group4">Usage Status</th>
                                    <th data-hide="phone" data-sort-ignore="true" data-group="group4">Active?</th>
                                    <th data-hide="phone" data-sort-ignore="true" data-group="group4">Validate?</th>

                                    <th data-group="group5" data-hide="phone" data-sort-ignore="true" width="7%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $person_id = $this->data['DigPerson']['id'];
                                
                                
                                
                                        if(count($twitterValidate))  {
                                            $id = $twitterValidate['DigAccount']['id'];
                                        if ($twitterValidate['DigAccount']['account_status'] == '1')
                                            $status = 'Submitted';
                                        elseif ($twitterValidate['DigAccount']['account_status'] == '2')
                                            $status = 'Approved';
                                        elseif ($twitterValidate['DigAccount']['account_status'] == '3')
                                            $status = 'Returned';
                                        elseif ($twitterValidate['DigAccount']['account_status'] == '4')
                                            $status = 'Change Submitted';
                                        elseif ($twitterValidate['DigAccount']['account_status'] == '8')
                                            $status = 'De-activated';
                                        
                                        $base_website_url = 'Twitter';
                                        $person_name =     $twitterValidate['DigPerson']['person_name'];
                                        $account_parm1 = $twitterValidate['DigAccount']['account_parm1'];
                                        $account_parm2 = $twitterValidate['DigAccount']['account_parm2'];
                                        $account_parm3 = $twitterValidate['DigAccount']['account_parm3'];
                                         if ($twitterValidate['DigAccount']['account_profile_url']) 
                                             $account_profile_url = $this->Html->link('Click Here', $twitterValidate['DigAccount']['account_profile_url'], array('target' => '_blank'));
                                        $DigAccountUsage = $twitterValidate['DigAccountUsage']['value'];
                                        $Active = $twitterValidate['DigAccount']['active'];  
                                        $Validate = 'Yes';
                                        
                                         
                                        }
                                        else{
                                            
                                           $base_website_url = 'Twitter';
                                            $status = '';
                                            $id = '';
                                            $person_name = '';
                                            $account_parm1 = '';
                                            $account_parm2 = '';
                                            $account_parm3 = '';
                                            $account_profile_url = '';
                                            $DigAccountUsage = '';
                                            $Active = '';
                                            $Validate = 'No'; 
                                            $account_base_id = '25'; //twitter 
                                        }
                                        
                                
                                        ?>
                                        <tr> 
                                            <td><?php echo $id; ?></td>
                                            <td><?php echo $base_website_url; ?></td>
                                            <td><?php echo $person_name; ?></td>
                                           

                                            <td><?php echo $account_parm1; ?></td>
                                            <td><?php echo $account_parm2; ?></td>
                                            <td><?php echo $account_parm3; ?></td>
                                            <td><?php echo $account_profile_url; ?></td>

                                            <td><?php echo $status; ?></td>
                                            <td><?php echo $DigAccountUsage; ?></td>
                                            <td><?php echo $Active; ?></td>
                                            <td><?php echo $Validate; ?></td>
                                            <td>
                                                <?php
                                                if($Validate == 'No'){                                                
                                                ?>  
                                                <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Account', '/dig_accounts/add_account/'.$person_id.'/'.$account_base_id,array('class' => 'act-ico open-popup-link add-btn', 'escape' => false)) ?></span>
                                                <?php }?>
                                            </td>
                                        </tr>
                                        <?php
                                      
                                       if(count($pinterestValidate))  {
                                           $id = $pinterestValidate['DigAccount']['id'];
                                            
                                        if ($pinterestValidate['DigAccount']['account_status'] == '1')
                                            $status = 'Submitted';
                                        elseif ($pinterestValidate['DigAccount']['account_status'] == '2')
                                            $status = 'Approved';
                                        elseif ($pinterestValidate['DigAccount']['account_status'] == '3')
                                            $status = 'Returned';
                                        elseif ($pinterestValidate['DigAccount']['account_status'] == '4')
                                            $status = 'Change Submitted';
                                        elseif ($pinterestValidate['DigAccount']['account_status'] == '8')
                                            $status = 'De-activated';
                                        
                                        $base_website_url = 'Pinterest';
                                        $person_name =     $pinterestValidate['DigPerson']['person_name'];
                                        $account_parm1 = $pinterestValidate['DigAccount']['account_parm1'];
                                        $account_parm2 = $pinterestValidate['DigAccount']['account_parm2'];
                                        $account_parm3 = $pinterestValidate['DigAccount']['account_parm3'];
                                         if ($pinterestValidate['DigAccount']['account_profile_url']) 
                                             $account_profile_url = $this->Html->link('Click Here', $pinterestValidate['DigAccount']['account_profile_url'], array('target' => '_blank'));
                                        $DigAccountUsage = $pinterestValidate['DigAccountUsage']['value'];
                                        $Active = $pinterestValidate['DigAccount']['active'];  
                                        $Validate = 'Yes';   
                                        
                                        }
                                        else{
                                            $base_website_url = 'Pinterest';
                                            $status = '';
                                            $id = '';
                                            $person_name = '';
                                            $account_parm1 = '';
                                            $account_parm2 = '';
                                            $account_parm3 = '';
                                            $account_profile_url = '';
                                            $DigAccountUsage = '';
                                            $Active = '';
                                            $Validate = 'No';
                                            $account_base_id = '3'; //Pinterest 
                                        }
                                        
                                
                                        ?>
                                        <tr> 
                                            <td><?php echo $id; ?></td>
                                            <td><?php echo $base_website_url; ?></td>
                                            <td><?php echo $person_name; ?></td>
                                           

                                            <td><?php echo $account_parm1; ?></td>
                                            <td><?php echo $account_parm2; ?></td>
                                            <td><?php echo $account_parm3; ?></td>
                                            <td><?php echo $account_profile_url; ?></td>

                                            <td><?php echo $status; ?></td>
                                            <td><?php echo $DigAccountUsage; ?></td>
                                            <td><?php echo $Active; ?></td>
                                            <td><?php echo $Validate; ?></td>
                                            <td>
                                                <?php
                                                if($Validate == 'No'){                                                
                                                ?>  
                                                <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Account', '/dig_accounts/add_account/'.$person_id.'/'.$account_base_id,array('class' => 'act-ico open-popup-link add-btn', 'escape' => false)) ?></span>
                                                <?php }?>
                                            </td>
                                        </tr>
                                        <?php
                                      
                                       if(count($facebookValidate))  {
                                           $id = $facebookValidate['DigAccount']['id'];
                                            
                                        if ($facebookValidate['DigAccount']['account_status'] == '1')
                                            $status = 'Submitted';
                                        elseif ($facebookValidate['DigAccount']['account_status'] == '2')
                                            $status = 'Approved';
                                        elseif ($facebookValidate['DigAccount']['account_status'] == '3')
                                            $status = 'Returned';
                                        elseif ($facebookValidate['DigAccount']['account_status'] == '4')
                                            $status = 'Change Submitted';
                                        elseif ($facebookValidate['DigAccount']['account_status'] == '8')
                                            $status = 'De-activated';
                                        
                                        $base_website_url = 'Facebook';
                                        $person_name =     $facebookValidate['DigPerson']['person_name'];
                                        $account_parm1 = $facebookValidate['DigAccount']['account_parm1'];
                                        $account_parm2 = $facebookValidate['DigAccount']['account_parm2'];
                                        $account_parm3 = $facebookValidate['DigAccount']['account_parm3'];
                                         if ($facebookValidate['DigAccount']['account_profile_url']) 
                                             $account_profile_url = $this->Html->link('Click Here', $facebookValidate['DigAccount']['account_profile_url'], array('target' => '_blank'));
                                        $DigAccountUsage = $facebookValidate['DigAccountUsage']['value'];
                                        $Active = $facebookValidate['DigAccount']['active'];  
                                        $Validate = 'Yes';   
                                        
                                        }
                                        else{
                                            $base_website_url = 'Facebook';
                                            $status = '';
                                            $id = '';
                                            $person_name = '';
                                            $account_parm1 = '';
                                            $account_parm2 = '';
                                            $account_parm3 = '';
                                            $account_profile_url = '';
                                            $DigAccountUsage = '';
                                            $Active = '';
                                            $Validate = 'No';
                                            $account_base_id = '41'; //Pinterest 
                                        }
                                        
                                
                                        ?>
                                        <tr> 
                                            <td><?php echo $id; ?></td>
                                            <td><?php echo $base_website_url; ?></td>
                                            <td><?php echo $person_name; ?></td>
                                           

                                            <td><?php echo $account_parm1; ?></td>
                                            <td><?php echo $account_parm2; ?></td>
                                            <td><?php echo $account_parm3; ?></td>
                                            <td><?php echo $account_profile_url; ?></td>

                                            <td><?php echo $status; ?></td>
                                            <td><?php echo $DigAccountUsage; ?></td>
                                            <td><?php echo $Active; ?></td>
                                            <td><?php echo $Validate; ?></td>
                                            <td>
                                                <?php
                                                if($Validate == 'No'){                                                
                                                ?>  
                                                <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Account', '/dig_accounts/add_account/'.$person_id.'/'.$account_base_id,array('class' => 'act-ico open-popup-link add-btn', 'escape' => false)) ?></span>
                                                <?php }?>
                                            </td>
                                        </tr>
                                        <?php
                                      
                                       if(count($linkedInValidate))  {
                                           $id = $linkedInValidate['DigAccount']['id'];
                                            
                                        if ($linkedInValidate['DigAccount']['account_status'] == '1')
                                            $status = 'Submitted';
                                        elseif ($linkedInValidate['DigAccount']['account_status'] == '2')
                                            $status = 'Approved';
                                        elseif ($linkedInValidate['DigAccount']['account_status'] == '3')
                                            $status = 'Returned';
                                        elseif ($linkedInValidate['DigAccount']['account_status'] == '4')
                                            $status = 'Change Submitted';
                                        elseif ($linkedInValidate['DigAccount']['account_status'] == '8')
                                            $status = 'De-activated';
                                        
                                        $base_website_url = 'LinkedIn';
                                        $person_name =     $linkedInValidate['DigPerson']['person_name'];
                                        $account_parm1 = $linkedInValidate['DigAccount']['account_parm1'];
                                        $account_parm2 = $linkedInValidate['DigAccount']['account_parm2'];
                                        $account_parm3 = $linkedInValidate['DigAccount']['account_parm3'];
                                         if ($linkedInValidate['DigAccount']['account_profile_url']) 
                                             $account_profile_url = $this->Html->link('Click Here', $linkedInValidate['DigAccount']['account_profile_url'], array('target' => '_blank'));
                                        $DigAccountUsage = $linkedInValidate['DigAccountUsage']['value'];
                                        $Active = $linkedInValidate['DigAccount']['active'];  
                                        $Validate = 'Yes';   
                                        
                                        }
                                        else{
                                            $base_website_url = 'LinkedIn';
                                            $status = '';
                                            $id = '';
                                            $person_name = '';
                                            $account_parm1 = '';
                                            $account_parm2 = '';
                                            $account_parm3 = '';
                                            $account_profile_url = '';
                                            $DigAccountUsage = '';
                                            $Active = '';
                                            $Validate = 'No';
                                            $account_base_id = '46'; //Pinterest 
                                        }
                                        
                                
                                        ?>
                                        <tr> 
                                            <td><?php echo $id; ?></td>
                                            <td><?php echo $base_website_url; ?></td>
                                            <td><?php echo $person_name; ?></td>
                                           

                                            <td><?php echo $account_parm1; ?></td>
                                            <td><?php echo $account_parm2; ?></td>
                                            <td><?php echo $account_parm3; ?></td>
                                            <td><?php echo $account_profile_url; ?></td>

                                            <td><?php echo $status; ?></td>
                                            <td><?php echo $DigAccountUsage; ?></td>
                                            <td><?php echo $Active; ?></td>
                                            <td><?php echo $Validate; ?></td>
                                            <td>
                                                <?php
                                                if($Validate == 'No'){                                                
                                                ?>  
                                                <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Account', '/dig_accounts/add_account/'.$person_id.'/'.$account_base_id,array('class' => 'act-ico open-popup-link add-btn', 'escape' => false)) ?></span>
                                                <?php }?>
                                            </td>
                                        </tr>
                                        <?php
                                      
                                       if(count($muzyValidate))  {
                                           $id = $muzyValidate['DigAccount']['id'];
                                            
                                        if ($muzyValidate['DigAccount']['account_status'] == '1')
                                            $status = 'Submitted';
                                        elseif ($muzyValidate['DigAccount']['account_status'] == '2')
                                            $status = 'Approved';
                                        elseif ($muzyValidate['DigAccount']['account_status'] == '3')
                                            $status = 'Returned';
                                        elseif ($muzyValidate['DigAccount']['account_status'] == '4')
                                            $status = 'Change Submitted';
                                        elseif ($muzyValidate['DigAccount']['account_status'] == '8')
                                            $status = 'De-activated';
                                        
                                        $base_website_url = 'Muzy';
                                        $person_name =     $muzyValidate['DigPerson']['person_name'];
                                        $account_parm1 = $muzyValidate['DigAccount']['account_parm1'];
                                        $account_parm2 = $muzyValidate['DigAccount']['account_parm2'];
                                        $account_parm3 = $muzyValidate['DigAccount']['account_parm3'];
                                         if ($muzyValidate['DigAccount']['account_profile_url']) 
                                             $account_profile_url = $this->Html->link('Click Here', $muzyValidate['DigAccount']['account_profile_url'], array('target' => '_blank'));
                                        $DigAccountUsage = $muzyValidate['DigAccountUsage']['value'];
                                        $Active = $muzyValidate['DigAccount']['active'];  
                                        $Validate = 'Yes';   
                                        
                                        }
                                        else{
                                            $base_website_url = 'Muzy';
                                            $status = '';
                                            $id = '';
                                            $person_name = '';
                                            $account_parm1 = '';
                                            $account_parm2 = '';
                                            $account_parm3 = '';
                                            $account_profile_url = '';
                                            $DigAccountUsage = '';
                                            $Active = '';
                                            $Validate = 'No';
                                            $account_base_id = '42'; //Pinterest 
                                        }
                                        
                                
                                        ?>
                                        <tr> 
                                            <td><?php echo $id; ?></td>
                                            <td><?php echo $base_website_url; ?></td>
                                            <td><?php echo $person_name; ?></td>
                                           

                                            <td><?php echo $account_parm1; ?></td>
                                            <td><?php echo $account_parm2; ?></td>
                                            <td><?php echo $account_parm3; ?></td>
                                            <td><?php echo $account_profile_url; ?></td>

                                            <td><?php echo $status; ?></td>
                                            <td><?php echo $DigAccountUsage; ?></td>
                                            <td><?php echo $Active; ?></td>
                                            <td><?php echo $Validate; ?></td>
                                            <td>
                                                <?php
                                                if($Validate == 'No'){                                                
                                                ?>  
                                                <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Account', '/dig_accounts/add_account/'.$person_id.'/'.$account_base_id,array('class' => 'act-ico open-popup-link add-btn', 'escape' => false)) ?></span>
                                                <?php }?>
                                            </td>
                                        </tr>
                                        <?php
                                      
                                       if(count($newsvineValidate))  {
                                           $id = $newsvineValidate['DigAccount']['id'];
                                            
                                        if ($newsvineValidate['DigAccount']['account_status'] == '1')
                                            $status = 'Submitted';
                                        elseif ($newsvineValidate['DigAccount']['account_status'] == '2')
                                            $status = 'Approved';
                                        elseif ($newsvineValidate['DigAccount']['account_status'] == '3')
                                            $status = 'Returned';
                                        elseif ($newsvineValidate['DigAccount']['account_status'] == '4')
                                            $status = 'Change Submitted';
                                        elseif ($newsvineValidate['DigAccount']['account_status'] == '8')
                                            $status = 'De-activated';
                                        
                                        $base_website_url = 'Newsvine';
                                        $person_name =     $newsvineValidate['DigPerson']['person_name'];
                                        $account_parm1 = $newsvineValidate['DigAccount']['account_parm1'];
                                        $account_parm2 = $newsvineValidate['DigAccount']['account_parm2'];
                                        $account_parm3 = $newsvineValidate['DigAccount']['account_parm3'];
                                         if ($newsvineValidate['DigAccount']['account_profile_url']) 
                                             $account_profile_url = $this->Html->link('Click Here', $newsvineValidate['DigAccount']['account_profile_url'], array('target' => '_blank'));
                                        $DigAccountUsage = $newsvineValidate['DigAccountUsage']['value'];
                                        $Active = $newsvineValidate['DigAccount']['active'];  
                                        $Validate = 'Yes';   
                                        
                                        }
                                        else{
                                            $base_website_url = 'Newsvine';
                                            $status = '';
                                            $id = '';
                                            $person_name = '';
                                            $account_parm1 = '';
                                            $account_parm2 = '';
                                            $account_parm3 = '';
                                            $account_profile_url = '';
                                            $DigAccountUsage = '';
                                            $Active = '';
                                            $Validate = 'No';
                                            $account_base_id = '43'; //Pinterest 
                                        }
                                        
                                
                                        ?>
                                        <tr> 
                                            <td><?php echo $id; ?></td>
                                            <td><?php echo $base_website_url; ?></td>
                                            <td><?php echo $person_name; ?></td>
                                           

                                            <td><?php echo $account_parm1; ?></td>
                                            <td><?php echo $account_parm2; ?></td>
                                            <td><?php echo $account_parm3; ?></td>
                                            <td><?php echo $account_profile_url; ?></td>

                                            <td><?php echo $status; ?></td>
                                            <td><?php echo $DigAccountUsage; ?></td>
                                            <td><?php echo $Active; ?></td>
                                            <td><?php echo $Validate; ?></td>
                                            <td>
                                                <?php
                                                if($Validate == 'No'){                                                
                                                ?>  
                                                <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Account', '/dig_accounts/add_account/'.$person_id.'/'.$account_base_id,array('class' => 'act-ico open-popup-link add-btn', 'escape' => false)) ?></span>
                                                <?php }?>
                                            </td>
                                        </tr>
                                        <?php
                                      
                                       if(count($skyrockValidate))  {
                                           $id = $skyrockValidate['DigAccount']['id'];
                                            
                                        if ($skyrockValidate['DigAccount']['account_status'] == '1')
                                            $status = 'Submitted';
                                        elseif ($skyrockValidate['DigAccount']['account_status'] == '2')
                                            $status = 'Approved';
                                        elseif ($skyrockValidate['DigAccount']['account_status'] == '3')
                                            $status = 'Returned';
                                        elseif ($skyrockValidate['DigAccount']['account_status'] == '4')
                                            $status = 'Change Submitted';
                                        elseif ($skyrockValidate['DigAccount']['account_status'] == '8')
                                            $status = 'De-activated';
                                        
                                        $base_website_url = 'Skyrock';
                                        $person_name =     $skyrockValidate['DigPerson']['person_name'];
                                        $account_parm1 = $skyrockValidate['DigAccount']['account_parm1'];
                                        $account_parm2 = $skyrockValidate['DigAccount']['account_parm2'];
                                        $account_parm3 = $skyrockValidate['DigAccount']['account_parm3'];
                                         if ($skyrockValidate['DigAccount']['account_profile_url']) 
                                             $account_profile_url = $this->Html->link('Click Here', $skyrockValidate['DigAccount']['account_profile_url'], array('target' => '_blank'));
                                        $DigAccountUsage = $skyrockValidate['DigAccountUsage']['value'];
                                        $Active = $skyrockValidate['DigAccount']['active'];  
                                        $Validate = 'Yes';   
                                        
                                        }
                                        else{
                                            $base_website_url = 'Skyrock';
                                            $status = '';
                                            $id = '';
                                            $person_name = '';
                                            $account_parm1 = '';
                                            $account_parm2 = '';
                                            $account_parm3 = '';
                                            $account_profile_url = '';
                                            $DigAccountUsage = '';
                                            $Active = '';
                                            $Validate = 'No';
                                            $account_base_id = '44'; //Pinterest 
                                        }
                                        
                                
                                        ?>
                                        <tr> 
                                            <td><?php echo $id; ?></td>
                                            <td><?php echo $base_website_url; ?></td>
                                            <td><?php echo $person_name; ?></td>
                                           

                                            <td><?php echo $account_parm1; ?></td>
                                            <td><?php echo $account_parm2; ?></td>
                                            <td><?php echo $account_parm3; ?></td>
                                            <td><?php echo $account_profile_url; ?></td>

                                            <td><?php echo $status; ?></td>
                                            <td><?php echo $DigAccountUsage; ?></td>
                                            <td><?php echo $Active; ?></td>
                                            <td><?php echo $Validate; ?></td>
                                            <td>
                                                <?php
                                                if($Validate == 'No'){                                                
                                                ?>  
                                                <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Account', '/dig_accounts/add_account/'.$person_id.'/'.$account_base_id,array('class' => 'act-ico open-popup-link add-btn', 'escape' => false)) ?></span>
                                                <?php }?>
                                            </td>
                                        </tr>
                                        <?php
                                      
                                       if(count($weheartitValidate))  {
                                           $id = $weheartitValidate['DigAccount']['id'];
                                            
                                        if ($weheartitValidate['DigAccount']['account_status'] == '1')
                                            $status = 'Submitted';
                                        elseif ($weheartitValidate['DigAccount']['account_status'] == '2')
                                            $status = 'Approved';
                                        elseif ($weheartitValidate['DigAccount']['account_status'] == '3')
                                            $status = 'Returned';
                                        elseif ($weheartitValidate['DigAccount']['account_status'] == '4')
                                            $status = 'Change Submitted';
                                        elseif ($weheartitValidate['DigAccount']['account_status'] == '8')
                                            $status = 'De-activated';
                                        
                                        $base_website_url = 'Weheartit';
                                        $person_name =     $weheartitValidate['DigPerson']['person_name'];
                                        $account_parm1 = $weheartitValidate['DigAccount']['account_parm1'];
                                        $account_parm2 = $weheartitValidate['DigAccount']['account_parm2'];
                                        $account_parm3 = $weheartitValidate['DigAccount']['account_parm3'];
                                         if ($weheartitValidate['DigAccount']['account_profile_url']) 
                                             $account_profile_url = $this->Html->link('Click Here', $weheartitValidate['DigAccount']['account_profile_url'], array('target' => '_blank'));
                                        $DigAccountUsage = $weheartitValidate['DigAccountUsage']['value'];
                                        $Active = $weheartitValidate['DigAccount']['active'];  
                                        $Validate = 'Yes';   
                                        
                                        }
                                        else{
                                            $base_website_url = 'Weheartit';
                                            $status = '';
                                            $id = '';
                                            $person_name = '';
                                            $account_parm1 = '';
                                            $account_parm2 = '';
                                            $account_parm3 = '';
                                            $account_profile_url = '';
                                            $DigAccountUsage = '';
                                            $Active = '';
                                            $Validate = 'No';
                                            $account_base_id = '45'; //Pinterest 
                                        }
                                        
                                
                                        ?>
                                        <tr> 
                                            <td><?php echo $id; ?></td>
                                            <td><?php echo $base_website_url; ?></td>
                                            <td><?php echo $person_name; ?></td>
                                           

                                            <td><?php echo $account_parm1; ?></td>
                                            <td><?php echo $account_parm2; ?></td>
                                            <td><?php echo $account_parm3; ?></td>
                                            <td><?php echo $account_profile_url; ?></td>

                                            <td><?php echo $status; ?></td>
                                            <td><?php echo $DigAccountUsage; ?></td>
                                            <td><?php echo $Active; ?></td>
                                            <td><?php echo $Validate; ?></td>
                                            <td>
                                                <?php
                                                if($Validate == 'No'){                                                
                                                ?>  
                                                <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Account', '/dig_accounts/add_account/'.$person_id.'/'.$account_base_id,array('class' => 'act-ico open-popup-link add-btn', 'escape' => false)) ?></span>
                                                <?php }?>
                                            </td>
                                        </tr>
                                        <?php
                                      
                                       if(count($plurkValidate))  {
                                           $id = $plurkValidate['DigAccount']['id'];
                                            
                                        if ($plurkValidate['DigAccount']['account_status'] == '1')
                                            $status = 'Submitted';
                                        elseif ($plurkValidate['DigAccount']['account_status'] == '2')
                                            $status = 'Approved';
                                        elseif ($plurkValidate['DigAccount']['account_status'] == '3')
                                            $status = 'Returned';
                                        elseif ($plurkValidate['DigAccount']['account_status'] == '4')
                                            $status = 'Change Submitted';
                                        elseif ($plurkValidate['DigAccount']['account_status'] == '8')
                                            $status = 'De-activated';
                                        
                                        $base_website_url = 'Plurk';
                                        $person_name =     $plurkValidate['DigPerson']['person_name'];
                                        $account_parm1 = $plurkValidate['DigAccount']['account_parm1'];
                                        $account_parm2 = $plurkValidate['DigAccount']['account_parm2'];
                                        $account_parm3 = $plurkValidate['DigAccount']['account_parm3'];
                                         if ($plurkValidate['DigAccount']['account_profile_url']) 
                                             $account_profile_url = $this->Html->link('Click Here', $plurkValidate['DigAccount']['account_profile_url'], array('target' => '_blank'));
                                        $DigAccountUsage = $plurkValidate['DigAccountUsage']['value'];
                                        $Active = $plurkValidate['DigAccount']['active'];  
                                        $Validate = 'Yes';   
                                        
                                        }
                                        else{
                                            $base_website_url = 'Plurk';
                                            $status = '';
                                            $id = '';
                                            $person_name = '';
                                            $account_parm1 = '';
                                            $account_parm2 = '';
                                            $account_parm3 = '';
                                            $account_profile_url = '';
                                            $DigAccountUsage = '';
                                            $Active = '';
                                            $Validate = 'No';
                                            $account_base_id = '6'; //Pinterest 
                                        }
                                        
                                
                                        ?>
                                        <tr> 
                                            <td><?php echo $id; ?></td>
                                            <td><?php echo $base_website_url; ?></td>
                                            <td><?php echo $person_name; ?></td>
                                           

                                            <td><?php echo $account_parm1; ?></td>
                                            <td><?php echo $account_parm2; ?></td>
                                            <td><?php echo $account_parm3; ?></td>
                                            <td><?php echo $account_profile_url; ?></td>

                                            <td><?php echo $status; ?></td>
                                            <td><?php echo $DigAccountUsage; ?></td>
                                            <td><?php echo $Active; ?></td>
                                            <td><?php echo $Validate; ?></td>
                                            <td>
                                                <?php
                                                if($Validate == 'No'){                                                
                                                ?>  
                                                <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Account', '/dig_accounts/add_account/'.$person_id.'/'.$account_base_id,array('class' => 'act-ico open-popup-link add-btn', 'escape' => false)) ?></span>
                                                <?php }?>
                                            </td>
                                        </tr>
                                        <?php
                                      
                                       if(count($fancyValidate))  {
                                           $id = $fancyValidate['DigAccount']['id'];
                                            
                                        if ($fancyValidate['DigAccount']['account_status'] == '1')
                                            $status = 'Submitted';
                                        elseif ($fancyValidate['DigAccount']['account_status'] == '2')
                                            $status = 'Approved';
                                        elseif ($fancyValidate['DigAccount']['account_status'] == '3')
                                            $status = 'Returned';
                                        elseif ($fancyValidate['DigAccount']['account_status'] == '4')
                                            $status = 'Change Submitted';
                                        elseif ($fancyValidate['DigAccount']['account_status'] == '8')
                                            $status = 'De-activated';
                                        
                                        $base_website_url = 'Fancy';
                                        $person_name =     $fancyValidate['DigPerson']['person_name'];
                                        $account_parm1 = $fancyValidate['DigAccount']['account_parm1'];
                                        $account_parm2 = $fancyValidate['DigAccount']['account_parm2'];
                                        $account_parm3 = $fancyValidate['DigAccount']['account_parm3'];
                                         if ($fancyValidate['DigAccount']['account_profile_url']) 
                                             $account_profile_url = $this->Html->link('Click Here', $fancyValidate['DigAccount']['account_profile_url'], array('target' => '_blank'));
                                        $DigAccountUsage = $fancyValidate['DigAccountUsage']['value'];
                                        $Active = $fancyValidate['DigAccount']['active'];  
                                        $Validate = 'Yes';   
                                        
                                        }
                                        else{
                                            $base_website_url = 'Fancy';
                                            $status = '';
                                            $id = '';
                                            $person_name = '';
                                            $account_parm1 = '';
                                            $account_parm2 = '';
                                            $account_parm3 = '';
                                            $account_profile_url = '';
                                            $DigAccountUsage = '';
                                            $Active = '';
                                            $Validate = 'No';
                                            $account_base_id = '13'; //Pinterest 
                                        }
                                        
                                
                                        ?>
                                        <tr> 
                                            <td><?php echo $id; ?></td>
                                            <td><?php echo $base_website_url; ?></td>
                                            <td><?php echo $person_name; ?></td>
                                           

                                            <td><?php echo $account_parm1; ?></td>
                                            <td><?php echo $account_parm2; ?></td>
                                            <td><?php echo $account_parm3; ?></td>
                                            <td><?php echo $account_profile_url; ?></td>

                                            <td><?php echo $status; ?></td>
                                            <td><?php echo $DigAccountUsage; ?></td>
                                            <td><?php echo $Active; ?></td>
                                            <td><?php echo $Validate; ?></td>
                                            <td>
                                                <?php
                                                if($Validate == 'No'){                                                
                                                ?>  
                                                <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Account', '/dig_accounts/add_account/'.$person_id.'/'.$account_base_id,array('class' => 'act-ico open-popup-link add-btn', 'escape' => false)) ?></span>
                                                <?php }?>
                                            </td>
                                        </tr>
                                        <?php
                                      
                                       if(count($pushaValidate))  {
                                           $id = $pushaValidate['DigAccount']['id'];
                                            
                                        if ($pushaValidate['DigAccount']['account_status'] == '1')
                                            $status = 'Submitted';
                                        elseif ($pushaValidate['DigAccount']['account_status'] == '2')
                                            $status = 'Approved';
                                        elseif ($pushaValidate['DigAccount']['account_status'] == '3')
                                            $status = 'Returned';
                                        elseif ($pushaValidate['DigAccount']['account_status'] == '4')
                                            $status = 'Change Submitted';
                                        elseif ($pushaValidate['DigAccount']['account_status'] == '8')
                                            $status = 'De-activated';
                                        
                                        $base_website_url = 'Pusha';
                                        $person_name =     $pushaValidate['DigPerson']['person_name'];
                                        $account_parm1 = $pushaValidate['DigAccount']['account_parm1'];
                                        $account_parm2 = $pushaValidate['DigAccount']['account_parm2'];
                                        $account_parm3 = $pushaValidate['DigAccount']['account_parm3'];
                                         if ($pushaValidate['DigAccount']['account_profile_url']) 
                                             $account_profile_url = $this->Html->link('Click Here', $pushaValidate['DigAccount']['account_profile_url'], array('target' => '_blank'));
                                        $DigAccountUsage = $pushaValidate['DigAccountUsage']['value'];
                                        $Active = $pushaValidate['DigAccount']['active'];  
                                        $Validate = 'Yes';   
                                        
                                        }
                                        else{
                                            $base_website_url = 'Pusha';
                                            $status = '';
                                            $id = '';
                                            $person_name = '';
                                            $account_parm1 = '';
                                            $account_parm2 = '';
                                            $account_parm3 = '';
                                            $account_profile_url = '';
                                            $DigAccountUsage = '';
                                            $Active = '';
                                            $Validate = 'No';
                                            $account_base_id = '47'; //Pinterest 
                                        }
                                        
                                
                                        ?>
                                        <tr> 
                                            <td><?php echo $id; ?></td>
                                            <td><?php echo $base_website_url; ?></td>
                                            <td><?php echo $person_name; ?></td>
                                           

                                            <td><?php echo $account_parm1; ?></td>
                                            <td><?php echo $account_parm2; ?></td>
                                            <td><?php echo $account_parm3; ?></td>
                                            <td><?php echo $account_profile_url; ?></td>

                                            <td><?php echo $status; ?></td>
                                            <td><?php echo $DigAccountUsage; ?></td>
                                            <td><?php echo $Active; ?></td>
                                            <td><?php echo $Validate; ?></td>
                                            <td>
                                                <?php
                                                if($Validate == 'No'){                                                
                                                ?>  
                                                <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Account', '/dig_accounts/add_account/'.$person_id.'/'.$account_base_id,array('class' => 'act-ico open-popup-link add-btn', 'escape' => false)) ?></span>
                                                <?php }?>
                                            </td>
                                        </tr>
                                        <?php
                                      
                                       if(count($visualizeValidate))  {
                                           $id = $visualizeValidate['DigAccount']['id'];
                                            
                                        if ($visualizeValidate['DigAccount']['account_status'] == '1')
                                            $status = 'Submitted';
                                        elseif ($visualizeValidate['DigAccount']['account_status'] == '2')
                                            $status = 'Approved';
                                        elseif ($visualizeValidate['DigAccount']['account_status'] == '3')
                                            $status = 'Returned';
                                        elseif ($visualizeValidate['DigAccount']['account_status'] == '4')
                                            $status = 'Change Submitted';
                                        elseif ($visualizeValidate['DigAccount']['account_status'] == '8')
                                            $status = 'De-activated';
                                        
                                        $base_website_url = 'Visualize';
                                        $person_name =     $visualizeValidate['DigPerson']['person_name'];
                                        $account_parm1 = $visualizeValidate['DigAccount']['account_parm1'];
                                        $account_parm2 = $visualizeValidate['DigAccount']['account_parm2'];
                                        $account_parm3 = $visualizeValidate['DigAccount']['account_parm3'];
                                         if ($visualizeValidate['DigAccount']['account_profile_url']) 
                                             $account_profile_url = $this->Html->link('Click Here', $visualizeValidate['DigAccount']['account_profile_url'], array('target' => '_blank'));
                                        $DigAccountUsage = $visualizeValidate['DigAccountUsage']['value'];
                                        $Active = $visualizeValidate['DigAccount']['active'];  
                                        $Validate = 'Yes';   
                                        
                                        }
                                        else{
                                            $base_website_url = 'Visualize';
                                            $status = '';
                                            $id = '';
                                            $person_name = '';
                                            $account_parm1 = '';
                                            $account_parm2 = '';
                                            $account_parm3 = '';
                                            $account_profile_url = '';
                                            $DigAccountUsage = '';
                                            $Active = '';
                                            $Validate = 'No';
                                            $account_base_id = '48'; //Pinterest 
                                        }
                                        
                                
                                        ?>
                                        <tr> 
                                            <td><?php echo $id; ?></td>
                                            <td><?php echo $base_website_url; ?></td>
                                            <td><?php echo $person_name; ?></td>
                                           

                                            <td><?php echo $account_parm1; ?></td>
                                            <td><?php echo $account_parm2; ?></td>
                                            <td><?php echo $account_parm3; ?></td>
                                            <td><?php echo $account_profile_url; ?></td>

                                            <td><?php echo $status; ?></td>
                                            <td><?php echo $DigAccountUsage; ?></td>
                                            <td><?php echo $Active; ?></td>
                                            <td><?php echo $Validate; ?></td>
                                            <td>
                                                <?php
                                                if($Validate == 'No'){                                                
                                                ?>  
                                                <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Account', '/dig_accounts/add_account/'.$person_id.'/'.$account_base_id,array('class' => 'act-ico open-popup-link add-btn', 'escape' => false)) ?></span>
                                                <?php }?>
                                            </td>
                                        </tr>
                                        <?php
                                      
                                       if(count($piccsyValidate))  {
                                           $id = $piccsyValidate['DigAccount']['id'];
                                            
                                        if ($piccsyValidate['DigAccount']['account_status'] == '1')
                                            $status = 'Submitted';
                                        elseif ($piccsyValidate['DigAccount']['account_status'] == '2')
                                            $status = 'Approved';
                                        elseif ($piccsyValidate['DigAccount']['account_status'] == '3')
                                            $status = 'Returned';
                                        elseif ($piccsyValidate['DigAccount']['account_status'] == '4')
                                            $status = 'Change Submitted';
                                        elseif ($piccsyValidate['DigAccount']['account_status'] == '8')
                                            $status = 'De-activated';
                                        
                                        $base_website_url = 'Piccsy';
                                        $person_name =     $piccsyValidate['DigPerson']['person_name'];
                                        $account_parm1 = $piccsyValidate['DigAccount']['account_parm1'];
                                        $account_parm2 = $piccsyValidate['DigAccount']['account_parm2'];
                                        $account_parm3 = $piccsyValidate['DigAccount']['account_parm3'];
                                         if ($piccsyValidate['DigAccount']['account_profile_url']) 
                                             $account_profile_url = $this->Html->link('Click Here', $piccsyValidate['DigAccount']['account_profile_url'], array('target' => '_blank'));
                                        $DigAccountUsage = $piccsyValidate['DigAccountUsage']['value'];
                                        $Active = $piccsyValidate['DigAccount']['active'];  
                                        $Validate = 'Yes';   
                                        
                                        }
                                        else{
                                            $base_website_url = 'Piccsy';
                                            $status = '';
                                            $id = '';
                                            $person_name = '';
                                            $account_parm1 = '';
                                            $account_parm2 = '';
                                            $account_parm3 = '';
                                            $account_profile_url = '';
                                            $DigAccountUsage = '';
                                            $Active = '';
                                            $Validate = 'No';
                                            $account_base_id = '49'; //Pinterest 
                                        }
                                        
                                
                                        ?>
                                        <tr> 
                                            <td><?php echo $id; ?></td>
                                            <td><?php echo $base_website_url; ?></td>
                                            <td><?php echo $person_name; ?></td>
                                           

                                            <td><?php echo $account_parm1; ?></td>
                                            <td><?php echo $account_parm2; ?></td>
                                            <td><?php echo $account_parm3; ?></td>
                                            <td><?php echo $account_profile_url; ?></td>

                                            <td><?php echo $status; ?></td>
                                            <td><?php echo $DigAccountUsage; ?></td>
                                            <td><?php echo $Active; ?></td>
                                            <td><?php echo $Validate; ?></td>
                                            <td>
                                                <?php
                                                if($Validate == 'No'){                                                
                                                ?>  
                                                <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Account', '/dig_accounts/add_account/'.$person_id.'/'.$account_base_id,array('class' => 'act-ico open-popup-link add-btn', 'escape' => false)) ?></span>
                                                <?php }?>
                                            </td>
                                        </tr>
                                        <?php
                                      
                                       if(count($scoopitValidate))  {
                                           $id = $scoopitValidate['DigAccount']['id'];
                                            
                                        if ($scoopitValidate['DigAccount']['account_status'] == '1')
                                            $status = 'Submitted';
                                        elseif ($scoopitValidate['DigAccount']['account_status'] == '2')
                                            $status = 'Approved';
                                        elseif ($scoopitValidate['DigAccount']['account_status'] == '3')
                                            $status = 'Returned';
                                        elseif ($scoopitValidate['DigAccount']['account_status'] == '4')
                                            $status = 'Change Submitted';
                                        elseif ($scoopitValidate['DigAccount']['account_status'] == '8')
                                            $status = 'De-activated';
                                        
                                        $base_website_url = 'Scoopit';
                                        $person_name =     $scoopitValidate['DigPerson']['person_name'];
                                        $account_parm1 = $scoopitValidate['DigAccount']['account_parm1'];
                                        $account_parm2 = $scoopitValidate['DigAccount']['account_parm2'];
                                        $account_parm3 = $scoopitValidate['DigAccount']['account_parm3'];
                                         if ($scoopitValidate['DigAccount']['account_profile_url']) 
                                             $account_profile_url = $this->Html->link('Click Here', $scoopitValidate['DigAccount']['account_profile_url'], array('target' => '_blank'));
                                        $DigAccountUsage = $scoopitValidate['DigAccountUsage']['value'];
                                        $Active = $scoopitValidate['DigAccount']['active'];  
                                        $Validate = 'Yes';   
                                        
                                        }
                                        else{
                                            $base_website_url = 'Scoopit';
                                            $status = '';
                                            $id = '';
                                            $person_name = '';
                                            $account_parm1 = '';
                                            $account_parm2 = '';
                                            $account_parm3 = '';
                                            $account_profile_url = '';
                                            $DigAccountUsage = '';
                                            $Active = '';
                                            $Validate = 'No';
                                            $account_base_id = '29'; //Pinterest 
                                        }
                                        
                                
                                        ?>
                                        <tr> 
                                            <td><?php echo $id; ?></td>
                                            <td><?php echo $base_website_url; ?></td>
                                            <td><?php echo $person_name; ?></td>
                                           

                                            <td><?php echo $account_parm1; ?></td>
                                            <td><?php echo $account_parm2; ?></td>
                                            <td><?php echo $account_parm3; ?></td>
                                            <td><?php echo $account_profile_url; ?></td>

                                            <td><?php echo $status; ?></td>
                                            <td><?php echo $DigAccountUsage; ?></td>
                                            <td><?php echo $Active; ?></td>
                                            <td><?php echo $Validate; ?></td>
                                            <td>
                                                <?php
                                                if($Validate == 'No'){                                                
                                                ?>  
                                                <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Account', '/dig_accounts/add_account/'.$person_id.'/'.$account_base_id,array('class' => 'act-ico open-popup-link add-btn', 'escape' => false)) ?></span>
                                                <?php }?>
                                            </td>
                                        </tr>
                                        <?php
                                      
                                       if(count($buzznetValidate))  {
                                           $id = $buzznetValidate['DigAccount']['id'];
                                            
                                        if ($buzznetValidate['DigAccount']['account_status'] == '1')
                                            $status = 'Submitted';
                                        elseif ($buzznetValidate['DigAccount']['account_status'] == '2')
                                            $status = 'Approved';
                                        elseif ($buzznetValidate['DigAccount']['account_status'] == '3')
                                            $status = 'Returned';
                                        elseif ($buzznetValidate['DigAccount']['account_status'] == '4')
                                            $status = 'Change Submitted';
                                        elseif ($buzznetValidate['DigAccount']['account_status'] == '8')
                                            $status = 'De-activated';
                                        
                                        $base_website_url = 'Buzznet';
                                        $person_name =     $buzznetValidate['DigPerson']['person_name'];
                                        $account_parm1 = $buzznetValidate['DigAccount']['account_parm1'];
                                        $account_parm2 = $buzznetValidate['DigAccount']['account_parm2'];
                                        $account_parm3 = $buzznetValidate['DigAccount']['account_parm3'];
                                         if ($buzznetValidate['DigAccount']['account_profile_url']) 
                                             $account_profile_url = $this->Html->link('Click Here', $buzznetValidate['DigAccount']['account_profile_url'], array('target' => '_blank'));
                                        $DigAccountUsage = $buzznetValidate['DigAccountUsage']['value'];
                                        $Active = $buzznetValidate['DigAccount']['active'];  
                                        $Validate = 'Yes';   
                                        
                                        }
                                        else{
                                            $base_website_url = 'Buzznet';
                                            $status = '';
                                            $id = '';
                                            $person_name = '';
                                            $account_parm1 = '';
                                            $account_parm2 = '';
                                            $account_parm3 = '';
                                            $account_profile_url = '';
                                            $DigAccountUsage = '';
                                            $Active = '';
                                            $Validate = 'No';
                                            $account_base_id = '50'; //Pinterest 
                                        }
                                        
                                
                                        ?>
                                        <tr> 
                                            <td><?php echo $id; ?></td>
                                            <td><?php echo $base_website_url; ?></td>
                                            <td><?php echo $person_name; ?></td>
                                           

                                            <td><?php echo $account_parm1; ?></td>
                                            <td><?php echo $account_parm2; ?></td>
                                            <td><?php echo $account_parm3; ?></td>
                                            <td><?php echo $account_profile_url; ?></td>

                                            <td><?php echo $status; ?></td>
                                            <td><?php echo $DigAccountUsage; ?></td>
                                            <td><?php echo $Active; ?></td>
                                            <td><?php echo $Validate; ?></td>
                                            <td>
                                                <?php
                                                if($Validate == 'No'){                                                
                                                ?>  
                                                <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Account', '/dig_accounts/add_account/'.$person_id.'/'.$account_base_id,array('class' => 'act-ico open-popup-link add-btn', 'escape' => false)) ?></span>
                                                <?php }?>
                                            </td>
                                        </tr>
                                        <?php
                                      
                                       if(count($tumblrValidate))  {
                                           $id = $tumblrValidate['DigAccount']['id'];
                                            
                                        if ($tumblrValidate['DigAccount']['account_status'] == '1')
                                            $status = 'Submitted';
                                        elseif ($tumblrValidate['DigAccount']['account_status'] == '2')
                                            $status = 'Approved';
                                        elseif ($tumblrValidate['DigAccount']['account_status'] == '3')
                                            $status = 'Returned';
                                        elseif ($tumblrValidate['DigAccount']['account_status'] == '4')
                                            $status = 'Change Submitted';
                                        elseif ($tumblrValidate['DigAccount']['account_status'] == '8')
                                            $status = 'De-activated';
                                        
                                        $base_website_url = 'Tumblr';
                                        $person_name =     $tumblrValidate['DigPerson']['person_name'];
                                        $account_parm1 = $tumblrValidate['DigAccount']['account_parm1'];
                                        $account_parm2 = $tumblrValidate['DigAccount']['account_parm2'];
                                        $account_parm3 = $tumblrValidate['DigAccount']['account_parm3'];
                                         if ($tumblrValidate['DigAccount']['account_profile_url']) 
                                             $account_profile_url = $this->Html->link('Click Here', $tumblrValidate['DigAccount']['account_profile_url'], array('target' => '_blank'));
                                        $DigAccountUsage = $tumblrValidate['DigAccountUsage']['value'];
                                        $Active = $tumblrValidate['DigAccount']['active'];  
                                        $Validate = 'Yes';   
                                        
                                        }
                                        else{
                                            $base_website_url = 'Tumblr';
                                            $status = '';
                                            $id = '';
                                            $person_name = '';
                                            $account_parm1 = '';
                                            $account_parm2 = '';
                                            $account_parm3 = '';
                                            $account_profile_url = '';
                                            $DigAccountUsage = '';
                                            $Active = '';
                                            $Validate = 'No';
                                            $account_base_id = '51'; //Pinterest 
                                        }
                                        
                                
                                        ?>
                                        <tr> 
                                            <td><?php echo $id; ?></td>
                                            <td><?php echo $base_website_url; ?></td>
                                            <td><?php echo $person_name; ?></td>
                                           

                                            <td><?php echo $account_parm1; ?></td>
                                            <td><?php echo $account_parm2; ?></td>
                                            <td><?php echo $account_parm3; ?></td>
                                            <td><?php echo $account_profile_url; ?></td>

                                            <td><?php echo $status; ?></td>
                                            <td><?php echo $DigAccountUsage; ?></td>
                                            <td><?php echo $Active; ?></td>
                                            <td><?php echo $Validate; ?></td>
                                            <td>
                                                <?php
                                                if($Validate == 'No'){                                                
                                                ?>  
                                                <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Account', '/dig_accounts/add_account/'.$person_id.'/'.$account_base_id,array('class' => 'act-ico open-popup-link add-btn', 'escape' => false)) ?></span>
                                                <?php }?>
                                            </td>
                                        </tr>
                                        <?php
                                      
                                       if(count($diigoValidate))  {
                                           $id = $diigoValidate['DigAccount']['id'];
                                            
                                        if ($diigoValidate['DigAccount']['account_status'] == '1')
                                            $status = 'Submitted';
                                        elseif ($diigoValidate['DigAccount']['account_status'] == '2')
                                            $status = 'Approved';
                                        elseif ($diigoValidate['DigAccount']['account_status'] == '3')
                                            $status = 'Returned';
                                        elseif ($diigoValidate['DigAccount']['account_status'] == '4')
                                            $status = 'Change Submitted';
                                        elseif ($diigoValidate['DigAccount']['account_status'] == '8')
                                            $status = 'De-activated';
                                        
                                        $base_website_url = 'Diigo';
                                        $person_name =     $diigoValidate['DigPerson']['person_name'];
                                        $account_parm1 = $diigoValidate['DigAccount']['account_parm1'];
                                        $account_parm2 = $diigoValidate['DigAccount']['account_parm2'];
                                        $account_parm3 = $diigoValidate['DigAccount']['account_parm3'];
                                         if ($diigoValidate['DigAccount']['account_profile_url']) 
                                             $account_profile_url = $this->Html->link('Click Here', $diigoValidate['DigAccount']['account_profile_url'], array('target' => '_blank'));
                                        $DigAccountUsage = $diigoValidate['DigAccountUsage']['value'];
                                        $Active = $diigoValidate['DigAccount']['active'];  
                                        $Validate = 'Yes';   
                                        
                                        }
                                        else{
                                            $base_website_url = 'Diigo';
                                            $status = '';
                                            $id = '';
                                            $person_name = '';
                                            $account_parm1 = '';
                                            $account_parm2 = '';
                                            $account_parm3 = '';
                                            $account_profile_url = '';
                                            $DigAccountUsage = '';
                                            $Active = '';
                                            $Validate = 'No';
                                            $account_base_id = '30'; //Pinterest 
                                        }
                                        
                                
                                        ?>
                                        <tr> 
                                            <td><?php echo $id; ?></td>
                                            <td><?php echo $base_website_url; ?></td>
                                            <td><?php echo $person_name; ?></td>
                                           

                                            <td><?php echo $account_parm1; ?></td>
                                            <td><?php echo $account_parm2; ?></td>
                                            <td><?php echo $account_parm3; ?></td>
                                            <td><?php echo $account_profile_url; ?></td>

                                            <td><?php echo $status; ?></td>
                                            <td><?php echo $DigAccountUsage; ?></td>
                                            <td><?php echo $Active; ?></td>
                                            <td><?php echo $Validate; ?></td>
                                            <td>
                                                <?php
                                                if($Validate == 'No'){                                                
                                                ?>  
                                                <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Account', '/dig_accounts/add_account/'.$person_id.'/'.$account_base_id,array('class' => 'act-ico open-popup-link add-btn', 'escape' => false)) ?></span>
                                                <?php }?>
                                            </td>
                                        </tr>
                                        <?php
                                      
                                       if(count($behanceValidate))  {
                                           $id = $behanceValidate['DigAccount']['id'];
                                            
                                        if ($behanceValidate['DigAccount']['account_status'] == '1')
                                            $status = 'Submitted';
                                        elseif ($behanceValidate['DigAccount']['account_status'] == '2')
                                            $status = 'Approved';
                                        elseif ($behanceValidate['DigAccount']['account_status'] == '3')
                                            $status = 'Returned';
                                        elseif ($behanceValidate['DigAccount']['account_status'] == '4')
                                            $status = 'Change Submitted';
                                        elseif ($behanceValidate['DigAccount']['account_status'] == '8')
                                            $status = 'De-activated';
                                        
                                        $base_website_url = 'Behance';
                                        $person_name =     $behanceValidate['DigPerson']['person_name'];
                                        $account_parm1 = $behanceValidate['DigAccount']['account_parm1'];
                                        $account_parm2 = $behanceValidate['DigAccount']['account_parm2'];
                                        $account_parm3 = $behanceValidate['DigAccount']['account_parm3'];
                                         if ($behanceValidate['DigAccount']['account_profile_url']) 
                                             $account_profile_url = $this->Html->link('Click Here', $behanceValidate['DigAccount']['account_profile_url'], array('target' => '_blank'));
                                        $DigAccountUsage = $behanceValidate['DigAccountUsage']['value'];
                                        $Active = $behanceValidate['DigAccount']['active'];  
                                        $Validate = 'Yes';   
                                        
                                        }
                                        else{
                                            $base_website_url = 'Behance';
                                            $status = '';
                                            $id = '';
                                            $person_name = '';
                                            $account_parm1 = '';
                                            $account_parm2 = '';
                                            $account_parm3 = '';
                                            $account_profile_url = '';
                                            $DigAccountUsage = '';
                                            $Active = '';
                                            $Validate = 'No';
                                            $account_base_id = '52'; //Pinterest 
                                        }
                                        
                                
                                        ?>
                                        <tr> 
                                            <td><?php echo $id; ?></td>
                                            <td><?php echo $base_website_url; ?></td>
                                            <td><?php echo $person_name; ?></td>
                                           

                                            <td><?php echo $account_parm1; ?></td>
                                            <td><?php echo $account_parm2; ?></td>
                                            <td><?php echo $account_parm3; ?></td>
                                            <td><?php echo $account_profile_url; ?></td>

                                            <td><?php echo $status; ?></td>
                                            <td><?php echo $DigAccountUsage; ?></td>
                                            <td><?php echo $Active; ?></td>
                                            <td><?php echo $Validate; ?></td>
                                            <td>
                                                <?php
                                                if($Validate == 'No'){                                                
                                                ?>  
                                                <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Account', '/dig_accounts/add_account/'.$person_id.'/'.$account_base_id,array('class' => 'act-ico open-popup-link add-btn', 'escape' => false)) ?></span>
                                                <?php }?>
                                            </td>
                                        </tr>
                                        <?php
                                      
                                       if(count($googleplValidate))  {
                                           $id = $googleplValidate['DigAccount']['id'];
                                            
                                        if ($googleplValidate['DigAccount']['account_status'] == '1')
                                            $status = 'Submitted';
                                        elseif ($googleplValidate['DigAccount']['account_status'] == '2')
                                            $status = 'Approved';
                                        elseif ($googleplValidate['DigAccount']['account_status'] == '3')
                                            $status = 'Returned';
                                        elseif ($googleplValidate['DigAccount']['account_status'] == '4')
                                            $status = 'Change Submitted';
                                        elseif ($googleplValidate['DigAccount']['account_status'] == '8')
                                            $status = 'De-activated';
                                        
                                        $base_website_url = 'Google Plus';
                                        $person_name =     $googleplValidate['DigPerson']['person_name'];
                                        $account_parm1 = $googleplValidate['DigAccount']['account_parm1'];
                                        $account_parm2 = $googleplValidate['DigAccount']['account_parm2'];
                                        $account_parm3 = $googleplValidate['DigAccount']['account_parm3'];
                                         if ($googleplValidate['DigAccount']['account_profile_url']) 
                                             $account_profile_url = $this->Html->link('Click Here', $googleplValidate['DigAccount']['account_profile_url'], array('target' => '_blank'));
                                        $DigAccountUsage = $googleplValidate['DigAccountUsage']['value'];
                                        $Active = $googleplValidate['DigAccount']['active'];  
                                        $Validate = 'Yes';   
                                        
                                        }
                                        else{
                                            $base_website_url = 'Google Plus';
                                            $status = '';
                                            $id = '';
                                            $person_name = '';
                                            $account_parm1 = '';
                                            $account_parm2 = '';
                                            $account_parm3 = '';
                                            $account_profile_url = '';
                                            $DigAccountUsage = '';
                                            $Active = '';
                                            $Validate = 'No';
                                            $account_base_id = '1'; //Pinterest 
                                        }
                                        
                                
                                        ?>
                                        <tr> 
                                            <td><?php echo $id; ?></td>
                                            <td><?php echo $base_website_url; ?></td>
                                            <td><?php echo $person_name; ?></td>
                                           

                                            <td><?php echo $account_parm1; ?></td>
                                            <td><?php echo $account_parm2; ?></td>
                                            <td><?php echo $account_parm3; ?></td>
                                            <td><?php echo $account_profile_url; ?></td>

                                            <td><?php echo $status; ?></td>
                                            <td><?php echo $DigAccountUsage; ?></td>
                                            <td><?php echo $Active; ?></td>
                                            <td><?php echo $Validate; ?></td>
                                            <td>
                                                <?php
                                                if($Validate == 'No'){                                                
                                                ?>  
                                                <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Account', '/dig_accounts/add_account/'.$person_id.'/'.$account_base_id,array('class' => 'act-ico open-popup-link add-btn', 'escape' => false)) ?></span>
                                                <?php }?>
                                            </td>
                                        </tr>
                                    
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="col-sm-12 validate" style="display:none">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <span class="validate_txt">Profile Picture Uploaded?</span>
                            <span class="colon">:</span>
                            <div class="col-sm-5 validate_icon">
                                <?php
                                if ($this->request->data['DigPerson']['person_profile_picture'] == 'Yes') {
                                    echo '<span class="glyphicon glyphicon-ok"></span>';
                                    $flag .='1';
                                }
                                else
                                    echo '<span class="glyphicon glyphicon-ban-circle"></span>';
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="validate_txt">Bio Uploaded?</span>
                            <span class="colon">:</span>
                            <div class="col-sm-5 validate_icon">
                                <?php
                                if ($this->request->data['DigPerson']['person_bio'] == 'Yes') {
                                    echo '<span class="glyphicon glyphicon-ok"></span>';
                                    $flag .='2';
                                } else {
                                    echo '<span class="glyphicon glyphicon-ban-circle"></span>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="validate_txt">Credentials Uploaded?&nbsp;<span class="icon-info-sign" title="Email,UserName,Email Credential,User Credential" data-toggle ='tooltip' data-placement="right" style="font-size: 15px;"></span></span>
                            <span class="colon">:</span>
                            <div class="col-sm-5 validate_icon">
                                <?php
                                if ($this->data['DigPerson']['person_email_parm'] == '' || $this->data['DigPerson']['person_email'] == '' || $this->data['DigPerson']['person_user'] == '' || $this->data['DigPerson']['person_user_parm'] == '') {
                                    echo '<span class="glyphicon glyphicon-ban-circle"></span>';
                                } else {
                                    echo '<span class="glyphicon glyphicon-ok"></span>';
                                    $flag .='3';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="validate_txt">Has a Validated Twitter A/C?</span>
                            <span class="colon">:</span>
                            <div class="col-sm-5 validate_icon">
                                <?php
                                if (count($twitterValidate) > 0) {
                                    echo '<span class="glyphicon glyphicon-ok"></span>';
                                    $flag .='4';
                                } else {
                                    echo '<span class="glyphicon glyphicon-ban-circle"></span>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="validate_txt">Has a Validated Pinterest A/C?</span>
                            <span class="colon">:</span>
                            <div class="col-sm-5 validate_icon">
                                <?php
                                if (count($pinterestValidate) > 0) {
                                    echo '<span class="glyphicon glyphicon-ok"></span>';
                                    $flag .='5';
                                } else {
                                    echo '<span class="glyphicon glyphicon-ban-circle"></span>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="validate_txt">Has a Validated Facebook A/C?</span>
                            <span class="colon">:</span>
                            <div class="col-sm-5 validate_icon">
                                <?php
                                if (count($pinterestValidate) > 0) {
                                    echo '<span class="glyphicon glyphicon-ok"></span>';
                                    $flag .='6';
                                } else {
                                    echo '<span class="glyphicon glyphicon-ban-circle"></span>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="validate_txt">Has a Validated LinkedIn A/C?</span>
                            <span class="colon">:</span>
                            <div class="col-sm-5 validate_icon">
                                <?php
                                if (count($pinterestValidate) > 0) {
                                    echo '<span class="glyphicon glyphicon-ok"></span>';
                                    $flag .='7';
                                } else {
                                    echo '<span class="glyphicon glyphicon-ban-circle"></span>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="validate_txt">Has a Validated Muzy A/C?</span>
                            <span class="colon">:</span>
                            <div class="col-sm-5 validate_icon">
                                <?php
                                if (count($muzyValidate) > 0) {
                                    echo '<span class="glyphicon glyphicon-ok"></span>';
                                    $flag .='8';
                                } else {
                                    echo '<span class="glyphicon glyphicon-ban-circle"></span>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="validate_txt">Has a Validated Newsvine A/C?</span>
                            <span class="colon">:</span>
                            <div class="col-sm-5 validate_icon">
                                <?php
                                if (count($newsvineValidate) > 0) {
                                    echo '<span class="glyphicon glyphicon-ok"></span>';
                                    $flag .='9';
                                } else {
                                    echo '<span class="glyphicon glyphicon-ban-circle"></span>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="validate_txt">Has a Validated Skyrock A/C?</span>
                            <span class="colon">:</span>
                            <div class="col-sm-5 validate_icon">
                                <?php
                                if (count($skyrockValidate) > 0) {
                                    echo '<span class="glyphicon glyphicon-ok"></span>';
                                    $flag .='10';
                                } else {
                                    echo '<span class="glyphicon glyphicon-ban-circle"></span>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="validate_txt">Has a Validated WeHeartIt A/C?</span>
                            <span class="colon">:</span>
                            <div class="col-sm-5 validate_icon">
                                <?php
                                if (count($weheartitValidate) > 0) {
                                    echo '<span class="glyphicon glyphicon-ok"></span>';
                                    $flag .='11';
                                } else {
                                    echo '<span class="glyphicon glyphicon-ban-circle"></span>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="validate_txt">Has a Validated Plurk A/C?</span>
                            <span class="colon">:</span>
                            <div class="col-sm-5 validate_icon">
                                <?php
                                if (count($plurkValidate) > 0) {
                                    echo '<span class="glyphicon glyphicon-ok"></span>';
                                    $flag .='12';
                                } else {
                                    echo '<span class="glyphicon glyphicon-ban-circle"></span>';
                                }
                                ?>
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <span class="validate_txt">Has a Validated Fancy A/C?</span>
                            <span class="colon">:</span>
                            <div class="col-sm-5 validate_icon">
                                <?php
                                if (count($fancyValidate) > 0) {
                                    echo '<span class="glyphicon glyphicon-ok"></span>';
                                    $flag .='13';
                                } else {
                                    echo '<span class="glyphicon glyphicon-ban-circle"></span>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="validate_txt">Has a Validated Pusha A/C?</span>
                            <span class="colon">:</span>
                            <div class="col-sm-5 validate_icon">
                                <?php
                                if (count($pushaValidate) > 0) {
                                    echo '<span class="glyphicon glyphicon-ok"></span>';
                                    $flag .='14';
                                } else {
                                    echo '<span class="glyphicon glyphicon-ban-circle"></span>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="validate_txt">Has a Validated Visualize A/C?</span>
                            <span class="colon">:</span>
                            <div class="col-sm-5 validate_icon">
                                <?php
                                if (count($visualizeValidate) > 0) {
                                    echo '<span class="glyphicon glyphicon-ok"></span>';
                                    $flag .='15';
                                } else {
                                    echo '<span class="glyphicon glyphicon-ban-circle"></span>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="validate_txt">Has a Validated Piccsy A/C?</span>
                            <span class="colon">:</span>
                            <div class="col-sm-5 validate_icon">
                                <?php
                                if (count($piccsyValidate) > 0) {
                                    echo '<span class="glyphicon glyphicon-ok"></span>';
                                    $flag .='16';
                                } else {
                                    echo '<span class="glyphicon glyphicon-ban-circle"></span>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="validate_txt">Has a Validated ScoopIt A/C?</span>
                            <span class="colon">:</span>
                            <div class="col-sm-5 validate_icon">
                                <?php
                                if (count($scoopitValidate) > 0) {
                                    echo '<span class="glyphicon glyphicon-ok"></span>';
                                    $flag .='17';
                                } else {
                                    echo '<span class="glyphicon glyphicon-ban-circle"></span>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="validate_txt">Has a Validated Buzznet A/C?</span>
                            <span class="colon">:</span>
                            <div class="col-sm-5 validate_icon">
                                <?php
                                if (count($buzznetValidate) > 0) {
                                    echo '<span class="glyphicon glyphicon-ok"></span>';
                                    $flag .='18';
                                } else {
                                    echo '<span class="glyphicon glyphicon-ban-circle"></span>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="validate_txt">Has a Validated Tumblr A/C?</span>
                            <span class="colon">:</span>
                            <div class="col-sm-5 validate_icon">
                                <?php
                                if (count($tumblrValidate) > 0) {
                                    echo '<span class="glyphicon glyphicon-ok"></span>';
                                    $flag .='19';
                                } else {
                                    echo '<span class="glyphicon glyphicon-ban-circle"></span>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="validate_txt">Has a Validated Diigo A/C?</span>
                            <span class="colon">:</span>
                            <div class="col-sm-5 validate_icon">
                                <?php
                                if (count($diigoValidate) > 0) {
                                    echo '<span class="glyphicon glyphicon-ok"></span>';
                                    $flag .='20';
                                } else {
                                    echo '<span class="glyphicon glyphicon-ban-circle"></span>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="validate_txt">Has a Validated Behance A/C?</span>
                            <span class="colon">:</span>
                            <div class="col-sm-5 validate_icon">
                                <?php
                                if (count($behanceValidate) > 0) {
                                    echo '<span class="glyphicon glyphicon-ok"></span>';
                                    $flag .='21';
                                } else {
                                    echo '<span class="glyphicon glyphicon-ban-circle"></span>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="validate_txt">Has a Validated Google+ A/C?</span>
                            <span class="colon">:</span>
                            <div class="col-sm-5 validate_icon">
                                <?php
                                if (count($googleplValidate) > 0) {
                                    echo '<span class="glyphicon glyphicon-ok"></span>';
                                    $flag .='22';
                                } else {
                                    echo '<span class="glyphicon glyphicon-ban-circle"></span>';
                                }
                                ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="validate_txt">Usage Status Currently Using / Validated?</span>
                            <span class="colon">:</span>
                            <div class="col-sm-5 validate_icon">
                                <?php
                                if ($this->request->data['DigPerson']['person_usage_status'] == '1' || $this->request->data['DigPerson']['person_usage_status'] == '9') {
                                    echo '<span class="glyphicon glyphicon-ok"></span>';
                                    $flag.='23';
                                }
                                else
                                    echo '<span class="glyphicon glyphicon-ban-circle"></span>';
                                ?>
                            </div>
                        </div>
                    </div>
                    <div style="clear:both"></div>
                    <div class="form_submit clearfix">
                        <div class="row">
                            <div class="col-sm-1">
<?php
if ($flag == '1234567891011121314151617181920212223')
    echo $this->Form->submit('Validate', array('class' => 'btn btn-success sticky_success', 'name' => 'Validate'));
elseif ($account_usage_status == '9')
    echo $this->Form->submit('Unvalidate', array('class' => 'btn btn-success sticky_success', 'name' => 'Unvalidate'));
?>
                            </div>                   
                        </div>
                    </div>

                </div>               

                <div class="col-sm-12 edit" style="display:none">                
                    <div class="col-sm-6">


                        <div class="form-group">
                            <label for="reg_input_name" class="req">Person Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
<?php
echo $this->Form->input('person_name', array('data-required' => 'true', 'tabindex' => '1'));
?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Location</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
<?php
echo $this->Form->input('person_location', array('options' => $codes, 'empty' => '--Select--', 'data-required' => 'true', 'tabindex' => '3'));
?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Used By (Team)</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
echo $this->Form->input('person_used_by_team', array('options' => $DigPersonUsedByTeams, 'empty' => '--Select--', 'data-required' => 'true', 'tabindex' => '5'));
?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Profile Type</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
echo $this->Form->input('person_profile_type', array('options' => $DigPersonProfileTypes, 'empty' => '--Select--', 'tabindex' => '7'));
?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Active?</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
echo $this->Form->input('active', array('options' => array('TRUE' => 'TRUE', 'FALSE' => 'FALSE'), 'empty' => '--Select--', 'tabindex' => '9'));
?></div>
                        </div>





                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Type</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
echo $this->Form->input('person_type', array('options' => $DigPersonTypes, 'empty' => '--Select--', 'data-required' => 'true', 'tabindex' => '2'));
?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Industry</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
echo $this->Form->input('person_industry', array('options' => $DigPersonIndustries, 'empty' => '--Select--', 'data-required' => 'true', 'tabindex' => '4'));
?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Used By (Person)</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
echo $this->Form->input('person_used_by_person', array('options' => $DigPersonUsedByPersons, 'empty' => '--Select--', 'data-required' => 'true', 'tabindex' => '6'));
?></div>
                        </div>





                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="reg_input_name" style="margin-left: 14px">Instructions</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
<?php
echo $this->Form->input('person_instructions', array('type' => 'textarea', 'style' => 'width:122%;height:100px', 'tabindex' => '14'));
?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" style="margin-left: 14px">Comment</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
<?php
echo $this->Form->input('person_comment', array('type' => 'textarea', 'style' => 'width:122%;height:100px', 'tabindex' => '15'));
?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" style="margin-left: 14px">Description</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
<?php
echo $this->Form->input('person_description', array('type' => 'textarea', 'style' => 'width:122%;height:100px', 'tabindex' => '16'));
?></div>
                        </div>




                    </div>

                    <div class="form_submit clearfix">
                        <div class="row">
                            <div class="col-sm-1">
<?php
echo $this->Form->submit('Update', array('class' => 'btn btn-success sticky_success'));
?>
                            </div>                   
                        </div>
                    </div>
                    <div class="form_submit clearfix">
                        <div class="row">
                            <div class="col-sm-1">
<?php
echo $this->Form->submit('Update', array('class' => 'btn btn-success sticky_success'));
?>
                            </div>                   
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>
<?php echo $this->Form->end(); ?>

<script>



    $('#DigPersonActionType').change(function() {
        var value = $(this).val();

        if (value == '1') { //update 
            $('.update').css('display', 'block');
            $('.validate').css('display', 'none');
            $('.edit').css('display', 'none');

        }
        else if (value == '2') { //update 
            $('.validate').css('display', 'block');
            $('.update').css('display', 'none');
            $('.edit').css('display', 'none');

        }
        else if (value == '3') { //edit 
            $('.edit').css('display', 'block');
            $('.validate').css('display', 'none');
            $('.update').css('display', 'none');

        }


    });

</script>


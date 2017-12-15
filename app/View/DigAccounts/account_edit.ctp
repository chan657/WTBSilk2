<?php
$this->Html->addCrumb('Twitter Account Information', 'javascript:void(0);', array('class' => 'breadcrumblast'));
//pr($this->data);
?>
<?php
echo $this->Form->create('DigAccount', array('method' => 'post', 'class' => 'form-horizontal user_form', 'id' => 'parsley_reg', 'novalidate' => true,
    'inputDefaults' => array(
        'label' => false,
        'div' => false,
        'class' => 'form-control',
    )
));
if ($action_type == '1') { // Update
    $Update = 'display:block';
    $Validate = 'display:none';
    $Edit = 'display:none';
} elseif ($action_type == '2') { // Validate
    $Validate = 'display:block';
} elseif ($action_type == '3') { // Edit
    $Edit = 'display:block';
} else {
    $Update = 'display:none';
    $Validate = 'display:none';
    $Edit = 'display:none';
}

$flag = '';
$account_usage_status = $this->data['DigAccount']['account_usage_status'];
if ($account_usage_status <> '9')
    $disabled = array('3', '4');
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
<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Twitter Account Information</h4>

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
echo $this->Form->input('action_type', array('options' => array('2' => 'Validate', '1' => 'Update', '4' => 'Interact', '3' => 'Edit'), 'empty' => '--Select--', 'data-required' => 'true', 'tabindex' => '1', 'disabled' => $disabled));
?></div>
                        </div>

                    </div>

                </div>
                <div style="clear:both"></div>
                <div class="col-sm-12 update" style="<?php echo $Update; ?>">
                    <div class="col-sm-12" style="background-color: rgb(206, 228, 245);overflow:hidden;">
                        <div class="col-sm-6">    
                            <h4>Account Statistics (As Per Your Last Update)</h4>
                            <div class="form-group">
                                <label for="reg_input_name" class="req">Person Name    </label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <p class="form-control-static"><?php echo $this->data['DigPerson']['person_name']; ?></p>

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="reg_input_name">Industry</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <p class="form-control-static"><?php echo $this->data['DigAccountIndustry']['value']; ?></p>

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
                                <label>Followers</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <p class="form-control-static"><?php echo $this->data['DigAccount']['total_followers']; ?></p>

                                </div>
                            </div>
                            <div class="form-group">
                                <label>Usage Status</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <p class="form-control-static"><?php echo $this->data['DigAccountUsage']['value']; ?></p>

                                </div>
                            </div>
                            <div class="form-group">
                                <label>Bio?</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <p class="form-control-static"><?php echo $this->data['DigAccount']['bio_added']; ?></p>

                                </div>
                            </div>
                            <div class="form-group">
                                <label>Profile URL</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <p class="form-control-static"><?php echo $this->data['DigAccount']['account_profile_url']; ?></p>

                                </div>
                            </div>


                        </div>  
                        <div class="col-sm-6">
                            <h4>&nbsp;</h4>
                            <div class="form-group">
                                <label>Geography</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <p class="form-control-static"><?php echo $this->data['Geography']['value']; ?></p>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="req">Login Email</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10 editable">
                                    <p class="form-control-static"><?php echo $this->data['DigPerson']['person_email']; ?></p>

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="req">Credential</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <p class="form-control-static"><?php echo $this->data['DigPerson']['person_email_parm']; ?></p>

                                </div>
                            </div>
                            <div class="form-group">
                                <label>Following</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <p class="form-control-static"><?php echo $this->data['DigAccount']['total_following']; ?></p>

                                </div>
                            </div>
                            <div class="form-group">
                                <label>Profile Picture?</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <p class="form-control-static"><?php echo $this->data['DigAccount']['profile_pic_uploaded']; ?></p>

                                </div>
                            </div>
                            <div class="form-group">
                                <label>Last Update Date</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <p class="form-control-static"><?php echo $this->data['DigAccount']['last_updated_date']; ?></p>

                                </div>
                            </div>

                            <div class="form-group">
                                <label>Public URL</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <p class="form-control-static"><?php echo $this->data['DigAccount']['account_public_url']; ?></p>

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
echo $this->Form->input('account_parm1');
?></div>
                            </div>
                            <div class="form-group">
                                <label for="reg_input_name">Credential</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <?php
                                    echo $this->Form->input('account_parm3');
                                    ?></div>
                            </div>
                            <div class="form-group">
                                <label for="reg_input_name" class="req">Added Picture?</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <?php
                                    echo $this->Form->input('profile_pic_uploaded', array('options' => array('Yes' => 'Yes', 'No' => 'No'), 'empty' => '--Select--', 'data-required' => 'true', 'tabindex' => '1'));
                                    ?></div>
                            </div>
                            <div class="form-group">
                                <label for="reg_input_name">Profile Url</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <?php
                                    echo $this->Form->input('account_profile_url');
                                    ?></div>
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

if ($this->data['DigPerson']['upload_picture']) {    
    $logo_image2 = $imagePath . '/' . $this->data['DigPerson']['upload_picture'];
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
                                <label for="reg_input_name" class="req">User</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
<?php
echo $this->Form->input('account_parm2');
?></div>
                            </div>
                            <div class="form-group">
                                <label for="reg_input_name" class="req">Usage Status</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <?php
                                    echo $this->Form->input('account_usage_status', array('options' => $DigAccountUsages, 'empty' => '--Select--', 'data-required' => 'true', 'tabindex' => '2', 'disabled' => $usage_options));
                                    ?></div>
                            </div>
                            <div class="form-group">
                                <label for="reg_input_name" class="req">Added Bio?</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <?php
                                    echo $this->Form->input('bio_added', array('options' => array('Yes' => 'Yes', 'No' => 'No'), 'empty' => '--Select--', 'data-required' => 'true', 'tabindex' => '2'));
                                    ?></div>
                            </div>
                            <div class="form-group">
                                <label for="reg_input_name">Public Url</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <?php
                                    echo $this->Form->input('account_public_url');
                                    ?></div>
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
                <div class="col-sm-12 validate" style="<?php echo $Validate; ?>">
                    <div class="form-group">
                        <span class="validate_txt">Profile Picture Uploaded?</span>
                        <span class="colon">:</span>
                        <div class="col-sm-5 validate_icon">
<?php
if ($this->request->data['DigAccount']['profile_pic_uploaded'] == 'Yes') {
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
                            if ($this->request->data['DigAccount']['bio_added'] == 'Yes') {
                                echo '<span class="glyphicon glyphicon-ok"></span>';
                                $flag .='2';
                            } else {
                                echo '<span class="glyphicon glyphicon-ban-circle"></span>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <span class="validate_txt">Credentials Uploaded?&nbsp;<span class="icon-info-sign" title="Email,UserName,Credential" data-toggle ='tooltip' data-placement="right" style="font-size: 15px;"></span></span>
                        <span class="colon">:</span>
                        <div class="col-sm-5 validate_icon">
                            <?php
                            if ($this->data['DigAccount']['account_parm1'] == '' || $this->data['DigAccount']['account_parm2'] == '' || $this->data['DigAccount']['account_parm3'] == '') {
                                echo '<span class="glyphicon glyphicon-ban-circle"></span>';
                            } else {
                                echo '<span class="glyphicon glyphicon-ok"></span>';
                                $flag .='3';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <span class="validate_txt">Profile Url Uploaded?</span>
                        <span class="colon">:</span>
                        <div class="col-sm-5 validate_icon">
                            <?php
                            if ($this->request->data['DigAccount']['account_profile_url'] == '') {
                                echo '<span class="glyphicon glyphicon-ban-circle"></span>';
                            } else {
                                echo '<span class="glyphicon glyphicon-ok"></span>';
                                $flag.='4';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <span class="validate_txt">Public Url Uploaded?</span>
                        <span class="colon">:</span>
                        <div class="col-sm-5 validate_icon">
                            <?php
                            if ($this->request->data['DigAccount']['account_public_url'] == '') {
                                echo '<span class="glyphicon glyphicon-ban-circle"></span>';
                            } else {
                                echo '<span class="glyphicon glyphicon-ok"></span>';
                                $flag.='5';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <span class="validate_txt">Profile Url Equals to Public Url?</span>
                        <span class="colon">:</span>
                        <div class="col-sm-5 validate_icon">
                            <?php
                            if ($this->request->data['DigAccount']['account_public_url'] == $this->request->data['DigAccount']['account_profile_url']) {
                                echo '<span class="glyphicon glyphicon-ok"></span>';
                                $flag.='6';
                            }
                            else
                                echo '<span class="glyphicon glyphicon-ban-circle"></span>';
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <span class="validate_txt">Usage Status Currently Using / Validated?</span>
                        <span class="colon">:</span>
                        <div class="col-sm-5 validate_icon">
                            <?php
                            if ($this->request->data['DigAccount']['account_usage_status'] == '1' || $this->request->data['DigAccount']['account_usage_status'] == '9') {
                                echo '<span class="glyphicon glyphicon-ok"></span>';
                                $flag.='7';
                            }
                            else
                                echo '<span class="glyphicon glyphicon-ban-circle"></span>';
                            ?>
                        </div>
                    </div>
                    <div class="form_submit clearfix">
                        <div class="row">
                            <div class="col-sm-1">
                            <?php
                            if ($flag == '1234567')
                                echo $this->Form->submit('Validate', array('class' => 'btn btn-success sticky_success', 'name' => 'Validate'));
                            elseif ($account_usage_status == '9')
                                echo $this->Form->submit('Unvalidate', array('class' => 'btn btn-success sticky_success', 'name' => 'Unvalidate'));
                            ?>
                            </div>                   
                        </div>
                    </div>

                </div>
                <div class="col-sm-12 interact" style="display:none">
                    <div class="col-sm-12">            


                        <div class="panel-group" id="accordion1" style="margin-bottom:20px;">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title fpt">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#acc1_collapseOne">
                                            Today's Peer List to Follow
                                            <span class="icon-angle-left"></span>
                                        </a>
                                    </h4>
                                </div>
                                <div id="acc1_collapseOne" class="panel-collapse collapse">
                                    <div class="form-group">

                                        <div class="col-sm-12 editable">

                                            <div class="form-control-static">
                                                <div class="table-heading disimp">
                                                    <h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php echo count($AllDigAccounts); ?></span>List to Follow </h4></div>
                                                <table border="0" cellpadding="0" cellspacing="0" id="resp_table" class="table toggle-square myclitb" data-filter="#table_search" data-page-size="100">
                                                    <tr>
                                                        <th data-toggle="true"><input type="checkbox" onclick="checkedAll('parsley_reg')" /></th>
                                                        <th data-toggle="phone">Person Name</th>
                                                        <th data-hide="phone">Geography</th>
                                                        <th data-hide="phone">Industry</th>
                                                        <th data-hide="phone">Profile URL</th>
                                                        <th data-hide="phone">Following Me?</th>
                                                        <th data-hide="phone">I am Following?</th>

                                                    </tr>
<?php
//   pr($AllDigAccounts);
if (count($AllDigAccounts)) {

    foreach ($AllDigAccounts as $DigAccount) {
        ?>
                                                            <tr>
                                                                <td>
        <?php
        $followed_by = $this->request->data['DigAccount']['id'];
        $following_id = $DigAccount['DigAccount']['id'];
        $account_type = '1'; //lookup_account_types
        $options = array('value' => $followed_by . '_' . $following_id . '_' . $account_type, 'name' => 'data[DigAccount][relation][]', 'hiddenField' => false);
        $attributes = array('legend' => false, 'label' => false, 'div' => false);
        echo $this->Form->checkbox('relation', $options, $attributes);
        ?>                                

                                                                </td>
                                                                <td><?php echo $DigAccount['DigPerson']['person_name']; ?></td>
                                                                <td><?php echo $DigAccount['Geography']['value']; ?></td>
                                                                <td><?php echo $DigAccount['DigAccountIndustry']['value']; ?></td>
                                                                <td><?php if ($DigAccount['DigAccount']['account_profile_url']) echo $this->Html->link('Click Here', $DigAccount['DigAccount']['account_profile_url'], array('target' => '_blank')); ?></td>
                                                                <td><?php
                                                                    if (array_key_exists($following_id, $Following))
                                                                        echo 'Yes';
                                                                    else
                                                                        echo 'No';
                                                                    ?></td>
                                                                <td><?php echo 'No'; ?></td>                                                                
                                                            </tr>
        <?php
    }
}
?>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="reg_input_name"  class="req">Accepted All Reqs.?</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
<?php
echo $this->Form->input('follow_accepted', array('options' => array('Yes' => 'Yes', 'No' => 'No'), 'empty' => '--Select--', 'data-required' => 'true', 'tabindex' => '3'));
?></div>
                            </div>
                            <div class="form-group">
                                <label for="reg_input_name">Follower</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
<?php
echo $this->Form->input('total_followers', array('tabindex' => '5', 'type' => 'text'));
?></div>
                            </div> 

                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="reg_input_name" class="req">Followed 30 People?</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <?php
                                    echo $this->Form->input('followed_30_people', array('options' => array('Yes' => 'Yes', 'No' => 'No'), 'empty' => '--Select--', 'data-required' => 'true', 'tabindex' => '4'));
                                    ?></div>
                            </div>
                            <div class="form-group">
                                <label for="reg_input_name">Following</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
<?php
echo $this->Form->input('total_following', array('tabindex' => '6', 'class' => 'form-control integer', 'type' => 'text'));
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

                    </div>
                </div>

                <div class="col-sm-12 edit" style="<?php echo $Edit; ?>">                
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
?></div>                        </div>
                        

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
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="reg_input_name">Account Description?</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('account_description', array('type' => 'textarea', 'style' => 'width:122%;height:100px', 'tabindex' => '12'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Account Comment?</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
<?php
echo $this->Form->input('account_usage_comment', array('type' => 'textarea', 'style' => 'width:122%;height:100px', 'tabindex' => '12'));
?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Account Instructions?</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
<?php
echo $this->Form->input('account_instructions', array('type' => 'textarea', 'style' => 'width:122%;height:100px', 'tabindex' => '12'));
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
                                                            $('.accordion-toggle').click(function() {
                                                                $(".accordion-toggle span").toggleClass('icon-angle-up', 'icon-angle-up');
                                                                // $( "span" ).addClass( "icon-angle-up" );        
                                                            });
                                                            checked = false;
                                                            function checkedAll(examform) {
                                                                var aa = document.getElementById('parsley_reg');
                                                                if (checked == false)
                                                                {
                                                                    checked = true
                                                                }
                                                                else
                                                                {
                                                                    checked = false
                                                                }
                                                                for (var i = 0; i < aa.elements.length; i++)
                                                                {
                                                                    aa.elements[i].checked = checked;
                                                                }
                                                            }



                                                            $('#DigAccountActionType').change(function() {
                                                                var value = $(this).val();

                                                                if (value == '1') { //update 
                                                                    $('.update').css('display', 'block');
                                                                    $('.validate').css('display', 'none');
                                                                    $('.edit').css('display', 'none');
                                                                    $('.interact').css('display', 'none');
                                                                }
                                                                else if (value == '2') { //update 
                                                                    $('.validate').css('display', 'block');
                                                                    $('.update').css('display', 'none');
                                                                    $('.edit').css('display', 'none');
                                                                    $('.interact').css('display', 'none');
                                                                }
                                                                else if (value == '3') { //edit 
                                                                    $('.edit').css('display', 'block');
                                                                    $('.validate').css('display', 'none');
                                                                    $('.update').css('display', 'none');
                                                                    $('.interact').css('display', 'none');
                                                                }
                                                                else if (value == '4') { //interact 
                                                                    $('.interact').css('display', 'block');
                                                                    $('.edit').css('display', 'none');
                                                                    $('.validate').css('display', 'none');
                                                                    $('.update').css('display', 'none');
                                                                }

                                                            });

</script>


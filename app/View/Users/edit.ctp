<?php
$this->Html->addCrumb('View / Edit User', 'javascript:void(0);', array('class' => 'breadcrumblast'));
?>
<?php
echo $this->Form->create('User', array('method' => 'post', 'class' => 'form-horizontal user_form',
    'inputDefaults' => array(
        'label' => false,
        'div' => false,
        'class' => 'form-control',
    )
));
if ($this->data['User']['dummy_status'] == '1')
    $status = 'Dummy User';
else
    $status = 'Real User';
?>
<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">View / Edit Information</h4>
            <div class="user_actions pull-right">
                <a href="#" class="edit_form" data-toggle="tooltip" data-placement="top" title="Edit"><span class="icon-edit"></span></a> <a href="#" class="view_form" data-toggle="tooltip" data-placement="top" title="View" style="display: none;"><span class="glyphicon glyphicon-eye-open"></span></a>

            </div>
        </div>

        <div class="panel-body">
            <fieldset>
                <legend><span>View / Edit User</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">

                    <div class="col-sm-6"> 
                        <div class="form-group">
                            <label>User Status</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $status; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('dummy_status', array('options' => array('1' => 'Dummy User', '2' => 'Real User'))); ?>
                                </div>
                            </div>
                        </div>   
                        <div class="form-group">
                            <label>First Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['User']['fname']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('fname'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['User']['lname']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('lname'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Gender</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['User']['sex']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('sex', array('options' => array('M' => 'Male', 'F' => 'Female'), 'empty' => 'Select')); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group slt-sm">
                            <label>Primary Mobile</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['PrimaryCode']['value'] . ': ' . $this->data['PrimaryCode']['code'] . ' ' . $this->data['User']['primary_mobile_number']; ?></p>
                                <div class="hidden_control">
                                    <?php
                                    echo $this->Form->input('primary_country_code', array('options' => $codes, 'default' => '76', 'empty' => '--Select--'));
                                    echo $this->Form->input('primary_mobile_number', array('div' => false, 'class' => 'form-control sm rgt'));
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Personal Email</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['User']['personal_email_id']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('personal_email_id', array('type' => 'email')); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>PAN Card</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['User']['pan_card_number']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('pan_card_number'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Travel Infra Email</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['User']['travel_infra_email']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('travel_infra_email'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Travel S&M Email</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['User']['travel_sale_marketing_email']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('travel_sale_marketing_email'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Home Loans Email</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['User']['home_loan_email']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('home_loan_email'); ?>
                                </div>
                            </div>
                        </div>

                    </div>  
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>City</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['City']['city_name']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('city_id', array('options' => $cities, 'empty' => 'Select')); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Middle Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['User']['mname']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('mname'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Company Email</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['User']['company_email_id']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('company_email_id', array('readonly' => 'readonly', 'type' => 'email')); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group slt-sm">
                            <label>Secondary Mobile</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['SecondaryCode']['value'] . ': ' . $this->data['SecondaryCode']['code'] . ' ' . $this->data['User']['secondary_mobile_number']; ?></p>
                                <div class="hidden_control">
                                    <?php
                                    echo $this->Form->input('secondary_country_code', array('options' => $codes, 'default' => '76', 'empty' => '--Select--'));
                                    echo $this->Form->input('secondary_mobile_number', array('div' => false, 'class' => 'form-control sm rgt'));
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Blackberry Pin</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['User']['blackberry_pin']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('blackberry_pin'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Passport</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['User']['passport_number']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('passport_number'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Skype Id</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['User']['skype_id']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('skype_id', array('type' => 'text')); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>System Email</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['User']['system_email']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('system_email'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Sumanus Email</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['User']['sumanus_email']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('sumanus_email'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Real Estate Email</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['User']['realestate_email']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('realestate_email'); ?>
                                </div>
                            </div>
                        </div>



                    </div>

                    <div style="clear:both"></div>










                </div>
            </div>
            <div class="row" style="clear:both;">
                <div class="col-sm-12">
                    <div class="panel-group" id="accordion2">

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title fpt">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc1_collapseOne">
                                        Channels & Roles set [Real Estate]
                                    </a>
                                </h4>
                            </div>
                            <div id="acc1_collapseOne" class="panel-collapse collapse">
                                <div class="form-group">
                                    <div class="form-control-static"><div class="panel-body">
                                            <div class="col-sm-12">
                                                <div class="form-group">	
                                                    <label class="col-sm-3 control-label blank"></label>

                                                    <div class="col-sm-4">Channel Manager</div>
                                                    <div class="col-sm-4">Role Manager</div>
                                                </div>
                                            </div>  

                                            <?php
                                            //     pr($channels);
                                            if (count($groups)) {
                                                foreach ($groups as $group) {
                                                    ?> 
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label"><?php echo $group['GroupsUser']['name']; ?></label><span class="colon">:</span>
                                                            <div class="col-sm-4">
                                                                <select id="<?php echo $group['GroupsUser']['channel_field']; ?>" name="data[User][<?php echo $group['GroupsUser']['channel_field'] ?>]" class="form-control">
                                                                    <option value="">--Select--</option>
                                                                    <?php
                                                                    foreach ($channels as $channel) {


                                                                        if ($group['GroupsUser']['id'] == $channel['Channel']['channel_role']) {
                                                                            ?>
                                                                            <option value="<?php echo $channel['Channel']['id']; ?>" <?php if (in_array($channel['Channel']['id'], $channel_id)) { ?> selected <?php } ?>><?php echo $channel['Channel']['channel_name']; ?></option>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>


                                                            </div>
                                                            <div class="col-sm-4">
                                                                <select id="<?php echo $group['GroupsUser']['role_field'] ?>" name="data[User][<?php echo $group['GroupsUser']['role_field'] ?>]" class="form-control user_role_bootbox_custom">
                                                                    <option value="">--Select--</option>
                                                                    <?php
                                                                    foreach ($roles as $role) {

                                                                        if ($group['GroupsUser']['id'] == $role['Role']['group_id']) {
                                                                            ?>
                                                                            <option value="<?php echo $role['Role']['id']; ?>" <?php if (in_array($role['Role']['id'], $role_id)) { ?> selected <?php } ?> ><?php echo $role['Role']['role_name']; ?></option>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>	

                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>



                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title fpt">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc1_collapseTwo">
                                        Channels & Roles set [Travel]
                                    </a>
                                </h4>
                            </div>
                            <div id="acc1_collapseTwo" class="panel-collapse collapse">
                                <div class="form-group">
                                    <div class="form-control-static"><div class="panel-body">
                                            <div class="col-sm-12">
                                                <div class="form-group">	
                                                    <label class="col-sm-3 control-label blank"></label>

                                                    <div class="col-sm-4">Channel Manager</div>
                                                    <div class="col-sm-4">Role Manager</div>
                                                </div>
                                            </div>  

                                            <?php
                                            //     pr($channels);
                                            if (count($travel_groups)) {
                                                foreach ($travel_groups as $travel_group) {
                                                    ?> 
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label"><?php echo $travel_group['GroupsUser']['name']; ?></label><span class="colon">:</span>
                                                            <div class="col-sm-4">
                                                                <select id="<?php echo $travel_group['GroupsUser']['channel_field']; ?>" name="data[User][<?php echo $travel_group['GroupsUser']['channel_field'] ?>]" class="form-control">
                                                                    <option value="">--Select--</option>
                                                                    <?php
                                                                    foreach ($channels as $travel_channel) {


                                                                        if ($travel_group['GroupsUser']['id'] == $travel_channel['Channel']['channel_role']) {
                                                                            ?>
                                                                            <option value="<?php echo $travel_channel['Channel']['id']; ?>" <?php if (in_array($travel_channel['Channel']['id'], $channel_id)) { ?> selected <?php } ?>><?php echo $travel_channel['Channel']['channel_name']; ?></option>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>


                                                            </div>
                                                            <div class="col-sm-4">
                                                                <select id="<?php echo $travel_group['GroupsUser']['role_field'] ?>" name="data[User][<?php echo $travel_group['GroupsUser']['role_field'] ?>]" class="form-control user_role_bootbox_custom">
                                                                    <option value="">--Select--</option>
                                                                    <?php
                                                                    foreach ($travel_roles as $travel_role) {

                                                                        if ($travel_group['GroupsUser']['id'] == $travel_role['Role']['group_id']) {
                                                                            ?>
                                                                            <option value="<?php echo $travel_role['Role']['id']; ?>" <?php if (in_array($travel_role['Role']['id'], $role_id)) { ?> selected <?php } ?> ><?php echo $travel_role['Role']['role_name']; ?></option>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>	

                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title fpt">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc1_collapseThree">
                                        Channels & Roles set [Digital Media]
                                    </a>
                                </h4>
                            </div>
                            <div id="acc1_collapseThree" class="panel-collapse collapse">
                                <div class="form-group">
                                    <div class="form-control-static"><div class="panel-body">
                                            <div class="col-sm-12">
                                                <div class="form-group">	
                                                    <label class="col-sm-3 control-label blank"></label>

                                                    <div class="col-sm-4">Channel Manager</div>
                                                    <div class="col-sm-4">Role Manager</div>
                                                </div>
                                            </div>  

                                            <?php
                                              //   pr($digital_groups);
                                              //   pr($channels);
                                            if (count($digital_groups)) {
                                                foreach ($digital_groups as $dig_group) {
                                                    ?> 
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label"><?php echo $dig_group['GroupsUser']['name']; ?></label><span class="colon">:</span>
                                                            <div class="col-sm-4">
                                                                <select id="<?php echo $dig_group['GroupsUser']['channel_field']; ?>" name="data[User][<?php echo $dig_group['GroupsUser']['channel_field'] ?>]" class="form-control">
                                                                    <option value="">--Select--</option>
                                                                    <?php
                                                                    foreach ($channels as $travel_channel) {


                                                                        if ($dig_group['GroupsUser']['id'] == $travel_channel['Channel']['channel_role']) {
                                                                            ?>
                                                                            <option value="<?php echo $travel_channel['Channel']['id']; ?>" <?php if (in_array($travel_channel['Channel']['id'], $channel_id)) { ?> selected <?php } ?>><?php echo $travel_channel['Channel']['channel_name']; ?></option>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>


                                                            </div>
                                                            <div class="col-sm-4">
                                                                <select id="<?php echo $dig_group['GroupsUser']['role_field'] ?>" name="data[User][<?php echo $dig_group['GroupsUser']['role_field'] ?>]" class="form-control user_role_bootbox_custom">
                                                                    <option value="">--Select--</option>
                                                                    <?php
                                                                    foreach ($digital_roles as $travel_role) {

                                                                        if ($dig_group['GroupsUser']['id'] == $travel_role['Role']['group_id']) {
                                                                            ?>
                                                                            <option value="<?php echo $travel_role['Role']['id']; ?>" <?php if (in_array($travel_role['Role']['id'], $role_id)) { ?> selected <?php } ?> ><?php echo $travel_role['Role']['role_name']; ?></option>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>	

                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form_submit clearfix" style="display:none">
                <div class="row">
                    <div class="col-sm-1">
                        <?php
                        echo $this->Form->submit('Update', array('class' => 'btn btn-success sticky_success'));
                        ?>
                    </div>
                    <div class="col-sm-1">
                        <?php echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'btn btn-danger sticky_important')); ?>
                    </div>


                </div>

            </div>
        </div>
    </div>
</div>
<?php echo $this->Form->end(); ?>



<?php
$this->Html->addCrumb('Add User', 'javascript:void(0);', array('class' => 'breadcrumblast'));

echo $this->Form->create('User', array('method' => 'post', 'id' => 'parsley_reg', 'novalidate' => true,
    'inputDefaults' => array(
        'label' => false,
        'div' => false,
        'class' => 'form-control',
    )
));
echo $this->Form->hidden('role_id', array('value' => '6'));
?>





<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Add Information</h4>
        </div>
        <div class="panel-body">
            <fieldset>
                <legend><span>Add User</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name" class="req">First Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('fname');
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Last Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('lname');
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Gender</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('sex', array('options' => array('M' => 'Male', 'F' => 'Female'), 'empty' => 'Select'));
                                ?></div>
                        </div>
                        <div class="form-group slt-sm">
                            <label for="reg_input_name">Primary Mobile</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('primary_country_code', array('options' => $codes, 'default' => '76', 'empty' => '--Select--'));
                                echo $this->Form->input('primary_mobile_number', array('class' => 'form-control sm rgt'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Personal Email</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('personal_email_id', array('type' => 'email'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">PAN Card</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('pan_card_number');
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Travel Infra Email</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('travel_infra_email');
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Travel S&M Email</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('travel_sale_marketing_email');
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Home Loans Email</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('home_loan_email');
                                ?></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name">City</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('city_id', array('options' => $cities, 'empty' => 'Select'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Middle Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('mname');
                                ?></div>
                        </div>

                        <div class="form-group">
                            <label for="reg_input_name">Company Email</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('company_email_id', array('type' => 'email'));
                                ?></div>
                        </div>

                        <div class="form-group slt-sm">
                            <label for="reg_input_name">Secondary Mobile</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('secondary_country_code', array('options' => $codes, 'default' => '76', 'empty' => '--Select--'));
                                echo $this->Form->input('secondary_mobile_number', array('class' => 'form-control sm rgt'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Blackberry Pin</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('blackberry_pin');
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Passport</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('passport_number');
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Skype Id</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('skype_id', array('type' => 'text'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">System Email</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('system_email');
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Sumanus Email</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('sumanus_email');
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Real Estate Email</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('realestate_email');
                                ?></div>
                        </div>
                    </div>



                </div>
            </div>
            <div class="row" style="clear:both;">
                <div class="col-sm-12">
                    <div class="panel-group" id="accordion2">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title fpt">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc1_collapseOne">
                                        Channel & Roles set [Real Easte]
                                    </a>
                                </h4>
                            </div>
                            <div id="acc1_collapseOne" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label blank"></label>
                                            <div class="col-sm-4">Channel Manager</div>
                                            <div class="col-sm-4">Role Manager</div>
                                        </div>
                                    </div>

                                    <?php
                                    // pr($groups);
                                    if (count($groups)) {
                                        foreach ($groups as $group) {
                                            ?>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label"><?php echo $group['GroupsUser']['name']; ?></label>
                                                    <span class="colon">:</span>
                                                    <div class="col-sm-4">
                                                        <select id="<?php echo $group['GroupsUser']['channel_field']; ?>" name="data[User][<?php echo $group['GroupsUser']['channel_field'] ?>]" class="form-control">
                                                            <option value="">--Select--</option>
                                                            <?php
                                                            foreach ($channels as $channel) {


                                                                if ($group['GroupsUser']['id'] == $channel['Channel']['channel_role']) {
                                                                    ?>
                                                                    <option value="<?php echo $channel['Channel']['id']; ?>"><?php echo $channel['Channel']['channel_name']; ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>


                                                    </div>
                                                    <div class="col-sm-4">
                                                        <select id="<?php echo $group['GroupsUser']['role_field'] ?>" name="data[User][<?php echo $group['GroupsUser']['role_field'] ?>]" class="form-control user_role_bootbox_custom">
                                                            <option value="">Select</option>
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

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title fpt">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc1_collapseTwo">
                                        Channel & Roles set [Travel]
                                    </a>
                                </h4>
                            </div>
                            <div id="acc1_collapseTwo" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label blank"></label>
                                            <div class="col-sm-4">Channel Manager</div>
                                            <div class="col-sm-4">Role Manager</div>
                                        </div>
                                    </div>

                                    <?php
                                    // pr($groups);
                                    if (count($travel_groups)) {
                                        foreach ($travel_groups as $travel_group) {
                                            ?>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label"><?php echo $travel_group['GroupsUser']['name']; ?></label>
                                                    <span class="colon">:</span>
                                                    <div class="col-sm-4">
                                                        <select id="<?php echo $travel_group['GroupsUser']['channel_field']; ?>" name="data[User][<?php echo $travel_group['GroupsUser']['channel_field'] ?>]" class="form-control">
                                                            <option value="">--Select--</option>
                                                            <?php
                                                            foreach ($channels as $channel) {


                                                                if ($travel_group['GroupsUser']['id'] == $channel['Channel']['channel_role']) {
                                                                    ?>
                                                                    <option value="<?php echo $channel['Channel']['id']; ?>"><?php echo $channel['Channel']['channel_name']; ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>


                                                    </div>
                                                    <div class="col-sm-4">
                                                        <select id="<?php echo $travel_group['GroupsUser']['role_field'] ?>" name="data[User][<?php echo $travel_group['GroupsUser']['role_field'] ?>]" class="form-control user_role_bootbox_custom">
                                                            <option value="">Select</option>
                                                            <?php
                                                            foreach ($roles as $role) {

                                                                if ($travel_group['GroupsUser']['id'] == $role['Role']['group_id']) {
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

            </div>
            <div class="row">
                <div class="col-sm-1">
                    <?php
                    echo $this->Form->submit('Add', array('class' => 'btn btn-success sticky_success', 'id' => 'lead_add'));
                    ?>
                </div>
                <div class="col-sm-1">
                    <?php echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'btn btn-danger sticky_important')); ?>
                </div>


            </div>

        </div>
    </div>
</div>










<?php echo $this->Form->end(); ?>   

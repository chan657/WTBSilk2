<?php $this->Html->addCrumb('My Profile', 'javascript:void(0);', array('class' => 'breadcrumblast')); ?>

<div class="home-row">

    <div class="container">
        <!--<h2>My Profile</h2>-->

        <div class="user_heading">
            <div class="row">
                <div class="col-sm-2 hidden-xs">
                    <?php echo $this->Html->image('user_avatar_lg.png'); ?>
                </div>
                <div class="col-sm-10">
                    <div class="user_heading_info">
                        <div class="user_actions pull-right">
                            <a href="#" class="edit_form" data-toggle="tooltip" data-placement="top" title="Edit"><span class="icon-edit"></span></a> <a href="#" class="view_form" data-toggle="tooltip" data-placement="top" title="View" style="display: none;"><span class="glyphicon glyphicon-eye-open"></span></a>
                        </div>
                        <h1><?php echo $fname . ' ' . $lname; ?></h1>
                        <!--<h2>Administrator</h2>-->
                    </div>
                </div>
            </div>
        </div>
        <div class="user_content">
            <div class="row">
                <div class="col-sm-4 sppdng">
                    <?php
                    echo $this->Form->create('User', array('method' => 'post', 'class' => 'form-horizontal user_form', 'id' => 'parsley_reg', 'novalidate' => true,
                        'inputDefaults' => array(
                            'label' => false,
                            'div' => false,
                            'class' => 'form-control',
                        )
                    ));
                    ?>
                    <h3 class="heading_a">General</h3>
                    <div class="form-group">
                        <label class="col-sm-5 control-label req" for="reg_input_name">First Name</label>
                        <div class="col-sm-7 editable">
                            <p class="form-control-static"><?php echo $this->data['User']['fname']; ?></p>
                            <div class="hidden_control">
                                <?php echo $this->Form->input('fname', array('data-required' => 'true')); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-5 control-label">Middle Name &nbsp;</label>
                        <div class="col-sm-7 editable">
                            <p class="form-control-static"><?php echo $this->data['User']['mname']; ?></p>
                            <div class="hidden_control">
                                <?php echo $this->Form->input('mname'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-5 control-label req" for="reg_input_name">Last Name</label>
                        <div class="col-sm-7 editable">
                            <p class="form-control-static"><?php echo $this->data['User']['lname']; ?></p>
                            <div class="hidden_control">
                                <?php echo $this->Form->input('lname', array('data-required' => 'true')); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-5 control-label req" for="reg_input_name">Gender</label>
                        <div class="col-sm-7 editable">
                            <p class="form-control-static"><?php echo $this->data['User']['sex']; ?></p>
                            <div class="hidden_control">
                                <?php echo $this->Form->input('sex', array('options' => array('M' => 'Male', 'F' => 'Female'), 'empty' => '--Select--', 'data-required' => 'true')); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-5 control-label">Passport &nbsp;</label>
                        <div class="col-sm-7 editable">
                            <p class="form-control-static"><?php echo $this->data['User']['passport_number']; ?></p>
                            <div class="hidden_control">
                                <?php echo $this->Form->input('passport_number'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-5 control-label">PAN Card &nbsp;</label>
                        <div class="col-sm-7 editable">
                            <p class="form-control-static"><?php echo $this->data['User']['pan_card_number']; ?></p>
                            <div class="hidden_control">
                                <?php echo $this->Form->input('pan_card_number'); ?>
                            </div>
                        </div>
                    </div>
                    <h3 class="heading_a">Contact info</h3>
                    <div class="form-group">
                        <label class="col-sm-5 control-label req" for="reg_input_name">Primary Mobile</label>
                        <div class="col-sm-7 editable singleline">
                            <p class="form-control-static"><?php echo $this->data['PrimaryCode']['value'] . ': ' . $this->data['PrimaryCode']['code'] . ' ' . $this->data['User']['primary_mobile_number']; ?></p>
                            <div class="hidden_control">
                                <?php
                                echo $this->Form->input('primary_country_code', array('options' => $codes, 'default' => '76', 'empty' => '--Select--'));
                                echo $this->Form->input('primary_mobile_number', array('div' => false, 'class' => 'form-control sm rgt', 'data-required' => 'true'));
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-5 control-label">Secondary Mobile &nbsp;</label>
                        <div class="col-sm-7 editable singleline">
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
                        <label class="col-sm-5 control-label">Personal Email &nbsp;</label>
                        <div class="col-sm-7 editable">
                            <p class="form-control-static"><?php echo $this->data['User']['personal_email_id']; ?></p>
                            <div class="hidden_control">
<?php echo $this->Form->input('personal_email_id', array('type' => 'email')); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-5 control-label">Skype Id &nbsp;</label>
                        <div class="col-sm-7 editable">
                            <p class="form-control-static"><?php echo $this->data['User']['skype_id']; ?></p>
                            <div class="hidden_control">
<?php echo $this->Form->input('skype_id', array('type' => 'text')); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-5 control-label">Blackberry Pin &nbsp;</label>
                        <div class="col-sm-7 editable">
                            <p class="form-control-static"><?php echo $this->data['User']['blackberry_pin']; ?></p>
                            <div class="hidden_control">
<?php echo $this->Form->input('blackberry_pin'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-5 control-label req" for="reg_input_name">Location</label>
                        <div class="col-sm-7 editable">
                            <p class="form-control-static"><?php echo $this->data['City']['city_name']; ?></p>
                            <div class="hidden_control">
<?php echo $this->Form->input('city_id', array('options' => $cities, 'empty' => '--Select--', 'data-required' => 'true')); ?>
                            </div>
                        </div>
                    </div>
                    <h3 class="heading_a">Email info</h3>
                    <div class="form-group">
                        <label class="col-sm-5 control-label">System &nbsp;</label>
                        <div class="col-sm-7 editable">
                            <p class="form-control-static"><?php echo $this->data['User']['company_email_id']; ?></p>
                            <div class="hidden_control">
<?php echo $this->Form->input('system_email', array('disabled' => true)); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-5 control-label">Real Estate &nbsp;</label>
                        <div class="col-sm-7 editable">
                            <p class="form-control-static"><?php echo $this->data['User']['realestate_email']; ?></p>
                            <div class="hidden_control">
<?php echo $this->Form->input('realestate_email', array('disabled' => true)); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-5 control-label">Travel / Tech Infra &nbsp;</label>
                        <div class="col-sm-7 editable">
                            <p class="form-control-static"><?php echo $this->data['User']['travel_infra_email']; ?></p>
                            <div class="hidden_control">
<?php echo $this->Form->input('travel_infra_email', array('disabled' => true)); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-5 control-label">Travel S&M &nbsp;</label>
                        <div class="col-sm-7 editable">
                            <p class="form-control-static"><?php echo $this->data['User']['travel_sale_marketing_email']; ?></p>
                            <div class="hidden_control">
<?php echo $this->Form->input('travel_sale_marketing_email', array('disabled' => true)); ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-5 control-label">Home Loans &nbsp;</label>
                        <div class="col-sm-7 editable">
                            <p class="form-control-static"><?php echo $this->data['User']['home_loan_email']; ?></p>
                            <div class="hidden_control">
<?php echo $this->Form->input('home_loan_email', array('disabled' => true)); ?>
                            </div>
                        </div>
                    </div>

                    <div class="form_submit clearfix" style="display:none">
                        <div class="row">
                            <div class="col-sm-10 col-sm-offset-2">
                                <?php
                                echo $this->Form->submit('Update', array('class' => 'btn btn-success sticky_success'));
                                ?>
                            </div>
                        </div>
                    </div>
<?php echo $this->Form->end(); ?>
                </div>
                <div class="col-sm-8">
                    <h3 class="heading_a mrgno">Roles</h3>
                </div>
                <?php if($self_id == '1'){?>
                <div class="col-sm-8 real-estate-blk">
                    <h3>Administration</h3>
                    <ul class="top_ico_nav clearfix">
                        <li>
                            <a href="<?php echo $this->webroot; ?>users/dashboard/id:1/channel:214/industry:6"><img src="<?php echo $this->webroot; ?>img/24.png" alt="Adminstration" title="Adminstration"><span class="menu_label">Adminstration</span><span>Global</span></a>
                            <?php //echo $this->Html->link($this->Html->image('5.png', array('alt' => 'Distribution Global', 'title' => 'Distribution Global')) . '<span class="menu_label">Distribution</span><span>Global</span>', '#', array('escape' => false)); ?></li>
                    </ul>
                </div>
                <?php }?>
                                <?php if($self_id == '133'){?>
                <div class="col-sm-8 real-estate-blk">
                    <h3>Administration</h3>
                    <ul class="top_ico_nav clearfix">
                        <li>
                            <a href="<?php echo $this->webroot; ?>users/dashboard/id:1/channel:214/industry:6"><img src="<?php echo $this->webroot; ?>img/24.png" alt="Adminstration" title="Adminstration"><span class="menu_label">Adminstration</span><span>Global</span></a>
                            <?php //echo $this->Html->link($this->Html->image('5.png', array('alt' => 'Distribution Global', 'title' => 'Distribution Global')) . '<span class="menu_label">Distribution</span><span>Global</span>', '#', array('escape' => false)); ?></li>
                    </ul>
                </div>
                <?php }?>
                <div class="col-sm-8 real-estate-blk">
                    <h3>Real Estate</h3>

                    <?php
                    $role_id = array_filter($role_id);
                    ?>
                    <ul class="top_ico_nav clearfix">
                        <?php if (count($role_id)) { ?>
                            <?php
                            foreach ($role_id as $role) {
                                $arr = explode(',', $role);
                                $role = $arr[1];
                                $channel = $arr[0];
                                ?>
                                <li>

                                    <?php
                                echo $this->Html->link($this->Html->image($role . '.png', array('alt' => $groups[$roles[$role]], 'title' => $groups[$roles[$role]])) . '<span class="menu_label">' . $groups[$roles[$role]] . '</span><span>' . $channel_city[$channel] . '</span>', array('controller' => 'users', 'action' => 'dashboard', 'id' => $role, 'channel' => $channel,'industry' => '1'), array('escape' => false));
                                ?> </li>   
                                <?php
                            }
                        } else {
                            ?>
                            <li><?php
                         //   echo $this->Html->link('<i class="icon-tasks icon-2x"></i><span class="menu_label">Others</span>', array('controller' => 'users', 'action' => 'dashboard'), array('escape' => false));
                            ?></li>
<?php } ?>
                    </ul>
                </div>
                <div class="col-sm-8 travel">
                    <h3>Travel</h3>
                    <?php
                    $travel_role_id = array_filter($travel_role_id);
                    ?>
                    <ul class="top_ico_nav clearfix">
                        <?php if (count($travel_role_id)) { ?>
                            <?php
                            foreach ($travel_role_id as $role) {
                                $arr = explode(',', $role);
                                $role = $arr[1];
                                $channel = $arr[0];
                                ?>
                                <li>
                                    <?php
                                echo $this->Html->link($this->Html->image($role . '.png', array('alt' => $groups[$roles[$role]], 'title' => $groups[$roles[$role]])) . '<span class="menu_label">' . $groups[$roles[$role]] . '</span><span>' . $channel_city[$channel] . '</span>', array('controller' => 'users', 'action' => 'dashboard', 'id' => $role, 'channel' => $channel,'industry' => '2'), array('escape' => false));
                                ?> </li>   
                                <?php
                            }
                        } else {
                            ?>
                            <li><?php
                            echo $this->Html->link('<i class="icon-tasks icon-2x"></i><span class="menu_label">Others</span>', array('controller' => 'users', 'action' => 'dashboard'), array('escape' => false));
                            ?></li>
<?php } ?>
                    </ul>
                </div>
                <div class="col-sm-8 travel homeln">
                    <h3>Home Loans</h3>
                    <ul class="top_ico_nav clearfix">
                        <li><?php //echo $this->Html->link($this->Html->image('5.png', array('alt' => 'Distribution Global', 'title' => 'Distribution Global')) . '<span class="menu_label">Distribution</span><span>Global</span>', '#', array('escape' => false)); ?></li>
                    </ul>
                </div>
                           <div class="col-sm-8 travel dgtmd">
                    <h3>Digital Media</h3>
                    <?php
                    $digital_role_id = array_filter($digital_role_id);
                   
                    ?>
                    <ul class="top_ico_nav clearfix">
                        <?php if (count($digital_role_id)) { ?>
                            <?php
                            foreach ($digital_role_id as $role) {
                                $arr = explode(',', $role);
                                $role = $arr[1];
                                $channel = $arr[0];
                                ?>
                                <li>

                                    <?php
                                echo $this->Html->link($this->Html->image($role . '.png', array('alt' => $groups[$roles[$role]], 'title' => $groups[$roles[$role]])) . '<span class="menu_label">' . $groups[$roles[$role]] . '</span><span>' . $channel_city[$channel] . '</span>', array('controller' => 'users', 'action' => 'dashboard', 'id' => $role, 'channel' => $channel,'industry' => '5'), array('escape' => false));
                                ?> </li>   
                                <?php
                            }
                        } else {
                            ?>
                            <li><?php
                          //  echo $this->Html->link('<i class="icon-tasks icon-2x"></i><span class="menu_label">Others</span>', array('controller' => 'users', 'action' => 'dashboard'), array('escape' => false));
                            ?></li>
<?php } ?>
                    </ul>
                </div>
         
            </div>
        </div>
    </div>

</div>

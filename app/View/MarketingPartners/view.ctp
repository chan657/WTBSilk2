<?php
$this->Html->addCrumb('View Partner', 'javascript:void(0);', array('class' => 'breadcrumblast'));
App::import('Model', 'User');
$attr = new User();
?>


<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">View Information</h4>

        </div>

        <div class="panel-body">
            <fieldset>
                <legend><span>View  Partner</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    echo $this->Form->create('MarketingPartner', array('method' => 'post', 'class' => 'form-horizontal user_form',
                        'inputDefaults' => array(
                            'label' => false,
                            'div' => false,
                            'class' => 'form-control',
                        )
                    ));

                    if ($this->data['MarketingPartner']['marketing_partner_approved'] == 1)
                        $approved = 'Approved';
                    else
                        $approved = 'Pending';
                    ?>
                    <div class="col-sm-6">    
                        <div class="form-group">
                            <label>Approval Status</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <p class="form-control-static"><?php echo $approved; ?></p>
                                <!--<div class="hidden_control">
<?php echo $approved; ?>
                                </div>-->
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Website</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->Html->link($this->data['MarketingPartner']['marketing_partner_website'], $this->data['MarketingPartner']['marketing_partner_website'], array('target' => '_blank', 'escape' => false));
$this->data['MarketingPartner']['marketing_partner_website'];
?></p>

                            </div>
                        </div>

                        <div class="form-group slt-sm">
                            <label>Board Number</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['MarketingPartner']['marketing_partner_boardnumber_code'] . ' ' . $this->data['MarketingPartner']['marketing_partner_boardnumber']; ?></p>

                            </div>
                        </div>
                    </div>  
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Partner Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['MarketingPartner']['marketing_partner_display_name']; ?></p>

                            </div>
                        </div>
                        <div class="form-group">
                            <label>Primary City</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['City']['city_name']; ?></p>

                            </div>
                        </div>
                        <div class="form-group">
                            <label>Board Email</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['MarketingPartner']['marketing_partner_boardemail']; ?></p>

                            </div>
                        </div>

                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Corporate Address</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable txtbox">
                                <p class="form-control-static"><?php echo $this->data['MarketingPartner']['marketing_partner_corporateaddress']; ?></p>

                            </div>
                        </div>
                        <div class="form-group">
                            <label>Partner Description</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable txtbox">
                                <p class="form-control-static"><?php echo $this->data['MarketingPartner']['marketing_partner_description']; ?></p>

                            </div>
                        </div>
                    </div>





                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel-group" id="accordion1">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title fpt">
                                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#acc1_collapseOne">
                                                Builder Contacts
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="acc1_collapseOne" class="panel-collapse collapse">
                                        <div class="form-group">

                                            <div class="col-sm-12">

                                                <div class="form-control-static">
                                                    <div class="table-heading disimp">
                                                        <h4 class="table-heading-title">Contact Details</h4></div><table class="table toggle-square responsive_table" data-filter="#table_search" data-page-size="40">
                                                        <thead>
                                                            <tr>
                                                                <th data-toggle="true">Contact Id</th>
                                                                <th data-hide="phone">Contact Name</th>
                                                                <th data-hide="phone">Designation</th>
                                                                <th data-hide="phone">Primary Mobile</th>
                                                                <th data-hide="phone">Secondary Mobile</th>

                                                                <th data-hide="phone">Email Address</th>
                                                                <th data-hide="phone">Location</th>
                                                                <th data-hide="phone">Level</th>



                                                                <th data-hide="all" data-sort-ignore="true">For Company</th>
                                                                <th data-hide="all" data-sort-ignore="true">For Company City</th>
                                                                <th data-hide="all" data-sort-ignore="true">Approved By</th>
                                                                <th data-hide="all" data-sort-ignore="true">Approved Date</th>
                                                                <th data-hide="all" data-sort-ignore="true">Address of Contact</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>  
                                                            <?php
                                                            if (count($this->data['BuilderContact']) && !empty($this->data['BuilderContact'])) {
                                                                foreach ($this->data['BuilderContact'] as $BuilderContact) {
                                                                    ?> 
                                                                    <tr>
                                                                        <td><?php echo $BuilderContact['id']; ?></td>
                                                                        <td><?php echo $BuilderContact['builder_contact_name']; ?></td>
                                                                        <td><?php echo $BuilderContact['builder_contact_designation']; ?></td>
                                                                        <td><?php echo $codes[$BuilderContact['builder_contact_mobile_country_code']] . ' ' . $BuilderContact['builder_contact_mobile_no']; ?></td>
                                                                        <td><?php echo $BuilderContact['builder_contact_secondary_mobile_country_code'] . ' ' . $BuilderContact['builder_contact_secondary_mobile_no']; ?></td>

                                                                        <td><?php echo $BuilderContact['builder_contact_email']; ?></td>
                                                                        <td><?php echo $city[$BuilderContact['builder_contact_location']]; ?></td>
                                                                        <td><?php echo $contact_level[$BuilderContact['builder_contact_level']]; ?></td>


                                                                        <td><?php echo $for_company[$BuilderContact['builder_contact_company']]; ?></td>
                                                                        <td><?php echo $city[$BuilderContact['builder_contact_company_city']]; ?></td>
                                                                        <td><?php echo $attr->Username($BuilderContact['builder_contact_approved_by']); ?></td>
                                                                        <td><?php echo date("d/m/Y", strtotime($BuilderContact['builder_contact_approved_date'])); ?></td>
                                                                        <td><?php echo $BuilderContact['builder_contact_email']; ?></td>

                                                                    </tr>
                                                                <?php
                                                                }
                                                            }
                                                            ?>

                                                        </tbody>   
                                                    </table></div>

                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title fpt">
                                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#acc1_collapseThree">
                                                Partner Multicity Operations
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="acc1_collapseThree" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Primary City</label>
                                                    <span class="colon">:</span>
                                                    <div class="col-sm-10">
                                                        <div class="form-group">
                                                            <div class="col-sm-4 col-xs-12 editable">
                                                                <p class="form-control-static"><?php echo $this->data['City']['city_name']; ?></p>
                                                                <div class="hidden_control">
<?php echo $this->Form->input('marketing_partner_primarycity', array('options' => $city, 'empty' => '--Select--')); ?>
                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Secondary City</label>
                                                    <span class="colon">:</span>
                                                    <div class="col-sm-10">
                                                        <div class="form-group">
                                                            <div class="col-sm-4 col-xs-12 editable">
                                                                <p class="form-control-static"><?php
                                                                    $secondary_city = '';

                                                                    if ($this->data['SecondaryCity']['city_name'])
                                                                        $secondary_city .= $this->data['SecondaryCity']['city_name'] . ',';
                                                                    if ($this->data['TertiaryCity']['city_name'])
                                                                        $secondary_city .= $this->data['TertiaryCity']['city_name'] . ',';
                                                                    if ($this->data['City4']['city_name'])
                                                                        $secondary_city .= $this->data['City4']['city_name'] . ',';
                                                                    if ($this->data['City5']['city_name'])
                                                                        $secondary_city .= $this->data['City5']['city_name'] . ',';







                                                                    echo $secondary_city;
                                                                    ?></p>

                                                            </div>



                                                        </div>
                                                    </div>
                                                </div>
                                            </div>




                                        </div>
                                    </div>
                                </div>




                            </div>

                        </div>
                    </div>






<?php echo $this->Form->end(); ?>

                </div>
            </div>
        </div>
    </div>
</div>


<?php
$this->Html->addCrumb('View Agent', 'javascript:void(0);', array('class' => 'breadcrumblast'));

echo $this->Form->create('Agent', array('method' => 'post', 'class' => 'form-horizontal',
    'inputDefaults' => array(
        'label' => false,
        'div' => false,
        'class' => 'form-control',
    )
));

if ($this->data['Agent']['agent_iata_approval_status'])
    $agent_iata_approval_status = 'Yes';
else
    $agent_iata_approval_status = 'No';
?>

<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">View Information</h4>

        </div>

        <div class="panel-body">
            <fieldset>
                <legend><span>View  Agent</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">

                    <div class="col-sm-6">    
                        <div class="form-group">
                            <label>Approval Status</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <p class="form-control-static"><?php echo $this->data['AgentStatus']['value']; ?></p>

                            </div>
                        </div>

                        <div class="form-group">
                            <label>Incorporation Country</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['AgentCountry']['name']; ?></p>

                            </div>
                        </div>
                        <div class="form-group">
                            <label>Suburb</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['AgentSuburb']['suburb_name']; ?></p>

                            </div>
                        </div>
                        <div class="form-group">
                            <label>Zip Code</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['Agent']['agent_zip_code']; ?></p>

                            </div>
                        </div>
                        <div class="form-group">
                            <label>Website</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php
                                    echo $this->Html->link($this->data['Agent']['agent_website'], $this->data['Agent']['agent_website'], array('target' => '_blank', 'escape' => false));
                                    $this->data['Agent']['agent_website'];
                                    ?></p>

                            </div>
                        </div>
                        <div class="form-group">
                            <label>IATA Status</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $agent_iata_approval_status; ?></p>

                            </div>
                        </div>
                    </div>  
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Agent Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['Agent']['agent_name']; ?></p>

                            </div>
                        </div>
                        <div class="form-group">
                            <label>Procurement Type</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['ProcurementType']['value']; ?></p>

                            </div>
                        </div>
                        <div class="form-group">
                            <label>Primary City</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['PrimaryCity']['city_name']; ?></p>

                            </div>
                        </div>
                        <div class="form-group">
                            <label>Area</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['AgentArea']['area_name']; ?></p>

                            </div>
                        </div>
                        <div class="form-group">
                            <label>Time Zone</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['TimeZone']['gmt'] . ' ' . $this->data['TimeZone']['timezone_location']; ?></p>

                            </div>
                        </div>

                    </div>
                    <br class="spacer" />
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Corporate Address</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable txtbox">
                                <p class="form-control-static"><?php echo $this->data['Agent']['agent_corporate_address']; ?></p>

                            </div>
                        </div>

                    </div>
                    
                    <div class="col-sm-12">
                        <div class="col-sm-6">
                            <div class="form-group lessGap">
                                <label>Mobile</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10 editable">
                                    <p class="form-control-static"><?php echo $this->data['MobileCode']['code'] . ' ' . $this->data['Agent']['agent_contact_number_mobile']; ?></p>

                                </div>
                            </div>
                            <div class="form-group lessGap">
                                <label>Email</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10 editable">
                                    <p class="form-control-static"><?php echo $this->data['Agent']['agent_contact_email']; ?></p>

                                </div>
                            </div>
                            <div class="form-group lessGap">
                                <label>Business Type</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10 editable">
                                    <p class="form-control-static"><?php echo $this->data['AgentBusinessType']['value']; ?></p>

                                </div>
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <div class="form-group slt-sm">
                                <label>Land Line No.</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10 editable">
                                    <p class="form-control-static"><?php echo $this->data['LandLineCode']['code'] . ' ' . $this->data['Agent']['agent_contact_number_landline']; ?></p>

                                </div>
                            </div>
                            <div class="form-group">
                                <label>Nature of Business</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10 editable">
                                    <p class="form-control-static"><?php echo $this->data['AgentBusinessNature']['value']; ?></p>

                                </div>
                            </div>
                            <div class="form-group">
                                <label>Source</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10 editable">
                                    <p class="form-control-static"><?php echo $this->data['AgentSource']['value']; ?></p>

                                </div>
                            </div>

                        </div>
                    </div>
                    <br class="spacer" />
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Registration Note</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable txtbox">
                                <p class="form-control-static"><?php echo $this->data['Agent']['agent_registration_note']; ?></p>

                            </div>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable txtbox">
                                <p class="form-control-static"><?php echo $this->data['Agent']['agent_description']; ?></p>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel-group" id="accordion1">
                                <!-- <div class="panel panel-default">
                                     <div class="panel-heading">
                                         <h4 class="panel-title fpt">
                                             <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#acc1_collapseOne">
                                                 Agent Contacts
                                             </a>
                                         </h4>
                                     </div>
                                     <div id="acc1_collapseOne" class="panel-collapse collapse">
                                         <div class="form-group">
 
                                             <div class="col-sm-12">
 
                                                 <div class="form-control-static">
                                                     <div class="table-heading disimp">
                                                         <h4 class="table-heading-title"><?php echo count($this->data['BuilderContact']) ?>Contact Details</h4>
                                                     </div>
                                                     <table class="table toggle-square responsive_table" data-filter="#table_search" data-page-size="100">
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
 
                                                                 <th data-hide="all" data-sort-ignore="true">Initiated By</th>
                                                                 <th data-hide="all" data-sort-ignore="true">Intiator</th>
                                                                 <th data-hide="all" data-sort-ignore="true">Managed By</th>
                                                                 <th data-hide="all" data-sort-ignore="true">Manager</th>
 
                                                                 <th data-hide="all" data-sort-ignore="true">For Company</th>
                                                                 <th data-hide="all" data-sort-ignore="true">For Company City</th>
                                                                 <th data-hide="all" data-sort-ignore="true">Approved By</th>
                                                                 <th data-hide="all" data-sort-ignore="true">Approved Date</th>
                                                                 <th data-hide="all" data-sort-ignore="true">Address of Contact</th>
                                                                 <th data-hide="phone" data-sort-ignore="true">Action</th>
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
                                                                                 <td><?php echo $BuilderContact['builder_contact_location']; ?></td>
                                                                                 <td><?php echo $contact_level[$BuilderContact['builder_contact_level']]; ?></td>
         
                                                                                 <td><?php echo $BuilderContact['builder_contact_intiated_by']; ?></td>
                                                                                 <td><?php echo $contact_initiated[$BuilderContact['builder_contact_intiated_by_id']]; ?></td>
                                                                                 <td><?php echo $BuilderContact['builder_contact_managed_by']; ?></td>
         
                                                                                 <td><?php echo $BuilderContact['builder_contact_approved_by']; ?></td>
                                                                                 <td><?php echo $BuilderContact['builder_contact_company']; ?></td>
                                                                                 <td><?php echo $city[$BuilderContact['builder_contact_company_city']]; ?></td>
                                                                                 <td><?php echo $BuilderContact['builder_contact_approved_by']; ?></td>
                                                                                 <td><?php echo date("d/m/Y", strtotime($BuilderContact['builder_contact_approved_date'])); ?></td>
                                                                                 <td><?php echo $BuilderContact['builder_contact_email']; ?></td>
                                                                                 <td>
                                        <?php
                                        echo $this->Html->link('<span class="icon-pencil"></span>', '/builder/edit_contact/' . $BuilderContact['id'], array('class' => 'act-ico open-popup-link add-btn', 'escape' => false));
                                        ?>
                                                                                 </td>
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
 
                                 </div> -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title fpt">
                                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#acc1_collapseThree">
                                                Agent Multicity Operations
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
                                                                <p class="form-control-static"><?php echo $this->data['PrimaryCity']['city_name']; ?></p>
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
                                                                    ?>
                                                                </p>
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
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->Form->end(); ?>

<?php
$this->Html->addCrumb('View Owner', 'javascript:void(0);', array('class' => 'breadcrumblast'));

//pr($this->data);
function rating_range($num) {
    switch ($num) {
        case in_array($num, range(0, 20000)):
            return 'Poor';
            break;
        case in_array($num, range(20001, 40000)):
            return 'Average';
            break;
        case in_array($num, range(40001, 60000)):
            return 'Above Average';
            break;
        case in_array($num, range(60001, 75000)):
            return 'Great';
            break;
        case in_array($num, range(75001, 90000)):
            return 'Outstanding';
            break;
        case in_array($num, range(90001, 100000)):
            return 'Out of the World';
            break;


        default: //default
            return "within no range";
            break;
    }
}
?>


<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">View Information</h4>

        </div>

        <div class="panel-body">
            <fieldset>
                <legend><span>View  Owner</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    echo $this->Form->create('Owner', array('method' => 'post', 'class' => 'form-horizontal user_form', 'id' => 'owner',
                        'inputDefaults' => array(
                            'label' => false,
                            'div' => false,
                            'class' => 'form-control',
                        )
                    ));

                    if ($this->data['Owner']['owner_approved'] == 1)
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
                                <p class="form-control-static"><?php
                                    echo $this->Html->link($this->data['Owner']['owner_website'], $this->data['Owner']['owner_website'], array('target' => '_blank', 'escape' => false));
                                    $this->data['Owner']['owner_website'];
                                    ?></p>

                            </div>
                        </div>

                        <div class="form-group slt-sm">
                            <label>Board Number</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['BoardNumber']['code'] . ' ' . $this->data['Owner']['owner_boardnumber']; ?></p>

                            </div>
                        </div>
                    </div>  
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Owner Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['Owner']['owner_name']; ?></p>

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
                                <p class="form-control-static"><?php echo $this->data['Owner']['owner_boardemail']; ?></p>

                            </div>
                        </div>

                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Corporate Address</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable txtbox">
                                <p class="form-control-static"><?php echo $this->data['Owner']['owner_corporateaddress']; ?></p>

                            </div>
                        </div>
                        <div class="form-group">
                            <label>Owner Description</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable txtbox">
                                <p class="form-control-static"><?php echo $this->data['Owner']['owner_description']; ?></p>

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
                                                Owner Contacts
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="acc1_collapseOne" class="panel-collapse collapse">
                                        <div class="form-group">

                                            <div class="col-sm-12">

                                                <div class="row">

                                                    <div class="col-sm-6">

                                                        <div class="form-group">
                                                            <label class="required">Contact Name</label>
                                                            <span class="colon">:</span>
                                                            <div class="col-sm-10"> <?php echo $this->data['Owner']['owner_contact_name']; ?></div>
                                                        </div>

                                                        <div class="form-group slt-sm">
                                                            <label class="required">Primary Mobile</label>
                                                            <span class="colon">:</span>
                                                            <div class="col-sm-10">
                                                                <?php
                                                                echo $this->data['ContactMobileCode']['value'];
                                                                echo $this->data['Owner']['owner_contact_mobile_no'];
                                                                ?></div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="email">Email Address</label>
                                                            <span class="colon">:</span>
                                                            <div class="col-sm-10">  <?php echo $this->data['Owner']['owner_contact_email']; ?></div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="required">For Company</label>
                                                            <span class="colon">:</span>
                                                            <div class="col-sm-10"><?php echo $this->data['ForCompany']['value']; ?></div>
                                                        </div>






                                                    </div>

                                                    <div class="col-sm-6">

                                                        <div class="form-group">
                                                            <label class="required">Contact Level</label>
                                                            <span class="colon">:</span>
                                                            <div class="col-sm-10">  <?php echo $this->data['ContactLevel']['value']; ?></div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="required">Designation</label>
                                                            <span class="colon">:</span>
                                                            <div class="col-sm-10">
                                                                <?php
                                                                echo $this->data['Owner']['owner_contact_designation'];
                                                                ?></div>
                                                        </div>
                                                        <div class="form-group slt-sm">
                                                            <label>Secondary Mobile</label>
                                                            <span class="colon">:</span>
                                                            <div class="col-sm-10">  <?php
                                                                echo $this->data['ContactSecondaryMobileCode']['value'];
                                                                echo $this->data['Owner']['owner_contact_secondary_mobile_no'];
                                                                ?></div>
                                                        </div>  

                                                        <div class="form-group">
                                                            <label class="required">Location</label>
                                                            <span class="colon">:</span>
                                                            <div class="col-sm-10 editable"> <p class="form-control-static"> <?php echo $this->data['ContactLocation']['city_name']; ?></p></div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="input_name">For Company City</label>
                                                            <span class="colon">:</span>
                                                            <div class="col-sm-10 editable">
                                                                
                                                                        <p class="form-control-static">
                                                                            <?php echo $this->data['ContactCompanyCity']['city_name']; ?>
                                                                        </p>
                                                                   
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>





                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title fpt">
                                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#acc1_collapseThree">
                                                Owner Multicity Operations
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

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title fpt">
                                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#acc1_collapseFour">
                                                Owner Construction Capabilities
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="acc1_collapseFour" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Residential</label>
                                                    <span class="colon">:</span>
                                                    <div class="col-sm-10">
                                                        <div class="form-group">
                                                            <div class="col-sm-4 col-xs-12 editable">
                                                                <p class="form-control-static"><?php echo $this->data['Residental']['value']; ?></p>

                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>High End Residential</label>
                                                    <span class="colon">:</span>
                                                    <div class="col-sm-10">
                                                        <div class="form-group">
                                                            <div class="col-sm-4 col-xs-12 editable">
                                                                <p class="form-control-static"><?php echo $this->data['Highend']['value']; ?></p>

                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Commercial</label>
                                                    <span class="colon">:</span>
                                                    <div class="col-sm-10">
                                                        <div class="form-group">
                                                            <div class="col-sm-4 col-xs-12 editable">
                                                                <p class="form-control-static"><?php echo $this->data['Commercial']['value']; ?></p>

                                                            </div>


                                                        </div>
                                                    </div>	
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title fpt">
                                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#acc1_collapseFive">
                                                Owner Rating
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="acc1_collapseFive" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Rating</label>
                                                    <span class="colon">:</span>
                                                    <div class="col-sm-10">
                                                        <div class="form-group">
                                                            <div class="col-sm-4 col-xs-12 editable">
                                                                <p class="form-control-static"><?php echo $this->data['Owner']['owner_rating'] . ' -> ' . rating_range($this->data['Owner']['owner_rating']); ?></p>

                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Brand Recognition</label>
                                                    <span class="colon">:</span>
                                                    <div class="col-sm-10">
                                                        <div class="form-group">
                                                            <div class="col-sm-4 col-xs-12 editable">
                                                                <p class="form-control-static"><?php echo $this->data['Owner']['owner_brandrecognition'] . ' -> ' . rating_range($this->data['Owner']['owner_brandrecognition']); ?></p>

                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Quality of Construction</label>
                                                    <span class="colon">:</span>
                                                    <div class="col-sm-10">
                                                        <div class="form-group">
                                                            <div class="col-sm-4 col-xs-12 editable">
                                                                <p class="form-control-static"><?php echo $this->data['Owner']['owner_qualityofconstruction'] . ' -> ' . rating_range($this->data['Owner']['owner_qualityofconstruction']); ?></p>

                                                            </div>


                                                        </div>
                                                    </div>	
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Timely Delivery</label>
                                                    <span class="colon">:</span>
                                                    <div class="col-sm-10">
                                                        <div class="form-group">
                                                            <div class="col-sm-4 col-xs-12 editable">
                                                                <p class="form-control-static"><?php echo $this->data['Owner']['owner_timelydelivery'] . ' -> ' . rating_range($this->data['Owner']['owner_timelydelivery']); ?></p>

                                                            </div>


                                                        </div>
                                                    </div>	
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Past Track Record</label>
                                                    <span class="colon">:</span>
                                                    <div class="col-sm-10">
                                                        <div class="form-group">
                                                            <div class="col-sm-4 col-xs-12 editable">
                                                                <p class="form-control-static"><?php echo $this->data['Owner']['owner_pasttrackrecord'] . ' -> ' . rating_range($this->data['Owner']['owner_pasttrackrecord']); ?></p>

                                                            </div>


                                                        </div>
                                                    </div>	
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Professionalism</label>
                                                    <span class="colon">:</span>
                                                    <div class="col-sm-10">
                                                        <div class="form-group">
                                                            <div class="col-sm-4 col-xs-12 editable">
                                                                <p class="form-control-static"><?php echo $this->data['Owner']['owner_professionalismandtransparency'] . ' -> ' . rating_range($this->data['Owner']['owner_professionalismandtransparency']); ?></p>

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


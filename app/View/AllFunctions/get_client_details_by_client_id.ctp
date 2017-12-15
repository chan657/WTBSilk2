<?php if (count($leads) > 0) { ?>
    <div class="panel-group" id="accordion2">
        <div class="panel panel-default" style="clear:both">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#acc2_collapseEight">
                        Client Details
                    </a>
                </h4>
            </div>
            <div id="acc2_collapseEight" class="panel-collapse collapse">
                <div class="panel-body">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Client Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('ActionItem.client_name', array('value' => $leads['Lead']['lead_fname'] . ' ' . $leads['Lead']['lead_lname'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control'));
                                ?> 
                                <span class="copy_right_arrow" id="copy_client_name"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Country</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('ActionItem.lead_country', array('value' => $leads['Country']['value'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control'));
                                ?> 
                                <span class="copy_right_arrow" id="copy_lead_country"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Primary Mobile</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('ActionItem.lead_primaryphonenumber', array('value' => $leads['PrimaryCode']['code'] . ' ' . $leads['Lead']['lead_primaryphonenumber'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control'));
                                ?>
                                <span class="copy_right_arrow" id="copy_lead_primaryphonenumber"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Secondary Mobile</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('ActionItem.lead_secondaryphonenumber', array('value' => $leads['SecondaryCode']['code'] . ' ' . $leads['Lead']['lead_secondaryphonenumber'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control'));
                                ?> 
                                <span class="copy_right_arrow" id="copy_lead_secondaryphonenumber"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('ActionItem.lead_emailid', array('value' => $leads['Lead']['lead_emailid'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control'));
                                ?> 
                                <span class="copy_right_arrow" id="copy_lead_emailid"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Street Address</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('ActionItem.lead_streetaddress', array('value' => $leads['Lead']['lead_streetaddress'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control'));
                                ?> 
                                <span class="copy_right_arrow" id="copy_lead_streetaddress"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Client Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php echo $this->Form->input('Deal.deal_client_name', array('label' => false, 'div' => false, 'class' => 'form-control')); ?> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Country</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php echo $this->Form->input('Deal.deal_lead_country', array('label' => false, 'div' => false, 'class' => 'form-control')); ?> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Primary Mobile</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php echo $this->Form->input('Deal.deal_lead_primaryphonenumber', array('label' => false, 'div' => false, 'class' => 'form-control')); ?> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Secondary Mobile</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php echo $this->Form->input('Deal.deal_lead_secondaryphonenumber', array('label' => false, 'div' => false, 'class' => 'form-control')); ?> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php echo $this->Form->input('Deal.deal_lead_emailid', array('label' => false, 'div' => false, 'class' => 'form-control')); ?> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Street Address</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php echo $this->Form->input('Deal.deal_lead_streetaddress', array('label' => false, 'div' => false, 'class' => 'form-control')); ?> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
<script>
       $('#copy_client_name').click(function(){
       $('#DealDealClientName').val($('#ActionItemClientName').val());
    });
    $('#copy_lead_country').click(function(){
       $('#DealDealLeadCountry').val($('#ActionItemLeadCountry').val());
    });
    $('#copy_lead_primaryphonenumber').click(function(){
       $('#DealDealLeadPrimaryphonenumber').val($('#ActionItemLeadPrimaryphonenumber').val());
    });
    $('#copy_lead_secondaryphonenumber').click(function(){
       $('#DealDealLeadSecondaryphonenumber').val($('#ActionItemLeadSecondaryphonenumber').val());
    });
    $('#copy_lead_emailid').click(function(){
       $('#DealDealLeadEmailid').val($('#ActionItemLeadEmailid').val());
    });
    $('#copy_lead_streetaddress').click(function(){
       $('#DealDealLeadStreetaddress').val($('#ActionItemLeadStreetaddress').val());
    });
    </script>
    <?php
}?>
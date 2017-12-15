<?php if (count($ProjectLegalNames) > 0) { ?>
    <div class="panel-group" id="accordion2">
        <div class="panel panel-default" style="clear:both">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#acc2_collapseSeven">
                        Project Legal Name Details
                    </a>
                </h4>
            </div>
            <div id="acc2_collapseSeven" class="panel-collapse collapse">
                <div class="panel-body">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Legal Address</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php echo $this->Form->input('ActionItem.legal_address', array('value' => $ProjectLegalNames['BuilderLegalName']['builder_legal_names_address'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control')); ?>
                                <span class="copy_right_arrow" id="copy_legal_address"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Legal Location</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('ActionItem.legal_city', array('value' => $ProjectLegalNames['Location']['city_name'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control'));
                                ?>
                                <span class="copy_right_arrow" id="copy_legal_city"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Contact Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('ActionItem.legal_contact', array('value' => $ProjectLegalNames['BuilderContact']['builder_contact_name'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control'));
                                ?>
                                <span class="copy_right_arrow" id="copy_legal_contact"></span>
                            </div>
                        </div>
                        <div class="form-group slt-sm">
                            <label for="reg_input_name">Primary Mobile</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('ActionItem.builder_contact_mobile_country_code', array('options' => $codes, 'selected' => $ProjectLegalNames['BuilderContact']['builder_contact_mobile_country_code'], 'disabled' => true, 'empty' => '--Select--', 'class' => 'form-control', 'label' => false, 'div' => false));
                                echo $this->Form->input('ActionItem.builder_contact_mobile_no', array('class' => 'form-control sm rgt', 'value' => $ProjectLegalNames['BuilderContact']['builder_contact_email'], 'readonly' => true, 'label' => false, 'div' => false));
                                ?>
                                <span class="copy_right_arrow" id="copy_legal_primary"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Primary Email</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"> <?php echo $this->Form->input('ActionItem.legal_email', array('value' => $ProjectLegalNames['BuilderContact']['builder_contact_email'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control')); ?>
                                <span class="copy_right_arrow" id="copy_legal_email"></span>
                            </div>
                        </div>


                    </div>
                    <div class="col-sm-6">

                        <div class="form-group">
                            <label>Legal Address</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"> <?php echo $this->Form->input('Deal.deal_legal_address', array('label' => false, 'div' => false, 'class' => 'form-control')); ?></div>
                        </div>
                        <div class="form-group">
                            <label>Legal Location</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"> <?php echo $this->Form->input('Deal.deal_legal_city', array('label' => false, 'div' => false, 'class' => 'form-control')); ?></div>
                        </div>
                        <div class="form-group">
                            <label>Contact Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"> <?php echo $this->Form->input('Deal.deal_legal_contact', array('label' => false, 'div' => false, 'class' => 'form-control')); ?></div>
                        </div>
                        <div class="form-group slt-sm">
                            <label for="reg_input_name">Primary Mobile</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('Deal.deal_legal_primary_code', array('options' => $codes, 'empty' => '--Select--', 'class' => 'form-control', 'label' => false, 'div' => false));
                                echo $this->Form->input('Deal.deal_legal_primary_no', array('class' => 'form-control sm rgt', 'label' => false, 'div' => false));
                                ?></div>
                        </div>

                        <div class="form-group">
                            <label>Primary Email</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"> <?php echo $this->Form->input('Deal.deal_legal_email', array('label' => false, 'div' => false, 'class' => 'form-control')); ?></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


    </div>
<script>
$('#copy_legal_address').click(function(){
       $('#DealDealLegalAddress').val($('#ActionItemLegalAddress').val());
    });
    $('#copy_legal_city').click(function(){
       $('#DealDealLegalCity').val($('#ActionItemLegalCity').val());
    });
    $('#copy_legal_contact').click(function(){
       $('#DealDealLegalContact').val($('#ActionItemLegalContact').val());
    });
    $('#copy_legal_primary').click(function(){
       $('#DealDealLegalPrimaryCode').val($('#ActionItemBuilderContactMobileCountryCode').val());
       $('#DealDealLegalPrimaryNo').val($('#ActionItemBuilderContactMobileNo').val());
               
    });
    $('#copy_legal_email').click(function(){
       $('#DealDealLegalEmail').val($('#ActionItemLegalEmail').val());
    });
</script>
<?php } ?>

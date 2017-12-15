<?php
$this->Html->addCrumb('Add Package', 'javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->Form->create('PackageStandardMaster', array('method' => 'post',
    'id' => 'parsley_reg',
    'novalidate' => true,
    'inputDefaults' => array(
        'label' => false,
        'div' => false,
        'class' => 'form-control',
    )
));
?>
<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Add Information</h4>
        </div>
        <div class="panel-body">
            <fieldset>
                <legend><span>Add Package</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-6">
                        <h4>Package Basics</h4>
                        <div class="form-group">
                            
                            <label for="reg_input_name" class="req">Package Code</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('StandardPackageCode', array('data-required' => 'true', 'tabindex' => '1'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Selling Currency</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('SellingCurrency', array('options' => $PackageCurrencies, 'empty' => '--Select--', 'tabindex' => '3'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Selling Cost</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('PackageCost', array('type' => 'text', 'tabindex' => '5'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Package Type</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('PackageTypeCode', array('options' => $PackageTypes,'empty' => '--Select--', 'tabindex' => '7'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Package Duration</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('PackageDurationTargetCode', array('options' => $PackageDurationTargets,'empty' => '--Select--', 'tabindex' => '9'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Service Code</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('ServiceScopeCode', array('options' => $ServiceScopes,'empty' => '--Select--', 'tabindex' => '11'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="input_name" class="req">Valid From</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                
                                <div class="input-group date ebro_datepicker event_date_present_div" data-date-format="dd-mm-yyyy" data-date-autoclose="true">
                                    <?php
                                    echo $this->Form->input('PackageValidFrom', array('type' => 'text','id' => 'dpStart', 'data-date-format' => 'dd-mm-yyyy', 'data-date-autoclose' => 'true', 'tabindex' => '13'));
                                    ?>
                                    <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <h4>Package Details</h4>
                        <div class="form-group">
                            <label for="reg_input_name">No. Of Cities</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('NoOfCities', array('options' => $PackageNo1s,'empty' => '--Select--', 'tabindex' => '15'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">No. Of Hotels</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('NoOfHotels', array('options' => $PackageNo2s,'empty' => '--Select--', 'tabindex' => '17'));
                                ?></div>
                        </div>                        
                       <div class="form-group  slt-sm">
                            <label for="reg_input_name">No. Of Adults</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('PackageNoofAdults', array('options' => $PackageNo2s,'empty' => '--Actual--', 'tabindex' => '20'));
                                echo $this->Form->input('PackageNoofAdultsMax', array('options' => $PackageNo2s,'empty' => '--Maximum--', 'tabindex' => '21'));
                                ?></div>
                        </div>
                        
                    </div>
                    
                    <div class="col-sm-6">
                        <h4>&nbsp;</h4>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Package Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('StandardPackageName', array('data-required' => 'true', 'tabindex' => '2'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Buying Currency</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('PackageCurrencyBuy', array('options' => $PackageCurrencies,'empty' => '--Select--', 'tabindex' => '4'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Buying Cost</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('PackageCostBuy', array('type' => 'text', 'tabindex' => '6'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Internal Code</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('PackageTypeInternalCode', array('options' => $PackageTypeInternals,'empty' => '--Select--', 'tabindex' => '8'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Target Nationality</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('PackageNationalityCode', array('options' => $PackageNationalities,'empty' => '--Select--', 'tabindex' => '10'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Service Cost Target</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('ServiceCostTargetCode', array('options' => $ServiceCostTargets,'empty' => '--Select--', 'tabindex' => '12'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="input_name" class="req">Valid To</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                
                                <div class="input-group date ebro_datepicker event_date_present_div" data-date-format="dd-mm-yyyy" data-date-autoclose="true">
                                    <?php
                                    echo $this->Form->input('PackageValidTo', array('type' => 'text','id' => 'dpEnd', 'data-date-format' => 'dd-mm-yyyy', 'data-date-autoclose' => 'true', 'tabindex' => '14'));
                                    ?>
                                    <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <h4>&nbsp;</h4>
                         
                        <div class="form-group">
                            <label for="reg_input_name">No. Of Pax</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('PackageNoofPax', array('options' => $PackageNo2s,'empty' => '--Select--', 'tabindex' => '16'));
                                ?></div>
                        </div>
                        <div class="form-group slt-sm">
                            <label for="reg_input_name">No. Of Children’s</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('PackageNoofChilds', array('options' => $PackageNo2s,'empty' => '--Actual--', 'tabindex' => '18'));
                                echo $this->Form->input('PackageNoofChildsMax', array('options' => $PackageNo2s,'empty' => '--Maximum--', 'tabindex' => '19'));
                                ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="reg_input_name" style="margin-left: 14px">Package Caption</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('PackageSummaryShort', array('type' => 'textarea', 'style' => 'width:122%;height:100px', 'tabindex' => '22'));
                            ?></div>
                    </div>
                    <div class="form-group">
                        <label for="reg_input_name" style="margin-left: 14px">Package Summary</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('PackageSummary', array('type' => 'textarea', 'style' => 'width:122%;height:100px', 'tabindex' => '23'));
                            ?></div>
                    </div>


                    <div class="row">
                        <div class="col-sm-1">
                            <?php
                            echo $this->Form->submit('Add', array('class' => 'btn btn-success sticky_success'));
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
</div>

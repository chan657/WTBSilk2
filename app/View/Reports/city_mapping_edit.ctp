<?php
$this->Html->addCrumb('Edit Supplier City', 'javascript:void(0);', array('class' => 'breadcrumblast'));
//pr($this->data);
?>

<!----------------------------start add project block------------------------------>
<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Edit Supplier City</h4>
        </div>



        <?php
//echo $this->Form->create('Remark', array('enctype' => 'multipart/form-data'));
        echo $this->Form->create('TravelCitySupplier', array('method' => 'post', 'id' => 'parsley_reg', 'novalidate' => true,
            'inputDefaults' => array(
                'label' => false,
                'div' => false,
                'class' => 'form-control',
            ),
            array('controller' => 'reports', 'action' => 'city_mapping_edit')
        ));
        echo $this->Form->hidden('province_name');
        echo $this->Form->hidden('base_url', array('id' => 'hidden_site_baseurl', 'value' => $this->request->base . ((!is_null($this->params['language'])) ? '/' . $this->params['language'] : '')));
        //pr($this->data);
        ?>
        <div class="panel-body">

            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-6">

                        <div class="form-group">
                            <label for="reg_input_name" class="req">Supplier</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('supplier_code', array('id' => 'city_supplier_code', 'options' => $TravelSuppliers, 'empty' => '--Select--', 'data-required' => 'true'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Province</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('province_id', array('options' => $Provinces, 'empty' => '--Select--','data-required' => 'true'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Supp. City Code</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('supplier_city_code', array('data-required' => 'true'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Status</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('city_supplier_status', array('options' => array('1' => 'Submitted For Approval', '2' => 'Approved', '3' => 'Returned', '4' => 'Change Submitted', '5' => 'Rejected', '6' => 'Request For Allocation'), 'empty' => '--Select--'));
                                ?></div>
                        </div>


                    </div>
                    <div class="col-sm-6">

                        <div class="form-group">
                            <label for="reg_input_name" class="req">WTB Country</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('city_country_code', array('id' => 'city_country_code', 'options' => $TravelCountries, 'empty' => '--Select--', 'disabled' => true));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">WTB City</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('pf_city_code', array('id' => 'pf_city_code', 'options' => $TravelCities, 'empty' => '--Select--','data-required' => 'true'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Active?</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('active',array('options' => array('TRUE' => 'TRUE','FALSE' => 'FALSE'),'empty' => '--Select--','data-required' => 'true'));
                                ?></div>
                        </div>
                    </div>
                    <div class="clear" style="clear: both;"></div>
                    <div class="form-group">
                        <label for="reg_input_name" class="req" style="margin-left: 1%">Mapping Name</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('city_mapping_name', array('data-required' => 'true', 'style' => 'width:123%'));
                            ?></div>
                    </div>
                    <div class="clear" style="clear: both;"></div>
                    <div class="row">
                        <div class="col-sm-12"><?php echo $this->Form->submit('Update', array('class' => 'success btn', 'div' => false, 'id' => 'udate_unit')); ?><?php
                            //echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'reset btn'));
                            ?></div>
                    </div>
                </div>
            </div>	
        </div>	
        <?php echo $this->Form->end();
        ?>
    </div>	
</div>

<script>

    var FULL_BASE_URL = $('#hidden_site_baseurl').val(); // For base path of value;
    
    $('#TravelCitySupplierProvinceId').change(function(){    
      $('#TravelCitySupplierProvinceName').val($('#TravelCitySupplierProvinceId option:selected').text());
    });
</script>

<!----------------------------end add project block------------------------------>

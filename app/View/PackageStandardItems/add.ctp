<?php
echo $this->Html->css(array('/bootstrap/css/bootstrap.min', 'popup',
    'todc-bootstrap.min',
    'font-awesome/css/font-awesome.min',
    '/js/lib/datepicker/css/datepicker',
    '/js/lib/timepicker/css/bootstrap-timepicker.min'
        )
);
echo $this->Html->script(array('jquery.min', 'lib/chained/jquery.chained.remote.min', 'lib/jquery.inputmask/jquery.inputmask.bundle.min', 'lib/parsley/parsley.min', 'pages/ebro_form_validate', 'lib/datepicker/js/bootstrap-datepicker', 'lib/timepicker/js/bootstrap-timepicker.min', 'pages/ebro_form_extended'));
echo $this->Form->create('PackageStandardItem', array('method' => 'post',
    'id' => 'parsley_reg',
    'novalidate' => true,
    'inputDefaults' => array(
        'label' => false,
        'div' => false,
        'class' => 'form-control',
    )
));
echo $this->Form->hidden('base_url',array('id' => 'hidden_site_baseurl', 'value' => $this->request->base . ((!is_null($this->params['language'])) ? '/' . $this->params['language'] : '')));
echo $this->Form->hidden('model_name', array('id' => 'model_name', 'value' => 'PackageStandardItem'));
echo $this->Form->hidden('PackageItemCountryCode');
echo $this->Form->hidden('PackageItemCityCode');
echo $this->Form->hidden('PackageItemType');

?>
<div class="pop-outer">
    <div class="pop-up-hdng">Add Package Standard Item</div>
    <div class="col-sm-12" id="mycl-det">


        <div class="row">
            <div class="col-sm-12">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="reg_input_name" class="req">Item Type</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('PackageItemTypeId', array('options' => $PackageItems, 'empty' => '--Select--', 'data-required' => 'true'));
                            ?></div>
                    </div>
                    <div class="form-group">
                        <label for="reg_input_name" class="req">City Code</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('PackageItemCityId', array('options' => array(), 'empty' => '--Select--', 'data-required' => 'true'));
                            ?></div>
                    </div>
                    

                    <div class="form-group">
                        <label for="reg_input_name">PackageItemOrder1</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('PackageItemOrder1', array('type' => 'text'));
                            ?></div>
                    </div>
                    <div class="form-group">
                        <label for="reg_input_name">PackageItemOrder3</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('PackageItemOrder3', array('type' => 'text'));
                            ?></div>
                    </div>
                    <div class="form-group">
                        <label for="reg_input_name">PackageItemOrder5</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('PackageItemOrder5', array('type' => 'text'));
                            ?></div>
                    </div>




                </div>
                <div class="col-sm-6">
                   <div class="form-group">
                        <label for="reg_input_name" class="req">Country Code</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('PackageItemCountryId', array('options' => $TravelCountries, 'empty' => '--Select--', 'data-required' => 'true'));
                            ?></div>
                    </div>
                    <div id="ajax"></div>
                    
                    <div class="form-group">
                        <label for="reg_input_name">ItemCodeIdLinked</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('ItemCodeIdLinked', array('type' => 'text'));
                            ?></div>
                    </div>
                    <div class="form-group">
                        <label for="reg_input_name">PackageItemOrder2</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('PackageItemOrder2', array('type' => 'text'));
                            ?></div>
                    </div>
                    <div class="form-group">
                        <label for="reg_input_name">PackageItemOrder4</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('PackageItemOrder4', array('type' => 'text'));
                            ?></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="reg_input_name">ItemSummaryShort</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10">
                        <?php
                        echo $this->Form->input('ItemSummaryShort', array('type' => 'textarea', 'style' => 'width:122%;height:100px'));
                        ?></div>
                </div>
                <div class="form-group">
                    <label for="reg_input_name">ItemSummary</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10">
                        <?php
                        echo $this->Form->input('ItemSummary', array('type' => 'textarea', 'style' => 'width:122%;height:100px'));
                        ?></div>
                </div>
                <div style="clear: both;"></div>


                <div class="row">
                    <div class="col-sm-1">
                        <?php
                        echo $this->Form->submit('Add', array('class' => 'success btn'));
                        ?>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">




    $(document).ready(function() {

        var FULL_BASE_URL = $('#hidden_site_baseurl').val();


        $('#PackageStandardItemPackageItemCountryId').change(function() {

            var country_id = $(this).val();         
            var dataString = 'country_id=' + country_id;
            $('.success').attr('disabled', 'true');
            $('#PackageStandardItemPackageItemCityId').attr('disabled', 'true');

            $.ajax({
                type: "POST",
                data: dataString,
                url: FULL_BASE_URL + '/all_functions/ajax_get_travel_city_by_country_id',
                beforeSend: function() {
                   $('.success').attr('disabled', 'true');
                    $('#PackageStandardItemPackageItemCityId').attr('disabled', 'true');
                },
                success: function(return_data) {                 
                    $('.success').removeAttr('disabled', 'false');
                    $('#PackageStandardItemPackageItemCityId').removeAttr('disabled', 'false');
                    $('#PackageStandardItemPackageItemCityId').html(return_data);                   
                }
            });

        });
        
        $('#PackageStandardItemPackageItemCityId').change(function() {

            var city_id = $(this).val();
            var country_id = $('#PackageStandardItemPackageItemCountryId').val();
            var item_type = $('#PackageStandardItemPackageItemTypeId').val();
            // alert(channel_id);
            var model = $('#model_name').val();
            var dataString = 'country_id=' + country_id + '&model=' + model + '&item_type=' + item_type+ '&city_id=' + city_id;           
            $('#ajax').addClass('loader');
            $('.success').attr('disabled', 'true');
            $.ajax({
                type: "POST",
                data: dataString,
                url: FULL_BASE_URL + '/all_functions/ajax_get_travel_item',
                beforeSend: function() {
                   
                   $('#ajax').addClass('loader');
                   $('.success').attr('disabled', 'true');
                },
                success: function(return_data) {                   
                    $('#ajax').removeClass('loader');
                    $('.success').removeAttr('disabled', 'false');
                    $('#ajax').html(return_data);
                }
            });

        });
      $('#PackageStandardItemPackageItemCountryId').change(function() {
            $('#PackageStandardItemPackageItemCountryCode').val($('#PackageStandardItemPackageItemCountryId option:selected').text());
        });
        
        $('#PackageStandardItemPackageItemCityId').change(function() {
            $('#PackageStandardItemPackageItemCityCode').val($('#PackageStandardItemPackageItemCityId option:selected').text());
        });
        $('#PackageStandardItemPackageItemTypeId').change(function() {
            $('#PackageStandardItemPackageItemType').val($('#PackageStandardItemPackageItemTypeId option:selected').text());
        });
      
        
    });
    
    
</script>

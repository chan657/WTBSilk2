<?php
$this->Html->addCrumb('View / Edit Country', 'javascript:void(0);', array('class' => 'breadcrumblast'));
?>

<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">View / Edit Information</h4>
            
        </div>

        <div class="panel-body">
            <fieldset>
                <legend><span>View / Edit Country</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    echo $this->Form->create('TravelCountry', array('method' => 'post', 'id' => 'parsley_reg', 'class' => 'form-horizontal user_form', 'novalidate' => true,
                        'inputDefaults' => array(
                            'label' => false,
                            'div' => false,
                            'class' => 'form-control',
                        )
                    ));
                  
                    echo $this->Form->hidden('continent_name');
                    ?>
                    <div class="col-sm-6"> 
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['TravelCountry']['country_name']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('country_name', array('data-required' => 'true')); ?>
                                </div>
                            </div>
                        </div>   
                        <div class="form-group">
                            <label for="reg_input_name">Top Country</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['TravelCountry']['top_country']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('top_country', array('options' => array('TRUE' => 'TRUE', 'FALSE' => 'FALSE'), 'empty' => '--Select--')); ?>
                                </div>
                            </div>
                        </div>
                    
                        
                    </div>  
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name">Code</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['TravelCountry']['country_code']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('country_code', array('readonly' => true)); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Continent</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['TravelCountry']['continent_name']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('continent_id',array('options' => $TravelLookupContinents,'empty' => '--Select--', 'data-required' => 'true')); ?>
                                </div>
                            </div>
                        </div>
                        
                        
                        
                        
                    </div>
                    <div class="form-group">
                        <label style="margin-left: 14px">Description</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10 editable">
                            <p class="form-control-static"><?php echo $this->data['TravelCountry']['country_comment']; ?></p>
                            <div class="hidden_control">
<?php echo $this->Form->input('country_comment', array('type' => 'textarea','style' => 'width:122%;height:100px')); ?>
                            </div>
                        </div>
                    </div>
                    <h4>Mapping Information</h4>
                    
                    <table border="0" cellpadding="0" cellspacing="0" id="resp_table" class="table toggle-square myclitb" data-filter="#table_search" data-page-size="100">
                <thead>
                   
                    <tr>                        
                        <th data-toggle="phone"  data-group="group1">Supplier Code</th>                        
                        <th data-hide="phone"  data-group="group1">Mapping Status</th>                                                              
                        <th data-hide="phone" data-sort-ignore="true" data-group="group1">Mapping Active?</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group1">Mapping Excluded?</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group1">Mapping Name</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group1">WTB</th> 
                        <th data-hide="phone" data-sort-ignore="true" data-group="group1">Supplier</th>  
                                            
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //pr($TravelCountrySuppliers);
                    if (isset($TravelCountrySuppliers) && count($TravelCountrySuppliers) > 0):
                        foreach ($TravelCountrySuppliers as $TravelCountrySupplier):
                            $id = $TravelCountrySupplier['TravelCountrySupplier']['id'];
                            $status = $TravelCountrySupplier['TravelCountrySupplier']['country_suppliner_status'];
                            if ($status == '1')
                                $status_txt = 'Submitted For Approval';
                            elseif ($status == '2')
                                $status_txt = 'Approved';
                            elseif ($status == '3')
                                $status_txt = 'Returned';
                            elseif ($status == '4')
                                $status_txt = 'Change Submitted';
                            elseif ($status == '5')
                                $status_txt = 'Rejection';
                            elseif ($status == '6')
                                $status_txt = 'Request For Allocation';
                            else
                                $status_txt = 'Allocation';
                            ?>
                            <tr>
                              
                                <td><?php echo $TravelCountrySupplier['TravelCountrySupplier']['supplier_code']; ?></td>
                                <td><?php echo $status_txt; ?></td>
                                <td><?php echo $TravelCountrySupplier['TravelCountrySupplier']['active']; ?></td>                                                          
                               
                                <td><?php echo $TravelCountrySupplier['TravelCountrySupplier']['excluded']; ?></td>
                                <td><?php echo $TravelCountrySupplier['TravelCountrySupplier']['country_mapping_name']; ?></td>
                                <td><?php echo $TravelCountrySupplier['TravelCountrySupplier']['pf_country_code']; ?></td>
                                <td><?php echo $TravelCountrySupplier['TravelCountrySupplier']['supplier_country_code']; ?></td>
                              </tr>
                        <?php endforeach; ?>

                        <?php
                      
                    else:
                        echo '<tr><td colspan="7" class="norecords">No Records Found</td></tr>';
                    endif;
                    ?>
                </tbody>
            </table>


                    <div class="form_submit clearfix" style="display:none">
                        <div class="row">
                            <div class="col-sm-1">
                                <?php
                                echo $this->Form->submit('Update', array('class' => 'btn btn-success sticky_success'));
                                ?>
                            </div>
                            <div class="col-sm-1">
                                <?php echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'btn btn-danger sticky_important')); ?>
                            </div>
                        </div>
                    </div>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
 
<script>
    $('#TravelCountryContinentId').change(function(){    
      $('#TravelCountryContinentName').val($('#TravelCountryContinentId option:selected').text());
    });
 
    
</script>



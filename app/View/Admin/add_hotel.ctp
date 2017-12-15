<?php
$this->Html->addCrumb('Add Supplier Hotel', 'javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->Form->create('SupplierHotel', array('method' => 'post',
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
                <legend><span>Add Supplier Hotel</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-6">
                       <div class="form-group">
                            <label for="reg_input_name" class="req">Supplier</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('supplier_id', array('options' => $TravelSuppliers, 'empty' => '--Select--', 'data-required' => 'true'));
                                ?></div>
                        </div>  
                        <div class="form-group">
                            <label for="reg_input_name" class="req">City</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('city_id', array('options' => array(), 'empty' => '--Select--', 'data-required' => 'true'));
                                ?></div>
                        </div>
                       
                    </div>
                    
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Country</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('country_id', array('options' => $SupplierCountries, 'empty' => '--Select--','data-required' => 'false'));
                                ?></div>
                        </div>
                         
                    </div>
                  
                    <div style="clear:both"></div>

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
 <?php 
echo $this->Form->end(); 
//$data = $this->Js->get('#parsley_reg')->serializeForm(array('isForm' => true, 'inline' => true));

$this->Js->get('#SupplierHotelCountryId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_supplier_city_by_country_id/SupplierHotel/country_id'
                ), array(
            'update' => '#SupplierHotelCityId',
            'async' => true,
            'before' => 'loading("SupplierHotelCityId")',
            'complete' => 'loaded("SupplierHotelCityId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);

 


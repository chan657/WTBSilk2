<?php
$this->Html->addCrumb('Add Country Mapping', 'javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->Form->create('SupplierCountry', array('method' => 'post',
    'id' => 'parsley_reg',
    'novalidate' => true,
    'inputDefaults' => array(
        'label' => false,
        'div' => false,
        'class' => 'form-control',
    ),
));
echo $this->Form->hidden('supplier_country_id',array('value' => $SupplierCountries['SupplierCountry']['id'],'type' => 'text'));
echo $this->Form->hidden('country_id',array('value' => $TravelCountries['TravelCountry']['id'],'type' => 'text'));
?>
<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Country Mapping</h4>
        </div>
        <div class="panel-body">
           
            <div class="row">
                
                <div class="col-sm-12"  style="background-color: rgb(211, 233, 237);overflow:hidden;">
                    <div class="col-sm-6">
                        <h4>Supplier Country</h4>
                        <div class="form-group">
                            <label for="reg_input_name" class="bgr">Id</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $SupplierCountries['SupplierCountry']['id'];
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Country</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $SupplierCountries['SupplierCountry']['name'];
                                ?></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                       <h4>&nbsp;</h4>
                       <div class="form-group">
                            <label for="reg_input_name" class="req">Continent</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                </div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Code</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo '<b>'.$SupplierCountries['SupplierCountry']['code'].'</b>';
                                ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12"  style="background-color: rgb(238, 221, 255);overflow:hidden;">
                    <div class="col-sm-6">
                        <h4>Country</h4>
                        <div class="form-group">
                            <label for="reg_input_name" class="bgr">Id</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo '<b>'.$TravelCountries['TravelCountry']['id'].'</b>';
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Country</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $TravelCountries['TravelCountry']['country_name'];
                                ?></div>
                        </div>
                        
                    </div>
                    <div class="col-sm-6">
                        <h4>&nbsp;</h4>
                       <div class="form-group">
                            <label for="reg_input_name" class="req">Continent</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $TravelCountries['TravelCountry']['continent_name'];
                                ?></div>
                        </div>
                        
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Code</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $TravelCountries['TravelCountry']['country_code'];
                                ?></div>
                        </div>
                    </div>
                </div>   
                <div class="clear" style="clear: both;"></div>
                <div class="col-sm-12">
                    <div class="row">  
                        
                        <div class="col-sm-2">
                            <?php
                            echo $this->Form->submit('Add', array('class' => 'btn btn-success sticky_success','name' => 'add','style' => 'width:100%;float:left'));                            
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
echo $this->Form->end();
?>

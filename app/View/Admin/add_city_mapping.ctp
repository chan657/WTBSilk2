<?php
$this->Html->addCrumb('Add City Mapping', 'javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->Form->create('SupplierCity', array('method' => 'post',
    'id' => 'parsley_reg',
    'novalidate' => true,
    'inputDefaults' => array(
        'label' => false,
        'div' => false,
        'class' => 'form-control',
    ),
));
echo $this->Form->hidden('supplier_city_id',array('value' => $SupplierCities['SupplierCity']['id'],'type' => 'text'));
echo $this->Form->hidden('city_id',array('value' => $TravelCities['TravelCity']['id'],'type' => 'text'));
//pr($TravelCities);

?>
<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">City Mapping</h4>
        </div>
        <div class="panel-body">
           
            <div class="row">
                
                <div class="col-sm-12"  style="background-color: rgb(211, 233, 237);overflow:hidden;">
                    <div class="col-sm-6">
                        <h4>Supplier City</h4>
                        <div class="form-group">
                            <label for="reg_input_name">Id</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $SupplierCities['SupplierCity']['id'];
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Country</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $SupplierCities['SupplierCity']['country_name'];
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Code</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo '<b>'.$SupplierCities['SupplierCity']['code'].'</b>';
                                ?></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                       <h4>&nbsp;</h4>
                       <div class="form-group">
                            <label for="reg_input_name">Continent</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                </div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">City</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $SupplierCities['SupplierCity']['name'];
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
                                echo '<b>'.$TravelCities['TravelCity']['id'].'</b>';
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Country</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $TravelCities['TravelCity']['country_name'];
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Code</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $TravelCities['TravelCity']['city_code'];
                                ?></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <h4>&nbsp;</h4>
                       <div class="form-group">
                            <label for="reg_input_name">Continent</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $TravelCities['TravelCity']['continent_name'];
                                ?></div>
                        </div>
                        
                        <div class="form-group">
                            <label for="reg_input_name">City</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $TravelCities['TravelCity']['city_name'];
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

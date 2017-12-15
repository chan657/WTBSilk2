<?php
$this->Html->addCrumb('City Mapping', 'javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->Form->create('Common', array(
    'url' => array('controller' => 'admin', 'action' => 'add_city_mapping'),'method' => 'get'
));
/*
echo $this->Form->create('Test', array('/admin/add_country_mapping','method' => 'post', 'id' => 'parsley_reg', 'novalidate' => true,
    'inputDefaults' => array(
        'label' => false,
        'div' => false,
        'class' => 'form-control',
    ),
    array('controller' => 'admin', 'action' => 'add')
));
 * 
 */
echo $this->Form->hidden('supplier_city_id',array('value' => $this->data['SupplierCity']['id']));
echo $this->Form->hidden('supplier_city_name',array('value' => $this->data['SupplierCity']['name']));
echo $this->Form->hidden('supplier_city_code',array('value' => $this->data['SupplierCity']['code']));
echo $this->Form->hidden('supplier_country_code',array('value' => $this->data['SupplierCity']['country_code']));
?>
<style>
  .form-group{
        margin-left: -15px;
        margin-right: -15px;
        margin-bottom: 6px;
        overflow: hidden;
        z-index: 1;
        position: relative;
        clear: both;
  }
    </style>
<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">City Mapping</h4>
        </div>
        <div class="panel-body">           
            <div class="row">                
                <div class="col-sm-12">
                    <div class="col-sm-6">                        
                        <div class="form-group">
                            <label for="reg_input_name" class="bgr">Id</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->data['SupplierCity']['id'];
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="bgr">Country</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->data['SupplierCity']['country_name'];
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">City</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->data['SupplierCity']['name'];
                                ?></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                       <div class="form-group">
                            <label for="reg_input_name" class="req">Continent</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                </div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="bgr">Country Code</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->data['SupplierCity']['country_code'];
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Code</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo '<b>'.$this->data['SupplierCity']['code'].'</b>';
                                ?></div>
                        </div>
                    </div>
                </div>      
            
                
                <div class="clear" style="clear: both; margin-bottom: 10px;"></div>
                <div class="col-sm-12">
                <table border="0" cellpadding="0" cellspacing="0" id="resp_table" class="table toggle-square myclitb" data-filter="#table_search" data-page-size="3000">
                <thead>         
                    <tr>
                        <th data-toggle="true" data-group="group1" width="5%">Id</th>  
                        <th data-hide="phone" data-group="group1" width="10%"  data-sort-ignore="true">Continent Name</th> 
                        <th data-hide="phone" data-group="group1" width="10%">Country Name</th>
                        <th data-hide="phone" data-group="group1" width="10%" data-sort-ignore="true">Country Code</th>
                        <th data-hide="phone" data-group="group1" width="10%" data-sort-ignore="true">Province Name</th>
                        <th data-hide="phone" data-group="group1" width="10%" data-sort-ignore="true">City Name</th>
                        <th data-hide="phone" data-group="group1" width="10%" data-sort-ignore="true">City Code</th>
                        <th data-group="group4" data-hide="phone" data-sort-ignore="true" width="3%">Action</th>        
                    </tr>
                </thead>
                <tbody>
<?php

if (isset($TravelCities) && count($TravelCities) > 0):
    foreach ($TravelCities as $TravelCity):
        $id = $TravelCity['TravelCity']['id'];
        
        if($id)
            $tr_style = 'style="background-color:#5DD0ED"';
        else
            $tr_style = 'style="background-color:#FFFFFF"';
        ?>
                            <tr>
                                <td class="tablebody"><?php echo $id; ?></td>
                                <td class="tablebody"><?php echo $TravelCity['TravelCity']['continent_name']; ?></td> 
                                <td class="tablebody"><?php echo $TravelCity['TravelCity']['country_name']; ?></td>                                                              
                                <td class="tablebody"><?php echo $TravelCity['TravelCity']['country_code']; ?></td>
                                <td class="tablebody"><?php echo $TravelCity['TravelCity']['province_name']; ?></td>
                                <td class="tablebody"><?php echo $TravelCity['TravelCity']['city_name']; ?></td>
                                <td class="tablebody"><?php echo $TravelCity['TravelCity']['city_code']; ?></td>
                                <td width="10%" valign="middle" align="center">
                                    <?php 
                                        $options=array($id=>'');
                                        $attributes=array('legend'=>false, 'hiddenField' => false,'label' => false,'div' => false,'class' => 'attrInputs');
                                        echo $this->Form->radio('city_id',$options,$attributes);
                                        ?>                                
                                </td>
                            </tr>
        <?php endforeach; ?>

                        <?php
                        echo $this->element('paginate');
                    else:
                        echo '<tr><td colspan="7" class="norecords">No Records Found</td></tr>';

                    endif;
                    ?>
                </tbody>
            </table>                 
                </div>
                <div class="clear" style="clear: both;"></div>
                <div class="col-sm-12">
                    <div class="row">  
                        
                        <div class="col-sm-2">
                            <?php
                            //echo $this->Html->link('Proceed to Mapped', '/admin/add_country_mapping/'.$this->data['SupplierCountry']['id'], array('class' => 'btn btn-success', 'escape' => false));        
                            //echo $this->Html->link('Proceed to Mapped', array('/admin/add_country_mapping'), array('class' => 'btn btn-success sticky_success', 'escape' => false));
                            echo $this->Form->submit('Proceed to Mapped', array('class' => 'btn btn-success sticky_success','id' => 'ClickRadioMandatory','name' => 'mapped','style' => 'width:100%;float:left'));
                            //echo $this->Form->submit('Submit Insert', array('class' => 'btn btn-success sticky_success','name' => 'add','style' => 'width:100%;float:left;'));
                            ?>
                        </div>
                        <div class="col-sm-2">
                            <?php
                            //echo $this->Form->submit('Proceed to Mapped', array('class' => 'btn btn-success sticky_success','name' => 'add','style' => 'width:100%;float:left'));
                            echo $this->Form->submit('Submit Insert', array('class' => 'btn btn-success sticky_success','name' => 'inserted','style' => 'width:100%;float:left;','onclick' => "return confirm('Are you sure you want to create support ticket?')"));
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

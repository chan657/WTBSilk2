<?php
$this->Html->addCrumb('Edit Pattern', 'javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->Form->create('DigPattern', array( 'method' => 'post',
    'id' => 'parsley_reg',
    'novalidate' => true,
    'inputDefaults' => array(
        'label' => false,
        'div' => false,
        'class' => 'form-control',
    )
));

echo $this->Form->hidden('base_url', array('id' => 'hidden_site_baseurl', 'value' => $this->request->base . ((!is_null($this->params['language'])) ? '/' . $this->params['language'] : '')));
App::import('Model', 'User');
$attr = new User();
?>

<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Edit Information</h4>
        </div>
        <div class="panel-body">
            <fieldset>
                <legend><span>Edit Pattern</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-6">


                        <div class="form-group">
                            <label for="reg_input_name" class="req">Pattern Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('pattern_name', array('data-required' => 'true','tabindex' => '1'));
                                ?></div>
                        </div>
                         <div class="form-group">
                            <label for="reg_input_name">Pattern Tier</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('pattern_tier_id', array('options' => $DigMediaLookupLinkTiers, 'empty' => '--Select--','tabindex' => '3'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Bonus No. Of Links</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('pattern_bonus_number_of_links',array('tabindex' => '5'));
                                ?></div>
                        </div>
                         <div class="form-group slt-sm">
                            <label for="reg_input_name">Duration Unit</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                        <?php
                        echo $this->Form->input('pattern_duration', array('class' => 'form-control sm rgt', 'tabindex' => '7', 'style' => 'float:left;'));
                        echo $this->Form->input('pattern_duration_unit', array('options' => $DigMediaLookupDurationUnits, 'empty' => '--Select--', 'tabindex' => '8', 'style' => 'float:left;margin-left:4px'));
                        ?></div>
                        </div>
                     
                        
                        
                        </div>
                       
                       
                       

                    
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name">Pattern Type</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('pattern_type_id', array('options' =>$DigBaseTypes, 'empty' => '--Select--','tabindex' => '2'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Active?</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('pattern_active', array('options' => array('TRUE' => 'TRUE', 'FALSE' => 'FALSE'), 'empty' => '--Select--','tabindex' => '4'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">No. Of Links</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('pattern_number_of_links',array('tabindex' => '6'));
                                ?></div>
                        </div>
                         <div class="form-group slt-sm">
                            <label for="reg_input_name">Duration Unit</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                        <?php
                        echo $this->Form->input('pattern_review_duration', array('class' => 'form-control sm rgt', 'tabindex' => '9', 'style' => 'float:left;'));
                        echo $this->Form->input('pattern_review_duration_unit', array('options' => $DigMediaLookupDurationUnits, 'empty' => '--Select--', 'tabindex' => '10', 'style' => 'float:left;margin-left:4px'));
                        ?></div>
                        </div>
                        
                       
                      
                       
                        </div>
                    <div class="form-group">
                                            <label for="reg_input_name" style="margin-left: 14px">Description</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">
                                                <?php
                                                echo $this->Form->input('pattern_description', array('type' => 'textarea', 'style' => 'width:122%;height:100px','tabindex' => '11'));
                                                ?></div>
                                        </div>
                    <div class="form-group">
                                            <label for="reg_input_name" style="margin-left: 14px">Special Instruction</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">
                                                <?php
                                                echo $this->Form->input('pattern_special_instruction', array('type' => 'textarea', 'style' => 'width:122%;height:100px','tabindex' => '12'));
                                                ?></div>
                                        </div>
                    
                     <div class="row">
                        <div class="col-sm-12">
                            <div class="panel-group" id="accordion1">                                                       
                          
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title fpt">
                                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#acc1_collapseOne">
                                                Person Information
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="acc1_collapseOne" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="col-sm-12">
                                                <div class="form-control-static">
                                                    <div class="table-heading disimp">
                                                        <h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php echo count($DigPatternPersons); ?>
                                                            <?php echo $this->Html->link('Add Person', '/dig_patterns/add_person/'.$this->data['DigPattern']['id'], array('class' => 'open-popup-link add-btn')); ?>
                                                            </span>Person Details</h4></div><table class="table toggle-square responsive_table" data-filter="#table_search" data-page-size="40">
                                                        <thead>
                                                            <tr>
                                                                <th data-toggle="true">Pattern Id</th>
                                                                <th data-hide="phone">Channel</th>
                                                                <th data-hide="phone">User</th>
                                                                <th data-hide="phone">Person</th>                                                               
                                                            </tr>
                                                        </thead>
                                                        <tbody>  
                                                            <?php
	//pr($DigMediaLinks);
                                                            if (count($DigPatternPersons) && !empty($DigPatternPersons)) {
                                                                foreach ($DigPatternPersons as $DigPatternPerson) {
                                                                   // pr($DigMediaLink['DigMediaLookupLinkTier']);
                                                                    ?> 
                                                                    <tr>
                                                                        <td><?php echo $DigPatternPerson['DigPattern']['pattern_name'] ?></td>
                                                                        <td><?php echo $DigPatternPerson['Channel']['channel_name']; ?></td>
                                                                        <td><?php echo $attr->Username($DigPatternPerson['DigPatternPerson']['user_id']); ?></td>
                                                                        <td><?php echo $DigPatternPerson['DigPerson']['person_name'] ?></td>
                                                                       
                                                                    </tr>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </tbody>   
                                                    </table>
                                                </div>
                                                
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title fpt">
                                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#acc1_collapseTwo">
                                                Lot Information
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="acc1_collapseTwo" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="col-sm-12">
                                                <div class="form-control-static">
                                                    <div class="table-heading disimp">
                                                        <h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php echo count($DigPatternLots); ?>
                                                            <?php echo $this->Html->link('Add Lot', '/dig_patterns/add_lot/'.$this->data['DigPattern']['id'], array('class' => 'open-popup-link add-btn')); ?>
                                                            </span>Lot Details</h4></div><table class="table toggle-square responsive_table" data-filter="#table_search" data-page-size="40">
                                                        <thead>
                                                            <tr>
                                                                <th data-toggle="true">Pattern Id</th>
                                                                <th data-hide="phone">Channel</th>                                                                
                                                                <th data-hide="phone">Lot</th>                                                               
                                                            </tr>
                                                        </thead>
                                                        <tbody>  
                                                            <?php
	//pr($DigMediaLinks);
                                                            if (count($DigPatternLots) && !empty($DigPatternLots)) {
                                                                foreach ($DigPatternLots as $DigPatternLot) {
                                                                   // pr($DigMediaLink['DigMediaLookupLinkTier']);
                                                                    ?> 
                                                                    <tr>
                                                                        <td><?php echo $DigPatternLot['DigPattern']['pattern_name'] ?></td>
                                                                        <td><?php echo $DigPatternLot['Channel']['channel_name']; ?></td>                                                                        
                                                                        <td><?php echo $DigPatternLot['DigLot']['lot_name'] ?></td>                                                                       
                                                                    </tr>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </tbody>   
                                                    </table>
                                                </div>
                                                
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-1">
                            <?php
                            echo $this->Form->submit('Submit', array('name' => 'add','class' => 'btn btn-success sticky_success','value' =>'add'));
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






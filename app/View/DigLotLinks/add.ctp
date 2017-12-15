<?php
$this->Html->addCrumb('Add Lot Links', 'javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->Form->create('DigLotLink', array('enctype' => 'multipart/form-data', 'method' => 'post',
    'id' => 'parsley_reg',
    'novalidate' => true,
    'inputDefaults' => array(
        'label' => false,
        'div' => false,
        'class' => 'form-control',
    )
));

echo $this->Form->hidden('base_url', array('id' => 'hidden_site_baseurl', 'value' => $this->request->base . ((!is_null($this->params['language'])) ? '/' . $this->params['language'] : '')));
?>

<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Add Information</h4>
        </div>
        <div class="panel-body">
            <fieldset>
                <legend><span>Add Lot Links</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-6">


                        <div class="form-group">
                            <label for="reg_input_name" class="req">Base Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('lot_links_base_id', array('options' => $DigBases, 'empty' => '--Select--', 'data-required' => 'true','tabindex' => '1'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Exact URL</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('lot_links_exact_url', array('data-required' => 'true','tabindex' => '3'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Usage Status</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('lot_links_usage_status',  array('options' => $DigLotLinkUsageStatus, 'empty' => '--Select--', 'data-required' => 'true','tabindex' => '5'));
                                ?></div>
                        </div>
                       

                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Lot Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('lot_links_lot_id', array('options' => $DigLots, 'empty' => '--Select--', 'data-required' => 'true','tabindex' => '2'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Sample URL</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('lot_links_sample_url', array('data-required' => 'true','tabindex' => '4'));
                                ?></div>
                        </div>
                         <div class="form-group">
                            <label for="reg_input_name">Active?</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('active', array('options' => array('TRUE' => 'TRUE', 'FALSE' => 'FALSE'), 'empty' => '--Select--','tabindex' => '6'));
                                ?></div>
                        </div>
                        
                    </div>
                </div>
                <div style="clear: both"></div>
                                      

                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="reg_input_name" style="margin-left: 14px">Description</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('lot_links_description', array('type' => 'textarea', 'style' => 'width:122%;height:100px','tabindex' => '7'));
                            ?></div>
                    </div>
                    <div class="form-group">
                        <label for="reg_input_name" style="margin-left: 14px">Comment</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('lot_links_comment', array('type' => 'textarea', 'style' => 'width:122%;height:100px','tabindex' => '8'));
                            ?></div>
                    </div>
                    <div class="form-group">
                        <label for="reg_input_name" style="margin-left: 14px">Instructions</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('lot_links_instructions', array('type' => 'textarea', 'style' => 'width:122%;height:100px','tabindex' => '9'));
                            ?></div>
                    </div>

                    <div class="row">
                        <div class="col-sm-1">
                            <?php
                            echo $this->Form->submit('Submit', array('class' => 'btn btn-success sticky_success'));
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
$data = $this->Js->get('#parsley_reg')->serializeForm(array('isForm' => true, 'inline' => true));

$this->Js->get('#DigAccountAccountPersonId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_dig_person_dtl_by_person_id/DigAccount/account_person_id'
                ), array(
            'update' => '#ajax_person',
            'async' => true,
            // 'before' => 'loading("TravelChainChainHqCityId")',
            // 'complete' => 'loaded("TravelChainChainHqCityId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $data
        ))
);
?> 





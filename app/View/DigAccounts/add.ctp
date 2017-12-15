<?php
$this->Html->addCrumb('Add Account', 'javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->Form->create('DigAccount', array('enctype' => 'multipart/form-data', 'method' => 'post',
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
                <legend><span>Add Account</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-6">


                        <div class="form-group">
                            <label for="reg_input_name" class="req">Base Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('account_base_id', array('options' => $DigBases, 'empty' => '--Select--', 'data-required' => 'true','tabindex' => '1'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Public URL</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('account_public_url', array('data-required' => 'true','tabindex' => '3'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Example Profile URL</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('account_ex_profile_url', array('data-required' => 'true','tabindex' => '5'));
                                ?></div>
                        </div>
                        <h4>Account Statistics </h4>
                        <div class="form-group">
                            <label for="reg_input_name">Account PR</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('account_profile_pr',array('tabindex' => '6'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Account PA</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('account_profile_pa',array('tabindex' => '8'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Usage Status</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('account_usage_status', array('options' => $DigAccountUsages, 'empty' => '--Select--', 'data-required' => 'true','tabindex' => '10'));
                                ?></div>
                        </div>

                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Person Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('account_person_id', array('options' => $DigPersons, 'empty' => '--Select--', 'data-required' => 'true','tabindex' => '2'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Profile URL</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('account_profile_url', array('data-required' => 'true','tabindex' => '4'));
                                ?></div>
                        </div>
                        
                        <h4>&nbsp;</h4>
                        <h4>&nbsp;</h4>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Account DA</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('account_profile_da', array('data-required' => 'true','tabindex' => '7'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Account DF</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('account_profile_df', array('options' => $DigAccountDofollows, 'empty' => '--Select--', 'data-required' => 'true','tabindex' => '9'));
                                ?></div>
                        </div>                    

                        <div class="form-group">
                            <label for="reg_input_name" class="req">Active?</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('active', array('options' => array('TRUE' => 'TRUE', 'FALSE' => 'FALSE'), 'empty' => '--Select--','tabindex' => '11'));
                                ?></div>
                        </div>

                    </div>
                </div>
                <div style="clear: both"></div>
                <div class="col-sm-12" id="ajax_person">   </div>                           

                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="reg_input_name" style="margin-left: 14px">Account Description</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('account_description', array('type' => 'textarea', 'style' => 'width:122%;height:100px','tabindex' => '12'));
                            ?></div>
                    </div>
                    <div class="form-group">
                        <label for="reg_input_name" style="margin-left: 14px">Account Comment</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('account_usage_comment', array('type' => 'textarea', 'style' => 'width:122%;height:100px','tabindex' => '13'));
                            ?></div>
                    </div>
                    <div class="form-group">
                        <label for="reg_input_name" style="margin-left: 14px">Account Instructions</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('account_instructions', array('type' => 'textarea', 'style' => 'width:122%;height:100px','tabindex' => '14'));
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





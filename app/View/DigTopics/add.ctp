<?php
$this->Html->addCrumb('Add Topic', 'javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->Form->create('DigTopic', array('method' => 'post',
    'id' => 'parsley_reg',
    'novalidate' => true,
    'inputDefaults' => array(
        'label' => false,
        'div' => false,
        'class' => 'form-control',
    )
));

echo $this->Form->hidden('base_url', array('id' => 'hidden_site_baseurl', 'value' => $this->request->base . ((!is_null($this->params['language'])) ? '/' . $this->params['language'] : '')));
if ($generate)
    $style = 'display:block;';
else
    $style = 'display:none;';
?>

<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Add Information</h4>
        </div>
        <div class="panel-body">
            <fieldset>
                <legend><span>Add Topic</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-6">


                        <div class="form-group">
                            <label for="reg_input_name" class="req">Topic Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('topic_name', array('data-required' => 'true','tabindex' => '1'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Keywords</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('topic_keywords', array('type' => 'textarea', 'style' => 'width:100%;height:300px','tabindex' => '3'));
                                ?></div>
                        </div>
                    </div>





                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name">Channel</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('topic_channel', array('options' => $Channel, 'empty' => '--Select--','tabindex' => '2'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Related Keywords</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('topic_related_keywords', array('type' => 'textarea', 'style' => 'width:100%;height:300px','tabindex' => '4'));
                                ?></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1">
                                <?php
                                echo $this->Form->submit('Generate', array('name' => 'generate', 'class' => 'btn btn-success sticky_success', 'value' => 'generate'));
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12" style="<?php echo $style; ?>">
                    <div class="form-group">
                        <label for="reg_input_name">Anchors Raw</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10"><?php
                            echo $this->Form->input('topic_anchors_raw', array('value' => $keyword_value, 'style' => 'width: 957px;height: 95px;', 'readonly' => true));
                            ?></div>
                    </div>
                    <div class="form-group">
                        <label for="reg_input_name">Anchors Polished</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('topic_anchors_polished', array('value' => $Ukeyword_value, 'style' => 'width: 957px;height: 95px;', 'readonly' => true));
                            ?></div>
                    </div>
                    <div class="form-group">
                        <label for="reg_input_name">Tags Raw</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('topic_tags_raw', array('value' => $keyword_value, 'style' => 'width: 957px;height: 95px;', 'readonly' => true));
                            ?></div>
                    </div>  
                    <div class="form-group">
                        <label for="reg_input_name">Tags Polished</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('topic_tags_polished', array('value' => $Ukeyword_value, 'style' => 'width: 957px;height: 95px;', 'readonly' => true));
                            ?></div>
                    </div>


                    <div class="form-group">
                        <label for="reg_input_name">Related Raw</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('topic_related_anchors_raw', array('value' => $related_key_value, 'style' => 'width: 957px;height: 95px;', 'readonly' => true));
                            ?></div>
                    </div>


                    <div class="form-group">
                        <label for="reg_input_name">Related Polished</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('topic_related_anchors_polished', array('value' => $Urelated_key_value, 'style' => 'width: 957px;height: 95px;', 'readonly' => true));
                            ?></div>
                    </div>                    
                    <div class="row">
                        <div class="col-sm-1">
                            <?php
                            echo $this->Form->submit('Submit', array('name' => 'add', 'class' => 'btn btn-success sticky_success', 'value' => 'add'));
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






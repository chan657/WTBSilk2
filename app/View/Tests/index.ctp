<?php
$this->Html->addCrumb('My Tests', 'javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->Form->create('Test', array('enctype' => 'multipart/form-data', 'method' => 'post',
    'id' => 'parsley_reg',
    'novalidate' => true,
    'inputDefaults' => array(
        'label' => false,
        'div' => false,
        'class' => 'form-control',
    )
));
//echo $this->Html->link('<span class="icon-list"></span>', array('controller' => 'messages', 'action' => 'index/leads/my-clients'), array('class' => 'act-ico', 'escape' => false));
?>

<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Spinner: Output Single Content Versions From Nested Spintax</h4>
        </div>
        <div class="panel-body">
            
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="reg_input_name" style="margin-left: 14px">Enter Spintax</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('text', array('type' => 'textarea', 'style' => 'width:122%;height:100px'));
                            ?></div>
                    </div>
                    <div class="form-group">
                        <label for="reg_input_name" style="margin-left: 14px">Output Spintax</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('task_url_description2', array('type' => 'textarea', 'style' => 'width:122%;height:100px','value' => $output_txt));
                            ?></div>
                    </div>
                    <div class="form-group">
                                            <div class="col-sm-10 editable txtbox">
                                                <label>Picture1</label>
                                                <span class="colon">:</span>
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                    <div class="fileupload-new img-thumbnail" style="width: 178px; height: 120px;">
                                                        <?php
                                                       
                                                            $image1 = $this->webroot . "img/no_img_180.png";
                                                       
                                                        ?>
                                                        <img src="<?php echo $image1; ?>" height="200" width="170" />

                                                    </div>
                                                    <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 178px; height: 120px"></div>
                                                    <div>
                                                        <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
                                                            <input type="file" name="data[Test][hotel_img1]" />

                                                        </span>
                                                        <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                </div>



                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-1">
                            <?php
                            echo $this->Form->submit('Action', array('class' => 'btn btn-success sticky_success'));
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
?>




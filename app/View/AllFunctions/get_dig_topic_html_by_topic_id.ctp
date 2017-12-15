<?php
if (count($DataArray) > 0) {
    // pr($DataArray);
    ?>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="reg_input_name">Keywords</label>
            <span class="colon">:</span>
            <div class="col-sm-10">
                <?php
                echo $this->Form->input('topic_keywords', array('type' => 'textarea', 'style' => 'width:100%;height:300px', 'div' => false, 'label' => false, 'class' => 'form-control', 'value' => $DataArray['DigTopic']['topic_keywords']));
                ?></div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="reg_input_name">Related Keywords</label>
            <span class="colon">:</span>
            <div class="col-sm-10">
                <?php
                echo $this->Form->input('topic_related_keywords', array('type' => 'textarea', 'style' => 'width:100%;height:300px', 'value' => $DataArray['DigTopic']['topic_related_keywords'], 'div' => false, 'label' => false, 'class' => 'form-control'));
                ?></div>
        </div>
    </div>
    <div class="form-group">
        <label for="reg_input_name">Anchors Raw</label>
        <span class="colon">:</span>
        <div class="col-sm-10"><?php
            echo $this->Form->input('topic_anchors_raw', array('type' => 'textarea','style' => 'width: 957px;height: 95px;', 'readonly' => true, 'div' => false, 'label' => false, 'class' => 'form-control', 'value' => $DataArray['DigTopic']['topic_anchors_raw']));
            ?></div>
    </div>
    <div class="form-group">
        <label for="reg_input_name">Anchors Polished</label>
        <span class="colon">:</span>
        <div class="col-sm-10">
            <?php
            echo $this->Form->input('topic_anchors_polished', array( 'type' => 'textarea','style' => 'width: 957px;height: 95px;', 'readonly' => true, 'div' => false, 'label' => false, 'class' => 'form-control', 'value' => $DataArray['DigTopic']['topic_anchors_polished']));
            ?></div>
    </div>
    <div class="form-group">
        <label for="reg_input_name">Tags Raw</label>
        <span class="colon">:</span>
        <div class="col-sm-10">
            <?php
            echo $this->Form->input('topic_tags_raw', array('type' => 'textarea','style' => 'width: 957px;height: 95px;', 'readonly' => true, 'div' => false, 'label' => false, 'class' => 'form-control', 'value' => $DataArray['DigTopic']['topic_tags_raw']));
            ?></div>
    </div>  
    <div class="form-group">
        <label for="reg_input_name">Tags Polished</label>
        <span class="colon">:</span>
        <div class="col-sm-10">
            <?php
            echo $this->Form->input('topic_tags_polished', array('type' => 'textarea','style' => 'width: 957px;height: 95px;', 'readonly' => true, 'div' => false, 'label' => false, 'class' => 'form-control', 'value' => $DataArray['DigTopic']['topic_tags_polished']));
            ?></div>
    </div>


    <div class="form-group">
        <label for="reg_input_name">Related Raw</label>
        <span class="colon">:</span>
        <div class="col-sm-10">
            <?php
            echo $this->Form->input('topic_related_anchors_raw', array('type' => 'textarea','style' => 'width: 957px;height: 95px;', 'readonly' => true, 'div' => false, 'label' => false, 'class' => 'form-control', 'value' => $DataArray['DigTopic']['topic_related_anchors_raw']));
            ?></div>
    </div>


    <div class="form-group">
        <label for="reg_input_name">Related Polished</label>
        <span class="colon">:</span>
        <div class="col-sm-10">
            <?php
            echo $this->Form->input('topic_related_anchors_polished', array('type' => 'textarea','style' => 'width: 957px;height: 95px;', 'readonly' => true, 'div' => false, 'label' => false, 'class' => 'form-control', 'value' => $DataArray['DigTopic']['topic_related_anchors_polished']));
            ?></div>
    </div> 


    <?php
}?>
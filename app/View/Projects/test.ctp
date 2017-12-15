<?php echo $this->Form->create('Project', array('method' => 'post', 'url' => '/project/get_list_by_builder_1')) ?>
<?php echo $this->Form->input('builder_id1') ?>
<?php echo $this->Form->end('Submit') ?>
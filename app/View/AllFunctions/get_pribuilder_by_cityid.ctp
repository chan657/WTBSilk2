<?php 
echo $this->Form->input('builder_id',array('options' => $builders, 'empty' => '--Select--','class' => 'form-control','onchange' => 'filterPreferences(this.value,\'ProjectSecondaryBuilderId\',\'ProjectTertiaryBuilderId\')','tabindex' => '8'));
?>
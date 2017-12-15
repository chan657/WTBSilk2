<?php 
echo $this->Form->input('secondary_builder_id',array('options' => $builders, 'empty' => '--Secondary Builder--','class' => 'form-control','onchange' => 'filterPreferences(\'ProjectSecondaryBuilderId\',\'ProjectBuilderId\',\'ProjectTertiaryBuilderId\')','tabindex' => '8'));

?>
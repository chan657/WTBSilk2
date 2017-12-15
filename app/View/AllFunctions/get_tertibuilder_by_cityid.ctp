<?php 
echo $this->Form->input('tertiary_builder_id', array('options' => $builders, 'empty' => '--Tertiary Builder--','class' => 'form-control city_custom','onchange' => 'filterPreferences(\'ProjectTertiaryBuilderId\,\'ProjectBuilderId\',\'ProjectSecondaryBuilderId\')','tabindex' => '8'));
?>
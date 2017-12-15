<h1>Add Group</h1>
<?php
echo $this->Form->create('Group');

echo $this->Form->input('group_name', array('div' =>true,
                   'label' => array(
                   'text'=> 'Group Name For Amenities', 'class' =>'myclass'),
                   'class' => 'input', 'size' => '25','maxlength'=>'100'));
echo $this->Form->end('Save');
?>
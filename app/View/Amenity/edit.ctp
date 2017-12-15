<h1>Edit Amenity</h1>
<?php
echo $this->Form->create('Amenity');
echo $this->Form->input('id',array('type'=>'hidden'));
echo $this->Form->input('amenity_name', array('div' =>true,
                   'label' => array(
                   'text'=> 'Amenities', 'class' =>'myclass'),
                   'class' => 'input', 'size' => '25','maxlength'=>'100'));
				   
echo $this->Form->input('group_id',array('options'=>$groups), array('div' =>true,
                   'placeholder' => array(
                   'text'=> 'Group', 'class' =>'myclass'),
                   'class' => 'input', 'size' => '25','maxlength'=>'100'));


echo $this->Form->end('Update');
?>
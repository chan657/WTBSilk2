         <div id='ajax'></div>
     <?php
                echo $this->Form->input($model.'.amenity_id', array(
                    'label' => false,
                    'div' => array('class' => 'list-checkbox'),
                    'type' => 'select',
                    'multiple' => 'checkbox',
                    'options' => $groups,
                   
                ));
                ?>
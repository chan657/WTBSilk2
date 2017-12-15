 <?php 
 echo $this->Form->input('ProjectAgreement.project_agreement_project_id', array(
                    'label' => false,
                    'div' => array('class' => 'list-checkbox'),
                    'between' => '<div class="blank"></div>',
					'id' => 'aa',
                    'type' => 'select',
                    'multiple' => 'checkbox',
					'fieldset' => false,
            		'legend' => false,
					
                    'options' => $projects
                  ));
										
 
 
 ?>
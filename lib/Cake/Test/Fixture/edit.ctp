<table width="25%" border="0" cellspacing="15" cellpadding="15">
 <tr>
 <td>
 
 <table width="20%" border="0" cellspacing="0" cellpadding="6">
  		<tr>
    		<td align="left" valign="top" class="headerText"> Edit Area</td>
		</tr>
	
   </table>	
   <table width="25%" border="0" cellspacing="1" cellpadding="6">
			<tr>
              <td align="left" valign="middle">&nbsp;</td>
              
            </tr>
</table>
 
 <?php echo $this->Session->flash();?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="center" valign="middle">
          	<div class="tableheadbg">
            <table width="96%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <tr>
    <td align="left" valign="middle">Edit Area</td>
  
  </tr>
</table>

            </div>
          
          </td>
        </tr>
        <tr>
		
		<?php
			echo $this->Form->create('Area');
		?>

          <td align="center" valign="top" class="tableboeder"><table width="98%" border="0" cellspacing="1" cellpadding="6">
            <tr>
              <td align="left" valign="middle">&nbsp;</td>
              <td align="left" valign="middle">&nbsp;</td>
            </tr>
            <tr>
              <td width="9%" align="left" valign="middle">Area Name:</td>
              <td width="91%" align="left" valign="middle">
			  	<?php
					echo $this->Form->input('area_name',  array('div' =>true,
                   'label' => false,
                   
                   'class' => 'inputbox', 'size' => '20', 'maxlength'=>'100'));
				?>
            </tr>
           
		    <tr>
              <td align="left" valign="middle">City:</td>
              <td align="left" valign="middle">
			  	<?php
					echo $this->Form->input('city_id',   array('div' =>false,
                   'label' => false,'options' => $cities,'empty'=>'Select',
                   
                   'class' => 'inputbox', 'size' => '1','maxlength'=>'100'));
				   ?>
				   </td>
            </tr>
			<tr>
              <td align="left" valign="middle">Suburb:</td>
              <td align="left" valign="middle">
			  	<?php
					echo $this->Form->input('suburb_id',   array('div' =>false,
                   'label' => false,'options' => $suburbs,'empty'=>'Select',
                   
                   'class' => 'inputbox', 'size' => '1','maxlength'=>'100'));
				   ?>

			</td>
            </tr>
            <tr>
              <td align="left" valign="middle"> Area Description:</td>
              <td align="left" valign="middle">
			  	<?php	
					echo $this->Form->input('area_description', array('div' =>false,
                   'label'=>false,'type'=>'textarea',
                   'class' => 'myclass', 'size' => '25','maxlength'=>'100'));
				   ?>
			</td>
            </tr>
			
			 <tr>
              <td align="left" valign="middle">Area Rating:</td>
              <td align="left" valign="middle">
			  	<?php	
					echo $this->Form->input('area_rating',  array('div' =>true,
                   'label' =>false,
                   'class' => 'inputbox', 'size' => '25','maxlength'=>'100'));
				?>   
		
			</td>
            </tr>
			
			 <tr>
              <td align="left" valign="middle">Area Economic Parameters:</td>
              <td align="left" valign="middle">
			  <?php
					echo $this->Form->input('area_economicparameters', array('div' =>false,
                   'label' =>false,
            
                   'class' => 'inputbox', 'size' => '1','maxlength'=>'100'));
				?>
			</td>
            </tr>
			
			 <tr>
              <td align="left" valign="middle">Area Political Parameters:</td>
              <td align="left" valign="middle">
			  	<?php			
		
					echo $this->Form->input('area_politicalparameters',  array('div' =>false,
                   'label' => false, 
           
                   'class' => 'inputbox', 'size' => '1','maxlength'=>'100'));
		
		?>

			</td>
            </tr>
			
			 <tr>
              <td align="left" valign="middle">Area Population Parameter:</td>
              <td align="left" valign="middle">
			  	<?php			
		
					echo $this->Form->input('area_populationparameter',  array('div' =>false,
                   'label' => false, 
           
                   'class' => 'inputbox', 'size' => '1','maxlength'=>'100'));
		
		?>
			</td>
            </tr>
			
			 <tr>
              <td align="left" valign="middle">Area Investment Environment:</td>
              <td align="left" valign="middle">
			  	<?php			
		
					echo $this->Form->input('area_investmentenvironment',  array('div' =>false,
                   'label' => false, 
           
                   'class' => 'inputbox', 'size' => '1','maxlength'=>'100'));
		
		?>
			</td>
            </tr>
			
			 <tr>
              <td align="left" valign="middle"> Area Infrastructure Growth Potential:</td>
              <td align="left" valign="middle">
			  	<?php			
		
					echo $this->Form->input('area_infrastructuregrowthpotential',  array('div' =>false,
                   'label' => false, 
           
                   'class' => 'inputbox', 'size' => '1','maxlength'=>'100'));
		
		?>
			</td>
            </tr>
			
			 <tr>
              <td align="left" valign="middle">Area Status :</td>
              <td align="left" valign="middle">
			  	<?php			
		
					echo $this->Form->input('suburb_status',  array('div' =>false,
                   'label' => false, 'options' => array('Approved'=>'Approved'),
           
                   'class' => 'inputbox', 'size' => '1','maxlength'=>'100'));
		
		?>
			</td>
            </tr>
			
			 			
			
			
			
			
                      </table></td>
        </tr>
        <tr>
          <td align="right" valign="middle" class="tablefooter"><?php echo $this->Form->submit('/img/btn-update.gif'); ?> <?php echo $this->Html->link($this->Html->image("btn-reset.gif"), array(), array('escape' => false, 'onclick'=>'document.UserAddForm.reset();return false;', 'div' => false));?></td>
        </tr>
    </table>

<?php
echo $this->Form->end();
?>



 </td>
 </tr>
 </table>
 
 <?php
$this->Js->get('#AreaCityId')->event('change', 
	$this->Js->request(array(
		'controller'=>'suburb',
		'action'=>'getByCity'
		), array(
		'update'=>'#AreaSuburbId',
		'async' => true,
		'method' => 'post',
		'dataExpression'=>true,
		'data'=> $this->Js->serializeForm(array(
			'isForm' => true,
			'inline' => true
			))
		))
	);
?>
<?php
 echo $this->Html->css(array('/bootstrap/css/bootstrap.min','popup',
									
									'font-awesome/css/font-awesome.min',
									
									'/js/lib/datepicker/css/datepicker',
									'/js/lib/timepicker/css/bootstrap-timepicker.min'
									
									
									)
							);
echo $this->Html->script(array('jquery.min','lib/chained/jquery.chained.remote.min','lib/jquery.inputmask/jquery.inputmask.bundle.min','lib/parsley/parsley.min','pages/ebro_form_validate','lib/datepicker/js/bootstrap-datepicker','lib/timepicker/js/bootstrap-timepicker.min','pages/ebro_form_extended'));
		/* End */
		//pr($this->data);
?>

<!----------------------------start add project block------------------------------>

<div class="pop-outer">
     <div class="pop-up-hdng">Hotel Count</div>
     

    <?php
    //echo $this->Form->create('Remark', array('enctype' => 'multipart/form-data'));
	echo $this->Form->create('Reimbursement', array('method' => 'post','id' => 'parsley_reg','novalidate' => true,
													'inputDefaults' => array(
																	'label' => false,
																	'div' => false,
																	'class' => 'form-control',
																),
													array('controller' => 'reimbursements','action' => 'edit')	
						));
  
  
   
    ?>
 
<div class="col-sm-12">
       <table id="resp_table" class="table toggle-square" data-filter="#table_search" data-page-size="2000">
                <thead>         
                    <tr>
                        <th data-hide="phone" data-sort-ignore="true">Id</th>
                        <th data-hide="phone" data-sort-ignore="true">Continent Name</th>
                        <th data-hide="phone" data-sort-ignore="true">Country Name</th>
                       
                        <th data-hide="phone" data-sort-ignore="true">City Name</th>
                        <th data-hide="phone" data-sort-ignore="true">City Id</th>
                        <th data-hide="phone" data-sort-ignore="true">City Code</th>
                        
                        <th data-hide="phone" data-sort-ignore="true">Hotel Count</th>                        
                      
                    </tr>
                </thead>
                <tbody>
                    <?php
                   
                    $i = 1;
                    $sum = 0;
             
                    if (isset($TravelHotelLookups) && count($TravelHotelLookups) > 0):
                        foreach ($TravelHotelLookups as $value):                       
                         
                            ?>
                            <tr>
                                <td><?php echo $i;?></td> 
                                 <td><?php echo $value['TravelHotelLookup']['continent_name']; ?></td>   
                                <td><?php echo $value['TravelHotelLookup']['country_name']; ?></td>
                               
                                <td><?php echo $value['TravelHotelLookup']['city_name']; ?></td>
                                <td><?php echo $value['TravelHotelLookup']['city_id']; ?></td>
                                <td><?php echo $value['TravelHotelLookup']['city_code']; ?></td>
                                
                                <td><?php $sum = $sum + $value[0]['cnt']; 
                                
                                echo $this->Html->link($value[0]['cnt'],'/mass_operations/hotel/city_id:'.$value['TravelHotelLookup']['city_id'].'/country_id:'.$value['TravelHotelLookup']['country_id'], array('class' => 'act-ico', 'escape' => false,'target' => '_blank'));
                                ?></td> 
                                
                              
                            </tr>
                        <?php 
                        $i++;
                        endforeach; ?>
                            <tr>
                                <td  colspan="6">Total</td>
                                <td colspan="2"><?php echo $sum?></td> 
                                
                            </tr>

                        <?php
                       
                    else:
                        echo '<tr><td colspan="3" class="norecords">No Records Found</td></tr>';
                    endif;
                    ?>
                </tbody>
            </table>
	</div>
            
        

    <?php echo $this->Form->end();
    ?>
</div>	

		
<!----------------------------end add project block------------------------------>

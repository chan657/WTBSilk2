<?php

 echo $this->Html->css(array('/bootstrap/css/bootstrap.min','popup','style','/js/lib/FooTable/css/footable.core'));
 echo $this->Html->script(array('jquery.min','/bootstrap/js/bootstrap.min','lib/FooTable/js/footable',
									'lib/FooTable/js/footable.sort',
									'lib/FooTable/js/footable.filter',
									'lib/FooTable/js/footable.paginate',
									'pages/ebro_responsive_table'));							

?>

<!----------------------------start add project block------------------------------>
<div class="pop-outer">
	<div class="col-sm-12 mrgn">
     <div class="table-heading">
     	<h4 class="table-heading-title"><span class="badge badge-circle badge-success"><?php echo count($this->data['Action'])?></span> Action History</h4></div>
     </div>
     <div class="form-group">
     	<div class="col-sm-12">
        	<table border="0" cellpadding="0" cellspacing="0" id="resp_table" class="table toggle-square myclitb" data-filter="#table_search" data-page-size="40">
            	<thead>
                   <tr class="table-header">
                      <th data-toggle="true">Action Id</th>
                      <th data-hide="phone">Action Parent Id</th>
                      <th data-hide="phone,tablet">Action Level</th>
                      <th data-hide="phone,tablet">Action Type</th>
                      <th data-hide="phone,tablet">Action Status</th>
                      <th data-hide="phone,tablet">Action Date</th>
                      <th data-hide="phone,tablet">Action Source</th>
                      <th data-hide="phone,tablet">Action By</th>
                      <th data-hide="phone">The Action</th>	
                   </tr>
                </thead>
                <tbody>
					 <?php
					// pr($created_by);
					 if(count($this->data['Action'])){
					 foreach($this->data['Action'] as $actions ){?>
					<tr style="background-color:#FFF;">
						
						<td class="borderRightNone" align="left"><?php echo $actions['id'];?></td>
						<td class="borderRightNone" align="left"><?php echo $actions['parent_action_item_id'];?></td>
						<td data-value="yes_UN" class="borderRightNone" align="left"><?php echo $action_level[$actions['action_item_level_id']];?></td>
						<td data-value="yes_UN" class="borderRightNone" align="left"><?php echo $action_type[$actions['type_id']];?></td>
						<td data-value="yes_UN" class="borderRightNone" align="left"><?php echo $action_status[$actions['action_item_status']];?></td>	
						<td data-value="yes_UN" class="borderRightNone" align="left"><?php echo date("d/m/Y", strtotime($actions['created']));?></td>
						<td data-value="yes_UN" class="borderRightNone" align="left"><?php echo $source[$actions['action_item_source']];?></td>	
						<td data-value="yes_UN" class="borderRightNone" align="left"><?php echo $created_by[$actions['created_by']];?></td>
						<td class="borderRightNone" align="left"><?php echo $actions['description'];?></td>
						
					</tr>
					<?php }
					}
					 ?>
					</tbody>
				</table>
                                                            
                                                        </div>
                                                    </div>    

</div>	

		
<!----------------------------end add project block------------------------------>

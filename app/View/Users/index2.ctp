<table width="80%" border="0" cellspacing="0" cellpadding="6">
<tr>
<td>



<table width="70%" border="0" cellspacing="0" cellpadding="6">
	<tr>
		<td align="left" valign="top" class="headerText">Client</td>
	</tr>

</table>	


<?php echo $this->Session->flash();?> 



<table width="40%" border="0" cellspacing="0" cellpadding="6">
	<tr>
	   <td>
			<div style="width:100%; margin:auto;">
						<div class="tableheadbg">
						<div class="tableheadertxt">Clients</div> 
						<div class="tablesearchblock"> 
			<table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">
				<tr>
					 <td align="left" valign="middle"> <input type="text" size="25" /></td>
					 <td align="center" valign="middle"><?php echo $this->Html->image('icon-search.png', array('alt' => 'search', 'title' => 'search',       		 							'width'=>'24', 'height'=>'24', 'hspace'=>'5')) ?></td>
				 </tr>
			</table>
						</div>
						</div>

			<div class="blank"></div>
						
			<div class="filterblock">
				<table width="100%" border="0" cellspacing="0" cellpadding="4">
					<tr>
					<td width="7%" align="right" valign="middle">City Name:</td>
					<td width="12%" align="left" valign="middle"><select name="select" id="select" class="filterblockdd">
					<option selected="selected">Select</option>
					</select></td>
					<td width="7%" align="right" valign="middle">Suburb Name:</td>
					<td width="13%" align="left" valign="middle"><select name="select" id="select" class="filterblockdd">
					<option selected="selected">Select</option>
					</select></td>
					<td width="6%" align="right" valign="middle">Area Name:</td>
					<td width="12%" align="left" valign="middle"><select name="select" id="select" class="filterblockdd">
					<option selected="selected">Select</option>
					</select></td>
					<td width="43%" align="left" valign="middle"><?php echo $this->Html->image('btn-filter.gif', array('alt' => 'Edit', 'title' => 'Edit', 'url' => array('controller' => 'areas','action' =>'edit',), 'class' => 'aClass')); ?>
					
					<?php echo $this->Html->image('btn-reset.gif', array('alt' => 'View', 'title' => 'View', 'url' => array('controller' =>                   	'areas','action' => 'view',), 'class' => 'aClass')); ?>	</td>
					</tr>
				</table>

			</div>

			
			<table width="100%" border="0" cellpadding="0" cellspacing="0" class="sample">
					  <tr>
						
						<th width="10%" align="middle" valign="middle">Lead Generation Date</th>
						<th width="10%" align="middle" valign="middle">Urgency</th>
						<th width="10%" align="middle" valign="middle">Importance</th>
						<th width="10%" align="middle" valign="middle">Status</th>
						<th width="15%" align="middle" valign="middle">First Name</th>
						<th width="15%" align="middle" valign="middle">Last Name</th>
						<th width="15%" align="middle" valign="middle">Interested City</th>
						<th width="15%" align="middle" valign="middle">Interested Project</th>
						<th width="15%" align="middle" valign="middle">Interested Builder</th>
						<th width="15%" align="middle" valign="middle">Interested Area</th>
						
						<th width="15%" align="middle" valign="middle">Source</th>
						<th width="15%" align="middle" valign="middle">Category</th>
						<th width="15%" align="middle" valign="middle">Channel</th>
						<th width="15%" align="middle" valign="middle">Primary Manager</th>
						<th width="15%" align="middle" valign="middle">Secondary Manager</th>
						<th width="15%" align="middle" valign="middle">Associate</th>
						<th width="10%" align="middle" valign="middle">Action</th>


					</tr>
					  
					   <?php foreach ($leads as $lead): ?>
						<tr>
							<td align="center" valign="middle" class="tablebody"><?php echo $lead['Lead']['lead_allocateddate']; ?></td>
							<td align="center" valign="middle" class="tablebody"><?php echo $lead['Lead']['lead_urgency']; ?></td>
							<td align="center" valign="middle" class="tablebody"><?php echo $lead['Lead']['lead_importance']; ?></td>
							<td align="center" valign="middle" class="tablebody"><?php echo $lead['Lead']['lead_status']; ?></td>
							<td align="center" valign="middle" class="tablebody"><?php echo $lead['Lead']['lead_fname']; ?></td>
							<td align="center" valign="middle" class="tablebody"><?php echo $lead['Lead']['lead_lname']; ?></td>
							<td align="center" valign="middle" class="tablebody"><?php echo $lead['Lead']['lead_city']; ?></td>
							<td align="center" valign="middle" class="tablebody"><?php echo $lead['Project']['project_name']; ?></td>
							<td align="center" valign="middle" class="tablebody"><?php echo $lead['Lead']['builder_id1']; ?></td>
							<td align="center" valign="middle" class="tablebody"><?php echo $lead['Lead']['lead_areapreference1']; ?></td>
							<td align="center" valign="middle" class="tablebody"><?php echo $lead['Lead']['lead_source']; ?></td>
							<td align="center" valign="middle" class="tablebody"><?php echo $lead['Lead']['lead_category']; ?></td>
							<td align="center" valign="middle" class="tablebody"><?php echo $lead['Lead']['lead_channel']; ?></td>
							<td align="center" valign="middle" class="tablebody"><?php echo $lead['Lead']['lead_managerprimary']; ?></td>
							<td align="center" valign="middle" class="tablebody"><?php echo $lead['Lead']['lead_managersecondary']; ?></td>
							<td align="center" valign="middle" class="tablebody"><?php echo $lead['Lead']['lead_associate']; ?></td>
							<td align="center" valign="middle"><?php echo $this->Html->image('btn-details.gif', array('alt' => 'View Details','title'=> 'View Details','width'=>'61', 'height'=>'32', 'hspace'=>'6')) ?></td>
						</tr>
						 <?php endforeach; ?>
						<?php unset($area); ?>

					</table>
				
				</div>
		</td>
	</tr>

</table>  





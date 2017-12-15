<table width="70%" border="0" cellspacing="0" cellpadding="6">
  <tr>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
</table>
	  
<table width="70%" border="0" cellspacing="0" cellpadding="0">
        <td width="24" align="left" valign="middle" class="messageblock"><?php echo $this->Html->image('icon-info.gif', array('alt' => 'Info', 'title' => 'Info',       'width'=>'24', 'height'=>'23', 'hspace'=>'6')) ?></td>
          <td align="left" valign="middle" class="messageblock"><?php echo $this->Session->flash();?></td>
        </tr>
 </table>
	
	
<table width="50%" border="0" cellspacing="0" cellpadding="4">
        <tr>
          <td width="27%"><div class="tableheadbg">
            <table width="96%" border="0" cellspacing="0" cellpadding="4">
              <tr>
                <td width="19" align="left" valign="top"><?php echo $this->Html->image('icon-pen.png',array('width'=>'19', 'height'=>'26'))?></td>
                <td align="left" valign="middle">View Suburb Profile</td>
              </tr>
</table>

<table width="70%" border="0" cellspacing="0" cellpadding="6">
  <tr>
    <td align="left" valign="top">&nbsp;</td>
	
  </tr>
 </table>
 
 
<table width="70%" border="0" cellspacing="0" cellpadding="6">
  <tr>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
 </table>
	  
	  
<tr>
<td align="left" valign="top">
<table width="50%" border="1" cellspacing="1" cellpadding="6">
	
	<tr>
		<td>Suburb Name</td>
		<td><?php echo $suburb['Suburb']['suburb_name']; ?></td>
	</tr>
	
	<tr>
		<td>City</td>
		<td><?php echo $suburb['City']['city_name']; ?></td>
	</tr>
	
	<tr>
		<td>Suburb Description</td>
		<td><?php echo $suburb['Suburb']['suburb_description']; ?></td>
	</tr>
	
	<tr>
		<td>Suburb Rating</td>
		<td><?php echo $suburb['Suburb']['suburb_rating']; ?></td>
	</tr>
	
	<tr>
		<td>Suburb Economic Parameter</td>
		<td><?php echo $suburb['Suburb']['suburb_economicparameters']; ?></td>
	</tr>
	
	<tr>
		<td>Suburb Political Parameter</td>
		<td><?php echo $suburb['Suburb']['suburb_politicalparameters']; ?></td>
	</tr>
	
	<tr>
		<td>Suburb Population Parameter</td>
		<td><?php echo $suburb['Suburb']['suburb_populationparameter']; ?></td>
	</tr>
	
	<tr>
		<td>Suburb Investment Environment</td>
		<td><?php echo $suburb['Suburb']['suburb_investmentenvironment']; ?></td>
	</tr>
	
<tr>
		<td>Suburb Infrastructure Growth Potential</td>
		<td><?php echo $suburb['Suburb']['suburb_infrastructuregrowthpotential']; ?></td>
	</tr>
	
	<tr>
		<td>Suburb Status</td>
		<td><?php echo $suburb['Suburb']['suburb_status']; ?></td>
	</tr>
	
</table>
</tr>


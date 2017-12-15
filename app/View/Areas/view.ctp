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
                <td align="left" valign="middle">View Area Profile</td>
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
		<td>Area Name</td>
		<td><?php echo $area['Area']['area_name']; ?></td>
	</tr>
	
	<tr>
		<td>City</td>
		<td><?php echo $area['City']['city_name']; ?></td>
	</tr>
	
	<tr>
		<td>Suburb</td>
		<td><?php echo $area['Suburb']['suburb_name']; ?></td>
	</tr>

	
	<tr>
		<td>Area Description</td>
		<td><?php echo $area['Area']['area_description']; ?></td>
	</tr>
	
	<tr>
		<td>Area Rating</td>
		<td><?php echo $area['Area']['area_rating']; ?></td>
	</tr>
	
	<tr>
		<td>Area Economic Parameter</td>
		<td><?php echo $area['Area']['area_economicparameters']; ?></td>
	</tr>
	
	<tr>
		<td>Area Political Parameter</td>
		<td><?php echo $area['Area']['area_politicalparameters']; ?></td>
	</tr>
	
	<tr>
		<td>Area Population Parameter</td>
		<td><?php echo $area['Area']['area_populationparameter']; ?></td>
	</tr>
	
	<tr>
		<td>Area Investment Environment</td>
		<td><?php echo $area['Area']['area_investmentenvironment']; ?></td>
	</tr>
	
<tr>
		<td>Area Infrastructure Growth Potential</td>
		<td><?php echo $area['Area']['area_infrastructuregrowthpotential']; ?></td>
	</tr>
	
	<tr>
		<td>Area Status</td>
		<td><?php echo $area['Area']['area_status']; ?></td>
	</tr>
	
</table>
</tr>



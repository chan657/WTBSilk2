<?php App::import('Model', 'User');
$attr = new User();
?>
<span><strong>Primary Information</strong></span>
<p>AGENT NAME: <?php echo $AgentName;?></p>
<p>PRIMARY CITY: <?php echo $PrimaryCity;?></p>
<p>MULTICITY? <?php echo $MultiCity;?></p>
<p>PROCUREMENT TYPE: <?php echo $ProcurementType;?></p>
<p>NATURE OF BUSINESS: <?php echo $AgentBusinessNature;?></p>
<p>BUSINESS TYPE: <?php echo $AgentBusinessType;?></p>
<p>CREATED BY: <?php echo strtoupper($attr->Username($CreatedBy));?></p>
<p>STATUS: <?php echo $Status;?></p>
<p>&nbsp;</p>
<p>Next Action By: <?php echo strtoupper($attr->Username($NextActionBy));?></p>




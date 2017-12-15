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
<p>ALLOCATION REQUESTED BY: <?php echo strtoupper($attr->Username($NextActionBy));?></p>
<p>ALLOCATION REASON: <?php echo $ActionAllocationReason;?></p>
<p>REMARK: <?php echo $ActionRemark;?></p>
<p>&nbsp;</p>
<span><strong>Activity Details</strong></span>
<p>&nbsp;</p>
<p>ACTIVITY FROM: <?php echo $ActivityFrom;?></p>
<p>ACTIVITY TO: <?php echo $ActivityTo;?></p>
<p>ACTIVITY LEVEL: <?php echo $ActivityLevel;?></p>
<p>ACTIVITY WITH: <?php echo $ActivityWith;?></p>
<p>ACTIVITY TYPE: <?php echo $ActivityType;?></p>
<p>ACTIVITY DETAILS: <?php echo $ActivityDetails;?></p>
<p>ACTIVITY DESCRIPTION: <?php echo $ActivityDescription;?></p>




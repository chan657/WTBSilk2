<span><strong>Primary Information</strong></span>
<p>&nbsp;</p>
<p>PAST ACTIVITY? <?php echo $PastActivity;?></p>
<p>ACTIVITY FROM: <?php echo $ActivityFrom;?></p>
<p>ACTIVITY TO: <?php echo $ActivityTo;?></p>
<p>ACTIVITY COMPLETED? <?php echo $ActivityCompleted;?></p>
<p>&nbsp;</p>
<p>ACTIVITY LEVEL: <?php echo $ActivityLevel;?></p>
<p>ACTIVITY WITH: <?php echo $ActivityWith;?></p>
<p>ACTIVITY TYPE: <?php echo $ActivityType;?></p>
<p>ACTIVITY DETAILS: <?php echo $ActivityDetails;?></p>
<p>ACTIVITY PROJECT SITE: <?php echo $ActivitySite;?></p>
<p>&nbsp;</p>
<p>ACTIVITY DESCRIPTION- <?php echo $ActivityDescription;?></p>
<p>&nbsp;</p>
<?php if($ExpenseStatus == '1'){?>
<span><strong>Reimbursement Details</strong></span>
<p>&nbsp;</p>
<p>EXPENSE LEVEL: <?php echo $ExpenseLevel;?></p>
<p>EXPENSE WITH: <?php echo $ExpenseWith;?></p>
<p>EXPENSE TYPE: <?php echo $ExpenceType;?></p>
<p>EXPENSE FOR: <?php echo $ExpenceFor;?></p>
<p>EXPENSE AMOUNT: Rs -<?php echo $ApprovalAmount;?></p>
<p>EXPENSE DATE: <?php echo $SumittedDate;?></p>
<p>&nbsp;</p>
<p>Next Action By <?php echo $NextActionBy;?></p>
<?php }?>
<p>&nbsp;</p>
<?php if($FollowupStatus == '1'){?>
<span><strong>Followup Datails</strong></span>
<p>&nbsp;</p>

<p>START DATE: <?php echo $StartDate;?></p>
<p>END DATE: <?php echo $EndDate;?></p>
<p>FOLLOWUP COMPLETED? <?php echo $FollowupCompleted;?></p>
<p>&nbsp;</p>
<p>FOLLOWUP LEVEL: <?php echo $FollowupLevel;?></p>
<p>FOLLOWUP WITH: <?php echo $FollowupWith;?></p>
<p>FOLLOWUP TYPE: <?php echo $FollowupType;?></p>
<p>FOLLOWUP DETAILS: <?php echo $FollowupDetails;?></p>
<p>FOLLOWUP PROJECT SITE: <?php echo $FollowupSite;?></p>
<p>&nbsp;</p>
<p>REMARK- <?php echo $FollowupDescription;?></p>
<?php }?>
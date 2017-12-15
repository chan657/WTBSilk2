<p>CITY: <?php echo $City;?></p>
<p>CLIENT NAME: <?php echo $lead_name;?></p>
<p>PHONE NO.: <?php echo $lead_primaryphonenumber;?></p>
<p>EMAIL ID: <?php echo $lead_emailid;?></p>
<p>SUBURB: <?php echo $SuburbPref1; if($SuburbPref2<>'') echo ' | '.$SuburbPref2;if($SuburbPref3<>'') echo ' | '.$SuburbPref3;?></p>
<p>AREA: <?php echo $AreaPref1;if($AreaPref2<>'') echo ' | '.$AreaPref2;if($AreaPref3<>'') echo ' | '.$AreaPref3;?></p>
<p>BUILDER: <?php echo $BuilderPref1;if($BuilderPref2<>'') echo ' | '.$BuilderPref2;if($BuilderPref3<>'') echo ' | '.$BuilderPref3;?></p>
<p>PROJECT: <?php echo $ProjectPref1;if($ProjectPref2<>'') echo ' | '.$ProjectPref2;if($ProjectPref3<>'') echo ' | '.$ProjectPref3;?></p>
<p>UNIT: <?php echo $UnitPref1;if($UnitPref2<>'') echo ' | '.$UnitPref2;if($UnitPref3<>'') echo ' | '.$UnitPref3;?></p>
<p>PROJECT TYPE: <?php echo $ProjectTypepPref1;if($ProjectTypepPref2<>'') echo ' | '.$ProjectTypepPref2;if($ProjectTypepPref3<>'') echo ' | '.$ProjectTypepPref3;?></p>
<p>BUDGET: <?php echo $Budget;?></p>
<p>&nbsp;</p>
<p>ARRIVAL: <?php echo $Arrival;?></p>
<p>LAST ALLOCATION: <?php echo $LastAllocation;?></p>
<p>LAST RETURN: <?php echo $ReturnHistory;?></p>
<p>CURRENT RETURN: <?php echo $Unit;?></p>
<p>&nbsp;</p>
<p><?php echo $LookupReturn.' - '.$Return;?></p>
<p>&nbsp;</p>
<p>NEXT ACTION BY- <?php echo $NextActionBy;?></p>

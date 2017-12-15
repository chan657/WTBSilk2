<?php $this->Html->addCrumb('My Summary', 'javascript:void(0);', array('class' => 'breadcrumblast')); 

                echo $this->Form->create('Report', array('controller' => 'reports', 'action' => 'job_report','class' => 'quick_search', 'id' => 'parsley_reg', 'novalidate' => true, 'inputDefaults' => array(
                        'label' => false,
                        'div' => false,
                        'class' => 'form-control',
                )));
                ?>
<div class="row">
    <div class="col-sm-12">
        <div class="table-heading">
            <h4 class="table-heading-title"> My Summary</h4>
            
        </div>
        <div class="panel panel-default">
            <div class="panel_controls hideform">
                 
          
                <div class="row">
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Summary Type:</label>
                        <?php echo $this->Form->input('summary_type', array('options' => $summary, 'empty' => '--Select--', 'data-required' => 'true','disabled' => '2')); ?>
                    </div>                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Choose Person:</label>
                        <?php echo $this->Form->input('user_id', array('options' => $persons, 'empty' => $Select)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Supplier:</label>
                        <?php echo $this->Form->input('supplier_id', array('options' => $TravelSuppliers, 'empty' => '--Select--', 'data-required' => 'true')); ?>
                    </div>              
                    <div class="col-sm-3 col-xs-6">
                       <label>&nbsp;</label>
                        <?php
                        echo $this->Form->submit('View Report', array('div' => false,'label' => false,'class' => 'success btn','style' => 'width: 50%;margin-top: 0px;'));
                        ?>
                    </div>
                </div>
                
            </div>
            <br />
            <?php if($display == 'TRUE'){?>
            <table border="0" cellpadding="0" cellspacing="0" id="resp_table" class="table toggle-square myclitb" data-filter="#table_search" data-page-size="500">
                <thead>
                   <tr class="footable-group-row">
                        <th data-group="group3" colspan="7" class="nodis">Information</th>
                        <th data-group="group1" colspan="5">Hotel Edit (WTB)</th>                     
                        <th data-group="group2" colspan="4">Hotel Mapping (WTB)</th>
                        <th data-group="group4" colspan="4">Hotel Mapping (Supplier)<?php //echo $this->Custom->getSupplierCode($this->data['Report']['supplier_id']); ?></th>
						 <th data-group="group5" colspan=""></th>
                    </tr>
                    <tr>           
                        <th data-toggle="phone"  data-sort-ignore="true" data-group="group3">Sl. </th>
                        <th data-toggle="phone"  data-sort-ignore="true" data-group="group3">Person</th>
			<th data-toggle="phone"  data-sort-ignore="true" data-group="group3">Approver (Hotel)</th>
			<th data-toggle="phone"  data-sort-ignore="true" data-group="group3">Approver (Mapping)</th>
                        <th data-toggle="phone"  data-sort-ignore="true" data-group="group3">Country</th>
                        <th data-toggle="phone"  data-sort-ignore="true" data-group="group3">Province</th>
                        <th data-toggle="phone"  data-sort-ignore="true" data-group="group3">City</th>    
                        
                        <th data-toggle="phone"  data-sort-ignore="true" data-group="group1" >UNL</th>
                        <th data-toggle="phone"  data-sort-ignore="true" data-group="group1">PND</th>
                        <th data-toggle="phone"  data-sort-ignore="true" data-group="group1" >SMT</th>
                        <th data-toggle="phone"  data-sort-ignore="true" data-group="group1" >APV</th>
                        <th data-hide="phone"  data-sort-ignore="true" data-group="group1" >Total</th>                
                        
                        <th data-toggle="phone"  data-sort-ignore="true" data-group="group2" >PND</th>
                        <th data-toggle="phone"  data-sort-ignore="true" data-group="group2">SMT</th>
                        <th data-toggle="phone"  data-sort-ignore="true" data-group="group2" >APV</th>
                        <th data-hide="phone"  data-sort-ignore="true" data-group="group2" >Total</th>                
                        
                        <th data-toggle="phone"  data-sort-ignore="true" data-group="group4" >PND</th>                       
                        <th data-toggle="phone"  data-sort-ignore="true" data-group="group4">SMT</th>
						<th data-toggle="phone"  data-sort-ignore="true" data-group="group4" >CMP</th>
                        <th data-toggle="phone"  data-sort-ignore="true" data-group="group4" >Total</th>
						
						<th data-toggle=""  data-sort-ignore="true" data-group="" >TKT</th>
                                             
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
					//echo '<pre>';
                 /// print_r($TravelCities);
                //  die;
                    $supplier_id = $this->data['Report']['supplier_id'];
                    if (isset($TravelCities) && count($TravelCities) > 0):
					
					$getHotelUnallocatedCnt = 0;
					$getHotePendingCnt = 0;
					$getHoteSubmittedCnt = 0;
					$getHoteApprovedCnt = 0;
					$getHoteTotalCnt = 0;
					$getMappingPendingCnt = 0;
					$getMappingSubmitCnt = 0;
					$getMappingApproveCnt = 0;
					$getSupplierHotelCompeleteCnt = 0;
					$getSupplierHotelSubmitCnt = 0;
					$getSupplierHotelTotalCnt = 0;	
					$getSupplierHotelPendingCnt =0;
					
                        foreach ($TravelCities as $TravelCity):
                            $id = $TravelCity['TravelCity']['id'];              
                            $country_id = $TravelCity[0]['country_id'];
                            $province_id = $TravelCity[0]['province_id'];							
			    $creator = $TravelCity[0]['user_id'];
                            $levelh = '7';
                            $levelm = '4';
							
							$getHotelUnallocatedCnt += $getHotelUnallocatedCnt_1 = $this->Custom->getHotelUnallocatedCnt($country_id,$id);
							$getHotePendingCnt += $getHotePendingCnt_1 = $this->Custom->getHotePendingCnt($country_id,$id);
							$getHoteSubmittedCnt += $getHoteSubmittedCnt_1 = $this->Custom->getHoteSubmittedCnt($country_id,$id);
							$getHoteApprovedCnt += $getHoteApprovedCnt_1 = $this->Custom->getHoteApprovedCnt($country_id,$id);
							$getHoteTotalCnt += $getHoteTotalCnt_1 = $this->Custom->getHoteTotalCnt($country_id,$id);
							
							
							$getMappingPendingCnt += $getMappingPendingCnt_1 = $this->Custom->getMappingPendingCnt($country_id,$id);
							$getMappingSubmitCnt += $getMappingSubmitCnt_1 = $this->Custom->getMappingSubmitCnt($country_id,$id);
							$getMappingApproveCnt += $getMappingApproveCnt_1 = $this->Custom->getMappingApproveCnt($country_id,$id);
							//$getHoteApprovedCnt += $getHoteApprovedCnt_1 = $this->Custom->getHoteApprovedCnt($country_id,$id);  getSupplierHotelPendingCnt
							
							$getSupplierHotelPendingCnt += $getSupplierHotelPendingCnt_1 = $this->Custom->getSupplierHotelPendingCnt($country_id,$id,$supplier_id);
							$getSupplierHotelCompeleteCnt += $getSupplierHotelCompeleteCnt_1 = $this->Custom->getSupplierHotelCompeleteCnt($country_id,$id,$supplier_id);
							$getSupplierHotelSubmitCnt += $getSupplierHotelSubmitCnt_1 = $this->Custom->getSupplierHotelSubmitCnt($country_id,$id,$supplier_id);
							$getSupplierHotelTotalCnt += $getSupplierHotelTotalCnt_1 = $this->Custom->getSupplierHotelTotalCnt($country_id,$id,$supplier_id);
							
							
							$getSupportTicketCnt += $getSupportTicketCnt_1 = $this->Custom->getSupportTicketCnt($country_id,$id,$TravelCity[0]['province_id'],$TravelCity[0]['user_id']);
                            ?>
                            <tr>                              
				<td><?php echo $i; ?></td>
                                <td><?php echo $this->Custom->Username($TravelCity[0]['user_id']); ?></td>
				<td><?php echo $this->Custom->Username($TravelCity[0]['approval_id']); ?></td>
				<td><?php echo $this->Custom->Username($TravelCity[0]['maaping_approval_id']); ?></td>
                                <td><?php echo $this->Custom->getCountryName($country_id); ?></td>
                                <td><?php echo $this->Custom->getProvinceName($TravelCity[0]['province_id']); ?></td>
                                <td><?php echo $TravelCity['TravelCity']['city_name']; ?></td> 
                                
                                <td class="background_yellow"><?php echo $getHotelUnallocatedCnt_1; ?></td>
                                <td class="background_yellow">
								<?php if($channel_id == 262): ?>
								<a href="<?php echo $this->webroot .'my-hotels?country_id='.$country_id.'&province_id='.$province_id.'&city_id='.$id ?>" ><?php echo $getHotePendingCnt_1; ?></a>
								<?php else :?>
									<?php echo $getHotePendingCnt_1; ?>
								<?php endif ?>
								</td>
                                <td class="background_yellow">
								<?php if($channel_id == 259): ?>
								<a href="<?php echo $this->webroot .'travel_action_items?country_id='.$country_id.'&province_id='.$province_id.'&city_id='.$id.'&creator='.$creator.'&level_id='.$levelh.'&supplier_id='.$supplier_id ?>" ><?php echo $getHoteSubmittedCnt_1; ?></a>
								<?php else :?>
									<?php echo $getHoteSubmittedCnt_1; ?>
								<?php endif ?>
								</td>
                                <td class="background_yellow"><?php echo $getHoteApprovedCnt_1; ?></td>
                                <td class="background_yellow"><?php echo $getHoteTotalCnt_1; ?></td>                               
                                
                                <td class="background-l-gray"><?php echo $getMappingPendingCnt_1 ; ?></td>
                                <td class="background-l-gray"><?php echo $getMappingSubmitCnt_1; ?></td>
                                <td class="background-l-gray"><?php echo $getMappingApproveCnt_1; ?></td>
                                <td class="background-l-gray"><?php echo $getHoteApprovedCnt_1;?></td>
								
								
                                <td class="background-l-sky">
								<?php if($channel_id == 262): ?>
								<a href="<?php echo $this->webroot .'mappinge_areas/supplier_hotel_report?country_id='.$country_id.'&city_id='.$id.'&supplier_id='.$supplier_id ?>" ><?php echo $getSupplierHotelPendingCnt_1; ?></a>
								<?php else :?>
									<?php echo $getSupplierHotelPendingCnt_1; ?>
								<?php endif ?>
								</td>
                                <td class="background-l-sky">
								<?php if($channel_id == 258): ?>
								<a href="<?php echo $this->webroot .'travel_action_items?country_id='.$country_id.'&province_id='.$province_id.'&city_id='.$id.'&creator='.$creator.'&level_id='.$levelm.'&supplier_id='.$supplier_id ?>" ><?php echo $getSupplierHotelSubmitCnt_1; ?></a>
								<?php else :?>
									<?php echo $getSupplierHotelSubmitCnt_1; ?>
								<?php endif ?>
								</td>
								<td class="background-l-sky"><?php echo $getSupplierHotelCompeleteCnt_1; ?></td>
                                <td class="background-l-sky"><?php echo $getSupplierHotelTotalCnt_1; ?></td>
								
								<td class="background-ticket"><a href="<?php echo $this->webroot .'support_tickets?country_id='.$country_id.'&city_id='.$id .'&province_id='.$TravelCity[0]['province_id'].'&user_id='.$TravelCity[0]['user_id']?>" ><?php echo $getSupportTicketCnt_1 ; ?></a></td>

                            </tr>
                        <?php 
                        $i++;
                        endforeach;
						?>
						<tr>     
								<th colspan="7">Total </th>                         
                                
                                
                                <th><?php echo $getHotelUnallocatedCnt; ?></th>
                                <th><?php echo $getHotePendingCnt; ?></th>
                                <th><?php echo $getHoteSubmittedCnt; ?></th>
                                <th><?php echo $getHoteApprovedCnt; ?></th>
                                <th><?php echo $getHoteTotalCnt; ?></th>                               
                                
                                <th><?php echo $getMappingPendingCnt; ?></th>
                                <th><?php echo $getMappingSubmitCnt; ?></th>
                                <th><?php echo $getMappingApproveCnt; ?></th>
                                <th><?php echo $getHoteApprovedCnt;?></th>
                                
                                <th><?php echo $getSupplierHotelPendingCnt; ?></th>
				<th><?php echo $getSupplierHotelSubmitCnt; ?></th>
                                <th><?php echo $getSupplierHotelCompeleteCnt; ?></th>                                
                                <th><?php echo $getSupplierHotelTotalCnt; ?></th>
								
								<th STYLE="TEXT-ALIGN:LEFT"><?php echo $getSupportTicketCnt;?></td>
                            </tr>

<?php						
                    else:
                        echo '<tr><td colspan="5" class="norecords">No Records Found</td></tr>';
                    endif;
                    ?>
                </tbody>
            </table>
     
            
            <?php }?>
            <!--
            <table id="resp_table" class="table toggle-square" data-filter="#table_search" data-page-size="1000" style="width:50%;float: left;">
                <thead>
                     <tr class="footable-group-row">
                        <th data-group="group1" colspan="7" class="nodis">Mapping</th>                     
                       
                    </tr>
                    <tr>           
                      
                        <th data-toggle="phone"  data-sort-ignore="true" data-group="group1">Pending</th>
                        <th data-toggle="phone"  data-sort-ignore="true" data-group="group1">Submitted</th>
                        <th data-toggle="phone"  data-sort-ignore="true" data-group="group1">Approved</th>
                        <th data-hide="phone"  data-sort-ignore="true" data-group="group1">Total</th>                
                        <th data-hide="phone"  data-sort-ignore="true" data-group="group1">Supplier Total</th>                      
                    </tr>
                </thead>
                <tbody>
                    
                            <tr>                              
                                <td><?php //echo $hotel_unallocated_cnt; ?></td>
                                <td><?php //echo $hotel_pending_cnt; ?></td>
                                <td><?php //echo $hotel_submitted_cnt; ?></td>
                                <td><?php //echo $hotel_approved_cnt; ?></td>
                                <td><?php //echo $hotel_total_cnt; ?></td>                               

                            </tr>
                        
                </tbody>
            </table>
                    -->
        </div>
    </div>
</div>
<br>
<div class="row">
    <div align="center" class="col-sm-12" style="font-size: 15px; font-family: sans-serif">
        <p style="color: black; background-color: #f2d7d5">
        <strong><?php echo "UNL = Unallocated | PND = Pending | SMT = Submitted | APV = Approved | CMP = Completed | TKT = Support Tickets (OPEN / RESOLVED)." ?></strong>
        </p>
    </div> 
</div> 

<?php echo $this->Form->end(); 

$this->Js->get('#ReportSummaryType')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_user_list_by_summary_type'
                ), array(
            'update' => '#ReportUserId',
            'async' => true,
            'before' => 'loading("ReportUserId")',
            'complete' => 'loaded("ReportUserId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);
?>
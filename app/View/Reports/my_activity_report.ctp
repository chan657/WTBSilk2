<?php $this->Html->addCrumb('My Activity Report', 'javascript:void(0);', array('class' => 'breadcrumblast')); 

                echo $this->Form->create('Report', array('controller' => 'reports', 'action' => 'my_activity_report','class' => 'quick_search', 'id' => 'parsley_reg', 'novalidate' => true, 'inputDefaults' => array(
                        'label' => false,
                        'div' => false,
                        'class' => 'form-control',
                )));
                ?>
<div class="row">
    <div class="col-sm-12">
        <div class="table-heading">
            <h4 class="table-heading-title"> My Activities</h4>
            
        </div>
        <div class="panel panel-default">
            <div class="panel_controls hideform"> 
                 
          
                <div class="row">
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Activity Type:</label>
                        <?php echo $this->Form->input('summary_type', array('options' => $summary, 'empty' => '--Select--', 'data-required' => 'true','disabled' => '2')); ?>
                    </div>
					<div class="col-sm-3 col-xs-6">
                        <label for="un_member">Choose Person:</label>
                        <?php echo $this->Form->input('user_id', array('options' => $persons, 'empty' => $Select)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Choose Period:</label>
                        <?php echo $this->Form->input('choose_date', array('options' => $ChooseDate, 'empty' => '--Select--', 'data-required' => 'true')); ?>
                    </div> 
					<div class="col-sm-3 col-xs-6">
                        <label for="un_member">Choose Supplier:</label>
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
                        <th data-group="group3" colspan="5" class="nodis">Information</th>
                        <th data-group="group1" colspan="5">Activity Summary</th> 
                    </tr>
                    <tr>           
                        <th data-toggle="phone"  data-sort-ignore="true" data-group="group3"> Sl. </th>
                        <th data-toggle="phone"  data-sort-ignore="true" data-group="group3"> Person</th>						
                        <th data-toggle="phone"  data-sort-ignore="true" data-group="group3"> Country</th>
                        <th data-toggle="phone"  data-sort-ignore="true" data-group="group3"> Province</th>
                        <th data-toggle="phone"  data-sort-ignore="true" data-group="group3"> City</th>    
                        
                        <th data-toggle="phone"  data-sort-ignore="true" data-group="group1" class="display-total">Hotel Edited</th>
                        <th data-toggle="phone"  data-sort-ignore="true" data-group="group1" class="display-total">Mapping Submitted</th>
                        <th data-toggle="phone"  data-sort-ignore="true" data-group="group1" class="display-total">Hotel Approved</th>
                        <th data-toggle="phone"  data-sort-ignore="true" data-group="group1" class="display-total">Mapping Approved</th>
                        <th data-hide="phone"  data-sort-ignore="true" data-group="group1" class="display-total">Image Uploaded</th>                
                        <th data-hide="phone"  data-sort-ignore="true" data-group="group1" class="display-total">Page Edited</th>  
                        <th data-hide="phone"  data-sort-ignore="true" data-group="group1" class="display-total">Tour Edited</th>   						
                        <th data-hide="phone"  data-sort-ignore="true" data-group="group1" class="display-total">Tour Approved</th> 
                        <th data-hide="phone"  data-sort-ignore="true" data-group="group1" class="display-total">Transfer Edited</th>   						
                        <th data-hide="phone"  data-sort-ignore="true" data-group="group1" class="display-total">Transfer Approved</th>                         
                        <th data-hide="phone"  data-sort-ignore="true" data-group="group1" class="display-total">Package Created</th>   						
                        <th data-hide="phone"  data-sort-ignore="true" data-group="group1" class="display-total">Package Approved</th> 
                                         
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
					//echo '<pre>';
                 /// print_r($TravelCities);
                //  die;
				//echo $data_choose_date;
                    $supplier_id = $this->data['Report']['supplier_id'];
                    $levelh = '7';
                    $levelm = '4';	
                    
                    //For get today
                    if($data_choose_date == 'today'){
                            $sdate = date('Y-m-d').' 00:00:00';
                            $edate = date("Y-m-d").' 23:59:59'; 	
                    }

                    //For get yesterday
                    elseif($data_choose_date == 'yesterday'){
                            $yesterday = date('Y-m-d',strtotime("-1 days"));
                            $sdate = $yesterday.' 00:00:00';
                            $edate = $yesterday.' 23:59:59'; 	
                    }

                    //For get this week
                    elseif($data_choose_date == 'this_week'){
                            $sdate = date('Y-m-d', strtotime("last sunday")).' 00:00:00';
                            $edate = date("Y-m-d").' 23:59:59'; 	
                    }

                    #For get this month
                    elseif($data_choose_date == 'this_month'){
                            $sdate = date('Y-m-01').' 00:00:00';
                            $edate = date("Y-m-d").' 23:59:59'; 
                    }

                    //For get this year
                    elseif($data_choose_date == 'this_year'){
                    $sdate = date('Y-01-01').' 00:00:00';
                    $edate = date("Y-m-d").' 23:59:59';  
                    }	 

                    //For get last year
                    elseif($data_choose_date == 'last_year'){
                    $year =	date('Y')-1;
                    $sdate = date("$year-01-01").' 00:00:00';
                    $edate = date("$year-12-t").' 23:59:59';  
                    }
                    
                    if (isset($TravelCities) && count($TravelCities) > 0):
					
					$hotelEditedCnt = 0;
					$MappingSubmittedCnt = 0;
                                        $hotelApprovedCnt = 0;
                                        $MappingApprovedCnt = 0;
                                        $ImageUploadedCnt = 0;
                                        $PageEditedCnt = 0;
                                        $SightSeeingEditedCnt = 0;
                                        $SightSeeingApprovedCnt = 0;
                                        $TransferEditedCnt = 0;
                                        $TransferApprovedCnt = 0;                                        
                                        $PackageCreatedCnt = 0;
                                        $PackageApprovedCnt = 0;
				
					
                        foreach ($TravelCities as $TravelCity):
                            $id = $TravelCity['TravelCity']['id'];              
                            $country_id = $TravelCity[0]['country_id'];
                            $province_id = $TravelCity[0]['province_id'];							
                            $user_id = $TravelCity[0]['user_id'];
							
                                                        //$hotelEditedCnt += $hotelEditedCnt_1 = $this->Custom->getHoteByDateCnt($country_id,$id,$data_choose_date,'Hotel Edited');
							$hotelEditedCnt += $hotelEditedCnt_1 = $this->Custom->getHotelEditActionByDateCnt($user_id,$country_id,$province_id,$id,$levelh,$sdate,$edate);
							$hotelApprovedCnt += $hotelApprovedCnt_1 = $this->Custom->getHotelApprovedByDateCnt($user_id,$country_id,$province_id,$id,$levelh,$sdate,$edate);
							$MappingSubmittedCnt += $MappingSubmittedCnt_1 = $this->Custom->getMappingSubmitByDateCnt($user_id,$country_id,$id,$supplier_id,$levelm,$sdate,$edate);                                                        
							$MappingApprovedCnt += $MappingApprovedCnt_1 = $this->Custom->getMappingApprovedByDateCnt($user_id,$country_id,$id,$supplier_id,$levelm,$sdate,$edate);
							$ImageUploadedCnt += $ImageUploadedCnt_1 = $this->Custom->getImageUploadedByDateCnt($user_id,$country_id,$province_id,$id,$sdate,$edate);							
							$PageEditedCnt += $PageEditedCnt_1 = $this->Custom->getPageEditedByDateCnt($user_id,$country_id,$province_id,$id,$sdate,$edate);                                                        

                                                         
                            ?>
                            <tr>                              
								<td><?php echo $i; ?></td>
                                <td><?php echo $this->Custom->Username($TravelCity[0]['user_id']); ?></td>								
                                <td><?php echo $this->Custom->getCountryName($country_id); ?></td>
                                <td><?php echo $this->Custom->getProvinceName($TravelCity[0]['province_id']); ?></td>
                                <td><?php echo $TravelCity['TravelCity']['city_name']; ?></td> 
                                
                                <td class="background_yellow"><?php echo $hotelEditedCnt_1; ?></td>
                                <td class="background_yellow"><?php echo $MappingSubmittedCnt_1; ?></td>
                                <td class="background_yellow"><?php echo $hotelApprovedCnt_1; ?></td>                               
                                <td class="background_yellow"><?php echo $MappingApprovedCnt_1; ?></td>
                                <td class="background_yellow"><?php echo $ImageUploadedCnt_1; ?></td>
                                <td class="background_yellow"><?php echo $PageEditedCnt_1; ?></td>
                                <td class="background_yellow"><?php echo "0" ?></td>                                
                                <td class="background_yellow"><?php echo "0" ?></td> 
                                <td class="background_yellow"><?php echo "0" ?></td>                                
                                <td class="background_yellow"><?php echo "0" ?></td>  
                                <td class="background_yellow"><?php echo "0" ?></td>                                
                                <td class="background_yellow"><?php echo "0" ?></td>                                  
                            </tr>
                        <?php 
                        $i++;
                        endforeach;
						?>
							<tr>     
								<th colspan="5">Total </th>  
                                
                                <th class="display-total"><?php echo $hotelEditedCnt; ?></th>
                                <th class="display-total"><?php echo $MappingSubmittedCnt; ?></th>
                                <th class="display-total"><?php echo $hotelApprovedCnt; ?></th>
                                <th class="display-total"><?php echo $MappingApprovedCnt; ?></th>
                                <th class="display-total"><?php echo $ImageUploadedCnt; ?></th>                                                                
                                <th class="display-total"><?php echo $PageEditedCnt; ?></th>
                                <th class="display-total"><?php echo $SightSeeingEditedCnt; ?></th>
                                <th class="display-total"><?php echo $SightSeeingApprovedCnt; ?></th>
                                <th class="display-total"><?php echo $TransferEditedCnt; ?></th>
                                <th class="display-total"><?php echo $TransferApprovedCnt; ?></th>                                
                                <th class="display-total"><?php echo $PackageCreatedCnt; ?></th>                                                                
                                <th class="display-total"><?php echo $PackageApprovedCnt; ?></th>                                  
                            </tr>

<?php						
                    else:
                        echo '<tr><td colspan="5" class="norecords">No Records Found</td></tr>';
                    endif;
                    ?>
                </tbody>
            </table>
     
            
            <?php }?>
            
        </div>
    </div>
</div>

<?php echo $this->Form->end(); 

$this->Js->get('#ReportSummaryType')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_activity_user_list_by_summary_type'
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
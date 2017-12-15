<?php $this->Html->addCrumb('My Builders','javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->element('Builder/top_menu');
?>    
<div class="row">
							<div class="col-sm-12">
                            	<div class="table-heading">
										<h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php
                echo $this->Paginator->counter(array('format' => '{:count}'));
                ?></span> My Builders</h4>
                
                                        <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Builder','/builder/add')?></span>
                                        <span class="search_panel_icon"><i class="icon-plus" id="toggle_search_panel"></i></span>
									</div>
								<div class="panel panel-default">
									
									<div class="panel_controls hideform">
                                    
                                    <?php            
                    echo $this->Form->create('Builder', array('controller' => 'builder', 'class' => 'quick_search', 'id' => 'SearchForm','novalidate'=>true,'inputDefaults' => array(
																	'label' => false,
																	'div' => false,
																	'class' => 'form-control',
																)));
																echo $this->Form->hidden('model_name', array('id' => 'model_name', 'value' => 'Builder'));
                 
                    ?> 
										<div class="row" id="search_panel_controls">
										
                                            <div class="col-sm-3 col-xs-6">
												<label for="un_member">Builder City:</label>
												<?php echo $this->Form->input('builder_primarycity', array('options' => $city, 'empty' => '--Select--')); ?>
											</div>
                                            
                                            <div class="col-sm-3 col-xs-6">
												<label for="un_member">Residential:</label>
												<?php echo $this->Form->input('builder_residential', array('options'=>array('1'=>'Yes','2'=>'No'),'empty'=>'--Select--'));?>
											</div>
                                            <div class="col-sm-3 col-xs-6">
												<label for="un_member">High end:</label>
												<?php echo $this->Form->input('builder_highendresidential', array('options' => array('1' => 'Yes','2' => 'No'), 'empty' => '--Select--')); ?>
											</div>
                                            <div class="col-sm-3 col-xs-6">
												<label for="un_member">Commercial:</label>
												 <?php echo $this->Form->input('builder_commercial', array('options' => array('1' => 'Yes','2' => 'No'), 'empty' => '--Select--')); ?>
											</div>
                                            <div class="col-sm-3 col-xs-6">
												<label for="un_member">Agreement Status:</label>
												 <?php echo $this->Form->input('status', array('options'=>array('1'=>'Yes','2'=>'No'),'empty'=>'--Select--'));?>
											</div>
                                                                             
											<div class="col-sm-3 col-xs-6">
												<label>&nbsp;</label>
                                                <?php
											   echo $this->Form->submit('Filter', array('div' => false, 'class' => 'btn btn-default btn-sm"'));            
											  // echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'btn btn-default btn-sm"'));
					   
					   							?>
												
											</div>
										</div>
                                         <?php echo $this->Form->end(); ?>
									</div>
                                    
									<table border="0" cellpadding="0" cellspacing="0" id="resp_table" class="table toggle-square myclitb" data-filter="#table_search" data-page-size="40">
										<thead>
                                        	<tr class="footable-group-row">
                                                <th data-group="group1" colspan="9" class="nodis">Builder Information</th>
                                                <th data-group="group2" colspan="3">Construction Capabilities</th>
                                                
                                                <th data-group="group3" class="nodis">Builder Action</th>
                                            </tr>
											<tr>
                                            	
												<th data-toggle="true" data-group="group1">Builder Name</th>
												<th data-hide="phone" data-group="group1">Primary City</th>
                                                <th data-hide="phone" data-group="group1">Website</th>
                                                <th data-hide="phone" data-group="group1">Board Number</th>
                                                <th data-hide="phone" data-group="group1">Board Email</th>
                                              
                                               
                                                <th data-hide="all" data-group="group1" data-sort-ignore="true">Corporate Address</th>
                                                <th data-hide="all" data-group="group1" data-sort-ignore="true">Secondary Cities </th>
                                                <th data-hide="all" data-group="group1" data-sort-ignore="true">Summary of Activities</th>
                                                <th data-group="group2" data-sort-ignore="true" data-hide="phone" align="left">Residential</th>
                                                <th data-group="group2" data-sort-ignore="true" data-hide="phone" align="left">High-End</th>
                                                <th data-group="group2" data-sort-ignore="true" data-hide="phone" align="left">Commercial</th>
                                                
                                                <th data-group="group3" data-hide="phone" data-sort-ignore="true">Action</th>        
											</tr>
										</thead>
										<tbody>
                                        	<?php
										 $i = 1;
						//	pr($builders);
						$secondary_city = '';

                           if (isset($builders) && count($builders) > 0):
                                foreach ($builders as $builder):
                                    $id = $builder['Builder']['id'];
									if($builder['SecondaryCity']['city_name'])
										$secondary_city .= $builder['SecondaryCity']['city_name'].',';
									if($builder['TertiaryCity']['city_name'])
										$secondary_city .= $builder['TertiaryCity']['city_name'].',';
									if($builder['City4']['city_name'])
										$secondary_city .= $builder['City4']['city_name'].',';
									if($builder['City5']['city_name'])
										$secondary_city .= $builder['City5']['city_name'].',';			
										
										?>
										<tr>
                                        	<td class="tablebody"><?php echo $builder['Builder']['builder_name']; ?></td>
                                           
                                            <td class="tablebody"><?php echo $builder['City']['city_name']; ?></td>
                                            <td class="tablebody"><?php echo $builder['Builder']['builder_website']; ?></td>
                                            <td class="tablebody"><?php echo $builder['Builder']['builder_boardnumber']; ?></td>
                                            <td class="tablebody"><?php echo $builder['Builder']['builder_boardemail']; ?></td>
                                           
                                            <td class="tablebody"><?php echo $builder['Builder']['builder_corporateaddress']; ?></td> 
                                            <td class="tablebody"><?php echo $secondary_city; ?></td>
                                            <td class="tablebody"><?php echo $builder['Builder']['builder_description']; ?></td>
                                            <td class="sub-tablebody"><?php echo $builder['Residental']['value'];?></td>
                                            <td class="sub-tablebody"><?php echo $builder['Highend']['value']; ?></td>
                                            <td class="sub-tablebody"><?php echo $builder['Commercial']['value']; ?></td>
												<td width="10%" valign="middle" align="center">
                                                	
												<?php 
												
												 echo $this->Html->link('<span class="icon-pencil"></span>', array('controller' => 'builder','action' => 'edit','slug' =>$builder['Builder']['builder_name'].'-'.$builder['City']['city_name'],'id' => base64_encode($id),'mode' => '1'), array('class' => 'act-ico','escape' => false));
                                             echo $this->Html->link('<span class="icon-eye-open"></span>', array('controller' => 'builder','action' => 'edit','slug' => $builder['Builder']['builder_name'].'-'.$builder['City']['city_name'],'id' => base64_encode($id),'mode' => '2'), array('class' => 'act-ico','escape' => false));
											?>
                                                 </td>
                                      
											  </tr>
                                        <?php
                                        endforeach; ?>
                                       
                                         <?php echo $this->element('paginate'); ?>
                                 <?php   endif; ?>
                                        </tbody>
									</table>
                                    <span class="badge badge-circle add-client"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Builder','/builder/add')?></span>
                                    
								</div>
							</div>
						</div>


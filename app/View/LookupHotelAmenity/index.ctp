<?php $this->Html->addCrumb('Data Area','javascript:void(0);', array('class' => 'breadcrumblast'));

?>
<div class="row">
							<div class="col-sm-12">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">My Hotel Amenities</h4>
									</div>
									<div class="panel-body">
										<div class="row">
											
											<div class="col-sm-12">
												<div class="panel-group" id="accordion2">
                                                    <div class="panel panel-success">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc1_collapseone">
																	Amenity Categories
																</a>
															</h4>
														</div>
														<div id="acc1_collapseone" class="panel-collapse collapse">
															<div class="panel-body">
																 <table class="table">
                                                       <tr>
                                                            <th width="10%">ID</th>
                                                             <th width="70%">Value</th>
            
                                                           <th width="13%">Action</th>
                                                       </tr>
                                                       <?php
                                                             
                                                            $i = 1;
                                                       if (isset($categories) && count($categories) > 0):
                                                           foreach ($categories as $category):
                                                               $id = $category['TravelLookupAmenityCategorie']['id'];
                                                               ?>
                                                               <tr>
                                                                  <td align="left" valign="right" class="tablebody"><?php echo $i; ?></td>
                                                                  <td align="left" valign="left" class="tablebody"><?php echo $category['TravelLookupAmenityCategorie']['value']; ?></td>
                           
                                                                   <td align="center" valign="middle">
                                                                   <?php
                                                                      echo $this->Html->link('Edit', '/datas/edit_amenities_category/' . $id, array('class' => 'btn btn-success sticky_success open-popup-link'));
                                                                   ?>
                                                                   </td>
                                                               </tr>
                                                           
                                                               <?php
                                                               $i++;
                                                           endforeach;
                                                       endif;
                                                       ?>
                                                   </table>                                          
                                                   
                                                      <?php
                                                      echo $this->Html->link('Add', '/datas/add_amenities_category/', array('class' => 'btn btn-success sticky_success open-popup-link'));
                                                      ?>
															</div>
														</div>
													</div>
                                                    <div class="panel panel-success">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc1_collapseTwo">
																	Amenity Types
																</a>
															</h4>
														</div>
														<div id="acc1_collapseTwo" class="panel-collapse collapse">
															<div class="panel-body">
																 <table class="table">
                                                       <tr>
                                                            <th width="10%">ID</th>
                                                             <th width="10%">Value</th>
            												 <th width="60%">Amenities</th>	
                                                           <th width="13%">Action</th>
                                                       </tr>
                                                       <?php
                                                     
                                                            // pr($amenities);
                                                            $i = 1;
                                                       if (isset($amenities) && count($amenities) > 0):
                                                           foreach ($amenities as $key => $amenitie) :
                                                               $id = $amenities[$key]['TravelLookupAmenityType']['amenity_category_id'];
                                                               ?>
                                                               <tr>
                                                                  <td align="left" valign="right" class="tablebody"><?php echo $i; ?></td>
                                                                  <td align="left" valign="right" class="tablebody"><?php echo $amenities[$key]['TravelLookupAmenityCategorie']['value']; ?></td>
                                                                  <td align="left" valign="left" class="tablebody"><?php echo $amenities[$key][0]['amenity_name']; ?></td>
                           
                                                                   <td align="center" valign="middle">
                                                                   <?php
                                                                      echo $this->Html->link('Edit', '/datas/edit_amenities/' . $id, array('class' => 'btn btn-success sticky_success open-popup-link'));
                                                                   ?>
                                                                   </td>
                                                               </tr>
                                                           
                                                               <?php
                                                               $i++;
                                                           endforeach;
                                                       endif;
                                                       ?>
                                                   </table>                                          
                                                   
                                                      <?php
                                                      echo $this->Html->link('Add', '/datas/add_amenities/', array('class' => 'btn btn-success sticky_success open-popup-link'));
                                                      ?>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>


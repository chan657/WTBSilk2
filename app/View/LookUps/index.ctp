<div class="row">
							<div class="col-sm-12">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">My Look Ups Table</h4>
									</div>
									<div class="panel-body">
										<div class="row">
											
											<div class="col-sm-12">
												<div class="panel-group" id="accordion2">
													<div class="panel panel-success">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseOne">
																	Lookup For Project Phase
																</a>
															</h4>
														</div>
														<div id="acc2_collapseOne" class="panel-collapse collapse">
															<div class="panel-body">
																<table class="table">
                                           <tr>
                                                <th width="10%">ID</th>
                                                             <th width="70%">Value</th>
            
                                                           <th width="13%">Action</th>
                                           </tr>
                                           <?php
                                                 
                                                $i = 1;
                                           if (isset($phases) && count($phases) > 0):
                                               foreach ($phases as $phase):
                                                   $id = $phase['Phase']['id'];
                                                   ?>
                                                   <tr>
                                                      <td><?php echo $i; ?></td>
                                                      <td><?php echo $phase['Phase']['name']; ?></td>

               
                                                       <td>
                                                       <?php
                                                                
                                                                
                                                                echo $this->Html->link('Edit', '/look_ups/edit_project_phase/' . $id, array('class' => 'btn btn-success sticky_success open-popup-link'));
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
                                                     echo $this->Html->link('Add', '/look_ups/add_project_phase/', array('class' => 'btn btn-success sticky_success open-popup-link'));                                      
                                                      ?>
															</div>
														</div>
													</div>
													<div class="panel panel-success">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseTwo">
																	Lookup For Project Marketing
																</a>
															</h4>
														</div>
														<div id="acc2_collapseTwo" class="panel-collapse collapse">
															<div class="panel-body">
																<table class="table">
                                           <tr>
                                                <th width="10%">ID</th>
                                                             <th width="70%">Value</th>
            
                                                           <th width="13%">Action</th>
                                           </tr>
                                           <?php
                                               
                                                $i = 1;
                                           if (isset($marketings) && count($marketings) > 0):
                                               foreach ($marketings as $marketing):
                                                   $id = $marketing['Marketing']['id'];
                                                   ?>
                                                   <tr>
                                                      <td><?php echo $i; ?></td>
                                                      <td><?php echo $marketing['Marketing']['name']; ?></td>

               
                                                       <td>
                                                       <?php
                                                                
                                                               
                                                                echo $this->Html->link('Edit', '/look_ups/edit_project_marketing/' . $id, array('class' => 'btn btn-success sticky_success open-popup-link'));
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
                                                      echo $this->Html->link('Add', '/look_ups/add_project_marketing/', array('class' => 'btn btn-success sticky_success open-popup-link'));                                           
                                                      ?>
															</div>
														</div>
													</div>
													<div class="panel panel-success">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseThree">
																	Lookup For Project Categories
																</a>
															</h4>
														</div>
														<div id="acc2_collapseThree" class="panel-collapse collapse">
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
                                                               $id = $category['Category']['id'];
                                                               ?>
                                                               <tr>
                                                                  <td><?php echo $i; ?></td>
                                                                  <td><?php echo $category['Category']['name']; ?></td>
            
                           
                                                                   <td>
                                                                   <?php
                                                                            
                                                                            
                                                                            echo $this->Html->link('Edit', '/look_ups/edit_project_category/' . $id, array('class' => 'btn btn-success sticky_success open-popup-link'));
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
                                                      echo $this->Html->link('Add', '/look_ups/add_project_category/', array('class' => 'btn btn-success sticky_success open-popup-link'));                                           
                                                      ?>
															</div>
														</div>
													</div>
													<div class="panel panel-success">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseFour">
																	Lookup For Project Unit Types
																</a>
															</h4>
														</div>
														<div id="acc2_collapseFour" class="panel-collapse collapse">
															<div class="panel-body">
																 <table class="table">
                                                       <tr>
                                                            <th width="10%">ID</th>
                                                             <th width="70%">Value</th>
            
                                                           <th width="13%">Action</th>
                                                       </tr>
                                                       <?php
                                                             
                                                            $i = 1;
                                                       if (isset($lookup_value_project_unit_types) && count($lookup_value_project_unit_types > 0)):
                                                           foreach ($lookup_value_project_unit_types as $lookup_value_project_unit_type):
                                                               $id = $lookup_value_project_unit_type['LookupValueProjectUnitType']['id'];
                                                               ?>
                                                               <tr>
                                                                  <td><?php echo $i; ?></td>
                                                                  <td><?php echo $lookup_value_project_unit_type['LookupValueProjectUnitType']['value']; ?></td>
            
                           
                                                                   <td>
                                                                   <?php
                                                                      echo $this->Html->link('Edit', '/look_ups/edit_project_unit_type/' . $id, array('class' => 'btn btn-success sticky_success open-popup-link'));
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
                                                      echo $this->Html->link('Add', '/look_ups/add_project_unit_type/', array('class' => 'btn btn-success sticky_success open-popup-link'));                                           
                                                      ?>
															</div>
														</div>
													</div>
                                                    <div class="panel panel-success">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseFive">
																	Lookup For Project Unit Type Qualifier1
																</a>
															</h4>
														</div>
														<div id="acc2_collapseFive" class="panel-collapse collapse">
															<div class="panel-body">
																<table class="table">
                                                       <tr>
                                                            <th width="10%">ID</th>
                                                             <th width="70%">Value</th>
            
                                                           <th width="13%">Action</th>
                                                       </tr>
                                                       <?php
                                                             
                                                            $i = 1;
                                                       if (isset($lookup_value_project_unit_type_qualifier_1) && count($lookup_value_project_unit_type_qualifier_1 > 0)):
                                                           foreach ($lookup_value_project_unit_type_qualifier_1 as $lookup_value_project_unit_type_qualifier_1s):
                                                               $id = $lookup_value_project_unit_type_qualifier_1s['LookupValueProjectUnitTypeQualifier_1']['id'];
                                                               ?>
                                                               <tr>
                                                                  <td><?php echo $i; ?></td>
                                                                  <td><?php echo $lookup_value_project_unit_type_qualifier_1s['LookupValueProjectUnitTypeQualifier_1']['value']; ?></td>
            
                           
                                                                   <td>
                                                                   <?php
                                                                      echo $this->Html->link('Edit', '/look_ups/edit_project_unit_type_qualifier1/' . $id, array('class' => 'btn btn-success sticky_success open-popup-link'));
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
                                                      echo $this->Html->link('Add', '/look_ups/add_project_unit_type_qualifier1/', array('class' => 'btn btn-success sticky_success open-popup-link'));                                           
                                                      ?>
															</div>
														</div>
													</div>
                                                    <div class="panel panel-success">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseSix">
																	Lookup For Project Unit Type Qualifier2
																</a>
															</h4>
														</div>
														<div id="acc2_collapseSix" class="panel-collapse collapse">
															<div class="panel-body">
																 <table class="table">
                                                       <tr>
                                                           <th width="10%">ID</th>
                                                             <th width="70%">Value</th>
            
                                                           <th width="13%">Action</th>
                                                       </tr>
                                                       <?php
                                                             
                                                            $i = 1;
                                                       if (isset($lookup_value_project_unit_type_qualifier_2) && count($lookup_value_project_unit_type_qualifier_2 > 0)):
                                                           foreach ($lookup_value_project_unit_type_qualifier_2 as $lookup_value_project_unit_type_qualifier_2s):
                                                               $id = $lookup_value_project_unit_type_qualifier_2s['LookupValueProjectUnitTypeQualifier_2']['id'];
                                                               ?>
                                                               <tr>
                                                                  <td><?php echo $i; ?></td>
                                                                  <td><?php echo $lookup_value_project_unit_type_qualifier_2s['LookupValueProjectUnitTypeQualifier_2']['value']; ?></td>
            
                           
                                                                   <td>
                                                                   <?php
                                                                      echo $this->Html->link('Edit', '/look_ups/edit_project_unit_type_qualifier2/' . $id, array('class' => 'btn btn-success sticky_success open-popup-link'));
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
                                                      echo $this->Html->link('Add', '/look_ups/add_project_unit_type_qualifier2/', array('class' => 'btn btn-success sticky_success open-popup-link'));                                           
                                                      ?>
															</div>
														</div>
													</div>
                                                    <div class="panel panel-success">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseSeven">
																	Lookup For Project Unit Type Qualifier3
																</a>
															</h4>
														</div>
														<div id="acc2_collapseSeven" class="panel-collapse collapse">
															<div class="panel-body">
																 <table class="table">
                                                       <tr>
                                                            <th width="10%">ID</th>
                                                             <th width="70%">Value</th>
            
                                                           <th width="13%">Action</th>
                                                       </tr>
                                                       <?php
                                                             
                                                            $i = 1;
                                                       if (isset($lookup_value_project_unit_type_qualifier_3) && count($lookup_value_project_unit_type_qualifier_3 > 0)):
                                                           foreach ($lookup_value_project_unit_type_qualifier_3 as $lookup_value_project_unit_type_qualifier_3s):
                                                               $id = $lookup_value_project_unit_type_qualifier_3s['LookupValueProjectUnitTypeQualifier_3']['id'];
                                                               ?>
                                                               <tr>
                                                                  <td><?php echo $i; ?></td>
                                                                  <td><?php echo $lookup_value_project_unit_type_qualifier_3s['LookupValueProjectUnitTypeQualifier_3']['value']; ?></td>
            
                           
                                                                   <td>
                                                                   <?php
                                                                      echo $this->Html->link('Edit', '/look_ups/edit_project_unit_type_qualifier3/' . $id, array('class' => 'btn btn-success sticky_success open-popup-link'));
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
                                                      echo $this->Html->link('Add', '/look_ups/add_project_unit_type_qualifier3/', array('class' => 'btn btn-success sticky_success open-popup-link'));                                           
                                                      ?>
															</div>
														</div>
													</div>
                                                    <div class="panel panel-success">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseEight">
																	Lookup For Project Unit Type Qualifier4
																</a>
															</h4>
														</div>
														<div id="acc2_collapseEight" class="panel-collapse collapse">
															<div class="panel-body">
																 <table class="table">
                                                       <tr>
                                                            <th width="10%">ID</th>
                                                             <th width="70%">Value</th>
            
                                                           <th width="13%">Action</th>
                                                       </tr>
                                                        <?php
                                                             
                                                            $i = 1;
                                                       if (isset($lookup_value_project_unit_type_qualifier_4) && count($lookup_value_project_unit_type_qualifier_4 > 0)):
                                                           foreach ($lookup_value_project_unit_type_qualifier_4 as $lookup_value_project_unit_type_qualifier_4s):
                                                               $id = $lookup_value_project_unit_type_qualifier_4s['LookupValueProjectUnitTypeQualifier_4']['id'];
                                                               ?>
                                                               <tr>
                                                                  <td><?php echo $i; ?></td>
                                                                  <td><?php echo $lookup_value_project_unit_type_qualifier_4s['LookupValueProjectUnitTypeQualifier_4']['value']; ?></td>
            
                           
                                                                   <td>
                                                                   <?php
                                                                      echo $this->Html->link('Edit', '/look_ups/edit_project_unit_type_qualifier4/' . $id, array('class' => 'btn btn-success sticky_success open-popup-link'));
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
                                                      echo $this->Html->link('Add', '/look_ups/add_project_unit_type_qualifier4/', array('class' => 'btn btn-success sticky_success open-popup-link'));                                           
                                                      ?>
															</div>
														</div>
													</div>
                                                    <div class="panel panel-success">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseNine">
																	Lookup For Project Unit Type Qualifier5
																</a>
															</h4>
														</div>
														<div id="acc2_collapseNine" class="panel-collapse collapse">
															<div class="panel-body">
																 <table class="table">
                                                       <tr>
                                                            <th width="10%">ID</th>
                                                             <th width="70%">Value</th>
            
                                                           <th width="13%">Action</th>
                                                       </tr>
                                                        <?php
                                                             
                                                            $i = 1;
                                                       if (isset($lookup_value_project_unit_type_qualifier_5) && count($lookup_value_project_unit_type_qualifier_5 > 0)):
                                                           foreach ($lookup_value_project_unit_type_qualifier_5 as $lookup_value_project_unit_type_qualifier_5s):
                                                               $id = $lookup_value_project_unit_type_qualifier_5s['LookupValueProjectUnitTypeQualifier_5']['id'];
                                                               ?>
                                                               <tr>
                                                                  <td><?php echo $i; ?></td>
                                                                  <td><?php echo $lookup_value_project_unit_type_qualifier_5s['LookupValueProjectUnitTypeQualifier_5']['value']; ?></td>
            
                           
                                                                   <td align="center" valign="middle">
                                                                   <?php
                                                                      echo $this->Html->link('Edit', '/look_ups/edit_project_unit_type_qualifier5/' . $id, array('class' => 'btn btn-success sticky_success open-popup-link'));
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
                                                      echo $this->Html->link('Add', '/look_ups/add_project_unit_type_qualifier5/', array('class' => 'btn btn-success sticky_success open-popup-link'));                                           
                                                      ?>
															</div>
														</div>
													</div>
                                                    <div class="panel panel-success">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseTen">
																	Lookup For Project Types
																</a>
															</h4>
														</div>
														<div id="acc2_collapseTen" class="panel-collapse collapse">
															<div class="panel-body">
																 <table class="table">
                                                       <tr>
                                                            <th width="10%">ID</th>
                                                             <th width="70%">Value</th>
            
                                                           <th width="13%">Action</th>
                                                       </tr>
                                                       <?php
                                                             
                                                            $i = 1;
                                                       if (isset($types) && count($types) > 0):
                                                           foreach ($types as $type):
                                                               $id = $type['Type']['id'];
                                                               ?>
                                                               <tr>
                                                                  <td align="left" valign="right" class="tablebody"><?php echo $i; ?></td>
                                                                  <td align="left" valign="left" class="tablebody"><?php echo $type['Type']['name']; ?></td>
            
                           
                                                                   <td align="center" valign="middle">
                                                                   <?php
                                                                      echo $this->Html->link('Edit', '/look_ups/edit_project_type/' . $id, array('class' => 'btn btn-success sticky_success open-popup-link'));
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
                                                      echo $this->Html->link('Add', '/look_ups/add_project_type/', array('class' => 'btn btn-success sticky_success open-popup-link'));                                           
                                                      ?>
															</div>
														</div>
													</div>
                                                    <div class="panel panel-success">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseEleven">
																	Lookup For Project Qualities
																</a>
															</h4>
														</div>
														<div id="acc2_collapseEleven" class="panel-collapse collapse">
															<div class="panel-body">
																 <table class="table">
                                                       <tr>
                                                            <th width="10%">ID</th>
                                                             <th width="70%">Value</th>
            
                                                           <th width="13%">Action</th>
                                                       </tr>
                                                      <?php
                                                             
                                                            $i = 1;
                                                       if (isset($qualities) && count($qualities) > 0):
                                                           foreach ($qualities as $quality):
                                                               $id = $quality['Quality']['id'];
                                                               ?>
                                                               <tr>
                                                                  <td><?php echo $i; ?></td>
                                                                  <td><?php echo $quality['Quality']['name']; ?></td>
            
                           
                                                                   <td align="center" valign="middle">
                                                                   <?php
                                                                      echo $this->Html->link('Edit', '/look_ups/edit_project_qualities/' . $id, array('class' => 'btn btn-success sticky_success open-popup-link'));
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
                                                      echo $this->Html->link('Add', '/look_ups/add_project_qualities/', array('class' => 'btn btn-success sticky_success open-popup-link'));
                                                      ?>
															</div>
														</div>
													</div>
                                                    <div class="panel panel-success">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseTwelve">
																	Lookup For Actionitem Levels
																</a>
															</h4>
														</div>
														<div id="acc2_collapseTwelve" class="panel-collapse collapse">
															<div class="panel-body">
																 <table class="table">
                                                       <tr>
                                                            <th width="10%">ID</th>
                                                             <th width="70%">Value</th>
            
                                                           <th width="13%">Action</th>
                                                       </tr>
                                                       <?php
                                                             
                                                            $i = 1;
                                                       if (isset($action_item_levels) && count($action_item_levels) > 0):
                                                           foreach ($action_item_levels as $action_item_level):
                                                               $id = $action_item_level['ActionItemLevel']['id'];
                                                               ?>
                                                               <tr>
                                                                  <td align="left" valign="right" class="tablebody"><?php echo $i; ?></td>
                                                                  <td align="left" valign="left" class="tablebody"><?php echo $action_item_level['ActionItemLevel']['level']; ?></td>
            
                           
                                                                   <td align="center" valign="middle">
                                                                   <?php
                                                                      echo $this->Html->link('Edit', '/look_ups/edit_action_level/' . $id, array('class' => 'btn btn-success sticky_success open-popup-link'));
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
                                                      echo $this->Html->link('Add', '/look_ups/add_action_level/', array('class' => 'btn btn-success sticky_success open-popup-link'));
                                                      ?>
															</div>
														</div>
													</div>
                                                    <div class="panel panel-success">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseThirteen">
																	Lookup For Actionitem Types
																</a>
															</h4>
														</div>
														<div id="acc2_collapseThirteen" class="panel-collapse collapse">
															<div class="panel-body">
																 <table class="table">
                                                       <tr>
                                                            <th width="10%">ID</th>
                                                             <th width="70%">Value</th>
            
                                                           <th width="13%">Action</th>
                                                       </tr>
                                                       <?php
                                                             
                                                            $i = 1;
                                                       if (isset($action_item_types) && count($action_item_types) > 0):
                                                           foreach ($action_item_types as $action_item_type):
                                                               $id = $action_item_type['ActionItemType']['id'];
                                                               ?>
                                                               <tr>
                                                                  <td align="left" valign="right" class="tablebody"><?php echo $i; ?></td>
                                                                  <td align="left" valign="left" class="tablebody"><?php echo $action_item_type['ActionItemType']['type']; ?></td>
            
                           
                                                                   <td align="center" valign="middle">
                                                                   <?php
                                                                      echo $this->Html->link('Edit', '/look_ups/edit_action_type/' . $id, array('class' => 'btn btn-success sticky_success open-popup-link'));
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
                                                      echo $this->Html->link('Add', '/look_ups/add_action_type/', array('class' => 'btn btn-success sticky_success open-popup-link'));
                                                      ?>
															</div>
														</div>
													</div>
                                                    <div class="panel panel-success">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseForteen">
																	Lookup For Project Unit Type Qualifier3
																</a>
															</h4>
														</div>
														<div id="acc2_collapseForteen" class="panel-collapse collapse">
															<div class="panel-body">
																 <table class="table">
                                                       <tr>
                                                            <th width="10%">ID</th>
                                                             <th width="70%">Value</th>
            
                                                           <th width="13%">Action</th>
                                                       </tr>
                                                      <?php
                                                             
                                                            $i = 1;
                                                       if (isset($lookup_value_action_item_statuses) && count($lookup_value_action_item_statuses) > 0):
                                                           foreach ($lookup_value_action_item_statuses as $lookup_value_action_item_status):
                                                               $id = $lookup_value_action_item_status['LookupValueActionItemStatus']['id'];
                                                               ?>
                                                               <tr>
                                                                  <td align="left" valign="right" class="tablebody"><?php echo $i; ?></td>
                                                                  <td align="left" valign="left" class="tablebody"><?php echo $lookup_value_action_item_status['LookupValueActionItemStatus']['value']; ?></td>
            
                           
                                                                   <td align="center" valign="middle">
                                                                   <?php
                                                                      echo $this->Html->link('Edit', '/look_ups/edit_action_status/' . $id, array('class' => 'btn btn-success sticky_success open-popup-link'));
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
                                                      echo $this->Html->link('Add', '/look_ups/add_action_status/', array('class' => 'btn btn-success sticky_success open-popup-link'));
                                                      ?>
															</div>
														</div>
													</div>
                                                    <div class="panel panel-success">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseFifteen">
																	Lookup For Lead Categories
																</a>
															</h4>
														</div>
														<div id="acc2_collapseFifteen" class="panel-collapse collapse">
															<div class="panel-body">
																 <table class="table">
                                                       <tr>
                                                            <th width="10%">ID</th>
                                                             <th width="70%">Value</th>
            
                                                           <th width="13%">Action</th>
                                                       </tr>
                                                       <?php
                                                             
                                                            $i = 1;
                                                       if (isset($lookup_value_lead_categories) && count($lookup_value_lead_categories) > 0):
                                                           foreach ($lookup_value_lead_categories as $lookup_value_lead_category):
                                                               $id = $lookup_value_lead_category['LookupValueLeadsCategory']['id'];
                                                               ?>
                                                               <tr>
                                                                  <td align="left" valign="right" class="tablebody"><?php echo $i; ?></td>
                                                                  <td align="left" valign="left" class="tablebody"><?php echo $lookup_value_lead_category['LookupValueLeadsCategory']['value']; ?></td>
            
                           
                                                                   <td align="center" valign="middle">
                                                                   <?php
                                                                      echo $this->Html->link('Edit', '/look_ups/edit_lead_category/' . $id, array('class' => 'btn btn-success sticky_success open-popup-link'));
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
                                                      echo $this->Html->link('Add', '/look_ups/add_lead_category/', array('class' => 'btn btn-success sticky_success open-popup-link'));
                                                      ?>
															</div>
														</div>
													</div>
                                                    <div class="panel panel-success">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseSixteen">
																	Lookup For Lead Closure Probabilities
																</a>
															</h4>
														</div>
														<div id="acc2_collapseSixteen" class="panel-collapse collapse">
															<div class="panel-body">
																 <table class="table">
                                                       <tr>
                                                            <th width="10%">ID</th>
                                                             <th width="70%">Value</th>
            
                                                           <th width="13%">Action</th>
                                                       </tr>
                                                       <?php
                                                             
                                                            $i = 1;
                                                       if (isset($lookup_value_leads_closure_probabilities) && count($lookup_value_leads_closure_probabilities) > 0):
                                                           foreach ($lookup_value_leads_closure_probabilities as $lookup_value_leads_closure_probability):
                                                               $id = $lookup_value_leads_closure_probability['LookupValueLeadsClosureProbability']['id'];
                                                               ?>
                                                               <tr>
                                                                  <td align="left" valign="right" class="tablebody"><?php echo $i; ?></td>
                                                                  <td align="left" valign="left" class="tablebody"><?php echo $lookup_value_leads_closure_probability['LookupValueLeadsClosureProbability']['value']; ?></td>
            
                           
                                                                   <td align="center" valign="middle">
                                                                   <?php
                                                                      echo $this->Html->link('Edit', '/look_ups/edit_lead_closure/' . $id, array('class' => 'btn btn-success sticky_success open-popup-link'));
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
                                                      echo $this->Html->link('Add', '/look_ups/add_lead_closure/', array('class' => 'btn btn-success sticky_success open-popup-link'));
                                                      ?>
															</div>
														</div>
													</div>
                                                    <div class="panel panel-success">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseSeventeen">
																	Lookup For Lead Countries
																</a>
															</h4>
														</div>
														<div id="acc2_collapseSeventeen" class="panel-collapse collapse">
															<div class="panel-body">
																 <table class="table">
                                                       <tr>
                                                            <th width="10%">ID</th>
                                                             <th width="70%">Value</th>
            
                                                           <th width="13%">Action</th>
                                                       </tr>
                                                        <?php
                                                             
                                                            $i = 1;
                                                       if (isset($lookup_value_leads_countries) && count($lookup_value_leads_countries) > 0):
                                                           foreach ($lookup_value_leads_countries as $lookup_value_leads_country):
                                                               $id = $lookup_value_leads_country['LookupValueLeadsCountry']['id'];
                                                               ?>
                                                               <tr>
                                                                  <td align="left" valign="right" class="tablebody"><?php echo $i; ?></td>
                                                                  <td align="left" valign="left" class="tablebody"><?php echo $lookup_value_leads_country['LookupValueLeadsCountry']['value']; ?></td>
            
                           
                                                                   <td align="center" valign="middle">
                                                                   <?php
                                                                      echo $this->Html->link('Edit', '/look_ups/edit_lead_country/' . $id, array('class' => 'btn btn-success sticky_success open-popup-link'));
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
                                                      echo $this->Html->link('Add', '/look_ups/add_lead_country/', array('class' => 'btn btn-success sticky_success open-popup-link'));
                                                      ?>
															</div>
														</div>
													</div>
                                                    <div class="panel panel-success">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseEightteen">
																	Lookup For Lead Closure Probabilities
																</a>
															</h4>
														</div>
														<div id="acc2_collapseEightteen" class="panel-collapse collapse">
															<div class="panel-body">
																 <table class="table">
                                                       <tr>
                                                            <th width="10%">ID</th>
                                                             <th width="70%">Value</th>
            
                                                           <th width="13%">Action</th>
                                                       </tr>
                                                       <?php
                                                             
                                                            $i = 1;
                                                       if (isset($lookup_value_leads_creation_types) && count($lookup_value_leads_creation_types) > 0):
                                                           foreach ($lookup_value_leads_creation_types as $lookup_value_leads_creation_type):
                                                               $id = $lookup_value_leads_creation_type['LookupValueLeadsCreationType']['id'];
                                                               ?>
                                                               <tr>
                                                                  <td align="left" valign="right" class="tablebody"><?php echo $i; ?></td>
                                                                  <td align="left" valign="left" class="tablebody"><?php echo $lookup_value_leads_creation_type['LookupValueLeadsCreationType']['value']; ?></td>
            
                           
                                                                   <td align="center" valign="middle">
                                                                   <?php
                                                                      echo $this->Html->link('Edit', '/look_ups/edit_lead_creation_type/' . $id, array('class' => 'btn btn-success sticky_success open-popup-link'));
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
                                                      echo $this->Html->link('Add', '/look_ups/add_lead_creation_type/', array('class' => 'btn btn-success sticky_success open-popup-link'));
                                                      ?>
															</div>
														</div>
													</div>
                                                    <div class="panel panel-success">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseNineteen">
																	Lookup For Lead Importance
																</a>
															</h4>
														</div>
														<div id="acc2_collapseNineteen" class="panel-collapse collapse">
															<div class="panel-body">
																 <table class="table">
                                                       <tr>
                                                            <th width="10%">ID</th>
                                                             <th width="70%">Value</th>
            
                                                           <th width="13%">Action</th>
                                                       </tr>
                                                       <?php
                                                             
                                                            $i = 1;
                                                       if (isset($lookup_value_leads_importances) && count($lookup_value_leads_importances) > 0):
                                                           foreach ($lookup_value_leads_importances as $lookup_value_leads_importance):
                                                               $id = $lookup_value_leads_importance['LookupValueLeadsImportance']['id'];
                                                               ?>
                                                               <tr>
                                                                  <td align="left" valign="right" class="tablebody"><?php echo $i; ?></td>
                                                                  <td align="left" valign="left" class="tablebody"><?php echo $lookup_value_leads_importance['LookupValueLeadsImportance']['value']; ?></td>
            
                           
                                                                   <td align="center" valign="middle">
                                                                   <?php
                                                                      echo $this->Html->link('Edit', '/look_ups/edit_lead_importance/' . $id, array('class' => 'btn btn-success sticky_success open-popup-link'));
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
                                                      echo $this->Html->link('Add', '/look_ups/add_lead_importance/', array('class' => 'btn btn-success sticky_success open-popup-link'));
                                                      ?>
															</div>
														</div>
													</div>
                                                    <div class="panel panel-success">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseTwentyteen">
																	Lookup For Lead Industries
																</a>
															</h4>
														</div>
														<div id="acc2_collapseTwentyteen" class="panel-collapse collapse">
															<div class="panel-body">
																 <table class="table">
                                                       <tr>
                                                            <th width="10%">ID</th>
                                                             <th width="70%">Value</th>
            
                                                           <th width="13%">Action</th>
                                                       </tr>
                                                      <?php
                                                             
                                                            $i = 1;
                                                       if (isset($lookup_value_leads_industries) && count($lookup_value_leads_industries) > 0):
                                                           foreach ($lookup_value_leads_industries as $lookup_value_leads_industry):
                                                               $id = $lookup_value_leads_industry['LookupValueLeadsIndustry']['id'];
                                                               ?>
                                                               <tr>
                                                                  <td align="left" valign="right" class="tablebody"><?php echo $i; ?></td>
                                                                  <td align="left" valign="left" class="tablebody"><?php echo $lookup_value_leads_industry['LookupValueLeadsIndustry']['value']; ?></td>
            
                           
                                                                   <td align="center" valign="middle">
                                                                   <?php
                                                                      echo $this->Html->link('Edit', '/look_ups/edit_lead_industry/' . $id, array('class' => 'btn btn-success sticky_success open-popup-link'));
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
                                                      echo $this->Html->link('Add', '/look_ups/add_lead_industry/', array('class' => 'btn btn-success sticky_success open-popup-link'));
                                                      ?>
															</div>
														</div>
													</div>
                                                    <div class="panel panel-success">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseTwentyone">
																	Lookup For Lead Progress
																</a>
															</h4>
														</div>
														<div id="acc2_collapseTwentyone" class="panel-collapse collapse">
															<div class="panel-body">
																 <table class="table">
                                                       <tr>
                                                            <th width="10%">ID</th>
                                                             <th width="70%">Value</th>
            
                                                           <th width="13%">Action</th>
                                                       </tr>
                                                        <?php
                                                             
                                                            $i = 1;
                                                       if (isset($lookup_value_leads_progresses) && count($lookup_value_leads_progresses) > 0):
                                                           foreach ($lookup_value_leads_progresses as $lookup_value_leads_progress):
                                                               $id = $lookup_value_leads_progress['LookupValueLeadsProgress']['id'];
                                                               ?>
                                                               <tr>
                                                                  <td align="left" valign="right" class="tablebody"><?php echo $i; ?></td>
                                                                  <td align="left" valign="left" class="tablebody"><?php echo $lookup_value_leads_progress['LookupValueLeadsProgress']['value']; ?></td>
                           
                                                                   <td align="center" valign="middle">
                                                                   <?php
                                                                     echo $this->Html->link('Edit', '/look_ups/edit_lead_progress/' . $id, array('class' => 'btn btn-success sticky_success open-popup-link'));
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
                                                      echo $this->Html->link('Add', '/look_ups/add_lead_progress/', array('class' => 'btn btn-success sticky_success open-popup-link'));
                                                      ?>
															</div>
														</div>
													</div>
                                                    <div class="panel panel-success">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseTwentytwo">
																	Lookup For Lead Segments
																</a>
															</h4>
														</div>
														<div id="acc2_collapseTwentytwo" class="panel-collapse collapse">
															<div class="panel-body">
																 <table class="table">
                                                       <tr>
                                                            <th width="10%">ID</th>
                                                             <th width="70%">Value</th>
            
                                                           <th width="13%">Action</th>
                                                       </tr>
                                                       <?php
                                                             
                                                            $i = 1;
                                                       if (isset($lookup_value_leads_segments) && count($lookup_value_leads_segments) > 0):
                                                           foreach ($lookup_value_leads_segments as $lookup_value_leads_segment):
                                                               $id = $lookup_value_leads_segment['LookupValueLeadsSegment']['id'];
                                                               ?>
                                                               <tr>
                                                                  <td align="left" valign="right" class="tablebody"><?php echo $i; ?></td>
                                                                  <td align="left" valign="left" class="tablebody"><?php echo $lookup_value_leads_segment['LookupValueLeadsSegment']['value']; ?></td>
                           
                                                                   <td align="center" valign="middle">
                                                                   <?php
                                                                      echo $this->Html->link('Edit', '/look_ups/edit_lead_segment/' . $id, array('class' => 'btn btn-success sticky_success open-popup-link'));
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
                                                      echo $this->Html->link('Add', '/look_ups/add_lead_segment/', array('class' => 'btn btn-success sticky_success open-popup-link'));
                                                      ?>
															</div>
														</div>
													</div>
                                                    <div class="panel panel-success">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseTwentythree">
																	Lookup For Lead Status
																</a>
															</h4>
														</div>
														<div id="acc2_collapseTwentythree" class="panel-collapse collapse">
															<div class="panel-body">
																 <table class="table">
                                                       <tr>
                                                            <th width="10%">ID</th>
                                                             <th width="70%">Value</th>
            
                                                           <th width="13%">Action</th>
                                                       </tr>
                                                        <?php
                                                             
                                                            $i = 1;
                                                       if (isset($lead_statuses) && count($lead_statuses) > 0):
                                                           foreach ($lead_statuses as $lead_status):
                                                               $id = $lead_status['LeadStatus']['id'];
                                                               ?>
                                                               <tr>
                                                                  <td align="left" valign="right" class="tablebody"><?php echo $i; ?></td>
                                                                  <td align="left" valign="left" class="tablebody"><?php echo $lead_status['LeadStatus']['status']; ?></td>
                           
                                                                   <td align="center" valign="middle">
                                                                   <?php
                                                                      echo $this->Html->link('Edit', '/look_ups/edit_lead_status/' . $id, array('class' => 'btn btn-success sticky_success open-popup-link'));
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
                                                      echo $this->Html->link('Add', '/look_ups/add_lead_status/', array('class' => 'btn btn-success sticky_success open-popup-link'));
                                                      ?>
															</div>
														</div>
													</div>
                                                    <div class="panel panel-success">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseTwentyfour">
																	Lookup For Lead Type
																</a>
															</h4>
														</div>
														<div id="acc2_collapseTwentyfour" class="panel-collapse collapse">
															<div class="panel-body">
																 <table class="table">
                                                       <tr>
                                                            <th width="10%">ID</th>
                                                             <th width="70%">Value</th>
            
                                                           <th width="13%">Action</th>
                                                       </tr>
                                                       <?php
                                                             
                                                            $i = 1;
                                                       if (isset($lookup_value_leads_types) && count($lookup_value_leads_types) > 0):
                                                           foreach ($lookup_value_leads_types as $lookup_value_leads_type):
                                                               $id = $lookup_value_leads_type['LookupValueLeadsType']['id'];
                                                               ?>
                                                               <tr>
                                                                  <td align="left" valign="right" class="tablebody"><?php echo $i; ?></td>
                                                                  <td align="left" valign="left" class="tablebody"><?php echo $lookup_value_leads_type['LookupValueLeadsType']['value']; ?></td>
                           
                                                                   <td align="center" valign="middle">
                                                                   <?php
                                                                      echo $this->Html->link('Edit', '/look_ups/edit_lead_type/' . $id, array('class' => 'btn btn-success sticky_success open-popup-link'));
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
                                                      echo $this->Html->link('Add', '/look_ups/add_lead_type/', array('class' => 'btn btn-success sticky_success open-popup-link'));
                                                      ?>
															</div>
														</div>
													</div>
                                                    <div class="panel panel-success">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseTwentyfive">
																	Lookup For Lead Urgency
																</a>
															</h4>
														</div>
														<div id="acc2_collapseTwentyfive" class="panel-collapse collapse">
															<div class="panel-body">
																 <table class="table">
                                                       <tr>
                                                            <th width="10%">ID</th>
                                                             <th width="70%">Value</th>
            
                                                           <th width="13%">Action</th>
                                                       </tr>
                                                       <?php
                                                             
                                                            $i = 1;
                                                       if (isset($lookup_value_leads_urgencies) && count($lookup_value_leads_urgencies) > 0):
                                                           foreach ($lookup_value_leads_urgencies as $lookup_value_leads_urgency):
                                                               $id = $lookup_value_leads_urgency['LookupValueLeadsUrgency']['id'];
                                                               ?>
                                                               <tr>
                                                                  <td align="left" valign="right" class="tablebody"><?php echo $i; ?></td>
                                                                  <td align="left" valign="left" class="tablebody"><?php echo $lookup_value_leads_urgency['LookupValueLeadsUrgency']['value']; ?></td>
                           
                                                                   <td align="center" valign="middle">
                                                                   <?php
                                                                      echo $this->Html->link('Edit', '/look_ups/edit_lead_urgency/' . $id, array('class' => 'btn btn-success sticky_success open-popup-link'));
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
                                                       echo $this->Html->link('Add', '/look_ups/add_lead_urgency/', array('class' => 'btn btn-success sticky_success open-popup-link'));
                                                      ?>
															</div>
														</div>
													</div>
                                                    <div class="panel panel-success">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseTwentysix">
																	Lookup For Rating Translation
																</a>
															</h4>
														</div>
														<div id="acc2_collapseTwentysix" class="panel-collapse collapse">
															<div class="panel-body">
																 <table class="table">
                                                       <tr>
                                                            <th width="10%">ID</th>
                                                             <th width="70%">Value</th>
            
                                                           <th width="13%">Action</th>
                                                       </tr>
                                                      <?php
                                                             
                                                            $i = 1;
                                                       if (isset($lookup_value_rating_translations) && count($lookup_value_rating_translations) > 0):
                                                           foreach ($lookup_value_rating_translations as $lookup_value_rating_translation):
                                                               $id = $lookup_value_rating_translation['LookupValueRatingTranslation']['id'];
                                                               ?>
                                                               <tr>
                                                                  <td align="left" valign="right" class="tablebody"><?php echo $i; ?></td>
                                                                  <td align="left" valign="left" class="tablebody"><?php echo $lookup_value_rating_translation['LookupValueRatingTranslation']['value']; ?></td>
                           
                                                                   <td align="center" valign="middle">
                                                                   <?php
                                                                      echo $this->Html->link('Edit', '/look_ups/edit_rating_translation/' . $id, array('class' => 'btn btn-success sticky_success open-popup-link'));
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
                                                      echo $this->Html->link('Add', '/look_ups/add_rating_translation/', array('class' => 'btn btn-success sticky_success open-popup-link'));
                                                      ?>
															</div>
														</div>
													</div>
                                                    <div class="panel panel-success">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseTwnetyseven">
																	Lookup For Remarks Level
																</a>
															</h4>
														</div>
														<div id="acc2_collapseTwnetyseven" class="panel-collapse collapse">
															<div class="panel-body">
																 <table class="table">
                                                       <tr>
                                                            <th width="10%">ID</th>
                                                             <th width="70%">Value</th>
            
                                                           <th width="13%">Action</th>
                                                       </tr>
                                                      <?php
                                                             
                                                            $i = 1;
                                                       if (isset($lookup_value_remarks_levels) && count($lookup_value_remarks_levels) > 0):
                                                           foreach ($lookup_value_remarks_levels as $lookup_value_remarks_level):
                                                               $id = $lookup_value_remarks_level['LookupValueRemarksLevel']['id'];
                                                               ?>
                                                               <tr>
                                                                  <td align="left" valign="right" class="tablebody"><?php echo $i; ?></td>
                                                                  <td align="left" valign="left" class="tablebody"><?php echo $lookup_value_remarks_level['LookupValueRemarksLevel']['value']; ?></td>
                           
                                                                   <td align="center" valign="middle">
                                                                   <?php
                                                                      echo $this->Html->link('Edit', '/look_ups/edit_remarks_level/' . $id, array('class' => 'btn btn-success sticky_success open-popup-link'));
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
                                                      echo $this->Html->link('Add', '/look_ups/add_remarks_level/', array('class' => 'btn btn-success sticky_success open-popup-link'));
                                                      ?>
															</div>
														</div>
													</div>
                                                    <div class="panel panel-success">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseTwentyeight">
																	Lookup For Satus
																</a>
															</h4>
														</div>
														<div id="acc2_collapseTwentyeight" class="panel-collapse collapse">
															<div class="panel-body">
																 <table class="table">
                                                       <tr>
                                                            <th width="10%">ID</th>
                                                             <th width="70%">Value</th>
            
                                                           <th width="13%">Action</th>
                                                       </tr>
                                                       <?php
                                                             
                                                            $i = 1;
                                                       if (isset($lookup_value_statuses) && count($lookup_value_statuses) > 0):
                                                           foreach ($lookup_value_statuses as $lookup_value_status):
                                                               $id = $lookup_value_status['LookupValueStatus']['id'];
                                                               ?>
                                                               <tr>
                                                                  <td align="left" valign="right" class="tablebody"><?php echo $i; ?></td>
                                                                  <td align="left" valign="left" class="tablebody"><?php echo $lookup_value_status['LookupValueStatus']['value']; ?></td>
                           
                                                                   <td align="center" valign="middle">
                                                                   <?php
                                                                      echo $this->Html->link('Edit', '/look_ups/edit_status/' . $id, array('class' => 'btn btn-success sticky_success open-popup-link'));
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
                                                     echo $this->Html->link('Add', '/look_ups/add_status/', array('class' => 'btn btn-success sticky_success open-popup-link'));
                                                      ?>
															</div>
														</div>
													</div>
                                                    <div class="panel panel-success">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseTwentynine">
																	Lookup For Channel Roles
																</a>
															</h4>
														</div>
														<div id="acc2_collapseTwentynine" class="panel-collapse collapse">
															<div class="panel-body">
																 <table class="table">
                                                       <tr>
                                                            <th width="10%">ID</th>
                                                             <th width="70%">Value</th>
            
                                                           <th width="13%">Action</th>
                                                       </tr>
                                                      <?php
                                                             
                                                            $i = 1;
                                                       if (isset($lookup_value_channel_roles) && count($lookup_value_channel_roles) > 0):
                                                           foreach ($lookup_value_channel_roles as $lookup_value_channel_role):
                                                               $id = $lookup_value_channel_role['LookupValueChannelRole']['id'];
                                                               ?>
                                                               <tr>
                                                                  <td align="left" valign="right" class="tablebody"><?php echo $i; ?></td>
                                                                  <td align="left" valign="left" class="tablebody"><?php echo $lookup_value_channel_role['LookupValueChannelRole']['value']; ?></td>
                           
                                                                   <td align="center" valign="middle">
                                                                   <?php
                                                                      echo $this->Html->link('Edit', '/look_ups/edit_channel_role/' . $id, array('class' => 'btn btn-success sticky_success open-popup-link'));
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
                                                      echo $this->Html->link('Add', '/look_ups/add_channnel_role/', array('class' => 'btn btn-success sticky_success open-popup-link'));
                                                      ?>
															</div>
														</div>
													</div>
                                                    <div class="panel panel-success">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseThirty">
																	Lookup For Channel Status
																</a>
															</h4>
														</div>
														<div id="acc2_collapseThirty" class="panel-collapse collapse">
															<div class="panel-body">
																 <table class="table">
                                                       <tr>
                                                            <th width="10%">ID</th>
                                                             <th width="70%">Value</th>
            
                                                           <th width="13%">Action</th>
                                                       </tr>
                                                       <?php
                                                             
                                                            $i = 1;
                                                       if (isset($lookup_value_channel_statuses) && count($lookup_value_channel_statuses) > 0):
                                                           foreach ($lookup_value_channel_statuses as $lookup_value_channel_status):
                                                               $id = $lookup_value_channel_status['LookupValueChannelStatus']['id'];
                                                               ?>
                                                               <tr>
                                                                  <td align="left" valign="right" class="tablebody"><?php echo $i; ?></td>
                                                                  <td align="left" valign="left" class="tablebody"><?php echo $lookup_value_channel_status['LookupValueChannelStatus']['value']; ?></td>
                           
                                                                   <td align="center" valign="middle">
                                                                   <?php
                                                                      echo $this->Html->link('Edit', '/look_ups/edit_channel_status/' . $id, array('class' => 'btn btn-success sticky_success open-popup-link'));
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
                                                      echo $this->Html->link('Add', '/look_ups/add_channnel_status/', array('class' => 'btn btn-success sticky_success open-popup-link'));
                                                      ?>
															</div>
														</div>
													</div>
                                                    <div class="panel panel-success">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseThirtyone">
																	Lookup For General Status
																</a>
															</h4>
														</div>
														<div id="acc2_collapseThirtyone" class="panel-collapse collapse">
															<div class="panel-body">
																 <table class="table">
                                                       <tr>
                                                            <th width="10%">ID</th>
                                                             <th width="70%">Value</th>
            
                                                           <th width="13%">Action</th>
                                                       </tr>
                                                       <?php
                                                             
                                                            $i = 1;
                                                       if (isset($lookup_value_general_statuses) && count($lookup_value_general_statuses) > 0):
                                                           foreach ($lookup_value_general_statuses as $lookup_value_general_status):
                                                               $id = $lookup_value_general_status['LookupValueGeneralStatus']['id'];
                                                               ?>
                                                               <tr>
                                                                  <td align="left" valign="right" class="tablebody"><?php echo $i; ?></td>
                                                                  <td align="left" valign="left" class="tablebody"><?php echo $lookup_value_general_status['LookupValueGeneralStatus']['value']; ?></td>
                           
                                                                   <td align="center" valign="middle">
                                                                   <?php
                                                                      echo $this->Html->link('Edit', '/look_ups/edit_general_status/' . $id, array('class' => 'btn btn-success sticky_success open-popup-link'));
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
                                                      echo $this->Html->link('Add', '/look_ups/add_general_status/', array('class' => 'btn btn-success sticky_success open-popup-link'));
                                                      ?>
															</div>
														</div>
													</div>
                                                    <div class="panel panel-success">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseThirtytwo">
																	Lookup For Amenities Type
																</a>
															</h4>
														</div>
														<div id="acc2_collapseThirtytwo" class="panel-collapse collapse">
															<div class="panel-body">
																 <table class="table">
                                                       <tr>
                                                            <th width="10%">ID</th>
                                                             <th width="70%">Value</th>
            
                                                           <th width="13%">Action</th>
                                                       </tr>
                                                       <?php
                                                             
                                                            $i = 1;
                                                         
                                                       if (isset($groups) && count($groups) > 0):
                                                           foreach ($groups as $group):
                                                               $id = $group['Group']['id'];
                                                               ?>
                                                               <tr>
                                                                  <td align="left" valign="right" class="tablebody"><?php echo $i; ?></td>
                                                                  <td align="left" valign="left" class="tablebody"><?php echo $group['Group']['group_name']; ?></td>
                           
                                                                   <td align="center" valign="middle">
                                                                   <?php
                                                                      echo $this->Html->link('Edit', '/look_ups/edit_amenities_group/' . $id, array('class' => 'btn btn-success sticky_success open-popup-link'));
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
                                                      echo $this->Html->link('Add', '/look_ups/add_amenities_group/', array('class' => 'btn btn-success sticky_success open-popup-link'));
                                                      ?>
															</div>
														</div>
													</div>
                                                    <div class="panel panel-success">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseThirtythree">
																	Lookup For Amenities
																</a>
															</h4>
														</div>
														<div id="acc2_collapseThirtythree" class="panel-collapse collapse">
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
                                                               $id = $amenities[$key]['LookupValueAmenitie']['group_id'];
                                                               ?>
                                                               <tr>
                                                                  <td align="left" valign="right" class="tablebody"><?php echo $i; ?></td>
                                                                  <td align="left" valign="right" class="tablebody"><?php echo $amenities[$key]['Group']['group_name']; ?></td>
                                                                  <td align="left" valign="left" class="tablebody"><?php echo $amenities[$key][0]['amenity_name']; ?></td>
                           
                                                                   <td align="center" valign="middle">
                                                                   <?php
                                                                      echo $this->Html->link('Edit', '/look_ups/edit_amenities/' . $id, array('class' => 'btn btn-success sticky_success open-popup-link'));
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
                                                      echo $this->Html->link('Add', '/look_ups/add_amenities/', array('class' => 'btn btn-success sticky_success open-popup-link'));
                                                      ?>
															</div>
														</div>
													</div>
                                                    <div class="panel panel-success">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseThirtyfour">
																	Lookup For Dummy Status
																</a>
															</h4>
														</div>
														<div id="acc2_collapseThirtyfour" class="panel-collapse collapse">
															<div class="panel-body">
																 <table class="table">
                                                       <tr>
                                                            <th width="10%">ID</th>
                                                             <th width="70%">Value</th>
            
                                                           <th width="13%">Action</th>
                                                       </tr>
                                                       <?php
                                                             
                                                            $i = 1;
                                                       if (isset($lookup_value_dummy_statuses) && count($lookup_value_dummy_statuses) > 0):
                                                           foreach ($lookup_value_dummy_statuses as $lookup_value_dummy_status):
                                                               $id = $lookup_value_dummy_status['LookupValueDummyStatus']['id'];
                                                               ?>
                                                               <tr>
                                                                  <td align="left" valign="right" class="tablebody"><?php echo $i; ?></td>
                                                                  <td align="left" valign="left" class="tablebody"><?php echo $lookup_value_dummy_status['LookupValueDummyStatus']['value']; ?></td>
                           
                                                                  
                                                               </tr>
                                                           
                                                               <?php
                                                               $i++;
                                                           endforeach;
                                                       endif;
                                                       ?>
                                                   </table>
															</div>
														</div>
													</div>
                                                    <div class="panel panel-success">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseThirtyfive">
																	Lookup For Builder Contact Initiated By
																</a>
															</h4>
														</div>
														<div id="acc2_collapseThirtyfive" class="panel-collapse collapse">
															<div class="panel-body">
																 <table class="table">
                                                       <tr>
                                                            <th width="10%">ID</th>
                                                             <th width="70%">Value</th>
            
                                                           <th width="13%">Action</th>
                                                       </tr>
                                                       <?php
                                                             
                                                            $i = 1;
                                                       if (isset($LookupBuilderContactInitiatedBy) && count($LookupBuilderContactInitiatedBy) > 0):
                                                           foreach ($LookupBuilderContactInitiatedBy as $lookup_value):
                                                               $id = $lookup_value['LookupBuilderContactInitiatedBy']['id'];
                                                               ?>
                                                               <tr>
                                                                  <td align="left" valign="right" class="tablebody"><?php echo $i; ?></td>
                                                                  <td align="left" valign="left" class="tablebody"><?php echo $lookup_value['LookupBuilderContactInitiatedBy']['value']; ?></td>
                                                                  <td align="center" valign="middle">
                                                                   <?php
                                                                      echo $this->Html->link('Edit', '/look_ups/edit_builder_contact_initiated_by/' . $id, array('class' => 'btn btn-success sticky_success open-popup-link'));
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
                                                     echo $this->Html->link('Add', '/look_ups/add_builder_contact_initiated_by/', array('class' => 'btn btn-success sticky_success open-popup-link'));                                                     
                                                      ?>
															</div>
														</div>
													</div>
                                                    <div class="panel panel-success">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseThirtysix">
																	Lookup For Builder Contact Managed By
																</a>
															</h4>
														</div>
														<div id="acc2_collapseThirtysix" class="panel-collapse collapse">
															<div class="panel-body">
																 <table class="table">
                                                       <tr>
                                                            <th width="10%">ID</th>
                                                             <th width="70%">Value</th>
            
                                                           <th width="13%">Action</th>
                                                       </tr>
                                                       <?php
                                                             
                                                            $i = 1;
                                                       if (isset($LookupBuilderContactManagedBy) && count($LookupBuilderContactManagedBy) > 0):
                                                           foreach ($LookupBuilderContactManagedBy as $lookup_value):
                                                               $id = $lookup_value['LookupBuilderContactManagedBy']['id'];
                                                               ?>
                                                               <tr>
                                                                  <td align="left" valign="right" class="tablebody"><?php echo $i; ?></td>
                                                                  <td align="left" valign="left" class="tablebody"><?php echo $lookup_value['LookupBuilderContactManagedBy']['value']; ?></td>
                                                                  <td align="center" valign="middle">
                                                                   <?php
                                                                      echo $this->Html->link('Edit', '/look_ups/edit_builder_contact_managed_by/' . $id, array('class' => 'btn btn-success sticky_success open-popup-link'));
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
                                                     echo $this->Html->link('Add', '/look_ups/add_builder_contact_managed_by/', array('class' => 'btn btn-success sticky_success open-popup-link'));                                                     
                                                      ?>
															</div>
														</div>
													</div>
                                                    <div class="panel panel-success">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseThirtyseven">
																	Lookup For Builder Contact Level
																</a>
															</h4>
														</div>
														<div id="acc2_collapseThirtyseven" class="panel-collapse collapse">
															<div class="panel-body">
																 <table class="table">
                                                       <tr>
                                                            <th width="10%">ID</th>
                                                             <th width="70%">Value</th>
            
                                                           <th width="13%">Action</th>
                                                       </tr>
                                                       <?php
                                                             
                                                            $i = 1;
                                                       if (isset($LookupBuilderContactLevel) && count($LookupBuilderContactLevel) > 0):
                                                           foreach ($LookupBuilderContactLevel as $lookup_value):
                                                               $id = $lookup_value['LookupBuilderContactLevel']['id'];
                                                               ?>
                                                               <tr>
                                                                  <td align="left" valign="right" class="tablebody"><?php echo $i; ?></td>
                                                                  <td align="left" valign="left" class="tablebody"><?php echo $lookup_value['LookupBuilderContactLevel']['value']; ?></td>
                                                                  <td align="center" valign="middle">
                                                                   <?php
                                                                      echo $this->Html->link('Edit', '/look_ups/edit_builder_contact_level/' . $id, array('class' => 'btn btn-success sticky_success open-popup-link'));
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
                                                     echo $this->Html->link('Add', '/look_ups/add_builder_contact_level/', array('class' => 'btn btn-success sticky_success open-popup-link'));                                                     
                                                      ?>
															</div>
														</div>
													</div>
                                                    <div class="panel panel-success">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseThityeight">
																	Lookup For Marketing Industry
																</a>
															</h4>
														</div>
														<div id="acc2_collapseThityeight" class="panel-collapse collapse">
															<div class="panel-body">
																 <table class="table">
                                                       <tr>
                                                            <th width="10%">ID</th>
                                                             <th width="70%">Value</th>
            
                                                           <th width="13%">Action</th>
                                                       </tr>
                                                       <?php
                                                             
                                                            $i = 1;
                                                       if (isset($LookupMarketingIndustry) && count($LookupMarketingIndustry) > 0):
                                                           foreach ($LookupMarketingIndustry as $lookup_value):
                                                               $id = $lookup_value['LookupMarketingIndustry']['id'];
                                                               ?>
                                                               <tr>
                                                                  <td align="left" valign="right" class="tablebody"><?php echo $i; ?></td>
                                                                  <td align="left" valign="left" class="tablebody"><?php echo $lookup_value['LookupMarketingIndustry']['value']; ?></td>
                                                                  <td align="center" valign="middle">
                                                                   <?php
                                                                      echo $this->Html->link('Edit', '/look_ups/edit_builder_contact_level/' . $id, array('class' => 'btn btn-success sticky_success open-popup-link'));
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
                                                     echo $this->Html->link('Add', '/look_ups/add_builder_contact_level/', array('class' => 'btn btn-success sticky_success open-popup-link'));                                                     
                                                      ?>
															</div>
														</div>
													</div>
                                                    <div class="panel panel-success">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseThirtynine">
																	Lookup For Marketing Location
																</a>
															</h4>
														</div>
														<div id="acc2_collapseThirtynine" class="panel-collapse collapse">
															<div class="panel-body">
																 <table class="table">
                                                       <tr>
                                                            <th width="10%">ID</th>
                                                             <th width="70%">Value</th>
            
                                                           <th width="13%">Action</th>
                                                       </tr>
                                                      <?php
                                                             
                                                            $i = 1;
                                                       if (isset($LookupMarketingLocation) && count($LookupMarketingLocation) > 0):
                                                           foreach ($LookupMarketingLocation as $lookup_value):
                                                               $id = $lookup_value['LookupMarketingLocation']['id'];
                                                               ?>
                                                               <tr>
                                                                  <td align="left" valign="right" class="tablebody"><?php echo $i; ?></td>
                                                                  <td align="left" valign="left" class="tablebody"><?php echo $lookup_value['LookupMarketingLocation']['value']; ?></td>
                                                                  <td align="center" valign="middle">
                                                                   <?php
                                                                      echo $this->Html->link('Edit', '/look_ups/edit_builder_contact_level/' . $id, array('class' => 'btn btn-success sticky_success open-popup-link'));
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
                                                     echo $this->Html->link('Add', '/look_ups/add_builder_contact_level/', array('class' => 'btn btn-success sticky_success open-popup-link'));                                                     
                                                      ?>
															</div>
														</div>
													</div>
                                                    <div class="panel panel-success">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseForty">
																	Lookup For Marketing Resource Type
																</a>
															</h4>
														</div>
														<div id="acc2_collapseForty" class="panel-collapse collapse">
															<div class="panel-body">
																 <table class="table">
                                                       <tr>
                                                            <th width="10%">ID</th>
                                                             <th width="70%">Value</th>
            
                                                           <th width="13%">Action</th>
                                                       </tr>
                                                        <?php
                                                             
                                                            $i = 1;
                                                       if (isset($LookupMarketingSiteResourceType) && count($LookupMarketingSiteResourceType) > 0):
                                                           foreach ($LookupMarketingSiteResourceType as $lookup_value):
                                                               $id = $lookup_value['LookupMarketingSiteResourceType']['id'];
                                                               ?>
                                                               <tr>
                                                                  <td align="left" valign="right" class="tablebody"><?php echo $i; ?></td>
                                                                  <td align="left" valign="left" class="tablebody"><?php echo $lookup_value['LookupMarketingSiteResourceType']['value']; ?></td>
                                                                  <td align="center" valign="middle">
                                                                   <?php
                                                                      echo $this->Html->link('Edit', '/look_ups/edit_builder_contact_level/' . $id, array('class' => 'btn btn-success sticky_success open-popup-link'));
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
                                                     echo $this->Html->link('Add', '/look_ups/add_builder_contact_level/', array('class' => 'btn btn-success sticky_success open-popup-link'));                                                     
                                                      ?>
															</div>
														</div>
													</div>
                                                    <div class="panel panel-success">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseFortyone">
																	Lookup For Marketing Vertical
																</a>
															</h4>
														</div>
														<div id="acc2_collapseFortyone" class="panel-collapse collapse">
															<div class="panel-body">
																 <table class="table">
                                                       <tr>
                                                            <th width="10%">ID</th>
                                                             <th width="70%">Value</th>
            
                                                           <th width="13%">Action</th>
                                                       </tr>
                                                      <?php
                                                             
                                                            $i = 1;
                                                       if (isset($LookupMarketingVertical) && count($LookupMarketingVertical) > 0):
                                                           foreach ($LookupMarketingVertical as $lookup_value):
                                                               $id = $lookup_value['LookupMarketingVertical']['id'];
                                                               ?>
                                                               <tr>
                                                                  <td align="left" valign="right" class="tablebody"><?php echo $i; ?></td>
                                                                  <td align="left" valign="left" class="tablebody"><?php echo $lookup_value['LookupMarketingVertical']['value']; ?></td>
                                                                  <td align="center" valign="middle">
                                                                   <?php
                                                                      echo $this->Html->link('Edit', '/look_ups/edit_builder_contact_level/' . $id, array('class' => 'btn btn-success sticky_success open-popup-link'));
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
                                                     echo $this->Html->link('Add', '/look_ups/add_builder_contact_level/', array('class' => 'btn btn-success sticky_success open-popup-link'));                                                     
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


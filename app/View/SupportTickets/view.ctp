<?php
//echo $this->Form->create('Remark', array('enctype' => 'multipart/form-data'));
echo $this->Form->create('SupportTicket', array('method' => 'post', 'enctype' => 'multipart/form-data', 'id' => 'parsley_reg', 'novalidate' => true,
    'inputDefaults' => array(
        'label' => false,
        'div' => false,
        'class' => 'form-control',
    ),
        //array('controller' => 'reimbursements', 'action' => 'add')
));
?>
<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">          
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="group blue">
                        
                            <div class="form-group">
                                <label for="reg_input_name">Ticket #</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <?php
                                    echo $this->data['SupportTicket']['id'];
                                   
                                    if($this->data['SupportTicket']['status'] == '1' && ($this->data['SupportTicket']['next_action_by'] == $self_id)){
                                        echo $this->Html->link('[Respond]', '/support_tickets/response/'.$this->data['SupportTicket']['id'], array('class' => 'act-ico open-popup-link add-btn', 'escape' => false, 'data-placement' => "left", 'title' => "Action", 'data-toggle' => "tooltip"));
                                    //if($this->data['SupportTicket']['status'] == '1')
                                        //echo $this->Html->link('[Respond]', '/support_tickets/response/'.$this->data['SupportTicket']['id'], array('class' => 'act-ico open-popup-link add-btn', 'escape' => false, 'data-placement' => "left", 'title' => "Action", 'data-toggle' => "tooltip"));
                                    }
                                    elseif($this->data['SupportTicket']['status'] == '2' && ($this->data['SupportTicket']['next_action_by'] == $self_id))
                                        echo $this->Html->link('[Close]','/support_tickets/close/'.$this->data['SupportTicket']['id'], array('class' => 'act-ico', 'escape' => false), "Are you sure you wish to close this ticket?");
                                    
                                    ?></div>
                            </div>
                            <div class="form-group">
                                <label for="reg_input_name">Created on</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <?php
                                    echo $this->data['SupportTicket']['created'].' -> '.$this->data['SupportTicket']['ip_address'];
                                    ?></div>
                            </div>
                        <div class="form-group">
                                <label for="reg_input_name">Created by</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <?php
                                    echo ($this->data['SupportTicket']['created_by']) ? $this->Custom->Username($this->data['SupportTicket']['created_by']) : '';
                                    ?></div>
                            </div>
                        <div class="form-group">
                                <label for="reg_input_name">Last update</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <?php
                                    echo $this->data['SupportTicket']['modified'];
                                    ?></div>
                            </div>
                            <div class="form-group">
                                <label for="reg_input_name">Last updated by</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <?php
                                    echo ($this->data['SupportTicket']['created_by']) ? $this->Custom->Username($this->data['SupportTicket']['created_by']) : '';
                                    ?></div>
                            </div>
                        
                            <div class="form-group">
                                <label for="reg_input_name">Next action by</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <?php
                                    echo ($this->data['SupportTicket']['next_action_by']) ? $this->Custom->Username($this->data['SupportTicket']['next_action_by']) : '';
                                    ?></div>
                            </div>
                        <div class="form-group">
                                <label for="reg_input_name">Department</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <?php echo $this->data['LookupDepartment']['name']; ?>
                                </div>
                            </div>
                        <div class="form-group">
                            <label>Type</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php echo $this->data['LookupTicketType']['value']; ?>            
                            </div>            
                        </div> 
                            <div class="form-group">
                                <label for="reg_input_name">Urgency</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <?php
                                    echo $this->data['LookupTicketUrgency']['value'];
                                    ?></div>
                            </div>
                        <div class="form-group">
                        <label>Raised from Screen</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php echo $this->data['LookupScreen']['value']; ?>

                        </div>
                    </div>
                            <div class="form-group">
                                <label for="reg_input_name">Raised About</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <?php
                                    $id =   $this->Custom->after_last(' ',$this->data['SupportTicket']['about']);
                                     //$id =   end(explode(" | ", $this->data['SupportTicket']['about']));
                                     $about_link = '';
                                     if($this->data['SupportTicket']['screen'] == '1')
                                        $about_link = $this->Html->link($this->data['SupportTicket']['about'], array('controller' => 'reports', 'action' => 'support_hotel_summary/id:'.$id), array('class' => 'act-ico', 'escape' => false,'target' => '_blank'));
                                     elseif($this->data['SupportTicket']['screen'] == '4' || $this->data['SupportTicket']['screen'] == '10')
//                                         $about_link = $this->Html->link($this->data['SupportTicket']['about'], array('controller' => 'reports', 'action' => 'support_supplier_hotel_summary/id:'.$id.'/ticket_id:'.$this->data['SupportTicket']['id'].'/wtb_continent_id:'.$this->data['SupportTicket']['continent_id'].'/wtb_country_id:'.$this->data['SupportTicket']['country_id'].'/wtb_province_id:'.$this->data['SupportTicket']['province_id'].'/wtb_city_id:'.$this->data['SupportTicket']['city_id'].'/supplier_id:'.$this->data['SupportTicket']['supplier_id'].'/supplier_country_id:'.$this->data['SupportTicket']['supplier_country_id'].'/supplier_city_id:'.$this->data['SupportTicket']['supplier_city_id'].'/supplier_hotel_id:'.$this->data['SupportTicket']['supplier_hotel_id']), array('class' => 'act-ico', 'escape' => false,'target' => '_blank'));
                                         $about_link = $this->Html->link($this->data['SupportTicket']['about'], array('controller' => 'reports', 'action' => 'support_supplier_hotel_summary/'.$id.'/'.$this->data['SupportTicket']['id'].'/'.$this->data['SupportTicket']['continent_id'].'/'.$this->data['SupportTicket']['country_id'].'/'.$this->data['SupportTicket']['province_id'].'/'.$this->data['SupportTicket']['city_id'].'/'.$this->data['SupportTicket']['supplier_id'].'/'.$this->data['SupportTicket']['supplier_country_id'].'/'.$this->data['SupportTicket']['supplier_city_id'].'/'.$this->data['SupportTicket']['supplier_hotel_id']), array('class' => 'act-ico', 'escape' => false,'target' => '_blank'));                                     
                                     elseif($this->data['SupportTicket']['screen'] == '5')
                                         $about_link = $this->Html->link($this->data['SupportTicket']['about'], array('controller' => 'admin', 'action' => 'country_add/'.$id), array('class' => 'act-ico', 'escape' => false,'target' => '_blank'));
                                     elseif($this->data['SupportTicket']['screen'] == '6')
                                         $about_link = $this->Html->link($this->data['SupportTicket']['about'], array('controller' => 'admin', 'action' => 'city_add/'.$id), array('class' => 'act-ico', 'escape' => false,'target' => '_blank'));
                                   echo $about_link;
                                    ?></div>
                            </div>
                        
                        
                          
                        </div>
                  <?php if(isset($this->data['SupportTicket']['response'])){?>  
                    <div class="group grey">
                        <div class="form-group">
                                <label for="reg_input_name">Date</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <?php
                                     echo $this->data['SupportTicket']['modified'];
                                    ?></div>
                            </div>
                    <div class="form-group">
                                <label for="reg_input_name">Name</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <?php
                                      echo ($this->data['SupportTicket']['next_action_by']) ? $this->Custom->Username($this->data['SupportTicket']['next_action_by']) : '';
                                    ?>
                                </div>
                                </div>
                            <div class="form-group">
                                <label for="reg_input_name">About</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <?php
                                      echo $this->data['SupportTicket']['about'];
                                    ?>
                                </div>
                                </div>
                        <h4>Response</h4>
                        <div class="form-group">
                            <label>Issue</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                    <?php echo $this->data['LookupResponseIssue']['value']; ?>            
                            </div>            
                        </div>
                        <div class="form-group">
                            <label>Issue Level Assessment</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                    <?php echo $this->data['SupportTicket']['response_level_assessment']; ?>            
                            </div>            
                        </div>
                        <div class="form-group">
                            <label>Solution</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                    <?php echo $this->data['Response']['value']; ?>            
                            </div>            
                        </div>
                        <div class="form-group">
                            <label>Answer</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                    <?php 
                                    if ($this->data['Response']['id'] == '28') {
                                        $wtb_hotel_id = $this->data['SupportTicket']['response1'];
                                        $solution_link = $this->Html->link('Mapped with WTB Hotel Id -> '.$this->data['SupportTicket']['response1'], array('controller' => 'reports', 'action' => 'support_hotel_summary/id:'.$wtb_hotel_id), array('class' => 'act-ico', 'escape' => false,'target' => '_blank'));
                                        echo $solution_link;                                        
                                    } elseif  ($this->data['Response']['id'] == '29') {
                                        if ($this->data['SupportTicket']['answer'] == '52') {
                                            $supplier_hotel_id = $this->data['SupportTicket']['response2'];
                                            $solution_link = $this->Html->link('Marked as Duplicate of Existing Supplier Hotel Id -> '.$this->data['SupportTicket']['response2'], array('controller' => 'reports', 'action' => 'support_supplier_hotel_summary/id:'.$supplier_hotel_id), array('class' => 'act-ico', 'escape' => false,'target' => '_blank'));
                                            echo $solution_link;                                                                                     
                                        } elseif ($this->data['SupportTicket']['answer'] == '56') {
                                            $supplier_hotel_id = $this->data['SupportTicket']['response1'];
                                            $solution_link = $this->Html->link('Marked as Duplicate of Existing Supplier Hotel Id -> '.$this->data['SupportTicket']['response1'], array('controller' => 'reports', 'action' => 'support_supplier_hotel_summary/id:'.$supplier_hotel_id), array('class' => 'act-ico', 'escape' => false,'target' => '_blank'));
                                            echo $solution_link;                                                                                     
                                        }

                                    } else {
                                        echo $this->data['SupportTicket']['response1'];
                                        echo ($this->data['SupportTicket']['response2']) ? ' ->'.$this->data['SupportTicket']['response2'] : '';
                                    }            
                                    ?>            
                            </div>            
                        </div>
                        <div class="form-group" >
                            <label>Comments</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                    <?php echo nl2br($this->data['SupportTicket']['response_comment']) ."<br>".'...'; ?>    

                            </div>            
                        </div>
                        <div class="form-group">
                        <label>Attachments</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">

                            <?php if ($this->data['SupportTicket']['response_file'] <> '') { ?> 
                                <a href="<?php echo $this->webroot . 'uploads/SpportTicket/' . $this->data['SupportTicket']['response_file']; ?>" download>Click here to download...</a>
                            <?php }
                            else
                                echo 'No file';
                            ?>
                        </div>            
                    </div>
                    </div>    
                       <?php }?>
                     <div class="group pink">
                      <div class="form-group">
                                <label for="reg_input_name">Date</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <?php
                                     echo $this->data['SupportTicket']['created'];
                                    ?></div>
                            </div>
                    <div class="form-group">
                                <label for="reg_input_name">Name</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <?php
                                      echo $this->Custom->Username($this->data['SupportTicket']['created_by']);
                                    ?>
                                </div>
                                </div>
                            <div class="form-group">
                                <label for="reg_input_name">About</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <?php
                                      echo $this->data['SupportTicket']['about'];
                                    ?>
                                </div>
                                </div>
                            <h4>Request</h4>
                            <div class="form-group">
                                <label for="reg_input_name">The Issue</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                     <?php echo $this->data['Answer']['question']; ?>     
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="reg_input_name">Raised About</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <?php
                                      echo $about_link;
                                    ?></div>
                            </div>
                            <div class="form-group">
                                <label for="reg_input_name">Suggestion</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <?php 
                                    if($this->data['SupportTicket']['answer'] == '27'){
                                         $duplicate_id =   $this->Custom->after_last(' ',$this->data['SupportTicket']['answer1']);
                                        echo $this->Html->link($this->data['SupportTicket']['answer1'], array('controller' => 'reports', 'action' => 'support_hotel_summary/id:'.$duplicate_id), array('class' => 'act-ico', 'escape' => false,'target' => '_blank'));
                                    }
                                    else{
                                        echo $this->data['SupportTicket']['answer1'];
                                        echo ($this->data['SupportTicket']['answer2']) ? ' ->'.$this->data['SupportTicket']['answer2'] : '';
                                    }
                                     
                                   //echo ($this->data['SupportTicket']['response2']) ? ' ->'.$this->data['SupportTicket']['response2'] : '';     
                                    ///echo $this->data['SupportTicket']['answer1'].' -> '.$this->data['SupportTicket']['answer2']; ?>
                                </div>
                            </div>
                            
                            <div class="form-group">
                        <label>How many hotels here (approx)</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php echo $this->data['SupportTicket']['hotel_range']; ?>            
                        </div>            
                    </div>
                             <div class="form-group">
                        <label>Comments</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php echo $this->data['SupportTicket']['description']; ?>            
                        </div>            
                    </div>
                    <div class="form-group">
                        <label>Attachments</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">

                            <?php if ($this->data['SupportTicket']['file'] <> '') { ?> 
                                <a href="<?php echo $this->webroot . 'uploads/SpportTicket/' . $this->data['SupportTicket']['file']; ?>" download>Click here to download...</a>
                            <?php }
                            else
                                echo 'No file';
                            ?>
                        </div>            
                    </div>
                     </div>
                     

                
            </div>
        </div>
    </div>
</div>	
</div>
    <style type="text/css">
        .group{
            overflow: hidden;
            margin-bottom: 10px;
            padding: 15px;
        }
        .blue{
            background-color: rgb(211, 233, 237);
        }
        .grey{
             background-color: #F5F5F5;
        }
        .pink{
           background-color: #5DD9F8;
        }
        .form-group{
            margin-left: 30%;
        }
        h4 {
            font-weight: 600;
            text-align: center;
        }
        #mycl-det.col-sm-12 .form-group .col-sm-10 {
            top: 6px;

        }
        #mycl-det.col-sm-12 label {
            width: 226px !important;
        }
        #mycl-det.col-sm-12 label {
            line-height: 25px !important;
        }
        #parsley_reg .form-group {
            margin-bottom: 0 !important;
        }
        .panel-body {
        padding: 15px 15px 6px !important;
        }
     </style>
<?php
echo $this->Form->end();?>

<?php
$this->Html->addCrumb('My Deals', 'javascript:void(0);', array('class' => 'breadcrumblast'));
//echo $this->element('Deal/top_menu');
?>    
<div class="row">
    <div class="col-sm-12">
        <div class="table-heading">
            <h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php
                    echo $this->Paginator->counter(array('format' => '{:count}'));
                    ?></span> My Deals</h4>

            <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Deal', '/deals/add') ?></span>
            <span class="search_panel_icon"><i class="icon-plus" id="toggle_search_panel"></i></span>
        </div>
        <div class="panel panel-default">

            <div class="panel_controls hideform">

                <?php
                echo $this->Form->create('Deal', array('class' => 'quick_search', 'id' => 'SearchForm', 'novalidate' => true, 'inputDefaults' => array(
                        'label' => false,
                        'div' => false,
                        'class' => 'form-control',
                )));
                echo $this->Form->hidden('model_name', array('id' => 'model_name', 'value' => 'Deal'));
                ?> 
                <div class="row spe-row">
                    <div class="col-sm-4 col-xs-8">

                        <?php echo $this->Form->input('builder_name', array('value' => '', 'placeholder' => 'Type builder name', 'error' => array('class' => 'formerror'))); ?>
                    </div>
                    <div class="col-sm-3 col-xs-4">
                        <?php
                        echo $this->Form->submit('Deal Search', array('div' => false, 'class' => 'btn btn-default btn-sm"'));
                        ?>

                    </div>
                </div>
                <!--    <div class="row" id="search_panel_controls">
    
    
    
                        <div class="col-sm-3 col-xs-6">
                            <label for="un_member">City:</label>
                <?php echo $this->Form->input('builder_primarycity', array('options' => $city, 'empty' => '--Select--', 'value' => $Deal_primarycity)); ?>
                        </div>
    
                        <div class="col-sm-3 col-xs-6">
                            <label for="un_member">Residential:</label>
                <?php echo $this->Form->input('builder_residential', array('options' => array('1' => 'Yes', '2' => 'No'), 'empty' => '--Select--', 'value' => $Deal_residential)); ?>
                        </div>
                        <div class="col-sm-3 col-xs-6">
                            <label for="un_member">High end:</label>
                <?php echo $this->Form->input('builder_highendresidential', array('options' => array('1' => 'Yes', '2' => 'No'), 'empty' => '--Select--', 'value' => $Deal_highendresidential)); ?>
                        </div>
                        <div class="col-sm-3 col-xs-6">
                            <label for="un_member">Commercial:</label>
                <?php echo $this->Form->input('builder_commercial', array('options' => array('1' => 'Yes', '2' => 'No'), 'empty' => '--Select--', 'value' => $Deal_commercial)); ?>
                        </div>
    
    
                        <div class="col-sm-3 col-xs-6">
                            <label>&nbsp;</label>
                <?php
                echo $this->Form->submit('Filter', array('div' => false, 'class' => 'btn btn-default btn-sm"'));
                // echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'btn btn-default btn-sm"'));
                ?>
    
                        </div>
                    </div> -->
                <?php echo $this->Form->end(); ?>
            </div>

            <table border="0" cellpadding="0" cellspacing="0" id="resp_table" class="table toggle-square myclitb" data-filter="#table_search" data-page-size="100">
                <thead>
                    <tr>
                        <th data-toggle="true" width="10%">Transaction Type</th>
                        <th data-toggle="true" width="7%">Billing Type</th>
                        <th data-toggle="true" width="15%">Builder / Partner</th>
                        <th data-hide="phone" width="5%">Deal Status</th>
                        <th data-hide="phone" width="5%">Cost Currency</th>
                        <th data-hide="phone" width="15%">Project</th>
                        <th data-hide="phone" width="5%">Sale Pattern</th>
                        <th data-hide="phone" width="5%"  data-sort-ignore="true">Floor Number</th>
                        <th data-hide="phone" width="5%">Property Value</th>
                        <th data-hide="phone" width="13%">Client</th>
                        <th data-hide="phone"  data-sort-ignore="true">Booking Amount</th>
                        <th data-hide="phone" data-sort-ignore="true">Booking Date</th>
                        <th data-hide="phone" data-sort-ignore="true">Commission Event</th>
                        <th data-hide="phone" data-sort-ignore="true" width="5%">Action</th>        
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //  pr($Deals);
                    if (isset($Deals) && count($Deals) > 0):
                        foreach ($Deals as $Deal):
                            $id = $Deal['Deal']['id'];
                            if ($Deal['Deal']['deal_billing_type'] == '2')  // marketing partner
                                $sale_pattern = $Deal['DealPartner']['marketing_partner_display_name'];
                            elseif ($Deal['Deal']['deal_billing_type'] == '1') // builder
                                $sale_pattern = $Deal['DealBuilder']['builder_name'];
                            ?>
                            <tr>
                                <td class="tablebody"><?php echo $Deal['TransactionType']['value']; ?></td>
                                <td class="tablebody"><?php echo $Deal['BillingType']['value']; ?></td>
                                <td class="tablebody"><?php echo $sale_pattern; ?></td>
                                <td class="tablebody"><?php echo $Deal['DealStatus']['value']; ?></td>
                                <td class="tablebody"><?php echo $Deal['Deal']['deal_currency']; ?></td>
                                <td class="tablebody"><?php echo $Deal['DealProject']['project_name']; ?></td>
                                <td class="tablebody"><?php echo $Deal['Deal']['deal_sale_pattern']; ?></td>
                                <td class="tablebody"><?php echo $Deal['Deal']['deal_unit_floor']; ?></td> 
                                <td class="tablebody"><?php echo $Deal['Deal']['deal_invoiced_on_amount']; ?></td>
                                <td class="tablebody"><?php echo $Deal['DealClient']['lead_fname'] . ' ' . $Deal['DealClient']['lead_lname']; ?></td>
                                <td class="tablebody"><?php echo $Deal['Deal']['deal_booking_amount']; ?></td>
                                <td class="tablebody"><?php echo $Deal['Deal']['deal_booking_date']; ?></td>
                                <td class="tablebody"><?php echo $Deal['CommissionEvent']['value']; ?></td>
                                <td width="10%" valign="middle" align="center">

                                    <?php
                                    // echo $this->Html->link('<span class="icon-pencil"></span>', array('controller' => 'builders', 'action' => 'edit', 'slug' => $Deal['Deal']['builder_name'] . '-' . $Deal['City']['city_name'], 'id' => base64_encode($id)), array('class' => 'act-ico', 'escape' => false));
                                    // echo $this->Html->link('<span class="icon-eye-open"></span>', array('controller' => 'builders', 'action' => 'view', 'slug' => $Deal['Deal']['builder_name'] . '-' . $Deal['City']['city_name'], 'id' => base64_encode($id)), array('class' => 'act-ico', 'escape' => false));
                                    ?>
                                </td>

                            </tr>
    <?php endforeach; ?>

                        <?php
                        echo $this->element('paginate');
                    else:
                        echo '<tr><td colspan="13" class="norecords">No Records Found</td></tr>';

                    endif;
                    ?>
                </tbody>
            </table>
            <span class="badge badge-circle add-client"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Deal', '/deals/add') ?></span>

        </div>
    </div>
</div>


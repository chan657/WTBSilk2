<?php
$this->Html->addCrumb('My Partners', 'javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->element('MarketingPartners/top_menu');
?>    
<div class="row">
    <div class="col-sm-12">
        <div class="table-heading">
            <h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php
                    echo $this->Paginator->counter(array('format' => '{:count}'));
                    ?></span> My Partners</h4>

            <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Partner', '/marketing_partners/add') ?></span>
            <span class="search_panel_icon"><i class="icon-plus" id="toggle_search_panel"></i></span>
        </div>
        <div class="panel panel-default">

            <div class="panel_controls hideform">

                <?php
                echo $this->Form->create('MarketingPartner', array('controller' => 'builders', 'action' => 'index', 'class' => 'quick_search', 'id' => 'SearchForm', 'novalidate' => true, 'inputDefaults' => array(
                        'label' => false,
                        'div' => false,
                        'class' => 'form-control',
                )));
                echo $this->Form->hidden('model_name', array('id' => 'model_name', 'value' => 'Builder'));
                ?> 
                <div class="row spe-row">
                    <div class="col-sm-4 col-xs-8">

                        <?php echo $this->Form->input('marketing_partner_display_name', array('value' => $marketing_partner_display_name, 'placeholder' => 'Type partner name', 'error' => array('class' => 'formerror'))); ?>
                    </div>
                    <div class="col-sm-3 col-xs-4">
                        <?php
                        echo $this->Form->submit('Partner Search', array('div' => false, 'class' => 'btn btn-default btn-sm"'));
                        ?>

                    </div>
                </div>
                <div class="row" id="search_panel_controls">



                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">City:</label>
                        <?php echo $this->Form->input('marketing_partner_primarycity', array('options' => $city, 'empty' => '--Select--', 'value' => $marketing_partner_primarycity)); ?>
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

            <table id="resp_table" class="table toggle-square" data-filter="#table_search" data-page-size="100">
                <thead>
                   
                    <tr>
                        <th data-toggle="true" width="15%">Partner Name</th>
                        <th data-toggle="true" width="20%">Partner Legal Name</th>
                        <th data-toggle="true" width="7%">Approval Status</th>
                        <th data-hide="phone" width="8%">Primary City</th>
                        <th data-hide="phone" width="2%">Website</th>
                        <th data-hide="phone" width="12%">Board Number</th>
                        <th data-hide="phone" width="1%">Board Email</th>
                        <th data-hide="all" data-sort-ignore="true">Corporate Address</th>
                        <th data-hide="all" data-sort-ignore="true">Secondary Cities </th>
                        <th data-hide="all" data-sort-ignore="true">Summary of Activities</th>
                       
                        <th data-hide="phone" data-sort-ignore="true" width="3%">Action</th>        
                    </tr>
                </thead>
                <tbody>
<?php
$i = 1;
//	pr($builders);
$secondary_city = '';

if (isset($MarketingPartners) && count($MarketingPartners) > 0):
    foreach ($MarketingPartners as $MarketingPartner):
        $id = $MarketingPartner['MarketingPartner']['id'];
        if ($MarketingPartner['SecondaryCity']['city_name'])
            $secondary_city .= $MarketingPartner['SecondaryCity']['city_name'] . ',';
        if ($MarketingPartner['TertiaryCity']['city_name'])
            $secondary_city .= $MarketingPartner['TertiaryCity']['city_name'] . ',';
        if ($MarketingPartner['City4']['city_name'])
            $secondary_city .= $MarketingPartner['City4']['city_name'] . ',';
        if ($MarketingPartner['City5']['city_name'])
            $secondary_city .= $MarketingPartner['City5']['city_name'] . ',';

        if ($MarketingPartner['MarketingPartner']['marketing_partner_approved'] == 1)
            $approved = 'Approved';
        else
            $approved = 'Pending';
        ?>
                            <tr>
                                <td class="tablebody"><?php echo $MarketingPartner['MarketingPartner']['marketing_partner_display_name']; ?></td>
                                <td class="tablebody"><?php echo $MarketingPartner['MarketingPartner']['marketing_partner_legal_name']; ?></td>
                                <td class="tablebody"><?php echo $approved; ?></td>
                                <td class="tablebody"><?php echo $MarketingPartner['City']['city_name']; ?></td>
                                <td class="tablebody"><?php echo $MarketingPartner['MarketingPartner']['marketing_partner_website']; ?></td>
                                <td class="tablebody"><?php if ($MarketingPartner['MarketingPartner']['marketing_partner_boardnumber'] <> '') echo $codes[$MarketingPartner['MarketingPartner']['marketing_partner_boardnumber_code']] . ' ' . $MarketingPartner['MarketingPartner']['marketing_partner_boardnumber']; ?></td>
                                <td class="tablebody"><?php echo $MarketingPartner['MarketingPartner']['marketing_partner_boardemail']; ?></td>

                                <td class="tablebody"><?php echo $MarketingPartner['MarketingPartner']['marketing_partner_corporateaddress']; ?></td> 
                                <td class="tablebody"><?php echo $secondary_city; ?></td>
                                <td class="tablebody"><?php echo $MarketingPartner['MarketingPartner']['marketing_partner_description']; ?></td>
                               
                                <td width="10%" valign="middle" align="center">

                                        <?php
                                        
                                        
                                            echo $this->Html->link('<span class="icon-pencil"></span>', array('controller' => 'marketing_partners', 'action' => 'edit', 'slug' => $MarketingPartner['MarketingPartner']['marketing_partner_display_name'] . '-' . $MarketingPartner['City']['city_name'], 'id' => base64_encode($id)), array('class' => 'act-ico', 'escape' => false));
                                            
                                        
                                        echo $this->Html->link('<span class="icon-eye-open"></span>', array('controller' => 'marketing_partners', 'action' => 'view', 'slug' => $MarketingPartner['MarketingPartner']['marketing_partner_display_name'] . '-' . $MarketingPartner['City']['city_name'], 'id' => base64_encode($id)), array('class' => 'act-ico', 'escape' => false));
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
            <span class="badge badge-circle add-client"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Partner', '/marketing_partners/add') ?></span>

        </div>
    </div>
</div>


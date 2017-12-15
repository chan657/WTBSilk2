<?php
$this->Html->addCrumb('My Network', 'javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->element('BuilderContact/top_menu');
?>    
<div class="row">
    <div class="col-sm-12">
        <div class="table-heading">
            <h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php
                    echo $this->Paginator->counter(array('format' => '{:count}'));
                    ?></span> My Contacts</h4>

            <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Contact', '/builder_contacts/add', array('class' => 'open-popup-link add-btn')) ?></span>
            <span class="search_panel_icon"><i class="icon-plus" id="toggle_search_panel"></i></span>
        </div>
        <div class="panel panel-default">

            <div class="panel_controls hideform">

                <?php
                echo $this->Form->create('BuilderContact', array('controller' => 'builder_contacts', 'action' => 'index', 'class' => 'quick_search', 'id' => 'SearchForm', 'novalidate' => true, 'inputDefaults' => array(
                        'label' => false,
                        'div' => false,
                        'class' => 'form-control',
                )));
                ?> 
                <div class="row spe-row">
                    <div class="col-sm-4 col-xs-8">

                        <?php echo $this->Form->input('builder_contact_name', array('value' => $builder_contact_name, 'placeholder' => 'Type contact name or builder name', 'error' => array('class' => 'formerror'))); ?>
                    </div>
                    <div class="col-sm-3 col-xs-4">
                        <?php
                        echo $this->Form->submit('Search', array('div' => false, 'class' => 'btn btn-default btn-sm"'));
                        ?>

                    </div>
                </div>
                <div class="row" id="search_panel_controls">



                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Builder Name:</label>
<?php echo $this->Form->input('builder_contact_builder_id', array('options' => $builder, 'empty' => '--Select--', 'value' => $builder_contact_builder_id)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Contact Level:</label>
<?php echo $this->Form->input('builder_contact_level', array('options' => $contact_level, 'empty' => '--Select--', 'value' => $builder_contact_level)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Location:</label>
<?php echo $this->Form->input('builder_contact_location', array('options' => $city, 'empty' => '--Select--', 'value' => $builder_contact_location)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">For Company:</label>
<?php echo $this->Form->input('builder_contact_company', array('options' => $for_company, 'empty' => '--Select--', 'value' => $builder_contact_company)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">For Company City:</label>
<?php echo $this->Form->input('builder_contact_company_city', array('options' => $city, 'empty' => '--Select--', 'value' => $builder_contact_company_city)); ?>
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
                    <tr>
                        <th data-toggle="true" width="7%">Builder Name</th>
                        <th data-hide="phone" width="7%">Contact Name</th>
                        <th data-hide="phone" width="5%">Designation</th>
                        <th data-hide="phone" width="6%">Primary Mobile</th>
                        <th data-hide="phone" width="8%">Secondary Mobile</th>

                        <th data-hide="phone" width="1%">Email Address</th>
                        <th data-hide="phone" width="7%">Location</th>
                        <th data-hide="phone" width="5%">For City</th>
                        <th data-hide="phone" width="7%">Level</th>

                        <!--<th data-hide="all" data-sort-ignore="true">Initiated By</th>
                        <th data-hide="all" data-sort-ignore="true">Intiator</th>
<th data-hide="all" data-sort-ignore="true">Managed By</th>
                        <th data-hide="all" data-sort-ignore="true">Manager</th>
                        
<th data-hide="all" data-sort-ignore="true">For Company</th>
                        <th data-hide="all" data-sort-ignore="true">For Company City</th>
                        <th data-hide="all" data-sort-ignore="true">Approved By</th>
<th data-hide="all" data-sort-ignore="true">Approved Date</th>
                        <th data-hide="all" data-sort-ignore="true">Address of Contact</th>-->
                        <th data-hide="phone" data-sort-ignore="true" width="1%">Action</th>
                    </tr>
                </thead>
                <tbody>  
<?php
// pr($builder_contacts);
if (count($builder_contacts) && !empty($builder_contacts)):
    foreach ($builder_contacts as $BuilderContact):
        $id = $BuilderContact['BuilderContact']['id'];
        ?> 
                            <tr>
                                <td><?php echo $BuilderContact['Builder']['builder_name']; ?></td>
                                <td><?php echo $BuilderContact['BuilderContact']['builder_contact_name']; ?></td>
                                <td><?php echo $BuilderContact['BuilderContact']['builder_contact_designation']; ?></td>
                                <td><?php echo $BuilderContact['PrimaryMobileCountry']['code'] . ' ' . $BuilderContact['BuilderContact']['builder_contact_mobile_no']; ?></td>
                                <td><?php echo $BuilderContact['SecondMobileCountry']['code'] . ' ' . $BuilderContact['BuilderContact']['builder_contact_secondary_mobile_no']; ?></td>

                                <td><?php echo $BuilderContact['BuilderContact']['builder_contact_email']; ?></td>
                                <td><?php echo $BuilderContact['Location']['city_name']; ?></td>
                                <td><?php echo $BuilderContact['ForCompanyCity']['city_name']; ?></td>
                                <td><?php echo $BuilderContact['Level']['value']; ?></td>

         <!-- <td><?php echo $BuilderContact['Initiated']['fname'] . ' ' . $BuilderContact['Initiated']['lname']; ?></td>
          <td><?php echo $BuilderContact['InitiatedBy']['value']; ?></td>
          <td><?php echo $BuilderContact['Managed']['fname'] . ' ' . $BuilderContact['Managed']['lname']; ?></td>
              <td><?php echo $BuilderContact['ManagedBy']['value']; ?></td>
         
          <td><?php echo $BuilderContact['ForCompany']['value']; ?></td>
          <td><?php echo $BuilderContact['ForCompanyCity']['city_name']; ?></td>
          <td><?php echo $BuilderContact['ApprovedBy']['fname'] . ' ' . $BuilderContact['ApprovedBy']['lname']; ?></td>
          <td><?php if ($BuilderContact['BuilderContact']['builder_contact_approved_date'] <> '') echo date("d/m/Y", strtotime($BuilderContact['BuilderContact']['builder_contact_approved_date'])); ?></td>
          <td><?php echo $BuilderContact['BuilderContact']['builder_contact_email']; ?></td>-->
                                <td><?php
                    if ($BuilderContact['BuilderContact']['builder_contact_approved'] == 1) {

                        echo $this->Html->link('<span class="icon-pencil"></span>', array('controller' => 'builder_contacts', 'action' => 'edit', 'slug' => $BuilderContact['BuilderContact']['builder_contact_name'] . '-' . $BuilderContact['Location']['city_name'], 'id' => base64_encode($id)), array('class' => 'open-popup-link add-btn act-ico', 'escape' => false));
                    }
        ?></td>
                            </tr>
                                    <?php endforeach; ?>

                                <?php
                                echo $this->element('paginate');
                            else:
                                echo '<tr><td colspan="18" class="norecords">No Records Found</td></tr>';

                            endif;
                            ?>

                </tbody>   
            </table>

            <span class="badge badge-circle add-client"><i class="icon-plus"></i>  <?php echo $this->Html->link('Add Contact', '/builder_contacts/add', array('class' => 'open-popup-link add-btn')) ?></span>

        </div>
    </div>
</div>


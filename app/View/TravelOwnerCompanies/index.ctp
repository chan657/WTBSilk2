<?php $this->Html->addCrumb('My Owner Companies', 'javascript:void(0);', array('class' => 'breadcrumblast')); ?>
<div class="row">
    <div class="col-sm-12">
        <div class="table-heading">
            <h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php
                    echo $this->Paginator->counter(array('format' => '{:count}'));
                    ?></span> My Owner Companies</h4>
            <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Owner Company', '/travel_owner_companies/add') ?></span>
            <span class="search_panel_icon"><i class="icon-plus" id="toggle_search_panel"></i></span>
        </div>
        <div class="panel panel-default">

            <div class="panel_controls hideform">

                <?php
                echo $this->Form->create('TravelOwnerCompany', array('controller' => 'travel_owner_companies', 'action' => 'index', 'class' => 'quick_search', 'id' => 'SearchForm', 'novalidate' => true, 'inputDefaults' => array(
                        'label' => false,
                        'div' => false,
                        'class' => 'form-control',
                )));
                ?> 

                <div class="row spe-row">
                    <div class="col-sm-4 col-xs-8">
                        <?php echo $this->Form->input('owner_company_name', array('value' => $owner_company_name, 'placeholder' => 'Type owner copany name', 'error' => array('class' => 'formerror'))); ?>
                    </div>
                    <div class="col-sm-3 col-xs-4">
                        <?php
                        echo $this->Form->submit('Copany Search', array('div' => false, 'class' => 'btn btn-default btn-sm"'));
                        ?>

                    </div>
                </div>
                <div class="row" id="search_panel_controls">

                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Category:</label>
                        <?php echo $this->Form->input('owner_company_category',array('value' => $owner_company_category)); ?>
                    </div>

                    <div class="col-sm-3 col-xs-6">
                        <label>&nbsp;</label>
                        <?php
                        echo $this->Form->submit('Filter', array('div' => false, 'class' => 'btn btn-default btn-sm"'));
                        ?>

                    </div>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
            <table id="resp_table" class="table toggle-square" data-filter="#table_search" data-page-size="100">
                <thead>
                    <tr>
                        <th data-toggle="true" data-sort-ignore="true"><?php echo $this->Paginator->sort('id', 'Owner Id'); echo ($sort == 'id') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>" : " <i class='icon-sort'></i>"; ?></th>
                        <th data-toggle="phone" data-sort-ignore="true"><?php echo $this->Paginator->sort('owner_company_name', 'Owner Company'); echo ($sort == 'owner_company_name') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>" : " <i class='icon-sort'></i>"; ?></th>                               
                        <th data-hide="phone" data-sort-ignore="true">HQ</th>
                        <th data-hide="phone" data-sort-ignore="true">Category</th>
                        <th data-hide="phone" data-sort-ignore="true">Presence</th>
                        <th data-hide="phone" data-sort-ignore="true">Company VC1</th>
                        <th data-hide="phone" data-sort-ignore="true">Company VC2</th>
                        <th data-hide="phone" data-sort-ignore="true">Company VC3</th>
                        <th data-hide="phone" data-sort-ignore="true">Company VC4</th>
                        <th data-hide="phone" data-sort-ignore="true">Company VC5</th>                        
                        <th data-hide="phone" data-sort-ignore="true">Active</th>
                        <th data-hide="phone" data-sort-ignore="true">Status</th>                        
                        <th data-hide="phone" data-sort-ignore="true">Action</th>   
                        <th data-hide="all" data-sort-ignore="true">Top Company</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($TravelOwnerCompanies) && count($TravelOwnerCompanies) > 0):
                        foreach ($TravelOwnerCompanies as $TravelOwnerCompany):
                            $id = $TravelOwnerCompany['TravelOwnerCompany']['id'];
                            if ($TravelOwnerCompany['TravelOwnerCompany']['owner_company_status'] == '1') {
                                $status = 'Active';
                                $tb_class = 'active';
                            } else {
                                $status = 'Inactive';
                                $tb_class = 'inactive';
                            }
                            ?>
                            <tr>
                                <td><?php echo $id ?></td>
                                <td><?php echo $TravelOwnerCompany['TravelOwnerCompany']['owner_company_name']; ?></td>

                                <td><?php echo $TravelOwnerCompany['TravelOwnerCompany']['owner_company_hq']; ?></td>
                                <td><?php echo $TravelOwnerCompany['TravelOwnerCompany']['owner_company_category']; ?></td>
                                <td><?php echo $TravelOwnerCompany['TravelOwnerCompany']['owner_company_presence']; ?></td>
                                <td><?php echo $TravelOwnerCompany['TravelOwnerCompany']['owner_company_vc1']; ?></td>
                                <td><?php echo $TravelOwnerCompany['TravelOwnerCompany']['owner_company_vc2']; ?></td>
                                <td><?php echo $TravelOwnerCompany['TravelOwnerCompany']['owner_company_vc3']; ?></td>
                                <td><?php echo $TravelOwnerCompany['TravelOwnerCompany']['owner_company_vc4']; ?></td>
                                <td><?php echo $TravelOwnerCompany['TravelOwnerCompany']['owner_company_vc5']; ?></td>
                                <td><?php echo $TravelOwnerCompany['TravelOwnerCompany']['owner_company_active']; ?></td>
                                <td class="<?php echo $tb_class; ?>"><?php echo $status; ?></td>
                                <td width="10%" valign="middle" align="center">

                                    <?php
                                    echo $this->Html->link('<span class="icon-pencil"></span>', array('controller' => 'travel_owner_companies', 'action' => 'edit', 'slug' => $TravelOwnerCompany['TravelOwnerCompany']['owner_company_name'], 'id' => base64_encode($id), 'mode' => '1'), array('class' => 'act-ico', 'escape' => false));
                                    echo $this->Html->link('<span class="icon-eye-open"></span>', array('controller' => 'travel_owner_companies', 'action' => 'edit', 'slug' => $TravelOwnerCompany['TravelOwnerCompany']['owner_company_name'], 'id' => base64_encode($id), 'mode' => '2'), array('class' => 'act-ico', 'escape' => false));
                                    ?>
                                </td>
                                <td><?php echo $TravelOwnerCompany['TravelOwnerCompany']['top_owner_company']; ?></td>

                            </tr>
                        <?php endforeach; ?>

                        <?php
                        echo $this->element('paginate');
                    else:
                        echo '<tr><td colspan="14" class="norecords">No Records Found</td></tr>';
                    endif;
                    ?>
                </tbody>
            </table>
            <span class="badge badge-circle add-client"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Owner Company', '/travel_owner_companies/add') ?></span>

        </div>
    </div>
</div>


<?php
$this->Html->addCrumb('My Projects', 'javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->element('Project/top_menu');
?>


<div class="row">
    <div class="col-sm-12">
        <div class="table-heading">
            <h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php
                    echo $this->Paginator->counter(array('format' => '{:count}'));
                    ?></span> My Projects</h4>
            <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Project', '/projects/add') ?></span>
            <span class="search_panel_icon"><i class="icon-plus" id="toggle_search_panel"></i></span>
        </div>
        <div class="panel panel-default">

            <div class="panel_controls hideform">

                <?php
                echo $this->Form->create('Project', array('controller' => 'projects', 'action' => 'index', 'class' => 'quick_search', 'id' => 'SearchForm', 'novalidate' => true, 'inputDefaults' => array(
                        'label' => false,
                        'div' => false,
                        'class' => 'form-control',
                )));
                echo $this->Form->hidden('model_name', array('id' => 'model_name', 'value' => 'Project'));
                ?> 
                <div class="row spe-row">
                    <div class="col-sm-4 col-xs-8">

                        <?php echo $this->Form->input('global_search', array('value' => $global_search, 'placeholder' => 'Type project name', 'error' => array('class' => 'formerror'))); ?>
                    </div>
                    <div class="col-sm-3 col-xs-4">
                        <?php
                        echo $this->Form->submit('Project Search', array('div' => false, 'class' => 'btn btn-default btn-sm"'));
                        ?>

                    </div>
                    <div class="col-sm-5 col-xs-5">
                        <label for="un_member">Phase:</label>
                        <?php echo $this->Form->input('phase_id', array('value' => $phase_id, 'options' => $phase, 'empty' => '--Select--', 'onchange' => 'this.form.submit()', 'error' => array('class' => 'formerror'))); ?>
                    </div>
                </div>
                <div class="row" id="search_panel_controls">

                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">City:</label>
                        <?php echo $this->Form->input('city_id', array('id' => 'city_id', 'type' => 'select', 'options' => $cities, 'empty' => '--Select--', 'value' => $city_id)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Suburb:</label>
                        <?php echo $this->Form->input('suburb_id', array('type' => 'select', 'options' => $suburbs, 'empty' => '--Select--', 'value' => $suburb_id)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Area:</label>
                        <?php echo $this->Form->input('area_id', array('options' => $areas, 'empty' => '--Select--', 'value' => $area_id)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Builder:</label>
                        <?php echo $this->Form->input('builder_id', array('div' => array('id' => 'builder_id'), 'options' => $builders, 'empty' => '--Select--', 'value' => $builder_id)); ?>
                    </div>

                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Residential:</label>
                        <?php echo $this->Form->input('proj_residential', array('options' => array('1' => 'Yes', '2' => 'No'), 'empty' => '--Select--', 'value' => $proj_residential)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">High End:</label>
                        <?php echo $this->Form->input('proj_highendresidential', array('options' => array('1' => 'Yes', '2' => 'No'), 'empty' => '--Select--', 'value' => $proj_highendresidential)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Commercial:</label>
                        <?php echo $this->Form->input('proj_commercial', array('options' => array('1' => 'Yes', '2' => 'No'), 'empty' => '--Select--', 'value' => $proj_commercial)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Secondary Builder:</label>
                        <?php echo $this->Form->input('secondary_builder_id', array('options' => $builders, 'empty' => '--Select--', 'value' => $secondary_builder_id)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Marketing Status:</label>
                        <?php echo $this->Form->input('proj_marketing_status', array('options' => $marketing_status, 'empty' => '--Select--', 'value' => $proj_marketing_status)) ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Marketing Partner:</label>
                        <?php echo $this->Form->input('proj_marketing_partner', array('options' => $marketing_partners, 'empty' => '--Select--', 'value' => $proj_marketing_partner)); ?>
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
                        <th data-toggle="true">Project Name</th>
                        <th data-hide="phone">Builder</th>
                        <th data-hide="phone">Approval Status</th>
                        <th data-hide="phone">City</th>
                        <th data-hide="phone">Suburb</th>
                        <th data-hide="phone">Area</th>


                        <th data-hide="phone">Phase</th>
                        <th data-hide="phone">Category</th>

                        <th data-sort-ignore="true" data-hide="phone">Completion Date</th>
                        <th data-sort-ignore="true" data-hide="phone">Marketing Status</th>
                        <th data-sort-ignore="true" data-hide="phone">Marketing Partner</th>

                        <th data-sort-ignore="true" data-hide="all">Area of Land</th>
                        <th data-sort-ignore="true" data-hide="all">No of Buildings</th>
                        <th data-sort-ignore="true" data-hide="all">No of Stories </th>
                        <th data-sort-ignore="true" data-hide="all">Exact Location </th>
                        <th data-sort-ignore="true" data-hide="all">Distance from Landmark </th>
                        <th data-sort-ignore="true" data-hide="all">Construction status </th>
                        <th data-sort-ignore="true" data-hide="all">Legal Approval status </th>
                        <th data-sort-ignore="true" data-hide="all">Bank Finance Status </th>
                        <th data-sort-ignore="true" data-hide="all">Secondary Builders </th>
                        <th data-sort-ignore="true" data-hide="all">Project USP 1  </th>
                        <th data-sort-ignore="true" data-hide="all">Project USP 2  </th>
                        <th data-sort-ignore="true" data-hide="all">Project USP 3  </th>
                        <th data-sort-ignore="true" data-hide="all">Project Summary  </th>
                        <th data-sort-ignore="true" data-hide="phone">Action</th>        
                    </tr>
                </thead>
                <tbody>
<?php
$i = 1;
$secondary_city = '';

if (isset($projects) && count($projects) > 0):
    foreach ($projects as $project):
        $id = $project['Project']['id'];

        if ($project['SecondaryBuilder']['builder_name'])
            $secondary_city .= $project['SecondaryBuilder']['builder_name'] . ',';
        if ($project['TertiaryBuilder']['builder_name'])
            $secondary_city .= $project['TertiaryBuilder']['builder_name'] . ',';

        if ($project['Project']['proj_approved'] == 1)
            $approved = 'Approved';
        else
            $approved = 'Pending';
        ?>
                            <tr>
                                <td><?php echo $project['Project']['project_name']; ?></td>
                                <td><?php echo $project['Builder']['builder_name']; ?></td>
                                <td><?php echo $approved ?></td>
                                <td><?php echo $project['City']['city_name']; ?></td>
                                <td><?php echo $project['Suburb']['suburb_name'] ?></td>
                                <td><?php echo $project['Area']['area_name']; ?></td>


                                <td><?php echo $project['Phase']['name'] ?></td>
                                <td><?php echo $project['Category']['name']; ?></td>

                                <td><?php if ($project['Project']['proj_completionyear']) echo date("d/m/Y", strtotime($project['Project']['proj_completionyear']));
                    else echo '---' ?></td>
                                <td><?php echo $project['Project']['marketing_id']; ?></td>
                                <td><?php echo $project['Project']['proj_marketing_partner']; ?></td>

                                <td><?php echo $project['Project']['proj_areaofland']; ?></td>
                                <td><?php echo $project['Project']['no_of_buildings']; ?></td>

                                <td><?php echo $project['Project']['proj_storeys'] ?></td>
                                <td><?php echo $project['Project']['exact_location']; ?></td>
                                <td><?php echo $project['Project']['proj_distancefromcentrallandmark'] ?></td>
                                <td><?php echo $project['Project']['construction_status'] ?></td>
                                <td><?php echo $project['Project']['legal_approval_status'] ?></td>
                                <td><?php echo $project['Project']['bank_finance_status'] ?></td>
                                <td><?php echo $secondary_city; ?></td>
                                <td><?php echo $project['Project']['proj_usp1'] ?></td>
                                <td><?php echo $project['Project']['proj_usp2'] ?></td>
                                <td><?php echo $project['Project']['proj_usp3'] ?></td>
                                <td><?php echo $project['Project']['proj_description'] ?></td>





                                <td width="10%" valign="middle" align="center">

                                    <?php
                                    //if($project['Project']['proj_approved'] == 1){
                                    echo $this->Html->link('<span class="icon-pencil"></span>', array('controller' => 'projects', 'action' => 'edit', 'slug' => $project['Project']['project_name'] . '-' . $project['City']['city_name'] . '-' . $project['Builder']['builder_name'], 'id' => base64_encode($id)), array('class' => 'act-ico', 'escape' => false));
                                    // }

                                    echo $this->Html->link('<span class="icon-eye-open"></span>', array('controller' => 'projects', 'action' => 'view', 'slug' => $project['Project']['project_name'] . '-' . $project['City']['city_name'] . '-' . $project['Builder']['builder_name'], 'id' => base64_encode($id)), array('class' => 'act-ico', 'escape' => false));
                                    ?>
                                </td>

                            </tr>
        <?php endforeach; ?>

                        <?php
                        echo $this->element('paginate');
                    else:
                        echo '<tr><td colspan="25" class="norecords">No Records Found</td></tr>';
                    endif;
                    ?>
                </tbody>
            </table>
            <span class="badge badge-circle add-client"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Project', '/projects/add') ?></span>


        </div>
    </div>
</div>

<?php
$this->Js->get('#city_id')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_suburb_by_city/Project/city_id'
                ), array(
            'update' => '#ProjectSuburbId',
            'async' => true,
            'before' => 'loading("ProjectSuburbId")',
            'complete' => 'loaded("ProjectSuburbId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);
$this->Js->get('#city_id')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_area_by_city', 'Project'
                ), array(
            'update' => '#ProjectAreaId',
            'async' => true,
            'before' => 'loading("ProjectAreaId")',
            'complete' => 'loaded("ProjectAreaId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);
$this->Js->get('#ProjectSuburbId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_area_by_suburb/Project/suburb_id'
                ), array(
            'update' => '#ProjectAreaId',
            'async' => true,
            'before' => 'loading("ProjectAreaId")',
            'complete' => 'loaded("ProjectAreaId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true,
            ))
        ))
);
$this->Js->get('#city_id')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_builder_by_cityid', 'Project'
                ), array(
            'update' => '#ProjectBuilderId',
            'async' => true,
            'before' => 'loading("ProjectBuilderId")',
            'complete' => 'loaded("ProjectBuilderId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true,
            ))
        ))
);
?>

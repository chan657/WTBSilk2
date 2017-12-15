<?php $this->Html->addCrumb('My Search', 'javascript:void(0);', array('class' => 'breadcrumblast')); ?>
<?php
if ($search_type == '1') {
    $property = 'style="display: block;"';
    $project = 'style="display: none;"';
    $cmn_style = 'style="display: block;"';
} elseif ($search_type == '2') {
    $property = 'style="display: none;"';
    $project = 'style="display: block;"';
    $cmn_style = 'style="display: block;"';
} else {
    $cmn_style = 'style="display: none;"';
    $property = 'style="display: none;"';
    $project = 'style="display: none;"';
}
if ($project_specific == '1') {
    $contact = 'style="display: block;"';
    $legal_name = 'style="display: none;"';
    $unit = 'style="display: none;"';
    $amanity = 'style="display: none;"';
} elseif ($project_specific == '2') {
    $contact = 'style="display: none;"';
    $legal_name = 'style="display: block;"';
    $unit = 'style="display: none;"';
    $amanity = 'style="display: none;"';
} elseif ($project_specific == '3') {
    $contact = 'style="display: none;"';
    $amanity = 'style="display: block;"';
    $legal_name = 'style="display: none;"';
    $unit = 'style="display: none;"';
} elseif ($project_specific == '4') {
    $contact = 'style="display: none;"';
    $legal_name = 'style="display: none;"';
    $amanity = 'style="display: none;"';
    $unit = 'style="display: block;"';
} else {
    $contact = 'style="display: none;"';
    $legal_name = 'style="display: none;"';
    $amanity = 'style="display: none;"';
    $unit = 'style="display: none;"';
}
?> 
<div class="row">
    <div class="col-sm-12">
        <div class="table-heading">
            <h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php
//  echo $this->Paginator->counter(array('format' => '{:count}'));
?></span> My Search</h4>


        </div>
        <div class="panel panel-default">

            <div class="panel_controls">

                <?php
                echo $this->Form->create('Search', array('controller' => 'Cities', 'action' => 'index', 'class' => 'quick_search', 'id' => 'SearchForm', 'novalidate' => true, 'inputDefaults' => array(
                        'label' => false,
                        'div' => false,
                        'class' => 'form-control',
                )));
                ?> 
                <div class="row spe-row">
                    <div class="col-sm-4 col-xs-8">

                        <?php echo $this->Form->input('search_type', array('options' => array('1' => 'Property', '2' => 'Project'), 'empty' => '--Type of search--')); ?>
                    </div>
                    <div class="col-sm-3 col-xs-4">
                        <?php
                        echo $this->Form->button('Search', array('div' => false, 'id' => 'search', 'class' => 'btn btn-default btn-sm', 'type' => 'button'));
                        ?>

                    </div>
                </div>
                <div class="row" id="search_panel_controls" style="display: block;">
                    <div id="property" <?php echo $property; ?>> 
                        <div class="col-sm-3 col-xs-6">
                            <label for="un_member">City:</label>
                            <?php echo $this->Form->input('Project.city_id', array('options' => $city, 'empty' => '--Select--', 'value' => $property_city_id)); ?>
                        </div>
                        <div class="col-sm-3 col-xs-6">
                            <label for="un_member">Suburb:</label>
                            <?php echo $this->Form->input('Project.suburb_id', array('options' => $suburbs, 'empty' => '--Select--', 'value' => $property_suburb_id)); ?>
                        </div>
                        <div class="col-sm-3 col-xs-6">
                            <label for="un_member">Area:</label>
                            <?php echo $this->Form->input('Project.area_id', array('options' => $areas, 'empty' => '--Select--', 'value' => $property_area_id)); ?>
                        </div>
                        <div class="col-sm-3 col-xs-6">
                            <label for="un_member">Unit Type:</label>
                            <?php echo $this->Form->input('ProjectUnit.unit_type', array('options' => $unit_type, 'empty' => '--Select--', 'value' => $property_unit_type)); ?>
                        </div>
                        <div class="col-sm-3 col-xs-6">
                            <label for="un_member">Project Type:</label>
                            <?php echo $this->Form->input('Project.project_type', array('options' => $project_types, 'empty' => '--Select--', 'value' => $property_project_type)); ?>
                        </div>
                        <div class="col-sm-3 col-xs-6">
                            <label for="un_member">Budget minimum & maxium:</label>
                            <?php echo $this->Form->input('ProjectUnit.property_budget',array('value' => $property_budget)); ?>
                        </div>
                        <div class="col-sm-3 col-xs-6">
                            <label for="un_member">Based On:</label>
                            <?php echo $this->Form->input('ProjectUnit.unit_commission_based_on', array('options' => array('1' => 'Basic Cost','2' => 'Agreement Cost','3' => 'Inclusive Cost'), 'empty' => '--Select--', 'value' => $property_unit_commission_based_on)); ?>
                        </div>
                    </div>

                    <div id="project" <?php echo $project; ?>>
                        <div class="col-sm-3 col-xs-6">
                            <label for="un_member">Project Specific:</label>
                            <?php echo $this->Form->input('Project.specific', array('options' => array('1' => 'Project without contacts', '2' => 'Project without legal name', '3' => 'Project without amenities', '4' => 'Project without units'), 'empty' => '--Select--', 'value' => $project_specific)); ?>
                        </div>
                        <div id="contacts" <?php echo $contact; ?>>
                            <div class="col-sm-3 col-xs-6">
                                <label for="un_member">City:</label>
                                <?php echo $this->Form->input('Project.city_id1', array('options' => $city, 'empty' => '--Select--', 'value' => $contact_city_id)); ?>
                            </div>
                            <div class="col-sm-3 col-xs-6">
                                <label for="un_member">Suburb:</label>
                                <?php echo $this->Form->input('Project.suburb_id1', array('options' => $suburbs, 'empty' => '--Select--', 'value' => $contact_suburb_id)); ?>
                            </div>
                            <div class="col-sm-3 col-xs-6">
                                <label for="un_member">Area:</label>
                                <?php echo $this->Form->input('Project.area_id1', array('options' => $areas, 'empty' => '--Select--', 'value' => $contact_area_id)); ?>
                            </div>
                        </div>
                        <div id="legal_names"  <?php echo $legal_name; ?>>
                            <div class="col-sm-3 col-xs-6">
                                <label for="un_member">City:</label>
                                <?php echo $this->Form->input('Project.city_id2', array('options' => $city, 'empty' => '--Select--', 'value' => $legal_city_id)); ?>
                            </div>
                            <div class="col-sm-3 col-xs-6">
                                <label for="un_member">Suburb:</label>
                                <?php echo $this->Form->input('Project.suburb_id2', array('options' => $suburbs, 'empty' => '--Select--', 'value' => $legal_suburb_id)); ?>
                            </div>
                            <div class="col-sm-3 col-xs-6">
                                <label for="un_member">Area:</label>
                                <?php echo $this->Form->input('Project.area_id2', array('options' => $areas, 'empty' => '--Select--', 'value' => $legal_area_id)); ?>
                            </div>
                        </div>
                        <div id="amanities"  <?php echo $amanity; ?>>
                            <div class="col-sm-3 col-xs-6">
                                <label for="un_member">City:</label>
                                <?php echo $this->Form->input('Project.city_id3', array('options' => $city, 'empty' => '--Select--', 'value' => $aminity_city_id)); ?>
                            </div>
                            <div class="col-sm-3 col-xs-6">
                                <label for="un_member">Suburb:</label>
                                <?php echo $this->Form->input('Project.suburb_id3', array('options' => $suburbs, 'empty' => '--Select--', 'value' => $aminity_suburb_id)); ?>
                            </div>
                            <div class="col-sm-3 col-xs-6">
                                <label for="un_member">Area:</label>
                                <?php echo $this->Form->input('Project.area_id3', array('options' => $areas, 'empty' => '--Select--', 'value' => $aminity_area_id)); ?>
                            </div>
                        </div>
                        <div id="units"  <?php echo $unit; ?>>
                            <div class="col-sm-3 col-xs-6">
                                <label for="un_member">City:</label>
                                <?php echo $this->Form->input('Project.city_id4', array('options' => $city, 'empty' => '--Select--', 'value' => $unit_city_id)); ?>
                            </div>
                            <div class="col-sm-3 col-xs-6">
                                <label for="un_member">Suburb:</label>
                                <?php echo $this->Form->input('Project.suburb_id4', array('options' => $suburbs, 'empty' => '--Select--', 'value' => $unit_suburb_id)); ?>
                            </div>
                            <div class="col-sm-3 col-xs-6">
                                <label for="un_member">Area:</label>
                                <?php echo $this->Form->input('Project.area_id4', array('options' => $areas, 'empty' => '--Select--', 'value' => $unit_area_id)); ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3 col-xs-6 form_submit" <?php echo $cmn_style; ?>>
                        <label>&nbsp;</label>
                        <?php
                        echo $this->Form->submit('Filter', array('div' => false, 'class' => 'btn btn-default btn-sm"'));
                        echo $this->Form->button('Reset', array('type' => 'button', 'id' => 'reset', 'class' => 'btn btn-default btn-sm"'));
                        ?>

                    </div>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
            <?php if ($search_type == '1') { ?>
                <table border="0" cellpadding="0" cellspacing="0" id="resp_table" class="table toggle-square myclitb" data-filter="#table_search" data-page-size="100">
                    <thead>
                        <tr>
                            <th data-toggle="true">Project name</th>
                            <th data-hide="phone">Unit display name</th>
                            <th data-hide="phone">City</th> 
                            <th data-hide="phone">Suburb</th>
                            <th data-hide="phone">Area</th>
                            <th data-hide="phone">Unit area (lowest and highest)</th>
                            <th data-hide="phone">Unit price (lowest and highest)</th>
                            <th data-hide="phone">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($properties) && count($properties) > 0):
                            foreach ($properties as $property):
                                $id = $property['ProjectUnit']['id'];
                                ?>
                                <tr>
                                    <td class="tablebody" valign="middle" align="left"><?php echo $property['Project']['project_name']; ?></td>
                                    <td class="tablebody" valign="middle" align="left"><?php echo $property['ProjectUnit']['unit_name']; ?></td>
                                    <td class="tablebody" valign="middle" align="left"><?php echo $property['ProjectCity']['city_name']; ?></td>
                                    <td class="tablebody" valign="middle" align="left"><?php echo $property['ProjectSuburb']['suburb_name']; ?></td>
                                    <td class="tablebody" valign="middle" align="left"><?php echo $property['ProjectArea']['area_name']; ?></td>
                                    <td class="tablebody" valign="middle" align="left"><?php echo $property['ProjectUnit']['unit_sellable_area_lowest_size'] . ' / ' . $property['ProjectUnit']['unit_sellable_area_highest_size']; ?></td>
                                    <td class="tablebody" valign="middle" align="left"><?php echo $property['ProjectUnit']['unit_price']; ?></td>

                                    <td width="10%" valign="middle" align="center">

                                        <?php
                                        echo $this->Html->link('<span class="icon-eye-open"></span>', '/projects/view_unit/' . $id, array('class' => 'act-icon open-popup-link add-btn', 'escape' => false));
                                        ?>
                                    </td>

                                </tr>
                                <?php
                            endforeach;
                            echo $this->element('paginate');
                        else:
                            echo '<tr><td colspan="8" class="norecords">No Records Found</td></tr>';
                        endif;
                        ?>
                    </tbody>
                </table>
            <?php
            }
            elseif ($search_type == '2') {
                ?>
                <table border="0" cellpadding="0" cellspacing="0" id="resp_table" class="table toggle-square myclitb" data-filter="#table_search" data-page-size="100">
                    <thead>
                        <tr>
                            <th data-toggle="true">Project Name</th>
                            <th data-hide="phone">Builder</th>

                            <th data-hide="phone">City</th>
                            <th data-hide="phone">Suburb</th>
                            <th data-hide="phone">Area</th>


                            <th data-hide="phone">Phase</th>
                            <th data-hide="phone">Category</th>
                            <th data-hide="phone">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($projects) && count($projects) > 0):
                            foreach ($projects as $project):
                                $id = $project['Project']['id'];
                                ?>
                                <tr>
                                    <td><?php echo $project['Project']['project_name']; ?></td>
                                    <td><?php echo $project['Builder']['builder_name']; ?></td>

                                    <td><?php echo $project['City']['city_name']; ?></td>
                                    <td><?php echo $project['Suburb']['suburb_name'] ?></td>
                                    <td><?php echo $project['Area']['area_name']; ?></td>
                                    <td><?php echo $project['Phase']['name'] ?></td>
                                    <td><?php echo $project['Category']['name']; ?></td>

                                    <td width="10%" valign="middle" align="center">

                                        <?php
                                        echo $this->Html->link('<span class="icon-eye-open"></span>', array('controller' => 'projects', 'action' => 'view', 'slug' => $project['Project']['project_name'] . '-' . $project['City']['city_name'] . '-' . $project['Builder']['builder_name'], 'id' => base64_encode($id)), array('class' => 'act-ico', 'escape' => false, 'target' => '_blank'));
                                        //echo $this->Html->link('<span class="icon-pencil"></span>', array('controller' => 'cities', 'action' => 'edit', 'slug' => $city['City']['city_name'], 'id' => base64_encode($id), 'mode' => '1'), array('class' => 'act-ico', 'escape' => false));
                                        //echo $this->Html->link('<span class="icon-eye-open"></span>', array('controller' => 'cities', 'action' => 'edit', 'slug' => $city['City']['city_name'], 'id' => base64_encode($id), 'mode' => '2'), array('class' => 'act-ico', 'escape' => false));
                                        ?>
                                    </td>

                                </tr>
                                <?php
                            endforeach;
                            echo $this->element('paginate');
                        else:
                            echo '<tr><td colspan="9" class="norecords">No Records Found</td></tr>';
                        endif;
                        ?>
                    </tbody>
                </table>
            <?php } ?>

        </div>
    </div>
</div>
<?php
$this->Js->get('#ProjectCityId')->event('change', $this->Js->request(array(
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

$this->Js->get('#ProjectCityId1')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_suburb_by_city/Project/city_id1'
                ), array(
            'update' => '#ProjectSuburbId1',
            'async' => true,
            'before' => 'loading("ProjectSuburbId1")',
            'complete' => 'loaded("ProjectSuburbId1")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);

$this->Js->get('#ProjectSuburbId1')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_area_by_suburb/Project/suburb_id1'
                ), array(
            'update' => '#ProjectAreaId1',
            'async' => true,
            'before' => 'loading("ProjectAreaId1")',
            'complete' => 'loaded("ProjectAreaId1")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true,
            ))
        ))
);

$this->Js->get('#ProjectCityId2')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_suburb_by_city/Project/city_id2'
                ), array(
            'update' => '#ProjectSuburbId2',
            'async' => true,
            'before' => 'loading("ProjectSuburbId2")',
            'complete' => 'loaded("ProjectSuburbId2")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);

$this->Js->get('#ProjectSuburbId2')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_area_by_suburb/Project/suburb_id2'
                ), array(
            'update' => '#ProjectAreaId2',
            'async' => true,
            'before' => 'loading("ProjectAreaId2")',
            'complete' => 'loaded("ProjectAreaId2")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true,
            ))
        ))
);

$this->Js->get('#ProjectCityId3')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_suburb_by_city/Project/city_id3'
                ), array(
            'update' => '#ProjectSuburbId3',
            'async' => true,
            'before' => 'loading("ProjectSuburbId3")',
            'complete' => 'loaded("ProjectSuburbId3")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);

$this->Js->get('#ProjectSuburbId3')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_area_by_suburb/Project/suburb_id3'
                ), array(
            'update' => '#ProjectAreaId3',
            'async' => true,
            'before' => 'loading("ProjectAreaId3")',
            'complete' => 'loaded("ProjectAreaId3")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true,
            ))
        ))
);
$this->Js->get('#ProjectCityId4')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_suburb_by_city/Project/city_id4'
                ), array(
            'update' => '#ProjectSuburbId4',
            'async' => true,
            'before' => 'loading("ProjectSuburbId4")',
            'complete' => 'loaded("ProjectSuburbId4")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);

$this->Js->get('#ProjectSuburbId4')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_area_by_suburb/Project/suburb_id4'
                ), array(
            'update' => '#ProjectAreaId4',
            'async' => true,
            'before' => 'loading("ProjectAreaId4")',
            'complete' => 'loaded("ProjectAreaId4")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true,
            ))
        ))
);
?>
<script>
    $('#search').click(function() {
        var search_type = $('#SearchSearchType').val();
        $('.form_submit').css('display', 'block');
        if (search_type == '1') {
            $('#property').css('display', 'block');
            $('#project').css('display', 'none');
        }
        else if (search_type == '2') {
            $('#property').css('display', 'none');
            $('#project').css('display', 'block');
        }

    });

    $('#ProjectSpecific').change(function() {
        var specific = $(this).val();
        if (specific == '1') {
            $('#contacts').css('display', 'block');
            $('#legal_names').css('display', 'none');
            $('#units').css('display', 'none');
            $('#amanities').css('display', 'none')
        }
        else if (specific == '2') {
            $('#legal_names').css('display', 'block');
            $('#contacts').css('display', 'none');
            $('#units').css('display', 'none');
            $('#amanities').css('display', 'none');
        }
        else if (specific == '3') {
            $('#amanities').css('display', 'block');
            $('#legal_names').css('display', 'none');
            $('#contacts').css('display', 'none');
            $('#units').css('display', 'none');
        }
        else if (specific == '4') {
            $('#units').css('display', 'block');
            $('#legal_names').css('display', 'none');
            $('#contacts').css('display', 'none');
            $('#amanities').css('display', 'none');
        }
    });

    $('#reset').click(function() {

        $('#SearchSearchType').val(''); 
        $('#ProjectCityId').val('');
        $('#ProjectSuburbId').val('');
        $('#ProjectAreaId').val('');
        $('#ProjectUnitUnitType').val('');
        $('#ProjectProjectType').val('');
        $('#SearchPropertyBudget').val('');
        $('#ProjectUnitUnitCommissionBasedOn').val('');
        $('#ProjectSpecific').val('');
        $('#ProjectCityId1').val('');
        $('#ProjectSuburbId1').val('');
        $('#ProjectAreaId1').val('');
        $('#ProjectCityId2').val('');
        $('#ProjectSuburbId2').val('');
        $('#ProjectAreaId2').val('');
        $('#ProjectCityId3').val('');
        $('#ProjectSuburbId3').val('');
        $('#ProjectAreaId3').val('');
        $('#ProjectCityId4').val('');
        $('#ProjectSuburbId4').val('');
        $('#ProjectAreaId4').val('');
    });
</script>
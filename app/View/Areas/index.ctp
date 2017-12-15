<?php
$this->Html->addCrumb('My Areas', 'javascript:void(0);', array('class' => 'breadcrumblast'));
//pr($areas);
?>
<div class="row">
    <div class="col-sm-12">
        <div class="table-heading">
            <h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php
                    echo $this->Paginator->counter(array('format' => '{:count}'));
                    ?></span> My Areas</h4>
            <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Area', '/areas/add') ?></span>
            <span class="search_panel_icon"><i class="icon-plus" id="toggle_search_panel"></i></span>
        </div>
        <div class="panel panel-default">

            <div class="panel_controls hideform">

                <?php
                echo $this->Form->create('Area', array('controller' => 'areas', 'action' => 'index', 'class' => 'quick_search', 'id' => 'SearchForm', 'novalidate' => true, 'inputDefaults' => array(
                        'label' => false,
                        'div' => false,
                        'class' => 'form-control',
                )));
                ?> 
                <div class="row spe-row">
                    <div class="col-sm-4 col-xs-8">
                        <label for="un_member">Area:</label>
                        <?php echo $this->Form->input('area_name', array('value' => $area_name, 'error' => array('class' => 'formerror'))); ?>
                    </div>
                    <div class="col-sm-3 col-xs-4">
                        <?php
                        echo $this->Form->submit('Search', array('div' => false, 'class' => 'btn btn-default btn-sm"'));
                        ?>

                    </div>
                </div>
                <div class="row" id="search_panel_controls">


                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">City Name:</label>
                        <?php echo $this->Form->input('city_id', array('options' => $city, 'empty' => '--Select--', 'value' => $city_id)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Suburb Name:</label>
                        <?php echo $this->Form->input('suburb_id', array('type' => 'select', 'options' => $suburb, 'empty' => '--Select--', 'value' => $suburb_id)); ?>
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
            <table id="resp_table" class="table toggle-square" data-filter="#table_search" data-page-size="40">
                <thead>
                    <tr>
                        <th data-toggle="true">Area Name</th>
                        <th data-hide="phone">Suburb Name</th>
                        <th data-hide="phone">City Name</th>
                        <th data-hide="phone">Status</th>
                        <th data-hide="phone" data-sort-ignore="true">Action</th>        
                    </tr>
                </thead>
                <tbody>
<?php
if (isset($areas) && count($areas) > 0):
    foreach ($areas as $area):
        $id = $area['Area']['id'];
        if ($area['Area']['area_status'] == '1') {
            $status = 'Active';
            $tb_class = 'active';
        } else {
            $status = 'Inactive';
            $tb_class = 'inactive';
        }
        ?>
                            <tr>
                                <td><?php echo $area['Area']['area_name']; ?></td>
                                <td><?php echo $area['Suburb']['suburb_name']; ?></td>                     
                                <td><?php echo $area['City']['city_name']; ?></td>
                                <td class="<?php echo $tb_class; ?>"><?php echo $status; ?></td>
                                <td width="10%" valign="middle" align="center">

        <?php
        echo $this->Html->link('<span class="icon-pencil"></span>', array('controller' => 'areas', 'action' => 'edit', 'slug' => $area['Area']['area_name'] . '-' . $area['City']['city_name'] . '-' . $area['Suburb']['suburb_name'], 'id' => base64_encode($id), 'mode' => '1'), array('class' => 'act-ico', 'escape' => false));
        echo $this->Html->link('<span class="icon-eye-open"></span>', array('controller' => 'areas', 'action' => 'edit', 'slug' => $area['Area']['area_name'] . '-' . $area['City']['city_name'] . '-' . $area['Suburb']['suburb_name'], 'id' => base64_encode($id), 'mode' => '2'), array('class' => 'act-ico', 'escape' => false));
        ?>
                                </td>

                            </tr>
                                    <?php endforeach; ?>

                                <?php
                                echo $this->element('paginate');
                            else:
                                echo '<tr><td colspan="4" class="norecords">No Records Found</td></tr>';

                            endif;
                            ?>

                </tbody>
            </table>
            <span class="badge badge-circle add-client"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Area', '/areas/add') ?></span>

        </div>
    </div>
</div>
<?php
$this->Js->get('#AreaCityId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_suburb_by_city/Area/city_id'
                ), array(
            'update' => '#AreaSuburbId',
            'async' => true,
            'before' => 'loading("AreaSuburbId")',
            'complete' => 'loaded("AreaSuburbId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);
?>                        

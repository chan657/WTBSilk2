<?php
$this->Html->addCrumb('URL Shorteners', 'javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->Form->create('Short', array('method' => 'post',
    'id' => 'parsley_reg',
    'novalidate' => true,
    'inputDefaults' => array(
        'label' => false,
        'div' => false,
        'class' => 'form-control',
    ),
    array('tests/convert')
));
?>
<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">URL Shorteners</h4>
        </div>
        <div class="panel-body">
            <fieldset>
                <legend><span>URL Shorteners</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">

                    <div class="form-group">
                        <label for="reg_input_name" class="req">Paste Url</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('longurl', array('data-required' => 'true', 'placeholder' => 'Paste a link to shorten it'));
                            ?></div>
                    </div>

                    <div class="form-group">
                        <label for="reg_input_name" class="req">Short Url</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $sort_url;
                            ?></div>
                    </div>


                    <div class="row">
                        <div class="col-sm-1">
                            <?php
                            echo $this->Form->submit('Add', array('class' => 'btn btn-success sticky_success'));
                            ?>
                        </div>
                    </div>
                    <div style="margin-bottom: 15px"></div>
                    <table id="resp_table" class="table toggle-square" data-filter="#table_search" data-page-size="100">
                        <thead>

                            <tr>           
                                <th data-toggle="true"  data-sort-ignore="true">Long Url</th>                        
                                <th data-hide="phone" data-sort-ignore="true">Short Domain</th>
                                <th data-hide="phone" data-sort-ignore="true">301 Redirect</th>
                                <th data-hide="phone" data-sort-ignore="true">Length</th>
                                <th data-hide="phone" data-sort-ignore="true">Short Url</th>                                                

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($Shorts) && count($Shorts) > 0):
                                foreach ($Shorts as $Short):
                                    ?>
                                    <tr>                              
                                        <td><?php echo $Short['Short']['url']; ?></td>   
                                        <td><?php echo $Short['Short']['domain']; ?></td>
                                        <td>Yes</td>
                                        <td><?php echo strlen($_SERVER['HTTP_HOST'] . '/' . $Short['Short']['slug']); ?></td>
                                        <td><?php echo BASE_HREF . $Short['Short']['slug']; ?></td>                                                             

                                    </tr>
                                <?php endforeach; ?>

                                <?php
                                echo $this->element('paginate');
                            else:
                                echo '<tr><td colspan="5" class="norecords">No Records Found</td></tr>';
                            endif;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->Form->end(); ?>   

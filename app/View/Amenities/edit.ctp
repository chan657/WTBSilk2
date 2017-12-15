<?php
echo $this->Html->script('jquery-1.10.2.min');
echo $this->Html->css('main');
?>
<style>
    .add-project-row{
        padding: 10px 0 8px 30px;
        height: 28px;
    }

    .inputbox{
        padding: 0 0 0 0;
    }
    .butt_submit{
        float: right;
    }

</style>
<?php echo $this->Session->flash(); ?>

<!----------------------------start add project block------------------------------>
<div>
    <input type="hidden" id="hidden_site_baseurl" value="<?php echo $this->request->base . ((!is_null($this->params['language'])) ? '/' . $this->params['language'] : ''); ?>"  />
    <div class="tableheadbg">
        <span class="heading_text">Edit Amenities For | <?php echo $amenities['Project']['project_name']; ?></span>
    </div>

    <?php
    echo $this->Form->create('Amenity', array('enctype' => 'multipart/form-data'));
    echo $this->Form->hidden('model_name',array('id' => 'model_name','value' =>'Amenity'));
    ?>

    <div class="tableboeder" style="padding-top: 25px;">
        <div class="add-project-row">
            <div style="width:20%; float: left; padding: 5px 0;">Amenities Type</div>
            <div style="width:5%; float: left; padding: 5px 0;">:</div>
            <div style="width:75%; float: left;">	<?php
             echo $this->Form->input('group_id', array('div' => false,'id' => 'group_id', 'label' => false,'disabled' => true, 'options' => $groups,'selected' => $selected_grp['Group']['id'], 'empty' => 'Select', 'class' => 'inputformadd', 'size' => '1', 'maxlength' => '100'));
                ?></div>

        </div>

        <div class="add-project-row" id="ajax">
            <div style="width:20%; float: left; padding: 5px 0;">Amenities</div>
            <div style="width:5%; float: left; padding: 5px 0;">:</div>
            <div style="width:75%; float: left;">  <?php
                echo $this->Form->input('amenity_id', array(
                    'label' => false,
                    'div' => array('class' => 'list-checkbox'),
                    'type' => 'select',
                    'multiple' => 'checkbox',
                    'options' => $amenity,
                    'selected' => $select_arr
                ));
                ?></div>

        </div>


        <div class="butt_submit">
            <?php echo $this->Form->submit('Update Amenities', array('class' => 'updateBox','div'=>false)); ?>

            <?php
            echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'updateBox updateBox2'));
            //  echo $this->Html->link($this->Html->image("btn-reset.gif"), array(), array('escape' => false, 'onclick'=>'document.UserAddForm.reset();return false;', 'div' => false));
            ?>


        </div>
    </div>

    <?php echo $this->Form->end();
    ?>
</div>
<script type="text/javascript">
    $(document).ready(function(){
         var FULL_BASE_URL = $('#hidden_site_baseurl').val();
        
                $('#group_id').change(function(){
                 var group_id = $(this).val();
                
                 var model = $('#model_name').val();
                 var dataString = 'group_id=' + group_id + '&model=' + model;
                 
                
                  $.ajax({
                     type: "POST",
                     data: dataString,
                      url: FULL_BASE_URL + '/all_functions/get_amenity_by_groupId',
                    
                   
                     success: function(return_data) {
                         //alert(return_data)
                       
                        $('#ajax').html(return_data);
                        $('#sec_mang').css('display','block');
                     }
                 });  
                 
             });
        });
                
  </script>

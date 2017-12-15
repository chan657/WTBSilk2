<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">Message</h4>
            </div>
            <div class="panel-body">
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><?php echo $this->Session->flash(); ?>
                </div>
                <div class="form_sep">                
                <?php 
                echo '<div class="col-sm-1">'.$this->Html->link('Details', array('controller' => '/','action' => $action), array('class' => 'btn btn-primary')).'</div>';
                echo '<div class="col-sm-1">'.$this->Html->link('Add', array('controller' => $controller,'action' => 'add'), array('class' => 'btn btn-success')).'</div>';
				
                ?>
                </div>
            </div>
        </div>
    </div>
</div>


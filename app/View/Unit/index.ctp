<div style="text-align:right"><?php echo $this->Html->link('Add Unit', array('controller' => 'unit', 'action' => 'add')); ?></div>

<h1>List of Project Units</h1>
<table>
    <tr>
        <th>Name</th>
		
    </tr>

    <?php foreach ($units as $unit): ?>
    <tr>
        <td>
            <?php echo $this->Html->link($unit['Unit']['unit_name'],
					array('controller' => 'unit', 'action' => 'edit', $unit['Unit']['id'])); ?>
        </td>
		
    </tr>
    <?php endforeach; ?>
    <?php unset($unit); ?>
</table>
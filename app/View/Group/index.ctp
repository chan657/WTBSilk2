<div style="text-align:right"><?php echo $this->Html->link('Add Group Of Amenities', array('controller' => 'group', 'action' => 'add')); ?></div>

<h1>List of Group Of Amenities</h1>
<table>
    <tr>
        <th>Name</th>
		
    </tr>

    <?php foreach ($groups as $group): ?>
    <tr>
        <td>
            <?php echo $this->Html->link($group['Group']['group_name'],
					array('controller' => 'group', 'action' => 'edit', $group['Group']['id'])); ?>
        </td>
		
    </tr>
    <?php endforeach; ?>
    <?php unset($group); ?>
</table>
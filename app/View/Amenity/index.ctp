<div style="text-align:right"><?php echo $this->Html->link('Add Amenities', array('controller' => 'amenity', 'action' => 'add')); ?></div>

<h1>List of Amenities</h1>
<table>
    <tr>
        <th>Name</th>
		<th>Group</th>
    </tr>

    <?php foreach ($amenities as $amenity): ?>
    <tr>
        <td>
            <?php echo $this->Html->link($amenity['Amenity']['amenity_name'],
					array('controller' => 'amenity', 'action' => 'edit', $amenity['Amenity']['id'])); ?>
        </td>
		<td>
			<?php echo $amenity['Group']['group_name']; ?>
		</td>
    </tr>
    <?php endforeach; ?>
    <?php unset($amenity); ?>
</table>
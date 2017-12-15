<!-- file path View/Suburb/get_by_city.ctp -->
<option value="">Select</option>
<?php foreach ($suburbs as $key => $value): ?>
<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
<?php endforeach; ?>
<?PHP 
App::import('Model', 'User');
$attr = new User();
?>
<p>MAPPING NAME: <?php echo $MappingName;?></p>
<p>SUPPLIER CODE: <?php echo $Supplier;?></p>
<p>COUNTRY: <?php echo $Country;?></p>
<p>CITY: <?php echo $City;?></p>
<p>HOTEL: <?php echo $Hotel;?></p>
<p>DESCRIPTION: <?php echo $Description;?></p>
<p>CREATED BY: <?php echo $attr->Username($CreatedBy);?></p>


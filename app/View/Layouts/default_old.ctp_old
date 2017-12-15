<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
		echo $this->Html->css('main');
		
		echo $this->Html->script('jquery-min');
		echo $this->Html->script('SpryAccordion');
		
		echo $this->Html->css('SpryAccordion');
		
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">

<div id="header-top">
  <div class="logo"><?php echo $this->Html->image('in-logo.png'); ?></div>
	 <div class="right"> 
		<div class="notice"> 
			<div id="redb">2</div>
		</div>
	 </div>
</div>

<div class="leftnavbg" style="width:198px;">
<div id="Accordion1" class="Accordion" tabindex="0">
	  <div class="AccordionPanel">
		<div class="AccordionPanelTab"><?php echo $this->Html->image('btn-user-management.gif'); ?></div>
		<div class="AccordionPanelContent">
		  <a href="#">My Users</a><br />
			Add User<br />
			User Authority
		
		</div>
	  </div>
	  <div class="AccordionPanel">
		<div class="AccordionPanelTab"><?php echo $this->Html->image('btn-cities.gif'); ?></div>
		<div class="AccordionPanelContent">
			<a href="/cakephp/admin/city/">Cities</a><br />
			<a href="/cakephp/admin/city/add/">Add City</a>
		</div>
	  </div>
	  <div class="AccordionPanel">
		<div class="AccordionPanelTab"><?php echo $this->Html->image('btn-channels.gif'); ?></div>
		<div class="AccordionPanelContent">
			<a href="/cakephp/admin/channel/">Channels</a><br />
			<a href="/cakephp/admin/channel/add/">Add Channel</a>
		</div>
	  </div>
	<div class="AccordionPanel">
		<div class="AccordionPanelTab"><?php echo $this->Html->image('btn-suburbs.gif'); ?></div>
		<div class="AccordionPanelContent">
			<a href="/cakephp/admin/suburb/">Suburbs</a><br />
			<a href="/cakephp/admin/suburb/add/">Add Suburb</a>
		</div>
	</div>
	<div class="AccordionPanel">
	  <div class="AccordionPanelTab"><?php echo $this->Html->image('btn-area.gif'); ?></div>
	  <div class="AccordionPanelContent">
	  		<a href="/cakephp/admin/area/">Areas</a><br />
			<a href="/cakephp/admin/area/add/">Add Area</a>
	</div>
	</div>
	<div class="AccordionPanel">
	  <div class="AccordionPanelTab"><?php echo $this->Html->image('btn-builder.gif'); ?></div>
	  <div class="AccordionPanelContent">
	  		<a href="/cakephp/admin/builder/">Builder</a><br />
			<a href="/cakephp/admin/builder/add/">Add Builder</a>
	</div>
	</div>
	<div class="AccordionPanel">
	  <div class="AccordionPanelTab"><?php echo $this->Html->image('btn-project.gif'); ?></div>
	  <div class="AccordionPanelContent">
	  		<a href="/cakephp/admin/project/">Projects</a><br />
			<a href="/cakephp/admin/project/add/">Add Project</a>
	</div>
	</div>

</div>
</div>

       


		
		
		<div id="content" style="float:right; width:80%;">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<!--<div id="footer">
			<?php echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
					'http://www.cakephp.org/',
					array('target' => '_blank', 'escape' => false)
				);
			?>
		</div>-->
	</div>
	<?php //echo $this->element('sql_dump'); ?>
	
	<script type="text/javascript">
		var Accordion1 = new Spry.Widget.Accordion("Accordion1");
	</script>
	
</body>
</html>

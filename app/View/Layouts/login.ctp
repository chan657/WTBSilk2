<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
		echo $this->Html->meta('favicon.ico','http://www.wtbone.com/app/webroot/img/favicon.ico',array('type' => 'icon'));

		//echo $this->Html->css('cake.generic');
		echo $this->Html->css(array('login'));
		
		
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body class="login_body">

<div id="logincontainer">
<div id="login-top"><?php echo $this->Html->image('beta.gif', array('alt' => 'Beta', 'title' => '', 'border' => '0','width'=>'54','height'=>'60')) ?></div> 
             
            <div class="blank"></div> 
            
            <div id="loginleft"><?php echo $this->Html->image('silkrouters-big-logo.png', array('alt' => 'Secure Site', 'title' => '', 'border' => '0','width'=>'346', 'height'=>'280' )) ?></div>
           
           
           <!--login main box -->
			<div id="loginright">
            	
               		<div class="mainloginbox">
                       <div class="login1"><?php echo $this->Html->image('login-top.png', array('alt' => '', 'title' => '', 'border' => '0','width'=>'311' ,'height'=>'57')) ?></div>
                       <div class="loginmiddle">
					   
					   <?php echo $this->fetch('content'); ?>
                       
                       
                     	</div>
                       <div class="loginbottom"><?php echo $this->Html->image('login-bottom.png', array('alt' => '', 'title' => '', 'border' => '0','width'=>'311', 'height'=>'26' )) ?></div>
                   </div> 
    </div>
            
        
 <!--  main container end-->       
</div> 
 <!--  main container end-->   

 	
	
	
 
 
  	
	</body>
	</html>
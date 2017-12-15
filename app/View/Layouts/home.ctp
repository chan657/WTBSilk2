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

            <?php echo $title_for_layout; ?>
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php
        echo $this->Html->meta('favicon.ico', 'http://www.silkrouters.com/demo/app/webroot/img/favicon.ico', array('type' => 'icon'));

        echo $this->Html->css(array('/bootstrap/css/bootstrap.min',
            'todc-bootstrap.min',
            'font-awesome/css/font-awesome.min',
            '/img/flags/flags',
            'retina',
            '/js/lib/jvectormap/jquery-jvectormap-1.2.2',
            '/js/lib/bootstrap-switch/stylesheets/bootstrap-switch',
            '/js/lib/bootstrap-switch/stylesheets/ebro_bootstrapSwitch',
            '/js/lib/FooTable/css/footable.core',
            'style',
                )
        );
        echo $this->Html->script(array('jquery.min',
            '/bootstrap/js/bootstrap.min',
            'jquery.ba-resize.min',
            'jquery_cookie.min',
            'retina.min',
            'tooltip',
            'tinynav',
            'pages/ebro_user_profile',
            'lib/magnific-popup/jquery.magnific-popup.min',
            'common',
            'lib/parsley/parsley.min',
            'pages/ebro_form_validate',
                )
        );
        //echo $this->Html->script('jquery.accordion');							


        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');

        $url = $this->here;
        $arr = explode("/", $url);
        $cur_page = $arr[1]; // live
        ?>

        <script>
            $(window).load(function() {
        <?php if ($mode == 1) { ?>
                    $('.user_form .editable p').hide();
                    $('.user_form .editable div').hide();
                    $('.edit_form').hide();
                    $('.view_form').show();
                    $('#mycl-det').addClass('view');
                    $('.user_form .editable .hidden_control,.user_form .form_submit').show();

<?php } ?>



            });
        </script>
        <link href='http://fonts.googleapis.com/css?family=Roboto:300,700&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>

    </head>
    <body class="boxed pattern_1">
        <div id="wrapper_all">

            <header id="top_header">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-6 col-sm-2 homelogo">
<?php
echo $this->Html->image('logonew.png', array('alt' => 'Logo', 'border' => '0'));
?>

                        </div>                       

                        <ul class="nav navbar-nav user-menu navbar-right" id="user-menu">

                            <li>
                            <?php echo $this->Html->link('<span class="username">' . $this->Html->image('user_profile.jpg', array('class' => 'user-avatar')) . $fname . ' ' . $lname . '</span>', array('controller' => 'users', 'action' => '#'), array('data-toggle' => 'dropdown', 'escape' => false)); ?>


                            </li>        

                            <li>
                            <?php
                            // echo $this->Html->link('<span aria-hidden="true" class="icon-user-md"></span>', array('controller' => 'users','action' => 'edit','slug' => $user['fname'].'-'.$user['mname'].'-'.$user['lname'],'id' => base64_encode($user['id']),array('class' => 'settings','escape' => false)));
                            // echo $this->Html->link('<span aria-hidden="true" class="icon-user-md"></span>', '/action-items', array('class' => 'settings','escape' => false));
                            ?>



                            </li>
                            <li>
<?php echo $this->Html->link('<span aria-hidden="true" class="icon icon-logout"></span>', '/users/logout', array('escape' => false, 'class' => 'settings')); ?>
                            <!--<a href="logout.php" class="settings"><span aria-hidden="true" class="icon icon-logout"></span></a>--></li>
                            <li class="menu-last">
                                <a href="#" class="settings dropdown-toggle" data-toggle="dropdown"><span class="icon-reorder icon"></span></a>
                                <div class="notification_dropdown">
                                    <ul class="dropdown-menu dropdown-menu-wide">
                                        <li>
                                            <!--<div class="dropdown_heading">Menu</div>-->
                                            <div class="dropdown_content">
                                                <ul class="dropdown_items">
                                                    <li> <?php echo $this->Html->link('<span aria-hidden="true" class="icon-off"></span> Logout', '/users/logout', array('escape' => false)); ?></li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>

                    </div>
                </div>
            </header>
            <nav id="mobile_navigation"></nav>
            <section class="container clearfix main_section">
                <div id="main_content_outer" class="clearfix">
                    <div id="main_content">


                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="page-header">

<?php
echo $this->Html->getCrumbs(' <i class="icon-double-angle-right"></i> ', array(
    'text' => '<span aria-hidden="true" class="icon icon-home"></span>',
    'class' => 'current',
    'url' => array('controller' => 'users', 'action' => 'home'),
    'escape' => false
));
?>

                                </h3>

                            </div>
                        </div>
                                    <?php //echo $this->Session->flash();  ?>
                                    <?php echo $this->fetch('content'); ?>
                    </div>
                </div>

                <nav id="sidebar">
                    <ul id="icon_nav_v" class="side_ico_nav">
                        <li class="nav-toggle"><button class="btn  btn-nav-toggle"><i class="fa toggle-left fa-angle-double-left" style="color:#eee;"></i> </button></li>
                        <li <?php if ($cur_page == 'users') { ?> class="active"<?php } ?>>   
                                    <?php
                                    echo $this->Html->link('<i class="icon-tasks"></i><span>My Profile</span>', '/users/home', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Profile', 'escape' => false));
                                    ?>          

                        </li>
                        <li <?php if ($cur_page == 'my-cities') { ?> class="active"<?php } ?>>   
                        <?php
                        echo $this->Html->link('<i class="icon-tasks"></i><span>My HR</span>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My HR', 'escape' => false));
                        ?>          

                        </li>
                        <li <?php if ($cur_page == 'my-cities') { ?> class="active"<?php } ?>>   
<?php
echo $this->Html->link('<i class="icon-tasks"></i><span>My Finance</span>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Finance', 'escape' => false));
?>          

                        </li>

                    </ul>
                </nav>
            </section> 
            <div id="footer_space"></div>            
        </div> <!-- wrapper_all -->
                            <?php //echo $this->element('footer'); ?>


    </body>
</html>
<header id="top_header">
    <div class="container"> 
        <div class="row">
            <div class="col-xs-6 col-sm-2">
            <?php
            if(isset($foreignMachineInterAction)){
                if($foreignMachineInterAction=='NO'){
                    $color='#ff0303';
                }else{
                    $color='#8BC34A';
                }
            }else{
                $color='#8BC34A';
            }
            ?>
            <div id="checkMark" style="position: absolute;width: 20px;height: 20px;color:<?php echo $color;?>;font-size: 15px;"> 
            <span class="glyphicon glyphicon-ok"></span>
            </div>
                <?php
                echo $this->Html->link(
                        $this->Html->image('logonew.png', array('alt' => 'Logo', 'border' => '0')), array('controller' => 'users', 'action' => 'dashboard'), array('escape' => false, 'class' => 'logo_main')
                );
                ?>

            </div>                       

            <ul class="nav navbar-nav user-menu navbar-right" id="user-menu">

                <li>
                    <?php echo $this->Html->link('<span class="username">' . $this->Html->image('user_profile.jpg', array('class' => 'user-avatar')) . strtoupper($fname) . ' ' . strtoupper($lname) . '</span>', array('controller' => 'users', 'action' => 'dashboard'), array('data-toggle' => 'dropdown', 'escape' => false)); ?>

                    <ul class="dropdown-menu">          

                        <li>
                            <?php echo $this->Html->link('<span aria-hidden="true" class="icon icon-logout"></span>', '/users/logout', array('escape' => false)); ?>
                        </li>
                    </ul>
                </li>        
                <li>



                    <a href="#" class="settings dropdown-toggle" data-toggle="dropdown"><span aria-hidden="true" class="icon icon-envelope"><span class="badge cart bg-success">0</span></span></a>
                    <div class="notification_dropdown">
                        <ul class="dropdown-menu dropdown-menu-wide">
                            <li>
                                <div class="dropdown_heading">Messages</div>
                                <div class="dropdown_content">
                                    <ul class="dropdown_items">
                                        <li>
                                            <h3><a href="#">Lorem ipsum dolor sit amet</a></h3>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing.</p>
                                            <p class="large_info">Sean Walter, 24.05.2014</p>
                                            <i class="icon-exclamation-sign indicator"></i>
                                        </li>
                                        <li>
                                            <h3><a href="#">Lorem ipsum dolor&hellip;</a></h3>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi aliquam assumenda&hellip;</p>
                                            <p class="large_info">Sean Walter, 24.05.2014</p>
                                        </li>
                                        <li>
                                            <h3><a href="#">Lorem ipsum dolor&hellip;</a></h3>
                                            <p>Lorem ipsum dolor sit amet, consectetur&hellip;</p>
                                            <p class="large_info">Sean Walter, 24.05.2014</p>
                                            <i class="icon-exclamation-sign indicator"></i>
                                        </li>
                                    </ul>
                                </div>
                                <div class="dropdown_footer">
                                    <a href="#" class="btn btn-sm btn-default">Show all</a>
                                    <div class="pull-right dropdown_actions">
                                        <a href="#"><i class="icon-refresh"></i></a>
                                        <a href="#"><i class="icon-cog"></i></a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                </li>
                <li>
                    <?php
                    echo $this->Html->link('<span aria-hidden="true" class="icon icon-calendar"><span class="badge cart bg-success">' . $count_events . '</span></span>', '/events', array('class' => 'settings', 'escape' => false));
                    ?>
                </li>
                <li>
                    <?php
                    if($industry == '1')
                        echo $this->Html->link('<span aria-hidden="true" class="icon icon-bell"><span class="badge cart bg-success">' . $count_action . '</span></span>', '/action-items', array('class' => 'settings', 'escape' => false));
                    elseif ($industry == '2') {
                        echo $this->Html->link('<span aria-hidden="true" class="icon icon-bell"><span class="badge cart bg-success">'.$travel_count_action.'</span></span>', '/travel_action_items', array('class' => 'settings', 'escape' => false));
                    }
                    elseif ($industry == '5') {
                        echo $this->Html->link('<span aria-hidden="true" class="icon icon-bell"><span class="badge cart bg-success">'.$dig_count_action.'</span></span>', '/dig_action_items', array('class' => 'settings', 'escape' => false));
                    }
                    ?>



                </li>
                <li>
                    <?php
                     echo $this->Html->link('<span aria-hidden="true" class="icon icon-bell"><span class="badge cart bg-success">'.$ticket_count.'</span></span>', '/support_tickets',array('class' => 'settings','escape' => false));
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
                                        <li><?php
echo $this->Html->link('<span aria-hidden="true" class="icon icon-bell"></span> My Messages', '#', array('class' => 'settings', 'escape' => false));
?></li>
                                        <li>
                                            <?php
                                            echo $this->Html->link('<span aria-hidden="true" class="icon icon-calendar"> My Events</span>', '/events', array('class' => 'settings', 'escape' => false));
                                            ?>
                                        </li>
                                        <li><?php
                                            echo $this->Html->link('<span aria-hidden="true" class="icon icon-bell"></span> My Actions', '/action-items', array('class' => 'settings', 'escape' => false));
                                            ?></li>
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

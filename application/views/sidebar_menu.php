<?php
$userData = getUserSessionData();
?>
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">              
        <ul class="nav side-menu">

            <!-- <li><a href="<?php echo base_url(); ?>home/dashboard"><i class="fa fa-home"></i> Home</a></li>-->
            <?php if (in_array("AD", $userData['roles']) || in_array("MA", $userData['roles'])) { ?>
                <li><a href="<?php echo base_url(); ?>rooms/showrooms"><i class="fa fa-building-o"></i> Halls / Classes</a></li>
            <?php } ?>
                    <li><a href="<?php echo base_url(); ?>reserve/book"><i class="fa fa-edit"></i> Reservations </a> </li>
            <?php if (in_array("AD", $userData['roles'])) { ?>
                    <li><a href="<?php echo base_url(); ?>users/showusers"><i class="fa fa-user"></i> Manage Users <!--<span class="fa fa-chevron-down"></span> --> </a> 
                <?php } ?>  
                <!--<ul class="nav child_menu">
                  <li><a href="form.html">Admin</a></li>
                  <li><a href="<?php echo base_url(); ?>users/showusers">Faculty Member</a></li>
                </ul> -->
            </li>
        </ul>
    </div>
</div>
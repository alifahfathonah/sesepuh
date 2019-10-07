 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

     <!-- Sidebar - Brand -->
     <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
         <div class="sidebar-brand-icon rotate-n-15">
             <i class="fas fa-home"></i>
         </div>
         <div class="sidebar-brand-text mx-3">SESEPUH ID</div>
     </a>

     <!-- Divider -->
     <hr class="sidebar-divider">
     <!-- Query menu -->
     <?php
        $role_id = $this->session->userdata('role_id');
        $queryMenu = "SELECT `M`.`id`, `menu` 
                        FROM `tbl_user_menu` AS M JOIN `tbl_user_access_menu` AS AM
                        ON `M`.`id` = `AM`.`menu_id`
                        WHERE `AM`.`role_id` = $role_id AND `M`.`id` != 2 
                        ORDER BY `AM`.`menu_id` ASC
                    ";
        $menu = $this->db->query($queryMenu)->result_array();
        ?>

     <!-- LOOPING MENU -->
     <?php foreach ($menu as $m) { ?>
         <div class="sidebar-heading">
             <?= $m['menu']; ?>
         </div>

         <?php
                $menuId = $m['id'];
                $querySubMenu = "SELECT * 
                                FROM `tbl_user_sub_menu`AS SB JOIN `tbl_user_menu` AS UM
                                ON `SB`.menu_id = `UM`.`id`
                                WHERE `SB`.`menu_id` = $menuId
                                AND `SB`.`is_active` = 1
                            ";
                $submenu = $this->db->query($querySubMenu)->result_array();
                ?>
         <?php foreach ($submenu as $sm) { ?>

             <?php if ($title == $sm['title']) { ?>
                 <li class="nav-item active">
                 <?php } else { ?>
                 <li class="nav-item">
                 <?php  } ?>
                 <a class="nav-link pb-0" href="<?= base_url($sm['url']) ?>">
                     <i class="<?= $sm['icon'] ?>"></i>
                     <span><?= $sm['title'] ?></span></a>
                 </li>

             <?php } ?>
             <hr class="sidebar-divider mt-3">

         <?php } ?>
         <li class="nav-item">
             <a class="nav-link pb-0" href="<?= base_url('auth/logout') ?>">
                 <i class="fas fa-fw fa-sign-out-alt"></i>
                 <span>Logout</span></a>
         </li>
         <!-- Divider -->
         <hr class="sidebar-divider mt-3">

         <!-- Sidebar Toggler (Sidebar) -->
         <div class="text-center d-none d-md-inline">
             <button class="rounded-circle border-0" id="sidebarToggle"></button>
         </div>

 </ul>
 <!-- End of Sidebar -->
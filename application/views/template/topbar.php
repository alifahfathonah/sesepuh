<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $user['name']; ?></span>
                        <img class="img-profile rounded-circle" src="<?= base_url('assets/img/profile/') . $user['image']; ?>">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class=" dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <?php
                        $role_id = $this->session->userdata('role_id');
                        $queryMenu = "SELECT `M`.`id`, `menu` 
                            FROM `tbl_user_menu` AS M JOIN `tbl_user_access_menu` AS AM
                            ON `M`.`id` = `AM`.`menu_id`
                            WHERE `AM`.`role_id` = $role_id AND `M`.`id` = 2 
                            ORDER BY `AM`.`menu_id` ASC
                        ";
                        $menu = $this->db->query($queryMenu)->row();
                        // $menuId = $menu->id;

                        if (!empty($menu)) {
                            $querySubMenu = "SELECT * 
                                                FROM `tbl_user_sub_menu`AS SB JOIN `tbl_user_menu` AS UM
                                                ON `SB`.menu_id = `UM`.`id`
                                                WHERE `SB`.`menu_id` = $menu->id
                                                AND `SB`.`is_active` = 1
                                            ";
                            $submenu = $this->db->query($querySubMenu)->result_array();
                            foreach ($submenu as $sm) { ?>


                                <a class="dropdown-item" href="<?= base_url($sm['url']) ?>">
                                    <i class="fas <?= $sm['icon'] ?> fa-sm fa-fw mr-2 text-gray-400"></i>
                                    <?= $sm['title']; ?>
                                </a>
                                <div class="dropdown-divider"></div>
                                <!-- <a class="dropdown-item" href="<?= base_url('user/edit') ?>">
                                    <i class="fas fa-user-edit fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Edit Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= base_url('user/changepassword') ?>">
                                    <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Change Password
                                </a>
                                <div class="dropdown-divider"></div> -->
                        <?php }
                        } ?>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->
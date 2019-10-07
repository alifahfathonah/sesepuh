<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    public function getSubMenu()
    {
        $query = "SELECT `SM`.*, `M`.`menu`
                FROM `tbl_user_sub_menu` AS `SM`
                JOIN `tbl_user_menu` AS `M` ON `SM`.`menu_id` = `M`.`id` ";
        return $this->db->query($query)->result_array();
    }
}

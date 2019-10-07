<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }


    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('template/footer');
    }


    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get('tbl_user_role')->result_array();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('template/footer');
    }


    public function roleAccess($role_id)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get_where('tbl_user_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('tbl_user_menu')->result_array();


        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('template/footer');
    }

    public function changeaccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('tbl_user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('tbl_user_access_menu', $data);
        } else {
            $this->db->delete('tbl_user_access_menu', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Access Changed! </div>');
    }

    function telegram($msg = null, $telegram_id = null)
    {

        $msg = "\xF0\x9F\x93\x96<b> Sesepuh (Sehari Sepuluh) </b>\xF0\x9F\x93\x96 \n";
        $msg .= "\xE2\x98\x80" . date('d F Y') . "\xE2\x98\x80 \n\n";
        $msg .= "<b> 'Quotes harian' By MS </b>\n\n";
        // for ($i = 0; $i < 3; $i++) {
        $msg .= "\x23\xE2\x83\xA3 01 \xF0\x9F\x86\x94 S01 Furqon \xE2\x9A\xAA \n";
        // # code...
        // }
        $msg .= "\x23\xE2\x83\xA3 02 \xF0\x9F\x86\x94 S02 Fadly \xF0\x9F\x94\xB4 \n";
        $msg .= "\x23\xE2\x83\xA3 03 \xF0\x9F\x86\x94 S04 Heru \xF0\x9F\x94\xB5 \n\n\n";

        $msg .= "\xC2\xAE EKAP : \xF0\x9F\x93\x9D \n";
        $msg .= "\xF0\x9F\x95\x9B \x30\xE2\x83\xA3 \x30\xE2\x83\xA3 s/d \x32\xE2\x83\xA3 \x32\xE2\x83\xA3 \n";
        $telegrambot = '910315548:AAFGD3BDxaKxvUhGZvFd1YdXZj5xmh85iYk';
        $telegram_id = -312083762;
        // $telegram_id = 384920975;
        //Markdown
        $url = 'https://api.telegram.org/bot' . $telegrambot . '/sendMessage';
        $data = array('chat_id' => $telegram_id, 'text' => $msg, 'parse_mode' => 'HTML');
        $options = array('http' => array('method' => 'POST', 'header' => "Content-Type:application/x-www-form-urlencoded\r\n", 'content' => http_build_query($data),),);

        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        redirect('admin');
    }
}

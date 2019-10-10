<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }
    public function index()
    {
        $data['title'] = 'List';
        $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->db->get('tbl_user_menu')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {
            $this->db->Select('A.id, A.name, A.email, A.is_active, A.date_created, B.role ');
            $this->db->from('tbl_user AS A');
            $this->db->join('tbl_user_role AS B', 'A.role_id = B.id');
            $data['member'] = $this->db->get()->result_array();
            $data['role'] = $this->db->get('tbl_user_role')->result_array();

            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('member/list-member', $data);
            $this->load->view('template/footer');
        } else {
            $this->db->insert('tbl_user_menu', ['menu' => $this->input->post('menu')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu new added!</div>');
            redirect('member');
        }
    }

    public function editMember($id)
    {
        $data = $this->db->get_where('tbl_user', ['id' => $id])->row_array();
        echo json_encode($data);
    }
    public function update()
    {
        $data = [
            'name' => $this->input->post('name'),
            'role_id' => $this->input->post('role')
        ];

        if ($this->db->update('tbl_user', $data, ['email' => $this->input->post('email')])) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Member updated!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Member failed update!</div>');
        }

        redirect('member');
    }

    public function delete($id)
    {
        if ($this->db->delete('tbl_user', ['id' => $id])) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Member deleted!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Member failed delete!</div>');
        }
        redirect('member');
    }


    function telegram($msg = null, $telegram_id = null)
    {
        $_id = $this->input->post('id[]');
        $_name = $this->input->post('name[]');
        $_check = $this->input->post('check[]');

        $quotes = $this->input->post('quotes');
        $by_ = $this->input->post('by_');

        if ($quotes && $by_) {
            $_quotes = "'" . $quotes . "' " . $by_;
        } else {
            $_quotes = "'Membaca sebab itu ada pintu ilmu'   by M.S";
        }

        $msg = "\xF0\x9F\x93\x96<b> Sesepuh (Sehari Sepuluh) </b>\xF0\x9F\x93\x96 \n";
        $msg .= "\xE2\x98\x80" . date('d F Y') . "\xE2\x98\x80 \n\n";
        // pena \xE2\x9C\x92
        // buku \xF0\x9F\x93\x9A
        $msg .= "\xE3\x80\xB0\xE3\x80\xB0\xE3\x80\xB0 \xE2\x9C\x92	\xF0\x9F\x93\x9A \xE2\x9C\x92 \xE3\x80\xB0\xE3\x80\xB0\xE3\x80\xB0\xE3\x80\xB0 \n\n";

        $msg .= "<b>" . $_quotes . "</b>\n\n";

        $no = 1;
        for ($i = 0; $i < count($_id); $i++) {
            if ($_check[$i] == 1) {
                $status = "\xF0\x9F\x94\xB5";
            } else if ($_check[$i] == 2) {
                $status = "\xF0\x9F\x94\xB4";
            } else if ($_check[$i] == 3) {
                $status = "\xF0\x9F\x9A\xB7";
            } else {
                $status = "\xE2\x9A\xAA";
            }

            $id = $_id[$i];
            $nama = $_name[$i];
            $msg .= "\x23\xE2\x83\xA3 " . $no++ . " \xF0\x9F\x86\x94 S0" . $id . " " . $nama . " " . $status . "\n";
        }


        $msg .= "\n \xC2\xAE EKAP : \xF0\x9F\x93\x9D \n";
        $msg .= "\xF0\x9F\x95\x9B \x30\xE2\x83\xA3 \x30\xE2\x83\xA3 s/d \x32\xE2\x83\xA3 \x32\xE2\x83\xA3 \n\n";
        $msg .= "\xE3\x80\xB0\xE3\x80\xB0\xE3\x80\xB0\xE3\x80\xB0\xE3\x80\xB0\xE3\x80\xB0\xE3\x80\xB0\xE3\x80\xB0 \n";
        $msg .= "<b>NOTE :</b> \n";
        $msg .= "\xE2\x96\xAA Format Laporan \n";
        $msg .= "\xE2\x9C\x85 ID Judul Buku (jumlah halaman yang dibaca) \n";
        $msg .= "\xE2\x96\xAA Contoh : \n";
        $msg .= "\xE2\x9C\x85 S04 Bahagia Merayakan Cinta (50) \n\n";
        $msg .= "Keterangan : \n";
        $msg .= "\x23\xE2\x83\xA3 : Peringkat Grup \n";
        $msg .= "\xF0\x9F\x86\x94 : ID Sesepuh \n";
        $msg .= "\xE2\x9C\x85 : Sudah lapor \n";
        $msg .= "\xE2\x9A\xAA : Belum lapor hari ini \n";
        $msg .= "\xF0\x9F\x94\xB5 : Belum lapor 2 hari \n";
        $msg .= "\xF0\x9F\x94\xB4 : Belum lapor 3 hari \n";
        $msg .= "\xF0\x9F\x9A\xB7 : Hapus dari list grup \n\n";
        $msg .= "<b>PERHATIAN !!!</b> \n";
        $msg .= "1. Buku yang dilaporkan cukup satu buku, boleh buku yang sama atau berbeda setiap harinya. \n";
        $msg .= "2. Jika target pembacaan sudah memenuhi/melebihi batas minimal pembacaan yakni 10 halaman/hari, boleh langsung dilaporkan. \n";
        $msg .= "3. Jika sudah laporan, namun memiliki targetan baca yang lain, tetep dilanjutkan bacanya tapi tidak dilaporkan. \n";

        // print_r($msg);
        // die;
        $telegrambot = '910315548:AAFGD3BDxaKxvUhGZvFd1YdXZj5xmh85iYk';
        $telegram_id = -312083762;
        // $telegram_id = 384920975;
        //Markdown
        $url = 'https://api.telegram.org/bot' . $telegrambot . '/sendMessage';
        $data = array('chat_id' => $telegram_id, 'text' => $msg, 'parse_mode' => 'HTML');
        $options = array('http' => array('method' => 'POST', 'header' => "Content-Type:application/x-www-form-urlencoded\r\n", 'content' => http_build_query($data),),);

        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        redirect('member');
    }

    public function createForm()
    {
        $data['title'] = 'List';
        $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->db->get('tbl_user_menu')->result_array();

        $this->db->Select('*');
        $this->db->from('tbl_user ');
        $data['member'] = $this->db->get()->result_array();
        $data['role'] = $this->db->get('tbl_user_role')->result_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('member/create-form', $data);
        $this->load->view('template/footer');
    }
}
// $_hadir = "\xE2\x9A\xAA";
        // $_absen1 = "\xF0\x9F\x94\xB5";
        // $_absen2 = "\xF0\x9F\x94\xB4";
        // $_absen3 = "\xF0\x9F\x9A\xB7";

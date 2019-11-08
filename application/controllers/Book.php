<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Book extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }
    public function index()
    {
        $data['title'] = 'List Buku';
        $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->db->get('tbl_user_menu')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {
            $this->db->Select('*');
            $this->db->from('tbl_user_book');
            $this->db->where('user_id', $this->session->userdata('id'));
            $data['book'] = $this->db->get()->result_array();

            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('book/list-book', $data);
            $this->load->view('template/footer');
        } else {
            $this->db->insert('tbl_user_menu', ['menu' => $this->input->post('menu')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu new added!</div>');
            redirect('book');
        }
    }

    public function add()
    {
        $data = [
            'date_created' => time(),
            'date_buy' => $this->input->post('date_buy'),
            'author' => $this->input->post('author'),
            'title' => $this->input->post('title'),
            'publisher' => $this->input->post('publisher'),
            'years' => $this->input->post('years'),
            'isbn' => $this->input->post('isbn'),
            'qty' => $this->input->post('qty'),
            'descrip' => $this->input->post('descrip'),
            'user_id' =>  $this->session->userdata('id')
        ];

        if ($this->db->insert('tbl_user_book', $data)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menambahkan buku baru</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Buku baru gagal ditambahkan!</div>');
        }
        redirect('book');
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
}

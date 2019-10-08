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
            redirect('menu');
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
}

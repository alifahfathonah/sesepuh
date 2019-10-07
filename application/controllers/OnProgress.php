<?php
defined('BASEPATH') or exit('No direct script access allowed');

class OnProgress extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        // $data['view'] = $this->load->view('home/home');
        $this->load->view('template/header');
        $this->load->view('404');
        $this->load->view('template/footer');
    }
}

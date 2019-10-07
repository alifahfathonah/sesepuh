<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }


    public function index()
    {
        // $data['view'] = $this->load->view('home/home');
        $data['data'] = $this->db->query('SELECT * FROM tbl_transaksi where tgl_transaksi BETWEEN "2019-07-01" AND "2019-07-30"  ORDER BY tgl_transaksi ASC ')->result();
        $data['yudi'] = $this->db->query('SELECT jumlah, tgl_transaksi as tanggal FROM tbl_transaksi where (tgl_transaksi BETWEEN "2019-07-01" AND "2019-07-30") AND user_id = 2  ORDER BY tgl_transaksi ASC ')->result();
        // print_r($data['yudi']);
        $data['name'] = $this->db->query('SELECT user_id, sum(jumlah) AS total FROM tbl_transaksi where tgl_transaksi BETWEEN "2019-07-01" AND "2019-07-30" GROUP BY user_id ORDER BY tgl_transaksi ASC ')->result();

        // log_message()
        $this->load->view('template/header');
        $this->load->view('report/form_report', $data);
        $this->load->view('template/footer');
    }

    public function save_report()
    {
        $data = array(
            'user_id' => $this->input->post('kode'),
            'tgl_transaksi' => $this->input->post('tgl_transaksi'),
            'jumlah' => $this->input->post('jumlah')
        );
        $this->db->insert('tbl_transaksi', $data);
        redirect(base_url('Report'));
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keuangan extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('login') <> 1) {
            redirect(base_url('auth'));
        }
        $this->load->model('Keuangan_model');
    }
    public function index()
    {
        if ($this->session->userdata('jabatan') <> 'Keuangan') {
            redirect(base_url('tidakadaakses'));
        }
        $data = array(
            'lihatiptgl' => $this->Keuangan_model->lihatiptgl($this->session->userdata('id_pabrik')),
            'lihatqcbayar' => $this->Keuangan_model->lihatqcbayar()
        );
        $this->load->view('keuangan/index.php', $data);
    }

    public function bayar()
    {

        $status = 'Sudah Dibayar';
        $data = array(
            'status' => $status,
            'tgl_bayar' => $this->session->userdata('tgl')
        );
        $this->Keuangan_model->update($this->input->post('id', TRUE), $data);
        $this->session->set_flashdata('message', 'Update Record Success');
        redirect(base_url('keuangan'));
    }
    public function search()
    {
        $keyword = $this->input->post('keyword');
        $id_pabrik = $this->session->userdata('id_pabrik');
        $data = array(
            'qc' => $this->Keuangan_model->get_qc_keyword($keyword, $id_pabrik)
        );
        $this->load->view('keuangan/search.php', $data);
    }
}

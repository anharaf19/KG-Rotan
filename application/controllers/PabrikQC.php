<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PabrikQC extends CI_Controller
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
        $this->load->model('Pabrikqc_model');
        $this->load->library('form_validation');
    }
    public function index()
    {
        if ($this->session->userdata('jabatan') <> 'Pabrik') {
            redirect(base_url('tidakadaakses'));
        }
        $id_pabrik = $this->session->userdata('id_pabrik');
        $data = array(
            'lihatspk2' => $this->Pabrikqc_model->lihatspk2($id_pabrik)
        );
        $this->load->view('pabrikqc/index.php', $data);
    }
    public function addqty($id)
    {
        $rows = $this->Pabrikqc_model->lihatspkperid($id);
        $dataw = array(
            'id' => set_value('id', $rows->id),
            'no_item' => set_value('no_item', $rows->no_item),
            'no_spk' => set_value('no_spk', $rows->no_spk),
            'id_penyimpanan' => set_value('id_penyimpanan', $rows->id_penyimpanan)
        );

        $this->load->view('pabrikqc/formqc', $dataw);
    }
    function add()
    {
        $id_detail_spk = $this->input->post('id_detail_spk');
        $no_item = $this->input->post('no_item');
        $no_spk = $this->input->post('no_spk');
        $tgl_masuk = $this->input->post('tgl_masuk');
        $qty = $this->input->post('qty');
        $id_pabrik = $this->session->userdata('id_pabrik');
        $data = array(
            'id_detail_spk' => $id_detail_spk,
            'id_pabrik' => $id_pabrik,
            'no_item' => $no_item,
            'no_spk' => $no_spk,
            'tgl_masuk' => $tgl_masuk,
            'qty' => $qty,
            'status' => 'belum dibayar'

        );
        $this->Pabrikqc_model->input_data($data, 'qc');
        redirect('pabrikqc');
    }
    function edit($id)
    {
        $where = array('id' => $id);

        $data['user'] = $this->m_data->edit_data($where, 'user')->result();

        $this->load->view('v_edit', $data);
    }
    public function search()
    {
        $keyword = $this->input->post('keyword');
        $id_pabrik = $this->session->userdata('id_pabrik');
        $data = array(
            'detail_spk' => $this->Pabrikqc_model->get_detailspk_keyword($keyword, $id_pabrik)
        );
        $this->load->view('pabrikqc/search.php', $data);
    }
}

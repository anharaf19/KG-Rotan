<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ambil_bahan extends CI_Controller
{
    function __construct()
    {

        parent::__construct();
        if ($this->session->userdata('login') <> 1) {
            redirect(base_url('auth'));
        }
        $this->load->model('Ambil_bahan_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        $jabatan = $this->session->userdata('jabatan');
        if ($jabatan == 'SuperAdmin' || $jabatan == 'Bahan') {
            $this->load->view('ambil_bahan/ambil_bahan_list');
        } else {
            redirect(base_url('tidakadaakses'));
        }
    }

    public function json()
    {
        header('Content-Type: application/json');
        $jabatan = $this->session->userdata('jabatan');
        if ($jabatan == 'SuperAdmin') {
            echo $this->Ambil_bahan_model->jsonIsAdmin();
        } else {
            echo $this->Ambil_bahan_model->json();
        }
    }

    public function read($id)
    {
        $row = $this->Ambil_bahan_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'id_detail_spk' => $row->id_detail_spk,
                'id_bahan_rendam' => $row->id_bahan_rendam,
                'tgl_keluar' => $row->tgl_keluar,
                'kg' => $row->kg,
                'ball' => $row->ball,
                'nama_sopir' => $row->nama_sopir,
            );
            $this->load->view('ambil_bahan/ambil_bahan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('ambil_bahan'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('ambil_bahan/create_action'),
            'id' => set_value('id'),
            'id_detail_spk' => set_value('id_detail_spk'),
            'id_bahan_rendam' => set_value('id_bahan_rendam'),
            'tgl_keluar' => set_value('tgl_keluar'),
            'kg' => set_value('kg'),
            'ball' => set_value('ball'),
            'nama_sopir' => set_value('nama_sopir'),
            'lihatkolam' => $this->Ambil_bahan_model->lihatkolam(),
            'lihatnospk' => $this->Ambil_bahan_model->lihatnospk()
        );
        $this->load->view('ambil_bahan/ambil_bahan_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'id_detail_spk' => $this->input->post('id_detail_spk', TRUE),
                'id_bahan_rendam' => $this->input->post('id_bahan_rendam', TRUE),
                'tgl_keluar' => $this->input->post('tgl_keluar', TRUE),
                'kg' => $this->input->post('kg', TRUE),
                'ball' => $this->input->post('ball', TRUE),
                'nama_sopir' => $this->input->post('nama_sopir', TRUE),
            );

            $this->Ambil_bahan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('ambil_bahan'));
        }
    }

    public function update($id)
    {
        $row = $this->Ambil_bahan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('ambil_bahan/update_action'),
                'id' => set_value('id', $row->id),
                'id_detail_spk' => set_value('id_detail_spk', $row->id_detail_spk),
                'id_bahan_rendam' => set_value('id_bahan_rendam', $row->id_bahan_rendam),
                'tgl_keluar' => set_value('tgl_keluar', $row->tgl_keluar),
                'kg' => set_value('kg', $row->kg),
                'ball' => set_value('ball', $row->ball),
                'nama_sopir' => set_value('nama_sopir', $row->nama_sopir),
                'lihatkolam' => $this->Ambil_bahan_model->lihatkolam(),
                'lihatnospk' => $this->Ambil_bahan_model->lihatnospk()
            );
            $this->load->view('ambil_bahan/ambil_bahan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('ambil_bahan'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'id_detail_spk' => $this->input->post('id_detail_spk', TRUE),
                'id_bahan_rendam' => $this->input->post('id_bahan_rendam', TRUE),
                'tgl_keluar' => $this->input->post('tgl_keluar', TRUE),
                'kg' => $this->input->post('kg', TRUE),
                'ball' => $this->input->post('ball', TRUE),
                'nama_sopir' => $this->input->post('nama_sopir', TRUE),
            );

            $this->Ambil_bahan_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('ambil_bahan'));
        }
    }

    public function delete($id)
    {
        $row = $this->Ambil_bahan_model->get_by_id($id);

        if ($row) {
            $this->Ambil_bahan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('ambil_bahan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('ambil_bahan'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('id_detail_spk', 'id detail spk', 'trim|required');
        $this->form_validation->set_rules('id_bahan_rendam', 'id bahan rendam', 'trim|required');
        $this->form_validation->set_rules('tgl_keluar', 'tgl keluar', 'trim|required');
        $this->form_validation->set_rules('kg', 'kg', 'trim|required');
        $this->form_validation->set_rules('ball', 'ball', 'trim|required');
        $this->form_validation->set_rules('nama_sopir', 'nama sopir', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "ambil_bahan.xls";
        $judul = "ambil_bahan";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
        xlsWriteLabel($tablehead, $kolomhead++, "Id Detail Spk");
        xlsWriteLabel($tablehead, $kolomhead++, "Id Bahan Rendam");
        xlsWriteLabel($tablehead, $kolomhead++, "Tgl Keluar");
        xlsWriteLabel($tablehead, $kolomhead++, "Kg");
        xlsWriteLabel($tablehead, $kolomhead++, "Ball");
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Sopir");

        foreach ($this->Ambil_bahan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteNumber($tablebody, $kolombody++, $data->id_detail_spk);
            xlsWriteNumber($tablebody, $kolombody++, $data->id_bahan_rendam);
            xlsWriteLabel($tablebody, $kolombody++, $data->tgl_keluar);
            xlsWriteNumber($tablebody, $kolombody++, $data->kg);
            xlsWriteNumber($tablebody, $kolombody++, $data->ball);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama_sopir);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }
}

/* End of file Ambil_bahan.php */
/* Location: ./application/controllers/Ambil_bahan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-04-22 13:29:42 */
/* http://harviacode.com */
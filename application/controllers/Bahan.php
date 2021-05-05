<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bahan extends CI_Controller
{
    function __construct()
    {

        parent::__construct();
        if ($this->session->userdata('login') <> 1) {
            redirect(base_url('auth'));
        }
        $this->load->model('Bahan_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        $jabatan = $this->session->userdata('jabatan');
        if ($jabatan == 'SuperAdmin' || $jabatan == 'Bahan') {
            $this->load->view('bahan/bahan_list');
        } else {
            redirect(base_url('tidakadaakses'));
        }
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Bahan_model->json();
    }

    public function read($id)
    {
        $row = $this->Bahan_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'nama' => $row->nama,
                'total_kg' => $row->total_kg,
                'total_ball' => $row->total_ball,
                'ket' => $row->ket,
            );
            $this->load->view('bahan/bahan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('bahan'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('bahan/create_action'),
            'id' => set_value('id'),
            'nama' => set_value('nama'),
            'total_kg' => set_value('total_kg'),
            'total_ball' => set_value('total_ball'),
            'ket' => set_value('ket'),
        );
        $this->load->view('bahan/bahan_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'nama' => $this->input->post('nama', TRUE),
                'total_kg' => $this->input->post('total_kg', TRUE),
                'total_ball' => $this->input->post('total_ball', TRUE),
                'ket' => $this->input->post('ket', TRUE),
            );

            $this->Bahan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('bahan'));
        }
    }

    public function update($id)
    {
        $row = $this->Bahan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('bahan/update_action'),
                'id' => set_value('id', $row->id),
                'nama' => set_value('nama', $row->nama),
                'total_kg' => set_value('total_kg', $row->total_kg),
                'total_ball' => set_value('total_ball', $row->total_ball),
                'ket' => set_value('ket', $row->ket),
            );
            $this->load->view('bahan/bahan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('bahan'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'nama' => $this->input->post('nama', TRUE),
                'total_kg' => $this->input->post('total_kg', TRUE),
                'total_ball' => $this->input->post('total_ball', TRUE),
                'ket' => $this->input->post('ket', TRUE),
            );

            $this->Bahan_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('bahan'));
        }
    }

    public function delete($id)
    {
        $row = $this->Bahan_model->get_by_id($id);

        if ($row) {
            $this->Bahan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('bahan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('bahan'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_rules('total_kg', 'total kg', 'trim|required');
        $this->form_validation->set_rules('total_ball', 'total ball', 'trim|required');
        $this->form_validation->set_rules('ket', 'ket', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "bahan.xls";
        $judul = "bahan";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Nama");
        xlsWriteLabel($tablehead, $kolomhead++, "Total Kg");
        xlsWriteLabel($tablehead, $kolomhead++, "Total Ball");
        xlsWriteLabel($tablehead, $kolomhead++, "Ket");

        foreach ($this->Bahan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama);
            xlsWriteNumber($tablebody, $kolombody++, $data->total_kg);
            xlsWriteNumber($tablebody, $kolombody++, $data->total_ball);
            xlsWriteLabel($tablebody, $kolombody++, $data->ket);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }
}

/* End of file Bahan.php */
/* Location: ./application/controllers/Bahan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-04-22 13:29:43 */
/* http://harviacode.com */
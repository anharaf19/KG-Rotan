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
        if ($this->session->userdata('jabatan') <> 'SuperAdmin') {
            redirect(base_url('tidakadaakses'));
        }
        $this->load->view('bahan/bahan_list');
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
                'jenis' => $row->jenis,
                'total_kg' => $row->total_kg,
                'total_ball' => $row->total_ball,
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
            'jenis' => set_value('jenis'),
            'total_kg' => set_value('total_kg'),
            'total_ball' => set_value('total_ball'),
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
                'jenis' => $this->input->post('jenis', TRUE),
                'total_kg' => $this->input->post('total_kg', TRUE),
                'total_ball' => $this->input->post('total_ball', TRUE),
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
                'jenis' => set_value('jenis', $row->jenis),
                'total_kg' => set_value('total_kg', $row->total_kg),
                'total_ball' => set_value('total_ball', $row->total_ball),
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
                'jenis' => $this->input->post('jenis', TRUE),
                'total_kg' => $this->input->post('total_kg', TRUE),
                'total_ball' => $this->input->post('total_ball', TRUE),
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
        $this->form_validation->set_rules('jenis', 'jenis', 'trim|required');
        $this->form_validation->set_rules('total_kg', 'total kg', 'trim|required');
        $this->form_validation->set_rules('total_ball', 'total ball', 'trim|required');

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
        xlsWriteLabel($tablehead, $kolomhead++, "Jenis");
        xlsWriteLabel($tablehead, $kolomhead++, "Total Kg");
        xlsWriteLabel($tablehead, $kolomhead++, "Total Ball");

        foreach ($this->Bahan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama);
            xlsWriteLabel($tablebody, $kolombody++, $data->jenis);
            xlsWriteNumber($tablebody, $kolombody++, $data->total_kg);
            xlsWriteNumber($tablebody, $kolombody++, $data->total_ball);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=bahan.doc");

        $data = array(
            'bahan_data' => $this->Bahan_model->get_all(),
            'start' => 0
        );

        $this->load->view('bahan/bahan_doc', $data);
    }
}

/* End of file Bahan.php */
/* Location: ./application/controllers/Bahan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-03-19 11:59:23 */
/* http://harviacode.com */
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pabrik extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('login') <> 1) {
            redirect(base_url('auth'));
        }
        $this->load->model('Pabrik_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        if ($this->session->userdata('jabatan') <> 'SuperAdmin') {
            redirect(base_url('tidakadaakses'));
        }
        $this->load->view('pabrik/pabrik_list');
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Pabrik_model->json();
    }

    public function read($id)
    {
        $row = $this->Pabrik_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'nama' => $row->nama,
            );
            $this->load->view('pabrik/pabrik_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pabrik'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('pabrik/create_action'),
            'id' => set_value('id'),
            'nama' => set_value('nama'),
        );
        $this->load->view('pabrik/pabrik_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'nama' => $this->input->post('nama', TRUE),
            );

            $this->Pabrik_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('pabrik'));
        }
    }

    public function update($id)
    {
        $row = $this->Pabrik_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pabrik/update_action'),
                'id' => set_value('id', $row->id),
                'nama' => set_value('nama', $row->nama),
            );
            $this->load->view('pabrik/pabrik_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pabrik'));
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
            );

            $this->Pabrik_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pabrik'));
        }
    }

    public function delete($id)
    {
        $row = $this->Pabrik_model->get_by_id($id);

        if ($row) {
            $this->Pabrik_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pabrik'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pabrik'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "pabrik.xls";
        $judul = "pabrik";
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

        foreach ($this->Pabrik_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=pabrik.doc");

        $data = array(
            'pabrik_data' => $this->Pabrik_model->get_all(),
            'start' => 0
        );

        $this->load->view('pabrik/pabrik_doc', $data);
    }
}

/* End of file Pabrik.php */
/* Location: ./application/controllers/Pabrik.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-03-19 11:59:24 */
/* http://harviacode.com */
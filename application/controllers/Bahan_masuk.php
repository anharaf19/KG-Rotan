<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bahan_masuk extends CI_Controller
{
    function __construct()
    {

        parent::__construct();
        if ($this->session->userdata('login') <> 1) {
            redirect(base_url('auth'));
        }
        $this->load->model('Bahan_masuk_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        $jabatan = $this->session->userdata('jabatan');
        if ($jabatan == 'SuperAdmin' || $jabatan == 'Bahan') {
            $this->load->view('bahan_masuk/bahan_masuk_list');
        } else {
            redirect(base_url('tidakadaakses'));
        }
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Bahan_masuk_model->json();
    }

    public function read($id)
    {
        $row = $this->Bahan_masuk_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'id_bahan' => $row->id_bahan,
                'tgl_masuk' => $row->tgl_masuk,
                'kg' => $row->kg,
                'ball' => $row->ball,
                'asal_bahan' => $row->asal_bahan,
                'ket' => $row->ket,

            );
            $this->load->view('bahan_masuk/bahan_masuk_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('bahan_masuk'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('bahan_masuk/create_action'),
            'id' => set_value('id'),
            'id_bahan' => set_value('id_bahan'),
            'tgl_masuk' => set_value('tgl_masuk'),
            'kg' => set_value('kg'),
            'ball' => set_value('ball'),
            'asal_bahan' => set_value('asal_bahan'),
            'ket' => set_value('ket'),
            'lihatbahan' => $this->Bahan_masuk_model->lihatbahan()
        );
        $this->load->view('bahan_masuk/bahan_masuk_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'id_bahan' => $this->input->post('id_bahan', TRUE),
                'tgl_masuk' => $this->input->post('tgl_masuk', TRUE),
                'kg' => $this->input->post('kg', TRUE),
                'ball' => $this->input->post('ball', TRUE),
                'asal_bahan' => $this->input->post('asal_bahan', TRUE),
                'ket' => $this->input->post('ket', TRUE),
            );

            $this->Bahan_masuk_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('bahan_masuk'));
        }
    }

    public function update($id)
    {
        $row = $this->Bahan_masuk_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('bahan_masuk/update_action'),
                'id' => set_value('id', $row->id),
                'id_bahan' => set_value('id_bahan', $row->id_bahan),
                'tgl_masuk' => set_value('tgl_masuk', $row->tgl_masuk),
                'kg' => set_value('kg', $row->kg),
                'ball' => set_value('ball', $row->ball),
                'asal_bahan' => set_value('asal_bahan', $row->asal_bahan),
                'ket' => set_value('ket', $row->ket),
                'lihatbahan' => $this->Bahan_masuk_model->lihatbahan()
            );
            $this->load->view('bahan_masuk/bahan_masuk_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('bahan_masuk'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'id_bahan' => $this->input->post('id_bahan', TRUE),
                'tgl_masuk' => $this->input->post('tgl_masuk', TRUE),
                'kg' => $this->input->post('kg', TRUE),
                'ball' => $this->input->post('ball', TRUE),
                'asal_bahan' => $this->input->post('asal_bahan', TRUE),
                'ket' => $this->input->post('ket', TRUE),
            );

            $this->Bahan_masuk_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('bahan_masuk'));
        }
    }

    public function delete($id)
    {
        $row = $this->Bahan_masuk_model->get_by_id($id);

        if ($row) {
            $this->Bahan_masuk_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('bahan_masuk'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('bahan_masuk'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('id_bahan', 'id bahan', 'trim|required');
        $this->form_validation->set_rules('tgl_masuk', 'tgl masuk', 'trim|required');
        $this->form_validation->set_rules('kg', 'kg', 'trim|required');
        $this->form_validation->set_rules('ball', 'ball', 'trim|required');
        $this->form_validation->set_rules('asal_bahan', 'asal bahan', 'trim|required');
        $this->form_validation->set_rules('ket', 'ket', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "bahan_masuk.xls";
        $judul = "bahan_masuk";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Id Bahan");
        xlsWriteLabel($tablehead, $kolomhead++, "Tgl Masuk");
        xlsWriteLabel($tablehead, $kolomhead++, "Kg");
        xlsWriteLabel($tablehead, $kolomhead++, "Ball");
        xlsWriteLabel($tablehead, $kolomhead++, "Asal Bahan");
        xlsWriteLabel($tablehead, $kolomhead++, "Ket");

        foreach ($this->Bahan_masuk_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteNumber($tablebody, $kolombody++, $data->id_bahan);
            xlsWriteLabel($tablebody, $kolombody++, $data->tgl_masuk);
            xlsWriteNumber($tablebody, $kolombody++, $data->kg);
            xlsWriteNumber($tablebody, $kolombody++, $data->ball);
            xlsWriteLabel($tablebody, $kolombody++, $data->asal_bahan);
            xlsWriteLabel($tablebody, $kolombody++, $data->ket);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }
}

/* End of file Bahan_masuk.php */
/* Location: ./application/controllers/Bahan_masuk.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-04-22 13:29:43 */
/* http://harviacode.com */
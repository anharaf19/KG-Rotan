<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bahan_rendam extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('login') <> 1) {
            redirect(base_url('auth'));
        }
        $this->load->model('Bahan_rendam_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        if ($this->session->userdata('jabatan') <> 'SuperAdmin') {
            redirect(base_url('tidakadaakses'));
        }
        $this->load->view('bahan_rendam/bahan_rendam_list');
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Bahan_rendam_model->json();
    }

    public function read($id)
    {
        $row = $this->Bahan_rendam_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'id_bahan' => $row->id_bahan,
                'tgl_rendam' => $row->tgl_rendam,
                'kolam' => $row->kolam,
                'ball' => $row->ball,
                'kg' => $row->kg,
                'tgl_habis' => $row->tgl_habis,
                'ket' => $row->ket,
                //'lihatbahan' => $this->Bahan_rendam_model->lihatbahan()

            );
            $this->load->view('bahan_rendam/bahan_rendam_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('bahan_rendam'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('bahan_rendam/create_action'),
            'id' => set_value('id'),
            'id_bahan' => set_value('id_bahan'),
            'tgl_rendam' => set_value('tgl_rendam'),
            'kolam' => set_value('kolam'),
            'ball' => set_value('ball'),
            'kg' => set_value('kg'),
            'tgl_habis' => set_value('tgl_habis'),
            'ket' => set_value('ket'),
            'lihatbahan' => $this->Bahan_rendam_model->lihatbahan()
        );
        $this->load->view('bahan_rendam/bahan_rendam_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'id_bahan' => $this->input->post('id_bahan', TRUE),
                'tgl_rendam' => $this->input->post('tgl_rendam', TRUE),
                'kolam' => $this->input->post('kolam', TRUE),
                'ball' => $this->input->post('ball', TRUE),
                'kg' => $this->input->post('kg', TRUE),
                'tgl_habis' => $this->input->post('tgl_habis', TRUE),
                'ket' => $this->input->post('ket', TRUE),
            );

            $this->Bahan_rendam_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('bahan_rendam'));
        }
    }

    public function update($id)
    {
        $row = $this->Bahan_rendam_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('bahan_rendam/update_action'),
                'id' => set_value('id', $row->id),
                'id_bahan' => set_value('id_bahan', $row->id_bahan),
                'tgl_rendam' => set_value('tgl_rendam', $row->tgl_rendam),
                'kolam' => set_value('kolam', $row->kolam),
                'ball' => set_value('ball', $row->ball),
                'kg' => set_value('kg', $row->kg),
                'tgl_habis' => set_value('tgl_habis', $row->tgl_habis),
                'ket' => set_value('ket', $row->ket),
                'lihatbahan' => $this->Bahan_rendam_model->lihatbahan()
            );
            $this->load->view('bahan_rendam/bahan_rendam_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('bahan_rendam'));
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
                'tgl_rendam' => $this->input->post('tgl_rendam', TRUE),
                'kolam' => $this->input->post('kolam', TRUE),
                'ball' => $this->input->post('ball', TRUE),
                'kg' => $this->input->post('kg', TRUE),
                'tgl_habis' => $this->input->post('tgl_habis', TRUE),
                'ket' => $this->input->post('ket', TRUE),
            );

            $this->Bahan_rendam_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('bahan_rendam'));
        }
    }

    public function delete($id)
    {
        $row = $this->Bahan_rendam_model->get_by_id($id);

        if ($row) {
            $this->Bahan_rendam_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('bahan_rendam'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('bahan_rendam'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('id_bahan', 'id bahan', 'trim|required');
        $this->form_validation->set_rules('tgl_rendam', 'tgl rendam', 'trim|required');
        $this->form_validation->set_rules('kolam', 'kolam', 'trim|required');
        $this->form_validation->set_rules('ball', 'ball', 'trim|required');
        $this->form_validation->set_rules('kg', 'kg', 'trim|required');
        $this->form_validation->set_rules('tgl_habis', 'tgl habis', 'trim|required');
        $this->form_validation->set_rules('ket', 'ket', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "bahan_rendam.xls";
        $judul = "bahan_rendam";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Tgl Rendam");
        xlsWriteLabel($tablehead, $kolomhead++, "Kolam");
        xlsWriteLabel($tablehead, $kolomhead++, "Ball");
        xlsWriteLabel($tablehead, $kolomhead++, "Kg");
        xlsWriteLabel($tablehead, $kolomhead++, "Tgl Habis");
        xlsWriteLabel($tablehead, $kolomhead++, "Ket");

        foreach ($this->Bahan_rendam_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteNumber($tablebody, $kolombody++, $data->id_bahan);
            xlsWriteLabel($tablebody, $kolombody++, $data->tgl_rendam);
            xlsWriteLabel($tablebody, $kolombody++, $data->kolam);
            xlsWriteNumber($tablebody, $kolombody++, $data->ball);
            xlsWriteNumber($tablebody, $kolombody++, $data->kg);
            xlsWriteLabel($tablebody, $kolombody++, $data->tgl_habis);
            xlsWriteLabel($tablebody, $kolombody++, $data->ket);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=bahan_rendam.doc");

        $data = array(
            'bahan_rendam_data' => $this->Bahan_rendam_model->get_all(),
            'start' => 0
        );

        $this->load->view('bahan_rendam/bahan_rendam_doc', $data);
    }
}

/* End of file Bahan_rendam.php */
/* Location: ./application/controllers/Bahan_rendam.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-03-19 11:59:23 */
/* http://harviacode.com */
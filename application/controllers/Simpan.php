<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Simpan extends CI_Controller
{
    function __construct()
    {

        parent::__construct();
        if ($this->session->userdata('login') <> 1) {
            redirect(base_url('auth'));
        }
        $this->load->model('Simpan_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        if ($this->session->userdata('jabatan') <> 'SuperAdmin') {
            redirect(base_url('tidakadaakses'));
        }
        $this->load->view('simpan/simpan_list');
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Simpan_model->json();
    }

    public function read($id)
    {
        $row = $this->Simpan_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'no_item' => $row->no_item,
                'qty' => $row->qty,
                'tgl' => $row->tgl,
            );
            $this->load->view('simpan/simpan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('simpan'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('simpan/create_action'),
            'id' => set_value('id'),
            'no_item' => set_value('no_item'),
            'qty' => set_value('qty'),
            'tgl' => set_value('tgl'),
            'lihatpenyimpanan' => $this->Simpan_model->lihatpenyimpanan()
        );
        $this->load->view('simpan/simpan_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'no_item' => $this->input->post('no_item', TRUE),
                'qty' => $this->input->post('qty', TRUE),
                'tgl' => $this->input->post('tgl', TRUE),
            );

            $this->Simpan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('simpan'));
        }
    }

    public function update($id)
    {
        $row = $this->Simpan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('simpan/update_action'),
                'id' => set_value('id', $row->id),
                'no_item' => set_value('no_item', $row->no_item),
                'qty' => set_value('qty', $row->qty),
                'tgl' => set_value('tgl', $row->tgl),
                'lihatpenyimpanan' => $this->Simpan_model->lihatpenyimpanan()
            );
            $this->load->view('simpan/simpan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('simpan'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'no_item' => $this->input->post('no_item', TRUE),
                'qty' => $this->input->post('qty', TRUE),
                'tgl' => $this->input->post('tgl', TRUE),
            );

            $this->Simpan_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('simpan'));
        }
    }

    public function delete($id)
    {
        $row = $this->Simpan_model->get_by_id($id);

        if ($row) {
            $this->Simpan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('simpan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('simpan'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('no_item', 'no item', 'trim|required');
        $this->form_validation->set_rules('qty', 'qty', 'trim|required');
        $this->form_validation->set_rules('tgl', 'tgl', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "simpan.xls";
        $judul = "simpan";
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
        xlsWriteLabel($tablehead, $kolomhead++, "No Item");
        xlsWriteLabel($tablehead, $kolomhead++, "Qty");
        xlsWriteLabel($tablehead, $kolomhead++, "Tgl");

        foreach ($this->Simpan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->no_item);
            xlsWriteNumber($tablebody, $kolombody++, $data->qty);
            xlsWriteLabel($tablebody, $kolombody++, $data->tgl);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }
}

/* End of file Simpan.php */
/* Location: ./application/controllers/Simpan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-04-22 13:29:43 */
/* http://harviacode.com */
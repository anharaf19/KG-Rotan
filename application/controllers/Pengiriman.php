<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pengiriman extends CI_Controller
{
    function __construct()
    {

        parent::__construct();
        if ($this->session->userdata('login') <> 1) {
            redirect(base_url('auth'));
        }
        $this->load->model('Pengiriman_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
        $this->load->model('Detail_pengiriman_model');
    }

    public function index()
    {
        if ($this->session->userdata('jabatan') <> 'SuperAdmin') {
            redirect(base_url('tidakadaakses'));
        }
        $this->load->view('pengiriman/pengiriman_list');
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Pengiriman_model->json();
    }

    public function read($id)
    {
        $row = $this->Pengiriman_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'no_pengiriman' => $row->no_pengiriman,
                'tgl' => $row->tgl,
                'ket' => $row->ket,
            );
            $this->load->view('pengiriman/pengiriman_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pengiriman'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('pengiriman/create_action'),
            'id' => set_value('id'),
            'no_pengiriman' => set_value('no_pengiriman'),
            'tgl' => set_value('tgl'),
            'ket' => set_value('ket'),
        );
        $this->load->view('pengiriman/pengiriman_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'no_pengiriman' => $this->input->post('no_pengiriman', TRUE),
                'tgl' => $this->input->post('tgl', TRUE),
                'ket' => $this->input->post('ket', TRUE),

            );
            $data1 = array(

                'lihatwarehouse' => $this->Detail_pengiriman_model->lihatwarehouse()
            );
            $this->Pengiriman_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            $this->load->view('detail_pengiriman/detail_pengiriman_formmulti', $data, $data1);
        }
    }

    public function update($id)
    {
        $row = $this->Pengiriman_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pengiriman/update_action'),
                'id' => set_value('id', $row->id),
                'no_pengiriman' => set_value('no_pengiriman', $row->no_pengiriman),
                'tgl' => set_value('tgl', $row->tgl),
                'ket' => set_value('ket', $row->ket),
            );
            $this->load->view('pengiriman/pengiriman_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pengiriman'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'no_pengiriman' => $this->input->post('no_pengiriman', TRUE),
                'tgl' => $this->input->post('tgl', TRUE),
                'ket' => $this->input->post('ket', TRUE),
            );

            $this->Pengiriman_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pengiriman'));
        }
    }

    public function delete($id)
    {
        $row = $this->Pengiriman_model->get_by_id($id);

        if ($row) {
            $this->Pengiriman_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pengiriman'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pengiriman'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('no_pengiriman', 'no_pengiriman', 'trim|required');
        $this->form_validation->set_rules('tgl', 'tgl', 'trim|required');
        $this->form_validation->set_rules('ket', 'ket', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "pengiriman.xls";
        $judul = "pengiriman";
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
        xlsWriteLabel($tablehead, $kolomhead++, "No Pengiriman");
        xlsWriteLabel($tablehead, $kolomhead++, "Tgl");
        xlsWriteLabel($tablehead, $kolomhead++, "Ket");

        foreach ($this->Pengiriman_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteNumber($tablebody, $kolombody++, $data->id_detail_pengiriman);
            xlsWriteLabel($tablebody, $kolombody++, $data->no_pengiriman);
            xlsWriteLabel($tablebody, $kolombody++, $data->tgl);
            xlsWriteLabel($tablebody, $kolombody++, $data->ket);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }
}

/* End of file Pengiriman.php */
/* Location: ./application/controllers/Pengiriman.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-04-22 13:29:43 */
/* http://harviacode.com */
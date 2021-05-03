<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Penyimpanan extends CI_Controller
{
    function __construct()
    {

        parent::__construct();
        if ($this->session->userdata('login') <> 1) {
            redirect(base_url('auth'));
        }
        $this->load->model('Penyimpanan_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        if ($this->session->userdata('jabatan') <> 'SuperAdmin') {
            redirect(base_url('tidakadaakses'));
        }
        $this->load->view('penyimpanan/penyimpanan_list');
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Penyimpanan_model->json();
    }

    public function read($id)
    {
        $row = $this->Penyimpanan_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'id_po_pabrik' => $row->id_po_pabrik,
                'no_po' => $row->no_po,
                'no_item' => $row->no_item,
                'total_qty' => $row->total_qty,
                'status' => $row->status,
            );
            $this->load->view('penyimpanan/penyimpanan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('penyimpanan'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('penyimpanan/create_action'),
            'id' => set_value('id'),
            'id_po_pabrik' => set_value('id_po_pabrik'),
            'no_po' => set_value('no_po'),
            'no_item' => set_value('no_item'),
            'total_qty' => set_value('total_qty'),
            'status' => set_value('status'),
        );
        $this->load->view('penyimpanan/penyimpanan_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'id_po_pabrik' => $this->input->post('id_po_pabrik', TRUE),
                'no_po' => $this->input->post('no_po', TRUE),
                'no_item' => $this->input->post('no_item', TRUE),
                'total_qty' => $this->input->post('total_qty', TRUE),
                'status' => $this->input->post('status', TRUE),
            );

            $this->Penyimpanan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('penyimpanan'));
        }
    }

    public function update($id)
    {
        $row = $this->Penyimpanan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('penyimpanan/update_action'),
                'id' => set_value('id', $row->id),
                'id_po_pabrik' => set_value('id_po_pabrik', $row->id_po_pabrik),
                'no_po' => set_value('no_po', $row->no_po),
                'no_item' => set_value('no_item', $row->no_item),
                'total_qty' => set_value('total_qty', $row->total_qty),
                'status' => set_value('status', $row->status),
            );
            $this->load->view('penyimpanan/penyimpanan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('penyimpanan'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'id_po_pabrik' => $this->input->post('id_po_pabrik', TRUE),
                'no_po' => $this->input->post('no_po', TRUE),
                'no_item' => $this->input->post('no_item', TRUE),
                'total_qty' => $this->input->post('total_qty', TRUE),
                'status' => $this->input->post('status', TRUE),
            );

            $this->Penyimpanan_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('penyimpanan'));
        }
    }

    public function delete($id)
    {
        $row = $this->Penyimpanan_model->get_by_id($id);

        if ($row) {
            $this->Penyimpanan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('penyimpanan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('penyimpanan'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('id_po_pabrik', 'id po pabrik', 'trim|required');
        $this->form_validation->set_rules('no_po', 'no po', 'trim|required');
        $this->form_validation->set_rules('no_item', 'no item', 'trim|required');
        $this->form_validation->set_rules('total_qty', 'total qty', 'trim|required');
        $this->form_validation->set_rules('status', 'status', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "penyimpanan.xls";
        $judul = "penyimpanan";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Id Po Pabrik");
        xlsWriteLabel($tablehead, $kolomhead++, "No Po");
        xlsWriteLabel($tablehead, $kolomhead++, "No Item");
        xlsWriteLabel($tablehead, $kolomhead++, "Total Qty");
        xlsWriteLabel($tablehead, $kolomhead++, "Status");

        foreach ($this->Penyimpanan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteNumber($tablebody, $kolombody++, $data->id_po_pabrik);
            xlsWriteLabel($tablebody, $kolombody++, $data->no_po);
            xlsWriteLabel($tablebody, $kolombody++, $data->no_item);
            xlsWriteNumber($tablebody, $kolombody++, $data->total_qty);
            xlsWriteLabel($tablebody, $kolombody++, $data->status);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }
}

/* End of file Penyimpanan.php */
/* Location: ./application/controllers/Penyimpanan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-04-22 13:29:43 */
/* http://harviacode.com */
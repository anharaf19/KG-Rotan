<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Warehouse extends CI_Controller
{
    function __construct()
    {

        parent::__construct();
        if ($this->session->userdata('login') <> 1) {
            redirect(base_url('auth'));
        }
        $this->load->model('Warehouse_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        if ($this->session->userdata('jabatan') <> 'SuperAdmin') {
            redirect(base_url('tidakadaakses'));
        }
        $this->load->view('warehouse/warehouse_list');
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Warehouse_model->json();
    }

    public function read($id)
    {
        $row = $this->Warehouse_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'no_item' => $row->no_item,
                'no_po' => $row->no_po,
                'total_qty' => $row->total_qty,
            );
            $this->load->view('warehouse/warehouse_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('warehouse'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('warehouse/create_action'),
            'id' => set_value('id'),
            'no_item' => set_value('no_item'),
            'no_po' => set_value('no_po'),
            'total_qty' => set_value('total_qty'),
        );
        $this->load->view('warehouse/warehouse_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'no_item' => $this->input->post('no_item', TRUE),
                'no_po' => $this->input->post('no_po', TRUE),
                'total_qty' => $this->input->post('total_qty', TRUE),
            );

            $this->Warehouse_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('warehouse'));
        }
    }

    public function update($id)
    {
        $row = $this->Warehouse_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('warehouse/update_action'),
                'id' => set_value('id', $row->id),
                'no_item' => set_value('no_item', $row->no_item),
                'no_po' => set_value('no_po', $row->no_po),
                'total_qty' => set_value('total_qty', $row->total_qty),
            );
            $this->load->view('warehouse/warehouse_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('warehouse'));
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
                'no_po' => $this->input->post('no_po', TRUE),
                'total_qty' => $this->input->post('total_qty', TRUE),
            );

            $this->Warehouse_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('warehouse'));
        }
    }

    public function delete($id)
    {
        $row = $this->Warehouse_model->get_by_id($id);

        if ($row) {
            $this->Warehouse_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('warehouse'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('warehouse'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('no_item', 'no item', 'trim|required');
        $this->form_validation->set_rules('no_po', 'no po', 'trim|required');
        $this->form_validation->set_rules('total_qty', 'total qty', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "warehouse.xls";
        $judul = "warehouse";
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
        xlsWriteLabel($tablehead, $kolomhead++, "No Po");
        xlsWriteLabel($tablehead, $kolomhead++, "Total Qty");

        foreach ($this->Warehouse_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->no_item);
            xlsWriteLabel($tablebody, $kolombody++, $data->no_po);
            xlsWriteNumber($tablebody, $kolombody++, $data->total_qty);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }
}

/* End of file Warehouse.php */
/* Location: ./application/controllers/Warehouse.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-04-22 13:29:43 */
/* http://harviacode.com */
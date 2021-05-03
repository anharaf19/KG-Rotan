<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Po_pabrik extends CI_Controller
{
    function __construct()
    {

        parent::__construct();
        if ($this->session->userdata('login') <> 1) {
            redirect(base_url('auth'));
        }
        $this->load->model('Po_pabrik_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        if ($this->session->userdata('jabatan') <> 'SuperAdmin') {
            redirect(base_url('tidakadaakses'));
        }
        $this->load->view('po_pabrik/po_pabrik_list');
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Po_pabrik_model->json();
    }

    public function read($id)
    {
        $row = $this->Po_pabrik_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'id_pabrik' => $row->id_pabrik,

                'no_po' => $row->no_po,
                'no_item' => $row->no_item,
                'qty' => $row->qty,
            );
            $this->load->view('po_pabrik/po_pabrik_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('po_pabrik'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('po_pabrik/create_action'),
            'id' => set_value('id'),
            'id_pabrik' => set_value('id_pabrik'),

            'no_po' => set_value('no_po'),
            'no_item' => set_value('no_item'),
            'qty' => set_value('qty'),
            'lihatpabrik' => $this->Po_pabrik_model->lihatpabrik(),
            'lihatpo' => $this->Po_pabrik_model->lihatpo()

        );
        $this->load->view('po_pabrik/po_pabrik_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'id_pabrik' => $this->input->post('id_pabrik', TRUE),

                'no_po' => $this->input->post('no_po', TRUE),
                'no_item' => $this->input->post('no_item', TRUE),
                'qty' => $this->input->post('qty', TRUE),
            );

            $this->Po_pabrik_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('po_pabrik'));
        }
    }

    public function update($id)
    {
        $row = $this->Po_pabrik_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('po_pabrik/update_action'),
                'id' => set_value('id', $row->id),
                'id_pabrik' => set_value('id_pabrik', $row->id_pabrik),
                'no_po' => set_value('no_po', $row->no_po),
                'no_item' => set_value('no_item', $row->no_item),
                'qty' => set_value('qty', $row->qty),
                'lihatpabrik' => $this->Po_pabrik_model->lihatpabrik(),
                'lihatpo' => $this->Po_pabrik_model->lihatpo()
            );
            $this->load->view('po_pabrik/po_pabrik_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('po_pabrik'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'id_pabrik' => $this->input->post('id_pabrik', TRUE),
                'no_po' => $this->input->post('no_po', TRUE),
                'no_item' => $this->input->post('no_item', TRUE),
                'qty' => $this->input->post('qty', TRUE),
            );

            $this->Po_pabrik_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('po_pabrik'));
        }
    }

    public function delete($id)
    {
        $row = $this->Po_pabrik_model->get_by_id($id);

        if ($row) {
            $this->Po_pabrik_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('po_pabrik'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('po_pabrik'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('id_pabrik', 'id pabrik', 'trim|required');
        $this->form_validation->set_rules('no_po', 'no po', 'trim|required');
        $this->form_validation->set_rules('no_item', 'no item', 'trim|required');
        $this->form_validation->set_rules('qty', 'qty', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "po_pabrik.xls";
        $judul = "po_pabrik";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Id Pabrik");
        xlsWriteLabel($tablehead, $kolomhead++, "No Po");
        xlsWriteLabel($tablehead, $kolomhead++, "No Item");
        xlsWriteLabel($tablehead, $kolomhead++, "Qty");

        foreach ($this->Po_pabrik_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteNumber($tablebody, $kolombody++, $data->id_pabrik);
            xlsWriteNumber($tablebody, $kolombody++, $data->id_po);

            xlsWriteLabel($tablebody, $kolombody++, $data->no_po);
            xlsWriteNumber($tablebody, $kolombody++, $data->no_item);
            xlsWriteNumber($tablebody, $kolombody++, $data->qty);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }
}

/* End of file Po_pabrik.php */
/* Location: ./application/controllers/Po_pabrik.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-04-22 13:29:43 */
/* http://harviacode.com */
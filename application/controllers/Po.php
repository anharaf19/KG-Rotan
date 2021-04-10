<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Po extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('login') <> 1) {
            redirect(base_url('auth'));
        }
        $this->load->model('Po_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        if ($this->session->userdata('jabatan') <> 'SuperAdmin') {
            redirect(base_url('tidakadaakses'));
        }
        $this->load->view('po/po_list');
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Po_model->json();
    }

    public function read($id)
    {
        $row = $this->Po_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'id_pembeli' => $row->id_pembeli,
                'no_po' => $row->no_po,
                'tgl_mulai' => $row->tgl_mulai,
                'tgl_selesai' => $row->tgl_selesai,
            );
            $this->load->view('po/po_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('po'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('po/create_action'),
            'id' => set_value('id'),
            'id_pembeli' => set_value('id_pembeli'),
            'no_po' => set_value('no_po'),
            'tgl_mulai' => set_value('tgl_mulai'),
            'tgl_selesai' => set_value('tgl_selesai'),
            'lihatpembeli' => $this->Po_model->lihatpembeli()
        );
        $this->load->view('po/po_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'id_pembeli' => $this->input->post('id_pembeli', TRUE),
                'no_po' => $this->input->post('no_po', TRUE),
                'tgl_mulai' => $this->input->post('tgl_mulai', TRUE),
                'tgl_selesai' => $this->input->post('tgl_selesai', TRUE),
            );

            $this->Po_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            $this->load->view('detail_po/detail_po_formmulti', $data);
        }
    }

    public function update($id)
    {
        $row = $this->Po_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('po/update_action'),
                'id' => set_value('id', $row->id),
                'id_pembeli' => set_value('id_pembeli', $row->id_pembeli),
                'tgl_mulai' => set_value('tgl_mulai', $row->tgl_mulai),
                'tgl_selesai' => set_value('tgl_selesai', $row->tgl_selesai),
                'no_po' => set_value('no_po', $row->no_po),
                'lihatpembeli' => $this->Po_model->lihatpembeli()
            );
            $this->load->view('po/po_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('po'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'id_pembeli' => $this->input->post('id_pembeli', TRUE),
                'tgl_mulai' => $this->input->post('tgl_mulai', TRUE),
                'no_po' => $this->input->post('no_po', TRUE),
                'tgl_selesai' => $this->input->post('tgl_selesai', TRUE),

            );

            $this->Po_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('po'));
        }
    }

    public function delete($id)
    {
        $row = $this->Po_model->get_by_id($id);

        if ($row) {
            $this->Po_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('po'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('po'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('id_pembeli', 'id pembeli', 'trim|required');
        $this->form_validation->set_rules('tgl_mulai', 'tgl mulai', 'trim|required');
        $this->form_validation->set_rules('tgl_selesai', 'tgl selesai', 'trim|required');
        $this->form_validation->set_rules('no_po', 'no po', 'trim|required');
        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "po.xls";
        $judul = "po";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Id Pembeli");
        xlsWriteLabel($tablehead, $kolomhead++, "Tgl Mulai");
        xlsWriteLabel($tablehead, $kolomhead++, "Tgl Selesai");

        foreach ($this->Po_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteNumber($tablebody, $kolombody++, $data->no_po);
            xlsWriteNumber($tablebody, $kolombody++, $data->id_pembeli);
            xlsWriteLabel($tablebody, $kolombody++, $data->tgl_mulai);
            xlsWriteLabel($tablebody, $kolombody++, $data->tgl_selesai);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=po.doc");

        $data = array(
            'po_data' => $this->Po_model->get_all(),
            'start' => 0
        );

        $this->load->view('po/po_doc', $data);
    }
}

/* End of file Po.php */
/* Location: ./application/controllers/Po.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-03-19 11:59:24 */
/* http://harviacode.com */
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Spk extends CI_Controller
{
    function __construct()
    {

        parent::__construct();
        if ($this->session->userdata('login') <> 1) {
            redirect(base_url('auth'));
        }
        $this->load->model('Spk_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        $jabatan = $this->session->userdata('jabatan');
        if ($jabatan == 'SuperAdmin' || $jabatan = 'Admin') {
            $this->load->view('spk/spk_list');
        } else {
            redirect(base_url('tidakadaakses'));
        }
    }


    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Spk_model->json();
    }

    public function read($id)
    {
        $row = $this->Spk_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'no_spk' => $row->no_spk,
                'id_po_pabrik' => $row->id_po_pabrik,
                'id_sub' => $row->id_sub,
                'tgl_mulai' => $row->tgl_mulai,
                'tgl_selesai' => $row->tgl_selesai,
                'status' => $row->status,
            );
            $this->load->view('spk/spk_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('spk'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('spk/create_action'),
            'id' => set_value('id'),
            'no_spk' => set_value('no_spk'),
            'id_po_pabrik' => set_value('id_po_pabrik'),
            'id_sub' => set_value('id_sub'),
            'tgl_mulai' => set_value('tgl_mulai'),
            'tgl_selesai' => set_value('tgl_selesai'),
            'status' => set_value('status'),

            'lihatsub' => $this->Spk_model->lihatsub(),
            'lihatpabrik' => $this->Spk_model->lihatpabrik($this->session->userdata('id_pabrik'))
        );
        $this->load->view('spk/spk_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'no_spk' => $this->input->post('no_spk', TRUE),
                'id_po_pabrik' => $this->input->post('id_po_pabrik', TRUE),
                'id_sub' => $this->input->post('id_sub', TRUE),
                'tgl_mulai' => $this->input->post('tgl_mulai', TRUE),
                'tgl_selesai' => $this->input->post('tgl_selesai', TRUE),
                'status' => 'Belum Selesai',
            );

            $this->Spk_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            $this->load->view('detail_spk/detail_spk_formmulti', $data);
        }
    }

    public function update($id)
    {
        $row = $this->Spk_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('spk/update_action'),
                'id' => set_value('id', $row->id),
                'no_spk' => set_value('no_spk', $row->no_spk),
                'id_po_pabrik' => set_value('id_po_pabrik', $row->id_po_pabrik),
                'id_sub' => set_value('id_sub', $row->id_sub),
                'tgl_mulai' => set_value('tgl_mulai', $row->tgl_mulai),
                'tgl_selesai' => set_value('tgl_selesai', $row->tgl_selesai),
                'status' => set_value('status', $row->status),

                'lihatsub' => $this->Spk_model->lihatsub(),
                'lihatpabrik' => $this->Spk_model->lihatpabrik($this->session->userdata('id_pabrik'))
            );
            $this->load->view('spk/spk_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('spk'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'no_spk' => $this->input->post('no_spk', TRUE),
                'id_po_pabrik' => $this->input->post('id_po_pabrik', TRUE),
                'id_sub' => $this->input->post('id_sub', TRUE),
                'tgl_mulai' => $this->input->post('tgl_mulai', TRUE),
                'tgl_selesai' => $this->input->post('tgl_selesai', TRUE),
                'status' => $this->input->post('status', TRUE),
            );

            $this->Spk_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('spk'));
        }
    }

    public function delete($id)
    {
        $row = $this->Spk_model->get_by_id($id);

        if ($row) {
            $this->Spk_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('spk'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('spk'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('no_spk', 'no spk', 'trim|required');
        $this->form_validation->set_rules('id_po_pabrik', 'id po pabrik', 'trim|required');
        $this->form_validation->set_rules('id_sub', 'id sub', 'trim|required');
        $this->form_validation->set_rules('tgl_mulai', 'tgl mulai', 'trim|required');
        $this->form_validation->set_rules('tgl_selesai', 'tgl selesai', 'trim|required');
        $this->form_validation->set_rules('status', 'status', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "spk.xls";
        $judul = "spk";
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
        xlsWriteLabel($tablehead, $kolomhead++, "No Spk");
        xlsWriteLabel($tablehead, $kolomhead++, "Id Po Pabrik");
        xlsWriteLabel($tablehead, $kolomhead++, "Id Sub");
        xlsWriteLabel($tablehead, $kolomhead++, "Tgl Mulai");
        xlsWriteLabel($tablehead, $kolomhead++, "Tgl Selesai");
        xlsWriteLabel($tablehead, $kolomhead++, "Status");

        foreach ($this->Spk_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->no_spk);
            xlsWriteNumber($tablebody, $kolombody++, $data->id_po_pabrik);
            xlsWriteNumber($tablebody, $kolombody++, $data->id_sub);
            xlsWriteLabel($tablebody, $kolombody++, $data->tgl_mulai);
            xlsWriteLabel($tablebody, $kolombody++, $data->tgl_selesai);
            xlsWriteLabel($tablebody, $kolombody++, $data->status);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }
}

/* End of file Spk.php */
/* Location: ./application/controllers/Spk.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-04-22 13:29:43 */
/* http://harviacode.com */
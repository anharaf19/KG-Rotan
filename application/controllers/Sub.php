<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sub extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('login') <> 1) {
            redirect(base_url('auth'));
        }
        $this->load->model('Sub_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        if ($this->session->userdata('jabatan') <> 'SuperAdmin') {
            redirect(base_url('tidakadaakses'));
        }
        $this->load->view('sub/sub_list');
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Sub_model->json();
    }

    public function read($id)
    {
        $row = $this->Sub_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'nama' => $row->nama,
            );
            $this->load->view('sub/sub_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sub'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('sub/create_action'),
            'id' => set_value('id'),
            'nama' => set_value('nama'),
        );
        $this->load->view('sub/sub_form', $data);
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

            $this->Sub_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('sub'));
        }
    }

    public function update($id)
    {
        $row = $this->Sub_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('sub/update_action'),
                'id' => set_value('id', $row->id),
                'nama' => set_value('nama', $row->nama),
            );
            $this->load->view('sub/sub_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sub'));
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

            $this->Sub_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('sub'));
        }
    }

    public function delete($id)
    {
        $row = $this->Sub_model->get_by_id($id);

        if ($row) {
            $this->Sub_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('sub'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sub'));
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
        $namaFile = "sub.xls";
        $judul = "sub";
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

        foreach ($this->Sub_model->get_all() as $data) {
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
        header("Content-Disposition: attachment;Filename=sub.doc");

        $data = array(
            'sub_data' => $this->Sub_model->get_all(),
            'start' => 0
        );

        $this->load->view('sub/sub_doc', $data);
    }
}

/* End of file Sub.php */
/* Location: ./application/controllers/Sub.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-03-19 11:59:24 */
/* http://harviacode.com */
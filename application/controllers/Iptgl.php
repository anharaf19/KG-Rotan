<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Iptgl extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Iptgl_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('iptgl/iptgl_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Iptgl_model->json();
    }

    public function read($id) 
    {
        $row = $this->Iptgl_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'id_detail_spk' => $row->id_detail_spk,
		'no_item' => $row->no_item,
		'tgl_masuk' => $row->tgl_masuk,
		'qty' => $row->qty,
		'status' => $row->status,
	    );
            $this->load->view('iptgl/iptgl_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('iptgl'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('iptgl/create_action'),
	    'id' => set_value('id'),
	    'id_detail_spk' => set_value('id_detail_spk'),
	    'no_item' => set_value('no_item'),
	    'tgl_masuk' => set_value('tgl_masuk'),
	    'qty' => set_value('qty'),
	    'status' => set_value('status'),
	);
        $this->load->view('iptgl/iptgl_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_detail_spk' => $this->input->post('id_detail_spk',TRUE),
		'no_item' => $this->input->post('no_item',TRUE),
		'tgl_masuk' => $this->input->post('tgl_masuk',TRUE),
		'qty' => $this->input->post('qty',TRUE),
		'status' => $this->input->post('status',TRUE),
	    );

            $this->Iptgl_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('iptgl'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Iptgl_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('iptgl/update_action'),
		'id' => set_value('id', $row->id),
		'id_detail_spk' => set_value('id_detail_spk', $row->id_detail_spk),
		'no_item' => set_value('no_item', $row->no_item),
		'tgl_masuk' => set_value('tgl_masuk', $row->tgl_masuk),
		'qty' => set_value('qty', $row->qty),
		'status' => set_value('status', $row->status),
	    );
            $this->load->view('iptgl/iptgl_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('iptgl'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'id_detail_spk' => $this->input->post('id_detail_spk',TRUE),
		'no_item' => $this->input->post('no_item',TRUE),
		'tgl_masuk' => $this->input->post('tgl_masuk',TRUE),
		'qty' => $this->input->post('qty',TRUE),
		'status' => $this->input->post('status',TRUE),
	    );

            $this->Iptgl_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('iptgl'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Iptgl_model->get_by_id($id);

        if ($row) {
            $this->Iptgl_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('iptgl'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('iptgl'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_detail_spk', 'id detail spk', 'trim|required');
	$this->form_validation->set_rules('no_item', 'no item', 'trim|required');
	$this->form_validation->set_rules('tgl_masuk', 'tgl masuk', 'trim|required');
	$this->form_validation->set_rules('qty', 'qty', 'trim|required');
	$this->form_validation->set_rules('status', 'status', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "iptgl.xls";
        $judul = "iptgl";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Id Detail Spk");
	xlsWriteLabel($tablehead, $kolomhead++, "No Item");
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl Masuk");
	xlsWriteLabel($tablehead, $kolomhead++, "Qty");
	xlsWriteLabel($tablehead, $kolomhead++, "Status");

	foreach ($this->Iptgl_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_detail_spk);
	    xlsWriteLabel($tablebody, $kolombody++, $data->no_item);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_masuk);
	    xlsWriteNumber($tablebody, $kolombody++, $data->qty);
	    xlsWriteLabel($tablebody, $kolombody++, $data->status);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Iptgl.php */
/* Location: ./application/controllers/Iptgl.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-04-09 22:11:04 */
/* http://harviacode.com */
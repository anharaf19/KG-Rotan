<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Detail_invoice extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Detail_invoice_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('detail_invoice/detail_invoice_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Detail_invoice_model->json();
    }

    public function read($id) 
    {
        $row = $this->Detail_invoice_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'no_kontainer' => $row->no_kontainer,
		'no_seal' => $row->no_seal,
		'no_surat_jalan' => $row->no_surat_jalan,
		'no_invoice' => $row->no_invoice,
	    );
            $this->load->view('detail_invoice/detail_invoice_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('detail_invoice'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('detail_invoice/create_action'),
	    'id' => set_value('id'),
	    'no_kontainer' => set_value('no_kontainer'),
	    'no_seal' => set_value('no_seal'),
	    'no_surat_jalan' => set_value('no_surat_jalan'),
	    'no_invoice' => set_value('no_invoice'),
	);
        $this->load->view('detail_invoice/detail_invoice_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'no_kontainer' => $this->input->post('no_kontainer',TRUE),
		'no_seal' => $this->input->post('no_seal',TRUE),
		'no_surat_jalan' => $this->input->post('no_surat_jalan',TRUE),
		'no_invoice' => $this->input->post('no_invoice',TRUE),
	    );

            $this->Detail_invoice_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('detail_invoice'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Detail_invoice_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('detail_invoice/update_action'),
		'id' => set_value('id', $row->id),
		'no_kontainer' => set_value('no_kontainer', $row->no_kontainer),
		'no_seal' => set_value('no_seal', $row->no_seal),
		'no_surat_jalan' => set_value('no_surat_jalan', $row->no_surat_jalan),
		'no_invoice' => set_value('no_invoice', $row->no_invoice),
	    );
            $this->load->view('detail_invoice/detail_invoice_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('detail_invoice'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'no_kontainer' => $this->input->post('no_kontainer',TRUE),
		'no_seal' => $this->input->post('no_seal',TRUE),
		'no_surat_jalan' => $this->input->post('no_surat_jalan',TRUE),
		'no_invoice' => $this->input->post('no_invoice',TRUE),
	    );

            $this->Detail_invoice_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('detail_invoice'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Detail_invoice_model->get_by_id($id);

        if ($row) {
            $this->Detail_invoice_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('detail_invoice'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('detail_invoice'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('no_kontainer', 'no kontainer', 'trim|required');
	$this->form_validation->set_rules('no_seal', 'no seal', 'trim|required');
	$this->form_validation->set_rules('no_surat_jalan', 'no surat jalan', 'trim|required');
	$this->form_validation->set_rules('no_invoice', 'no invoice', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "detail_invoice.xls";
        $judul = "detail_invoice";
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
	xlsWriteLabel($tablehead, $kolomhead++, "No Kontainer");
	xlsWriteLabel($tablehead, $kolomhead++, "No Seal");
	xlsWriteLabel($tablehead, $kolomhead++, "No Surat Jalan");
	xlsWriteLabel($tablehead, $kolomhead++, "No Invoice");

	foreach ($this->Detail_invoice_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->no_kontainer);
	    xlsWriteLabel($tablebody, $kolombody++, $data->no_seal);
	    xlsWriteLabel($tablebody, $kolombody++, $data->no_surat_jalan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->no_invoice);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Detail_invoice.php */
/* Location: ./application/controllers/Detail_invoice.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-05-26 10:26:06 */
/* http://harviacode.com */
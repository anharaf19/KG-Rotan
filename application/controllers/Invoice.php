<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Invoice extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Invoice_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('invoice/invoice_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Invoice_model->json();
    }

    public function read($id) 
    {
        $row = $this->Invoice_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'no_invoice' => $row->no_invoice,
		'importir' => $row->importir,
		'feeder_vessel' => $row->feeder_vessel,
		'mother_vessel' => $row->mother_vessel,
		'total' => $row->total,
		'etd' => $row->etd,
		'eta' => $row->eta,
		'tgl' => $row->tgl,
	    );
            $this->load->view('invoice/invoice_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('invoice'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('invoice/create_action'),
	    'id' => set_value('id'),
	    'no_invoice' => set_value('no_invoice'),
	    'importir' => set_value('importir'),
	    'feeder_vessel' => set_value('feeder_vessel'),
	    'mother_vessel' => set_value('mother_vessel'),
	    'total' => set_value('total'),
	    'etd' => set_value('etd'),
	    'eta' => set_value('eta'),
	    'tgl' => set_value('tgl'),
	);
        $this->load->view('invoice/invoice_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'no_invoice' => $this->input->post('no_invoice',TRUE),
		'importir' => $this->input->post('importir',TRUE),
		'feeder_vessel' => $this->input->post('feeder_vessel',TRUE),
		'mother_vessel' => $this->input->post('mother_vessel',TRUE),
		'total' => $this->input->post('total',TRUE),
		'etd' => $this->input->post('etd',TRUE),
		'eta' => $this->input->post('eta',TRUE),
		'tgl' => $this->input->post('tgl',TRUE),
	    );

            $this->Invoice_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('invoice'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Invoice_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('invoice/update_action'),
		'id' => set_value('id', $row->id),
		'no_invoice' => set_value('no_invoice', $row->no_invoice),
		'importir' => set_value('importir', $row->importir),
		'feeder_vessel' => set_value('feeder_vessel', $row->feeder_vessel),
		'mother_vessel' => set_value('mother_vessel', $row->mother_vessel),
		'total' => set_value('total', $row->total),
		'etd' => set_value('etd', $row->etd),
		'eta' => set_value('eta', $row->eta),
		'tgl' => set_value('tgl', $row->tgl),
	    );
            $this->load->view('invoice/invoice_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('invoice'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'no_invoice' => $this->input->post('no_invoice',TRUE),
		'importir' => $this->input->post('importir',TRUE),
		'feeder_vessel' => $this->input->post('feeder_vessel',TRUE),
		'mother_vessel' => $this->input->post('mother_vessel',TRUE),
		'total' => $this->input->post('total',TRUE),
		'etd' => $this->input->post('etd',TRUE),
		'eta' => $this->input->post('eta',TRUE),
		'tgl' => $this->input->post('tgl',TRUE),
	    );

            $this->Invoice_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('invoice'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Invoice_model->get_by_id($id);

        if ($row) {
            $this->Invoice_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('invoice'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('invoice'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('no_invoice', 'no invoice', 'trim|required');
	$this->form_validation->set_rules('importir', 'importir', 'trim|required');
	$this->form_validation->set_rules('feeder_vessel', 'feeder vessel', 'trim|required');
	$this->form_validation->set_rules('mother_vessel', 'mother vessel', 'trim|required');
	$this->form_validation->set_rules('total', 'total', 'trim|required');
	$this->form_validation->set_rules('etd', 'etd', 'trim|required');
	$this->form_validation->set_rules('eta', 'eta', 'trim|required');
	$this->form_validation->set_rules('tgl', 'tgl', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "invoice.xls";
        $judul = "invoice";
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
	xlsWriteLabel($tablehead, $kolomhead++, "No Invoice");
	xlsWriteLabel($tablehead, $kolomhead++, "Importir");
	xlsWriteLabel($tablehead, $kolomhead++, "Feeder Vessel");
	xlsWriteLabel($tablehead, $kolomhead++, "Mother Vessel");
	xlsWriteLabel($tablehead, $kolomhead++, "Total");
	xlsWriteLabel($tablehead, $kolomhead++, "Etd");
	xlsWriteLabel($tablehead, $kolomhead++, "Eta");
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl");

	foreach ($this->Invoice_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->no_invoice);
	    xlsWriteLabel($tablebody, $kolombody++, $data->importir);
	    xlsWriteLabel($tablebody, $kolombody++, $data->feeder_vessel);
	    xlsWriteLabel($tablebody, $kolombody++, $data->mother_vessel);
	    xlsWriteNumber($tablebody, $kolombody++, $data->total);
	    xlsWriteLabel($tablebody, $kolombody++, $data->etd);
	    xlsWriteLabel($tablebody, $kolombody++, $data->eta);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Invoice.php */
/* Location: ./application/controllers/Invoice.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-05-26 10:26:11 */
/* http://harviacode.com */
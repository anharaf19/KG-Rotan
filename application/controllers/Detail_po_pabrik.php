<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Detail_po_pabrik extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Detail_po_pabrik_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('detail_po_pabrik/detail_po_pabrik_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Detail_po_pabrik_model->json();
    }

    public function read($id) 
    {
        $row = $this->Detail_po_pabrik_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'id_po_pabrik' => $row->id_po_pabrik,
		'no_item' => $row->no_item,
		'qty' => $row->qty,
	    );
            $this->load->view('detail_po_pabrik/detail_po_pabrik_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('detail_po_pabrik'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('detail_po_pabrik/create_action'),
	    'id' => set_value('id'),
	    'id_po_pabrik' => set_value('id_po_pabrik'),
	    'no_item' => set_value('no_item'),
	    'qty' => set_value('qty'),
	);
        $this->load->view('detail_po_pabrik/detail_po_pabrik_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_po_pabrik' => $this->input->post('id_po_pabrik',TRUE),
		'no_item' => $this->input->post('no_item',TRUE),
		'qty' => $this->input->post('qty',TRUE),
	    );

            $this->Detail_po_pabrik_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('detail_po_pabrik'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Detail_po_pabrik_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('detail_po_pabrik/update_action'),
		'id' => set_value('id', $row->id),
		'id_po_pabrik' => set_value('id_po_pabrik', $row->id_po_pabrik),
		'no_item' => set_value('no_item', $row->no_item),
		'qty' => set_value('qty', $row->qty),
	    );
            $this->load->view('detail_po_pabrik/detail_po_pabrik_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('detail_po_pabrik'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'id_po_pabrik' => $this->input->post('id_po_pabrik',TRUE),
		'no_item' => $this->input->post('no_item',TRUE),
		'qty' => $this->input->post('qty',TRUE),
	    );

            $this->Detail_po_pabrik_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('detail_po_pabrik'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Detail_po_pabrik_model->get_by_id($id);

        if ($row) {
            $this->Detail_po_pabrik_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('detail_po_pabrik'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('detail_po_pabrik'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_po_pabrik', 'id po pabrik', 'trim|required');
	$this->form_validation->set_rules('no_item', 'no item', 'trim|required');
	$this->form_validation->set_rules('qty', 'qty', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "detail_po_pabrik.xls";
        $judul = "detail_po_pabrik";
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
	xlsWriteLabel($tablehead, $kolomhead++, "No Item");
	xlsWriteLabel($tablehead, $kolomhead++, "Qty");

	foreach ($this->Detail_po_pabrik_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_po_pabrik);
	    xlsWriteLabel($tablebody, $kolombody++, $data->no_item);
	    xlsWriteNumber($tablebody, $kolombody++, $data->qty);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Detail_po_pabrik.php */
/* Location: ./application/controllers/Detail_po_pabrik.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-05-30 09:50:16 */
/* http://harviacode.com */
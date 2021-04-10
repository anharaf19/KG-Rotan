<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Detail_spk extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Detail_spk_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('detail_spk/detail_spk_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Detail_spk_model->json();
    }

    public function read($id) 
    {
        $row = $this->Detail_spk_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'id_spk' => $row->id_spk,
		'no_item' => $row->no_item,
		'qty' => $row->qty,
		'id_bahan_rendam' => $row->id_bahan_rendam,
		'ball' => $row->ball,
		'kg' => $row->kg,
		'detail_iptgl' => $row->detail_iptgl,
	    );
            $this->load->view('detail_spk/detail_spk_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('detail_spk'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('detail_spk/create_action'),
	    'id' => set_value('id'),
	    'id_spk' => set_value('id_spk'),
	    'no_item' => set_value('no_item'),
	    'qty' => set_value('qty'),
	    'id_bahan_rendam' => set_value('id_bahan_rendam'),
	    'ball' => set_value('ball'),
	    'kg' => set_value('kg'),
	    'detail_iptgl' => set_value('detail_iptgl'),
	);
        $this->load->view('detail_spk/detail_spk_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_spk' => $this->input->post('id_spk',TRUE),
		'no_item' => $this->input->post('no_item',TRUE),
		'qty' => $this->input->post('qty',TRUE),
		'id_bahan_rendam' => $this->input->post('id_bahan_rendam',TRUE),
		'ball' => $this->input->post('ball',TRUE),
		'kg' => $this->input->post('kg',TRUE),
		'detail_iptgl' => $this->input->post('detail_iptgl',TRUE),
	    );

            $this->Detail_spk_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('detail_spk'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Detail_spk_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('detail_spk/update_action'),
		'id' => set_value('id', $row->id),
		'id_spk' => set_value('id_spk', $row->id_spk),
		'no_item' => set_value('no_item', $row->no_item),
		'qty' => set_value('qty', $row->qty),
		'id_bahan_rendam' => set_value('id_bahan_rendam', $row->id_bahan_rendam),
		'ball' => set_value('ball', $row->ball),
		'kg' => set_value('kg', $row->kg),
		'detail_iptgl' => set_value('detail_iptgl', $row->detail_iptgl),
	    );
            $this->load->view('detail_spk/detail_spk_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('detail_spk'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'id_spk' => $this->input->post('id_spk',TRUE),
		'no_item' => $this->input->post('no_item',TRUE),
		'qty' => $this->input->post('qty',TRUE),
		'id_bahan_rendam' => $this->input->post('id_bahan_rendam',TRUE),
		'ball' => $this->input->post('ball',TRUE),
		'kg' => $this->input->post('kg',TRUE),
		'detail_iptgl' => $this->input->post('detail_iptgl',TRUE),
	    );

            $this->Detail_spk_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('detail_spk'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Detail_spk_model->get_by_id($id);

        if ($row) {
            $this->Detail_spk_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('detail_spk'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('detail_spk'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_spk', 'id spk', 'trim|required');
	$this->form_validation->set_rules('no_item', 'no item', 'trim|required');
	$this->form_validation->set_rules('qty', 'qty', 'trim|required');
	$this->form_validation->set_rules('id_bahan_rendam', 'id bahan rendam', 'trim|required');
	$this->form_validation->set_rules('ball', 'ball', 'trim|required');
	$this->form_validation->set_rules('kg', 'kg', 'trim|required');
	$this->form_validation->set_rules('detail_iptgl', 'detail iptgl', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "detail_spk.xls";
        $judul = "detail_spk";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Id Spk");
	xlsWriteLabel($tablehead, $kolomhead++, "No Item");
	xlsWriteLabel($tablehead, $kolomhead++, "Qty");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Bahan Rendam");
	xlsWriteLabel($tablehead, $kolomhead++, "Ball");
	xlsWriteLabel($tablehead, $kolomhead++, "Kg");
	xlsWriteLabel($tablehead, $kolomhead++, "Detail Iptgl");

	foreach ($this->Detail_spk_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_spk);
	    xlsWriteLabel($tablebody, $kolombody++, $data->no_item);
	    xlsWriteNumber($tablebody, $kolombody++, $data->qty);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_bahan_rendam);
	    xlsWriteNumber($tablebody, $kolombody++, $data->ball);
	    xlsWriteNumber($tablebody, $kolombody++, $data->kg);
	    xlsWriteNumber($tablebody, $kolombody++, $data->detail_iptgl);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Detail_spk.php */
/* Location: ./application/controllers/Detail_spk.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-04-09 22:10:53 */
/* http://harviacode.com */
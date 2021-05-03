<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Detail_pengiriman extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('login') <> 1) {
            redirect(base_url('auth'));
        }
        $this->load->model('Detail_pengiriman_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        if ($this->session->userdata('jabatan') <> 'SuperAdmin') {
            redirect(base_url('tidakadaakses'));
        }
        $this->load->view('detail_pengiriman/detail_pengiriman_list');
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Detail_pengiriman_model->json();
    }

    public function read($id)
    {
        $row = $this->Detail_pengiriman_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'no_pengiriman' => $row->no_pengiriman,
                'no_item' => $row->no_item,
                'no_po' => $row->no_po,
                'qty' => $row->qty,
            );
            $this->load->view('detail_pengiriman/detail_pengiriman_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('detail_pengiriman'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('detail_pengiriman/create_action'),
            'id' => set_value('id'),
            'no_pengiriman' => set_value('no_pengiriman'),
            'no_item' => set_value('no_item'),
            'no_po' => set_value('no_po'),
            'qty' => set_value('qty'),
            'lihatwarehouse' => $this->Detail_pengiriman_model->lihatwarehouse()
        );
        $this->load->view('detail_pengiriman/detail_pengiriman_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'no_pengiriman' => $this->input->post('no_pengiriman', TRUE),
                'no_item' => $this->input->post('no_item', TRUE),
                'no_po' => $this->input->post('no_po', TRUE),
                'qty' => $this->input->post('qty', TRUE),
            );

            $this->Detail_pengiriman_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('detail_pengiriman'));
        }
    }

    public function update($id)
    {
        $row = $this->Detail_pengiriman_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('detail_pengiriman/update_action'),
                'id' => set_value('id', $row->id),
                'no_pengiriman' => set_value('no_pengiriman', $row->no_pengiriman),
                'no_item' => set_value('no_item', $row->no_item),
                'no_po' => set_value('no_po', $row->no_po),
                'qty' => set_value('qty', $row->qty),
                'lihatwarehouse' => $this->Detail_pengiriman_model->lihatwarehouse()
            );
            $this->load->view('detail_pengiriman/detail_pengiriman_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('detail_pengiriman'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'no_pengiriman' => $this->input->post('no_pengiriman', TRUE),
                'no_item' => $this->input->post('no_item', TRUE),
                'no_po' => $this->input->post('no_po', TRUE),
                'qty' => $this->input->post('qty', TRUE),
            );

            $this->Detail_pengiriman_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('detail_pengiriman'));
        }
    }

    public function delete($id)
    {
        $row = $this->Detail_pengiriman_model->get_by_id($id);

        if ($row) {
            $this->Detail_pengiriman_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('detail_pengiriman'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('detail_pengiriman'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('no_pengiriman', 'no pengiriman', 'trim|required');
        $this->form_validation->set_rules('no_item', 'no item', 'trim|required');
        $this->form_validation->set_rules('no_po', 'no po', 'trim|required');
        $this->form_validation->set_rules('qty', 'qty', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "detail_pengiriman.xls";
        $judul = "detail_pengiriman";
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
        xlsWriteLabel($tablehead, $kolomhead++, "No Pengiriman");
        xlsWriteLabel($tablehead, $kolomhead++, "No Item");
        xlsWriteLabel($tablehead, $kolomhead++, "No Po");
        xlsWriteLabel($tablehead, $kolomhead++, "Qty");

        foreach ($this->Detail_pengiriman_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->no_pengiriman);
            xlsWriteLabel($tablebody, $kolombody++, $data->no_item);
            xlsWriteLabel($tablebody, $kolombody++, $data->no_po);
            xlsWriteNumber($tablebody, $kolombody++, $data->qty);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }
    public function save()
    {
        // Ambil data yang dikirim dari form
        $no_pengiriman = $_POST['no_pengiriman']; // Ambil data no_po dan masukkan ke variabel no_po
        $no_item = $_POST['no_item']; // Ambil data no_item dan masukkan ke variabel no_item
        $no_po = $_POST['no_po'];

        $data = array();

        $index = 0; // Set index array awal dengan 0
        foreach ($no_item as $datano_item) { // Kita buat perulangan berdasarkan no_item sampai data terakhir
            array_push($data, array(
                'no_pengiriman' => $no_pengiriman,
                'no_item' => $datano_item,
                'no_po' => $no_po[$index]

            ));

            $index++;
        }

        $sql = $this->Detail_pengiriman_model->save_batch($data); // Panggil fungsi save_batch yang ada di model siswa (Detail_po_model.php)

        // Cek apakah query insert nya sukses atau gagal
        if ($sql) { // Jika sukses
            echo "<script>alert('Data berhasil disimpan');window.location = '" . base_url('pengiriman') . "';</script>";
        } else { // Jika gagal
            echo "<script>alert('Data gagal disimpan');window.location = '" . base_url('detail_pengiriman/create') . "';</script>";
        }
    }
}

/* End of file Detail_pengiriman.php */
/* Location: ./application/controllers/Detail_pengiriman.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-04-22 13:29:43 */
/* http://harviacode.com */
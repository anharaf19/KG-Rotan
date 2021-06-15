<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Detail_spk extends CI_Controller
{
    function __construct()
    {

        parent::__construct();
        if ($this->session->userdata('login') <> 1) {
            redirect(base_url('auth'));
        }
        $this->load->model('Detail_spk_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        if ($this->session->userdata('jabatan') <> 'SuperAdmin') {
            redirect(base_url('tidakadaakses'));
        }
        $this->load->view('detail_spk/detail_spk_list');
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Detail_spk_model->json();
    }
    function get_no_item()
    {

        $id_po_pabrik = $this->input->post('id_po_pabrik');
        $data = $this->Detail_spk_model->get_no_item($id_po_pabrik)->result();
        echo json_encode($data);
    }

    public function read($id)
    {
        $row = $this->Detail_spk_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'no_spk' => $row->no_spk,
                'no_item' => $row->no_item,
                'total_qty' => $row->total_qty,
                'id_bahan_rendam' => $row->id_bahan_rendam,
                'kg' => $row->kg,
                'ball' => $row->ball,
                'ket' => $row->ket,
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
            'no_spk' => set_value('no_spk'),
            'no_item' => set_value('no_item'),
            'total_qty' => set_value('total_qty'),
            'id_bahan_rendam' => set_value('id_bahan_rendam'),
            'kg' => set_value('kg'),
            'ball' => set_value('ball'),
            'ket' => set_value('ket'),
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
                'no_spk' => $this->input->post('no_spk', TRUE),
                'no_item' => $this->input->post('no_item', TRUE),
                'total_qty' => $this->input->post('total_qty', TRUE),
                'id_bahan_rendam' => $this->input->post('id_bahan_rendam', TRUE),
                'kg' => $this->input->post('kg', TRUE),
                'ball' => $this->input->post('ball', TRUE),
                'ket' => $this->input->post('ket', TRUE),
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
                'no_spk' => set_value('no_spk', $row->no_spk),
                'no_item' => set_value('no_item', $row->no_item),
                'total_qty' => set_value('total_qty', $row->total_qty),
                'id_bahan_rendam' => set_value('id_bahan_rendam', $row->id_bahan_rendam),
                'kg' => set_value('kg', $row->kg),
                'ball' => set_value('ball', $row->ball),
                'ket' => set_value('ket', $row->ket),
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
                'no_spk' => $this->input->post('no_spk', TRUE),
                'no_item' => $this->input->post('no_item', TRUE),
                'total_qty' => $this->input->post('total_qty', TRUE),
                'id_bahan_rendam' => $this->input->post('id_bahan_rendam', TRUE),
                'kg' => $this->input->post('kg', TRUE),
                'ball' => $this->input->post('ball', TRUE),
                'ket' => $this->input->post('ket', TRUE),
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
        $this->form_validation->set_rules('no_spk', 'no spk', 'trim|required');
        $this->form_validation->set_rules('no_item', 'no item', 'trim|required');
        $this->form_validation->set_rules('total_qty', 'total qty', 'trim|required');
        $this->form_validation->set_rules('id_bahan_rendam', 'id bahan rendam', 'trim|required');
        $this->form_validation->set_rules('kg', 'kg', 'trim|required');
        $this->form_validation->set_rules('ball', 'ball', 'trim|required');
        $this->form_validation->set_rules('ket', 'ket', 'trim|required');

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
        xlsWriteLabel($tablehead, $kolomhead++, "No Spk");
        xlsWriteLabel($tablehead, $kolomhead++, "No Item");
        xlsWriteLabel($tablehead, $kolomhead++, "Total Qty");
        xlsWriteLabel($tablehead, $kolomhead++, "Id Bahan Rendam");
        xlsWriteLabel($tablehead, $kolomhead++, "Kg");
        xlsWriteLabel($tablehead, $kolomhead++, "Ball");
        xlsWriteLabel($tablehead, $kolomhead++, "Ket");

        foreach ($this->Detail_spk_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->no_spk);
            xlsWriteLabel($tablebody, $kolombody++, $data->no_item);
            xlsWriteNumber($tablebody, $kolombody++, $data->total_qty);
            xlsWriteNumber($tablebody, $kolombody++, $data->id_bahan_rendam);
            xlsWriteNumber($tablebody, $kolombody++, $data->kg);
            xlsWriteNumber($tablebody, $kolombody++, $data->ball);
            xlsWriteLabel($tablebody, $kolombody++, $data->ket);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }
    public function save()
    {
        // Ambil data yang dikirim dari form
        $no_spk = $_POST['no_spk']; // Ambil data no_spk dan masukkan ke variabel no_spk
        $no_item = $_POST['no_item']; // Ambil data no_item dan masukkan ke variabel no_item
        $total_qty = $_POST['qty'];
        $id_bahan_rendam = $_POST['id_bahan_rendam']; // Ambil data id_bahan_rendam dan masukkan ke variabel id_bahan_rendam
        $ball = $_POST['ball']; // Ambil data ball dan masukkan ke variabel ball
        $kg = $_POST['kg']; // Ambil data kg dan masukkan ke variabel kg
        $ket = '0';
        $data = array();

        $index = 0; // Set index array awal dengan 0
        foreach ($no_item as $datano_item) { // Kita buat perulangan berdasarkan no_item sampai data terakhir
            array_push($data, array(
                'no_spk' => $no_spk[$index],
                'no_item' => $datano_item,
                'total_qty' => $total_qty[$index],
                'id_bahan_rendam' => $id_bahan_rendam[$index],  // Ambil dan set data id_bahan_rendam sesuai index array dari $index
                'ball' => $ball[$index],  // Ambil dan set data ball sesuai index array dari $index
                'kg' => $kg[$index],  // Ambil dan set data kg sesuai index array dari $index
                'ket' => $ket
            ));

            $index++;
        }

        $sql = $this->Detail_spk_model->save_batch($data); // Panggil fungsi save_batch yang ada di model siswa (Detail_po_model.php)

        // Cek apakah query insert nya sukses atau gagal
        if ($sql) { // Jika sukses
            echo "<script>alert('Data berhasil disimpan');window.location = '" . base_url('spk') . "';</script>";
        } else { // Jika gagal
            echo "<script>alert('Data gagal disimpan');window.location = '" . base_url('detail_spk/create') . "';</script>";
        }
    }
}

/* End of file Detail_spk.php */
/* Location: ./application/controllers/Detail_spk.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-04-22 13:29:43 */
/* http://harviacode.com */
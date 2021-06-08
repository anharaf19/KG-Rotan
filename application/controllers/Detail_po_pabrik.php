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

    public function json()
    {
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
                'id_po_pabrik' => $this->input->post('id_po_pabrik', TRUE),
                'no_item' => $this->input->post('no_item', TRUE),
                'qty' => $this->input->post('qty', TRUE),
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
                'id_po_pabrik' => $this->input->post('id_po_pabrik', TRUE),
                'no_item' => $this->input->post('no_item', TRUE),
                'qty' => $this->input->post('qty', TRUE),
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
    public function save()
    {
        // Ambil data yang dikirim dari form
        $id_po_pabrik = $_POST['id_po_pabrik']; // Ambil data no_spk dan masukkan ke variabel no_spk
        $no_item = $_POST['no_item']; // Ambil data no_item dan masukkan ke variabel no_item
        $qty = $_POST['qty'];
        $data = array();

        $index = 0; // Set index array awal dengan 0
        foreach ($no_item as $datano_item) { // Kita buat perulangan berdasarkan no_item sampai data terakhir
            array_push($data, array(
                'id_po_pabrik' => $id_po_pabrik[$index],
                'no_item' => $datano_item,
                'qty' => $qty[$index],
            ));

            $index++;
        }

        $sql = $this->Detail_po_pabrik_model->save_batch($data); // Panggil fungsi save_batch yang ada di model siswa (Detail_po_model.php)

        // Cek apakah query insert nya sukses atau gagal
        if ($sql) { // Jika sukses
            echo "<script>alert('Data berhasil disimpan');window.location = '" . base_url('po_pabrik') . "';</script>";
        } else { // Jika gagal
            echo "<script>alert('Data gagal disimpan');window.location = '" . base_url('detail_po_pabrik/create') . "';</script>";
        }
    }
}

/* End of file Detail_po_pabrik.php */
/* Location: ./application/controllers/Detail_po_pabrik.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-05-30 09:50:16 */
/* http://harviacode.com */
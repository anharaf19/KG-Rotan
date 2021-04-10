<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Detail_po extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Detail_po_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('detail_po/detail_po_list');
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Detail_po_model->json();
    }

    public function read($id)
    {
        $row = $this->Detail_po_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'no_po' => $row->no_po,
                'no_item' => $row->no_item,
                'nama_item' => $row->nama_item,
                'jenis_pack' => $row->jenis_pack,
                'total_order' => $row->total_order,
                'order_reff' => $row->order_reff,
                'pack' => $row->pack,
                'total_ctn' => $row->total_ctn,
                'cbm_ctn' => $row->cbm_ctn,
                'total_cbm' => $row->total_cbm,
                'harga_sub' => $row->harga_sub,
                'harga_anyam' => $row->harga_anyam,
            );
            $this->load->view('detail_po/detail_po_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('detail_po'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('detail_po/create_action'),
            'id' => set_value('id'),
            'no_po' => set_value('no_po'),
            'no_item' => set_value('no_item'),
            'nama_item' => set_value('nama_item'),
            'jenis_pack' => set_value('jenis_pack'),
            'total_order' => set_value('total_order'),
            'order_reff' => set_value('order_reff'),
            'pack' => set_value('pack'),
            'total_ctn' => set_value('total_ctn'),
            'cbm_ctn' => set_value('cbm_ctn'),
            'total_cbm' => set_value('total_cbm'),
            'harga_sub' => set_value('harga_sub'),
            'harga_anyam' => set_value('harga_anyam'),
        );
        $this->load->view('detail_po/detail_po_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'no_po' => $this->input->post('no_po', TRUE),
                'no_item' => $this->input->post('no_item', TRUE),
                'nama_item' => $this->input->post('nama_item', TRUE),
                'jenis_pack' => $this->input->post('jenis_pack', TRUE),
                'total_order' => $this->input->post('total_order', TRUE),
                'order_reff' => $this->input->post('order_reff', TRUE),
                'pack' => $this->input->post('pack', TRUE),
                'total_ctn' => $this->input->post('total_ctn', TRUE),
                'cbm_ctn' => $this->input->post('cbm_ctn', TRUE),
                'total_cbm' => $this->input->post('total_cbm', TRUE),
                'harga_sub' => $this->input->post('harga_sub', TRUE),
                'harga_anyam' => $this->input->post('harga_anyam', TRUE),
            );

            $this->Detail_po_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('detail_po'));
        }
    }
    public function save()
    {
        // Ambil data yang dikirim dari form
        $no_po = $_POST['no_po']; // Ambil data no_po dan masukkan ke variabel no_po
        $no_item = $_POST['no_item']; // Ambil data no_item dan masukkan ke variabel no_item
        $nama_item = $_POST['nama_item'];
        $jenis_pack = $_POST['jenis_pack']; // Ambil data jenis_pack dan masukkan ke variabel jenis_pack
        $total_order = $_POST['total_order']; // Ambil data total_order dan masukkan ke variabel total_order
        $order_reff = $_POST['order_reff']; // Ambil data order_reff dan masukkan ke variabel order_reff
        $pack = $_POST['pack']; // Ambil data pack dan masukkan ke variabel pack
        $total_ctn = $_POST['total_ctn']; // Ambil data total_ctn dan masukkan ke variabel total_ctn
        $cbm_ctn = $_POST['cbm_ctn']; // Ambil data cbm_ctn dan masukkan ke variabel cbm_ctn
        $total_cbm = $_POST['total_cbm']; // Ambil data total_cbm dan masukkan ke variabel total_cbm
        $harga_sub = $_POST['harga_sub'];
        $harga_anyam = $_POST['harga_anyam'];
        $data = array();

        $index = 0; // Set index array awal dengan 0
        foreach ($no_item as $datano_item) { // Kita buat perulangan berdasarkan no_item sampai data terakhir
            array_push($data, array(
                'no_po' => $no_po[$index],
                'no_item' => $datano_item,
                'nama_item' => $nama_item[$index],
                'jenis_pack' => $jenis_pack[$index],  // Ambil dan set data jenis_pack sesuai index array dari $index
                'total_order' => $total_order[$index],  // Ambil dan set data total_order sesuai index array dari $index
                'order_reff' => $order_reff[$index],  // Ambil dan set data order_reff sesuai index array dari $index
                'pack' => $pack[$index],  // Ambil dan set data pack sesuai index array dari $index
                'total_ctn' => $total_ctn[$index],  // Ambil dan set data total_ctn sesuai index array dari $index
                'cbm_ctn' => $cbm_ctn[$index],  // Ambil dan set data cbm_ctn sesuai index array dari $index
                'total_cbm' => $total_cbm[$index],  // Ambil dan set data total_cbm sesuai index array dari $index
                'harga_sub' => $harga_sub[$index],
                'harga_anyam' => $harga_anyam[$index],
            ));

            $index++;
        }

        $sql = $this->Detail_po_model->save_batch($data); // Panggil fungsi save_batch yang ada di model siswa (Detail_po_model.php)

        // Cek apakah query insert nya sukses atau gagal
        if ($sql) { // Jika sukses
            echo "<script>alert('Data berhasil disimpan');window.location = '" . base_url('po') . "';</script>";
        } else { // Jika gagal
            echo "<script>alert('Data gagal disimpan');window.location = '" . base_url('detail_po/create') . "';</script>";
        }
    }
    public function update($id)
    {
        $row = $this->Detail_po_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('detail_po/update_action'),
                'id' => set_value('id', $row->id),
                'no_po' => set_value('no_po', $row->no_po),
                'no_item' => set_value('no_item', $row->no_item),
                'nama_item' => set_value('nama_item', $row->nama_item),
                'jenis_pack' => set_value('jenis_pack', $row->jenis_pack),
                'total_order' => set_value('total_order', $row->total_order),
                'order_reff' => set_value('order_reff', $row->order_reff),
                'pack' => set_value('pack', $row->pack),
                'total_ctn' => set_value('total_ctn', $row->total_ctn),
                'cbm_ctn' => set_value('cbm_ctn', $row->cbm_ctn),
                'total_cbm' => set_value('total_cbm', $row->total_cbm),
                'harga_sub' => set_value('harga_sub', $row->harga_sub),
                'harga_anyam' => set_value('harga_anyam', $row->harga_anyam),
            );
            $this->load->view('detail_po/detail_po_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('detail_po'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'no_po' => $this->input->post('no_po', TRUE),
                'no_item' => $this->input->post('no_item', TRUE),
                'nama_item' => $this->input->post('nama_item', TRUE),
                'jenis_pack' => $this->input->post('jenis_pack', TRUE),
                'total_order' => $this->input->post('total_order', TRUE),
                'order_reff' => $this->input->post('order_reff', TRUE),
                'pack' => $this->input->post('pack', TRUE),
                'total_ctn' => $this->input->post('total_ctn', TRUE),
                'cbm_ctn' => $this->input->post('cbm_ctn', TRUE),
                'total_cbm' => $this->input->post('total_cbm', TRUE),
                'harga_sub' => $this->input->post('harga_sub', TRUE),
                'harga_anyam' => $this->input->post('harga_anyam', TRUE),
            );

            $this->Detail_po_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('detail_po'));
        }
    }

    public function delete($id)
    {
        $row = $this->Detail_po_model->get_by_id($id);

        if ($row) {
            $this->Detail_po_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('detail_po'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('detail_po'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('no_po', 'no po', 'trim|required');
        $this->form_validation->set_rules('no_item', 'no item', 'trim|required');
        $this->form_validation->set_rules('nama_item', 'nama item', 'trim|required');
        $this->form_validation->set_rules('jenis_pack', 'jenis pack', 'trim|required');
        $this->form_validation->set_rules('total_order', 'total order', 'trim|required');
        $this->form_validation->set_rules('order_reff', 'order reff', 'trim|required');
        $this->form_validation->set_rules('pack', 'pack', 'trim|required');
        $this->form_validation->set_rules('total_ctn', 'total ctn', 'trim|required');
        $this->form_validation->set_rules('cbm_ctn', 'cbm ctn', 'trim|required');
        $this->form_validation->set_rules('total_cbm', 'total cbm', 'trim|required');
        $this->form_validation->set_rules('harga_sub', 'harga sub', 'trim|required');
        $this->form_validation->set_rules('harga_anyam', 'harga anyam', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "detail_po.xls";
        $judul = "detail_po";
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
        xlsWriteLabel($tablehead, $kolomhead++, "No Po");
        xlsWriteLabel($tablehead, $kolomhead++, "No Item");
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Item");
        xlsWriteLabel($tablehead, $kolomhead++, "Jenis Pack");
        xlsWriteLabel($tablehead, $kolomhead++, "Total Order");
        xlsWriteLabel($tablehead, $kolomhead++, "Order Reff");
        xlsWriteLabel($tablehead, $kolomhead++, "Pack");
        xlsWriteLabel($tablehead, $kolomhead++, "Total Ctn");
        xlsWriteLabel($tablehead, $kolomhead++, "Cbm Ctn");
        xlsWriteLabel($tablehead, $kolomhead++, "Total Cbm");
        xlsWriteLabel($tablehead, $kolomhead++, "Harga Sub");
        xlsWriteLabel($tablehead, $kolomhead++, "Harga Anyam");

        foreach ($this->Detail_po_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->no_po);
            xlsWriteLabel($tablebody, $kolombody++, $data->no_item);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama_item);
            xlsWriteLabel($tablebody, $kolombody++, $data->jenis_pack);
            xlsWriteNumber($tablebody, $kolombody++, $data->total_order);
            xlsWriteLabel($tablebody, $kolombody++, $data->order_reff);
            xlsWriteNumber($tablebody, $kolombody++, $data->pack);
            xlsWriteNumber($tablebody, $kolombody++, $data->total_ctn);
            xlsWriteNumber($tablebody, $kolombody++, $data->cbm_ctn);
            xlsWriteNumber($tablebody, $kolombody++, $data->total_cbm);
            xlsWriteNumber($tablebody, $kolombody++, $data->harga_sub);
            xlsWriteNumber($tablebody, $kolombody++, $data->harga_anyam);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }
}

/* End of file Detail_po.php */
/* Location: ./application/controllers/Detail_po.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-04-09 22:26:42 */
/* http://harviacode.com */
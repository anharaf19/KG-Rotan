<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Keuangan_model extends CI_Model
{

    public $table = 'qc';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    function lihatiptgl($id_pabrik)
    {
        return $this->db->query("select * from qc where status='belum dibayar' && id_pabrik = $id_pabrik ")->result();
    }
    function lihatqcbayar()
    {
        return $this->db->query("select * from qc where status='sudah dibayar'")->result();
    }
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }
    public function get_qc_keyword($keyword, $id_pabrik)
    {
        return $this->db->query("SELECT * from (SELECT * FROM `qc` WHERE id_pabrik = $id_pabrik && status = 'belum dibayar')AS tabelqc WHERE tabelqc.no_spk LIKE '%$keyword%' OR tabelqc.no_item LIKE '%$keyword%'")->result();
    }
}


/* End of file Pabrik_model.php */
/* Location: ./application/models/Pabrik_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-03-19 11:59:24 */
/* http://harviacode.com */
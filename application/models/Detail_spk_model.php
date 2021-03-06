<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Detail_spk_model extends CI_Model
{

    public $table = 'detail_spk';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json()
    {
        $this->datatables->select('id,no_spk,no_item,total_qty,id_bahan_rendam,kg,ball,ket');
        $this->datatables->from('detail_spk');
        //add this line for join
        //$this->datatables->join('table2', 'detail_spk.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('detail_spk/read/$1'), 'Read') . " | " . anchor(site_url('detail_spk/update/$1'), 'Update') . " | " . anchor(site_url('detail_spk/delete/$1'), 'Delete', 'onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id');
        return $this->datatables->generate();
    }
    function get_no_item($id_po_pabrik)
    {
        $query = $this->db->get('detail_po_pabrik');
        $query = $this->db->where('id_po_pabrik', $id_po_pabrik);
        return $query;
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get total rows
    function total_rows($q = NULL)
    {
        $this->db->like('id', $q);
        $this->db->or_like('no_spk', $q);
        $this->db->or_like('no_item', $q);
        $this->db->or_like('total_qty', $q);
        $this->db->or_like('id_bahan_rendam', $q);
        $this->db->or_like('kg', $q);
        $this->db->or_like('ball', $q);
        $this->db->or_like('ket', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
        $this->db->or_like('no_spk', $q);
        $this->db->or_like('no_item', $q);
        $this->db->or_like('total_qty', $q);
        $this->db->or_like('id_bahan_rendam', $q);
        $this->db->or_like('kg', $q);
        $this->db->or_like('ball', $q);
        $this->db->or_like('ket', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
    //save batch data
    public function save_batch($data)
    {
        return $this->db->insert_batch('detail_spk', $data);
    }
}

/* End of file Detail_spk_model.php */
/* Location: ./application/models/Detail_spk_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-04-22 13:29:43 */
/* http://harviacode.com */
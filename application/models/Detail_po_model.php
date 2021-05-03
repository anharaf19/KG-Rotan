<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Detail_po_model extends CI_Model
{

    public $table = 'detail_po';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json()
    {
        $this->datatables->select('id,no_po,no_item,nama_item,jenis_pack,total_order,order_reff,pack,total_ctn,cbm_ctn,total_cbm,harga_sub,harga_anyam');
        $this->datatables->from('detail_po');
        //add this line for join
        //$this->datatables->join('table2', 'detail_po.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('detail_po/read/$1'), 'Read') . " | " . anchor(site_url('detail_po/update/$1'), 'Update') . " | " . anchor(site_url('detail_po/delete/$1'), 'Delete', 'onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id');
        return $this->datatables->generate();
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
        $this->db->or_like('no_po', $q);
        $this->db->or_like('no_item', $q);
        $this->db->or_like('nama_item', $q);
        $this->db->or_like('jenis_pack', $q);
        $this->db->or_like('total_order', $q);
        $this->db->or_like('order_reff', $q);
        $this->db->or_like('pack', $q);
        $this->db->or_like('total_ctn', $q);
        $this->db->or_like('cbm_ctn', $q);
        $this->db->or_like('total_cbm', $q);
        $this->db->or_like('harga_sub', $q);
        $this->db->or_like('harga_anyam', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
        $this->db->or_like('no_po', $q);
        $this->db->or_like('no_item', $q);
        $this->db->or_like('nama_item', $q);
        $this->db->or_like('jenis_pack', $q);
        $this->db->or_like('total_order', $q);
        $this->db->or_like('order_reff', $q);
        $this->db->or_like('pack', $q);
        $this->db->or_like('total_ctn', $q);
        $this->db->or_like('cbm_ctn', $q);
        $this->db->or_like('total_cbm', $q);
        $this->db->or_like('harga_sub', $q);
        $this->db->or_like('harga_anyam', $q);
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
        return $this->db->insert_batch('detail_po', $data);
    }
}

/* End of file Detail_po_model.php */
/* Location: ./application/models/Detail_po_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-04-22 13:29:43 */
/* http://harviacode.com */
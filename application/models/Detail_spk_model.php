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
    function json() {
        $this->datatables->select('id,id_spk,no_item,qty,id_bahan_rendam,ball,kg,detail_iptgl');
        $this->datatables->from('detail_spk');
        //add this line for join
        //$this->datatables->join('table2', 'detail_spk.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('detail_spk/read/$1'),'Read')." | ".anchor(site_url('detail_spk/update/$1'),'Update')." | ".anchor(site_url('detail_spk/delete/$1'),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id');
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
    function total_rows($q = NULL) {
        $this->db->like('id', $q);
	$this->db->or_like('id_spk', $q);
	$this->db->or_like('no_item', $q);
	$this->db->or_like('qty', $q);
	$this->db->or_like('id_bahan_rendam', $q);
	$this->db->or_like('ball', $q);
	$this->db->or_like('kg', $q);
	$this->db->or_like('detail_iptgl', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('id_spk', $q);
	$this->db->or_like('no_item', $q);
	$this->db->or_like('qty', $q);
	$this->db->or_like('id_bahan_rendam', $q);
	$this->db->or_like('ball', $q);
	$this->db->or_like('kg', $q);
	$this->db->or_like('detail_iptgl', $q);
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

}

/* End of file Detail_spk_model.php */
/* Location: ./application/models/Detail_spk_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-04-09 22:10:53 */
/* http://harviacode.com */
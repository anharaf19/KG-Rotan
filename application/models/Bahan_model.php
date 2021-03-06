<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bahan_model extends CI_Model
{

    public $table = 'bahan';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function jsonIsAdmin()
    {
        $this->datatables->select('id,nama,total_kg,total_ball,ket');
        $this->datatables->from('bahan');
        //add this line for join
        //$this->datatables->join('table2', 'bahan.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('bahan/read/$1'), 'Read') . " | " . anchor(site_url('bahan/update/$1'), 'Update') . " | " . anchor(site_url('bahan/delete/$1'), 'Delete', 'onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id');
        return $this->datatables->generate();
    }
    function json()
    {
        $this->datatables->select('id,nama,total_kg,total_ball,ket');
        $this->datatables->from('bahan');
        //add this line for join
        //$this->datatables->join('table2', 'bahan.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('bahan/read/$1'), 'Read'), 'id');
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
        $this->db->or_like('nama', $q);
        $this->db->or_like('total_kg', $q);
        $this->db->or_like('total_ball', $q);
        $this->db->or_like('ket', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
        $this->db->or_like('nama', $q);
        $this->db->or_like('total_kg', $q);
        $this->db->or_like('total_ball', $q);
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

    function lihattotal()
    {
        return $this->db->query("select sum(total_kg) as total_kg,sum(total_ball)as total_ball from bahan")->row();
    }
}

/* End of file Bahan_model.php */
/* Location: ./application/models/Bahan_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-04-22 13:29:43 */
/* http://harviacode.com */
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Po_model extends CI_Model
{

    public $table = 'po';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function jsonIsAdmin()
    {
        $this->datatables->select('po.id as id, no_po ,pembeli.id as idpembeli,nama,tgl_mulai ,tgl_selesai  ,po.ket as keterangan');
        $this->datatables->from('po');
        //add this line for join
        $this->datatables->join('pembeli', 'po.id_pembeli = pembeli.id');
        $this->datatables->add_column('action', anchor(site_url('po/read/$1'), 'Read') . " | " . anchor(site_url('po/update/$1'), 'Update') . " | " . anchor(site_url('po/delete/$1'), 'Delete', 'onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id');
        return $this->datatables->generate();
    }
    function json()
    {
        $this->datatables->select('po.id as id, no_po ,pembeli.id as idpembeli,nama,tgl_mulai ,tgl_selesai  ,po.ket as keterangan');
        $this->datatables->from('po');
        //add this line for join
        $this->datatables->join('pembeli', 'po.id_pembeli = pembeli.id');
        $this->datatables->add_column('action', anchor(site_url('po/read/$1'), 'Read'), 'id');
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
        $this->db->or_like('po', $q);
        $this->db->or_like('id_pembeli', $q);
        $this->db->or_like('tgl_mulai', $q);
        $this->db->or_like('tgl_selesai', $q);
        $this->db->or_like('ket', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
        $this->db->or_like('no_po', $q);
        $this->db->or_like('po', $q);
        $this->db->or_like('id_pembeli', $q);
        $this->db->or_like('tgl_mulai', $q);
        $this->db->or_like('tgl_selesai', $q);
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
    function lihatpembeli()
    {
        return $this->db->query("select * from pembeli")->result_array();
    }
    function lihatdetailpo($nopo)
    {
        return $this->db->query("select * from detail_po where no_po = '$nopo'")->result();
    }
}

/* End of file Po_model.php */
/* Location: ./application/models/Po_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-04-22 13:29:43 */
/* http://harviacode.com */
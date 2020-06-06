<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategoripelanggaran_model extends CI_Model{

    private $table = 'tb_tipe_pelanggaran';
    public $id = 'id';
    public $order_by = 'DESC';

	public function __construct(){
		parent::__construct();

	}


    function TotalDataKategoriPelanggaran($value = null){
        if ($value <> '') {
            $this->db->like($value);
        }
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function DataKategoriPelanggaran($limit, $start, $value = null){  
        if ($value <> '') {
            $this->db->like($value);
        }   
        $this->db->limit($limit, $start);
        $this->db->from($this->table);
        $this->db->order_by($this->id, $this->order_by);
        $query = $this->db->get();
        return $query;
    }

    function view(){
        return $this->db->get($this->table);
    }
    
    function getByID($id){
    	return $this->db->get_where($this->table, [$this->id => $id]);
    } 

    function insert($data){
    	return $this->db->insert($this->table, $data);
    }

    function update($data, $id){
    	return $this->db->update($this->table, $data, array($this->id => $id));
    }

    function delete($id){
    	return $this->db->delete($this->table, array($this->id => $id));
    }


}
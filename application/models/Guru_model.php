<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guru_model extends CI_Model{

    private $table = 'tb_guru';
    private $table_2 = 'tb_pelanggaran';
    public $nik = 'nik';
    public $id = 'id';
    public $id_pelanggaran = 'teacher_id';
    public $order_by = 'ASC';

	public function __construct(){
		parent::__construct();

	}


    function TotalDataGuru($value = null){
        if ($value <> '') {
            $this->db->like($value);
        }
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function DataGuru($limit, $start, $value = null){  
        if ($value <> '') {
            $this->db->like($value);
        }   
        $this->db->limit($limit, $start);
        $this->db->from($this->table);
        $this->db->order_by($this->id, $this->order_by);
        $query = $this->db->get();
        return $query;
    }

    function getByID($id){
    	return $this->db->get_where($this->table, [$this->id => $id]);
    } 

    function getByNIK($nik){
    	return $this->db->get_where($this->table, [$this->nik => $nik]);
    } 

    function CheckByID($id){
    	return $this->db->get_where($this->table_2, [$this->id_pelanggaran => $id]); // Tabel Pelanggaran
    } 

    function view(){
        return $this->db->get($this->table);
    }

    function insert($data){
    	return $this->db->insert($this->table, $data);
    }

    function insert_id($data){
        return $this->db->insert($this->table, $data);
    }

    function update($data, $id){
    	return $this->db->update($this->table, $data, array($this->id => $id));
    }

    function delete($id){
    	return $this->db->delete($this->table, array($this->id => $id));
    }

    function delete_pelanggaran($id){
    	return $this->db->delete($this->table_2, array($this->id_pelanggaran => $id));
    }

}
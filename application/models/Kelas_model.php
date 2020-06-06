<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas_model extends CI_Model{

    private $table = 'tb_kelas'; // Table Utama
    private $table_2 = 'tb_pelanggaran'; // Table Pelanggaran
    private $table_3 = 'tb_siswa'; // Table Siswa
    public $id = 'id';
    public $class_id = 'class_id'; // Field Yang Terdapat Di Pada Table 2 Dan 3
 	public $class_name = 'class_name';
    public $order_by = 'ASC';

	public function __construct(){
		parent::__construct();

	}


    function TotalDataKelas($value = null){
        if ($value <> '') {
            $this->db->like($value);
        }
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function DataKelas($limit, $start, $value = null){  
        if ($value <> '') {
            $this->db->like($value);
        }   
        $this->db->limit($limit, $start);
        $this->db->from($this->table);
        $this->db->order_by($this->id, $this->order_by);
        $query = $this->db->get();
        return $query;
    }

    // Get Data
    function getByID($id){
    	return $this->db->get_where($this->table, [$this->id => $id]);
    } 

    function getByName($name){
    	return $this->db->get_where($this->table, [$this->class_name => $name]);
    } 

	// Check Data
    function CheckPelanggaranByID($id){ 
    	return $this->db->get_where($this->table_2, [$this->class_id => $id]); //Cek Data Pada Tabel Pelanggaran
    } 

    function CheckSiswaByID($id){ 
    	return $this->db->get_where($this->table_3, [$this->class_id => $id]); //Cek Data Pada Tabel Siswa
    } 

    function getJsonBySub($sub){ 
        $this->db->where(['sub_class' => $sub]);
        $this->db->from($this->table);
        return $this->db->get();        
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

    function delete_pelanggaran($id){
    	return $this->db->delete($this->table_2, array($this->class_id => $id)); // Hapus Data Pada Table Pelanggaran
    }

    function delete_siswa($id){
    	return $this->db->delete($this->table_3, array($this->class_id => $id)); // Hapus Data Pada Table Siswa
    } 
}
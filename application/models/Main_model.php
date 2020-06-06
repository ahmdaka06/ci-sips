<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_model extends CI_Model{

	public function __construct(){
		parent::__construct();

	}

// Get Hall Of Fame

    public function TopPelanggaran(){
        $this->db->select('tb_pelanggaran.id');
        $this->db->select('count(tb_pelanggaran.id) as total_pelanggaran');
        $this->db->select('tb_pelanggaran.type_id');
        $this->db->select('tb_tipe_pelanggaran.violation_name');
        $this->db->from('tb_pelanggaran');
        $this->db->join('tb_tipe_pelanggaran','tb_pelanggaran.type_id = tb_tipe_pelanggaran.id');
        $this->db->group_by('tb_pelanggaran.type_id');
        $this->db->order_by('total_pelanggaran', 'desc');
        $this->db->limit(5);
        $query = $this->db->get();

        return $query->result();
    }

    public function TopMurid(){
        $this->db->select('SUM(tb_pelanggaran.point) as total_poin');
        $this->db->select('count(tb_pelanggaran.id) as total_pelanggaran');
        $this->db->select('tb_pelanggaran.type_id');
        $this->db->select('tb_siswa.std_name');
        $this->db->select('tb_siswa.nisn');
        $this->db->from('tb_pelanggaran');
        $this->db->join('tb_siswa','tb_pelanggaran.student_id = tb_siswa.id', 'left');
        $this->db->group_by('tb_pelanggaran.student_id');
        $this->db->order_by('total_poin', 'desc');
        $this->db->limit(5);
        $query = $this->db->get();

        return $query->result();
    }

	public function GetOrdersHOF(){
		$this->db->select('SUM(orders.price) as total_pembelian');
        $this->db->select('count(orders.id) as tcount');
        $this->db->select('orders.user_id');
        $this->db->select('users.full_name');
        $this->db->from('orders');
        $this->db->join('users','orders.user_id = users.id');
		$this->db->where(['MONTH(orders.created_at)' => date('m'), ' YEAR(orders.created_at)' => date('Y')]);
        $this->db->group_by('orders.user_id');
        $this->db->order_by('total_pembelian', 'desc');
        $this->db->limit(5);
		$query = $this->db->get();

		return $query->result_array();
	}
    
    public function GetServiceHOF(){
        $this->db->select('SUM(orders.price) as total_pembelian');
        $this->db->select('count(orders.id) as tcount');
        $this->db->select('orders.service_name');
        $this->db->select('services.service_name');
        $this->db->from('orders');
        $this->db->join('services','orders.service_name = services.service_name');
        $this->db->where(['MONTH(orders.created_at)' => date('m'), ' YEAR(orders.created_at)' => date('Y')]);
        $this->db->group_by('orders.service_name');
        $this->db->order_by('total_pembelian', 'desc');
        $this->db->limit(5);
        $query = $this->db->get();

        return $query->result_array();
    }

    function total($select = null, $table, $user){
        if ($select <> null){
        $this->db->select($select);
        }   
        $this->db->from($table);
        $this->db->where($user);
            return $this->db->get();
    }

    function get_note_level($select){
        $this->db->select($select);  
        $this->db->from('website');
            return $this->db->get();
    }  

	function UpdateWhere($table, $field, $column, $is_column){
		$this->db->set($field);
		$this->db->where($column, $is_column);
		$this->db->update($table);
		return $this;
	}

    function GetTotalRowsPaginationJoin($table, $value = null, $where = []){
    	if ($where == true) {
    		$this->db->where($where);
    	}	
        if ($value <> '') {
            $this->db->like($value);
        }
    	$this->db->from($table);
        $this->db->join('tb_kelas', 'tb_kelas.id = tb_siswa.class_id', 'right');
        return $this->db->count_all_results();
    }

    function GetPaginationJoin($table, $order_by, $limit, $start, $value = null, $where = []){
    	if ($where == true) {
    		$this->db->where($where);
        }    	  		
        $this->db->order_by('tb_siswa.id', $order_by);
        if ($value <> null) {
            $this->db->like($value);
        }
        $this->db->limit($limit, $start);
    	$this->db->from($table);
        $this->db->join('tb_kelas', 'tb_kelas.id = tb_siswa.class_id', 'right');
        return $this->db->get();
    }

    function TotalListSearchPelanggaran($value = null){
        if ($value <> null) {
            $this->db->like($value);
        }  
        $this->db->from('tb_pelanggaran');
        $this->db->join('tb_guru', 'tb_guru.id = tb_pelanggaran.teacher_id');
        $this->db->join('tb_wali', 'tb_wali.id = tb_pelanggaran.wali_id');
        $this->db->join('tb_kelas', 'tb_kelas.id = tb_pelanggaran.class_id');
        $this->db->join('tb_tipe_pelanggaran', 'tb_tipe_pelanggaran.id = tb_pelanggaran.type_id');
        $this->db->join('tb_siswa', 'tb_siswa.id = tb_pelanggaran.student_id');
        return $this->db->count_all_results();
    }

    function ListSearchPelanggaran($limit, $start, $value = null){            
        if ($value <> null) {
            $this->db->like($value);
        }
        $this->db->limit($limit, $start);
        $this->db->from('tb_pelanggaran');
        $this->db->join('tb_guru', 'tb_guru.id = tb_pelanggaran.teacher_id');
        $this->db->join('tb_wali', 'tb_wali.id = tb_pelanggaran.wali_id');
        $this->db->join('tb_kelas', 'tb_kelas.id = tb_pelanggaran.class_id');
        $this->db->join('tb_tipe_pelanggaran', 'tb_tipe_pelanggaran.id = tb_pelanggaran.type_id');
        $this->db->join('tb_siswa', 'tb_siswa.id = tb_pelanggaran.student_id');
        $this->db->order_by('tb_pelanggaran.id', 'desc');
        return $this->db->get();
    }

    function insert($table, $data){
            $this->db->insert($table, $data);
            return $this->db->insert_id();
    }

    function update_data($where, $data, $table){
            $this->db->where($where);
            $this->db->update($table, $data);
    }

	function Get($table, $where = null, $order_by, $limit){
		if ($where <> null) {
	    $this->db->where($where);
        }
	    $this->db->order_by($order_by);
        $this->db->limit($limit);
        $this->db->from($table);
		return $this->db->get();
	}

	function GetOrderBy($table, $column, $type){
			$this->db->order_by($column, $type);
			return $this->db->get($table);
	}

}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggaran_model extends CI_Model{

    private $table = 'tb_pelanggaran';
    public $table_join1 = 'tb_guru';
    public $table_join2 = 'tb_wali';
    public $table_join3 = 'tb_kelas';
    public $table_join4 = 'tb_tipe_pelanggaran';
    public $table_join5 = 'tb_siswa';
    public $join1 = 'tb_guru.id = tb_pelanggaran.teacher_id';
    public $join2 = 'tb_wali.id = tb_pelanggaran.wali_id';
    public $join3 = 'tb_kelas.id = tb_pelanggaran.class_id';
    public $join4 = 'tb_tipe_pelanggaran.id = tb_pelanggaran.type_id';
    public $join5 = 'tb_siswa.id = tb_pelanggaran.student_id';
    public $field_student = 'student_id';
    public $id = 'id';
    public $id_order_by = 'tb_pelanggaran.id';
    public $order_by = 'DESC';

	public function __construct(){
		parent::__construct();

	}



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

    function TotalDataPelanggaran($value = null){
        if ($value <> '') {
            $this->db->like($value);
        }
        $this->db->from($this->table);
        $this->db->join($this->table_join1, $this->join1);
        $this->db->join($this->table_join2, $this->join2);
        $this->db->join($this->table_join3, $this->join3);
        $this->db->join($this->table_join4, $this->join4);
        $this->db->join($this->table_join5, $this->join5);
        return $this->db->count_all_results();
    }

    function DataPelanggaran($limit, $start, $value = null){  
        if ($value <> '') {
            $this->db->like($value);
        }
        $this->db->join($this->table_join1, $this->join1);
        $this->db->join($this->table_join2, $this->join2);
        $this->db->join($this->table_join3, $this->join3);
        $this->db->join($this->table_join4, $this->join4);
        $this->db->join($this->table_join5, $this->join5);       
        $this->db->limit($limit, $start);
        $this->db->from($this->table);
        $this->db->order_by($this->id_order_by, $this->order_by);
        $query = $this->db->get();
        return $query;
    }

    function DataPelanggaranPrint($id){  
        $this->db->join($this->table_join1, $this->join1);
        $this->db->join($this->table_join2, $this->join2);
        $this->db->join($this->table_join3, $this->join3);
        $this->db->join($this->table_join4, $this->join4);
        $this->db->join($this->table_join5, $this->join5);      
        $this->db->from($this->table);
        $this->db->where(['tb_pelanggaran.id' => $id]);
        $query = $this->db->get();
        return $query;
    }

    public function CariTotalPelanggaranSiswa($id){
        $this->db->select('sum(point) as point');
        $this->db->from($this->table);
        $this->db->where($this->field_student, $id);
        $query = $this->db->get()->row();

        return $query;
    }

    function getByID($id){
        $this->db->join($this->table_join1, $this->join1);
        $this->db->join($this->table_join2, $this->join2);
        $this->db->join($this->table_join3, $this->join3);
        $this->db->join($this->table_join4, $this->join4);
        $this->db->join($this->table_join5, $this->join5);      
        $this->db->from($this->table);
        $this->db->where(['tb_pelanggaran.id' => $id]);
        $query = $this->db->get();
        return $query;
    } 

    // Check Data
    function CheckPelanggaranByID($id){ 
        return $this->db->get_where($this->table_2, ['student_id' => $id]); //Cek Data Pada Tabel Pelanggaran
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

}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model{

    private $table = 'tb_users';
    public $id = 'id';
    public $order_by = 'id';

	public function __construct(){
		parent::__construct();

	}

	// ========================== Check Data Users
    function CheckDataUser($username){      
        $this->db->where("username = '$username'");
        return $this->db->get($this->table);
    }

    function VerifPass($username,$password){      
    	$this->db->where("username = '$username'");
        $CekUser = $this->db->get($this->table)->result_array();
        foreach ($CekUser as $DataUser){}
            //Verif Password
        if(password_verify($password , $DataUser['password'])){
            return true;
        } else {
          return false;
        }
    }
    // ambil data berdasarkan cookie
    function get_by_cookie($cookie){
        $this->db->where('remember_me', $cookie);
        return $this->db->get($this->table);
    }    

    function change_password($data, $id){
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    function update_cookie($data, $id){
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    function TotalDataUsers($value = null){
        if ($value <> '') {
            $this->db->like($value);
        }
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function DataUsers($limit, $start, $value = null){  
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
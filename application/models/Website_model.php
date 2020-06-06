<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Website_model extends CI_Model{

    private $table = 'tb_website';
    public $id = 'id';
    public $update_id = '1';

	public function __construct(){
		parent::__construct();

	}

    function view(){  
        $query = $this->db->get($this->table);
        return $query->row();
    }


    function update($data){
        return $this->db->update($this->table, $data, array($this->id => $this->update_id));
    }

}
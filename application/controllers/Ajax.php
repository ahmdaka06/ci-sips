<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends MY_Controller {

	function __construct(){
		parent::__construct();  
	}
// Ajax Request Default
	public function list_kelas(){
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
				if (!$this->input->post('sub_kelas')) {
					exit("Not Access!");
				}
				if (empty($this->input->post('sub_kelas'))) {
					exit('<option value="0">Pilih Kategori...</option>');
				}
					$input_kategori = $this->db->escape_str(filter($this->input->post('sub_kelas', true)));
					$cek_kelas = $this->Main_model->Get('tb_kelas', ['sub_class' => $input_kategori], '"name", "asc"', null);
					print('<option value="0">Pilih Salah Satu...</option>');
					if ($cek_kelas->num_rows() == 0) {
						print('<option value="0">Tidak Tersedia...</option>');							
					} else {
												foreach ($cek_kelas->result() as $kelas) {
						print('<option value="'.$kelas->id.'">'.$kelas->name.'</option>');
					}
				}
			} else {
			exit("Not Access!");
		}
	}

}

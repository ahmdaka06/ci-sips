<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends MY_Controller {

    function __construct(){
        parent::__construct();   
        $this->session('Guru');
        $this->load->model('Users_model');
    }

    public function index(){
            if (count($this->input->post())) {
                if ($this->form_validation('change-password') == true) {
                    $this->setting_password($this->data_user()->id);
                }
            }
            $data['page'] = 'Pengaturan';
            $data['login'] = $this->data_user();
            $this->template('setting', $data);
    }    

    public function setting_password($id = null){
            if (!isset($id)) {
            $this->session->set_flashdata('result', ['alert' => 'danger', 'title' => 'Request Gagal', 'msg' => 'Aksi Tidak Bisa Diterima.']);
            redirect('setting');
            } 
            $login = $this->data_user();  
            if (count($this->input->post())) {
                if ($this->form_validation('change-password') == true) {
			     $old_pass = $this->db->escape_str(filter($this->input->post('old_pass', true))); 
			     $new_pass = $this->db->escape_str(filter($this->input->post('new_pass', true))); 
			     $conf_pass = $this->db->escape_str(filter($this->input->post('conf_new_pass', true)));
					$check_password = password_verify($old_pass, $login->password);
					$hash_new_password = hash_pw($new_pass);
						if ($check_password == false) {
							$this->session->set_flashdata('result', ['alert' => 'danger', 'title' => 'Request Gagal', 'msg' => 'Password Lama Yang Anda Inputkan Tidak Sesuai !!.']);
							redirect('setting');
							} else {
								$this->session->set_flashdata('result', ['alert' => 'success', 'title' => 'Request Gagal', 'msg' => 'Fitur Dinonaktifkan.']);
							redirect('setting');
						}
                    }
            }
    }    
    
}
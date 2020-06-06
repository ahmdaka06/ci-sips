<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model(array('Users_model'));
    }

	public function index(){
		redirect(base_url('404'));
	}

	public function login(){
        $cookie = get_cookie('ahmadandika');
        // cek session
        if ($this->session->userdata('login') == true) {
            if ($this->session->userdata('level') == 'Admin') {
            redirect('admin', 'refresh');
            } else {
            redirect('dashboard');
            }
        } else if($cookie <> '') {
            // cek cookie
            $row = $this->Users_model->get_by_cookie($cookie)->row();
            if ($row) {
                $this->_insert_session($row);
            }
        } else if (count($this->input->post())) { // kek gini contohnya
            $this->form_validation->set_rules(
                'username', 'Username', 
                'required',
                    array(
                        'required'      => 'Username  Wajib Diisi'
                    )
                );
            $this->form_validation->set_rules(
                'password', 'Password',
                'required|min_length[8]',
                    array(
                        'required'      => 'Password Wajib Diisi',
                        'min_length'      => 'Minimal Memasukkan 8 Karakter Pada Kolom Password'
                    )
                );
            // Jika Form Validation Benar
            if ($this->form_validation->run() == true) {   
                $this->sign_in();
                }
            }   
		$data['page'] = 'Login';
        $data['DataWebsite'] = $this->db->get_where('tb_website', ['id' => '1'])->row(); 
		$this->load->view('auth/header', $data);
		$this->load->view('auth/login', $data);
		$this->load->view('auth/footer', $data);
	}	

    public function sign_in(){
        if (count($this->input->post())) { // kek gini contohnya
            $username = $this->db->escape_str($this->input->post('username', true)); 
            $password = $this->db->escape_str($this->input->post('password', true)); 
            $remember = $this->db->escape_str($this->input->post('remember', true)); 
            if ($this->Users_model->CheckDataUser($username)->num_rows() == 1){
                if ($this->Users_model->CheckDataUser($username)->row('status') == '1'){
                    if ($this->Users_model->VerifPass($username,$password) == true){
                $login = $this->Users_model->CheckDataUser($username)->row();
                    if ($remember) {
                        $key = random_string('alnum', 64);
                        set_cookie('ahmadandika', $key, 3600*24*30); // set expired 30 hari kedepan
                        // simpan key di database
                        $update_key = array(
                            'remember_me' => $key
                        );
                        $this->Users_model->update_cookie($update_key, $login->id);
                    }   
                        $this->_insert_session($login);

                        } else {
                            $result = array('alert' => 'danger', 'title' => 'Login Gagal !', 'msg' => 'Password Tidak Sesuai');
                            $this->session->set_flashdata('result', $result);
                            redirect('auth/login', 'refresh');                    
                        }
                    } else {
                        $result = array('alert' => 'danger', 'title' => 'Login Gagal !', 'msg' => 'Akun Telah Di Nonaktifkan');
                        $this->session->set_flashdata('result', $result);
                        redirect('auth/login', 'refresh'); 
                    }
                } else {
                    $result = array('alert' => 'danger', 'title' => 'Login Gagal !', 'msg' => 'Akun Tidak Terdaftar');
                    $this->session->set_flashdata('result', $result);
                    redirect('auth/login', 'refresh'); 
                }
            }
    }

    public function _insert_session($row) {
        // 1. Daftarkan Session
        $user_data = array(
            'id'       => $row->id,
            'email'    => $row->email,
            'username' => $row->username,
            'level'    => $row->level,
            'login'    => true,
            );
        $this->session->set_userdata($user_data);
        // 2. Redirect ke dashboard
            if ($row->level == 'Admin') {
                redirect('admin','refresh');
            } else {
                redirect('dashboard','refresh');    
            }
    }

	public function logout(){
        delete_cookie('ahmadandika');
		$this->session->sess_destroy();       
		redirect('');
	}

}

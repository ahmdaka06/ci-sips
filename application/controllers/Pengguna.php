<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends MY_Controller {

	function __construct(){
		parent::__construct();   
        $this->session('Admin');
        $this->load->model(array('Users_model'));
	}

    public function index(){
        $keyword = $this->db->escape_str(filter($this->input->get('search', true)));
        $config['per_page'] = 20;  //show record per halaman
        $config['base_url'] = site_url('users/index');
        $config['total_rows'] = $this->Users_model->TotalDataUsers(['username' => $keyword]);  
        $per_page = $config['per_page'];
        $config['uri_segment'] = 3;  // uri parameter
        $choice = $config['total_rows'] / $per_page;
        $config['num_links'] = 2;
        if ($keyword <> '') {
        $config['suffix'] = '?' . http_build_query($_GET, '', "&");
        } else if (http_build_query($_GET, '', "&")) {
        $config['suffix'] = '?' . http_build_query($_GET, '', "&"); 
        } else {
        $config['suffix'] = '' . http_build_query($_GET, '', "&");    
        }
        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<ul class="pagination"><li class="page-item">';
        $config['full_tag_close']   = '</ul></li>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
 
        $this->pagination->initialize($config);
        $data['uri'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['list'] = $this->Users_model->DataUsers($config['per_page'], $data['uri'], ['username' => $keyword]);
        $data['page'] = 'List Pengguna';
        $data['login'] = $this->data_user();
        $data['total_rows'] = $config['total_rows'];
        $data['pagination'] = $this->pagination->create_links();
        $this->template_admin('admin/list-pengguna', $data);
    }

        public function tambah(){
            if (count($this->uri->segment_array()) > 2) {
                redirect('admin');
            }            
                if (count($this->input->post())) {
                    if ($this->form_validation('pengguna') == true) { 
                        $post_nama = $this->db->escape_str($this->input->post('nama', true));
                        $post_email = $this->db->escape_str($this->input->post('email', true));
                        $post_username = $this->db->escape_str($this->input->post('username', true));
                        $post_password = $this->db->escape_str($this->input->post('password', true));
                        $post_level = $this->db->escape_str($this->input->post('level', true));

                        $hass_pass = hash_pw($post_password);
                                $data_pengguna = [
                                        'full_name' => $post_nama,
                                        'email' => $post_email,
                                        'username' => $post_username,
                                        'password' => $hass_pass,
                                        'level' => $post_level,
                                        'status' => '1'
                                        ];   
                                $insert = $this->Users_model->insert($data_pengguna);
                                if ($insert == true) {
                                        $this->session->set_flashdata('result', ['alert' => 'success', 'title' => 'Berhasil', 'msg' => 'Data Baru Berhasil Ditambahkan']);
                                } else {
                                        $this->session->set_flashdata('result', ['alert' => 'danger', 'title' => 'Gagal', 'msg' => 'Terjadi Kesalahan']);
                                }
                    }
                } 
                $data['login'] = $this->data_user();
                $data['page'] = 'Tambah Pengguna';
                $this->template_admin('admin/pengguna/add', $data);                
        } 

        public function edit($id = null){
            if (count($this->uri->segment_array()) > 3) {
                redirect('admin');
            } 
                if (!isset($id)) {
                $this->session->set_flashdata('result', ['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Data tidak ditemukan.']);
                redirect('pengguna');
                } 

                if (!is_numeric($id)) {
                $this->session->set_flashdata('result', ['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Data tidak ditemukan.']);
                redirect('pengguna');
                } 

                $data_pengguna = $this->Users_model->getByID($this->db->escape_str(filter($id, true)));   

                if ($data_pengguna->num_rows() == 0) {
                    $this->session->set_flashdata('result', ['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Data tidak ditemukan.']);
                    redirect('pengguna');
                }   
                if (count($this->input->post())) {
                        if ($this->form_validation('pengguna_edit') == true) { 
                            $post_nama = $this->db->escape_str($this->input->post('nama', true));
                            $post_email = $this->db->escape_str($this->input->post('email', true));
                            $post_username = $this->db->escape_str($this->input->post('username', true));
                            $post_password = $this->db->escape_str($this->input->post('pass', true));
                            $post_level = $this->db->escape_str($this->input->post('level', true));

                            $hass_pass = hash_pw($post_password);

                            if (empty($post_password)) {
                                    $update_post = [
                                            'full_name' => $post_nama,
                                            'email' => $post_email,
                                            'username' => $post_username,
                                            'level' => $post_level,
                                            'status' => '1'
                                            ];
                            } else {
                                    $update_post = [
                                            'full_name' => $post_nama,
                                            'email' => $post_email,
                                            'username' => $post_username,
                                            'password' => $hass_pass,
                                            'level' => $post_level,
                                            'status' => '1'
                                            ];  
                            } 
                                $update = $this->Users_model->update($update_post, $this->db->escape_str(filter($id, true)));
                                if ($update == true) {
                                        $this->session->set_flashdata('result', ['alert' => 'success', 'title' => 'Berhasil!', 'msg' => 'Data Berhasil Di Ubah.']);
                                        redirect('pengguna');
                                } else {
                                        $this->session->set_flashdata('result', ['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Terjadi Kesalahan.']);
                                }     
                        }
                }
                $data['page'] = 'Edit Pengguna';
                $data['login'] = $this->data_user();
                $data['pengguna'] = $data_pengguna->row();
                $this->template_admin('admin/pengguna/edit', $data);
        }               

        public function hapus(){   
                if (count($this->input->post())) {
                $post_id = $this->input->post($this->db->escape_str(filter('id', true)));
                
                $data_pengguna = $this->Users_model->getByID($post_id);  

                        if ($data_pengguna->num_rows() == 0) {
                        $this->session->set_flashdata('result', ['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Data tidak ditemukan.']);
                        redirect('pengguna');
                        } else {
                            $delete = $this->Users_model->delete($post_id);
                                if ($delete == true) {
                                   $this->session->set_flashdata('result', ['alert' => 'success', 'title' => 'Berhasil!', 'msg' => 'Data Berhasil Di Hapus.']);
                                   redirect('pengguna');
                                } else {
                                   $this->session->set_flashdata('result', ['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Terjadi Kesalahan.']);
                                   redirect('pengguna');

                                }
                        }
                }
        }               
}

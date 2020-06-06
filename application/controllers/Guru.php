<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guru extends MY_Controller {

	function __construct(){
		parent::__construct();   
        $this->session('Admin');
        $this->load->model(array('Guru_model'));
		if(!$this->session->userdata('login') == true) {
			redirect('auth/login', 'refresh');
		}
	}

    public function index(){
        $keyword = $this->db->escape_str(filter($this->input->get('search', true)));
        $config['per_page'] = 20;  //show record per halaman
        $config['base_url'] = site_url('guru/index');
        $config['total_rows'] = $this->Guru_model->TotalDataGuru(['nik' => $keyword]);  
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
        $data['list'] = $this->Guru_model->DataGuru($config['per_page'], $data['uri'], ['nik' => $keyword]);
        $data['page'] = 'List Guru';
        $data['login'] = $this->data_user();
        $data['total_rows'] = $config['total_rows'];
        $data['pagination'] = $this->pagination->create_links();
        $this->template_admin('admin/list-guru', $data);
    }

        public function tambah(){
            if (count($this->uri->segment_array()) > 2) {
                redirect('admin');
            }            
                if (count($this->input->post())) {
                    if ($this->form_validation('guru') == true) { 
                        $post_nik = $this->db->escape_str($this->input->post('nik', true));
                        $post_name = $this->db->escape_str($this->input->post('nama', true));
                        $post_mapel = $this->db->escape_str($this->input->post('mapel', true));

                        $data_guru = $this->Guru_model->getByNIK($post_nik);

                        if ($data_guru->num_rows() == 1) {
                             $this->session->set_flashdata('result', ['alert' => 'danger', 'title' => 'Gagal', 'msg' => 'Data Guru Sudah Tersedia']);
                        } else {
                                $data = [
                                        'nik' => $post_nik,
                                        'teacher_name' => $post_name,
                                        'subject' => $post_mapel
                                        ];  
                                $insert = $this->Guru_model->insert($data);
                                if ($insert == true) {
                                        $this->session->set_flashdata('result', ['alert' => 'success', 'title' => 'Berhasil', 'msg' => 'Data Baru Berhasil Ditambahkan']);
                                } else {
                                        $this->session->set_flashdata('result', ['alert' => 'danger', 'title' => 'Gagal', 'msg' => 'Terjadi Kesalahan']);
                                }
                        }
                    }
                } 
                $data['login'] = $this->data_user();
                $data['page'] = 'Tambah Guru';
                $this->template_admin('admin/guru/add', $data);                
        } 

        public function edit($id = null){
            if (count($this->uri->segment_array()) > 3) {
                redirect('admin');
            } 
                if (!isset($id)) {
                $this->session->set_flashdata('result', ['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Data tidak ditemukan.']);
                redirect('guru');
                } 

                if (!is_numeric($id)) {
                $this->session->set_flashdata('result', ['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Data tidak ditemukan.']);
                redirect('guru');
                } 
                $data_guru = $this->Guru_model->getByID($this->db->escape_str(filter($id, true)));   

                if ($data_guru->num_rows() == 0) {
                    $this->session->set_flashdata('result', ['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Data tidak ditemukan.']);
                    redirect('guru');
                }   
                if (count($this->input->post())) {
                    if ($this->form_validation('guru') == true) { 
                        $post_nik = $this->db->escape_str($this->input->post('nik', true));
                        $post_name = $this->db->escape_str($this->input->post('nama', true));
                        $post_mapel = $this->db->escape_str($this->input->post('mapel', true));
                                        
                                $update_post = [
                                        'nik' => $post_nik,
                                        'teacher_name' => $post_name,
                                        'subject' => $post_mapel
                                        ];   
                                $update = $this->Guru_model->update($update_post, $this->db->escape_str(filter($id, true)));
                                if ($update == true) {
                                        $this->session->set_flashdata('result', ['alert' => 'success', 'title' => 'Berhasil!', 'msg' => 'Data Berhasil Di Ubah.']);
                                        redirect('guru');
                                } else {
                                        $this->session->set_flashdata('result', ['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Terjadi Kesalahan.']);
                                }
                        }
                }
                $data['page'] = 'Edit Guru';
                $data['login'] = $this->data_user();
                $data['guru'] = $data_guru->row();
                $this->template_admin('admin/guru/edit', $data);
        }               

        public function hapus(){   
                if (count($this->input->post())) {
                $post_id = $this->input->post($this->db->escape_str(filter('id', true)));
                $data_guru = $this->Guru_model->getByID($post_id);   
                $check_data_pelanggaran = $this->Guru_model->CheckByID($post_id);
                        if ($data_guru->num_rows() == 0) {
                        $this->session->set_flashdata('result', ['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Data tidak ditemukan.']);
                        redirect('guru');
                        } else {
                        if ($check_data_pelanggaran->num_rows() > 0) {
                            $delete = $this->Guru_model->delete_pelanggaran($post_id);
                        }
                            $delete = $this->Guru_model->delete($post_id);
                                if ($delete == true) {
                                   $this->session->set_flashdata('result', ['alert' => 'success', 'title' => 'Berhasil!', 'msg' => 'Data Berhasil Di Hapus.']);
                                   redirect('guru');
                                } else {
                                   $this->session->set_flashdata('result', ['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Terjadi Kesalahan.']);
                                   redirect('guru');

                                }
                        }
                }
        }               
}

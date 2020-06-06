<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends MY_Controller {

	function __construct(){
		parent::__construct();   
        $this->session('Admin');
        $this->load->model(array('Guru_model', 'Kelas_model'));
	}

    public function index(){
        $keyword = $this->db->escape_str(filter($this->input->get('search', true)));
        $config['per_page'] = 20;  //show record per halaman
        $config['base_url'] = site_url('kelas/index');
        $config['total_rows'] = $this->Kelas_model->TotalDataKelas(['class_name' => $keyword]);  
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
        $data['list'] = $this->Kelas_model->DataKelas($config['per_page'], $data['uri'], ['class_name' => $keyword]);
        $data['page'] = 'List Kelas';
        $data['login'] = $this->data_user();
        $data['total_rows'] = $config['total_rows'];
        $data['pagination'] = $this->pagination->create_links();
        $this->template_admin('admin/list-kelas', $data);
    }

        public function tambah(){
            if (count($this->uri->segment_array()) > 2) {
                redirect('admin');
            }            
                if (count($this->input->post())) {
                    if ($this->form_validation('kelas') == true) { 
                        $post_kelas = $this->db->escape_str($this->input->post('kelas', true));
                        $post_nama_kelas = $this->db->escape_str($this->input->post('nama_kelas', true));
                        $post_wali_kelas = $this->db->escape_str($this->input->post('wali_kelas', true));
                        $post_total_siswa = $this->db->escape_str($this->input->post('total_siswa', true));

                        $data_kelas = $this->Kelas_model->getByName($post_nama_kelas);

                        $data_guru = $this->Guru_model->getByID($post_wali_kelas);
                        $row_guru = $data_guru->row();

                        if ($data_kelas->num_rows() == 1) {
                             $this->session->set_flashdata('result', ['alert' => 'danger', 'title' => 'Gagal', 'msg' => 'Data Kelas Sudah Tersedia']);
                        } else if ($data_guru->num_rows() == 0) {
                             $this->session->set_flashdata('result', ['alert' => 'danger', 'title' => 'Gagal', 'msg' => 'Data Guru Tidak Tersedia']);
                        } else {
                                $data = [
                                        'wali_name' => $row_guru->teacher_name,
                                        'class_name' => $post_nama_kelas,
                                        'sub_class' => $post_kelas,
                                        'total_students' => $post_total_siswa
                                        ];   
                                $insert = $this->Kelas_model->insert($data);
                                if ($insert == true) {
                                        $this->session->set_flashdata('result', ['alert' => 'success', 'title' => 'Berhasil', 'msg' => 'Data Baru Berhasil Ditambahkan']);
                                } else {
                                        $this->session->set_flashdata('result', ['alert' => 'danger', 'title' => 'Gagal', 'msg' => 'Terjadi Kesalahan']);
                                }
                        }
                    }
                } 
                $data['login'] = $this->data_user();
                $data['page'] = 'Tambah Kelas';
                $data['guru'] = $this->Guru_model->view()->result();
                $this->template_admin('admin/kelas/add', $data);                
        } 

        public function edit($id = null){
            if (count($this->uri->segment_array()) > 3) {
                redirect('admin');
            } 
                if (!isset($id)) {
                $this->session->set_flashdata('result', ['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Data tidak ditemukan.']);
                redirect('kelas');
                } 

                if (!is_numeric($id)) {
                $this->session->set_flashdata('result', ['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Data tidak ditemukan.']);
                redirect('kelas');
                } 

                $data_kelas = $this->Kelas_model->getByID($this->db->escape_str(filter($id, true)));   

                if ($data_kelas->num_rows() == 0) {
                    $this->session->set_flashdata('result', ['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Data tidak ditemukan.']);
                    redirect('kelas');
                }   
                if (count($this->input->post())) {
                        if ($this->form_validation('kelas') == true) { 
                                $post_kelas = $this->db->escape_str($this->input->post('kelas', true));
                                $post_nama_kelas = $this->db->escape_str($this->input->post('nama_kelas', true));
                                $post_wali_kelas = $this->db->escape_str($this->input->post('wali_kelas', true));
                                $post_total_siswa = $this->db->escape_str($this->input->post('total_siswa', true));

                                $data_kelas = $this->Kelas_model->getByName($post_nama_kelas);

                                $data_guru = $this->Guru_model->getByID($post_wali_kelas);
                                $row_guru = $data_guru->row();
                                       
                                $update_post = [
                                                'wali_name' => $post_wali_kelas,
                                                'class_name' => $post_nama_kelas,
                                                'sub_class' => $post_kelas,
                                                'total_students' => $post_total_siswa
                                        ];  
                                $update = $this->Kelas_model->update($update_post, $this->db->escape_str(filter($id, true)));
                                if ($update == true) {
                                        $this->session->set_flashdata('result', ['alert' => 'success', 'title' => 'Berhasil!', 'msg' => 'Data Berhasil Di Ubah.']);
                                        redirect('kelas');
                                } else {
                                        $this->session->set_flashdata('result', ['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Terjadi Kesalahan.']);
                                }     
                        }
                }
                $data['page'] = 'Edit Kelas';
                $data['login'] = $this->data_user();
                $data['guru'] = $this->Guru_model->view()->result();
                $data['kelas'] = $data_kelas->row();
                $this->template_admin('admin/kelas/edit', $data);
        }               

        public function hapus(){   
                if (count($this->input->post())) {
                $post_id = $this->input->post($this->db->escape_str(filter('id', true)));
                
                $data_kelas = $this->Kelas_model->getByID($post_id);   
                $check_data_pelanggaran = $this->Kelas_model->CheckPelanggaranByID($post_id);
                $check_data_siswa = $this->Kelas_model->CheckSiswaByID($post_id);

                        if ($data_kelas->num_rows() == 0) {
                        $this->session->set_flashdata('result', ['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Data tidak ditemukan.']);
                        redirect('kelas');
                        } else {
                        if ($check_data_pelanggaran->num_rows() > 0 AND $check_data_siswa->num_rows() > 0) {
                            $delete = $this->Kelas_model->delete_pelanggaran($post_id);
                            $delete = $this->Kelas_model->delete_siswa($post_id);
                        }
                            $delete = $this->Kelas_model->delete($post_id);
                                if ($delete == true) {
                                   $this->session->set_flashdata('result', ['alert' => 'success', 'title' => 'Berhasil!', 'msg' => 'Data Berhasil Di Hapus.']);
                                   redirect('kelas');
                                } else {
                                   $this->session->set_flashdata('result', ['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Terjadi Kesalahan.']);
                                   redirect('kelas');

                                }
                        }
                }
        }               
}

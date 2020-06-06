<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends MY_Controller {

    function __construct(){
        parent::__construct(); 
        $this->session('Guru');  
        $this->load->model(array('Siswa_model', 'Kelas_model', 'Wali_model'));
    }

    public function index(){
        $keyword = $this->db->escape_str(filter($this->input->get('search', true)));
        $config['per_page'] = 20;  //show record per halaman
        $config['base_url'] = site_url('siswa/index');
        $config['total_rows'] = $this->Siswa_model->TotalDataSiswa(['nisn' => $keyword]);  
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
        $data['list'] = $this->Siswa_model->DataSiswa($config['per_page'], $data['uri'], ['nisn' => $keyword]);
        $data['page'] = 'List Siswa';
        $data['login'] = $this->data_user();
        $data['total_rows'] = $config['total_rows'];
        $data['pagination'] = $this->pagination->create_links();
        if ($this->data_user()->level == 'Admin') {
        $this->template_admin('admin/list-siswa', $data);
        } else {
        $this->template('admin/list-siswa', $data);    
        }
    }
              
    public function search($search){
        if (!isset($search)) {
            $this->session->set_flashdata('result', ['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Data tidak ditemukan.']);
            redirect('dashboard');
        } 
        if (count($this->uri->segment_array()) > 4) {
            redirect('dashboard');
        }
        if (http_build_query($_GET, '', "&")) {
        $config['suffix'] = '?' . http_build_query($_GET, '', "&"); 
        } else {
        $config['suffix'] = '' . http_build_query($_GET, '', "&");    
        }
        $cek_siswa = $this->Siswa_model->CariSiswa($this->db->escape_str(filter($search)));
        $siswa = $cek_siswa->row();
        if ($cek_siswa->num_rows() == 0) {
            $data['hasil'] = 'Tidak Ditemukan';
        } else {
            $data['hasil'] = 'Ditemukan';
        }
        $config['per_page'] = 20;  //show record per halaman
        $config['base_url'] = site_url('siswa/search/'.$search.'');
        $config['total_rows'] = $this->Siswa_model->TotalDataPelanggaranSiswa(['student_id' => $siswa->id]);  
        $per_page = $config['per_page'];
        $config['uri_segment'] = 4;  // uri parameter
        $choice = $config['total_rows'] / $per_page;
        $config['num_links'] = 2;
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
        $data['uri'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data['list'] = $this->Siswa_model->DataPelanggaranSiswa($config['per_page'], $data['uri'], ['student_id' => $siswa->id]);
        $data['total_rows'] = $config['total_rows'];
        $data['pagination'] = $this->pagination->create_links();
        $data['page'] = 'Search ' . $search;
        $data['siswa'] = $siswa;
        $data['total_point'] = $this->Pelanggaran_model->CariTotalPelanggaranSiswa($siswa->id)->point;
        $data['login'] = $this->data_user();
        $this->template('search', $data);
    }

        public function tambah(){
            if (count($this->uri->segment_array()) > 2) {
                redirect('admin');
            }            
                if (count($this->input->post())) {
                    if ($this->form_validation('siswa') == true) { 
                                $post_nisn = $this->db->escape_str($this->input->post('nisn', true));
                                $post_nama = $this->db->escape_str($this->input->post('nama', true));
                                $post_sub_kelas = $this->db->escape_str($this->input->post('sub_kelas', true));
                                $post_kelas = $this->db->escape_str($this->input->post('kelas', true));
                                $post_ortu = $this->db->escape_str($this->input->post('orang_tua', true));
                                $post_alamat = $this->db->escape_str($this->input->post('alamat', true));
                                $post_phone = $this->db->escape_str($this->input->post('phone', true));

                                $kelas = $this->Kelas_model->getByID($post_kelas);
                                $count_kelas = $kelas->num_rows();
                                $row_kelas = $kelas->row();

                                $murid = $this->Siswa_model->getByNISN($post_nisn);
                                $count_murid = $murid->num_rows();
                                $row_murid = $murid->num_rows();

                                if ($count_kelas == 0) {
                                        $this->session->set_flashdata('result', ['alert' => 'danger', 'title' => 'Gagal', 'msg' => 'Data Kelas Tidak Tersedia']);
                                } else if ($count_murid == 1) {
                                        $this->session->set_flashdata('result', ['alert' => 'danger', 'title' => 'Gagal', 'msg' => 'Data Siswa Sudah Tersedia']);                                    
                                } else {
                                        $data_murid = [
                                                'nisn' => $post_nisn,
                                                'std_name' => $post_nama,
                                                'class_id' => $row_kelas->id,
                                                'address' => $post_alamat,
                                                'phone_number' => $post_phone
                                                ];  
                                        $insert = $this->Siswa_model->insert_id($data_murid);
                                        if ($insert == true) {
                                        $this->Wali_model->insert(['student_id' => $insert, 'parent_name' => $post_ortu, 'phone_number' => $post_phone]);
                                                $this->session->set_flashdata('result', ['alert' => 'success', 'title' => 'Berhasil', 'msg' => 'Data Siswa Baru Berhasil Ditambahkan']);
                                        } else {
                                                $this->session->set_flashdata('result', ['alert' => 'danger', 'title' => 'Gagal', 'msg' => 'Terjadi Kesalahan']);
                                        }
                                }
                            }
                        } 
                $data['login'] = $this->data_user();
                $data['page'] = 'Tambah Siswa';
                if ($this->data_user()->level == 'Admin') {
                $this->template_admin('admin/siswa/add', $data);
                } else {
                $this->template('admin/siswa/add', $data);    
                }             
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
                redirect('siswa');
                } 
                $data_siswa = $this->Siswa_model->getByID($this->db->escape_str(filter($id, true)));   

                if ($data_siswa->num_rows() == 0) {
                    $this->session->set_flashdata('result', ['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Data tidak ditemukan.']);
                    redirect('siswa');
                }   
                if (count($this->input->post())) {
                    if ($this->form_validation('siswa') == true) { 
                                $post_nisn = $this->db->escape_str($this->input->post('nisn', true));
                                $post_nama = $this->db->escape_str($this->input->post('nama', true));
                                $post_sub_kelas = $this->db->escape_str($this->input->post('sub_kelas', true));
                                $post_kelas = $this->db->escape_str($this->input->post('kelas', true));
                                $post_ortu = $this->db->escape_str($this->input->post('orang_tua', true));
                                $post_alamat = $this->db->escape_str($this->input->post('alamat', true));
                                $post_phone = $this->db->escape_str($this->input->post('phone', true));

                                $kelas = $this->Kelas_model->getByID($post_kelas);
                                $count_kelas = $kelas->num_rows();
                                $row_kelas = $kelas->row();

                                       
                                $update = ['nisn' => $post_nisn,
                                            'std_name' => $post_nama,
                                            'class_id' => $row_kelas->id,
                                            'address' => $post_alamat,
                                            'phone_number' => $post_phone 
                                            ];   
                                $update = $this->Siswa_model->update($update, $this->db->escape_str(filter($id, true)));
                                if ($update == true) {
                                        $this->Wali_model->update(['student_id' => $id, 'parent_name' => $post_ortu, 'phone_number' => $post_phone], $this->db->escape_str(filter($id, true)));
                                        $this->session->set_flashdata('result', ['alert' => 'success', 'title' => 'Berhasil!', 'msg' => 'Data Berhasil Di Ubah.']);
                                        redirect('siswa');
                                } else {
                                        $this->session->set_flashdata('result', ['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Terjadi Kesalahan.']);
                                }     
                        }
                }
                $data['page'] = 'Edit Siswa';
                $data['siswa'] = $this->Siswa_model->getByID_Join($this->db->escape_str(filter($id, true)))->row();
                $data['login'] = $this->data_user();
                if ($this->data_user()->level == 'Admin') {
                $this->template_admin('admin/siswa/edit', $data);
                } else {
                $this->template('admin/siswa/edit', $data);    
                }    
        }               

        public function hapus(){   
                if (count($this->input->post())) {
                $post_id = $this->input->post($this->db->escape_str(filter('id', true)));
                
                $data_siswa = $this->Siswa_model->getByID($post_id);   
                $check_data_pelanggaran = $this->Siswa_model->CheckPelanggaranByID($post_id);

                        if ($data_siswa->num_rows() == 0) {
                        $this->session->set_flashdata('result', ['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Data tidak ditemukan.']);
                        redirect('siswa');
                        } else {
                        if ($check_data_pelanggaran->num_rows() > 0) {
                            $delete = $this->Siswa_model->delete_pelanggaran($post_id);
                        }
                            
                            $delete = $this->Wali_model->delete($post_id);
                            $delete = $this->Siswa_model->delete($post_id);
                                if ($delete == true) {
                                   
                                   $this->session->set_flashdata('result', ['alert' => 'success', 'title' => 'Berhasil!', 'msg' => 'Data Berhasil Di Hapus.']);
                                   redirect('siswa');
                                } else {
                                   $this->session->set_flashdata('result', ['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Terjadi Kesalahan.']);
                                   redirect('siswa');

                                }
                        }
                }
        } 

    public function ajax_list_kelas(){
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                if (!$this->input->post('sub_kelas')) {
                    exit("Not Access!");
                }
                if (empty($this->input->post('sub_kelas'))) {
                    exit('<option value="0">Pilih ...</option>');
                }
                    $input_kategori = $this->db->escape_str(filter($this->input->post('sub_kelas', true)));
                    $cek_kelas = $this->Kelas_model->getJsonBySub($input_kategori);
                    print('<option value="0">Pilih Salah Satu...</option>');
                    if ($cek_kelas->num_rows() == 0) {
                        print('<option value="0">Tidak Tersedia...</option>');                          
                    } else {
                                                foreach ($cek_kelas->result() as $kelas) {
                        print('<option value="'.$kelas->id.'">'.$kelas->class_name.'</option>');
                    }
                }
            } else {
            exit("Not Access!");
        }
    }

    public function ajax_list_siswa(){
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                if (!$this->input->post('kelas')) {
                    exit("Not Access!");
                }
                if (empty($this->input->post('kelas'))) {
                    exit('<option value="0">Pilih ...</option>');
                }
                    $input_kategori = $this->db->escape_str(filter($this->input->post('kelas', true)));
                    $cek_kelas = $this->Siswa_model->getJsonForSiswa($input_kategori);
                    print('<option value="0">Pilih Salah Satu...</option>');
                    if ($cek_kelas->num_rows() == 0) {
                        print('<option value="0">Tidak Tersedia...</option>');                          
                    } else {
                                                foreach ($cek_kelas->result() as $siswa) {
                        print('<option value="'.$siswa->id.'">'.$siswa->std_name.'</option>');
                    }
                }
            } else {
            exit("Not Access!");
        }
    }
}
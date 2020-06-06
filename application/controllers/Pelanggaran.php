<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggaran extends MY_Controller {

    function __construct(){
        parent::__construct();   
        $this->session('Guru');
        $this->load->model(array('Pelanggaran_model', 'Guru_model', 'Kategoripelanggaran_model'));
    }
// ==== Pelanggaran ==== //
    public function index(){
        $keyword = $this->db->escape_str(filter($this->input->get('search', true)));
        $config['per_page'] = 20;  //show record per halaman
        $config['base_url'] = site_url('pelanggaran/index');
        $config['total_rows'] = $this->Pelanggaran_model->TotalDataPelanggaran(['tb_siswa.nisn' => $keyword]);  
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
        $data['list'] = $this->Pelanggaran_model->DataPelanggaran($config['per_page'], $data['uri'], ['tb_siswa.nisn' => $keyword]);
        $data['page'] = 'List Pelanggaran';
        $data['login'] = $this->data_user();
        $data['point'] = $this->db->get_where('tb_website', ['id' => '1'])->row('point');
        $data['total_rows'] = $config['total_rows'];
        $data['pagination'] = $this->pagination->create_links();
        if ($this->data_user()->level == 'Admin') {
        $this->template_admin('admin/list-pelanggaran', $data);
        } else {
        $this->template('list-pelanggaran', $data);    
        }
    }


        public function tambah(){
                if (count($this->input->post())) {
                    if ($this->form_validation('pelanggaran') == true) { 
                        $post_kelas = $this->db->escape_str(filter($this->input->post('kelas', true)));
                        $post_siswa = $this->db->escape_str(filter($this->input->post('siswa', true)));
                        $post_pelapor = $this->db->escape_str(filter($this->input->post('pelapor', true)));
                        $post_kategori = $this->db->escape_str(filter($this->input->post('kategori', true)));
                        $post_catatan = $this->db->escape_str(filter($this->input->post('catatan', true)));

                        $data_guru = db_query('tb_guru', array('id' => $post_pelapor));
                        $data_kelas = db_query('tb_kelas', array('id' => $post_kelas));
                        $data_siswa = db_query('tb_siswa', array('id' => $post_siswa));
                        $data_kategori = db_query('tb_tipe_pelanggaran', array('id' => $post_kategori));
                        $data_wali = db_query('tb_wali', array('id' => $post_siswa));

                        if ($data_kelas['count'] == 0) {
                                $this->session->set_flashdata('result', ['alert' => 'danger', 'title' => 'Gagal', 'msg' => 'Data Kelas Tidak Tersedia']);
                        } else if ($data_siswa['count'] == 0) {
                                $this->session->set_flashdata('result', ['alert' => 'danger', 'title' => 'Gagal', 'msg' => 'Data Siswa Tidak Tersedia']);
                        } else if ($data_guru['count'] == 0) {
                                $this->session->set_flashdata('result', ['alert' => 'danger', 'title' => 'Gagal', 'msg' => 'Data Guru Tidak Tersedia']);
                        } else if ($data_kategori['count'] == 0) {
                                $this->session->set_flashdata('result', ['alert' => 'danger', 'title' => 'Gagal', 'msg' => 'Data Pelanggaran Tersedia']);
                        } else {
                                $data = [
                                        'nisn' => $data_siswa['rows']['nisn'],
                                        'student_id' => $data_siswa['rows']['id'],
                                        'class_id' => $data_kelas['rows']['id'],
                                        'teacher_id' => $data_guru['rows']['id'],
                                        'wali_id' => $data_wali['rows']['id'],
                                        'type_id' => $data_kategori['rows']['id'],
                                        'note' => $post_catatan,
                                        'point' => $data_kategori['rows']['get_point'],
                                        'reported_on' => date('Y-m-d H:i:s')
                                        ];   
                                $insert = $this->Pelanggaran_model->insert($data);
                                if ($insert == true) {
                                        $this->session->set_flashdata('result', ['alert' => 'success', 'title' => 'Berhasil', 'msg' => 'Pelanggaran Baru Berhasil Ditambahkan']);
                                } else {
                                        $this->session->set_flashdata('result', ['alert' => 'danger', 'title' => 'Gagal', 'msg' => 'Terjadi Kesalahan']);
                                }
                        }
                    }
                } 
                $data['login'] = $this->data_user();
                $data['page'] = 'Tambah Pelanggaran';
                $data['guru'] = $this->Guru_model->view()->result();
                $data['kategori'] = $this->Kategoripelanggaran_model->view()->result();
                if ($this->data_user()->level == 'Admin') {
                $this->template_admin('admin/pelanggaran/add', $data);
                } else {
                $this->template('pelanggaran/add', $data);    
                }             
        } 

        public function edit($id = null){
            if (count($this->uri->segment_array()) > 3) {
                redirect('admin');
            } 
                if (!isset($id)) {
                $this->session->set_flashdata('result', ['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Data tidak ditemukan.']);
                redirect('pelanggaran');
                } 

                if (!is_numeric($id)) {
                $this->session->set_flashdata('result', ['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Data tidak ditemukan.']);
                redirect('pelanggaran');
                } 

                $data_pelanggaran = $this->Pelanggaran_model->getByID($this->db->escape_str(filter($id, true))); 

                if ($data_pelanggaran->num_rows() == 0) {
                    $this->session->set_flashdata('result', ['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Data tidak ditemukan.']);
                    redirect('pelanggaran');
                }   
                if (count($this->input->post())) {
                    if ($this->form_validation('pelanggaran') == true) { 
                        $post_kelas = $this->db->escape_str(filter($this->input->post('kelas', true)));
                        $post_siswa = $this->db->escape_str(filter($this->input->post('siswa', true)));
                        $post_pelapor = $this->db->escape_str(filter($this->input->post('pelapor', true)));
                        $post_kategori = $this->db->escape_str(filter($this->input->post('kategori', true)));
                        $post_catatan = $this->db->escape_str(filter($this->input->post('catatan', true)));

                        $data_guru = db_query('tb_guru', array('id' => $post_pelapor));
                        $data_kelas = db_query('tb_kelas', array('id' => $post_kelas));
                        $data_siswa = db_query('tb_siswa', array('id' => $post_siswa));
                        $data_kategori = db_query('tb_tipe_pelanggaran', array('id' => $post_kategori));
                        $data_wali = db_query('tb_wali', array('id' => $post_siswa));

                                $data = [
                                        'nisn' => $data_siswa['rows']['nisn'],
                                        'student_id' => $data_siswa['rows']['id'],
                                        'class_id' => $data_kelas['rows']['id'],
                                        'teacher_id' => $data_guru['rows']['id'],
                                        'wali_id' => $data_wali['rows']['id'],
                                        'type_id' => $data_kategori['rows']['id'],
                                        'note' => $post_catatan,
                                        'point' => $data_kategori['rows']['get_point'],
                                        'reported_on' => date('Y-m-d H:i:s')
                                        ];   
                                $update = $this->Pelanggaran_model->update($data, $this->db->escape_str(filter($id, true)));

                                if ($update == true) {
                                        $this->session->set_flashdata('result', ['alert' => 'success', 'title' => 'Berhasil!', 'msg' => 'Data Berhasil Di Ubah.']);
                                        redirect('pelanggaran');
                                } else {
                                        $this->session->set_flashdata('result', ['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Terjadi Kesalahan.']);
                                }
                        }
                }
                $data['pelanggaran'] = $data_pelanggaran->row();
                $data['page'] = 'Edit Pelanggaran';
                $data['login'] = $this->data_user();
                if ($this->data_user()->level == 'Admin') {
                $this->template_admin('admin/pelanggaran/edit', $data);
                } else {
                $this->template('pelanggaran/edit', $data);    
                }  
        }               

        public function hapus(){   
                if (count($this->input->post())) {
                $post_id = $this->input->post($this->db->escape_str(filter('id', true)));
                $data_pelanggaran =  $this->Pelanggaran_model->getByID($post_id); 
                        if ($data_pelanggaran->num_rows() == 0) {
                        $this->session->set_flashdata('result', ['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Data tidak ditemukan.']);
                        redirect('pelanggaran');
                        } else {
                        $delete = $this->Pelanggaran_model->delete($post_id);
                                if ($delete == true) {
                                   $this->session->set_flashdata('result', ['alert' => 'success', 'title' => 'Berhasil!', 'msg' => 'Data Berhasil Di Hapus.']);
                                   redirect('pelanggaran');
                                } else {
                                   $this->session->set_flashdata('result', ['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Terjadi Kesalahan.']);
                                   redirect('pelanggaran');

                                }
                        }
                }
        }  

    public function print_pelanggaran($id = null){
                if (!isset($id)) {
                $this->session->set_flashdata('result', ['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Data tidak ditemukan.']);
                redirect('pelanggaran');
                } 
                $data_pelanggaran = $this->Pelanggaran_model->getByID($this->db->escape_str(filter($id, true)));   

                if ($data_pelanggaran->num_rows() == 0) {
                    $this->session->set_flashdata('result', ['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Data tidak ditemukan.']);
                    redirect('pelanggaran');
                }   
        $data['login'] = $this->data_user();
        $data['title'] = 'Cetak Laporan Pelanggaran';
        $data['pelanggaran'] = $this->Pelanggaran_model->DataPelanggaranPrint($id)->row();
        if ($this->data_user()->level == 'Admin') {
        $this->load->view('admin/pelanggaran/print', $data);
        } else {
        $this->load->view('pelanggaran/print', $data);    
        }
    }

}      
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Website extends MY_Controller {

    function __construct(){
        parent::__construct();   
        $this->session('Admin');
        $this->load->model('Website_model');
    }

    public function index(){
            if (count($this->input->post())) {
                $post_nama = $this->db->escape_str($this->input->post('name', true));
                $post_point = $this->db->escape_str($this->input->post('point', true));
                $update_post = [
                                'school_name' => $post_nama,
                                'point' => $post_point
                                ];  
                    $update = $this->Website_model->update($update_post);   
                    if ($update == true) {
                        $this->session->set_flashdata('result', ['alert' => 'success', 'title' => 'Berhasil!', 'msg' => 'Data Berhasil Di Ubah.']);
                            redirect('website');
                    } else {
                        $this->session->set_flashdata('result', ['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Terjadi Kesalahan.']);
                    }                                  
            }
            $data['page'] = 'Pengaturan Website';
            $data['login'] = $this->data_user();
            $data['website'] = $this->Website_model->view();
            $this->template_admin('admin/website', $data);
    }    
    
}
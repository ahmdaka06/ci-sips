<?php 
class MY_Controller extends CI_Controller {
	
	public function template($body='',$data=[]) {
		$data['DataWebsite'] = $this->db->get_where('tb_website', ['id' => '1'])->row(); 
		$time = microtime(); 
		$time = explode(' ', $time); 
		$time = $time[1] + $time[0]; 
		$data['start'] = $time; 
		$this->load->view('lib/header',$data);
		$this->load->view($body,$data);
		$this->load->view('lib/footer',$data);
	}

	public function template_admin($body='',$data=[]) {
        $data['DataWebsite'] = $this->db->get_where('tb_website', ['id' => '1'])->row(); 
        $this->load->view('lib/header_admin',$data);
        $this->load->view($body,$data);
        $this->load->view('lib/footer',$data);
	}

	public function form_validation($type = ''){
		if ($type == 'guru') {
            $this->form_validation->set_rules(
                'nik', 'NIK',
                'required',
                    array(
                        'required'      => 'NIK Wajib Diisi',
                    )
            );
            $this->form_validation->set_rules(
                'nama', 'Nama Guru',
                'required',
                    array(
                        'required'      => 'Nama Guru Wajib Diisi',
                    )
            );
            $this->form_validation->set_rules(
                'mapel', 'Mata Pelajaran',
                'required',
                    array(
                        'required'      => 'Mata Pelajaran Wajib Diisi',
                    )
            );
        	if ($this->form_validation->run()) {
        		return true;
        	} else {
        		return false;
        	}
		} else if ($type == 'kelas'){
            $this->form_validation->set_rules(
                'kelas', 'Kelas',
                'required',
                    array(
                        'required'      => 'Kelas Diisi',
                    )
            );
            $this->form_validation->set_rules(
                'nama_kelas', 'Nama Kelas',
                'required',
                    array(
                        'required'      => 'Nama Kelas Wajib Diisi',
                    )
            );
            $this->form_validation->set_rules(
                'wali_kelas', 'Wali Kelas',
                'required',
                    array(
                        'required'      => 'Wali Kelas Wajib Diisi',
                    )
            );
            $this->form_validation->set_rules(
                'total_siswa', 'Total Siswa',
                'required',
                    array(
                        'required'      => 'Total Siswa Wajib Diisi',
                    )
            );	
        	if ($this->form_validation->run()) {
        		return true;
        	} else {
        		return false;
        	}		
		} else if ($type == 'siswa'){
            $this->form_validation->set_rules(
                'nisn', 'NISN',
                'required',
                    array(
                        'required'      => 'NISN Wajib Diisi',
                    )
            );
            $this->form_validation->set_rules(
                'nama', 'Nama',
                'required',
                    array(
                        'required'      => 'Nama Murid Wajib Diisi',
                    )
            );
            $this->form_validation->set_rules(
                'sub_kelas', 'Kategori Kelas',
                'required',
                    array(
                        'required'      => 'Kategori Kelas Wajib Dipilih',
                    )
            );
            $this->form_validation->set_rules(
                'kelas', 'Kelas',
                'required',
                    array(
                        'required'      => 'Kategori Kelas Wajib Dipilih',
                    )
            );
            $this->form_validation->set_rules(
                'orang_tua', 'Orang Tua',
                'required',
                    array(
                        'required'      => 'Orang Tua Wajib Diisi',
                    )
            );	
            $this->form_validation->set_rules(
                'alamat', 'Alamat',
                'required',
                    array(
                        'required'      => 'Alamat Wajib Diisi',
                    )
            );	
            $this->form_validation->set_rules(
                'phone', 'Nomor HP',
                'required',
                    array(
                        'required'      => 'Nomor HP Wajib Diisi',
                    )
            );	
        	if ($this->form_validation->run()) {
        		return true;
        	} else {
        		return false;
        	}
        } else if ($type == 'change-password') {
            $this->form_validation->set_rules(
                'old_pass', 'Password', 
                'required',
                    array(
                        'required' => '- Kolom Password Lama Harus Diisi'
                    )
            );
            $this->form_validation->set_rules(
                'new_pass', 'Password Baru',
                'required|trim|min_length[8]|max_length[50]',
                    array(
                        'required'      => '- Kolom Password Baru  Wajib Diisi',
                        'min_length'      => '- Password Baru Minimal Mengandung 8 Karakter',
                        'max_length'      => '- Password Baru Maksimal Mengandung 50 Karakter'
                    )
            );

            $this->form_validation->set_rules(
                'conf_new_pass', 'Konfirmasi Password Baru',
                'required|trim|matches[new_pass]',
                    array(
                        'required'      => '- Kolom Konfirmasi Password Baru Wajib Diisi',
                        'matches'      => '- Konfirmasi Password Baru Tidak Sesuai'
                    )
            );
            if ($this->form_validation->run()) {
                return true;
            } else {
                return false;
            }            
        } else if ($type == 'kategori-pelanggaran') {
            $this->form_validation->set_rules(
                'name', 'Nama',
                'required',
                    array(
                        'required'      => 'Nama Pelanggaran Wajib Diisi',
                    )
            );
            $this->form_validation->set_rules(
                'point', 'Point',
                'required',
                    array(
                        'required'      => 'Point Wajib Diisi',
                    )
            );
            if ($this->form_validation->run()) {
                return true;
            } else {
                return false;
            }	
        } else if ($type == 'pelanggaran') {
            $this->form_validation->set_rules(
                'sub_kelas', 'Sub Kelas',
                'required',
                    array(
                        'required'      => '%s Wajib Dipilih',
                    )
            );
            $this->form_validation->set_rules(
                'kelas', 'Kelas',
                'required',
                    array(
                        'required'      => '%s Wajib Dipilih',
                    )
            );
            $this->form_validation->set_rules(
                'siswa', 'Siswa',
                'required',
                    array(
                        'required'      => '%s Wajib Dipilih',
                    )
            );
            $this->form_validation->set_rules(
                'siswa', 'Siswa',
                'required',
                    array(
                        'required'      => '%s Wajib Dipilih',
                    )
            );
            $this->form_validation->set_rules(
                'pelapor', 'Pelapor',
                'required',
                    array(
                        'required'      => '%s Wajib Dipilih',
                    )
            );
            $this->form_validation->set_rules(
                'kategori', 'Kategori',
                'required',
                    array(
                        'required'      => '%s Wajib Dipilih',
                    )
            );    
            $this->form_validation->set_rules(
                'catatan', 'Catatan',
                'required',
                    array(
                        'required'      => '%s Wajib Diisi',
                    )
            );                                  
            if ($this->form_validation->run()) {
                return true;
            } else {
                return false;
            }   
        } else if ($type == 'pengguna') {
            $this->form_validation->set_rules(
                'nama', 'Nama',
                'required',
                    array(
                        'required'      => '%s Wajib Diisi',
                    )
            );
            $this->form_validation->set_rules(
                'email', 'Email', 
                'required|valid_email|is_unique[tb_users.email]',
                    array(
                        'required'      => 'Email  Wajib Diisi',
                        'valid_email'      => 'Harap Memasukkan Email Yang Valid',
                        'is_unique'      => 'Email Sudah Terdaftar'
                    )
            );
            $this->form_validation->set_rules(
                'username', 'Username', 
                'required|min_length[6]|max_length[50]|is_unique[tb_users.username]|alpha_numeric_spaces',
                    array(
                        'required'      => 'Username  Wajib Diisi',
                        'min_length'      => 'Username Minimal Mengandung 6 Karakter',
                        'max_length'      => 'Username Maksimal Mengandung 50 Karakter',
                        'is_unique'      => 'Username Sudah Terdaftar',
                        'alpha_numeric_spaces' => 'Dilarang Mengisi Dengan Simbol Alpha Numeric'
                    )
            );
            $this->form_validation->set_rules(
                'password', 'Password',
                'required|trim|min_length[8]|max_length[50]',
                    array(
                        'required'      => 'Password  Wajib Diisi',
                        'min_length'      => 'Password Minimal Mengandung 8 Karakter',
                        'max_length'      => 'Password Maksimal Mengandung 50 Karakter'
                    )
            );
            $this->form_validation->set_rules(
                'level', 'Level',
                'required',
                    array(
                        'required'      => '%s Wajib Dipilih',
                    )
            );                                
            if ($this->form_validation->run()) {
                return true;
            } else {
                return false;
            }   
        } else if ($type == 'pengguna_edit') {
            $this->form_validation->set_rules(
                'nama', 'Nama',
                'required',
                    array(
                        'required'      => '%s Wajib Diisi',
                    )
            );
            $this->form_validation->set_rules(
                'level', 'Level',
                'required',
                    array(
                        'required'      => '%s Wajib Dipilih',
                    )
            );                                
            if ($this->form_validation->run()) {
                return true;
            } else {
                return false;
            }   
        }
	}
	public function session($level = '') {
		if(!$this->session->userdata('login') == true) {
			$this->session->set_flashdata('result', ['alert' => 'danger', 'title' => 'Ups !!', 'msg' => 'Otentikasi dibutuhkan.!!']);
			redirect('auth/login');
		} 
		$akses_level = $this->db->get_where('tb_users',array('username' => $this->session->userdata('username')))->row_array()['level'];
		if($level == 'Admin') {
			if($akses_level != 'Admin') {
				$this->session->set_flashdata('result', ['alert' => 'danger', 'title' => 'Ups !!', 'msg' => 'Akses Dilarang !!']);
				redirect('auth/login');
			}
		}
		if($level == 'Guru') {
			if(!($akses_level == "Admin" || $akses_level =="Guru")) {
				$this->session->set_flashdata('result', ['alert' => 'danger', 'title' => 'Ups !!', 'msg' => 'Akses Dilarang !!']);
				redirect('auth/login');
			}
		}
	}

    public function data_user(){
            return $this->db->get_where('tb_users', ['id' => $this->session->userdata('id')])->row();
    }


}
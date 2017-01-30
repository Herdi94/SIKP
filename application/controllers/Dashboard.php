<?php
/**
 * Created by PhpStorm.
 * User: Herdi
 * Date: 04/10/2016
 * Time: 08.34
 */


defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
    }

    public function home()
    {
        $this->template->load('admin/template', 'admin/home_view');
        session_write_close();
    }

    public function pembimbing()
    {
        $this->template->load('admin/template', 'admin/pembimbing_view');
        session_write_close();
    }

    public function pendaftaran()
    {
        $this->template->load('admin/template', 'admin/pendaftaran_view');
        session_write_close();
    }

    public function profile()
    {
        $this->template->load('admin/template','admin/profile_view');
        session_write_close();

    }



    public function save_password()
    {

        $this->load->model('admin/admin_model');
        $this->form_validation->set_rules('new','New','required|alpha_numeric');
        $this->form_validation->set_rules('re_new', 'Retype New', 'required|matches[new]');
        if($this->form_validation->run() == FALSE)
        {
            $this->template->load('admin/template','admin/password_view');
        }else{
            $cek_old = $this->admin_model->cek_old();
            if ($cek_old == False){
                $this->session->set_flashdata('error','Old password not match!' );
                $this->template->load('admin/template','admin/password_view');
            }else{
                $this->admin_model->save();
                $this->session->set_flashdata('error','Your password success to change' );
                redirect('dashboard/save_password');
            }//end if valid_user
        }
    }

    public function index($error = NULL)
    {
        $data = array(
            'action' => site_url('dashboard/login'),
            'error' => $error
        );
        $this->load->view('admin/login_view', $data);
    }

    public function display_doforget()
    {
        $data="";
        $this->load->view('admin/forgot_password',$data);
    }
    public function doforget()
    {
        $this->load->helper('url');
        $this->load->helper('security');
        $email= $this->input->post('email');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email','email','required|xss_clean|trim');
        if ($this->form_validation->run() == FALSE)
        {

            $this->load->view('admin/forgot_password');

        }
        else
        {
            $q = $this->db->query("select * from admin where email='" . $email . "'");
            if ($q->num_rows > 0) {
                $r = $q->result();
                $user=$r[0];
                $this->load->helper('string');
                $password= random_string('alnum',6);
                $this->db->where('id_admin', $user->id_admin);
                $this->db->update('admin',array('password'=>$password,'pass_encryption'=>sha1($password)));
                $this->load->library('email');
                $this->email->from('contact@example.com', 'sampletest');
                $this->email->to('dfikr94@gmail.com');
                $this->email->subject('Password reset');
                $this->email->message('You have requested the new password, Here is you new password:'. $password);
                $this->email->send();
                $this->session->set_flashdata('message','Password has been reset and has been sent to email');
                redirect('dashboard/display_doforget');
            }
        }
    }

    public function login()
    {
        $this->load->model('admin/auth_model');
        $login = $this->auth_model->login($this->input->post('username'), sha1($this->input->post('password')));


        if ($login == 1) {
//          ambil detail data
            $row = $this->auth_model->data_login($this->input->post('username'),sha1($this->input->post('password')));

//          daftarkan session
            $data = array(
                'logged' => TRUE,
                'id_admin'=> $row->id_admin,
                'username' => $row->username,
                'nama' => $row->nama,
                'nip' => $row->nip,
                'email' => $row->email,
                'photo' => $row->photo,
                'password' => $row->password

            );

            $this->session->set_userdata($data);

            $this->template->load('admin/template', 'admin/home_view');

        } else {
//            tampilkan pesan error
            $error = 'username / email / password salah';
            $this->index($error);
        }
    }

    function logout()
    {
//        destroy session
        $this->session->sess_destroy();

//        redirect ke halaman login
        redirect(site_url('dashboard'));
    }


}

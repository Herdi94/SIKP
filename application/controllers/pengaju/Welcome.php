<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{

    function __construct(){
        parent::__construct();
        $this->load->model('pengaju/welcome_model');
        $this->load->helper('form');
        $this->load->library('session');

    }

    public function index()
    {
        $this->load->view('pengaju/template');

    }



    public function add_pendaftaran()
    {

       function __construct()
    {
        $this->load->library('email');


        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $this->email->initialize($config);

    }



            //Check whether user upload picture
            if (!empty($_FILES['photo']['name'])) {
                $config['upload_path'] = 'upload/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size']             = '4096';
                $config['file_name'] = $_FILES['photo']['name'];

                //load form validation
                $this->load->library('form_validation');

                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('photo')) {
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
                } else {
                   $error = array('error' => $this->upload->display_errors());
                    $this->session->set_flashdata('error',$error['error']);
                    redirect('pengaju/welcome/#about');
                }
            } else {
                $picture = '';
            }

            //Prepare array of user data
            $userData = array(
                'no_identitas' => $this->input->post('no_identitas'),
                'nama' => $this->input->post('nama2'),
                'jk' => $this->input->post('jk'),
                'email' => $this->input->post('email'),
                'jns_pengaju' => $this->input->post('jns_pengaju'),
                'anggota_kelompok' => $this->input->post('anggota_kelompok'),
                'pendidikan' => $this->input->post('pendidikan'),
                'jurusan' => $this->input->post('jurusan'),
                'sekolah' => $this->input->post('sekolah'),
                'tgl_mulai' => $this->input->post('tgl_mulai'),
                'tgl_akhir' => $this->input->post('tgl_akhir'),
                'photo' => $picture
            );

        //sending email

        $email = $this->input->post('email');
        $this->load->library('email');
        $this->email->from($email);
        $this->email->to('dfikr94@gmail.com');




        $this->email->subject('Email Test');
        $this->email->message('Halo Herdi kamu berhasil mengirim email');
        $this->email->send();

        /*if($this->email->send()){
            echo 'Email berhasil dikirim';
        }
        else {
            show_error($this->email->print_debugger());
        }*/


            //Pass user data to model
            $insertUserData = $this->welcome_model->add($userData);

            //Storing insertion status message.
            if ($insertUserData > 1) {
                $this->session->set_flashdata('success_msg', 'Data berhasil disubmit. Selanjutnya kami akan menghubungi anda melalui email.  ');
                redirect('pengaju/welcome/#about'); //untuk redirect
            } else {
                $this->session->set_flashdata('error_msg', 'Data gagal disubmit. Silahkan coba lagi!');
                redirect('pengaju/welcome/#about'); //untuk redirect
            }



    }

    public function konfirmasi(){
        $this->load->view('admin/konfirmasi_view');
    }








}


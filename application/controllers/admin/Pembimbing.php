<?php
/**
 * Created by PhpStorm.
 * User: Herdi
 * Date: 15/11/2016
 * Time: 16.33
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembimbing extends CI_Controller{

    public function __construct()
    {
        parent::__construct(); // TODO: Change the autogenerated stub
        //deklaration to delete data admin
        $this->load->model('admin/pembimbing_model','pembimbing');

    }

        public function index(){
        $this->load->view('admin/pembimbing_view');
    }

    public function ajax_add(){
       $this->_validate();

        $data = array(
            'nip' => $this->input->post('nip'),
            'nama'=> $this->input->post('nama'),
            'bidang' => $this->input->post('bidang'),
            'jabatan' => $this->input->post('jabatan'),
            'username' => $this->input->post('username'),
            'password' => sha1($this->input->post('password'))
        );

        $this->pembimbing->save($data);
        echo json_encode(array("status" => TRUE));

    }

    public function ajax_list(){
        $list = $this->pembimbing->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $pembimbing) {
            $no++;
            $row = array();
            $row[] = $pembimbing->id_pembimbing;
            $row[] = $pembimbing->nip;
            $row[] = $pembimbing->nama;
            $row[] = $pembimbing->bidang;
            $row[] = $pembimbing->jabatan;

            if($pembimbing->photo)
                $row[] = '<a href="'.base_url('upload/'.$pembimbing->photo).'" target="_blank"><img src="'.base_url('upload/'.$pembimbing->photo).'" class="img-responsive" /></a>';
            else
                $row[] = '(No photo)';

            $row[] = $pembimbing->username;


//add html for action
            $row[] = '<a class="btn btn-block btn-primary" href="javascript:void(0)" title="edit" onclick="edit_pembimbing('."'".$pembimbing->id_pembimbing."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
            <a class="btn btn-block btn-danger" href="javascript:void(0)" title="delete" onclick="delete_pembimbing('."'".$pembimbing->id_pembimbing."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->pembimbing->count_all(),
            "recordsFiltered" => $this->pembimbing->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_edit($id_pembimbing)
    {
        $data = $this->pembimbing->get_by_id($id_pembimbing);
        echo json_encode($data);
    }

    public function ajax_update(){
        $this->_validate();

        $data = array(
            'nip' => $this->input->post('nip'),
            'nama'=> $this->input->post('nama'),
            'bidang' => $this->input->post('bidang'),
            'jabatan' => $this->input->post('jabatan'),
            'username' => $this->input->post('username')
        );

        $this->pembimbing->update(array('id_pembimbing' => $this->input->post('id_pembimbing')), $data);
        echo json_encode(array("status" => TRUE));

    }


    public function ajax_delete($id_pembimbing){

        $pembimbing = $this->pembimbing->get_by_id($id_pembimbing);
        if(file_exists('upload/'.$pembimbing->photo)&& $pembimbing->photo)
            unlink('upload/'.$pembimbing->photo);
        $this->pembimbing->delete_by_id($id_pembimbing);
        echo json_encode(array("status"=> TRUE));
    }

    private function _validate(){
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('nip') == '')
        {
            $data['inputerror'][] = 'nip';
            $data['error_string'][] = 'NIP is required';
            $data['status'] = FALSE;
        }
        if($this->input->post('nama') == '')
        {
            $data['inputerror'][] = 'nama';
            $data['error_string'][] = 'Nama is required';
            $data['status'] = FALSE;
        }
        if($this->input->post('bidang') == '')
        {
            $data['inputerror'][] = 'bidang';
            $data['error_string'][] = 'Bidang is required';
            $data['status'] = FALSE;
        }
        if($this->input->post('jabatan') == '')
        {
            $data['inputerror'][] = 'jabatan';
            $data['error_string'][] = 'Jabatan is required';
            $data['status'] = FALSE;
        }
        if($this->input->post('username') == '')
        {
            $data['inputerror'][] = 'username';
            $data['error_string'][] = 'Username is required';
            $data['status'] = FALSE;
        }

        if($data['status'] == FALSE){
            echo json_encode($data);
            exit();
        }
    }


    }

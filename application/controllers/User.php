<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->load->model('user_model');
		$this->load->model('todo_model');

	}

	public function index()
	{
		$this->load->view('user_view');
	}
	public function check_user()
	{
		$username = $this->input->post('username');

        $id = $this->user_model->get_userid($username);
        $id_val = $id[0]->id;

        $data['id']=$id_val;

        $data['tasks'] = $this->todo_model->get_usertask($id_val);

		$data['username'] = $username;

	    $this->load->view('todo_view',$data);

	}

	public
}

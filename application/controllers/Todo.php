<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Todo extends CI_Controller {

    public function __construct()
    {
        parent:: __construct();
        $this->load->model('user_model');
        $this->load->model('todo_model');

    }

    public function view_todo($username, $id)
    {
        $data['username'] = $username;
        $data['id'] = $id;

        $data['tasks'] = $this->todo_model->get_usertasks($data['id']);

        $this->load->view('todo_view',$data);
    }

    public function view_task()
    {
        $data['username'] = $this->input->post('username');
        $data['userid'] = $this->input->post('userid');
        $data['taskid'] = $this->input->post('taskid');

        $data['task'] = $this->todo_model->get_task($data['taskid']);

        $this->load->view('task_view',$data);


    }

    public function add_task()
    {

        $data['taskname'] = $this->input->post('taskname');
        $data['userid'] = $this->input->post('userid');
        $username = $this->input->post('username');

        $this->todo_model->add_task($data['taskname'],$data['userid']);

        $this->view_todo($username,$data['id']);

    }

    public function delete_task()
    {
        $taskid = $this->input->post('taskid');
        $username = $this->input->post('username');
        $id = $this->input->post('userid');

        $this->todo_model->del_task($taskid);

        $this->view_todo($username,$id);

    }

    public function edit_task()
    {
        $data['taskname'] = $this->input->post('taskname');
        $data['taskid'] = $this->input->post('taskid');
        $username = $this->input->post('username');
        $id = $this->input->post('userid');

        $this->todo_model->update_task($data['taskname'], $data['taskid']);

        $this->view_todo($username,$id);


    }
}


?>
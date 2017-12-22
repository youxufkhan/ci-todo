<?php

require(APPPATH.'/libraries/REST_Controller.php');

class Api extends REST_Controller
{


    public function __construct()
    {
        parent::__construct();
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Access-Control-Allow-Origin');
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == "OPTIONS") {
            die();
        }
        $this->load->model('user_model');
        $this->load->model('todo_model');
    }

    function get_userid_get()
    {
        $username = $this->get('username');

        if (!$username) {

            $this->response("No username specified", 400);

            exit;
        }

        $result = $this->user_model->get_userid($username);

        if ($result) {

            $this->response($result, 200);

            exit;
        } else {

            $this->response("Invalid username", 404);

            exit;
        }
    }

    function get_usertasks_get()
    {
        $userid = $this->get('userid');

        $result = $this->todo_model->get_usertasks($userid);

        if ($result>0) {
            $this->response($result, 200);
        } else {
            $this->response("No record found", 404);
        }
    }

    function get_task_get()
    {
        $taskid = $this->get('taskid');

        $result = $this->todo_model->get_task($taskid);

        if ($result) {
            $this->response($result, 200);
        } else {
            $this->response("No record found", 404);
        }
    }


    function create_user_post()
    {
        $username = $this->post('username');

        if (!$username) {
            $this->response("Enter username", 400);
        } else

            $result = $this->user_model->create_user($username);

        if ($result === 0) {
            $this->response("Username could not be added. Try again.", 404);
        } else {
            $this->response("success", 200);
        }
    }


    function add_task_post()
    {
//        print_r(var_dump($this->post()));die;
        $userid = $this->post('userid');
        $taskname = $this->post('taskname');
        $deadline = $this->post('deadline');

        if (!$taskname || !$userid || !$deadline) {
            $this->response("Enter taskname and userid to add", 400);
        } else

            $result = $this->todo_model->add_task($taskname, $userid, $deadline);

        if ($result === 0) {
            $this->response("Task could not be added. Try again.", 404);
        } else {
            $this->response("success", 200);
        }
    }


    function update_task_put()
    {
        $taskname = $this->put('taskname');
        $taskid = $this->put('taskid');

        if (!$taskname || !$taskid) {
            $this->response("Enter taskname and taskid to update", 400);
        } else

            $result = $this->todo_model->update_task($taskname, $taskid);

        if ($result === 0) {
            $this->response("Task could not be updated. Try again.", 404);
        } else {
            $this->response("success", 200);
        }
    }



    function del_task_delete()
    {
        header("Access-Control-Allow-Origin: *");

        $taskid = $this->query('taskid');

        if (!$taskid) {

            $this->response("Parameter missing", 404);

        }

        if ($this->todo_model->del_task($taskid)) {

            $this->response("success", 200);

        } else {

            $this->response("Failed", 400);

        }

    }

    function get_alltasks_get()
    {
        header("Access-Control-Allow-Origin: *");
        $result = $this->todo_model->get_alltasks();

            if ($result) {
                $this->response($result, 200);
            } else {
                $this->response("No record found", 404);
            }
    }

}
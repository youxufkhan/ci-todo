<?php
require_once APPPATH . '/controllers/libraries/JWT.php';
require(APPPATH.'/libraries/REST_Controller.php');
use \Firebase\JWT\JWT;

class Api extends REST_Controller
{


    public function __construct()
    {
        parent::__construct();
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Access-Control-Allow-Origin, authorization');
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == "OPTIONS") {
            die();
        }
        $this->load->model('user_model');
        $this->load->model('todo_model');
    }

    function login_user_post(){
        $username = $this->post('username');
        $password = $this->post('password');

        $passwordhash = $this->user_model->get_pass($username)[0]['password'];


        if (password_verify($password ,$passwordhash)) {
            $result['status']=true;
            $this->response($result,200);
        } else {
            $this->response("Wrong Username or Password",404);
        }

    }


    function get_userid_get()
    {
        $username = $this->get('username');

        if (!$username) {

            $this->response("No username specified", 400);
            exit;
        }
        $result = [];
        $id = $this->user_model->get_userid($username)[0]['id'];

        if ($id) {
            $result['id']=$id;
            $key = "example_key";
            $token = array(
                "id"=> $result['id']
            );
            $result['token'] = JWT::encode($token, $key);

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
        $headers = $this->input->request_headers();

        if(!$this->verifyToken($userid,$headers["Authorization"]))
        {
            $this->response("You are not authorized", 401);
        }
        else {
            $result = $this->todo_model->get_usertasks($userid);

            if ($result > 0) {
                $this->response($result, 200);
            } else {
                $this->response("No record found", 404);
            }
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
        $password = $this->post('password');
        $password = password_hash($password, PASSWORD_DEFAULT);

        $id = $this->user_model->get_userid($username)[0]['id'];

        if(!$id) {
            if (!$username) {
                $this->response("Enter username and password", 400);
            } else

                $result = $this->user_model->create_user($username,$password);

            if ($result === 0) {
                $this->response("Username could not be added. Try again.", 404);
            } else {
                $this->response("success", 200);
            }
        }
            $this->response("Username already exists",404);
    }


    function add_task_post()
    {
        $userid = $this->post('userid');
        $taskname = $this->post('taskname');
        $deadline = $this->post('deadline');
        $start_time = $this->post('start_time');
        $headers = $this->input->request_headers();

        if(!$this->verifyToken($userid,$headers["Authorization"]))
        {
            $this->response("You are not authorized", 401);
        }
        else {

            if (!$taskname || !$userid || !$deadline || !$start_time) {
                $this->response("Enter taskname and userid to add", 400);
            } else

                $result = $this->todo_model->add_task($taskname, $userid, $deadline, $start_time);

            if ($result === 0) {
                $this->response("Task could not be added. Try again.", 404);
            } else {
                $this->response("success", 200);
            }
        }
    }


    function update_task_put()
    {
        $userid = $this->put('userid');
        $taskname = $this->put('taskname');
        $taskid = $this->put('taskid');
        $headers = $this->input->request_headers();

        if(!$this->verifyToken($userid,$headers["Authorization"]))
        {
            $this->response("You are not authorized", 401);
        }
        else {
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
    }



    function del_task_delete()
    {
        header("Access-Control-Allow-Origin: *");

        $taskid = $this->query('taskid');
        $userid = $this->query('userid');
        $headers = $this->input->request_headers();

        if(!$this->verifyToken($userid,$headers["Authorization"]))
        {
            $this->response("You are not authorized", 401);
        }
        else {
            if (!$taskid) {

                $this->response("Parameter missing", 404);

            }

            if ($this->todo_model->del_task($taskid)) {

                $this->response("success", 200);

            } else {

                $this->response("Failed", 400);

            }
        }
    }


    function verifyToken($userid,$Token)
    {
        $key = "example_key";
        $decoded = JWT::decode($Token , $key, array('HS256'));
        $decoded_array = (array) $decoded;
        if($decoded_array['id']==$userid){
            return true;
        }else{
            return false;}
    }

}
<?php 
Class User_model extends CI_Model
{
	
	public function __construct()
	{
		parent:: __construct();
		$this->load->database();
	}


	public function get_userid($username)
	{
		
		$this->db->select('id');
		$this->db->from('user');
		$this->db->where("`username` = '".$username."'");
		$query = $this->db->get();

        if($query->num_rows() == 1)
        {
            return $query->result_array();
        }
        else
        {
            return 0;
        }

	}

	public function create_user($username,$password)
    {

        if($this->db->insert('user',array('username'=>$username,'password'=>$password)))
        {
            return true;
        }else{
            return false;
        }
    }

    public function get_pass($username)
    {
        $this->db->select('password');
        $this->db->from('user');
        $this->db->where("`username` = '".$username."'");
        $query = $this->db->get();
        if($query->num_rows() == 1)
        {
            return $query->result_array();
        }
        else
        {
            return 0;
        }
    }
}
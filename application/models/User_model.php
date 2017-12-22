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
//        Old code Pre-API (Logic for creating new user)
//        $count = count($query);
//        if($count==0)
//        {
//            $this->create_user($username);
//            return $this->get_userid($username);
//        }
//
//		return $query;
	}

	public function create_user($username)
    {
        if($this->db->insert('user',array('username'=>$username)))
        {
            return true;
        }else{
            return false;
        }
    }
}
<?php 
Class Todo_model extends CI_Model
{
	
	public function __construct()
	{
		parent:: __construct();
		$this->load->database();
	}

	public function get_usertasks($userid)
	{
		$this->db->select('*');
		$this->db->from('task');
		$this->db->where("`userid` = '".$userid."'");

		$query = $this->db->get();

        if($query->num_rows() >= 0)
        {
            return $query->result_array();
        }
        else
        {
            return 0;
        }
	}

	public function add_task($taskname,$userid, $deadline)
    {

        if($this->db->insert('task',array('task'=>$taskname, 'userid'=>$userid, 'deadline'=>$deadline)))
        {
            return true;
        }else{
            return false;
        }
    }

    public function get_task($taskid)
    {
        $this->db->select('*');
        $this->db->from('task');
        $this->db->where("`id` = '".$taskid."'");
        $query = $this->db->get()->result();
        return $query;
    }

    public function update_task($taskname,$taskid)
    {
        $this->db->set('task', $taskname);
        $this->db->where('id', $taskid);

        if($this->db->update('task'))
        {
            return true;
        }else{
            return false;
        }
    }

    public function del_task($taskid)
    {
        $this->db->where('id', $taskid);

        if($this->db->delete('task'))
        {
            return true;
        }else{
            return false;
        }
    }

    public function get_alltasks()
    {
        $this->db->select('*');
        $this->db->from('task');
        $query = $this->db->get();
        return $query->result_array();

    }

}
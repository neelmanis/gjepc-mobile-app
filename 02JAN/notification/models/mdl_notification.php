<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_notification extends CI_Model {

	function __construct() {
		parent::__construct();
	}
	function _custom_query($mysql_query) {
		$query = $this->db->query($mysql_query);
		return $query;
	}
	
	function listusers()
	{
		$this->db->select("*");
		$this->db->from("push_notification");
		$ans=$this->db->get();
		if($ans->num_rows > 0)
		{
			$getUser = $ans->result();
		}
		else
		{
			$getUser = "no";
		}	
		return $getUser;
	}

	function user_delete($id)
	{
		$this->db->where('id',$id);		
		$this->db->delete("push_notification");
		return 1;
	}
	
	function addDetail($data)
	{
		$this->db->insert("notification_msg",$data);
		//echo $ans=$this->db->last_query(); exit;
	}

}
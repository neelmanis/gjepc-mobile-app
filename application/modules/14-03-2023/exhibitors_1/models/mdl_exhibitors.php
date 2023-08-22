<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_exhibitors extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	
	function get_table() {
		$table = "exhibitor";
		return $table;
	}
	
	public function listExhibitor($isActive)
        {
            $this->db->select('*');
            $this->db->from('exhibitor');
			$this->db->where('Exhibitor_IsActive',$isActive); 
            $query = $this->db->get(); 
			//$query = $this->db->last_query();
		   // echo $query; exit; 
            if($query->num_rows() != 0)
            {
                return $query->result_array();
            }
            else
            {
                return false;
            }
        }

     function userUpdate($data,$reg_id)
	 {
		$this->db->where("regId", $reg_id);
		$ans = $this->db->update("exhibitor",$data);
	    return $ans; 
	 }
   
	function getsubmitchangepassword($password,$oldpassword,$regId)
	{
		$hashpassword=Modules::run('sitesecurity/makeHash',$password);
		$oldhashpassowrd=Modules::run('sitesecurity/makeHash',$oldpassword);
		$strResult=$this->get_where($regId);
		$strResult=$strResult->result();
			$Resultoldpassword=$strResult[0]->password;
			if($Resultoldpassword==$oldhashpassowrd)
			{
					$strQuery="update exhibitor set password='$hashpassword' where regId=$regId";
					$strResult=$this->_custom_query($strQuery);
						if($strResult) 
						{
							$strResult=1;

						}
						else 
						{
							$strResult="Some error occure.";
						}


			}
			else
			{
				$strResult="Old password is inccorect";

			}
			return $strResult;
		

	}

	 function userDeactive($id)
	 {
		$this->db->where('regId', $id);
        $ans=$this->db->update('exhibitor',array("isActive"=>"0"));
		return $ans;
	 }
	 
	function userActive($id)
	 {
		$this->db->where('regId', $id);
        $ans=$this->db->update('exhibitor',array("isActive"=>"1"));
	    return $ans;
	 }

    function getFeeds($id)
	{
	  $ans = $this->db->get_where("feed_userfeed",array("regId"=>$id,"isActive"=>"1"));	
	  if($ans->num_rows()>0)
	  {
		 return $ans->result();
	  }
	  else
	  {
	    return "No";	  
	  }
	}
    
	
	function getUser($id)
	{
		$ans=$this->db->get_where("exhibitor",array("regId"=>$id));
		if($ans->num_rows()>0)
		{
			return $ans->result();
		}
    }
	
	function get($order_by) {

		$table = $this->get_table();

		$this->db->order_by($order_by);

		$query=$this->db->get($table);

		return $query;

	}



	function get_with_limit($limit, $offset, $order_by) {

		$table = $this->get_table();

		$this->db->limit($limit, $offset);

		$this->db->order_by($order_by);

		$query=$this->db->get($table);

		return $query;

	}



	function get_where($regId) {

		$table = $this->get_table();

		$this->db->where('regId', $regId);

		$query=$this->db->get($table);

		return $query;

	}



	function get_where_custom($col, $value) {

		$table = $this->get_table();

		$this->db->where($col, $value);

		$query=$this->db->get($table);

		return $query;

	}



	function _insert($data) {

		$table = $this->get_table();

		return $this->db->insert($table, $data);

	}



	function _update($regId, $data) {

		$table = $this->get_table();

		$this->db->where('regId', $regId);

		return $this->db->update($table, $data);

	}



	function _delete($regId) {

		$table = $this->get_table();

		$this->db->where('regId', $regId);

		return $this->db->delete($table);

	}



	function count_where($column, $value) {

		$table = $this->get_table();

		$this->db->where($column, $value);

		$query=$this->db->get($table);

		$num_rows = $query->num_rows();

		return $num_rows;

	}



	function count_all() {

		$table = $this->get_table();

		$query=$this->db->get($table);

		$num_rows = $query->num_rows();

		return $num_rows;

	}



	function get_max() {

		$table = $this->get_table();

		$this->db->select_max('regId');

		$query = $this->db->get($table);

		$row=$query->row();

		$regId=$row->regId;

		return $regId;

	}



	function _custom_query($mysql_query) {

		$query = $this->db->query($mysql_query);
		return $query;

	}
	
	function checkEmail($email){
  
			    $strQuery="select * FROM exhibitor where email='$email'";
				$strResult=$this->_custom_query($strQuery);
				
					if($strResult->num_rows > 0)
					{ 
						$strResult=$strResult->result();
								   $strResult=array("Result"=>$strResult,
									"Message"=>"Success",
									"status"=>"true");	
					}
					else
					{
						            $strResult=array("Result"=>"",
									"Message"=>"Mail address does not exists",
									"status"=>"false");	
					}
					return $strResult;
}


	
public function change_forgot_passowrd($uid,$new)
	{
	    $this->db->where("regId", $uid);
		$ans = $this->db->update("exhibitor",array("password"=>$new));
	    return $ans; 
	}
	
}
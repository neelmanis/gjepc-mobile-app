<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_services extends CI_Model { 
	function __construct() {
		parent::__construct();
	}

		function _insert($table,$data) { 
		  $query = $this->
		  db->insert($table,$data);
            //$query = $this->db->last_query();
		    // exit;
			return $query;

		}

		function _custom_query($mysql_query) {
			$query = $this->db->query($mysql_query);
			return $query;
		}
 
               function _custom_query1($mysql_query) {
			$query = $this->db->query($mysql_query);
			return $this->db->insert_id();;
		}


		function _update($table,$data,$regid){

			$this->db->where('feedId', $regid);

			$updaterec = $this->db->update($table, $data); 

                        return $updaterec;

		}
		function _updateprofile($table,$data,$regid){
		$this->db->where('regId', $regid);		
		return $this->db->update($table, $data); 
		}
		
		function _delete($table,$feedid){
		$this->db->where('feedId', $feedid);		
		$deleterec = $this->db->delete($table);  
		return $deleterec;
		}

		function _get($table)
		{
			$query=$this->db->get($table);
			return $query;
		}
		function get_where($table,$coloumnName,$value) {
			$this->db->where($coloumnName,$value);
			$query=$this->db->get($table);
			return $query;
		}
		
		function count_all($table) {
			$query=$this->db->get($table);
			$num_rows = $query->num_rows();
			return $num_rows;
	    }
	
	function newsList()
	   {
		    $strQuery="select * FROM news_master where status=1 order by id desc";
			$strResult=$this->_custom_query($strQuery);
			if($strResult)
			{
				$strResult=$strResult->result();
				$news=$strResult;
						$strResult=array("Result"=>$news,
						"Message"=>"Success.",
						"status"=>"true");	
			}
			else
			{
				$strResult=array("Result"=>"",
						"Message"=>"some error occure.",
						"status"=>"false");	
			}
			return $strResult;
	   }
	   function newsSearch($name,$orderBy,$year,$from,$to)
	   {
	   		$strQuery='';
	   		$strQuery.="select * FROM news_master where status=1";
			
			if($name!='')
			{
				$strQuery.=" and name LIKE '%".$name."%'";
			}
			
			if($year!='')
			{
				$strQuery.=" and year(post_date)='".$year."'";
			}
			
			if($from!='')
			{
				$strQuery.=" and `post_date` BETWEEN '".$from."' AND '".$to."'";
			}
			if($orderBy!='')
			{
				$strQuery.=" order by id".$orderBy;
			}
			
			$strResult=$this->_custom_query($strQuery);
			if($strResult)
			{
				$strResult=$strResult->result();
				$news=$strResult;
						$strResult=array("Result"=>$news,
						"Message"=>"Success.",
						"status"=>"true");	
			}
			else
			{
				$strResult=array("Result"=>"",
						"Message"=>"some error occure.",
						"status"=>"false");	
			}
			return $strResult;
	   }


	function exhibitorList()
	   {
		    $strQuery="select * FROM exhibitor where Exhibitor_IsActive=1 order by Exhibitor_Name ASC";
			$strResult=$this->_custom_query($strQuery);
			if($strResult)
			{
				$strResult=$strResult->result();
				$exhibitors=$strResult;
						$strResult=array("Result"=>$exhibitors,
						"Message"=>"Success.",
						"status"=>"true");	
			}
			else
			{
				$strResult=array("Result"=>"",
						"Message"=>"some error occure.",
						"status"=>"false");	
			}
			return $strResult;
	   }
	  
	  function exhibitorSearch($name)
	   {
	   		$strQuery='';
	   		$strQuery.="select * FROM exhibitor where Exhibitor_IsActive=1";
			
			if($name!='')
			{
				$strQuery.=" and Exhibitor_Name LIKE '%".$name."%'";
			}			
			
			$strResult=$this->_custom_query($strQuery);
			if($strResult)
			{
				$strResult=$strResult->result();
				$news=$strResult;
						$strResult=array("Result"=>$news,
						"Message"=>"Success.",
						"status"=>"true");	
			}
			else
			{
				$strResult=array("Result"=>"",
						"Message"=>"some error occure.",
						"status"=>"false");	
			}
			return $strResult;
	   }

	   
	function categoryUpdate($catId,$catName,$regId)
	{
	           $updateArray=array(
			    "catId"=>$catId,
				"catName"=>$catName,
				"regId"=>$regId,
				'modifiedDate'=>date("Y-m-d h:i:s")
				);
				$strResult=$this->_updateCat("feed_Category",$updateArray,$catId);
				if($strResult)
				{
					$strResult=$this->getCategory($catId);
				}
				else
				{
					$strResult=array("Result"=>"",
									"Message"=>"some error occure.",
									"status"=>"false");	
				}
				return $strResult;
	}

   function categoryDelete($catId)
   {
      $delete = $this->_deleteCat('feed_Category',$catId);
				if($delete)
				{
					$strResult=array("Result"=>"",
									"Message"=>"Success.",
									"status"=>"true");	
				}
				else
				{
					$strResult=array("Result"=>"",
									"Message"=>"something goes wrong!.",
									"status"=>"false");	
				}
				return $strResult;
   }
} 
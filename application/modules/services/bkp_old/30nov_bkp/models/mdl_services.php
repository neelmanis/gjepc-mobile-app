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

		/**************** News Section Start ****************/	
		
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
	   
	   function fortnightly()
	   {
		    $strQuery="select * FROM fortnightly where status=1 order by id desc";
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
	   
	   function patrika()
	   {
		    $strQuery="select * FROM e_patrika where status=1 order by id desc";
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
	   
	   function statisticsExport()
	   {
	   		$strQuery="select a.id,a.cat_name,b.name,b.upload_statistics_export FROM statistics_export_category a, statistics_export_master b where a.id=b.cat_id and b.set_archive='0' and b.status='1' order by a.order_no desc, b.post_date desc,b.id desc";				
			$strResult=$this->_custom_query($strQuery);				
			if($strResult)
			{
				$strResult=$strResult->result();
				$getExport=$strResult;
						$strResult=array("Result"=>$getExport,
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
	   
	   function statisticsImport()
	   {
	   		$strQuery="select a.id,a.cat_name,b.name,b.upload_statistics_import FROM statistics_import_category a, statistics_import_master b where a.id=b.cat_id and b.set_archive='0' and b.status='1' order by a.order_no desc, b.post_date desc,b.id desc";				
			$strResult=$this->_custom_query($strQuery);				
			if($strResult)
			{
				$strResult=$strResult->result();
				$getImport=$strResult;
						$strResult=array("Result"=>$getImport,
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

	/**************** News Section End ****************/	
	
    /*************** Exhibitor Section Start **********/
	
	   function exhibitorList($year,$eventName)
	   {
		    $strQuery='';
		    $strQuery.="select * FROM exhibitor where Exhibitor_IsActive=1";
						
			if($year!='')
			{
				$strQuery.=" and year='".$year."'";
			}
			if($eventName!='')
			{
				$strQuery.=" and event_name='".$eventName."'";
			}
			
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
				$exResult=$strResult;
						$strResult=array("Result"=>$exResult,
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
	   
	   function circularMember($year)
	   {
	   		//$strQuery="select a.cat_name,b.name,b.upload_circulars FROM circulars_to_member_category a, circulars_to_member_master b where a.id=b.cat_id";			
			//$strQuery.="select a.cat_name,b.name,b.upload_circulars FROM circulars_to_member_category a, circulars_to_member_master b where a.id=b.cat_id order by a.order_no desc";
			$strQuery='';
			$strQuery.="select a.cat_name,b.name,b.upload_circulars FROM circulars_to_member_category a, circulars_to_member_master b where a.id=b.cat_id";
			
			if($year!='')
			{
				$strQuery.=" and a.cat_name='".$year."'";
			}
			$strQuery.=" order by a.order_no desc";
		
			$strResult=$this->_custom_query($strQuery);				
			if($strResult)
			{
				$strResult=$strResult->result();
				$circularm=$strResult;
						$strResult=array("Result"=>$circularm,
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
	   
	   function circularGov($year)
	   {
	   	//$strQuery="select a.cat_name,b.name,b.upload_circulars FROM circulars_category a, circulars_master b where a.id=b.cat_id";
		//$strQuery="select a.cat_name,b.name,b.upload_circulars FROM circulars_category a, circulars_master b where a.id=b.cat_id order by a.order_no desc";
			$strQuery='';
			$strQuery="select a.cat_name,b.name,b.upload_circulars FROM circulars_category a, circulars_master b where a.id=b.cat_id";
		
			if($year!='')
			{
				$strQuery.=" and a.cat_name='".$year."'";
			}
			$strQuery.=" order by a.order_no desc";
			
			$strResult=$this->_custom_query($strQuery);
			if($strResult)
			{
				$strResult=$strResult->result();
				$circular=$strResult;
						$strResult=array("Result"=>$circular,
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

	   /*************** Exhibitor Section End **************/
	   
	   /*************** Members Directory Start **********/
	   
	   function memberDirectoryList()
	   { 
		$current_year = (int)date('Y');
		$next_year    = date('Y', strtotime('+1 year'));

   	$strQuery="SELECT a.company_name,a.city,b.registration_id,c.region_id FROM registration_master a, `approval_master` b, `information_master` c WHERE 1  and (b.`membership_issued_certificate_dt` between '".$current_year."-04-01' and '".$next_year."-03-31' || (b.`membership_renewal_dt` between '".$current_year."-04-01' and '".$next_year."-03-31')) and a.id=b.registration_id and a.id=c.registration_id";
			$strResult=$this->_custom_query($strQuery);				
			if($strResult)
			{
				$strResult=$strResult->result();
				$dirList=$strResult;
						$strResult=array("Result"=>$dirList,
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
	   
	   /*************** Members Directory End **********/
	   
	   /************************ Statistics Search Start ************************************************/
	   function statisticsSearch($year,$quarter,$month,$commodity_name,$hs_code,$trade_type)
	   {
	   		$strQuery='';
	   		echo $strQuery.="select id, comodity_description,product_category_code,year,export_import_date,country_name,country_code,value_INR as total_inr,value_USD as total_usd,export_import_date from statistics_report where 1"; 
			
			if($year!='')
			{
				$strQuery.=" and year='".$year."'";
			}
			
			if($quarter!='')
			{
					if($quarter==1)
					{
					$strQuery.=" and export_import_date between '$year-01-01' and '$year-03-31' ";
					}else if($quarter==2)
					{
					$strQuery.=" and export_import_date between '$year-04-01' and '$year-06-30' ";
					}else if($quarter==3)
					{
					$strQuery.=" and export_import_date between '$year-07-01' and '$year-09-30' ";
					}else if($quarter==4)
					{
					$strQuery.=" and export_import_date between '$year-10-01' and '$year-12-31' ";
					}
			}
			
			if($month!='')
			{
				if($month==1)
					{
					$strQuery.=" and export_import_date between '$year-01-01' and '$year-01-31' ";
					}else if($month==2)
					{
					$strQuery.=" and export_import_date between '$year-02-01' and '$year-02-29' ";
					}else if($month==3)
					{
					$strQuery.=" and export_import_date between '$year-03-01' and '$year-03-31' ";
					}else if($month==4)
					{
					$strQuery.=" and export_import_date between '$year-04-01' and '$year-04-30' ";
					}else if($month==5)
					{
					$strQuery.=" and export_import_date between '$year-05-01' and '$year-05-31' ";
					}else if($month==6)
					{
					$strQuery.=" and export_import_date between '$year-06-01' and '$year-06-30' ";
					}else if($month==7)
					{
					$strQuery.=" and export_import_date between '$year-07-01' and '$year-07-31' ";
					}else if($month==8)
					{
					$strQuery.=" and export_import_date between '$year-08-01' and '$year-08-31' ";
					}else if($month==9)
					{
					$strQuery.=" and export_import_date between '$year-09-01' and '$year-09-30' ";
					}else if($month==10)
					{
					$strQuery.=" and export_import_date between '$year-10-01' and '$year-10-31' ";
					}else if($month==11)
					{
					$strQuery.=" and export_import_date between '$year-11-01' and '$year-11-30' ";
					}else if($month==12)
					{
					$strQuery.=" and export_import_date between '$year-12-01' and '$year-12-31' ";
					}				
			}
			
			if($commodity_name!='')
			{
				$strQuery.=" and product_category_code like '%$commodity_name%' ";
			}
			
			if($hs_code!='')
			{
				$strQuery.=" and hs_code='$hs_code' ";
			}
			
			if($trade_type!='')
			{
				$strQuery.=" and trade_type='$trade_type' ";
			}
			
		//	$strQuery.=" and trade_type='$trade_type' ";
			
			
			$strQuery.=" group by country_code order by total_inr desc";
			//echo $strQuery; exit;
			$strResult=$this->_custom_query($strQuery);
			if($strResult)
			{
				$strResult=$strResult->result();
				$statSearch=$strResult;
						$strResult=array("Result"=>$statSearch,
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
	   
	   /************************ Statistics Search End ************************************************/
	   
	    /************************ Lab Start ************************************************/
	   function labList()
	   {
		    $strQuery="select * FROM cms_laboratories where status=1";
			$strResult=$this->_custom_query($strQuery);
			if($strResult)
			{
				$strResult=$strResult->result();
				$labs=$strResult;
						$strResult=array("Result"=>$labs,
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
	   
	   /************************ Lab  End ************************************************/
	   
	    /************************ Education Start ************************************************/
	   function getinstitutesList()
	   {
		    $strQuery="select * FROM cms_institutes where status=1";
			$strResult=$this->_custom_query($strQuery);
			if($strResult)
			{
				$strResult=$strResult->result();
				$institutes=$strResult;
						$strResult=array("Result"=>$institutes,
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
	   
	   /************************ Education End ************************************************/
	  
	/********************************************************* Enquiry ******************************************/
	function submitenquiry($topic,$email,$mobile,$enquiry)
	{
								$insertQuery=array(
											'post_date'=>date("Y-m-d h:i:s"),
											'topic'=>$topic,
											'email'=>$email,
											'mobile'=>$mobile,
											'enquiry'=>$enquiry,
											'ipAddress'=>$_SERVER['REMOTE_ADDR']
											);
								   $strResult=$this->_insert('enquiry',$insertQuery);
									if($strResult)
									{
								    $strResult=array("Result"=>"",
													"Message"=>"Success",
													"status"=>"true");	
									}
									else
									{
									$strResult=array("Result"=>"",
												"Message"=>"Some error occure.",
												"status"=>"false");	
									}
									return $strResult;
	}

/********************************************************* Enquiry ******************************************/
	   
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
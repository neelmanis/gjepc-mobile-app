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
		
	   function newsList($start, $limit)
	   {	
			$strQuery="";
		    $strQuery.="select * FROM news_master where status=1 order by id desc limit $start, $limit";			
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
	   
	   function newsSearch($name,$start, $limit)
	   {
	   		$strQuery='';
	   		$strQuery.="select * FROM news_master where status=1";
			
			if($name!='')
			{
				$strQuery.=" and name LIKE '%".$name."%' limit $start, $limit";
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
	   
	   function getNewsNotification($deviceID)
	   {	
			$strQuery="select * FROM news_master where status='1' ORDER BY post_date DESC LIMIT 5";			
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
	   
	   function getPatrika($start, $limit)
	   {	
			$strQuery="";
		    $strQuery.="select * FROM e_patrika where status=1 order by id desc limit $start, $limit";
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
	   
	   function getPatrikaSearch($name,$start,$limit)
	   {
	   		 $strQuery='';
	   		 $strQuery.="select * FROM e_patrika where status=1";
			
			if($name!='')
			{
				$strQuery.=" and name LIKE '%".$name."%' limit $start, $limit";
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
	   
	   function getNewsletter($start, $limit)
	   {
			$strQuery="";
		    $strQuery.="select name,year,html_files FROM newsletter_master where status=1 order by year desc limit $start, $limit";
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
	   
	   function getNewsletterSearch($name,$start,$limit)
	   {
	   		 $strQuery='';
	   		 $strQuery.="select * FROM newsletter_master where status=1";
			
			if($name!='')
			{
				$strQuery.=" and name LIKE '%".$name."%' limit $start, $limit";
			}
						
			$strResult=$this->_custom_query($strQuery);
			if($strResult)
			{
				$strResult=$strResult->result();
				$patri=$strResult;
						$strResult=array("Result"=>$patri,
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
	   
	   function getArticleSearch($title,$start,$limit)
	   {
	   		$strQuery='';
	   		$strQuery.="select * FROM update_article where status='1'";
			
			if($title!='')
			{
				$strQuery.=" and title LIKE '%".$title."%' limit $start, $limit";
			}
				
			$strResult=$this->_custom_query($strQuery);
			if($strResult)
			{
				$strResult = $strResult->result();
				$article = $strResult;
						$strResult=array("Result"=>$article,
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
		   /* $strQuery.="SELECT `Exhibitor_ID`, `Exhibitor_Gid`, `Customer_No`, `Exhibitor_Name`, `Exhibitor_Contact_Person`, `Exhibitor_Designation`, `Exhibitor_Code`, `Exhibitor_Login`, `Exhibitor_Password`, `Exhibitor_Address1`, `Exhibitor_Address2`, `Exhibitor_Address3`, `Exhibitor_City`, `Exhibitor_State`, `Exhibitor_Country_ID`, `Exhibitor_Pincode`, `Exhibitor_Mobile`, `Exhibitor_Phone`, `Exhibitor_Fax`, `Exhibitor_Email`, `Exhibitor_Email1`, `Exhibitor_Website`, `Exhibitor_HallNo`, `Exhibitor_DivisionNo`, UPPER(REPLACE(Exhibitor_Section, '_', ' ')) as Exhibitor_Section, `Exhibitor_Scheme`, `Exhibitor_Area`, `Exhibitor_StallNo1`, `Exhibitor_StallNo2`, `Exhibitor_StallNo3`, `Exhibitor_StallNo4`, `Exhibitor_StallNo5`, `Exhibitor_StallNo6`, `Exhibitor_StallNo7`, `Exhibitor_StallNo8`, `Exhibitor_StallType`, `Exhibitor_Premium`, `Exhibitor_Region`, `Exhibitor_IsActive`, `comments`, `Exhibitor_Layout`, `Exhibitor_Subscribe`, `Exhibitor_LastLogin`, `Xml_ID`, `Exhibitor_Registration_ID`, `event_name`, `year`, `Catalog_CompanyLogo` FROM `exhibitor` where Exhibitor_IsActive=1";
			*/
			$strQuery.="select E.*,UPPER(REPLACE(E.Exhibitor_Section, '_', ' ')) as Exhibitor_Section,C.Catalog_ProductLogo,C.Catalog_CompanyLogo,C.Catalog_Brief from exhibitor E left join iijs_catalog C on E.Exhibitor_Code=C.Exhibitor_Code WHERE E.Exhibitor_IsActive =1";
			
						
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
	   
	 /************************ Exhibitor Menu End  Start **********************************************/
	   function getExhibitorMenuList($eventName)
	   {
		    $strQuery="SELECT * FROM `app_exhibitor_menu` WHERE event='$eventName' AND status='1'";
			$strResult=$this->_custom_query($strQuery);
			if($strResult)
			{
				$strResult=$strResult->result();
				$menuList=$strResult;
						$strResult=array("Result"=>$menuList,
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

	 /************************ Exhibitor Menu End **********************************************/

	   function circularMember($year,$name)
	   {
	   		//$strQuery="select a.cat_name,b.name,b.upload_circulars FROM circulars_to_member_category a, circulars_to_member_master b where a.id=b.cat_id";			
			//$strQuery.="select a.cat_name,b.name,b.upload_circulars FROM circulars_to_member_category a, circulars_to_member_master b where a.id=b.cat_id order by a.order_no desc";
			$strQuery='';
			$strQuery.="select a.cat_name,b.name,b.upload_circulars FROM circulars_to_member_category a, circulars_to_member_master b where a.id=b.cat_id";
			
			if($year!='')
			{
				$strQuery.=" and a.cat_name='".$year."'";
			}
			if($name!='')
			{
				$strQuery.=" and b.name LIKE '%".$name."%'";
			}
			$strQuery.=" order by a.order_no desc";
	//	echo $strQuery; exit;
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
	   
	   function circularGov($year,$name)
	   {
	   	//$strQuery="select a.cat_name,b.name,b.upload_circulars FROM circulars_category a, circulars_master b where a.id=b.cat_id";
		//$strQuery="select a.cat_name,b.name,b.upload_circulars FROM circulars_category a, circulars_master b where a.id=b.cat_id order by a.order_no desc";
			$strQuery='';
			$strQuery="select a.cat_name,b.name,b.upload_circulars FROM circulars_category a, circulars_master b where a.id=b.cat_id";
		
			if($year!='')
			{
				$strQuery.=" and a.cat_name='".$year."'";
			}
			if($name!='')
			{
				$strQuery.=" and b.name LIKE '%".$name."%'";
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

   	/*$strQuery="SELECT a.company_name,a.city,b.registration_id,c.region_id FROM registration_master a, `approval_master` b, `information_master` c WHERE 1  and (b.`membership_issued_certificate_dt` between '".$current_year."-04-01' and '".$next_year."-03-31' || (b.`membership_renewal_dt` between '".$current_year."-04-01' and '".$next_year."-03-31')) and a.id=b.registration_id and a.id=c.registration_id"; */
	
	$strQuery="SELECT a.company_name,a.city,b.registration_id,c.region_id FROM registration_master a, `approval_master` b, `information_master` c WHERE 1  and (b.`membership_issued_certificate_dt` between '2016-04-01' and '2017-03-31' || (b.`membership_renewal_dt` between '2016-04-01' and '2017-03-31')) and a.id=b.registration_id and a.id=c.registration_id";
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
	   		$strQuery.="select id, product_category_code,year,export_import_date,country_name,country_code,value_INR as total_inr,value_USD as total_usd,export_import_date from statistics_report where 1"; 
			
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
			//echo $strQuery; //exit;
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
	 
	/************************ CFC Start ************************************************/
	   function getCfcList()
	   {
		    $strQuery="select * FROM cms_cfc where status='1'";
			$strResult=$this->_custom_query($strQuery);
			if($strResult)
			{
				$strResult=$strResult->result();
				$cfcs=$strResult;
						$strResult=array("Result"=>$cfcs,
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
	   
	 /************************ CFC End ************************************************/
	 
	 /************************ GJEPC EVENTS START **********************************************/
	   function getGjepcEventList()
	   {
		    $strQuery="select * FROM appnewevents where status='1'";
			$strResult=$this->_custom_query($strQuery);
			if($strResult)
			{
				$strResult=$strResult->result();
				$cfcs=$strResult;
						$strResult=array("Result"=>$cfcs,
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
	   
	 /************************ GJEPC EVENTS END **********************************************/
	   
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
							        $strQuery="select * FROM helpdesk where id='$topic'"; 
				                    $strResult=$this->_custom_query($strQuery); 
									$strResult=$strResult->result();
								    $strResult=array($strResult,
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

/********************************************************* helpdesk ******************************************/	   
	function enquiryTopicList()
	{
            $strQuery="select id,dept from  helpdesk"; 
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
							"Message"=>"Some error occure.",
							"status"=>"false");	
			}
			return $strResult;
	}

/********************************************************* helpdesk ******************************************/	   

/************************ Show Info Start ************************************************/
	   function infoList($year,$eventName)
	   {
		    $strQuery='';
		    $strQuery.="select * FROM cms_show_info where status=1";
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
	   
/************************ Show Info  End ************************************************/

/************************ Service Venue Start ************************************************/
	   function venueList($year,$eventName)
	   {
		    $strQuery='';
		    $strQuery.="select * FROM cms_services_venue where status=1";
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
	   
/************************ Service Venue End ************************************************/

/************************ How To Reach Start ************************************************/
	   function reachList($year,$eventName)
	   {
		    $strQuery='';
		    $strQuery.="select * FROM cms_how_to_reach where status=1";
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
				$reaches=$strResult;
						$strResult=array("Result"=>$reaches,
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
	   
/************************ How To Reach End ************************************************/

/************************ OOPS Start ************************************************/
	   function getoopsList($year,$eventName)
	   {
		    $strQuery='';
		    $strQuery.="SELECT * FROM `cms_operational_manual` WHERE status=1";
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
				$oops=$strResult;
						$strResult=array("Result"=>$oops,
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
	   
/************************ OOPS End ************************************************/

/************************ Show Updates Start ************************************************/

	   function showUpdateList($year,$eventName)
	   {
			$strQuery='';
		    $strQuery.="SELECT `id`, `post_date`, `event_name`, `year`, `title`,`description` FROM `cms_show_updates` WHERE status='1'";
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
				$showlist=$strResult;
						$strResult=array("Result"=>$showlist,
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

/************************ Show Updates End ************************************************/	

/************************ Zone Manager Start ************************************************/

	   function zoneManagerList($eventName)
	   {
		    $strQuery='';
		    $strQuery.="SELECT `id`, `post_date`, `hall`, `zone`, `event_name`, `year`, `name`, `email`, `mob` FROM `cms_zone_manager` WHERE status='1'";
			if($eventName!='')
			{
				$strQuery.=" and event_name='".$eventName."' order by hall";
			}
			
			$strResult=$this->_custom_query($strQuery);
			if($strResult)
			{
				$strResult=$strResult->result();
				$zonelist=$strResult;
						$strResult=array("Result"=>$zonelist,
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

/************************ Zone Manager End ************************************************/
/************************ Event Status Start **********************************************/
	   function getEventStatus($event)
	   {
			$strQuery='';
		    $strQuery.="SELECT `event`, `status` FROM `event_master` WHERE 1";
			if($event!='')
			{
				$strQuery.=" and event='".$event."'";
			}
			$strResult=$this->_custom_query($strQuery);
			if($strResult)
			{
				$strResult=$strResult->result();
				$chkstatus=$strResult;
						$strResult=array("Result"=>$chkstatus,
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

/************************ Event Status End ************************************************/
/************************ Metal & Currency Rate Status Start ***************************/
	   function getMetalNCurrency()
	   {
			
		    $strQuery="select * from current_market_rate_master where status=1 order by post_date desc limit 4";
			
			$strResult=$this->_custom_query($strQuery);
			if($strResult)
			{
				$strResult=$strResult->result();
				$chkstatus=$strResult;
						$strResult=array("Result"=>$chkstatus,
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

/************************ Metal & currency Status End **********************************/
 
 /************************ Notification List Start ************************************************/	  
	   function getNotifyList()
	   {
		    $strQuery="select * FROM notification_msg where status=1";
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
	   
/************************ Notification List End ************************************************/
	   
/************************ Notification Start **********************************************/ 
	function submitNotification($deviceType,$gcmRegid)
	{
            $strQuery="select * from  push_notification where deviceId='$gcmRegid'"; 
			$strResult=$this->_custom_query($strQuery);			
					if($strResult->num_rows>0)
					{
					 $result=$strResult->result();					 
					 $id=$result[0]->id;
				     $deviceId=$result[0]->deviceId;
					 $deviceType=$result[0]->deviceType; 
					 
					 $strQuery="update push_notification set modified_date=NOW() where id=".$id;
					 $Result=$this->_custom_query($strQuery);
						if($Result)
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
					
					}				
					else
					{
					$insertQuery=array(
										
                                            'deviceType'=>$deviceType,
                                            'deviceId'=>$gcmRegid,          
											'post_date'=>date("Y-m-d h:i:s"),
											'modified_date'=>date("Y-m-d h:i:s"),
											'isActive'=>1
										);
								    $Result=$this->_insert('push_notification',$insertQuery);
									if($Result)
									{
								    $strQuery="select * FROM push_notification where deviceId='$gcmRegid'"; 
				                    $strResult=$this->_custom_query($strQuery); 
									$strResult=$strResult->result();
								    $strResult=array("Result"=>$strResult,
													"Message"=>"Success",
													"status"=>"true");	
									}
									else
									{
									$strResult=array("Result"=>"",
									"Message"=>"Some error occure.",
									"status"=>"false");	
									}
					}
					return $strResult;
}
/************************ Notification End **********************************************/

/************************ Video Start **********************************************/
	   function getvideoList($catName)
	   {
		    $strQuery="select title,category,video_url FROM app_video_section where category='$catName' AND status='1'";
			$strResult=$this->_custom_query($strQuery);
			if($strResult)
			{
				$strResult=$strResult->result();
				$videos=$strResult;
						$strResult=array("Result"=>$videos,
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

/************************ Video End **********************************************/


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
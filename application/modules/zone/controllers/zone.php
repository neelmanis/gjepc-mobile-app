<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Zone extends MX_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('mdl_zone');
		$this->load->library('form_validation');
		$this->load->helper('url');
	}
	
	function index()
	{	
		$data['viewFile']='show';
		$template='dashboard';
			
		$data['userlist']=$this->get('regId')->result();		
		echo Modules::run('template/'.$template,$data);
		
	}

/*********************************************** Start Show Updates Details ***************************************************/	

	function ZoneList()
	{
		$template = 'admin';
		$data['viewFile'] = "zone";
		$data['page'] = 'details';
		$data['menu'] = 'zone';
		$data['details'] = $this->mdl_zone->getShowList();
		echo Modules::run('template/'.$template, $data);
	}	
		
	function addzonedetails()
	{
		  $template = 'admin';
		  $data['viewFile'] = "addzonedetails";
		  $data['page'] = 'addzonedetails';
		  $data['menu'] = 'abc';
		  $data['hall']= $this->mdl_zone->getHallList();
		  $data['zone']= $this->mdl_zone->getZoneList();		  
		  $data['events']= $this->mdl_zone->getEvents();
		  $data['years']= $this->mdl_zone->getYear();
		   echo Modules::run('template/'.$template, $data);
	}
	
	/************* get Event Name ************/
	function eventName($event)
	{
	   $getEvents = $this->mdl_zone->getEventName($event);
	   echo  $getEvents;
    }
	
	/************* get Year Name ************/
	function yearName($year)
	{
	   $getYear = $this->mdl_zone->getYearName($year);
	   echo  $getYear;
    }
	
	/************* get Hall Name ************/
	function hallName($hall)
	{
	   $getHall = $this->mdl_zone->getHallName($hall);
	   echo  $getHall;
    }
	
	/************* get Zone Name ************/
	function zoneName($zone)
	{
	   $getZone = $this->mdl_zone->getZoneName($zone);
	   echo  $getZone;
    }
	
	function addDetails()
	{ 
		$userdata = $this->input->post();				  
			 $data = array(
					'hall'=>$userdata['hall'],
					'zone'=>$userdata['zone'],
					'event_name'=>$userdata['event'],
					'year'=>$userdata['year'],					
					'name'=>$userdata['name'],
					'email'=>$userdata['email'],
					'mob'=>$userdata['mob'],
					'status'=>$userdata['status']
			      );
				
			$updateData = $this->mdl_zone->addDetail($data);					
			redirect('zone/ZoneList');		
	}
	
	function editinfo($id)
	{
		if(!empty($id))
		{
		  $template = 'admin';
		  $data['viewFile'] = "editzone";
		  $data['page'] = 'editzone';
		  $data['hall']= $this->mdl_zone->getHallList();
		  $data['zone']= $this->mdl_zone->getZoneList();
		  $data['editinfo']=$this->mdl_zone->getUser($id);
		  $data['events']= $this->mdl_zone->getEvents();
		  $data['years']= $this->mdl_zone->getYear();
		  $data['menu'] = 'abc';
		  echo Modules::run('template/'.$template, $data);
		}
		else
		{
			  redirect("admin/login");
		}
	}
	
	function updateDetails()
	{
		$userdata = $this->input->post();	
		$id =$userdata['id'];						  
			 $data = array(
					'hall'=>$userdata['hall'],
					'zone'=>$userdata['zone'],
					'event_name'=>$userdata['event'],
					'year'=>$userdata['year'],					
					'name'=>$userdata['name'],
					'email'=>$userdata['email'],
					'mob'=>$userdata['mob'],
					'status'=>$userdata['status'],
					'modified_date'=> date('Y-m-d H:i:s')
			        );
				
			$updateData = $this->mdl_zone->userUpdate($data,$id);
			redirect('zone/ZoneList');
	  }
	  
		function viewDetails($id)
		{
		if(!empty($id))
		{
			
	    $template = 'admin';
		$data = array();
		$data['viewFile'] = 'viewzonedetails';
		$data['page'] = 'viewzonedetails';
		$data['menu'] = 'abc';
		$data['hall']= $this->mdl_zone->getHallList();
		$data['zone']= $this->mdl_zone->getZoneList();
	    $data['view_details'] = $this->mdl_zone->getUser($id);
		$data['events']= $this->mdl_zone->getEvents();
		$data['years']= $this->mdl_zone->getYear();
		echo Modules::run('template/'.$template, $data);
		}
		else
		{
			 redirect("admin/login");
		}
		}
		
		function delete_details($id)
		{
			if(!empty($id))
			{
				$deleteData = $this->mdl_zone->del_Detail($id);
				redirect('zone/ZoneList');	
			}
		}
		
/**************************************************** End Show Updates Details ************************************************/	


	
	function changepassword()
	{
		$data['viewFile']='changepassword';
		$template='dashboard';
		echo Modules::run('template/'.$template,$data);
	}
	function submitchangepassword()
	{
		$password=$this->input->post("password");
		$oldpassword=$this->input->post("oldpassword");
		$regId=Modules::run('sitesecurity/getSessionId');
		echo $this->mdl_zoneinfo->getsubmitchangepassword($password,$oldpassword,$regId);
		
	}

	function get($order_by) {
		$query = $this->mdl_showinfo->get($order_by);
		return $query;
	}

	function get_with_limit($limit, $offset, $order_by) {
		$query = $this->mdl_showinfo->get_with_limit($limit, $offset, $order_by);
		return $query;
	}

	function get_where($addId) {
		$query = $this->mdl_showinfo->get_where($addId);
		return $query;
	}

	function get_where_custom($col, $value) {
		$query = $this->mdl_showinfo->get_where_custom($col, $value);
		return $query;
	}

	function _insert($data) {
		return $this->mdl_showinfo->_insert($data);
	}

	function _update($addId, $data) {
		return $this->mdl_showinfo->_update($addId, $data);
	}

	function _delete($addId) {
		return $this->mdl_showinfo->_delete($addId);
	}

	function count_where($column, $value) {
		$count = $this->mdl_showinfo->count_where($column, $value);
		return $count;
	}

	function get_max() {
		$max_id = $this->mdl_showinfo->get_max();
		return $max_id;
	}

	function _custom_query($mysql_query) {
		$query = $this->mdl_showinfo->_custom_query($mysql_query);
		return $query;
	}
/***************************** shital *********************************/	
	  public function forgotpass()
	  {
			$json = file_get_contents('php://input');
			$obj = json_decode($json,True);
			if(!empty($obj))
                        {
                            $email=$obj["email"];
			              
			if(!empty($obj)&& (isset($email)))
			{
    			  $strResponse = $this->mdl_showinfo->checkEmail($email);
			
					if($strResponse['Message'] == "Success")
					{ 
					$regId=base64_encode($strResponse['Result'][0]->regId);
					$exp=explode("=",$regId);
					
			 /********************** Mail *****************/
					$to  = $email;  
					// subject
				$subject = 'Life Feed-Change Password';
				//message
				$message ='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome to Life Feed</title>
<style type="text/css">
<!--
* { padding:0px;}

body, td, th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #353535;
	line-height:18px;
}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}

a:link{color:#353535; text-decoration:none; font-weight: bold;}
a:hover{color:#00519a; text-decoration:none; font-weight: bold;}


</style>
</head>
<body>
<table width="70%"  border="0" cellspacing="0" cellpadding="0" align="CENTER" bgcolor="#f2f2f2">
    <tr>
    <td colspan="4" bgcolor="#469D85">&nbsp;</td>
    </tr> 
    
    <tr>
    <td width="5%" height="81" align="center">&nbsp;</td>
    <td colspan="2" align="center" style="border-bottom:2px #2D2C80 solid"><img src="http://digitalagencymumbai.com/lifefeed/logo.png" width="150px" style="padding:10px 0px;" /></td>
    <td width="5%" align="center" >&nbsp;</td>
</tr>
    
    <tr>
    <td colspan="4">&nbsp;</td>
    </tr>
    
    <tr>
    <td>&nbsp;</td>
    <td colspan="2">Dear Sir/Madam,</td>
    <td>&nbsp;</td>
    </tr>
    
    <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
    
    <tr>
    <td>&nbsp;</td>
    <td colspan="2" style="text-align:justify;">
       To reset your  password, simply click the link below. That will take you to a web page where you can create a new password.</td>
    	  <td>&nbsp;</td>
    </tr>
    
    <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
    
     <tr>
    <td>&nbsp;</td>
    <td colspan="2">Please click<a href='.base_url("users/changeForgotpass/$exp[0]").'> 
    Click here</a></td>
    <td>&nbsp;</td>
    </tr>
    
    <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
    
    
    <tr>
    <td colspan="4">&nbsp;</td>
    </tr>
    
    
    <tr>
    <td height="22">&nbsp;</td>
    <td colspan="2" style="text-align:right">Regards,</td>
    <td>&nbsp;</td>
    </tr>
    
    <tr>
    <td height="23">&nbsp;</td>
    <td width="129" style="text-align:right">&nbsp;</td>
    <td width="436" style="text-align:right">Team Life Feed</td>
    <td>&nbsp;</td>
    </tr>
    
    <tr>
    <td colspan="4">&nbsp;</td>
    </tr>
    
    <tr>
    <td colspan="4" bgcolor="#469D85">&nbsp;</td>
    </tr></table>
</body>
</html>
';
				// To send HTML mail, the Content-type header must be set
				$headers = 'From:Life Feed- Change Password <info@digitalagencymumbai.com>' . "\r\n";
				$headers .= "MIME-Version: 1.0" . "\r\n";
   				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 

				// Additional headers

				// Mail it
				
					 mail($to, $subject, $message, $headers);
					 $strResponse=array(
						"Result"=>'',
						"Message"=>"Please check your mail to reset the password",
						"status"=>"true"
						);	
					/********************** Mail *****************/
			}
			}
			else
			{
				$strResponse=array(
				"Result"=>'',
				"Message"=>"Invalid post.Post must contains email.",
				"status"=>"false"
				);
				
			}
              }
          else 
               {
                $strResponse=array(
				"Result"=>'',
				"Message"=>" Invalid post.Post must contains email.",
				"status"=>"false"
				);
               }
				//header('Content-type: application/json');
			    echo json_encode(array("Response"=>$strResponse));

	 }
	 
function changeForgotpass($id='')
	{
if(!empty($id))
		{
		$uid = $id."==";
	    $data['user_id'] = base64_decode($uid);
		//echo $user_id;
	    $this->load->view('users/forgot_password',$data); 
	    }
		else
		{
		 show_404();
		}
	}	 
	
	 
	 public function updatePassword()
	 {
	   $formdata = $this->input->post();
	  
	   $this->form_validation->set_rules('new_pass','New Password','trim|required|xss_clean');
	   $this->form_validation->set_rules('confirm_pass','Confirm Password','trim|required|xss_clean|matches[new_pass]'); 
	   
	     if($this->form_validation->run() == FALSE)
		  {
	        echo validation_errors();	  
   		  }
		 else
		 {
		    $uid = $formdata['id']; 
			$new = Modules::run('sitesecurity/makeHash', $formdata['new_pass']);
			$update = $this->mdl_showinfo->change_forgot_passowrd($uid,$new);
			echo "1";
		 } 
	 }
/*************************** shital ***********************/	
}
?>
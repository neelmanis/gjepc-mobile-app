<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends MX_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('mdl_test');
		$this->load->library('form_validation');
	}
	
	function index()
	{		
		$data['viewFile']='showdetails';
		$template='dashboard';
		$this->load->helper('url');
			
		$data['userlist']=$this->get('regId')->result();		
		echo Modules::run('template/'.$template,$data);		
	}

/********************************************************** Start Test Details ****************************************/
	function addtest()
	{
		  $template = 'admin';
		  $data['viewFile'] = "addtest";
		  $data['page'] = 'addtest';
		  $data['menu'] = 'abc';
		  echo Modules::run('template/'.$template, $data);
	}
	
	function addtestDetails()
	{ 
		$userdata = $this->input->post();
		$email =$userdata['email'];
		//print_r($_POST); exit;
			 $data = array(
			        'email'=>$userdata['email']
					);
	
		$updateData = $this->mdl_test->check_email_availablity($data,$email);
		if(!$updateData ) {
		$this->load->view('addtest');
		echo '<span style="color:#f00">Email already exist.</span>';
		//$this->load->view('addtest');
		} else { 
		//$this->load->view('addtest');
		//echo '<span style="color:#0c0">Email Available</span>';
		$updateData = $this->mdl_test->addTestDetail($data);
		//echo '1'; 
		}
	}
	
	/********************************************************** Start Registration ****************************************/	

	function registration()
	{
		  $template = 'admin';
		  $data['viewFile'] = "registration";
		  $data['page'] = 'registration';
		  $data['menu'] = 'abc';
		  echo Modules::run('template/'.$template, $data);
	}
	
	function addRegistrationDetails()
	{ 
		$userdata = $this->input->post();
		$email =$userdata['email'];
		$username =$userdata['username'];
		$password =$userdata['password'];
		$status =$userdata['status'];
		//print_r($_POST); exit;
			 $data = array(
					'username'=>$userdata['username'],
			        'email'=>$userdata['email'],					
					'password'=>$userdata['password'],
					'status'=>$userdata['status']
					);
	
					$updateData = $this->mdl_test->addRegisDetail($data);
					redirect('test/RegistrationList');		
	}
	
	function listExhibitor($status = 'active')
	{
		$template = 'admin';
		$data['viewFile'] = "lists";
		$data['page'] = 'users';
		if($status == 'active')
		{
			$data['menu'] = 'listsA';
		}
		else
		{
			$data['menu'] = 'listsD';
		}
		$isActive = ($status == 'active') ? '1' : '0';
		$data['users'] = $this->mdl_test->listExhibitor($isActive);
		echo Modules::run('template/'.$template, $data);
	}
		
	function getlist($type)
	{
		if($type == "1" || $type == "0")
		{
			if($type == "1"){
				$data['value'] = "A";
			} else if($type == "0"){
				$data['value'] = "B";
			} else {
				$data['value'] = "P";
			}
						
			$data['page'] = "products";
			$data['menu'] = "lists";
			$template = 'admin';
			$data['viewFile'] = "list";
			$data['type'] = $type;
			echo Modules::run('template/'.$template,$data);	
		}
		else {
			show_404();
		}
	}
	
	function getProduct($type)
	{
		if(Modules::run('site_security/is_admin')):
		$new = array(); $json = array();
			$ans = $this->mdl_test->getExhibitor($type);	
			//print_r($ans); exit;
			foreach($ans as $val)
			{
				$new['Exhibitor_ID'] = $val->Exhibitor_ID;
				$new['Exhibitor_Name'] = $val->Exhibitor_Name;
				$new['Exhibitor_Contact_Person'] = $val->Exhibitor_Contact_Person;				
				$new['Exhibitor_Designation'] = $val->Exhibitor_Designation;
				$new['Exhibitor_Login'] = $val->Exhibitor_Login;				
				$new['Exhibitor_Password'] = $val->Exhibitor_Password;  
				
             //   $new['rentername'] = $this->getRegName($val->regId);       
				
				if($val->Exhibitor_IsActive == "1")
				{
					$new['Exhibitor_IsActive'] = "Active";
				} else if($val->Exhibitor_IsActive == "0")
				{
					$new['Exhibitor_IsActive'] = "Inactive";
				} else {
					$new['Exhibitor_IsActive'] = "Disapprove";
				}	
				
				array_push($json, $new);
			}
			echo json_encode($json);
		else:
			show_404();
		endif;
	}
		
	function inventory(){		
			$data['page'] = "inventory";
			$data['menu'] = "inventory";
			$template = 'admin';
			$data['viewFile'] = "list";
			echo Modules::run('template/'.$template,$data);	
}
}
?>
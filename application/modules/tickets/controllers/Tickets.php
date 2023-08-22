<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH.'modules/generic/controllers/Generic.php';

/**
 * 	Author : NEEL
 */

class Tickets extends Generic{
	
	function __construct() {
	parent::__construct();
    $this->load->model('Mdl_tickets');
	}
  
  /**
   *  All Tickets listing page
  */
  
  function all_tickets(){
	$data['categories'] = $this->Mdl_tickets->getByValue("ticket_statuses", "status", '1');
	$data['vendor_statuses'] = $this->Mdl_tickets->getByValue("ticket_statuses", "other_status", '1');
    //$data["categories"] = $this->Mdl_tickets->retrieveByorder("ticket_statuses",array("status"=>"1"),"","");
    $template = 'admin';
    $data['scriptFile'] = 'all-visitors';
    $data['viewFile'] = 'all-tickets';
    $data['module'] = "tickets";
    echo Modules::run('template/'.$template, $data);
  }
  
  
  /**
   *  Get All Tickets
  */
  public function getAllVisitorsRecords(){
    $records = $this->Mdl_tickets->get_datatables("tickets"); 
//	  echo '<pre>'; print_r($records); exit;
    $data = array();
    $no = $_POST['start']; 
    $admin_session = $this->session->userdata('admin');

    $admin_id = $admin_session['admin_id'];
    $admin_access = $admin_session['admin_access'];
//	echo $this->db->last_query();exit;
    foreach($records as $val){
		
		$row = array();
		$getDept = $this->Mdl_tickets->retrieve("ticket_departments", array("id"=>$val->department_id));
		$dept = $getDept[0]->name;

		$visitor = '<div class="d-flex">
		<div class="text-left">
          <p class="mb-0">'.$val->exhibitor_name.'</p>
          <p class="">'.$val->exhibitor_code.'</p>
		</div>
		</div>';
	  
	  $url = base_url().'tickets/view/'.$val->id;	  
      $row[] = $val->unique_code;
      $row[] = $visitor;
      $row[] = $val->subject; 
    	//  $row[] = $dept;
      $row[] = $val->hall_no;
      $row[] = $val->division_no;
      if($val->status_id == '1'){
        $row[] = '<span class="badge badge-success">Open</span>';
      }elseif($val->status_id == '2'){
        $row[] = '<span class="badge badge-warning">Pending</span>';
      }elseif($val->status_id == '3'){
        $row[] = '<span class="badge badge-info">Resolved</span>';
      } else {
        $row[] = '<span class="badge badge-danger">Closed</span>';
      }

	  if($val->vendor_status_id == '1'){
        $row[] = '<span class="badge badge-success">Open</span>';
      }elseif($val->vendor_status_id == '2'){
        $row[] = '<span class="badge badge-warning">Pending</span>';
      }elseif($val->vendor_status_id == '3'){
        $row[] = '<span class="badge badge-info">Resolved</span>';
      } elseif(!isset($val->vendor_status_id)){
		$row[] = '<span class="badge badge-success">Open</span>';
	  }else {
        $row[] = '<span class="badge badge-danger">Closed</span>';
      }
	  
		$vendors = $val->vendor_id;
		/*$vendor_array = explode(',',$vendors);
		$row[] = $vendor_array; */
		if(!empty($vendors)){
			$row[] = '<span class="badge badge-success">Assigned</span>';
		} else {
			$row[] = '<span class="badge badge-danger">Unassigned</span>';
		}

	  /*if($val->priority_id == '1'){
        $row[] = '<span class="badge badge-success">Low</span>';
      }elseif($val->priority_id == '2'){
        $row[] = '<span class="badge badge-warning">Medium</span>';
      }elseif($val->priority_id == '3'){
        $row[] = '<span class="badge badge-danger">High</span>';
      }elseif($val->priority_id == '4'){
        $row[] = '<span class="badge badge-danger">Urgent</span>';
	  } else {
        $row[] = '<span class="badge badge-info">Unassigned</span>';
      }	 */
	  
	  $row[] = date("d-m-Y",strtotime($val->created_at));
      $row[] = '<a class="btn btn-circle btn-info action_edit" href="'.$url.'" title="view Ticket"><i class="fa fa-eye"></i></a>';             
      
      $data[] = $row;
    }
    $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->Mdl_tickets->count_all("tickets"),
      "recordsFiltered" => $this->Mdl_tickets->count_filtered("tickets"),
      "data" => $data,
    );
    //echo $this->db->last_query(); exit;
    
    echo json_encode($output);
  }
 

  /*
  ** View
  */
  function view($id){

	if(! Modules::run('security/isAdmin')){
		redirect('admin','refresh');
	}
    $result = $this->Mdl_tickets->getByValue("tickets","id",$id);
	
    if($result == "No Data"){
      redirect('errors','refresh');
    } else {
	    $admin_session = $this->session->userdata('admin');
		$name = $admin_session['contact_name'];
		$comment = $this->show_tree($id); 
		$role = $admin_session['role']; 
		$admin_id = $admin_session['admin_id'];

		if($comment == 'no'){
			$data['comments'] = '';
		}else{
			$data['comments'] = $comment;
		}

			if($result[0]->ticket_view=='0')
			{
			$datas = array(
				'ticket_view' => '1',
				'ticket_view_date' => date('Y-m-d H:i:s'),
				'ticket_view_admin'=> $name
			);
			$update = $this->Mdl_tickets->update2("tickets","id",$id,$datas);
			}
			
			$getTicketData = $this->Mdl_tickets->retrieve("tickets", array('id'=>$id));
			if($getTicketData == 'NA'){
				echo json_encode(array("status"=>"error",'message'=>'data not found')); exit;
			}
					
			$exhibitor_name = $getTicketData[0]->exhibitor_name;
			$uniqueIdentifier = $getTicketData[0]->unique_code;
			$vendor_status_id = $getTicketData[0]->vendor_status_id;
			$issue_name = $getTicketData[0]->issue_name;

			if(!isset($vendor_status_id)){
			$vendor_status_id = '1';
			}

			$ticket_logs_data = array(
				'post_date' => date('Y-m-d H:i:s'),
				'ticket_id' => $id,
				'unique_code' => strip_tags($uniqueIdentifier),
				'exhibitor_name' => $exhibitor_name,
				'user_id' => strip_tags($admin_id),
				'admin_name' => $name,
				'ticket_view_admin' => $name,
				'vendor_status_id'=>$vendor_status_id,
				'issue_name' => $issue_name,
				'action' => 'Ticket View'
			);
			$ticket_logs = $this->tickteLogs($ticket_logs_data);

		$data['dept'] = $this->Mdl_tickets->getByValue("ticket_departments", "status", 'Y');
		if($role == "Super Admin" || $role == "Admin")
		{
		$data['statuses'] = $this->Mdl_tickets->getByValue("ticket_statuses", "status", '1');
		} else { 
		$data['statuses'] = $this->Mdl_tickets->getByValue("ticket_statuses", "other_status", '1');
		}
		$data['adminUser'] = $this->Mdl_tickets->getByValue("admin_master", "role", 'Admin');
		$data['vendorUser'] = $this->Mdl_tickets->getByValue("admin_master", "role", 'Vendor');
		$data['priorities'] = $this->Mdl_tickets->getByValue("priorities", "status", '1');
		$data['onlineStatus'] = $this->Mdl_tickets->retrieve("admin_master",array("id" => $admin_session['admin_id']));
		$data['issue'] = $this->Mdl_tickets->getByValue("ticket_issue_master", "is_active", '1');
		//  echo $this->db->last_query(); exit;
		//  print_r($data['statuses']); exit;
		$data['onspot_visitor'] = $result;
		$data['breadcrumb'] = "View Ticket";
		$data['viewFile'] = "view";
		$data['scriptFile'] = "all-visitors";
		$data['module'] = "tickets";
		$template = 'admin';	  
		echo Modules::run('template/'.$template, $data);
    }
  }
	
	/***************************************** Add Comments ***************************************/
	function addComment(){
		if(! Modules::run('security/isAdmin')){
			redirect('admin','refresh');
		}
		$content = $this->input->post();
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules("comment","Comment","required|xss_clean",array(
					'required' => 'Comment field should not be empty' ));

		if($this->form_validation->run() == FALSE){
			  $errors = $this->form_validation->error_array();
        echo json_encode($errors); exit;
		} else{
			$data = array(
				'ticket_id' => $content['ticket_id'],
				'comments' => $content['comment'],
				'role' => $content['utype'],
				'user_id'=> $content['user_id'],
				'parentId'=> $content['pid'],
				'created_at' =>date('Y-m-d H:i:s')
			);
			$insert = $this->Mdl_tickets->insert("ticket_replies", $data);			
			//echo json_encode(array("status"=>"success")); exit;
		}
	}

	
	/***************************************** Get Comment Id ***************************************/
	function show_tree($bid){
        // create array to store all comments ids
        $store_all_id = array();
        // get all parent comments ids by using news id
        $id_result = $this->Mdl_tickets->tree_all($bid);
        // loop through all comments to save parent ids $store_all_id array
		
		if($id_result !== 'no'){
			foreach ($id_result as $comment_id) {
				//echo '<pre>'; print_r($comment_id); exit;
				//array_push($store_all_id, $comment_id['parentId']);
				array_push($store_all_id, $comment_id['parentId']);
			}
			// return all hierarchical tree data from in_parent by sending
			//  initiate parameters 0 is the main parent,news id, all parent ids
			return  $this->in_parent(0,$bid, $store_all_id);
		} else {
			return "no";
		}
    }

    /***************************************** Get Comment Hierarchy ***************************************/
    function in_parent($in_parent,$bid,$store_all_id) {
        $html = "";
        if (in_array($in_parent,$store_all_id)) {
            $result = $this->Mdl_tickets->tree_by_parent($bid,$in_parent);
			
            foreach ($result as $re){ //echo '<pre>'; print_r($re); 
				$type = $re['role'];
				$uid = $re['user_id'];
				$commentId = $re['id'];
				$comment = $re['comments'];
				$date = $re['created_at'];
				$url = '';
				$getAdminName = $this->Mdl_tickets->retrieve("admin_master", array("id"=>$re['user_id']));
				$contact_name = $getAdminName[0]->contact_name;
				$onlineStatus = $getAdminName[0]->online;						
				if($onlineStatus == '1') {
					$activeUser = 'ppWrp'; //online
				} else { 
					$activeUser = ''; //offline
				}
				if($type == 'Super Admin' || $type == 'Admin' || $type == 'Vendor'){
				$name = strtoupper($contact_name);
				} else { 
				$uid = $re['user_id'];
				$getAdminName = $this->Mdl_tickets->retrieve("iijs_exhibitor", array("Exhibitor_Registration_ID"=>$re['user_id']));
				//echo $this->db->last_query(); exit;
				$name = $getAdminName[0]->Exhibitor_Name;
				}
								
				if($type == 'Super Admin'){
					$url = 'https://gjepc.org/assets/images/logo.png';
				}else if($type == 'Admin'){
					$url = base_url().'/assets/admin/images/users/hall-manager.png'; 
				}else if($type == 'Vendor'){
					$url = base_url().'/assets/admin/images/users/vendor.png';
				}else if($type == 'exhibitor'){
					$url = base_url().'/assets/admin/images/users/vendor.png';
				}
				
				if($type == 'Super Admin'){
					$html .= '<div class="comment_box">
					<div class="author_dp"><div><span class="'.$activeUser.'"></span><img src="'.$url.'"></div></div>
					<div class="comment">
					<div class="comment_container">
					<div class="comment_holder doc_comment">
					<strong class="txtblue">'.$name.' -</strong> '.$comment.'
					</div>
					<div class="comment_detail"><span style="margin-right:15px;">'.date("d-M, Y ",strtotime($date)).'</span> <a href="javascript:;" class="reply" id="'.$commentId.'" >Reply</a>
					<a href="javascript:;" class="report" id="'.$commentId.'"></a>
					</div></div>';
					$html .= $this->in_parent($commentId, $bid, $store_all_id);
					$html .= '</div></div>';
				}else if($type == 'Admin' || $type == 'Vendor' || $type == 'exhibitor'){
					
					$html .= '<div class="comment_box">
					<div class="author_dp"><div><span class="'.$activeUser.'"></span><img src="'.$url.'"></div></div>
					<div class="comment">
					<div class="comment_container">
					<div class="comment_holder doc_comment">
					<strong class="txtblue">'.$name.' -</strong> '.$comment.'
					</div>
					<div class="comment_detail"><span style="margin-right:15px;">'.date("d-M, Y ",strtotime($date)).'</span> <a href="javascript:;" class="reply" id="'.$commentId.'" >Reply</a>
					<a href="javascript:;" class="report" id="'.$commentId.'"></a>
					</div></div>';
					$html .= $this->in_parent($commentId, $bid, $store_all_id);
					$html .= '</div></div>';
				}
			}
        }
        return $html;
    }
	
	/*
	** VIEW Update Ticket ACTION
	*/
	function updateTicketAction(){
		if(! Modules::run('security/isAdmin')){
			redirect('admin','refresh');
		}
		$content = $this->input->post();
		$admin_session = $this->session->userdata('admin');
		$name = $admin_session['contact_name'];
		$role = $admin_session['role'];
		$admin_id = $admin_session['admin_id'];
		//print_r($admin_session); exit;
		$this->form_validation->set_rules("statuses","Status","trim|xss_clean|required",
		array(
			'required' => "Status is required"
		));
	  
		if($this->form_validation->run() == FALSE){
			$errors = $this->form_validation->error_array();
			echo json_encode($errors); exit;
		} else {
			$getIssueData = $this->Mdl_tickets->retrieve("ticket_issue_master", array("id"=>$content['issue_id']));
			if($getIssueData == 'NA'){
				echo json_encode(array("status"=>"error",'message'=>'data not found')); exit;
			}
			$issue_name = $getIssueData[0]->issue_name;
			if($role == "Super Admin" || $role == "Admin")
			{
				$data = array(
					'priority_id' => strip_tags($content['priority_id']),    
					'status_id' => strip_tags($content['statuses']),    
					'vendor_id' => strip_tags($content['rights']),
					'issue_id' => strip_tags($content['issue_id']),
					'issue_name' => strip_tags($issue_name),
					'vendor_assign_date' => date('Y-m-d H:i:s'),
					'closed_at' => date('Y-m-d H:i:s'),
					'closed_by'=> $name
				);
			} else {
				$data = array( 
					'vendor_status_id' => strip_tags($content['statuses']), 
					'issue_id' => strip_tags($content['issue_id']), 
					'issue_name' => strip_tags($issue_name),  
					'closed_by_vendor_date' => date('Y-m-d H:i:s'),
					'closed_by_vendor'=> $admin_id
				);
			}
			$getTicket = $this->Mdl_tickets->retrieve("tickets", array('id'=>$content['id']));
			if($getTicket == 'NA'){
				echo json_encode(array("status"=>"error",'message'=>'data not found')); exit;
			}
			
			$exhibitor_name = $getTicket[0]->exhibitor_name;
			$uniqueIdentifier = $getTicket[0]->unique_code;
			$vendor_status_id = $getTicket[0]->vendor_status_id;
			if($content['statuses'] == '4'){
				$vendor_id_array = explode(',',$content['rights']);
					$vendor_id_arr = array();
					foreach($vendor_id_array as $vendor_id){
						$getVendorName = $this->Mdl_tickets->retrieve("admin_master", array("id"=>$vendor_id));
						if($getVendorName == 'NA'){
							echo json_encode(array("status"=>"error",'message'=>'data not found')); exit;
						}
						$vendor_email = $getVendorName[0]->email_id;
						//array_push($vendor_id_arr, $vendor_email);
						array_push($vendor_id_arr, 'rohit@kwebmaker.com');
					}
					$getTicketData = $this->Mdl_tickets->retrieve("tickets", array('id'=>$content['id']));
					if($getTicketData == 'NA'){
						echo json_encode(array("status"=>"error",'message'=>'data not found')); exit;
					}
					
					$exhibitor_code = $getTicketData[0]->exhibitor_code;
					$uniqueIdentifier = $getTicketData[0]->unique_code;
					$vendor_status_id = $getTicketData[0]->vendor_status_id;
					if(!isset($vendor_status_id)){
						$vendor_status_id = '1';
					}
					if(!empty($exhibitor_code)){						
						$exhibitor_name = $getTicketData[0]->exhibitor_name;
						$getExhibitorData = $this->Mdl_tickets->retrieve("iijs_exhibitor", array('Exhibitor_Code'=>$exhibitor_code));
						if($getExhibitorData == 'NA'){
							echo json_encode(array("status"=>"error",'message'=>'data not found')); exit;
						}
						$exhibitor_email = $getExhibitorData[0]->Exhibitor_Email;
						$mailData = array(
							"view_file" => "vendor-close-ticket",
							"to" => 'neelmani@kwebmaker.com',//$exhibitor_email,
							"cc" => $vendor_id_arr,//$vendor_email,
							"bcc" => "",
							//'name' => $exhibitor_name,
							'unique_code' => $getTicketData[0]->unique_code,
							"subject" => 'Ticket Closed',
						);
					}  else {	
						$getVendorAdmin = $this->Mdl_tickets->retrieve("admin_master", array("id"=>$getTicketData[0]->admin_id));
						if($getVendorAdmin == 'NA'){
							echo json_encode(array("status"=>"error",'message'=>'data not found')); exit;
						}
						$admin_email = $getVendorAdmin[0]->email_id;
						$mailData = array(
							"view_file" => "vendor-close-ticket",
							"to" => 'neelmani@kwebmaker.com',//$admin_email,
							"cc" => $vendor_id_arr,//$vendor_email,
							"bcc" => "",
							//'vendor_name' => $getVendorName[0]->contact_name,
							'unique_code' => $getTicketData[0]->unique_code,
							'name' => $getTicketData[0]->exhibitor_name,
							"subject" => 'Ticket Closed',
						);
					}
					//$sent = Modules::run('email/mailer', $mailData);
					$sent = Modules::run('email/send_mailArray', $mailData);
					/*if(!$sent){
						echo json_encode(array("status"=>"error","message"=>"Mail Not Sent")); exit;
					} */

			}
			$update = $this->Mdl_tickets->update2("tickets","id",$content['id'],$data);

			$ticket_logs_data = array(
				'post_date' => date('Y-m-d H:i:s'),
				'ticket_id' => $content['id'],
				'unique_code' => strip_tags($uniqueIdentifier),
				'exhibitor_name' => $exhibitor_name,
				'user_id' => strip_tags($admin_id),
				'status_id' => strip_tags($content['statuses']),
				'vendor_id'=> strip_tags($content['rights']),
				'issue_name' => strip_tags($issue_name), 
				'admin_name' => $name,
				'vendor_status_id'=>$vendor_status_id,
				'action' => 'Ticket Update'
			);
			$ticket_logs = $this->tickteLogs($ticket_logs_data);

			echo json_encode(array("status"=>"success","message"=>"ticket successfully updated","redirect"=>"admin/dashboard")); exit;
		}
	}
	
	
	
	/*
  ** Add ACTION
  */
	function add(){
		$admin = $this->session->userdata('admin');
		$role = $admin['role'];
		$admin_access = $admin['admin_access'];
		$hall = $admin['hall'];
		if($role == "Super Admin" || $role == "Admin"){
		//	$data['dept'] = $this->Mdl_tickets->getByValue("ticket_departments", "status", 'Y');
		if($role == "Super Admin"){
		$data['exhibitors'] = $this->Mdl_tickets->getByValue("iijs_exhibitor", "year", '2023');
		}else if($role == "Admin" && $admin_access == "Hall Wise" || $admin_access == "Division Wise"){ 
		$data['exhibitors'] = $this->Mdl_tickets->getByValue("iijs_exhibitor", "Exhibitor_HallNo", $hall);
		}
		
		$data['statuses'] = $this->Mdl_tickets->getByValue("ticket_statuses", "status", '1');
		$data['adminUser'] = $this->Mdl_tickets->getByValue("admin_master", "role", 'Admin');
		$data['vendorUser'] = $this->Mdl_tickets->getByValue("admin_master", "role", 'Vendor');
		$data['priorities'] = $this->Mdl_tickets->getByValue("priorities", "status", '1');
		$data['issue'] = $this->Mdl_tickets->getByValue("ticket_issue_master", "is_active", '1');
		$data['scriptFile'] = 'all-visitors';
		$data['viewFile'] = 'add';
		$data['module'] = "tickets";
		$data['breadcrumb'] = "Create Ticket";
		$template = 'admin';		
		echo Modules::run('template/'.$template, $data);
		} else { 
		redirect('/tickets/all_tickets');
		}
	}
	
	/*
  ** ADD ONSPOT ACTION
  */
  function addOnspotAction(){
	//  echo '<pre>'; print_r($_POST);
    $content = $this->input->post();
    $vendor_id = $content['vendor_id'];
   	// $department_id = $content['department_id'];
    $priority_id = $content['priority_id'];
    $status_id = $content['statuses'];
    $subject = $content['subject'];
    $description = $content['description'];
	
	$this->form_validation->set_rules("exhibitor_code","exhibitor_code","trim|required|xss_clean",
    array(
      'required' => 'Please select Exhibitor'
    ));

    $this->form_validation->set_rules("vendor_id","vendor_id","trim|required|xss_clean",
    array(
      'required' => 'Please select Vendor'
    ));

    /*$this->form_validation->set_rules("department_id","department_id","trim|required|xss_clean",
    array(
      'required' => 'Please select Department'
    )); */
    
    $this->form_validation->set_rules("issue_id","issue_id","trim|required|xss_clean",
    array(
      'required' => 'Please select Issue'
    ));
    $this->form_validation->set_rules("priority_id","Priority","trim|required|xss_clean",
    array(
      'required' => 'Please select Priority'
    ));

    $this->form_validation->set_rules("statuses","Status","trim|required|xss_clean",
    array(
      'required' => 'Please select Status'
    ));
	
	$this->form_validation->set_rules("subject","Subject","trim|required|xss_clean",
    array(
      'required' => 'Please select Subject'
    ));
	
	$this->form_validation->set_rules("description","Description","trim|required|xss_clean",
    array(
      'required' => 'Please select Description'
    ));

    if ($this->form_validation->run($this) == FALSE) {
      $errors = $this->form_validation->error_array();
      echo json_encode($errors);
      exit;
    } else {
			$digits = 9;	
			$uniqueIdentifier = rand(pow(10, $digits-1), pow(10, $digits)-1);
			$checkUniqueIdentifier =$this->Mdl_tickets->isExist("tickets", array("unique_code"=>$uniqueIdentifier));
			while($checkUniqueIdentifier){
			$uniqueIdentifier = rand(pow(10, $digits-1), pow(10, $digits)-1);
			}

			if($this->session->userdata('admin')){
				$admin = $this->session->userdata('admin');
				$adminId = $admin['admin_id'];
				$name = $admin['contact_name'];
			}
			$exhibitor_code = $content['exhibitor_code'];
			$exhibitors = $this->Mdl_tickets->retrieve("iijs_exhibitor", array('Exhibitor_Code'=>$exhibitor_code));
			if($exhibitors == "NA"){
				echo json_encode(array("status"=>"error")); exit;
			}
			$exhibitor_name = $exhibitors[0]->Exhibitor_Name;
			$exhibitor_hall_no = $exhibitors[0]->Exhibitor_HallNo;
			$division_no = $exhibitors[0]->Exhibitor_DivisionNo;

			$issue_id = $content['issue_id'];
			$issues = $this->Mdl_tickets->retrieve("ticket_issue_master", array('id'=>$issue_id));
			if($issues == "NA"){
				echo json_encode(array("status"=>"error")); exit;
			}
			$issue_id = $issues[0]->id;
			$issue_name = $issues[0]->issue_name;
			$data = array(
				'unique_code' => strip_tags($uniqueIdentifier),
				'admin_id' => strip_tags($adminId),
				'user_id' => $adminId,
				'exhibitor_code' => $exhibitor_code,
				'exhibitor_name' => $exhibitor_name,
				'hall_no' => $exhibitor_hall_no,
				'division_no' => $division_no,
				'issue_name' => $issue_name,
				'issue_id' => $issue_id,
				'subject'=> strip_tags($subject),
				'description'=> strip_tags($description),
				'status_id'=> strip_tags($status_id),
				'priority_id'=> strip_tags($priority_id),
				//'department_id'=> strip_tags($department_id),
				'vendor_id'=> strip_tags($vendor_id),
				'vendor_status_id'=>'1',
				'created_at' => date('Y-m-d H:i:s')
			);
		
			$insert = $this->Mdl_tickets->insert("tickets", $data);

			$ticket_logs_data = array(
				'post_date' => date('Y-m-d H:i:s'),
				'ticket_id' => $insert,
				'unique_code' => strip_tags($uniqueIdentifier),
				'exhibitor_name' => $exhibitor_name,
				'user_id' => strip_tags($adminId),
				'status_id' => strip_tags($status_id),
				'priority_id' => strip_tags($priority_id),
				'vendor_id'=> strip_tags($vendor_id),
				'issue_name' => $issue_name,
				'admin_name' => $name,
				'vendor_status_id'=>'1',
				'action' => 'Ticket Create'
			);
			$ticket_logs = $this->tickteLogs($ticket_logs_data);
			echo json_encode(array("status"=>"success")); exit;
		}
	}	
   
   
   /**
   *  All OverDue Tickets listing page
  */
  
  function overdue_tickets(){
	$data['categories'] = $this->Mdl_tickets->getByValue("ticket_statuses", "status", '1');
	$data['vendor_statuses'] = $this->Mdl_tickets->getByValue("ticket_statuses", "other_status", '1');
    //$data["categories"] = $this->Mdl_tickets->retrieveByorder("ticket_statuses",array("status"=>"1"),"","");
    $template = 'admin';
    $data['scriptFile'] = 'all-overdue';
    $data['viewFile'] = 'overduetickets';
    $data['module'] = "tickets";
    echo Modules::run('template/'.$template, $data);
  }
  
  
  /**
   *  Get All Tickets
  */
  public function getAllOverdueRecords(){
    $records = $this->Mdl_tickets->get_datatables("overduetickets"); 
//	echo $this->db->last_query(); exit;
//	  echo '<pre>'; print_r($records); exit;
    $data = array();
    $no = $_POST['start']; 
    $admin_session = $this->session->userdata('admin');

    $admin_id = $admin_session['admin_id'];
    $admin_access = $admin_session['admin_access'];
//	echo $this->db->last_query();exit;
    foreach($records as $val){
		
		$row = array();

		$visitor = '<div class="d-flex">
		<div class="text-left">
          <p class="mb-0">'.$val->exhibitor_name.'</p>
          <p class="">'.$val->exhibitor_code.'</p>
		</div>
		</div>';
	  
	  $url = base_url().'tickets/view/'.$val->id;	  
      $row[] = $val->unique_code;
      $row[] = $visitor;
      $row[] = $val->subject; 
    	//  $row[] = $dept;
      $row[] = $val->hall_no;
      $row[] = $val->division_no;
      if($val->status_id == '1'){
        $row[] = '<span class="badge badge-success">Open</span>';
      }elseif($val->status_id == '2'){
        $row[] = '<span class="badge badge-warning">Pending</span>';
      }elseif($val->status_id == '3'){
        $row[] = '<span class="badge badge-info">Resolved</span>';
      } else {
        $row[] = '<span class="badge badge-danger">Closed</span>';
      }

	  if($val->vendor_status_id == '1'){
        $row[] = '<span class="badge badge-success">Open</span>';
      }elseif($val->vendor_status_id == '2'){
        $row[] = '<span class="badge badge-warning">Pending</span>';
      }elseif($val->vendor_status_id == '3'){
        $row[] = '<span class="badge badge-info">Resolved</span>';
      } elseif(!isset($val->vendor_status_id)){
		$row[] = '<span class="badge badge-success">Open</span>';
	  }else {
        $row[] = '<span class="badge badge-danger">Closed</span>';
      }
	  
		$vendors = $val->vendor_id;
		/*$vendor_array = explode(',',$vendors);
		$row[] = $vendor_array; */
		if(!empty($vendors)){
			$row[] = '<span class="badge badge-success">Assigned</span>';
		} else {
			$row[] = '<span class="badge badge-danger">Unassigned</span>';
		}

	  /*if($val->priority_id == '1'){
        $row[] = '<span class="badge badge-success">Low</span>';
      }elseif($val->priority_id == '2'){
        $row[] = '<span class="badge badge-warning">Medium</span>';
      }elseif($val->priority_id == '3'){
        $row[] = '<span class="badge badge-danger">High</span>';
      }elseif($val->priority_id == '4'){
        $row[] = '<span class="badge badge-danger">Urgent</span>';
	  } else {
        $row[] = '<span class="badge badge-info">Unassigned</span>';
      }	 */
	  
	  $row[] = date("d-m-Y",strtotime($val->created_at));
      $row[] = '<a class="btn btn-circle btn-info action_edit" href="'.$url.'" title="view Ticket"><i class="fa fa-eye"></i></a>';             
      
      $data[] = $row;
    }
    $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->Mdl_tickets->count_all("overduetickets"),
      "recordsFiltered" => $this->Mdl_tickets->count_filtered("overduetickets"),
      "data" => $data,
    );
   // echo $this->db->last_query(); exit;
    
    echo json_encode($output);
  }
	
  
}
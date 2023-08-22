<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Services extends MX_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('mdl_services');
	}
	
	function index()
	{
		echo "Services";
	}

	function newsList()
		{ 
			$json = file_get_contents('php://input');
			$obj = json_decode($json,True);
			$strResponse=$this->mdl_services->newsList();
			
			if($strResponse['status']==true)
			{
				$finalResponse=$strResponse;
			}
              else 
				{
					$finalResponse=array(
							"Result"=>'',
							"Message"=>"Invalid post.Post must contains regId.",
							"status"=>"false"
					);
				}
			header('Content-type: application/json');
			echo json_encode(array("Response"=>$finalResponse));
		}
	function newsSearch()
		{ 
			$json = file_get_contents('php://input');
			$obj = json_decode($json,True);
			if(!empty($obj))
			{
				$name = $obj["name"];
				$orderBy = $obj["orderBy"];
				$year= $obj["year"];
				$from= $obj["from"];
				$to= $obj["to"];
			}
			
			$strResponse=$this->mdl_services->newsSearch($name,$orderBy,$year,$from,$to);
			
			if($strResponse['status']==true)
			{
				$finalResponse=$strResponse;
			}
              else 
				{
					$strResponse=array(
							"Result"=>'',
							"Message"=>"Invalid post.Post must contains regId.",
							"status"=>"false"
					);
				}
			header('Content-type: application/json');
			echo json_encode(array("Response"=>$finalResponse));
		}	
		
		
	function exhibitorList()
	{
		$json = file_get_contents('php://input');
		$obj = json_decode($json,True);
		$strResponse=$this->mdl_services->exhibitorList();
		if($strResponse['status']==true)
			{
				$finalResponse=$strResponse;
			}
			else
			{
				$finalResponse=array(
				"Result"=>'',
				"Message"=>"Invalid post.Post must contains regId and catName.",
				"status"=>"false"
				);
			}	
		header('Content-type: application/json');
		echo json_encode(array("Response"=>$strResponse));
	}
	
	
	function exhibitorSearch()
		{ 
			$json = file_get_contents('php://input');
			$obj = json_decode($json,True);
			if(!empty($obj))
			{
				$name = $obj["name"];				
			}
			
			$strResponse=$this->mdl_services->exhibitorSearch($name);
			
			if($strResponse['status']==true)
			{
				$finalResponse=$strResponse;
			}
              else 
				{
					$strResponse=array(
							"Result"=>'',
							"Message"=>"Invalid post.Post must contains regId.",
							"status"=>"false"
					);
				}
			header('Content-type: application/json');
			echo json_encode(array("Response"=>$finalResponse));
		}	
	
	
	function updateCategory()
	{
      	$json = file_get_contents('php://input');
		$obj = json_decode($json,true);
		if(!empty($obj))
                        {
                          $catId = $obj["catId"]; 
						  $catName= $obj["catName"];
						  $regId = $obj["regId"];
			if(!empty($obj)&& (isset($catId))&& (isset($catName))&& (isset($regId)))
			{
				$strResponse=$this->mdl_services->categoryUpdate($catId,$catName,$regId);
			}
			else
			{
				$strResponse=array(
				"Result"=>'',
				"Message"=>"Invalid post.Post must contains regId and catName.",
				"status"=>"false"
				);
				
			}
                            
          }
		   else 
                        {
                            $strResponse=array(
				"Result"=>'',
				"Message"=>"Invalid post.Post must contains regId , parentId and catName.",
				"status"=>"false"
				);
                        }
				header('Content-type: application/json');
				 echo json_encode(array("Response"=>$strResponse));
	
	}
	
	function deleteCat()
	{
	  $json = file_get_contents('php://input');
	  $obj = json_decode($json,true);
	  if(!empty($obj))
                        {
                          $catId = $obj["catId"]; 
			if(!empty($obj)&& (isset($catId)))
			{
				$strResponse=$this->mdl_services->categoryDelete($catId);
			}
			else
			{
				$strResponse=array(
				"Result"=>'',
				"Message"=>"Invalid post.Post must contains regId and catName.",
				"status"=>"false"
				);
				
			}
                            
          }
		   else 
                        {
                            $strResponse=array(
				"Result"=>'',
				"Message"=>"Invalid post.Post must contains regId , parentId and catName.",
				"status"=>"false"
				);
                        }
				header('Content-type: application/json');
				 echo json_encode(array("Response"=>$strResponse));
	}

		

		function login()
		{
			$json = file_get_contents('php://input');
			$obj = json_decode($json,True);
			if(!empty($obj))
                        {
                            $username=$obj["username"];
                            $password=$obj["password"];
							$deviceId = $obj["deviceId"];
							$deviceType = $obj["deviceType"];
							
			if(!empty($obj)&& (isset($username) && isset($password) && isset($deviceId) && isset($deviceType)))
			{
				$strResponse=$this->mdl_services->submitlogin($username,$password,$deviceId,$deviceType);
			}
			else
			{
				$strResponse=array(
				"Result"=>'',
				"Message"=>"Invalid post.Post must contains username and password.",
				"status"=>"false"
				);
				
			}
                            
                        }
                        else 
                        {
                            $strResponse=array(
				"Result"=>'',
				"Message"=>"Invalid post.Post must contains username and password.",
				"status"=>"false"
				);
                        }
				header('Content-type: application/json');
				 echo json_encode(array("Response"=>$strResponse));


		}

		function signup()
		{
			$json = file_get_contents('php://input');
			$obj = json_decode($json,True);
			if(!empty($obj))
                        {
                            $email=$obj["email"];
							$username=$obj["username"];
                            $password=$obj["password"];
                            $deviceType=$obj["deviceType"];
                            $deviceId=$obj["deviceId"];

							
			if(!empty($obj)&& (isset($email) && isset($password) && isset($deviceId) && isset($deviceType) ))
			{

    			if(isset($obj["refcode"]))
					$refcode = $obj["refcode"];
				else 
					$refcode = "";


				$strResponse=$this->mdl_services->submitsignup($email,$username,$password,$deviceId,$deviceType,$refcode);
			}
			else
			{
				$strResponse=array(
				"Result"=>'',
				"Message"=>"Invalid post.Post must contains email, deviceType, deviceId and password.",
				"status"=>"false"
				);
				
			}
                            
              }
                        else 
                        {
                            $strResponse=array(
				"Result"=>'',
				"Message"=>" Invalid post.Post must contains email, deviceType, deviceId and password.",
				"status"=>"false"
				);
                        }
				header('Content-type: application/json');
				 echo json_encode(array("Response"=>$strResponse));


		}

		function fblogin()
		{
                        

				$json = file_get_contents('php://input');


			$obj = json_decode($json,True);
                 
			if(!empty($obj))
                        {
                            $email=$obj["email"];
                            $fbId=$obj["fbId"];
                            $deviceType=$obj["deviceType"];
                            $deviceId=$obj["deviceId"];
                             $username=$obj["username"];

							
			if(!empty($obj)&& (isset($email) && isset($fbId) && isset($deviceId) && isset($deviceType) && isset($username) ))
			{
				$strResponse=$this->mdl_services->submitfblogin($email,$deviceType,$deviceId,$fbId,$username);
			}
			else
			{
				$strResponse=array(
				"Result"=>'',
				"Message"=>"Invalid post.Post must contains email, deviceType, deviceId and fbId.",
				"status"=>"false"
				);
				
			}
                            
                        }
                        else 
                        {
                            $strResponse=array(
				"Result"=>'',
				"Message"=>"Invalid post.Post must contains email, deviceType, deviceId and fbId.",
				"status"=>"false"
				);
                        }
				header('Content-type: application/json');
				 echo json_encode(array("Response"=>$strResponse));


		}

		function gplogin()
		{

				$json = file_get_contents('php://input');
			$obj = json_decode($json,True);
               
			if(!empty($obj))
                        {
                            $email=$obj["email"];
                            $gId=$obj["gId"];
                            $deviceType=$obj["deviceType"];
                            $deviceId=$obj["deviceId"];
                            $gmailuserpic=$obj["gmailuserpic"];
                            $username = $obj["username"];

							
			     if(!empty($obj)&& (isset($email) && isset($gId) && isset($deviceId) && isset($deviceType) && isset($username) ))
			       {
				   $strResponse=$this->mdl_services->submitgplogin($email,$gId,$deviceType,$deviceId,$gmailuserpic,$username);
			       }
			    else
			      {
				 $strResponse=array(
				 "Result"=>'',
				 "Message"=>"Invalid post.Post must contains email, deviceType, deviceId and gId.",
				 "status"=>"false"
				 );
			      }
                        }
                        else 
                        {
                            $strResponse=array(
				"Result"=>'',
				"Message"=>"Invalid post.Post must contains email, deviceType, deviceId and gId.",
				"status"=>"false"
				);
                        }
				header('Content-type: application/json');
				 echo json_encode(array("Response"=>$strResponse));
		}

		function postfeed()
		{
			$json = file_get_contents('php://input');
			$obj = json_decode($json,True);
			
			if(!empty($obj["categoryId"]))
			{
			   $categoryId=$obj["categoryId"];
			}
			
			if(!empty($obj["regId"]))
			{
			   $regId=$obj["regId"];
			}
			
			if(!empty($obj["description"]))
			{
			   $description = $obj["description"];
			}
			else{  $description=""; }
			
			if(!empty($obj["people"]))
			{
			   $people=$obj["people"];
			}
			else{  $people=""; }
			
			if(!empty($obj["location"]))
			{
			   $location=$obj["location"];
			}
			else{  $location=""; }
			
			if(!empty($obj["latitude"]))
			{
			   $latitude=$obj["latitude"];
			}
			else{  $latitude=""; }
			
			if(!empty($obj["longitude"]))
			{
			   $longitude=$obj["longitude"];
			}
			else{  $longitude=""; }
			
			if(!empty($obj["alert"]))
			{
			   $alert=$obj["alert"];
			}
			else{  $alert=""; }
			
			if(!empty($obj["note"]))
			{
			   $note=$obj["note"];
			}
			else{  $note=""; }
			
			if(!empty($obj["amount"]))
			{
			   $amount=$obj["amount"];
			}
			else{  $amount=""; }
			
			if(!empty($obj["eventDate"]))
			{
			   $eventDate=$obj["eventDate"];
			}
			else{  $eventDate=""; }
			
			if(!empty($obj["starred"]))
			{
			   $starred=$obj["starred"];
			}
			else{  $starred=""; }
			
			if(!empty($obj["isAlert"]))
			{
			   $isAlert = $obj["isAlert"];
			}
			else{  $isAlert=""; }
				
			if(isset($categoryId)&& isset($regId))
			 { 
	        $strResponse=$this->mdl_services->submitfeed($categoryId,$description,$people,$location,$latitude,$longitude,$alert,$note,$regId,$amount,$eventDate,$starred,$isAlert);
			}
			else
			{
				$strResponse=array(
				"Result"=>'',
				"Message"=>"Invalid post.Post must contain categoryId and regId.",
				"status"=>"false"
				);
				
			}
                            
				 header('Content-type: application/json');
				 echo json_encode(array("Response"=>$strResponse));

		}
              
              
          function search(){
			$json = file_get_contents('php://input');
			$obj = json_decode($json,True);
			if(!empty($obj))
            {
				$strResponse=$this->mdl_services->searchresult($obj);
            }
            else 
            {
                $strResponse=array(
				"Result"=>'',
				"Message"=>"Invalid post.Post must contains feedId.",
				"status"=>"false"
				);
            }
			header('Content-type: application/json');
			echo json_encode(array("Response"=>$strResponse));
		}

/**** Gaurav ****/
	function editpostfeed()
		{ 
			$json = file_get_contents('php://input');
			$obj = json_decode($json,True);
			
			if(!empty($obj["feedId"]))
			{
			  $feedId=$obj["feedId"];
			} 
							
			if(!empty($obj["categoryId"]))
			{
		      $categoryId=$obj["categoryId"]; 
			}
			
			if(!empty($obj["regId"]))
			{
			   $regId=$obj["regId"];
			}
			
			if(!empty($obj["description"]))
			{
			   $description=$obj["description"];
			}
			else{  $description=""; }
			
			if(!empty($obj["people"]))
			{
			   $people=$obj["people"];
			}
			else{  $people=""; }
			
			if(!empty($obj["location"]))
			{
			   $location=$obj["location"];
			}
			else{  $location=""; }
			
			if(!empty($obj["latitude"]))
			{
			   $latitude=$obj["latitude"];
			}
			else{  $latitude=""; }
			
			if(!empty($obj["longitude"]))
			{
			   $longitude=$obj["longitude"];
			}
			else{  $longitude=""; }
			
			if(!empty($obj["alert"]))
			{
			   $alert=$obj["alert"];
			}
			else{  $alert=""; }
			
			if(!empty($obj["note"]))
			{
			   $note=$obj["note"];
			}
			else{  $note=""; }
			
			if(!empty($obj["amount"]))
			{
			   $amount=$obj["amount"];
			}
			else{  $amount=""; }
			
			if(!empty($obj["eventDate"]))
			{
			   $eventDate=$obj["eventDate"];
			}
			else{  $eventDate=""; }
			
			if(!empty($obj["starred"]))
			{
			   $starred=$obj["starred"];
			}
			else{  $starred=""; }
			
		    $isAlert = $obj["isAlert"]; 
			
			
				
			if(isset($categoryId) && isset($regId) && isset($feedId))
			{
		$strResponse=$this->mdl_services->edituserfeed($categoryId,$description,$people,$latitude,$longitude,$alert,$note,$regId,$amount,$feedId,$eventDate,$starred,$isAlert,$location);
			}
			else
			{
				$strResponse=array(
				"Result"=>'',
				"Message"=>"Invalid post.Post must contains Feedid,regId and categoryId",
				"status"=>"false"
				);
				
			}
          
				header('Content-type: application/json');
				 echo json_encode(array("Response"=>$strResponse));

		}

	function getfeedrecord()
		{
			$json = file_get_contents('php://input');
			$obj = json_decode($json,True);
			if(!empty($obj))
            {
                $feedId=$obj["feedId"];		
				if(!empty($obj)&& (isset($feedId) ))
				{
					$strResponse=$this->mdl_services->getuserfeeddata($feedId);
				}
				else
				{
					$strResponse=array(
					"Result"=>'',
					"Message"=>"Invalid post.Post must contains feedId.",
					"status"=>"false"
					);
				}
                            
            }
            else 
            {
                $strResponse=array(
				"Result"=>'',
				"Message"=>"Invalid post.Post must contains feedId.",
				"status"=>"false"
				);
            }
			header('Content-type: application/json');
			echo json_encode(array("Response"=>$strResponse));

		}
		

        function getdeleterecord()
		{
			$json = file_get_contents('php://input');
			$obj = json_decode($json,True);
			if(!empty($obj))
            {
                $feedId=$obj["feedId"];		
				if(!empty($obj)&& (isset($feedId) ))
				{
					$strResponse=$this->mdl_services->getdeletefeeddata($feedId);
				}
				else
				{
					$strResponse=array(
					"Result"=>'',
					"Message"=>"Invalid post.Post must contains feedId.",
					"status"=>"false"
					);
				}          
            }
            else 
            {
                $strResponse=array(
				"Result"=>'',
				"Message"=>"Invalid post.Post must contains feedId.",
				"status"=>"false"
				);
            }
			header('Content-type: application/json');
			echo json_encode(array("Response"=>$strResponse));
		}

		

           	function deleteuser(){
			$json = file_get_contents('php://input');
			$obj = json_decode($json,True);
			if(!empty($obj))
            {
                $regId=$obj["regId"];		
				if(!empty($obj) && (isset($regId) ))
				{
					$strResponse=$this->mdl_services->deactiveuser($regId);
				}
				else
				{
					$strResponse=array(
					"Result"=>'',
					"Message"=>"Invalid post.Post must contains RegId.",
					"status"=>"false"
					);
				}          
            }
            else 
            {
                $strResponse=array(
				"Result"=>'',
				"Message"=>"Invalid post.Post must contains RegId.",
				"status"=>"false"
				);
            }
			header('Content-type: application/json');
			echo json_encode(array("Response"=>$strResponse));
		}
		

             	function profileImage()
		{
			$regId=$_POST['regId'];
		    if(isset($_FILES['uploaded_file']['name']) && isset($regId))
		{
					$strfile=$_FILES['uploaded_file'];
			                $strResponse=$this->mdl_services->submitprofile($strfile,$regId);
		}
		else
		{
			 $strResponse=array(
				"Result"=>'',
				"Message"=>"Invalid post.Post must contains regId and image file.",
				"status"=>"false"
				);
			
		}
			echo json_encode(array("Response"=>$strResponse));

		}
		/**** Gaurav ****/

		function getuserfeed()
		{
				$json = file_get_contents('php://input');
			$obj = json_decode($json,True);
			if(!empty($obj))
                        {
                            $regId=$obj["regId"];
							
			if(!empty($obj)&& (isset($regId) ))
			{
				$strResponse=$this->mdl_services->submitgetuserfeed($regId);
			}
			else
			{
				$strResponse=array(
				"Result"=>'',
				"Message"=>"Invalid post.Post must contains regId.",
				"status"=>"false"
				);
				
			}
                            
                        }
                        else 
                        {
                            $strResponse=array(
				"Result"=>'',
				"Message"=>"Invalid post.Post must contains regId.",
				"status"=>"false"
				);
                        }
				header('Content-type: application/json');
				 echo json_encode(array("Response"=>$strResponse));

		}


		function uploadImage()
		{
			$regId=$_POST['regId'];
			$feedId=$_POST['feedId'];
		if(isset($_FILES['uploaded_file']['name']) && isset($regId))
		{
					$strfile=$_FILES['uploaded_file'];
					$strResponse=$this->mdl_services->submitfileupload($strfile,$regId,$feedId);
		}
		else
		{
			 $strResponse=array(
				"Result"=>'',
				"Message"=>"Invalid post.Post must contains regId and image file.",
				"status"=>"false"
				);
			
		}

				//$strResponse=$strReId."finle name".$strfileName;
			echo json_encode(array("Response"=>$strResponse));

		}

           				function invitefriend()
		{
				$json = file_get_contents('php://input');
			$obj = json_decode($json,True);
			if(!empty($obj))
                        {
                            $regId=$obj["regId"];
							
			if(!empty($obj)&& (isset($regId) ))
			{
				$characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
						$string = '';
						for ($i = 0; $i < 5; $i++) {
							$string .= $characters[rand(0, strlen($characters) - 1)];
                        } 
                       
				$strResponse=$this->mdl_services->updateReferenceCode($string,$regId);
			}
			else
			{
				$strResponse=array(
				"Result"=>'',
				"Message"=>"Invalid post.Post must contains regId.",
				"status"=>"false"
				);
				
			}
                            
                        }
                        else 
                        {
                            $strResponse=array(
				"Result"=>'',
				"Message"=>"Invalid post.Post must contains regId.",
				"status"=>"false"
				);
                        }
				header('Content-type: application/json');
				 echo json_encode(array("Response"=>$strResponse));

		}



		function syncsetting()
		{
				$json = file_get_contents('php://input');
			$obj = json_decode($json,True);
			if(!empty($obj))
                     {
                      $regId=$obj["regId"];				
					if(!empty($obj)&& (isset($regId) ))
					{
			            $folder = $_SERVER['DOCUMENT_ROOT']."/lifefeed/uploads/feeds/".$regId."/images";
			             $folder = escapeshellcmd($folder);
                                       if( ! is_dir($folder) )
                                        {
                                           $strResponse=array(
						"Result"=>'',
						"Message"=>"User invalid",
						"status"=>"false"
						);
                                        }
                                       else
                                        { 
                                             $size = 0;
                                             
                                             foreach (glob(rtrim($folder, '/').'/*', GLOB_NOSORT) as $each) {
                                             $size += is_file($each) ? filesize($each) : folderSize($each);
                                             }
                                                 $value = round($size,2);
                                               $mbrecoard = round($size/(1024*1024),2);
                                                 $useddata =  $mbrecoard."MB";
                                          
                                            $strResponse=$this->mdl_services->getReferenceCount($regId);
                                           if(empty($strResponse))
                                                $userspace = 0;
                                           else 
                                                $userspace = $strResponse; 
                          
                                            $usedtotalspace =   $userspace;      
                                           $totalspace = $usedtotalspace."MB";
                                              $strResponse=array(
						"Result"=>array("used"=>$useddata,"available"=>$totalspace),
						"Message"=>"",
						"status"=>"true"
						);

                                        }  
					        
					}
					else
					{
						$strResponse=array(
						"Result"=>'',
						"Message"=>"Invalid post.Post must contains regId.",
						"status"=>"false"
						);
					}  
            }
            else 
            {
                $strResponse=array(
				"Result"=>'',
				"Message"=>"Invalid post.Post must contains regId.",
				"status"=>"false"
				);
            }
				header('Content-type: application/json');
				 echo json_encode(array("Response"=>$strResponse));

		}


	function hello_world()
	{
             $this->load->helper('url');
		$this->load->library('cezpdf');

		$this->cezpdf->ezText('Hello World', 12, array('justification' => 'center'));
		$this->cezpdf->ezSetDy(-10);

		$content = 'The quick, brown fox jumps over a lazy dog. DJs flock by when MTV ax quiz prog.
					Junk MTV quiz graced by fox whelps. Bawds jog, flick quartz, vex nymphs.';

		$this->cezpdf->ezText($content, 10);

		$this->cezpdf->ezStream();
	}

    function headers()
	{
		$this->load->library('cezpdf');
		$this->load->helper('pdf');
		
		prep_pdf(); // creates the footer for the document we are creating.

		$db_data[] = array('name' => 'Jon Doe', 'phone' => '111-222-3333', 'email' => 'jdoe@someplace.com');
		$db_data[] = array('name' => 'Jane Doe', 'phone' => '222-333-4444', 'email' => 'jane.doe@something.com');
		$db_data[] = array('name' => 'Jon Smith', 'phone' => '333-444-5555', 'email' => 'jsmith@someplacepsecial.com');
		
		$col_names = array(
			'name' => 'Name',
			'phone' => 'Phone Number',
			'email' => 'E-mail Address'
		);
		
		$this->cezpdf->ezTable($db_data, $col_names, 'Contact List', array('width'=>550));
		$this->cezpdf->ezStream();
	}

       function sharefeed(){
             $this->load->view('allshare'); 
       }

     
      function pdfhtml($obj)
        {
			$objs = explode("-",$obj);
			if(!empty($objs))
            {
				$strResponse=$this->mdl_services->getfeedpdfrecord($objs);
				$data['records'] = $strResponse;
				$html=$this->load->view('pdfview', $data, true);
				$pdfFilePath = "lifefeed_".date('ymdhis').".pdf";
				$this->load->library('m_pdf');
				$this->m_pdf->pdf->WriteHTML($html);
				$this->m_pdf->pdf->Output($pdfFilePath, "D"); 		
            }
            else 
            {
                $strResponse=array(
				"Result"=>'',
				"Message"=>"Invalid post.Post must contains feedId.",
				"status"=>"false"
				);
            }
				header('Content-type: application/json');
				 echo json_encode(array("Response"=>$strResponse));
		}
      

		function getEditImages()
		{
			$json = file_get_contents('php://input');
			$obj = json_decode($json,True);
			if(!empty($obj))
            {
                $feedId=$obj["feedId"];				
					if(!empty($obj)&& (isset($feedId) ))
					{
						 $editImage=$obj["editimages"];	
      			
				        $strResponse=$this->mdl_services->updateEditimages($editImage,$feedId);
						echo "<pre>";
						print_r($strResponse);
                                                exit;						
							/* $html=$this->load->view('pdfview', $data, true);
							$pdfFilePath = "output_pdf_name.pdf";
							$this->load->library('m_pdf');
							$this->load->library('m_pdf');
							$this->m_pdf->pdf->WriteHTML($html);
							$this->m_pdf->pdf->Output($pdfFilePath, "D"); */
					
					}
					else
					{
						$strResponse=array(
						"Result"=>'',
						"Message"=>"Invalid post.Post must contains feedId.",
						"status"=>"false"
						);
					}  
            }
            else 
            {
                $strResponse=array(
				"Result"=>'',
				"Message"=>"Invalid post.Post must contains feedId.",
				"status"=>"false"
				);
            }
				header('Content-type: application/json');
				 echo json_encode(array("Response"=>$strResponse));

		}



        function getfeedpdfrecord()
		{
			$json = file_get_contents('php://input');
			$obj = json_decode($json,True);
			if(!empty($obj))
            {
                $feedId=$obj["feedId"];		
				if(!empty($obj)&& (isset($feedId) ))
				{
					$strResponse=$this->mdl_services->getfeedpdfrecord($feedId);
				}
				else
				{
					$strResponse=array(
					"Result"=>'',
					"Message"=>"Invalid post.Post must contains feedId.",
					"status"=>"false"
					);
				}
                            
            }
            else 
            {
                $strResponse=array(
				"Result"=>'',
				"Message"=>"Invalid post.Post must contains feedId.",
				"status"=>"false"
				);
            }
			header('Content-type: application/json');
			echo json_encode(array("Response"=>$strResponse));

		}
		
		function getreferCount()
		{
			$json = file_get_contents('php://input');
			$obj = json_decode($json,True);
			if(!empty($obj))
            {
                $regId=$obj["regId"];		
				if(!empty($obj)&& (isset($regId) ))
				{
					$strResponse=$this->mdl_services->getUserReferCount($regId);
				}
				else
				{
					$strResponse=array(
					"Result"=>'',
					"Message"=>"Invalid post.Post must contains feedId.",
					"status"=>"false"
					);
				}
                            
            }
            else 
            {
                $strResponse=array(
				"Result"=>'',
				"Message"=>"Invalid post.Post must contains userID.",
				"status"=>"false"
				);
            }
			header('Content-type: application/json');
			echo json_encode(array("Response"=>$strResponse));

		}
		
		function share()
		{
			$json = file_get_contents('php://input');
			$obj = json_decode($json,True);
			if(!empty($obj))
            {
                                $regId=$obj["regId"];	
				$feedId=$obj["feedId"];
				$images=$obj["images"];	
				$no_of_people=$obj["no_of_people"];
				$expense=$obj["expense"];	
				$location=$obj["location"];
				$note=$obj["note"];
				$alarm=$obj["alarm"];	
				if(!empty($obj)&& (isset($regId) && isset($feedId)))
				{
					$strResponse=$this->mdl_services->getShareModel($regId,$feedId,$images,$no_of_people,$expense,$location,$note,$alarm);
				}
				else
				{
					$strResponse=array(
					"Result"=>'',
					"Message"=>"Invalid post.Post must contains feedId.",
					"status"=>"false"
					);
				}
                            
            }
            else 
            {
                $strResponse=array(
				"Result"=>'',
				"Message"=>"Invalid post.Post must contains userID.",
				"status"=>"false"
				);
            }
			header('Content-type: application/json');
			echo json_encode(array("Response"=>$strResponse));

		}
		
			function sharebk()
		{
			$json = file_get_contents('php://input');
			$obj = json_decode($json,True);
			if(!empty($obj))
            {
                $regId=$obj["regId"];	
				$feedId=$obj["feedId"];
				$images=$obj["images"];	
				$no_of_people=$obj["no_of_people"];
				$expense=$obj["expense"];	
				$location=$obj["location"];
				$note=$obj["note"];
				$alarm=$obj["alarm"];	
				if(!empty($obj)&& (isset($regId) ))
				{
					$strResponse=$this->mdl_services->getShareModel($regId,$feedId,$images,$no_of_people,$expense,$location,$note,$alarm);
				}
				else
				{
					$strResponse=array(
					"Result"=>'',
					"Message"=>"Invalid post.Post must contains feedId.",
					"status"=>"false"
					);
				}
                            
            }
            else 
            {
                $strResponse=array(
				"Result"=>'',
				"Message"=>"Invalid post.Post must contains userID.",
				"status"=>"false"
				);
            }
			header('Content-type: application/json');
			echo json_encode(array("Response"=>$strResponse));

		}
		
		function viewShareLink($shareId)
		{
			 $data['records']=$this->mdl_services->getShareLink($shareId);
			 $data['share']=$this->mdl_services->getShareStatus($shareId);
                     
			 $this->load->view('share',$data);
		}
		
		/************************ ios edit feed ********************/
		function editpostfeedios()
		{ 
			$json = file_get_contents('php://input');
			$obj =json_decode($json,True);
			
			if(!empty($obj["feedId"]))
			{
			  $feedId=$obj["feedId"];
			} 
							
			if(!empty($obj["categoryId"]))
			{
		      $categoryId=$obj["categoryId"]; 
			}
			
			if(!empty($obj["regId"]))
			{
			   $regId=$obj["regId"];
			}
			
			if(!empty($obj["description"]))
			{
			   $description=$obj["description"];
			}
			else{  $description=""; }
			
			if(!empty($obj["people"]))
			{
			   $people=$obj["people"];
			}
			else{  $people=""; }
			
			if(!empty($obj["location"]))
			{
			   $location=$obj["location"];
			}
			else{  $location=""; }
			
			if(!empty($obj["latitude"]))
			{
			   $latitude=$obj["latitude"];
			}
			else{  $latitude=""; }
			
			if(!empty($obj["longitude"]))
			{
			   $longitude=$obj["longitude"];
			}
			else{  $longitude=""; }
			
			if(!empty($obj["alert"]))
			{
			   $alert=$obj["alert"];
			}
			else{  $alert=""; }
			
			if(!empty($obj["note"]))
			{
			   $note=$obj["note"];
			}
			else{  $note=""; }
			
			if(!empty($obj["amount"]))
			{
			   $amount=$obj["amount"];
			}
			else{  $amount=""; }
			
			if(!empty($obj["eventDate"]))
			{
			   $eventDate=$obj["eventDate"];
			}
			else{  $eventDate=""; }
			
			if(!empty($obj["starred"]))
			{
			   $starred=$obj["starred"];
			}
			else{  $starred=""; }
			
		    $isAlert = $obj["isAlert"]; 
			
			
				
			if(isset($categoryId) && isset($regId) && isset($feedId))
			{

                     if(isset($obj["editimages"]) && !empty($obj["editimages"]))
		      {
		        $editImage=$obj["editimages"];	
			$strResponse=$this->mdl_services->updateEditimages($editImage,$feedId);
		      }

		       $strResponse=$this->mdl_services->edituserfeedios($categoryId,$description,$people,$latitude,$longitude,$alert,$note,$regId,$amount,$feedId,$eventDate,$starred,$isAlert);
		
		     
		  }
			else
			{
				$strResponse=array(
				"Result"=>'',
				"Message"=>"Invalid post.Post must contains Feedid,regId and categoryId",
				"status"=>"false"
				);
				
			}
          
				header('Content-type: application/json');
				 echo json_encode(array("Response"=>$strResponse));

		}

// verify email id function 

  function verifyemail($id){

    $verfiyEmail = $this->mdl_services->getverfiyemailid($id);
    $emailid = $this->mdl_services->getuseremailid($id);

    if($verfiyEmail == 1 ){

        
         if($emailid != "no") {

/********************** Mail *****************/
					$to  = $emailid; 
					// subject
				$subject = 'Welcome to life-feed';
				//message
				$message ='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml">
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
    <td colspan="2">Welcome to Lifefeed,</td>
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
       your email is verified ! </td>
    	  <td>&nbsp;</td>
    </tr>
    
    <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
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
				$headers = 'From:Life Feed- Verify Your Email-id <info@digitalagencymumbai.com>' . "\r\n";
				$headers .= "MIME-Version: 1.0" . "\r\n";
   				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 

				// Additional headers

				// Mail it
				
					 //mail($to, $subject, $message, $headers);
					  mail($to, $subject, $message, $headers);
					
					/* $strResponse=array(
						"Result"=>'',
						"Message"=>"Please check your mail to for verify your email address",
						"status"=>"true"
						);	*/
					/********************** Mail *****************/


                                       }







      $this->load->view('abc');
    }
   }
//check reference code 

  function checkRefcode()
  {
	  
			$json = file_get_contents('php://input');
			$obj = json_decode($json,True);
			if(!empty($obj))
            {
                $refcode=$obj["refcode"];	
					
				if(!empty($obj)&& (isset($refcode) ))
				{
					$strResponse=$this->mdl_services->refCheck($refcode);
				}
				else
				{
					$strResponse=array(
					"Result"=>'',
					"Message"=>"Invalid post.Post must contains refcode.",
					"status"=>"false"
					);
				}
                            
            }
            else 
            {
                $strResponse=array(
				"Result"=>'',
				"Message"=>"Invalid post.Post must contains refcode.",
				"status"=>"false"
				);
            }
			header('Content-type: application/json');
			echo json_encode(array("Response"=>$strResponse));

		
  }

// invite friend refer count


  function userReferCount()
  {
	  
			$json = file_get_contents('php://input');
			$obj = json_decode($json,True);
			if(!empty($obj))
            {
                              $regId=$obj["regId"];	
					
				if(!empty($obj)&& (isset($regId)))
				{
					$strResponse=$this->mdl_services->userReferCount($regId);
				}
				else
				{
					$strResponse=array(
					"Result"=>'',
					"Message"=>"Invalid post.Post must contains regId.",
					"status"=>"false"
					);
				}
                            
            }
            else 
            {
                $strResponse=array(
				"Result"=>'',
				"Message"=>"Invalid post.Post must contains regId.",
				"status"=>"false"
				);
            }
			header('Content-type: application/json');
			echo json_encode(array("Response"=>$strResponse));

		
  }

}
?>
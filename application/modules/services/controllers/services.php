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

	/**************** News Section Start ****************/	
	
		function newsList()
		{ 
			$json = file_get_contents('php://input');
			$obj = json_decode($json,True);
			if(!empty($obj))
			{
				$start= $obj["start"];
				$limit= $obj["limit"];
			}
			$strResponse=$this->mdl_services->newsList($start, $limit);			
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
		
		function newsNotification()
		{ 
			$json = file_get_contents('php://input');
			$obj = json_decode($json,True);
			if(!empty($obj))
			{
				$deviceID= $obj["deviceID"];
			}
			$strResponse=$this->mdl_services->getNewsNotification($deviceID);			
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
				$start= $obj["start"];
				$limit= $obj["limit"];
			}
			
		$strResponse=$this->mdl_services->newsSearch($name,$start, $limit); 			
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
		
		function patrika()
		{
			$json = file_get_contents('php://input');
			$obj = json_decode($json,True);
			if(!empty($obj))
			{
				$start= $obj["start"];
				$limit= $obj["limit"];
			}
			$strResponse=$this->mdl_services->getPatrika($start, $limit);
			
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
		
		function patrikaSearch()
		{
			$json = file_get_contents('php://input');
			$obj = json_decode($json,True);
			if(!empty($obj))
			{
				$name = $obj["name"];
				$start= $obj["start"];
				$limit= $obj["limit"];
			}
			
		$strResponse=$this->mdl_services->getPatrikaSearch($name,$start, $limit);  			
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
		
		function newsletter()
		{
			$json = file_get_contents('php://input');
			$obj = json_decode($json,True);
			if(!empty($obj))
			{
				$start= $obj["start"];
				$limit= $obj["limit"];
			}
			$strResponse=$this->mdl_services->getNewsletter($start, $limit);
			
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
		
		function newsletterSearch()
		{
			$json = file_get_contents('php://input');
			$obj = json_decode($json,True);
			if(!empty($obj))
			{
				$name = $obj["name"];
				$start= $obj["start"];
				$limit= $obj["limit"];
			}
			
		   $strResponse=$this->mdl_services->getNewsletterSearch($name,$start, $limit);  			
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
		
		function articleSearch()
		{
			$json = file_get_contents('php://input');
			$obj = json_decode($json,True);
			if(!empty($obj))
			{
				$title = $obj["title"];
				$start= $obj["start"];
				$limit= $obj["limit"];
			}
			
			$strResponse=$this->mdl_services->getArticleSearch($title,$start,$limit); 			
			if($strResponse['status']==true)
			{
				$finalResponse=$strResponse;
			}
              else 
				{
					$strResponse=array(
							"Result"=>'',
							"Message"=>"Invalid Article.",
							"status"=>"false"
					);
				}
			header('Content-type: application/json');
			echo json_encode(array("Response"=>$finalResponse));
		}
		
		function statisticsExport()
		{ 
			$json = file_get_contents('php://input');
			$obj = json_decode($json,True);
						
			$strResponse=$this->mdl_services->statisticsExport();
			
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
		
		function statisticsImport()
		{ 
			$json = file_get_contents('php://input');
			$obj = json_decode($json,True);
						
			$strResponse=$this->mdl_services->statisticsImport();
			
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
		
		
		/**************** News Section End ****************/	
		
		/*************** Exhibitor Section Start **********/

	function exhibitorList()
	{
			$json = file_get_contents('php://input');
			$obj = json_decode($json,True);
			if(!empty($obj))
			{
				$year= $obj["year"];
				$eventName= $obj["event_name"];
			}
			$strResponse=$this->mdl_services->exhibitorList($year,$eventName);
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
		
	/************************ Exhibitor Menu End  Start **********************************************/
	function exhibitorMenuList()
	{ 
			$json = file_get_contents('php://input');
			$obj = json_decode($json,True);
			if(!empty($obj))
			{
				$eventName= $obj["event"];
			}	
			$strResponse=$this->mdl_services->getExhibitorMenuList($eventName);
			if($strResponse['status']==true)
			{
				$finalResponse=$strResponse;
			}
            else 
			{
				$finalResponse=array(
							"Result"=>'',
							"Message"=>"Invalid Menu List",
							"status"=>"false"
				);
			}			
			header('Content-type: application/json');
			echo json_encode(array("Response"=>$finalResponse));
	}
    /************************ Exhibitor Menu End **********************************************/

		function circularMember()
		{ 
			$json = file_get_contents('php://input');
			$obj = json_decode($json,True);
			if(!empty($obj))
			{
				$year= $obj["year"];
			}
			if(!empty($obj))
			{
				$name= $obj["name"];
			}				
			$strResponse=$this->mdl_services->circularMember($year,$name);
			
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
		
		function circularGov()
		{
			$json = file_get_contents('php://input');
			$obj = json_decode($json,True);
			if(!empty($obj))
			{
				$year= $obj["year"];
			}
			if(!empty($obj))
			{
				$name= $obj["name"];
			}			
			$strResponse=$this->mdl_services->circularGov($year,$name);
			
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
	
	/*************** Exhibitor Section End **************/
	
	/*************** Members Directory Start **************/
	
		function memberDirectoryList()
		{
			$json = file_get_contents('php://input');
			$obj = json_decode($json,True);
						
			$strResponse=$this->mdl_services->memberDirectoryList();
			
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
		
	/*************** Members Directory End **************/
	
	/************************ Statistics Search Start ************************************************/
	
	public function moneyFormatIndia($num){
    $explrestunits = "" ;
    if(strlen($num)>3){
        $lastthree = substr($num, strlen($num)-3, strlen($num));
        $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
        $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
        $expunit = str_split($restunits, 2);
        for($i=0; $i<sizeof($expunit); $i++){
            // creates each of the 2's group and adds a comma to the end
            if($i==0)
            {
                $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
            }else{
                $explrestunits .= $expunit[$i].",";
            }
        }
        $thecash = $explrestunits.$lastthree;
    } else {
        $thecash = $num;
    }
    return $thecash; // writes the final format where $currency is the currency symbol.
}


		function statisticsSearch()
		{
			$json = file_get_contents('php://input');
			$obj = json_decode($json,True);
			if(!empty($obj))
			{	
				$year= $obj["year"];
				$quarter = $obj["quarter"];
				$month= $obj["month"];
				$commodity_name = $obj["commodity_name"];
				$hs_code= $obj["hs_code"];
				$trade_type= $obj["trade_type"];
			}
			
		$strResponse=$this->mdl_services->statisticsSearch($year,$quarter,$month,$commodity_name,$hs_code,$trade_type); 
			
			if($strResponse['status']==true)
			{
				$finalResponse=$strResponse;
				//echo '<pre>';  print_r($finalResponse['Result']); exit;
				$ans=$finalResponse['Result'];
				$mainArray = array();
				
				$sub_total_inr=0;
				$sub_total_usd=0;
					
				$i = 0;	
				foreach($ans as $value) {
				
					$total_inr=$value->total_inr;
					$total_usd=$value->total_usd; 
					
					/*$sub_total_inr1=round($sub_total_inr+$value->total_inr);
					$sub_total_usd1=round($sub_total_usd+$value->total_usd); */
					
					$sub_total_inr=round($sub_total_inr+$value->total_inr);
					$sub_total_usd=round($sub_total_usd+$value->total_usd);
					
					$get_inr=round($value->total_inr);
					$get_usd=round($value->total_usd);
					
					$get_inr1=$this->moneyFormatIndia($get_inr);
					$get_usd1=$this->moneyFormatIndia($get_usd);					 
					
					$mainArray[$i]['id'] = $value->id; 
					$mainArray[$i]['product_category_code'] = $value->product_category_code; 
					$mainArray[$i]['year'] = $value->year; 
					$mainArray[$i]['export_import_date'] = $value->export_import_date; 
                    $mainArray[$i]['country_name'] = $value->country_name; 
					$mainArray[$i]['country_code'] = $value->country_code; 
					$mainArray[$i]['total_inr'] = $get_inr1;
					$mainArray[$i]['total_usd'] = $get_usd1;
					
				$i++;
				}
					$all_total_inr=$this->moneyFormatIndia($sub_total_inr);
					$all_total_usd=$this->moneyFormatIndia($sub_total_usd);
					
			//	echo "==---------->".$all_total_inr; echo '<br/>'; 
			//	echo "==---------->".$all_total_inr; echo '<br/>'; exit;
			//	echo '----++++>'.$sub_total_inr=round($sub_total_inr+$rowx['total_inr']); exit;
				$finalResponse=$mainArray;
				//echo '<pre>';  print_r($mainArray);exit;
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
			echo json_encode(array("Response"=>$finalResponse,"Total INR"=>$all_total_inr,"Total USD"=>$all_total_usd));
		}	
	   
	   /************************ Statistics Search End ************************************************/
	   
	   /************************ Lab Start ************************************************/	   
	    function laboratoryList()
		{ 
			$json = file_get_contents('php://input');
			$obj = json_decode($json,True);
			$strResponse=$this->mdl_services->labList();
			
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
	   
	   /************************ Lab End ************************************************/
	   
	   /************************ Education Start ************************************************/	   
	    function institutesList()
		{ 
			$json = file_get_contents('php://input');
			$obj = json_decode($json,True);
			$strResponse=$this->mdl_services->getinstitutesList();
			
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
	   
	   /************************ Education End ************************************************/
	   
	    /************************ CFC Start ************************************************/	   
	    function cfcList()
		{ 
			$json = file_get_contents('php://input');
			$obj = json_decode($json,True);
			$strResponse=$this->mdl_services->getCfcList();
			
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
	   
	   /************************ CFC End ************************************************/
	   
	   /************************ GJEPC EVENTS START *************************************/	   
	    function gjepcEventList()
		{ 
			$json = file_get_contents('php://input');
			$obj = json_decode($json,True);
			$strResponse=$this->mdl_services->getGjepcEventList();
			
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
	   
	   /************************ GJEPC EVENTS END *****************************************/
	   
	   /********************************************************* Enquiry ******************************************/
	function enquiry()
	{
			$json = file_get_contents('php://input');
			$obj = json_decode($json,True);
			if(!empty($obj))
                        {	
							$topic=$obj["topic"]; 
                            $email=$obj["email"];
							$mobile=$obj["mobile"];
                            $enquiry=$obj["enquiry"]; 
			              
			if(!empty($obj)&& (isset($topic) && isset($email) && isset($mobile) && isset($enquiry)))
			{
    			    $strResponse=$this->mdl_services->submitenquiry($topic,$email,$mobile,$enquiry);
					if($strResponse['Message'] == "Success")
					{ 
					$topic=$strResponse[0][0]->dept;
					$getemail=$strResponse[0][0]->email;
					
					/********************** Mail *****************/
$to  =  $getemail;
$subject = 'Thank you';
$message ='<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:"Lucida Sans"; font-size:14px; color:#333333; text-align:justify; ">
  <tr>
    <td colspan="2"> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
	<td width="85%" align="left"><img src="http://gjepc.org/images/gjepc_logo.png" width="105" height="91" /></td>         
        </tr>
      </table>    </td>
  </tr>
  <tr>
    <td height="10" colspan="2" align="left" style="font-family:"Lucida Sans"; font-size:14px; color:#990000; border-bottom: solid thin #666666;">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" style="text-align:justify;"> Thanks for Feedback at Gems and Jewellery Export Promotion Council (GJEPC).
</td>
  </tr>
   <tr>
    <td>&nbsp; </td>
    </tr>
  <tr>
    <td align="left"  style="text-align:justify;">You may now log in to http://www.gjepc.org/login.php using the following<br/></td>
  </tr>
  <tr>
    <td align="left"  style="text-align:justify;"><strong>Topic :</strong> '. $topic .'</td>
  </tr>
    <tr>
    <td align="left"  style="text-align:justify;"><strong>Email :</strong> '. $email .' </td>
  </tr>
  <tr>
    <td align="left"  style="text-align:justify;"><strong>Mobile :</strong> '. $mobile .' </td>
  </tr>
  <tr>
    <td align="left"  style="text-align:justify;"><strong>Enquiry :</strong> '. $enquiry .'</td>
  </tr>

   <tr>
  <td>&nbsp; </td>
    </tr>
    
  <tr>
    <td align="left"  style="text-align:justify;"> For any further queries regarding the same please contact regional offices:<br/>
    F  17-18, Flatted Factories Complex, Jhandewalan, New Delhi - 110 055</td>
  </tr>
   <tr>
    <td>&nbsp; </td>
    </tr>
  <tr>
    <td height="22" align="left"  style="font-family:"Lucida Sans"; font-size:14px; font-weight:bold; color:#990000;">Kind Regards,</td>
  </tr>
  <tr>
    <td align="left"><strong>GJEPC Web Team,</strong></td>
  </tr>
  
</table>';
				
				// To send HTML mail, the Content-type header must be set
				$headers = 'From:GJEPC Feedback <do-not-reply@gjepc.org>' . "\r\n";
				$headers .= "MIME-Version: 1.0" . "\r\n";
   				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 

				// Additional headers
				// Mail it
			  mail($to, $subject, $message, $headers);
					/********************** Auto Reply Mail *****************/

$auto_subject = 'Your information has been successfully Send it';
$auto_message ='<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:"Lucida Sans"; font-size:14px; color:#333333; text-align:justify; ">
  <tr>
    <td colspan="2"> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
	<td width="85%" align="left"><img src="http://gjepc.org/images/gjepc_logo.png" width="105" height="91" /></td>         
        </tr>
      </table>    </td>
  </tr>
  <tr>
    <td height="10" colspan="2" align="left" style="font-family:"Lucida Sans"; font-size:14px; color:#990000; border-bottom: solid thin #666666;">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" style="text-align:justify;"> Thanks for Contact Your information has been successfully Send to Gems and Jewellery Export Promotion Council (GJEPC).
	</td>
  </tr>
    <tr>
		<td> &nbsp;</td>
	</tr>
  <tr>
    <td align="left"  style="text-align:justify;"> For any further queries regarding the same please contact regional offices:<br/>
    F  17-18, Flatted Factories Complex, Jhandewalan, New Delhi - 110 055</td>
  </tr>
   <tr>
    <td>&nbsp; </td>
    </tr>
  <tr>
    <td height="22" align="left"  style="font-family:"Lucida Sans"; font-size:14px; font-weight:bold; color:#990000;">Kind Regards,</td>
  </tr>
  <tr>
    <td align="left"><strong>GJEPC Web Team,</strong></td>
  </tr>
  
</table>';		
			    $autoheaders = 'From:GJEPC Feedback <do-not-reply@gjepc.org>' . "\r\n";
				$autoheaders .= "MIME-Version: 1.0" . "\r\n";
   				$autoheaders .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
			  mail($email, $auto_subject, $auto_message, $autoheaders);
					
			}
			}
			else
			{
				$strResponse=array(
				"Result"=>'',
				"Message"=>"Invalid post.Post must contains email and password.",
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
				//header('Content-type: application/json');
			    echo json_encode(array("Response"=>$strResponse));
}
/********************************************************* Enquiry ******************************************/

/********************************************************* helpdesk ******************************************/	 
		function topicList()
		{ 
			$json = file_get_contents('php://input');
			$obj = json_decode($json,True);
			$strResponse=$this->mdl_services->enquiryTopicList();
			
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

/********************************************************* helpdesk ******************************************/	 

/************************ Show Info Start ************************************************/	   
	    function showInfoList()
		{
			$json = file_get_contents('php://input');
			$obj = json_decode($json,True);
			if(!empty($obj))
			{
				$year= $obj["year"];
				$eventName= $obj["event_name"];
			}
			$strResponse=$this->mdl_services->infoList($year,$eventName);
			
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
	   
/************************ Show Info End ************************************************/

/************************ Service Venue Start ************************************************/	   
	    function serviceVenueList()
		{ 
			$json = file_get_contents('php://input');
			$obj = json_decode($json,True);
			if(!empty($obj))
			{
				$year= $obj["year"];
				$eventName= $obj["event_name"];
			}
			$strResponse=$this->mdl_services->venueList($year,$eventName);
			
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
	   
/************************ Service Venue End ************************************************/

/************************ How To Reach Start ************************************************/	   
	    function howReachList()
		{ 
			$json = file_get_contents('php://input');
			$obj = json_decode($json,True);
			if(!empty($obj))
			{
				$year= $obj["year"];
				$eventName= $obj["event_name"];
			}
			$strResponse=$this->mdl_services->reachList($year,$eventName);
			
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
	   
/************************ How To Reach End ************************************************/

/************************ OOPS Start ************************************************/	   
	    function oopsList()
		{
			$json = file_get_contents('php://input');
			$obj = json_decode($json,True);
			if(!empty($obj))
			{
				$year= $obj["year"];
				$eventName= $obj["event_name"];
			}
			$strResponse=$this->mdl_services->getoopsList($year,$eventName);
			
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
	   
/************************ OOPS End ************************************************/

/************************ Show Updates Start ************************************************/
		function getUpdateList()
		{ 
			$json = file_get_contents('php://input');
			$obj = json_decode($json,True);
			if(!empty($obj))
			{
				$year= $obj["year"];
				$eventName= $obj["event_name"];
			}
			$strResponse=$this->mdl_services->showUpdateList($year,$eventName);
			
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
/************************ Show Updates End ************************************************/

/************************ Zone Manager Start ************************************************/
		function zoneList()
		{ 
			$json = file_get_contents('php://input');
			$obj = json_decode($json,True);
			if(!empty($obj))
			{
				$eventName= $obj["event_name"];
			}
			$strResponse=$this->mdl_services->zoneManagerList($eventName);
			
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
/************************ Zone Manager End ************************************************/

/************************ Event Status Start **********************************************/
		function checkEventStatus()
		{ 
			$json = file_get_contents('php://input');
			$obj = json_decode($json,True);
			if(!empty($obj))
			{
				$event= $obj["event"];
			}
			$strResponse=$this->mdl_services->getEventStatus($event);
			
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
/************************ Event Status End **********************************************/

/************************ Metal & Currency Status Start *****************************/
		function metalNCurrency()
		{ 
			$json = file_get_contents('php://input');
			$obj = json_decode($json,True);
			
			$strResponse=$this->mdl_services->getMetalNCurrency();
			
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
/************************ Metal & Currency Status End ***********************************/

 /************************ Notification List Start ************************************************/	   
	    function notificationList()
		{ 
			$json = file_get_contents('php://input');
			$obj = json_decode($json,True);
			$strResponse=$this->mdl_services->getNotifyList();
			
			if($strResponse['status']==true)
			{
				$finalResponse=$strResponse;
			}
              else 
				{
					$finalResponse=array(
							"Result"=>'',
							"Message"=>"Notification not Found.",
							"status"=>"false"
					);
				}
			header('Content-type: application/json');
			echo json_encode(array("Response"=>$finalResponse));
		}   
	   
/************************ Notification List End ************************************************/
	   
/************************ Notification Start **********************************************/

	function pushNotification()
	{
			$json = file_get_contents('php://input');
			$obj = json_decode($json,True);
			if(!empty($obj))
                {
							$deviceType=$obj["deviceType"];
                            $gcmRegid=$obj["deviceId"];  
			              
			if(!empty($obj)&& isset($deviceType) && isset($gcmRegid))
			{
					$strResponse=$this->mdl_services->submitNotification($deviceType,$gcmRegid);
					if(!empty($strResponse['Result']) && is_array($strResponse))
					{
						$deviceType=$strResponse['Result'][0]->deviceType;
						$gcmRegid=$strResponse['Result'][0]->deviceId;
					}
			}
			else
			{
				$strResponse=array(
				"Result"=>'',
				"Message"=>"Invalid post.Post must contains email and password.",
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
				//header('Content-type: application/json');
			    echo json_encode(array("Response"=>$strResponse));
}

/************************ Notification End **********************************************/

/************************ Video Start **********************************************/
	function videoList()
	{ 
			$json = file_get_contents('php://input');
			$obj = json_decode($json,True);
			if(!empty($obj))
			{
				$catName= $obj["catName"];
			}	
			$strResponse=$this->mdl_services->getvideoList($catName);
			if($strResponse['status']==true)
			{
				$finalResponse=$strResponse;
			}
            else 
			{
				$finalResponse=array(
							"Result"=>'',
							"Message"=>"Invalid Videos",
							"status"=>"false"
				);
			}			
			header('Content-type: application/json');
			echo json_encode(array("Response"=>$finalResponse));
	}
/************************   End **********************************************/


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
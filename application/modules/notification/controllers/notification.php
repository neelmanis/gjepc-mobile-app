<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');
class Notification extends MX_Controller
{

	function __construct() {
		parent::__construct();
		
		$this->load->model('mdl_notification');
		$this->load->library('session');
	}

/************************************** Start Login ****************************************************/	

	function notificationlist()
	{
		$getUsers = $this->mdl_notification->listusers();
		 if(!empty($getUsers) && is_array($getUsers))
		 {
		  $data['getAllusers'] = $getUsers;
		 }
		 else
		 {
		  $data['getAllusers'] = ""; 
		 }
		$data['viewFile'] = "list";
		$data['page'] = 'list';
		$data['menu'] = 'infos';
		$template = 'admin';
		echo Modules::run('template/'.$template, $data);
	}
	
	
	function SendMessage()
	{
		    $message=$this->input->post("sendMessage"); 
		    $registatoin_ids=$this->input->post("sendIds"); 
			
			$size=sizeof($registatoin_ids);
			$counter=0;
			$strReturnVal="Android Result:-";
			$strReturnValIphone="Iphone Result:-";               
            
			$msgData = $this->input->post();
			//echo '<pre>'; print_r($msgData); exit;
			 $data = array(
					'message'=>$msgData['sendMessage']
			      );				
			$insData = $this->mdl_notification->addDetail($data);
			
                foreach($registatoin_ids as $values)
                {
					
                   // $this->send_notification($values, $message);
                  $strId = $values;
            		//$base_64 =$strId . str_repeat('=', strlen($strId) % 4);
        			//$strId = base64_decode($base_64);
                   $strQuery="select * from push_notification where id=".$strId;
                    $strResult=$this->_custom_query($strQuery);
                    $strResult=$strResult->result();
					$devicetype=$strResult[0]->deviceType;
					$deviceId=$strResult[0]->deviceId;
					$alert="";

                    if($devicetype=="A")
                    {
                      $strReturnVal1=$this->send_notification($deviceId,$message);
                      if($strReturnVal1!=1)
                      {
                        $strReturnVal.="Message not send to ".$deviceId." ,";
                      }

                    }
                    else
                    {
                      $strReturnVal1= $this->sentnotificationIos($deviceId,$message);
                      if($strReturnVal1!=1)
                      {
                        $strReturnValIphone.="Message not send to ".$deviceId." ,";
                      }
                    }
                    $counter=$counter+1;               
                    
                }
			
            if($size==$counter)
            {
                echo 1;

            }
            else
            {
                echo $strReturnVal." ".$strReturnValIphone ;
            }
		
	}

 function send_notification($deviceId,$message)
 {
 
		$url = 'https://fcm.googleapis.com/fcm/send';
		   
        $ans = '{"to":"'.$deviceId.'","data":{"data":{"title":"GJEPC Notification","is_background":false,"message":"'.$message.'","image":"","payload":{"team":"India","score":"5.6"},"timestamp":"2017-01-09 8:34:42"}}}';
        $headers = array(
                     'Authorization:key = AAAApL0uOnU:APA91bHeUBlanWzWt-w-cam2VoZ-2G7LTqVPF0ZBOh_3a0y0BJQs1Xz2mB7SOQGSTwtvTnepNoDR39Ec8010edDhg04596Qyb2sZumRSmz5jIgF5rhcHBBHV7CfiajL9c_gejQf4VroE',
            'Content-Type: application/json'

        );

        $ch = curl_init();
 
        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
 
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
 
        curl_setopt($ch, CURLOPT_POSTFIELDS,  $ans);
 
        // Execute post
        $result = curl_exec($ch);
       
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
 
        // Close connection
        curl_close($ch);
         //var_dump($result);
        return $result;
 }
/*
function sentnotificationIos($deviceToken='',$message='')
{
        $deviceToken = "5e5cd09cee20af4c350b1169866ec7f8207fa81eb960502521dd4b6efe085251";
		$message="GJEPC";
		$ctx = stream_context_create();
        $tCert = "https://gjepc.org/gjepc_mobile/Certificates.pem";
            
		// ck.pem is your certificate file
		stream_context_set_option($ctx, 'ssl', 'local_cert', $tCert);
		stream_context_set_option($ctx, 'ssl', 'passphrase', '');

        $fp = stream_socket_client(
			'ssl://gateway.sandbox.push.apple.com:2195', $err,
			$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
		if (!$fp)
			exit("Failed to connect: $err $errstr" . PHP_EOL);
		// Create the payload body
		$body['aps'] = array(
			'alert' => array(
			    'title' => 'GJEPC',
                'body' => $message,
                'badge' => 1
			 ),
			'sound' => 'default'
		);
		//print_r($body['aps']); exit;
		// Encode the payload as JSON
		$payload = json_encode($body);
		// Build the binary notification
		$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
		
		// Send it to the server
		$result = fwrite($fp, $msg, strlen($msg));
		
		// Close the connection to the server
		fclose($fp);
		return 1;
}
*/
function sentnotificationIos($deviceToken='',$message='')
{
        // Put your device token here (without spaces):
//$deviceToken = 'f8be6c6a6ace3bc14da7fb2f8ad9a3691aa9283dc822c06761f89ad2cd688517';

		//$message="GJEPC";
		$ctx = stream_context_create();
        $tCert = "https://gjepc.org/gjepc_mobile/Certificates.pem";
		
stream_context_set_option($ctx, 'ssl', 'local_cert', 'Certificates.pem');
stream_context_set_option($ctx, 'ssl', 'passphrase', '');
stream_context_set_option($ctx, 'ssl', 'verify_peer', false);


// Open a connection to the APNS server
$fp = stream_socket_client(
  'ssl://gateway.sandbox.push.apple.com:2195', $err,
  $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

if (!$fp)
  exit("Failed to connect: $err $errstr" . PHP_EOL);

//echo 'Connected to APNS' . PHP_EOL;

// Create the payload body
/*$body['aps'] = array(
  'alert' => $message,
    'badge' => '10',
    'sound' => 'newMessage.wav'  
  );
*/
  $body['aps'] = array(
			'alert' => array(
			    'title' => 'GJEPC',
                'body' => $message,
                'badge' => 1
			 ),
			'sound' => 'default'
		);
		
// Encode the payload as JSON
$payload = json_encode($body);

// Build the binary notification
$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
try {
    $result = fwrite($fp, $msg, strlen($msg));
} catch (Exception $ex) {
    sleep(1); //sleep for 5 seconds
    $result = fwrite($fp, $msg, strlen($msg));
}
// Close the connection to the server
fclose($fp);
return 1;
}
 
  function _custom_query($mysql_query) {
        $query = $this->mdl_notification->_custom_query($mysql_query);
        return $query;
    }
	
	
}
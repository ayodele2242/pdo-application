<?php

function web(){
	global $pdo;
    $setSql = 'SELECT * FROM store_setting';
    $setRes = $pdo->query($setSql);
    // fetch the next row
    $row = $setRes->fetch(PDO::FETCH_ASSOC);

    return $row;   
}

function currencyPosition(){
	global $pdo;
    $query = "SELECT * FROM currency_setting";
    $setRes = $pdo->query($query);
    // fetch the next row
    $row = $setRes->fetch(PDO::FETCH_ASSOC);
    return $row;   
}

$aget = currencyPosition();

if($aget['currency_position'] == "right"){
	$right_currency = $aget['currency'];
}else if($aget['currency_position'] == "right-space"){
	$right_currency = ' '.$aget['currency'];
}
else{
	$right_currency = "";
}


if($aget['currency_position'] == "left"){
	$left_currency = $aget['currency'];
}else if($aget['currency_position'] == "left-space"){
	$left_currency = $aget['currency'] .' ';
}else{
	$left_currency = "";
}



?>


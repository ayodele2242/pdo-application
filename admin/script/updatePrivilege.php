<?php
require_once("../../inc/admins.php");

if(empty($_POST['ucode']) && empty($_POST['module'])){
	echo "Select menu module";
}else{
$urole = $_POST['ucode'];
$suc = "";
$modules = $_POST['module'];

$failed_query = array(); // create an empty array to get which query fails
$failed_count = 0; // count to come to know how many query failed
$success_count = 0; // count to come to know how many query succeed

//Check if modules have already been assigned to this user in the database
$query = "SELECT rr_rolecode, rr_modulecode FROM role_rights WHERE rr_rolecode = '$urole' AND rr_modulecode IN ('".implode("','",$modules)."')";
$stmt = $pdo->prepare($query);
$stmt->execute();
$count = $stmt->rowCount();


if($count == 0){

	$rowCount = count($modules);
	for($i = 0; $i < $rowCount; $i++)
 { 
if(!empty($_POST['module'][$i])) {		
$module = $_POST['module'][$i];
}else{
	echo "Select menu module <br>";
	$failed_count++; // increase failed counter
}
if(!empty($_POST['create'][$i])){
$create = $_POST['create'][$i];	
}else{
	echo "Select create privilege for this module<br>";
	$failed_count++; // increase failed counter
}
if(!empty($_POST['edit'][$i])){
$edit = $_POST['edit'][$i];
}else{
	echo "Select edit privilege for this module<br>";
	$failed_count++; // increase failed counter
}
if(!empty($_POST['delete'][$i])){
$del = $_POST['delete'][$i];
}else{
	echo "Select delete privilege for this module<br>";
	$failed_count++; // increase failed counter
}
if(!empty($_POST['view'][$i])){
$view = $_POST['view'][$i];
}else{
	echo "Select view privilege for this module<br>";
	$failed_count++; // increase failed counter
}

  if(!empty($_POST['module'][$i]) && !empty($_POST['create'][$i]) && !empty($_POST['edit'][$i]) && !empty($_POST['delete'][$i]) && !empty($_POST['view'][$i])) {	

	$sql = "INSERT INTO role_rights(rr_rolecode,rr_modulecode,rr_create,rr_edit,rr_delete,rr_view) 
	VALUES('$urole', '$module','$create','$edit','$del','$view')";
	
	$pdo->exec($sql);
	$success_count++; // increase success counter

  }
}


}else{
	echo "You have already assigned ".implode(", ",$_POST['module'])." to this user";
	$failed_count++; // increase failed counter
}
	
if($success_count > $failed_count){
    echo "i";
 }
}



?>
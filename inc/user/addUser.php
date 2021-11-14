<?php
require_once("../functions.php");

$name = trim($_POST['name']);
$email = trim($_POST['email']);
$phone = trim($_POST['phone']);
$username = trim($_POST['username']);
$password = $_POST['password'];
$pass = encryptIt($password);
$sta =  $_POST['status'];
//$role = $_POST['urole'];

$module = $_POST['module'];

$u_me = strtoupper($username);

if($name !="" && $email !="" && $phone !="" && $sta !=""  && $username != "" && $password != "") {

 try {

//get if user already exist in db
$query = "SELECT u_username from system_users WHERE u_username =:username";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':username', $username, PDO::PARAM_STR);
$stmt->execute();
$count = $stmt->rowCount();
$row   = $stmt->fetch(PDO::FETCH_ASSOC);

if($count < 1 ) {

//Check if modules have already been assigned to this user in the database
$query = "SELECT rr_rolecode, rr_modulecode FROM role_rights WHERE 
rr_rolecode = '$username' 
AND rr_modulecode IN ('".implode("','",$_POST['module'])."')";

$stmt = $pdo->prepare($query);
$stmt->execute();
$count = $stmt->rowCount();

if($count > 0){
	echo "You have already assigned ".implode(", ",$_POST['module'])." to this user";
}else{
 // "We can insert now";

 try {
	//$pdo->beginTransaction(); 

	$sql = 
	"INSERT INTO system_users (
		Name,
		u_username,
		u_password,
		email,
		phone,
		u_rolecode,
		status
		)VALUES (
		'$name',
		'$username',
		'$pass',
		'$email',
		'$phone',
		'$u_me',
		'$sta')"; 

		$pdo->exec($sql);
		echo "i";

		if(!empty($_POST['module'])){
			$rowCount = count($_POST['module']);
			
			for($i = 0; $i < $rowCount; $i++)
			 { 		
			$module = $_POST['module'][$i];
			$edit = $_POST['edit'][$i];
			$view = $_POST['view'][$i];
			$create = $_POST['create'][$i];
			$del = $_POST['delete'][$i];
			
			 
			$sql = "INSERT INTO role_rights(rr_rolecode,rr_modulecode,rr_create,rr_edit,rr_delete,rr_view) 
			VALUES('$u_me', '$module','$create','$edit','$del','$view')";
			
			$pdo->exec($sql);
						
			 }
			}

	
 }catch(PDOException $e) {
	echo $sql . "<br>" . $e->getMessage();
  }

}

    
}else{
    echo "Username already exist in the database.";
}



}catch (PDOException $e) {
$json['status'] = false;
$json['message'] = 'Error : '.$e->getMessage();;
}

}else{
	echo "Emptied value(s) sent";
}


?>
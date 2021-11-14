<?php

require_once("../../inc/admins.php");
 
 //if(isset($_POST['id'])){
//Retrieve form data. 
$id= $_POST['id'];
$email=$_POST['email'];
$phone = $_POST['phone'];

if($id !="" && $email !="" && $phone !=""){
 

try {
//update database and and echo 1 for success 
$sql = "UPDATE system_users SET email=:email, phone=:phone WHERE u_userid=:id";


$statement = $pdo->prepare($sql);
$statement->bindParam(':id', $id, PDO::PARAM_INT);
$statement->bindParam(':email', $email, PDO::PARAM_STR);
$statement->bindParam(':phone', $phone, PDO::PARAM_STR);

// execute the UPDATE statment
if ($statement->execute()) {
	echo 1;
}

} catch (PDOException $e) {
    echo 'Error : '.$e->getMessage();;
} 
 

}else{
	echo "Check for empty input value(s)";
}



?>
 
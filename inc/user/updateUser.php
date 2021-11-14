<?php

require_once("../functions.php");
 
//Retrieve form data. 
$id=$_POST['id'];
$email=$_POST['email'];
$phone = "phone";

 
 
//update database and and echo 1 for success 
try {

$sql = "UPDATE system_users SET email=:email, phone=:phone where u_userid=:id";
    
    // prepare statement
    $statement = $pdo->prepare($sql);
    // bind params
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
	$statement->bindParam(':phone', $phone, PDO::PARAM_STR);

	if ($statement->execute()) {
        echo 1;
    }


} catch (PDOException $e) {
    echo 'Error : '.$e->getMessage();
} 


?>
 
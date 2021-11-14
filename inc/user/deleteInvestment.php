<?php

require_once("../admins.php");
 
//Retrieve form data. 
$id=$_POST['id'];



 try {
	//delete admin details from system users table
	$sql = "DELETE FROM plans where id=:id";
	$stmt = $pdo->prepare($sql);
	// bind params
	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	if ($stmt->execute()) {
		echo 1;
	}
	
	
	} catch (PDOException $e) {
		echo 'Error : '.$e->getMessage();;
	} 



?>
 
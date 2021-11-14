<?php

require_once("../../inc/admins.php");
 
//Retrieve form data. 
$id=$_POST['id'];

try {
//delete admin details from system users table
$sql = "DELETE FROM system_users WHERE u_rolecode=:id";
$stmt = $pdo->prepare($sql);
// bind params
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
if ($stmt->execute()) {

//delete all privileges for this admin
$sql = "DELETE FROM role_rights WHERE rr_rolecode=:id";
$statement = $pdo->prepare($sql);
// bind params
$statement->bindParam(':id', $id, PDO::PARAM_INT);
if ($statement->execute()) {
	echo 1;
}

}


} catch (PDOException $e) {
    echo 'Error : '.$e->getMessage();;
} 
 
 

?>
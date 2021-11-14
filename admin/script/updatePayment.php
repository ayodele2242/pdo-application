<?php

require_once("../../inc/admins.php");
 
$id=$_POST['id'];
$transid=$_POST['transid'];
$status = $_POST['status'];

try {
 
//update database and and echo 1 for success 
$sql = "UPDATE plans SET transId=:trxid, status=:sta, trasaction_status=:status WHERE id=:id";
 

$statement = $pdo->prepare($sql);
$statement->bindParam(':id', $id, PDO::PARAM_INT);
$statement->bindParam(':trxid', $transid, PDO::PARAM_STR);
$statement->bindParam(':status', 'active');
$statement->bindParam(':status', $status, PDO::PARAM_STR);

// execute the UPDATE statment
if ($statement->execute()) {
	echo 1;
}


} catch (PDOException $e) {
    echo 'Error : '.$e->getMessage();;
} 



?>
 
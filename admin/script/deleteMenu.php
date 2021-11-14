<?php

require_once("../../inc/admins.php");
 
//Retrieve form data. 
$id=$_POST['id'];

try {



//delete all privileges for this admin
$sql = "DELETE FROM role_rights where id=:id";
$statement = $pdo->prepare($sql);
// bind params
$statement->bindParam(':id', $id, PDO::PARAM_INT);
// execute the UPDATE statment
if ($statement->execute()) {
	echo 1;
}


} catch (PDOException $e) {
    echo 'Error : '.$e->getMessage();;
} 
 
 

?>
 
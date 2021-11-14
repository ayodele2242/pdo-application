<?php 

require_once('../admins.php'); 



$id = $_POST['member_id'];



//Let check if this package has investors on it

$query = "select loan_id from loan_disburse where loan_id = :id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':id', $id, PDO::PARAM_STR);
$stmt->execute();
$count = $stmt->rowCount();


if($count > 0){
	echo "You can't delete this loan product; there is already active loan on it.";
}else{


	try {
		
		$sql = "DELETE FROM loans_packages where id=:id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		
		if ($stmt->execute()) {
			echo 1;
		}
		

		} catch (PDOException $e) {
			echo 'Error : '.$e->getMessage();;
		} 

}

// close database connection
$pdo = null;


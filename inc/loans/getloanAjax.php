<?php
require_once '../admins.php';

header('Content-type: application/json; charset=utf-8');




if($_REQUEST['id']) {



	$sql = "SELECT id, name, interest, duration, amount, late_interest FROM loans_packages WHERE id=:id";
	
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $_REQUEST['id'], PDO::PARAM_INT);
    $stmt->execute();

	$data = array();
	while (($rows = $stmt->fetch(PDO::FETCH_ASSOC)) !== false) {
		$data = $rows;
	}
	echo json_encode($data);
} else {
	echo 0;	
}




?>
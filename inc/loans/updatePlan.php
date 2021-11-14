<?php
	require_once('../functions.php');




if(!empty($_POST['name']) && !empty($_POST['interest_rate']) && !empty($_POST['duration']) && !empty($_POST['amount']) && !empty($_POST['late_interest'])){
	$id = $_POST['id'];

	$name=$_POST['name'];
	$percent=$_POST['interest_rate'];
	$late=$_POST['late_interest'];
	$duration=$_POST['duration'];
	$amt=$_POST['amount'];
	$descr = $_POST['info'];

	$b = str_replace( ',', '', $amt );

	if( is_numeric( $b ) ) {
	    $a = $b;
	}


	try {

		$sql = "UPDATE loans_packages SET name = :name,interest = :percent,duration = :duration,
		amount = :a,late_interest = :late,details = :descr WHERE id = :id";
			
			// prepare statement
			$statement = $pdo->prepare($sql);
			// bind params
			$statement->bindParam(':id', $id, PDO::PARAM_INT);
			$statement->bindParam(':name', $name, PDO::PARAM_STR);
			$statement->bindParam(':percent', $percent, PDO::PARAM_STR);
			$statement->bindParam(':duration', $duration, PDO::PARAM_STR);
			$statement->bindParam(':a', $a, PDO::PARAM_STR);
			$statement->bindParam(':late', $late, PDO::PARAM_STR);
			$statement->bindParam(':descr', $descr, PDO::PARAM_STR);
		
			if ($statement->execute()) {
				echo 1;
			}
		
		
		} catch (PDOException $e) {
			echo 'Error : '.$e->getMessage();
		} 
	

    
}else{
	echo "Check for empty values";
}
?>
<?php
	require_once('../functions.php');




if(!empty($_POST['name']) && !empty($_POST['interest_rate']) && !empty($_POST['duration']) && !empty($_POST['amount']) && !empty($_POST['late_interest'])){
	
	
	
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


	try{

		//We start our transaction.
		$pdo->beginTransaction();
	

		$sql = "INSERT INTO loans_packages(name,interest,duration,amount,late_interest,details)
		values(?,?,?,?,?,?)";


		$stmt = $pdo->prepare($sql);
		$stmt->execute(array(
				$name,
				$percent,
				$duration,
				$a,
				$late,
				$descr
			)
		);
		
		
		
		
		$pdo->commit();

		echo "done";
		
	} 
	//Our catch block will handle any exceptions that are thrown.
	catch(Exception $e){
		//An exception has occured, which means that one of our database queries
		//failed.
		//Print out the error message.
		echo $e->getMessage();
		//Rollback the transaction.
		$pdo->rollBack();
	}
	


    
}else{
	echo "Check for empty values";
}
?>
<?php
require_once('../functions.php');



/*if(!empty($_POST['email']) && !empty($_POST['interest_rate']) && !empty($_POST['loantype']) && !empty($_POST['amount']) && !empty($_POST['status']) && !empty($_POST['frequency'])){*/

//check if email exist for member





	$id = $_POST['loan_id'];
	$success_count = 0;
	

	$query = "SELECT * FROM loans_packages WHERE id =:ID";
	$stmt = $pdo->prepare($query);
	$stmt->bindParam(':ID', $id, PDO::PARAM_INT);
	$stmt->execute();
	$count = $stmt->rowCount();
	$row   = $stmt->fetch(PDO::FETCH_ASSOC);



	$amount = $_POST['amount'];
	$interest = $_POST['interest_rate'];
    $months = $_POST['duration'];
    $frequency = $_POST['frequency'];
    $email = $_POST['email'];
    $status = $_POST['status'];
    $freq = $_POST['frequency'];
//divisor
		switch ($_POST['frequency']) {
			case 'Monthly':
				$divisor = 1;
				$days = 30;
				break;
			case '2 Weeks':
				$divisor = 2;
				$days = 15;
				break;
			case 'Weekly':
				$divisor = 4;
				$days = 7;
				break;
		}



		$chec = "select email from members WHERE email=:email";
		
		$stmts = $pdo->prepare($query);
		$stmts->bindParam(':email', $email, PDO::PARAM_STR);
		$stmts->execute();
		$countMe = $stmts->rowCount();
		



		if($countMe > 0){

	//interest
		//$amount_interest = $amount * ($interest/100)/$divisor;
		$amount_interest = round($amount / 100 * $interest)/$divisor;
//$totalAmt = $amt + $interestdue;
		
		//total payments applying interest
		$amount_total = $amount + $amount_interest * $divisor;
		
		//payment per term
		$amount_term = number_format(round($amount_total / ($months * $divisor), 2));
		
		$date = date("Y-m-d");
		


      $query = "";

      //check if borrower haven't finished paying loan for this category

      $mque = "select * from loan_disburse where email = :email and loan_id=:id and status=:active";

	  $stm = $pdo->prepare($mque);
	  $stm->bindParam(':email', $email, PDO::PARAM_STR);
	  $stm->bindParam(':id', $id, PDO::PARAM_INT);
	  $stm->bindParam(':active', 'active');
	  $stm->execute();
	  $countIt = $stm->rowCount();

      
      if($countIt > 0){
      	echo "Loan can not be granted for this customer on this loan category. The customer is yet to pay up";
      }else{
        

		for ($i = 1; $i <= $months * $divisor; $i++)
		{
			$frequency = $days * $i;
			$newdate = strtotime ('+'.$frequency.' day', strtotime($date)) ;
			//check if payment date landed on weekend
			//if Sunday, make it Monday. If Saturday, make it Friday
			if(date('D', $newdate) == 'Sun') {
				$newdate = strtotime('+1 day', $newdate) ;
			} elseif(date ('D' , $newdate) == 'Sat') {
				$newdate = strtotime('-1 day', $newdate) ;
			}
			
			$newdate = date('Y-m-d', $newdate);

			$dateArr[] =  $newdate;
			//$table = $table . '<tr><td>'.$i.'</td><td>'.$amount_term.'</td><td>'.$newdate.'</td></tr>';

		

		$sql = "insert into loans_payment_schedule(email,loan_id,payment_schedule,amount)
		values(?,?,?,?)";


		$stmt = $pdo->prepare($sql);
		$stmt->execute(array(
			$email,
			$id,
			$newdate,
			$amount_term
			)
		);
		$success_count++;

		}
		//$table = $table . '</table></div>';
		
		//echo $table;
if($success_count > 0){ 
    
      //get next payment id
	  $qg = "select id from loans_payment_schedule where loan_id =:id 
	  and email =:email and status =:unpaid and payment_schedule = (SELECT MIN(payment_schedule) FROM loans_payment_schedule) "; 

	  $stmts = $pdo->prepare($qg);
	  $stmts->bindParam(':id', $id, PDO::PARAM_INT);
	  $stmts->bindParam(':email', $email, PDO::PARAM_STR);
	  $stmts->bindParam(':unpaid', 'unpaid');
	  $stmts->execute();
	  $countMe = $stmts->rowCount();
	  $idget = $stmt->fetch(PDO::FETCH_ASSOC);



      $next_payment_id = $idget['id'];

    $max = min(array_map('strtotime', $dateArr));
    $next_payment_date = date('Y-m-d', $max);


	$sql = "INSERT INTO loan_disburse(email,loan_id,amt_borrowed,interest,
	total,loan_amount_term,frequency,next_payment_id,status)VALUES(:email,:id,:amount,:amountinterest,
	:amount_total,:months,:freq,:next_payment_id,:status)";

	$statement = $pdo->prepare($sql);
	$statement->bindParam(':id', $id, PDO::PARAM_INT);
	$statement->bindParam(':email', $email, PDO::PARAM_STR);
	$statement->bindParam(':amount', $amount, PDO::PARAM_STR);
	$statement->bindParam(':amountinterest', $amount_interest, PDO::PARAM_STR);
	$statement->bindParam(':amount_total', $amount_total, PDO::PARAM_STR);
	$statement->bindParam(':months', $months, PDO::PARAM_STR);
	$statement->bindParam(':freq', $freq, PDO::PARAM_STR);
	$statement->bindParam(':next_payment_id', $next_payment_id, PDO::PARAM_INT);
    
	if($statement->execute()){
		echo "done";
		//update loan schedule
		$getid = $pdo->lastInsertId();
		$unpaid = "unpaid";

		$sql = 'UPDATE loans_payment_schedule
        SET oan_disburse_id = :id
        WHERE email=:email and status = :unpaid';
	
		$statement = $pdo->prepare($sql);
		$statement->bindParam(':id', $id, PDO::PARAM_INT);
		$statement->bindParam(':email', $email, PDO::PARAM_STR);
		$statement->bindParam(':unpaid', $unpaid);

	



	}else{
		echo "Error occured while disbursing. Try again.";
	}

}else{
	echo "Error occured. Try again.";
}

/*}else{
	echo "Check for empty values";
}*/

//print_r($dateArr);

}

}else{
	echo "That email does not exist in the database. Please add member details before issuing loan.";
}

?>

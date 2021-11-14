<?php
require_once('../admins.php');



/*if(!empty($_POST['email']) && !empty($_POST['interest_rate']) && !empty($_POST['loantype']) && !empty($_POST['amount']) && !empty($_POST['status']) && !empty($_POST['frequency'])){*/

	$id = $_POST['loan_id'];

	$sql = "select * from loans_packages where id=:id";
	$stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

	$row = $stmt->fetch(PDO::FETCH_ASSOC);

	$amount = $_POST['amount'];
	$interest = $_POST['interest_rate'];
    $months = $_POST['duration'];
    $frequency = $_POST['frequency'];

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

	//interest
		//$amount_interest = $amount * ($interest/100)/$divisor;
		$amount_interest = round($amount / 100 * $interest)/$divisor;
//$totalAmt = $amt + $interestdue;
		
		//total payments applying interest
		$amount_total = $amount + $amount_interest * $divisor;
		
		//payment per term
		$amount_term = number_format(round($amount_total / ($months * $divisor), 2));
		
		$date = date("Y-m-d");
		
		//Loan info
		$table = '<div id="calculator" class="card p-5"><h3>Loan Info</h3>';
		$table = $table . '<table cellpadding="5" cellspacing="0" class="table table_view mb-3 mt-2">';
		$table = $table . '<tr><td>Loan Name:</td><td>'.$row['name'].'</td></tr>';
		$table = $table . '<tr><td>Interest:</td><td>'.$interest.'%</td></tr>';
		$table = $table . '<tr><td>Terms:</td><td>'.$months * $divisor.'</td></tr>';
		$table = $table . '<tr><td>Frequency:</td><td>Every '.$_POST['frequency'].' days</td></tr>';
		$table = $table . '<tr><td>Loan Amount:</td><td> '.number_format($amount, 2, '.', ',').'</td></tr>';
		$table = $table . '<tr><td>Total Interest:</td><td> '. number_format($amount_interest*$divisor, 2, '.', ',').'</td></tr>';
		$table = $table . '<tr><td colspan="2"><h3>Computation</h3></td></tr>';
		$table = $table . '<tr><td>Amount Per Term:</td><td> '. $amount_term.'</td></tr>';
		$table = $table . '<tr><td>Total Payment:</td><td> '. number_format($amount_total, 2, '.', ',').'</td></tr>';
		$table = $table . '</table>';
		$table = $table . '';
		
		$table = $table . '<table cellpadding="5" class="table table_view mb-3 mt-4">';
		$table = $table . '<tr><td>#ID</td><td>Amount </td><td>Next Payment Date</td></tr>';
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
			$table = $table . '<tr><td>'.$i.'</td><td>'.$amount_term.'</td><td>'.$newdate.'</td></tr>';
		}
		$table = $table . '</table></div>';
		
		echo $table;



/*}else{
	echo "Check for empty values";
}*/



?>

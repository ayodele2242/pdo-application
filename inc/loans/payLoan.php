
<?php
 require_once '../admins.php';

 
 if (isset($_REQUEST['id'])) {
   
 $id = intval($_REQUEST['id']);
 $loanid = $_REQUEST['loanid'];
 $email = $_REQUEST['email'];
 $date = date("Y-m-d");

 $status = "paid";



 
 try {
  $pdo->beginTransaction();

  $sql = "UPDATE loans_payment_schedule SET payment_date=:date, status = :sta WHERE id=:id";
      

      $statement = $pdo->prepare($sql);
      $statement->bindParam(':id', $id, PDO::PARAM_INT);
      $statement->bindParam(':date', $date, PDO::PARAM_STR);
      $statement->bindParam(':sta', $status, PDO::PARAM_STR);
  
    if ($statement->execute()) {
          echo 1;

        	$query = "SELECT DISTINCT c.*,  ld.amt_borrowed, ld.interest,ld.total, ld.id as aloan_id,
    m.name, m.phone, l.name as loan_type,l.duration 
    FROM loan_disburse ld
    INNER JOIN members m ON m.email = ld.email
    INNER JOIN loans_packages l ON l.id = ld.loan_id
    INNER JOIN loans_payment_schedule c ON c.loan_id =ld.loan_id
      INNER JOIN
    (
        SELECT  MIN(payment_schedule) maxDate
        FROM loans_payment_schedule WHERE status='unpaid'
        
    ) b ON 
            c.payment_schedule = b.maxDate
    WHERE ld.status = 'active' 
    and c.loan_id=:loanid 
    and c.email=:email";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':loanid', $loanid, PDO::PARAM_INT);
$stmt->bindParam(':email', $email, PDO::PARAM_STR);
$stmt->execute();
$count = $stmt->rowCount();

if($count < 1){
  $sql = "UPDATE loan_disburse SET status = :paid 
  WHERE email = :email 
  and loan_id = :loanid 
  and status=:active ";

$statement = $pdo->prepare($sql);
$statement->bindParam(':paid', 'paid');
$statement->bindParam(':email', $email, PDO::PARAM_STR);
$statement->bindParam(':loanid', $loanid, PDO::PARAM_INT);
$statement->bindParam(':active', 'active');



}

      }
  
  

      $pdo->commit();

  } catch (PDOException $e) {
      echo 'Error : '.$e->getMessage();
      $pdo->rollBack();
  } 
  


}



 ?>
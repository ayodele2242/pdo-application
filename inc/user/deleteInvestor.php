<?php

require_once("../admins.php");
 
//Retrieve form data. 
$id=$_POST['id'];


//get investor email first


$query = "select email from members where id = :id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':id', $id, PDO::PARAM_STR);
$stmt->execute();
$count = $stmt->rowCount();

if($count < 1){
    echo "No result exist in the database for this user";
}else{
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $email = $row['email'];
    $status = "active";
    $paymentStatus = "successful";

    $query = "select * from plans where email = :email and status = :sta and payment_status = :pstatus";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':sta', $status, PDO::PARAM_STR);
    $stmt->bindParam(':pstatus', $paymentStatus, PDO::PARAM_STR);
    $stmt->execute();
    $getc = $stmt->rowCount();

    if($getc > 0){
        echo "You cannot delete this account. There\'s an active investment on the account";
     }else{

        try {
            //delete user details from members users table
            $sql = "DELETE FROM members where id=:id";
            $stmt = $pdo->prepare($sql);
            // bind params
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            
            //delete all plans for this user
            $sql = "DELETE FROM plans where email=:email";
            $statement = $pdo->prepare($sql);
            // bind params
            $statement->bindParam(':email', $email, PDO::PARAM_INT);


            if ($statement->execute() && $stmt->execute()) {
                echo 1;
            }
            
            
            
            
            } catch (PDOException $e) {
                echo 'Error : '.$e->getMessage();;
            } 


     }

}
	


?>
 
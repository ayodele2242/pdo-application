<?php
require_once("../admins.php");

if (isset($_POST['id']) and isset($_POST['sta'])){
    $id = $_POST['id'];
    $sta = $_POST['sta'];

    try {

    $sql = "UPDATE system_users SET status = :sta WHERE u_userid = :id";
    
    // prepare statement
    $statement = $pdo->prepare($sql);
    // bind params
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->bindParam(':sta', $sta, PDO::PARAM_STR);
   
    // execute the UPDATE statment
    if ($statement->execute() && $sta == 1) {
        echo 1;
    }else if ($statement->execute() && $sta == 0) {
        echo 0;
    }

} catch (PDOException $e) {
    echo 'Error : '.$e->getMessage();;
} 

}




?>
<?php
require_once '../../inc/functions.php';




$to = $_POST['to'];
$message = $_POST['message'];

$reciverid = $_POST['reciverid'];
$sendername = $_POST['sendername'];
$senderusername = $_POST['senderusername'];


if ($_FILES['files']['name']) {
 
    $name = md5(rand(100, 200));
    $ext = explode('.', $_FILES['file']['name']);
    $filename = $name . '.' . $ext[1];
    $destination = '../../assets/images/' . $filename; //change this directory
    $location = $_FILES["file"]["tmp_name"];
    move_uploaded_file($location, $destination);
    //echo 'images/' . $filename;//change this URL
 
}else{
	$filename = "";
}


try {

$sql = 'INSERT INTO messages(receiver_id, receiver_name, sender_uname, sender_name, msg, img) 
VALUES(:reciverid,:to,:senderusername,:sendername,:message,:filename)';

$statement = $pdo->prepare($sql);
$statement->bindParam(':reciverid', $reciverid, PDO::PARAM_INT);
$statement->bindParam(':to', $to, PDO::PARAM_STR);
$statement->bindParam(':senderusername', $senderusername, PDO::PARAM_STR);
$statement->bindParam(':sendername', $sendername, PDO::PARAM_STR);
$statement->bindParam(':message', $message, PDO::PARAM_STR);
$statement->bindParam(':filename', $filename, PDO::PARAM_STR);



if($statement->execute()){
    echo 'done';
}

} catch (PDOException $e) {
    echo 'Error : '.$e->getMessage();
} 






?>
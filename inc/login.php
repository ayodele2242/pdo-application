<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


require_once 'functions.php';
//var_dump($pdo);

$username = trim($_POST['username']);
$password = trim($_POST['password']);

$json = [];

if($username != "" && $password != "") {
$pwd = encryptIt($password);

try {
	$query = "
	SELECT * FROM system_users 
	WHERE 
	:login IN (u_username, email)
	AND
	u_password=:password";

	$stmt = $pdo->prepare($query);
	$stmt->bindValue(':login', $username, PDO::PARAM_STR);
	$stmt->bindValue(':password', $pwd, PDO::PARAM_STR);
	$stmt->execute();
	$count = $stmt->rowCount();
	$row   = $stmt->fetch(PDO::FETCH_ASSOC);


	if($count == 1 && !empty($row)) {
	  if($row['status']=='1'){

		$json['status'] = 'success';
		$_SESSION['uid'] = $row['u_userid'];
		$name            = $row['Name'];
		$user_ip 		 = getUserIP();
		$time 			 = time();
		$id 			 = $_SESSION['uid'];

		$sql = 'INSERT INTO logs(uid,name,action,ipAddress,etime) VALUES(:id, :name, :detail, :uip, :time)';
		$statement = $pdo->prepare($sql);
		$statement->execute([
			':id' => $id,
			':name' => $name,
			':detail' => 'Logged In',
			':uip' => $user_ip,
			':time' => $time
		]);


	}else if($row['status'] == '0'){
		$json['status'] = false;
		$json['message'] = 'Your account is in-active at the moment. Contact the admin for further details.';
	}else if($row['status'] == '2'){
		$json['status'] = false;
	    $json['message'] = 'Your account is suspended at the moment. Contact the admin for further details.';
	}

	
	 
	} else {
		$json['status'] = false;
		$json['message'] = 'Invalid login details entered';
	}
  } catch (PDOException $e) {
	$json['status'] = false;
    $json['message'] = 'Error : '.$e->getMessage();;
  }


}else {
    $json['status'] = false;
    $json['message'] = 'Both fields are required';
  }

  $pdo=null;

  echo json_encode($json);
?>
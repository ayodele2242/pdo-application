<?php

require_once("../../inc/admins.php");



 
 if(!empty($_POST['name']) && !empty($_POST['percentage']) && !empty($_POST['duration']) && !empty($_POST['amount'])){

	$name=$_POST['name'];
	$percent=$_POST['percentage'];
	$duration=$_POST['duration'];
	$amt=$_POST['amount'];

	$id = $_POST['id'];

	$pimg = $_POST['pimg'];


if (!empty($_FILES['image']['name'])) {
/* Getting file name */
$filename = $_FILES['image']['name'];

/* Location */
$location = "../../assets/images/".$filename;
$uploadOk = 1;
$imageFileType = pathinfo($location,PATHINFO_EXTENSION);

/* Valid Extensions */
$valid_extensions = array("jpg","jpeg","png");
/* Check file extension */
if( !in_array(strtolower($imageFileType),$valid_extensions) ) {
   $uploadOk = 0;
   echo "Invalid image uploaded<br/>";
}

if($uploadOk == 0){
   echo "Error updating image";
}else{
   /* Upload file */
   move_uploaded_file($_FILES['image']['tmp_name'],$location);
      //echo $location;
   }
}else{
	$filename = $pimg;
}
	

    $query = "SELECT * FROM plans WHERE plan_id = :id";
	$stmt = $pdo->prepare($query);
	$stmt->bindParam(':id', $id, PDO::PARAM_STR);
	$stmt->execute();
	$count = $stmt->rowCount();


    if ($count == 0) {
		
try {
	//update database and and echo 1 for success 
	$sql = "UPDATE farm_packages 
	SET category=:cat,percent=:percent,duration=:duration,
	capital=:amt,img=:img 
	WHERE id=:id";
       

	$statement = $pdo->prepare($sql);
	$statement->bindParam(':id', $id, PDO::PARAM_INT);
	$statement->bindParam(':cat', $name, PDO::PARAM_STR);
	$statement->bindParam(':percent', $percent, PDO::PARAM_STR);
	$statement->bindParam(':duration', $duration, PDO::PARAM_STR);
	$statement->bindParam(':amt', $amt, PDO::PARAM_STR);
	$statement->bindParam(':img', $filename, PDO::PARAM_STR);
	
	// execute the UPDATE statment
	if ($statement->execute()) {
		echo 1;
	}
	
	} catch (PDOException $e) {
		echo 'Error : '.$e->getMessage();;
	} 

	
    }else{
		echo "You can not update this plan. Investors are already on it";
    }
}else{
	echo "Check for empty values";
}


?>
 
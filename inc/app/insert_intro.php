<?php
	require_once('../admins.php');

	
if(!empty($_POST['info'])){
	
	$descr = $_POST['info'];
	$title = $_POST['title'];


if (!empty($_FILES['image'])) {
/* Getting file name */
$filename = $_FILES['image']['name'];

/* Location */
$location = "../../assets/images/".$filename;
$uploadOk = 1;
$imageFileType = pathinfo($location,PATHINFO_EXTENSION);

/* Valid Extensions */
$valid_extensions = array("jpg","jpeg","png","mp4");
/* Check file extension */
if( !in_array(strtolower($imageFileType),$valid_extensions) ) {
   $uploadOk = 0;
   echo "Invalid image uploaded";
}

if($uploadOk == 0){
   echo "Error updating image";
}else{
   /* Upload file */
   move_uploaded_file($_FILES['image']['tmp_name'],$location);
      //echo $location;
   }
}else{
	$filename = "";
}


	$query = "SELECT * FROM app_intro_page WHERE title = :title";
	$stmt = $pdo->prepare($query);
	$stmt->bindParam('title', $title, PDO::PARAM_STR);
	$stmt->execute();
	$count = $stmt->rowCount();



    if ($count < 1) {

		try {
			$pdo->beginTransaction();

			$sql = 'INSERT INTO app_intro_page(title,info,images) 
            VALUES(:title, :info, :img)';

			$statement = $pdo->prepare($sql);

			$statement->bindParam(':title', $title, PDO::PARAM_STR);
			$statement->bindParam(':info', $descr, PDO::PARAM_STR);
			$statement->bindParam(':img', $filename, PDO::PARAM_STR);
			
			$statement->execute();


		// commit the transaction
	      $pdo->commit();
		} catch (\PDOException $e) {
			// rollback the transaction
			$pdo->rollBack();

			// show the error message
			die($e->getMessage());
		}


    	$sql = "INSERT INTO app_intro_page(title,info,images)values('$title','$descr','$filename')";
	$done =	mysqli_query($mysqli, $sql);

	if($done){
		echo "done";
	}else{
		echo $mysqli->error;
	}



    }else{
		echo "App intro with this content already exist";
    }
}else{
	echo "Check for empty values";
}
?>
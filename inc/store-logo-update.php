<?php
include_once 'admins.php';

if(is_array($_FILES)) {
	
	    $imgFile = $_FILES['userImage']['name'];
		$tmp_dir = $_FILES['userImage']['tmp_name'];
		$imgSize = $_FILES['userImage']['size'];
		//$user = $_POST['user'];
		
			
			$upload_dir = '../assets/logo/'; // upload directory
	
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
		
			// valid image extensions
			$valid_extensions = array('jpeg', 'jpg', 'png');
		
			// rename uploading image
			$userpic = rand(1000,1000000).".".$imgExt;
			$pic = clean($userpic);
				
			// allow valid image file formats
			if(!in_array($imgExt, $valid_extensions)){
				echo "0";
			}
			elseif(in_array($imgExt, $valid_extensions)){			
				// Check file size '1MB'
				if($imgSize <= 1000000)	{
					move_uploaded_file($tmp_dir,$upload_dir.$pic);
					?>
					<img src="../assets/logo/<?php echo $pic; ?>" width="200px" height="200px" class="upload-preview" />

					<?php

				
try {

	$sql = "UPDATE store_setting set logo = :pic";
		
		// prepare statement
		$statement = $pdo->prepare($sql);
		// bind params
		
		$statement->bindParam(':pic', $pic, PDO::PARAM_STR);
		
	
		if ($statement->execute()) {
			echo "1";
		}
	
	
	} catch (PDOException $e) {
		echo 'Error : '.$e->getMessage();
	} 
				
                
				

				}
				
			}
		
	

	
	
	
	
	
	
	
	
	

}
?>
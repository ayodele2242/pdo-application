<?php
require_once("../config.php"); 


if(!empty($_POST["country_id"])){
    //Fetch all state data
    $query = "SELECT name FROM states WHERE country_id = :id ORDER BY name ASC";
   
	$stmt = $pdo->prepare($query);
	$stmt->bindParam(':id', $_POST["country_id"], PDO::PARAM_STR);
	$stmt->execute();
	$rowCount = $stmt->rowCount();
    
    
   
    
    //State option list
    if($rowCount > 0){
        echo '<option value="">Select state</option>';
        while (($row = $stmt->fetch(PDO::FETCH_ASSOC)) !== false) {
            echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';
        }
    }else{
        echo "Nothing to fetch";
    }
}else if(!empty($_POST["state_id"])){
    //Fetch all city data
    $query = "SELECT * FROM cities WHERE state_id = :stateid AND status = :id ORDER BY city_name ASC";
   
	$stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', 1, PDO::PARAM_INT);
	$stmt->bindParam(':stateid', $_POST["country_id"], PDO::PARAM_STR);
	$stmt->execute();
	$rowCount = $stmt->rowCount();

   
    
    //City option list
    if($rowCount > 0){
        echo '<option value="">Select city</option>';
        while (($row = $stmt->fetch(PDO::FETCH_ASSOC)) !== false) {
            echo '<option value="'.$row['city_id'].'">'.$row['city_name'].'</option>';
        }
    }else{
        echo '<option value="">City not available</option>';
    }
}

?>
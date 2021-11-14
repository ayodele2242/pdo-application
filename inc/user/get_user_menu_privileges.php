<?php
include '../admins.php';

$id = $_GET["id"];

$query = "SELECT rr_modulecode FROM role_rights WHERE rr_rolecode = :id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':id', $id, PDO::PARAM_STR);
$stmt->execute();
$count = $stmt->rowCount();

if ($count  > 0) { ?>
<ul>
 
 <?php while (($row = $stmt->fetch(PDO::FETCH_ASSOC)) !== false) {  ?>
  <li class=''><?php echo $row['rr_modulecode'] ?></li>  
 <?php } ?>

</ul>
<?php

}else{
  echo "Nothing to show";
}
?>
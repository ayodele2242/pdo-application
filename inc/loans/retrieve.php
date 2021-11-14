<?php 
require_once('../admins.php'); 


$output = array('data' => array());




$stmt = $pdo->query("SELECT * FROM farm_packages order by id desc");


$x = 1;
while ($row = $stmt->fetch()) {
 
	
	

	$actionButton = '
	<a  type="button" id="'.$row['id'].'" data-name="'.$row['category'].'"  class="btn btn-floating waves-effect waves-light green z-depth-4 btn-small editPro " onclick="updatePackage('.$row['id'].')"> <i class="material-icons left">edit</i>
    </a>	

	<a href="#menuModal" type="button" data-toggle="modal"  class="btn btn-floating waves-effect waves-light red z-depth-4 btn-small  modal-trigger" onclick="removePackage('.$row['id'].')"> <i class="material-icons left">delete</i>
    </a>	
	';
	
	$output['data'][] = array(
		$x,
		$row['category'],
		$row['duration'],
		$row['percent'].'%',
		
		number_format($row['capital']),	
		$actionButton
	);

	$x++;
}

// database connection close
$pdo = null;

echo json_encode($output);
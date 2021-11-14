<?php
		
		include('functions.php');
		
	        
		// execute a query -> fetch website settings
		$setSql = 'SELECT * FROM store_setting';
		$setRes = $pdo->query($setSql);
		// fetch the next row
		$set = $setRes->fetch(PDO::FETCH_ASSOC)
			
?>
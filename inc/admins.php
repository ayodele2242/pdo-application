<?php
//session_start();
require "functions.php";
if(!isset($_SESSION['uid'])){
    //redirect('auth/auth');
    echo "Hello";
}else{ 
//error_reporting(0);	
require "userFunctions.php";
require "website_info.php";
$web = web();
$current_page = getCurrentPage();
$cname = $web['country'];




$msgBox = '';
$activeAccount = '';
$nowActive = '';  
$neverText = '';

$t = date("Y-m-d H:i:s");
$tv = time(); 
$id = $_SESSION['uid'];


//Get admin details on login in
try {
	$query = "
	SELECT * FROM system_users 
	WHERE 
	u_userid=:id 
	";

	$stmt = $pdo->prepare($query);
	$stmt->bindParam('id', $id, PDO::PARAM_STR);
	$stmt->execute();
	$count = $stmt->rowCount();
	$d   = $stmt->fetch(PDO::FETCH_ASSOC);

       
    $name  = $d['Name'];
    $uname = $d['u_username'];
    $email = $d['email'];
    $_SESSION["rolecode"] = $d['u_rolecode'];
    $tel   = $d['phone'];

    $_SESSION['name'] = $name;
    $_SESSION['uname'] = $uname;
	 

  } catch (PDOException $e) {
    echo 'Error : '.$e->getMessage();;
  }



try {
	$query = "select name from states";

	$stmt = $pdo->prepare($query);
	$stmt->execute();
	$cstate  = $stmt->fetch(PDO::FETCH_ASSOC);

  $sname = $cstate['name'];
  $_SESSION['state'] = $sname;
	 
  } catch (PDOException $e) {
    echo 'Error : '.$e->getMessage();;
  }





// Logout
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action == 'logout') {
          session_unset();
        session_destroy();
         redirect('auth/auth');
    }
}

function getAdmin($id){
  global $pdo;
  
  try {
    $query = "SELECT * FROM system_users 
    WHERE u_userid= :id";
  
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':id', $id, PDO::PARAM_STR);
    $stmt->execute();
    $row  = $stmt->fetch(PDO::FETCH_ASSOC);
  
    return $row;
     
    } catch (PDOException $e) {
      echo 'Error : '.$e->getMessage();;
    }


}

function getAdminRights($u){

  global $pdo;
  try {
    $query = "SELECT * FROM role_rights WHERE rr_rolecode = :user ";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':user', $u, PDO::PARAM_STR);
    $stmt->execute();
    $resArr = array();
    while (($row = $stmt->fetch(PDO::FETCH_ASSOC)) !== false) {
      $resArr[] = $row; 
    }
    return $resArr;  
  } catch (PDOException $e) {
    echo 'Error : '.$e->getMessage();;
  } 

}

function getAllAdminRights($u){
  global $pdo;
  try {
    $query="SELECT mod_modulecode FROM module 
    WHERE mod_modulecode NOT IN(
    SELECT rr_modulecode  FROM role_rights WHERE rr_rolecode =:user) ";

    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':user', $u, PDO::PARAM_STR);
    $stmt->execute();
    $resArr = array();
    while (($row = $stmt->fetch(PDO::FETCH_ASSOC)) !== false) {
      $resArr[] = $row; 
    }
    return $resArr;  
    } catch (PDOException $e) {
    echo 'Error : '.$e->getMessage();;
    } 


}


function getTax(){
  global $pdo;
  try {
    $query = "select countrycode, statecode from tax_details";
  
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $tax  = $stmt->fetch(PDO::FETCH_ASSOC);
  
    return $tax;
     
    } catch (PDOException $e) {
      echo 'Error : '.$e->getMessage();;
    }
}








function roles(){
global $pdo;
$sql = 'SELECT * FROM role';
$statement = $pdo->query($sql);
// fetch the next row
while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
  echo '<option value="'.$row['role_rolecode'].'">'.$row['role_rolecode'].'</option>';
}


}

function currency(){
global $mysqli;
global $cname;

$sql = 'SELECT * FROM currency';
$statement = $pdo->query($sql);
// fetch the next row
while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
  if($row['name'] == $cname){
    $selected = "selected";
}else{
    $selected = "";
}
echo '<option value="'.$row['currency_symbol'].','.$row['name'].'" '.$selected.'>'.$row['name'].' ('.$row['code'].')   '. $row['currency_symbol'].'</option>';
 
}


}


function countryCode(){
    global $pdo;
    global $taxcountry;
 
    $taxcountry = getTax();
    $sql = 'SELECT id,name,iso2 FROM countries';
    $statement = $pdo->query($sql);
    // fetch the next row
    while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
      if($row['iso2'] == $ccode){
        $selected = "selected";
        }else{
            $selected = "";
        }
        echo '<option value="'.$row["id"].'" '.$selected.'>'.$row['name']. ' ('.$row['iso2'].')</option>'; 
    }


}

function stateCode(){
global $pdo;
global $sname;

$sql = 'SELECT * FROM states ORDER BY name';
$statement = $pdo->query($sql);
while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
  if($row['states'] == $sname){
      $selected = "selected";
  }else{
      $selected = "";
  }
  echo '<option value="'.$row['name'].'" '.$selected.'>'.$row['name'].'</option>';
  }

}

function getUsers(){
	global $pdo;
    $query = "SELECT * FROM system_users ORDER BY name ASC ";
    $statement = $pdo->query($query);
    $resArr = array(); //create the result array
    while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
      $resArr[] = $row; //add row to array
    }
    return $resArr;   
}


function getPlans(){
    global $pdo;
    $query = "SELECT * FROM farm_packages order by id desc ";
    $statement = $pdo->query($query);
    $resArr = array(); //create the result array
    while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
      $resArr[] = $row; //add row to array
    }
    return $resArr;   
}


function appIntro(){
    global $pdo;
    $query = "SELECT * FROM app_intro_page order by id desc ";
    $statement = $pdo->query($query);
    $resArr = array(); //create the result array
    while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
      $resArr[] = $row; //add row to array
    }
    return $resArr;   
}

function getInvestors(){
    global $pdo;
    $query = "SELECT * FROM members order by name desc ";
    $statement = $pdo->query($query);
    $resArr = array(); //create the result array
    while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
      $resArr[] = $row; //add row to array
    }
    return $resArr;   
}

function getInvestments(){
    global $pdo;
    $query = "SELECT p.*, m.name, m.phone FROM plans p JOIN members m ON p.email = m.email WHERE p.trasaction_status = 'successful'  ";
    $statement = $pdo->query($query);
    $resArr = array(); //create the result array
    while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
      $resArr[] = $row; //add row to array
    }
    return $resArr;    
}

function failedInvestments(){
    global $pdo;
    $query = "SELECT p.*, m.name, m.phone FROM plans p JOIN members m ON p.email = m.email WHERE p.trasaction_status != 'successful'";
    $statement = $pdo->query($query);
    $resArr = array(); //create the result array
    while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
      $resArr[] = $row; //add row to array
    }
    return $resArr;    
}




function getSlides($id){
    global $pdo;
    $query = "SELECT * FROM slidder WHERE id='$id'";
    $statement = $pdo->query($query);
    $resArr = array(); //create the result array
    while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
      $resArr[] = $row; //add row to array
    }
    return $resArr;   
}

function getSlideAnim($id){
    global $pdo;
    $query = "SELECT * FROM slidder_animation WHERE slidder_id='$id'";
    $statement = $pdo->query($query);
    $resArr = array(); //create the result array
    while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
      $resArr[] = $row; //add row to array
    }
    return $resArr;   
}

function getSavingPlans(){
    global $pdo;
    $query = "SELECT * FROM saving_packages order by id desc ";
    $statement = $pdo->query($query);
    $resArr = array(); //create the result array
    while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
      $resArr[] = $row; //add row to array
    }
    return $resArr;   
}

function getMemberSavings(){
    global $pdo;
    $query = "SELECT p.*, m.name, m.phone, sp.category, sp.duration, sp.amount 
    FROM savings_history p 
    JOIN members m ON p.email = m.email
    JOIN saving_packages sp ON sp.id = p.saving_pid
     ";
     $statement = $pdo->query($query);
     $resArr = array(); //create the result array
     while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
       $resArr[] = $row; //add row to array
     }
     return $resArr;    
}

function loanTypes(){
     global $pdo;
    $query = "SELECT * FROM loans_packages order by name";
    $statement = $pdo->query($query);
    $resArr = array(); //create the result array
    while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
      $resArr[] = $row; //add row to array
    }
    return $resArr;   
}

function getLoansPackage(){
    global $pdo;
    $query = "SELECT * FROM loans_packages order by id desc ";
    $statement = $pdo->query($query);
    $resArr = array(); //create the result array
    while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
      $resArr[] = $row; //add row to array
    }
    return $resArr;   
}

function getMemberSavingHistory(){
    global $pdo;
    $query = "SELECT p.*, m.name, m.phone, sp.duration 
    FROM saving_plans p 
    JOIN saving_packages sp ON sp.id = p.saving_package_id
    JOIN members m ON p.email = m.email
     ";
     $statement = $pdo->query($query);
     $resArr = array(); //create the result array
     while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
       $resArr[] = $row; //add row to array
     }
     return $resArr;   
}

function getActiveLoan(){
     global $pdo;
    $query = "SELECT DISTINCT c.*,  ld.amt_borrowed, ld.interest,ld.total, ld.id as aloan_id,
    m.name, m.phone, l.name as loan_type,l.duration 
    FROM loan_disburse ld
    INNER JOIN members m ON m.email = ld.email
    INNER JOIN loans_packages l ON l.id = ld.loan_id
    INNER JOIN loans_payment_schedule c ON c.loan_id =ld.loan_id
      INNER JOIN
    (
        SELECT  MIN(payment_schedule) maxDate
        FROM loans_payment_schedule WHERE status='unpaid'
        
    ) b ON 
            c.payment_schedule = b.maxDate
    WHERE ld.status = 'active' 
     ";
     $statement = $pdo->query($query);
     $resArr = array(); //create the result array
     while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
       $resArr[] = $row; //add row to array
     }
     return $resArr;   
}



function modules(){
	global $pdo;
	$query="SELECT mod_modulecode FROM module";
  $statement = $pdo->query($query);

  while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {     
   
      	echo '
        <option value="'.$row["mod_modulecode"].'"> '.$row["mod_modulecode"].'</option>
      	';
        
	}		//echo '<option value="'.$row["mod_modulecode"].'">'.$row["mod_modulecode"].'</option>';
	  

	}





function getMembers(){
    global $mysqli;
    $query = "SELECT count(*) as totMembers FROM members";
    $result = mysqli_query($mysqli,$query);
    $row = mysqli_fetch_array($result);
   if($row['totMembers'] > 0){
    echo   $row['totMembers'];
  }else{
    echo "0";
  }
    }

 function endedInvestment(){
    global $mysqli;
    $query = "SELECT count(*) as endedInvestment FROM plans WHERE exp_date < DATE(NOW()) and email !='' and transId !='' ";
    $result = mysqli_query($mysqli,$query);
    $row = mysqli_fetch_array($result);

    if($row['endedInvestment'] > 0){
    echo   $row['endedInvestment'];
  }else{
    echo "0";
  }
    }  


  function activeInvestment(){
    global $mysqli;
    $query = "SELECT count(*) as activeInvestment FROM plans WHERE exp_date > DATE(NOW()) and transId !=''";
    $result = mysqli_query($mysqli,$query);
    $row = mysqli_fetch_array($result);

    if($row['activeInvestment'] > 0){
    echo   $row['activeInvestment'];
  }else{
    echo "0";
  }
    }     


  function currentCapital(){
    global $mysqli;
    $query = "SELECT SUM(amount_invested) as currentCapital FROM plans where transId !=''";
    $result = mysqli_query($mysqli,$query);
    $row = mysqli_fetch_array($result);

    if($row['currentCapital'] > 0){
    echo   '₦ '.number_format($row['currentCapital']);
  }else{
    echo "₦0";
  }
    }  

function currentActiveCapital(){
    global $mysqli;
    //$query = "SELECT SUM(amount_invested) as currentCapital FROM plans WHERE exp_date > DATE(NOW()) and transId !=''";
     $query = "SELECT SUM(amount_invested) as currentCapital FROM plans WHERE exp_date > DATE(NOW()) and transId !=''";
    $result = mysqli_query($mysqli,$query);
    $row = mysqli_fetch_array($result);

    if($row['currentCapital'] > 0){
    echo   '₦ '.number_format($row['currentCapital']);
  }else{
    echo "₦0";
  }
    }  


  function totalReturns(){
    global $mysqli;
    $query = "SELECT SUM(Amt_to_get) as totalReturns FROM plans where transId !=''";
    $result = mysqli_query($mysqli,$query);
    $row = mysqli_fetch_array($result);

    if($row['totalReturns'] > 0){
    echo   '₦ '.number_format($row['totalReturns']);
  }else{
    echo "₦0";
  }
    }    
    

function getBankName($bcode){
    global $pdo;

    try {
      $query="SELECT name from banks where code = :code) ";
  
      $stmt = $pdo->prepare($query);
      $stmt->bindValue(':code', $bcode, PDO::PARAM_STR);
      $stmt->execute();
 
     $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
    if($row['name'] != ""){
      echo   ucfirst($row['name']);
    }else{
      echo "";
    }
      } catch (PDOException $e) {
      echo 'Error : '.$e->getMessage();;
      } 


}        


function totalActiveReturns(){
    global $mysqli;
    $query = "SELECT SUM(totInterest) as totalReturns FROM plans WHERE exp_date > DATE(NOW()) and transId !=''";
    $result = mysqli_query($mysqli,$query);
    $row = mysqli_fetch_array($result);

    if($row['totalReturns'] > 0){
    echo   '₦ '.number_format($row['totalReturns']);
  }else{
    echo "₦0";
  }
    }        



function currentInvestedFarm(){
    global $mysqli;
    $query = "SELECT COUNT(DISTINCT plan_id) as currentInvestedFarm FROM plans WHERE exp_date > DATE(NOW()) and transId !='' and status='active'";
    $result = mysqli_query($mysqli,$query);
    $row = mysqli_fetch_array($result);

    if($row['currentInvestedFarm'] > 0){
    echo   $row['currentInvestedFarm'];
  }else{
    echo "0";
  }
    }   

    
function getDailyGrowth($email){
    global $mysqli;
    $query = "SELECT distinct plan, daily_growth  FROM plans where email = '$email' and status = 'active' and exp_date > DATE(NOW()) and transId !=''";
    $result = mysqli_query($mysqli,$query);
    $resArr = array();
    while($row = mysqli_fetch_assoc($result)) {
      $resArr[] = $row;
    }
    return $resArr;   
} 





//Get user assigned menus privileges
// if the rights are not set then add them in the current session
if (!isset($_SESSION["access"])) {

    try {

        $sql = "SELECT mod_modulegroupcode, mod_modulegroupname FROM module WHERE 1 GROUP BY `mod_modulegrouporder`, mod_modulegroupcode, mod_modulegroupname,`mod_moduleorder` ORDER BY `mod_modulegrouporder` ASC, `mod_moduleorder` ASC  ";


        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $commonModules = $stmt->fetchAll();

        $sql = "SELECT mod_modulegroupcode, mod_modulegroupname, mod_modulepagename,  mod_modulecode, mod_modulename FROM module  WHERE 1  ORDER BY `mod_modulegrouporder` ASC, `mod_moduleorder` ASC ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $allModules = $stmt->fetchAll();

        $sql = "SELECT rr_modulecode, rr_create, rr_edit, rr_delete, rr_view FROM role_rights WHERE rr_rolecode = :rc ORDER BY `rr_modulecode` ASC  ";

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":rc", $_SESSION["rolecode"]);
        
        
        $stmt->execute();
        $userRights = $stmt->fetchAll();

       $_SESSION["access"] = set_rights($allModules, $userRights, $commonModules);

    } catch (Exception $ex) {

        echo $ex->getMessage();
    }
}









	
}


?>
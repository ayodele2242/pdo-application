<?php
/**
 * This is our config file which contains our database configurations
 */

/*** DB Connection #starts */

$dbhost = 'localhost'; 
$dbuser = 'root';
$dbpass = '';
$dbname = 'market_place';

//Mysqli
$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if (mysqli_connect_errno()) {
printf("MySQLi connection failed: ", mysqli_connect_error());
exit();
}

// Change character set to utf8
if (!$mysqli->set_charset('utf8')) {
printf('Error loading character set utf8: %s\n', $mysqli->error);
}

//PDO
class Connection
{
	public static function make($dbhost, $dbname, $dbuser, $dbpass)
	{
		$dsn = "mysql:host=$dbhost;dbname=$dbname;charset=UTF8";
		

		try {
			$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

			return new PDO($dsn, $dbuser, $dbpass, $options);
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}
}

return Connection::make($dbhost, $dbname, $dbuser, $dbpass);


/*** DB Connection #ends */




?>
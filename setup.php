<?PHP
$host = "localhost";
$username = "root";
$password = "123456";
$table = "users";
$dbname = "hypertube";
$db = null;
try{
	$db = new PDO("mysql:host=$host", $username, $password);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->exec("set names utf8");
	$sql = "CREATE DATABASE IF NOT EXISTS hypertube DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";
    $db->exec($sql);
    $db->query("USE ".$dbname);
	$statement = "CREATE TABLE IF NOT EXISTS `$dbname`.`$table` (
		id int PRIMARY KEY AUTO_INCREMENT NOT NULL,
        username varchar(255) NOT NULL,
        name varchar(255) NOT NULL, 
        surname varchar(255) NOT NULL, 
		email varchar(255) NOT NULL, 
		password varchar(255) NOT NULL,
		token text NOT NULL,
		notifications varchar(255) NOT NULL,
        verified int DEFAULT '0' NOT NULL)";
    $db->exec($statement);
}
catch (PDOException $e) {
	print "Error!: " . $e->getMessage() . "";
	die();
}
?>
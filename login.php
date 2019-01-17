<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
// require_once "config.php";

// $redirecturl = "http://localhost:8080/Hypertube/fb-callback.php";
// $permissions = ['email'];
// $loginurl = $helper->getLoginUrl($redirecturl, $permissions);

// $gloginurl = $client->createAuthUrl();
// $loginurl42 = "https://api.intra.42.fr/oauth/authorize?client_id=61d50a325b359a90c18726e2bf5c95c8c914ce04f80cd5a0b26c7a0af166d397&redirect_uri=http%3A%2F%2Flocalhost%3A8080%2FHypertube%2F42-callback.php&response_type=code";
?>

<!-- <html>
    <head>
    <title> Hyperlogin </title>
    <style>
        body
        {
            /* background-color: rgb(0, 0, 0); */

        }
    </style>
    </head>
    <body>
    <form method="POST">
    <input name="email" placeholder="Email"><br />
    <input name="password" type="password" placeholder="Password"><br />
    <input type="submit" value="Login"><br />
    <input type="button" onclick="window.location='<?php echo $loginurl ?>';" value="Login with Facebook"><br />
    <input type="button" onclick="window.location='<?php echo $gloginurl ?>';" value="Login with Google"><br />
    <input type="button" onclick="window.location='<?php echo $loginurl42 ?>';" value="Login with 42">
    </form>
    </body>
</html> -->

<?PHP
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("setup.php");

$db->query("USE ".$dbname);
function	userexists($user, $pwd)
{
	$host = "localhost";
	$dbname = "db_smarwise";
	$db = new PDO("mysql:host=$host", "root", "codecrazy");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->query("USE ".$dbname);
	$pswd = hash('whirlpool', $pwd);
	$one = "1";
	$query = $db->prepare("SELECT username,passwd  FROM users WHERE username = :name AND passwd = :passwd AND verified = :one");
	$query->bindParam(':name', $user);
	$query->bindParam(':passwd', $pswd);
	$query->bindParam(':one', $one);
	$query->execute();
	if ($query->rowcount() > 0)
		return (1);
	return (0);
}

if (isset($_GET['code']))
{
  $query = "SELECT id FROM users WHERE token = :tok and verified = :zero";
  $stmt = $db->prepare( $query );
  $zero = '0';
  $stmt->bindParam(':zero', $zero);
  $stmt->bindParam(':tok', $code);
  $code = trim($_GET['code']);

  $stmt->execute();
  $num = $stmt->rowCount();
  if ($num > 0)
  {
    $query = "UPDATE users set verified = '1' where token = :verification_code";
    $line = $db->prepare($query);
    $line->bindParam(':verification_code', $code);
    if ($line->execute())
      echo "Your email has been verified. You may now log in.";
    else
     {
				echo "Failed to verify email";
				exit;
		 }
  }
  else
   {
			echo "Verification token is invalid. Please try again.";
			exit;
	 }
}

if (isset($_POST['user']) && isset($_POST['passwd']))
{
	$user = $_POST['user'];
	$pwd = $_POST['passwd'];
}
if (isset($user) && isset($pwd))
{
	if (userexists($user, $pwd) == 1)
	{
		session_start();
		$query = "SELECT id FROM users where username = :user";
    	$line = $db->prepare($query);
		$line->bindParam(':user', $user);
		$id = $line->execute();
		$_SESSION["user_id"] = $id;
		$query = "SELECT * FROM users where username = :user";
    	$line = $db->prepare($query);
		$line->bindParam(':user', $user);
		$email = $line->execute();
		while ($row = $line->fetch(PDO::FETCH_ASSOC))
        {
            $email = $row;
        }
		$_SESSION['email'] = $email["email"];
  		$_SESSION["username"] = $user;
		$_SESSION["logged_in"] = true;
        header("Location: home.php?user=".$user);
        echo "wow";
	}
	else
		echo "Username and password do not match or Account is not yet verified";
}
?>
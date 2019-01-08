<html> 

<?php session_start(); ?>
<img src="<?php echo $_SESSION['picture']?>"><br />
<td> <?php echo $_SESSION['first_name']?> </td>
<td> <?php echo $_SESSION['last_name']?> </td><br />
<td> <?php echo $_SESSION['gender']?> </td><br />
<td> <?php echo $_SESSION['email']?> </td>
</html>
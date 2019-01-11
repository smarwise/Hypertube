<html> 
<style>
table, th, td {
  border: 1px solid black;
}
</style>

<?php session_start(); ?>
<img src="<?php echo $_SESSION['picture']?>">
<table>
<tr>
    <th>Id</th>
    <th> <?php echo $_SESSION['id']?> </th><br />
</tr>
<tr>
<th>First Name</th>
<td> <?php echo $_SESSION['first_name']?> </td>
</tr>
<tr>
<th>Last Name</th>
<td> <?php echo $_SESSION['last_name']?> </td><br />
</tr>
<tr>
<th>Email</th>
<td> <?php echo $_SESSION['email']?> </td>
</table>  
</html>
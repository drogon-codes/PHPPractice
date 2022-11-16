<?php 
	session_start();
	if($_SESSION['login']!="true")
		echo "<script>window.location='login.php'</script>"
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Dashboard</title>
</head>
<body>
	<?php 
		$conn = mysqli_connect("localhost","root","root","php_db") or die(mysqli_error());
        $query = "select * from tbl_user";
        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

        if(isset($_POST['btnLogout'])){
        	session_destroy();
        	echo "<script>window.location='login.php'</script>";
        }
	?>
	<table align="center" border="1">
		<tr>
			<th>UserId</th>
			<th>Name</th>
			<th>Email</th>
			<th>Contact</th>
		</tr>
		<?php 
			foreach ($result as $row) {
				?>
			<tr> 
				<td><?php echo $row['userId']?></td>
				<td><?php echo $row['userName']?></td>
				<td><?php echo $row['userEmail']?></td>
				<td><?php echo $row['userContact']?></td>
			</tr>
				<?php
			}
		?>
	</table>
	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">	
		<center><input type="submit" name="btnLogout" value="Logout"></center>
	</form>
</body>
</html>
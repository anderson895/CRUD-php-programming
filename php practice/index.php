<?php 
//joshua pogi
session_start();
include ("connection.php");

if(isset($_SESSION["user_id"])){
		$user_id = $_SESSION["user_id"];
		
		$get_record = mysqli_query ($connections,"SELECT * FROM user where user_id='$user_id' ");
		$row = mysqli_fetch_assoc($get_record);
		$account_type = $row ["account_type"];
		
		
		if($account_type ==1){
					//redirect admin
						echo "<script>window.location.href='Admin/';</script>";	
					
				}else{
					//redirect user
					echo "<script>window.location.href='User/'</script>";	
				}
}
include("connection.php");

$email = $pass="";
$emailErr = $passErr="";

if(isset($_POST["btnLogin"])){
	
	
	//Login
if(empty($_POST["email"])){
	
	$emailErr ="Email is Required !";
}else{
	
	$email = $_POST["email"];
	
	
	//PAssword
}if(empty($_POST["pass"])){
	
	$passErr ="Password is Required !";
}else{
	
	$pass = $_POST["pass"];
}
	if($email AND $pass){
		
		$check_email = mysqli_query($connections,"SELECT * from user WHERE email='$email'");
		$check_email_row = mysqli_num_rows ($check_email);
		
		if($check_email_row  > 0){
			
			$row = mysqli_fetch_assoc($check_email);
			$user_id  = $row["user_id"];
			$db_password = $row["password"];
			$accountype= $row["account_type"];
			
			if($pass==$db_password){
				
			$_SESSION["user_id"]=$user_id; 
			
			
				if($accountype==1){
					//redirect admin
						echo "<script>window.location.href='Admin/';</script>";	
					
				}else{
					//redirect user
					echo "<script>window.location.href='User/'</script>";	
				}
				
			}else{
				
				$passErr="Password incorrect !";
				
			}
		}else{
			
			$emailErr = "Email is Not Registered !";
		}
		
		
		
	}

}
?>

<br>
<br>
<br>
<br>
<br>
<br>
<center>
<form method="POST">
<table border="0" width="10%">

	<tr>
	<td>
		<input type="text" name="email" value="<?php echo $email; ?>" placeholder="Email">
	</td>
	</tr>
	<tr><td><span class="Error"><?php echo $emailErr; ?></span></td></tr>
	<tr><td><hr></td></tr>
	
	<tr>
	<td>
		<input type="password" name="pass" value="" placeholder="Password">
	</td>
	</tr>
	<tr><td><span class="error"><?php echo $passErr; ?></span></td></tr>
<tr><td><hr></td></tr>
<tr><td><center><input type="submit" name="btnLogin" value="Login"></center> </td></tr>
<tr><td><hr></td></tr>
<tr><td><center><a href="">Register </a></center></td></tr>
</table>
</form>
</center>
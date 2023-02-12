<?php 
session_start();


if(isset($_SESSION["user_id"])){
	
			include ("../connection.php");
		$user_id = $_SESSION["user_id"];
		
		$get_record = mysqli_query ($connections,"SELECT * FROM user where user_id='$user_id' ");
		$row = mysqli_fetch_assoc($get_record);
		 $db_first_name = $row["first_name"];
		
	
}else{
	
	echo "<script>window.location.href='../';</script>";
	
}

include ("nav.php");
echo "<center>";
echo "<h1>WELCOME <font color='red'> $db_first_name</font> </h1>";
echo "</center>";

?>

 
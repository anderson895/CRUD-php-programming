<?php 
//admins
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
include("../connection.php");


$first_name = $middle_name = $last_name = $gender = $email ="";
$first_nameErr = $middle_nameErr = $last_nameErr = $genderErr = $emailErr ="";


	if(isset($_POST["btnRegister"])){
	
		if(empty($_POST["first_name"])){
		$first_nameErr = "First Name is Required !";
	
	}else{
		$first_name= $_POST["first_name"];
	}
	//
	if(empty($_POST["middle_name"])){
		$middle_nameErr = "(optional)";
	
	}else{
		$middle_name= $_POST["middle_name"];
	}
	//
	if(empty($_POST["last_name"])){
		$last_nameErr = "Last Name is Required !";
	
	}else{
		$last_name= $_POST["last_name"];
	}
	//
	if(empty($_POST["gender"])){
		$genderErr = "Gender is Required !";
	
	}else{
		$gender= $_POST["gender"];
	}
	//
	if(empty($_POST["email"])){
		$emailErr = "Email is Required !";
	
	}else{
		$email= $_POST["email"];
	}
	//
	if($first_name && $last_name && $gender && $email){
		
		//echo"$first_name <br>  $middle_name <br> $last_name <br> $gender <br> $email";
		//
		
		//validation for first_name
		$check_first_name = strlen($first_name);
		
			if($check_first_name < 2){
				$first_nameErr = "Your first name is too short !";
			}else{
		$check_last_name = strlen($last_name);
		
			if($check_last_name < 2 ){
			$last_nameErr = "Your Last name is too short !";		
			
			}else{
				//validation for email
				if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
					$emailErr="Invalid email format";
				}else{
					
					mysqli_query($connections,"INSERT INTO user(first_name,middle_name,last_name,gender,email) 
					VALUES('$first_name','$middle_name','$last_name','$gender','$email')");
					
					header("Location: index.php");
					}
				
				}
			}
		
		
	}
	
}


?>


<style>

	.error{
				color:Red;
				}

</style>


 <!-- start part is for search-->
 </center>
 <form method="POST" action="index.php">
	<tr>
	<td colspan="3"></td>
	
<input type="text"  placeholder="Search here..." name="keyword" required="required" value="<?php echo isset($_POST['keyword']) ? $_POST['keyword'] : '' ?>"/>

<input type="submit"  name="search" value="SEARCH">
</span>
	
	</tr>
	</form>
	
<?php include 'search.php'?>
 <!--end part is for search-->
 
 
<form method="POST" value="">
	<input type="text" name="first_name"  placeholder="First Name" value="<?php echo$first_name;?>">  <span class="error">  <?php echo $first_nameErr;?></span><br><br>
	<input type="text" name="middle_name" placeholder="Middle Name"value="<?php echo$middle_name;?>">  <span class="error">  <?php echo $middle_nameErr;?></span><br><br>
	<input type="text" name="last_name"   placeholder="Last Name"  value="<?php echo$last_name;?>"> <span class="error">  <?php echo $last_nameErr;?></span><br><br>
	
	<select name="gender">
	
		<option name="gender" value="" >SELECT GENDER</option>
		<option name="male" <?php if($gender=="Male"){ echo "selected";} ?>  value="Male">Male</option>
		<option name="female" <?php if($gender=="Female"){ echo "selected";} ?>  value="Female">Female</option>
		
	
	
	</select><span class="error"> <?php echo $genderErr; ?></span>
	<br><br>
	<input type="text" name="email" placeholder="Email" value="<?php echo$email; ?>"><span class="error"> <?php echo $emailErr;?></span><br><br>
	<input type="submit" name="btnRegister" value="Register">


</form>
<hr>


<center>

<table border="1" width="50%">	

<tr>
		
	<td colspan="4"><hr></td>
	</tr>

<form method="POST">
		
	
	
	
	<tr>
	<td>
			<b>ID</b>
		</td>
		<td>
			<b>Name</b>
		</td>
		
		<td>
			<b>Gender</b>
		</td>
		
		<td>
			<b>Email</b>
		</td>
		<td>
			<center><b>Option</b></center>
		</td>
		
	</tr>
		
	<tr>
		
	<td colspan="4"><hr></td>
	</tr>
	<?php
	
	// start code for count for user
	$count_query_user = mysqli_query($connections,"select COUNT(*)as total FROM user where account_type='0' ");
	$row_count_user = mysqli_fetch_assoc($count_query_user);
	 $count_user = $row_count_user["total"];
	// end code for count for user
	
	// start code for count for admin
	$count_query_admin = mysqli_query($connections,"select COUNT(*)as total FROM user where account_type='1' ");
	$row_count_admin = mysqli_fetch_assoc($count_query_admin);
	 $count_admin = $row_count_admin["total"];
	// end code for count for admin
	
	
	
		$full_name="";
		$view_query = mysqli_query($connections,"SELECT * from user "); 
		// where account_type='0'
		
		while($row = mysqli_fetch_assoc($view_query)){ //<-- ginagamit tuwing kukuha ng database
			
			$user_id = $row["user_id"];
			$db_first_name = $row["first_name"];
			$db_middle_name = $row["middle_name"];
			$db_gender = $row["gender"];
			$db_email = $row["email"];
			
			$db_last_name = $row["last_name"];
			
			
			
			$full_name = ucfirst($db_first_name)." ".ucfirst($db_middle_name) .". ".ucfirst($db_last_name);
					
			
			echo "<tr> 
					<td>$user_id </td>
					<td>$full_name</td>
					<td>$db_gender</td>
					<td>$db_email</td>
					<td><center>
				<a href='edit.php?user_id=$user_id'>UPDATE</a> || 
				<a href='delete.php?user_id=$user_id'>DELETE</a>
					
					
					</center></td>
				  </tr>
				  
				  
				  
				  
				  
				  
";

		}
	
	?>


 </table>
<h1>USER : <?php echo $count = $row_count_user["total"]; ?></h1>
<h1>ADMIN : <?php echo $count = $row_count_admin["total"]; ?></h1>
 
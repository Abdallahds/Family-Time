<html>
	<head>
		<style>
			td{font-size:2em}
			div{font-size:0.70em}
			
			input[type='submit']
			{
				background-color:#99ff99;
				width:150px;
				height:50px;
				
			}
			
			input
			{
				border-radius:12px;
				border-color:black;
			}

			input[type='password']
			{width:300px;
			height:30px;}

			input[type='email']
			{width:300px;
			height:30px;}
			
			input[type='text']
			{width:300px;
			height:30px;}

			input:hover
			{background-color:#00ff00;}
		</style>
	</head>

	<body style="font-size:2em">
		
		Welcome to the family time website.<br><br>
		
		<img src="pic/family.png" align="right" height="70%" width="40%"/>
		<form method="post" action="body.php">
		<fieldset>
			<legend>Signing-up</legend>
			<table>
					<tr>
						<td>First name:</td><td><input type="text" name="firstname" required value=<?php if(isset($_POST['signup'])) echo $_POST['firstname'];?>></td>
					</tr>
					<tr>
						<td>Middle name:</td><td><input type="text" name="middlename" required value=<?php if(isset($_POST['signup'])) echo $_POST['middlename'];?>></td>
					</tr>
					<tr>
						<td>Last name:</td><td><input type="text" name="lastname" required value=<?php if(isset($_POST['signup'])) echo $_POST['lastname'];?>></td>
					</tr>
					<tr>
						<td>Email:</td><td><input type="email" name="email"required value=<?php if(isset($_POST['signup'])) echo $_POST['email'];?>></td>
					</tr>
					<tr>
						<td>Password:</td><td><input type="password" name="pass1"required></td>
					</tr>
					<tr>
						<td>Retype password:</td><td><input type="password" name="pass2"required></td>
					</tr>
			</table>
			Birthdate:
			<div>
			
				Day:<select name="day">
					
					<?php	
						for( $i = 1; $i <= 31; $i++)
							{
								echo "<option value=$i>".$i."</option>";
							}
					?>
				</select>
	 
 
				Month:<select name="month">
					<?php
						
						for($i = 1; $i < 13; $i++)
							{
								echo "<option value=$i>".$i."</option>";
							}
						
				?>
				</select>
 

				Year:<select name="year">
					<?php
						
						for($i = 1950; $i< 2018; $i++)
							{
								echo "<option value=$i>".$i."</option>";
							}
					?>
				 </select>
			
			</div>
	
				<br>
			<input type="submit" value="sign up" name="signup">
		</form>


	</body>
	

</html>
<?php
if(isset($_POST['signup']))
{
	$x=0;
	$y=0;
	if($_POST['pass1']!=$_POST['pass2'])
	{	
	echo "<br>"."<b style='color:red;'>"."*the password is not the same"."</b>";
	$x++;
	}
	
	if(strlen($_POST['pass1'])<=8)
	{
		$x++;
		echo "<br>"."<b style='color:red;'>"."*the password must be larger than 8 characters."."</b>";
	}
	if(!preg_match("/[A-Z]/", $_POST['pass1']))
	{
		$x++;
		echo "<br>"."<b style='color:red;'>"."*the password must have atleast one upper case character."."</b>";
	}
	if(!preg_match("/[0-9]/", $_POST['pass1']))
	{
		$x++;
		echo "<br>"."<b style='color:red;'>"."*the password must have atleast one number."."</b>";
	}
	if(!preg_match("/@/", $_POST['pass1']))
		$y++;		
	
	if(!preg_match("/!/", $_POST['pass1']))		
		$y++;
	
	if(!preg_match("/#/", $_POST['pass1']))
		$y++;

	if(!preg_match("/%/", $_POST['pass1']))
		$y++;
	
	if(!preg_match("/&/", $_POST['pass1']))
		$y++;
	
	if($y==5)
	{
		$x++;
		echo "<br>"."<b style='color:red;'>"."*the password must have atleast one of this special character:@ ! # % &"."</b>";
	}
	
	if($x==0)
	{		
	$age="$_POST[year]"."-"."$_POST[month]"."-"."$_POST[day]";
	$conn=mysqli_connect("localhost","root","abdallah","familytime");
	if($conn)
		{
			$q="insert into members(first_name,middle_name,last_name,date_of_birth,email,passwd)
			values('$_POST[firstname]','$_POST[middlename]','$_POST[lastname]','$age','$_POST[email]',md5('$_POST[pass1]'))";
			mysqli_query($conn,$q);
			mysqli_close($conn);
			echo "<br>"."<h2 style='color:green;'>"."welcome to the family time system,please login."."</h2>";
		}
		else
			echo "error in connection";			
		
	}
}
?>
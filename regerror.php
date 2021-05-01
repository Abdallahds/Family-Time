<?php session_start();?>

<html>
<head>
<style>
body
	{
		background-color:rgb(0,100,0);
		color:white;
		font-style:italic;
		font-size:1.5em;
		
	}
	
div 
	{
		background-color:rgb(255,255,255);
		height:20%;
		width:20%;
		color:rgb(0,0,0);
		box-shadow:5px 5px 20px 20px;
		
	}
</style>
</head>

<body>
<br>
<h1 align="center">"you entered wrong email or password"</h1>
<br>
<br><br><br><br><br><br>
<center>
<div>
<form align="center" method="post" target="_top">
<table>
<br><br>
E_mail:<input type="text" name="email" required value=<?php if(isset($_POST['login'])) echo $_POST['email'];?>>
<br>
Password:<input type="password" required name="password"/>
<br><br>
<input type="submit" name ="login" value="login" style="height:2em;width:5em">
</table>
</form>
</div>
</center>
</body>
</html>



<?php

if(isset($_POST['login']))
	{
		$conn=mysqli_connect("localhost","root","abdallah","familytime");
		if($conn)
		{
			$q1=mysqli_query($conn,"select passwd from members where email='$_POST[email]'");
			$row=mysqli_fetch_array($q1);
			if($row['passwd']==md5($_POST['password']))
			{
			$id=mysqli_query($conn,"select member_id from members where email='$_POST[email]'");
			$user_id=mysqli_fetch_array($id);
			$_SESSION['id']=$user_id['member_id'];
			header("location:logedin/logedin.html");
			}
			else
			{
				
				header("location:regerror.php");
			}
			
		}
	else echo "wrong connection";
	mysqli_close($conn);
		
		
		
	}



?>
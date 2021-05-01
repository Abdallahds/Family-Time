<?php session_start();?>

<html>
<head>
<style>
body
	{
		background-color:rgb(0,100,0);
		color:white;
		font-style:italic;
		font-size:2em
	}
#logo
	{
		position:absolute;
		top:5px;
		right:5px
	}
input[type='submit']
{
	background-color:#99ff99;
	width:150px;
	height:30px;
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

input:hover
{background-color:#00ff00;}

</style>
</head>

<body>

<form method="post" target="_top">

E_mail:<input type="email" name="email" required  value=<?php if(isset($_POST['email'])) echo $_POST['email']?> >
Password:<input type="password" required name="password"/>
<input type="submit" name ="login" value="login" >
</form>

<img id="logo" src="pic/logo.png" height="70%" width="13%"/>
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
			if(md5($_POST['password'])==$row['passwd'])
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
	else echo "wrong database connection";
	mysqli_close($conn);	
		
		
	}
?>


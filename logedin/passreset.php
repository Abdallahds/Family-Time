<?php session_start();
$num=$_SESSION[id];
?>
<html>
<head>
<style>
            input[type='submit']
			{
				background-color:#99ff99;
				width:150px;
				height:40px;
				
			}
			
			input
			{
				border-radius:12px;
				border-color:black;
			}

			input[type='password']
			{width:300px;
			height:30px;}

			input:hover
			{background-color:#00ff00;
			}
			input:hover[type='submit']
			{
			width:170px;
			height:50px;
			}
</style>
</head>
<center>
<fieldset>
<legend>
Password reset
</legend>
<form method="post" target="logedbody">
<table>
<tr>
<td>Your old password:</td><td><input type="password" name="old" required /></td>
</tr>
<tr>
<td>New password:</td><td><input type="password" name="new" required /></td>
</tr>
<tr>
<td>Confirm password:</td><td><input type="password" name="confirm" required /></td>
</tr>
<tr>
<td></td><td><input type="submit" name="change" value="password reset"/></td>
</tr>
</table>
</form>

</fieldset>


</center>

<?php
if(isset($_POST['change']))
{
	$conn=mysqli_connect("localhost","root","abdallah","familytime");
	$oldpass=mysqli_query($conn,"select passwd from members where member_id=$num");
	$old=mysqli_fetch_array($oldpass);
	if($old['passwd']==md5($_POST['old']))
	{
		$x=0;
	$y=0;
	if($_POST['new']!=$_POST['confirm'])
	{	
	echo "<br>"."*the password is not the same";
	$x++;
	}
	
	if(strlen($_POST['new'])<=8)
	{
		$x++;
		echo "<br>*the password must be larger than 8 characters.";
	}
	if(!preg_match("/[A-Z]/", $_POST['new']))
	{
		$x++;
		echo "<br>*the password must have atleast one upper case character.";
	}
	if(!preg_match("/[0-9]/", $_POST['new']))
	{
		$x++;
		echo "<br>*the password must have atleast one number.";
	}
	if(!preg_match("/@/", $_POST['new']))
		$y++;
	
	if(!preg_match("/!/", $_POST['new']))
		$y++;
	
	if(!preg_match("/#/", $_POST['new']))
		$y++;	
	
	if(!preg_match("/%/", $_POST['new']))
		$y++;
	
	if(!preg_match("/&/", $_POST['new']))
		$y++;		
	
	if($y==5)
	{
		echo "<br>*the password must have atleast one of this special character:@ ! # % &";
		$x++;
	}
	
	if($x==0)
	{
		$p=md5($_POST['new']);
		mysqli_query($conn,"update members set passwd='$p' where member_id=$num");
		echo "<h2>the password has been reset.</h2>";		
	}
	}
	else
		echo "<h2>wrong old password.......</h2>";
}
?>
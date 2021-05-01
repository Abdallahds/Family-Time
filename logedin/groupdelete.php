<?php
session_start();
?>
<html>
<head>
<style>

	input[type='submit']
			{
				background-color:#99ff99;
				width:250px;
				height:30px;
				margin:1px;
				
			}
			
	input
			{
				border-radius:12px;
				border-color:black;
			}
	input:hover
			{
				border-radius:50px;
				border-color:black;
				background-color:#00ff00;
				width:255px;
				height:35px;
				
			}
		

</style>
</head>
<center>
<fieldset>
<h1>Are you sure you want to delete the group</h1>
<table>
<form method="post" target="_top">
<input type="submit" name="yes" value="Confirm"/>
</form>

<form method="post" target="logedbody">
<input type="submit" name="no" value="Cancel"/>
</form>
</table>
</fieldset>
</center>
</head>
<?php
if(isset($_POST['yes']))
	{
		$conn=mysqli_connect("localhost","root","abdallah","familytime");
		$q=mysqli_query($conn,"delete from groups where group_name='$_SESSION[gname]'");
		header("location:logedin.html");
	}
	
if(isset($_POST['no']))
	header("location:groupbody.php");


?>
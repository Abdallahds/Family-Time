<?php
session_start(); 
$num=$_SESSION['id'];
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

<h2> Are you sure you want to delete your account.</h2>
<form method="post" target="_top">
<input type="submit" name="delete" value="Confirm deletetion"/>

</form>
</center>
</html>

<?php

if(isset($_POST['delete']))
	{
		$conn=mysqli_connect("localhost","root","abdallah","familytime");
		mysqli_query($conn,"delete from members where member_id=$num");
		header("location:afterdelete.php");
	}

?>
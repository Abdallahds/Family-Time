<?php 
session_start();
?>

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
	input[type='email']
			{
				width:300px;
				height:30px;
				margin:1px;
		

</style>
</head>
<center>

<h1>Remove the member from the group.</h1>
<fieldset>
<form method="post" target="logedbody">
Enter the member email:<input type="email" name="email"/>
<input type="submit" name="remove" value="Remove"/>
<input type="submit" name="cancel" value="Cancel"/>
</form>


</fieldset>
</center>

<?php
if(isset($_POST['remove']))
	{
	$conn=mysqli_connect("localhost","root","abdallah","familytime");
	$mid=mysqli_query($conn,"select member_id from members where email='$_POST[email]'");
	$memberid=mysqli_fetch_array($mid);
	$gid=mysqli_query($conn,"select group_id from groups where group_name='$_SESSION[gname]'");
	$groupid=mysqli_fetch_array($gid);
	$q=mysqli_query($conn,"delete from groups_members
							where member_id=$memberid[member_id] and group_id=$groupid[group_id]");
	echo "<h2>the member has been removed......</h2>";
	}
	
if(isset($_POST['cancel']))
	header("location:groupbody.php");
?>
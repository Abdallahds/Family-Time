<?php 
session_start();
$num=$_SESSION[id];
$conn=mysqli_connect("localhost","root","abdallah","familytime");
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

</style>
<center>
<h1>Are you sure you want to leave this group</h1><br>
<form method="post" target="_top">
<input type="submit" value="confirm" name="confirm"/>
</form>
</center>






<?php 
if(isset($_POST['confirm']))
{
$group=mysqli_query($conn,"select group_id ,admin from groups where group_name='$_SESSION[gname]'");
$gid=mysqli_fetch_array($group);	

mysqli_query($conn,"delete from groups_members where member_id=$num and group_id=$gid[group_id]");

if($num==$gid['admin'])
{
	$nextadmin=mysqli_query($conn,"select member_id from groups_members where group_id=$gid[group_id]");
	if(mysqli_num_rows($nextadmin))
	{
	$newadmin=mysqli_fetch_array($nextadmin);
	mysqli_query($conn,"update groups set admin=$newadmin[member_id] where group_id=$gid[group_id]");
	}
	else
		mysqli_query($conn,"delete from groups where group_id=$gid[group_id]");
}

header("location:logedin.html");
}
?>
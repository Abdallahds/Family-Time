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

<h1>Adding new member to the group..</h1>
<fieldset>

	
	<form method="post" target="logedbody">	
	Friend's Email <input type="email" name="email" required />
	<input type="submit" name="add" value="ADD"/>
	
	</form>
	<form method="post" target="logedbody">	
	<input type="submit" name="cancel" value="Back"/>
	</form>
</fieldset>

</center>
<?php
if(isset($_POST['cancel']))
	header("location:groupbody.php");
	
if(isset($_POST['add']))	
	{
		$conn=mysqli_connect("localhost","root","abdallah","familytime");
		$mid=mysqli_query($conn,"select member_id from members where email='$_POST[email]'");
		$memberid=mysqli_fetch_array($mid);
		$gid=mysqli_query($conn,"select group_id from groups where group_name='$_SESSION[gname]'");
		$groupid=mysqli_fetch_array($gid);
		mysqli_query($conn,"insert into groups_members values($memberid[member_id],$groupid[group_id])");
		echo "<h2>The user has been added.</h2>";
	}	
		
?>
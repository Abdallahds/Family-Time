<?php session_start();
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
			
			input[type='text']
			{width:300px;
			height:30px;}

			input:hover
			{background-color:#00ff00;}
			input:hover[type='submit']
			{
			width:170px;
			height:50px;
			}
</style>
</head>
<center>
<h2>Insert the group information to create it.</h2>
<fieldset>
	<table>
		<td><tr><b>Group name:</b></tr>
			<tr>
				<form method="post" target="_self">
				<input type="text" name="gname" required placeholder="name without spaces"/><br><br>
				<input type="submit" name="btn" value="Create"/>
				</form>
			</tr>
		</td>
	</table>
	
</fieldset>
</center>

<?php
if ( preg_match('/\s/',$_POST['gname']) )
	echo "group name cant contain spaces";
else
{
if (isset($_POST['btn']))
	{
		$conn=mysqli_connect("localhost","root","abdallah","familytime");
		if($conn)
		{
			mysqli_query($conn,"insert into groups (group_name,admin)values ('$_POST[gname]',$num)");
			echo "<h2>The group has been created,you should Refresh the page..........</h2>";
			$g=mysqli_query($conn,"select group_id from groups where admin =$num order by group_id DESC");
			$g_id=mysqli_fetch_array($g);
			mysqli_query($conn,"insert into groups_members values($num,$g_id[group_id])");
					
		}
		else 
			echo "wrong connection";
	}
}

?>
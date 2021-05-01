<?php 
session_start();
$num=$_SESSION['id'];
$conn=mysqli_connect("localhost","root","abdallah","familytime");
if($conn)
{
	$result=mysqli_query($conn,"select * from members where member_id=$num");
	$q=mysqli_fetch_array($result);

}
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

			input[type='email']
			{width:300px;
			height:30px;}
			
			input[type='text']
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

<form method="post" action="edit.php" target="_self" enctype='multipart/form-data'>
		<fieldset>
			<legend>Edit all your informations</legend>
			<fieldset>
			<table>
					<tr>
						<td>First name:</td><td><input type="text" name="firstname" required value=<?php echo $q['first_name'];?>></td>
					</tr>
					<tr>
						<td>Middle name:</td><td><input type="text" name="middlename" required value=<?php echo $q['middle_name'];?>></td>
					</tr>
					<tr>
						<td>Last name:</td><td><input type="text" name="lastname" required value=<?php echo $q['last_name'];?>></td>
					</tr>
					<tr>
						<td>Phone number:</td><td><input type="text" name="phone"  value=<?php echo $q['phone_number'];?>></td>
					</tr>
					<tr>
						<td>Address:</td><td><input type="text" name="addr"  value=<?php echo $q['address'];?>></td>
					</tr>
					<tr>
						<td>Birthday:</td><td><input type="date" name="bday" required placeholder="year-month-day" value=<?php echo $q['date_of_birth'];?>></td>
					</tr>
					<tr>
						<td>wedding_date:</td><td><input type="date" name="wday" placeholder="year-month-day" value=<?php echo $q['wedding_date'];?>></td>
					</tr>						
			</table>
			<input type="submit" name="update" value="Update"/><br><br>
			</fieldset>
			<br>
</form>
<form method="post" action="edit.php" target="_self" enctype='multipart/form-data'>
Profile image</td><td><input type="file" name="img" /></td> 
<input type="submit" name="upload" value="Upload" required/>
</form>
</center>
</html>
<?php
if(isset($_POST['update']))
{	
	
	$update=mysqli_query($conn,"update members set first_name='$_POST[firstname]'	
	where member_id=$num");
	
	$update=mysqli_query($conn,"update members set middle_name='$_POST[middlename]'	
	where member_id=$num");
	
	$update=mysqli_query($conn,"update members set last_name='$_POST[lastname]'	
	where member_id=$num");
	if(empty($_POST['phone']))
		$update=mysqli_query($conn,"update members set phone_number=null	
		where member_id=$num");
	else
	{
		if(is_numeric($_POST['phone']))
			$update=mysqli_query($conn,"update members set phone_number='$_POST[phone]'
			where member_id=$num");
			else
				echo "phone number must be number";
	}
	
	if(empty($_POST['addr']))
	$update=mysqli_query($conn,"update members set address =null
		where member_id=$num");
	else
	$update=mysqli_query($conn,"update members set address='$_POST[addr]'	
	where member_id=$num");
	
	$update=mysqli_query($conn,"update members set date_of_birth='$_POST[bday]'	
	where member_id=$num");
	
	if(empty($_POST['wday']))
		$update=mysqli_query($conn,"update members set wedding_date=null	
		where member_id=$num");
	else	
		$update=mysqli_query($conn,"update members set wedding_date='$_POST[wday]'	
		where member_id=$num");
    
	echo "<h2>Updateing is compleate.....</h2>";
	header("Refresh:2");
	
}
?>

<?php
if(isset($_POST['upload']))
	{
			$name=$_FILES["img"]["name"];
			$type=$_FILES["img"]["type"];			
			$temp=$_FILES["img"]["tmp_name"];
			if($type="image/jpeg")
			{
				$target="uploads/".$name;
				move_uploaded_file($temp,$target);
				mysqli_query($conn,"update members set img='$target' where  member_id=$num");
				echo "Profile image is uploaded";
			}
			else echo "you can only add jpeg as your profile image.";
	}
?>
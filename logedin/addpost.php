<?php session_start();
$num=$_SESSION['id'];
$conn=mysqli_connect("localhost","root","abdallah","familytime");
$q=mysqli_query($conn,"select group_id from groups where group_name='$_SESSION[gname]'");
$gid=mysqli_fetch_array($q);
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
			input:hover[type='submit']
			{
				border-radius:50px;
				border-color:black;
				background-color:#00ff00;
				width:255px;
				height:35px;

</style>
<fieldset>
<legend>
Write the article
</legend>
<form method="post" target="logedbody">
<textarea name="article" rows="10" cols="50" required style="resize:none"
placeholder="what are you thinking........."></textarea>
<input type="submit" name="aupload" value="Upload"/>

</form>

</fieldset>


<fieldset>
<legend>
Upload the photo or video
</legend>
<form method="post" action="addpost.php" target="logedbody" enctype='multipart/form-data'>
<textarea name="text" rows="10" cols="50" required style="resize:none"
placeholder="Add title to the post........."></textarea>
<input type="file" name="post"/>
<input type="submit" value="upload" name="pupload"/>
</form>
</fieldset>





<form method="post" target="logedbody">
<br><input type="submit" name="back" value="back"/>
</form>

<?php
	if(isset($_POST['back']))
		header("location:groupbody.php");
?>

<?php
	if(isset($_POST['aupload']))
	{
		$a=mysqli_query($conn,"insert into articles (article,owner,group_id) values ('$_POST[article]',$num,$gid[group_id])");	
		echo "<h2>article has been uploaded......</h2>";
	}
?>

<?php
	
	if(isset($_POST['pupload']))
	{
		$name = $_FILES["post"]["name"];
		$type= $_FILES["post"]["type"];			
		$temp=$_FILES["post"]["tmp_name"];
		if($type!="image/jpeg")
		{
			$target="uploads/".$name;
			move_uploaded_file($temp,$target);
			echo "upload compleate";
			mysqli_query($conn,"insert into videos (video,owner,text,group_id)
								values('$target',$num,'$_POST[text]',$gid[group_id])");
		}
		else
		{
		$target="uploads/".$name;
		move_uploaded_file($temp,$target);
		echo "upload compleate";
		mysqli_query($conn,"insert into photos (photo,text,owner,group_id) values('$target','$_POST[text]',$num,$gid[group_id])");
		}
		
		
	}
?>




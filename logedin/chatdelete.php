<?php 
session_start();
?>


<center>
<h1>Are you sure you want to delete this chat</h1><br>
<form method="post" target="_top">
<input type="submit" value="confirm" name="confirm"/>
</form>
</center>

<?php
if(isset($_POST['confirm']))
	{	
		$conn=mysqli_connect("localhost","root","abdallah","familytime");
		mysqli_query($conn,"delete from chat_rooms where chat_name='$_SESSION[chatname]'");
		header("location:logedin.html");
	}
?>
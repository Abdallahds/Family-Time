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

</style>

<body>
<center>
<h1>your account has been deleted, we hope to see you again.</h1>
<form method="post" target="_top">
<input type="submit" name="btn" value="back to home page"/>

</form>
</center>
</body>
</html>

<?php

if(isset($_POST['btn']))
	header ("location:../index.html");


?>
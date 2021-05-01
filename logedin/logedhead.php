<?php session_start();?>

<html>
<head>
<style>
body
	{
		background-color:rgb(0,100,0);
		color:white;
		font-style:italic
	}
#logo
	{
		position:absolute;
		top:5px;
		right:5px
	}
#logouty
	{
		position:absolute;
		top:2.7em;
		left:5px;
		width:5em;
		height:1.5em
	}

</style>
</head>

<body>
<h2>
 
<?php
$num=$_SESSION['id'];
$conn=mysqli_connect("localhost","root","abdallah","familytime");
if($conn)
{
	$result=mysqli_query($conn,"select first_name,img from members where member_id=$num");
	$q=mysqli_fetch_array($result);
	if(!is_null($q[img]))
	echo "<img src='$q[img]' width='50px' hieght='50px' align='middle'/>";
	echo "Welcome ".$q['first_name'].".....";
	
}
else
	echo "wrong with the database connenction";
			
?>

</h2>

<img id="logo" src="../pic/logo.png" height="70%" width="13%"/>

</body>

</html>
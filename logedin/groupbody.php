<?php session_start();?>

<html>
<head>
<style>
			
			input[type='submit']
			{
				background-color:#99ff99;
				width:150px;
				height:30px;
				
			}
			
			input
			{
				border-radius:12px;
				border-color:black;
			}

			input:hover
			{background-color:#00ff00;
			width:170px;
			height:40px;}
		</style>
</head>

<?php
$num=$_SESSION[id];
echo "<h2>Welcome to ".$_SESSION[gname]." group.";
$conn=mysqli_connect("localhost","root","abdallah","familytime");
$result=mysqli_query($conn,"select admin from groups where group_name='$_SESSION[gname]'");
$q=mysqli_fetch_array($result);

$g=mysqli_query($conn,"select group_id from groups where group_name='$_SESSION[gname]'");
$gid=mysqli_fetch_array($g);

echo "<fieldset>";
echo "<form method ='post' target='_self'>";
if($_SESSION[id]==$q[admin])
	{
		echo "<input type='submit' name='delete' value='Delete the group'/>";
		echo " <input type='submit' name='addfriend' value='Add Friends'/>";
		echo " <input type='submit' name='remove' value='Remove member'/>";
	}
echo " <input type='submit' name='addpost' value='Add Post'/>";
echo " <input type='submit' name='address' value='Address book'/>";
echo " <input type='submit' name='leave' value='Leave the group'/>";

echo "</form>";
echo "</fieldset>";

?>

<?php
if(isset($_POST['delete']))
	header("location:groupdelete.php");
?>

<?php
	if(isset($_POST['addfriend']))
		header("location:friendadd.php");
?>

<?php
	if(isset($_POST['remove']))
		header("location:memberremove.php");
?>
<?php
	if(isset($_POST['addpost']))
		header("location:addpost.php");
?>

<?php
	if(isset($_POST['address']))
		header("location:addressbook.php");
?>


<?php
	if(isset($_POST['leave']))
		header("location:leavegroup.php");
?>

<?php
$videos=mysqli_query($conn,"select m.first_name,m.last_name,m.img,v.video,v.text from videos v join
							members m where group_id=$gid[group_id] and m.member_id=v.owner");
while($v=mysqli_fetch_array($videos))
	{	
		if(!is_null($v[img]))
		echo "<img src='$v[img]' width='50px' hieght='50px' align='middle'/>";
		echo $v[first_name]."_".$v[last_name].":";
		echo $v[text];
		echo "<center>";
		$url=$v[video];
		echo "<fieldset>";
		echo "<video width='500px' height='500px' controls>";
		echo "<source src='$url' type='video/mp4'/>";
		echo "</video>";		
		echo "</fieldset>";
		echo "</center>";
	}

?>

<?php
$articles=mysqli_query($conn,"select m.first_name,m.last_name,m.img,a.article from articles a join members m
							where a.group_id=$gid[group_id] and m.member_id=a.owner");
while($a=mysqli_fetch_array($articles))
	{
		if(!is_null($a[img]))
		echo "<img src='$a[img]' width='50px' hieght='50px' align='middle'/>";
		echo $a[first_name]."_".$a[last_name].":";
		echo "<center>";
		echo "<fieldset>";
		echo $a[article]."<br>";
		echo "</fieldset>";	
		echo "</center>";
	}

?>


<?php

$photos=mysqli_query($conn,"select m.first_name,m.last_name,m.img,p.photo,p.text from photos p join members m
							where p.group_id=$gid[group_id] and m.member_id=p.owner");
while($p=mysqli_fetch_array($photos))
	{
		if(!is_null($p[img]))
		echo "<img src='$p[img]' width='50px' hieght='50px' align='middle'/>";
		echo $p[first_name]."_".$p[last_name].":";
		echo $p[text];
		echo "<center>";
		echo "<fieldset>";
		echo "<img src='$p[photo]' width='500px' height='500px'/>";		
		echo "</fieldset>";
		echo "</center>";
	}

?>


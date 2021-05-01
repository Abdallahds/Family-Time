<?php 
session_start();
$num=$_SESSION['id'];
?>

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
				
			}
		

</style>
</head>
<body style="background-image:url(../pic/gr.jpg)">

<form method="post" target="logedbody">
<input type="submit" name="home" value="Home page"/>
<input type="submit" name="edit" value="Edit your profile" width="15em"/>
 <br>--------------------------<BR>
<input type="submit" name="group" value="create group" size="15"/>
<br>

<?php
	$conn=mysqli_connect("localhost","root","abdallah","familytime");
	$groups=mysqli_query($conn,"SELECT group_name 
								from groups g join groups_members gm
								where g.group_id=gm.group_id
								and gm.member_id=$num");
	echo "<b style='font-size:1.5em;background-color:fff;border-radius:12px;'>"."your groups:"."</b>"."<br>";							
	echo "<form method='post' target='logedbody'>";
	foreach($groups as $x)	
	{		
		echo "<input type='submit' name=$x[group_name] value=$x[group_name]>"."<br>";
		$n=$x[group_name];
		if(isset($_POST[$n]))
		{
			$_SESSION['gname']=$x[group_name];
			header("location:groupbody.php");
		}
		
	}
		
?>
----------------------------<br>
<input type="submit" value="create new chat" name="createchat"/><br>
<b style='font-size:1.5em;background-color:fff;border-radius:12px;'>Joined chats:</b><br>

<?php
	
	$conn=mysqli_connect("localhost","root","abdallah","familytime");
	
	$chat=mysqli_query($conn,"select c.chat_name
							  from chat_rooms c join chat_rooms_members cm
							  where cm.member_id=$_SESSION[id] and cm.chat_room_id=c.chat_room_id");
	
	
	foreach($chat as $chname)
	{
		$ss=$chname[chat_name];
		
		echo "<input type='submit' name=$ss value=$ss>"."<br>";
		$ch=$chname[chat_name];
		if(isset($_POST[$ss]))
		{
			$_SESSION['chatname']=$ch;
			header("location:chatbody.php");
		}
	}
?>
-------------------------------
<input type="submit" name ="pass" value="Reset your password "/>
<br><br><input type="submit" name ="out" value="Delete your profile "/>
<br><br><input type="submit" name ="help" value="Invite your friends "/>
</form>

<form method="post" target="_top">
<input type="submit" name="logout" value="logout"/>
</form>
</body>
</html>

<?php
if(isset($_POST['logout']))
	header("location:../index.html");
?>

<?php
if(isset($_POST['edit']))
	header("location:edit.php");
?>
<?php
if(isset($_POST['out']))
		header("location:acountdelete.php");
?>

<?php
if(isset($_POST['group']))
	header("location:groupadd.php");
?>

<?php
	if(isset($_POST['chat']))
		header("location:groupchat.php");
?>

<?php
if(isset($_POST['createchat']))
	header("location:createchat.php");
?>

<?php
if(isset($_POST['pass']))
	header("location:passreset.php");
?>

<?php
if(isset($_POST['home']))
	header("location:logedbody.php");
?>

<?php
if(isset($_POST['help']))
	header("location:email.php");
?>
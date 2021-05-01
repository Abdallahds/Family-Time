<?php
session_start();
$chatname=$_SESSION['chatname'];
date_default_timezone_set('Asia/Amman');
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
</head>
<center>
<h1>
<?php echo $chatname;?>  chat room
</h1>
<form method="post" target="logedbody">
<textarea name="message" cols="50" rows="10" placeholder="enter your message......" style="resize: none;" required >
</textarea>
<br>
<input type="submit" name="send" value="Send"/>

</form>
</center>

<form method="post" target="logedbody">
<input type="submit" name="delete" value="Delete the chat"/><br><br>
<input type="submit" name="ref" value="Chat refresh"/><br>
</form>



<?php


if(isset($_POST[ref]))
	header("Refresh:0");

if(isset($_POST[delete]))
	{
		header("location:chatdelete.php");
	}

$conn=mysqli_connect("localhost","root","abdallah","familytime");

if(isset($_POST['send']))
{

$q=mysqli_query($conn,"select first_name from members where member_id=$_SESSION[id]");
$mname=mysqli_fetch_array($q);	
$date=date('M-d-y l h:i:s A');
$msg=$date." ".$mname[first_name]."-Say:".$_POST['message'];



$oldchat=mysqli_query($conn,"select chat from chat_rooms where chat_name='$chatname'");
$ochat=mysqli_fetch_array($oldchat);

$newchat=$msg."<br>".$ochat[chat];
mysqli_query($conn,"update chat_rooms set chat='$newchat' where chat_name='$chatname'");

header("Refresh:0");
}
$conversetion=mysqli_query($conn,"select chat from chat_rooms where chat_name='$chatname'");
$conver=mysqli_fetch_array($conversetion);
echo $conver['chat'];
header("Refresh:10");
?>
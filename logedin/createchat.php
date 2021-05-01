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

			input[type='email']
			{width:300px;
			height:30px;}
			
			input:hover
			{background-color:#00ff00;
			}
			input:hover[type='submit']
			{
			width:170px;
			height:40px;
			}
</style>
</head>
<center>
<fieldset>
<legend>
Chat with
</legend>
<form method="post" target="logedbody">
enter your friend EMAIL<input type="email" name="email" required/>
<input type="submit" name="create" value="create the chat"/>
</form>
</fieldset>
</center>
</html>
<?php
	if(isset($_POST['create']))
	{
		$conn=mysqli_connect("localhost","root","abdallah","familytime");
		$q1=mysqli_query($conn,"select first_name ,last_name from members where member_id=$_SESSION[id]");
		$name1=mysqli_fetch_array($q1);
		

		$id=mysqli_query($conn,"select member_id from members where email='$_POST[email]'");
		$mid=mysqli_fetch_array($id);
		$q2=mysqli_query($conn,"select first_name ,last_name from members where member_id=$mid[member_id]");
		$name2=mysqli_fetch_array($q2);
		$name=$name1[first_name]."(".$name1[last_name].")"."-".$name2[first_name]."(".$name2[last_name].")";
		
		mysqli_query($conn,"insert into chat_rooms (chat_name,chat)
		values ('$name','  ')");
		
		$chatid=mysqli_query($conn,"select chat_room_id from chat_rooms order by chat_room_id DESC");
		$cid=mysqli_fetch_array($chatid);
		mysqli_query($conn,"insert into chat_rooms_members values($cid[chat_room_id],$_SESSION[id])");
		mysqli_query($conn,"insert into chat_rooms_members values($cid[chat_room_id],$mid[member_id])");
		
		echo "<h2>the chat has been created,refresh the page......</h2>";
	}

?>

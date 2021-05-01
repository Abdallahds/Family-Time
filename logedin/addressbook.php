<?php 
session_start();
$conn=mysqli_connect("localhost","root","abdallah","familytime");
$gid=mysqli_query($conn,"select group_id from groups where group_name='$_SESSION[gname]'");
$groupid=mysqli_fetch_array($gid);
$g=$groupid[group_id];

$q=mysqli_query($conn,"select first_name,middle_name,last_name,phone_number,address
						from members m join groups_members gr 
						where m.member_id=gr.member_id and gr.group_id=$g");
echo "<center>";
echo "<h1>Address book for all members in group: ".$_SESSION[gname]."</h1>";
echo "<table border=3>";
echo "<th>First Name</th><th>Middle Name</th><th>Last Name</th><th>Phone Number</th><th>Address</th>";
foreach($q as $x)
	echo "<tr>"."<td>".$x[first_name]."</td>"."<td>".$x[middle_name]."</td>"."<td>".$x[last_name]
	."</td>"."<td>".$x[phone_number]."</td>"."<td>".$x[address]."</td>"."</tr>";
echo "</table>";
echo "</center>";
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
<form method="post" target="logedbody">
<input type="submit" name="homepage" value="Homepage"/>
<form>

<?php
	if(isset($_POST['homepage']))
		header("location:groupbody.php");

?>

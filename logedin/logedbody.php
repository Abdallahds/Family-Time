<?php 
session_start();
date_default_timezone_set('Asia/Amman');
$num=$_SESSION['id'];
$conn=mysqli_connect("localhost","root","abdallah","familytime");
$dates=mysqli_query($conn,"select date_of_birth,wedding_date from members where member_id=$num");
$d=mysqli_fetch_array($dates);

$wday=substr($d[wedding_date],5,2);
$wmon=substr($d[wedding_date],8,2);
$bmon=substr($d[date_of_birth],8,2);
$bday=substr($d[date_of_birth],5,2);
$nowday=date('m');
$nowmonth=date('d');

if($wday==$nowday && $wmon==$nowmonth)
	echo "<h2>Today is your wedding day anniversary , HAPPY WIDDING DAY....</h2>";
if($bday==$nowday && $bmon==$nowmonth)
	echo "<h2>Today is your birthday anniversary , HAPPY BIRTHDAY....</h2>";

?>

<h1>Home page....</h1>

<?php

$videos=mysqli_query($conn,"select m.first_name,m.last_name,m.img,v.video,v.text from videos v join
							members m where v.owner=$num and m.member_id=$num");
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
							where a.owner=$num and m.member_id=$num");
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
							where p.owner=$num and m.member_id=$num");
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


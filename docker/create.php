<?php
include("../dao/function.php");
include("../public/function.php");
session_start();
$team_num=$_SESSION['team_num'];
$content=$_SESSION['content'];
$end_time=$_SESSION['end_time'];
$token=select_one_arr('game','token','is_run',1);
$flag=select_one_arr('game','flag','is_run',1);
$ip=select_one_arr('game','web_ip','is_run',1);
$i=0;
$ip_path="../check_server/host.lists";
while($token[$i])
{
//echo $token[$i];
$path="flag/web_".$i.$token[$i];
//echo $path[$i];
file_put_contents($ip_path,$ip[$i].PHP_EOL,FILE_APPEND);
file_put_contents($path,"flag=".$flag[$i]);
$i++;
}
$cmd="python create.py $team_num $content $end_time";
//echo $cmd;
$is_ok=exec($cmd);
if($is_ok)
{
echo "<script>window.location.href='../enter/info.php'</script>";
die();
}
else
{
	echo "<script>alert('server error,please concat admin  ')</script>";
	echo "<script>window.location.href='../enter/index.php'</script>";
//echo "no";
	die();
	
}
?>

<?php
header("Content-type:text/html;charset=utf-8"); 
include("../dao/function.php");
include("../public/function.php");
$end_time=get_end_time();
$team_num=get_arr_num(select_one_arr('game','token','is_run',1));
$cmd="python resetdocker.py";
$is_ok=exec($cmd);
if($is_ok)
{
	$cmd_1="python /var/www/html/awd-lastest/docker/start.py $team_num $end_time";
	#echo $cmd_1;
	$is_ok_2=exec($cmd_1);
	 if($is_ok_2)
	    {
	       echo "ok";
	 }
	else
	{
	    echo "one is ok";
	}
}
else
{
	    echo "error";
}




?>

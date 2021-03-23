<?php
header("Content-type:text/html;charset=utf-8"); 
include("../dao/function.php");
include("../public/function.php");
session_start();
if(!$_SESSION['username'])
{
	echo "<script>alert('请先登录')</script>";
	echo "<script>window.location.href='../index.html'</script>";
	die();
}
$team_num=waf(trim($_GET['team_num']));
$end_time=waf(trim($_GET['end_time']));
$match_name=waf(trim($_GET['match_name']));
$content=waf(trim($_GET['content']));
//echo $content;
$_SESSION['team_num']=$team_num;
$_SESSION['content']=$content;
$_SESSION['match_name']=$match_name;
$visit_code=time();
$_SESSION['visit_code']=$visit_code;




$endtime=str_replace("T"," ",$end_time);
$end_time1=strtotime($endtime);
$current_time=time();
if($end_time1<=$current_time)
{
 echo "<script>alert('截止时间格式错误')</script>";
 echo "<script>window.location.href='index.php'</script>";
 die();
}


if(empty($team_num)||empty($end_time)||empty($match_name))
{
  echo "<script>alert('请完善比赛信息')</script>";
  echo "<script>window.location.href='index.php'</script>";
  die();
}

if(select_one("match_info","is_run","is_run",1))
{
    echo "<script>alert('请等待当前比赛结束再进行创建')</script>";
    echo "<script>window.location.href='index.php'</script>";
    die();
}
insert_match_info($match_name,$visit_code,$end_time);
$_SESSION['end_time']=get_end_time();
//$path="../docker/d7297256b8cf26ab/";
$all=select_one_arr('match_info','match_id','is_run',0);
$num=get_arr_num($all);
$match_id=$num+1;
for($i=1;$i<=(int)$team_num;$i++)
{
$path="../docker/d7297256b8cf26ab/Team_F1AG_".$i;
$web_ip[$i-1]="47.115.18.243:".(8800+$i);
$port[$i-1]=2200+$i;
$code = rand(99*$i, 999999);
$token=substr(md5($code), 8, 16);
$flag[$i]=new password();
//echo "ok";
insert_game($match_id,$token,$flag[$i]->get_password(),$web_ip[$i-1],$port[$i-1]);
file_put_contents($path," flag=".$flag[$i]->get_password().PHP_EOL,FILE_APPEND);

}
echo "ok";
//echo "<script>window.location.href='../docker/create.php'</script>";
?>

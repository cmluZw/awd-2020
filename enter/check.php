<?php
header("Content-type:text/html;charset=utf-8"); 
require("../dao/function.php");
require("../public/function.php");
session_start();
$_SESSION['is_ok']=0;
$visit_code=waf(trim($_POST['visit_code']));

//echo "hello";
$select_visit_code=select_one("match_info","visit_code","visit_code",$visit_code);
$is_run=select_one("match_info","is_run","visit_code",$visit_code);
if(!$visit_code)
{
    echo "<script>alert('请输入邀请码')</script>";
    echo "<script>window.location.href='index.php'</script>";
    die();
}
if(!$select_visit_code)
{
    echo "<script>alert('邀请码错误或比赛已经结束')</script>";
    echo "<script>window.location.href='index.php'</script>";
    die();
}
if($select_visit_code===$visit_code&&$is_run)
{
    $_SESSION['is_ok']=1;
    $username=$_SESSION['username'];
    $team_id=select_one('user','team_id','name',$username);
    $is_exist=select_run_one('game','team_id','is_run',1,'team_id',$team_id);
    //echo $is_exist;
    if(!$is_exist)
    {
	    update_team_id($team_id);
     }
    $_SESSION['team_id']=$team_id;
    echo "<script>window.location.href='../user/index.php'</script>";
}
else
{
    echo "<script>alert('邀请码错误或比赛已经结束')</script>";
    echo "<script>window.location.href='index.php'</script>";
}

?>

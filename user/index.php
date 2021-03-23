<?php
header("Content-type:text/html;charset=utf-8"); 
session_start();
//echo $_SESSION['is_ok'];
if(!$_SESSION['is_ok'])
{
    echo "<script>alert('请输入邀请码')</script>";
    echo "<script>window.location.href='../enter/index.php'</script>";
    die();
}
require("../dao/function.php");
require("../public/function.php");
$team_id=$_SESSION['team_id'];
if(!$team_id)
{
    echo "<script>alert('非法操作！')</script>";
   // echo "<script>window.location.href='../enter/index.html'</script>";

}
//echo $team_id;
$_SESSION['id']=$team_id;
$visit_code=select_one("match_info","visit_code","is_run",1);
$end_time=select_one("match_info","end_time","is_run",1);
$match_name=select_one("match_info","match_name","is_run",1);

$token=select_run_one("game","token","team_id",$team_id,"is_run",1);
$web_ip=select_run_one("game","web_ip","team_id",$team_id,"is_run",1);
$port=select_run_one("game","port","team_id",$team_id,"is_run",1);
$username="";
$password="";
if($port)
{
$username="root";
$password="11111";
}
$score=select_rank("score");
$team_id=select_rank("team_id");
$solve_num=select_rank("solve_num");
$num=select_one_arr("game","is_run","is_run",1);
$n=get_arr_num($num);
for($i=3;$i<$n;$i++)
{
    if($score[$i]||$score[$i]==0)
    {
    $team_name[$i]=select_one("team","team_name","team_id", $team_id[$i]);
    $rank[$i-3]=new object($i+1,$team_name[$i],$solve_num[$i],$score[$i]);
    $list_str[$i-3]=$rank[$i-3]->tostring();
    }
}
$num=json_encode($n);
$seconds=get_seconds();
$rank_list=json_encode($list_str);
//var_dump($rank_list);
if($seconds<0)
{
exec("python ../check_server/stop.py");
}
echo "<script>var str=$seconds;</script>";
echo "<script>var n=$num;</script>";
echo "<script>var q=[];q=$rank_list;</script>";

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>awd比赛</title>
    <link rel="stylesheet" type="text/css" href="../style/match.css">
    <script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript" src="../style/match.js"></script>
</head>
<body>
    <h1>欢迎来到 <?php echo  $match_name;?> 线上攻防赛</h1>
    <div class="center">
        <div class="tip">
            <div class="title">
                <label>说明文档</label>
            </div>
            <div class="document">
               <!-- <p>1.比赛邀请码为:<?php echo  $visit_code;?></p>-->
		<p>1.比赛时间维持到:<?php echo  $end_time;?></p>
                <p>2.注意每过十五分钟check一次</p>
                <p>3.此比赛为友谊赛，作为学习使用</p>
            </div>
            
            <div class="title">
                <label>祝您在比赛中取得好名次</label>
            </div>
        </div>
        <div>
            <div class="info">
                <div class="info_list">
                    <span class="th">web_ip</span>
                    <span><?php echo $web_ip;?></span>
                </div>
                <div class="info_list">
                    <span class="th">port</span>
                    <span><?php echo $port;?> </span>
                </div>
                <div class="info_list">
                    <span class="th">username</span>
                    <span><?php echo $username;?> </span>
                </div>
                <div class="info_list">
                    <span class="th">password</span>
                    <span><?php echo $password;?> </span>
                </div>
                <div class="info_list">
                    <span class="th">token</span>
                    <span><?php echo $token;?> </span>
                </div>
            </div>
            <div class="range_box">
                <div>
                    <img src="../style/jb.ico" class="icon">
                    <label>排行榜</label>
                </div>
                <div class="divider">
                    <span class="line"></span>
                    <span class="time">截止时间：<?php echo date("Y-m-d H:i:s",time())?></span>
                    <span class="line"></span>
                </div>
                <div class="range">
                    <div class="range_th">
                        <span class="num">排名</span>
                        <span class="name">队伍名</span>
                        <span>解题数</span>
                        <span>分数</span>
                    </div>
                    <div class="range_td one">
                        <span class="num"><img src="../style/star.ico" class="first"></span>
                        <span class="name"><?php $id=$team_id[0]; $team_name=select_one("team","team_name","team_id",$id);echo $team_name;?></span>
                        <span><?php echo $solve_num[0];?></span>
                        <span><?php echo $score[0];?></span>
                    </div>
                    <div class="range_td two">
                        <span class="num">2</span>
                        <span class="name"><?php $id=$team_id[1]; $team_name=select_one("team","team_name","team_id",$id);echo $team_name;?></span>
                        <span><?php echo $solve_num[1];?></span>
                        <span><?php echo  $score[1];?></span>
                    </div>
                    <div class="range_td three">
                        <span class="num">3</span>
                        <span class="name"><?php $id=$team_id[2]; $team_name=select_one("team","team_name","team_id",$id);echo $team_name;?></span>
                        <span><?php echo  $solve_num[2];?></span>
                        <span><?php echo  $score[2];?></span>
                    </div>
                    <div id="range_list"></div>
                </div>
            </div>
        </div>
        <div class="right">
            <div class="submit_box">
			 <form method="POST" action="../check_server/index.php">
                <div class="row">
                    <span>token：</span>
                    <input type="text" name="token">
                </div>
                <div class="row">
                    <span>flag：</span>
                    <input type="text" name="flag">
                </div>
                <div class="submit">
                    <button>submit</button>
                </div>
				 </form>
            </div>
            <div class="time-item">
                <span id="day_show">0天</span>
                <strong id="hour_show">0时</strong>
                <strong id="minute_show">0分</strong>
                <strong id="second_show">0秒</strong>
            </div>
        </div>
    </div>
</body>
</html>

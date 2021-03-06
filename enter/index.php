<?php
header("Content-type:text/html;charset=utf-8"); 
require("../dao/function.php");
require("../public/function.php");
session_start();
if(!$_SESSION['username'])
{
    echo "<script>alert('请先登录')</script>";
    echo "<script>window.location.href='../index.html'</script>";
    die();
}
$seconds=get_seconds();
if($seconds<0)
{
exec("python check_server/stop.py");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AWD首页</title>
    <link rel="stylesheet" type="text/css" href="../style/index.css">
    <script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript" src="../style/index.js"></script>
</head>
<body>
    <div class="description">
        <p>赛前须知</p>
        <div class="info">
            <span>此比赛平台为原创平台，不得盗链或者商用</span>
            <span>不得对此平台进行任何DDOS攻击</span>
	    <span>不得对平台进行任何形式的扫描，此平台会记录ip还请自重</span>
	    <span>若发现此平台存在漏洞，请提交到学习平台社区</span>
	   <!-- <span></span>-->
	    <span>另有什么疑问或者建议请联系管理人ring_ring</span>
        </div>
    </div>
    <div class="form">
        <div class="button_list">
            <button onclick="Choose('join')">加<br>入<br>比<br>赛</button>
            <button onclick="Choose('create')">创<br>建<br>比<br>赛</button>
        </div>
		 <form action="check.php" method="POST">
        <div id="join">
            <div class="code_input">
                <label class="title">邀请码：</label>
                <input type="text" id="match_code" name="visit_code">
            </div>
            <button class="submit" onclick="SubmitJoin()">点击进入</button>
        </div>
		</form>
        <div id="create">
            <div class="row">
                <label class="label_tip">比赛内容</label>
                <div class="select_row">
                    <span class="select" id="easy_cms" name="easy_cms">easy_cms</span>
                   <!-- <span class="select" id="easy_cms" name="easy_cms">easy_cms</span>
                   <span class="select" id="three">awdaaa</span>
                    <span class="select" id="four">awdaaa</span>-->
                </div>
            </div>
            <div class="row">
                <label class="label_tip">比赛名称</label>
                <input id="match_name" type="text" class="input_name" name="match_name">
            </div>
            <div class="row">
                <label class="label_tip">结束时间</label>
                <div class="column">
                    <input id="match_endTime" type="datetime-local" class="input_name"  name="end_time"/>
                    <span class="tip">输入样例:2020-04-19T00:00</span>
                </div>
            </div>
            <div class="row">
                <label class="label_tip">队伍数</label>
                <input id="match_teamNum"  type="text" class="input_name" name="team_num"/>
            </div>
            <button class="submit_create" onclick="SubmitCreate()">点击创建</button>
        </div>
    </div>
</body>
</html>

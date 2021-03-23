<?php
header("Content-type:text/html;charset=utf-8"); 
session_start();
if(!$_SESSION['username'])
	{
    echo "<script>alert('请先登录')</script>";
    echo "<script>window.location.href='../index.html'</script>";
    die();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>awd比赛信息</title>
    <link rel="stylesheet" href="../style/awd_match.css">
    <script type="text/javascript" src="../style/awd_match.js"></script>
</head>
<body>
    <div class="center">
        <div class="title">
            <label>比赛信息</label>
        </div>
        <div class="info">
            <label>名称：
                <?php echo $_SESSION['match_name']; ?>
            </label>
        </div>
        <div class="info">
            <label>邀请码：
                <?php echo $_SESSION['visit_code']; ?></label>
        </div>
        <div class="info">
            <label>awd网站地址如下：</label>
        </div>

        <div class="web">
        <?php 
                echo "<br>";
                echo "<br>";
                $num=$_SESSION['team_num'];
                for($i=1;$i<=$num;$i++)
                {
                    $port=8800+(int)$i;
                    $ssh_port=2200+(int)$i;
                    echo "<span>";
                    echo "team".$i.":http://47.115.18.243:".$port."ssh登录端口为:".$ssh_port;
                    echo "<br>";
                    echo "<br>";
                    echo "</span>";
                }
                ?>
        </div>
    </div>
</body>
</html>

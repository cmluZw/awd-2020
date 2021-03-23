<?php
header("Content-type:text/html;charset=utf-8"); 
require("dao/function.php");
require("public/function.php");
session_start();
$username=waf($_POST['username']);
$password=waf($_POST['password']);
$pass=select_one('user','password','name',$username);
$seconds=get_seconds();
if($seconds<0)
{
exec("python check_server/stop.py");
}
//echo $pass;
if($pass===$password)
{
    $_SESSION['username']=$username;
    echo "<script>window.location.href='enter/index.php'</script>";
    die();
}
else
{
    echo "<script>alert('账号或密码错误')</script>";
    echo "<script>window.location.href='index.html'</script>";
    die();
}


?>
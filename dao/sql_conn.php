<?php
@header("Content-type:text/html;charset=utf-8"); 
require('config.php');
$conn=mysqli_connect($host,$dbuser,$dbpass,$dbname);
$conn->query("set names utf8");
if(!$conn)
{
    die("数据库连接失败");
}
?>

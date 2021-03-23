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
$flag=waf(trim($_POST['flag']));
$id=$_SESSION['id'];
//echo $id;
$token=waf(trim($_POST['token']));
$team_id=select_one('game','team_id','token',$token);
//echo "<script>alert($team_id)</script>";
$flag_arr=select_not_self_flag($token);
$i=0;
$submit=select_one('game','submit','flag',$flag);
if(!$team_id)
{
//echo "tame_id is error";
    echo "<script>alert('token错误')</script>";
    echo "<script> window.location.href='../user/index.php?id=$id'</script>";
    die();
}
$submit = explode(',',$submit); 
while($flag_arr[$i])
{
    if($flag==$flag_arr[$i]&&!in_array($team_id,$submit,true))
    {
        update_add_one('game','solve_num',1,'token',$token);
        update_add_one('game','score',100,'token',$token);
        update_submit($team_id,$flag);
        //update_sub_one('game','solve_num',1,'flag',$flag);
        update_sub_one('game','score',100,'flag',$flag);
        echo "<script>alert('flag正确')</script>";
        echo "<script> window.location.href='../user/index.php?id=$id'</script>";
        exit();
    }
    $i++;
}
        echo "<script>alert('flag错误或者已经提交过')</script>";
        echo "<script> window.location.href='../user/index.php?id=$id'</script>";



?>

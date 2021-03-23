<?php
require("../dao/function.php");
require("../public/function.php");
$ip=waf($_POST['ip']);
$option=waf($_POST['option']);
if($option=='add')
{
update_add_one('game','score',20,'web_ip',$ip);
echo "check is ok";
}
else if($option=='sub')
{
    update_sub_one('game','score',20,'web_ip',$ip);
    echo "check is ok";
}

?>

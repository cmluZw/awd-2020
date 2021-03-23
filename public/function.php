<?php
function rand_str()
{
    $i = rand(0, 3);
    $rand_str=array('ring','+v','yuyan','hhh');
    return $rand_str[$i];
}

class password
{
    var $rand_str;
    var $encode_password;
    var $password;
    function __construct()
    {
        $rand_str=rand_str();
        $code = rand(99*$i, 999999);
        $key=base64_encode($code).$rand_str;
        $flag="flag{awd-".$key."}";
        $this->password=$flag;
        $encode_password=md5("$rand_str").base64_encode($flag);
        $this->encode_password=$encode_password;
        $this->rand_str=$rand_str;
    }
    function get_encode_password()
    {
        return $this->encode_password;
    }
    function get_password()
    {
        return $this->password;
    }

}

class object
{

    var $rank;
    var $name;
    var $num;
    var $score;
    function __construct($rank,$name,$num,$score)
    {
        $this->rank=$rank;
        $this->name=$name;
        $this->num=$num;
        $this->score=$score;
    } 

    function tostring()
    {
        $string="{'rank':".$this->rank.",'name':'".$this->name."','num':".$this->num.",'score':".$this->score."}";
        return $string;
    }
}


function get_seconds()
{
    $match_info=select_all("match_info","is_run",1);
    $endtime=$match_info['end_time'];
    $endtime=str_replace("T"," ",$endtime);
  //  echo $endtime;
    $end_time=strtotime($endtime);
    $current_time=time();
    $seconds=$end_time-$current_time;
    return json_encode($seconds);
}


function get_end_time()
{
	$match_info=select_all("match_info","is_run",1);
	$endtime=$match_info['end_time'];
	$endtime=str_replace("T"," ",$endtime);
    //echo $endtime;
	$end_time=strtotime($endtime);
	return $end_time;
}


function waf($x)
{
    if(eregi('select|insert|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile', $x))
    {
        return false;
    }
    else
    {
        $x=addslashes($x);
        $x=htmlspecialchars($x);
        return $x;
    }
}

function get_arr_num($arr)
{
    $i=0;
    while($arr[$i])
    {
        $i++;
    }
    return $i;
}




?>

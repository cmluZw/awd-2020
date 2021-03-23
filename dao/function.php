<?php


#######################查询数据####################################
//查找单个字段，需要传入数据表名字，需要查找的字段名字，where判断的条件1，和条件2
function select_one($table,$column,$where_1,$where_2)
{
    include("sql_conn.php");
	$sql="SELECT $column FROM $table WHERE $where_1 ='$where_2'";
    $result=mysqli_query($conn,$sql);
	@$row = mysqli_fetch_array($result);
    if(!$row)
    {
        //die("select_one查找".$column."函数错误");
        return false;
    }else
    {
	return $row[0];
}
}

//两个条件
function select_run_one($table,$column,$where_1,$where_2,$where_3,$where_4)
{
    include("sql_conn.php");
	$sql="SELECT $column FROM $table WHERE $where_1 ='$where_2' and $where_3='$where_4'";
    $result=mysqli_query($conn,$sql);
	@$row = mysqli_fetch_array($result);
    if(!$row)
    {
        //die("select_one查找".$column."函数错误");
        return false;
    }else
    {
	return $row[0];
}
}



//用于查找数据需要返回结果是数组的时候，但只能返回一个单个字段的数组
function select_one_arr($table,$column,$where_1,$where_2)
{
    include("sql_conn.php");
	$sql="select $column from $table where $where_1 ='$where_2'";
    $result=mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
        $result_arr[] = $row[$column];          
    }
    return $result_arr;
}

//用于查找数据表中的所有数据
function select_all($table,$where_1,$where_2)
{
    include("sql_conn.php");
    $sql="select * from $table where $where_1 =$where_2";
    $result=mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
        $result_arr= $row;          
        }
    return $result_arr;
}



//用于查找不是自己的所有其它flag
function select_not_self_flag($token)
{
    include("sql_conn.php");
	$sql="select flag from game where token !='$token'";
    $result=mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
        $result_arr[] = $row['flag'];          
    }
    return $result_arr;
}


//排序查询正在比赛的数据，返回单个字段数组
function select_rank($column)
{
    include("sql_conn.php");
	$sql= "select $column from game where is_run=1 ORDER BY score DESC ";
    $result=mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
        $result_arr[] = $row[$column];          
    }
    return $result_arr;
   
}
#############以上是查询数据########################################


############插入数据##############################################
//初始化插入game表
function insert_game($match_id,$token,$flag,$web_ip,$port)
{
    include("sql_conn.php");
    $sql="insert into game (match_id,token,flag,solve_num,web_ip,port,is_run,score) values ('$match_id','$token','$flag',0,'$web_ip','$port',1,100)";
   // echo $sql;
    if(!mysqli_query($conn,$sql))
    {
        die(mysql_error());
    }
}

//初始化插入match_info表
function insert_match_info($match_name,$visit_code,$end_time)
{
    include("sql_conn.php");
    $sql="insert into match_info (visit_code,end_time,match_name,is_run) values ('$visit_code','$end_time','$match_name',1)";
    if(!mysqli_query($conn,$sql))
    {
        die("error in function insert_match_info()");
    }
    return true;
}



###############以上是插入数据######################################################3




###############################更新数据###############################
//更新单个数据,加法，用于加solve_num和分数
function update_add_one($table,$column,$add,$where_1,$where_2)
{   
    include("sql_conn.php");
    $sql="update $table set $column=$column+$add where $where_1='$where_2' and is_run=1";
    if(!mysqli_query($conn,$sql))
    {
        die("error in function update_add_one() ");
    }
    return true;
    }

//更新单个数据,减法，用于减olve_num和分数
function update_sub_one($table,$column,$add,$where_1,$where_2)
{   
    include("sql_conn.php");
    $sql="update $table set $column=$column-$add where $where_1='$where_2' and is_run=1";
    if(!mysqli_query($conn,$sql))
    {
        die("error in function update_sub_one() ");
    }
    return true;
    }

//flag提交成功时向game中的submit插入数据，以逗号隔开
function update_submit($team_id,$flag)
{   
    include("sql_conn.php");
    $sql="update game set submit=CONCAT_WS(',',submit,'$team_id') where flag='$flag'";
    if(!mysqli_query($conn,$sql))
    {
        die("error in function update_submit() output");
    }
    return true;
    }

//清空submit
function clean_submit()
{
    include("sql_conn.php");
    $sql="UPDATE game SET submit = ''";
    if(!mysqli_query($conn,$sql))
    {
        return false;
        die("error in function clean_submit() output");
    }
    return true;
}

//比赛要结束的时候将is_run设置为0
function update_is_run_to_0($table)
{
    include("sql_conn.php");
    $sql="UPDATE $table SET is_run = 0";
    if(!mysqli_query($conn,$sql))
    {
        return false;
        die("error in function update_is_run_to_0() output");
    }
    return true;
}

//加入比赛的时候写入队伍id
function update_team_id($team_id)
{
    include("sql_conn.php");
    $sql="UPDATE game SET team_id ='$team_id'  where is_run=1 and team_id='0' order by port asc limit 1;";
    if(!mysqli_query($conn,$sql))
    {
        return false;
        die("error in function update_team_id() output");
    }
    return true;
}
?>

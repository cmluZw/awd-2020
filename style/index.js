
// 选择的比赛内容
var selectMatch = '';
//默认显示join卡片
$(function() {
    $("#create").hide();
    // 选择比赛内容
    $("#easy_cms").click(function(){
        $(this).addClass('active').siblings().removeClass('active');
        selectMatch = 'easy_cms';
        //console.log(selectMatch)
    });
    $("#easy_cms").click(function(){
        $(this).addClass('active').siblings().removeClass('active');
        selectMatch ='easy_cms';
        //console.log(selectMatch)
    });
   /* $("#three").click(function(){
        $(this).addClass('active').siblings().removeClass('active');
    });
    $("#four").click(function(){
        $(this).addClass('active').siblings().removeClass('active');
    });*/
})



// 切换选项卡
function Choose(type) {
    document.getElementById(type).style.display="";
    if (type === "join") {
        document.getElementById("create").style.display="none";
    }
    if (type === "create") {
        document.getElementById("join").style.display="none";
    }
}

// 提交加入比赛 事件
function SubmitJoin() {

}

// 提交创建比赛 事件
function SubmitCreate() {
    if (selectMatch === '') {
        alert("您还没有选择比赛内容！");
    } else {
        if (document.getElementById("match_name").value) {
            //if (isChinese() && isTime() && isTeamNum()) {
                if ( isTime() && isTeamNum()) {
                var name = document.getElementById("match_name").value;
                var num = document.getElementById("match_teamNum").value;
                var end_time=document.getElementById("match_endTime").value;
                window.location.href="create.php?content="+selectMatch+"&match_name="+name+"&end_time="+end_time+"&team_num="+num;
               // document.form.action = "create.php?content="+selectMatch;
                document.form.submit();
            }
        } else {
            alert("您还没有填写比赛名称！");
        }
    }
}

// 判断队伍数是否为正整数
function isTeamNum(){
    const value = document.getElementById("match_teamNum").value;
    console.log(value);
    let res = false;
    if (value | 0 === value && value <= 30) {
        res = true;
    }
    else {
        alert("比赛队伍数只能是1~30的正整数！");
    }
    return res;
}

// 判断比赛结束时间
function isTime(){
    if(!document.getElementById("match_endTime").value){
        alert("比赛时间不能为空！");
        return false;
    }
    return true;
}

// 判断比赛名称中是否有汉字
function isChinese(){
    var res =false;
    var name = document.getElementById("match_name").value;
    // console.log(name);
    for(var i=0;i<name.length;i++)
    res=(name.charCodeAt(i)>=10000) || res;
    if(res){
        alert("比赛名称中不能出现汉字！");
        return false;
    }
    return true;
}

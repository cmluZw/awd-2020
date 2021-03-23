// 页面倒计时
var intDiff = parseInt(str);//倒计时总秒数量
function timer(intDiff){
    window.setInterval(function(){
    var day=0,
        hour=0,
        minute=0,
        second=0;//时间默认值        
    if(intDiff > 0){
        day = Math.floor(intDiff / (60 * 60 * 24));
        hour = Math.floor(intDiff / (60 * 60)) - (day * 24);
        minute = Math.floor(intDiff / 60) - (day * 24 * 60) - (hour * 60);
        second = Math.floor(intDiff) - (day * 24 * 60 * 60) - (hour * 60 * 60) - (minute * 60);
    }
    if (minute <= 9) minute = '0' + minute;
    if (second <= 9) second = '0' + second;
    $('#day_show').html(day+"天");
    $('#hour_show').html('<s id="h"></s>'+hour+'时');
    $('#minute_show').html('<s></s>'+minute+'分');
    $('#second_show').html('<s></s>'+second+'秒');
    intDiff--;
    }, 1000);
} 
$(function(){
    timer(intDiff);
    // list存放第四名及以后的信息
   /* var list=[{
        rank:'4',
        name:'没有头发',
        num:'10',
        score:'999'
    },{
        rank:'5',
        name:'没有头发',
        num:'10',
        score:'999'
    }];
    var test={
        rank:'5',
        name:'没有头发',
        num:'10',
        score:'999'
    };*/
    var list=[];
    for(var i=0;i<n-3;i++)
    {
        var obj = eval('(' + q[i] + ')');
      //  var p=JSON.parse(q[i]);
        list.push(obj);
    }
    // 这里别改
    list.forEach(function(item){
        $("<div></div>")
        .html('<div class="range_td"><span id="rank" class="num">'
         + item.rank
         + '</span><span id="name" class="name">'
         + item.name
         + '</span><span id="num">'
         + item.num
         + '</span><span id="score">'
         + item.score
         + '</span></div>')
         .appendTo("#range_list")
    })
}); 
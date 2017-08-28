<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--add_campus-->
    <title>新增校区</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <script src="/public/simpleboot/headmaster/js/rootfont.js"></script>
<script src="/public/simpleboot/headmaster/js/clipboard.min.js"></script>
<script src="/public/simpleboot/headmaster/js/jquery-1.10.1.min.js"></script>
<link rel="stylesheet" href="/public/simpleboot/headmaster/css/main.css" />
<link rel="stylesheet" href="/public/simpleboot/headmaster/css/manager.css">
<link rel="stylesheet" href="/public/simpleboot/manager/css/manager-v2.0.css">
    <link rel="stylesheet" href="/public/simpleboot/manager/css/campus.css">
    <link rel="stylesheet" href="/public/simpleboot/manager/css/DateSelector.css">
</head>
<body>
<script>
    document.body.style.height=document.documentElement.clientHeight+"px";
</script>
<div class="list-content" style="height:100%;">
     <div class="list-om" style="position:relative;height:100%;">
         <div class="add-new-campus">
             <span class="add-span">校区名称</span><input type="text" placeholder="请输入校区名称">
         </div>
         <div class="area-div"></div>
         <div class="add-new-campus">
             <span class="add-span">投资人</span><input type="text" placeholder="请填写投资人姓名">
         </div>
         <div class="area-div"></div>
         <div class="add-new-campus">
             <span class="add-span">校区地址</span><input type="text" placeholder="请填写校区的详细地址">
         </div>
         <div class="area-div"></div>
         <div class="add-new-campus">
             <span class="add-span">授权期限</span>
             <p id="allow_time_btn">请选择</p>
         </div>
         <div class="area-div"></div>
         <div class="add-new-campus">
             <span class="add-span">登录账号</span><input type="text" placeholder="请填写投资人常用手机号">
         </div>
         <div class="area-div"></div>
         <button class="add_campus">添加校区</button>
     </div>
</div>
<div id="allow_time_box"></div>

<script src="/public/simpleboot/manager/js/DateSelector.js"></script>
<script>

   new DateSelector({
       input:'allow_time_btn',
       container:'allow_time_box',
       type:0,
       param:[1, 1, 1, 0, 0],
       beginTime:[2017,1,1],
       endTime:[2050,12,31],
       recentTime:[],
       success:function(arr){
           var data = arr[0]+'-'+arr[1]+'-'+arr[2];
           $('#allow_time_btn').html(data).css('color','black');
       }
   });
</script>
</body>
</html>
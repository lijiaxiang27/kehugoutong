<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>入校支持申请详情</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <script src="/public/simpleboot/headmaster/js/rootfont.js"></script>
<script src="/public/simpleboot/headmaster/js/clipboard.min.js"></script>
<script src="/public/simpleboot/headmaster/js/jquery-1.10.1.min.js"></script>
<link rel="stylesheet" href="/public/simpleboot/headmaster/css/main.css" />
<link rel="stylesheet" href="/public/simpleboot/headmaster/css/manager.css">
<link rel="stylesheet" href="/public/simpleboot/manager/css/manager-v2.0.css">

    <style>
        .Application-detail-header{
            text-align:left;
            padding:0.35rem;
        }
        .Application-detail-header:after{
            content:'';
            height:0;
            display:block;
            clear: both;
            visibility: hidden;
        }
        .Application-detail-content{
            font-size:0.26rem;
            padding:0.35rem 0.4rem;
            text-align:left;
        }
        .detail-header-people{
            border-radius: 50%;
            float:left;
            width:24%;
            margin-left:0.1rem;
        }
        .detail-header-right{
            margin-left:0.2rem;
            display:inline-block;
            text-align: left;
        }

        .detail-header-right .school-name{
            font-family:'微软雅黑';
            font-size:0.28rem;
            color:rgb(100,100,100);
            margin-bottom:0.1rem;
        }

        .detail-content-name{
            color:rgb(150,150,150);
            display:inline-block;
            width:2rem;
            text-align: right;
            vertical-align: top;
        }
        .d-c-n-2{
            width:4.6rem;
            display:inline-block;
            margin-left:0.1rem;
        }
        .support-content{
            vertical-align: top;

        }
        .detail-content-bottom{
            margin-top:0.1rem;
        }
        .detail-content-bottom div{
            display:inline-block
        }

        .application-status{
            background:rgb(243,243,243);
            border-top:1px solid rgb(220,220,220);
            border-bottom:1px solid rgb(220,220,220);
        }
        .application-status > div{
            float:left;
        }
        .application-status:after{
            content:'';
            height:0;
            display:block;
            clear: both;
            visibility: hidden;
        }


        .application-status-right > .successful-application{
            text-align:left;
            background:white;
            border:1px solid rgb(210,210,210);
            border-radius:4px;
            padding:0.3rem;
        }
        .successful-application img{
            width:0.6rem;
            height:0.6rem;
            border-radius: 50%;
            margin:0  0.24rem 0;

        }
        .application-status-right > .successful-application div{

            display:inline-block;

        }
        .successful-application div p{
            font-size:0.3rem;
        }
        .successful-application div > span{
            display:inline-block;
            color:#666;
        }
        .successful-application div p span{
            font-size:0.3rem;
        }
        .status-during{
            margin-top:0.2rem;
        }
        /*footer*/
        footer{
            padding:0.15rem;
        }
        footer li a{
            color:#007FBA;
            display:inline-block;
            width:100%;
            height:100%;
            padding:0.12rem;
            font-size:0.32rem;
        }
        footer ul:after{
            content:'';
            height:0;
            display:block;
            clear: both;
            visibility: hidden;
        }

        .c_and_s_enclosure{
            width:4.4rem;
            height:2.5rem;
            vertical-align: top;
        }
        .c_and_s_enclosure img{
            width:4.4rem;
            height:2.5rem;
        }

        .return_box{
            text-align: left;
            padding:0.3rem;
            box-sizing:border-box;
        }
        .return_input{
            border:1px solid rgb(200,200,200);
            resize: none;
            width:77%;
            height:2.4rem;
            font-size:0.3rem;
        }
        .return_button{
            display:block;
            width:40%;
            text-align: center;
            border-radius: 0.1rem;
            margin: 0 auto;
            padding: 0.2rem 0;
            font-size: 0.3rem;
            color: white;
            margin-top: 0.3rem;
            background: rgb(23,176,90);
        }
        .your_reply_box{
            display:none;
            text-align:left;
            font-size:0.3rem;
            padding:0.3rem;
            box-sizing: border-box;
        }
        .master_reply{
            text-align: left;
            font-size:0.3rem;
            display:none;
        }
    </style>
</head>
<body>
<script>
    //document.body.style.height=document.documentElement.clientHeight+"px";
</script>
<div class="list-content">
    <div class="list-om">
        <div class="Application-detail-header">
            <div class="detail-header-right">
                <p class="school-name">河北沧州凹凸学习中心投诉运营服务</p>
                <span class="approval-result approval-result-detail" id="approvalResult">待处理</span>
            </div>
        </div>
        <hr/>
        <div class="Application-detail-content">
            <p><span class="detail-content-name">投诉时间： </span><span class="d-c-n-2">2017-6-30 9:00</span></p>
            <p><span class="detail-content-name">投诉人： </span><span class="d-c-n-2">刘校长</span></p>
            <p><span class="detail-content-name">投诉内容： </span><span class="d-c-n-2">帮助校区构建标准化的运营服务体系，帮助校区建立师资库并配合进行兼职教师面试和培训。</span></p>
            <p><span class="detail-content-name">期望解决方案： </span ><span class="d-c-n-2">帮助校区构建标准化的运营服务体系，帮助校区建立师资库并配合进行兼职教师面试和培训。</span></p>
            <div class="detail-content-bottom">
                <span class="detail-content-name  support-content">附件：</span>
                <div class="c_and_s_enclosure">

                </div>
            </div>
        </div>
        <div  class="application-status" id="apply_box">
           <p class="your_reply_box">您的回复：<br><span class="your_reply" style="margin-left:1.5rem"></span></p><!--运营经理输入框的内容-->
           <p class="return_box">
               <span style="vertical-align:top;font-size:0.3rem;">请回复：</span>
               <textarea class="return_input" id="return_input">

               </textarea>
           </p>
            <a class="return_button" id="return_button" href="#1">回复</a>
        </div>

        <!--<p class="master_reply">-->
            <!--校长对您的回复:<br>-->
            <!--<span style="text-indent:2.2rem;display:inline-block"></span>&lt;!&ndash;校长的回复&ndash;&gt;-->

        <!--</p>-->
    </div>
</div>
<script>
    var spans = document.querySelector('.approval-result');
    var textarea = $('#return_input');
    var return_btn = $('#return_button');
    var box = $('#apply_box');
    var manager_text = $('.your_reply');
    var manager_text_box = $('.your_reply_box');




        if(spans.innerHTML == "已完成" || spans.innerHTML == "已同意"){
            manager_text_box.show();
            $('.return_box').hide();
            return_btn.hide();
            $('.master_reply').show();
            spans.style.color = "rgb(0,196,109)";
        }
        if(spans.innerHTML == "待处理" || spans.innerHTML == "待评价"){
            spans.style.color = "#F8B42C"
        }


    return_btn.click(function () {
        var val = textarea.val();
        if(val.trim() === ''){
            alert('请填写对投诉或建议的回复');
            return false;
        }
        var br = confirm("确定提交吗，提交后不能修改");
        if(br){
            spans.innerHTML = '待评价';
            spans.style.color = "#F8B42C";
            manager_text_box.show();
            manager_text.html(val);
            val = val.trim();
            console.log(val);
            $('.return_box').fadeOut(200);
            return_btn.fadeOut(200);
            $('.master_reply').fadeIn(200);
            alert("提交成功");
            $.ajax({
                url:'',
                type:'',
                data:{},
                dataType:'json',
                success:function(msg){

                },
                error:function(msg){
                    //alert(msg);
                }
            })
        }
    });
</script>
</body>
</html>
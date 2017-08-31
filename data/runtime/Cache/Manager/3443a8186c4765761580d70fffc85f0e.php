<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--add_campus-->
    <title>资料管理</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <script src="/public/simpleboot/headmaster/js/rootfont.js"></script>
<script src="/public/simpleboot/headmaster/js/clipboard.min.js"></script>
<script src="/public/simpleboot/headmaster/js/jquery-1.10.1.min.js"></script>
<link rel="stylesheet" href="/public/simpleboot/headmaster/css/main.css" />
<link rel="stylesheet" href="/public/simpleboot/headmaster/css/manager.css">
<link rel="stylesheet" href="/public/simpleboot/manager/css/manager-v2.0.css">
    <style>
         .data_box{
             text-align: left;
             padding:0.1rem 0.4rem;
         }
         .data_box h3{
             border-bottom:1px solid rgb(220,220,220);
             text-indent: 0.3rem;
             padding:0.2rem 0;
         }
         .data_header{
             font-size:0.24rem;
             font-weight:400;
             padding:0.15rem 0.2rem 0.15rem 0.3rem;
         }

        .find_more{
            float:right;
            color:rgb(23,176,90);
        }
        .data_lists{
            margin-bottom:0.3rem;
        }
        .data_list > .data_left{
            float:left;
            width:0.8rem;
        }
        .data_list > .data_right{
             float:left;
             padding-left:0.1rem;
             box-sizing: border-box;
             width:5.4rem;
        }
        .data_title{
            font-size:0.32rem;
            display:inline-block;
            padding-right:0.2rem;
        }
        .download_count{
            font-size:0.22rem;
            color:rgb(140,140,140);
        }
        .data_list_box{
            padding:0.15rem;
            border:1px solid rgb(220,220,220);
            background:rgb(245,245,245)
        }
        .data_list{
            padding:0.2rem 0;
            border-bottom:1px solid rgb(220,220,220);
        }
         .data_list:last-child{
             padding:0.1rem 0;
             border-bottom:none;
         }
        .data_time{
            font-size:0.22rem;
            vertical-align: bottom;
            display:inline-block;
            padding:0.1rem 0;
            color:rgb(140,140,140);
        }
        .data_btn{
            float:right;
            padding:0.1rem 0.16rem;
            background:rgb(23,176,90);
            color:white;
            margin-left:0.1rem;
            border-radius:2px;
        }
        .data_text{
            font-size:0.28rem;
        }

        .upload_container{
            width:1.5rem;
        }
        .upload_data_btn{
            display:inline-block;
            text-align: center;
            color:black;
            font-size:0.26rem;
            position:relative;
        }
         .upload_data_btn .upload_input{
             width:100%;
             height:100%;
             opacity: 0;
             position: absolute;
             top:0;
             left:0;
         }
         .upload_data_btn img{
             width:1.5rem;
         }
         .list-om{
             position:relative;
         }
        @media screen and (max-width:320px){
            .data_box{
                text-align: left;
                padding:0.3rem;
            }
            .data_btn{
                padding:0.1rem 0.12rem;
            }
            .data_list > .data_right{
                width:5.6rem;
            }
        }

         #block {
             position: absolute;
             right:1rem;
             bottom: -1.5rem;
         }
    </style>

</head>
<body>
<script>
    document.body.style.height=document.documentElement.clientHeight+"px";
</script>
<div class="list-content" style="">
    <div class="list-om" style="">
        <div class="data_box">
            <h3>资料列表</h3>
            <div class="data_lists">
                <h4 class="data_header clear">
                    <span class="data_text">运营资料</span>
                    <a href="" class="find_more">查看更多></a>
                </h4>
                <div class="data_list_box">
                    <div class="data_list clear">
                        <img class="data_left" src="/public/simpleboot/manager/images/people.jpg" alt="">
                        <div class="data_right">
                            <p>
                                <span class="data_title">招生策划</span>
                                <span class="download_count">下载次数: 135</span></p>
                            <p class="clear">
                                <span class="data_time">2017-05-30</span>
                                <span class="data_time">15:27:10</span>
                                <a class="data_btn" href="">下载</a>
                                <a class="data_btn" href="">编辑</a>
                                <a class="data_btn delete_data" href="#1">删除</a>
                            </p>
                        </div>
                    </div>
                    <div class="data_list clear">
                        <img class="data_left" src="/public/simpleboot/manager/images/people.jpg" alt="">
                        <div class="data_right">
                            <p>
                                <span class="data_title">员工培训</span>
                                <span class="download_count">下载次数: 255</span></p>
                            <p class="clear">
                                <span class="data_time">2017-05-30</span>
                                <span class="data_time">15:27:10</span>
                                <a class="data_btn" href="https://nodejs.org/dist/v6.11.2/node-v6.11.2-x64.msi">下载</a>
                                <a class="data_btn" href="">编辑</a>
                                <a class="data_btn delete_data" href="#1">删除</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="data_lists">
                <h4 class="data_header clear">
                    <span class="data_text">市场方案</span>
                    <a href="" class="find_more">查看更多></a>
                </h4>
                <div class="data_list_box">
                    <div class="data_list clear">
                        <img class="data_left" src="/public/simpleboot/manager/images/people.jpg" alt="">
                        <div class="data_right">
                            <p>
                                <span class="data_title">招生策划</span>
                                <span class="download_count">下载次数: 198</span></p>
                            <p class="clear">
                                <span class="data_time">2017-05-30</span>
                                <span class="data_time">15:27:10</span>
                                <a class="data_btn" href="">下载</a>
                                <a class="data_btn" href="">编辑</a>
                                <a class="data_btn delete_data" href="#1">删除</a>
                            </p>
                        </div>
                    </div>
                    <div class="data_list clear">
                        <img class="data_left" src="/public/simpleboot/manager/images/people.jpg" alt="">
                        <div class="data_right">
                            <p>
                                <span class="data_title">员工培训</span>
                                <span class="download_count">下载次数: 166</span></p>
                            <p class="clear">
                                <span class="data_time">2017-05-30</span>
                                <span class="data_time">15:27:10</span>
                                <a class="data_btn" href="https://nodejs.org/dist/v6.11.2/node-v6.11.2-x64.msi">下载</a>
                                <a class="data_btn" href="">编辑</a>
                                <a class="data_btn delete_data" href="#1">删除</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="upload_container block" id="block">
            <a class="upload_data_btn" href="upload_data.html">
                <img src="/public/simpleboot/manager/images/upload_cloud.svg" alt=""><br>
                上传资料
            </a>
        </div>
    </div>
</div>
<script>
    // 获取节点
    var block = document.getElementById("block");
    var oW,oH;
    // 绑定touchstart事件
    block.addEventListener("touchstart", function(e) {
        console.log(e);
        var touches = e.touches[0];
        oW = touches.clientX - block.offsetLeft;
        oH = touches.clientY - block.offsetTop;
        //阻止页面的滑动默认事件
        document.addEventListener("touchmove",defaultEvent,false);
    },false);

    block.addEventListener("touchmove", function(e) {
        var touches = e.touches[0];
        var oLeft = touches.clientX - oW;
        var oTop = touches.clientY - oH;
        if(oLeft < 0) {
            oLeft = 0;
        }else if(oLeft > document.documentElement.clientWidth - block.offsetWidth) {
            oLeft = (document.documentElement.clientWidth - block.offsetWidth);
        }
        block.style.left = oLeft + "px";
        block.style.top = oTop + "px";
    },false);

    block.addEventListener("touchend",function() {
        document.removeEventListener("touchmove",defaultEvent,false);
    },false);
    function defaultEvent(e) {
        e.preventDefault();
    }


    var delete_btn = $('.delete_data');//删除按钮
    $.each(delete_btn,function (i,e) {
        (function(j){
            console.log(j);
            delete_btn.eq(j).click(function(){
                var br = confirm("确认删除此选项？");
                if(br){
                    $(this).parent().parent().parent().remove();
                }
            })
        })(i);
    })
</script>
</body>
</html>
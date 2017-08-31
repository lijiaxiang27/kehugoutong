<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>入校支持申请详情</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="/public/simpleboot/manager/js/multi-picker-master/MultiPicker/MultiPicker.css">
    <script src="/public/simpleboot/headmaster/js/rootfont.js"></script>
<script src="/public/simpleboot/headmaster/js/clipboard.min.js"></script>
<script src="/public/simpleboot/headmaster/js/jquery-1.10.1.min.js"></script>
<link rel="stylesheet" href="/public/simpleboot/headmaster/css/main.css" />
<link rel="stylesheet" href="/public/simpleboot/headmaster/css/manager.css">
<link rel="stylesheet" href="/public/simpleboot/manager/css/manager-v2.0.css">


</head>
<body>
<script>
    document.body.style.height=document.documentElement.clientHeight+"px";
</script>
<div class="list-content">
    <div class="list-om">
        <div class="Application-detail-header">
            <img class="detail-header-people" src='<?php echo sp_get_user_avatar_url($data["avatar"]);?>' alt="">
            <div class="detail-header-right">
                <p class="school-master-name"><?php echo ($data["master_name"]); ?></p>
                <p class="school-name">凹凸个性教育<?php echo ($data["user_nicename"]); ?></p>
                <span class="approval-result approval-result-detail"  id="approvalResult"><?php if($data['status'] <= 1 ): ?>待审批<?php elseif($data['status'] <= 3 ): ?>已同意<?php elseif($data['status'] == 4 ): ?>已拒绝<?php endif; ?></span>
            </div>
        </div>
        <hr/>
        <div class="Application-detail-content">
            <p><span class="detail-content-name">校区名称： </span><span><?php echo ($data["user_nicename"]); ?></span></p>
            <p><span class="detail-content-name">所在地区： </span><span><?php echo ($data["user_area"]); ?></span></p>
            <?php if(!empty($data['title'])): ?><p><span class="detail-content-name">支持名称： </span><span><?php echo ($data["title"]); ?></span></p><?php endif; ?>

            <?php if(!empty($data['start'])): ?><p><span class="detail-content-name">开始时间： </span><span><?php echo (date("Y年m月d天 H:i", $start)); ?></span></p><?php endif; ?>
            <?php if(!empty($data['end'])): ?><p><span class="detail-content-name">结束时间： </span><span><?php echo (date("Y年m月d天 H:i", $end)); ?></span></p><?php endif; ?>

            <?php if(!empty($data['continue'])): ?><p><span class="detail-content-name">支持天数： </span><span>6天</span></p><?php endif; ?>
            <div class="detail-content-bottom">
                <span class="detail-content-name  support-content">支持内容：</span>
                <div>
                    <p><?php echo ($data["content"]); ?></p>
                </div>
            </div>
        </div>
        <div  class="application-status">
            <div class="application-status-left">
                <img class="success-img" src="/public/simpleboot/manager/images/success.png" alt="申请成功">
               <img class="status-img" id="status-img" src="/public/simpleboot/manager/images/clock-2.png" alt="审批中">
                <img class="send-img" style="display: none" id="send-img" src="/public/simpleboot/manager/images/success.png" alt="审批中">



                <span class="z-index-box"></span>
            </div>
            <div class="application-status-right">
                 <div class="successful-application">
                     <img src='<?php echo sp_get_user_avatar_url($data["avatar"]);?>' alt="校长头像" title="校长头像">
                     <div>
                         <p><span><?php echo ($data["master_name"]); ?></span> 提交申请成功</p>
                         <span><?php echo (date("Y-m-d", $data["time"])); ?></span>
                     </div>
                 </div>
                 <div class="successful-application status-during">
                     <img src='<?php echo sp_get_user_avatar_url($now_user["avatar"]);?>' alt="经理头像" title="经理头像">
                     <div>
                         <p><?php echo ($now_user["user_nicename"]); ?>
 <span class="approval-result"  id="approvalResult2"><?php if($data['status'] <= 1 ): ?>待审批<?php elseif($data['status'] <= 3 ): ?>已同意<?php elseif($data['status'] == 4 ): ?>已拒绝<?php endif; ?></span>
                         </p>
                         <span><?php echo (date("Y-m-d",$data["passtime"])); ?></span>
                     </div>
                 </div>

                <div class="successful-application status-during" id="approvalResult3" style="display:none">
                    <img src="<?php echo sp_get_user_avatar_url($now_user["avatar"]);?>" alt="经理头像" title="经理头像">
                    <div >
                        <p><span class="approval-result" id="persons">
                            <?php if(is_array($send_users_name)): $i = 0; $__LIST__ = $send_users_name;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; echo ($vo["user_nicename"]); ?>、<?php endforeach; endif; else: echo "" ;endif; ?>
                        </span> 将入校支持</p>
                        <span>2017-03-24</span>
                    </div>
                </div>

            </div>
        </div>
        <!--footer-->
        <?php if($data['status'] <= 1 ): ?><footer id="footer">
                <ul>
                    <li class="footer-left" id="agree"><a href='javascript:void(0)'>同意</a></li>
                    <li class="footer-right" id="refuse"><a href='javascript:void(0)'>拒绝</a></li>
                </ul>
            </footer>
            <?php elseif($data['status'] >= 2 ): ?>
            <footer>
    <ul class="footer-nav">
        <li>
            <a href="<?php echo leuu('index/index');?>">
                <img src="/public/simpleboot/manager/images/clock.png" alt="">
                <p>申请处理</p>
            </a>
        </li>
        <li>
            <a href="<?php echo leuu('Active/index');?>">
                <img src="/public/simpleboot/manager/images/activity-manager.png" alt="">
                <p>活动管理</p>
            </a>
        </li>
        <li>
            <a href="<?php echo leuu('Material/index');?>">
                <img src="/public/simpleboot/manager/images/data.png" alt="">
                <p>资料更新</p>
            </a>
        </li>
        <li>
            <a href="<?php echo leuu('School/index');?>">
                <img src="/public/simpleboot/manager/images/school.png" alt="">
                <p>校区管理</p>
            </a>
        </li>
        <li>
            <a href="<?php echo leuu('User/index');?>">
                <img src="/public/simpleboot/manager/images/user-center1.png" alt="">
                <p>个人中心</p>
            </a>
        </li>
    </ul>
</footer><?php endif; ?>
        <img class="passed" src="/public/simpleboot/manager/images/pass.png" alt="">
        <!--同意弹出容器-->
        <div class="app_alert_page_box" id="alert_box">
            <div class="app_alert_page">
                <p>选派运营经理：</p>
                <div class="send_managers_box" id="send_managers_box">

                </div>
                <p class="app_alert_add_btn" id="add_btn">添加+</p>
                <p class="send_managers_btns">
                    <!--<button class="send_managers_btn" id="add_manager_no">取消</button>-->
                    <button class="send_managers_btn" id="add_manager_yes">确定</button>
                </p>
            </div>
        </div>

        <div id="targetContainer"></div>
    </div>
</div>
<script src="/public/simpleboot/manager/js/multi-picker-master/MultiPicker/MultiPicker.js"></script>
<script>


        var spans = document.getElementsByClassName('approval-result');
        var agree = document.getElementById('agree');
        var refuse = document.getElementById('refuse');
        var span1 = document.getElementById('approvalResult');
        var span2 = document.getElementById('approvalResult2');
        var img = document.getElementById('status-img');
        var ani = document.querySelector('.passed');
        var footer = document.getElementById('footer');
        var alert_box = $('#alert_box');

        var left = $('.application-status-left');//左侧三个图片列表   ************************8.31
        var three = $('#approvalResult3');       // 派遣容器，页面加载拒绝则不显示***************8.31
        var send_img = $('#send-img');           // 左侧第三个图片****************************8.31
        var send_persons = $('#persons');        //获取派遣入校支持的容器**********************8.31

        /*页面加载判断状态改变字体颜色和图片url*/
        if(span1.innerHTML == "已同意"){
            span1.style.color = "#F8B42C";img.src='/public/simpleboot/manager/images/success.png';span2.innerHTML='已同意';span2.style.color = "rgb(0,196,109)";
            ani.style.display ='block';ani.src="/public/simpleboot/manager/images/pass.png";ani.setAttribute('class','pass-ed');
            three.css('display','block');//*************************8.31
            left.css('height','4.3rem');//*************************8.31
            send_img.css('display','block');//*************************8.31

        }

        if(span1.innerHTML == "已拒绝"){
            span1.style.color = "red";img.src='/public/simpleboot/manager/images/error.png';span2.innerHTML='已拒绝';span2.style.color = "red";
            ani.style.display ='block';ani.src="/public/simpleboot/manager/images/refuse.png";ani.setAttribute('class','refuse-ed');
            three.css('display','none');//*************************8.31
            left.css('height','2.6rem');//*************************8.31
            send_img.css('display','none');//*************************8.31
        }


        for(var i = 0,len = spans.length;i < len;i++){
            if(spans[i].innerHTML == "已处理" || spans[i].innerHTML == "已同意"){
                spans[i].style.color = "rgb(0,196,109)"
            }
            if(spans[i].innerHTML == "待审批" || spans[i].innerHTML == "审批中"){
                spans[i].style.color = "#F8B42C"
            }
        }
        /*页面加载判断状态改变字体颜色和图片url end*/



        agree.addEventListener('click',function () {
            var br = confirm("同意？");
            if(br){
                alert_box.fadeIn();
                /*$.ajax({
                    type:'post',
                    url : "<?php echo leuu('index/apply_status1');?>",
                    data :{
                        'id':"<?php echo ($data['id']); ?>",'type':"<?php echo ($type); ?>",'status':'2'
                    },
                    dataType :'json',
                    success : function(msg){
                        if (msg.code == 200) {
                            span1.innerHTML = '已同意';
                            span1.style.color = "rgb(0,196,109)";
                            span2.innerHTML = '已同意';
                            span2.style.color = "rgb(0,196,109)";
                            img.src="/public/simpleboot/manager/images/success.png";
                            img.alt='已同意';
                            if(ani){
                                ani.src= "/public/simpleboot/manager/images/pass.png";
                                ani.setAttribute('class','pass');
                                ani.setAttribute('style','display:block');
                                footer.setAttribute('style','display:none');
                            }
                        }else {
                            alert('提交失败！');
                        }

                    }
                });*/
            }
        });
        refuse.addEventListener('click',function () {
            var br = confirm("拒绝？");
            if(br){
                $.ajax({
                    type:'post',
                    url : "<?php echo leuu('index/apply_status');?>",
                    data :{
                        'id':"<?php echo ($data['id']); ?>",'type':"<?php echo ($type); ?>",'status':'4'
                    },
                    dataType :'json',
                    success : function(msg){
                        if (msg.code == 200) {
                            span1.innerHTML = '已拒绝';
                            span1.style.color = "red";
                            span2.innerHTML = '已拒绝';
                            span2.style.color = "red";
                            img.src="/public/simpleboot/manager/images/error.png";
                            img.alt='已拒绝';
                            if(ani){
                                ani.src= "/public/simpleboot/manager/images/refuse.png";
                                ani.setAttribute('class','refuse');
                                ani.setAttribute('style','display:block');
                                footer.setAttribute('style','display:none');
                            }
                        }else {
                            alert('提交失败！');
                        }

                    }
                });

            }
        });

        //8.25
        var $data = <?php echo ($framework); ?>;
        var str = [];
        var person_box = [];
        var send_box = $('#send_managers_box');
        var send_box_js = document.getElementById('send_managers_box');
        new MultiPicker({
            input: 'add_btn',
            container: 'targetContainer',
            jsonData: $data,
            success:function(arr){
                str.push(arr[1].value);
                person_box.push(arr[1].value);
                var s = str.join('>');
                var p = $('<p class="manager_css">'+s+'<a href="#1" onclick="delete_this(this)" class="add_manager_box"><img src="/public/simpleboot/manager/images/close-fill.png" alt=""></a></p>');
                send_box.append(p);
                str = [];
            }
        });

        var yes = $('#add_manager_yes');//点击派遣经理

        yes.click(function () {
            var box = [];
            if(!send_box_js.innerText){
                alert('请点击 "添加+" 按钮选择支持的经理！');
                return false;
            }
            var persons = $('.manager_css');
            $.each(persons,function (i,ele) {
                console.log(ele.innerText);
                box.push(ele.innerText);
            });
            box = box.join('、');
            var br = confirm('您将委派: '+box);
            if(br === true){
                $.ajax({
                    type:'post',
                    url : "<?php echo leuu('index/apply_status');?>",
                    data :{
                        'id':"<?php echo ($data['id']); ?>",'type':"<?php echo ($type); ?>",'status':'2','managers':box
                    },
                    dataType :'json',
                    success : function(msg){
                        if (msg.code == 200) {

                            left.css('height','4.5rem');     //*********************************8.31
                            three.fadeIn(200);               //*********************************8.31
                            alert_box.fadeOut();             //*********************************8.31
                            send_img.css('display','block'); //*********************************8.31
                            console.log(box);
                            send_persons.html(box);               //*********************************8.31

                            span1.innerHTML = '已同意';
                            span1.style.color = "rgb(0,196,109)";
                            span2.innerHTML = '已同意';
                            span2.style.color = "rgb(0,196,109)";
                            img.src="/public/simpleboot/manager/images/success.png";
                            img.alt='已同意';
                            if(ani){
                                ani.src= "/public/simpleboot/manager/images/pass.png";
                                ani.setAttribute('class','pass');
                                ani.setAttribute('style','display:block');
                                footer.setAttribute('style','display:none');
                            }
                        }else {
                            alert('提交失败！');
                        }

                    }
                });
            }
            else{
                return false;
            }
        });
        function delete_this(ele){
            var element = ele;
            element.parentNode.parentNode.removeChild(element.parentNode);//点击x移除this的父级。
        }

        //2.遍历防止重复添加#

</script>
</body>
</html>
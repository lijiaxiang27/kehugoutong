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
            <a href="">
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


    </div>
</div>
<script>
    window.onload=function(){

        function hasClass(obj, cls) {
            return obj.className.match(new RegExp('(\\s|^)' + cls + '(\\s|$)'));
        }

        function addClass(obj, cls) {
            if (!this.hasClass(obj, cls)) obj.className += " " + cls;
        }

        function removeClass(obj, cls) {
            if (hasClass(obj, cls)) {
                var reg = new RegExp('(\\s|^)' + cls + '(\\s|$)');
                obj.className = obj.className.replace(reg, ' ');
            }
        }

        function toggleClass(obj,cls){
            if(hasClass(obj,cls)){
                removeClass(obj, cls);
            }else{
                addClass(obj, cls);
            }
        }

        var spans = document.getElementsByClassName('approval-result');
        var agree = document.getElementById('agree');
        var refuse = document.getElementById('refuse');
        var span1 = document.getElementById('approvalResult');
        var span2 = document.getElementById('approvalResult2');
        var img = document.getElementById('status-img');
        var ani = document.querySelector('.passed');
        var footer = document.getElementById('footer');

        if(span1.innerHTML == "已同意"){
            span1.style.color = "#F8B42C";
            img.src='/public/simpleboot/manager/images/success.png';
            span2.innerHTML='已同意';
            span2.style.color = "rgb(0,196,109)";
            ani.style.display ='block';
            ani.src="/public/simpleboot/manager/images/pass.png";
            ani.setAttribute('class','pass-ed');
        }

        if(span1.innerHTML == "已拒绝"){
            span1.style.color = "red";
            img.src='/public/simpleboot/manager/images/error.png';
            span2.innerHTML='已拒绝';
            span2.style.color = "red";
            ani.style.display ='block';
            ani.src="/public/simpleboot/manager/images/refuse.png";
            ani.setAttribute('class','refuse-ed');
        }

        for(var i = 0,len = spans.length;i < len;i++){
            if(spans[i].innerHTML == "已处理" || spans[i].innerHTML == "已同意"){
                spans[i].style.color = "rgb(0,196,109)"
            }
            if(spans[i].innerHTML == "待审批" || spans[i].innerHTML == "审批中"){
                spans[i].style.color = "#F8B42C"
            }
            if(spans[i].innerHTML == "已拒绝"){
                spans[i].style.color = "red"
            }
        }

        agree.addEventListener('click',function () {
            var br = confirm("同意？");
            if(br){
                $.ajax({
                    type:'post',
                    url : "<?php echo leuu('index/apply_status');?>",
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
                });


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
        })
    }

</script>
</body>
</html>
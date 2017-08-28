<?php
namespace User\Controller;

use Common\Controller\AdminbaseController;

class IndexadminController extends AdminbaseController {
    
    // 后台本站用户列表
    public function index(){
        $where=array();
        $request=I('request.');
        
        if(!empty($request['uid'])){
            $where['id']=intval($request['uid']);
        }
        
        if(!empty($request['keyword'])){
            $keyword=$request['keyword'];
            $keyword_complex=array();
            $keyword_complex['user_login']  = array('like', "%$keyword%");
            $keyword_complex['user_nicename']  = array('like',"%$keyword%");
            $keyword_complex['user_email']  = array('like',"%$keyword%");
            $keyword_complex['_logic'] = 'or';
            $where['_complex'] = $keyword_complex;
        }
        
    	$users_model=M("Users");
    	$where['user_type'] = 2;
    	$count=$users_model->where($where)->count();
    	$page = $this->page($count, 20);
    	
    	$list = $users_model
    	->where($where)
    	->order("create_time DESC")
    	->limit($page->firstRow . ',' . $page->listRows)
    	->select();
    	
    	$this->assign('list', $list);
    	$this->assign("page", $page->show('Admin'));
    	
    	$this->display(":index");
    }
    //添加校长
    public function add(){
        $yyjingli_roleid = D("role")->where(array("name"=>"运营经理"))->field('id')->find();
        $yyjingli = D("role_user as a")
                    ->join("cmf_users as b on a.user_id = b.id")
                    ->where(array("role_id"=>$yyjingli_roleid['id']))
                    ->field("b.id,b.user_login")
                    ->select();
        $this->assign('yyjingli', $yyjingli);
        $this->display();

    }
    //添加校长提交
    public function add_post(){
        $rules = array(
            //array(验证字段,验证规则,错误提示,验证条件,附加规则,验证时间)
            array('mobile', 'require', '手机号不能为空！', 1 ),
            array('mobile','','手机号已被注册！！',0,'unique',3),
            array('password','require','密码不能为空！',1),
            array('password','5,20',"密码长度至少5位，最多20位！",1,'length',3),
        );

        $users_model=M("Users");

        if($users_model->validate($rules)->create()===false){
            $this->error($users_model->getError());
        }

        $password=I('post.password');
        $mobile=I('post.mobile');

        $user_login=I('post.user_login');
        $pid=I('post.pid');

        $users_model=M("Users");
        $data=array(
            'user_login' => $user_login,
            'user_email' => '',
            'mobile' =>$mobile,
            'user_nicename' =>'',
            'user_pass' => sp_password($password),
            'last_login_ip' => get_client_ip(0,true),
            'create_time' => date("Y-m-d H:i:s"),
            'last_login_time' => date("Y-m-d H:i:s"),
            'user_status' => 1,
            "user_type"=>2,//会员
            "pid"=>$pid,
        );

        $result = $users_model->add($data);
        if($result){
            //注册成功页面跳转
            $data['id']=$result;
            session('user',$data);
            $this->success("注册成功！",U("user/indexadmin/index"));

        }else{
            $this->error("注册失败！");
        }
    }
    //编辑校长
    public function edit(){
        $yyjingli_roleid = D("role")->where(array("name"=>"运营经理"))->field('id')->find();
        $yyjingli = D("role_user as a")
            ->join("cmf_users as b on a.user_id = b.id")
            ->where(array("role_id"=>$yyjingli_roleid['id']))
            ->field("b.id,b.user_login")
            ->select();
        $this->assign('yyjingli', $yyjingli);


        $where['id'] = I('get.id');
        $user_info = D('users')->where($where)->find();
        $this->assign('user_info', $user_info);
        $this->display();
    }
    //编辑校长提交
    public function edit_post(){
        $user_model = M("users");
        $post = I("post.");
        if(empty($post['password'])){
            unset($post['password']);
        } else {
            $post['user_pass'] = sp_password($post['password']);
        }
        if ($user_model->create()!==false){
            $rs = $user_model->save();
            if ($rs) {
                $this->success("修改成功", U("indexadmin/index"));
            } else {
                $this->error('修改失败!');
            }
        } else {
            $this->error('数据传入失败');
        }
    }
    // 后台本站用户禁用
    public function ban(){
    	$id= I('get.id',0,'intval');
    	if ($id) {
    		$result = M("Users")->where(array("id"=>$id,"user_type"=>2))->setField('user_status',0);
    		if ($result) {
    			$this->success("会员拉黑成功！", U("indexadmin/index"));
    		} else {
    			$this->error('会员拉黑失败,会员不存在,或者是管理员！');
    		}
    	} else {
    		$this->error('数据传入失败！');
    	}
    }
    
    // 后台本站用户启用
    public function cancelban(){
    	$id= I('get.id',0,'intval');
    	if ($id) {
    		$result = M("Users")->where(array("id"=>$id,"user_type"=>2))->setField('user_status',1);
    		if ($result) {
    			$this->success("会员启用成功！", U("indexadmin/index"));
    		} else {
    			$this->error('会员启用失败！');
    		}
    	} else {
    		$this->error('数据传入失败！');
    	}
    }
}

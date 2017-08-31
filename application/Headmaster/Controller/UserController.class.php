<?php
namespace Headmaster\Controller;

use Common\Controller\AdminbaseController;

class UserController extends AdminbaseController{

	protected $userid;
	public function _initialize() {
		parent::_initialize();
        $this->userid = sp_get_current_admin_id();
	}
	//用户中心
	public function usercenter() {
	    //个人信息
	    $userinfo = M('users')->where(array('id'=>$this->userid))->find();
        //我的申请个数
        $apply_count1 = M('support')->where(array('userid'=>$this->userid))->count();
        $apply_count2 = M('design')->where(array('userid'=>$this->userid))->count();
        $apply_count3 = M('lecture')->where(array('userid'=>$this->userid))->count();
        $apply_count4 = M('other_app')->where(array('userid'=>$this->userid))->count();
        $apply_count = $apply_count1 + $apply_count2 + $apply_count3 + $apply_count4;
        //投诉建议个数
        $complain_count = M('complain')->where(array('userid'=>$this->userid))->count();

        $this->assign('apply_count', $apply_count);
        $this->assign('complain_count', $complain_count);
        $this->assign($userinfo);
        $this->assign('current', 4);
	    $this->display();
    }
    //个人申请列表
    public function user_apply() {
        $st = I('get.st',0);
        if ($st != 0) {
            if ($st == 1){
                $where['status'] = array('elt',$st);
            }else{
                $where['status'] = $st;
            }
        }
        $where['userid'] = $this->userid;

        $supports = M('support')->where($where)->order('time desc')->select();
        $designs = M('design')->where($where)->order('time desc')->select();
        $lectures = M('lecture')->where($where)->order('time desc')->select();
        $otherapps = M('other_app')->where($where)->order('time desc')->select();

        $count['sq'] += M('support')->where(array('userid'=>$this->userid,'status'=>array('LT', 2)))->count();
        $count['sq'] += M('design')->where(array('userid'=>$this->userid,'status'=>array('LT', 2)))->count();
        $count['sq'] += M('lecture')->where(array('userid'=>$this->userid,'status'=>array('LT', 2)))->count();
        $count['sq'] += M('other_app')->where(array('userid'=>$this->userid,'status'=>array('LT', 2)))->count();

        $count['pj'] += M('support')->where(array('userid'=>$this->userid,'status'=>2))->count();
        $count['pj'] += M('design')->where(array('userid'=>$this->userid,'status'=>2))->count();
        $count['pj'] += M('lecture')->where(array('userid'=>$this->userid,'status'=>2))->count();
        $count['pj'] += M('other_app')->where(array('userid'=>$this->userid,'status'=>2))->count();

        $count['wc'] += M('support')->where(array('userid'=>$this->userid,'status'=>3))->count();
        $count['wc'] += M('design')->where(array('userid'=>$this->userid,'status'=>3))->count();
        $count['wc'] += M('lecture')->where(array('userid'=>$this->userid,'status'=>3))->count();
        $count['wc'] += M('other_app')->where(array('userid'=>$this->userid,'status'=>3))->count();


        $this->assign('supports', $supports);
        $this->assign('designs', $designs);
        $this->assign('lectures', $lectures);
        $this->assign('otherapps', $otherapps);
        $this->assign('count', $count);
        $this->display();
    }
    public function managers(){
        //查询运营经理信息
        $yyjl = M('users')->where(array('id'=>$this->userid))->field('pid_gj,pid_jg,pid_zx,pid_sc')->find();
        $gjjl_info = M('users')->where(array('id'=>$yyjl['pid_gj']))->find();
        $jgjl_info = M('users')->where(array('id'=>$yyjl['pid_jg']))->find();
        $zxjl_info = M('users')->where(array('id'=>$yyjl['pid_zx']))->find();
        $scjl_info = M('users')->where(array('id'=>$yyjl['pid_sc']))->find();

        //查询所属大区
        $area = M('users')->where(array('id'=>$gjjl_info['pid_gj']))->field('user_area')->find();

        //查询运营经理职位 名称
        $roleid = M('role_user')->where(array('user_id'=>$yyjl['pid_gj']))->field('role_id')->find();
        $gj_rolename = M('role')->where(array('id'=>$roleid['role_id']))->field('name')->find();

        $roleid = M('role_user')->where(array('user_id'=>$yyjl['pid_jg']))->field('role_id')->find();
        $jg_rolename = M('role')->where(array('id'=>$roleid['role_id']))->field('name')->find();

        $roleid = M('role_user')->where(array('user_id'=>$yyjl['pid_zx']))->field('role_id')->find();
        $zx_rolename = M('role')->where(array('id'=>$roleid['role_id']))->field('name')->find();

        $roleid = M('role_user')->where(array('user_id'=>$yyjl['pid_sc']))->field('role_id')->find();
        $sc_rolename = M('role')->where(array('id'=>$roleid['role_id']))->field('name')->find();

        $this->assign('gjjl', $gjjl_info);
        $this->assign('jgjl', $jgjl_info);
        $this->assign('zxjl', $zxjl_info);
        $this->assign('scjl', $scjl_info);

        $this->assign('area', $area['user_area']);

        $this->assign('gj_rolename', $gj_rolename['name']);
        $this->assign('jg_rolename', $jg_rolename['name']);
        $this->assign('zx_rolename', $zx_rolename['name']);
        $this->assign('sc_rolename', $sc_rolename['name']);
        $this->display();
    }
    public function managerpj(){
        $this->display();
    }
    //我的运营经理
    public function manager() {
        //查询运营经理个人信息
        $pid_gj = I('get.pid_gj');
        $pid_jg = I('get.pid_jg');
        $pid_zx = I('get.pid_zx');
        $pid_sc = I('get.pid_sc');
        if ($pid_gj){
            $pid = 'pid_gj';
            $id = $pid_gj;
        }
        if ($pid_jg){
            $pid = 'pid_jg';
            $id = $pid_jg;
        }
        if ($pid_zx){
            $pid = 'pid_zx';
            $id = $pid_zx;
        }
        if ($pid_sc){
            $pid = 'pid_sc';
            $id = $pid_sc;
        }
        $yyjl_info = M('users')->where(array('id'=>$id))->find();
        //查询该运营经理管理校区数量
        $count = M('users')->where(array("$pid"=>$id))->count();
        //查询运营经理职位 名称
        $roleid = M('role_user')->where(array('user_id'=>$id))->field('role_id')->find();
        $rolename = M('role')->where(array('id'=>$roleid['role_id']))->field('name')->find();

        $this->assign('user', $yyjl_info);
        $this->assign('rolename', $rolename['name']);
        $this->assign("count", $count);
        $this->display();
    }
    //我的投诉建议
    public function complain() {
        //投诉
        $complains = M('complain')->where(array('userid'=>$this->userid))->order('time desc')->select();
        //建议
        $advs = M('adv')->where(array('userid'=>$this->userid))->order('time desc')->select();
        $this->assign('complains', $complains);
        $this->assign('advs', $advs);
        $this->display();
    }
    //我的申请详情页(评价页)
    public function apply_detail() {
        $id = I('get.id');
        $db = I('get.db');
        $data = M("$db")->where(array('id'=>$id))->find();
        $db_user = $db."_user";
        $db_user_model = M("$db_user");
        $send_users = $db_user_model->where(array('app_id'=>$id))->select();
        $users_model = M('users');
        foreach ($send_users as $k=>$v){
            $name = $users_model->field('user_nicename')->where(array('id'=>$v['user_id']))->find();
            $send_users[$k]['user_nicename'] = $name['user_nicename'];
        }
        $this->assign('send_users', $send_users);
        $this->assign($data);
        $this->assign("db", $db);
        $this->display();
    }
    //评价
    public function pingjia() {
        $data= I('post.');
        $post['status'] = 3;
        $post['id'] = $data['id'];
        $post['judge_time'] = time();
        $db = $data['db'];
        $post['judge'] = serialize($data['score']);
        M("$db")->create($post);
        $res = M("$db")->save();
    }
    // 密码修改
    public function password(){
        $this->display();
    }

    // 密码修改提交
    public function password_post(){
        if (IS_POST) {
            if(empty($_POST['old_password'])){
                $msg = array(
                    'code' => 0,
                    'info' => '原始密码不能为空!',
                );
                $this->ajaxReturn($msg);
            }
            if(empty($_POST['password'])){
                $msg = array(
                    'code' => 0,
                    'info' => '新密码不能为空!',
                );
                $this->ajaxReturn($msg);
            }
            $user_obj = D("Common/Users");
            $uid=sp_get_current_admin_id();
            $admin=$user_obj->where(array("id"=>$uid))->find();
            $old_password=I('post.old_password');
            $password=I('post.password');
            if(sp_compare_password($old_password,$admin['user_pass'])){
                if($password==I('post.repassword')){
                    if(sp_compare_password($password,$admin['user_pass'])){
                        $msg = array(
                            'code' => 0,
                            'info' => '新密码不能和原始密码相同!',
                        );
                        $this->ajaxReturn($msg);
                    }else{
                        $data['user_pass']=sp_password($password);
                        $data['id']=$uid;
                        $r=$user_obj->save($data);
                        if ($r!==false) {
                            $msg = array(
                                'code' => 1,
                                'info' => U('headmaster/user/usercenter'),
                            );
                            $this->ajaxReturn($msg);
                        } else {
                            $msg = array(
                                'code' => 0,
                                'info' => '修改失败!',
                            );
                            $this->ajaxReturn($msg);
                        }
                    }
                }else{
                    $msg = array(
                        'code' => 0,
                        'info' => '密码输入不一致!',
                    );
                    $this->ajaxReturn($msg);
                }

            }else{
                $msg = array(
                    'code' => 0,
                    'info' => '原始密码不正确!',
                );
                $this->ajaxReturn($msg);
            }
        }
    }

}
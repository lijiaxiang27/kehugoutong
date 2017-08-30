<?php
/**
 * 运营经理后台首页
 */
namespace Manager\Controller;

use Common\Controller\AdminbaseController;

class IndexController extends AdminbaseController {
	
	public function _initialize() {
	    empty($_GET['upw'])?"":session("__SP_UPW__",$_GET['upw']);//设置后台登录加密码	    
		parent::_initialize();
		$this->initMenu();
	}
    function _empty()
    {
        header("HTTP/1.0 404 Not Found");
        $this->display("Public:404");
    }
    //申请列表
    public function index() {
        $school_str = $this->get_schools();
        $where['userid'] = array('in',"$school_str");
        $post = I('get.status');
        if ($post == 1){
            $where['status'] = array('elt', 1);
        } elseif($post == 2) {
            $where['status'] = array('gt', 1);
        } else {

        }
        //设计申请
        $designs = M('design')->alias('a')
                                ->join('__USERS__ as b on a.userid=b.id')
                                ->field('a.id,a.title,a.time,a.status,b.user_nicename,b.avatar')
                                ->where($where)
                                ->select();
        //入校支持
        $supports = M('support')->alias('a')
                                ->join('__USERS__ as b on a.userid=b.id')
                                ->field('a.id,a.title,a.time,a.status,b.user_nicename,b.avatar')
                                ->where($where)
                                ->select();
        //家庭讲座
        $lectures = M('lecture')->alias('a')
                                ->join('__USERS__ as b on a.userid=b.id')
                                ->field('a.id,a.title,a.time,a.status,b.user_nicename,b.avatar')
                                ->where($where)
                                ->select();
        //其他申请
        $others = M('other_app')->alias('a')
            ->join('__USERS__ as b on a.userid=b.id')
            ->field('a.id,a.content,a.time,a.status,b.user_nicename,b.avatar')
            ->where($where)
            ->select();

        $this->assign('designs', $designs);
        $this->assign('supports', $supports);
        $this->assign('lectures', $lectures);
        $this->assign('others', $others);

        $this->display();
    }
    //申请详情
    public function application_detail(){
        $type = I('get.type');
        $id = I('get.id');
        $data = M("$type")->alias('a')
                            ->join('__USERS__ as b on a.userid=b.id')
                            ->field('a.*,b.user_nicename,b.avatar,b.master_name,b.user_area')
                            ->where(array('a.id'=>$id))
                            ->find();
        //得到当前用户信息
        $now_user = $this->get_user_now();
        $framework = $this->get_framework();

        $this->assign('now_user', $now_user);
        $this->assign('data', $data);
        $this->assign('type', $type);
        $this->assign('framework', $framework);
        $this->display();
    }
    //改变支持申请的状态
    public function apply_status(){
        $data = I('post.');
        $table = $data['type'];
        $data['passtime'] = time();

        if (M("$table")->create($data) !== false) {
            $result = M("$table")->save();
            if ($result !== false) {
                $rs = array(
                    'code' => 200
                );
                $this->ajaxReturn($rs);
            } else {
                $rs = array(
                    'code' => 400
                );
                $this->ajaxReturn($rs);
            }
        }

    }
    //得到名下的校区id
    public function get_schools(){
        $uid=sp_get_current_admin_id();
        $role_id = M('role_user')->field('role_id')->where(array('user_id'=>$uid))->find();
        switch ($role_id['role_id']){
            case '5':
                $role = 'pid_qy';
                break;
            case '6':
                $role = 'pid_gj';
                break;
            case '7';
                $role = 'pid_sc';
                break;
            case '8';
                $role = 'pid_zx';
                break;
            case '3';
                $role = 'pid_jg';
                break;
            default:
                $role = 'pid_gj';
                break;
        }
        $school_ids = M('users')->field('id')->where(array($role=>$uid))->select();
        $str = '';
        foreach($school_ids as $k=>$v){
            $str .= $v['id'] . ',';
        }
        $school_str = rtrim($str, ',');
        return $school_str;
    }
    //得到登录用户信息
    public function get_user_now(){
        $uid=sp_get_current_admin_id();
        $data = M('users')->field('user_nicename,avatar')->where(array('id'=>$uid))->find();
        return $data;
    }
    /**
     *9	管理资料
     *8	咨询经理
     *7	市场经理
     *6	高级运营经理
     *5	区域经理
     *4	校长
     *3	教管经理
     *2	总部
     *1	超级管理员
     */
//    得到大区经理，运营经理的架构
    public function get_framework(){
        $arr[] = [];
        $data = M('users')->alias('a')->join('__ROLE_USER__ as b on a.id=b.user_id')->field('a.id,a.user_nicename as value,a.pid_gj,b.role_id')->select();
        foreach ($data as $k=>$v){
            if($v['role_id'] == 2) {
                $root[] = $v;
            }
            if ($v['role_id'] == 5) {
                $qy[] = $v;
            }
            if (in_array($v['role_id'],array(3,6,7,8))){
                $jl[] = $v;
            }
            if ($v['role_id'] == 4) {
                $xz[] = $v;
            }
        }
        $arr = $qy;
        foreach($qy as $m=>$n){
            foreach ($jl as $mm=>$nn){
                if ($nn['pid_gj'] == $n['id']){
                    $arr[$m]['child'][] = $nn;
                }
            }
        }
        foreach ($arr as $k=>$v){
            foreach ($v as $kk=>$vv){
                if ($kk == "pid_gj"){
                    unset($arr[$k][$kk]);
                }
                if ($kk == "role_id"){
                    unset($arr[$k][$kk]);
                }
                if ($kk == "child"){
                    foreach($vv as $kkk=>$vvv){
                        foreach($vvv as $kkkk=>$vvvv){
                            if ($kkkk == "pid_gj"){
                                unset($arr[$k]['child'][$kkk][$kkkk]);
                            }
                            if ($kkkk == "role_id"){
                                unset($arr[$k]['child'][$kkk][$kkkk]);
                            }
                        }

                    }
                }
            }
        }
        return json_encode($arr);
    }
}


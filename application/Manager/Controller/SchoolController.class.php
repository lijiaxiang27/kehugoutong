<?php
/**
 * Created by PhpStorm.
 * User: tester
 * Date: 17/7/19
 * Time: 14:42
 */

namespace Manager\Controller;


use Common\Controller\AdminbaseController;

class SchoolController extends AdminbaseController
{
    public function _initialize() {
        parent::_initialize();
    }
//    校区列表
    public function index(){
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
        $schools = M('users')->field('id,master_name,user_nicename,user_login')->order('id desc')->where(array($role=>$uid))->select();
        $this->assign('schools', $schools);
        $this->display();
    }
//    新增校区
    public function add_school(){
        $user_model = A("Admin/User");

        //高级运营经理列表
        $gj = $user_model->get_gjjl();
        //学管经理列表
        $jg = $user_model->get_jgjl();
        //咨询经理列表
        $zx = $user_model->get_zxjl();
        //市场经理列表
        $sc = $user_model->get_scjl();



        $this->assign('gjjls', $gj);
        $this->assign('jgjls', $jg);
        $this->assign('zxjls', $zx);
        $this->assign('scjls', $sc);
        $this->display();
    }
    // 校区添加提交
    public function add_school_post(){
        if(IS_POST){
            if(!empty($_POST['role_id']) && is_array($_POST['role_id'])){
                $role_ids=$_POST['role_id'];
                unset($_POST['role_id']);
                if ($this->users_model->create()!==false) {
                    $result=$this->users_model->add();
                    if ($result!==false) {
                        $role_user_model=M("RoleUser");
                        foreach ($role_ids as $role_id){
                            if(sp_get_current_admin_id() != 1 && $role_id == 1){
                                $this->error("为了网站的安全，非网站创建者不可创建超级管理员！");
                            }
                            $role_user_model->add(array("role_id"=>$role_id,"user_id"=>$result));
                        }
                        $this->success("添加成功！", U("user/index"));
                    } else {
                        $this->error("添加失败！");
                    }
                } else {
                    $this->error($this->users_model->getError());
                }
            }else{
                $this->error("请为此用户指定角色！");
            }

        }
    }
}
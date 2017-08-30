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

    /**
     * Effect  :  获取用户ID 及 角色
     * @return : array  $user
     * @return : $user['id']   = 当前用户ID
     * @return : $user['role'] = 当前用户角色
     */
    private function _get_user()
    {
        $user['uid']=sp_get_current_admin_id();
        $role_id = M('role_user')->field('role_id')->where(array('user_id'=>$user['uid']))->find();
        switch ($role_id['role_id']){
            case '5':
                $user['role'] = 'pid_qy';
                break;
            case '6':
                $user['role'] = 'pid_gj';
                break;
            case '7';
                $user['role'] = 'pid_sc';
                break;
            case '8';
                $user['role'] = 'pid_zx';
                break;
            case '3';
                $user['role'] = 'pid_jg';
                break;
            default:
                $user['role'] = 'pid_gj';
                break;
        }

        return $user;
    }



//    校区列表
    public function index(){

        $user = $this -> _get_user();
        $schools = M('users')->field('id,master_name,user_nicename,user_login')->order('id desc')->where(array( $user['role']=>$user['uid']))->select();
        $this->assign('schools', $schools);
        $this->display();
    }


    /**
     * Effect   : 添加校区视图
     * @assign  : role  当前用户角色
     * @display :
     */
    public function add_school(){
        $user_model = A("Admin/User");
        $user = $this -> _get_user();

        if ($user['role']!='pid_gj'){
            //高级运营经理列表
            $gj = $user_model->get_gjjl();
            $this->assign('gjjls', $gj);
        }
        if ($user['role']!='pid_xg'){
            //学管经理列表
            $jg = $user_model->get_jgjl();
            $this->assign('jgjls', $jg);
        }
        if ($user['role']!='pid_zx'){
            //咨询经理列表
            $zx = $user_model->get_zxjl();
            $this->assign('zxjls', $zx);
        }
        if ($user['role']!='pid_sc'){
            //市场经理列表
            $sc = $user_model->get_scjl();
            $this->assign('scjls', $sc);
        }

        $this->assign('role',$user['role']);
        $this->display();
    }

    /**
     * Effect  : 校区添加
     * Request :  ajax.post
     * @return : json
     */
    public function add_school_post(){
        if(IS_POST){
            //填充数据
            $data = I('post.');
            $data['user_pass']='123456';

            $mng = $this -> _get_user();
            $data[$mng['role']] = $mng['uid'];
            $user = D('Common/Users');

            if ($user->create($data)!==false) {
                $result=$user->add($data);
                if ($result!==false) {
                    $role_user_model=M("RoleUser");
                    $role_user_model->add(array("role_id"=>4,"user_id"=>$result));
                }

                $msg = array('code'=>200,'info'=>'添加成功');
            }else{
                $info = $user -> getError();
                $msg = array('code'=>400,'info'=>$info);
            }

            $this -> ajaxReturn($msg);
        }
    }


}
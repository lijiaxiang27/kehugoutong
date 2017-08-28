<?php
/**
 * Created by PhpStorm.
 * User: tester
 * Date: 17/7/20
 * Time: 14:22
 */

namespace Manager\Controller;


use Common\Controller\AdminbaseController;

class UserController extends AdminbaseController
{
    protected $user_model;
	protected $app;
    public function _initialize()
    {
        parent::_initialize();
        $this->user_model = M('users');
		
		$config = [
            'debug'     => C('DEBUG'),
            'app_id'    => C('APP_ID'),
            'secret'    => C('SECRET'),
            'token'     => C('TOKEN'),
            'log' => C('LOG'),
            'oauth' => C('OAUTH'),
            // ..
        ];
        $this->app = new \EasyWeChat\Foundation\Application($config);
    }
//    个人中心首页
    public function index(){
        $uid = sp_get_current_admin_id();
        $user_info = $this->user_model->field('id,user_login,user_nicename,avatar,signature,user_email,user_wx,skill,pid_gj')->where(array('id'=>$uid))->find();
        $tmp = $this->user_model->field('user_area')->where(array('id'=>$user_info['pid_gj']))->find();
        $user_info['user_area'] = $tmp['user_area'];
        $user_info['skill'] = str_replace('|', ';', $user_info['skill']);
        $js = $this->app->js;
		$aa = $js->config(array('chooseImage', 'uploadImage', 'downloadImage'), false, false, false);
		$jsApiList = '';
		foreach($aa['jsApiList'] as $k=>$v){
			$jsApiList .= "'" . $v . "'" . ',';
		}
		$jsApiList = rtrim($jsApiList, ',');
		$this->assign('str', $aa);
		$this->assign('jsApiList', $jsApiList);
		
        $this->assign($user_info);
        $this->display();
    }
	
	public function add_img(){
		$media_id = I('get.media');
		$data['avatar'] = $this->getmedia($media_id);
		$uid = sp_get_current_admin_id();
		$rs = $this->user_model->where(array('id'=>$uid))->save($data);
		if($rs){
			$msg = array(
				'code' => 200,
				'info' => '更新成功！'
			);
		} else {
			$msg = array(
				'code' => 400,
				'info' => '更新失败！'
			);
		}
		$this->ajaxReturn($msg);
		
	}
	//保存头像
	private function getmedia($media_id){
		$temporary = $this->app->material_temporary;
		$img_url = "." . C("TMPL_PARSE_STRING.__UPLOAD__")."avatar/";
		$img_url_short = "upload_".date('YmdHis').rand(1000,9999);
		
		$temporary->download($media_id, $img_url, $img_url_short);
		return $img_url_short.".jpg";
        
    }
	
	//修改个人介绍
	public function update_introduce(){
		$uid = sp_get_current_admin_id();
		$signature = I('get.signature');
		if(!empty($signature)){
			$data['signature'] = $signature;
			$rs = $this->user_model->where(array('id'=>$uid))->save($data);
			if($rs){
				$msg = array(
					'code' => 200,
					'info' => '更新成功！'
				);
			} else {
				$msg = array(
					'code' => 400,
					'info' => '更新失败！'
				);
			}
		} else {
			$msg = array(
					'code' => 400,
					'info' => '更新失败！'
				);
		}
		$this->ajaxReturn($msg);
	}
    //修改提交
    public function updateTag(){
        $str = I('post.skill');
        $uid = sp_get_current_admin_id();
        if(!empty($str)){
            $data['skill'] = $str;
            $rs = $this->user_model->where(array('id'=>$uid))->save($data);
            if($rs){
                $msg = array(
                    'code' => 200,
                    'info' => '更新成功！'
                );
            } else {
                $msg = array(
                    'code' => 400,
                    'info' => '更新失败！'
                );
            }
        } else {
            $msg = array(
                    'code' => 400,
                    'info' => '更新失败！'
                );
        }
        $this->ajaxReturn($msg);

    }
    //修改标签
    public function personalTag(){
        $uid = sp_get_current_admin_id();
        $user_info = $this->user_model->field('id,skill')->where(array('id'=>$uid))->find();
        $tags = explode('|',$user_info['skill']);
        $this->assign('tags', $tags);
        $this->display();
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
                                'info' => U('manage/user/index'),
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
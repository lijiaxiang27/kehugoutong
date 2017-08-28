<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2014 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Tuolaji <479923197@qq.com>
// +----------------------------------------------------------------------
/**
 */
namespace Admin\Controller;
use Common\Controller\AdminbaseController;
class PublicController extends AdminbaseController {
    protected $app;
    protected $user_info;
    public function _initialize() {
        C(S('sp_dynamic_config'));//加载动态配置
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
    public function yanzheng(){

        $server = $this->app->server;
        $user = $this->app->user;

        $server->setMessageHandler(function($message) use ($user) {
            $fromUser = $user->get($message->FromUserName);

            return "{$fromUser->nickname} 您好！欢迎关注 overtrue!";
        });

        $server->serve()->send();
        //return $server->serve();
    }
    public function wysq(){
        $oauth = $this->app->oauth;
        // 未授权
        if (empty($_SESSION['wechat_user'])) {
            $_SESSION['target_url'] = '/index.php?g=admin&m=public&a=wysq';
            //return $oauth->redirect();
            // 这里不一定是return，如果你的框架action不是返回内容的话你就得使用
            $oauth->redirect()->send();
        }
        // 已经授权过
        $this->user_info = $_SESSION['wechat_user'];
        //判断用户的openid是否存在数据库中,存在,则直接登录,不存在,则需要绑定账号(手机)
        $userinfo = $this->user_info;
        $user_openid = $userinfo['id'];
        $this->users_model=D("Common/Users");
        $rs=$this->users_model->where(array("openid"=>$user_openid))->find();
        if ($rs) {
            session('ADMIN_ID',$rs["id"]);
            $this->login();
//            $roleid = M('role_user')->where(array("user_id"=>$rs["id"]))->field("role_id")->find();
//            if ($roleid['role_id'] == 4) {
//                $admin_id=session('ADMIN_ID');
//                //$this->success(L('LOGIN_SUCCESS'),U("headmaster/index/index"));
//                $this->redirect(U("headmaster/index/index"));
//            } else {
//                $admin_id=session('ADMIN_ID');
//                //$this->success(L('LOGIN_SUCCESS'),U("admin/index/index"));
//                $this->redirect(U("admin/index/index"));
//            }
        } else {
            $this->login();
        }


    }
    public function cb() {
        $oauth = $this->app->oauth;
        // 获取 OAuth 授权结果用户信息
        $user = $oauth->user();
        $_SESSION['wechat_user'] = $user->toArray();
        $targetUrl = empty($_SESSION['target_url']) ? '/' : $_SESSION['target_url'];
        header('location:'. $targetUrl);
    }
    //后台登陆界面
    public function login() {
        $admin_id=session('ADMIN_ID');
        $yyjls = array('3', '8', '7', '6', '5');
    	if(!empty($admin_id)){//已经登录
            $roleid = M('role_user')->where(array("user_id"=>$admin_id))->field("role_id")->find();
            if ($roleid['role_id'] == 4) {
                redirect(U("headmaster/index/index"));
            } elseif (in_array($roleid['role_id'], $yyjls)){
                redirect(U("manager/index/index"));
            } else {
                redirect(U("admin/index/index"));
            }

    	}else{
    	    $site_admin_url_password =C("SP_SITE_ADMIN_URL_PASSWORD");
    	    $upw=session("__SP_UPW__");
    		if(!empty($site_admin_url_password) && $upw!=$site_admin_url_password){
    			redirect(__ROOT__."/");
    		}else{
    		    session("__SP_ADMIN_LOGIN_PAGE_SHOWED_SUCCESS__",true);
    			$this->display(":login");
    		}
    	}
    }
    
    public function logout(){
    	session('ADMIN_ID',null); 
    	//redirect(__ROOT__."/");
        redirect(U("admin/public/login"));
    }
    
    public function dologin(){
        $login_page_showed_success=session("__SP_ADMIN_LOGIN_PAGE_SHOWED_SUCCESS__");
        if(!$login_page_showed_success){
            $this->error('login error!');
        }
    	$name = I("post.username");
    	if(empty($name)){
    		$this->error(L('USERNAME_OR_EMAIL_EMPTY'));
    	}
    	$pass = I("post.password");
    	if(empty($pass)){
    		$this->error(L('PASSWORD_REQUIRED'));
    	}
    	$verrify = I("post.verify");
    	if(empty($verrify)){
    		$this->error(L('CAPTCHA_REQUIRED'));
    	}
    	//验证码
    	if(!sp_check_shverify_code()){
    		$this->error(L('CAPTCHA_NOT_RIGHT'));
    	}else{
    		$user = D("Common/Users");
    		if(strpos($name,"@")>0){//邮箱登陆
    			$where['user_email']=$name;
    		}else{
    			$where['user_login']=$name;
    		}
    		
    		$result = $user->where($where)->find();
    		if(!empty($result) && $result['user_type']==1){
    			if(sp_compare_password($pass,$result['user_pass'])){
    				
    				$role_user_model=M("RoleUser");
    				
    				$role_user_join = C('DB_PREFIX').'role as b on a.role_id =b.id';
    				
    				$groups=$role_user_model->alias("a")->join($role_user_join)->where(array("user_id"=>$result["id"],"status"=>1))->getField("role_id",true);
    				
    				if( $result["id"]!=1 && ( empty($groups) || empty($result['user_status']) ) ){
    					$this->error(L('USE_DISABLED'));
    				}
    				//登入成功页面跳转
    				session('ADMIN_ID',$result["id"]);
    				session('name',$result["user_login"]);
                    //写入微信登录信息
                    $is_weixin = sp_is_weixin();
                    if($is_weixin) {
                        $u_info = $_SESSION['wechat_user'];
                        $headimage = $this->put_file_from_url_content($u_info['original']['headimgurl'], $u_info['id'] . ".jpg", "./data/upload/avatar/");
                        $head_url = "/data/upload/avatar/" . $u_info['id'] . ".jpg";
						if(empty($result['avatar'])){
							$result['avatar'] = $head_url ? $head_url : '';
						}
                        $result['openid'] = $u_info['id'] ? $u_info['id'] : '';
                        if ($result['avatar'] == '' || $result['openid'] == '') {
                            unset($result['avatar']);
                            unset($result['openid']);
                        }
                    }
    				$result['last_login_ip']=get_client_ip(0,true);
    				$result['last_login_time']=date("Y-m-d H:i:s");

    				$user->save($result);
    				cookie("admin_username",$name,3600*24*30);
                    $roleid = M('role_user')->where(array("user_id"=>$result["id"]))->field("role_id")->find();
                    $yyjls = array('3', '8', '7', '6', '5');
                    if ($roleid['role_id'] == 4) {
                        $this->success(L('LOGIN_SUCCESS'),U("headmaster/index/index"));
                        // $this->redirect(U("headmaster/index/index"));
                    } elseif (in_array($roleid['role_id'], $yyjls)){
                        $this->success(L('LOGIN_SUCCESS'),U("manager/index/index"));
                    } else {
                       $this->success(L('LOGIN_SUCCESS'),U("Index/index"));
                        //$this->redirect(U("Index/index"));
                    }
    			}else{
    				$this->error(L('PASSWORD_NOT_RIGHT'));
    			}
    		}else{
    			$this->error(L('USERNAME_NOT_EXIST'));
    		}
    	}
    }
    /**
     * 异步将远程链接上的内容(图片或内容)写到本地
     *
     * @param unknown $url
     *            远程地址
     * @param unknown $saveName
     *            保存在服务器上的文件名
     * @param unknown $path
     *            保存路径
     * @return boolean
     */
    function put_file_from_url_content($url, $saveName, $path) {
        // 设置运行时间为无限制
        set_time_limit ( 0 );

        $url = trim ( $url );
        $curl = curl_init ();
        // 设置你需要抓取的URL
        curl_setopt ( $curl, CURLOPT_URL, $url );
        // 设置header
        curl_setopt ( $curl, CURLOPT_HEADER, 0 );
        // 设置cURL 参数，要求结果保存到字符串中还是输出到屏幕上。
        curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, 1 );
        // 运行cURL，请求网页
        $file = curl_exec ( $curl );
        // 关闭URL请求
        curl_close ( $curl );
        // 将文件写入获得的数据
        $filename = $path . $saveName;
        $write = @fopen ( $filename, "w" );
        if ($write == false) {
            return false;
        }
        if (fwrite ( $write, $file ) == false) {
            return false;
        }
        if (fclose ( $write ) == false) {
            return false;
        }
    }

}
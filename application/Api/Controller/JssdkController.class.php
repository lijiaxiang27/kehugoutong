<?php
/**
 * 微信jssdk处理
 */
namespace Api\Controller;

use Common\Controller\AppframeController;

class JssdkController extends AppframeController {

    protected $app;
    protected $user_info;
    public function _initialize() {
		parent::_initialize();
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
    public function getJsSdk(){
        $js = $this->app->js;
		$aa = $js->config(array('onMenuShareTimeline','onMenuShareAppMessage', 'onMenuShareQQ', 'onMenuShareWeibo', 'onMenuShareQZone'), true, false, false);
		$this->assign('str', $aa);
		$this->display();
		
    }
    

}


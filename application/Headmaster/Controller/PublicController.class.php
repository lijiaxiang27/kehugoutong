<?php
namespace Headmaster\Controller;

use Common\Controller\AdminbaseController;

class PublicController extends AdminbaseController{
	
	protected $guestbook_model;
	
	public function _initialize() {
		parent::_initialize();
	}
	
	//提交成功跳转
	public function success(){
	    $data['time'] = time();
        $data['userid'] = sp_get_current_admin_id();
        $this->assign('data', $data);
		$this->display();
	}
    //提交失败跳转
    public function error(){
        $this->display();
    }

}
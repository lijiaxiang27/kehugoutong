<?php
/**
 * 运营服务模块
 */
namespace Headmaster\Controller;

use Common\Controller\AdminbaseController;

class ServiceController extends AdminbaseController {
	
	public function _initialize() {
		parent::_initialize();
	}
	//入校支持
    public function support() {

       	$this->display();
    }
    //家庭教育
    public function home() {
        $this->display();
    }
    //设计申请
    public function design() {
        $this->display();
    }
    //其他申请
    public function other_apply() {
        $this->display();
    }
}


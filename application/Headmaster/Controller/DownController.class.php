<?php
/**
 * 资料下载模块
 */
namespace Headmaster\Controller;

use Common\Controller\AdminbaseController;

class DownController extends AdminbaseController {
	protected $down_model;
	public function _initialize() {
		parent::_initialize();
        $this->down_model = M('material');
	}
	//运营资料
    public function yy_data() {
        $data = M('material as a')->join('cmf_doctype as b on a.doctype = b.id')
                                ->where(array('typeid'=>1))->field('a.id,a.title,a.content,a.pwd,a.time,b.icon')
                                ->order('time desc')
                                ->select();
        $this->assign('data', $data);
       	$this->display();
    }
    //市场方案
    public function sc_data() {
        $data = M('material as a')->join('cmf_doctype as b on a.doctype = b.id')
                                ->where(array('typeid'=>2))->field('a.id,a.title,a.content,a.pwd,a.time,b.icon')
                                ->order('time desc')
                                ->select();
        $this->assign('data', $data);
        $this->display();
    }
    //培训资料
    public function px_data() {
        $data = M('material as a')->join('cmf_doctype as b on a.doctype = b.id')
            ->where(array('typeid'=>3))->field('a.id,a.title,a.content,a.pwd,a.time,b.icon')
            ->order('time desc')
            ->select();
        $this->assign('data', $data);
        $this->display();
    }
    //其他资料
    public function qt_data() {
        $data = M('material as a')->join('cmf_doctype as b on a.doctype = b.id')
            ->where(array('typeid'=>4))->field('a.id,a.title,a.content,a.pwd,a.time,b.icon')
            ->order('time desc')
            ->select();
        $this->assign('data', $data);
        $this->display();
    }
}


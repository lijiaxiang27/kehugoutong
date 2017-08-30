<?php
/**
 * 资料更新
 */

namespace Manager\Controller;


use Common\Controller\AdminbaseController;

class MaterialController extends AdminbaseController
{
    public function _initialize()
    {
        parent::_initialize();
    }
//    资料更新首页
    public function index(){
//        运营资料
        $yy_data = M('material as a')->join('cmf_doctype as b on a.doctype = b.id')
            ->where(array('typeid'=>1))->field('a.id,a.title,a.content,a.pwd,a.time,b.icon')
            ->order('time desc')
            ->select();
//      市场方案
        $sc_data = M('material as a')->join('cmf_doctype as b on a.doctype = b.id')
            ->where(array('typeid'=>2))->field('a.id,a.title,a.content,a.pwd,a.time,b.icon')
            ->order('time desc')
            ->select();
//        培训资料
        $px_data = M('material as a')->join('cmf_doctype as b on a.doctype = b.id')
            ->where(array('typeid'=>3))->field('a.id,a.title,a.content,a.pwd,a.time,b.icon')
            ->order('time desc')
            ->select();
//        其他资料
        $qt_data = M('material as a')->join('cmf_doctype as b on a.doctype = b.id')
            ->where(array('typeid'=>4))->field('a.id,a.title,a.content,a.pwd,a.time,b.icon')
            ->order('time desc')
            ->select();
        $this->assign('yy_data', $yy_data);
        $this->assign('sc_data', $sc_data);
        $this->assign('px_data', $px_data);
        $this->assign('qt_data', $qt_data);
        $this->display();
    }
    //资料添加
    public function add_material(){

        $this->display();
    }
//    资料添加提交
    public function add_material_post(){

        $this->display();
    }
//    资料编辑
    public function edit_material(){

        $this->display();
    }
//    资料编辑提交
    public function edit_material_post(){

        $this->display();
    }
//资料删除
    public function delete_material(){

        $this->display();
    }

}
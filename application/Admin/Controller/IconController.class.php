<?php
/**
 * 后台首页
 */
namespace Admin\Controller;

use Common\Controller\AdminbaseController;

class IconController extends AdminbaseController {
	protected $doctype_model;
	public function _initialize() {
		parent::_initialize();
        $this->doctype_model = M('doctype');
	}
	//图标列表
    public function index() {
        $icons = $this->doctype_model->select();
        $this->assign('icons', $icons);
        $this->display();
    }

    //添加图标
    public function add() {
        $id = I('get.id');
        $this->assign('id', $id);

        $doctypes = M('doctype')->select();
        $this->assign('doctypes', $doctypes);
        $this->display();
    }
    //添加图标提交
    public function add_post() {
        $post = I('post.');
        $post['time'] = time();
        $post['upid'] = sp_get_current_admin_id();
        if ($this->doctype_model->create()!==false) {
            if ($this->doctype_model->add()!==false) {
                $this->success("添加成功！", U("Icon/index"));
            } else {
                $this->error("添加失败！");
            }
        } else {
            $this->error($this->doctype_model->getError());
        }
    }
    //编辑图标
    public function edit() {
        $id = I('get.id');
        $icon = $this->doctype_model->where(array('id'=>$id))->find();
        $this->assign($icon);
        $this->display();
    }
    //编辑提交
    public function edit_post() {
        if (IS_POST) {
            if ($this->doctype_model->create()!==false) {
                if ($this->doctype_model->save()!==false) {
                    $this->success("编辑成功！", U("Icon/index"));
                } else {
                    $this->error("编辑失败！");
                }
            } else {
                $this->error($this->doctype_model->getError());
            }
        }

    }
    //删除
    public function delete() {
        $id = I('get.id');
        if ($this->doctype_model->delete($id)!==false) {
            $this->success("删除成功！");
        } else {
            $this->error("删除失败！");
        }
    }
}


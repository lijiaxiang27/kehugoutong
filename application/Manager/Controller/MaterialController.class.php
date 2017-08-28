<?php
/**
 * Created by PhpStorm.
 * User: tester
 * Date: 17/7/20
 * Time: 14:27
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
        $this->display();
    }
}
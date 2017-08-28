<?php
/**
 * Created by PhpStorm.
 * User: tester
 * Date: 17/7/19
 * Time: 14:42
 */

namespace Manager\Controller;


use Common\Controller\AppframeController;

class ApiController extends AppframeController
{
    public function _initialize() {
        parent::_initialize();
    }
    //分享+1
    public function share_plus(){
        $id = I('post.id');
        M('act')->where(array('id'=>$id))->setInc('share');
        return M('act')->_sql;
    }
}
<?php
/**
 * 校长后台首页
 */
namespace Headmaster\Controller;

use Common\Controller\AdminbaseController;

class IndexController extends AdminbaseController {
	
	public function _initialize() {
	    empty($_GET['upw'])?"":session("__SP_UPW__",$_GET['upw']);//设置后台登录加密码	    
		parent::_initialize();
		$this->initMenu();
	}
    function _empty()
    {
        header("HTTP/1.0 404 Not Found");
        $this->display("Public:404");
    }
    /**
     * 后台框架首页
     */
    public function index() {
        $term=sp_get_term(1);
//        $count=D('term_relationships as a')->join('cmf_posts as b on b.id=a.object_id')->where(array('b.post_type'=>1,'b.post_status'=>1,'a.status'=>1,'a.term_id'=>1))->count();
//        $page = $this->page($count, 20);
        //凹凸生活
        $reports = D('term_relationships as a')->join('cmf_posts as b on b.id=a.object_id')
            ->field('b.post_date,b.post_title,b.post_excerpt,b.smeta,b.id')
            ->order('a.listorder asc,b.istop,b.post_date desc')
            ->where(array('b.post_type'=>1,'b.post_status'=>1,'a.status'=>1,'a.term_id'=>1))
            ->limit(1)
            ->select();
        foreach ($reports as $k=>&$v) {
            $v['post_date'] = date('Y-m-d',strtotime($v['post_date']));
        }
        //最新活动
        $acts = M('act')->order('time desc')->limit('3')->select();
        $userid = sp_get_current_admin_id();
        //当前时间,判断活动是否过期
        $nowtime = time();

        //isbm  判断是否已经报名
        foreach($acts as $kk=>$vv){
        	//判断是否过期
            if ($nowtime > strtotime($vv['endtime'] . " 23:59:59")) {
                $acts[$kk]['isover'] = 1;
            } else {
                $acts[$kk]['isover'] = 0;
            }
            //判断是否报名
            $rs = M('act_user')->where(array('act_id'=>$vv['id'],'userid'=>$userid))->find();
            if ($rs) {
                $acts[$kk]['isbm'] = 1;
            } else {
                $acts[$kk]['isbm'] = 0;
            }
        	//判断报名人数是否已满
            $num = M('act_user')->where(array('act_id'=>$vv['id']))->field('num')->select();
            $max_num = $vv['num'];
            $already_bm = 0;
            foreach($num as $kkk=>$vvv){
            	$already_bm += $vvv['num'];
            }
            if ($already_bm >= $vv['num']) {
            	$acts[$kk]['isfull'] = 1;
            } else {
            	$acts[$kk]['isfull'] = 0;
            }
        }
        $this->assign('acts', $acts);
        $this->assign($term);
//        $this->assign("page", $page->show('Admin'));
//        $this->assign('count', $count);
        $this->assign('reports', $reports);
        $this->assign('active', 'about');
        $this->assign('current', 1);
        $this->display();
    }
    //支持页面
    public function support() {
        $term=sp_get_term(2);
        //凹凸故事
        $storys = D('term_relationships as a')->join('cmf_posts as b on b.id=a.object_id')
            ->field('b.post_date,b.post_title,b.post_excerpt,b.smeta,b.id')
            ->order('a.listorder asc,b.istop,b.post_date desc')
            ->where(array('b.post_type'=>1,'b.post_status'=>1,'a.status'=>1,'a.term_id'=>2))
            ->limit(1)
            ->select();
        foreach ($storys as $k=>&$v) {
            $v['post_date'] = date('Y-m-d',strtotime($v['post_date']));
        }
        $this->assign('storys', $storys);
        $this->assign('current', 2);
        $this->display();
    }
    //采购页面
    public function buy() {

        $this->assign('current', 3);
        $this->display();
    }
    //北京支持中心
    public function bjsupport() {
        $this->display();
    }
    //长沙支持中心
    public function cssupport() {
        $this->display();
    }
    //帮助页面
    public function help() {
        $this->display();
    }
}


<?php
/**
 * 凹凸生活/凹凸故事
 */
namespace Headmaster\Controller;

use Common\Controller\AdminbaseController;

class AtliveController extends AdminbaseController {
	public function _initialize() {
		parent::_initialize();
	}
	public function index() {
	    $id = I('get.id');
        $term_id = D('term_relationships')->where(array('object_id'=>$id))->field('term_id')->find();
        $term=sp_get_term($term_id['term_id']);
        $atlive = D('posts')->where(array('id'=>$id))->field('post_author,post_date,post_content,post_title,post_keywords,post_excerpt,post_hits')->find();
        $this->assign('atlive', $atlive);
        $this->assign('term', $term['name']);
        $this->display();
    }
}


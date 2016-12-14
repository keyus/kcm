<?php
namespace app\admin\controller;
use \think\Controller;
use \app\admin\model\Category;
use \think\Cookie;
use \think\Session;
class Categorys extends Controller
{
    public function _initialize(){
        if(!isLogin()){
            $this->redirect(ADMIN_ROUTE.'login');
        }
    }
    public function model(){
        $Article=new Category;
        return $Article;
    }

    public function listing()
    {
        $list=$this->model()->getTree();
        $this->assign('list',$list);
        return $this->fetch('list');
    }
    public function edit(){
        $list=$this->model()->getTree();
        $this->assign('list',$list);
        $cate=false;
        if(Cookie::get('category_id')){
            $cate=$this->model()->getOneCate(Cookie::get('category_id'));
        }
        $this->assign('cate',$cate);
        return $this->fetch('edit');
    }
}

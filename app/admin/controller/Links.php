<?php
namespace app\admin\controller;
use \think\Controller;
use \app\admin\model\Link;
use think\Cookie;
use think\Request;

class Links extends Controller
{
    public function _initialize(){
        if(!isLogin()){
            $this->redirect(ADMIN_ROUTE.'login');
        }
    }
    public function model(){
        return new Link;
    }

    //主页
    public function index($pid=null){
        $links_type_id=false;
        if(intval($pid)){
            //搜索
            $links=$this->model()->getSearch($pid);
            $links_type_id=$pid;
        }else{
            $links=$this->model()->getLinks();
        }
        $links_type=$this->model()->getLinksType();
        $this->assign('links_type',$links_type);
        $this->assign('links',$links);
        $this->assign('links_type_id',$links_type_id);
        return $this->fetch();
    }

    //添加与更新
    public function edit(){
        $links=false;
        $links_id=false;
        $id=intval(Cookie::get('links_id'));
        if($id){
            $links=$this->model()->getLinks($id);
        }
        $links_type=$this->model()->getLinksType();

        $this->assign('links_type',$links_type);
        $this->assign('links',$links);
        return $this->fetch();
    }

    //分类
    public function type(){
        $list=$this->model()->getLinksType();
        $this->assign('list',$list);
        return $this->fetch();
    }

    //添加分类与更新
    public function edit_type(){
        $type=false;
        if(Cookie::get('links_type_id')){
            $type=$this->model()->getLinksType(Cookie::get('links_type_id'));
        }
        $this->assign('type',$type);
        return $this->fetch('edit_type');
    }

}

<?php
namespace app\web\controller;
use \think\Controller;

class Webs extends Controller
{

    public function _initialize()
    {
        //站点配置
        $this->assign('site',getSite());
        //金融网产链接
        $this->assign('bank_links',getlinks(7));
    }
    //首页 渲染
    public function index()
    {
        return $this->fetch();
    }

    //列表
    public function listing($id)
    {
        if(intval($id)){
            //分页
            $this->assign('list',getPA($id));
            //分类名
            $this->assign('cate',getCName($id));
            return $this->fetch('list');
        }
        abort(404,'页面不存在');
    }

    //内容页
    public function view($id){
        if(intval($id)){
            $this->assign('article',getA($id));
            return $this->fetch();
        }
        abort(404,'页面不存在');
    }

    //栏目页
    public function column($name){

        $column=getColumn($name);
        if($column){
            $this->assign('column',$column);
            return $this->fetch();
        }
        abort(404,'页面不存在');
    }

    //下载
    public function down(){
        return $this->fetch();
    }
}

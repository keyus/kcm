<?php
namespace app\admin\controller;
use \think\Controller;
use \app\admin\model\Article;
use \app\admin\model\Category;
use \think\Cookie;
use think\Request;

class Articles extends Controller
{
    public function _initialize(){
        if(!isLogin()){
            $this->redirect(ADMIN_ROUTE.'login');
        }
    }
    public function model(){
        $Article=new Article;
        return $Article;
    }
    //文章列表
    public function listing(Request $request)
    {
        //获取分类树
        $category=new Category;
        $tree=$category->getTree();

        $search_value=false;    //记录搜索文本或类型
        //是否有搜索参数
        $search=$request->param();
        if($search){
            $filter=$request->param('filter');              //input 关键字
            $category=$request->param('category');          //分类筛选值
            $list=$this->model()->search($filter,$category,$tree);
            Cookie::set('search_category_id',$category);
            $search_value=$filter;
        }else{
            $list=$this->model()->getPage();
        }

        //文章列表
        $this->assign('tree',$tree);
        $this->assign('list',$list);
        $this->assign('search_value',$search_value);
        return $this->fetch('list');
    }

    //添加或编辑文章
    public function edit(){
        $category=new Category;
        $tree=$category->getTree();
        $this->assign('tree',$tree);
        $article=false;
        if(Cookie::get('article_id')){
            $article=$this->model()->getOneArticle(Cookie::get('article_id'));
        }
        $this->assign('article',$article);
        return $this->fetch('edit');
    }

}

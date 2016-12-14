<?php
namespace app\admin\controller;
use \think\Controller;
use \app\admin\model\Column;
use \think\Cookie;
use think\Request;

class Columns extends Controller
{
    public function _initialize(){
        if(!isLogin()){
            $this->redirect(ADMIN_ROUTE.'login');
        }
    }
    public function model(){
        return new Column;
    }

    public function index()
    {
        $this->assign('list',$this->model()->getCol());
        return $this->fetch('list');
    }

    //添加或编辑文章
    public function edit(){
        $column=false;
        if(Cookie::get('column_id')){
            $column=$this->model()->getCol(Cookie::get('column_id'));
        }
        $this->assign('column',$column);
        return $this->fetch('edit');
    }

}

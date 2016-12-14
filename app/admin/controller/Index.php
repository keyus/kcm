<?php
namespace app\admin\controller;
use \think\Controller;

class Index extends Controller
{
    //检测
    public function _initialize(){
        if(!isLogin()){
            $this->redirect(ADMIN_ROUTE.'login');
        }
    }
    //首页 渲染
    public function index()
    {
        return $this->fetch();
    }

}

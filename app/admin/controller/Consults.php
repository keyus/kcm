<?php
namespace app\admin\controller;
use \think\Controller;
use \app\admin\model\Consult;

class Consults extends Controller
{
    public function _initialize(){
        if(!isLogin()){
            $this->redirect(ADMIN_ROUTE.'login');
        }
    }
    public function model(){
        return new Consult;
    }

    //主页
    public function index(){
        $list=$this->model()->getPage();

        $this->assign('list',$list);
        return $this->fetch();
    }

}

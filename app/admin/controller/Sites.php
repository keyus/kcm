<?php
namespace app\admin\controller;
use \think\Controller;
use \app\admin\model\Site;
use think\Cookie;
use think\Request;

class Sites extends Controller
{
    public function _initialize(){
        if(!isLogin()){
            $this->redirect(ADMIN_ROUTE.'login');
        }
    }
    public function model(){
        $Site=new Site;
        return $Site;
    }

    //主页
    public function index(Request $request){
        $query=$request->param();
        if($query){
            if($this->model()->savaData($query)){
                Cookie::set('site_save','1');
            }else{
                Cookie::set('site_save','0');
            }
            $this->redirect(ADMIN_ROUTE.'site');
        }
        $this->assign('site',$this->model()->getSite());
        return $this->fetch();
    }

}

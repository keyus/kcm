<?php
namespace app\admin\controller;
use \think\Controller;
use \app\admin\model\User;
use \think\Cookie;
use think\Session;
class Users extends Controller
{
    public function _initialize(){
        if(!isLogin()){
            $this->redirect(ADMIN_ROUTE.'login');
        }
    }
    public function index()
    {
        return $this->fetch();
    }

    //添加用户
    public function add(){
        $User=new User;
        $User->getUser();
        $this->assign('UserList',$User->getUser());
        return $this->fetch();
    }

    //用户列表
    public function entry(){
        return $this->fetch('list');
    }
    //编辑页面
    public function edit(){
        if(!Cookie::get('update_userid')){
            $this->error('页面错误，请稍候再试!');
        }
        Session::set('session_update_userid',Cookie::get('update_userid'));
        return $this->fetch();
    }




}

<?php
namespace app\admin\controller;
use \think\Controller;

class Login extends Controller
{

    public function index()
    {
        if(isLogin()){
            return $this->redirect(ADMIN_ROUTE);
        }
        return $this->fetch();
    }
    //登出
    public function logout(){
        logout();
        $this->redirect(ADMIN_ROUTE.'login');
    }


}
